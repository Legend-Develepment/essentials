<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * "Modpack", "mod" và "loader" giữ nguyên: đó là chữ trên Modrinth và trong trò
 * chơi, và người ta tìm đúng những chữ đó.
 */

return [
    'nav_label' => 'Modpack',
    'title' => 'Modpack',
    'subheading' => 'Cài một modpack từ Modrinth vào máy chủ này.',

    'section' => 'Tìm một pack',
    'section_helper' => 'Chỉ Modrinth, và chỉ những pack chạy phía máy chủ. Nó không cần tài khoản lẫn khóa API, và đó là lý do nó là nguồn duy nhất ở đây - những nguồn khác mỗi cái đều đòi dán một khóa vào trước khi bất cứ thứ gì hiện ra.',

    'search' => 'Tìm',
    'search_helper' => 'Để trống để lấy những cái tải nhiều nhất. Việc tìm sẽ hỏi Modrinth, nên nó chạy khi bạn rời khỏi ô chứ không phải trong lúc bạn gõ.',

    'pack' => 'Pack',
    'pack_helper' => 'Chỉ liệt kê những pack nói rằng chúng chạy được trên máy chủ.',

    'version' => 'Phiên bản',
    'version_helper' => 'Phiên bản trò chơi và loader hiện bên cạnh từng cái. Chọn loader mà egg của máy chủ này vốn đã chạy - cái này cài tệp và không đổi egg lẫn lệnh khởi động của bạn.',

    'downloads' => 'lượt tải',

    'install' => 'Cài pack này',
    'install_go' => 'Cài nó',
    'install_confirm' => 'Các tệp của pack được thêm vào máy chủ này. **Không có gì bị xóa** - không phải thế giới của bạn, không phải các mod cũ, không phải một tệp cấu hình nào. Một pack cài chồng lên pack khác sẽ để lại cả hai, nên hãy tự gỡ mod của pack trước đó nếu đó là điều bạn muốn. Máy chủ phải đang dừng, và nó vẫn dừng sau đó.',

    'started' => 'Đang cài',
    'started_helper' => 'Pack đang được tải về và giải nén. Vài trăm tệp mất vài phút, và bạn sẽ được báo khi xong - nó vẫn chạy tiếp nếu bạn rời khỏi trang này.',

    'running' => 'Máy chủ đang chạy',
    'running_helper' => 'Minecraft nạp các mod của nó lúc khởi động, nên một pack cài lúc này sẽ để lại một máy chủ không phải pack cũ cũng chẳng phải pack mới cho tới khi khởi động lại. Hãy dừng nó rồi thử lại.',

    'done' => 'Đã cài :pack',
    'done_body' => 'Đã tải về :files tệp và đặt vào chỗ :overrides mục lấy từ thư mục riêng của pack. Khởi động máy chủ khi bạn sẵn sàng.',
    'done_refused' => 'Đã bỏ qua :count tệp vì pack đòi chúng từ một nơi mà cái này không tải về.',

    'failed' => 'Pack chưa được cài',
    'failed_fetch' => 'Không tải về hoặc không giải nén được pack. Có thể daemon không với tới được, hoặc máy chủ đã hết chỗ trên đĩa.',
    'failed_index' => 'Pack đã tải về nhưng bên trong không có chỉ mục nào đọc được, nên chẳng có gì để cài.',
    'failed_version' => 'Phiên bản đó không còn tệp pack để tải nữa. Hãy chọn cái khác.',
    'failed_queue' => 'Không đưa được việc cài vào hàng đợi. Cái này cần một queue worker đang chạy trên bảng điều khiển.',
];
