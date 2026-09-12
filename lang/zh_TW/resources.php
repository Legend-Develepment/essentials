<?php

/*
 * 正體中文。逐字手譯，用臺灣與香港的說法寫。
 *
 * 「mod」「plugin」「loader」「jar」「mods/」「plugins/」「egg」保留原文：它們要嘛是
 * 資料夾名或檔名，要嘛是 Modrinth 介面上就這麼寫的。
 */

return [
    'nav_label' => 'Mod 與 plugin',
    'title' => 'Mod 與 plugin',
    'subheading' => '從 Modrinth 一次裝一個到這臺伺服器上。',

    'section' => '找點東西',
    'section_helper' => 'modpack 頁面一次裝一整包。這一頁裝單一個 mod 或 plugin，而後者才是你遠遠更常需要的。',

    'kind' => '你要加的是什麼',
    /*
     * 直接問，而不是自己推。egg 叫什麼全看管理員當初怎麼取名，而且有幾種 loader 兩個
     * 資料夾都讀，所以從這裡沒有誠實的猜法，猜錯就等於把一個 jar 寫進了沒人會讀的資
     * 料夾。
     */
    'kind_helper' => 'mod 進 mods/，是給 Fabric、Forge 或 NeoForge 用的。plugin 進 plugins/，是給 Bukkit、Spigot 或 Paper 用的。這同時也決定了要搜 Modrinth 的哪一半。',
    'kind_mod' => 'mod（mods/）',
    'kind_plugin' => 'plugin（plugins/）',

    'search' => '搜尋',
    'search_helper' => '打個名字，然後點到框外面。結果照下載量從多到少排。',

    'project' => 'mod 或 plugin',
    'version' => '版本',
    'version_helper' => '每一列是版本號、它為哪些 Minecraft 版本建置，以及它支援的 loader。挑一個和你伺服器對得上的，這裡不會替你核對。',

    'install' => '安裝',
    'install_confirm' => '檔案由節點直接從 Modrinth 抓來，放進資料夾。已經在那裡的東西一個都不會被刪。',
    'installed' => '已安裝',
    'installed_helper' => '它會在伺服器下次啟動時載入。',

    'change' => '換個版本',
    'change_helper' => '用同一個專案的另一個版本替掉這個檔案。新的下完了才刪舊的，所以下載失敗時你手上的還是原來那個。',
    'change_project_helper' => '從這一頁裝上的東西，這一項是固定的。改它就不是換版本了，那是同一個檔名底下換成了另一個 mod。',
    'change_lookup_helper' => '這個檔案本來就在資料夾裡，所以這裡不知道它是什麼。搜一次它就記住了。',
    'changed' => '版本已更換',

    'check' => '檢查更新',
    'checked' => '已檢查',
    'checked_none' => '認得的都已經是最新版了。',
    'checked_some' => '有 :count 個有更新的版本，已經在清單裡標出來了。',
    'update_ready' => '有 v:number',
    /*
     * 寫在標記旁邊而不是提示框裡，因為它改變了那個標記的意思。這裡並不知道伺服器跑的
     * 是哪個 Minecraft 版本、哪個 loader，所以「最新」就是最新，不是「能用的裡面最
     * 新」。
     */
    'check_note' => '「更新」指的是在 Modrinth 上更新。這裡並不知道你的伺服器跑的是哪個 Minecraft 版本和哪個 loader，所以在啟動伺服器之前，先確認你挑的版本上寫著它對得上。',
    'unknown' => '不是從這裡裝的，用「換個版本」告訴它這是什麼',

    'remove' => '移除',
    'remove_confirm' => '檔案會從伺服器上刪掉。從這裡沒辦法復原。',
    'removed' => '已移除',

    'running' => '伺服器正在執行',
    'running_helper' => 'Minecraft 讀 mods/ 和 plugins/ 只有啟動時那一次。現在加的檔案要等重新啟動才會載入，而從一個正在跑的遊戲腳底下抽走檔案，可能連遊戲一起帶走。先停下伺服器。',

    'failed' => '沒成',
    'failed_version' => '那個版本沒有這裡能裝的 jar。有些發行版只帶原始碼，或者只有用戶端建置。',
    'failed_write' => '節點拒絕了這次下載。可能是它連不上 Modrinth。',

    'installed_title' => '已安裝',
    'installed_mods' => 'mods/ 裡',
    'installed_plugins' => 'plugins/ 裡',
    /*
     * 空清單容易被誤讀，所以說明一下：它通常代表這臺伺服器根本不用那個資料夾，而不是
     * 少了什麼東西。
     */
    'installed_empty' => '這裡什麼都沒有。一臺伺服器只會用這兩個資料夾中的一個，所以有一個是空的很正常。',
    'installed_note' => '只列出 .jar 檔案。設定資料夾和被停用的檔案都原樣留著，不在這裡顯示。',
];
