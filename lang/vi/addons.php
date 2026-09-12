<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Tiện ích thêm, bán kèm một gói.
 *
 * Hai chữ được giữ tách bạch ở đây. Một tiện ích *giá* bao nhiêu là giá của nó,
 * và đó là số tiền được tính mỗi lần. Nó *tốn bao nhiêu hôm nay* chỉ là một
 * phần của số ấy, bởi người mua nó vào giữa tháng chỉ trả cho nửa tháng. Chữ
 * viết cho khách luôn nói rõ đang nói tới cái nào trong hai cái đó.
 *
 * "Không thêm gì cho máy chủ" là một câu trả lời thật và được nói thành lời chứ
 * không để trống, bởi bán quyền được hỗ trợ trước là chuyện hết sức bình thường
 * và một ô trống đọc ra như một lỗi.
 */

return [
    'title' => 'Tiện ích thêm',
    'nav_label' => 'Tiện ích thêm',
    'subheading' => 'Những thứ bán kèm một gói: thêm bộ nhớ, thêm một chỗ sao lưu, hoặc một thứ chỉ là một dòng trên hóa đơn.',

    // ---- bảng -------------------------------------------------------------
    'column_name' => 'Tiện ích',
    'column_price' => 'Giá',
    'column_adds' => 'Thêm',
    'column_sold' => 'Đang dùng',
    'column_live' => 'Đang bán',
    'adds_nothing' => 'Không thêm gì cho máy chủ',

    // ---- biểu mẫu ---------------------------------------------------------
    'section_what' => 'Nó là gì',
    'section_what_helper' => 'Tên và giá khách nhìn thấy, và nó được bán kèm những gói nào.',
    'name' => 'Tên',
    'price' => 'Giá',
    'price_helper' => 'Số tiền được tính mỗi lần. Mua vào giữa kỳ thì khách trả một phần của số này, và trả trọn từ lần gia hạn kế tiếp.',
    'billing' => 'Tính tiền',
    'billing_helper' => 'Theo dịch vụ nghĩa là nó quay lại ở mỗi lần gia hạn, chừng nào họ còn giữ. Một lần nghĩa là nó được tính trên hóa đơn đầu tiên mang nó và không bao giờ tính nữa.',
    'billing_with' => 'Mỗi lần gia hạn',
    'billing_once' => 'Một lần',
    'max' => 'Nhiều nhất mỗi dịch vụ',
    'max_helper' => 'Một người được giữ bao nhiêu cái loại này. Một là trường hợp thường; hãy nâng lên cho thứ bán theo gigabyte.',
    'description' => 'Mô tả',
    'description_helper' => 'Một dòng nằm dưới cái tên ở bước thanh toán. Hãy nói nó làm được gì chứ đừng nói nó tên là gì.',
    'packages' => 'Gói',
    'packages_helper' => 'Cái này được bán kèm những gói nào. Không đánh dấu gì nghĩa là kèm tất cả, và đó thường là trường hợp của một tùy chọn hỗ trợ hay một chỗ sao lưu.',

    'section_adds' => 'Nó thêm gì cho máy chủ',
    'section_adds_helper' => 'Những số này được cộng vào những gì gói đã cho, chứ không thay thế: 4096 ở bộ nhớ làm máy chủ to thêm 4 GiB. Hai tiện ích giống nhau thì cộng dồn. Hãy để tất cả bằng không cho thứ chỉ là một dòng trên hóa đơn. Một số âm sẽ lấy bớt đi, điều đó được phép và thỉnh thoảng đúng là thứ người ta muốn.',
    'sort' => 'Thứ tự',
    'sort_helper' => 'Số nhỏ hơn đứng trước ở bước thanh toán. Bằng nhau thì xét tới giá.',
    'live' => 'Đang bán',
    'live_helper' => 'Tắt thì nó không được chào ở đâu cả. Ai đang có thì vẫn giữ và vẫn bị tính tiền cho nó.',

    // ---- các nút ----------------------------------------------------------
    'new' => 'Tiện ích mới',
    'edit' => 'Sửa',
    'delete' => 'Xóa',
    'delete_confirm' => 'Chưa ai có cái này. Xóa nó là gỡ nó khỏi danh sách vĩnh viễn.',
    'delete_sold' => ':count dịch vụ đang có cái này. Chúng vẫn giữ nó, vẫn giữ những giới hạn nó đã cho và vẫn bị tính tiền cho nó - cái mất đi là dòng trên danh sách, để không ai mua mới được nữa.',
    'go_live' => 'Đưa lên bán',
    'go_offline' => 'Ngừng bán',
    'saved' => 'Đã lưu',
    'deleted' => 'Tiện ích đã bị xóa',
    'save_failed' => 'Chưa lưu được',
    'save_failed_body' => 'Không có gì được ghi lại. Hãy thử lại, và xem nhật ký nếu chuyện cứ lặp lại.',
    'invalid' => 'Một tiện ích cần có tên và giá.',
    'empty' => 'Chưa có tiện ích nào',
    'empty_body' => 'Một tiện ích là thứ bán kèm bên cạnh một gói: thêm một gigabyte, một chỗ sao lưu thứ hai, hoặc một dịch vụ chẳng thêm gì cho máy chủ cả.',

    // ---- những gì khách nhìn thấy -----------------------------------------
    'choose' => 'Tiện ích thêm',
    'choose_helper' => 'Không bắt buộc, và bạn có thể thêm hay bỏ sau.',
    'yours' => 'Tiện ích trên dịch vụ này',
    'add' => 'Thêm một tiện ích',
    'add_helper' => 'Bây giờ bạn trả cho phần còn lại của kỳ này, và trả trọn giá từ lần gia hạn kế tiếp.',
    'add_to' => 'Thêm :name',
    'add_confirm' => 'Thêm :name vào dịch vụ này?',
    'drop' => 'Gỡ bỏ',
    'drop_confirm' => 'Gỡ :name? Phần bạn đã trả mà chưa dùng sẽ quay lại tài khoản của bạn, và máy chủ của bạn đổi ngay lập tức.',
    'costs_now' => 'trả :amount bây giờ',
    'free_now' => 'Bây giờ không phải trả gì',
    'then' => 'sau đó :amount mỗi lần gia hạn',
    'once_only' => ':amount, một lần',
    'each' => 'mỗi cái',
    'added' => 'Đã thêm :name',
    'added_body' => 'Máy chủ của bạn đã nhận được những gì nó thêm vào.',
    'dropped' => 'Đã gỡ :name',
    'dropped_body' => 'Phần bạn đã trả mà chưa dùng nằm trong tài khoản của bạn.',

    // ---- và khi nào thì không được ----------------------------------------
    'refused' => 'Việc đó không làm được',
    'refused_off' => 'Bảng điều khiển này đã tắt tiện ích thêm.',
    'refused_not_active' => 'Chỉ dịch vụ đang chạy mới thêm tiện ích được.',
    'refused_gone' => 'Tiện ích đó không còn bán nữa.',
    'refused_wrong_package' => 'Tiện ích đó không bán kèm gói này.',
    'refused_enough' => 'Bạn đã có đủ số cái mà dịch vụ này được phép giữ.',
    'refused_failed' => 'Không có gì được ghi lại, nên không có gì thay đổi. Hãy thử lại, và báo cho người quản lý bảng điều khiển này nếu chuyện cứ lặp lại.',
    'refused_server' => 'Máy chủ không chịu nhận giới hạn mới, nên không có gì thay đổi và không có gì bị tính tiền.',
    'refused_not_yours' => 'Tiện ích đó không nằm trên dịch vụ này.',

    // ---- những gì ghi trên giấy tờ ----------------------------------------
    'line' => ':name × :many, cho :days ngày còn lại của kỳ này',
    'credit_reason' => 'Đã gỡ: :name',
    'bell_failed' => 'Một tiện ích không đưa được vào máy chủ ở đơn hàng :number',

    // ---- đơn vị, cho bảng của quản trị ------------------------------------
    'unit_memory' => 'MiB bộ nhớ',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB ổ đĩa',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'database',
    'unit_allocation_limit' => 'allocation',
    'unit_backup_limit' => 'bản sao lưu',
];
