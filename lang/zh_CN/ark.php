<?php

/*
 * 简体中文。逐字手译。
 *
 * “egg”“GameUserSettings.ini”“Startup”“mod”保留原文：前三个是 Pelican 和游戏本来
 * 就用的名字，最后一个是这个圈子里人人都这么说的。
 */

return [
    /* ------------------------------------------------ 管理标签页 --------- */

    /*
     * 这一节的标题不在这里。每个设置节的标题都取自 settings.groups.<名字>，由
     * group() 拼出来。
     */
    'section_helper' => '只说哪些 egg 是 ARK，别的都没有：一台 ARK 服务器的其余部分靠启动变量配置，那些 Pelican 自己的 Startup 页面已经在改了。',

    'eggs' => '哪些 egg 是 ARK',
    'eggs_helper' => '把跑 ARK 服务器的 egg 勾上。用到它们的服务器里会出现一个“世界设置”页面，别处不会有。这和状态页上的那个问题不是一回事：那边问的是哪些 egg 会回应 Valve 的查询，Rust 和 Valheim 也会；这边问的是哪些 egg 会把 GameUserSettings.ini 放在 ARK 放它的地方，那只有 ARK。一开始一个都没勾，这是故意的：插件没法知道你给自己的 egg 起了什么名字。',

    /* --------------------------------------------- 服务器里的页面 -------- */

    'nav_label' => '世界设置',
    'title' => 'ARK 世界设置',
    'subheading' => 'GameUserSettings.ini 里人们真正会改的那些设置。',

    'group_server' => '服务器',
    'group_server_helper' => '服务器叫什么、谁能进来、能进多少人。',
    'group_rates' => '倍率',
    'group_rates_helper' => '各种事情发生得多快。1.0 是原版，2.0 就是两倍。',
    'group_rules' => '规则',
    'group_rules_helper' => '玩家能做什么，以及游戏给他们看什么。',

    'keeps' => '一个几百行的文件里的十五项设置。里面其余的一切（你的 mod 设置、这个插件从没听说过的键、注释，还有它们的顺序）保存时都原样不动。',
    'missing' => '这台服务器还没有 GameUserSettings.ini。游戏第一次跑起来时才会写出它，所以先启动一次服务器，这一页就会填上。',
    'read_only' => '你能读这个文件但不能写，所以这里什么都改不了。',

    'save' => '保存',
    'saved' => '已保存',
    'saved_restart' => 'ARK 在启动时读这个文件，所以要让改动生效，请重启服务器。',
    'failed' => '没能保存',
    'failed_write' => 'daemon 拒绝了写入。检查服务器是不是连得上，以及文件是不是只读的。',
];
