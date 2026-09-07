<?php

/*
 * 日本語。手作業による翻訳です。
 *
 * ゲームモードと難易度は訳しません。Minecraft はゲーム内で Survival、Creative、
 * Peaceful、Hard と表示します - 出どころの画面と違う名前の設定は、二度調べないと
 * 分からない設定になります。
 *
 * server.properties の中に書かれている語も同じです。whitelist、operator、seed、
 * chunk、RCON、query、resource pack、そして the Nether。
 */

return [
    /* ------------------------------------------------ 管理タブ ----------- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft の設定',
    'subheading' => 'このサーバー自身の server.properties を、テキストファイルではなくフォームとして。',

    /*
     * 見出しはここにはありません。設定の各節は settings.groups.<名前> から題を取り
     * ます。group() が組み立てているもので、このファイル自身の 'section' キーにあっ
     * た二つ目の写しは、本物が丸ごと欠けているあいだ、どこからも使われていませんで
     * した。
     */
    'section_helper' => 'これがどの egg に適用されるか、そして Minecraft まわりでこのプラグインがすることのすべて。',

    'live' => 'サーバーに誰が遊んでいるか尋ねる',
    'live_helper' => 'プレイヤーのページに、接続中の人の一覧をその場で追加します。Minecraft のクライアントが自分のサーバー一覧を描くのに使うのと同じ握手を使います。既定でオフなのは、ここでパネルからゲームのポートへ直接つなぐ唯一の機能だからです。パネルとノードが互いに届かないネットワークにある場合、何も応答せず、その行は単に出ません。ゲームサーバー側で有効にすべきものはありません。',

    'eggs' => 'どの egg が Minecraft か',
    'eggs_helper' => 'Minecraft サーバーを動かす egg に印を付けてください - Vanilla、Paper、Purpur、Fabric、Forge、そしてあなたが付けた名前のもの。それを使うサーバーの中にだけこのページが現れます。最初は何にも印が付いていません。これは意図的です。あなたが egg にどんな名前を付けたか、プラグインには分かりませんし、当てずっぽうの一覧は、公開したその週に誰かのパネルで間違っていることになります。',

    /* --------------------------------------------- サーバーのページ ------ */

    'groups' => [
        'general' => 'サーバー',
        'players' => 'プレイヤー',
        'world' => 'ワールド',
        'performance' => '性能',
        'access' => 'アクセスと追加機能',
        'other' => 'ファイルのそのほかすべて',
    ],

    'other_helper' => 'server.properties から読み取り、そのまま残しているものです。mod と modpack は自分の設定をここに置きます。存在が分かるように表示していますが、変更は ファイルマネージャーから行ってください。このページを保存しても、これらには一切触れません。',

    'reload' => 'ファイルを読み直す',

    'saved' => 'server.properties に保存しました',
    'saved_helper' => '次にサーバーが起動したときに反映されます。',

    'running' => 'サーバーが動いています',
    'running_helper' => 'Minecraft は起動時に server.properties を読み、停止時に書き戻します。だからいま保存しても、終了するときに上書きされてしまいます。サーバーを停止してから保存し直してください。',

    'missing' => 'server.properties が見つかりません',
    'missing_helper' => 'このファイルはサーバーを初めて起動したときに現れます。一度起動してから戻ってきてください。',

    'failed' => '保存できませんでした',
    'failed_helper' => 'daemon が書き込みを拒否しました。このページを開いているあいだにサーバーが起動したのかもしれません。',

    /* ------------------------------------- 各キーの意味 ------------------ */

    'keys' => [
        'motd' => 'サーバー一覧に出る文言',
        'gamemode' => 'ゲームモード',
        'difficulty' => '難易度',
        'hardcore' => 'Hardcore - 死んだら終わり',
        'force_gamemode' => '参加時に全員を既定のモードに戻す',
        'pvp' => 'プレイヤー同士が傷つけられる',

        'max_players' => '同時接続の上限',
        'white_list' => 'whitelist のみ',
        'enforce_whitelist' => 'whitelist に無い人を追い出す',
        'online_mode' => 'アカウントを Mojang に照会する',
        'player_idle_timeout' => '無操作が何分続いたら追い出すか',
        'op_permission_level' => 'operator にできること (1-4)',

        'level_name' => 'ワールドのフォルダ',
        'level_seed' => 'Seed',
        'level_type' => 'ワールドの種類',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'モンスターが湧く',
        'spawn_protection' => 'spawn 周辺の保護ブロック数',

        'view_distance' => '描画距離 (chunk)',
        'simulation_distance' => 'シミュレーション距離 (chunk)',
        'max_tick_time' => 'Watchdog (ミリ秒。-1 でオフ)',
        'sync_chunk_writes' => 'chunk をディスクへ直接書く',

        'enable_command_block' => 'コマンドブロック',
        'allow_flight' => '飛行を許可',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'resource pack のアドレス',
        'require_resource_pack' => 'resource pack を必須にする',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
