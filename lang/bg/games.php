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
    'save' => 'Запази',
    'saved' => 'Запазено',
    'restart' => 'Играта чете този файл при стартиране, затова рестартирайте сървъра, за да влезе промяната в сила.',
    'failed' => 'Запазването не успя',
    'failed_write' => 'Демонът отказа записа. Проверете дали сървърът е достъпен и дали файлът не е само за четене.',
    'read_only' => 'Може да четете този файл, но не и да пишете в него, затова тук нищо не може да се промени.',
    'missing' => 'Този сървър още няма файл с настройки. Играта го създава при първото стартиране, затова стартирайте сървъра веднъж и страницата ще се запълни.',
    'keeps' => 'Всичко останало във файла - коментарите, празните редове, редът и всеки ключ, за който приставката не знае - остава точно както си е при запазване.',
    'raw' => 'Имената тук са имената на играта, в реда на файла. Нищо не се превежда и не се групира, защото страницата чете файла вместо списък: показва всяка настройка, която играта разбира.',
    'unset' => 'Не е зададено. Играта го споменава като пример; попълването го добавя.',
    'group_all' => 'Настройки',
    'group_all_helper' => 'Всичко, което този файл споменава.',
    'subheading' => 'Изградено от :files, а не от списък, написан на ръка.',
];
