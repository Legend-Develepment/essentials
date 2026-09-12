<?php

/*
 * 简体中文。手写。
 *
 * 账单：单据本身、列出它们的页面，以及邮件。
 *
 * 三种读者共用这个文件。管理员看表格并按“标为已付”；客户看能打印的单据和邮件；而
 * 单据本身，几个月后由记账的人来看。doc_ 那些行写得干巴巴、公事公办，正是为了最后
 * 这位：账单不是用面板别处那种口气的地方。
 */

return [
    'title' => '账单',
    'nav_label' => '账单',
    'subheading' => '欠着的和已付的。在这里标为已付，会做付款会做的一切：服务器建出来，停掉的回来。',

    // ---- 表格 ------------------------------------------------------------
    'column_number' => '账单',
    'column_customer' => '客户',
    'column_order' => '订单',
    'column_total' => '合计',
    'column_state' => '状态',
    'column_due' => '到期',

    'kind_order' => '首张账单',
    'kind_renewal' => '续费',
    'kind_credit' => '退款单',
    'kind_upgrade' => '套餐变更',
    'kind_topup' => '充值',
    'kind_addon' => '附加项',

    'state_unpaid' => '未付',
    'state_paid' => '已付',
    'state_cancelled' => '已作废',

    'no_order' => '无订单',
    'order_count' => ':count 项服务',
    'no_due' => '无日期',
    'gone_customer' => '账号已删除',
    'discount_of' => '用 :code 减 :amount',
    'paid_via' => '经 :how',
    'column_attempts' => '支付',
    'paid_by' => '由 :how 付讫',
    'paid_by_unknown' => '已付',
    'paid_by_manual' => '手工',
    'paid_by_free' => '无需支付',
    'attempts_none' => '没试过',
    'attempts_open' => '试了 :count 次 - :how',
    'attempt_last' => '最后一次 :when，:state',
    'attempt_open' => '没走完',
    'attempt_paid' => '已付',
    'attempt_cancelled' => '已取消',
    'attempt_failed' => '失败',
    'emailed' => '已发送',
    'not_emailed' => '未发送',
    'filter_overdue' => '已逾期',

    // ---- 按钮 ------------------------------------------------------------
    'open' => '打开',
    'mark_paid' => '标为已付',
    'mark_paid_confirm' => '记下钱已经到账。服务器建出来，停掉的重新跑，下一次到期日往后推，和支付服务商通知过来时一模一样。',
    'paid' => '已标为已付',
    'paid_body' => '等着这张账单的事都已经动起来了。',
    'already_paid' => '它本来就已经付了',

    'withdraw' => '作废',
    'withdraw_confirm' => '把账单从账上拿掉。只有未付的能作废；已付的账单是钱易手的记录本身。',
    'withdrawn' => '已作废',
    'withdraw_refused' => '只有未付的账单能作废',

    'empty' => '还没有账单',
    'empty_body' => '一有人买就写出一张，之后凡是续费的，每个周期再写一张。',

    // ---- 单据 ------------------------------------------------------------
    'doc_title' => '账单',
    'doc_number' => '编号',
    'doc_issued' => '开具日期',
    'doc_due' => '付款期限',
    'doc_paid_on' => '付款日期',
    'doc_billed_to' => '付款方',
    'doc_from' => '开票方',
    'doc_vat' => '增值税号',
    'doc_coc' => '工商登记号',
    'doc_description' => '项目',
    'doc_amount' => '金额',
    'doc_subtotal' => '小计',
    'doc_discount' => '折扣',
    'doc_total' => '合计',
    'doc_how_to_pay' => '如何付款',
    'doc_print' => '打印或存为 PDF',
    'doc_back' => '返回面板',

    // ---- 邮件 ------------------------------------------------------------
    'mail_subject' => '账单 :number',
    'mail_hello' => ':name，你好：',
    'mail_intro' => '这是账单 :number。',
    'mail_open' => '打开账单',
    'mail_foot' => '这张账单随时都能在你的账单页面上重新查看。',

    // ---- 提醒 ------------------------------------------------------------
    'bell_new' => '账单 :number',
    'bell_new_body' => '有 :total 待付。打开账单页面去支付。',
    'bell_reminder' => '账单 :number 已经逾期',
    'bell_reminder_body' => '它还有 :total 没付。到那天还没付清的话，它付的那台服务器会在 :date 停掉，而停掉的时候上面什么都不会删。',
];
