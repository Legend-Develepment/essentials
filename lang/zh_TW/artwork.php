<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 「Steam App ID」「IGDB」「Twitch client ID」「client secret」保留原文：抓值的那些
 * 頁面上寫的正是這幾個字。
 */

return [
    'title' => 'egg 圖片',
    'nav_label' => 'egg 圖片',
    'subheading' => '替你的 egg 配上遊戲圖，從 Steam 和 IGDB 抓。沒有圖的 egg，會在每一張用到它的伺服器卡片上顯示 Pelican 自己那隻鳥。',

    // ---- 表格 -------------------------------------------------------------
    'column_name' => 'egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => '已鎖定',

    'locked' => '已鎖定',
    'unlocked' => '未鎖',

    // ---- 對一列能做什麼 ----------------------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => '一款遊戲 Steam 商店位址裡的那個數字 —— store.steampowered.com/app/892970 就是 892970。照 id 抓會把圖鎖上，因為敲一個數字是一次決定，後來的批次抓不該把它推翻。',

    'fetch_igdb' => 'IGDB',
    'search_term' => '搜尋',
    'search_term_helper' => 'egg 的名字已經填好了，但它很少就是遊戲的名字 —— 「Paper 1.20.4」是 Minecraft。打遊戲的名字。',

    'lock' => '鎖定',
    'unlock' => '解鎖',
    'locked_done' => '已鎖定 —— 批次抓會繞開這一個',
    'unlocked_done' => '已解鎖 —— 批次抓可能換掉這張圖',

    'clear' => '清除',
    'clear_confirm' => '把圖和 Steam App ID 都拿掉。這個 egg 會回到 Pelican 自己那隻鳥，下一次批次抓會再試一次。',
    'cleared' => '圖已拿掉',

    // ---- 結果 -------------------------------------------------------------
    'fetched' => '圖已儲存',
    'failed' => '沒有儲存任何圖',

    /*
     * 每種情況一個理由，因為它們是不同的問題。
     *
     * 因為打錯字而失敗的抓圖，和因為磁碟滿了而失敗的抓圖，不該都說「失敗」 —— 前者盯
     * 著那個數字就能治，後者要盯著伺服器才能治。
     */
    'why_bad_id' => '那不是一個 Steam App ID。',
    'why_not_found' => 'Steam 在那個位址上什麼都沒有。核對一下 App ID —— 沒有商店頁面的遊戲，也沒有標題圖。',
    'why_no_match' => '用那個名字什麼都沒找到。試試遊戲真正的名字，而不是 egg 的名字。',
    'why_no_name' => '沒有可搜的內容。',
    'why_no_token' => 'Twitch 不肯發權杖。核對一下「憑證」裡的 client ID 和 secret。',
    'why_not_configured' => 'IGDB 需要一個 Twitch client ID 和 secret。到「憑證」裡填上。',
    'why_empty' => '回應是空的。',
    'why_large' => '那張圖比一個圖示大得多，沒有儲存。',
    'why_not_an_image' => '回來的東西不是圖。這通常代表一個錯誤頁面用成功的狀態碼回應了。',
    'why_wrong_format' => '那張圖的格式本面板不保存。Pelican 收 PNG、JPEG 和 WebP。',
    'why_unwritable' => '圖寫不進去。檢查 storage/app/public 是不是屬於執行面板的那個使用者，以及 php artisan storage:link 有沒有跑過。',
    'why_unknown' => '沒成，而這個原因不在這裡叫得出名字的那幾種裡。',

    // ---- 一次全做 ---------------------------------------------------------
    'bulk' => '把缺的都抓回來',
    'bulk_confirm_steam' => '對每一個沒有圖、也沒被鎖定的 egg，照名字去 Steam 搜。鎖定的 egg 和已經有圖的 egg 會被繞開。這件事在背景跑 —— 做完會告訴你。',
    'bulk_confirm_both' => '對每一個沒有圖、也沒被鎖定的 egg，照名字去 Steam 搜，Steam 找不到的再去試 IGDB。鎖定的 egg 和已經有圖的 egg 會被繞開。這件事在背景跑 —— 做完會告訴你。',

    'bulk_started' => '正在背景抓',
    'bulk_started_body' => '面板大的話可能要好幾分鐘。做完會有通知，你可以離開這一頁。',

    'bulk_done' => 'egg 圖片完成',
    'bulk_done_body' => '抓到 :fetched 個，繞開 :skipped 個，:failed 個沒找到。一個 egg 被繞開，是因為它被鎖定了或者本來就有圖。',

    'bulk_failed' => '批次抓沒有跑起來',
    'bulk_failed_queue' => '它交不到佇列上。這需要一個 queue worker —— 檢查 pelican-queue 是不是在跑。',

    // ---- IGDB 憑證 ---------------------------------------------------------
    'credentials' => '憑證',
    'credentials_helper' => 'Steam 不需要這裡的任何東西。這些只給 IGDB 用，而 IGDB 涵蓋的是 Steam 從沒聽過的遊戲 —— Minecraft 和它的每一個分支、所有在主機上發行的，以及大部分帶 mod 的 egg。',
    'credentials_where' => '到 dev.twitch.tv/console 建一個應用程式，產生一個 client secret，然後把兩樣都貼到這裡。這是免費的。',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => '憑證已儲存',
    'credentials_failed' => '憑證沒能儲存',
];
