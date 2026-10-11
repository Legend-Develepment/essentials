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

    'section_helper' => '哪些 egg 运行 Terraria。仅此而已：Terraria 服务器的其余部分由启动变量配置，而 Pelican 自己的 Startup 页面已经在编辑它们了。',
    'eggs' => '哪些 egg 是 Terraria',
    'eggs_helper' => '勾选运行 Terraria 服务器的 egg，原版或 tModLoader 都行。使用它们的服务器里会出现一个"服务器设置"页面，别处不会。一开始什么都没勾选，这是故意的：插件无法知道你把 egg 叫成了什么。',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => '服务器设置',
    'title' => 'Terraria 服务器设置',
];
