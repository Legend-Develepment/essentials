/*
 * Inlined into the <head> by ThemeServiceProvider, deliberately not built by
 * Vite: it has to run before anything else on the page.
 *
 * Two jobs, both of them races that have to be won:
 *   1. stamp the current area on <html>, before the first paint
 *   2. intercept window.Xterm so the terminal is created with our colours
 *
 * The file editor used to be handled here as well. It is not any more: Monaco
 * styles itself through --vscode-* custom properties, so the stylesheet can do
 * it without any of this timing, and without sitting in the code path that
 * builds the editor.
 *
 * Both parts fail quietly. If Pelican changes how any of this is wired, the
 * panel keeps working with its own colours.
 */
(function () {
    var root = document.documentElement;

    /* ----------------------------------------------------------- switches */

    /*
     * Two things the address can ask for, both for working out why a terminal
     * is not showing what it should:
     *
     *   ?ld=plain   build the terminal from exactly what Pelican asked for.
     *               Nothing of the theme's reaches it. If the console works
     *               like this and not otherwise, the cause is in here.
     *   ?ld=debug   measure every part of the terminal once it is on screen
     *               and put the numbers on the page. A phone has no devtools
     *               worth the name, so the readout has to be visible.
     *
     * Neither costs anything when it is not asked for, and neither is a
     * setting: they are for one page load, by whoever is looking.
     */
    function flag(name) {
        try {
            return (location.search || '').indexOf('ld=' + name) !== -1;
        } catch (error) {
            return false;
        }
    }

    var PLAIN = flag('plain');
    var DEBUG = flag('debug');

    /* ------------------------------------------------------ gpu contexts */

    /*
     * Under ?ld=debug only: every WebGL context the page asks for, kept so the
     * readout can say whether it is still alive.
     *
     * A browser allows only so many WebGL contexts at once - fewer on a phone
     * than on a desktop - and when the limit is passed it takes the oldest one
     * away. xterm's WebGL renderer then draws nothing at all, while its buffer,
     * its socket and its geometry stay perfectly correct.
     */
    var contexts = [];

    if (DEBUG) {
        try {
            var nativeGetContext = HTMLCanvasElement.prototype.getContext;

            HTMLCanvasElement.prototype.getContext = function (type) {
                var context = nativeGetContext.apply(this, arguments);

                if (context && /webgl/i.test(String(type))) {
                    contexts.push(context);
                }

                return context;
            };
        } catch (error) {
            /* the rest of the readout is still worth having */
        }
    }

    /* -------------------------------------------------------- the socket */

    /*
     * Under ?ld=debug only, every websocket the page opens is counted: whether
     * it opened, whether it errored, how many messages came back and which
     * events those were.
     *
     * The console's output arrives over this socket and nowhere else, so a
     * terminal with an empty buffer is either a socket that never opened, an
     * authentication that never completed, or output that arrived and was not
     * written. Those are three different faults and they look identical on
     * screen.
     */
    var sockets = [];

    if (DEBUG) {
        try {
            var NativeSocket = window.WebSocket;

            var Wrapped = function (url, protocols) {
                var socket = protocols === undefined
                    ? new NativeSocket(url)
                    : new NativeSocket(url, protocols);

                var record = {
                    url: String(url).replace(/\?.*$/, ''),
                    opened: false,
                    errors: 0,
                    closed: null,
                    messages: 0,
                    events: {},
                };

                sockets.push(record);

                socket.addEventListener('open', function () {
                    record.opened = true;
                });

                socket.addEventListener('error', function () {
                    record.errors++;
                });

                socket.addEventListener('close', function (event) {
                    record.closed = event && event.code;
                });

                socket.addEventListener('message', function (event) {
                    record.messages++;

                    try {
                        var name = JSON.parse(event.data).event;

                        record.events[name] = (record.events[name] || 0) + 1;
                    } catch (error) {
                        /* not one of Pelican's own frames */
                    }
                });

                return socket;
            };

            Wrapped.prototype = NativeSocket.prototype;
            Wrapped.CONNECTING = 0;
            Wrapped.OPEN = 1;
            Wrapped.CLOSING = 2;
            Wrapped.CLOSED = 3;

            window.WebSocket = Wrapped;
        } catch (error) {
            /* the rest of the readout is still worth having */
        }
    }

    /* ------------------------------------------------------------- colours */

    var canvas = null;
    var styles = null;

    /**
     * Read one of the theme's custom properties. Every terminal setting travels
     * this way: the stylesheet is rebuilt per request and this file is not, so
     * a property is how a setting reaches a script that is inlined verbatim.
     */
    function token(name) {
        try {
            styles = styles || getComputedStyle(root);

            return styles.getPropertyValue(name).trim();
        } catch (error) {
            return '';
        }
    }

    /*
     * What xterm will actually accept. Everything handed to it is checked
     * against this first, because a colour it cannot parse is not a wrong
     * colour - it throws while the terminal is being constructed, and a
     * terminal that never gets built is a console with nothing in it.
     *
     * The canvas can hand back color(srgb ...) for a colour outside sRGB, and
     * the theme's tokens are oklch, so this is not a theoretical case.
     */
    var HEX = /^#(?:[0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/i;
    var RGB = /^rgba?\([0-9.,%\s/]+\)$/i;

    function usable(value) {
        return typeof value === 'string' && (HEX.test(value) || RGB.test(value));
    }

    /**
     * Resolve a custom property to something xterm can parse. It wants hex or
     * rgb and the theme's tokens are oklch, so the canvas is used as the
     * converter - it parses any CSS colour and hands back a hex string.
     */
    function colour(name, fallback) {
        var raw = token(name);

        if (!raw) {
            return fallback;
        }

        try {
            canvas = canvas || document.createElement('canvas').getContext('2d');
            canvas.fillStyle = '#010203';
            canvas.fillStyle = raw;

            var resolved = canvas.fillStyle;

            if (resolved !== '#010203' && usable(resolved)) {
                return resolved;
            }
        } catch (error) {
            /* fall through */
        }

        return usable(raw) ? raw : fallback;
    }

    /* ---------------------------------------------------------------- area */

    function area() {
        var match = location.pathname.match(/\/server\/[^/]+(\/.*)?$/);

        if (!match) {
            return '';
        }

        var rest = (match[1] || '').replace(/^\//, '');

        if (rest === '' || rest.indexOf('console') === 0) {
            return 'console';
        }

        if (/^files\/(edit|new)/.test(rest)) {
            return 'edit';
        }

        if (rest.indexOf('files') === 0) {
            return 'files';
        }

        if (/(^|\/)edit(\/|$)/.test(rest)) {
            return 'edit';
        }

        return 'server';
    }

    function stampArea() {
        root.setAttribute('data-ld-area', area());
    }

    /* ------------------------------------------------------------ terminal */

    /*
     * xterm's sixteen palette keys, in the ANSI order the theme emits them in.
     * Matched by position rather than by name, which is what lets a scheme be
     * a plain list of colours on the PHP side.
     */
    var ANSI = [
        'black', 'red', 'green', 'yellow', 'blue', 'magenta', 'cyan', 'white',
        'brightBlack', 'brightRed', 'brightGreen', 'brightYellow',
        'brightBlue', 'brightMagenta', 'brightCyan', 'brightWhite',
    ];

    function terminalTheme() {
        var background = colour('--ld-terminal-bg', '#16130f');
        var accent = colour('--primary-500', '#ffa500');
        var cursor = colour('--ld-terminal-cursor', accent);

        var theme = {
            background: background,
            foreground: colour('--ld-terminal-fg', '#d6d3d1'),
            cursor: cursor,
            cursorAccent: background,
        };

        /*
         * Only when the cursor came back as plain six-digit hex. Sticking an
         * alpha pair onto anything else builds a string no parser accepts, and
         * xterm does not shrug that off - it throws mid-construction.
         */
        if (/^#[0-9a-f]{6}$/i.test(cursor)) {
            theme.selectionBackground = cursor + '59';
        }

        /*
         * A scheme emits all sixteen; following the theme emits none, and then
         * every key here stays untouched and Pelican's own palette is what the
         * terminal keeps. There is no half-applied scheme in between.
         */
        for (var i = 0; i < ANSI.length; i++) {
            var value = colour('--ld-term-' + i, '');

            if (value) {
                theme[ANSI[i]] = value;
            }
        }

        return theme;
    }

    /*
     * Cursor shape, blinking and scrollback. Each is left out entirely when it
     * is on its default, so Pelican's own option survives rather than being
     * overwritten with the same value it already had.
     */
    function terminalOptions(options) {
        var cursor = token('--ld-term-cursor');

        // Checked here as well as on the way out of PHP: this ends up inside
        // xterm's own option validation, and an unknown keyword is a throw.
        if (cursor !== 'block' && cursor !== 'bar' && cursor !== 'underline') {
            cursor = '';
        }

        if (cursor) {
            // Both, or the change only shows while the console has focus - and
            // it never does, since Pelican disables stdin and puts the command
            // box underneath.
            options.cursorStyle = cursor;
            options.cursorInactiveStyle = cursor;
        }

        if (token('--ld-term-blink') === '1') {
            options.cursorBlink = true;
        }

        var scrollback = parseInt(token('--ld-term-scrollback'), 10);

        if (scrollback > 0) {
            options.scrollback = scrollback;
        }

        return options;
    }

    /*
     * The size is set here rather than in CSS because xterm draws to a canvas
     * through the WebGL addon: a stylesheet would move the text and leave the
     * glyphs behind.
     *
     * Pelican reads the console's font size from the person's own account
     * settings and hands it to xterm - so this is a ceiling on a screen too
     * narrow for it, never a size of its own. Someone who set 16 keeps 16 at a
     * desk, and gets something that fits on a phone.
     *
     * Worked out from the width rather than in steps, so a fold, a tablet and a
     * phone each get what they have room for. The divisor is roughly what a
     * monospace character costs in width, times the columns worth having: about
     * sixty on a small screen, which is enough for a stack trace to stay on one
     * line.
     */
    function terminalFontSize(current) {
        var size = typeof current === 'number' && current > 0 ? current : 14;
        var width = window.innerWidth || 1024;

        if (width >= 768) {
            return size;
        }

        return Math.max(7, Math.min(size, Math.floor(width / 36)));
    }

    /* Every terminal built on this page, so a rotation can be answered. */
    var terminals = [];

    /*
     * Turning a phone sideways doubles the width, and a size chosen for
     * portrait then wastes half of it. xterm keeps its options on the instance,
     * so the size can be revised - and Pelican's own resize handler calls the
     * fit addon straight after this one, which is what makes it take.
     */
    function refitTerminals() {
        if (PLAIN) {
            return;
        }

        for (var i = 0; i < terminals.length; i++) {
            try {
                var terminal = terminals[i];
                var next = terminalFontSize(terminal.__ldBaseFontSize);

                if (terminal.options.fontSize !== next) {
                    terminal.options.fontSize = next;
                }
            } catch (error) {
                /* a terminal that has been disposed of */
            }
        }
    }

    window.addEventListener('resize', refitTerminals);
    window.addEventListener('orientationchange', refitTerminals);

    /*
     * Getting the terminal measured against the box it actually ended up in.
     *
     * xterm draws to a canvas sized from the element as it was when the fit
     * addon last ran. Pelican runs it once, inline, immediately after
     * terminal.open() - and then only on window load and on resize. Neither of
     * those helps when the element is not at its final size yet: a Livewire
     * navigation never fires load again, and a console opened inside something
     * that is still being laid out is measured against a box that is about to
     * change. The canvas then holds glyphs drawn outside what is on screen, so
     * the terminal is there, the output is there, and the box is empty.
     *
     * A resize event is how the fit addon is reached from outside - Pelican
     * already listens for one - so that is what is sent.
     */
    function kickResize() {
        try {
            window.dispatchEvent(new Event('resize'));
        } catch (error) {
            /* nothing worth stopping for */
        }
    }

    /**
     * Watches the terminal's own element and re-fits whenever the box it sits
     * in changes size: the pop-out opening, the sidebar folding, a panel being
     * dragged. Only on a real change, so the fit that follows cannot feed
     * itself another one.
     */
    function watchSize(element) {
        if (!element || typeof ResizeObserver !== 'function') {
            return;
        }

        var last = '';
        var timer = null;

        try {
            new ResizeObserver(function () {
                var box = element.getBoundingClientRect();

                if (!box.width || !box.height) {
                    return;
                }

                var size = Math.round(box.width) + 'x' + Math.round(box.height);

                if (size === last) {
                    return;
                }

                last = size;

                clearTimeout(timer);
                timer = setTimeout(kickResize, 60);
            }).observe(element);
        } catch (error) {
            /* an older browser keeps the passes below and nothing more */
        }
    }

    /* ------------------------------------------------------------ readout */

    /**
     * Counts what the page hands the terminal, without changing any of it.
     */
    function countWrites(instance) {
        var tally = { count: 0 };

        instance.__ldWrites = tally;

        ['write', 'writeln'].forEach(function (name) {
            try {
                var original = instance[name];

                if (typeof original !== 'function') {
                    return;
                }

                instance[name] = function () {
                    tally.count++;

                    return original.apply(this, arguments);
                };
            } catch (error) {
                /* a terminal that will not be wrapped is still a terminal */
            }
        });
    }

    function box(element) {
        if (!element) {
            return 'missing';
        }

        var rect = element.getBoundingClientRect();
        var style = getComputedStyle(element);

        return Math.round(rect.width) + 'x' + Math.round(rect.height)
            + ' at ' + Math.round(rect.left) + ',' + Math.round(rect.top)
            + ' | ' + style.position
            + ' z=' + style.zIndex
            + ' ' + style.display
            + ' vis=' + style.visibility
            + ' op=' + style.opacity
            + ' bg=' + style.backgroundColor;
    }

    /**
     * Everything that decides whether a glyph ends up where someone can see it,
     * written down in one place. Printed to the console and put on the page,
     * because the report that comes back is worth more than the guess it saves.
     */
    function report(instance, age) {
        var terminal = instance.element;
        var screen = terminal && terminal.querySelector('.xterm-screen');
        var viewport = terminal && terminal.querySelector('.xterm-viewport');
        var host = terminal && terminal.parentElement;
        var canvases = terminal ? terminal.querySelectorAll('canvas') : [];

        var lines = [
            'legend-theme terminal readout' + (age === undefined ? '' : '  (' + age + 's)'),
            'host      ' + box(host),
            '.xterm    ' + box(terminal),
            '.screen   ' + box(screen),
            '.viewport ' + box(viewport),
        ];

        if (viewport) {
            lines.push('scroll    top=' + Math.round(viewport.scrollTop)
                + ' height=' + Math.round(viewport.scrollHeight)
                + ' client=' + Math.round(viewport.clientHeight));
        }

        // Was anything ever handed to the terminal at all? This is the line
        // that separates "drawn where nobody can see it" from "never arrived".
        try {
            lines.push('writes    ' + (instance.__ldWrites ? instance.__ldWrites.count : 'not counted'));
        } catch (error) {
            lines.push('writes    unreadable');
        }

        for (var s = 0; s < sockets.length; s++) {
            var socket = sockets[s];
            var names = [];

            for (var key in socket.events) {
                if (Object.prototype.hasOwnProperty.call(socket.events, key)) {
                    names.push(key + '=' + socket.events[key]);
                }
            }

            lines.push('socket    ' + socket.url);
            lines.push('          open=' + socket.opened
                + ' errors=' + socket.errors
                + ' closed=' + socket.closed
                + ' messages=' + socket.messages);
            lines.push('          ' + (names.length ? names.join(' ') : 'no events'));
        }

        if (!sockets.length) {
            lines.push('socket    none opened');
        }

        // The line that says whether the terminal can draw at all.
        var lost = 0;

        for (var c = 0; c < contexts.length; c++) {
            try {
                if (contexts[c].isContextLost()) {
                    lost++;
                }
            } catch (error) {
                lost++;
            }
        }

        lines.push('webgl     contexts=' + contexts.length + ' lost=' + lost);

        // What the stylesheet actually handed over, as opposed to what the
        // terminal ended up with. A browser whose canvas cannot parse oklch
        // sends every one of these to its fallback, which is fine but worth
        // being able to see.
        lines.push('tokens    bg="' + token('--ld-terminal-bg')
            + '" fg="' + token('--ld-terminal-fg')
            + '" accent="' + token('--primary-500') + '"');

        lines.push('canvases  ' + canvases.length);

        for (var i = 0; i < canvases.length; i++) {
            var canvas = canvases[i];

            lines.push('  [' + i + '] buffer=' + canvas.width + 'x' + canvas.height
                + ' ' + box(canvas));
        }

        try {
            var options = instance.options || {};
            var theme = options.theme || {};

            lines.push('opts      rows=' + instance.rows + ' cols=' + instance.cols
                + ' font=' + options.fontSize
                + ' transparent=' + options.allowTransparency);
            lines.push('theme     bg=' + theme.background + ' fg=' + theme.foreground);
        } catch (error) {
            lines.push('opts      unreadable');
        }

        var text = lines.join('\n');

        try {
            console.log(text);
        } catch (error) {
            /* nothing worth stopping for */
        }

        try {
            var panel = document.getElementById('ld-readout') || document.createElement('pre');

            panel.id = 'ld-readout';
            panel.textContent = text;
            panel.setAttribute(
                'style',
                'position:fixed;inset-block-start:0;inset-inline:0;z-index:99999;margin:0;'
                + 'padding:8px;font:11px/1.35 ui-monospace,monospace;white-space:pre-wrap;'
                + 'background:#000;color:#0f0;max-height:60vh;overflow:auto;',
            );

            document.body.appendChild(panel);
        } catch (error) {
            /* the console line is still there */
        }
    }

    /**
     * The element only exists once Pelican calls open(), which is after the
     * constructor this is scheduled from - hence the wait. A few frames, then
     * give up: a terminal that never opened has nothing to measure.
     */
    function settle(instance) {
        var tries = 0;

        function look() {
            var element = instance && instance.element;

            if (element) {
                watchSize(element);
                kickResize();

                // Once more after the layout has had time to finish moving,
                // for anything a resize observer does not see - a font landing,
                // a scrollbar appearing.
                setTimeout(kickResize, 250);

                if (DEBUG) {
                    /*
                     * Kept up to date rather than taken once. The first readout
                     * was a snapshot four hundred milliseconds in, and read as
                     * "two messages and nothing else ever came" when it only
                     * meant "nothing else had arrived yet". A number that is
                     * still climbing has to be watched, not photographed.
                     */
                    var since = Date.now();

                    setInterval(function () {
                        report(instance, Math.round((Date.now() - since) / 1000));
                    }, 1000);
                }

                return;
            }

            if (++tries < 60) {
                requestAnimationFrame(look);
            }
        }

        try {
            requestAnimationFrame(look);
        } catch (error) {
            /* no frames to wait for; the resize listeners still apply */
        }
    }

    /**
     * Pelican builds the terminal from the global Xterm bundle inside a Livewire
     * script block, so the instance is never exposed - but the class is. This
     * intercepts the assignment of that bundle and swaps in a subclass that
     * merges the theme, which works no matter which script runs first.
     */
    /**
     * A terminal that has lost its GPU context falls back to drawing in the
     * DOM instead of staying blank.
     *
     * A browser keeps only so many WebGL contexts alive at once - on a phone
     * that can be as few as eight - and when the limit is passed it takes the
     * oldest away. xterm's WebGL renderer then draws nothing: no error, no
     * warning, and every other measurement of the terminal still correct. The
     * buffer has the output in it, the socket is connected, the canvas is the
     * right size, and the box is empty.
     *
     * xterm's own documentation says to listen for onContextLoss and dispose
     * of the addon, which drops it back to the DOM renderer. Pelican builds
     * the addon and does not, so this wraps the class the same way the
     * terminal itself is wrapped. Slower to draw, and it always draws.
     */
    function patchWebgl(bundle) {
        var Base = bundle.WebglAddon;

        if (typeof Base !== 'function') {
            return;
        }

        function WebglAddon() {
            var addon = Reflect.construct(Base, arguments, new.target || WebglAddon);

            try {
                if (typeof addon.onContextLoss === 'function') {
                    addon.onContextLoss(function () {
                        try {
                            addon.dispose();
                        } catch (error) {
                            /* already gone */
                        }

                        try {
                            console.warn('[legend-theme] the terminal lost its WebGL context and is now drawing in the DOM');
                        } catch (error) {
                            /* nothing worth stopping for */
                        }
                    });
                }
            } catch (error) {
                /* an addon that will not be watched still works until it does not */
            }

            return addon;
        }

        WebglAddon.prototype = Base.prototype;

        bundle.WebglAddon = WebglAddon;
    }

    function patchXterm(bundle) {
        if (!bundle || !bundle.Terminal || bundle.__ldPatched) {
            return bundle;
        }

        patchWebgl(bundle);

        var Base = bundle.Terminal;

        /*
         * A function rather than a subclass, so the construction itself can be
         * retried. A subclass has to call super() and gets one attempt at it;
         * if xterm rejects anything in the options the terminal is never built
         * and the console stays empty, with the theme as the only cause and no
         * way back short of turning it off.
         *
         * Reflect.construct keeps the class semantics Base was written with.
         */
        function Terminal(options) {
            var original = options || {};
            var merged = Object.assign({}, original);
            var base = merged.fontSize;
            var target = new.target || Terminal;
            var instance;

            try {
                if (PLAIN) {
                    // Asked for by the address: hands off entirely, so the
                    // console can be seen without any of this in the way.
                    throw new Error('ld=plain');
                }

                merged.theme = Object.assign({}, merged.theme, terminalTheme());
                merged.fontSize = terminalFontSize(base);

                terminalOptions(merged);
            } catch (error) {
                merged = original;
            }

            try {
                instance = Reflect.construct(Base, [merged], target);
            } catch (error) {
                // Whatever the theme asked for, xterm would not have it. The
                // console is what matters; the colours are not.
                instance = Reflect.construct(Base, [original], target);

                // Said out loud, because a terminal that silently lost its
                // colours is a bug report with nothing in it. This is the one
                // line that names the value xterm refused.
                try {
                    console.warn('[legend-theme] the terminal refused the theme, so it was built without it:', error);
                } catch (ignored) {
                    /* a console that is not there is not a reason to stop */
                }
            }

            try {
                // What the account settings asked for, kept so a rotation is
                // measured against it rather than against the last narrow
                // answer.
                instance.__ldBaseFontSize = base;

                if (DEBUG) {
                    countWrites(instance);
                }

                terminals.push(instance);

                // Measured against the box it ends up in, not the one it was
                // built in. See settle() above.
                settle(instance);
            } catch (error) {
                /* not fatal: the terminal simply will not follow a rotation */
            }

            return instance;
        }

        Terminal.prototype = Base.prototype;

        bundle.Terminal = Terminal;
        bundle.__ldPatched = true;

        return bundle;
    }

    var xterm = window.Xterm;

    try {
        Object.defineProperty(window, 'Xterm', {
            configurable: true,
            get: function () {
                return xterm;
            },
            set: function (value) {
                xterm = patchXterm(value);
            },
        });
    } catch (error) {
        /* another script already locked the property */
    }

    if (xterm) {
        patchXterm(xterm);
    }


    /* --------------------------------------------------------------- start */

    stampArea();


    document.addEventListener('livewire:navigated', stampArea);
})();
