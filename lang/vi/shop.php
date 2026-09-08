<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Cài đặt cửa hàng, và về sau là chính cửa hàng.
 *
 * Hai người đọc dùng chung tệp này một cách có chủ ý. Nửa cài đặt là do quản
 * trị viên đọc; nửa công khai và nửa dành cho khách - được thêm vào khi cửa
 * hàng lớn dần - do những người có thể chưa từng nghe tới Pelican đọc, và mọi
 * câu ở đó phải được viết cho họ.
 */

return [
    'title' => 'Cài đặt cửa hàng',
    'nav_label' => 'Cài đặt cửa hàng',
    'subheading' => 'Đơn vị tiền, thuế, cách đánh số hóa đơn và những gì trang công khai nói. Còn thứ được bán thì nằm ở trang Gói.',

    // ---- ở đâu -----------------------------------------------------------
    'address' => 'Cửa hàng công khai nằm ở',
    'address_off' => 'Trang công khai đang tắt. Hãy bật "Trang cửa hàng công khai" trong danh sách tính năng ở trang Cài đặt Essentials thì trang sẽ trả lời tại :url.',

    // ---- chung -----------------------------------------------------------
    'section_general' => 'Tiền',
    'section_general_helper' => 'Một đơn vị tiền cho cả cửa hàng. Mọi giá của mọi gói đều là một con số theo đơn vị ấy.',
    'currency' => 'Đơn vị tiền',
    'currency_helper' => 'Đổi đơn vị không quy đổi lại thứ gì: giá các gói là những con số, và sau khi đổi chúng là những con số theo đơn vị mới.',
    'tax' => 'Thuế',
    'tax_helper' => 'Phần trăm được cộng vào mỗi hóa đơn thành một dòng riêng. Giá các gói là giá chưa thuế. Số không là không thu.',
    'tax_suffix' => '%',
    'prefix' => 'Số hóa đơn bắt đầu bằng',
    'prefix_helper' => 'Theo sau là một số tăng dần. INV- cho ra INV-000001.',

    // ---- gia hạn ---------------------------------------------------------
    'section_renewals' => 'Gia hạn',
    'section_renewals_helper' => 'Dành cho các gói tính tiền theo tháng, theo quý hoặc theo năm. Gói một lần không bao giờ bị đụng tới.',
    'notice_days' => 'Xuất hóa đơn trước khi hết kỳ bấy nhiêu ngày',
    'notice_days_helper' => 'Thời điểm hóa đơn kế tiếp được tạo và khách được báo.',
    'grace' => 'Dừng máy chủ sau hạn thanh toán bấy nhiêu ngày',
    'grace_helper' => 'Hóa đơn chưa trả quá mốc này sẽ dừng máy chủ — bằng chính cơ chế tạm ngưng của Pelican, được gỡ ngay khi hóa đơn được trả. Cửa hàng không bao giờ xóa gì cả.',
    'days' => 'ngày',

    // ---- trang công khai -------------------------------------------------
    'section_public' => 'Trang công khai',
    'section_public_helper' => 'Người không có tài khoản cũng đọc được. Trang có hiện ra hay không là do công tắc "Trang cửa hàng công khai" trong danh sách tính năng quyết định.',
    'heading' => 'Tiêu đề',
    'heading_helper' => 'Để trống thì lấy tên của chính bảng điều khiển.',
    'note' => 'Dòng phía trên các gói',
    'note_helper' => 'Để nói bạn là ai hoặc mua thì được gì. Văn bản thuần.',
    'terms_url' => 'Điều khoản',
    'terms_url_helper' => 'Địa chỉ https. Nếu có đặt, mua hàng đồng nghĩa với việc đánh dấu vào ô trỏ tới đó.',

    // ---- trả tiền thủ công -----------------------------------------------
    'section_manual' => 'Thanh toán khi chưa có nhà cung cấp',
    'section_manual_helper' => 'Hiện trên hóa đơn chưa trả khi chưa bật nhà cung cấp thanh toán nào: thông tin ngân hàng hoặc nơi gửi tiền tới. Văn bản thuần.',
    'pay_note' => 'Cách thanh toán',
    'pay_note_helper' => 'Để trống thì hóa đơn chưa trả chỉ nói rằng nó chưa được trả.',

    // ---- các nút ---------------------------------------------------------
    'save' => 'Lưu',
    'saved' => 'Đã lưu',
    'save_failed' => 'Không có gì được lưu',
];
