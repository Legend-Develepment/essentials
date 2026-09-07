<?php

/*
 * 简体中文。逐字手译。
 *
 * 服务器页面上的那条操作栏。它自成一个文件，而不是 settings.php 的一角，因为读它
 * 的是用面板的人，不是配置主题的人。
 *
 * 按钮旁边的状态用的是 Pelican 自己的说法，取自 ContainerStatus 枚举，所以这条栏
 * 和控制台页面永远不会对一台服务器正在做什么各执一词。
 *
 * “Kill” 不译：Pelican 的按钮上和 Docker 里都是这个词，换成译名反而要查两遍。
 */

return [
    'console' => '控制台',
    'full_page' => '新窗口',
    'close' => '关闭',

    'start' => '启动',
    'restart' => '重启',
    'stop' => '停止',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill 会就地停住容器。服务器还没写进磁盘的东西都会丢。要继续吗？',

    'sent_title' => '电源操作',
    'sent_body' => '已将 :action 发送至 :name。',
    'failed' => '无法连接到节点。',
];
