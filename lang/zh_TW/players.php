<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 「whitelist」「operator」「ban」「kick」保留原文：它們就是 Minecraft 主控台指令本
 * 身的名字，也是伺服器上那幾個檔案的名字。換成譯名只會讓人再去對一遍。
 */

return [
    'nav_label' => '玩家',
    'title' => '玩家',
    'subheading' => 'whitelist、operator、ban，以及這臺伺服器見過的所有人。',

    /*
     * 靠上的位置講一次，因為它同時解釋了這一頁能做什麼，以及它做不到的那一件事為什麼
     * 不是毛病。每一次改動都以主控台指令送出去，那正是 Minecraft 該被告知的方式：
     * 遊戲自己做改動、自己寫檔案，所以兩邊永遠不會各說各話。
     */
    'how' => '改動以主控台指令送給伺服器，由遊戲去做並寫它自己的檔案。這需要伺服器正在執行。',
    'needs_running' => '伺服器必須在執行。這些改動是遊戲做的，不是在它腳底下改檔案。',

    'name' => '玩家名稱',
    'reason' => '理由（可不填）',

    'whitelist' => '加入 whitelist',
    'unwhitelist' => '從 whitelist 移除',
    'op' => '設為 operator',
    'deop' => '取消 operator',
    'ban' => 'ban 掉',
    'pardon' => '解除 ban',
    'kick' => 'kick 出去',

    'sent' => '指令已送出',
    'sent_body' => '伺服器會執行它並更新自己的檔案。重新整理頁面就看得到名單的變化。',
    'refused' => '沒有送出去',

    'flag_op' => 'operator',
    'flag_whitelisted' => '在 whitelist 上',
    'flag_banned' => '已 ban',
    'flag_seen' => '在這裡玩過',

    'online' => '目前上線',
    'online_count' => ':max 人中的 :online 人',
    'online_none' => '沒有人連著。',

    'players' => '玩家',
    'ips' => '被 ban 的位址',
    'ips_empty' => '沒有被 ban 的位址。',

    /*
     * 空頁面代表什麼：通常不是「沒有玩家」，而是「這臺伺服器從沒啟動過」。Minecraft
     * 在第一次執行之前，這些檔案一個都不會建。
     */
    'empty' => '還沒有可顯示的東西。這些名單是 Minecraft 自己寫的，而在伺服器第一次啟動之前它不會建它們。',

    'level' => '等級 :level',

    /*
     * 這一頁不做的那一件事，講出來而不是留給人去發現。要知道此刻的狀況，需要另開一條
     * 通往遊戲本身的連線，那是另一個功能，有它自己的前提。
     */
    'not_live' => '這是伺服器記下來的東西，不是此刻誰在上面。',
];
