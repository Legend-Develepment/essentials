<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 伺服器頁面上的那條操作列。它自成一個檔案，而不是 settings.php 的一角，因為讀它的
 * 是在用面板的人，不是在設定佈景主題的人。
 *
 * 按鈕旁邊的狀態用的是 Pelican 自己的說法，取自 ContainerStatus 列舉，所以這條列和
 * 主控台頁面永遠不會對一臺伺服器正在做什麼各說各話。
 *
 * 「Kill」不譯：Pelican 的按鈕上和 Docker 裡都是這個字，換成譯名反而要查兩遍。
 */

return [
    'console' => '主控台',
    'full_page' => '新視窗',
    'close' => '關閉',

    'start' => '啟動',
    'restart' => '重新啟動',
    'stop' => '停止',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill 會就地停住容器。伺服器還沒寫進磁碟的東西都會不見。要繼續嗎？',

    'sent_title' => '電源操作',
    'sent_body' => '已將 :action 傳送至 :name。',
    'failed' => '無法連線至節點。',
];
