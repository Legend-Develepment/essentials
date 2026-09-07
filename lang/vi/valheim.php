<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "SteamID64" và "PlayFab ID" giữ nguyên đúng như cách chúng được viết ở những
 * chỗ bạn lấy chúng về. "Admin" cũng giữ nguyên: đó là chữ trong chính tệp của
 * trò chơi.
 */

return [
    /* -------------------------------------------------- tab quản trị ----- */

    'section_helper' => 'Egg nào chạy Valheim. Không gì khác — một máy chủ Valheim được cấu hình bằng các biến khởi động của nó, và trang Startup của chính Pelican đã sửa những biến đó rồi.',

    'eggs' => 'Egg nào là Valheim',
    'eggs_helper' => 'Đánh dấu những egg chạy máy chủ Valheim. Trang Danh sách người chơi xuất hiện bên trong các máy chủ dùng chúng, và không ở đâu khác. Những danh sách đó nằm ở đâu thì khác nhau tùy egg, nên nó được suy ra cho từng máy chủ bằng cách nhìn vào những chỗ mà trò chơi dùng. Ban đầu không có gì được đánh dấu, và đó là cố ý — một plugin không thể biết bạn đã đặt tên các egg của mình là gì.',

    /* ------------------------------------------------- trang máy chủ ----- */

    'nav_label' => 'Danh sách người chơi',
    'title' => 'Danh sách người chơi Valheim',
    'subheading' => 'Admin, ban và danh sách được phép; ba danh sách thay cho ba tệp văn bản.',

    'admin' => 'Admin',
    'admin_helper' => 'Mọi người ở đây dùng được các lệnh admin trong trò chơi.',
    'banned' => 'Bị ban',
    'banned_helper' => 'Mọi người ở đây bị từ chối khi họ thử vào.',
    'permitted' => 'Được phép',
    'permitted_helper' => 'Nếu danh sách này có ai đó, chỉ những người đó mới được vào. Danh sách rỗng cho tất cả mọi người vào — và đó là điều phần lớn máy chủ muốn, nên hãy để trống trừ khi bạn thật sự có ý khác.',

    'ids' => 'ID người chơi',
    'ids_placeholder' => 'Dán một ID rồi nhấn dấu cách',

    'how' => 'Mỗi người chơi một ID — SteamID64 trên máy chủ Steam, PlayFab ID trên máy chủ crossplay. Dán vào rồi nhấn dấu cách, tab hoặc dấu phẩy. Mọi thứ trò chơi đã viết dưới dạng chú thích phía trên danh sách vẫn nằm nguyên chỗ cũ.',
    'where' => 'Đọc từ :dir.',
    'missing' => 'Máy chủ này chưa có tệp nào trong số đó. Trò chơi ghi chúng ra khi nó cần lần đầu, và lưu ở đây sẽ tạo những tệp bạn điền vào.',
    'read_only' => 'Bạn được đọc những tệp này nhưng không được ghi, nên ở đây không đổi được gì.',

    'save' => 'Lưu',
    'saved' => 'Đã lưu',
    'saved_reload' => 'Valheim đọc những danh sách này trong lúc chạy, nên thay đổi có hiệu lực mà không cần khởi động lại.',
    'unchanged' => 'Không có gì thay đổi, nên không có gì được ghi',
    'failed' => 'Không lưu được',
    'failed_lists' => 'Daemon từ chối ghi cho: :lists. Kiểm tra xem máy chủ có với tới được không và các tệp có phải chỉ đọc không.',
];
