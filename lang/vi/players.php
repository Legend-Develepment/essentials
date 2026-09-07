<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Whitelist", "operator", "ban" và "kick" giữ nguyên tiếng Anh: đó là những
 * lệnh bạn gõ trong console và tên những tệp mà chính Minecraft ghi ra. Một cái
 * nút đã dịch nằm cạnh một lệnh tiếng Anh là cái nút mà bạn phải dịch ngược lại
 * trong đầu.
 */

return [
    'nav_label' => 'Người chơi',
    'title' => 'Người chơi',
    'subheading' => 'Whitelist, các operator, các ban, và mọi người máy chủ này từng thấy.',

    /*
     * Nói một lần, ở trên đầu, bởi vì nó giải thích cả việc trang này làm được
     * gì lẫn vì sao một việc nó không làm được lại không phải lỗi. Mọi thay đổi
     * đều gửi đi dưới dạng lệnh console, và đó chính là cách để nói với Minecraft
     * - trò chơi tự thực hiện thay đổi và tự ghi tệp của nó, nên hai bên không
     * bao giờ vênh nhau.
     */
    'how' => 'Thay đổi được gửi tới máy chủ dưới dạng lệnh console, nên trò chơi thực hiện chúng và tự ghi tệp của mình. Việc đó đòi máy chủ phải đang chạy.',
    'needs_running' => 'Máy chủ phải đang chạy. Những thay đổi này do trò chơi làm, chứ không phải do sửa tệp của nó từ bên dưới.',

    'name' => 'Tên người chơi',
    'reason' => 'Lý do (không bắt buộc)',

    'whitelist' => 'Thêm vào whitelist',
    'unwhitelist' => 'Bỏ khỏi whitelist',
    'op' => 'Cho làm operator',
    'deop' => 'Bỏ operator',
    'ban' => 'Ban',
    'pardon' => 'Gỡ ban',
    'kick' => 'Kick',

    'sent' => 'Đã gửi lệnh',
    'sent_body' => 'Máy chủ áp dụng nó rồi cập nhật tệp của chính nó. Tải lại trang để thấy các danh sách đổi.',
    'refused' => 'Cái đó không được gửi đi',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Trong whitelist',
    'flag_banned' => 'Bị ban',
    'flag_seen' => 'Đã từng chơi ở đây',

    'online' => 'Đang trực tuyến',
    'online_count' => ':online trên :max',
    'online_none' => 'Không có ai kết nối.',

    'players' => 'Người chơi',
    'ips' => 'Địa chỉ bị ban',
    'ips_empty' => 'Không có địa chỉ nào bị ban.',

    /*
     * Một trang trống nghĩa là gì, và điều đó thường không phải "không có người
     * chơi" mà là "máy chủ này chưa từng khởi động". Minecraft không tạo bất kỳ
     * tệp nào trong số này cho tới lần chạy đầu tiên của nó.
     */
    'empty' => 'Chưa có gì để hiện. Minecraft tự ghi những danh sách này, và nó không tạo chúng cho tới khi máy chủ khởi động lần đầu.',

    'level' => 'Cấp :level',

    /*
     * Một việc trang này không làm, nói ra chứ không để người ta tự phát hiện.
     * Trạng thái trực tiếp cần một kết nối thứ hai tới chính trò chơi, và đó là
     * một tính năng khác với những yêu cầu riêng của nó.
     */
    'not_live' => 'Đây là những gì máy chủ đã ghi lại, chứ không phải ai đang ở trong ngay lúc này.',
];
