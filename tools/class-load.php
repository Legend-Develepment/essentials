<?php

/*
 * Every class this plugin ships, actually loaded.
 *
 * `php -l` answers whether a file parses. It does not answer whether the class
 * in it can be built, and those are different questions with the same-looking
 * failure: a class is composed against its parents and its interfaces, and
 * anything wrong there is a fatal at the moment it is first used rather than a
 * syntax error at any point before that.
 *
 * **This exists because one of them took the panel down.** A page declared
 * `abstract protected function pull()`, and Livewire's Component has a pull() of
 * its own. PHP refuses to make an inherited non-abstract method abstract, so
 * every page in the panel answered 500 from the moment the file was loaded. It
 * passed php -l on the way out, because the file parses perfectly. It passed
 * every gate in tools/, because they all reason about the source from the
 * outside and none of them has ever seen Livewire.
 *
 * The same shape catches a handful of others that are only found at runtime: a
 * class in the wrong namespace for its path, an interface method that is not
 * implemented, an enum case that does not exist, a trait whose method collides
 * with one on the class.
 *
 *     sudo -u www-data php tools/class-load.php
 *
 * **It cannot be a build gate**, for the reason api-sweep.php cannot: it needs
 * a panel with Pelican and its vendor directory, and the machine this is built
 * on has neither - it does not even have php. It is a thing somebody runs
 * before pushing something that changes how a class is shaped.
 *
 * **It reports one fault and stops**, and that is the design rather than a
 * shortcut. A composition error is a fatal: nothing catches it, the process
 * ends there, and the only way to name it is to have said which file was about
 * to be loaded before loading it. So the last line printed is the answer. Fix
 * it and run it again.
 */

$root = '/var/www/pelican';

require $root . '/vendor/autoload.php';

$app = require_once $root . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

/*
 * Beside this file by default, or wherever it is told.
 *
 * The default is right when this is run from the plugin it belongs to, which is
 * how it is meant to be used. The argument is for the case that found this
 * need: the plugin on a panel is a copy, and a copy of this script somewhere
 * else has to be able to point at it.
 */
$here = rtrim((string) ($argv[1] ?? dirname(__DIR__)), '/') . '/src';

if (!is_dir($here)) {
    exit("no src directory beside this file\n");
}

/**
 * Every PHP file under src, deepest last.
 *
 * Sorted so a run is repeatable: a fault found by this is a fault somebody has
 * to reproduce, and a directory walk that answers in a different order each
 * time is one more thing to doubt.
 *
 * @return array<int, string>
 */
function found(string $dir): array
{
    $out = [];

    /** @var SplFileInfo $entry */
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $entry) {
        if ($entry->isFile() && $entry->getExtension() === 'php') {
            $out[] = $entry->getPathname();
        }
    }

    sort($out);

    return $out;
}

$files = found($here);

printf("%d class file(s) under src\n\n", count($files));

$loaded = 0;

foreach ($files as $file) {
    $short = str_replace('\\', '/', substr($file, strlen($here) + 1));

    /*
     * Said before it happens, and flushed.
     *
     * The fatal this is looking for ends the process without unwinding, so
     * anything held in a buffer is lost with it. The line naming the file has
     * to be on its way out before the file is touched.
     */
    printf("  %s ... ", $short);

    if (function_exists('ob_flush')) {
        @ob_flush();
    }

    flush();

    require_once $file;

    print "ok\n";

    $loaded++;
}

printf("\n  %d file(s) loaded, none of them refused.\n", $loaded);
