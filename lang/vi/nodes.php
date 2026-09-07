<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Khối trên trang tổng quan: máy mà chính bảng điều khiển đang chạy trên đó, và
 * từng node.
 *
 * Các con số của node là của chính Pelican, đọc từ daemon trên mỗi node. Dòng
 * của bảng điều khiển đọc từ /proc, đó lại là câu hỏi khác - xem
 * Support\SystemStatus.
 *
 * "Node" giữ nguyên: Pelican gọi nó như vậy ở khắp nơi, và một bản dịch chỉ là
 * cái tên thứ hai cho cùng một thứ.
 */

return [
    // Tiêu đề của khối là chính tên của plugin, đọc lúc chạy, nên ở đây không
    // có chữ nào cho nó.
    'panel' => 'Bảng điều khiển này',
    'offline' => 'không trả lời',
    'maintenance' => 'bảo trì',
    'cpu' => 'CPU',
    'memory' => 'Bộ nhớ',
    'disk' => 'Ổ đĩa',
    'load' => 'Tải',
];
