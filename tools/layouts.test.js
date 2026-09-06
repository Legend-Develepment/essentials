/*
 * Support\Layouts, ported.
 *
 * An arrangement is three layers now - the one everyone starts from, the
 * reader's role, and their own - and which one wins per key is the whole
 * feature. That is pure logic, it had none of these, and the two-layer version
 * of it was written by hand in one place and merged in another.
 *
 * The other half is the keys. A layout key becomes a CSS selector, and a key
 * that reached the stylesheet unchecked would be a way to write CSS into every
 * page of somebody's panel from a POST body. sanitiseKey() is what stops that,
 * so it is tested the way resources.test.js tests a path.
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

const pageKey = (path) => '/' + path.replace(/^\/+|\/+$/g, '').split('/').map((segment) => {
    if (/^\d+$/.test(segment)) { return '{id}'; }
    if (/^[0-9a-f]{8}-[0-9a-f]{4}-/i.test(segment)) { return '{id}'; }
    if (/^(?=.*\d)[A-Za-z0-9]{6,}$/.test(segment)) { return '{id}'; }

    return segment;
}).join('/');

const sanitiseKey = (key) => {
    key = key.trim();

    if (key.length > 140 || !/^(partial|key)\|[A-Za-z0-9_.\-]+$/.test(key)) { return null; }

    return key;
};

const roleOf = (scope) => {
    if (!scope.startsWith('role:')) { return null; }

    const id = scope.slice(5);

    return /^[1-9][0-9]{0,9}$/.test(id) ? parseInt(id, 10) : null;
};

/*
 * for(): shared, then each role the reader holds in ascending id order, then
 * their own. Object.assign is PHP's array_merge for string keys - later wins,
 * per key.
 */
const forPage = (shared, roleLayers, held, own) => {
    let layout = { ...shared };

    // The intersection, and its order: only roles that have arranged something,
    // lowest id first.
    const arranged = Object.keys(roleLayers).map(Number).sort((a, b) => a - b);

    for (const id of arranged) {
        if (!held.includes(id)) { continue; }

        layout = { ...layout, ...roleLayers[id] };
    }

    return { ...layout, ...own };
};

console.log('page layouts\n');

/* ------------------------------------------------------- which one wins -- */

const S = { a: { o: 1 }, b: { o: 2 }, c: { o: 3 } };

check('nothing anywhere', forPage({}, {}, [], {}), {});
check('only the shared one', forPage(S, {}, [], {}), S);

check('a role over the shared one',
    forPage(S, { 7: { b: { o: 9 } } }, [7], {}),
    { a: { o: 1 }, b: { o: 9 }, c: { o: 3 } });

check('their own over the role',
    forPage(S, { 7: { b: { o: 9 } } }, [7], { b: { o: 5 } }),
    { a: { o: 1 }, b: { o: 5 }, c: { o: 3 } });

check('their own over the shared one, with no role',
    forPage(S, {}, [], { a: { o: 4 } }),
    { a: { o: 4 }, b: { o: 2 }, c: { o: 3 } });

/*
 * Per key, which is the point of merging rather than replacing: somebody who
 * has moved one block still gets their role's arrangement of the rest.
 */
check('one block moved does not drop the role\'s others',
    forPage({}, { 7: { a: { o: 1 }, b: { o: 2 } } }, [7], { b: { o: 8 } }),
    { a: { o: 1 }, b: { o: 8 } });

check('a block added to the shared one later still arrives',
    forPage({ d: { o: 4 } }, { 7: { a: { o: 1 } } }, [7], { a: { o: 2 } }),
    { d: { o: 4 }, a: { o: 2 } });

// Hiding is a value like any other, so a role can hide what the shared
// arrangement shows - and a person can bring it back for themselves.
check('a role hides a block', forPage(S, { 7: { a: { h: true } } }, [7], {}).a, { h: true });
check('and they can unhide it', forPage(S, { 7: { a: { h: true } } }, [7], { a: { o: 1 } }).a, { o: 1 });

/* ------------------------------------------------------- more than one -- */

check('a role they do not hold does nothing',
    forPage(S, { 7: { b: { o: 9 } } }, [8], {}), S);

check('one of two roles held',
    forPage({}, { 7: { a: { o: 1 } }, 8: { b: { o: 2 } } }, [8], {}),
    { b: { o: 2 } });

check('both roles held, both applied',
    forPage({}, { 7: { a: { o: 1 } }, 8: { b: { o: 2 } } }, [7, 8], {}),
    { a: { o: 1 }, b: { o: 2 } });

/*
 * Two roles arranging the same block. Ascending id, so the one created later
 * wins - a rule rather than a preference, because Pelican's roles have no order
 * of their own. It is tested so the behaviour is a choice and not a surprise.
 */
check('the later role wins',
    forPage({}, { 7: { a: { o: 1 } }, 8: { a: { o: 2 } } }, [7, 8], {}),
    { a: { o: 2 } });

check('and the order they are held in does not change that',
    forPage({}, { 7: { a: { o: 1 } }, 8: { a: { o: 2 } } }, [8, 7], {}),
    { a: { o: 2 } });

// Ten sorts after nine only if these are numbers. As strings it would not.
check('role ids sort as numbers',
    forPage({}, { 9: { a: { o: 1 } }, 10: { a: { o: 2 } } }, [9, 10], {}),
    { a: { o: 2 } });

/* --------------------------------------------------------- the scope --- */

check('a role scope', roleOf('role:7'), 7);
check('a longer id', roleOf('role:1234567890'), 1234567890);
check('everyone is not a role', roleOf('shared'), null);
check('me is not a role', roleOf('me'), null);
check('role zero is not a role', roleOf('role:0'), null);
check('a leading zero is not an id', roleOf('role:07'), null);
check('no id at all', roleOf('role:'), null);
check('not a number', roleOf('role:abc'), null);
check('a negative', roleOf('role:-1'), null);
check('something after the id', roleOf('role:7x'), null);
check('a second colon', roleOf('role:7:8'), null);
check('eleven digits is too many', roleOf('role:12345678901'), null);
check('nonsense', roleOf('nonsense'), null);
check('empty', roleOf(''), null);

/* ----------------------------------------------------------- the page --- */

/* One arrangement covers every server and every record of the same page. */
check('a server page', pageKey('/server/1a2b3c4d/settings'), '/server/{id}/settings');
check('a numeric id', pageKey('/admin/users/12/edit'), '/admin/users/{id}/edit');
check('a uuid', pageKey('/server/3f2504e0-4f89-11d3-9a0c-0305e82c3301'), '/server/{id}');
check('a page with no ids', pageKey('/admin/settings'), '/admin/settings');
check('the dashboard', pageKey('/'), '/');
check('leading and trailing slashes', pageKey('/admin/'), '/admin');

// A word is not an id even when it is long. "settings" and "backups" have no
// digit in them, which is the rule that separates them from uuid_short.
check('a long word stays a word', pageKey('/server/backups'), '/server/backups');
check('a short mixed segment stays', pageKey('/server/ab1'), '/server/ab1');

/* ------------------------------------------------------------ the keys -- */

/*
 * A key becomes a CSS selector. What is refused here is what would end the
 * selector and start something else.
 */
check('a partial key', sanitiseKey('partial|form.APP_NAME'), 'partial|form.APP_NAME');
check('a livewire key', sanitiseKey('key|form.actions-1'), 'key|form.actions-1');
check('surrounding space is trimmed', sanitiseKey('  partial|form.a  '), 'partial|form.a');

check('no source', sanitiseKey('form.APP_NAME'), null);
check('a source that is not one', sanitiseKey('style|form.a'), null);
check('a quote', sanitiseKey('partial|form."]{color:red}'), null);
check('a brace', sanitiseKey('partial|a{color:red}'), null);
check('a bracket', sanitiseKey('partial|a]'), null);
check('a space inside', sanitiseKey('partial|form a'), null);
check('a slash', sanitiseKey('partial|../a'), null);
check('nothing after the bar', sanitiseKey('partial|'), null);
check('empty', sanitiseKey(''), null);
check('longer than a hundred and forty', sanitiseKey('partial|' + 'a'.repeat(140)), null);
check('exactly a hundred and forty', sanitiseKey('partial|' + 'a'.repeat(132))?.length, 140);

console.log(NEWLINE + 'page layouts: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
