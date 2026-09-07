<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Thanh điều khiển trên trang của một máy chủ. Tệp riêng chứ không phải một góc
 * của settings.php, bởi vì cái này do người dùng bảng điều khiển đọc, chứ không
 * phải người đang chỉnh giao diện.
 *
 * Trạng thái bên cạnh các nút là chữ của chính Pelican, lấy từ danh sách
 * ContainerStatus, để thanh này và trang console không bao giờ nói khác nhau về
 * việc một máy chủ đang làm gì.
 *
 * "Kill" giữ nguyên tiếng Anh: đó là tên nút của chính Pelican và tên lệnh, và
 * nó là chuyện khác với dừng.
 */

return [
    'console' => 'Console',
    'full_page' => 'Cửa sổ mới',
    'close' => 'Đóng',

    'start' => 'Khởi động',
    'restart' => 'Khởi động lại',
    'stop' => 'Dừng',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill dừng container ngay tại chỗ. Mọi thứ máy chủ chưa kịp ghi xuống đĩa sẽ mất. Tiếp tục chứ?',

    'sent_title' => 'Lệnh nguồn',
    'sent_body' => 'Đã gửi :action tới :name.',
    'failed' => 'Không tới được node.',
];
