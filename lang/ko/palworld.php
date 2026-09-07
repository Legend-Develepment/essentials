<?php

/*
 * 한국어. 손으로 옮겼습니다.
 *
 * Palworld의 월드 설정을, 파일이 아니라 페이지로.
 *
 * 여기에는 설정 이름이 하나도 없습니다. 그 페이지의 모든 이름표는 서버 자신의 파일
 * 이 가진 키에서 지어집니다 - 이름 목록을 두는 것이 아무것도 두지 않는 것보다 나쁜
 * 이유는 Support\Palworld\Palworld::label()을 보세요.
 *
 * 'Pal'과 'guild'는 게임 안의 말이라 그대로 둡니다.
 */

return [
    'title' => 'Palworld 설정',
    'nav_label' => 'Palworld',
    'subheading' => '이 서버 자신의 PalWorldSettings.ini에 있는 월드 설정입니다. 이 페이지를 연 시점에 읽었습니다. 서버가 멈춰 있는 동안에만 고칠 수 있습니다.',

    'reload' => '파일 다시 읽기',

    'save_confirm' => '이 값들로 파일을 다시 씁니다. 이 페이지에 나오지 않은 설정은 파일의 나머지와 함께 있던 그대로 되돌려 씁니다.',
    'saved' => '설정을 저장했습니다',
    'saved_body' => '다음에 서버가 켜질 때 적용됩니다.',
    'save_failed' => '파일을 쓰지 못했습니다',

    'running' => '서버가 돌고 있습니다',
    'running_body' => 'Palworld는 이 설정을 메모리에 들고 있다가 멈출 때 파일로 써 냅니다. 그래서 지금 저장해도 한마디 없이 되돌려집니다. 먼저 서버를 멈추세요.',

    'groups' => [
        'server' => '서버와 연결',
        'world' => '월드와 배율',
        'pals' => 'Pal',
        'players' => '플레이어',
        'building' => '건축, 아이템, 채집',
        'guild' => '길드',
        'other' => '그 밖의 것',
    ],
];
