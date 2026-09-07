<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Cron" giữ nguyên: đó là tên của thứ đang chạy trên máy của bảng điều khiển,
 * và người đi kiểm tra nó tìm đúng chữ đó.
 */

return [
    'nav_label' => 'Lịch',
    'title' => 'Lịch nào đã dừng',
    'subheading' => 'Mọi tác vụ theo lịch trên bảng điều khiển, tệ nhất trước — kẹt hơn :hours giờ, trễ hạn, hoặc chưa từng chạy.',

    'how' => 'Pelican hiện các lịch bên trong từng máy chủ, và trạng thái của chính nó có ba chữ cho chúng: tắt, đang xử lý, đang hoạt động. Không chữ nào nghĩa là "cái này đã dừng". Một lần chạy đổ giữa chừng sẽ mãi mãi ở trạng thái đang xử lý và trông y hệt một lần đang chạy thật; một lịch đã quá giờ nhiều tiếng vì cron chết vẫn được gọi là đang hoạt động. Trang này hỏi câu hỏi kia. Chỉ đọc — mọi thứ sửa, chạy hay xóa một lịch đều nằm lại trên trang của chính Pelican cho máy chủ đó.',

    'column_state' => 'Trạng thái',
    'column_name' => 'Lịch',
    'column_server' => 'Máy chủ',
    'column_last' => 'Lần chạy gần nhất',
    'column_next' => 'Lần chạy kế',

    /*
     * Năm phán quyết. Viết theo lối nêu sự thật chứ không phải ra lệnh, bởi vì
     * ba trong số đó là thứ cần xem và hai thì không.
     */
    'state_stuck' => 'Kẹt',
    'state_overdue' => 'Trễ hạn',
    'state_never' => 'Chưa từng chạy',
    'state_healthy' => 'Ổn',
    'state_off' => 'Tắt',

    'filter_stuck' => 'Kẹt',
    'filter_overdue' => 'Trễ hạn',
    'filter_never' => 'Chưa từng chạy',
    'filter_off' => 'Đã tắt',

    'open' => 'Mở trên máy chủ',

    'empty' => 'Không có lịch nào trên bất kỳ máy chủ nào bạn với tới — hoặc không có cái nào đã dừng, nếu bạn đang bật một bộ lọc.',
];
