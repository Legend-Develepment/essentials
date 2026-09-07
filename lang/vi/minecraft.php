<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Chế độ chơi và mức khó không dịch. Minecraft hiện chúng trong game là Survival,
 * Creative, Peaceful và Hard — và một cài đặt mang tên khác với màn hình nó đến
 * từ đó là một cài đặt bạn phải tra hai lần.
 *
 * Điều tương tự với những chữ nằm trong chính server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack và the Nether.
 */

return [
    /* -------------------------------------------------- tab quản trị ----- */

    'nav_label' => 'Minecraft',
    'title' => 'Cài đặt Minecraft',
    'subheading' => 'Chính tệp server.properties của máy chủ này, dưới dạng một biểu mẫu thay vì một tệp văn bản.',

    /*
     * Tiêu đề thì không nằm ở đây. Mỗi mục cài đặt lấy tiêu đề của nó từ
     * settings.groups.<tên>, do group() dựng nên.
     */
    'section_helper' => 'Nó áp dụng cho những egg nào, và mọi thứ khác plugin này làm quanh Minecraft.',

    'live' => 'Hỏi các máy chủ xem ai đang chơi',
    'live_helper' => 'Thêm vào trang Người chơi một danh sách trực tiếp những người đang kết nối, dùng đúng cái bắt tay mà máy khách Minecraft dùng để vẽ một máy chủ trong danh sách của chính nó. Mặc định tắt, bởi vì đây là thứ duy nhất ở đây mở một kết nối từ bảng điều khiển thẳng tới một cổng trò chơi: nếu bảng điều khiển và các node của bạn nằm trên những mạng không với tới nhau thì chẳng có gì trả lời cả, và dòng đó đơn giản là không hiện ra. Trên chính máy chủ trò chơi thì không cần bật gì.',

    'eggs' => 'Egg nào là Minecraft',
    'eggs_helper' => 'Đánh dấu những egg chạy máy chủ Minecraft — Vanilla, Paper, Purpur, Fabric, Forge, và bất cứ tên nào bạn đặt cho của mình. Trang này xuất hiện bên trong các máy chủ dùng chúng, và không ở đâu khác. Ban đầu không có gì được đánh dấu, và đó là cố ý: một plugin không thể biết bạn đã đặt tên các egg của mình là gì, và một danh sách đoán mò sẽ sai trên bảng điều khiển của ai đó ngay trong tuần nó ra mắt.',

    /* ------------------------------------------------- trang máy chủ ----- */

    'groups' => [
        'general' => 'Máy chủ',
        'players' => 'Người chơi',
        'world' => 'Thế giới',
        'performance' => 'Hiệu năng',
        'access' => 'Truy cập và phần thêm',
        'other' => 'Mọi thứ khác trong tệp',
    ],

    'other_helper' => 'Đọc từ server.properties và để nguyên y như cũ. Mod và modpack đặt cài đặt riêng của chúng ở đây; chúng được hiện ra để bạn biết là chúng có tồn tại, và chúng được sửa qua trình quản lý tệp. Việc lưu trang này không bao giờ động tới chúng.',

    'reload' => 'Đọc lại tệp',

    'saved' => 'Đã lưu vào server.properties',
    'saved_helper' => 'Có hiệu lực ở lần khởi động máy chủ tiếp theo.',

    'running' => 'Máy chủ đang chạy',
    'running_helper' => 'Minecraft đọc server.properties lúc khởi động rồi ghi lại lúc dừng, nên thứ lưu bây giờ sẽ bị ghi đè lúc nó thoát ra. Hãy dừng máy chủ rồi lưu lại.',

    'missing' => 'Không thấy server.properties',
    'missing_helper' => 'Tệp xuất hiện khi máy chủ được khởi động lần đầu. Hãy khởi động nó một lần rồi quay lại.',

    'failed' => 'Không lưu được',
    'failed_helper' => 'Daemon từ chối ghi. Có thể máy chủ đã khởi động trong lúc trang này đang mở.',

    /* ------------------------------- mỗi khóa nghĩa là gì ---------------- */

    'keys' => [
        'motd' => 'Dòng chữ trong danh sách máy chủ',
        'gamemode' => 'Chế độ chơi',
        'difficulty' => 'Độ khó',
        'hardcore' => 'Hardcore — chết là hết',
        'force_gamemode' => 'Đưa mọi người về chế độ mặc định khi họ vào',
        'pvp' => 'Người chơi có thể làm nhau bị thương',

        'max_players' => 'Nhiều nhất bao nhiêu người cùng lúc',
        'white_list' => 'Chỉ whitelist',
        'enforce_whitelist' => 'Đá ra bất kỳ ai không có trong whitelist',
        'online_mode' => 'Kiểm tra tài khoản với Mojang',
        'player_idle_timeout' => 'Đá ra sau chừng đó phút không làm gì',
        'op_permission_level' => 'Một operator được làm gì (1–4)',

        'level_name' => 'Thư mục thế giới',
        'level_seed' => 'Seed',
        'level_type' => 'Kiểu thế giới',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Quái vật xuất hiện',
        'spawn_protection' => 'Số khối được bảo vệ quanh spawn',

        'view_distance' => 'Tầm nhìn tính theo chunk',
        'simulation_distance' => 'Tầm mô phỏng tính theo chunk',
        'max_tick_time' => 'Watchdog, tính bằng mili giây (-1 tắt nó đi)',
        'sync_chunk_writes' => 'Ghi chunk thẳng xuống đĩa',

        'enable_command_block' => 'Command block',
        'allow_flight' => 'Cho phép bay',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Địa chỉ resource pack',
        'require_resource_pack' => 'Bắt buộc dùng resource pack',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
