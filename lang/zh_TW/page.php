<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 設定頁本身的框架，以及更新那一攤事。
 *
 * 「queue worker」「cron」「storage」保留原文：你會在伺服器上照這些名字去找它們。
 */

return [
    'title' => 'Essentials 設定',
    'nav_label' => 'Essentials 設定',
    'save' => '儲存',
    'saved' => '設定已儲存',
    'save_failed' => '沒能儲存設定',
    'update' => '更新',
    'update_available' => '有新版本',
    'update_confirm' => '面板會下載新版本、重建資源並清空快取。你的設定會保留。',
    'update_started' => '更新已開始',
    'update_background' => '它在背景執行，要一兩分鐘。',
    'update_failed' => '沒能更新佈景主題',
    'update_done' => '佈景主題已更新',
    'check' => '檢查更新',
    'check_failed' => '讀不到更新資訊',
    'check_failed_body' => '面板連不上它，或者它回的不是有效的 JSON。',
    'up_to_date' => '你用的已是最新版本',
    'reinstall' => '重新安裝',

    'auto_on' => '更新會自己裝上',

    /*
     * 上一次自動檢查做了什麼。每一句都點出該去看的那個部分，因為從瀏覽器裡看，這件事
     * 出岔子的三種方式長得一模一樣：一個在往下數的數字。
     */
    'auto_never' => '還沒有跑過一次檢查。自動更新需要面板的排程器 —— 那條每分鐘執行 php artisan schedule:run 的 cron。沒有它，任何排定的事情都不會發生。',
    'auto_ago' => '上次檢查在 :ago',
    'auto_just_now' => '剛剛',
    'auto_minutes' => '分鐘前',
    'auto_current' => '這個通道上沒有更新的了。',
    'auto_installed' => 'v:version 是在這裡裝上的，由那次排定的檢查自己動手。沒有 queue worker 回應時它就會這麼做，所以更新照樣會發生 —— 但一個沒有 worker 的面板，佇列裡的其他工作同樣也沒在做。',
    'auto_queued' => 'v:version 已交給 queue worker。如果上面的版本在幾分鐘內沒變，表示 worker 在接工作，只是這一件做不成 —— 通常重新啟動它就能解決，原因在 storage/logs 裡。',
    'auto_unreachable' => '讀不到更新資訊。它是從網際網路上抓的，所以通常是面板所在機器的網路或 DNS 問題。',
    'auto_error' => '檢查失敗了。原因在 storage/logs 裡。',

    /*
     * 真正執行更新的是 queue worker。和上面的檢查分開寫，因為它們各自會出岔子，救法也
     * 各不相同。
     */
    'worker_missing' => '沒有 queue worker 回應。更新和 modpack 安裝都是排進佇列、由一個 worker 行程去做的，所以在有 worker 跑起來之前，它們只會被記下而從不執行，而且哪裡都不會有錯誤。要嘛是根本沒有 worker，要嘛是有一個在這個外掛裝上之前就啟動了、載入不了它的程式碼 —— 兩種情況都靠在面板所在的機器上重新啟動它來解決。把它的服務設成會自己重啟，否則每次更新之後這條又會回來。',

    'next_check' => '距下次檢查',
    'due_now' => '就要到了',

    /*
     * 照原因而不是照症狀命名，因為症狀是「什麼都沒發生」，而這正是它難以歸位的地方：
     * 公告、導覽連結、儲存的樣式和頁面排版，全都是 storage/app 底下的檔案，一個面板寫
     * 不進去的目錄會讓這些一聲不響地全部不見。
     */
    'storage_failed' => '面板寫不進它的 storage 目錄，所以這一次沒有儲存。檢查 storage/app 是不是屬於執行面板的那個使用者。原因在 storage/logs 裡。',

    /*
     * 每次更新失敗後都說，而不只在對不上時才說。上面那句已經點出了原因，這一句點出的
     * 是人從「本該是 X，拿到的是 Y」裡推不出來的那唯一一個救法。
     */
    'update_renamed' => '如果它說兩個 id 對不上，那就是外掛被改過名，而更新跨不過這道坎 —— Pelican 是靠 id 認出一個已安裝外掛的。到 管理 → 外掛 裡把舊的那一項移除，再把這個重新裝上。你的設定不會不見：它們在 .env 和 storage/app/private/legend-theme 裡，兩處都不是照 id 來存的。',
];
