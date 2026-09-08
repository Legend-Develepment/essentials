<?php

/*
 * 简体中文。手写。
 *
 * 商店的设置，以后还有商店本身。
 *
 * 两种读者共用这个文件是有意为之。设置那一半由管理员读；公开页和顾客那一半 -
 * 随着商店长大再往里加 - 由那些也许根本没听说过 Pelican 的人读，那边的每一句都
 * 要为他们而写。
 */

return [
    'title' => '商店设置',
    'nav_label' => '商店设置',
    'subheading' => '货币、税、账单编号，以及公开页上说的话。卖的东西本身在“套餐”页里。',

    // ---- 在哪里 ----------------------------------------------------------
    'address' => '公开商店在',
    'address_off' => '公开页已关闭。在 Essentials 设置页的功能列表里打开“公开商店页”，:url 就会有响应。',

    // ---- 通用 ------------------------------------------------------------
    'section_general' => '钱',
    'section_general_helper' => '整个商店只用一种货币。每个套餐的每个价格，都是这种货币下的一个数。',
    'currency' => '货币',
    'currency_helper' => '换货币不会换算任何东西：套餐价格就是数字，换完之后它们就是新货币下的数字。',
    'tax' => '税',
    'tax_helper' => '作为单独一行加到每张账单上的百分比。套餐价格是不含税的。不收就填 0。',
    'tax_suffix' => '%',
    'prefix' => '账单编号以此开头',
    'prefix_helper' => '后面跟一个递增的号码。INV- 得到 INV-000001。',

    // ---- 续费 ------------------------------------------------------------
    'section_renewals' => '续费',
    'section_renewals_helper' => '给按月、按季、按年计费的套餐用。一次性的套餐永远不受这里影响。',
    'notice_days' => '周期结束前多少天出账单',
    'notice_days_helper' => '下一张账单什么时候生成、顾客什么时候收到通知。',
    'grace' => '账单到期后多少天停服',
    'grace_helper' => '超过这个天数还没付的账单会停掉服务器 — 用的是 Pelican 自己的暂停，账单一付清就解除。商店从不删除任何东西。',
    'days' => '天',

    // ---- 公开页 ----------------------------------------------------------
    'section_public' => '公开页',
    'section_public_helper' => '没有账号的人也会读。它到底出不出现，由功能列表里的“公开商店页”开关决定。',
    'heading' => '标题',
    'heading_helper' => '留空就用面板自己的名字。',
    'note' => '套餐上方的一行字',
    'note_helper' => '用来说你是谁，或者买了能得到什么。纯文本。',
    'terms_url' => '条款',
    'terms_url_helper' => 'https 地址。填了以后，购买就意味着勾选一个指向它的方框。',

    // ---- 手动付款 --------------------------------------------------------
    'section_manual' => '没有支付服务商时的付款方式',
    'section_manual_helper' => '在一个支付服务商都没开的时候，显示在未付账单上：银行信息，或者钱该打到哪里。纯文本。',
    'pay_note' => '怎么付款',
    'pay_note_helper' => '留空的话，未付账单就只说它还没付。',

    // ---- 按钮 ------------------------------------------------------------
    'save' => '保存',
    'saved' => '已保存',
    'save_failed' => '什么都没保存',

    /* ---------------------------------------------------------------------
     * 从这里往下是商店本身。
     *
     * 完全另一种读者：来买服务器的人，也许根本没听说过 Pelican，也不知道 egg 是
     * 什么。下面没有一处用面板的词，每一句都回答顾客在页面那个位置真正会有的疑问。
     * ------------------------------------------------------------------- */

    // ---- 商店 ------------------------------------------------------------
    'store_title' => '商店',
    'store_nav_label' => '商店',
    'store_subheading' => '挑一台服务器。账单一付清就为你建好。',
    'store_empty' => '现在没有在售的东西',
    'store_empty_body' => '过会儿再来，或者问问打理这个面板的人。',

    'buy' => '购买',
    'sold_out' => '已售罄',
    'plus_setup' => '另加一次性 :amount',

    'spec_memory' => '内存 :amount MiB',
    'spec_disk' => '硬盘 :amount MiB',
    'spec_cpu' => 'CPU :amount%',
    'spec_backups' => ':count 个备份',
    'spec_databases' => ':count 个数据库',

    // ---- 公开页 ----------------------------------------------------------
    'public_empty' => '现在没有在售的东西',
    'public_empty_body' => '过会儿再来。',
    'to_panel' => '登录',
    'terms' => '条款',
    'sign_in_note' => '在下面挑一台服务器。你登录后完成下单，账单付清就为你建好。',

    // ---- 下单 ------------------------------------------------------------
    'checkout_title' => '下单',
    'tax_line' => '税 (:rate%)',
    'coupon' => '优惠码',
    'coupon_placeholder' => '有的话就填',
    'coupon_bad' => '这个码在这儿用不了。',
    'coupon_good' => '优惠码已生效。',
    'agree' => '我同意',
    'place_order' => '提交订单',
    'place_order_note' => '这会生成一张账单。在你付款之前不会扣任何钱，服务器在账单付清后创建。',
    'back_to_store' => '回到商店',

    'placed' => '订单已提交',
    'placed_body' => '账单 :number 已经在你的账单页面上等着了。',

    'refused' => '这个买不了',
    'refused_gone' => '它已经不卖了。',
    'refused_sold_out' => '最后一个也没了。',
    'refused_bad_coupon' => '这个优惠码不适用于它。',
    'refused_failed' => '写订单的时候出了岔子。没有扣任何钱。再试一次，如果还这样就告诉打理这个面板的人。',

    // ---- 账单 ------------------------------------------------------------
    'billing_title' => '账单',
    'billing_nav_label' => '账单',
    'billing_subheading' => '你买了什么，还欠什么。',
    'your_orders' => '你的订单',
    'your_invoices' => '你的账单',
    'no_orders' => '你还没买过东西',
    'no_orders_body' => '你买的每样东西都会连同服务器和日期一起出现在这里。',
    'no_invoices' => '还没有账单',
    'to_store' => '去商店',
    'renews' => '续费于',
    'ask_how_to_pay' => '问问打理这个面板的人怎么付款。他们还没把这写在这里。',
    'order_pending' => '正在等账单付清。付清后马上就会建出服务器。',
    'order_suspended' => '因为有账单没付而停着。付清后服务器会重新跑起来 — 什么都没删。',

    // ---- 付款 ------------------------------------------------------------
    'pay_with' => '用以下方式付款',
    'pay_now' => '付款',
    'pay_description' => '账单 :number',
    'pay_thanks' => '谢谢。账单已付清。',
    'pay_pending' => '支付服务商还没确认。他们一确认，这个页面就会更新。',
    'pay_refused' => '这个没能开始',
    'pay_refused_body' => '付款打不开。换个方式试试，或者问问打理这个面板的人。',
    'gateway_mollie' => 'Mollie',

    // ---- 服务商设置 ------------------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => '用一个账户收 iDEAL、银行卡、Bancontact 和其余方式。测试和正式是同一个设置：密钥本身就说明它属于哪个账户。',
    'mollie_on' => '提供 Mollie',
    'mollie_on_helper' => '关掉会把按钮从每张账单上撤下。已经付过的仍然是已付。',
    'mollie_key' => 'API 密钥',
    'mollie_key_helper' => '在你的 Mollie 后台 Developers 一节里。它永远不会写进导出的设置文件。',
    'mollie_hook' => 'Webhook 地址',
    'mollie_hook_helper' => 'Mollie 会通知 :url — 你的面板要能从公网在那个地址被访问到。',

    'gateway_stripe' => '银行卡',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => '在 Stripe 自己画的页面上收卡，所以卡号永远不会到这个面板来。测试和正式在密钥的前缀里，不在某个开关上。',
    'stripe_on' => '提供 Stripe',
    'stripe_on_helper' => '关掉会把按钮从每张账单上撤下。已经付过的仍然是已付。',
    'stripe_key' => '私密密钥',
    'stripe_key_helper' => 'Developers 的 API keys 里以 sk_ 开头的那一个。它永远不会写进导出的设置文件。',
    'stripe_hook' => '签名密钥',
    'stripe_hook_key_helper' => '你添加下面这个地址时 Stripe 显示的 whsec_ 值。没有它就无法证明他们的通知是真的，通知会被忽略。',
    'stripe_hook_helper' => '在 Developers 的 webhooks 里把 :url 添加为 endpoint，事件选 checkout.session.completed。',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => '三家里唯一一家，钱是在顾客回来的时候才动，而不是他们还在 PayPal 上的时候。所以关掉标签页留下的是一张未付账单，不是一笔丢掉的钱。',
    'paypal_on' => '提供 PayPal',
    'paypal_on_helper' => '关掉会把按钮从每张账单上撤下。已经付过的仍然是已付。',
    'paypal_sandbox' => '沙盒',
    'paypal_sandbox_helper' => '和 PayPal 的测试账户说话，而不是真的那个。他们的 client id 两种情况下长得一样，这个开关正是因此而存在。',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => '来自你在 Apps & Credentials 里建的应用。注意那个标签页要和上面的开关对得上。',
    'paypal_secret_helper' => '在 client ID 旁边，Show 后面。它永远不会写进导出的设置文件。',
    'paypal_hook' => 'Webhook ID',
    'paypal_hook_id_helper' => '你添加 webhook 之后 PayPal 给它的 ID，不是那个地址。没有它就没法把他们的通知拿去跟他们核对，通知会被忽略。',
    'paypal_hook_helper' => '在那个应用里把 :url 添加为 webhook，事件选 PAYMENT.CAPTURE.COMPLETED，再把拿到的 ID 粘到这里。',

    // ---- 付款页 ----------------------------------------------------------
    'pay_title' => '付款',
    'pay_subheading' => '你欠多少，以及可以怎么付。',
    'pay_choose' => '你想怎么付款？',
    'pay_choose_body' => '不管选哪一个，你都在对方自己的页面上完成，然后马上回到这里。',
    'pay_safe' => '付款是在服务商那边完成的。你的卡片信息永远不会到这个面板来。',
    'pay_no_ways' => '钱一到，账单就会标为已付，你的服务器随即建好。',
    'pay_gone' => '没有这张账单',
    'pay_gone_body' => '可能是被作废了，也可能是地址不对。',
    'pay_already' => '这张已经付了',
    'pay_already_body' => '没有别的要做了。等着它的一切都已经动起来。',
    'pay_withdrawn' => '这张被作废了',
    'pay_withdrawn_body' => '它已经不在账上，不用付。如果看着不对，问问打理这个面板的人。',
    'back_to_billing' => '回到账单',

    'gateway_mollie_note' => 'iDEAL、Bancontact、银行卡等',
    'gateway_stripe_note' => 'Visa、Mastercard、American Express',
    'gateway_paypal_note' => '你的 PayPal 余额，或经由 PayPal 的银行卡',

    // ---- 服务和账单分开 --------------------------------------------------
    'services_title' => '我的服务',
    'services_nav_label' => '我的服务',
    'services_subheading' => '你正在付费的东西，以及每一项变成的服务器。',
    'open_server' => '打开服务器',
    'no_server_yet' => '正在准备',

    'invoices_title' => '账单',
    'invoices_subheading' => '给你开出的账单，以及还要付的部分。',
    'no_invoices_body' => '你买的每样东西都在这里开账单，付清之后也留在这里。',

    // ---- 把商店放在首页 --------------------------------------------------
    'section_landing' => '商店摆在哪儿',
    'section_landing_helper' => '登录的人是落在商店，还是落在自己的服务器上。',
    'landing' => '先打开商店',
    'landing_helper' => '打开后，商店就是登录后的第一页，服务器列表挪到它旁边。你的服务和账单仍然只有一步之遥 — 在商店的顶部和账号菜单里。关掉则什么都不挪，商店只是一个和其他一样的页面。',
];
