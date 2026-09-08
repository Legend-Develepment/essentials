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

    'empty' => '還沒有人買過東西',
    'empty_body' => '一有人買方案，訂單就會出現在這裡。',
];
