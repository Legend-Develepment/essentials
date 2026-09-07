<?php

/*
 * 日本語。手作業による翻訳です。
 *
 * 「Steam App ID」「IGDB」「Twitch client ID」「client secret」はそのままです。値
 * を取ってくる先のページに、まさにその表記で出ている語だからです。
 */

return [
    'title' => 'egg の画像',
    'nav_label' => 'egg の画像',
    'subheading' => 'あなたの egg に付けるゲームの画像を、Steam と IGDB から取得します。画像の無い egg は、それを使うすべてのサーバーカードに Pelican の鳥を出します。',

    // ---- 表 ---------------------------------------------------------------
    'column_name' => 'egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'ロック',

    'locked' => 'ロック中',
    'unlocked' => '解放',

    // ---- 一行に対してできること -------------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'ゲームの Steam ストアのアドレスに入っている数字です - store.steampowered.com/app/892970 なら 892970。id で取得すると画像はロックされます。数字を打ち込むのは一つの判断であり、あとの一括取得がそれを覆してはならないからです。',

    'fetch_igdb' => 'IGDB',
    'search_term' => '検索語',
    'search_term_helper' => 'egg の名前を入れてありますが、それがゲームの名前であることはめったにありません -「Paper 1.20.4」は Minecraft です。ゲームの名前を入力してください。',

    'lock' => 'ロック',
    'unlock' => 'ロック解除',
    'locked_done' => 'ロックしました - 一括取得はこれに触れません',
    'unlocked_done' => 'ロックを解除しました - 一括取得がこの画像を差し替えることがあります',

    'clear' => '消去',
    'clear_confirm' => '画像と Steam App ID を消します。egg は Pelican の鳥に戻り、次の一括取得でもう一度試されます。',
    'cleared' => '画像を消しました',

    // ---- 結果 -------------------------------------------------------------
    'fetched' => '画像を保存しました',
    'failed' => '画像は保存されませんでした',

    /*
     * それぞれに理由を一つずつ。別々の問題だからです。
     *
     * 打ち間違いで失敗した取得と、ディスクが一杯で失敗した取得が、どちらも「失敗」
     * と言うべきではありません - 前者は数字を見れば直り、後者はサーバーを見れば直り
     * ます。
     */
    'why_bad_id' => 'それは Steam App ID ではありません。',
    'why_not_found' => 'そのアドレスに Steam は何も持っていません。App ID を確認してください - ストアのページが無いゲームには、ヘッダー画像もありません。',
    'why_no_match' => 'その名前では何も見つかりませんでした。egg の名前ではなく、ゲームの実際の名前で試してください。',
    'why_no_name' => '検索するものがありません。',
    'why_no_token' => 'Twitch がトークンを発行しませんでした。認証情報の欄の client ID と secret を確認してください。',
    'why_not_configured' => 'IGDB には Twitch の client ID と secret が必要です。認証情報の欄で設定してください。',
    'why_empty' => '空の応答でした。',
    'why_large' => 'その画像はアイコンよりはるかに大きいので、保存しませんでした。',
    'why_not_an_image' => '返ってきたものは画像ではありません。たいていは、エラーページが成功のコードで応答したという意味です。',
    'why_wrong_format' => 'その画像は、このパネルが保存しない形式です。Pelican が扱うのは PNG、JPEG、WebP です。',
    'why_unwritable' => '画像を書き込めませんでした。storage/app/public がパネルの実行ユーザーのものになっているか、php artisan storage:link を実行済みかを確認してください。',
    'why_unknown' => 'うまくいきませんでしたが、その理由にはここで付けられた名前がありません。',

    // ---- まとめて ---------------------------------------------------------
    'bulk' => '足りないものをすべて取得',
    'bulk_confirm_steam' => '画像が無く、ロックもされていないすべての egg について、名前で Steam を検索します。ロック済みの egg と、すでに画像のある egg には触れません。これはバックグラウンドで実行され、終わったらお知らせします。',
    'bulk_confirm_both' => '画像が無く、ロックもされていないすべての egg について、名前で Steam を検索し、Steam で見つからなかったものは IGDB でも試します。ロック済みの egg と、すでに画像のある egg には触れません。これはバックグラウンドで実行され、終わったらお知らせします。',

    'bulk_started' => 'バックグラウンドで取得しています',
    'bulk_started_body' => '大きなパネルでは数分かかることがあります。終わったら通知が届きますし、このページを離れてもかまいません。',

    'bulk_done' => 'egg の画像が終わりました',
    'bulk_done_body' => ':fetched 件を取得、:skipped 件はそのまま、:failed 件は見つかりませんでした。egg がそのままになるのは、ロックされているか、すでに画像がある場合です。',

    'bulk_failed' => '一括取得は実行されませんでした',
    'bulk_failed_queue' => '待ち行列に渡せませんでした。これには queue worker が必要です - pelican-queue が動いているか確認してください。',

    // ---- IGDB の認証情報 --------------------------------------------------
    'credentials' => '認証情報',
    'credentials_helper' => 'Steam はこれが無くても動きます。これは IGDB のためだけのもので、IGDB は Steam が聞いたこともないゲームを扱います - Minecraft とその派生すべて、家庭用機で出たもの、そして mod 入りの egg のほとんど。',
    'credentials_where' => 'dev.twitch.tv/console でアプリケーションを作り、client secret を生成して、両方をここに貼り付けてください。無料です。',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => '認証情報を保存しました',
    'credentials_failed' => '認証情報を保存できませんでした',
];
