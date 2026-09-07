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
    'update' => 'Cập nhật',
    'update_available' => 'Có một bản cập nhật',
    'update_confirm' => 'Bảng điều khiển tải bản mới về, dựng lại asset của nó và xóa các bộ nhớ đệm. Cài đặt của bạn được giữ lại.',
    'update_started' => 'Đã bắt đầu cập nhật',
    'update_background' => 'Nó chạy nền và mất một hai phút.',
    'update_failed' => 'Không cập nhật được giao diện',
    'update_done' => 'Đã cập nhật giao diện',
    'check' => 'Kiểm tra cập nhật',
    'check_failed' => 'Không đọc được luồng cập nhật',
    'check_failed_body' => 'Bảng điều khiển không tới được nó, hoặc nó không trả về JSON hợp lệ.',
    'up_to_date' => 'Bạn đang ở bản mới nhất',
    'reinstall' => 'Cài lại',

    'auto_on' => 'Cập nhật tự cài lấy',

    /*
     * Lần kiểm tra tự động gần nhất đã làm gì. Mỗi câu ở đây gọi tên đúng cái
     * phần cần xem, bởi vì nhìn từ trình duyệt thì cả ba cách hỏng đều giống hệt
     * nhau: một con số đếm ngược.
     */
    'auto_never' => 'Chưa có lần kiểm tra nào chạy. Cập nhật tự động cần bộ hẹn giờ của bảng điều khiển — dòng cron chạy php artisan schedule:run mỗi phút. Không có nó thì không có gì theo lịch chạy cả.',
    'auto_ago' => 'Kiểm tra lần cuối :ago',
    'auto_just_now' => 'vừa xong',
    'auto_minutes' => 'phút trước',
    'auto_current' => 'trên kênh này không có gì mới hơn.',
    'auto_queued' => 'v:version đã vào hàng đợi. Nếu phiên bản ở trên không đổi trong vài phút thì queue worker không chạy — chính ở đó việc cập nhật mới diễn ra.',
    'auto_unreachable' => 'không đọc được luồng cập nhật. Nó được tải qua internet, nên đây thường là vấn đề mạng hoặc DNS trên máy của bảng điều khiển.',
    'auto_error' => 'lần kiểm tra thất bại. Lý do nằm trong storage/logs.',

    /*
     * Queue worker, tức là thứ thật sự thực hiện việc cập nhật. Nói riêng khỏi
     * phần kiểm tra ở trên bởi vì chúng hỏng riêng và thuốc chữa cho mỗi bên
     * khác nhau.
     */
    'worker_missing' => 'Không có queue worker nào trả lời. Cập nhật và cài modpack đều được đưa vào hàng đợi và do một tiến trình worker thực hiện, nên tới khi có một cái chạy thì chúng chỉ được ghi lại và không bao giờ được làm, mà cũng chẳng có lỗi ở đâu cả. Hoặc là không có worker nào, hoặc là có một cái đã chạy từ trước khi plugin này được cài và không nạp được mã của nó — cả hai đều chữa được bằng cách khởi động lại nó trên máy của bảng điều khiển. Hãy đặt dịch vụ của nó tự khởi động lại, không thì chuyện này sẽ quay lại sau mỗi lần cập nhật.',

    'next_check' => 'Kiểm tra kế tiếp sau',
    'due_now' => 'đến hạn',

    /*
     * Đặt tên theo nguyên nhân chứ không theo triệu chứng, bởi vì triệu chứng là
     * "chẳng có gì xảy ra" và chính điều đó làm nó khó xác định: thông báo, liên
     * kết điều hướng, các kiểu đã lưu và bố cục trang đều là tệp nằm dưới
     * storage/app, và một thư mục mà bảng điều khiển không ghi được sẽ làm mất
     * từng cái một mà không một lời nào.
     */
    'storage_failed' => 'Bảng điều khiển không ghi được vào thư mục storage của nó, nên cái này chưa được lưu. Kiểm tra xem storage/app có thuộc về người dùng mà bảng điều khiển đang chạy dưới quyền không. Lý do nằm trong storage/logs.',

    /*
     * Nói sau mọi lần cập nhật thất bại chứ không chỉ sau một lần lệch nhau. Câu
     * ở trên đã gọi tên nguyên nhân rồi; câu này gọi tên đúng một cách chữa mà
     * con người không thể suy ra từ "mong X, nhận Y".
     */
    'update_renamed' => 'Nếu ở đây nói rằng hai id không khớp nhau thì plugin đã bị đổi tên và không có bản cập nhật nào vượt qua được chuyện đó — Pelican nhận ra một plugin đã cài qua id của nó. Hãy gỡ mục cũ ở Admin → Plugins rồi cài cái này lại từ đầu. Cài đặt của bạn vẫn sống sót: chúng nằm trong .env và trong storage/app/private/legend-theme, và không cái nào được khóa theo id cả.',
];
