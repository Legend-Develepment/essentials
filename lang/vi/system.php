<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Trang Trạng thái hệ thống: máy mà chính bảng điều khiển chạy trên đó, cùng bất
 * kỳ node nào được yêu cầu đặt bên cạnh nó.
 *
 * Trên mọi bản cài mà chúng tách rời nhau thì đó không phải cùng một máy với các
 * node, và vì thế cả hai mới cùng nằm được trên trang này.
 *
 * "Swap", "Wings", "PHP" và "uptime" giữ nguyên: đó là tên của chúng trên máy và
 * trong mọi công cụ mà người ta sẽ đem ra so.
 */

return [
    'title' => 'Trạng thái hệ thống',
    'nav_label' => 'Trạng thái hệ thống',
    'subheading' => 'Máy mà chính bảng điều khiển chạy trên đó, nó đang chạy những gì, và bất kỳ node nào bạn yêu cầu đặt bên cạnh.',

    'options' => 'Tùy chọn',
    'enabled' => 'Hiện trong thanh bên',
    'enabled_helper' => 'Tắt sẽ bỏ dòng đó khỏi thanh bên. Trang vẫn giữ địa chỉ của nó, nên nó luôn ở đó để bạn bật lại.',

    'refresh' => 'Đọc lại mỗi',
    'refresh_helper' => 'Cả trang được yêu cầu lại theo khoảng này. Tắt thì để nguyên như lúc bạn mở nó.',
    'refresh_off' => 'Chỉ khi tôi mở nó',
    'refresh_seconds' => ':seconds giây',

    'blocks' => 'Hiện',
    'blocks_helper' => 'Cái nào đánh dấu thì hiện. Ổ đĩa là mỗi hệ tệp một thẻ, để một phân vùng gốc đã đầy không bị giấu sau một điểm gắn dữ liệu còn trống nửa.',
    'block_cpu' => 'Bộ xử lý',
    'block_memory' => 'Bộ nhớ',
    'block_swap' => 'Swap',
    'block_disk' => 'Ổ đĩa',
    'block_load' => 'Tải trung bình',
    'block_uptime' => 'Uptime',
    'block_system' => 'Hệ thống',
    'block_version' => 'Phiên bản bảng điều khiển',
    // Không bao giờ hiện - thẻ của một node lấy chính tên của node - nhưng
    // blank() hỏi tới nó, và một khóa thiếu mà tự in tên của mình ra thì là một
    // phương án dự phòng dở.
    'block_node' => 'Node',

    'nodes' => 'Node cần hiện',
    'nodes_helper' => 'Mỗi node một thẻ, bên cạnh máy của bảng điều khiển. Không đánh dấu gì thì không hiện cái nào — trang tổng quan vốn đã có một khối chứa mọi node. Mỗi node được hỏi từ daemon của chính nó, nên khoảng ngắn cộng danh sách dài nghĩa là rất nhiều yêu cầu.',

    'section_usage' => 'Mức dùng',
    'section_host' => 'Bảng điều khiển này',
    'section_nodes' => 'Node',

    'disk_panel' => 'Bảng điều khiển ở đây',
    'wings' => 'Wings :version',
    'version_installed' => 'Đã cài',
    'version_latest' => 'Mới nhất',
    'version_current' => 'Đã cập nhật',
    'version_update' => 'Có bản cập nhật',
    'version_unknown' => 'Không kiểm tra được',

    /*
     * Một thẻ đang tụt lại thì đưa ra cái gì.
     *
     * Một liên kết tới bản phát hành chứ không phải một nút thực hiện cập nhật,
     * bởi vì từ đây chẳng có việc cập nhật nào để thực hiện: Pelican không có
     * lệnh nâng cấp, và Wings không có endpoint nào thay được tệp nhị phân của
     * chính nó. Dòng gợi ý nói rõ công việc thật sự diễn ra ở đâu, để không ai
     * đi tìm một cái nút vốn chưa từng có thể tồn tại.
     */
    'version_release' => 'Có gì mới',
    'version_how_panel' => 'Mở ghi chú phát hành. Việc nâng cấp bảng điều khiển được làm trên chính máy nó chạy - bảng điều khiển không thay được tệp của chính mình, và không plugin nào được phép chạy lệnh shell.',
    'version_how_wings' => 'Mở ghi chú phát hành. Wings được cập nhật ngay trên node - bảng điều khiển không có kênh nào tới một chương trình chạy trên máy khác.',

    'wings_latest' => 'Mới nhất :version',
    'load_cores' => ':percent% của :cores bộ xử lý',
    'load_windows' => ':five trong 5 phút · :fifteen trong 15 phút',
    'uptime_since' => 'Từ :date',
    'unavailable' => 'Không có trên máy này',

    'fact_os' => 'Hệ điều hành',
    'fact_hostname' => 'Tên máy',
    'fact_php' => 'PHP',
    'fact_cores' => 'Bộ xử lý',
    'fact_processes' => 'Tiến trình',
];
