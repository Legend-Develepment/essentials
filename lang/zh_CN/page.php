<?php

/*
 * 简体中文。逐字手译。
 *
 * 设置页本身的框架，以及更新的那一摊事。
 *
 * “queue worker”“cron”“storage”保留原文：你会在服务器上按这些名字去找它们。
 */

return [
    'title' => 'Essentials 设置',
    'nav_label' => 'Essentials 设置',
    'save' => '保存',
    'saved' => '设置已保存',
    'save_failed' => '没能保存设置',
    'secret_kept' => '已保存。留空则保留，输入新的值则替换。',
    'update_background' => '它在后台运行，要一两分钟。',

    /*
     * queue worker 和 scheduler，所有后台任务和定时任务都靠它们。
     * 分开写，因为它们各自会出岔子，救法也各不相同。
     */
    'worker_missing' => '没有 queue worker 回应。modpack 安装、邮件和其他后台任务都是排进队列、由一个 worker 进程去做的，所以在有 worker 跑起来之前，它们只会被记下而从不执行，而且哪儿都不会有错误。要么是根本没有 worker，要么是有一个在这个插件装上之前就启动了、加载不了它的代码。两种情况都靠在面板所在机器上重启它来解决。把它的服务设成会自己重启，否则每次更新之后这条又会回来。',
    'cron_missing' => '面板的调度器已经 :for 分钟没跑过了。续费和看门狗检查都等着它。那条 cron 写法在 Pelican 的文档里。',

    /*
     * 按原因而不是按症状命名，因为症状是“什么都没发生”，而这正是它难以归位的地方：
     * 公告、导航链接、保存的样式和页面布局，全都是 storage/app 下的文件，一个面板写
     * 不进去的目录会让这些一声不响地全部丢失。
     */
    'storage_failed' => '面板写不进它的 storage 目录，所以这一次没有保存。检查 storage/app 是不是属于运行面板的那个用户。原因在 storage/logs 里。',
];
