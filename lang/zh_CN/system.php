<?php

/*
 * 简体中文。逐字手译。
 *
 * “系统状态”页：面板自己所在的那台主机，以及你要求摆在它旁边的任何节点。
 *
 * 在任何把两者分开的部署里，这都不是节点所在的那台机器 —— 这正是它们能同处一页的
 * 原因。
 *
 * “Swap”“Wings”“PHP”“uptime”保留原文：机器上是这么叫的，人们拿来对照的每样工具里也
 * 是。
 */

return [
    'title' => '系统状态',
    'nav_label' => '系统状态',
    'subheading' => '面板自己所在的那台机器、它上面在跑什么，以及你要求摆在它旁边的任何节点。',

    'options' => '选项',
    'enabled' => '在侧边栏里显示',
    'enabled_helper' => '关掉会把那一行从侧边栏里拿走。页面自己的地址还在，所以随时可以再开回来。',

    'refresh' => '每隔多久重读一次',
    'refresh_helper' => '整页按这个间隔重新取一次。关掉就保持你打开时的样子。',
    'refresh_off' => '只在我打开时',
    'refresh_seconds' => ':seconds 秒',

    'blocks' => '显示',
    'blocks_helper' => '勾上的才显示。磁盘是每个文件系统一张卡，这样一个塞满的根分区就不会被一个空了一半的数据挂载点挡住。',
    'block_cpu' => '处理器',
    'block_memory' => '内存',
    'block_swap' => 'Swap',
    'block_disk' => '磁盘',
    'block_load' => '平均负载',
    'block_uptime' => 'Uptime',
    'block_system' => '系统',
    'block_version' => '面板版本',
    // 永远不会显示 —— 节点的卡片用节点自己的名字 —— 但 blank() 会来取它，而一个缺失
    // 的键把自己的名字打出来，是个很差的兜底。
    'block_node' => '节点',

    'nodes' => '要显示的节点',
    'nodes_helper' => '每个节点一张卡，摆在面板所在机器旁边。一个都不勾就一个都不显示 —— 仪表盘上本来就有一块列着所有节点。每一个都要去问它自己的 daemon，所以短间隔加长列表就是很多次请求。',

    'section_usage' => '使用情况',
    'section_host' => '本面板',
    'section_nodes' => '节点',

    'disk_panel' => '面板就在这儿',
    'wings' => 'Wings :version',
    'version_installed' => '已安装',
    'version_latest' => '最新',
    'version_current' => '已是最新',
    'version_update' => '有可用更新',
    'version_unknown' => '查不到',

    /*
     * 一张落后的卡片会给出什么。
     *
     * 给的是通往发行版的链接，而不是一个执行更新的按钮，因为从这里根本没有更新可执
     * 行：Pelican 没有升级命令，Wings 也没有哪个接口能替换它自己的二进制。那句提示
     * 说明真正的活儿是在哪里干的，免得有人去找一个从来就不可能存在的按钮。
     */
    'version_release' => '有什么新东西',
    'version_how_panel' => '打开发行说明。升级面板要在它所在的机器上做 —— 面板换不了自己的文件，而任何插件都不允许执行 shell 命令。',
    'version_how_wings' => '打开发行说明。Wings 在节点上更新 —— 面板没有通往另一台机器上那个程序的通道。',

    'wings_latest' => '最新 :version',
    'load_cores' => ':cores 个处理器的 :percent%',
    'load_windows' => ':five（5 分钟）· :fifteen（15 分钟）',
    'uptime_since' => '自 :date 起',
    'unavailable' => '这台机器上取不到',

    'fact_os' => '操作系统',
    'fact_hostname' => '主机名',
    'fact_php' => 'PHP',
    'fact_cores' => '处理器',
    'fact_processes' => '进程',
];
