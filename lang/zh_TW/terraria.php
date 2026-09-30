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

    'section_helper' => '哪些 egg 執行 Terraria。僅此而已：Terraria 伺服器的其餘部分由啟動變數設定，而 Pelican 自己的 Startup 頁面已經在編輯它們了。',
    'eggs' => '哪些 egg 是 Terraria',
    'eggs_helper' => '勾選執行 Terraria 伺服器的 egg，原版或 tModLoader 都行。使用它們的伺服器裡會出現一個「伺服器設定」頁面，別處不會。一開始什麼都沒勾選，這是故意的：外掛無法知道你把 egg 叫成了什麼。',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => '伺服器設定',
    'title' => 'Terraria 伺服器設定',
];
