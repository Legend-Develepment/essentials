<?php

/*
 * 简体中文。逐字手译。
 *
 * Palworld 的世界设置，做成一个页面而不是一个文件。
 *
 * 这里没有任何一项设置的名字。那一页上的每个标签，都是从服务器自己文件里的键推出来
 * 的。为什么一份名字清单会比一个都没有更糟，见
 * Support\Palworld\Palworld::label()。
 *
 * “Pal”和“guild”是游戏里的说法，保留原文。
 */

return [
    'title' => 'Palworld 设置',
    'nav_label' => 'Palworld',
    'subheading' => '来自这台服务器自己的 PalWorldSettings.ini 的世界设置，在你打开这一页时读入。只有服务器停着时才能改。',

    'reload' => '重新读一次文件',

    'save_confirm' => '会用这些值重写这个文件。这一页没显示出来的每一项设置，连同文件里的其余一切，都会原样写回去。',
    'saved' => '设置已保存',
    'saved_body' => '下次服务器启动时生效。',
    'save_failed' => '没能写入文件',

    'running' => '服务器正在运行',
    'running_body' => 'Palworld 把这些设置放在内存里，停下来时再把文件写出去，所以现在保存的改动会被一声不吭地抹掉。先停下服务器。',

    'groups' => [
        'server' => '服务器与连接',
        'world' => '世界与倍率',
        'pals' => 'Pal',
        'players' => '玩家',
        'building' => '建造、物品与采集',
        'guild' => '公会',
        'other' => '其他',
    ],
];
