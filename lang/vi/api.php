<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Một lối vào từ bên ngoài bảng điều khiển.
 *
 * Hai loại người đọc trong cùng một tệp, và họ muốn hai điều ngược nhau. Người
 * quản trị đọc trang này đang quyết định có tin ai đó với một chiếc khóa hay
 * không, nên mỗi dòng ở đây nói khóa với tới được cái gì chứ không nói nó tên là
 * gì. Người xin một chiếc thì muốn biết mình được trao cái gì và chuyện gì xảy
 * ra nếu làm mất - vì vậy câu nói rằng khóa chỉ hiện ra một lần không phải một
 * dòng chú thích nhỏ.
 *
 * Không chỗ nào ở đây nói "token". "Khóa" là chữ trên chính trang tài khoản của
 * Pelican, và một bảng điều khiển gọi cùng một thứ bằng hai cái tên là một bảng
 * điều khiển nơi có người đi tìm nhầm cái.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Những chiếc khóa cho phép một thứ bên ngoài bảng điều khiển hỏi xem plugin này biết gì. Chỉ đọc — không gì ở đây khởi động, dừng hay với tới được một máy chủ.',

    'my_title' => 'Truy cập API',
    'my_nav_label' => 'Truy cập API',
    'my_subheading' => 'Một chiếc khóa của riêng bạn, cho một con bot hay một đoạn script. Nó chỉ trả lời cho những máy chủ mà bạn vốn đã mở được.',

    // ---- một chiếc khóa là gì, nói một lần, ở chỗ nó có ý nghĩa -----------
    'address' => 'Địa chỉ',
    'address_helper' => 'Gửi khóa dưới dạng một header Authorization: :example',

    /*
     * Điều duy nhất người ta phải đọc trước khi đóng hộp thoại. Viết như một
     * việc phải làm chứ không như một lời cảnh báo, bởi vì "hãy giữ nó cẩn thận"
     * là lời khuyên chẳng ai làm theo được, còn "dán nó vào chỗ con bot đọc,
     * ngay bây giờ" thì được.
     */
    'once' => 'Đây là lần duy nhất chiếc khóa này hiện ra',
    'once_body' => 'Nó được lưu dưới dạng một chuỗi băm, nên không ai — kể cả người vận hành bảng điều khiển này — đọc lại được. Hãy dán nó vào chỗ con bot hay đoạn script đọc, ngay bây giờ. Nếu làm mất, hãy thu hồi chiếc này và xin chiếc khác.',
    'copy' => 'Sao chép',
    'copied' => 'Đã sao chép',

    // ---- các trạng thái --------------------------------------------------
    'state' => 'Trạng thái',
    'state_pending' => 'Đang chờ',
    'state_active' => 'Đang hoạt động',
    'state_refused' => 'Bị từ chối',
    'state_revoked' => 'Đã thu hồi',

    'state_pending_body' => 'Phải có người chấp thuận thì nó mới trả lời được gì.',
    'state_refused_body' => 'Cái này đã bị từ chối. Không có gì được cấp cả.',
    'state_revoked_body' => 'Chiếc khóa này đã bị lấy lại và không còn trả lời nữa.',

    // ---- phạm vi ---------------------------------------------------------
    'scope' => 'Với tới',
    'scope_person' => 'Máy chủ của chính người đó',
    'scope_panel' => 'Toàn bộ bảng điều khiển',

    'scope_person_helper' => 'Chỉ trả lời cho những máy chủ mà chủ của nó vốn đã mở được, hỏi đúng cách mà bảng điều khiển hỏi. Mất chiếc khóa này không mất thứ gì mà chủ của nó chưa từng thấy được.',
    'scope_panel_helper' => 'Trả lời những câu hỏi ở tầm cả bảng điều khiển — mọi node, sức chứa, người canh cửa, và chính cái máy của bảng điều khiển. Dành cho một con bot báo cáo về bảng điều khiển chứ không phải cho một con người.',

    // ---- bảng ------------------------------------------------------------
    'column_name' => 'Để làm gì',
    'column_owner' => 'Của ai',
    'column_prefix' => 'Khóa',
    'column_asked' => 'Đã xin',
    'column_used' => 'Dùng lần cuối',
    'column_expires' => 'Hết hạn',

    'never_used' => 'Chưa bao giờ',
    'no_expiry' => 'Tới khi bị thu hồi',

    'tab_waiting' => 'Đang chờ',
    'tab_active' => 'Đang hoạt động',
    'tab_all' => 'Tất cả',

    'empty' => 'Chưa có khóa nào',
    'empty_body' => 'Chưa ai xin, và cũng chưa có chiếc nào được cấp. Trang này sẽ tự đầy lên khi người ta bắt đầu xin.',

    'my_empty' => 'Bạn chưa có khóa nào',
    'my_empty_body' => 'Hãy xin một chiếc, rồi nó sẽ hiện ra ở đây cùng với câu trả lời bạn nhận được.',

    // ---- xin -------------------------------------------------------------
    'ask' => 'Xin một chiếc khóa',
    'ask_name' => 'Nó dùng để làm gì',
    'ask_name_helper' => 'Vài chữ thôi, để sau này bạn phân biệt được hai chiếc của mình và để người xét duyệt biết họ đang duyệt cái gì.',
    'ask_reason' => 'Có gì đáng nói thêm không',
    'ask_reason_helper' => 'Không bắt buộc. Người ra quyết định sẽ đọc.',
    'ask_sent' => 'Đã xin',
    'ask_sent_body' => 'Nó hiện ra bên dưới ngay khi có người trả lời.',
    'ask_granted' => 'Khóa của bạn đây',
    'ask_open' => 'Bạn đã có một yêu cầu đang chờ trả lời',
    'ask_open_body' => 'Mỗi lần một yêu cầu. Hãy hủy cái kia nếu đó là nhầm lẫn.',
    'ask_failed' => 'Không xin được',

    'cancel' => 'Hủy',
    'cancel_confirm' => 'Rút lại yêu cầu. Chưa có gì được cấp, nên cũng chẳng có gì ngừng chạy.',

    // ---- quyết định ------------------------------------------------------
    'grant' => 'Cấp',
    'grant_confirm' => 'Cấp một chiếc khóa trả lời cho những máy chủ của chính người này, và hiện nó ra một lần. Họ vốn đã thấy được mọi thứ chiếc khóa sẽ báo — cái này quyết định liệu một thứ bên ngoài bảng điều khiển có được phép hỏi thay cho họ hay không.',
    'granted' => 'Đã cấp',

    'refuse' => 'Từ chối',
    'refuse_answer' => 'Nói gì với họ',
    'refuse_answer_helper' => 'Không bắt buộc, và hiện trên trang của chính họ. Một lời từ chối không có lý do là một lời từ chối sẽ bị hỏi lại vào tuần sau.',
    'refused' => 'Đã từ chối',

    'revoke' => 'Thu hồi',
    'revoke_confirm' => 'Chiếc khóa ngừng trả lời ngay lập tức và chuỗi băm của nó bị xóa, nên không lấy lại được. Mọi thứ đang dùng nó sẽ dừng. Hãy xin một chiếc mới thay vì tìm cách hoàn tác việc này.',
    'revoked' => 'Đã thu hồi',

    'mint' => 'Khóa mới',
    'mint_body' => 'Dành cho một con bot chứ không phải một con người. Nó được cấp ngay lúc tạo, bởi vì bạn chính là người lẽ ra sẽ duyệt nó.',
    'mint_owner' => 'Nó là của ai',
    'mint_owner_helper' => 'Một chiếc khóa trả lời với tư cách một người nào đó. Với khóa ở tầm cả bảng điều khiển thì đây chỉ là ai chịu trách nhiệm về nó; với khóa cá nhân thì đây còn là những gì khóa nhìn thấy được.',
    'minted' => 'Đã tạo',

    // ---- người quản trị đặt những gì -------------------------------------
    'settings' => 'Cách cái này hoạt động',
    'approval' => 'Yêu cầu phải chờ được duyệt',
    'approval_helper' => 'Bật, người xin một chiếc khóa sẽ nhận được nó khi có ai đó đồng ý. Tắt, họ nhận ngay — điều đó hợp lý trên một bảng điều khiển nơi mọi người có tài khoản đều đã được tin cậy, và đáng để chọn một cách có chủ ý chứ không phải rơi vào lúc nào không hay.',
    'rate' => 'Số yêu cầu mỗi phút, cho mỗi khóa',
    'rate_helper' => 'Một con bot hỏi bốn mươi máy chủ xem ai đang chơi là bốn mươi câu hỏi tới bốn mươi máy chủ trò chơi. Đây là cái trần giữ cho một vòng lặp ai đó viết lúc ba giờ sáng không biến thành một bài kiểm tra tải.',
    'days' => 'Một chiếc khóa đã cấp sống được',
    'days_helper' => 'Tính bằng ngày. Số không nghĩa là tới khi bị thu hồi, và đó là mặc định — một chiếc khóa hết hạn lúc chẳng ai để ý là một con bot chết giữa đêm mà không chỗ nào nói vì sao.',
    'days_never' => 'Tới khi bị thu hồi',

    /*
     * Nói thẳng trên trang thay vì để người ta tự phát hiện ra. Pelican hoàn tác
     * các migration của một plugin khi gỡ nó đi, và cái bảng duy nhất của plugin
     * này đi theo chúng.
     */
    'uninstall_note' => 'Gỡ plugin này đi sẽ xóa theo mọi chiếc khóa. Đó là cố ý — một chiếc khóa sống lâu hơn thứ trả lời cho nó là một thông tin đăng nhập chẳng ai thu hồi được nữa.',
];
