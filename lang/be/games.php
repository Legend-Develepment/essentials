<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Захаваць',
    'saved' => 'Захавана',
    'restart' => 'Гульня чытае гэты файл пры запуску, таму перазапусціце сервер, каб змена падзейнічала.',
    'failed' => 'Не ўдалося захаваць',
    'failed_write' => 'Дэман адмовіў у запісе. Праверце, ці даступны сервер і ці не толькі для чытання файл.',
    'read_only' => 'Вы можаце чытаць гэты файл, але не пісаць у яго, таму тут нічога не змяніць.',
    'missing' => 'У гэтага сервера яшчэ няма файла налад. Гульня стварае яго пры першым запуску, таму запусціце сервер адзін раз і старонка запоўніцца.',
    'keeps' => 'Усё астатняе ў файле - каментарыі, пустыя радкі, парадак і кожны ключ, пра які плагін не ведае - застаецца пры захаванні дакладна такім жа.',
    'raw' => 'Назвы тут - назвы гульні, у парадку файла. Нічога не перакладаецца і не групуецца, бо старонка чытае файл, а не спіс: яна паказвае кожную наладу, якую гульня разумее.',
    'unset' => 'Не зададзена. Гульня згадвае як прыклад; запаўненне дадае яе.',
    'group_all' => 'Налады',
    'group_all_helper' => 'Усё, што згадвае гэты файл.',
    'subheading' => 'Пабудавана з :files, а не са спіса, які нехта склаў.',
];
