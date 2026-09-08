<?php

/*
 * 繁體中文。手寫。
 *
 * 方案：別人可以買下的伺服器。
 *
 * 讀這裡的是打理商店的人。這裡的每個詞都是關於範本和價格的；顧客看見的話在
 * shop.php 裡，因為同一行東西，兩種讀者要的句子並不一樣。
 *
 * 「egg」「node」「swap」「io」和 Minecraft 的詞保持英文：它們是 Pelican 自己的
 * 建立伺服器表單裡的詞，而一個方案就是那張表單，先填好存起來留著以後用。
 */

return [
    'title' => '方案',
    'nav_label' => '方案',
    'subheading' => '賣的東西。每一個都是帶價格的伺服器範本；顧客買下一個，面板就建出伺服器。',

    // ---- 表格 ------------------------------------------------------------
    'column_name' => '方案',
    'column_egg' => 'Egg',
    'column_price' => '價格',
    'column_stock' => '庫存',
    'column_live' => '販售中',
    'column_orders' => '已售',

    'live' => '販售中',
    'offline' => '未販售',
    'no_egg' => '沒有 egg — 建不出來',

    'stock_unlimited' => '不限',
    'stock_left' => '還剩 :count 個',
    'stock_out' => '已售完',

    // ---- 週期 ------------------------------------------------------------
    'period_once' => '一次性',
    'period_month' => '按月',
    'period_quarter' => '按季',
    'period_year' => '按年',

    // 跟在價格後面：「€12.50 / 月」。
    'per_once' => '一次性',
    'per_month' => '/ 月',
    'per_quarter' => '/ 季',
    'per_year' => '/ 年',

    // ---- 操作 ------------------------------------------------------------
    'new' => '新增方案',
    'edit' => '編輯',
    'duplicate' => '複製',
    'copy_suffix' => '（副本）',
    'go_live' => '開始販售',
    'go_offline' => '停止販售',
    'delete' => '刪除',
    'delete_confirm' => '移除這個方案。已經買下的不受影響 — 每筆訂單自己留著當時的副本。',
    'delete_refused' => '沒有刪除',
    'delete_refused_body' => '這個方案已經有訂單，那些訂單指向它。更好的做法是停止販售；它留下來供對帳，誰也買不了。',
    'deleted' => '已刪除方案',
    'saved' => '已儲存方案',
    'save_failed' => '方案沒能儲存',
    'price_invalid' => '這不是金額。寫成 12.50 或 12,50。',

    // ---- 表單：它是什麼 --------------------------------------------------
    'section_basics' => '方案',
    'section_basics_helper' => '顧客在卡片上看到的東西。',
    'name' => '名稱',
    'name_helper' => '它在商店裡的叫法。',
    'slug' => '網址',
    'slug_helper' => '小寫字母、數字和連字號。留空就由名稱產生。以後再改，會讓別人存下的連結失效。',
    'description' => '說明',
    'description_helper' => '名稱下面的幾行字。純文字。',
    'live_field' => '販售中',
    'live_helper' => '關掉，方案就留在這裡，誰也看不到。沒有 egg 的方案永遠不會露面，不管這裡怎麼寫。',
    'sort' => '排序',
    'sort_helper' => '數字小的在商店裡排在前面。',

    // ---- 表單：它會變成什麼 ----------------------------------------------
    'section_server' => '它會變成的伺服器',
    'section_server_helper' => '和手動建伺服器時 Pelican 問的一樣，在這裡答一次，每次賣出都照著用。',
    'egg' => 'Egg',
    'egg_helper' => '選一個，就會用該 egg 的預設值填好映像檔、啟動指令和每個變數。之後想改哪裡都行。',
    'image' => 'Docker 映像檔',
    'image_helper' => 'egg 提供的映像檔之一。',
    'image_default' => 'egg 的第一個映像檔',
    'startup' => '啟動指令',
    'startup_helper' => 'egg 提供的指令之一。',
    'startup_default' => 'egg 的第一條指令',
    'environment' => '變數',
    'environment_helper' => 'egg 的變數和它們的值。egg 有而這裡沒列出的，會在建伺服器時取各自的預設值。',
    'env_key' => '變數',
    'env_value' => '值',
    'nodes' => 'Node',
    'nodes_helper' => '這個方案的伺服器可以建在哪裡 — 按這個順序一個個試，直到某個還有空位址。一個都不勾，就是哪個 node 都行。',

    // ---- 表單：限額 ------------------------------------------------------
    'section_limits' => '限額',
    'section_limits_helper' => '伺服器拿到的東西。和 Pelican 自己的建立伺服器表單同樣的欄位、同樣的單位。',
    'memory' => '記憶體',
    'disk' => '硬碟',
    'cpu' => 'CPU',
    'cpu_helper' => '相對一個核心的百分比：100 是一個核心，200 是兩個，0 是不限。',
    'swap' => 'Swap',
    'swap_helper' => '0 是沒有，-1 是不限。',
    'io' => '區塊 IO 權重',
    'io_helper' => 'Pelican 的預設值是 500。除非知道為什麼要改，否則保持原樣。',
    'threads' => 'CPU 綁定',
    'threads_helper' => '綁到哪幾個核心，按 Pelican 的寫法：0,1 或 0-3。留空就是任意。',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => '記憶體耗盡時，核心可不可以停掉這台伺服器。',
    'databases' => '資料庫',
    'allocations' => '額外 allocation',
    'backups' => '備份',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- 表單：錢 --------------------------------------------------------
    'section_price' => '價格與庫存',
    'section_price_helper' => '用商店的貨幣寫，貨幣在「商店設定」頁裡定。未稅 — 稅會作為單獨一行加到帳單上。',
    'price' => '價格',
    'price_helper' => '每個週期。寫成 12.50 或 12,50。',
    'setup_fee' => '開通費',
    'setup_fee_helper' => '只在第一張帳單上收一次。不收就填 0。',
    'period' => '計費',
    'period_helper' => '一次性的付一次就一直歸他。其餘的每個週期出一張新帳單；沒付的，過了「商店設定」頁裡的寬限天數就會停機。',
    'stock' => '庫存',
    'stock_helper' => '同時最多能賣出多少份，未取消的訂單都算在內。留空就是不限。',
    'term' => '最短期限',
    'term_helper' => '買下之後要被綁住多久。零是沒有約束：他可以取消，到已經付過的那個週期結束時就停。',
    'term_unit' => '按什麼算',
    'term_unit_helper' => '天、月或年。取消掉的訂單會跑到這個期限結束，伺服器在那天被刪除。',
    'unit_day' => '天',
    'unit_month' => '月',
    'unit_year' => '年',
    'term_day' => '最短期限：:count 天',
    'term_month' => '最短期限：:count 個月',
    'term_year' => '最短期限：:count 年',
    'section_art' => '圖片',
    'section_art_helper' => '方案卡片上的那張圖，商店裡和客戶的服務頁上都用它。兩個都留空，就用 egg 自己的圖，多數方案本來就有。',
    'art_file' => '上傳一張圖',
    'art_file_helper' => '寬的比高的好：卡片會按 16:9 裁。最大 8 MB。',
    'art_url' => '或者一個圖片位址',
    'art_url_helper' => '一個完整的 https 位址。上面沒上傳東西時才用它。',

    'empty' => '還沒有方案',
    'empty_body' => '建一個，一開始販售它就出現在商店裡。',
];
