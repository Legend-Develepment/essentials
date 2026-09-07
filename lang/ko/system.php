<?php

/*
 * 한국어. 손으로 옮겼습니다.
 *
 * 시스템 상태 페이지: 패널 자신이 도는 기계와, 그 옆에 놓으라고 지정한 노드.
 *
 * 둘이 나뉘어 있는 어떤 설치에서도 이것은 노드와 같은 기계가 아니며, 그래서 둘이
 * 한 페이지에 같이 놓일 수 있습니다.
 *
 * 'Swap', 'Wings', 'PHP', 'uptime'은 그대로 둡니다. 기계 위에서도, 사람들이 견주어
 * 볼 모든 도구에서도 그 이름이기 때문입니다.
 */

return [
    'title' => '시스템 상태',
    'nav_label' => '시스템 상태',
    'subheading' => '패널 자신이 도는 기계와, 거기서 돌고 있는 것들, 그리고 그 옆에 놓으라고 지정한 노드.',

    'options' => '선택',
    'enabled' => '사이드바에 보이기',
    'enabled_helper' => '끄면 그 줄이 사이드바에서 빠집니다. 페이지는 자기 주소를 그대로 지니므로, 언제든 다시 켤 수 있습니다.',

    'refresh' => '다시 읽는 간격',
    'refresh_helper' => '이 간격으로 페이지 전체를 다시 요청합니다. 끄면 열었을 때 그대로 둡니다.',
    'refresh_off' => '내가 열 때만',
    'refresh_seconds' => ':seconds초',

    'blocks' => '보일 것',
    'blocks_helper' => '표시한 것이 보입니다. 디스크는 파일 시스템마다 카드 하나씩입니다. 가득 찬 루트 파티션이 절반 빈 데이터 마운트 뒤에 가려지지 않도록 하기 위해서입니다.',
    'block_cpu' => '프로세서',
    'block_memory' => '메모리',
    'block_swap' => 'Swap',
    'block_disk' => '디스크',
    'block_load' => '평균 부하',
    'block_uptime' => 'Uptime',
    'block_system' => '시스템',
    'block_version' => '패널 버전',
    // 절대 보이지 않습니다 - 노드 카드는 노드 자신의 이름을 씁니다 - 그러나 blank()
    // 가 이것을 찾고, 빠진 키가 자기 이름을 찍는 것은 모자란 대비책입니다.
    'block_node' => '노드',

    'nodes' => '보일 노드',
    'nodes_helper' => '패널의 기계 옆에 하나씩 카드로. 아무것도 표시하지 않으면 하나도 보이지 않습니다 - 대시보드에는 이미 모든 노드가 담긴 블록이 있습니다. 각각은 자기 daemon에 묻는 것이라, 짧은 간격에 긴 목록이면 요청이 아주 많아집니다.',

    'section_usage' => '사용량',
    'section_host' => '이 패널',
    'section_nodes' => '노드',

    'disk_panel' => '패널은 여기에 있습니다',
    'wings' => 'Wings :version',
    'version_installed' => '설치됨',
    'version_latest' => '최신',
    'version_current' => '최신입니다',
    'version_update' => '새 버전 있음',
    'version_unknown' => '확인하지 못함',

    /*
     * 뒤처진 카드가 내놓는 것.
     *
     * 갱신을 수행하는 버튼이 아니라 릴리스로 가는 링크입니다. 여기서 수행할 갱신이
     * 없기 때문입니다. Pelican에는 업그레이드 명령이 없고, Wings에는 자기 바이너리
     * 를 갈아 끼우는 엔드포인트가 없습니다. 도움말이 실제 작업이 어디서 일어나는지
     * 를 말해 줍니다. 애초에 있을 수 없었던 버튼을 아무도 찾아 나서지 않도록.
     */
    'version_release' => '새로운 것',
    'version_how_panel' => '릴리스 노트를 엽니다. 패널의 업그레이드는 그것이 도는 기계 위에서 합니다 - 패널은 자기 파일을 갈아 끼울 수 없고, 어떤 플러그인도 셸 명령을 돌릴 수 없습니다.',
    'version_how_wings' => '릴리스 노트를 엽니다. Wings는 노드 위에서 갱신합니다 - 다른 기계에서 도는 프로그램으로 가는 통로를 패널은 갖고 있지 않습니다.',

    'wings_latest' => '최신 :version',
    'load_cores' => '프로세서 :cores개 중 :percent%',
    'load_windows' => ':five (5분) · :fifteen (15분)',
    'uptime_since' => ':date 부터',
    'unavailable' => '이 기계에서는 알 수 없음',

    'fact_os' => '운영 체제',
    'fact_hostname' => '호스트 이름',
    'fact_php' => 'PHP',
    'fact_cores' => '프로세서',
    'fact_processes' => '프로세스',
];
