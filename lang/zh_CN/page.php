<?php

/*
 * 简体中文。逐字手译。
 *
 * 设置页本身的框架，以及更新的那一摊事。
 *
 * “queue worker”“cron”“storage”保留原文：你会在服务器上按这些名字去找它们。
 */

return [
    'updating_now' => '面板正在安装更新。有些页面会有一小会儿显示得不太对。',
    'updating_done' => '更新装好了。刚才哪个页面显示得不对，重新加载一下就行。',
    'title' => 'Essentials 设置',
    'nav_label' => 'Essentials 设置',
    'save' => '保存',
    'saved' => '设置已保存',
    'save_failed' => '没能保存设置',
    'update' => '更新',
    'update_available' => '有新版本',
    'update_confirm' => '面板会下载新版本、重建资源并清空缓存。你的设置会保留。',
    'update_started' => '更新已开始',
    'update_background' => '它在后台运行，要一两分钟。',
    'update_failed' => '没能更新主题',
    'update_done' => '主题已更新',
    'check' => '检查更新',
    'check_failed' => '读不到更新信息',
    'check_failed_body' => '面板连不上它，或者它返回的不是有效的 JSON。',
    'up_to_date' => '你用的已是最新版本',
    'reinstall' => '重新安装',

    'auto_on' => '更新会自己装上',

    /*
     * 上一次自动检查做了什么。每一句都点出该去看的那个部分，因为从浏览器里看，这件
     * 事出岔子的三种方式长得一模一样：一个在往下数的数字。
     */
    'auto_never' => '还没有跑过一次检查。自动更新需要面板的调度器：那条每分钟执行 php artisan schedule:run 的 cron。没有它，任何排定的事情都不会发生。',
    'auto_ago' => '上次检查在 :ago',
    'auto_just_now' => '刚刚',
    'auto_minutes' => '分钟前',
    'auto_current' => '这个通道上没有更新的了。',
    'auto_installed' => 'v:version 是在这里装上的，由那次排定的检查自己动手。没有 queue worker 回应时它就会这么做，所以更新照样会发生，但一个没有 worker 的面板，队列里的其他活儿同样也没在做。',
    'auto_queued' => 'v:version 已交给 queue worker。如果上面的版本在几分钟内没变，说明 worker 在接活儿，只是这一件做不成；通常重启它就能解决，原因在 storage/logs 里。',
    'auto_unreachable' => '读不到更新信息。它是从互联网上取的，所以通常是面板所在机器的网络或 DNS 问题。',
    'auto_error' => '检查失败了。原因在 storage/logs 里。',

    /*
     * 真正执行更新的是 queue worker。和上面的检查分开写，因为它们各自会出岔子，救法
     * 也各不相同。
     */
    'worker_missing' => '没有 queue worker 回应。更新和 modpack 安装都是排进队列、由一个 worker 进程去做的，所以在有 worker 跑起来之前，它们只会被记下而从不执行，而且哪儿都不会有错误。要么是根本没有 worker，要么是有一个在这个插件装上之前就启动了、加载不了它的代码。两种情况都靠在面板所在机器上重启它来解决。把它的服务设成会自己重启，否则每次更新之后这条又会回来。',
    'cron_missing' => '面板的调度器已经 :for 分钟没跑过了。续费、看门狗检查和自动更新都等着它。那条 cron 写法在 Pelican 的文档里。',

    'next_check' => '距下次检查',
    'due_now' => '就要到了',

    /*
     * 按原因而不是按症状命名，因为症状是“什么都没发生”，而这正是它难以归位的地方：
     * 公告、导航链接、保存的样式和页面布局，全都是 storage/app 下的文件，一个面板写
     * 不进去的目录会让这些一声不响地全部丢失。
     */
    'storage_failed' => '面板写不进它的 storage 目录，所以这一次没有保存。检查 storage/app 是不是属于运行面板的那个用户。原因在 storage/logs 里。',

    /*
     * 每次更新失败后都说，而不只在对不上时才说。上面那句已经点出了原因，这一句点出
     * 的是人从“本该是 X，得到的是 Y”里推不出来的那唯一一个救法。
     */
    'update_renamed' => '如果它说两个 id 对不上，那就是插件被改过名，而更新跨不过这道坎：Pelican 是靠 id 认出一个已装插件的。到 管理 → 插件 里卸掉旧的那一项，再把这个重新装上。你的设置不会丢：它们在 .env 和 storage/app/private/legend-theme 里，两处都不是按 id 来存的。',
];
