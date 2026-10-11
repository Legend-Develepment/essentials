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
    'save' => 'Зберегти',
    'saved' => 'Збережено',
    'restart' => 'Гра читає цей файл під час запуску, тож перезапустіть сервер, щоб зміна подіяла.',
    'failed' => 'Не вдалося зберегти',
    'failed_write' => 'Демон відмовив у записі. Перевірте, чи доступний сервер і чи файл не лише для читання.',
    'read_only' => 'Ви можете читати цей файл, але не писати в нього, тож тут нічого не змінити.',
    'missing' => 'У цього сервера ще немає файлу налаштувань. Гра створює його під час першого запуску, тож запустіть сервер один раз і сторінка заповниться.',
    'keeps' => 'Усе решта у файлі - коментарі, порожні рядки, порядок і кожен ключ, про який цей плагін не знає - після збереження залишається точно таким самим.',
    'raw' => 'Назви тут - власні назви гри, у порядку файлу. Нічого не перекладається й не групується, бо сторінка читає файл, а не написаний вручну список.',
    'unset' => 'Не задано. Гра згадує як приклад; заповнення додасть це.',
    'group_all' => 'Налаштування',
    'group_all_helper' => 'Усе, що згадує цей файл.',
    'subheading' => 'Побудовано з :files, а не зі списку, написаного вручну.',
];
