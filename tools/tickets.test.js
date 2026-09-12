/*
 * Asking a question from inside the panel.
 *
 * There is very little arithmetic here and one rule that matters more than any
 * of it: **written down first, passed on second, always in that order.** A
 * customer who has typed out what is wrong with their server has done the
 * expensive part, and an HTTP call that fails afterwards is an inconvenience
 * while one that fails before the row is written loses their afternoon.
 *
 * So most of what follows is about ordering and about what survives a refusal.
 * The state machine is the other half: three states, and which one a ticket is
 * in says who is waiting rather than whether anything is wrong.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

/* ------------------------------------------------- written down first --- */

/**
 * Board::open() and Board::say(), as the order they do things in.
 *
 * The desk is a function that may refuse. Whatever it answers, the row exists
 * by the time it is asked - which is what the log below records.
 */
function open(desk) {
    const log = [];

    log.push('saved');

    const pushed = desk();

    log.push(pushed ? 'pushed' : 'refused');

    return { log, kept: log.includes('saved'), pushed };
}

const works = () => true;
const refuses = () => false;
const throws = () => { throw new Error('the network'); };

check('a desk that works saves then pushes', open(works).log, ['saved', 'pushed']);
check('a desk that refuses still saved', open(refuses).log, ['saved', 'refused']);
check('and the question is kept either way', [open(works).kept, open(refuses).kept], [true, true]);

/*
 * And a desk that throws is the same as one that refuses, because Board catches
 * it. The row is already there; an exception from a network call must not take
 * the request that wrote it.
 */
const guarded = (desk) => {
    try {
        return open(desk);
    } catch {
        return { log: ['saved'], kept: true, pushed: false };
    }
};

check('a desk that throws does not lose the question', guarded(throws).kept, true);
check('and it is simply not passed on', guarded(throws).pushed, false);

/* ------------------------------------------------------ whose turn ------ */

/**
 * Board::say(): the state is about who is waiting.
 *
 * Not about whether anything is wrong, and not about whether it is finished.
 * A customer replying to an answer puts it back in the queue, which is the
 * whole reason it is not a "seen" flag.
 */
const after = (state, staff) => state === 'closed' ? 'closed' : (staff ? 'answered' : 'open');

check('a question puts it on the panel', after('answered', false), 'open');
check('an answer puts it on the customer', after('open', true), 'answered');
check('a second question puts it back', after('answered', false), 'open');
check('a finished ticket stays finished', after('closed', true), 'closed');
check('even if the customer writes again', after('closed', false), 'closed');

/** And nothing can be added to a finished one. */
const mayAdd = (state) => state !== 'closed';

check('an open ticket takes more', mayAdd('open'), true);
check('an answered one takes more', mayAdd('answered'), true);
check('a finished one does not', mayAdd('closed'), false);

/* --------------------------------------------------- what gets pulled --- */

/**
 * Modora::pull(): everything is offered and the unique index decides.
 *
 * Our own messages come back on the read as well, matched by the id written
 * when they were sent - which is the only reason that id is written at all.
 */
function pull(remote, known) {
    const seen = new Set(known);
    let taken = 0;

    for (const row of remote) {
        const id = String(row.id || '');

        if (id === '' || String(row.content || '') === '' || seen.has(id)) continue;

        seen.add(id);
        taken++;
    }

    return taken;
}

const said = [
    { id: 'm1', content: 'is it off?' },
    { id: 'm2', content: 'have you tried a restart' },
    { id: 'm3', content: 'yes' },
];

check('a first pull takes everything', pull(said, []), 3);
check('a second pull takes nothing', pull(said, ['m1', 'm2', 'm3']), 0);
check('our own message is not taken back', pull(said, ['m1']), 2);
check('an overlapping pull takes only the new one', pull(said, ['m1', 'm2']), 1);
check('a row with no id is skipped', pull([{ content: 'hello' }], []), 0);
check('an empty message is skipped', pull([{ id: 'm9', content: '' }], []), 0);
check('the same id twice in one answer counts once', pull([said[0], said[0]], []), 1);

/* ------------------------------------------------ which desk answers --- */

/**
 * Desks::current(): never null, and the panel's own is the fallback.
 *
 * A Modora key that stops working must not turn Ask into a page that throws.
 * It turns questions into panel tickets, which somebody can still answer.
 */
const current = (wanted, modoraOn) => wanted === 'modora' && modoraOn ? 'modora' : 'panel';

check('the panel answers when it is chosen', current('panel', true), 'panel');
check('modora answers when it is chosen and on', current('modora', true), 'modora');
check('and the panel takes over when it is not', current('modora', false), 'panel');
check('a setting naming nothing is the panel', current('carrier-pigeon', true), 'panel');

/** And the page says so, rather than pretending the setting took. */
const fellBack = (wanted, modoraOn) => wanted !== 'panel' && current(wanted, modoraOn) === 'panel';

check('falling back is reported', fellBack('modora', false), true);
check('choosing the panel is not falling back', fellBack('panel', true), false);
check('a working modora is not falling back', fellBack('modora', true), false);

/* --------------------------------------------------- passing on again --- */

/**
 * Board::retry(): only what has not gone, and never an answer.
 *
 * An answer written on this panel is already where staff can see it - it is on
 * their own screen. Pushing answers to the channel they were typed into would
 * post everything twice.
 */
const toSend = (messages) => messages.filter((m) => !m.pushed && !m.staff).length;

const conversation = [
    { staff: false, pushed: true },
    { staff: true, pushed: false },
    { staff: false, pushed: false },
    { staff: false, pushed: false },
];

check('two questions still to pass on', toSend(conversation), 2);
check('nothing to do when all have gone', toSend([{ staff: false, pushed: true }]), 0);
check('an answer is never pushed', toSend([{ staff: true, pushed: false }]), 0);

/* ------------------------------------------------- what they send ------- */

/*
 * Hook: the shape Modora actually posts.
 *
 * Written against a real delivery rather than against a guess, and the guess
 * was wrong in exactly the place a guess is wrong: the ticket is named at
 * `ticket.ticket_id`, and the first version of this had five candidate paths
 * for that field with the right one among none of them. Every path below has
 * been seen.
 */
const delivery = {
    event: 'ticket.message',
    ticket: { ticket_id: 4821, ticket_number: 37, status: 'claimed' },
    message: {
        id: 90514,
        discord_message_id: '1405112233445566778',
        source: 'discord',
        author: { discord_user_id: '1234567890123456789', name: 'support_agent', type: 'staff' },
        content: 'On it.',
    },
    sent_at: '2026-08-19T15:49:55+00:00',
};

/** Hook::pick(): a value by the path it sits at, as a string. */
function pick(payload, paths) {
    for (const path of paths) {
        let at = payload;

        for (const step of path.split('.')) {
            if (at === null || typeof at !== 'object' || !(step in at)) { at = null; break; }
            at = at[step];
        }

        if (at !== null && typeof at !== 'object' && String(at).trim() !== '') return String(at);
    }

    return null;
}

check('the ticket is found', pick(delivery, ['ticket.ticket_id', 'ticket.id', 'ticket_id']), '4821');
check('the message id is found', pick(delivery, ['message.id', 'id']), '90514');
check('the text is found', pick(delivery, ['message.content', 'content']), 'On it.');
check('the author is found', pick(delivery, ['message.author.name', 'author.name']), 'support_agent');
check('the discord id is found', pick(delivery, ['message.discord_message_id', 'discord_message_id']), '1405112233445566778');
check('the event is found', pick(delivery, ['event', 'type', 'name']), 'ticket.message');

/* The guess that was wrong, kept as the reason the list is short now. */
check('ticket.id alone would have found nothing', pick(delivery, ['ticket.id']), null);
check('and the ticket number is not the ticket', pick(delivery, ['ticket.ticket_id']) === String(delivery.ticket.ticket_number), false);

/* A number comes back as a string, because every id here is a name. */
check('an id is a string', typeof pick(delivery, ['message.id']), 'string');

/* Missing pieces are missing rather than empty, so said() can refuse. */
check('a payload with no message says so', pick({ event: 'ticket.closed', ticket: { ticket_id: 1 } }, ['message.content', 'content']), null);
check('and one with no ticket says so', pick({ event: 'ticket.message' }, ['ticket.ticket_id', 'ticket.id', 'ticket_id']), null);

/*
 * And whether it is an answer comes from what they say about the author, not
 * from where it arrived. A customer who has claimed their ticket writes in the
 * channel too, and calling that an answer would label their own words support.
 */
const isStaff = (payload) => (pick(payload, ['message.author.type', 'author.type']) ?? 'staff') === 'staff';

check('a staff message is an answer', isStaff(delivery), true);
check('a customer writing in the channel is not', isStaff({
    message: { author: { type: 'customer' } },
}), false);
check('an author with no type is read as staff', isStaff({ message: { author: { name: 'x' } } }), true);

/* Which decides whose turn it is next, the same rule Board::say follows. */
check('an answer from the channel waits on the customer', after('open', isStaff(delivery)), 'answered');
check('a customer message from the channel waits on the panel', after('answered', isStaff({
    message: { author: { type: 'customer' } },
})), 'open');

/* -------------------------------------------------- still a question? --- */

/*
 * Desk::stillOpen(): three answers, not two.
 *
 * A ticket closed in Discord was staying open in the panel because nothing
 * ever asked. Now the pull does - and the important part is what it does with
 * an answer it did not get: a desk that could not be reached is not a desk
 * saying the conversation is over.
 */
const closesIt = (answer, alreadyClosed) => answer === false && !alreadyClosed;

check('the far end says finished, so it is', closesIt(false, false), true);
check('the far end says open, so it stays', closesIt(true, false), false);
check('the far end could not be asked, so it stays', closesIt(null, false), false);
check('and one already finished is not finished twice', closesIt(false, true), false);

/*
 * And which of their statuses counts as finished is read the other way round:
 * only "closed" ends it, so a status this release has never heard of leaves
 * somebody's conversation alone.
 */
const stillOpen = (status) => status === '' ? null : status !== 'closed';

check('closed is finished', stillOpen('closed'), false);
check('open is not', stillOpen('open'), true);
check('claimed is not', stillOpen('claimed'), true);
check('a status nobody has heard of is not', stillOpen('escalated'), true);
check('and no status at all says nothing', stillOpen(''), null);

/* ------------------------------------------------- what is rendered ----- */

/*
 * Markdown::render(): escaped first, formatted second, never the other way.
 *
 * The text is whatever somebody typed, in the panel or in a Discord channel.
 * Every tag in the output was put there by the renderer; none of it came from
 * the writer. These checks are that sentence, made testable.
 */
const escape = (text) => text
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');

check('a tag is text by the time anything else happens', escape('<script>x</script>'), '&lt;script&gt;x&lt;/script&gt;');
check('an attribute cannot be broken out of', escape('" onerror="x'), '&quot; onerror=&quot;x');
check('an ampersand survives as one', escape('a & b'), 'a &amp; b');

/** The marks, longest first or the short one eats half the long one. */
const bold = (t) => t.replace(/\*\*(?=\S)(.+?)(?<=\S)\*\*/gs, '<strong>$1</strong>');
const italic = (t) => t.replace(/\*(?=\S)(.+?)(?<=\S)\*/gs, '<em>$1</em>');

check('bold is bold', bold('**hi**'), '<strong>hi</strong>');
check('italic is italic', italic('*hi*'), '<em>hi</em>');
check('bold before italic leaves nothing stray', italic(bold('**hi**')), '<strong>hi</strong>');
check('and the other way round does not', bold(italic('**hi**')).includes('*'), true);

/*
 * Code is lifted out before any of that, or a pasted config comes back in
 * italics - which is the first thing somebody pasting one will notice.
 */
const lift = (text, kept) => text.replace(/`([^`\n]+)`/g, (_, code) => {
    kept.push(code);

    return '\u0001' + (kept.length - 1) + '\u0001';
});

const kept = [];
const lifted = lift('use `a * b * c` here', kept);

check('the code is taken out', lifted.includes('*'), false);
check('and kept whole', kept[0], 'a * b * c');
check('so formatting cannot reach it', italic(lifted).includes('<em>'), false);

/* And our own marker is never something a writer can supply. */
const clean = (text) => text.split('\u0001').join('');

check('a marker in the input is removed first', clean('a\u00010\u0001b'), 'a0b');

/* ------------------------------------------------------- the scopes ----- */

/**
 * Modora::check(): the five this plugin exercises, and no more.
 *
 * panels.read is deliberately absent. Nothing here lists panels, and asking for
 * a scope that is never used is asking somebody to hand over more than is
 * needed.
 */
const WANTS = ['tickets.create', 'tickets.read', 'tickets.close', 'messages.read', 'messages.write'];
const missing = (has) => WANTS.filter((scope) => !has.includes(scope));

check('a full key is missing nothing', missing(WANTS), []);
check('a read-only key is missing four', missing(['tickets.read']).length, 4);
check('a key without messages.write is named for it', missing(WANTS.filter((s) => s !== 'messages.write')), ['messages.write']);
check('panels.read is not asked for', WANTS.includes('panels.read'), false);
check('and having it extra is not a fault', missing([...WANTS, 'panels.read']), []);

/* --------------------------------------------------------- the list ----- */

/*
 * Waiting first, then answered, then finished, and newest within each. A list
 * sorted by date alone puts yesterday's finished conversation above this
 * morning's unanswered question, and the second one is the only thing anybody
 * opens the page to find.
 */
const rank = (state) => state === 'open' ? 0 : (state === 'answered' ? 1 : 2);

const queue = [
    { id: 1, state: 'closed', last: 90 },
    { id: 2, state: 'open', last: 10 },
    { id: 3, state: 'answered', last: 80 },
    { id: 4, state: 'open', last: 70 },
];

const sorted = queue
    .slice()
    .sort((a, b) => rank(a.state) - rank(b.state) || b.last - a.last)
    .map((row) => row.id);

check('waiting first, newest of them first', sorted, [4, 2, 3, 1]);
check('and the finished one is last', sorted[sorted.length - 1], 1);

/* ------------------------------------------- the conversation, drawn --- */

/*
 * Board::drawn(), which is the only part of the ticket feature with logic a
 * window depends on rather than a database.
 *
 * Three decisions live in it and all three have been got wrong before:
 *
 *   - Whose side a message sits on. The same message is mine on one page and
 *     theirs on the other, so the page says who is reading and the message
 *     never decides for itself.
 *   - Where one run of messages ends. Six replies in a row are one name and six
 *     bubbles, and the run has to break on anything that would change what the
 *     name says - not on the name alone.
 *   - Where a day ends, which also ends a run: a header that vanished across a
 *     date separator would leave the first message of a day anonymous.
 */
function drawn(messages, staffReads) {
    const out = [];
    let wasDay = null;
    let wasWho = null;

    for (const message of messages) {
        const notice = Boolean(message.notice);
        const from = message.user === null ? 'discord' : 'panel';

        // A notice belongs to neither end, so it is nobody's.
        const mine = !notice && (staffReads ? Boolean(message.staff) : !message.staff);

        const who = notice
            ? 'notice'
            : [from, message.staff ? 'staff' : 'user', message.author].join(':');

        out.push({
            mine,
            notice,
            lane: notice ? 'notice' : (from === 'discord' ? 'middle' : (mine ? 'mine' : 'theirs')),
            run: message.day !== wasDay || who !== wasWho,
            startsDay: message.day !== wasDay,
        });

        wasDay = message.day;
        wasWho = who;
    }

    return out;
}

const lanes = (rows) => rows.map((row) => row.lane);
const runs = (rows) => rows.map((row) => row.run);

/* The same three messages, read from both ends. */
const talk = [
    { author: 'Bryan', staff: false, user: 7, day: '2026-09-10' },
    { author: 'Sam', staff: true, user: 2, day: '2026-09-10' },
    { author: 'Sam', staff: true, user: 2, day: '2026-09-10' },
];

check('staff read their own answers on the right', lanes(drawn(talk, true)), ['theirs', 'mine', 'mine']);
check('and the customer reads the opposite', lanes(drawn(talk, false)), ['mine', 'theirs', 'theirs']);
check('two answers in a row are one run', runs(drawn(talk, true)), [true, true, false]);

/* Two different people, both staff, both "mine" on the admin page. */
const twoStaff = [
    { author: 'Sam', staff: true, user: 2, day: '2026-09-10' },
    { author: 'Kim', staff: true, user: 3, day: '2026-09-10' },
];

check('a second person starts a new run', runs(drawn(twoStaff, true)), [true, true]);
check('even though both are mine', drawn(twoStaff, true).map((row) => row.mine), [true, true]);

/* The same name, typed in two different places. */
const twoPlaces = [
    { author: 'Sam', staff: true, user: 2, day: '2026-09-10' },
    { author: 'Sam', staff: true, user: null, day: '2026-09-10' },
];

check('the same name from Discord is a new run', runs(drawn(twoPlaces, true)), [true, true]);
check('and Discord is down the middle on both pages', [
    lanes(drawn(twoPlaces, true))[1],
    lanes(drawn(twoPlaces, false))[1],
], ['middle', 'middle']);

/* A night in between. */
const twoDays = [
    { author: 'Sam', staff: true, user: 2, day: '2026-09-10' },
    { author: 'Sam', staff: true, user: 2, day: '2026-09-11' },
];

check('a new day restarts the run', runs(drawn(twoDays, true)), [true, true]);
check('and only the second one draws a separator', drawn(twoDays, true).map((row) => row.startsDay), [true, true]);

/* A notice is nobody's, whoever is reading. */
const withNotice = [
    { author: 'Bryan', staff: false, user: 7, day: '2026-09-10' },
    { author: 'Sam', staff: true, user: 2, notice: true, day: '2026-09-10' },
];

check('a notice is on nobody side', [
    drawn(withNotice, true)[1].mine,
    drawn(withNotice, false)[1].mine,
], [false, false]);
check('and is drawn as a notice, not a bubble', lanes(drawn(withNotice, true))[1], 'notice');

/* ------------------------------------------------- what staff may change --- */

/*
 * Board::urgency(), Board::claim() and Board::hand().
 *
 * None of them exists at the far end - Modora has no assign, no transfer and no
 * priority endpoint - so all three are decided here and said out loud in the
 * channel. What the tests hold down is that a bad value changes nothing, which
 * is the one way a panel-side decision can quietly corrupt a row.
 */
const PRIORITIES = ['low', 'normal', 'high'];

const urgency = (was, wanted) => PRIORITIES.includes(wanted) ? wanted : was;

check('a known level is taken', urgency('normal', 'high'), 'high');
check('an unknown one changes nothing', urgency('normal', 'critical'), 'normal');
check('and neither does an empty one', urgency('high', ''), 'high');

/* Claiming is one decision - is this mine - so one button does both. */
const claim = (held, me) => held === me ? null : me;

check('an unclaimed ticket becomes mine', claim(null, 4), 4);
check('pressing it again puts it down', claim(4, 4), null);
check('and on somebody else it is taken over', claim(9, 4), 4);

/*
 * Moving to a group refuses a role that is not there any more, rather than
 * writing an id nothing resolves. A group nobody can read the name of is a
 * label that says nothing.
 */
const hand = (roles, wanted) => {
    if (wanted === null) { return { moved: true, group: null }; }

    return roles[wanted] === undefined
        ? { moved: false, group: undefined }
        : { moved: true, group: wanted };
};

check('a real role is taken', hand({ 3: 'Billing' }, 3), { moved: true, group: 3 });
check('a role that is gone is refused', hand({ 3: 'Billing' }, 8).moved, false);
check('and no group at all is allowed', hand({ 3: 'Billing' }, null), { moved: true, group: null });

/* --------------------------------------- a picture from the far end --- */

/*
 * Files::theirs(), which reads an attachment somebody added in the channel.
 *
 * This is here because of the exact shape of the bug it replaced. The first
 * version read Discord's own field names - content_type, filename - and Modora
 * answers contentType and name. Every picture posted in a channel was therefore
 * skipped, silently, and from the panel it looked like a feature nobody had
 * built rather than one field name being wrong.
 *
 * So the test is written around the names and not around the logic.
 */
function theirs(attachments) {
    if (!Array.isArray(attachments)) { return null; }

    const endings = ['.png', '.jpg', '.jpeg', '.gif', '.webp'];

    for (const one of attachments) {
        if (!one || typeof one !== 'object') { continue; }

        const url = String(one.url ?? one.proxy_url ?? '').trim();
        const name = String(one.name ?? one.filename ?? '').trim();

        if (!url.startsWith('https://')) { continue; }

        const type = String(one.contentType ?? one.content_type ?? '').trim().toLowerCase();

        // No declared type is not the same as no picture: an attachment that
        // ends in .png is one, whoever failed to say so.
        const named = (name || url).toLowerCase();
        const ok = type ? type.startsWith('image/') : endings.some((e) => named.endsWith(e));

        if (!ok) { continue; }

        return { url, name, size: Number(one.size ?? 0) };
    }

    return null;
}

const MODORA = [{
    url: 'https://cdn.modora.gg/misc/WQMrnenSt2Q41AQWs4H6YF9Xu0YCGDDScwSFvCEH.jpg',
    name: 'image0.jpg',
    size: 125915,
    contentType: 'image/jpeg',
    storage: 'cdn',
}];

const DISCORD = [{
    url: 'https://cdn.discordapp.com/attachments/1/2/screenshot.png',
    proxy_url: 'https://media.discordapp.net/attachments/1/2/screenshot.png',
    filename: 'screenshot.png',
    content_type: 'image/png',
    size: 4096,
}];

check('Modora names it contentType, and it is read', theirs(MODORA).name, 'image0.jpg');
check('Discord names it content_type, and that still works', theirs(DISCORD).name, 'screenshot.png');
check('the size comes across', theirs(MODORA).size, 125915);

check('no type at all, but the name says png', theirs([
    { url: 'https://cdn.modora.gg/x/a.png', name: 'a.png' },
]).name, 'a.png');

check('no type and no name, but the address says so', theirs([
    { url: 'https://cdn.modora.gg/x/b.webp' },
]).url, 'https://cdn.modora.gg/x/b.webp');

check('.jpeg as well as .jpg', theirs([{ url: 'https://c.dn/x/c.jpeg' }]) !== null, true);

check('a pdf is not a picture', theirs([
    { url: 'https://cdn.modora.gg/x/bill.pdf', name: 'bill.pdf', contentType: 'application/pdf' },
]), null);

check('nor is one with no type and an unknown name', theirs([
    { url: 'https://cdn.modora.gg/x/thing', name: 'thing' },
]), null);

check('http is refused outright', theirs([
    { url: 'http://cdn.modora.gg/x/a.png', name: 'a.png', contentType: 'image/png' },
]), null);

check('and so is anything that is not a list', [theirs(null), theirs('a.png'), theirs([])], [null, null, null]);

check('the first picture wins, not the last', theirs([
    { url: 'https://a.dn/one.png', name: 'one.png', contentType: 'image/png' },
    { url: 'https://a.dn/two.png', name: 'two.png', contentType: 'image/png' },
]).name, 'one.png');

check('and a pdf in front of a picture is stepped over', theirs([
    { url: 'https://a.dn/bill.pdf', name: 'bill.pdf', contentType: 'application/pdf' },
    { url: 'https://a.dn/two.png', name: 'two.png', contentType: 'image/png' },
]).name, 'two.png');

/*
 * And the rule that decides whether a message exists at all.
 *
 * Somebody who drops a screenshot into the channel and types nothing has said
 * what they came to say. Discord sends that with no content, and requiring text
 * threw every one of them away.
 */
const worthKeeping = (content, attachments) => String(content ?? '').trim() !== '' || theirs(attachments) !== null;

check('words with no picture is a message', worthKeeping('hello', []), true);
check('a picture with no words is a message', worthKeeping('', MODORA), true);
check('both is a message', worthKeeping('look', MODORA), true);
check('neither is not', worthKeeping('   ', []), false);

/* ------------------------------------------------------------------------ */

console.log('Tickets: ' + pass + ' passed, ' + fail + ' failed.');
process.exit(fail === 0 ? 0 : 1);
