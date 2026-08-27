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

    /**
     * Resolve a custom property to something xterm can parse. It wants hex or
     * rgb and the theme's tokens are oklch, so the canvas is used as the
     * converter - it parses any CSS colour and hands back a hex string.
     */
    function colour(name, fallback) {
        var raw = getComputedStyle(root).getPropertyValue(name).trim();

        if (!raw) {
            return fallback;
        }

        try {
            canvas = canvas || document.createElement('canvas').getContext('2d');
            canvas.fillStyle = '#010203';
            canvas.fillStyle = raw;

            var resolved = canvas.fillStyle;

            if (typeof resolved === 'string' && resolved !== '#010203') {
                return resolved;
            }
        } catch (error) {
            /* fall through */
        }

        return raw.charAt(0) === '#' ? raw : fallback;
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

    function terminalTheme() {
        var background = colour('--ld-terminal-bg', '#16130f');
        var accent = colour('--primary-500', '#ffa500');

        return {
            background: background,
            foreground: colour('--ld-terminal-fg', '#d6d3d1'),
            cursor: accent,
            cursorAccent: background,
            selectionBackground: accent + '59',
        };
    }

    /**
     * Pelican builds the terminal from the global Xterm bundle inside a Livewire
     * script block, so the instance is never exposed - but the class is. This
     * intercepts the assignment of that bundle and swaps in a subclass that
     * merges the theme, which works no matter which script runs first.
     */
    /**
     * A phone is about half as wide as a laptop, and a terminal that cannot fit
     * a line of output wraps every one of them - which turns a stack trace into
     * something to reassemble rather than read. Two or four points smaller buys
     * back the columns.
     *
     * Set here rather than in CSS because xterm draws to a canvas from its own
     * options: a stylesheet would move the text and leave the glyphs behind.
     */
    function terminalFontSize(current) {
        var size = typeof current === 'number' && current > 0 ? current : 14;
        var width = window.innerWidth || 1024;

        /*
         * A size, not a reduction. Taking four points off whatever Pelican
         * asked for depends on knowing what it asked for, and if it asks for
         * nothing xterm's own default applies rather than the one assumed here
         * - which is how a phone ended up with a terminal fitting twenty
         * characters to a line.
         */
        if (width <= 480) {
            return Math.min(size, 9);
        }

        if (width <= 767) {
            return Math.min(size, 11);
        }

        return size;
    }

    function patchXterm(bundle) {
        if (!bundle || !bundle.Terminal || bundle.__ldPatched) {
            return bundle;
        }

        var Base = bundle.Terminal;

        bundle.Terminal = class extends Base {
            constructor(options) {
                var merged = Object.assign({}, options || {});

                try {
                    merged.theme = Object.assign({}, merged.theme, terminalTheme());
                    merged.fontSize = terminalFontSize(merged.fontSize);
                } catch (error) {
                    /* keep Pelican's own theme */
                }

                super(merged);
            }
        };

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
