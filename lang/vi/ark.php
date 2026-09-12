<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "GameUserSettings.ini" và "Startup" viết đúng như chúng hiện trong trò chơi và
 * trong Pelican - đó chính là những cái tên người ta đi tìm.
 */

return [
    /* -------------------------------------------------- tab quản trị ----- */

    /*
     * Tiêu đề thì không nằm ở đây. Mỗi mục cài đặt lấy tiêu đề của nó từ
     * settings.groups.<tên>, do group() dựng nên.
     */
    'section_helper' => 'Egg nào chạy ARK. Không gì khác - phần còn lại của một máy chủ ARK được cấu hình bằng các biến khởi động của nó, và trang Startup của chính Pelican đã sửa những biến đó rồi.',

    'eggs' => 'Egg nào là ARK',
    'eggs_helper' => 'Đánh dấu những egg chạy máy chủ ARK. Trang Cài đặt thế giới xuất hiện bên trong các máy chủ dùng chúng, và không ở đâu khác. Đây là câu hỏi khác với câu ở trang trạng thái: câu kia hỏi egg nào trả lời truy vấn của Valve, điều mà Rust và Valheim cũng làm, còn câu này hỏi egg nào giữ GameUserSettings.ini ở chỗ ARK giữ nó, điều mà chỉ ARK làm. Ban đầu không có gì được đánh dấu, và đó là cố ý - một plugin không thể biết bạn đã đặt tên các egg của mình là gì.',

    /* ------------------------------------------------- trang máy chủ ----- */

    'nav_label' => 'Cài đặt thế giới',
    'title' => 'Cài đặt thế giới ARK',
    'subheading' => 'Những cài đặt người ta thật sự hay đổi, lấy từ GameUserSettings.ini.',

    'group_server' => 'Máy chủ',
    'group_server_helper' => 'Máy chủ tên gì, ai được vào, và bao nhiêu người.',
    'group_rates' => 'Tỉ lệ',
    'group_rates_helper' => 'Mọi thứ diễn ra nhanh đến đâu. 1.0 là trò chơi nguyên bản; 2.0 là nhanh gấp đôi.',
    'group_rules' => 'Luật',
    'group_rules_helper' => 'Người chơi được làm gì và trò chơi cho họ thấy gì.',

    'keeps' => 'Mười lăm cài đặt lấy từ một tệp có hàng trăm cái. Mọi thứ khác trong đó - cài đặt các mod của bạn, những khóa mà plugin này chưa từng nghe tới, các chú thích và thứ tự của tất cả - đều được để nguyên như cũ khi bạn lưu.',
    'missing' => 'Máy chủ này chưa có GameUserSettings.ini. Trò chơi ghi nó ra ở lần chạy đầu tiên, nên hãy khởi động máy chủ một lần rồi trang này sẽ tự điền vào.',
    'read_only' => 'Bạn được đọc tệp này nhưng không được ghi, nên ở đây không đổi được gì.',

    'save' => 'Lưu',
    'saved' => 'Đã lưu',
    'saved_restart' => 'ARK đọc tệp này lúc khởi động, nên hãy khởi động lại máy chủ để thay đổi có hiệu lực.',
    'failed' => 'Không lưu được',
    'failed_write' => 'Daemon từ chối ghi. Kiểm tra xem máy chủ có với tới được không và tệp có phải chỉ đọc không.',
];
