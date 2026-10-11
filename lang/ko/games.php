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
    'save' => '저장',
    'saved' => '저장했습니다',
    'restart' => '게임은 시작할 때 이 파일을 읽으므로, 변경을 적용하려면 서버를 다시 시작하세요.',
    'failed' => '저장하지 못했습니다',
    'failed_write' => '데몬이 쓰기를 거부했습니다. 서버에 연결할 수 있는지, 파일이 읽기 전용이 아닌지 확인하세요.',
    'read_only' => '이 파일은 읽을 수 있지만 쓸 수는 없으므로 여기서는 아무것도 바꿀 수 없습니다.',
    'missing' => '이 서버에는 아직 설정 파일이 없습니다. 게임이 처음 실행될 때 만들므로 서버를 한 번 시작하면 이 페이지가 채워집니다.',
    'keeps' => '파일의 나머지 - 주석, 빈 줄, 순서, 이 플러그인이 모르는 모든 키 - 는 저장해도 그대로 남습니다.',
    'raw' => '여기 이름은 게임 자체의 이름이며 파일 순서 그대로입니다. 번역하거나 묶지 않습니다. 손으로 쓴 목록이 아니라 파일을 읽기 때문입니다.',
    'unset' => '설정되지 않았습니다. 게임이 예시로 언급한 항목이며, 입력하면 추가됩니다.',
    'group_all' => '설정',
    'group_all_helper' => '이 파일이 언급하는 모든 것.',
    'subheading' => ':files 에서 만들어집니다. 누군가 적어 둔 목록이 아니라.',
];
