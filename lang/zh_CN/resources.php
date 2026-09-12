<?php

/*
 * 简体中文。逐字手译。
 *
 * “mod”“plugin”“loader”“jar”“mods/”“plugins/”“egg”保留原文：它们要么是文件夹名或文
 * 件名，要么是 Modrinth 界面上就这么写的。
 */

return [
    'nav_label' => 'Mod 与 plugin',
    'title' => 'Mod 与 plugin',
    'subheading' => '从 Modrinth 一次装一个到这台服务器上。',

    'section' => '找点东西',
    'section_helper' => 'modpack 页面一次装一整包。这一页装单个 mod 或 plugin，而后者才是你远远更常需要的。',

    'kind' => '你要加的是什么',
    /*
     * 直接问，而不是自己推。egg 叫什么全看管理员当初怎么起名，而且有几种 loader 两
     * 个文件夹都读，所以从这里没有诚实的猜法：猜错就等于把一个 jar 写进了没人会读
     * 的文件夹。
     */
    'kind_helper' => 'mod 进 mods/，是给 Fabric、Forge 或 NeoForge 用的。plugin 进 plugins/，是给 Bukkit、Spigot 或 Paper 用的。这同时也决定了要搜 Modrinth 的哪一半。',
    'kind_mod' => 'mod（mods/）',
    'kind_plugin' => 'plugin（plugins/）',

    'search' => '搜索',
    'search_helper' => '打个名字，然后点到框外面。结果按下载量从多到少排。',

    'project' => 'mod 或 plugin',
    'version' => '版本',
    'version_helper' => '每一行是版本号、它为哪些 Minecraft 版本构建，以及它支持的 loader。挑一个和你服务器对得上的，这里不会替你核对。',

    'install' => '安装',
    'install_confirm' => '文件由节点直接从 Modrinth 取来，放进文件夹。已经在那儿的东西一个都不会被删。',
    'installed' => '已安装',
    'installed_helper' => '它会在服务器下次启动时加载。',

    'change' => '换个版本',
    'change_helper' => '用同一个项目的另一个版本替掉这个文件。新的下完了才删旧的，所以下载失败时你手上的还是原来那个。',
    'change_project_helper' => '从这一页装上的东西，这一项是固定的。改它就不是换版本了，那是同一个文件名下换成了另一个 mod。',
    'change_lookup_helper' => '这个文件本来就在文件夹里，所以这里不知道它是什么。搜一次它就记住了。',
    'changed' => '版本已更换',

    'check' => '检查更新',
    'checked' => '已检查',
    'checked_none' => '认得的都已经是最新版了。',
    'checked_some' => '有 :count 个有更新的版本，已在列表里标出来了。',
    'update_ready' => '有 v:number',
    /*
     * 写在标记旁边而不是提示框里，因为它改变了那个标记的含义。这里并不知道服务器跑
     * 的是哪个 Minecraft 版本、哪个 loader，所以“最新”就是最新，不是“能用的里面最
     * 新”。
     */
    'check_note' => '“更新”指的是在 Modrinth 上更新。这里并不知道你的服务器跑的是哪个 Minecraft 版本和哪个 loader，所以在启动服务器之前，先确认你选的版本上写着它对得上。',
    'unknown' => '不是从这里装的：用“换个版本”告诉它这是什么',

    'remove' => '删除',
    'remove_confirm' => '文件会从服务器上删掉。从这里没法撤销。',
    'removed' => '已删除',

    'running' => '服务器正在运行',
    'running_helper' => 'Minecraft 读 mods/ 和 plugins/ 只有启动时那一次。现在加的文件要等重启才会加载，而从一个正在跑的游戏脚底下抽走文件，可能连游戏一起带走。先停下服务器。',

    'failed' => '没成',
    'failed_version' => '那个版本没有这里能装的 jar。有些发行版只带源码，或者只有客户端构建。',
    'failed_write' => '节点拒绝了这次下载。可能是它连不上 Modrinth。',

    'installed_title' => '已安装',
    'installed_mods' => 'mods/ 里',
    'installed_plugins' => 'plugins/ 里',
    /*
     * 空列表容易被误读，所以说明一下：它通常意味着这台服务器根本不用那个文件夹，而
     * 不是少了什么东西。
     */
    'installed_empty' => '这里什么都没有。一台服务器只会用这两个文件夹中的一个，所以有一个是空的很正常。',
    'installed_note' => '只列出 .jar 文件。配置文件夹和被停用的文件都原样留着，不在这里显示。',
];
