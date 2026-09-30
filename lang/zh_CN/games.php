<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => '保存',
    'saved' => '已保存',
    'restart' => '游戏在启动时读取这个文件，所以请重启服务器让更改生效。',
    'failed' => '保存失败',
    'failed_write' => '守护进程拒绝了写入。请检查服务器是否可达，以及文件是否为只读。',
    'read_only' => '你可以读取这个文件但不能写入，所以这里什么都改不了。',
    'missing' => '这台服务器还没有配置文件。游戏会在第一次运行时写出它，启动一次服务器，这个页面就会填上。',
    'keeps' => '文件里的其他内容 - 注释、空行、顺序，以及这个插件从未听说过的每一个键 - 在你保存时原样保留。',
    'raw' => '这里的名称是游戏自己的名称，按文件里的顺序排列。不翻译也不分组，因为这个页面读的是文件而不是有人手写的清单。',
    'unset' => '未设置。游戏把它作为示例列出；填上就会添加它。',
    'group_all' => '设置',
    'group_all_helper' => '这个文件提到的一切。',
    'subheading' => '由 :files 生成，而不是来自有人手写的清单。',
];
