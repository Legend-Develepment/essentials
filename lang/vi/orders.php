<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Đơn hàng: ai đó đã mua gì và rồi ra sao.
 *
 * Bốn trạng thái bên dưới nói về tiền, không nói về máy chủ. Máy chủ có đang
 * chạy hay không là câu hỏi của chính Pelican và được trả lời trên các trang
 * của Pelican. Chữ ở đây giữ hai điều ấy tách bạch.
 */

return [
    'title' => 'Đơn hàng',
    'nav_label' => 'Đơn hàng',
    'subheading' => 'Mọi thứ đã bán, máy chủ sinh ra từ đó, và tình hình hiện tại.',

    // ---- bảng ------------------------------------------------------------
    'column_order' => 'Đơn hàng',
    'column_customer' => 'Khách',
    'column_package' => 'Gói',
    'column_server' => 'Máy chủ',
    'column_state' => 'Trạng thái',
    'column_due' => 'Kỳ hạn kế',

    'no_server' => 'Chưa dựng',
    'no_due' => 'Trả một lần',
    'gone_customer' => 'Tài khoản đã xóa',
    'gone_package' => 'Gói đã xóa',
    'overdue_days' => 'Trễ :days ngày',

    'state_pending' => 'Đang chờ',
    'state_active' => 'Đang chạy',
    'state_suspended' => 'Đã dừng',
    'state_cancelled' => 'Đã hủy',

    // ---- các nút ---------------------------------------------------------
    'retry' => 'Dựng lại',
    'retry_confirm' => 'Xếp việc dựng vào hàng đợi thêm một lần nữa. Không có gì khác thay đổi, và hóa đơn vẫn là đã trả.',
    'retrying' => 'Đã xếp vào hàng đợi',

    'suspend' => 'Dừng',
    'suspend_confirm' => 'Dừng máy chủ bằng chính cơ chế tạm ngưng của Pelican. Tập tin, cơ sở dữ liệu và bản sao lưu vẫn nằm nguyên chỗ cũ, và trả hóa đơn sẽ gỡ ngưng.',
    'suspended' => 'Đã dừng',

    'unsuspend' => 'Gỡ dừng',
    'unsuspended' => 'Chạy lại rồi',

    'change_due' => 'Đổi kỳ hạn',
    'change_due_helper' => 'Khi nào viết hóa đơn kế tiếp. Để trống nghĩa là không bao giờ - đơn hàng ngừng gia hạn mà không bị hủy.',

    'cancel' => 'Hủy',
    'cancel_confirm' => 'Dừng việc gia hạn và trả lại chỗ trong tồn kho. Máy chủ vẫn để nguyên: muốn xóa thì làm trong Pelican, nơi việc đó thuộc về.',
    'cancelled' => 'Đã hủy',

    'saved' => 'Đã lưu',
    'refused' => 'Không có gì thay đổi',
    'refused_body' => 'Đơn hàng không ở trạng thái cho phép làm điều đó. Tải lại trang và xem lại một lần nữa.',

    // ---- điều khách nghe thấy --------------------------------------------
    'bell_ready' => 'Máy chủ của bạn đã sẵn sàng',
    'bell_ready_body' => ':server đã được tạo và đang chờ bạn khởi động.',
    'bell_suspended' => 'Máy chủ của bạn đã bị dừng',
    'bell_suspended_body' => 'Một hóa đơn còn chưa trả quá thời gian gia hạn. Trả nó thì máy chủ chạy lại; không có gì bị xóa cả.',

    // ---- điều người quản trị nghe thấy -----------------------------------
    'bell_failed' => 'Đơn hàng :number không dựng được',
    'no_allocation' => 'Không node nào trong gói này còn allocation trống. Thêm một cái rồi dựng lại.',
    'no_reason' => 'Bảng điều khiển từ chối mà không nói vì sao.',

    // ---- máy chủ sinh ra từ đó -------------------------------------------
    'server_description' => 'Mua ở cửa hàng, đơn hàng :number.',
    'server_fallback' => 'Máy chủ',

    'empty' => 'Chưa có ai mua gì',
    'empty_body' => 'Đơn hàng hiện ra ở đây ngay khi có người mua một gói.',
];
