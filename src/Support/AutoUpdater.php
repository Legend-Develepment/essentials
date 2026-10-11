<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * What the Essentials Auto Updater says about each plugin, when it is installed.
 *
 * This plugin checks for and installs nothing itself. The Auto Updater is a
 * separate plugin that does both, and while it runs it offers a read-only
 * summary under one container key. This plugin shows its own line of it on
 * the dashboard and on its settings page, with a link to it, and that is all:
 * no class of the Auto Updater is named here, nothing of it is called but that
 * one offer, and without it there is simply no update state.
 *
 * The offer is the Auto Updater's own, already in the reader's language, so
 * this plugin carries none of its vocabulary. Whatever comes back is read for
 * what it is and anything that is not the expected shape is dropped.
 */
final class AutoUpdater
{
    /** The key the Auto Updater binds its summary under. */
    private const OFFER = 'essentials.auto-updater.status';

    /**
     * How long one reading is used for. Long enough that a page drawing a row
     * per module reads it once, short enough that a queue worker or any other
     * process that lives for hours does not keep its first answer for ever.
     */
    private const FOR_SECONDS = 30;

    /** @var array{url: ?string, label: string, plugins: array<string, array{sentence: string, waiting: bool, latest: ?string}>}|false|null */
    private static array|false|null $held = null;

    private static int $heldAt = 0;

    /**
     * The summary, or null when the Auto Updater is not installed or not running.
     *
     * @return array{url: ?string, label: string, plugins: array<string, array{sentence: string, waiting: bool, latest: ?string}>}|null
     */
    public static function status(): ?array
    {
        if (self::$held === null || time() - self::$heldAt > self::FOR_SECONDS) {
            self::$held = self::read() ?? false;
            self::$heldAt = time();
        }

        return self::$held === false ? null : self::$held;
    }

    /**
     * One plugin's line, or null when the Auto Updater says nothing about it.
     *
     * @return array{sentence: string, waiting: bool, latest: ?string}|null
     */
    public static function plugin(string $id): ?array
    {
        return self::status()['plugins'][strtolower($id)] ?? null;
    }

    /** Forget the summary, for a process that outlives the request it was read in. */
    public static function forget(): void
    {
        self::$held = null;
    }

    /** @return array{url: ?string, label: string, plugins: array<string, array{sentence: string, waiting: bool, latest: ?string}>}|null */
    private static function read(): ?array
    {
        try {
            if (!app()->bound(self::OFFER)) {
                return null;
            }

            $offer = app(self::OFFER);
            $answer = is_callable($offer) ? $offer() : null;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        if (!is_array($answer) || !is_array($answer['plugins'] ?? null)) {
            return null;
        }

        $plugins = [];

        foreach ($answer['plugins'] as $id => $line) {
            if (!is_string($id) || !is_array($line) || !is_string($line['sentence'] ?? null)) {
                continue;
            }

            $plugins[strtolower($id)] = [
                'sentence' => mb_substr($line['sentence'], 0, 300),
                'waiting' => ($line['waiting'] ?? false) === true,
                'latest' => is_string($line['latest'] ?? null) ? mb_substr($line['latest'], 0, 64) : null,
            ];
        }

        $url = $answer['url'] ?? null;

        return [
            // Only a link into this panel: the offer is drawn as an anchor.
            'url' => is_string($url) && str_starts_with($url, rtrim((string) url('/'), '/') . '/') ? $url : null,
            'label' => is_string($answer['label'] ?? null) ? mb_substr($answer['label'], 0, 80) : '',
            'plugins' => $plugins,
        ];
    }
}
