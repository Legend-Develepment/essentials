<?php

/*
 * 简体中文。手写。
 *
 * 套餐：别人可以买下的服务器。
 *
 * 读这里的是打理商店的人。这里的每个词都是关于模板和价格的；顾客看见的话在
 * shop.php 里，因为同一行东西，两种读者要的句子并不一样。
 *
 * “egg”“node”“swap”“io”和 Minecraft 的词保持英文：它们是 Pelican 自己的建服表单
 * 里的词，而一个套餐就是那张表单，先填好存起来留着以后用。
 */

return [
    'title' => '套餐',
    'nav_label' => '套餐',
    'subheading' => '卖的东西。每一个都是带价格的服务器模板；顾客买下一个，面板就建出服务器。',

    // ---- 表格 ------------------------------------------------------------
    'column_name' => '套餐',
    'column_egg' => 'Egg',
    'column_price' => '价格',
    'column_stock' => '库存',
    'column_live' => '在售',
    'column_orders' => '已售',

    'live' => '在售',
    'offline' => '未在售',
    'no_egg' => '没有 egg — 建不出来',

    'stock_unlimited' => '不限',
    'stock_left' => '还剩 :count 个',
    'stock_out' => '已售罄',

    // ---- 周期 ------------------------------------------------------------
    'period_once' => '一次性',
    'period_month' => '按月',
    'period_quarter' => '按季',
    'period_year' => '按年',

    // 跟在价格后面：“€12.50 / 月”。
    'per_once' => '一次性',
    'per_month' => '/ 月',
    'per_quarter' => '/ 季',
    'per_year' => '/ 年',

    // ---- 操作 ------------------------------------------------------------
    'new' => '新建套餐',
    'edit' => '编辑',
    'duplicate' => '复制',
    'copy_suffix' => '（副本）',
    'go_live' => '开始出售',
    'go_offline' => '停止出售',
    'delete' => '删除',
    'delete_confirm' => '移除这个套餐。已经买下的不受影响 — 每笔订单自己留着当时的副本。',
    'delete_refused' => '没有删除',
    'delete_refused_body' => '这个套餐已经有订单，那些订单指向它。更好的做法是停止出售；它留下来供对账，谁也买不了。',
    'deleted' => '已删除套餐',
    'saved' => '已保存套餐',
    'save_failed' => '套餐没能保存',
    'price_invalid' => '这不是金额。写成 12.50 或 12,50。',

    // ---- 表单：它是什么 --------------------------------------------------
    'section_basics' => '套餐',
    'section_basics_helper' => '顾客在卡片上看到的东西。',
    'name' => '名称',
    'name_helper' => '它在商店里的叫法。',
    'slug' => '地址',
    'slug_helper' => '小写字母、数字和连字符。留空就由名称生成。以后再改，会让别人存下的链接失效。',
    'description' => '说明',
    'description_helper' => '名称下面的几行字。纯文本。',
    'live_field' => '在售',
    'live_helper' => '关掉，套餐就留在这里，谁也看不到。没有 egg 的套餐永远不会露面，不管这里怎么写。',
    'sort' => '排序',
    'sort_helper' => '数字小的在商店里排在前面。',

    // ---- 表单：它会变成什么 ----------------------------------------------
    'section_server' => '它会变成的服务器',
    'section_server_helper' => '和手动建服务器时 Pelican 问的一样，在这里答一次，每次卖出都照着用。',
    'egg' => 'Egg',
    'egg_helper' => '选一个，就会用该 egg 的默认值填好镜像、启动命令和每个变量。之后想改哪里都行。',
    'image' => 'Docker 镜像',
    'image_helper' => 'egg 提供的镜像之一。',
    'image_default' => 'egg 的第一个镜像',
    'startup' => '启动命令',
    'startup_helper' => 'egg 提供的命令之一。',
    'startup_default' => 'egg 的第一条命令',
    'environment' => '变量',
    'environment_helper' => 'egg 的变量和它们的值。egg 有而这里没列出的，会在建服务器时取各自的默认值。',
    'env_key' => '变量',
    'env_value' => '值',
    'nodes' => 'Node',
    'nodes_helper' => '这个套餐的服务器可以建在哪里 — 按这个顺序一个个试，直到某个还有空地址。一个都不勾，就是哪个 node 都行。',

    // ---- 表单：限额 ------------------------------------------------------
    'section_limits' => '限额',
    'section_limits_helper' => '服务器拿到的东西。和 Pelican 自己的建服表单同样的字段、同样的单位。',
    'memory' => '内存',
    'disk' => '硬盘',
    'cpu' => 'CPU',
    'cpu_helper' => '相对一个核心的百分比：100 是一个核心，200 是两个，0 是不限。',
    'swap' => 'Swap',
    'swap_helper' => '0 是没有，-1 是不限。',
    'io' => '块 IO 权重',
    'io_helper' => 'Pelican 的默认值是 500。除非知道为什么要改，否则保持原样。',
    'threads' => 'CPU 绑定',
    'threads_helper' => '绑到哪几个核心，按 Pelican 的写法：0,1 或 0-3。留空就是任意。',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => '内存耗尽时，内核可不可以停掉这台服务器。',
    'databases' => '数据库',
    'allocations' => '额外 allocation',
    'backups' => '备份',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- 表单：钱 --------------------------------------------------------
    'section_price' => '价格与库存',
    'section_price_helper' => '用商店的货币写，货币在“商店设置”页里定。不含税 — 税会作为单独一行加到账单上。',
    'price' => '价格',
    'price_helper' => '每个周期。写成 12.50 或 12,50。',
    'setup_fee' => '开通费',
    'setup_fee_helper' => '只在第一张账单上收一次。不收就填 0。',
    'period' => '计费',
    'period_helper' => '一次性的付一次就一直归他。其余的每个周期出一张新账单；没付的，过了“商店设置”页里的宽限天数就会停服。',
    'stock' => '库存',
    'stock_helper' => '同时最多能卖出多少份，未取消的订单都算在内。留空就是不限。',

    'empty' => '还没有套餐',
    'empty_body' => '建一个，一开始出售它就出现在商店里。',
];
