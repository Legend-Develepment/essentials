<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Bản sao lưu, trên toàn bảng điều khiển.
 *
 * Pelican trả lời câu "máy chủ này có những bản sao lưu nào". Trang này trả lời
 * câu ngược lại, và đó mới là câu hỏi mà một quản trị viên thật sự có, cũng là
 * câu hỏi bảng điều khiển không có chỗ nào để đặt: cái nào của tôi không có bản
 * nào cả.
 */

return [
    'title' => 'Bản sao lưu',
    'nav_label' => 'Bản sao lưu',
    'subheading' => 'Mọi máy chủ bạn với tới được, kèm theo đã bao lâu nó không có bản sao lưu. Máy chủ chưa từng được sao lưu nằm trên cùng; bất cứ thứ gì cũ hơn :days ngày tính là cũ.',

    // ---- bảng -------------------------------------------------------------
    'column_server' => 'Máy chủ',
    'column_last' => 'Bản gần nhất',
    'column_kept' => 'Đang giữ',
    'column_size' => 'Dung lượng',
    'column_failed' => 'Thất bại',

    'never' => 'Chưa bao giờ',

    'filter_none' => 'Chưa từng sao lưu',
    'filter_stale' => 'Cũ',
    'filter_failed' => 'Đang hỏng',

    'open' => 'Mở trong Pelican',
];
