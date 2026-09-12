<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Egg" và "allocation" giữ nguyên: đó là chữ trong Pelican, và người ta tìm
 * đúng những chữ đó ở trang node.
 */

return [
    'title' => 'Nhân bản một máy chủ',
    'nav_label' => 'Nhân bản máy chủ',
    'subheading' => 'Thêm một máy chủ dựng y hệt cái bạn đã có, hoặc vài cái cùng lúc.',

    'section' => 'Cái gì được chép',
    'section_helper' => 'Chủ sở hữu, egg, lệnh khởi động, các giới hạn và mọi biến đều được chép. Tệp, cơ sở dữ liệu, bản sao lưu và lịch thì không - bản chép các tệp của một máy chủ đang chạy là bản chép trạng thái của nó, và đó hiếm khi là điều "thêm một cái như thế này" muốn nói.',

    'source' => 'Chép từ',
    'source_helper' => 'Các bản chép nằm trên cùng node với máy chủ này, bởi vì địa chỉ trống của nó ở đó.',

    'name' => 'Đặt tên bản chép',
    'name_helper' => 'Tạo nhiều hơn một thì chúng được đánh số: "Bot 1", "Bot 2", và cứ thế.',

    'copies' => 'Bao nhiêu',
    'copies_helper' => 'Chọn một máy chủ trước.',
    'room' => 'Còn :count địa chỉ trống trên :node, nên nhiều nhất chỉ tạo được chừng đó lúc này.',
    'no_room' => 'Không còn địa chỉ trống nào trên :node. Mỗi bản chép cần một địa chỉ riêng, nên hãy thêm một allocation cho node đó trước.',

    /*
     * Cái thành công thì đếm chứ không liệt kê, cái thất bại thì liệt kê - và
     * chiều đó mới giúp được: mười cái tên chạy được là một bức tường chữ chẳng
     * ai đọc, còn cái không chạy được là thứ duy nhất đáng đọc.
     */
    'made' => 'Đã tạo :count bản chép',
    'partly_failed' => ':count bản chép không tạo được',
    'failed' => 'Không có gì được chép',
];
