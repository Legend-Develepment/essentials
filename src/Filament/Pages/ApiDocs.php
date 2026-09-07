<?php

namespace LegendDevelopment\Theme\Filament\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Pages\Page;
use LegendDevelopment\Theme\Support\Api\Docs;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

/**
 * How to use the API, on the panel that has it.
 *
 * Its own namespace rather than Admin\Pages or App\Pages, because it is
 * registered in both - the same argument the favourites page makes. The person
 * who most needs this is whoever holds a key, and they are in the client area;
 * the administrator handing keys out wants to read the same thing before
 * deciding to.
 *
 * **Documentation on the panel it describes, rather than in a repository.** The
 * addresses in it are this panel's own, the version is the build that is
 * actually installed, and it cannot be a release behind the thing it documents.
 * Everything on the page comes from Support\Api\Docs, which is also what the
 * two downloads are rendered from, so the page and the file somebody takes away
 * cannot disagree.
 *
 * No permission of its own. It describes an interface; it does not open one.
 * Reading it grants nothing that having a key does not already grant, and
 * hiding it from the people expected to write against it would be a strange way
 * to encourage them.
 */
class ApiDocs extends Page implements HasActions
{
    use InteractsWithActions;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-file-code';

    protected static ?string $slug = 'api-docs';

    protected static ?int $navigationSort = 93;

    public static function canAccess(): bool
    {
        try {
            return Features::enabled(Features::API) && Keys::ready();
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('api.docs_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('api.docs_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('api.docs_nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.api-docs';
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        return [
            /*
             * Markdown, because it goes next to the code that calls the API -
             * where it can be read in a terminal, searched, and shown in a diff
             * when the panel it came from moves on without it.
             */
            Action::make('ld_docs_md')
                ->label(Theme::trans('api.docs_download_md'))
                ->icon('tabler-file-text')
                ->action(fn (): StreamedResponse => $this->send(
                    'essentials-api.md',
                    'text/markdown',
                    Docs::markdown(),
                )),

            /*
             * And OpenAPI, because the most useful thing to hand somebody
             * writing a bot is not prose - it is a file Postman, Insomnia and
             * every client generator already know how to read.
             */
            Action::make('ld_docs_json')
                ->label(Theme::trans('api.docs_download_json'))
                ->icon('tabler-braces')
                ->color('gray')
                ->action(fn (): StreamedResponse => $this->send(
                    'essentials-api.json',
                    'application/json',
                    Docs::pretty(Docs::openapi()),
                )),
        ];
    }

    /** What the page draws, and what the downloads are rendered from. */
    public function docs(): Docs
    {
        return new Docs();
    }

    /**
     * Hand the browser a file.
     *
     * Streamed rather than written anywhere. Nothing about this needs to touch
     * the disk - it is a few kilobytes built from an array in memory - and a
     * temporary file is a temporary file somebody has to remember to remove.
     */
    private function send(string $name, string $type, string $body): StreamedResponse
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
