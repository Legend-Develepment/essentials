<?php

/*
 * 简体中文。逐字手译。
 *
 * “whitelist”“operator”“ban”“kick”保留原文：它们就是 Minecraft 控制台指令本身的名
 * 字，也是服务器上那几个文件的名字。换成译名只会让人再去对一遍。
 */

return [
    'nav_label' => '玩家',
    'title' => '玩家',
    'subheading' => 'whitelist、operator、ban，以及这台服务器见过的所有人。',

    /*
     * 靠上的位置说一次，因为它同时解释了这一页能做什么，以及它做不到的那一件事为什
     * 么不是毛病。每一次改动都以控制台指令发出去，那正是 Minecraft 该被告知的方式
     * —— 游戏自己做改动、自己写文件，所以两边永远不会各说各话。
     */
    'how' => '改动以控制台指令发给服务器，由游戏去做并写它自己的文件。这需要服务器正在运行。',
    'needs_running' => '服务器必须在运行。这些改动是游戏做的，不是在它脚底下改文件。',

    'name' => '玩家名',
    'reason' => '理由（可不填）',

    'whitelist' => '加入 whitelist',
    'unwhitelist' => '从 whitelist 移出',
    'op' => '设为 operator',
    'deop' => '取消 operator',
    'ban' => 'ban 掉',
    'pardon' => '解除 ban',
    'kick' => 'kick 出去',

    'sent' => '指令已发送',
    'sent_body' => '服务器会执行它并更新自己的文件。刷新页面就能看到名单的变化。',
    'refused' => '没有发出去',

    'flag_op' => 'operator',
    'flag_whitelisted' => '在 whitelist 上',
    'flag_banned' => '已 ban',
    'flag_seen' => '在这儿玩过',

    'online' => '当前在线',
    'online_count' => ':max 人中的 :online 人',
    'online_none' => '没有人连着。',

    'players' => '玩家',
    'ips' => '被 ban 的地址',
    'ips_empty' => '没有被 ban 的地址。',

    /*
     * 空页面意味着什么 —— 通常不是“没有玩家”，而是“这台服务器从没启动过”。Minecraft
     * 在第一次运行之前，这些文件一个都不会建。
     */
    'empty' => '还没有可显示的东西。这些名单是 Minecraft 自己写的，而在服务器第一次启动之前它不会建它们。',

    'level' => '等级 :level',

    /*
     * 这一页不做的那一件事，说出来而不是留给人去发现。要知道此刻的情况，需要另开一
     * 条通往游戏本身的连接，那是另一个功能，有它自己的前提。
     */
    'not_live' => '这是服务器记下来的东西，不是此刻谁在上面。',
];
