<?php

namespace LegendDevelopment\Theme\Support;

/**
 * The terminal itself, as opposed to the page around it.
 *
 * Everything here is handed to xterm rather than to the browser. The console
 * loads xterm's WebGL addon, which draws every glyph to a canvas from the
 * options the terminal was constructed with - a stylesheet moves the box and
 * leaves the text behind. The way in is the interception in
 * resources/inline/runtime.js.
 *
 * That script is inlined verbatim and never rebuilt per request, so nothing
 * here is written into it. Instead these settings are emitted as custom
 * properties and the runtime reads them back, which is the same route the
 * accent already travelled. It also means the browser resolves the colours:
 * the theme's own tokens are oklch and xterm cannot parse those.
 *
 * What Pelican already decides is left alone. The font, its size and the
 * number of rows are each person's own, under Account, and the theme only caps
 * the size where the screen is too narrow for it.
 */
class Terminal
{
    /**
     * Sixteen ANSI colours, a background, a foreground and a cursor.
     *
     * Order is the ANSI order - black, red, green, yellow, blue, magenta, cyan,
     * white, then the same eight bright - because the runtime maps them onto
     * xterm's keys by position rather than by name.
     */
    private const SCHEMES = [
        'dracula' => [
            'bg' => '#282a36', 'fg' => '#f8f8f2', 'cursor' => '#f8f8f2',
            'ansi' => [
                '#21222c', '#ff5555', '#50fa7b', '#f1fa8c',
                '#bd93f9', '#ff79c6', '#8be9fd', '#f8f8f2',
                '#6272a4', '#ff6e6e', '#69ff94', '#ffffa5',
                '#d6acff', '#ff92df', '#a4ffff', '#ffffff',
            ],
        ],
        'nord' => [
            'bg' => '#2e3440', 'fg' => '#d8dee9', 'cursor' => '#88c0d0',
            'ansi' => [
                '#3b4252', '#bf616a', '#a3be8c', '#ebcb8b',
                '#81a1c1', '#b48ead', '#88c0d0', '#e5e9f0',
                '#4c566a', '#bf616a', '#a3be8c', '#ebcb8b',
                '#81a1c1', '#b48ead', '#8fbcbb', '#eceff4',
            ],
        ],
        'solarized' => [
            'bg' => '#002b36', 'fg' => '#839496', 'cursor' => '#93a1a1',
            'ansi' => [
                '#073642', '#dc322f', '#859900', '#b58900',
                '#268bd2', '#d33682', '#2aa198', '#eee8d5',
                '#586e75', '#cb4b16', '#93a1a1', '#657b83',
                '#839496', '#6c71c4', '#93a1a1', '#fdf6e3',
            ],
        ],
        'gruvbox' => [
            'bg' => '#282828', 'fg' => '#ebdbb2', 'cursor' => '#ebdbb2',
            'ansi' => [
                '#282828', '#cc241d', '#98971a', '#d79921',
                '#458588', '#b16286', '#689d6a', '#a89984',
                '#928374', '#fb4934', '#b8bb26', '#fabd2f',
                '#83a598', '#d3869b', '#8ec07c', '#ebdbb2',
            ],
        ],
        'one_dark' => [
            'bg' => '#282c34', 'fg' => '#abb2bf', 'cursor' => '#528bff',
            'ansi' => [
                '#282c34', '#e06c75', '#98c379', '#e5c07b',
                '#61afef', '#c678dd', '#56b6c2', '#abb2bf',
                '#5c6370', '#e06c75', '#98c379', '#e5c07b',
                '#61afef', '#c678dd', '#56b6c2', '#ffffff',
            ],
        ],
        'tokyo_night' => [
            'bg' => '#1a1b26', 'fg' => '#a9b1d6', 'cursor' => '#c0caf5',
            'ansi' => [
                '#15161e', '#f7768e', '#9ece6a', '#e0af68',
                '#7aa2f7', '#bb9af7', '#7dcfff', '#a9b1d6',
                '#414868', '#f7768e', '#9ece6a', '#e0af68',
                '#7aa2f7', '#bb9af7', '#7dcfff', '#c0caf5',
            ],
        ],
        'catppuccin' => [
            'bg' => '#1e1e2e', 'fg' => '#cdd6f4', 'cursor' => '#f5e0dc',
            'ansi' => [
                '#45475a', '#f38ba8', '#a6e3a1', '#f9e2af',
                '#89b4fa', '#f5c2e7', '#94e2d5', '#bac2de',
                '#585b70', '#f38ba8', '#a6e3a1', '#f9e2af',
                '#89b4fa', '#f5c2e7', '#94e2d5', '#a6adc8',
            ],
        ],
        'monokai' => [
            'bg' => '#272822', 'fg' => '#f8f8f2', 'cursor' => '#f8f8f0',
            'ansi' => [
                '#272822', '#f92672', '#a6e22e', '#f4bf75',
                '#66d9ef', '#ae81ff', '#a1efe4', '#f8f8f2',
                '#75715e', '#f92672', '#a6e22e', '#f4bf75',
                '#66d9ef', '#ae81ff', '#a1efe4', '#f9f8f5',
            ],
        ],
    ];

    private const CURSORS = ['underline', 'block', 'bar'];

    /*
     * How the terminal is drawn.
     *
     * Pelican loads xterm's WebGL addon and offers no way out of it. That is
     * the right default - it is much faster on a wall of scrolling output - but
     * a browser keeps only so many GPU contexts alive at once, fewer on a phone
     * than on a desktop, and takes the oldest away when the limit is passed.
     * The WebGL renderer then draws nothing at all: no error, no warning, and a
     * terminal whose buffer, socket and geometry are all still correct.
     *
     * 'dom' hands the drawing back to the browser. Slower, and it always draws.
     */
    private const RENDERERS = ['webgl', 'dom'];

    /*
     * How far back the buffer keeps. Every line is held in the browser, so a
     * chatty server on a large setting is real memory on someone's machine -
     * hence a ceiling rather than a free number.
     */
    private const SCROLLBACK = ['1000', '5000', '10000', '25000'];

    public static function scheme(): string
    {
        return self::oneOf(Theme::config('terminal_scheme', 'theme'), array_keys(self::SCHEMES), 'theme');
    }

    public static function cursor(): string
    {
        return self::oneOf(Theme::config('terminal_cursor', 'underline'), self::CURSORS, 'underline');
    }

    public static function blink(): bool
    {
        return (bool) Theme::config('terminal_blink', false);
    }

    public static function scrollback(): string
    {
        return self::oneOf(Theme::config('terminal_scrollback', '1000'), self::SCROLLBACK, '1000');
    }

    public static function renderer(): string
    {
        return self::oneOf(Theme::config('terminal_renderer', 'webgl'), self::RENDERERS, 'webgl');
    }

    public static function sanitiseRenderer(mixed $value): string
    {
        return self::oneOf($value, self::RENDERERS, 'webgl');
    }

    /**
     * @return array<string, string>
     */
    public static function rendererOptions(): array
    {
        $options = [];

        foreach (self::RENDERERS as $key) {
            $options[$key] = Theme::trans('settings.terminal.renderer_' . $key);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function schemeOptions(): array
    {
        $options = ['theme' => Theme::trans('settings.terminal.scheme_theme')];

        foreach (array_keys(self::SCHEMES) as $key) {
            $options[$key] = Theme::trans('settings.terminal.scheme_' . $key);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function cursorOptions(): array
    {
        $options = [];

        foreach (self::CURSORS as $key) {
            $options[$key] = Theme::trans('settings.terminal.cursor_' . $key);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function scrollbackOptions(): array
    {
        $options = [];

        foreach (self::SCROLLBACK as $lines) {
            $options[$lines] = Theme::trans('settings.terminal.scrollback_lines', [
                'lines' => number_format((int) $lines),
            ]);
        }

        return $options;
    }

    public static function sanitiseScheme(mixed $value): string
    {
        return self::oneOf($value, array_keys(self::SCHEMES), 'theme');
    }

    public static function sanitiseCursor(mixed $value): string
    {
        return self::oneOf($value, self::CURSORS, 'underline');
    }

    public static function sanitiseScrollback(mixed $value): string
    {
        return self::oneOf($value, self::SCROLLBACK, '1000');
    }

    /**
     * The custom properties the runtime reads back. Nothing is written while
     * every setting is on its default, so a panel that has not touched the
     * terminal carries no extra bytes and keeps following the accent.
     */
    public static function css(): string
    {
        $declarations = self::schemeProperties() . self::behaviourProperties();

        if ($declarations === '') {
            return '';
        }

        $css = ':root{' . $declarations . '}';

        // xterm is built with allowTransparency, so the box behind the canvas
        // is what is actually seen. Without this the scheme's background would
        // stop at the text and the page's own surface would show around it.
        if (self::scheme() !== 'theme') {
            $css .= 'html.dark #terminal{background-color:var(--ld-terminal-bg);}';
        }

        return $css;
    }

    private static function schemeProperties(): string
    {
        $scheme = self::scheme();

        if ($scheme === 'theme' || !isset(self::SCHEMES[$scheme])) {
            return '';
        }

        $colours = self::SCHEMES[$scheme];

        $css = '--ld-terminal-bg:' . $colours['bg'] . ';'
            . '--ld-terminal-fg:' . $colours['fg'] . ';'
            . '--ld-terminal-cursor:' . $colours['cursor'] . ';';

        foreach ($colours['ansi'] as $index => $value) {
            $css .= '--ld-term-' . $index . ':' . $value . ';';
        }

        return $css;
    }

    /**
     * Cursor and scrollback ride the same route as the colours: a custom
     * property holds any sequence of tokens, so a keyword travels through one
     * just as well as a colour does.
     */
    private static function behaviourProperties(): string
    {
        $css = '';

        // Pelican hard-codes an underline cursor, so that is the default here
        // as well - anything else and the console changes shape for someone who
        // never asked it to.
        if (self::cursor() !== 'underline') {
            $css .= '--ld-term-cursor:' . self::cursor() . ';';
        }

        if (self::blink()) {
            $css .= '--ld-term-blink:1;';
        }

        if (self::scrollback() !== '1000') {
            $css .= '--ld-term-scrollback:' . self::scrollback() . ';';
        }

        // Only ever written to ask for the DOM. Left out, the runtime leaves
        // Pelican's WebGL addon exactly where it found it.
        if (self::renderer() === 'dom') {
            $css .= '--ld-term-renderer:dom;';
        }

        return $css;
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        // Cast first: PHP turns a numeric array key into an integer, so a
        // scrollback of 5000 arrives as an int and a strict comparison against
        // the string list would reject every one of them.
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }
}
