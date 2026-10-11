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

    'section_helper' => 'Кои eggs стартират Terraria. Нищо повече: останалото от един Terraria сървър се настройва чрез стартовите променливи, които страницата Startup на Pelican вече редактира.',
    'eggs' => 'Кои eggs са Terraria',
    'eggs_helper' => 'Отметнете eggs, които стартират Terraria сървър, обикновен или tModLoader. В сървърите, които ги ползват, се появява страница Настройки на сървъра, и никъде другаде. Нищо не е отметнато в началото, нарочно: приставката не може да знае как сте нарекли своите eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Настройки на сървъра',
    'title' => 'Настройки на Terraria сървъра',
];
