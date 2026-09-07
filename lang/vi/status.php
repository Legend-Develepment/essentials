<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Trang trạng thái công khai.
 *
 * Thứ duy nhất plugin này phục vụ cho người chưa đăng nhập, và là trang duy nhất
 * mà chữ nghĩa phải được đọc như thể một người lạ sẽ nhìn thấy - bởi vì sẽ có
 * người lạ nhìn thấy thật. Không có gì ở đây cho biết node nào, chủ nào hay địa
 * chỉ nào; chỉ một cái tên, nó có chạy không, và bao nhiêu người đang ở trong.
 *
 * "Node" chỉ xuất hiện trong phần cài đặt; trên chính trang công khai thì ghi
 * "máy", bởi vì ở đó người đọc là người chưa từng nghe tới Pelican.
 */

return [
    // ---- trang cài đặt -----------------------------------------------------
    'title' => 'Trang trạng thái công khai',
    'nav_label' => 'Trang trạng thái',
    'subheading' => 'Một trang ai cũng mở được mà không cần tài khoản, cho thấy máy chủ nào của bạn đang chạy. Sẽ không có gì hiện lên đó cho tới khi bạn nêu một máy chủ ở bên dưới.',

    'address' => 'Trang trạng thái của bạn ở',
    'address_off' => 'Chưa phục vụ gì cả. Hãy thêm một máy chủ, một máy hoặc một dịch vụ ở dưới rồi lưu, địa chỉ sẽ hiện ra ở đây.',

    'which' => 'Cái gì được công khai',
    'which_helper' => 'Danh sách bắt đầu rỗng, và không gì là công khai cho tới khi có thứ gì đó nằm trên đó. Chỉ những máy chủ bạn vốn đã mở được mới được đưa ra.',
    'add' => 'Công khai một máy chủ',
    'server' => 'Máy chủ',
    'shown_as' => 'Hiện dưới tên',
    'shown_as_helper' => 'Thứ mà công chúng nhìn thấy. Hãy tự viết thay vì để bảng điều khiển dùng tên thật — "mc-prod-3 (đừng động)" là ghi chú cho chính bạn, chứ không phải thứ đem đăng lên diễn đàn.',

    'look' => 'Cách diễn đạt',
    'look_helper' => 'Mọi thứ trên trang này đều do những người không có tài khoản đọc.',
    'heading' => 'Tiêu đề',
    'heading_helper' => 'Để trống thì dùng chính tên của bảng điều khiển.',
    'note' => 'Một dòng phía trên danh sách',
    'note_helper' => 'Để nói đang có chuyện gì — một khung giờ bảo trì, hoặc hỏi ở đâu. Chữ thường.',
    'link' => 'Liên kết tới bảng điều khiển',
    'link_helper' => 'Một lối quay vào trong, ở cuối trang. Hãy tắt đi nếu bạn không muốn để lộ bảng điều khiển của mình nằm ở đâu.',

    'save' => 'Lưu',
    'saved' => 'Đã lưu',
    'save_failed' => 'Không có gì được lưu',
    'open' => 'Mở trang',

    // ---- số người chơi -----------------------------------------------------
    'counts' => 'Số người chơi',
    'counts_helper' => 'Những con số cạnh một máy chủ từ đâu ra. Máy chủ Minecraft trả lời cái bắt tay của riêng nó và được cấu hình ở mục Minecraft; mọi thứ bên dưới áp dụng cho những trò chơi trả lời truy vấn của Valve — Rust, ARK, Valheim, 7 Days to Die và phần lớn những trò khác chạy trên Source hoặc Unreal.',
    'query_eggs' => 'Egg trả lời truy vấn của Valve',
    'query_eggs_helper' => 'Đánh dấu các egg của những trò đó. Cùng danh sách này cũng quyết định máy chủ nào có trang Người chơi bên trong bảng điều khiển — một câu hỏi được đặt ra vì hai lý do. Không có gì được hỏi cho tới khi bạn nói: đây là thứ duy nhất ở đây mở một kết nối từ bảng điều khiển thẳng tới một cổng trò chơi, nên đó là một lựa chọn chứ không phải thứ tự khởi động. Một máy chủ mà bảng điều khiển không với tới cổng của nó thì đơn giản là không hiện con số nào.',

    // ---- các node ----------------------------------------------------------
    'nodes' => 'Máy',
    'nodes_helper' => 'Đang chạy hay không, và không gì khác. Không phải mức tải và không phải ổ đĩa đầy tới đâu — người hỏi xem mình có chơi được không thì không cần một báo cáo sức chứa về phần cứng của bạn, mà công khai một báo cáo như vậy là vẽ ra tấm bản đồ chỗ nào đang chật.',
    'add_node' => 'Công khai một máy',
    'node' => 'Máy',
    'node_shown_as_helper' => 'Hãy tự viết. Một node thường mang tên kiểu như hetzner-fsn1-01, và đó là cả một câu về chỗ các máy của bạn đặt ở đâu.',

    // ---- theo dõi HTTP -----------------------------------------------------
    'monitors' => 'Dịch vụ khác',
    'monitors_helper' => 'Mọi thứ khác đáng để biết là còn sống: trang web của bạn, một API, endpoint health của một bot. Bảng điều khiển hỏi từng cái theo cùng nhịp như với các máy chủ. Chỉ quản trị viên — một mục theo dõi khiến bảng điều khiển này đi lấy một địa chỉ, và nếu ai cũng thêm được thì nó thành một cái dò mà bạn chĩa đi đâu tùy ý.',
    'add_monitor' => 'Thêm một dịch vụ',
    'monitor_name' => 'Tên',
    'monitor_url' => 'Địa chỉ',
    'monitor_url_helper' => 'Chỉ https. Nếu bảng điều khiển này đều đặn đi lấy http thường, thì mọi người trên đường truyền đều biết bạn có những dịch vụ nào.',
    'monitor_expect' => 'Mong đợi',
    'monitor_expect_helper' => 'Để trống nghĩa là "trả lời gì cũng được", hợp với một trang web hay chuyển hướng hoặc trả 403 cho một yêu cầu trần trụi. Một con số là dành cho endpoint được viết ra để nói đúng chừng đó và không gì khác — đặt quá chặt thì dòng đó đỏ mãi mãi ở một dịch vụ chẳng có vấn đề gì.',

    // ---- trang cho người dùng ----------------------------------------------
    'users' => 'Trang cho người dùng của bạn',
    'users_helper' => 'Người có máy chủ trên bảng điều khiển này có được công khai trang trạng thái của riêng họ không.',
    'user_pages' => 'Để người dùng tự làm trang của họ',
    'user_pages_helper' => 'Mỗi người có địa chỉ riêng tại /status/tên-của-họ, nơi chỉ có những máy chủ họ sở hữu, dưới những cái tên chính họ viết. Không có máy và không có dịch vụ nào khác trên đó — cả hai thứ đó chỉ của riêng bạn. Khi cái này bật, họ tìm thấy nó ở mục Trang trạng thái trong menu tài khoản, ở bất cứ bảng điều khiển nào họ đang dùng.',

    // ---- diện mạo ----------------------------------------------------------
    'every' => 'Kiểm tra mỗi',
    'every_helper' => 'Trang được dựng lại thường xuyên thế nào, và nó tự làm mới trong trình duyệt thường xuyên thế nào. Một trang người ta ngồi nhìn trong lúc khởi động lại thì muốn tính bằng giây; một trang được dẫn từ diễn đàn mà chẳng ai mở thì muốn một tiếng, và hỏi từng node mỗi phút vì nó là công sức bỏ ra cho không ai cả.',
    'every_realtime' => 'Thời gian thực (10 giây)',
    'every_30s' => '30 giây',
    'every_1m' => '1 phút',
    'every_5m' => '5 phút',
    'every_10m' => '10 phút',
    'every_30m' => '30 phút',
    'every_60m' => '60 phút',

    'style' => 'Kiểu',
    'style_helper' => 'Một trong những diện mạo của chính bảng điều khiển, áp lên trang này: màu của nó, các sắc xám dựng từ mặt nền của nó, và góc bo tròn tới đâu. "Theo bảng điều khiển" nghĩa là cái đang được đặt hôm nay, kể cả những gì đổi sau này.',
    'style_mine_helper' => 'Những kiểu mà bảng điều khiển này đưa ra, áp lên trang của bạn: một màu, các sắc xám dựng từ nó, và góc bo tròn tới đâu. Danh sách có những kiểu nào là do chủ bảng điều khiển quyết — đúng cái danh sách bạn chọn được ở mục Diện mạo. "Theo bảng điều khiển" nghĩa là cái đang được đặt.',
    'style_panel' => 'Theo bảng điều khiển',

    // ---- trang của riêng bạn -----------------------------------------------
    'mine_title' => 'Trang trạng thái của tôi',
    'mine_nav_label' => 'Trang trạng thái',
    'mine_subheading' => 'Một địa chỉ để đưa cho những người chơi trên máy chủ của bạn. Nó hiện những máy chủ bạn chọn, và không gì khác về bảng điều khiển này.',
    'mine_address' => 'Địa chỉ của bạn',
    'mine_address_helper' => 'Chọn cái gì đó ngắn. Đổi nó về sau sẽ làm hỏng mọi liên kết ai đó đã lưu.',
    'mine_address_off' => 'Chọn một địa chỉ ở dưới rồi lưu, trang của bạn sẽ hiện ra ở đây.',
    'slug' => 'Địa chỉ',
    'slug_helper' => 'Chữ thường, số và dấu gạch nối. Từ ba ký tự trở lên.',
    'mine_heading' => 'Tiêu đề',
    'mine_heading_helper' => 'Để trống thì dùng địa chỉ của bạn.',
    'mine_note_helper' => 'Để nói đang có chuyện gì — một lần khởi động lại, một sự kiện, tìm bạn ở đâu. Chữ thường, và ai có liên kết cũng đọc được.',
    'mine_which' => 'Máy chủ của bạn',
    'mine_which_helper' => 'Chỉ những máy chủ chính bạn sở hữu mới được đưa ra. Làm subuser ở nơi khác là quyền vào một máy, chứ không phải quyền công khai rằng nó tồn tại.',
    'mine_shown_as_helper' => 'Thứ khách ghé thăm nhìn thấy. Hãy tự viết thay vì lấy tên từ bảng điều khiển, nếu cái tên đó là ghi chú cho riêng bạn.',
    'mine_look_helper' => 'Trang của bạn trông ra sao với những người bạn gửi nó cho.',
    'mine_remove' => 'Gỡ trang của tôi',
    'mine_remove_confirm' => 'Gỡ trang của bạn xuống và trả địa chỉ lại cho người khác. Mọi thứ bạn đã đặt sẽ mất; còn chính các máy chủ thì không bị động tới.',
    'mine_removed' => 'Trang của bạn đã được gỡ',

    'why_slug' => 'Địa chỉ đó không được. Chữ thường, số và dấu gạch nối, từ ba ký tự trở lên — và vài từ đã bị giữ chỗ.',
    'why_taken' => 'Địa chỉ đó đã có người khác giữ rồi.',
    'why_unwritable' => 'Không ghi được. Kiểm tra xem storage/app có thuộc về người dùng mà bảng điều khiển đang chạy dưới quyền không.',

    // ---- tiêu đề trên chính trang đó ---------------------------------------
    'section_servers' => 'Máy chủ',
    'section_nodes' => 'Máy',
    'section_monitors' => 'Dịch vụ',

    // ---- chính trang đó ----------------------------------------------------
    'up' => 'Đang chạy',
    'down' => 'Đang tắt',
    'starting' => 'Đang khởi động',

    /*
     * Không phải "đang tắt", và sự khác biệt này quan trọng ở chỗ công khai.
     *
     * Bảng điều khiển không với tới máy chủ. Đó thường là một node đang bảo trì
     * hoặc một daemon đang khởi động lại - nó không giống với việc máy chủ bị
     * tắt, và nói với một trăm người chơi rằng máy chủ của họ đang tắt trong khi
     * nó vẫn chạy thì còn tệ hơn là thú nhận rằng mình không biết.
     */
    'unknown' => 'Chưa rõ',

    'players' => 'Người chơi',
    'online_now' => 'đang chơi ngay lúc này',
    'checked' => 'Đã kiểm tra',
    'next_check' => 'tới lần kiểm tra kế',
    'just_now' => 'vừa xong',
    'seconds_ago' => ':count giây trước',
    'panel' => 'Đăng nhập',

    'all_up' => 'Mọi thứ đang chạy.',
    'some_down' => 'Có thứ không chạy.',
    'empty' => 'Chưa có gì được công khai ở đây.',
];
