<?php

/*
 * 한국어. 손으로 옮겼습니다.
 *
 * 대시보드의 블록. 패널이 도는 기계와 모든 노드.
 *
 * 노드의 수치는 Pelican의 것으로, 각 노드의 daemon에서 읽어 옵니다. 패널 줄은
 * /proc에서 읽으며, 이는 다른 질문입니다 - Support\SystemStatus를 보세요.
 *
 * 'CPU'는 그대로 둡니다. 이 화면을 보는 사람이 다른 모든 곳에서 마주치는 표기이기
 * 때문입니다.
 */

return [
    'title' => '머신',
    'panel' => '이 패널',
    'offline' => '응답 없음',
    'maintenance' => '점검 중',
    'cpu' => 'CPU',
    'memory' => '메모리',
    'disk' => '디스크',
    'load' => '부하',
];
