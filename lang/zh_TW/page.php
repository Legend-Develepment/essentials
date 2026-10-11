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
    'secret_kept' => '已儲存。留空則保留，輸入新的值則取代。',
    'update_background' => '它在背景執行，要一兩分鐘。',

    /*
     * queue worker 和 scheduler，所有背景工作和排程工作都靠它們。
     * 分開寫，因為它們各自會出岔子，救法也各不相同。
     */
    'worker_missing' => '沒有 queue worker 回應。modpack 安裝、郵件和其他背景工作都是排進佇列、由一個 worker 行程去做的，所以在有 worker 跑起來之前，它們只會被記下而從不執行，而且哪裡都不會有錯誤。要嘛是根本沒有 worker，要嘛是有一個在這個外掛裝上之前就啟動了、載入不了它的程式碼，兩種情況都靠在面板所在的機器上重新啟動它來解決。把它的服務設成會自己重啟，否則每次更新之後這條又會回來。',
    'cron_missing' => '面板的排程器已經 :for 分鐘沒跑了。續約和 watchdog 檢查都等著它。cron 那一行寫在 Pelican 的文件裡。',

    /*
     * 照原因而不是照症狀命名，因為症狀是「什麼都沒發生」，而這正是它難以歸位的地方：
     * 公告、導覽連結、儲存的樣式和頁面排版，全都是 storage/app 底下的檔案，一個面板寫
     * 不進去的目錄會讓這些一聲不響地全部不見。
     */
    'storage_failed' => '面板寫不進它的 storage 目錄，所以這一次沒有儲存。檢查 storage/app 是不是屬於執行面板的那個使用者。原因在 storage/logs 裡。',
];
