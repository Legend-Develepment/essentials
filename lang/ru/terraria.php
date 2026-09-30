<?php

/*
 * Terraria, and only what is about Terraria.
 *
 * Six strings. The words the page itself uses - Save, what to say when the file
 * is not there, what the raw field names mean - are in games.php and shared with
 * every game, which is what makes a third one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'Какие eggs запускают Terraria. И больше ничего: остальное в сервере Terraria настраивается переменными запуска, а их уже редактирует страница Startup в Pelican.',
    'eggs' => 'Какие eggs это Terraria',
    'eggs_helper' => 'Отметьте eggs, которые запускают сервер Terraria, обычный или tModLoader. В серверах, где они используются, появляется страница Настройки сервера, и больше нигде. Изначально ничего не отмечено, намеренно: плагин не может знать, как вы назвали свои eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Настройки сервера',
    'title' => 'Настройки сервера Terraria',
];
