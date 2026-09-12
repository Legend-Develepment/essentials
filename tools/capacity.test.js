/*
 * Support\Capacity, and the one thing it must not get wrong.
 *
 * The page answers whether another server fits, and Pelican already has the
 * only authoritative answer to that: Node::isViable(), the method that decides
 * whether a server may be created. If this page and that method disagree, this
 * page is wrong - somebody reads "room for more", tries, and is refused.
 *
 * So the arithmetic here is copied from it rather than derived:
 *
 *     limit = capacity * (1 + overallocate / 100)
 *     used  = the sum of what every server on the node was promised
 *
 * Including the two conventions that are easy to miss and would each make the
 * page confidently wrong: a capacity of zero means unlimited, and an
 * overallocation below zero means unlimited too. isViable() skips its check in
 * both cases, so neither is a percentage of anything.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const TIGHT = 90;
const WARM = 75;

function percent(capacity, overallocate, used) {
    capacity = parseInt(capacity, 10) || 0;
    overallocate = Number(overallocate) || 0;

    if (capacity <= 0 || overallocate < 0) { return null; }

    const limit = capacity * (1 + overallocate / 100);

    if (limit <= 0) { return null; }

    return Math.round(Math.max(0, parseInt(used, 10) || 0) / limit * 100);
}

function limit(capacity, overallocate) {
    capacity = parseInt(capacity, 10) || 0;
    overallocate = Number(overallocate) || 0;

    if (capacity <= 0 || overallocate < 0) { return null; }

    return Math.round(capacity * (1 + overallocate / 100));
}

function worst(node) {
    const each = [
        percent(node.memory, node.memory_overallocate, node.ld_memory || 0),
        percent(node.disk, node.disk_overallocate, node.ld_disk || 0),
        percent(node.cpu, node.cpu_overallocate, node.ld_cpu || 0),
    ].filter((v) => v !== null);

    return each.length === 0 ? null : Math.max(...each);
}

const colour = (p) => {
    if (p === null) { return 'gray'; }
    if (p >= TIGHT) { return 'danger'; }
    if (p >= WARM) { return 'warning'; }

    return 'success';
};

function size(mib) {
    if (mib === null) { return '-'; }
    if (mib < 1024) { return mib + ' MiB'; }

    const gib = mib / 1024;

    return (gib < 10 ? Math.round(gib * 10) / 10 : Math.round(gib)) + ' GiB';
}

// Pelican's own rule, as the plugin reads it: only a limit above zero that has
// been reached is a server whose next request fails.
function full(server) {
    const pairs = [
        [server.backup_limit || 0, server.backups_count || 0],
        [server.database_limit || 0, server.databases_count || 0],
        [server.allocation_limit || 0, server.allocations_count || 0],
    ];

    return pairs.some(([lim, count]) => lim > 0 && count >= lim);
}

/*
 * isViable() itself, ported, so the two can be compared directly rather than
 * by eye. This is the thing the page must agree with.
 */
function viable(node, wanted) {
    for (const key of ['memory', 'disk', 'cpu']) {
        const capacity = node[key];
        const over = node[key + '_overallocate'];

        if (capacity > 0 && over >= 0) {
            const used = node['ld_' + key] || 0;

            if (used + (wanted[key] || 0) > capacity * (1 + over / 100)) { return false; }
        }
    }

    return true;
}

console.log('capacity\n');

/* ------------------------------------------------------- the two unlimiteds */

/*
 * Both of these would be a full bar or an empty one if they were treated as
 * numbers, and both would be a lie. isViable() skips its check entirely, which
 * means there is no answer rather than a comfortable one.
 */
check('no capacity is unlimited, not empty', percent(0, 0, 4096), null);
check('and not full either', limit(0, 0), null);
check('a negative overallocation is unlimited', percent(8192, -1, 4096), null);
check('and so is its limit', limit(8192, -1), null);

check('a node with nothing set has no verdict',
    worst({ memory: 0, memory_overallocate: 0, disk: 0, disk_overallocate: 0, cpu: 0, cpu_overallocate: 0 }),
    null);
check('and is drawn grey rather than green', colour(null), 'gray');

/* ------------------------------------------------------------ the figures -- */

check('half of it', percent(8192, 0, 4096), 50);
check('all of it', percent(8192, 0, 8192), 100);
check('none of it', percent(8192, 0, 0), 0);
check('past it, which overallocation allows', percent(8192, 0, 9216), 113);

// The overallocation is a percentage on top, so fifty percent of 8 GiB is 12.
check('fifty percent more to hand out', limit(8192, 50), 12288);
check('and the same sum in the percentage', percent(8192, 50, 6144), 50);
check('a hundred percent more', limit(8192, 100), 16384);
check('zero more is just the capacity', limit(8192, 0), 8192);

/* --------------------------------------------------- against Pelican's own -- */

/*
 * The comparison that matters. For a node at exactly its limit, isViable()
 * refuses anything at all - and the page has to be showing a hundred percent
 * rather than something that reads as room.
 */
{
    const node = {
        memory: 8192, memory_overallocate: 0, ld_memory: 8192,
        disk: 100000, disk_overallocate: 0, ld_disk: 50000,
        cpu: 400, cpu_overallocate: 0, ld_cpu: 100,
    };

    check('a node with no memory left refuses a server', viable(node, { memory: 1, disk: 1, cpu: 1 }), false);
    check('and the page says a hundred percent', percent(node.memory, node.memory_overallocate, node.ld_memory), 100);
    check('and colours it red', colour(percent(node.memory, node.memory_overallocate, node.ld_memory)), 'danger');

    // The whole reason the fullest of the three is what colours the row.
    check('the fullest is the memory, not the disk', worst(node), 100);
    check('even though the disk is half empty',
        percent(node.disk, node.disk_overallocate, node.ld_disk), 50);
}

{
    // And the reverse: room in memory, none on disk. A node is full when any
    // one of the three is, which is what isViable() says and what worst() has
    // to agree with.
    const node = {
        memory: 8192, memory_overallocate: 0, ld_memory: 1024,
        disk: 100000, disk_overallocate: 0, ld_disk: 100000,
        cpu: 0, cpu_overallocate: 0, ld_cpu: 0,
    };

    check('no disk left refuses too', viable(node, { memory: 1, disk: 1, cpu: 1 }), false);
    check('and the row is drawn by the disk', worst(node), 100);
}

{
    // An unlimited resource must not drag the verdict down to nothing.
    const node = {
        memory: 8192, memory_overallocate: 0, ld_memory: 8192,
        disk: 0, disk_overallocate: 0, ld_disk: 999999,
        cpu: 0, cpu_overallocate: 0, ld_cpu: 0,
    };

    check('an unlimited disk is skipped rather than counted as empty', worst(node), 100);
    check('and the node still takes a server on disk alone',
        viable(node, { memory: 0, disk: 100000, cpu: 0 }), true);
}

/* ------------------------------------------------------------ the colours -- */

check('under three quarters is fine', colour(74), 'success');
check('three quarters is worth noticing', colour(WARM), 'warning');
check('ninety is worth acting on', colour(TIGHT), 'danger');
check('and past a hundred certainly is', colour(150), 'danger');

/* -------------------------------------------------------------- the sizes -- */

check('under a gibibyte stays in mebibytes', size(512), '512 MiB');
check('exactly one', size(1024), '1 GiB');
check('one and a half', size(1536), '1.5 GiB');
check('past ten it loses the decimal', size(16384), '16 GiB');
check('nothing at all', size(null), '-');
check('none', size(0), '0 MiB');

/* -------------------------------------------------- servers at their limit -- */

check('a server with room', full({ backup_limit: 5, backups_count: 2 }), false);
check('one that has run out of backups', full({ backup_limit: 5, backups_count: 5 }), true);
check('and one over, which happens when a limit is lowered',
    full({ backup_limit: 2, backups_count: 5 }), true);

/*
 * A limit of zero is Pelican's "none allowed", and a server allowed none has
 * not run out - it was never going to be able to make one. Counting it would
 * report every server with backups switched off as a problem.
 */
check('none allowed is not the same as run out', full({ backup_limit: 0, backups_count: 0 }), false);

check('databases count too', full({ database_limit: 2, databases_count: 2 }), true);
check('and allocations', full({ allocation_limit: 1, allocations_count: 1 }), true);
check('any one of them is enough',
    full({ backup_limit: 9, backups_count: 1, database_limit: 1, databases_count: 1 }), true);
check('a server with nothing set at all', full({}), false);

console.log(NEWLINE + 'capacity: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
