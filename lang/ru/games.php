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
    'save' => 'Сохранить',
    'saved' => 'Сохранено',
    'restart' => 'Игра читает этот файл при запуске, поэтому перезапустите сервер, чтобы изменение вступило в силу.',
    'failed' => 'Не удалось сохранить',
    'failed_write' => 'Демон отказал в записи. Проверьте, доступен ли сервер и не только ли для чтения файл.',
    'read_only' => 'Вы можете читать этот файл, но не писать в него, поэтому здесь ничего не изменить.',
    'missing' => 'У этого сервера ещё нет файла настроек. Игра создаёт его при первом запуске, поэтому запустите сервер один раз и страница заполнится.',
    'keeps' => 'Всё остальное в файле - комментарии, пустые строки, порядок и каждый ключ, о котором плагин не знает - при сохранении остаётся точно таким же.',
    'raw' => 'Названия здесь - собственные названия игры, в порядке файла. Ничего не переводится и не группируется, потому что страница читает файл, а не написанный от руки список.',
    'unset' => 'Не задано. Игра упоминает как пример; заполнение добавит это.',
    'group_all' => 'Настройки',
    'group_all_helper' => 'Всё, что упоминает этот файл.',
    'subheading' => 'Собрано из :files, а не из написанного вручную списка.',
];
