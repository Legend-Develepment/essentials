<?php

/*
 * 繁體中文。手寫。
 *
 * 訂單：誰買了什麼，以及後來怎麼樣了。
 *
 * 下面四個狀態說的是錢，不是伺服器。伺服器此刻在不在跑，那是 Pelican 自己的問題，
 * 由它自己的頁面回答。這裡的詞把兩件事分開。
 */

return [
    'title' => '訂單',
    'nav_label' => '訂單',
    'subheading' => '所有賣出去的東西、由此建出的伺服器，以及現在的情況。',

    // ---- 表格 ------------------------------------------------------------
    'column_order' => '訂單',
    'column_customer' => '客戶',
    'column_package' => '方案',
    'column_server' => '伺服器',
    'column_state' => '狀態',
    'column_due' => '下次到期',

    'no_server' => '還沒建出來',
    'no_due' => '一次性',
    'gone_customer' => '帳號已刪除',
    'gone_package' => '方案已刪除',
    'overdue_days' => '已逾期 :days 天',

    'state_pending' => '等待中',
    'state_active' => '使用中',
    'state_suspended' => '已停',
    'state_cancelled' => '已取消',

    // ---- 按鈕 ------------------------------------------------------------
    'retry' => '重新建立',
    'retry_confirm' => '把建立再排一次隊。其他什麼都不變，帳單仍然是已付。',
    'retrying' => '已排隊',

    'suspend' => '停機',
    'suspend_confirm' => '用 Pelican 自己的停權停掉伺服器。檔案、資料庫和備份都留在原處，帳單一付清就解除。',
    'suspended' => '已停',

    'unsuspend' => '解除停機',
    'unsuspended' => '又跑起來了',

    'change_due' => '改到期日',
    'change_due_helper' => '下一張帳單什麼時候寫。留空就是永不 — 訂單在沒有被取消的情況下不再續約。',

    'cancel' => '取消',
    'cancel_confirm' => '停掉續約並把庫存的位置還回去。伺服器原樣留著：要刪就去 Pelican 裡刪，那才是它該待的地方。',
    'cancelled' => '已取消',

    'saved' => '已儲存',
    'refused' => '什麼都沒變',
    'refused_body' => '這筆訂單不在能這麼做的狀態。重新整理頁面再看一眼。',

    // ---- 客戶收到的通知 --------------------------------------------------
    'bell_ready' => '你的伺服器準備好了',
    'bell_ready_body' => ':server 已經建立，等你啟動。',
    'bell_suspended' => '你的伺服器被停了',
    'bell_suspended_body' => '有一張帳單過了寬限期還沒付。付清後伺服器會重新跑起來；什麼都沒刪。',

    // ---- 管理員收到的通知 ------------------------------------------------
    'bell_failed' => '訂單 :number 沒能建出來',
    'no_allocation' => '這個方案裡沒有一個 node 還有空的 allocation。加一個再重新建立。',
    'no_reason' => '面板拒絕了，但沒說為什麼。',

    // ---- 由此建出的伺服器 ------------------------------------------------
    'server_description' => '在商店購買，訂單 :number。',
    'server_fallback' => '伺服器',
    'state_ending' => '即將結束',
    'ends_on' => ':date 結束',
    'no_more_dues' => '不再出帳單',
    'cancel_confirm_open' => '現在就停掉續約，並把庫存的位置還回去。伺服器留著跑：這個方案沒有最短期限，所以也沒有一個要跑到的日子。等客戶不用了，去 Pelican 裡把伺服器刪掉。',
    'terminate' => '停掉並刪除',
    'terminate_heading' => '刪除這臺伺服器？',
    'terminate_confirm' => '伺服器現在就刪掉，連同它的檔案、資料庫和備份。沒有復原，也不等合約走完。如果客戶應該留到當初給他的那個日子，請改用取消。',
    'terminate_go' => '刪掉它',
    'terminated' => '已刪除',
    'terminated_body' => '伺服器沒了，這筆訂單也結束了。',
    'bell_ending' => '你的 :package 將在 :date 結束',
    'bell_ending_open' => '你的 :package 已被取消',
    'bell_ending_body' => '以後不會再為它開帳單。伺服器停下的時候，上面的東西會全部刪除，想留的先備份出來。',
    'bell_ended' => '你的 :package 已經結束',
    'bell_ended_body' => '合約到期了，伺服器已經被刪除。',
    'bell_undeleted' => '訂單 :number 沒能刪除',
    'bell_undeleted_body' => '面板拒絕刪除這臺伺服器。訂單已經結束，誰也不會再為它付錢，但伺服器還在那裡，得到 Pelican 裡去把它移除。',
    'bell_undelivered' => '訂單 :number 的檔案還在這裡',
    'bell_undelivered_body' => '伺服器建出來了，但客戶上傳的檔案沒能放進去。它還留在面板的儲存空間裡，原因寫在 storage/logs 裡。',
    'details' => '詳情',
    'details_of' => '訂單 :number',
    'close' => '關閉',
    'detail_package' => '方案',
    'detail_placed' => '下單',
    'detail_built' => '伺服器建好',
    'detail_due' => '下次到期',
    'detail_ends' => '結束',
    'detail_suspended' => '已停',
    'detail_cancelled' => '已取消',
    'detail_file_in' => '檔案已放入',
    'detail_file_waiting' => '檔案',
    'detail_file_waiting_value' => '已上傳，等伺服器建出來。',
    'detail_note' => '上次的問題',

    'empty' => '還沒有人買過東西',
    'empty_body' => '一有人買方案，訂單就會出現在這裡。',

    // ---- 續約 ------------------------------------------------------------
    'filter_late' => '有帳單欠著',
    'run_renewals' => '現在就跑續約',
    'run_renewals_confirm' => '做的就是夜裡那一遍做的事：給快到期的寫出下一張帳單，並停掉那些帳單過了寬限期還沒付的伺服器。',
    'renewals_queued' => '已排隊',
    'renewals_queued_body' => '它在佇列裡跑。過一會兒重新整理就能看到變了什麼。',
];
