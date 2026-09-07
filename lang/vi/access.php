<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Subuser", "Wings", "SFTP", "cron" và "root admin" giữ nguyên: đó là chữ trong
 * Pelican và trên máy chủ, và người đi kiểm tra dòng đó tìm đúng những chữ ấy.
 */

return [
    'nav_label' => 'Quyền vào máy chủ',
    'title' => 'Máy chủ theo vai trò',
    'subheading' => 'Cho mọi người giữ một vai trò cùng quyền vào những máy chủ giống nhau.',

    /*
     * Nói trước mọi thứ khác trên trang, bởi vì đây là tính năng duy nhất ở đây
     * ghi vào một bảng thuộc về Pelican.
     */
    'more' => 'Cái này hoạt động ra sao',
    'warning' => 'Nó hoạt động bằng cách giữ cho các subuser của chính Pelican luôn đúng — chính những dòng bạn sẽ tự thêm ở trang Users của một máy chủ, và đó cũng là những dòng mà danh sách máy chủ, các bước kiểm tra quyền và Wings vẫn đọc. Nó chỉ động tới những dòng do chính nó tạo: mọi thứ bạn tự thêm không bao giờ bị đổi và không bao giờ bị bỏ đi. Không ai nhận email khi một vai trò trao cho họ một máy chủ. Rút quyền cũng thu hồi SFTP của họ, và việc đó cần đúng cái queue worker mà Pelican vốn đã đòi.',

    'never' => 'Chưa có gì được đối chiếu. Lưu một ánh xạ bên dưới và việc đó diễn ra ngay, rồi mỗi phút một lần trên cron của chính bảng điều khiển.',
    'timing' => 'Quyền bị rút đúng vào lúc nó phải bị rút: người mất một vai trò mất luôn các máy chủ ngay ở trang kế tiếp của họ. Việc trao quyền có thể mất tới một phút, bởi vì đó là lượt quét đi tìm những người lúc này không dùng bảng điều khiển.',
    'last_run' => 'Lần chạy gần nhất cách đây :ago giây: thêm :added, bỏ :removed, giữ nguyên :held.',
    'capped' => 'Quá nhiều cùng lúc — :pairs lượt trao, mà giới hạn là :max. Không có gì được ghi. Hãy thu hẹp một ánh xạ: một vai trò với năm mươi người và hai mươi máy chủ tự nó đã là một nghìn lượt trao.',

    'which' => 'Các ánh xạ',
    'which_helper' => 'Một vai trò, những máy chủ mà mọi người giữ nó nên với tới được, và họ được làm gì ở đó. Người ở trong hai vai trò nhận tất cả những gì cả hai trao. Chủ máy chủ và root admin bị bỏ qua — họ vốn đã có nhiều hơn những gì cái này có thể trao.',
    'add' => 'Thêm một vai trò',

    'role' => 'Vai trò',
    'role_helper' => 'Mọi người giữ nó, kể cả người được trao về sau.',
    'servers' => 'Máy chủ',
    'servers_helper' => 'Những máy chủ họ nhận được. Bỏ một cái khỏi đây là rút lại quyền đó.',

    'permissions' => 'Họ được làm gì',
    'permissions_helper' => 'Chính các quyền subuser của Pelican. Cứ để nguyên như vậy sẽ được một bộ hợp lý: console, các nút nguồn, tệp, bản sao lưu và nhật ký hoạt động — và không có gì sửa được máy chủ, người dùng, cơ sở dữ liệu hay allocation của nó. Connect to websocket luôn được kèm theo, bởi vì không có nó thì trang console chẳng kết nối tới đâu cả.',

    'save' => 'Lưu và áp dụng',
    'saved' => 'Đã lưu',
    'saved_body' => 'Đã trao :added, thu lại :removed.',
    'save_failed' => 'Không lưu được',
    'save_failed_disk' => 'Không ghi được danh sách vào storage. Kiểm tra xem storage/app có thuộc về người dùng mà bảng điều khiển đang chạy dưới quyền không.',

    'revoke' => 'Thu lại tất cả',
    'revoke_confirm' => 'Bỏ mọi thứ cái này đã trao?',
    'revoke_confirm_helper' => 'Mọi dòng subuser trang này đã tạo, trên mọi máy chủ, cho mọi người — và SFTP của họ đi cùng. Những dòng bạn tự thêm thì không bị động tới. Các ánh xạ bên dưới vẫn còn, nên lần lưu kế tiếp hoặc lần hẹn giờ kế tiếp sẽ trao lại chúng: hãy dọn danh sách trước nếu bạn muốn dứt hẳn.',
    'revoked' => 'Đã bỏ :count',
    'revoked_body' => 'Chỉ những dòng trang này đã tạo. Mọi thứ được thêm bằng tay vẫn ở nguyên chỗ cũ.',
    'revoke_failed' => 'Không bỏ được chúng',
];
