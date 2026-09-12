<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * Palworld 的世界設定，做成一個頁面而不是一個檔案。
 *
 * 這裡沒有任何一項設定的名字。那一頁上的每個標籤，都是從伺服器自己檔案裡的鍵推出來
 * 的；為什麼一份名字清單會比一個都沒有更糟，見
 * Support\Palworld\Palworld::label()。
 *
 * 「Pal」和「guild」是遊戲裡的說法，保留原文。
 */

return [
    'title' => 'Palworld 設定',
    'nav_label' => 'Palworld',
    'subheading' => '來自這臺伺服器自己的 PalWorldSettings.ini 的世界設定，在你打開這一頁時讀進來。只有伺服器停著時才能改。',

    'reload' => '重新讀一次檔案',

    'save_confirm' => '會用這些值重寫這個檔案。這一頁沒顯示出來的每一項設定，連同檔案裡的其餘一切，都會原樣寫回去。',
    'saved' => '設定已儲存',
    'saved_body' => '下次伺服器啟動時生效。',
    'save_failed' => '沒能寫入檔案',

    'running' => '伺服器正在執行',
    'running_body' => 'Palworld 把這些設定放在記憶體裡，停下來時再把檔案寫出去，所以現在儲存的改動會被一聲不響地抹掉。先停下伺服器。',

    'groups' => [
        'server' => '伺服器與連線',
        'world' => '世界與倍率',
        'pals' => 'Pal',
        'players' => '玩家',
        'building' => '建造、物品與採集',
        'guild' => '公會',
        'other' => '其他',
    ],
];
