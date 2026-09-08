<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Hóa đơn: bản tài liệu, trang danh sách và thư điện tử.
 *
 * Ba người đọc dùng chung tệp này. Người quản trị đọc bảng rồi bấm "đánh dấu
 * đã trả"; khách đọc bản in được và thư; còn chính bản tài liệu thì nhiều
 * tháng sau người làm sổ sách đọc. Chính vì người sau cùng ấy mà các dòng doc_
 * viết khô và trang trọng - hóa đơn không phải chỗ cho giọng của phần còn lại.
 */

return [
    'title' => 'Hóa đơn',
    'nav_label' => 'Hóa đơn',
    'subheading' => 'Cái gì còn nợ và cái gì đã trả. Đánh dấu ở đây làm đúng những gì việc trả tiền làm: máy chủ được dựng, máy đang dừng thì chạy lại.',

    // ---- bảng ------------------------------------------------------------
    'column_number' => 'Hóa đơn',
    'column_customer' => 'Khách',
    'column_order' => 'Đơn hàng',
    'column_total' => 'Tổng',
    'column_state' => 'Trạng thái',
    'column_due' => 'Hạn trả',

    'kind_order' => 'Hóa đơn đầu',
    'kind_renewal' => 'Gia hạn',

    'state_unpaid' => 'Chưa trả',
    'state_paid' => 'Đã trả',
    'state_cancelled' => 'Đã thu hồi',

    'no_order' => 'Không có đơn hàng',
    'no_due' => 'Không có ngày',
    'gone_customer' => 'Tài khoản đã xóa',
    'discount_of' => 'Giảm :amount với mã :code',
    'paid_via' => 'qua :how',
    'emailed' => 'Đã gửi',
    'not_emailed' => 'Chưa gửi',
    'filter_overdue' => 'Quá hạn',

    // ---- các nút ---------------------------------------------------------
    'open' => 'Mở',
    'mark_paid' => 'Đánh dấu đã trả',
    'mark_paid_confirm' => 'Ghi nhận rằng tiền đã tới. Máy chủ được dựng, máy đang dừng chạy lại, và kỳ hạn kế dời tới trước - y như khi một dịch vụ thanh toán báo về.',
    'paid' => 'Đã đánh dấu là đã trả',
    'paid_body' => 'Mọi thứ đang chờ hóa đơn này đều đã lên đường.',
    'already_paid' => 'Hóa đơn này đã trả rồi',

    'withdraw' => 'Thu hồi',
    'withdraw_confirm' => 'Rút hóa đơn khỏi sổ sách. Chỉ hóa đơn chưa trả mới thu hồi được; hóa đơn đã trả là dấu vết của khoản tiền đã đổi chủ.',
    'withdrawn' => 'Đã thu hồi',
    'withdraw_refused' => 'Chỉ hóa đơn chưa trả mới thu hồi được',

    'empty' => 'Chưa có hóa đơn nào',
    'empty_body' => 'Một cái được viết ngay khi có người mua, rồi mỗi kỳ một cái cho mọi thứ gia hạn.',

    // ---- bản tài liệu ----------------------------------------------------
    'doc_title' => 'Hóa đơn',
    'doc_number' => 'Số',
    'doc_issued' => 'Ngày lập',
    'doc_due' => 'Hạn trả',
    'doc_paid_on' => 'Đã trả',
    'doc_billed_to' => 'Bên mua',
    'doc_from' => 'Bên bán',
    'doc_description' => 'Diễn giải',
    'doc_amount' => 'Số tiền',
    'doc_subtotal' => 'Chưa thuế',
    'doc_discount' => 'Giảm giá',
    'doc_total' => 'Tổng cộng',
    'doc_how_to_pay' => 'Cách thanh toán',
    'doc_print' => 'In hoặc lưu thành PDF',
    'doc_back' => 'Về bảng điều khiển',

    // ---- thư -------------------------------------------------------------
    'mail_subject' => 'Hóa đơn :number',
    'mail_hello' => 'Chào :name,',
    'mail_intro' => 'Đây là hóa đơn :number.',
    'mail_open' => 'Mở hóa đơn',
    'mail_foot' => 'Bạn có thể đọc lại hóa đơn này bất cứ lúc nào ở trang thanh toán của mình.',

    // ---- chuông ----------------------------------------------------------
    'bell_new' => 'Hóa đơn :number',
    'bell_new_body' => 'Cần trả :total. Mở trang thanh toán của bạn để trả.',
    'bell_reminder' => 'Hóa đơn :number đã quá hạn',
    'bell_reminder_body' => 'Nó vẫn còn :total chưa trả. Máy chủ mà nó trả tiền cho sẽ dừng vào :date nếu tới lúc đó vẫn chưa thanh toán, và khi ấy không có gì trên máy bị xóa cả.',
];
