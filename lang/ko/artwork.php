<?php

/*
 * 한국어. 손으로 옮겼습니다.
 *
 * 'Steam App ID', 'IGDB', 'Twitch client ID', 'client secret'은 그대로 둡니다. 값
 * 을 가져오는 그 페이지에 바로 그 표기로 나오는 말이기 때문입니다.
 */

return [
    'title' => 'egg 그림',
    'nav_label' => 'egg 그림',
    'subheading' => 'egg에 붙일 게임 그림을 Steam과 IGDB에서 가져옵니다. 그림이 없는 egg는 그것을 쓰는 모든 서버 카드에 Pelican 자신의 새를 보여 줍니다.',

    // ---- 표 ---------------------------------------------------------------
    'column_name' => 'egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => '잠김',

    'locked' => '잠김',
    'unlocked' => '열림',

    // ---- 한 줄에 할 수 있는 일 --------------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => '게임의 Steam 상점 주소에 들어 있는 숫자입니다 - store.steampowered.com/app/892970 이면 892970. id로 가져오면 그림이 잠깁니다. 숫자를 입력하는 것은 하나의 결정이고, 나중의 일괄 실행이 그것을 되돌려서는 안 되기 때문입니다.',

    'fetch_igdb' => 'IGDB',
    'search_term' => '찾을 말',
    'search_term_helper' => 'egg의 이름을 넣어 두었지만, 그것이 게임의 이름인 경우는 드뭅니다 - 「Paper 1.20.4」는 Minecraft입니다. 게임 이름을 입력하세요.',

    'lock' => '잠그기',
    'unlock' => '잠금 풀기',
    'locked_done' => '잠갔습니다 - 일괄 가져오기가 이것은 건드리지 않습니다',
    'unlocked_done' => '잠금을 풀었습니다 - 일괄 가져오기가 이 그림을 바꿀 수 있습니다',

    'clear' => '지우기',
    'clear_confirm' => '그림과 Steam App ID를 지웁니다. egg는 Pelican 자신의 새로 돌아가고, 다음 일괄 가져오기에서 다시 시도합니다.',
    'cleared' => '그림을 지웠습니다',

    // ---- 결과 -------------------------------------------------------------
    'fetched' => '그림을 저장했습니다',
    'failed' => '그림이 저장되지 않았습니다',

    /*
     * 경우마다 이유 하나씩. 서로 다른 문제이기 때문입니다.
     *
     * 오타로 실패한 것과 디스크가 가득 차 실패한 것이 똑같이 「실패」라고 말해서는
     * 안 됩니다 - 앞의 것은 숫자를 들여다보면 고쳐지고, 뒤의 것은 서버를 들여다봐야
     * 고쳐집니다.
     */
    'why_bad_id' => '그것은 Steam App ID가 아닙니다.',
    'why_not_found' => '그 주소에 Steam이 가진 것이 없습니다. App ID를 확인하세요 - 상점 페이지가 없는 게임에는 머리 그림도 없습니다.',
    'why_no_match' => '그 이름으로는 아무것도 찾지 못했습니다. egg의 이름 말고 게임의 실제 이름으로 해 보세요.',
    'why_no_name' => '찾을 말이 없습니다.',
    'why_no_token' => 'Twitch가 토큰을 내주지 않았습니다. 인증 정보의 client ID와 secret을 확인하세요.',
    'why_not_configured' => 'IGDB에는 Twitch client ID와 secret이 필요합니다. 인증 정보에서 설정하세요.',
    'why_empty' => '응답이 비어 있었습니다.',
    'why_large' => '그 그림은 아이콘보다 훨씬 커서 저장하지 않았습니다.',
    'why_not_an_image' => '돌아온 것이 그림이 아닙니다. 대개는 오류 페이지가 성공 코드로 답했다는 뜻입니다.',
    'why_wrong_format' => '그 그림은 이 패널이 보관하지 않는 형식입니다. Pelican은 PNG, JPEG, WebP를 보관합니다.',
    'why_unwritable' => '그림을 쓰지 못했습니다. storage/app/public이 패널을 돌리는 사용자의 것인지, php artisan storage:link를 실행했는지 확인하세요.',
    'why_unknown' => '되지 않았고, 그 이유는 여기에 이름이 붙어 있는 종류가 아닙니다.',

    // ---- 한꺼번에 ---------------------------------------------------------
    'bulk' => '없는 것 모두 가져오기',
    'bulk_confirm_steam' => '그림이 없고 잠기지도 않은 모든 egg를 이름으로 Steam에서 찾습니다. 잠긴 egg와 이미 그림이 있는 egg는 그대로 둡니다. 뒤에서 돌며, 끝나면 알려 드립니다.',
    'bulk_confirm_both' => '그림이 없고 잠기지도 않은 모든 egg를 이름으로 Steam에서 찾고, Steam이 찾지 못한 것은 IGDB에서 시도합니다. 잠긴 egg와 이미 그림이 있는 egg는 그대로 둡니다. 뒤에서 돌며, 끝나면 알려 드립니다.',

    'bulk_started' => '뒤에서 가져오는 중',
    'bulk_started_body' => '큰 패널에서는 몇 분 걸릴 수 있습니다. 끝나면 알림이 가고, 이 페이지를 떠나도 됩니다.',

    'bulk_done' => 'egg 그림이 끝났습니다',
    'bulk_done_body' => ':fetched개 가져옴, :skipped개 그대로 둠, :failed개는 찾지 못함. egg가 그대로 남는 것은 잠겨 있거나 이미 그림이 있을 때입니다.',

    'bulk_failed' => '일괄 가져오기가 돌지 않았습니다',
    'bulk_failed_queue' => '대기열에 넘기지 못했습니다. 여기에는 queue worker가 필요합니다 - pelican-queue가 돌고 있는지 확인하세요.',

    // ---- IGDB 인증 정보 ---------------------------------------------------
    'credentials' => '인증 정보',
    'credentials_helper' => 'Steam은 이것 없이도 됩니다. 이건 IGDB만을 위한 것이고, IGDB는 Steam이 들어 본 적 없는 게임을 다룹니다 - Minecraft와 그 모든 갈래, 콘솔로 나온 것들, 그리고 mod가 올라간 egg 대부분.',
    'credentials_where' => 'dev.twitch.tv/console 에서 애플리케이션을 만들고 client secret을 발급한 뒤, 둘 다 여기에 붙여 넣으세요. 무료입니다.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => '인증 정보를 저장했습니다',
    'credentials_failed' => '인증 정보를 저장하지 못했습니다',
];
