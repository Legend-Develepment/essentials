<?php

namespace LegendDevelopment\Theme\Support\Tickets;

/**
 * The little bit of markdown a ticket message is allowed to have.
 *
 * **Escaped first, formatted second, and never the other way round.** The text
 * is whatever somebody typed - a customer, or a stranger in a Discord channel -
 * so it becomes text before anything is made of it. Every tag that ends up in
 * the output was put there by this class, never by the writer, which is what
 * makes "render markdown from the internet" a safe sentence rather than an
 * alarming one.
 *
 * **Discord's subset, because that is the other end of the conversation.** The
 * same message is read here and in a channel, and a panel that rendered things
 * Discord does not would show two different messages to two people who think
 * they are reading the same one. So: bold, italic, underline, strike, inline
 * code, fenced code and quotes - and not `[text](url)`, which Discord leaves as
 * plain text in a message.
 *
 * **Code is lifted out before anything else happens.** Otherwise a snippet
 * containing asterisks comes back italic, which is the one thing somebody
 * pasting a config file will notice immediately.
 */
class Markdown
{
    /**
     * What stands in for a code block while the rest is formatted.
     *
     * A control character, because the text has already been escaped by the
     * time this is used and an escaped string cannot contain one - unless the
     * writer typed it, which is why it is stripped from the input first.
     */
    private const MARK = "\x01";

    /** Turn a message into html that is safe to print. */
    public static function render(string $text): string
    {
        // Any of our own marker in the input is removed before it can be
        // mistaken for one of ours. Nothing legible is lost: it is a control
        // character that renders as nothing.
        $text = str_replace(self::MARK, '', $text);

        $safe = e($text);

        $kept = [];
        $safe = self::lift($safe, $kept);

        $safe = self::headings($safe);
        $safe = self::inline($safe);
        $safe = self::quotes($safe);
        $safe = self::links($safe);

        return self::putBack($safe, $kept);
    }

    /**
     * Take the code out, so nothing below touches it.
     *
     * Fenced blocks first and then inline spans, because ``` contains ` and a
     * pass that took the spans first would eat the fences from the inside.
     *
     * @param  array<int, string>  $kept
     */
    private static function lift(string $text, array &$kept): string
    {
        $text = (string) preg_replace_callback(
            '~```(?:[a-z0-9+#-]*\n)?(.*?)```~is',
            static function (array $found) use (&$kept): string {
                $kept[] = '<pre class="ld-said-code"><code>' . trim($found[1], "\n") . '</code></pre>';

                return self::MARK . (count($kept) - 1) . self::MARK;
            },
            $text,
        );

        return (string) preg_replace_callback(
            '~`([^`\n]+)`~',
            static function (array $found) use (&$kept): string {
                $kept[] = '<code>' . $found[1] . '</code>';

                return self::MARK . (count($kept) - 1) . self::MARK;
            },
            $text,
        );
    }

    /**
     * The marks that wrap a run of text.
     *
     * In this order on purpose: `**` before `*`, and `__` before `_`, or the
     * shorter pattern eats half of the longer one and leaves a stray asterisk
     * in the middle of somebody's sentence.
     */
    private static function inline(string $text): string
    {
        $rules = [
            '~\*\*(?=\S)(.+?)(?<=\S)\*\*~s' => '<strong>$1</strong>',
            '~__(?=\S)(.+?)(?<=\S)__~s' => '<u>$1</u>',
            // Escaped, because the delimiter is a tilde too: written bare,
            // `~~~...~~~s` is read as a pattern that ends after two
            // characters and a stray `~~s` after it, which PHP reports as
            // an unknown modifier and refuses to run.
            '~\~\~(?=\S)(.+?)(?<=\S)\~\~~s' => '<del>$1</del>',
            '~\*(?=\S)(.+?)(?<=\S)\*~s' => '<em>$1</em>',
            '~(?<![a-z0-9])_(?=\S)(.+?)(?<=\S)_(?![a-z0-9])~is' => '<em>$1</em>',
        ];

        foreach ($rules as $pattern => $into) {
            $text = (string) preg_replace($pattern, $into, $text);
        }

        return $text;
    }

    /**
     * Discord's three heading sizes, and its subtext.
     *
     * `# `, `## `, `### ` and `-# `, each only at the start of a line and each
     * needing the space after it - which is what keeps `#general` and a bare
     * `#` from turning into headings.
     *
     * Before the inline marks, because a heading line still has bold and links
     * in it and those passes should run on what is inside the heading rather
     * than on the hash in front of it.
     *
     * Longest first: `###` before `##` before `#`, or the short rule matches
     * the first hash of the long one and leaves the rest sitting in the text.
     */
    private static function headings(string $text): string
    {
        $rules = [
            '~^-# (.*)$~m' => '<span class="ld-said-small">$1</span>',
            '~^### (.*)$~m' => '<span class="ld-said-h3">$1</span>',
            '~^## (.*)$~m' => '<span class="ld-said-h2">$1</span>',
            '~^# (.*)$~m' => '<span class="ld-said-h1">$1</span>',
        ];

        foreach ($rules as $pattern => $into) {
            $text = (string) preg_replace($pattern, $into, $text);
        }

        return $text;
    }

    /**
     * A line that starts with a chevron.
     *
     * Wrapped line by line rather than gathered into one block: a quote of
     * three lines drawn as three quoted lines reads the same and needs no
     * state to be kept between them.
     */
    private static function quotes(string $text): string
    {
        return (string) preg_replace(
            '~^&gt;\s?(.*)$~m',
            '<span class="ld-said-quote">$1</span>',
            $text,
        );
    }

    /**
     * Bare addresses, made clickable.
     *
     * `nofollow` and `noopener`, because these are links written by people this
     * panel has no reason to vouch for and they open somebody else's page.
     */
    private static function links(string $text): string
    {
        return (string) preg_replace(
            '~(?<!")(https?://[^\s<>"]+)~i',
            '<a href="$1" target="_blank" rel="noopener nofollow">$1</a>',
            $text,
        );
    }

    /** @param array<int, string> $kept */
    private static function putBack(string $text, array $kept): string
    {
        foreach ($kept as $at => $code) {
            $text = str_replace(self::MARK . $at . self::MARK, $code, $text);
        }

        return $text;
    }
}
