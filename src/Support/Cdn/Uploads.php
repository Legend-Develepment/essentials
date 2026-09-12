<?php

namespace LegendDevelopment\Theme\Support\Cdn;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Where a file this plugin owns is kept, and the address it is read from.
 *
 * **One door for three places.** The panel's own disk, an S3 bucket, or a CDN
 * that speaks the Modora API. Everything that wants to keep a file asks the
 * same question here - take these bytes, tell me where they landed - and gets
 * back an address or nothing.
 *
 * **An address that has been written down is never taken back.** This decides
 * where a file goes *now*; a row that already holds a CDN address goes on
 * holding it when the setting changes back to the panel, because the file is
 * still there and the row is still right. Switching the destination is a
 * decision about the next file, not about every file ever kept.
 *
 * **Nothing here is allowed to lose a file.** Every failure answers null and
 * the caller writes to the panel's own disk instead. A misconfigured setting is
 * a thing to fix; somebody's screenshot of the error they are reporting is not
 * a thing to lose over it.
 */
class Uploads
{
    /** The panel's own disk. What every panel does until it is told otherwise. */
    public const PANEL = 'panel';

    /** Anything speaking the S3 protocol: AWS, R2, Backblaze, Wasabi, MinIO. */
    public const BUCKET = 's3';

    /** A CDN speaking the Modora API. */
    public const CDN = 'cdn';

    /** What the CDN's own upload endpoint is called, under the base address. */
    private const UPLOAD = '/api/upload';

    /** Long enough for a slow CDN, short enough not to hold a page open. */
    private const TIMEOUT = 20;

    /** Why the last attempt did not work, for the button that asks. */
    private static string $problem = '';

    /** Where files are being put today. */
    public static function where(): string
    {
        $where = trim((string) Theme::config('files_where', self::PANEL));

        return in_array($where, [self::PANEL, self::BUCKET, self::CDN], true) ? $where : self::PANEL;
    }

    /**
     * Whether anything other than the panel's own disk is set up and switched
     * on.
     *
     * Both halves matter. A destination chosen but left half filled in is a
     * panel that would silently stop keeping files, so "configured" is asked
     * here and not assumed from the choice.
     */
    public static function on(): bool
    {
        return match (self::where()) {
            self::BUCKET => self::bucket() !== null,
            self::CDN => self::token() !== '' && self::base() !== '',
            default => false,
        };
    }

    /** What went wrong last, in the far end's own words where there are any. */
    public static function problem(): string
    {
        return self::$problem;
    }

    /**
     * Keep these bytes somewhere that is not this panel, and say where.
     *
     * Null means "not from here" for every reason there is: the setting says
     * panel, the destination is half configured, the write was refused. All of
     * them mean the same thing to the caller, which is why none of them throws.
     *
     * @param  string  $folder  A path under the destination's root, no slashes at either end.
     * @param  string  $name  The name to keep it under. Already unguessable by the time it arrives.
     * @param  bool  $fixed  This exact folder and this exact name, on every
     *                        panel - because something else is going to ask for
     *                        it by that address rather than be told where it is.
     */
    public static function put(
        string $folder,
        string $name,
        string $bytes,
        string $type,
        bool $fixed = false,
    ): ?string {
        self::$problem = '';

        return match (self::where()) {
            self::BUCKET => self::toBucket($folder, $name, $bytes, $type),
            self::CDN => self::toCdn($folder, $name, $bytes, $type, $fixed),
            default => null,
        };
    }

    /**
     * The address of something this plugin stored, whatever it stored it as.
     *
     * **A value that is already an address is one**, and that is the whole of
     * how switching destinations stays safe: a file that went to a CDN was
     * written down as where it is, so it goes on being read from there when the
     * setting changes back. Anything else is a path on the panel's own disk and
     * is turned into an address the way it always was.
     *
     * Null for nothing stored, or for a disk that will not answer - which is a
     * missing picture rather than a page that will not draw.
     */
    public static function address(string $stored): ?string
    {
        $stored = trim($stored);

        if ($stored === '') {
            return null;
        }

        if (str_starts_with($stored, 'https://') || str_starts_with($stored, 'http://')) {
            return $stored;
        }

        try {
            $url = (string) Storage::disk('public')->url(ltrim($stored, '/'));
        } catch (Throwable) {
            return null;
        }

        return $url !== '' ? $url : null;
    }

    /**
     * Move what is still on this panel to wherever files now go.
     *
     * **Nothing here is automatic, and that is the point.** Turning the setting
     * on decides where the next file goes; this is the separate decision to
     * move the ones already here, which is a thing somebody means. It is also
     * the one operation in this class that changes an address already written
     * down, so it is the one thing a person presses rather than a thing that
     * happens to them.
     *
     * The panel's copy is left where it is. A file is small, the setting is one
     * word, and somebody who changes their mind should find the old one still
     * there rather than a broken picture and an apology.
     *
     * @param  array<string, string>  $stored  Setting name to stored value.
     * @return array{moved: array<string, string>, looked: int, failed: int}
     */
    public static function move(array $stored): array
    {
        $out = ['moved' => [], 'looked' => 0, 'failed' => 0];

        if (!self::on()) {
            return $out;
        }

        $disk = Storage::disk('public');

        foreach ($stored as $key => $path) {
            $path = trim($path);

            // Already somewhere else, or nothing at all. Neither is work.
            if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                continue;
            }

            $out['looked']++;

            try {
                if (!$disk->exists($path)) {
                    $out['failed']++;

                    continue;
                }

                $bytes = (string) $disk->get($path);
                $type = (string) ($disk->mimeType($path) ?: 'application/octet-stream');
            } catch (Throwable $exception) {
                report($exception);
                $out['failed']++;

                continue;
            }

            /*
             * A new name rather than the one it has. The name on the panel is a
             * ULID that was never secret, and the address it is about to get is
             * one the world can fetch.
             */
            $extension = mb_strtolower((string) pathinfo($path, PATHINFO_EXTENSION));
            $extension = preg_match('~^[a-z0-9]{1,8}$~', $extension) === 1 ? $extension : 'bin';

            $url = self::put('theme', bin2hex(random_bytes(16)) . '.' . $extension, $bytes, $type);

            if ($url === null) {
                $out['failed']++;

                continue;
            }

            $out['moved'][$key] = $url;
        }

        return $out;
    }

    /**
     * Whether the destination actually works, said in a sentence.
     *
     * Writes something, reads it back and removes it, because that is the only
     * way to find out: a key that looks right and a destination that refuses a
     * write are the same screen until something is written. Null when it worked.
     */
    public static function check(): ?string
    {
        $where = self::where();

        if ($where === self::PANEL) {
            return Theme::trans('settings.files.check_panel');
        }

        $name = 'check-' . bin2hex(random_bytes(8)) . '.txt';
        $url = self::put('checks', $name, 'legend-theme', 'text/plain');

        if ($url === null) {
            $why = self::problem();

            return $why !== '' ? $why : Theme::trans('settings.files.check_refused');
        }

        /*
         * And read back over the public address, not through the API. That is
         * the address a browser and a Discord will use, so it is the one worth
         * proving - a bucket that takes a file and serves nothing is a bucket
         * that looks like it works from in here.
         */
        try {
            $back = Http::timeout(self::TIMEOUT)->get($url);

            if (!$back->successful() || trim($back->body()) !== 'legend-theme') {
                return Theme::trans('settings.files.check_unreadable', ['url' => $url]);
            }
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }

        self::forget('checks', $name);

        return null;
    }

    /**
     * Take a probe file away again.
     *
     * Only ever used by check(). Anything else this class writes is somebody's
     * file, and a class that can quietly remove those is a class one wrong call
     * away from a bad afternoon.
     */
    private static function forget(string $folder, string $name): void
    {
        $at = trim($folder, '/') . '/' . $name;

        try {
            if (self::where() === self::BUCKET) {
                self::bucket()?->delete($at);

                return;
            }

            Http::withHeaders(['X-Internal-Token' => self::token()])
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->delete(self::base() . '/api/images', ['path' => $at]);
        } catch (Throwable) {
            // A probe file left behind is untidy and nothing worse. It is one
            // object called check-<hex>.txt in a folder of its own.
        }
    }

    // ------------------------------------------------------------ the bucket

    private static function toBucket(string $folder, string $name, string $bytes, string $type): ?string
    {
        $disk = self::bucket();

        if ($disk === null) {
            self::$problem = Theme::trans('settings.files.bucket_missing');

            return null;
        }

        $at = trim($folder, '/') . '/' . $name;

        try {
            /*
             * Public, and the type said out loud. A bucket serves what it was
             * told an object is, so a picture written without a type comes back
             * as a download prompt - and the whole point of putting it there is
             * that a browser can simply look at it.
             */
            $disk->put($at, $bytes, [
                'visibility' => 'public',
                'ContentType' => $type,
                'CacheControl' => 'public, max-age=31536000, immutable',
            ]);
        } catch (Throwable $exception) {
            self::$problem = $exception->getMessage();

            return null;
        }

        return self::bucketUrl($disk, $at);
    }

    /**
     * The bucket, built from this plugin's own settings.
     *
     * Its own rather than Pelican's `s3` disk: that one is shared with whatever
     * else a panel does with it, and where this plugin's files live is a
     * decision about this plugin. Built on demand rather than registered at
     * boot, so a panel that never turns this on pays nothing for it.
     */
    private static function bucket(): ?Filesystem
    {
        $key = trim((string) Theme::config('files_s3_key', ''));
        $secret = trim((string) Theme::config('files_s3_secret', ''));
        $bucket = trim((string) Theme::config('files_s3_bucket', ''));

        if ($key === '' || $secret === '' || $bucket === '') {
            return null;
        }

        $endpoint = trim((string) Theme::config('files_s3_endpoint', ''));

        try {
            return Storage::build(array_filter([
                'driver' => 's3',
                'key' => $key,
                'secret' => $secret,
                'region' => trim((string) Theme::config('files_s3_region', 'auto')) ?: 'auto',
                'bucket' => $bucket,
                'endpoint' => $endpoint !== '' ? $endpoint : null,
                // What R2, MinIO and most self-hosted ones need, and what AWS
                // does not. A switch rather than a guess from the endpoint.
                'use_path_style_endpoint' => (bool) Theme::config('files_s3_path_style', false),
                'url' => self::readFrom() ?: null,
                // Loud, because this class is the thing deciding whether to
                // fall back and it cannot decide on silence.
                'throw' => true,
            ], static fn (mixed $value): bool => $value !== null));
        } catch (Throwable $exception) {
            self::$problem = $exception->getMessage();

            return null;
        }
    }

    private static function bucketUrl(Filesystem $disk, string $at): ?string
    {
        $base = self::readFrom();

        if ($base !== '') {
            return $base . '/' . ltrim($at, '/');
        }

        try {
            $url = (string) $disk->url($at);
        } catch (Throwable $exception) {
            self::$problem = $exception->getMessage();

            return null;
        }

        return str_starts_with($url, 'https://') ? $url : null;
    }

    // --------------------------------------------------------------- the CDN

    /**
     * Hand it to the CDN, and work out what it answered.
     *
     * **Their reply is read rather than assumed**, and that is deliberate. The
     * published description of this endpoint says what to send and says nothing
     * at all about what comes back, so every plausible shape is looked for: an
     * address anywhere obvious, or a path this class can build one from. If
     * none of them is there the upload is treated as refused rather than
     * guessed at - a file whose address is a guess is a broken picture later.
     */
    private static function toCdn(
        string $folder,
        string $name,
        string $bytes,
        string $type,
        bool $fixed = false,
    ): ?string {
        $token = self::token();
        $base = self::base();

        if ($token === '' || $base === '') {
            self::$problem = Theme::trans('settings.files.cdn_missing');

            return null;
        }

        /*
         * A panel's own files go under its own folder, so one CDN can serve
         * several without them treading on each other. A shared one does not,
         * because the whole point of it is that the address is the same
         * wherever it is asked for.
         */
        $folder = $fixed
            ? trim($folder, '/')
            : trim(trim((string) Theme::config('files_cdn_folder', '')) . '/' . trim($folder, '/'), '/');

        try {
            $response = Http::withHeaders(['X-Internal-Token' => $token])
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->attach('files', $bytes, $name, ['Content-Type' => $type])
                ->post($base . self::UPLOAD, ['folder' => $folder]);
        } catch (Throwable $exception) {
            self::$problem = $exception->getMessage();

            return null;
        }

        if (!$response->successful()) {
            self::$problem = trim(mb_substr((string) $response->body(), 0, 400))
                ?: ('HTTP ' . $response->status());

            return null;
        }

        $url = self::addressIn($response->json(), $folder, $name);

        /*
         * And made to keep the name it was given, where the name is the point.
         *
         * This CDN renames every upload to a hash of its contents - which is
         * exactly right for a picture, whose address nobody types and whose
         * bytes never change once written, and exactly wrong for a language
         * file that something else is going to fetch by name.
         */
        if ($fixed && $url !== null) {
            $url = self::insist($folder, $name, (string) ($response->json('path') ?? '')) ?? $url;
        }

        if ($url === null) {
            // Kept whole, because the one thing anybody setting this up needs
            // is to see what their CDN actually said.
            self::$problem = Theme::trans('settings.files.cdn_shape', [
                'body' => mb_substr(trim((string) $response->body()), 0, 300),
            ]);
        }

        return $url;
    }

    /**
     * Make the file at `$was` answer to the name we asked for.
     *
     * Three calls where one would do, because their API has no "replace": an
     * upload is hashed, a rename refuses a name that is taken, and so the old
     * one has to go first. Ordered so the gap is as small as it can be - the
     * upload is done by the time this starts, and what is left is two quick
     * calls.
     *
     * Null when it could not be done, and the caller keeps the hashed address:
     * a file at the wrong name is worth more than no file.
     */
    private static function insist(string $folder, string $name, string $was): ?string
    {
        $was = trim($was, '/');

        if ($was === '') {
            return null;
        }

        $want = $folder . '/' . $name;

        if ($was === $want) {
            return null;
        }

        try {
            /*
             * The one already there, if any. A 404 here is the ordinary case
             * and not a fault - it is the first time this name has been used.
             */
            Http::withHeaders(['X-Internal-Token' => self::token()])
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->delete(self::base() . '/api/images?path=' . rawurlencode($want));

            /*
             * Form-encoded, and that is not a preference. Their rename reads
             * its fields from a form body; JSON, a query string and a raw body
             * all come back "field required" with the input seen as null.
             */
            $done = Http::withHeaders(['X-Internal-Token' => self::token()])
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asForm()
                ->patch(self::base() . '/api/images/rename', [
                    'path' => $was,
                    'new_name' => $name,
                ]);

            if (!$done->successful()) {
                return null;
            }
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        $base = self::readFrom() ?: self::base();

        return $base . '/' . $want;
    }

    /**
     * An address somewhere in what they answered.
     *
     * Every shape an upload endpoint plausibly replies with, tried in order of
     * how directly it says what we asked: a whole address first, then a path to
     * hang off the base, then the name we sent under the folder we sent it to -
     * which is what the public delivery route is documented to serve, and the
     * only one of the three that does not depend on their wording.
     *
     * @param  mixed  $body
     */
    private static function addressIn(mixed $body, string $folder, string $name): ?string
    {
        $base = self::readFrom() ?: self::base();

        if (is_array($body)) {
            $flat = [];
            array_walk_recursive($body, static function (mixed $value) use (&$flat): void {
                if (is_string($value)) {
                    $flat[] = $value;
                }
            });

            foreach ($flat as $value) {
                $value = trim($value);

                if (str_starts_with($value, 'https://')) {
                    return mb_substr($value, 0, 900);
                }
            }

            /*
             * No address, but perhaps a path. Anything that ends in the name we
             * just sent is the file we just sent, whatever the field around it
             * is called.
             */
            foreach ($flat as $value) {
                $value = trim($value, " \t\n\r\0\x0B/");

                if ($value !== '' && str_ends_with($value, $name)) {
                    return mb_substr($base . '/' . $value, 0, 900);
                }
            }
        }

        /*
         * And failing both, where the documented delivery route says it will
         * be. Only when the CDN was told a folder, so this cannot invent an
         * address for a reply that was an outright failure dressed as success.
         */
        return $folder === '' ? null : mb_substr($base . '/' . $folder . '/' . $name, 0, 900);
    }

    /** The CDN's address, with no trailing slash. */
    private static function base(): string
    {
        $base = rtrim(trim((string) Theme::config('files_cdn_base', '')), '/');

        return str_starts_with($base, 'https://') ? $base : '';
    }

    /** The key, as an administrator typed it. */
    private static function token(): string
    {
        return trim((string) Theme::config('files_cdn_token', ''));
    }

    /**
     * Where files are read from, which is not always where they were written.
     *
     * A CDN in front of a bucket is exactly this setting, and so is a delivery
     * host that differs from the API host - which is the ordinary case rather
     * than an odd one.
     */
    private static function readFrom(): string
    {
        return rtrim(trim((string) Theme::config('files_read_from', '')), '/');
    }
}
