<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use Illuminate\Support\Facades\Storage;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Models\TicketMessage;
use LegendDevelopment\Theme\Support\Cdn\Uploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;

/**
 * A picture attached to a ticket message.
 *
 * **Modora will not take the file.** Their message endpoint accepts a multipart
 * upload, answers success, and throws it away: the message lands in the channel
 * with `attachments: []`. So the picture stays here and the message carries a
 * link to it, which Discord unfurls into the picture anyway - the same thing
 * arrives in the channel by a different road.
 *
 * **Which means the address has to be reachable without signing in**, because
 * the thing fetching it is Discord rather than the customer. So it is
 * unguessable instead: a random name, no listing, no way to walk from one to
 * the next. The same argument as the webhook address, and the same limits on
 * what it can do - this one only ever hands back a picture.
 *
 * **Any file, and the panel decides what it is looking at.** A support ticket
 * is where somebody sends a crash log, a config, a modpack list - insisting on
 * pictures was insisting they paste a thousand lines into a text box.
 *
 * What does not change is that the type is read out of the file rather than
 * taken from its name, because a name is whatever the uploader typed. A file
 * that opens as a picture is served as that picture and drawn in the
 * conversation. **Everything else is served as bytes and never drawn**: one
 * content type, `application/octet-stream`, always as an attachment, and an
 * ending that claims to be a picture is taken away from it on the way in. That
 * is what stops "screenshot.png" being served as the html it actually contains,
 * which is the one way an upload box becomes somebody else's script running on
 * this panel.
 *
 * **Or somewhere that is not this panel**, which is a decision about every
 * file this plugin keeps rather than about tickets, and therefore not one this
 * class makes. Cdn\Uploads answers it. A destination that will not answer
 * falls back to the panel's own disk - a misconfigured setting is a thing to
 * fix, and a customer's screenshot of the error they are reporting is not a
 * thing to lose over it.
 */
class Files
{
    /** Where they live, under the local disk. */
    public const FOLDER = 'legend-theme/tickets';

    /** Eight megabytes, which is what Discord itself will show. */
    public const MOST = 8388608;

    /**
     * What everything that is not a picture is served as.
     *
     * One type for all of them, and an attachment rather than inline. A panel
     * that served a .html or an .svg back with its own type would be hosting
     * somebody else's script on its own domain, and there is no list of endings
     * long enough to be safe - so nothing outside the four below is ever given
     * a type at all.
     */
    public const PLAIN = 'application/octet-stream';

    /**
     * What is drawn as a picture, and what each one is served as.
     *
     * The value is the type this panel will answer with - never the type the
     * upload claimed - so the list is both the allow list and the answer.
     */
    public const KINDS = [
        IMAGETYPE_PNG => ['png', 'image/png'],
        IMAGETYPE_JPEG => ['jpg', 'image/jpeg'],
        IMAGETYPE_GIF => ['gif', 'image/gif'],
        IMAGETYPE_WEBP => ['webp', 'image/webp'],
    ];

    /**
     * Keep an uploaded file, and say what was kept.
     *
     * @return array{name: string, type: string, size: int, picture: bool, token?: string, url?: string}|null
     */
    public static function keep(mixed $file): ?array
    {
        if (!$file instanceof TemporaryUploadedFile) {
            return null;
        }

        try {
            if ($file->getSize() > self::MOST) {
                return null;
            }

            $name = mb_substr((string) $file->getClientOriginalName(), 0, 120);

            [$extension, $type, $picture] = self::whatItIs($file->getRealPath(), $name);

            // The name it is stored under says nothing about who sent it or
            // what it was called. Guessing one is guessing thirty-two hex
            // characters.
            $token = bin2hex(random_bytes(16)) . '.' . $extension;
            $bytes = (string) file_get_contents($file->getRealPath());

            $kept = [
                // Kept only to show under the file and to name a download.
                // Never used to decide anything.
                'name' => $name,
                'type' => $type,
                'size' => (int) $file->getSize(),
                // Whether the conversation draws it or offers it.
                'picture' => $picture,
            ];

            /*
             * Somewhere else, where somewhere else is set up and answering.
             *
             * Its address is written into the record rather than a token,
             * because the file is then not this panel's to serve - which is the
             * point of putting it there. Anything that goes wrong falls through
             * to the panel's own disk below.
             */
            $away = Uploads::put(self::FOLDER, $token, $bytes, $type);

            if ($away !== null) {
                return $kept + ['url' => $away];
            }

            Storage::disk('local')->put(self::FOLDER . '/' . $token, $bytes);

            return $kept + ['token' => $token];
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    /**
     * What a file is, read from the bytes and not from its name.
     *
     * getimagesize() fails on anything that is not an image, which is the check
     * as much as the answer: a file that will not open as a picture does not
     * become one by being called .png.
     *
     * **And the reverse is enforced too.** Anything that is not a picture has
     * a picture's ending taken off it here, on the way in, so that the route
     * serving these can decide inline-or-attachment from the ending alone and
     * be right every time. A rule that has to be applied in two places is a
     * rule that will one day be applied in one.
     *
     * @return array{0: string, 1: string, 2: bool}
     */
    private static function whatItIs(string $path, string $name): array
    {
        $found = @getimagesize($path);
        $kind = is_array($found) ? (int) ($found[2] ?? 0) : 0;

        if (array_key_exists($kind, self::KINDS)) {
            [$extension, $type] = self::KINDS[$kind];

            return [$extension, $type, true];
        }

        $extension = mb_strtolower((string) pathinfo($name, PATHINFO_EXTENSION));

        if (preg_match('~^[a-z0-9]{1,8}$~', $extension) !== 1 || self::picturesEnd($extension)) {
            $extension = 'bin';
        }

        return [$extension, self::PLAIN, false];
    }

    /** Whether an ending is one this panel would serve as a picture. */
    private static function picturesEnd(string $extension): bool
    {
        // .jpeg as well as .jpg. The table cannot carry it - its value is the
        // ending this panel writes, and that is .jpg - but a browser will read
        // either, so neither may be handed to a file that is not a picture.
        if ($extension === 'jpeg') {
            return true;
        }

        foreach (self::KINDS as [$ours]) {
            if ($ours === $extension) {
                return true;
            }
        }

        return false;
    }

    /**
     * Where a kept file can be fetched.
     *
     * Absolute, because the one asking for it is Discord's server rather than
     * a browser that already knows where this panel is.
     */
    public static function url(mixed $file): ?string
    {
        /*
         * A picture that is already somewhere else stays there.
         *
         * Anything attached in Discord is on their own network and arrives as
         * an address; copying it here would be keeping a second copy of
         * somebody else's file for no reason anybody could name. Ours are the
         * ones with a token, because ours are the ones this panel is holding.
         */
        $theirs = is_array($file) ? trim((string) ($file['url'] ?? '')) : '';

        if ($theirs !== '') {
            return str_starts_with($theirs, 'https://') ? $theirs : null;
        }

        $token = self::token($file);

        if ($token === null) {
            return null;
        }

        try {
            return url('/essentials/tickets/file/' . $token);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The bytes, the type and whether it may be drawn, for the route.
     *
     * **The ending decides, and it is safe to let it**, because keep() takes a
     * picture's ending away from anything that is not one. So a token ending in
     * .png is a file that opened as a png when it arrived, and everything else
     * goes back as bytes to be saved rather than as something to render.
     *
     * @return array{body: string, type: string, inline: bool, name: string}|null
     */
    public static function read(string $token): ?array
    {
        /*
         * The name is checked against the shape this class writes rather than
         * cleaned up. Anything else is not one of ours, and a path that has to
         * be made safe is a path that was allowed to be unsafe.
         */
        if (preg_match('~^[0-9a-f]{32}\.[a-z0-9]{1,8}$~', $token) !== 1) {
            return null;
        }

        try {
            $disk = Storage::disk('local');
            $at = self::FOLDER . '/' . $token;

            if (!$disk->exists($at)) {
                return null;
            }

            $extension = (string) pathinfo($token, PATHINFO_EXTENSION);

            foreach (self::KINDS as [$ours, $type]) {
                if ($ours === $extension) {
                    return [
                        'body' => (string) $disk->get($at),
                        'type' => $type,
                        'inline' => true,
                        'name' => self::named($token),
                    ];
                }
            }

            return [
                'body' => (string) $disk->get($at),
                'type' => self::PLAIN,
                'inline' => false,
                'name' => self::named($token),
            ];
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    /**
     * What it was called when it was sent, for the browser to save it as.
     *
     * Looked up rather than carried in the address, because a name in the
     * address is a name the person downloading chose - and a download named by
     * whoever asked for it is a download that can be named anything.
     *
     * The token is the fallback and it is a perfectly good file name; this is
     * the difference between saving `logs.txt` and saving thirty-two hex
     * characters, which is worth one query.
     */
    private static function named(string $token): string
    {
        try {
            $row = TicketMessage::query()->where('file->token', $token)->first();
            $name = is_array($row?->file) ? trim((string) ($row->file['name'] ?? '')) : '';
        } catch (Throwable) {
            return $token;
        }

        /*
         * Only what a header can carry, and nothing that could end it. A quote
         * or a newline in here is a second header of somebody else's choosing.
         */
        $safe = trim((string) preg_replace('~[^A-Za-z0-9 ._-]+~', '_', $name), '._ ');

        return $safe === '' ? $token : mb_substr($safe, 0, 120);
    }

    /**
     * A file somebody attached at the far end, as something this panel can
     * show.
     *
     * **Their field names, not the ones a reader would guess.** Modora answers
     * `{url, name, size, contentType, storage}` while Discord's own shape is
     * `{url, proxy_url, filename, content_type, size}`. The first version of
     * this read only Discord's, so every picture posted in a channel was
     * skipped and never appeared here - it looked exactly like a feature that
     * had not been built.
     *
     * Anything they send, not only pictures: a crash log dropped into the
     * channel is the same kind of evidence a screenshot is. Whether it is drawn
     * or offered is decided here, from the declared type where there is one and
     * from the name where there is not, because an attachment with no declared
     * type is still a picture if it ends in .png.
     *
     * Nothing here is trusted further than deciding whether to put it in an img
     * tag, and the address must be https either way. The file itself is never
     * fetched or copied - it stays on their network, which is where they put
     * it.
     *
     * The first one only. One file is what a report carries, and a gallery in a
     * support thread is a thing to build when somebody sends one.
     *
     * @return array{url: string, name: string, size: int, picture: bool}|null
     */
    public static function theirs(mixed $attachments): ?array
    {
        if (!is_array($attachments)) {
            return null;
        }

        foreach ($attachments as $one) {
            if (!is_array($one)) {
                continue;
            }

            $url = trim((string) ($one['url'] ?? $one['proxy_url'] ?? ''));
            $name = trim((string) ($one['name'] ?? $one['filename'] ?? ''));

            if (!str_starts_with($url, 'https://')) {
                continue;
            }

            $type = mb_strtolower(trim((string) ($one['contentType'] ?? $one['content_type'] ?? '')));

            return [
                'url' => mb_substr($url, 0, 900),
                'name' => mb_substr($name, 0, 120),
                'size' => (int) ($one['size'] ?? 0),
                'picture' => $type === ''
                    ? self::looksLikeOne($name, $url)
                    : str_starts_with($type, 'image/'),
            ];
        }

        return null;
    }

    /**
     * Whether a name ends in something this panel would draw as a picture.
     *
     * The same four kinds it accepts on the way in, so nothing is drawn here
     * that could not have been uploaded here. The address is used as a second
     * chance because a CDN often names the file in the path when the record
     * does not name it at all.
     */
    private static function looksLikeOne(string $name, string $url): bool
    {
        $where = mb_strtolower($name !== '' ? $name : (string) parse_url($url, PHP_URL_PATH));
        $ending = (string) pathinfo($where, PATHINFO_EXTENSION);

        return self::picturesEnd($ending);
    }

    /** Whether what is kept on a message is drawn rather than offered. */
    public static function drawable(mixed $file): bool
    {
        if (!is_array($file)) {
            return false;
        }

        /*
         * Missing means yes, and that is not a guess: before this release the
         * only thing that could be attached was a picture, so every row written
         * by an older one is one.
         */
        return (bool) ($file['picture'] ?? true);
    }

    /** What it was called, for the line under it. */
    public static function name(mixed $file): string
    {
        return is_array($file) ? mb_substr(trim((string) ($file['name'] ?? '')), 0, 120) : '';
    }

    /** How big it was, in words. */
    public static function size(mixed $file): string
    {
        $bytes = is_array($file) ? (int) ($file['size'] ?? 0) : 0;

        return $bytes >= 1048576
            ? round($bytes / 1048576, 1) . ' MB'
            : max(1, (int) round($bytes / 1024)) . ' KB';
    }

    /** The stored name, or null when there is no picture on this. */
    private static function token(mixed $file): ?string
    {
        $token = is_array($file) ? trim((string) ($file['token'] ?? '')) : '';

        return $token === '' ? null : $token;
    }
}
