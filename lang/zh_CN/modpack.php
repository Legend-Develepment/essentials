<?php

/*
 * 简体中文。逐字手译。
 *
 * “modpack”“mod”“loader”“egg”“queue worker”保留原文：Modrinth 的界面和 Pelican 的
 * 界面上都是这么写的。
 */

return [
    'nav_label' => 'Modpack',
    'title' => 'Modpack',
    'subheading' => '把一个 Modrinth 上的 modpack 装到这台服务器上。',

    'section' => '找一个包',
    'section_helper' => '只有 Modrinth，也只有服务端的包。它不需要账号也不需要 API 密钥，这正是它成为这里唯一来源的原因：其他几家都要先粘一个密钥进去，才肯让你看见任何东西。',

    'search' => '搜索',
    'search_helper' => '留空就按下载量最多的排。搜索要去问 Modrinth，所以它在你离开输入框时才执行，不是边打边搜。',

    'pack' => '包',
    'pack_helper' => '只列出声明能在服务端跑的包。',

    'version' => '版本',
    'version_helper' => '游戏版本和 loader 就写在每一项旁边。选这台服务器的 egg 本来就在跑的那个 loader。这只装文件，不会改你的 egg，也不会改启动命令。',

    'downloads' => '次下载',

    'install' => '安装这个包',
    'install_go' => '装上',
    'install_confirm' => '包里的文件会被加到这台服务器上。**什么都不会被删**：你的世界不会，旧的 mod 不会，配置也不会。在一个包上再装一个包，两边都会留着，所以要是你不想那样，先自己把上一个包的 mod 清掉。服务器必须是停着的，装完也仍旧停着。',

    'started' => '正在安装',
    'started_helper' => '正在取包并解开。几百个文件要几分钟，装完会有通知，你离开这一页它也会继续。',

    'running' => '服务器正在运行',
    'running_helper' => 'Minecraft 在启动时加载它的 mod，所以现在装的包会让服务器在重启之前既不是旧包也不是新包。先停下它，再试一次。',

    'done' => '已安装 :pack',
    'done_body' => '取了 :files 个文件，并把包自己文件夹里的 :overrides 项放到位。准备好了就启动服务器。',
    'done_refused' => '有 :count 个文件被跳过了，因为包要求从这里不会去下载的地方取它们。',

    'failed' => '这个包没有装上',
    'failed_fetch' => '包取不到或解不开。可能是 daemon 连不上，也可能是服务器磁盘不够了。',
    'failed_index' => '包取到了，但里面没有可读的索引，所以没有东西可装。',
    'failed_version' => '那个版本已经没有可下载的包文件了。换一个吧。',
    'failed_queue' => '安装排不进队列。这需要面板上有一个在跑的 queue worker。',
];
