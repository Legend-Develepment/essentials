<?php

/*
 * 한국어. 손으로 옮겼습니다.
 *
 * 게임 모드와 난이도는 옮기지 않습니다. Minecraft는 게임 안에서 Survival,
 * Creative, Peaceful, Hard로 보여 줍니다 - 나온 화면과 다른 이름을 붙인 설정은 두
 * 번 찾아봐야 하는 설정입니다.
 *
 * server.properties 안에 적힌 말도 마찬가지입니다. whitelist, operator, seed,
 * chunk, RCON, query, resource pack, 그리고 the Nether.
 */

return [
    /* ------------------------------------------------ 관리 탭 ------------ */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft 설정',
    'subheading' => '이 서버 자신의 server.properties를, 텍스트 파일이 아니라 양식으로.',

    /*
     * 제목은 여기 없습니다. 설정의 각 절은 settings.groups.<이름>에서 제목을 가져
     * 옵니다. group()이 짓는 것이고, 이 파일 자신의 'section' 키에 있던 두 번째 사
     * 본은 정작 진짜가 통째로 빠져 있는 동안 아무 데서도 쓰이지 않았습니다.
     */
    'section_helper' => '이것이 어느 egg에 적용되는지, 그리고 Minecraft를 두고 이 플러그인이 하는 나머지 모든 것.',

    'live' => '누가 놀고 있는지 서버에 묻기',
    'live_helper' => '플레이어 페이지에 접속 중인 사람의 목록을 실시간으로 더합니다. Minecraft 클라이언트가 자기 서버 목록을 그릴 때 쓰는 것과 같은 악수를 씁니다. 기본은 꺼짐입니다. 여기서 패널이 게임 포트로 곧장 연결을 여는 유일한 기능이기 때문입니다. 패널과 노드가 서로 닿지 못하는 망에 있으면 아무것도 답하지 않고, 그 줄은 그냥 나타나지 않습니다. 게임 서버 쪽에서 켜야 할 것은 없습니다.',

    'eggs' => '어느 egg가 Minecraft인가',
    'eggs_helper' => 'Minecraft 서버를 돌리는 egg에 표시하세요 - Vanilla, Paper, Purpur, Fabric, Forge, 그리고 여러분이 붙인 이름의 것들. 그것을 쓰는 서버 안에만 이 페이지가 나타납니다. 처음에는 아무것도 표시되어 있지 않습니다. 일부러 그렇게 했습니다. egg에 어떤 이름을 붙였는지 플러그인은 알 수 없고, 짐작으로 만든 목록은 내놓은 그 주에 누군가의 패널에서 틀리게 됩니다.',

    /* --------------------------------------------- 서버의 페이지 --------- */

    'groups' => [
        'general' => '서버',
        'players' => '플레이어',
        'world' => '월드',
        'performance' => '성능',
        'access' => '접근과 부가 기능',
        'other' => '파일의 나머지 전부',
    ],

    'other_helper' => 'server.properties에서 읽어 있는 그대로 둔 것들입니다. mod와 modpack이 자기 설정을 여기 둡니다. 존재를 알 수 있도록 보여 줄 뿐이고, 고치는 것은 파일 관리자에서 합니다. 이 페이지를 저장해도 이것들은 절대 건드리지 않습니다.',

    'reload' => '파일 다시 읽기',

    'saved' => 'server.properties에 저장했습니다',
    'saved_helper' => '다음에 서버가 켜질 때 적용됩니다.',

    'running' => '서버가 돌고 있습니다',
    'running_helper' => 'Minecraft는 시작할 때 server.properties를 읽고 멈출 때 다시 씁니다. 그래서 지금 저장한 것은 나가는 길에 덮어써집니다. 서버를 멈추고 다시 저장하세요.',

    'missing' => 'server.properties를 찾지 못했습니다',
    'missing_helper' => '이 파일은 서버를 처음 켤 때 생깁니다. 한 번 켠 뒤에 돌아오세요.',

    'failed' => '저장하지 못했습니다',
    'failed_helper' => 'daemon이 쓰기를 거절했습니다. 이 페이지를 열어 둔 사이에 서버가 켜졌을 수 있습니다.',

    /* ------------------------------------ 각 키가 뜻하는 것 -------------- */

    'keys' => [
        'motd' => '서버 목록에 나올 문구',
        'gamemode' => '게임 모드',
        'difficulty' => '난이도',
        'hardcore' => 'Hardcore - 죽으면 끝',
        'force_gamemode' => '들어올 때 모두를 기본 모드로 되돌리기',
        'pvp' => '플레이어끼리 다치게 할 수 있음',

        'max_players' => '동시에 들어올 수 있는 최대 인원',
        'white_list' => 'whitelist만',
        'enforce_whitelist' => 'whitelist에 없는 사람 내보내기',
        'online_mode' => 'Mojang에 계정 확인',
        'player_idle_timeout' => '몇 분 동안 가만있으면 내보낼지',
        'op_permission_level' => 'operator가 할 수 있는 일 (1-4)',

        'level_name' => '월드 폴더',
        'level_seed' => 'Seed',
        'level_type' => '월드 종류',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => '몬스터가 나타남',
        'spawn_protection' => 'spawn 주변 보호 블록 수',

        'view_distance' => '보이는 거리 (chunk)',
        'simulation_distance' => '계산되는 거리 (chunk)',
        'max_tick_time' => 'Watchdog (밀리초, -1이면 꺼짐)',
        'sync_chunk_writes' => 'chunk를 디스크에 곧장 쓰기',

        'enable_command_block' => '명령 블록',
        'allow_flight' => '비행 허용',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'resource pack 주소',
        'require_resource_pack' => 'resource pack을 필수로',
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
