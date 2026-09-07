<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Steam App ID", "IGDB", "Twitch client ID" và "client secret" giữ nguyên tiếng
 * Anh: đó đúng là những chữ hiện trên các trang mà giá trị được lấy về từ đó.
 */

return [
    'title' => 'Ảnh cho egg',
    'nav_label' => 'Ảnh cho egg',
    'subheading' => 'Ảnh trò chơi cho các egg của bạn, lấy từ Steam và IGDB. Một egg không có ảnh sẽ hiện con chim của chính Pelican trên mọi thẻ máy chủ dùng nó.',

    // ---- bảng ------------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Đã khóa',

    'locked' => 'Đã khóa',
    'unlocked' => 'Đang mở',

    // ---- làm được gì với một dòng ----------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Con số trong địa chỉ cửa hàng Steam của một trò chơi — store.steampowered.com/app/892970 là 892970. Lấy theo id sẽ khóa ảnh lại, bởi vì gõ một con số là một quyết định và một lượt lấy hàng loạt về sau không được phép hoàn tác nó.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Tìm',
    'search_term_helper' => 'Tên egg đã được điền sẵn, nhưng nó hiếm khi là tên trò chơi — "Paper 1.20.4" là Minecraft. Hãy gõ tên trò chơi.',

    'lock' => 'Khóa',
    'unlock' => 'Mở khóa',
    'locked_done' => 'Đã khóa — lượt lấy hàng loạt sẽ để yên cái này',
    'unlocked_done' => 'Đã mở khóa — lượt lấy hàng loạt có thể thay ảnh này',

    'clear' => 'Xóa',
    'clear_confirm' => 'Bỏ ảnh và Steam App ID đi. Egg quay lại con chim của chính Pelican, và lượt lấy hàng loạt kế tiếp sẽ thử lại.',
    'cleared' => 'Đã bỏ ảnh',

    // ---- kết quả ---------------------------------------------------------
    'fetched' => 'Đã lưu ảnh',
    'failed' => 'Không lưu được ảnh nào',

    /*
     * Mỗi trường hợp một lý do, bởi vì đó là những vấn đề khác nhau.
     *
     * Một lượt lấy hỏng vì gõ sai và một lượt hỏng vì đĩa đầy thì không nên cùng
     * nói "thất bại" — cái thứ nhất chữa bằng cách nhìn con số, cái thứ hai chữa
     * bằng cách nhìn máy chủ.
     */
    'why_bad_id' => 'Đó không phải Steam App ID.',
    'why_not_found' => 'Steam không có gì ở địa chỉ đó. Hãy kiểm tra App ID — một trò chơi không có trang cửa hàng thì cũng không có ảnh tiêu đề.',
    'why_no_match' => 'Không tìm thấy gì với cái tên đó. Hãy thử đúng tên trò chơi thay vì tên của egg.',
    'why_no_name' => 'Không có gì để tìm.',
    'why_no_token' => 'Twitch không chịu cấp token. Hãy kiểm tra client ID và secret ở mục Thông tin đăng nhập.',
    'why_not_configured' => 'IGDB cần một Twitch client ID và secret. Hãy đặt chúng ở mục Thông tin đăng nhập.',
    'why_empty' => 'Câu trả lời rỗng.',
    'why_large' => 'Ảnh đó lớn hơn một biểu tượng rất nhiều và đã không được lưu.',
    'why_not_an_image' => 'Thứ trả về không phải một ảnh. Điều đó thường nghĩa là một trang lỗi đã trả lời bằng mã thành công.',
    'why_wrong_format' => 'Ảnh đó ở một định dạng bảng điều khiển này không lưu. Pelican giữ PNG, JPEG và WebP.',
    'why_unwritable' => 'Không ghi được ảnh. Kiểm tra xem storage/app/public có thuộc về người dùng mà bảng điều khiển đang chạy dưới quyền không, và đã chạy php artisan storage:link chưa.',
    'why_unknown' => 'Không thành, và lý do không thuộc loại mà cái này có tên gọi cho nó.',

    // ---- tất cả cùng lúc -------------------------------------------------
    'bulk' => 'Lấy hết những cái còn thiếu',
    'bulk_confirm_steam' => 'Tìm trên Steam theo tên cho mọi egg chưa có ảnh và chưa bị khóa. Egg đã khóa và egg vốn đã có ảnh thì được để yên. Việc này chạy nền — bạn sẽ được báo khi xong.',
    'bulk_confirm_both' => 'Tìm trên Steam theo tên cho mọi egg chưa có ảnh và chưa bị khóa, rồi thử IGDB cho những cái Steam không tìm ra. Egg đã khóa và egg vốn đã có ảnh thì được để yên. Việc này chạy nền — bạn sẽ được báo khi xong.',

    'bulk_started' => 'Đang lấy dưới nền',
    'bulk_started_body' => 'Trên một bảng điều khiển lớn, việc này có thể mất vài phút. Bạn sẽ nhận thông báo khi xong, và bạn có thể rời trang này.',

    'bulk_done' => 'Xong phần ảnh cho egg',
    'bulk_done_body' => 'Lấy được :fetched, để yên :skipped, không tìm ra gì cho :failed. Một egg được để yên khi nó đã khóa hoặc vốn đã có ảnh.',

    'bulk_failed' => 'Lượt lấy hàng loạt không chạy',
    'bulk_failed_queue' => 'Không giao được nó cho hàng đợi. Việc này cần một queue worker — hãy kiểm tra xem pelican-queue có chạy không.',

    // ---- thông tin đăng nhập IGDB ----------------------------------------
    'credentials' => 'Thông tin đăng nhập',
    'credentials_helper' => 'Steam chạy được mà không cần cái nào trong số này. Chúng chỉ dành cho IGDB, nơi có những trò chơi Steam chưa từng nghe tới — Minecraft và mọi nhánh của nó, mọi thứ ra mắt trên máy chơi game, và phần lớn các egg đã gắn mod.',
    'credentials_where' => 'Tạo một ứng dụng ở dev.twitch.tv/console, sinh một client secret, rồi dán cả hai vào đây. Nó miễn phí.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Đã lưu thông tin đăng nhập',
    'credentials_failed' => 'Không lưu được thông tin đăng nhập',
];
