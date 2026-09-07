<?php

namespace LegendDevelopment\Theme\Filament\Concerns;

use Filament\Actions\Action;
use LegendDevelopment\Theme\Support\Api\Docs;
use LegendDevelopment\Theme\Support\Theme;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * The two download buttons, on whichever page is showing the documentation.
 *
 * A trait rather than a page of its own, because the documentation is not a
 * place to go - it is something you read while you are already looking at your
 * keys. It was a sidebar row for one release and that was wrong: a plugin that
 * adds a row to somebody's navigation for every piece of prose it has written
 * is a plugin nobody can find anything in.
 *
 * Both pages that use this render the same component underneath, so there is
 * one copy of the markup and one copy of these two actions, and neither page
 * can drift from the other.
 */
trait OffersApiDocs
{
    /**
     * Markdown for the repository beside a bot, OpenAPI for everything that
     * already knows how to read one.
     *
     * @return array<int, Action>
     */
    protected function apiDocsActions(): array
    {
        return [
            /*
             * Markdown goes next to the code that calls the API, where it can
             * be read in a terminal, searched, and shown in a diff when the
             * panel it came from moves on without it.
             */
            Action::make('ld_docs_md')
                ->label(Theme::trans('api.docs_download_md'))
                ->icon('tabler-file-text')
                ->color('gray')
                ->action(fn (): StreamedResponse => $this->sendDocs(
                    'essentials-api.md',
                    'text/markdown',
                    Docs::markdown(),
                )),

            /*
             * And OpenAPI, because the most useful thing to hand somebody
             * writing a bot is not prose - it is a file Postman, Insomnia and
             * every client generator can import.
             */
            Action::make('ld_docs_json')
                ->label(Theme::trans('api.docs_download_json'))
                ->icon('tabler-braces')
                ->color('gray')
                ->action(fn (): StreamedResponse => $this->sendDocs(
                    'essentials-api.json',
                    'application/json',
                    Docs::pretty(Docs::openapi()),
                )),
        ];
    }

    /**
     * Hand the browser a file.
     *
     * Streamed rather than written anywhere. It is a few kilobytes built from
     * an array in memory, and a temporary file is a temporary file somebody has
     * to remember to remove.
     */
    private function sendDocs(string $name, string $type, string $body): StreamedResponse
    {
        return response()->streamDownload(
            static function () use ($body): void {
                echo $body;
            },
            $name,
            ['Content-Type' => $type],
        );
    }
}
