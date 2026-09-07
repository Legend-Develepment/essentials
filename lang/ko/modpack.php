<?php

/*
 * 한국어. 손으로 옮겼습니다.
 *
 * 'modpack', 'mod', 'loader', 'egg', 'queue worker'는 그대로 둡니다. Modrinth의
 * 화면에도 Pelican의 화면에도 그 표기로 놓여 있습니다.
 */

return [
    'nav_label' => 'Modpack',
    'title' => 'Modpack',
    'subheading' => 'Modrinth의 modpack을 이 서버에 설치합니다.',

    'section' => '팩 찾기',
    'section_helper' => 'Modrinth만, 그리고 서버 쪽에서 도는 팩만입니다. 계정도 API 키도 필요 없고, 그래서 여기서 유일한 출처입니다 - 다른 곳들은 하나같이, 뭐라도 보이기 전에 키부터 붙여 넣으라고 합니다.',

    'search' => '검색',
    'search_helper' => '비워 두면 내려받기가 많은 순으로 나옵니다. 검색은 Modrinth에 묻는 일이라, 입력하는 동안이 아니라 칸을 벗어날 때 실행됩니다.',

    'pack' => '팩',
    'pack_helper' => '서버에서 돈다고 밝힌 팩만 나열합니다.',

    'version' => '버전',
    'version_helper' => '게임 버전과 loader가 각각의 옆에 보입니다. 이 서버의 egg가 이미 돌리고 있는 loader를 고르세요 - 이것은 파일을 넣을 뿐, egg나 시작 명령을 바꾸지 않습니다.',

    'downloads' => '내려받기',

    'install' => '이 팩 설치',
    'install_go' => '설치하기',
    'install_confirm' => '팩의 파일이 이 서버에 더해집니다. **아무것도 지워지지 않습니다** - 월드도, 예전 mod도, 설정도. 팩 위에 팩을 얹으면 둘 다 남으므로, 그걸 원하지 않는다면 먼저 이전 팩의 mod를 직접 치우세요. 서버는 멈춰 있어야 하고, 멈춘 채로 남습니다.',

    'started' => '설치 중',
    'started_helper' => '팩을 가져와 풀고 있습니다. 파일 몇백 개면 몇 분 걸립니다. 끝나면 알림이 갑니다 - 이 페이지를 떠나도 계속됩니다.',

    'running' => '서버가 돌고 있습니다',
    'running_helper' => 'Minecraft는 시작할 때 mod를 읽으므로, 지금 팩을 넣으면 다시 시작하기 전까지는 옛 팩도 새 팩도 아닌 서버가 됩니다. 멈춘 뒤 다시 해 보세요.',

    'done' => ':pack을(를) 설치했습니다',
    'done_body' => '파일 :files개를 가져오고, 팩 자신의 폴더에서 :overrides개를 제자리에 놓았습니다. 준비되면 서버를 켜세요.',
    'done_refused' => '파일 :count개는 건너뛰었습니다. 팩이 그것들을, 여기서 내려받지 않는 곳에서 요구했기 때문입니다.',

    'failed' => '팩은 설치되지 않았습니다',
    'failed_fetch' => '팩을 가져오거나 풀지 못했습니다. daemon에 닿지 못하거나, 서버의 디스크가 모자란 것일 수 있습니다.',
    'failed_index' => '팩은 가져왔지만 읽을 수 있는 색인이 없어, 설치할 것이 없었습니다.',
    'failed_version' => '그 버전에는 더 이상 내려받을 팩 파일이 없습니다. 다른 것을 고르세요.',
    'failed_queue' => '설치를 대기열에 넣지 못했습니다. 여기에는 패널에서 도는 queue worker가 필요합니다.',
];
