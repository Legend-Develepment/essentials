<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Ai đang ở trên một máy chủ, với những trò chơi trả lời truy vấn của Valve.
 *
 * Một trang cho Rust, ARK, Valheim và những trò còn lại, bởi vì chúng cùng trả
 * lời một gói tin. Cái khác nhau giữa các trò là bạn có thể làm gì với một
 * người - đá ra là `kick "tên"` ở trò này và `KickPlayer <id>` ở trò kia - và vì
 * vậy trang này đọc chứ không hành động.
 */

return [
    'title' => 'Người chơi',
    'nav_label' => 'Người chơi',
    'subheading' => 'Ai đang kết nối, hỏi chính trò chơi chứ không hỏi bảng điều khiển.',

    'refresh' => 'Hỏi lại',

    'count' => ':count đang kết nối',
    'score' => 'Điểm',

    'just_joined' => 'vừa vào',
    'minutes' => ':count phút',
    'hours' => ':count giờ',
    'hours_minutes' => ':hours giờ :minutes phút',

    'empty' => 'Không có ai trên máy chủ này.',

    /*
     * Không phải "không có ai", và sự khác biệt này quan trọng.
     *
     * Bảng điều khiển và cổng của trò chơi thường nằm trên những mạng không với
     * tới nhau, và vẽ chuyện đó thành một danh sách rỗng thì hóa ra trang này
     * nói điều nó không biết.
     */
    'unreachable' => 'Máy chủ không trả lời. Có thể nó đang khởi động, hoặc bảng điều khiển không với tới cổng trò chơi của nó từ chỗ nó đang chạy — đó là chuyện khác với việc không có ai cả.',
];
