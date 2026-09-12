<?php

/*
 * 简体中文。逐字手译。
 *
 * 游戏模式和难度不译。Minecraft 在游戏里显示的就是 Survival、Creative、Peaceful 和
 * Hard，一个和它来处的画面不同名的设置，是要查两遍的设置。
 *
 * server.properties 里写着的那些词也一样：whitelist、operator、seed、chunk、RCON、
 * query、resource pack 和 the Nether。
 */

return [
    /* ------------------------------------------------ 管理标签页 --------- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft 设置',
    'subheading' => '这台服务器自己的 server.properties，做成表单而不是一个文本文件。',

    /*
     * 标题不在这里。每个设置节的标题都取自 settings.groups.<名字>，由 group() 拼出
     * 来；本文件里那份放在 'section' 键下的副本，在真正的那个彻底缺席的日子里，反倒
     * 一直没人用。
     */
    'section_helper' => '这一套适用于哪些 egg，以及这个插件围绕 Minecraft 做的其余一切。',

    'live' => '向服务器询问谁在玩',
    'live_helper' => '在“玩家”页面上加一份实时的在线名单，用的是 Minecraft 客户端画自己那份服务器列表时用的同一套握手。默认关着，因为这是这里唯一一件会从面板直接开一条到游戏端口的连接的事：如果你的面板和节点在互相够不着的网络里，就不会有任何回应，那一行干脆不会出现。游戏服务器那边不需要开启什么。',

    'eggs' => '哪些 egg 是 Minecraft',
    'eggs_helper' => '把跑 Minecraft 服务器的 egg 勾上：Vanilla、Paper、Purpur、Fabric、Forge，以及你自己起的那些名字。用到它们的服务器里才会出现这一页，别处不会有。一开始一个都没勾，这是故意的：插件没法知道你给自己的 egg 起了什么名字，而一份猜出来的清单，在发布那一周就会在某个人的面板上出错。',

    /* --------------------------------------------- 服务器里的页面 -------- */

    'groups' => [
        'general' => '服务器',
        'players' => '玩家',
        'world' => '世界',
        'performance' => '性能',
        'access' => '访问与附加',
        'other' => '文件里的其余一切',
    ],

    'other_helper' => '读自 server.properties，并原样留着。mod 和 modpack 会把自己的设置放在这里；显示出来是让你知道它们存在，改则要到文件管理器里去改。保存这一页永远不会碰它们。',

    'reload' => '重新读一次文件',

    'saved' => '已保存到 server.properties',
    'saved_helper' => '下次服务器启动时生效。',

    'running' => '服务器正在运行',
    'running_helper' => 'Minecraft 启动时读 server.properties，停止时再写回去，所以现在保存的东西会在它退出时被盖掉。停下服务器，再保存一次。',

    'missing' => '找不到 server.properties',
    'missing_helper' => '这个文件在服务器第一次启动时才出现。先启动一次，再回来。',

    'failed' => '没能保存',
    'failed_helper' => 'daemon 拒绝了写入。可能是这一页开着的时候服务器启动了。',

    /* ---------------------------------------- 每个键是什么意思 ---------- */

    'keys' => [
        'motd' => '服务器列表里显示的那行字',
        'gamemode' => '游戏模式',
        'difficulty' => '难度',
        'hardcore' => 'Hardcore：死了就是死了',
        'force_gamemode' => '进来时把所有人拨回默认模式',
        'pvp' => '玩家之间可以互相伤害',

        'max_players' => '同时最多多少人',
        'white_list' => '仅 whitelist',
        'enforce_whitelist' => '把不在 whitelist 上的人踢出去',
        'online_mode' => '向 Mojang 校验账号',
        'player_idle_timeout' => '闲置多少分钟后踢出',
        'op_permission_level' => 'operator 能做什么（1-4）',

        'level_name' => '世界文件夹',
        'level_seed' => 'Seed',
        'level_type' => '世界类型',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => '刷怪',
        'spawn_protection' => 'spawn 周围受保护的方块数',

        'view_distance' => '视距（chunk）',
        'simulation_distance' => '模拟距离（chunk）',
        'max_tick_time' => 'Watchdog，单位毫秒（-1 为关闭）',
        'sync_chunk_writes' => '把 chunk 直接写进磁盘',

        'enable_command_block' => '命令方块',
        'allow_flight' => '允许飞行',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'resource pack 地址',
        'require_resource_pack' => '必须使用 resource pack',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
