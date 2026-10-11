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
    'save' => 'Сачувај',
    'saved' => 'Сачувано',
    'restart' => 'Игра чита ову датотеку при покретању, па поново покрените сервер да би промена имала ефекта.',
    'failed' => 'Није успело чување',
    'failed_write' => 'Демон је одбио упис. Проверите да ли је сервер доступан и да датотека није само за читање.',
    'read_only' => 'Ову датотеку можете читати али не и уписивати, па се овде ништа не може променити.',
    'missing' => 'Овај сервер још нема датотеку са подешавањима. Игра је прави при првом покретању, па покрените сервер једном и страница ће се попунити.',
    'keeps' => 'Све остало у датотеци - коментари, празни редови, редослед и сваки кључ који овај додатак не познаје - остаје при чувању потпуно исто.',
    'raw' => 'Имена овде су имена саме игре, редоследом датотеке. Ништа се не преводи нити групише, јер страница чита датотеку а не ручно писан списак.',
    'unset' => 'Није подешено. Игра то помиње као пример; попуњавање га додаје.',
    'group_all' => 'Подешавања',
    'group_all_helper' => 'Све што ова датотека помиње.',
    'subheading' => 'Направљено од :files, а не од ручно писаног списка.',
];
