<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Mã giảm giá: những mã trừ bớt gì đó khỏi hóa đơn đầu tiên.
 *
 * Chỉ hóa đơn đầu, cố ý như vậy, và câu chữ nói rõ điều đó ở chỗ nó quan
 * trọng. Một mã giảm cả mỗi lần gia hạn thì hóa ra là đổi giá có ngày kết
 * thúc, mà ai muốn thế thì nên đổi giá.
 */

return [
    'title' => 'Mã giảm giá',
    'nav_label' => 'Mã giảm giá',
    'subheading' => 'Những mã trừ một phần trăm hoặc một số tiền khỏi hóa đơn đầu tiên. Gia hạn thì theo giá gói.',

    // ---- bảng ------------------------------------------------------------
    'column_code' => 'Mã',
    'column_value' => 'Giá trị',
    'column_uses' => 'Đã dùng',
    'column_expires' => 'Hết hạn',
    'column_packages' => 'Áp dụng cho',
    'column_live' => 'Đang bật',

    'never_expires' => 'Không có ngày kết thúc',
    'all_packages' => 'Mọi gói',
    'some_packages' => ':count gói',
    'usable' => 'Ngay bây giờ dùng được',
    'unusable' => 'Đã tắt, hết hạn hoặc dùng hết',

    // ---- các nút ---------------------------------------------------------
    'new' => 'Mã mới',
    'edit' => 'Sửa',
    'delete' => 'Xóa',
    'delete_confirm' => 'Gỡ bỏ mã. Những hóa đơn đã dùng nó vẫn giữ phần giảm giá - mỗi hóa đơn tự lưu phần đã được trừ.',
    'deleted' => 'Đã xóa mã',
    'saved' => 'Đã lưu mã',
    'save_failed' => 'Không lưu được mã',
    'taken' => 'Đã có thứ khác dùng mã đó rồi.',
    'invalid' => 'Phần trăm là số nguyên từ 1 đến 100. Số tiền viết là 12.50 hoặc 12,50.',

    // ---- biểu mẫu --------------------------------------------------------
    'section_code' => 'Mã',
    'section_code_helper' => 'Thứ khách gõ vào khi đặt hàng.',
    'code' => 'Mã',
    'code_helper' => 'Được lưu và so sánh bằng chữ hoa, bỏ khoảng trắng, để gõ kiểu nào cũng chạy.',
    'live' => 'Đang bật',
    'live_helper' => 'Tắt thì mã ngừng chạy mà không bị xóa: nó ra khỏi lưu thông, còn phần giảm giá nó từng cho vẫn nằm lại trên những hóa đơn đã có.',

    'section_worth' => 'Trừ bao nhiêu',
    'section_worth_helper' => 'Chỉ từ hóa đơn đầu tiên. Không bao giờ đưa hóa đơn xuống dưới không.',
    'kind' => 'Loại',
    'kind_helper' => 'Một phần của giá, hoặc một số tiền cố định.',
    'kind_percent' => 'Phần trăm',
    'kind_fixed' => 'Số tiền cố định',
    'value' => 'Giá trị',
    'value_percent_helper' => 'Số nguyên từ 1 đến 100.',
    'value_fixed_helper' => 'Theo đơn vị tiền của cửa hàng. Viết là 12.50 hoặc 12,50.',

    'section_limits' => 'Giới hạn',
    'section_limits_helper' => 'Mọi thứ ở đây đều không bắt buộc. Một mã không đặt giới hạn nào thì áp dụng cho tất cả, cho mọi người, mãi mãi.',
    'max_uses' => 'Dùng được bao nhiêu lần',
    'max_uses_helper' => 'Đếm khi đặt hàng, không phải khi trả hóa đơn - nếu không thì một mã mười lượt có thể đặt cả trăm lần trong một đêm.',
    'expires' => 'Hết hạn',
    'expires_helper' => 'Sau thời điểm này mã ngừng chạy. Để trống nghĩa là chuyện đó không bao giờ xảy ra.',
    'packages' => 'Các gói',
    'packages_helper' => 'Không đánh dấu gì nghĩa là mọi gói, bây giờ và về sau.',

    'empty' => 'Chưa có mã nào',
    'empty_body' => 'Tạo một mã, nó sẽ chạy lúc đặt hàng ngay khi được bật.',
];
