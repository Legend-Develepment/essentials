<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Support\Cdn\Uploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;

/**
 * What a file somebody uploaded becomes once it is stored.
 *
 * A settings form hands over a temporary file; a .env line can hold a path. In
 * between sits everything that can go differently: the picture may be larger
 * than anything will ever draw it, the panel may be told to keep its files on a
 * CDN or in a bucket rather than on this machine, and either of those may
 * refuse - at which point the honest answer is to keep it here and say so
 * rather than to store an address that answers with nothing.
 *
 * It lived at the bottom of Settings, which is where the form is, and that is
 * the wrong reason for it to be there: none of this is about settings. It is
 * about a file.
 *
 * Nothing here decides what a picture should be made smaller to; Pictures does
 * that, and it decides by what the panel actually draws. Nothing here decides
 * where files go either; Cdn\Uploads holds that. This is the part that puts
 * those two together and tells the person what happened to their file.
 */
class Uploaded
{
    /**
     * Filament normally hands over the path it saved the upload to, but the value
     * can also arrive as an array of files or as the temporary upload itself,
     * depending on where the form was submitted from - so all three are handled.
     *
     * $edge is how wide the picture is ever actually drawn, and one that arrives
     * far larger than that is stored smaller. Here rather than in four places
     * because this is where an upload is still bytes, and nought for a caller
     * that is not storing a picture at all.
     *
     * The limit is worth saying out loud: an upload Filament has already put on
     * disk arrives as a string and is stored exactly as it is. The uploads this
     * plugin's own settings pages make do reach here as bytes, which is why the
     * address of one that went to a CDN is written down rather than a path.
     */
    public static function stored(mixed $value, int $edge = 0): string
    {
        if (is_array($value)) {
            $value = Arr::first($value);
        }

        if ($value instanceof TemporaryUploadedFile) {
            $made = $edge > 0 ? Pictures::smaller(self::bytesOf($value), $edge) : null;

            /*
             * Wherever files are set to go, and the panel's own disk when that
             * is nowhere or when it refuses.
             *
             * What is written down is the answer rather than the intention: a
             * file that reached a CDN is stored as its address, one that did
             * not is stored as a path. Both come back through
             * Uploads::address(), which is what lets the setting change without
             * anything already uploaded moving or breaking.
             */
            $away = self::sentAway($value, $made);

            if ($away !== null) {
                self::shrankIt($value, $made);

                return $away;
            }

            $here = self::keptHere($value, $made);

            if ($here !== null) {
                self::shrankIt($value, $made);

                return $here;
            }

            $value = $value->store('theme', 'public');
        }

        if (!is_string($value)) {
            return '';
        }

        /*
         * What is left is a path or an address that somebody sent rather than a
         * file they uploaded - the value the field already held, usually, and a
         * typed one if anybody cares to send it.
         *
         * It ends up in a CSS url() and in an img src, and a quote or an angle
         * bracket is a way out of either. They go, which is the same rule the
         * logo field beside it has always had; it is only this way in that
         * never had it. Nothing else about the value is second-guessed: a
         * relative path and a CDN address are both legitimate here, and
         * demanding one shape would wipe the other on the next save.
         *
         * The leading slash goes because Uploads::address() puts one back.
         */
        return ltrim(preg_replace('/[\s"\'<>]/', '', $value) ?? '', '/');
    }

    /** The upload as bytes, or nothing at all rather than an exception. */
    private static function bytesOf(TemporaryUploadedFile $file): string
    {
        try {
            return (string) file_get_contents($file->getRealPath());
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * The panel's own disk, when a smaller copy was made.
     *
     * Its own write rather than Filament's store(), which keeps the name and
     * the extension the browser sent - and after an unwrap those are the SVG
     * the picture arrived in rather than the PNG that came out of it. A file
     * called .svg holding a PNG is refused outright by anything sending
     * X-Content-Type-Options.
     *
     * @param  array{bytes: string, extension: string, type: string}|null  $made
     */
    private static function keptHere(TemporaryUploadedFile $file, ?array $made): ?string
    {
        if ($made === null) {
            return null;
        }

        try {
            $path = 'theme/' . bin2hex(random_bytes(16)) . '.' . $made['extension'];

            return Storage::disk('public')->put($path, $made['bytes']) ? $path : null;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    /**
     * Say so, once, and only after it is actually stored.
     *
     * Before the write it would be a promise rather than a report, and the
     * write is the half that can fail. Nothing is said when nothing was done,
     * which is every save but the one where a picture arrived.
     *
     * @param  array{bytes: string, extension: string, type: string}|null  $made
     */
    private static function shrankIt(TemporaryUploadedFile $file, ?array $made): void
    {
        if ($made === null) {
            return;
        }

        Notification::make()
            ->title(Theme::trans('settings.shrunk'))
            ->body(Theme::trans('settings.shrunk_body', [
                'name' => mb_substr((string) $file->getClientOriginalName(), 0, 60),
                'was' => self::inKilobytes(strlen(self::bytesOf($file))),
                'now' => self::inKilobytes(strlen($made['bytes'])),
            ]))
            ->success()
            ->send();
    }

    /** A size somebody reads rather than counts. */
    private static function inKilobytes(int $bytes): string
    {
        return $bytes >= 1048576
            ? number_format($bytes / 1048576, 1) . ' MB'
            : (string) max(1, (int) round($bytes / 1024)) . ' KB';
    }

    /**
     * Hand an upload to wherever files are kept, and say where it landed.
     *
     * Null when there is nowhere else, which is every panel until somebody sets
     * one up - and then the caller does exactly what it has always done.
     *
     * The name it is kept under says nothing about what it was called. These
     * are a panel's own decorations rather than somebody's private file, but
     * they sit on an address anybody can fetch, and a guessable one is an
     * invitation to go looking for the rest.
     */
    private static function sentAway(TemporaryUploadedFile $file, ?array $made = null): ?string
    {
        try {
            /*
             * The extension and the type come from what is actually being sent
             * rather than from what arrived. They are the same file until a
             * picture has been unwrapped out of an SVG, and then they are not:
             * Uploads::put() writes a year of immutable cache onto the answer,
             * so a PNG labelled image/svg+xml is wrong for a year.
             */
            $extension = $made === null
                ? mb_strtolower((string) $file->getClientOriginalExtension())
                : $made['extension'];
            $extension = preg_match('~^[a-z0-9]{1,8}$~', $extension) === 1 ? $extension : 'bin';

            return Uploads::put(
                'theme',
                bin2hex(random_bytes(16)) . '.' . $extension,
                $made === null ? self::bytesOf($file) : $made['bytes'],
                $made === null
                    ? (string) ($file->getMimeType() ?: 'application/octet-stream')
                    : $made['type'],
            );
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }
}
