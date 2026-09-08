<?php

/*
 * 繁體中文。手寫。
 *
 * 帳單：單據本身、列出它們的頁面，以及郵件。
 *
 * 三種讀者共用這個檔案。管理員看表格並按「標為已付」；客戶看能列印的單據和郵件；而
 * 單據本身，幾個月後由記帳的人來看。doc_ 那些行寫得乾巴巴、公事公辦，正是為了最後
 * 這位 — 帳單不是用面板別處那種口氣的地方。
 */

return [
    'title' => '帳單',
    'nav_label' => '帳單',
    'subheading' => '欠著的和已付的。在這裡標為已付，會做付款會做的一切：伺服器建出來，停掉的回來。',

    // ---- 表格 ------------------------------------------------------------
    'column_number' => '帳單',
    'column_customer' => '客戶',
    'column_order' => '訂單',
    'column_total' => '合計',
    'column_state' => '狀態',
    'column_due' => '到期',

    'kind_order' => '首張帳單',
    'kind_renewal' => '續約',

    'state_unpaid' => '未付',
    'state_paid' => '已付',
    'state_cancelled' => '已作廢',

    'no_order' => '無訂單',
    'no_due' => '無日期',
    'gone_customer' => '帳號已刪除',
    'discount_of' => '用 :code 減 :amount',
    'paid_via' => '經 :how',
    'emailed' => '已寄出',
    'not_emailed' => '未寄出',
    'filter_overdue' => '已逾期',

    // ---- 按鈕 ------------------------------------------------------------
    'open' => '開啟',
    'mark_paid' => '標為已付',
    'mark_paid_confirm' => '記下錢已經入帳。伺服器建出來，停掉的重新跑，下一次到期日往後推 — 和金流商通知過來時一模一樣。',
    'paid' => '已標為已付',
    'paid_body' => '等著這張帳單的事都已經動起來了。',
    'already_paid' => '它本來就已經付了',

    'withdraw' => '作廢',
    'withdraw_confirm' => '把帳單從帳上拿掉。只有未付的能作廢；已付的帳單是錢易手的紀錄本身。',
    'withdrawn' => '已作廢',
    'withdraw_refused' => '只有未付的帳單能作廢',

    'empty' => '還沒有帳單',
    'empty_body' => '一有人買就寫出一張，之後凡是續約的，每個週期再寫一張。',

    // ---- 單據 ------------------------------------------------------------
    'doc_title' => '帳單',
    'doc_number' => '編號',
    'doc_issued' => '開立日期',
    'doc_due' => '付款期限',
    'doc_paid_on' => '付款日期',
    'doc_billed_to' => '付款方',
    'doc_from' => '開立方',
    'doc_description' => '項目',
    'doc_amount' => '金額',
    'doc_subtotal' => '小計',
    'doc_discount' => '折扣',
    'doc_total' => '合計',
    'doc_how_to_pay' => '如何付款',
    'doc_print' => '列印或存成 PDF',
    'doc_back' => '返回面板',

    // ---- 郵件 ------------------------------------------------------------
    'mail_subject' => '帳單 :number',
    'mail_hello' => ':name，你好：',
    'mail_intro' => '這是帳單 :number。',
    'mail_open' => '開啟帳單',
    'mail_foot' => '這張帳單隨時都能在你的帳單頁面上重新查看。',

    // ---- 提醒 ------------------------------------------------------------
    'bell_new' => '帳單 :number',
    'bell_new_body' => '有 :total 待付。開啟帳單頁面去付款。',
    'bell_reminder' => '帳單 :number 已經逾期',
    'bell_reminder_body' => '它還有 :total 沒付。到那天還沒付清的話，它付的那臺伺服器會在 :date 停掉，而停掉的時候上面什麼都不會刪。',
];
