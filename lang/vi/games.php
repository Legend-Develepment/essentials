<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Lưu',
    'saved' => 'Đã lưu',
    'restart' => 'Trò chơi đọc tệp này khi khởi động, nên hãy khởi động lại máy chủ để thay đổi có hiệu lực.',
    'failed' => 'Không lưu được',
    'failed_write' => 'Daemon từ chối ghi. Kiểm tra xem máy chủ có truy cập được và tệp có phải chỉ đọc không.',
    'read_only' => 'Bạn có thể đọc tệp này nhưng không ghi được, nên ở đây không thay đổi được gì.',
    'missing' => 'Máy chủ này chưa có tệp cấu hình. Trò chơi tạo nó ở lần chạy đầu tiên, nên hãy khởi động máy chủ một lần và trang này sẽ được điền.',
    'keeps' => 'Mọi thứ còn lại trong tệp - chú thích, dòng trống, thứ tự và mọi khóa mà plugin này chưa từng biết - vẫn nguyên như cũ khi bạn lưu.',
    'raw' => 'Tên ở đây là tên của chính trò chơi, theo thứ tự trong tệp. Không có gì được dịch hay nhóm lại, vì trang này đọc tệp chứ không phải một danh sách viết tay.',
    'unset' => 'Chưa đặt. Trò chơi nhắc đến nó như một ví dụ; điền vào sẽ thêm nó.',
    'group_all' => 'Cài đặt',
    'group_all_helper' => 'Mọi thứ tệp này nhắc đến.',
    'subheading' => 'Được dựng từ :files chứ không phải từ một danh sách viết tay.',
];
