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

    /**
     * Pelican builds the terminal from the global Xterm bundle inside a Livewire
     * script block, so the instance is never exposed - but the class is. This
     * intercepts the assignment of that bundle and swaps in a subclass that
     * merges the theme, which works no matter which script runs first.
     */
    function patchXterm(bundle) {
        if (!bundle || !bundle.Terminal || bundle.__ldPatched) {
            return bundle;
        }

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

                terminals.push(instance);
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
