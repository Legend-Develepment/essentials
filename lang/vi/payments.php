<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Thanh toán: mỗi lần thử trả tiền và điều nhà cung cấp nói về nó.
 *
 * Một dòng cho mỗi lần thử chứ không phải mỗi hóa đơn, vì sự việc đã diễn ra
 * như thế. Chữ mà trang này lặp đi lặp lại là "lần thử": một lần trả tiền thất
 * bại là sự việc đáng giữ lại, không phải lỗi cần giấu đi.
 */

return [
    'title' => 'Thanh toán',
    'nav_label' => 'Thanh toán',
    'subheading' => 'Mọi lần thử trả tiền, qua mọi nhà cung cấp. Kiểm tra lại sẽ hỏi nhà cung cấp thêm một lần nữa - đúng việc mà webhook của họ làm khi tới nơi.',

    // ---- bảng ------------------------------------------------------------
    'column_invoice' => 'Hóa đơn',
    'column_gateway' => 'Nhà cung cấp',
    'column_reference' => 'Mã của họ',
    'column_amount' => 'Số tiền',
    'column_state' => 'Trạng thái',
    'column_updated' => 'Tin cuối',

    'gone_invoice' => 'Hóa đơn đã xóa',

    'state_open' => 'Đang chờ',
    'state_paid' => 'Đã trả',
    'state_failed' => 'Thất bại',
    'state_cancelled' => 'Bỏ dở',

    // ---- các nút ---------------------------------------------------------
    'recheck' => 'Kiểm tra lại',
    'rechecked' => 'Đã hỏi lại',
    'rechecked_body' => 'Nhà cung cấp vẫn chưa nói là đã trả. Không có gì thay đổi.',
    'settled' => 'Đã trả rồi',
    'settled_body' => 'Hóa đơn đã xong và mọi thứ chờ nó đều đang trên đường.',
    'recheck_failed' => 'Không hỏi được',
    'recheck_failed_body' => 'Nhà cung cấp không trả lời. Thử lại sau một phút; nếu còn lặp lại, hãy xem lại khóa ở trang Cài đặt cửa hàng.',
    'no_gateway' => 'Nhà cung cấp đó đang tắt',
    'no_gateway_body' => 'Bật lại để hỏi về khoản này, hoặc đánh dấu hóa đơn đã trả bằng tay.',

    'answer' => 'Câu trả lời của họ',
    'no_answer' => 'Không ghi nhận được gì',
    'close' => 'Đóng',

    'empty' => 'Chưa ai trả tiền qua nhà cung cấp',
    'empty_body' => 'Các lần thử hiện ra ở đây ngay khi có người bấm Thanh toán, dù có làm xong hay không.',
];
