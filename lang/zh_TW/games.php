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
    'save' => '儲存',
    'saved' => '已儲存',
    'restart' => '遊戲在啟動時讀取這個檔案，所以請重新啟動伺服器讓變更生效。',
    'failed' => '儲存失敗',
    'failed_write' => '守護程序拒絕了寫入。請檢查伺服器是否可達，以及檔案是否為唯讀。',
    'read_only' => '你可以讀取這個檔案但不能寫入，所以這裡什麼都改不了。',
    'missing' => '這台伺服器還沒有設定檔。遊戲會在第一次執行時寫出它，啟動一次伺服器，這個頁面就會填上。',
    'keeps' => '檔案裡的其他內容 - 註解、空行、順序，以及這個外掛從未聽過的每一個鍵 - 在你儲存時原樣保留。',
    'raw' => '這裡的名稱是遊戲自己的名稱，按檔案裡的順序排列。不翻譯也不分組，因為這個頁面讀的是檔案而不是有人手寫的清單。',
    'unset' => '未設定。遊戲把它作為範例列出；填上就會新增它。',
    'group_all' => '設定',
    'group_all_helper' => '這個檔案提到的一切。',
    'subheading' => '由 :files 產生，而不是來自有人手寫的清單。',
];
