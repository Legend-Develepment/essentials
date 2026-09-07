<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 「modpack」「mod」「loader」「egg」「queue worker」保留原文：Modrinth 的介面和
 * Pelican 的介面上都是這麼寫的。
 */

return [
    'nav_label' => 'Modpack',
    'title' => 'Modpack',
    'subheading' => '把一個 Modrinth 上的 modpack 裝到這臺伺服器上。',

    'section' => '找一個包',
    'section_helper' => '只有 Modrinth，也只有伺服器端的包。它不需要帳號也不需要 API 金鑰，這正是它成為這裡唯一來源的原因 —— 其他幾家都要先貼一把金鑰進去，才肯讓你看見任何東西。',

    'search' => '搜尋',
    'search_helper' => '留空就照下載量最多的排。搜尋要去問 Modrinth，所以它在你離開輸入欄時才執行，不是邊打邊搜。',

    'pack' => '包',
    'pack_helper' => '只列出聲明能在伺服器端跑的包。',

    'version' => '版本',
    'version_helper' => '遊戲版本和 loader 就寫在每一項旁邊。挑這臺伺服器的 egg 本來就在跑的那個 loader —— 這只裝檔案，不會改你的 egg，也不會改啟動指令。',

    'downloads' => '次下載',

    'install' => '安裝這個包',
    'install_go' => '裝上去',
    'install_confirm' => '包裡的檔案會被加到這臺伺服器上。**什麼都不會被刪** —— 你的世界不會，舊的 mod 不會，設定也不會。在一個包上再裝一個包，兩邊都會留著，所以要是你不想那樣，先自己把上一個包的 mod 清掉。伺服器必須是停著的，裝完也仍舊停著。',

    'started' => '正在安裝',
    'started_helper' => '正在抓包並解開。幾百個檔案要幾分鐘，裝完會有通知 —— 你離開這一頁它也會繼續。',

    'running' => '伺服器正在執行',
    'running_helper' => 'Minecraft 在啟動時載入它的 mod，所以現在裝的包會讓伺服器在重新啟動之前既不是舊包也不是新包。先停下它，再試一次。',

    'done' => '已安裝 :pack',
    'done_body' => '抓了 :files 個檔案，並把包自己資料夾裡的 :overrides 項放到位。準備好了就啟動伺服器。',
    'done_refused' => '有 :count 個檔案被跳過了，因為包要求從這裡不會去下載的地方抓它們。',

    'failed' => '這個包沒有裝上',
    'failed_fetch' => '包抓不到或解不開。可能是 daemon 連不上，也可能是伺服器磁碟不夠了。',
    'failed_index' => '包抓到了，但裡面沒有可讀的索引，所以沒有東西可裝。',
    'failed_version' => '那個版本已經沒有可下載的包檔了。換一個吧。',
    'failed_queue' => '安裝排不進佇列。這需要面板上有一個在跑的 queue worker。',
];
