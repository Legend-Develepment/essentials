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
    'state_ending' => 'Sắp kết thúc',
    'ends_on' => 'Kết thúc :date',
    'no_more_dues' => 'Không viết hóa đơn nữa',
    'cancel_confirm_open' => 'Dừng việc gia hạn ngay và trả lại chỗ trong tồn kho. Máy chủ vẫn để chạy: gói này không có kỳ hạn tối thiểu, nên không có mốc ngày nào để chạy tới. Hãy xóa máy chủ trong Pelican khi khách đã dùng xong.',
    'terminate' => 'Dừng và xóa',
    'terminate_heading' => 'Xóa máy chủ này?',
    'terminate_confirm' => 'Máy chủ bị xóa ngay bây giờ, cùng tập tin, cơ sở dữ liệu và bản sao lưu của nó. Không có hoàn tác và không chờ hết hợp đồng. Hãy dùng Hủy nếu khách được giữ nó tới đúng cái ngày đã hẹn.',
    'terminate_go' => 'Xóa nó',
    'terminated' => 'Đã xóa',
    'terminated_body' => 'Máy chủ không còn nữa và đơn hàng đã đóng.',
    'bell_ending' => ':package của bạn kết thúc vào :date',
    'bell_ending_open' => ':package của bạn đã được hủy',
    'bell_ending_body' => 'Bạn sẽ không bị tính tiền cho nó nữa. Mọi thứ trên máy chủ sẽ bị xóa khi nó dừng, nên hãy sao lưu những gì bạn muốn giữ.',
    'bell_ended' => ':package của bạn đã kết thúc',
    'bell_ended_body' => 'Hợp đồng đã hết và máy chủ đã bị xóa.',
    'bell_undeleted' => 'Đơn hàng :number không xóa được',
    'bell_undeleted_body' => 'Bảng điều khiển từ chối xóa máy chủ. Đơn hàng đã đóng và sẽ không ai bị viết hóa đơn cho nó, nhưng máy chủ vẫn còn đó và phải được gỡ đi trong Pelican.',
    'bell_undelivered' => 'Tệp của đơn hàng :number vẫn còn ở đây',
    'bell_undelivered_body' => 'Máy chủ đã dựng xong, nhưng tệp khách tải lên thì không đưa vào được. Nó vẫn nằm trong kho lưu trữ của bảng điều khiển, và lý do nằm trong storage/logs.',

    'empty' => 'Chưa có ai mua gì',
    'empty_body' => 'Đơn hàng hiện ra ở đây ngay khi có người mua một gói.',

    // ---- gia hạn ---------------------------------------------------------
    'filter_late' => 'Đang nợ một hóa đơn',
    'run_renewals' => 'Chạy gia hạn ngay',
    'run_renewals_confirm' => 'Làm đúng việc mà lượt chạy ban đêm làm: viết hóa đơn kế tiếp cho mọi thứ sắp tới hạn, và dừng những máy chủ đứng sau một hóa đơn còn chưa trả quá thời gian gia hạn.',
    'renewals_queued' => 'Đã xếp vào hàng đợi',
    'renewals_queued_body' => 'Nó chạy trong hàng đợi. Lát nữa tải lại trang để xem có gì thay đổi.',
];
