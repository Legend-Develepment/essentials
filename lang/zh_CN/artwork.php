<?php

/*
 * 简体中文。逐字手译。
 *
 * “Steam App ID”“IGDB”“Twitch client ID”“client secret”保留原文：取值的那些页面上
 * 写的正是这几个词。
 */

return [
    'title' => 'egg 配图',
    'nav_label' => 'egg 配图',
    'subheading' => '给你的 egg 配上游戏图，从 Steam 和 IGDB 取。没有图的 egg，会在每一张用到它的服务器卡片上显示 Pelican 自己那只鸟。',

    // ---- 表格 -------------------------------------------------------------
    'column_name' => 'egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => '已锁定',

    'locked' => '已锁定',
    'unlocked' => '未锁',

    // ---- 对一行能做什么 ----------------------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => '一款游戏 Steam 商店地址里的那个数字：store.steampowered.com/app/892970 就是 892970。按 id 取会把图锁上，因为敲一个数字是一次决定，后来的批量取不该把它推翻。',

    'fetch_igdb' => 'IGDB',
    'search_term' => '搜索',
    'search_term_helper' => 'egg 的名字已经填好了，但它很少就是游戏的名字：“Paper 1.20.4”是 Minecraft。打游戏的名字。',

    'lock' => '锁定',
    'unlock' => '解锁',
    'locked_done' => '已锁定：批量取会绕开这一个',
    'unlocked_done' => '已解锁：批量取可能换掉这张图',

    'clear' => '清除',
    'clear_confirm' => '把图和 Steam App ID 都去掉。这个 egg 会回到 Pelican 自己那只鸟，下一次批量取会再试一次。',
    'cleared' => '图已去掉',

    // ---- 结果 -------------------------------------------------------------
    'fetched' => '图已保存',
    'failed' => '没有保存任何图',

    /*
     * 每种情况一个理由，因为它们是不同的问题。
     *
     * 因为打错字而失败的取图，和因为磁盘满了而失败的取图，不该都说“失败”：前者盯
     * 着那个数字就能治，后者要盯着服务器才能治。
     */
    'why_bad_id' => '那不是一个 Steam App ID。',
    'why_not_found' => 'Steam 在那个地址上什么都没有。核对一下 App ID：没有商店页面的游戏，也没有头图。',
    'why_no_match' => '用那个名字什么也没找到。试试游戏真正的名字，而不是 egg 的名字。',
    'why_no_name' => '没有可搜的内容。',
    'why_no_token' => 'Twitch 不肯发令牌。核对一下“凭据”里的 client ID 和 secret。',
    'why_not_configured' => 'IGDB 需要一个 Twitch client ID 和 secret。到“凭据”里填上。',
    'why_empty' => '回应是空的。',
    'why_large' => '那张图比一个图标大得多，没有保存。',
    'why_not_an_image' => '回来的东西不是图。这通常意味着一个错误页面用成功的状态码回应了。',
    'why_wrong_format' => '那张图的格式本面板不保存。Pelican 收 PNG、JPEG 和 WebP。',
    'why_unwritable' => '图写不进去。检查 storage/app/public 是不是属于运行面板的那个用户，以及 php artisan storage:link 有没有跑过。',
    'why_unknown' => '没成，而这个原因不在这里能叫得出名字的那几种里。',

    // ---- 一次全做 ---------------------------------------------------------
    'bulk' => '把缺的都取回来',
    'bulk_confirm_steam' => '对每一个没有图、也没被锁定的 egg，按名字去 Steam 搜。锁定的 egg 和已经有图的 egg 会被绕开。这件事在后台跑，做完会告诉你。',
    'bulk_confirm_both' => '对每一个没有图、也没被锁定的 egg，按名字去 Steam 搜，Steam 找不到的再去试 IGDB。锁定的 egg 和已经有图的 egg 会被绕开。这件事在后台跑，做完会告诉你。',

    'bulk_started' => '正在后台取',
    'bulk_started_body' => '面板大的话可能要好几分钟。做完会有通知，你可以离开这一页。',

    'bulk_done' => 'egg 配图完成',
    'bulk_done_body' => '取到 :fetched 个，绕开 :skipped 个，:failed 个没找到。一个 egg 被绕开，是因为它被锁定了或者本来就有图。',

    'bulk_failed' => '批量取没有跑起来',
    'bulk_failed_queue' => '它交不到队列上。这需要一个 queue worker，检查 pelican-queue 是不是在跑。',

    // ---- IGDB 凭据 ---------------------------------------------------------
    'credentials' => '凭据',
    'credentials_helper' => 'Steam 不需要这里的任何东西。这些只给 IGDB 用，而 IGDB 覆盖的是 Steam 从没听说过的游戏：Minecraft 和它的每一个分支、所有在主机上发行的，以及大部分带 mod 的 egg。',
    'credentials_where' => '到 dev.twitch.tv/console 建一个应用，生成一个 client secret，然后把两样都粘到这里。这是免费的。',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => '凭据已保存',
    'credentials_failed' => '凭据没能保存',
];
