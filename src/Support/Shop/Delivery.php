<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Theme;
use RuntimeException;
use Throwable;

/**
 * Putting the customer's own file into the server that was just built.
 *
 * A package may ask for a zip - a world, a modpack, a set of configs - and it
 * is worth nothing sitting in the panel's storage. This is the step that moves
 * it, and it runs once, after the server exists and before the customer is told
 * it is ready.
 *
 * **The daemon fetches it, the panel does not push it.** Pelican's file
 * repository can take content directly, and for a two hundred megabyte world
 * that means reading the whole thing into PHP memory and posting it over a
 * second connection. pull() hands the daemon an address instead and it
 * downloads the file itself, which is what that endpoint is for.
 *
 * **The address is signed and short-lived.** It is a plain route with no
 * session - a daemon has no cookies - so what stands in for authentication is
 * Laravel's own signature: unforgeable without the app key, and expired within
 * the hour. Nothing else can read somebody's upload, and it cannot be read
 * again tomorrow.
 *
 * **Once.** delivered_at is written before the file is removed, so a retry that
 * arrives after a half-finished attempt does not put a second copy in. The file
 * is only deleted from the panel when the daemon has confirmed it has it.
 */
class Delivery
{
    /** How long the daemon has to collect the file. */
    public const MINUTES = 60;

    /** What it is called while it is in the server, before it is unpacked. */
    public const NAME = 'essentials-upload.zip';

    /** The disk uploads are kept on: private, never served by the web server. */
    public const DISK = 'local';

    /** Where on that disk, so one folder holds all of them. */
    public const FOLDER = 'essentials/uploads';

    /**
     * Move this order's file into its server.
     *
     * Answers false when there is nothing to do, which is most orders, and
     * throws when there was something to do and it did not work - the caller
     * turns that into a line in the log and a word to the administrator.
     */
    public static function run(Order $order): bool
    {
        $path = trim((string) $order->upload_path);

        if ($path === '' || $order->delivered_at !== null) {
            return false;
        }

        $server = $order->server;

        if (!$server instanceof Server) {
            throw new RuntimeException('Order ' . (int) $order->id . ' has a file but no server to put it in.');
        }

        if (!Storage::disk(self::DISK)->exists($path)) {
            throw new RuntimeException('The file for order ' . (int) $order->id . ' is no longer in storage.');
        }

        $package = $order->package;
        $directory = self::directory($package?->upload_dir);
        $extract = $package === null || (bool) $package->upload_extract;

        $files = app(DaemonFileRepository::class)->setServer($server);

        // Foreground, so the next call knows the file is actually there. A
        // decompress that starts before the download finishes finds nothing.
        $pulled = $files->pull(self::address($order), $directory, [
            'filename' => self::NAME,
            'foreground' => true,
        ]);

        if (!$pulled->successful()) {
            throw new RuntimeException('The daemon would not collect the file: HTTP ' . $pulled->status() . '.');
        }

        if ($extract) {
            $opened = $files->decompressFile($directory, self::NAME);

            if (!$opened->successful()) {
                throw new RuntimeException('The daemon would not unpack the file: HTTP ' . $opened->status() . '.');
            }

            // The archive itself is not part of what was bought. Left behind it
            // is a confusing file in the root of somebody's new server.
            $files->deleteFiles($directory, [self::NAME]);
        }

        // Written before the copy is dropped: a crash between the two leaves a
        // file nobody needs, which is tidier than a second copy in the server.
        $order->forceFill(['delivered_at' => now()])->save();

        self::forget($order);

        return true;
    }

    /**
     * A one-hour signed address the daemon can fetch, and nobody else can.
     *
     * The order's id rather than the path: a path in a URL is a path somebody
     * will try to walk out of, and the row already knows where its own file is.
     */
    public static function address(Order $order): string
    {
        return URL::temporarySignedRoute(
            'legend-theme.upload',
            now()->addMinutes(self::MINUTES),
            ['order' => (int) $order->id],
        );
    }

    /** Take the panel's copy away once the server has it. */
    public static function forget(Order $order): void
    {
        $path = trim((string) $order->upload_path);

        if ($path === '') {
            return;
        }

        try {
            Storage::disk(self::DISK)->delete($path);
        } catch (Throwable) {
            // A file left in storage costs a few megabytes and nothing else.
        }

        try {
            $order->forceFill(['upload_path' => null])->save();
        } catch (Throwable) {
            // The row still points at a file that is gone, which every reader
            // here copes with by checking that it exists first.
        }
    }

    /**
     * Where in the server the file goes, made safe.
     *
     * An administrator types this on the package form, so it is theirs rather
     * than a customer's - but a path that walks upwards would still be a path
     * out of the server's own directory, and the daemon is entitled to trust
     * what the panel sends it.
     */
    public static function directory(mixed $given): string
    {
        $path = trim((string) $given);

        if ($path === '' || str_contains($path, '..')) {
            return '/';
        }

        $path = '/' . trim(str_replace('\\', '/', $path), '/');

        return $path === '/' ? '/' : $path;
    }

    /** What to call the stored copy, so two orders never collide. */
    public static function filename(Order $order): string
    {
        return self::FOLDER . '/order-' . (int) $order->id . '-' . Theme::id() . '.zip';
    }
}
