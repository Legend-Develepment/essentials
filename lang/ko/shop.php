<?php

/*
 * 한국어. 손으로 썼다.
 *
 * 상점 설정, 그리고 나중에는 상점 자체.
 *
 * 두 부류의 읽는 이가 이 파일을 나눠 쓰는 것은 일부러 그렇게 한 것이다. 설정
 * 쪽은 관리자가 읽는다. 공개 페이지와 손님 쪽 - 상점이 자라면서 덧붙는다 - 은
 * Pelican이라는 이름조차 들어 본 적 없을 사람들이 읽으므로, 그쪽 문장은 모두 그
 * 사람들을 위해 쓴다.
 */

return [
    'title' => '상점 설정',
    'nav_label' => '상점 설정',
    'subheading' => '통화, 세금, 청구서 번호 매기기, 그리고 공개 페이지가 하는 말. 파는 것 자체는 패키지 페이지에 있다.',

    // ---- 어디에 있는가 ---------------------------------------------------
    'address' => '공개 상점의 주소',
    'address_off' => '공개 페이지가 꺼져 있다. Essentials 설정 페이지의 기능 목록에서 "공개 상점 페이지"를 켜면 :url 이 응답한다.',

    // ---- 일반 ------------------------------------------------------------
    'section_general' => '돈',
    'section_general_helper' => '상점 전체에 통화 하나. 모든 패키지의 모든 값은 그 통화로 된 숫자일 뿐이다.',
    'currency' => '통화',
    'currency_helper' => '바꿔도 아무것도 환산되지 않는다. 패키지 값은 그냥 숫자이고, 바꾼 뒤에는 그 숫자가 새 통화의 숫자가 된다.',
    'tax' => '세금',
    'tax_helper' => '모든 청구서에 별도 줄로 더해지는 백분율. 패키지 값은 세금이 빠진 값이다. 없으면 0.',
    'tax_suffix' => '%',
    'prefix' => '청구서 번호의 시작',
    'prefix_helper' => '그 뒤에 늘어나는 번호가 붙는다. INV- 이면 INV-000001 이 된다.',

    // ---- 갱신 ------------------------------------------------------------
    'section_renewals' => '갱신',
    'section_renewals_helper' => '달마다, 분기마다, 해마다 청구하는 패키지를 위한 항목. 한 번 결제 패키지는 여기에 걸리지 않는다.',
    'notice_days' => '기간이 끝나기 며칠 전에 청구할지',
    'notice_days_helper' => '다음 청구서가 만들어지고 손님에게 알림이 가는 시점.',
    'grace' => '납부 기한이 지난 뒤 며칠 만에 멈출지',
    'grace_helper' => '이 선을 넘도록 내지 않은 청구서가 있으면 서버가 멈춘다. Pelican의 정지 기능을 쓰며, 청구서가 결제되는 순간 풀린다. 정지 자체는 아무것도 지우지 않는다.',
    'days' => '일',

    // ---- 공개 페이지 -----------------------------------------------------
    'section_public' => '공개 페이지',
    'section_public_helper' => '계정 없는 사람이 읽는 페이지. 애초에 보일지 말지는 기능 목록의 "공개 상점 페이지" 스위치가 정한다.',
    'heading' => '제목',
    'heading_helper' => '비워 두면 패널 자체의 이름을 쓴다.',
    'note' => '패키지 위에 놓는 한 줄',
    'note_helper' => '당신이 누구인지, 사면 무엇을 얻는지 적는 곳. 그냥 글.',
    'terms_url' => '이용약관',
    'terms_url_helper' => 'https 주소. 넣어 두면, 사는 일은 그곳을 가리키는 칸에 표시하는 일이 된다.',

    // ---- 손으로 결제 -----------------------------------------------------
    'section_manual' => '결제사 없이 내는 방법',
    'section_manual_helper' => '결제사를 하나도 켜지 않은 동안 미결제 청구서에 나오는 글. 계좌나 돈을 어디로 보낼지 적는다. 그냥 글.',
    'pay_note' => '내는 방법',
    'pay_note_helper' => '비워 두면 미결제 청구서는 아직 내지 않았다는 것만 말한다.',

    // ---- 단추 ------------------------------------------------------------
    'save' => '저장',
    'saved' => '저장했다',
    'save_failed' => '아무것도 저장되지 않았다',

    /* ---------------------------------------------------------------------
     * 여기서부터 아래는 상점 자체.
     *
     * 전혀 다른 읽는 이다. 서버를 사는 사람이고, Pelican이라는 이름조차 들어 본 적
     * 없을 수 있으며 egg가 무엇인지도 모른다. 아래에서는 패널의 말을 하나도 쓰지
     * 않고, 모든 문장이 그 자리에서 손님이 실제로 품는 물음에 답한다.
     * ------------------------------------------------------------------- */

    // ---- 상점 ------------------------------------------------------------
    'store_title' => '상점',
    'store_nav_label' => '상점',
    'store_subheading' => '서버를 고르세요. 청구서가 결제되는 즉시 만들어 드립니다.',
    'store_empty' => '지금은 판매 중인 것이 없습니다',
    'store_empty_body' => '나중에 다시 오시거나, 이 패널을 운영하는 사람에게 물어보세요.',

    'buy' => '구매',
    'sold_out' => '품절',
    'plus_setup' => '＋ 최초 1회 :amount',

    'spec_memory' => '메모리 :amount MiB',
    'spec_disk' => '디스크 :amount MiB',
    'spec_cpu' => 'CPU :amount%',
    'spec_backups' => '백업 :count개',
    'spec_databases' => '데이터베이스 :count개',

    // ---- 공개 페이지 -----------------------------------------------------
    'public_empty' => '지금은 판매 중인 것이 없습니다',
    'public_empty_body' => '나중에 다시 오세요.',
    'to_panel' => '로그인',
    'terms' => '이용약관',
    'sign_in_note' => '아래에서 서버를 고르세요. 마무리하려면 로그인하시고, 청구서가 결제되면 서버가 만들어집니다.',
    'to_account' => '내 계정',
    'filter_all' => '전체',
    'filter_label' => '보기',
    'includes' => '포함',
    'public_count' => ':count개 판매 중',

    // ---- 주문 ------------------------------------------------------------
    'checkout_title' => '주문',
    'tax_line' => '세금 (:rate%)',
    'coupon' => '쿠폰 코드',
    'asks' => '서버에 대해',
    'upload_default' => '파일',
    'upload_help' => 'zip 파일입니다. 서버를 만들 때 서버 안으로 들어갑니다.',
    'upload_busy' => '올리는 중…',
    'what_is_this' => '이게 뭔가요?',
    'refused_no_file' => '이 패키지에는 파일이 필요한데 아무것도 고르지 않으셨습니다.',
    'refused_not_zip' => '그것은 zip 파일이어야 합니다.',
    'refused_too_big' => '그 파일은 이 패널이 받기에 너무 큽니다.',
    'coupon_placeholder' => '가지고 계시다면',
    'coupon_bad' => '그 코드는 여기서 쓸 수 없습니다.',
    'coupon_good' => '코드를 적용했습니다.',
    'agree' => '동의합니다:',
    'place_order' => '주문하기',
    'place_order_note' => '여기서 청구서가 발행됩니다. 결제하실 때까지 아무것도 청구되지 않으며, 서버는 결제 후에 만들어집니다.',
    'back_to_store' => '상점으로 돌아가기',

    'placed' => '주문했습니다',
    'placed_body' => '청구서 :number 가 결제 페이지에서 기다리고 있습니다.',

    'refused' => '구매하지 못했습니다',
    'refused_gone' => '더 이상 판매하지 않습니다.',
    'refused_sold_out' => '마지막 하나가 나갔습니다.',
    'refused_bad_coupon' => '이 쿠폰 코드는 여기에 쓸 수 없습니다.',
    'refused_failed' => '주문을 기록하는 중에 문제가 생겼습니다. 청구된 것은 없습니다. 다시 시도해 보시고, 계속되면 이 패널을 운영하는 사람에게 알려 주세요.',

    // ---- 결제 ------------------------------------------------------------
    'billing_title' => '결제',
    'billing_nav_label' => '결제',
    'billing_subheading' => '무엇을 사셨고 무엇이 남아 있는지.',
    'your_orders' => '내 주문',
    'your_invoices' => '내 청구서',
    'no_orders' => '아직 구매하신 것이 없습니다',
    'no_orders_body' => '구매하신 것은 서버와 날짜와 함께 여기에 나타납니다.',
    'no_invoices' => '아직 청구서가 없습니다',
    'to_store' => '상점으로',
    'renews' => '갱신일',
    'ask_how_to_pay' => '결제 방법은 이 패널을 운영하는 사람에게 물어보세요. 아직 여기에 적어 두지 않았습니다.',
    'order_pending' => '청구서 결제를 기다리고 있습니다. 결제되면 곧바로 서버가 만들어집니다.',
    'order_suspended' => '미결제 청구서 때문에 멈춰 있습니다. 결제하시면 서버가 다시 돕니다. 아무것도 지우지 않았습니다.',
    'order_ending' => ':date 에 끝납니다. 다시 청구되지 않고, 그날 그 위에 있는 것은 모두 지워집니다.',
    'order_ending_open' => '취소되었습니다. 다시 청구되지 않고, 없어질 때까지 계속 돌아갑니다.',

    // ---- 결제하기 --------------------------------------------------------
    'pay_with' => '결제 수단',
    'pay_now' => '결제',
    'pay_description' => '청구서 :number',
    'pay_thanks' => '감사합니다. 청구서가 결제되었습니다.',
    'pay_pending' => '결제사가 아직 확인해 주지 않았습니다. 확인되는 대로 이 페이지가 갱신됩니다.',
    'pay_refused' => '시작되지 않았습니다',
    'pay_refused_body' => '결제를 열지 못했습니다. 다른 방법을 쓰시거나, 이 패널을 운영하는 사람에게 물어보세요.',
    'gateway_mollie' => 'Mollie',

    // ---- 결제사 설정 -----------------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'iDEAL, 카드, Bancontact 등을 계정 하나로 받는다. 테스트와 실제는 같은 설정이며, 어느 계정의 것인지는 열쇠 자체가 말해 준다.',
    'mollie_on' => 'Mollie 제공',
    'mollie_on_helper' => '끄면 모든 청구서에서 단추가 사라진다. 이미 결제된 것은 그대로다.',
    'mollie_key' => 'API 열쇠',
    'mollie_key_helper' => 'Mollie 대시보드의 Developers 부분에서. 내보낸 설정 파일에는 결코 들어가지 않는다.',
    'mollie_hook' => 'Webhook 주소',
    'mollie_hook_helper' => 'Mollie는 :url 로 알려 온다. 인터넷에서 그 주소로 패널에 닿을 수 있어야 한다.',

    'gateway_stripe' => '카드',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => '카드는 Stripe가 직접 그리는 페이지에서 받으므로, 카드 번호가 이 패널에 닿는 일이 없다. 테스트와 실제는 열쇠의 앞글자에 있지, 스위치에 있지 않다.',
    'stripe_on' => 'Stripe 제공',
    'stripe_on_helper' => '끄면 모든 청구서에서 단추가 사라진다. 이미 결제된 것은 그대로다.',
    'stripe_key' => '비밀 열쇠',
    'stripe_key_helper' => 'Developers의 API keys에 있는 sk_로 시작하는 것. 내보낸 설정 파일에는 결코 들어가지 않는다.',
    'stripe_hook' => '서명 비밀값',
    'stripe_hook_key_helper' => '아래 주소를 추가할 때 Stripe가 보여 주는 whsec_ 값. 이것이 없으면 그쪽 알림이 진짜임을 증명할 수 없어 무시된다.',
    'stripe_hook_helper' => 'Developers의 webhooks에서 :url 을 endpoint로, checkout.session.completed 이벤트에 추가하라.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => '셋 가운데 유일하게, 돈이 움직이는 때는 손님이 돌아온 순간이지 아직 PayPal에 있을 때가 아니다. 그래서 탭을 닫아도 사라진 결제가 아니라 미결제 청구서가 남는다.',
    'paypal_on' => 'PayPal 제공',
    'paypal_on_helper' => '끄면 모든 청구서에서 단추가 사라진다. 이미 결제된 것은 그대로다.',
    'paypal_sandbox' => '샌드박스',
    'paypal_sandbox_helper' => '진짜 계정 대신 PayPal의 시험용 계정과 이야기한다. 그쪽 client id는 어느 쪽이든 똑같이 생겼고, 그래서 이 스위치가 있다.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Apps & Credentials에서 만든 앱의 것. 탭이 위의 스위치와 맞는지 확인하라.',
    'paypal_secret_helper' => 'client ID 옆, Show 뒤에. 내보낸 설정 파일에는 결코 들어가지 않는다.',
    'paypal_hook' => 'Webhook ID',
    'paypal_hook_id_helper' => 'webhook을 추가한 뒤 PayPal이 붙여 주는 ID이지 주소가 아니다. 이것이 없으면 그쪽에 알림을 확인할 수 없어 무시된다.',
    'paypal_hook_helper' => '그 앱에서 :url 을 PAYMENT.CAPTURE.COMPLETED 용 webhook으로 추가하고, 받은 ID를 여기 붙여 넣어라.',

    // ---- 결제 페이지 -----------------------------------------------------
    'pay_title' => '결제',
    'pay_subheading' => '내셔야 할 금액과, 그 방법들.',
    'pay_choose' => '어떻게 결제하시겠습니까?',
    'pay_choose_body' => '무엇을 고르시든 그쪽 페이지에서 마무리하시고, 바로 뒤에 이곳으로 돌아오십니다.',
    'pay_safe' => '결제는 결제사 쪽에서 이루어집니다. 카드 정보가 이 패널에 닿는 일은 없습니다.',
    'pay_no_ways' => '입금이 확인되는 대로 청구서는 결제됨이 되고, 서버가 준비됩니다.',
    'free' => '결제하실 금액이 없습니다',
    'free_body' => '쿠폰 코드가 이 청구서를 전부 덮어서 결제하실 것이 없습니다. 버튼을 누르시면 끝납니다.',
    'free_go' => '완료',
    'free_done' => '마무리되었습니다',
    'free_done_body' => '결제하실 금액이 없어 청구서가 닫혔습니다. 서버는 지금 만들어지고 있습니다.',
    'pay_gone' => '그런 청구서는 없습니다',
    'pay_gone_body' => '철회되었거나, 주소가 잘못되었을 수 있습니다.',
    'pay_already' => '이건 이미 결제되었습니다',
    'pay_already_body' => '더 하실 일은 없습니다. 기다리던 것은 이미 진행 중입니다.',
    'pay_withdrawn' => '이건 철회되었습니다',
    'pay_withdrawn_body' => '장부에서 빠졌고 결제하실 필요가 없습니다. 이상해 보이면 이 패널을 운영하는 사람에게 물어보세요.',
    'back_to_billing' => '결제 목록으로',

    'gateway_mollie_note' => 'iDEAL, Bancontact, 카드 등',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'PayPal 잔액, 또는 PayPal을 통한 카드',

    // ---- 서비스와 청구서를 나눔 ------------------------------------------
    'services_title' => '내 서비스',
    'services_nav_label' => '내 서비스',
    'services_subheading' => '결제하고 계신 것들과, 각각이 된 서버.',
    'open_server' => '서버 열기',
    'no_server_yet' => '준비 중',

    'invoices_title' => '청구서',
    'invoices_subheading' => '청구된 내용과, 아직 남은 결제.',
    'no_invoices_body' => '구매하신 것은 모두 여기서 청구되고, 결제한 뒤에도 여기 남습니다.',

    // ---- 상점을 첫 페이지로 ----------------------------------------------
    'section_landing' => '상점이 놓이는 자리',
    'section_landing_helper' => '상점이 손님에게도, 로그인하지 않은 사람에게도 패널의 정문이 되는지.',
    'landing' => '상점을 먼저 열기',
    'landing_helper' => '켜면 로그인 뒤 첫 페이지가 상점이 되고, 서버 목록은 그 옆으로 옮겨간다. 내 서비스와 청구서는 상점 머리글과 계정 메뉴에서 한 번에 열린다. 로그인하지 않은 사람에게는 로그인 화면 대신 공개 상점이 보이고, 패키지를 고른 뒤에야 로그인을 요구한다. 그래서 공개 상점 페이지도 함께 켜져 있어야 한다. 끄면 패널은 Pelican이 그리는 대로 서버 목록에서 열리고, 로그인하지 않은 사람에게는 로그인 화면이 보이며, 상점은 다른 페이지와 같은 한 페이지가 된다.',
];
