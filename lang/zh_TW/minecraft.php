<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 遊戲模式和難度不譯。Minecraft 在遊戲裡顯示的就是 Survival、Creative、Peaceful 和
 * Hard。一個和它出處畫面不同名的設定，是要查兩遍的設定。
 *
 * server.properties 裡寫著的那些字也一樣：whitelist、operator、seed、chunk、RCON、
 * query、resource pack 和 the Nether。
 */

return [
    /* ------------------------------------------------ 管理分頁 ----------- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft 設定',
    'subheading' => '這臺伺服器自己的 server.properties，做成表單而不是一個文字檔。',

    /*
     * 標題不在這裡。每個設定節的標題都取自 settings.groups.<名字>，由 group() 拼出
     * 來；本檔案裡那份放在 'section' 鍵底下的副本，在真正的那個徹底缺席的日子裡，反倒
     * 一直沒人用。
     */
    'section_helper' => '這一套適用於哪些 egg，以及這個外掛圍繞 Minecraft 做的其餘一切。',

    'live' => '向伺服器詢問誰在玩',
    'live_helper' => '在「玩家」頁面上加一份即時的線上名單，用的是 Minecraft 用戶端畫自己那份伺服器清單時用的同一套交握。預設關著，因為這是這裡唯一一件會從面板直接開一條到遊戲連接埠的連線的事：如果你的面板和節點在互相搆不著的網路裡，就不會有任何回應，那一行乾脆不會出現。遊戲伺服器那邊不需要開啟什麼。',

    'eggs' => '哪些 egg 是 Minecraft',
    'eggs_helper' => '把跑 Minecraft 伺服器的 egg 勾起來：Vanilla、Paper、Purpur、Fabric、Forge，以及你自己取的那些名字。用到它們的伺服器裡才會出現這一頁，別處不會有。一開始一個都沒勾，這是刻意的：外掛沒辦法知道你替自己的 egg 取了什麼名字，而一份猜出來的清單，在發行那一週就會在某個人的面板上出錯。',

    /* --------------------------------------------- 伺服器裡的頁面 -------- */

    'groups' => [
        'general' => '伺服器',
        'players' => '玩家',
        'world' => '世界',
        'performance' => '效能',
        'access' => '存取與附加',
        'other' => '檔案裡的其餘一切',
    ],

    'other_helper' => '讀自 server.properties，並原樣留著。mod 和 modpack 會把自己的設定放在這裡；顯示出來是讓你知道它們存在，要改則到檔案管理員裡去改。儲存這一頁永遠不會碰它們。',

    'reload' => '重新讀一次檔案',

    'saved' => '已儲存到 server.properties',
    'saved_helper' => '下次伺服器啟動時生效。',

    'running' => '伺服器正在執行',
    'running_helper' => 'Minecraft 啟動時讀 server.properties，停止時再寫回去，所以現在儲存的東西會在它結束時被蓋掉。停下伺服器，再儲存一次。',

    'missing' => '找不到 server.properties',
    'missing_helper' => '這個檔案在伺服器第一次啟動時才出現。先啟動一次，再回來。',

    'failed' => '沒能儲存',
    'failed_helper' => 'daemon 拒絕了寫入。可能是這一頁開著的時候伺服器啟動了。',

    /* ---------------------------------------- 每個鍵是什麼意思 ---------- */

    'keys' => [
        'motd' => '伺服器清單裡顯示的那行字',
        'gamemode' => '遊戲模式',
        'difficulty' => '難度',
        'hardcore' => 'Hardcore：死了就是死了',
        'force_gamemode' => '進來時把所有人撥回預設模式',
        'pvp' => '玩家之間可以互相傷害',

        'max_players' => '同時最多多少人',
        'white_list' => '僅 whitelist',
        'enforce_whitelist' => '把不在 whitelist 上的人踢出去',
        'online_mode' => '向 Mojang 核對帳號',
        'player_idle_timeout' => '閒置多少分鐘後踢出',
        'op_permission_level' => 'operator 能做什麼（1-4）',

        'level_name' => '世界資料夾',
        'level_seed' => 'Seed',
        'level_type' => '世界類型',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => '生怪',
        'spawn_protection' => 'spawn 周圍受保護的方塊數',

        'view_distance' => '視距（chunk）',
        'simulation_distance' => '模擬距離（chunk）',
        'max_tick_time' => 'Watchdog，單位毫秒（-1 為關閉）',
        'sync_chunk_writes' => '把 chunk 直接寫進磁碟',

        'enable_command_block' => '指令方塊',
        'allow_flight' => '允許飛行',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'resource pack 位址',
        'require_resource_pack' => '必須使用 resource pack',
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
