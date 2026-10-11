<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Queue worker", "cron", "storage" và các đường dẫn giữ nguyên đúng như cách
 * chúng được viết trên máy của bảng điều khiển: đó chính là cách chúng được gõ
 * vào một shell.
 */

return [
    'title' => 'Cài đặt Essentials',
    'nav_label' => 'Cài đặt Essentials',
    'save' => 'Lưu',
    'saved' => 'Đã lưu cài đặt',
    'save_failed' => 'Không lưu được cài đặt',
    'secret_kept' => 'Đã lưu. Để trống để giữ nguyên, hoặc nhập giá trị mới để thay thế.',
    'update_background' => 'Nó chạy nền và mất một hai phút.',

    /*
     * Queue worker và scheduler, thứ mà mọi tác vụ nền và mọi tác vụ theo lịch
     * đều phụ thuộc vào. Nói riêng vì chúng hỏng riêng và thuốc chữa cho mỗi
     * bên khác nhau.
     */
    'worker_missing' => 'Không có queue worker nào trả lời. Cài modpack, gửi thư và các việc chạy nền khác đều được đưa vào hàng đợi và do một tiến trình worker thực hiện, nên tới khi có một cái chạy thì chúng chỉ được ghi lại và không bao giờ được làm, mà cũng chẳng có lỗi ở đâu cả. Hoặc là không có worker nào, hoặc là có một cái đã chạy từ trước khi plugin này được cài và không nạp được mã của nó - cả hai đều chữa được bằng cách khởi động lại nó trên máy của bảng điều khiển. Hãy đặt dịch vụ của nó tự khởi động lại, không thì chuyện này sẽ quay lại sau mỗi lần cập nhật.',
    'cron_missing' => 'Bộ lập lịch của bảng điều khiển đã :for phút không chạy. Gia hạn và kiểm tra watchdog đều chờ vào nó. Dòng cron nằm trong tài liệu của Pelican.',

    /*
     * Đặt tên theo nguyên nhân chứ không theo triệu chứng, bởi vì triệu chứng là
     * "chẳng có gì xảy ra" và chính điều đó làm nó khó xác định: thông báo, liên
     * kết điều hướng, các kiểu đã lưu và bố cục trang đều là tệp nằm dưới
     * storage/app, và một thư mục mà bảng điều khiển không ghi được sẽ làm mất
     * từng cái một mà không một lời nào.
     */
    'storage_failed' => 'Bảng điều khiển không ghi được vào thư mục storage của nó, nên cái này chưa được lưu. Kiểm tra xem storage/app có thuộc về người dùng mà bảng điều khiển đang chạy dưới quyền không. Lý do nằm trong storage/logs.',
];
