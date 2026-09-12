<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 「egg」「GameUserSettings.ini」「Startup」「mod」保留原文：前三個是 Pelican 和遊戲
 * 本來就用的名字，最後一個是這個圈子裡人人都這麼說的。
 */

return [
    /* ------------------------------------------------ 管理分頁 ----------- */

    /*
     * 這一節的標題不在這裡。每個設定節的標題都取自 settings.groups.<名字>，由
     * group() 拼出來。
     */
    'section_helper' => '只講哪些 egg 是 ARK，別的都沒有：一臺 ARK 伺服器的其餘部分靠啟動變數設定，那些 Pelican 自己的 Startup 頁面已經在改了。',

    'eggs' => '哪些 egg 是 ARK',
    'eggs_helper' => '把跑 ARK 伺服器的 egg 勾起來。用到它們的伺服器裡會出現一個「世界設定」頁面，別處不會有。這和狀態頁上的那個問題不是一回事：那邊問的是哪些 egg 會回應 Valve 的查詢，Rust 和 Valheim 也會；這邊問的是哪些 egg 會把 GameUserSettings.ini 放在 ARK 放它的地方，那只有 ARK。一開始一個都沒勾，這是刻意的：外掛沒辦法知道你替自己的 egg 取了什麼名字。',

    /* --------------------------------------------- 伺服器裡的頁面 -------- */

    'nav_label' => '世界設定',
    'title' => 'ARK 世界設定',
    'subheading' => 'GameUserSettings.ini 裡人們真正會改的那些設定。',

    'group_server' => '伺服器',
    'group_server_helper' => '伺服器叫什麼、誰能進來、能進多少人。',
    'group_rates' => '倍率',
    'group_rates_helper' => '各種事情發生得多快。1.0 是原版，2.0 就是兩倍。',
    'group_rules' => '規則',
    'group_rules_helper' => '玩家能做什麼，以及遊戲給他們看什麼。',

    'keeps' => '一個幾百行的檔案裡的十五項設定。裡面其餘的一切（你的 mod 設定、這個外掛從沒聽過的鍵、註解，還有它們的順序）儲存時都原樣不動。',
    'missing' => '這臺伺服器還沒有 GameUserSettings.ini。遊戲第一次跑起來時才會寫出它，所以先啟動一次伺服器，這一頁就會填上。',
    'read_only' => '你能讀這個檔案但不能寫，所以這裡什麼都改不了。',

    'save' => '儲存',
    'saved' => '已儲存',
    'saved_restart' => 'ARK 在啟動時讀這個檔案，所以要讓改動生效，請重新啟動伺服器。',
    'failed' => '沒能儲存',
    'failed_write' => 'daemon 拒絕了寫入。檢查伺服器是不是連得上，以及檔案是不是唯讀的。',
];
