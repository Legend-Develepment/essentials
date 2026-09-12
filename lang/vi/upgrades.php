<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Chuyển một dịch vụ đang chạy từ gói này sang gói khác.
 *
 * Chữ ở đây giữ một điều cho rõ suốt từ đầu tới cuối: một gói giá bao nhiêu và
 * đổi sang nó hôm nay tốn bao nhiêu là hai con số khác nhau. Con số thứ nhất
 * nằm trên kệ; con số thứ hai tùy vào dịch vụ này đã đi được bao xa trong kỳ
 * đã trả tiền, và đó mới là con số người ta đồng ý khi bấm nút.
 *
 * Chữ "nâng cấp" được tránh trong những gì khách đọc, bởi vì một nửa số lần
 * chuyển là đi theo chiều ngược lại. Ở đây gọi là đổi.
 */

return [
    // ---- trên thẻ dịch vụ ------------------------------------------------
    'change' => 'Đổi gói',
    'change_body' => 'Phần còn lại của kỳ bạn đã trả tiền được trừ đi, và đúng số ngày ấy được tính theo giá mới. Không có gì trên máy chủ của bạn mất đi cả.',
    'change_to' => 'Đổi sang :name',
    'change_confirm' => 'Đổi dịch vụ này sang :name?',
    'change_free' => 'Không phải trả gì',
    'costs_now' => 'trả :amount bây giờ',
    'gives_back' => 'trả lại :amount',
    'waiting' => 'Đã chốt việc đổi',
    'waiting_for' => 'Một lần đổi sang :name đang chờ một hóa đơn chưa trả.',

    // ---- điều xảy ra sau đó ----------------------------------------------
    'done' => 'Đã chuyển sang :name',
    'done_body' => 'Dịch vụ của bạn đang ở gói mới. Phần bạn được nhận lại nằm trong tài khoản của bạn.',
    'refused' => 'Việc đổi không được thực hiện',

    // ---- và vì sao không, mỗi lần một lý do ------------------------------
    'refused_off' => 'Bảng điều khiển này đã tắt việc đổi gói.',
    'refused_not_active' => 'Chỉ dịch vụ đang chạy mới đổi được. Dịch vụ đang chờ, đã dừng hay sắp kết thúc thì không có gì để tính.',
    'refused_gone' => 'Gói mà dịch vụ này đang dùng không còn tồn tại, nên không có gì để so.',
    'refused_same' => 'Đó chính là gói nó đang dùng.',
    'refused_egg' => 'Gói đó chạy phần mềm khác. Nó sẽ là một máy chủ khác chứ không phải một máy chủ to hơn, nên phải mua thành một cái riêng.',
    'refused_period' => 'Gói đó tính tiền theo một kỳ khác, và đó là một thỏa thuận khác chứ không phải một thỏa thuận lớn hơn.',
    'refused_stock' => 'Gói đó đã hết hàng.',
    'refused_waiting' => 'Đã có một lần đổi đang chờ một hóa đơn chưa trả cho dịch vụ này. Hãy trả hoặc hủy cái đó trước.',
    'refused_failed' => 'Không có gì được ghi lại, nên không có gì thay đổi. Hãy thử lại, và báo cho người quản lý bảng điều khiển này nếu chuyện cứ lặp lại.',
    'refused_server' => 'Máy chủ không nhận được giới hạn mới, nên dịch vụ được giữ y nguyên như cũ. Người quản lý bảng điều khiển này đã được báo.',

    // ---- những gì ghi trên giấy tờ ---------------------------------------
    'line' => 'Đổi từ :from sang :to, cho :days ngày còn lại của kỳ này',
    'credit_reason' => 'Đổi sang :name',

    // ---- và những gì chủ nhân nghe thấy ----------------------------------
    'bell_failed' => 'Một lần đổi gói đã hỏng ở đơn hàng :number',
    'cold_title' => 'Một lần đổi gói tới được bảng điều khiển nhưng chưa tới node, ở đơn hàng :number',
    'cold_body' => 'Dịch vụ đang ở :name và giới hạn mới đã được ghi lại. Node chưa nhận chúng và sẽ đọc vào lần kế tiếp máy chủ ấy khởi động, nên tới lúc đó khách vẫn đang dùng cỡ cũ. Hãy kiểm tra node.',
    'gone' => 'Gói được chuyển sang không còn tồn tại.',
    'refused_by_node' => 'Máy chủ không chịu nhận giới hạn mới: :why',

    // ---- sửa lại cho đúng -------------------------------------------------
    'retry' => 'Thử đổi lại',
    'retry_confirm' => 'Thử lại lần đổi gói. Hóa đơn cho nó đã được trả rồi, nên không có gì bị tính tiền hai lần.',
    'retried' => 'Việc đổi đã xong',
    'retry_failed' => 'Lại hỏng lần nữa. Lý do nằm trên đơn hàng.',
];
