<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Gói: một máy chủ mà ai đó có thể mua.
 *
 * Người đọc chỗ này là người sắp xếp cửa hàng. Mọi chữ ở đây nói về khuôn mẫu
 * và giá; những gì khách nhìn thấy nằm trong shop.php, vì hai người đọc ấy cần
 * những câu khác nhau cho cùng một dòng.
 *
 * "egg", "node", "swap", "io" và các từ của Minecraft giữ nguyên tiếng Anh: đó
 * là những từ trong chính biểu mẫu tạo máy chủ của Pelican, còn một gói chính
 * là biểu mẫu ấy được lưu lại để dùng sau.
 */

return [
    'title' => 'Gói',
    'nav_label' => 'Gói',
    'subheading' => 'Những thứ được bán. Mỗi gói là một khuôn mẫu máy chủ kèm giá; khách mua một gói và bảng điều khiển tạo ra máy chủ.',

    // ---- bảng ------------------------------------------------------------
    'column_name' => 'Gói',
    'column_egg' => 'Egg',
    'column_price' => 'Giá',
    'column_stock' => 'Tồn kho',
    'column_live' => 'Đang bán',
    'column_orders' => 'Đã bán',

    'live' => 'Đang bán',
    'offline' => 'Không bán',
    'no_egg' => 'Không có egg — không dựng được',

    'stock_unlimited' => 'Không giới hạn',
    'stock_left' => 'Còn :count',
    'stock_out' => 'Hết hàng',

    // ---- kỳ hạn ----------------------------------------------------------
    'period_once' => 'Một lần',
    'period_month' => 'Hằng tháng',
    'period_quarter' => 'Hằng quý',
    'period_year' => 'Hằng năm',

    // Đứng sau giá: "12,50 € mỗi tháng".
    'per_once' => 'một lần',
    'per_month' => 'mỗi tháng',
    'per_quarter' => 'mỗi quý',
    'per_year' => 'mỗi năm',

    // ---- thao tác --------------------------------------------------------
    'new' => 'Gói mới',
    'edit' => 'Sửa',
    'duplicate' => 'Nhân bản',
    'copy_suffix' => ' (bản sao)',
    'go_live' => 'Đưa lên bán',
    'go_offline' => 'Ngừng bán',
    'delete' => 'Xóa',
    'delete_confirm' => 'Gỡ bỏ gói này. Những gì đã mua thì không đụng tới — mỗi đơn hàng giữ bản sao riêng về chính nó lúc được đặt.',
    'delete_refused' => 'Chưa xóa',
    'delete_refused_body' => 'Đã có đơn hàng cho gói này và chúng trỏ về nó. Hãy ngừng bán thay vì xóa; gói vẫn còn đó cho sổ sách và không ai mua được nữa.',
    'deleted' => 'Đã xóa gói',
    'saved' => 'Đã lưu gói',
    'save_failed' => 'Không lưu được gói',
    'price_invalid' => 'Đó không phải một số tiền. Hãy viết là 12.50 hoặc 12,50.',

    // ---- biểu mẫu: gói là gì ---------------------------------------------
    'section_basics' => 'Gói',
    'section_basics_helper' => 'Những gì khách nhìn thấy trên thẻ.',
    'name' => 'Tên',
    'name_helper' => 'Tên gọi của gói trong cửa hàng.',
    'slug' => 'Địa chỉ',
    'slug_helper' => 'Chữ thường, chữ số và dấu gạch nối. Để trống thì tự tạo từ tên. Đổi về sau sẽ làm hỏng đường dẫn ai đó đã lưu.',
    'description' => 'Mô tả',
    'description_helper' => 'Vài dòng dưới tên. Văn bản thuần.',
    'live_field' => 'Đang bán',
    'live_helper' => 'Tắt thì gói ở lại đây và không hiện ra với ai. Gói không có egg thì không bao giờ hiện ra, dù ở đây ghi gì.',
    'sort' => 'Thứ tự',
    'sort_helper' => 'Số nhỏ hơn đứng trước trong cửa hàng.',

    // ---- biểu mẫu: gói trở thành gì --------------------------------------
    'section_server' => 'Máy chủ mà gói trở thành',
    'section_server_helper' => 'Vẫn là những câu hỏi Pelican đặt ra khi tạo máy chủ bằng tay, trả lời một lần tại đây và dùng cho mọi lần bán.',
    'egg' => 'Egg',
    'egg_helper' => 'Chọn một egg sẽ điền image, lệnh khởi động và mọi biến bằng giá trị mặc định của egg. Sau đó sửa gì tùy bạn.',
    'image' => 'Image Docker',
    'image_helper' => 'Một trong các image mà egg đưa ra.',
    'image_default' => 'Image đầu tiên của egg',
    'startup' => 'Lệnh khởi động',
    'startup_helper' => 'Một trong các lệnh mà egg đưa ra.',
    'startup_default' => 'Lệnh đầu tiên của egg',
    'environment' => 'Biến',
    'environment_helper' => 'Các biến của egg và giá trị của chúng. Mọi biến egg có mà không được liệt kê ở đây sẽ nhận giá trị mặc định khi máy chủ được tạo.',
    'env_key' => 'Biến',
    'env_value' => 'Giá trị',
    'nodes' => 'Node',
    'nodes_helper' => 'Nơi máy chủ từ gói này được phép tạo ra — thử lần lượt theo thứ tự này cho tới khi có node còn địa chỉ trống. Không đánh dấu gì nghĩa là node nào cũng được.',

    // ---- biểu mẫu: giới hạn ----------------------------------------------
    'section_limits' => 'Giới hạn',
    'section_limits_helper' => 'Những gì máy chủ nhận được. Cùng những ô như biểu mẫu máy chủ của chính Pelican, cùng đơn vị.',
    'memory' => 'Bộ nhớ',
    'disk' => 'Ổ đĩa',
    'cpu' => 'CPU',
    'cpu_helper' => 'Phần trăm của một nhân: 100 là một nhân, 200 là hai nhân, 0 là không giới hạn.',
    'swap' => 'Swap',
    'swap_helper' => '0 là không có, -1 là không giới hạn.',
    'io' => 'Trọng số block IO',
    'io_helper' => 'Mặc định của Pelican là 500. Cứ để vậy trừ khi bạn biết vì sao không nên.',
    'threads' => 'Ghim CPU',
    'threads_helper' => 'Những nhân nào, viết theo cách Pelican viết: 0,1 hoặc 0-3. Để trống là nhân nào cũng được.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Nhân hệ điều hành có được dừng máy chủ khi máy chủ hết bộ nhớ hay không.',
    'databases' => 'Cơ sở dữ liệu',
    'allocations' => 'Allocation thêm',
    'backups' => 'Bản sao lưu',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- biểu mẫu: tiền --------------------------------------------------
    'section_price' => 'Giá và tồn kho',
    'section_price_helper' => 'Theo đơn vị tiền của cửa hàng, đặt ở trang Cài đặt cửa hàng. Chưa gồm thuế — thuế được cộng vào hóa đơn thành một dòng riêng.',
    'price' => 'Giá',
    'price_helper' => 'Cho mỗi kỳ. Hãy viết là 12.50 hoặc 12,50.',
    'setup_fee' => 'Phí cài đặt',
    'setup_fee_helper' => 'Thu một lần, trên hóa đơn đầu tiên. Số không là không thu.',
    'period' => 'Chu kỳ thanh toán',
    'period_helper' => 'Loại một lần thì trả một lần rồi giữ luôn. Các loại khác nhận hóa đơn mới mỗi kỳ; hóa đơn chưa trả sẽ dừng máy chủ sau thời gian gia hạn đặt ở trang Cài đặt cửa hàng.',
    'stock' => 'Tồn kho',
    'stock_helper' => 'Số lượng được bán ra cùng lúc, tính mọi đơn hàng chưa hủy. Để trống là không giới hạn.',
    'term' => 'Kỳ hạn tối thiểu',
    'term_helper' => 'Mua rồi thì người ta bị ràng buộc trong bao lâu. Số không là không ràng buộc: họ có thể hủy và nó dừng vào cuối kỳ họ đã trả tiền.',
    'term_unit' => 'Tính bằng',
    'term_unit_helper' => 'Ngày, tháng hoặc năm. Một đơn hàng đã hủy sẽ chạy tới hết kỳ hạn này và máy chủ bị xóa vào ngày đó.',
    'unit_day' => 'Ngày',
    'unit_month' => 'Tháng',
    'unit_year' => 'Năm',
    'term_day' => 'Kỳ hạn tối thiểu: :count ngày',
    'term_month' => 'Kỳ hạn tối thiểu: :count tháng',
    'term_year' => 'Kỳ hạn tối thiểu: :count năm',
    'section_art' => 'Ảnh',
    'section_art_helper' => 'Ảnh trên thẻ gói, trong cửa hàng và ở phần dịch vụ của khách. Để trống cả hai thì dùng ảnh của chính egg, thứ mà phần lớn gói vốn đã có.',
    'art_file' => 'Tải lên một ảnh',
    'art_file_helper' => 'Ngang hơn là dọc: thẻ sẽ cắt về tỉ lệ 16:9. Tối đa 8 MB.',
    'art_url' => 'Hoặc một địa chỉ ảnh',
    'art_url_helper' => 'Một địa chỉ https đầy đủ. Được dùng khi ở trên không tải lên gì cả.',

    'empty' => 'Chưa có gói nào',
    'section_ask' => 'Hỏi khách',
    'section_ask_helper' => 'Những câu hỏi đặt ở trang đặt hàng, được trả lời trước khi đơn hàng được gửi đi. Câu trả lời tới máy chủ khi máy chủ được dựng.',
    'ask_vars' => 'Biến cần hỏi',
    'ask_vars_helper' => 'Các biến của chính egg. Đánh dấu một biến thì khách tự điền khi mua, và giá trị khách điền được dùng thay cho giá trị của gói này. Không đánh dấu gì thì không hỏi ai điều gì cả.',
    'upload_ask' => 'Hỏi xin một tệp',
    'upload_ask_helper' => 'Một tệp zip khách tải lên khi mua — một thế giới, một modpack, một bộ cấu hình. Nó được đưa vào máy chủ của khách khi máy chủ được dựng, trước khi khách được báo là đã xong.',
    'upload_label' => 'Gọi nó là gì',
    'upload_label_helper' => 'Nhãn phía trên ô chọn tệp, viết bằng lời của bạn. Để trống thì dùng một nhãn đơn giản.',
    'upload_dir' => 'Đặt vào chỗ nào trong máy chủ',
    'upload_dir_helper' => 'Một đường dẫn bên trong máy chủ, như / hoặc /world. Nó được làm cho an toàn trước khi dùng.',
    'upload_extract' => 'Giải nén',
    'upload_extract_helper' => 'Bật thì tệp zip được giải nén ngay tại chỗ nó rơi xuống và bản nén bị gỡ đi — đúng cho một thế giới hay một bộ cấu hình. Tắt thì tệp zip được để nguyên, đó là thứ mà một egg cài modpack từ tệp zip cần.',
    'empty_body' => 'Tạo một gói và nó xuất hiện trong cửa hàng ngay khi được đưa lên bán.',
];
