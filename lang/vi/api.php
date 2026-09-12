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
    'subheading' => 'Những chiếc khóa cho phép một thứ bên ngoài bảng điều khiển hỏi xem plugin này biết gì. Chỉ đọc - không gì ở đây khởi động, dừng hay với tới được một máy chủ.',

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
    'once_body' => 'Nó được lưu dưới dạng một chuỗi băm, nên không ai - kể cả người vận hành bảng điều khiển này - đọc lại được. Hãy dán nó vào chỗ con bot hay đoạn script đọc, ngay bây giờ. Nếu làm mất, hãy thu hồi chiếc này và xin chiếc khác.',
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
    'scope_panel_helper' => 'Trả lời những câu hỏi ở tầm cả bảng điều khiển - mọi node, sức chứa, người canh cửa, và chính cái máy của bảng điều khiển. Dành cho một con bot báo cáo về bảng điều khiển chứ không phải cho một con người.',

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
    'grant_confirm' => 'Cấp một chiếc khóa trả lời cho những máy chủ của chính người này, và hiện nó ra một lần. Họ vốn đã thấy được mọi thứ chiếc khóa sẽ báo - cái này quyết định liệu một thứ bên ngoài bảng điều khiển có được phép hỏi thay cho họ hay không.',
    'granted' => 'Đã cấp',

    'refuse' => 'Từ chối',
    'refuse_answer' => 'Nói gì với họ',
    'refuse_answer_helper' => 'Không bắt buộc, và hiện trên trang của chính họ. Một lời từ chối không có lý do là một lời từ chối sẽ bị hỏi lại vào tuần sau.',
    'refused' => 'Đã từ chối',
    'collect' => 'Hiện khóa của tôi',
    'state_ready_body' => 'Đã cấp. Bấm Hiện khóa của tôi để xem - một lần thôi, bởi vì nó được lưu dưới dạng chuỗi băm và sau đó không đọc lại được.',
    'replace' => 'Thay khóa',
    'replace_confirm' => 'Chiếc khóa này ngừng hoạt động ngay lập tức và một chiếc mới thế chỗ nó, hiện ra một lần. Không có cách nào tra lại chiếc cũ - nó chưa từng được lưu - nên thay khóa là câu trả lời duy nhất cho việc làm mất nó.',
    'granted_body' => 'Họ tự lấy nó ở trang Truy cập API của chính họ. Nó không hiện ra ở đây: một chiếc khóa thuộc về người đã xin nó, chứ không thuộc về người đã đồng ý.',

    'revoke' => 'Thu hồi',
    'revoke_confirm' => 'Chiếc khóa ngừng trả lời ngay lập tức và chuỗi băm của nó bị xóa, nên không lấy lại được. Mọi thứ đang dùng nó sẽ dừng. Hãy xin một chiếc mới thay vì tìm cách hoàn tác việc này.',
    'revoked' => 'Đã thu hồi',
    'forget' => 'Gỡ bỏ',
    'forget_confirm' => 'Xóa hẳn dòng này khỏi trang. Nó vốn đã ngừng trả lời, nên không có thứ gì đang chạy bị dừng - cái này chỉ bỏ đi dấu vết rằng nó từng tồn tại.',
    'forgotten' => 'Đã gỡ bỏ',

    'mint' => 'Khóa mới',
    'mint_body' => 'Dành cho một con bot chứ không phải một con người. Nó được cấp ngay lúc tạo, bởi vì bạn chính là người lẽ ra sẽ duyệt nó.',
    'abilities' => 'Nó được phép hỏi những gì',
    'abilities_helper' => 'Ban đầu mọi thứ đều được đánh dấu, bởi vì trước khi có mục này thì một chiếc khóa vốn là như vậy. Bỏ đánh dấu mới là hành động có chủ ý. Thứ được lưu là danh sách được phép, nên một khả năng thêm vào ở bản phát hành sau sẽ tắt với những khóa tạo trước nó - một khả năng không ai đánh dấu là một khả năng không ai cấp.',
    'ability_health' => 'Chứng minh khóa còn dùng được',
    'ability_health_helper' => 'Không với tới thứ gì khác. Gọi theo định kỳ cũng không sao.',
    'ability_me' => 'Máy chủ của chính nó',
    'ability_me_helper' => 'Những máy chủ mà chủ của nó vốn đã mở được, cùng các bản sao lưu của chúng. Nó không bao giờ thấy được của người khác.',
    'ability_panel' => 'Toàn bộ bảng điều khiển',
    'ability_panel_helper' => 'Mọi node, mọi bản sao lưu, các tác vụ theo lịch đã dừng, người canh cửa và cái máy của bảng điều khiển. Còn cần một chiếc khóa ở tầm cả bảng điều khiển nữa.',
    'ability_live' => 'Hỏi thẳng một máy chủ',
    'ability_live_helper' => 'Ai đang chơi, và một máy chủ có đang chạy hay không. Đây là những câu hỏi duy nhất tốn kém - chúng với tới một máy chủ trò chơi hoặc một daemon, được nhớ đệm mười lăm đến hai mươi giây.',
    'ability_connect' => 'Nối tài khoản Discord với tài khoản bảng điều khiển',
    'ability_connect_helper' => 'Nhóm duy nhất không phải là đọc. Nó tạo khóa API Pelican trên tài khoản của những người xin, và có thể cắt một kết nối. Chỉ trao nó cho đúng con bot cần tới.',
    'own_rate' => 'Số yêu cầu mỗi phút cho chiếc khóa này',
    'own_rate_helper' => 'Để trống để theo cài đặt của bảng điều khiển. Một con số ở đây chỉ áp cho riêng chiếc khóa này. Số không nghĩa là không có trần nào cả - hợp lý với một con bot chạy trên chính máy của bạn, và là một cách để hối tiếc thật sự nếu chiếc khóa đi tới chỗ khác.',
    'own_rate_default' => 'Theo bảng điều khiển',
    'mint_owner' => 'Nó là của ai',
    'mint_owner_helper' => 'Một chiếc khóa trả lời với tư cách một người nào đó. Với khóa ở tầm cả bảng điều khiển thì đây chỉ là ai chịu trách nhiệm về nó; với khóa cá nhân thì đây còn là những gì khóa nhìn thấy được.',
    'minted' => 'Đã tạo',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Một chiếc khóa cho Essentials API',
    'profile_make_helper' => 'Một API khác với cái ở trên: cái này trả lời những gì plugin này biết - máy chủ nào của bạn chưa có bản sao lưu, ai đang chơi trên đó, chúng có đang chạy hay không. Nó luôn chỉ trả lời cho riêng bạn và chỉ với tới những máy chủ bạn vốn đã mở được.',
    'profile_create' => 'Tạo',
    'profile_yours' => 'Các khóa Essentials của bạn',
    'profile_manage' => 'Thu hồi một chiếc khóa, xem vì sao một chiếc bị từ chối, và kết nối Discord đều nằm ở trang Truy cập API trong thanh bên.',
    'discord' => 'Discord',
    'discord_body' => 'Nối tài khoản Discord của bạn với tài khoản này, để một con bot trả lời được về máy chủ của bạn khi bạn nhờ nó. Thứ nó nhận được là một chiếc khóa với tới đúng những gì bạn với tới được, không hơn.',
    'discord_connect' => 'Kết nối Discord',
    'discord_code' => 'Gõ cái này trong Discord trong vòng mười phút',
    'discord_code_body' => 'Gửi :command trong một kênh mà con bot đọc được. Mã này dùng được một lần. Không ai dùng được nó ngoài tài khoản mà nó được tạo cho.',
    'discord_on' => 'Đã kết nối với tư cách :name',
    'discord_since' => 'Từ :when',
    'discord_cut' => 'Ngắt kết nối',
    'discord_cut_confirm' => 'Cắt kết nối và xóa chiếc khóa mà nó đã tạo, nên con bot ngừng trả lời thay bạn ngay lập tức. Bạn muốn nối lại lúc nào cũng được.',
    'discord_off' => 'Chưa kết nối',
    'discord_key_note' => 'Kết nối sẽ tạo trên tài khoản của bạn một khóa API Pelican tên là Discord (Essentials). Bạn xem và thu hồi nó được ở Tài khoản → API keys - trang này chỉ là lối tắt tới đúng chỗ đó.',
    'docs_title' => 'Dùng API này thế nào',
    'docs_subheading' => 'Bảng điều khiển này trả lời những gì, ở những địa chỉ nào. Được viết ra từ chính bản mô tả mà API được dựng lên, nên nó không thể tụt lại sau API một bản phát hành.',
    'docs_base' => 'Nó nằm ở đâu',
    'docs_endpoints' => 'Endpoint',
    'docs_answers' => 'Cái gì trả về',
    'docs_calls' => 'Những khóa được phép gọi',
    'docs_params' => 'Gửi cái gì',
    'docs_required' => 'bắt buộc',
    'docs_optional' => 'không bắt buộc',
    'docs_try' => 'Thử xem',
    'docs_errors' => 'Khi có gì đó không ổn',
    'docs_hook' => 'Bảng điều khiển gửi gì cho bạn',
    'docs_hook_body' => 'Chiều ngược lại, và là phần duy nhất ở đây tới nơi mà không cần ai hỏi. Bật ở mục Cảnh báo cùng một địa chỉ và một chuỗi bí mật để ký: một lần gửi JSON khi người canh cửa thấy điều gì đó và một lần nữa khi nó ổn trở lại, để một con bot nghe được tin về một node đã chết thay vì cứ mỗi phút lại hỏi xem có cái nào như vậy không.',
    'docs_hook_verify' => 'Phần thân được băm bằng chuỗi bí mật của bạn và chuỗi băm đi trong X-Essentials-Signature dưới dạng sha256=<hex>. Hãy băm đúng phần thân thô, đừng băm một đối tượng đã dựng lại - chỉ cần khác nhau về khoảng trắng hay thứ tự khóa là chuỗi băm đã khác, và lần lệch nhau ấy trông như một cuộc tấn công chứ không như một lỗi.',
    'docs_download_md' => 'Tải về dạng Markdown',
    'docs_download_json' => 'Tải về dạng OpenAPI',

    // ---- người quản trị đặt những gì -------------------------------------
    'settings' => 'Cách cái này hoạt động',
    'approval' => 'Yêu cầu phải chờ được duyệt',
    'approval_helper' => 'Bật, người xin một chiếc khóa sẽ nhận được nó khi có ai đó đồng ý. Tắt, họ nhận ngay - điều đó hợp lý trên một bảng điều khiển nơi mọi người có tài khoản đều đã được tin cậy, và đáng để chọn một cách có chủ ý chứ không phải rơi vào lúc nào không hay.',
    'rate' => 'Số yêu cầu mỗi phút, cho mỗi khóa',
    'rate_helper' => 'Một con bot hỏi bốn mươi máy chủ xem ai đang chơi là bốn mươi câu hỏi tới bốn mươi máy chủ trò chơi. Đây là cái trần giữ cho một vòng lặp ai đó viết lúc ba giờ sáng không biến thành một bài kiểm tra tải.',
    'days' => 'Một chiếc khóa đã cấp sống được',
    'days_helper' => 'Tính bằng ngày. Số không nghĩa là tới khi bị thu hồi, và đó là mặc định - một chiếc khóa hết hạn lúc chẳng ai để ý là một con bot chết giữa đêm mà không chỗ nào nói vì sao.',
    'days_never' => 'Tới khi bị thu hồi',
    'hide_pelican' => 'Bỏ tab API keys của chính bảng điều khiển',
    'hide_pelican_helper' => 'Gỡ hẳn tab API keys khỏi trang hồ sơ tài khoản, để trên trang đó chỉ còn một thứ mang tên API keys. Nó bị lấy khỏi trang chứ không phải bị che đi, nên không còn địa chỉ nào dẫn tới nó nữa. Có một điều nó không làm được: client API của chính bảng điều khiển vẫn sẽ tạo một khóa tài khoản cho bất cứ thứ gì hỏi thẳng nó - cái tab là chỗ người ta tạo bằng tay, và cái này lấy đi bàn tay ấy. Những khóa đã có vẫn dùng được.',

    /*
     * Nói thẳng trên trang thay vì để người ta tự phát hiện ra. Pelican hoàn tác
     * các migration của một plugin khi gỡ nó đi, và cái bảng duy nhất của plugin
     * này đi theo chúng.
     */
    'uninstall_note' => 'Gỡ plugin này đi sẽ xóa theo mọi chiếc khóa. Đó là cố ý - một chiếc khóa sống lâu hơn thứ trả lời cho nó là một thông tin đăng nhập chẳng ai thu hồi được nữa.',
];
