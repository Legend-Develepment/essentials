<?php

/*
 * 简体中文。手写。
 *
 * 订单：谁买了什么，以及后来怎么样了。
 *
 * 下面四个状态说的是钱，不是服务器。服务器此刻在不在跑，那是 Pelican 自己的问题，
 * 由它自己的页面回答。这里的词把两件事分开。
 */

return [
    'title' => '订单',
    'nav_label' => '订单',
    'subheading' => '所有卖出去的东西、由此建出的服务器，以及现在的情况。',

    // ---- 表格 ------------------------------------------------------------
    'column_order' => '订单',
    'column_customer' => '客户',
    'column_package' => '套餐',
    'column_server' => '服务器',
    'column_state' => '状态',
    'column_due' => '下次到期',

    'no_server' => '还没建出来',
    'no_due' => '一次性',
    'gone_customer' => '账号已删除',
    'gone_package' => '套餐已删除',
    'overdue_days' => '已逾期 :days 天',

    'state_pending' => '等待中',
    'state_active' => '使用中',
    'state_suspended' => '已停',
    'state_cancelled' => '已取消',

    // ---- 按钮 ------------------------------------------------------------
    'retry' => '重新创建',
    'retry_confirm' => '把创建再排一次队。其他什么都不变，账单仍然是已付。',
    'retrying' => '已排队',

    'suspend' => '停服',
    'suspend_confirm' => '用 Pelican 自己的暂停停掉服务器。文件、数据库和备份都留在原处，账单一付清就解除。',
    'suspended' => '已停',

    'unsuspend' => '解除停服',
    'unsuspended' => '又跑起来了',

    'change_due' => '改到期日',
    'change_due_helper' => '下一张账单什么时候写。留空就是永不：订单在没有被取消的情况下不再续费。',

    'cancel' => '取消',
    'cancel_confirm' => '服务运行到 :date，之后不再计费。到那天，服务器连同上面的东西一起被删除。这两件事现在就会告诉客户。',
    'cancelled' => '已取消',

    'saved' => '已保存',
    'refused' => '什么都没变',
    'refused_body' => '这笔订单不在能这么做的状态。刷新页面再看一眼。',

    // ---- 客户收到的通知 --------------------------------------------------
    'bell_ready' => '你的服务器准备好了',
    'bell_ready_body' => ':server 已经创建，等你启动。',
    'bell_suspended' => '你的服务器被停了',
    'bell_suspended_body' => '有一张账单过了宽限期还没付。付清后服务器会重新跑起来；什么都没删。',

    // ---- 管理员收到的通知 ------------------------------------------------
    'bell_failed' => '订单 :number 没能建出来',
    'no_allocation' => '这个套餐里没有一个 node 还有空的 allocation。加一个再重新创建。',
    'no_reason' => '面板拒绝了，但没说为什么。',
    'not_paid' => '这笔订单名下没有已付的账单，所以什么也没建。如果确实付过，那说明付款那张账单上没有列出这笔订单 - 去找管这个面板的人说一声。',

    // ---- 由此建出的服务器 ------------------------------------------------
    'server_description' => '在商店购买，订单 :number。',
    'server_fallback' => '服务器',
    'state_ending' => '即将结束',
    'ends_on' => ':date 结束',
    'no_more_dues' => '不再出账单',
    'cancel_confirm_open' => '现在就停掉续费，并把库存的位置还回去。服务器留着跑：这个套餐没有最短期限，所以也没有一个要跑到的日子。等客户不用了，去 Pelican 里把服务器删掉。',
    'terminate' => '停掉并删除',
    'terminate_heading' => '删除这台服务器？',
    'terminate_confirm' => '服务器现在就删掉，连同它的文件、数据库和备份。没有撤销，也不等合约走完。如果客户应该留到当初给他的那个日子，请改用取消。',
    'terminate_go' => '删掉它',
    'terminated' => '已删除',
    'terminated_body' => '服务器没了，这笔订单也结束了。',
    'bell_ending' => '你的 :package 将在 :date 结束',
    'bell_ending_open' => '你的 :package 已被取消',
    'bell_ending_body' => '以后不会再为它开账单。服务器停下的时候，上面的东西会全部删除，想留的先备份出来。',
    'bell_ended' => '你的 :package 已经结束',
    'bell_ended_body' => '合约到期了，服务器已经被删除。',
    'bell_undeleted' => '订单 :number 没能删除',
    'bell_undeleted_body' => '面板拒绝删除这台服务器。订单已经结束，谁也不会再为它付钱，但服务器还在那儿，得到 Pelican 里去把它移除。',
    'bell_undelivered' => '订单 :number 的文件还在这里',
    'bell_undelivered_body' => '服务器建出来了，但客户上传的文件没能放进去。它还留在面板的存储里，原因写在 storage/logs 里。',
    'by_customer' => '客户结束的',
    'by_admin' => '我们结束的',
    'filter_by' => '谁结束的',
    'details' => '详情',
    'details_of' => '订单 :number',
    'close' => '关闭',
    'detail_package' => '套餐',
    'detail_placed' => '下单',
    'detail_built' => '服务器建好',
    'detail_due' => '下次到期',
    'detail_ends' => '结束',
    'detail_suspended' => '已停',
    'detail_cancelled' => '已取消',
    'detail_file_in' => '文件已放入',
    'detail_file_waiting' => '文件',
    'detail_file_waiting_value' => '已上传，等服务器建出来。',
    'detail_note' => '上次的问题',

    'empty' => '还没有人买过东西',
    'empty_body' => '一有人买套餐，订单就会出现在这里。',

    // ---- 续费 ------------------------------------------------------------
    'filter_late' => '有账单欠着',
    'run_renewals' => '现在就跑续费',
    'run_renewals_confirm' => '做的就是夜里那一遍做的事：给快到期的写出下一张账单，并停掉那些账单过了宽限期还没付的服务器。',
    'renewals_queued' => '已排队',
    'renewals_queued_body' => '它在队列里跑。过一会儿刷新就能看到变了什么。',
];
