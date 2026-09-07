<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Mod", "plugin", "loader", "jar" và tên thư mục mods/ với plugins/ giữ nguyên:
 * chúng được viết đúng như vậy trên Modrinth và trong cây tệp của máy chủ.
 */

return [
    'nav_label' => 'Mod và plugin',
    'title' => 'Mod và plugin',
    'subheading' => 'Từng cái một, từ Modrinth, vào máy chủ này.',

    'section' => 'Tìm một thứ gì đó',
    'section_helper' => 'Trang modpack cài trọn một pack cùng lúc. Trang này cài một mod hoặc một plugin duy nhất, và đó mới là điều người ta cần thường xuyên hơn nhiều.',

    'kind' => 'Bạn đang thêm cái gì',
    /*
     * Hỏi chứ không suy ra. Một egg mang cái tên mà quản trị viên đặt cho nó, và
     * vài loader đọc cả hai thư mục, nên từ đây không có cách nào đoán trung
     * thực được - và một cú đoán sai sẽ ghi một tệp jar vào thư mục chẳng có gì
     * đọc tới.
     */
    'kind_helper' => 'Một mod đi vào mods/ và dành cho Fabric, Forge hoặc NeoForge. Một plugin đi vào plugins/ và dành cho Bukkit, Spigot hoặc Paper. Cái này cũng quyết định nửa nào của Modrinth sẽ được tìm.',
    'kind_mod' => 'Một mod (mods/)',
    'kind_plugin' => 'Một plugin (plugins/)',

    'search' => 'Tìm',
    'search_helper' => 'Gõ một cái tên rồi bấm ra ngoài ô. Kết quả trả về với những cái tải nhiều nhất ở đầu.',

    'project' => 'Mod hoặc plugin',
    'version' => 'Phiên bản',
    'version_helper' => 'Mỗi dòng là số phiên bản, những bản Minecraft mà nó được dựng cho, và những loader nó hỗ trợ. Chọn một cái khớp với máy chủ của bạn — ở đây không có gì kiểm tra hộ bạn cả.',

    'install' => 'Cài',
    'install_confirm' => 'Tệp do node tải thẳng từ Modrinth về rồi đặt vào thư mục. Không có gì đang ở đó bị bỏ đi.',
    'installed' => 'Đã cài',
    'installed_helper' => 'Nó được nạp ở lần khởi động máy chủ tiếp theo.',

    'change' => 'Đổi phiên bản',
    'change_helper' => 'Đặt một phiên bản khác của cùng dự án vào chỗ tệp này. Bản mới được tải về trước khi bản cũ bị xóa, nên một lần tải hỏng để bạn lại với đúng cái bạn đang có.',
    'change_project_helper' => 'Cố định cho mọi thứ cài từ trang này. Đổi nó thì không phải là đổi phiên bản — đó sẽ là một mod khác dưới cùng một tên tệp.',
    'change_lookup_helper' => 'Tệp này vốn đã nằm trong thư mục, nên ở đây không có gì biết nó là cái gì. Tìm nó một lần và nó sẽ được nhớ.',
    'changed' => 'Đã đổi phiên bản',

    'check' => 'Kiểm tra cập nhật',
    'checked' => 'Đã kiểm tra',
    'checked_none' => 'Mọi thứ đã biết đều đang ở bản mới nhất của nó.',
    'checked_some' => ':count cái có bản mới hơn. Chúng được đánh dấu trong danh sách.',
    'update_ready' => 'Có v:number',
    /*
     * Nói ngay bên cạnh nhãn chứ không nhét vào chú thích, bởi vì nó đổi nghĩa
     * của cái nhãn. Ở đây không có gì biết máy chủ chạy bản Minecraft nào hay
     * loader nào, nên mới nhất nghĩa là mới nhất, chứ không phải mới nhất mà
     * chạy được.
     */
    'check_note' => 'Mới hơn nghĩa là mới hơn trên Modrinth. Ở đây không có gì biết máy chủ của bạn chạy bản Minecraft nào hay loader nào, nên hãy kiểm tra xem phiên bản bạn chọn có nói là hợp không trước khi khởi động máy chủ.',
    'unknown' => 'Không phải từ đây — dùng Đổi phiên bản để cho biết đây là cái gì',

    'remove' => 'Bỏ',
    'remove_confirm' => 'Tệp bị xóa khỏi máy chủ. Việc này không hoàn tác được từ đây.',
    'removed' => 'Đã bỏ',

    'running' => 'Máy chủ đang chạy',
    'running_helper' => 'Minecraft đọc mods/ và plugins/ một lần, lúc khởi động. Một tệp thêm vào lúc này sẽ không được nạp cho tới khi khởi động lại, còn một tệp bị rút khỏi bên dưới một trò chơi đang chạy có thể kéo cả trò chơi đi theo. Hãy dừng máy chủ trước.',

    'failed' => 'Việc đó không thành',
    'failed_version' => 'Phiên bản đó không có tệp jar nào cái này cài được. Vài bản phát hành chỉ mang mã nguồn, hoặc chỉ mang bản dựng cho máy khách.',
    'failed_write' => 'Node từ chối tải về. Có thể nó không tới được Modrinth.',

    'installed_title' => 'Đã cài',
    'installed_mods' => 'Trong mods/',
    'installed_plugins' => 'Trong plugins/',
    /*
     * Nói ra vì một danh sách rỗng dễ hiểu theo hai nghĩa: nó thường nghĩa là
     * máy chủ này không dùng thư mục đó chút nào, chứ không phải là thiếu cái gì.
     */
    'installed_empty' => 'Ở đây không có gì. Một máy chủ chỉ dùng một trong hai thư mục này, nên một cái rỗng là chuyện bình thường.',
    'installed_note' => 'Chỉ liệt kê các tệp .jar. Thư mục cấu hình và tệp đã tắt được để yên và không hiện ra.',
];
