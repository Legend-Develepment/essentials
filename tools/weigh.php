<?php

/*
 * What one page of the panel costs, measured rather than guessed.
 *
 * This produced the table in roadmap/weight.md and then was not kept, so the
 * instruction there - "per part, on the real panel, with the same script that
 * produced the table above" - pointed at something nobody had. A measurement
 * nobody can repeat is an anecdote with a number in it.
 *
 *     cd /var/www/pelican
 *     sudo -u www-data php plugins/essentials/tools/weigh.php /admin
 *
 * **One request per process, and that is the whole method.** A first attempt
 * ran nine requests through one kernel and three of them answered 500 from
 * state the one before had left behind, which measures the harness. So this
 * takes one path, makes one request, prints one row, and exits. Several pages
 * means several runs, which is what the loop at the bottom of the usage note
 * is for.
 *
 * **Nothing is written.** The request runs inside a transaction that is rolled
 * back whatever happens, so a page that saves something on a GET - a stamp, a
 * cached read written down, a last-seen - leaves the panel as it found it.
 *
 * Run as www-data. As root it leaves root-owned files in the cache directory
 * and the next request from the panel cannot read them.
 */

/*
 * The panel this is measuring: three directories up when the file sits in
 * plugins/<id>/tools/, and otherwise wherever it was run from. The second case
 * is the usual one - the file is copied to /tmp and run from /var/www/pelican,
 * because nothing should ever be written into plugins/ by hand.
 */
$root = is_file(dirname(__DIR__, 3) . '/vendor/autoload.php') ? dirname(__DIR__, 3) : getcwd();

if (!is_file($root . '/vendor/autoload.php')) {
    fwrite(STDERR, "Run this from inside the panel: expected {$root}/vendor/autoload.php\n");

    exit(1);
}

require $root . '/vendor/autoload.php';

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$path = $argv[1] ?? '/admin';
$as = isset($argv[2]) ? (int) $argv[2] : 1;

$app = require_once $root . '/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

/*
 * Signed in before the request rather than during it.
 *
 * Every page worth measuring is behind auth, and a redirect to the sign-in
 * screen is a fast page that tells you nothing. The user is set on the guard
 * the request will use, so the panel sees somebody rather than a session.
 */
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::query()->find($as) ?? App\Models\User::query()->first();

if ($user === null) {
    fwrite(STDERR, "No user to sign in as.\n");

    exit(1);
}

auth()->setUser($user);

DB::beginTransaction();
DB::enableQueryLog();

$before = microtime(true);
$memoryBefore = memory_get_usage(true);

try {
    $request = Request::create($path, 'GET');

    // The same session the guard was given, so Filament does not send this
    // back to the sign-in screen before it has drawn anything.
    $request->setUserResolver(static fn () => $user);

    $response = $kernel->handle($request);
    $body = (string) $response->getContent();
    $status = $response->getStatusCode();
} catch (Throwable $exception) {
    DB::rollBack();

    fwrite(STDERR, 'Threw: ' . $exception->getMessage() . "\n");

    exit(1);
}

$took = (microtime(true) - $before) * 1000;
$memory = memory_get_usage(true) - $memoryBefore;

$log = DB::getQueryLog();

DB::rollBack();

/*
 * Which of the queries are this plugin's own.
 *
 * Told apart by the table they touch: every table this plugin makes is named
 * for it, and nothing else on a Pelican panel is. Counting them matters
 * because the number that gets quoted at this plugin is the total, and the
 * total is mostly Pelican building its own panel.
 */
$ours = 0;
$sql = 0.0;

foreach ($log as $query) {
    $sql += (float) ($query['time'] ?? 0);

    if (stripos((string) ($query['query'] ?? ''), 'essentials_') !== false) {
        $ours += 1;
    }
}

printf("%s\n", $path);
printf("  status   %d\n", $status);
printf("  time     %.0f ms\n", $took);
printf("  queries  %d, of which ours %d\n", count($log), $ours);
printf("  in SQL   %.0f ms\n", $sql);
printf("  HTML     %.0f KB\n", strlen($body) / 1024);
printf("  memory   %.1f MB\n", $memory / 1048576);
