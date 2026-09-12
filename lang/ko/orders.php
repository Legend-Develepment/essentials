<?php

/*
 * 한국어. 손으로 썼다.
 *
 * 주문. 누가 무엇을 샀고 그것이 어떻게 되었는가.
 *
 * 아래 네 가지 상태는 돈에 관한 것이지 서버에 관한 것이 아니다. 서버가 지금
 * 돌고 있는지는 Pelican 자신의 물음이고 Pelican의 페이지가 답한다. 여기 말들은
 * 그 둘을 따로 둔다.
 */

return [
    'title' => '주문',
    'nav_label' => '주문',
    'subheading' => '팔린 모든 것과, 거기서 생긴 서버, 그리고 지금 어떤 상태인지.',

    // ---- 표 --------------------------------------------------------------
    'column_order' => '주문',
    'column_customer' => '고객',
    'column_package' => '패키지',
    'column_server' => '서버',
    'column_state' => '상태',
    'column_due' => '다음 기한',

    'no_server' => '아직 만들지 않음',
    'no_due' => '한 번 결제',
    'gone_customer' => '계정 삭제됨',
    'gone_package' => '패키지 삭제됨',
    'overdue_days' => ':days일 지남',

    'state_pending' => '대기',
    'state_active' => '사용 중',
    'state_suspended' => '정지',
    'state_cancelled' => '취소',

    // ---- 단추 ------------------------------------------------------------
    'retry' => '다시 만들기',
    'retry_confirm' => '만드는 일을 한 번 더 대기열에 넣는다. 다른 것은 아무것도 바뀌지 않고 청구서는 결제된 채로 남는다.',
    'retrying' => '대기열에 넣었다',

    'suspend' => '정지',
    'suspend_confirm' => 'Pelican의 정지 기능으로 서버를 멈춘다. 파일과 데이터베이스와 백업은 그대로 있고, 청구서를 결제하면 풀린다.',
    'suspended' => '정지했다',

    'unsuspend' => '정지 풀기',
    'unsuspended' => '다시 돌고 있다',

    'change_due' => '기한 바꾸기',
    'change_due_helper' => '다음 청구서를 언제 쓸지. 비워 두면 영영 쓰지 않는다. 주문은 취소되지 않은 채로 갱신을 멈춘다.',

    'cancel' => '취소',
    'cancel_confirm' => '서비스는 :date까지 돌아가고 다시 청구하지 않는다. 그날 서버는 안에 든 것과 함께 지워진다. 고객에게는 지금 두 가지 모두를 알린다.',
    'cancelled' => '취소했다',

    'saved' => '저장했다',
    'refused' => '아무것도 바뀌지 않았다',
    'refused_body' => '이 주문은 그럴 수 있는 상태가 아니다. 페이지를 새로 고치고 다시 보라.',

    // ---- 고객이 받는 알림 ------------------------------------------------
    'bell_ready' => '서버가 준비되었습니다',
    'bell_ready_body' => ':server 를 만들었습니다. 이제 시작하시면 됩니다.',
    'bell_suspended' => '서버가 정지되었습니다',
    'bell_suspended_body' => '청구서가 유예 기간을 넘겨 결제되지 않았습니다. 결제하시면 서버가 다시 돕니다. 아무것도 지우지 않았습니다.',

    // ---- 관리자가 받는 알림 ----------------------------------------------
    'bell_failed' => '주문 :number 를 만들지 못했다',
    'no_allocation' => '이 패키지의 어느 node에도 빈 allocation이 없다. 하나 넣고 다시 만들어라.',
    'no_reason' => '패널이 이유를 말하지 않고 거절했다.',
    'not_paid' => '이 주문에는 결제된 청구서가 없어 아무것도 만들지 않았다. 결제된 것이 맞다면, 결제된 그 청구서에 이 주문이 올라 있지 않은 것이다 - 이 패널을 굴리는 사람에게 알려라.',

    // ---- 거기서 생기는 서버 ----------------------------------------------
    'server_description' => '상점에서 구매, 주문 :number.',
    'server_fallback' => '서버',
    'state_ending' => '종료 예정',
    'ends_on' => ':date 에 끝남',
    'no_more_dues' => '다시 청구하지 않음',
    'cancel_confirm_open' => '갱신을 지금 멈추고 재고의 자리를 돌려준다. 서버는 돌아가는 채로 둔다. 이 패키지에는 최소 이용 기간이 없어 달려갈 날짜가 없다. 고객이 다 쓰면 Pelican에서 서버를 지운다.',
    'terminate' => '멈추고 지우기',
    'terminate_heading' => '이 서버를 지울까',
    'terminate_confirm' => '서버를 지금 지운다. 파일과 데이터베이스와 백업도 함께 간다. 되돌릴 수 없고 계약이 끝나기를 기다리지도 않는다. 고객이 약속받은 날짜까지 그것을 갖고 있어야 한다면 대신 취소를 쓴다.',
    'terminate_go' => '지운다',
    'terminated' => '지웠다',
    'terminated_body' => '서버는 사라졌고 주문은 닫혔다.',
    'bell_ending' => ':package 는 :date 에 끝납니다',
    'bell_ending_open' => ':package 를 취소했습니다',
    'bell_ending_body' => '이후로는 다시 청구되지 않습니다. 서버가 멈출 때 그 안의 모든 것이 지워지니, 남기고 싶은 것은 미리 백업해 두세요.',
    'bell_ended' => ':package 가 끝났습니다',
    'bell_ended_body' => '계약 기간이 다 되어 서버를 지웠습니다.',
    'bell_undeleted' => '주문 :number 를 지우지 못했다',
    'bell_undeleted_body' => '패널이 서버 지우기를 거절했다. 주문은 닫혔고 아무에게도 청구되지 않지만, 서버는 아직 남아 있어 Pelican에서 없애야 한다.',
    'bell_undelivered' => '주문 :number 의 파일이 아직 여기 있다',
    'bell_undelivered_body' => '서버는 만들어졌지만 고객이 올린 파일을 그 안에 넣지 못했다. 파일은 아직 패널의 저장 공간에 있고, 이유는 storage/logs에 적혀 있다.',
    'by_customer' => '고객이 끝냄',
    'by_admin' => '여기서 끝냄',
    'filter_by' => '누가 끝냈나',
    'details' => '자세히',
    'details_of' => '주문 :number',
    'close' => '닫기',
    'detail_package' => '패키지',
    'detail_placed' => '주문일',
    'detail_built' => '서버 생성',
    'detail_due' => '다음 기한',
    'detail_ends' => '종료',
    'detail_suspended' => '정지',
    'detail_cancelled' => '취소',
    'detail_file_in' => '파일 넣음',
    'detail_file_waiting' => '파일',
    'detail_file_waiting_value' => '올렸고, 서버가 만들어지기를 기다리는 중.',
    'detail_note' => '마지막 문제',

    'empty' => '아직 팔린 것이 없다',
    'empty_body' => '누군가 패키지를 사는 순간 주문이 여기 나타난다.',

    // ---- 갱신 ------------------------------------------------------------
    'filter_late' => '청구가 밀림',
    'run_renewals' => '갱신 지금 실행',
    'run_renewals_confirm' => '야간 처리와 같은 일을 한다. 기한이 가까운 것에 다음 청구서를 쓰고, 유예 기간을 넘겨 결제되지 않은 청구서가 걸린 서버를 멈춘다.',
    'renewals_queued' => '대기열에 넣었다',
    'renewals_queued_body' => '대기열에서 돈다. 잠시 뒤 새로 고치면 무엇이 바뀌었는지 보인다.',
];
