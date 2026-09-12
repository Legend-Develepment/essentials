<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Người canh cửa.
 *
 * Mỗi tin nhắn từ đây đều được đọc trên một cái điện thoại, lúc ba giờ sáng, bởi
 * một người mới ngủ cách đây một phút. Mỗi tin nói rõ máy nào, sai chuyện gì, và
 * không gì hơn - chi tiết thuộc về cái trang người ta mở ra sau đó, chứ không
 * thuộc về cái dòng đã đánh thức họ.
 *
 * Việc một thứ đã ổn trở lại được viết như một tin tức chứ không phải một dòng
 * chú thích. "Nó về chưa" chính là câu hỏi mà nếu không thì có người sẽ phải bò
 * dậy.
 *
 * "Node", "Wings", "daemon", "webhook", "queue", "Discord" và "SMTP" giữ nguyên
 * tiếng Anh: đó là những cái tên bạn tìm thấy chúng trong Pelican, trên máy chủ
 * và trong mọi thứ viết về chúng.
 */

return [
    'title' => 'Cảnh báo',
    'nav_label' => 'Cảnh báo',
    'subheading' => 'Bảng điều khiển vốn đã biết khi nào một node ngừng trả lời, khi nào một ổ đĩa đầy dần, hay khi nào hàng đợi dừng lại. Đây là thứ nói cho bạn biết điều đó.',

    // ---- các kênh, và lần gần nhất chúng làm gì ---------------------------
    'channels' => 'Tin nhắn đi đâu',
    'channels_helper' => 'Mỗi kênh đã làm gì ở lần gần nhất nó được yêu cầu gửi một thứ gì đó. Một kênh đang bật mà lặng lẽ từ chối trông y hệt một bảng điều khiển chẳng có gì sai, và vì vậy mục này đứng đầu trang.',

    'state_off' => 'Tắt',
    'state_untried' => 'Chưa gửi gì cả',
    'state_ok' => 'Đã chuyển',
    'state_failed' => 'Bị từ chối',

    // ---- khi nào -----------------------------------------------------------
    'when' => 'Bao lâu một lần',
    'when_helper' => 'Các lượt kiểm tra chạy nền, nên chúng cần một queue worker. Không có nó thì chẳng gửi được gì, và cũng chẳng có gì nói cho bạn biết - hãy dùng "Gửi thử", cái đó không đi qua hàng đợi.',

    'every' => 'Kiểm tra mỗi',
    'every_helper' => 'Mỗi lượt kiểm tra đều với tới daemon trên từng node, nên đó là một yêu cầu cho mỗi node mỗi vòng. Mười lăm phút là đủ để nghe tin về một sự cố trong khi nó còn đang là sự cố.',
    'every_off' => 'Tắt - không kiểm tra gì cả',
    'every_five' => '5 phút',
    'every_fifteen' => '15 phút',
    'every_thirty' => '30 phút',
    'every_hourly' => 'Giờ',
    'every_daily' => 'Ngày',

    'repeat' => 'Nhắc tôi chừng nào nó còn kéo dài',
    'repeat_helper' => 'Một tin được gửi khi có gì đó thay đổi, và một tin nữa khi nó ổn trở lại. Cái này thêm một lời nhắc trong lúc vấn đề vẫn còn. Số không nghĩa là không nhắc - một kênh cứ mười lăm phút lặp lại một lần là cái kênh người ta tắt tiếng.',
    'hours' => 'giờ',

    // ---- đi đâu ------------------------------------------------------------
    'where' => 'Kênh',
    'where_helper' => 'Nhiều hơn một là khôn ngoan. Chúng hỏng theo những cách khác nhau.',

    'discord' => 'Discord',
    'discord_helper' => 'Chỗ mà một tin nhắn thật sự được đọc bởi người không ngồi nhìn bảng điều khiển.',
    'webhook' => 'Địa chỉ webhook',
    'webhook_helper' => 'Trong Discord: Cài đặt máy chủ → Tích hợp → Webhooks → Webhook mới → Sao chép URL webhook. Giới hạn ở https, bởi vì cái này công bố máy nào của bạn đang tắt và ổ đĩa của nó đầy tới đâu.',
    'bot' => 'Một con bot của riêng bạn',
    'bot_helper' => 'Một lần gửi JSON có chữ ký tới một địa chỉ do bạn dựng, để một thứ bên ngoài bảng điều khiển nghe được tin về một node đã chết thay vì cứ mỗi phút lại hỏi xem có cái nào như vậy không. Webhook có sẵn của Pelican không chở nổi chuyện này: chúng kích hoạt theo model và theo nhật ký hoạt động, mà một node đã ngừng trả lời thì không ghi vào cái nào cả.',
    'bot_url' => 'Gửi tới đâu',
    'bot_url_helper' => 'Giới hạn ở https, bởi vì cái này gửi chuyện máy nào của bạn đang tắt tới một địa chỉ trên internet.',
    'bot_secret' => 'Chuỗi bí mật để ký',
    'bot_secret_helper' => 'Dùng chung với thứ nhận cái này. Phần thân được băm bằng nó và chuỗi băm đi trong X-Essentials-Signature dưới dạng sha256=<hex>, nên con bot của bạn có thể từ chối mọi thứ không đến từ bảng điều khiển này. Chừng nào ô này còn trống thì không gì được gửi đi - một chữ ký không bắt buộc là một chữ ký chẳng ai kiểm tra.',

    'panel' => 'Trong bảng điều khiển',
    'panel_helper' => 'Một thông báo tới mọi người giữ quyền này. Luôn hoạt động, không cần cài đặt gì, và vô hình với bất kỳ ai chưa đăng nhập.',

    'email' => 'Email',
    'email_helper' => 'Ngăn nhau bằng dấu phẩy. Dùng chính mailer của bảng điều khiển - đáng tin khi đã cấu hình, và câm hoàn toàn khi chưa, mà đó lại đúng là kiểu hỏng mà một người canh cửa không được phép có. Để trống để tắt nó đi.',

    // ---- cái gì ------------------------------------------------------------
    'what' => 'Những gì được canh chừng',
    'what_helper' => 'Mọi số đo ở đây đều là số bảng điều khiển vốn đã lấy. Không có gì trên trang này mở ra một kết nối mà trang Trạng thái hệ thống không mở.',

    'percent_helper' => 'Số không tắt lượt kiểm tra này.',
    'disk' => 'Cảnh báo khi ổ đĩa của một node vượt quá',
    'memory' => 'Cảnh báo khi bộ nhớ của một node vượt quá',

    'maintenance' => 'Cảnh báo về việc bảo trì kéo dài hơn',
    'maintenance_helper' => 'Một node đang bảo trì thì mọi lượt kiểm tra khác đều bỏ qua, và như thế là đúng - nhưng cũng đúng là như thế thì một node bị quên trong mười bốn ngày. Số không tắt việc này đi.',

    'versions' => 'Phiên bản của bảng điều khiển và Wings',
    'versions_helper' => 'Một tin khi có thứ gì tụt lại, và một tin khi nó cập nhật trở lại. Không nhắc lại - một phiên bản không phải một sự cố.',

    'backups' => 'Bản sao lưu bị tụt lại',
    'backups_helper' => 'Một tin nêu tên các máy chủ thay vì mỗi máy chủ một tin - khi một tác vụ theo lịch dừng lại thì mọi máy chủ cùng lúc trở nên cũ, và bốn mươi tin riêng lẻ cho một nguyên nhân là cái kênh người ta tắt tiếng. Mặc định tắt: một bảng điều khiển sao lưu bằng tay chứ không theo lịch sẽ nghe chuyện này mỗi ngày.',
    'backup_days' => 'Coi một bản sao lưu là cũ sau',
    'backup_days_helper' => 'Đó cũng là con số trang Bản sao lưu dùng. Một máy chủ sao lưu hằng tuần thì không nên bị báo sau tám ngày.',
    'days' => 'ngày',

    'stock' => 'Gói đang cạn hàng',
    'stock_helper' => 'Một tin nêu tên các gói thay vì mỗi gói một tin, và không bao giờ nhắc lại: hết hàng là một trạng thái bình thường của một cửa hàng chứ không phải một sự cố, và cứ bốn giờ lại nghe về nó một lần chính là cách để cái này không còn ai đọc. Chỉ những gói có giới hạn mới được ngó tới, nên một cửa hàng bán mọi thứ mà không đặt giới hạn thì canh chừng chẳng tốn gì. Mặc định tắt, như phần còn lại.',
    'stock_left' => 'Cảnh báo khi chỉ còn',
    'stock_left_helper' => 'Tính theo giới hạn đặt trên gói. Một gói phải tụt xuống tới con số này mới bị cảnh báo, và phải leo lên trên nó hai bậc mới được coi là ổn trở lại, nên một gói bị một lần mua rồi một lần hủy đẩy qua đẩy lại thì chẳng nói gì. Số không ở đây là một con số chứ không phải một sự vắng mặt: nó giữ cho lời cảnh báo im lặng và chỉ để lại cái tin báo rằng một gói đã hết.',
    'stock_left_suffix' => 'suất',

    'worker' => 'Queue worker',
    'worker_helper' => 'Liệu có thứ gì thật sự đang làm phần việc chạy nền của plugin này không. Để ý cái vòng luẩn quẩn: chính lượt kiểm tra cũng chạy trên hàng đợi, nên một bảng điều khiển chưa từng có worker thì không thể báo chuyện đó. Dòng ở đầu trang này thì có thể.',

    // ---- các nút -----------------------------------------------------------
    'save' => 'Lưu',
    'saved' => 'Đã lưu',
    'save_failed' => 'Không có gì được lưu',

    'test' => 'Gửi thử',
    'test_one' => 'Thử',
    'test_off' => 'Kênh đó đang tắt',
    'test_off_body' => 'Bật nó lên rồi lưu, nó sẽ được thử cùng với những kênh còn lại.',
    'test_title' => 'Tin nhắn thử',
    'test_body' => 'Nếu bạn đang đọc dòng này thì cảnh báo từ bảng điều khiển Pelican của bạn tới được đây. Không có gì trục trặc cả.',
    'test_sent' => 'Đã gửi tới mọi kênh đang bật',
    'test_failed' => 'Ít nhất một kênh từ chối nó',
    'test_none' => 'Không có chỗ nào để gửi',
    'test_none_body' => 'Không kênh nào đang bật, nên một cảnh báo thật cũng chẳng đi tới đâu.',

    /*
     * Làm gì với một lần bị từ chối.
     *
     * Lý do nhà cung cấp đưa ra thì ngắn, đúng, và tự nó thì vô dụng. Hai lý do
     * gần như lần nào cũng gặp thì được gọi thẳng tên, bởi vì không lý do nào
     * đoán được từ mã: một mã 553 là chuyện của người gửi chứ không phải người
     * nhận, còn một mã 401 từ Discord là một URL đã bị thu hồi hoặc gõ sai.
     */
    'hint_email_sender' => 'Máy chủ SMTP của bạn từ chối cái địa chỉ mà bảng điều khiển gửi đi, chứ không phải địa chỉ nó gửi tới. Ở Admin → Cài đặt → Email, địa chỉ Từ phải là một hộp thư mà tài khoản SMTP của bạn được phép gửi dưới danh nghĩa đó. Chuyện này chẳng liên quan gì tới plugin này - chính email thử của Pelican ở trang đó cũng hỏng y hệt như vậy.',
    'hint_email' => 'Xem ở Admin → Cài đặt → Email. Nút gửi email thử ở trang đó dùng cùng những cài đặt và nói cùng một điều.',
    'hint_discord_url' => 'Discord không nhận ra cái webhook đó. Nó đã bị xóa, đã được tạo lại, hoặc dán vào thiếu - hãy tạo cái mới ở Cài đặt máy chủ → Tích hợp → Webhooks rồi sao chép trọn cái URL.',
    'hint_discord' => 'Bảng điều khiển không tới được Discord. Nếu bảng điều khiển này nằm sau một tường lửa chặn các yêu cầu đi ra thì kênh này không chạy được từ đây.',
    'hint_panel' => 'Không ai có quyền cho việc này, hoặc không lưu được thông báo. Xem ở mục Vai trò.',

    'run_now' => 'Chạy các lượt kiểm tra ngay',
    'run_started' => 'Đang kiểm tra dưới nền',
    'run_failed' => 'Không khởi động được các lượt kiểm tra',

    'reset' => 'Quên những gì nó đã biết',
    'reset_confirm' => 'Xóa sạch những gì mỗi lượt kiểm tra nói lần gần nhất. Vòng kế tiếp học lại từ đầu và không gửi gì cả, nên một vấn đề vẫn còn sẽ được báo ở vòng sau đó. Hãy dùng cái này sau khi bạn đã cho một node ngừng hoạt động mà người canh cửa cứ càm ràm mãi.',
    'reset_done' => 'Đã xóa sạch',

    // ---- chính các tin nhắn ------------------------------------------------
    'still' => 'Đã kéo dài :for.',
    'cleared_body' => 'Nó đã như vậy suốt :for.',

    'for_unknown' => 'một lúc',
    'for_minutes' => ':count phút',
    'for_hours' => ':count giờ',
    'for_days' => ':count ngày',

    'node_down' => ':node không trả lời',
    'node_down_body' => 'Bảng điều khiển không tới được daemon trên :node. Máy chủ trên đó sẽ không khởi động, không dừng và không báo gì cho tới khi nó trở lại.',
    'node_up' => ':node trả lời trở lại',

    'node_disk' => ':node sắp hết ổ đĩa',
    'node_disk_body' => 'Ổ đĩa trên :node đã đầy :percent %, vượt mức :limit % bạn đặt. Sao lưu và cài đặt máy chủ là những thứ hỏng đầu tiên khi cái này chạm trần.',
    'node_disk_over' => 'Ổ đĩa trên :node đã xuống dưới ngưỡng',

    'node_memory' => ':node sắp hết bộ nhớ',
    'node_memory_body' => 'Bộ nhớ trên :node đã dùng :percent %, vượt mức :limit % bạn đặt. Máy chủ trên đó có thể bị nhân hệ điều hành giết trước khi có bất cứ thứ gì báo là có vấn đề.',
    'node_memory_over' => 'Bộ nhớ trên :node đã xuống dưới ngưỡng',

    'node_maintenance' => ':node đã bảo trì khá lâu',
    'node_maintenance_body' => ':node đã ở chế độ bảo trì hơn :hours giờ. Trong lúc đó không thứ gì khác trên nó được kiểm tra, và đó chính là toàn bộ ý nghĩa của chế độ này - nhưng cũng đáng biết rằng nó vẫn đang như vậy.',
    'node_maintenance_over' => ':node đã ra khỏi chế độ bảo trì',

    'wings_behind' => 'Wings trên :node đã cũ',
    'wings_behind_body' => ':node đang chạy Wings :installed, còn :latest thì đã ra. Hãy cập nhật ngay trên node - bảng điều khiển không có cách nào làm việc đó.',
    'wings_current' => 'Wings trên :node đã cập nhật',

    'panel_behind' => 'Bảng điều khiển đã cũ',
    'panel_behind_body' => 'Bảng điều khiển này đang chạy :installed, còn :latest thì đã ra.',
    'panel_current' => 'Bảng điều khiển đã cập nhật',

    'and_more' => 'và :count nữa',

    'owners' => 'Báo cho người ta khi cái máy phía sau máy chủ của họ đang tắt',
    'owners_helper' => 'Lượt kiểm tra duy nhất ở đây viết cho người khác ngoài bạn. Chủ của mỗi máy chủ nằm trên một cái máy đã ngừng trả lời sẽ nhận một thông báo trong bảng điều khiển - cái chuông, không bao giờ là email - và một cái nữa khi máy quay lại. Không bao giờ có lời nhắc ở giữa: lặp lại chuyện đó mười lăm phút một lần với tất cả mọi người trên một node đông đúc chính là cách để cảnh báo của một bảng điều khiển không còn ai đọc. Subuser thì không được báo; chính chủ sở hữu mới là người quyết định phải làm gì. Cái máy không được nêu tên với họ, vì cùng lý do mà trang trạng thái cũng không công bố nó.',

    'owner_down' => '{1} Một máy chủ của bạn đang tắt|[2,*] :count máy chủ của bạn đang tắt',
    'owner_down_body' => 'Cái máy chúng đứng trên đó đã ngừng trả lời. Đã có người được báo. Bị ảnh hưởng: :servers',
    'owner_up' => '{1} Máy chủ của bạn đã trở lại|[2,*] :count máy chủ của bạn đã trở lại',
    'owner_up_body' => 'Cái máy đã trả lời trở lại. Đã về: :servers',

    'schedules' => 'Tác vụ theo lịch đã dừng',
    'schedules_helper' => 'Một tác vụ kẹt giữa chừng một lần chạy, một tác vụ đã quá giờ vì cron không chạy, hoặc một tác vụ chưa từng chạy. Pelican không có chữ nào cho bất kỳ trường hợp nào trong số đó - một lần chạy đã đổ sẽ mãi mãi ở trạng thái "đang xử lý" và được vẽ y hệt một lần đang chạy thật. Mỗi lượt kiểm tra đều đọc mọi tác vụ theo lịch còn hoạt động trên bảng điều khiển.',

    'schedule_stopped' => ':count tác vụ theo lịch đã dừng',
    'schedule_stopped_body' => 'Kẹt hơn :hours giờ, trễ hạn, hoặc chưa từng chạy: :schedules',
    'schedule_running' => 'Mọi tác vụ theo lịch đã chạy trở lại',

    'stock_out' => '{1} Một gói đã hết hàng|[2,*] :count gói đã hết hàng',
    'stock_out_body' => 'Vẫn đang bày bán, mà chẳng còn gì để bán: :packages',
    'stock_low' => '{1} Một gói sắp hết hàng|[2,*] :count gói sắp hết hàng',
    'stock_low_body' => 'Còn :limit hoặc ít hơn: :packages',
    'stock_back' => '{1} Một gói đã có hàng trở lại|[2,*] :count gói đã có hàng trở lại',
    'stock_back_body' => 'Lại có hàng để bán: :packages',

    'backup_none' => ':count máy chủ chưa từng có bản sao lưu nào',
    'backup_none_body' => 'Chưa từng sao lưu ở: :servers',
    'backup_none_over' => 'Giờ thì máy chủ nào cũng có một bản sao lưu',

    'backup_stale' => ':count máy chủ đã lâu không có bản sao lưu',
    'backup_stale_body' => 'Không có bản sao lưu thành công nào trong :days ngày ở: :servers',
    'backup_stale_over' => 'Máy chủ nào cũng vừa có một bản sao lưu gần đây',

    'backup_failed' => 'Sao lưu đang hỏng trên :count máy chủ',
    'backup_failed_body' => 'Một lần sao lưu kết thúc không thành ở: :servers',
    'backup_failed_over' => 'Không còn lần sao lưu nào hỏng nữa',

    'worker_missing' => 'Không có gì đang làm việc trên hàng đợi',
    'worker_missing_body' => 'Một công việc đã vào hàng đợi mà chẳng có gì nhận nó. Cập nhật plugin, cài modpack và chính những lượt kiểm tra này đều đứng lại cho tới khi có một worker chạy - hãy thử systemctl status pelican-queue trên máy của bảng điều khiển.',
    'worker_back' => 'Hàng đợi lại đang được xử lý',
    'failed_title' => ':count công việc đã hỏng kể từ lần kiểm tra trước',
    'failed_body' => 'Một việc bảng điều khiển được giao đã không xảy ra và sẽ không được thử lại - một máy chủ không được dựng, một hóa đơn không được viết, một lá thư không được gửi. Chúng nằm trong bảng failed_jobs; `php artisan queue:retry all` đưa chúng trở lại, một khi thứ đã chặn chúng được sửa.',
    'failed_back' => 'Không có gì hỏng kể từ lần kiểm tra trước',
    'failed' => 'Báo cho tôi khi một công việc trong hàng đợi hỏng',
    'failed_helper' => 'Laravel ghi lại một công việc mà nó đã bỏ cuộc và không nói gì về chuyện đó. Cái này thì nói. Đếm chứ không liệt kê: hai mươi lần hỏng trong một đêm thường chỉ có một nguyên nhân.',
];
