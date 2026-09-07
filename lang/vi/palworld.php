<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Cài đặt thế giới của Palworld, trên một trang thay vì trong một tệp.
 *
 * Không có gì ở đây gọi tên một cài đặt cụ thể. Mỗi nhãn trên trang đó được suy
 * ra từ khóa nằm trong chính tệp của máy chủ - xem
 * Support\Palworld\Palworld::label() để biết vì sao một danh sách tên còn tệ hơn
 * là không có gì.
 *
 * "Pal" và "guild" giữ nguyên: đó là chữ của chính trò chơi, và người ta thấy
 * đúng những chữ đó ở trong game.
 */

return [
    'title' => 'Cài đặt Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'Cài đặt thế giới lấy từ chính tệp PalWorldSettings.ini của máy chủ này, đọc lúc bạn mở trang. Chỉ sửa được khi máy chủ đang dừng.',

    'reload' => 'Đọc lại tệp',

    'save_confirm' => 'Tệp được ghi lại với những giá trị này. Mọi cài đặt trang này không hiện ra sẽ được ghi lại y như cũ, và mọi thứ khác trong tệp cũng vậy.',
    'saved' => 'Đã lưu cài đặt',
    'saved_body' => 'Chúng có hiệu lực ở lần khởi động máy chủ tiếp theo.',
    'save_failed' => 'Không ghi được tệp',

    'running' => 'Máy chủ đang chạy',
    'running_body' => 'Palworld giữ những cài đặt này trong bộ nhớ và ghi lại tệp khi nó dừng, nên một thay đổi lưu lúc này sẽ bị hoàn tác mà không một lời nào. Hãy dừng máy chủ trước.',

    'groups' => [
        'server' => 'Máy chủ và kết nối',
        'world' => 'Thế giới và tỉ lệ',
        'pals' => 'Pals',
        'players' => 'Người chơi',
        'building' => 'Xây dựng, vật phẩm và thu thập',
        'guild' => 'Guilds',
        'other' => 'Khác',
    ],
];
