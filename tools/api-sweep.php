<?php

/*
 * Every endpoint called, and its fields compared to what the panel publishes.
 *
 * This is the check roadmap/api-one.md prescribes and could not automate: the
 * build gates reason about the source from the outside, and `check-api-docs.js`
 * compares paths, methods and ability names but never a single field of a
 * response - which is how three endpoints came to publish a body that was not
 * the body the documentation, the Markdown download and the OpenAPI file all
 * described, with every gate green.
 *
 * A field comparison needs a running panel and a real key, so it cannot be a
 * build gate and is not one. It is a thing somebody runs before calling a
 * release 1.0.0, and it takes about ten seconds.
 *
 *     sudo -u www-data php tools/api-sweep.php <key> [server-uuid] [discord-id] [ticket-id]
 *
 * The key needs every ability and a panel-wide scope, or the endpoints it was
 * not granted answer 403 and the comparison says so rather than lying.
 *
 * Seven of the nineteen readable endpoints carry an id in their path. Give a
 * running server, a connected Discord id and a ticket and they are swept too;
 * leave them out and they are printed as skipped, because a sweep that silently
 * covers twelve of nineteen reads as a sweep that covered everything. All of
 * them have to be real: an unconnected id answers `connected: false` and a shape half the size,
 * and the comparison then reports the missing half as a fault.
 *
 * **A list that is empty on this panel proves nothing about its rows.** The
 * published example for /schedules shows a stopped schedule with five fields;
 * a healthy panel has no stopped schedules, so the sweep reports those five as
 * documented and not on the wire. That is the panel being well, not the
 * documentation being wrong, and it is the one kind of result here that has to
 * be read rather than counted.
 *
 * It shows up as **documented, not on the wire** and nothing beside it, on an
 * endpoint whose top-level fields agree - a server nobody is playing on, an
 * owner who buys nothing, a panel with no stopped schedules. The way to settle
 * it is to look at the body rather than at the tally: if the list is there and
 * empty, the endpoint is right. Fields reported the other way round, **on the
 * wire and undocumented**, are never this: something is being published that
 * nobody wrote down.
 */

require '/var/www/pelican/vendor/autoload.php';

$app = require_once '/var/www/pelican/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Http\ApiController;
use LegendDevelopment\Theme\Support\Api\Docs;

$secret = trim((string) ($argv[1] ?? ''));

if ($secret === '') {
    exit("usage: php tools/api-sweep.php <key> [server-uuid] [discord-id] [ticket-id]\n");
}

$stand = array_filter([
    '{server}' => trim((string) ($argv[2] ?? '')),
    '{discord}' => trim((string) ($argv[3] ?? '')),
    '{ticket}' => trim((string) ($argv[4] ?? '')),
]);

$base = '/api/essentials/' . ApiController::CONTRACT;

/**
 * The keys an answer has, one level into a list or an object.
 *
 * Two levels rather than all of them, because the point is to catch a field
 * that appeared or vanished, and a deep walk turns one missing key into a
 * column of noise.
 *
 * @param  array<string, mixed>  $row
 * @return array<int, string>
 */
$shape = static function (array $row, string $prefix = '') use (&$shape): array {
    $out = [];

    foreach ($row as $key => $value) {
        if (is_int($key)) {
            continue;
        }

        $out[] = $prefix . $key;

        if ($prefix !== '' || !is_array($value) || $value === []) {
            continue;
        }

        $first = array_is_list($value) ? ($value[0] ?? null) : $value;

        if (is_array($first)) {
            foreach ($shape($first, $key . '.') as $deeper) {
                $out[] = $deeper;
            }
        }
    }

    sort($out);

    return $out;
};

/**
 * Fields the example shows a moment for and the answer sends null for.
 *
 * Comparing names alone let a real fault through: moment() tested is_scalar and
 * nothing else, so every timestamp arriving as a Carbon rather than as a string
 * went out as null - and null is a name being present, so the comparison above
 * said the fields agreed. They did. The values did not.
 *
 * Only where the example is a moment, and only where the answer is exactly
 * null. A null timestamp is often the truth - a ticket that is not closed has
 * no closed_at - so this is read rather than counted, like the empty lists. It
 * is here because reading four lines is cheaper than the afternoon that finding
 * this one by hand cost.
 *
 * @param  array<string, mixed>  $body
 * @param  array<string, mixed>  $want
 * @return array<int, string>
 */
$hollow = static function (array $body, array $want) use (&$hollow): array {
    $out = [];

    foreach ($want as $name => $value) {
        if (is_int($name)) {
            continue;
        }

        if (is_array($value) && is_array($body[$name] ?? null)) {
            $inner = array_is_list($value) ? ($value[0] ?? []) : $value;
            $said = array_is_list($body[$name]) ? ($body[$name][0] ?? []) : $body[$name];

            if (is_array($inner) && is_array($said)) {
                foreach ($hollow($said, $inner) as $deeper) {
                    $out[] = $name . '.' . $deeper;
                }
            }

            continue;
        }

        $moment = is_string($value) && preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}T/', $value) === 1;

        if ($moment && array_key_exists($name, $body) && $body[$name] === null) {
            $out[] = $name;
        }
    }

    sort($out);

    return $out;
};

$differences = 0;
$skipped = 0;

foreach (Docs::endpoints() as $endpoint) {
    if ($endpoint['method'] !== 'GET') {
        continue;
    }

    $path = strtr((string) $endpoint['path'], $stand);

    if (str_contains($path, '{')) {
        printf("  %-30s      skipped, no id was given for it\n", $endpoint['path']);
        $skipped++;

        continue;
    }

    $request = Request::create($base . $path, 'GET');
    $request->headers->set('Authorization', 'Bearer ' . $secret);

    $response = $app->make(Kernel::class)->handle($request);
    $body = json_decode((string) $response->getContent(), true);

    if (!is_array($body)) {
        printf("  %-30s %d  no json\n", $endpoint['path'], $response->getStatusCode());
        $differences++;

        continue;
    }

    $got = $shape($body);
    $want = $shape(is_array($endpoint['answers'] ?? null) ? $endpoint['answers'] : []);

    $extra = array_diff($got, $want);
    $missing = array_diff($want, $got);
    $empty = $hollow($body, is_array($endpoint['answers'] ?? null) ? $endpoint['answers'] : []);

    printf("  %-30s %d  %s\n", $endpoint['path'], $response->getStatusCode(),
        $extra === [] && $missing === [] ? 'fields agree' : '');

    if ($extra !== []) {
        printf("      on the wire, undocumented: %s\n", implode(', ', $extra));
        $differences++;
    }

    if ($missing !== []) {
        printf("      documented, not on the wire: %s\n", implode(', ', $missing));
        $differences++;
    }

    if ($empty !== []) {
        printf("      a moment in the example, null on the wire: %s\n", implode(', ', $empty));
        $differences++;
    }
}

printf("\n  %d difference(s), %d endpoint(s) skipped\n", $differences, $skipped);

exit($differences > 0 ? 1 : 0);
