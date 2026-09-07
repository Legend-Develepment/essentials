<?php

/*
 * 한국어. 손으로 옮겼습니다.
 *
 * 'mod', 'plugin', 'loader', 'jar', 'mods/', 'plugins/', 'egg'는 그대로 둡니다.
 * 모두 폴더 이름이거나 파일 이름이거나, Modrinth 화면에 그 표기로 나오는 것입니다.
 */

return [
    'nav_label' => 'Mod와 plugin',
    'title' => 'Mod와 plugin',
    'subheading' => 'Modrinth에서 하나씩, 이 서버로.',

    'section' => '찾기',
    'section_helper' => 'modpack 페이지는 팩을 통째로 설치합니다. 이쪽은 mod나 plugin 하나만 설치합니다. 훨씬 자주 필요한 쪽이 이쪽입니다.',

    'kind' => '무엇을 더하나요',
    /*
     * 짐작하지 않고 묻습니다. egg의 이름은 관리자가 붙인 대로이고, 두 폴더를 모두
     * 읽는 loader도 여럿이라, 여기서 정직하게 알아낼 방법이 없습니다 - 그리고 잘못
     * 짚으면 아무것도 읽지 않는 폴더에 jar를 써 넣게 됩니다.
     */
    'kind_helper' => 'mod는 mods/로 들어가며 Fabric, Forge, NeoForge용입니다. plugin은 plugins/로 들어가며 Bukkit, Spigot, Paper용입니다. 이것은 Modrinth의 어느 쪽을 검색할지도 정합니다.',
    'kind_mod' => 'mod (mods/)',
    'kind_plugin' => 'plugin (plugins/)',

    'search' => '검색',
    'search_helper' => '이름을 입력하고 칸 밖을 누르세요. 결과는 내려받기가 많은 순입니다.',

    'project' => 'mod 또는 plugin',
    'version' => '버전',
    'version_helper' => '각 줄은 버전 번호, 그것이 맞춰진 Minecraft 버전, 그리고 지원하는 loader입니다. 서버에 맞는 것을 고르세요 - 여기서 대신 확인해 주지 않습니다.',

    'install' => '설치',
    'install_confirm' => '파일은 노드가 Modrinth에서 곧장 가져와 폴더에 넣습니다. 이미 있는 것은 지우지 않습니다.',
    'installed' => '설치했습니다',
    'installed_helper' => '다음에 서버가 켜질 때 읽힙니다.',

    'change' => '버전 바꾸기',
    'change_helper' => '같은 프로젝트의 다른 버전을 이 파일 자리에 놓습니다. 옛것을 지우기 전에 새것을 내려받으므로, 내려받기가 실패해도 이미 가진 것은 그대로 남습니다.',
    'change_project_helper' => '이 페이지에서 설치한 것에 대해서는 고정입니다. 이것을 바꾸는 것은 버전 변경이 아니라, 같은 파일 이름의 다른 mod가 되는 일입니다.',
    'change_lookup_helper' => '이 파일은 원래 폴더에 있던 것이라, 여기서는 그것이 무엇인지 알지 못합니다. 한 번 찾아 주면 이후로는 기억합니다.',
    'changed' => '버전을 바꿨습니다',

    'check' => '새 버전 확인',
    'checked' => '확인했습니다',
    'checked_none' => '아는 것은 모두 최신 버전입니다.',
    'checked_some' => ':count개에 더 새로운 버전이 있습니다. 목록에 표시해 두었습니다.',
    'update_ready' => 'v:number 있음',
    /*
     * 풍선 도움말이 아니라 표식 옆에 적었습니다. 표식의 뜻 자체를 바꾸는 단서이기
     * 때문입니다. 여기서는 서버가 어느 Minecraft 버전과 어느 loader를 돌리는지 알지
     * 못하므로, 새로운 것은 새로운 것일 뿐 「돌아가는 것 중 새로운 것」이 아닙니다.
     */
    'check_note' => '「새롭다」는 Modrinth에서 새롭다는 뜻입니다. 여기서는 서버가 어느 Minecraft 버전과 어느 loader를 돌리는지 알지 못하므로, 서버를 켜기 전에 고른 버전이 맞는다고 적혀 있는지 확인하세요.',
    'unknown' => '여기서 넣은 것이 아닙니다 - 「버전 바꾸기」로 무엇인지 알려 주세요',

    'remove' => '지우기',
    'remove_confirm' => '파일을 서버에서 지웁니다. 여기서는 되돌릴 수 없습니다.',
    'removed' => '지웠습니다',

    'running' => '서버가 돌고 있습니다',
    'running_helper' => 'Minecraft가 mods/와 plugins/를 읽는 것은 시작할 때 한 번뿐입니다. 지금 더한 파일은 다시 시작하기 전까지 읽히지 않고, 돌고 있는 게임의 발밑에서 파일을 빼면 게임까지 함께 데려갈 수 있습니다. 먼저 서버를 멈추세요.',

    'failed' => '되지 않았습니다',
    'failed_version' => '그 버전에는 여기서 설치할 수 있는 jar가 없습니다. 어떤 릴리스는 소스만, 또는 클라이언트 build만 담고 있습니다.',
    'failed_write' => '노드가 내려받기를 거절했습니다. Modrinth에 닿지 못했을 수 있습니다.',

    'installed_title' => '설치됨',
    'installed_mods' => 'mods/ 안',
    'installed_plugins' => 'plugins/ 안',
    /*
     * 빈 목록은 헷갈리므로 적어 둡니다. 대개는 무엇이 빠졌다는 뜻이 아니라, 이 서버
     * 가 그 폴더를 아예 쓰지 않는다는 뜻입니다.
     */
    'installed_empty' => '여기에는 아무것도 없습니다. 서버는 이 두 폴더 중 하나만 쓰므로, 한쪽이 비어 있는 것은 흔한 일입니다.',
    'installed_note' => '나열하는 것은 .jar 파일뿐입니다. 설정 폴더와 꺼 둔 파일은 그대로 두었고 여기에 보이지 않습니다.',
];
