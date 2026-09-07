<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 「系統狀態」頁：面板自己所在的那臺主機，以及你要求擺在它旁邊的任何節點。
 *
 * 在任何把兩者分開的架設裡，這都不是節點所在的那臺機器 —— 這正是它們能同處一頁的原
 * 因。
 *
 * 「Swap」「Wings」「PHP」「uptime」保留原文：機器上是這麼叫的，人們拿來對照的每樣工
 * 具裡也是。
 */

return [
    'title' => '系統狀態',
    'nav_label' => '系統狀態',
    'subheading' => '面板自己所在的那臺機器、它上面在跑什麼，以及你要求擺在它旁邊的任何節點。',

    'options' => '選項',
    'enabled' => '在側邊欄裡顯示',
    'enabled_helper' => '關掉會把那一列從側邊欄裡拿走。頁面自己的位址還在，所以隨時可以再打開。',

    'refresh' => '每隔多久重讀一次',
    'refresh_helper' => '整頁照這個間隔重新抓一次。關掉就保持你打開時的樣子。',
    'refresh_off' => '只在我打開時',
    'refresh_seconds' => ':seconds 秒',

    'blocks' => '顯示',
    'blocks_helper' => '勾起來的才顯示。磁碟是每個檔案系統一張卡，這樣一個塞滿的根分割區就不會被一個空了一半的資料掛載點擋住。',
    'block_cpu' => '處理器',
    'block_memory' => '記憶體',
    'block_swap' => 'Swap',
    'block_disk' => '磁碟',
    'block_load' => '平均負載',
    'block_uptime' => 'Uptime',
    'block_system' => '系統',
    'block_version' => '面板版本',
    // 永遠不會顯示 —— 節點的卡片用節點自己的名字 —— 但 blank() 會來要它，而一個缺失的
    // 鍵把自己的名字印出來，是個很差的墊底。
    'block_node' => '節點',

    'nodes' => '要顯示的節點',
    'nodes_helper' => '每個節點一張卡，擺在面板所在的機器旁邊。一個都不勾就一個都不顯示 —— 儀表板上本來就有一塊列著所有節點。每一個都要去問它自己的 daemon，所以短間隔加長清單就是很多次請求。',

    'section_usage' => '使用狀況',
    'section_host' => '本面板',
    'section_nodes' => '節點',

    'disk_panel' => '面板就在這裡',
    'wings' => 'Wings :version',
    'version_installed' => '已安裝',
    'version_latest' => '最新',
    'version_current' => '已是最新',
    'version_update' => '有可用更新',
    'version_unknown' => '查不到',

    /*
     * 一張落後的卡片會給出什麼。
     *
     * 給的是通往發行版的連結，而不是一個執行更新的按鈕，因為從這裡根本沒有更新可執
     * 行：Pelican 沒有升級指令，Wings 也沒有哪個端點能替換它自己的執行檔。那句提示說
     * 明真正的工作是在哪裡做的，免得有人去找一個從來就不可能存在的按鈕。
     */
    'version_release' => '有什麼新東西',
    'version_how_panel' => '開啟版本說明。升級面板要在它所在的機器上做 —— 面板換不了自己的檔案，而任何外掛都不允許執行 shell 指令。',
    'version_how_wings' => '開啟版本說明。Wings 在節點上更新 —— 面板沒有通往另一臺機器上那個程式的通道。',

    'wings_latest' => '最新 :version',
    'load_cores' => ':cores 個處理器的 :percent%',
    'load_windows' => ':five（5 分鐘）· :fifteen（15 分鐘）',
    'uptime_since' => '自 :date 起',
    'unavailable' => '這臺機器上抓不到',

    'fact_os' => '作業系統',
    'fact_hostname' => '主機名稱',
    'fact_php' => 'PHP',
    'fact_cores' => '處理器',
    'fact_processes' => '行程',
];
