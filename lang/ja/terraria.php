<?php

/*
 * Terraria, and only what is about Terraria.
 *
 * Six strings. The words the page itself uses - Save, what to say when the file
 * is not there, what the raw field names mean - are in games.php and shared with
 * every game, which is what makes a third one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'どの egg が Terraria を動かすか。それだけです。Terraria サーバーの残りは起動変数で設定し、それは Pelican の Startup ページがすでに編集します。',
    'eggs' => 'どの egg が Terraria か',
    'eggs_helper' => 'Terraria サーバーを動かす egg にチェックを入れてください。vanilla でも tModLoader でも構いません。それを使うサーバーの中にだけ「サーバー設定」ページが現れます。最初は何もチェックされていません。プラグインはあなたが egg をどう名づけたか知りようがないからです。',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'サーバー設定',
    'title' => 'Terraria サーバー設定',
];
