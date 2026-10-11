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
    'saved' => '保存しました',
    'restart' => 'ゲームは起動時にこのファイルを読むので、変更を反映するにはサーバーを再起動してください。',
    'failed' => '保存できませんでした',
    'failed_write' => 'デーモンが書き込みを拒否しました。サーバーに到達できるか、ファイルが読み取り専用でないかを確認してください。',
    'read_only' => 'このファイルは読めますが書き込めないため、ここでは何も変更できません。',
    'missing' => 'このサーバーにはまだ設定ファイルがありません。ゲームが初回起動時に書き出すので、一度起動するとこのページが埋まります。',
    'keeps' => 'ファイルのそれ以外 - コメント、空行、並び順、このプラグインが知らないすべてのキー - は保存してもそのまま残ります。',
    'raw' => 'ここに並ぶ名前はゲーム自身の名前で、ファイルの順番のままです。翻訳もグループ分けもしません。手書きの一覧ではなくファイルを読んでいるからです。',
    'unset' => '未設定です。ゲームが例として挙げているもので、入力すると追加されます。',
    'group_all' => '設定',
    'group_all_helper' => 'このファイルが挙げているすべて。',
    'subheading' => ':files から作られます。誰かが書き出した一覧からではありません。',
];
