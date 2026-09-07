<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Tệp lớn nhất: mọi thứ trong bốn trang cài đặt.
 *
 * "Node", "egg", "subuser", "topbar", "storage", "cron", "queue worker",
 * "webhook", "SFTP" và "allocation" giữ nguyên tiếng Anh - đó là những chữ trên
 * chính màn hình của Pelican và trong tài liệu của nó, và một plugin gọi cùng
 * một thứ bằng cái tên khác là một plugin bắt người ta tra hai lần.
 *
 * Tên các kiểu dáng (Legend, Ember, Nord, Solarized...) là tên riêng và không
 * dịch. Phần mô tả sau dấu gạch thì có.
 */

return [
    'css_warning' => 'Đã lưu, nhưng đoạn CSS này trông có vẻ sai',
    'css_unclosed' => 'Một quy tắc mở ở dòng :line không bao giờ được đóng. Mọi thứ sau nó nằm bên trong quy tắc đó và sẽ không có tác dụng.',
    'css_extra' => 'Có một dấu ngoặc đóng ở dòng :line mà chẳng có gì đang mở. Mọi thứ sau nó nằm ngoài mọi quy tắc và sẽ bị bỏ qua.',
    'css_comment' => 'Một chú thích mở ở dòng :line không bao giờ được đóng, nên phần còn lại của tệp nằm bên trong nó.',

    'groups' => [
        'appearance' => 'Diện mạo',
        'servers' => 'Danh sách máy chủ',
        'windows' => 'Diện mạo theo giờ',
        'windows_helper' => 'Một kiểu dáng khác giữa hai mốc giờ trong ngày. Không có gì xảy ra cho tới khi bạn thêm một khung. Đồng hồ là của chính bảng điều khiển, lấy từ cài đặt múi giờ của nó chứ không phải của từng người đọc — một bảng điều khiển trông khác nhau với hai người ở cùng một khoảnh khắc thì trông như hỏng chứ không như đã hẹn giờ. Một khung giờ đổi cái diện mạo mà bảng điều khiển vốn đang có, nên nó chẳng làm gì khi kiểu dáng đang đặt là Không có. Một kiểu dáng ai đó tự chọn cho mình vẫn thắng nó.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Ngôn ngữ',
        'servers_helper' => 'Một thẻ máy chủ được vẽ ra sao. Còn việc chúng hiện dưới dạng lưới hay danh sách là lựa chọn riêng của từng người, ở Tài khoản → Bố cục bảng tổng quan.',
        'server_pages' => 'Các trang trong máy chủ',
        'server_pages_helper' => 'Những gì mọi trang bên trong một máy chủ đều mang theo, dù đó là trang nào.',
        'console' => 'Trang bảng điều khiển lệnh',
        'console_helper' => 'Phông chữ, cỡ chữ và chiều cao của chính cái terminal là lựa chọn riêng của từng người, ở mục Tài khoản.',
        'background' => 'Nền',
        'background_helper' => 'Áp dụng cho cả bảng điều khiển, kể cả màn hình đăng nhập.',
        'icons' => 'Biểu tượng',
        'bars' => 'Thanh đo tài nguyên',
        'bars_helper' => 'Các thanh bộ xử lý, bộ nhớ và ổ đĩa trên thẻ máy chủ.',
        'updates' => 'Cập nhật',
        'updates_helper' => 'Trang Giao diện đưa ra những bản phát hành nào, và nó tìm chúng ở đâu.',
        'brand' => 'Thương hiệu',
        'login' => 'Màn hình đăng nhập',
        'login_helper' => 'Áp dụng cho màn hình đăng nhập, đặt lại mật khẩu và xác thực hai bước.',
        'advanced' => 'CSS riêng',
        'advanced_helper' => 'Dành cho bất cứ thứ gì các cài đặt bên trên không lo được. Nạp sau tất cả, nên nó thắng.',
        'areas' => 'Theo từng khu vực',
        'areas_helper' => 'Mọi thứ bên trên áp dụng ở khắp nơi. Ở đây bạn có thể tách riêng một khu vực; chỗ nào để trống thì vẫn theo cài đặt chung.',
        'footer' => 'Chân thanh bên',
        'footer_helper' => 'Phần đáy thanh bên, chỗ Pelican để trống. Mọi thứ ở đây đều tắt cho tới khi bạn điền vào.',
        'features' => 'Những gì plugin này thêm vào',
        'features_helper' => 'Bỏ đánh dấu một mục sẽ lấy nó ra khỏi bảng điều khiển hoàn toàn. Cài đặt riêng của nó vẫn được giữ và trang của nó vẫn giữ địa chỉ, nên tắt một thứ đi để xem nó vốn làm gì thì chẳng mất mát gì cả. Phần lớn những mục này còn có quyền riêng ở phần Vai trò, để trao đi một thứ mà không phải trao cả phần còn lại. Không phải tất cả: thanh đo tài nguyên, chân thanh bên và ô tìm cài đặt được vẽ cho mọi người và chẳng ai quản, ngôi sao trên thẻ máy chủ thuộc về người bấm nó, còn trang Palworld và Minecraft bên trong một máy chủ thì theo quyền của chính máy chủ đó chứ không theo mục nào ở đây. Bản thân phần tạo kiểu không nằm trong danh sách này — cái đó có công tắc riêng, ở Diện mạo → Kiểu dáng → Không có.',
        'identity' => 'Plugin này trong thanh bên',
        'identity_helper' => 'Cái dòng mà plugin này thêm vào thanh bên, và bức ảnh trên đó.',
    ],

    /*
     * Các trang cài đặt, mỗi trang một dòng trong nhóm thanh bên của chính
     * plugin. Nhóm theo câu hỏi bạn đang trả lời, chứ không theo lớp nào hiện
     * thực chúng.
     */
    'pages' => [
        'look' => 'Diện mạo',
        'look_helper' => 'Màu, hình khối, và bảng điều khiển tên là gì.',
        'pages' => 'Trang',
        'pages_helper' => 'Danh sách máy chủ, các trang bên trong một máy chủ, và cái terminal.',
        'advanced' => 'Nâng cao',
        'advanced_helper' => 'Hai lối thoát hiểm: CSS của riêng bạn, và những cài đặt chỉ áp dụng cho một khu vực.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Egg nào là Minecraft, và mọi thứ khác về nó.',
        'artwork' => 'Ảnh cho egg',
        'artwork_helper' => 'Một trang liệt kê mọi egg, và một cách lấy ảnh trò chơi cho nó từ Steam hoặc IGDB. Nó ghi thẳng vào chính các egg — bức ảnh, cùng hai thẻ ghi lại đó là trò chơi nào và ảnh có phải chọn bằng tay hay không — nên nó mang một quyền riêng.',
        'alerts' => 'Cảnh báo',
        'alerts_helper' => 'Một lượt kiểm tra theo giờ cho những thứ bảng điều khiển vốn đã đo mà chẳng nói với ai: một node ngừng trả lời, một ổ đĩa đầy dần, một queue worker đã dừng, một phiên bản tụt lại. Gửi tới Discord, tới bảng điều khiển, hoặc qua email. Có quyền riêng, bởi vì nó với tới mọi node theo giờ và đăng lên một địa chỉ do người ta gõ vào.',
        'backups' => 'Tổng quan sao lưu',
        'backups_helper' => 'Một trang liệt kê mọi máy chủ cùng khoảng thời gian nó không có bản sao lưu nào, sắp xếp để những cái chưa từng có nằm trên cùng. Chỉ đọc — mọi thứ tác động lên một bản sao lưu vẫn nằm trên trang của chính Pelican cho máy chủ đó. Có quyền riêng, bởi vì cái danh sách này là một tấm bản đồ chỉ ra chỗ nào đang hổng.',
        'public_status' => 'Trang trạng thái công khai',
        'public_status_helper' => 'Một trang ai cũng mở được mà không cần tài khoản, cho thấy máy chủ nào của bạn đang chạy và có bao nhiêu người trên đó. Không gì được công bố cho tới khi bạn nêu tên một máy chủ, một cái máy hoặc một dịch vụ — cả ba danh sách đều bắt đầu rỗng, và chừng nào cả ba còn rỗng thì địa chỉ đó trả lời 404. Có quyền riêng, bởi vì nó quyết định cái gì rời khỏi bảng điều khiển.',
        'game_players' => 'Người chơi, các trò khác',
        'capacity' => 'Sức chứa',
        'capacity_helper' => 'Những gì đã hứa trên mỗi cái máy so với những gì nó được phép phát ra, để bạn thấy liệu còn nhét thêm được một máy chủ nữa không. Danh sách node của Pelican cho thấy một cái tên và số lượng máy chủ, khối Máy trên trang tổng quan cho thấy cái gì đang chạy — đây là câu hỏi thứ ba, và phép tính là của chính Pelican. Chỉ đọc. Có quyền riêng.',
        'schedules' => 'Tác vụ theo lịch',
        'schedules_helper' => 'Mọi tác vụ theo lịch trên bảng điều khiển cùng với cái nào đã dừng: kẹt giữa chừng một lần chạy, quá hạn vì cron không chạy, hoặc chưa từng chạy. Pelican hiện các tác vụ theo lịch bên trong từng máy chủ và trạng thái của chính nó không có chữ nào cho những trường hợp đó. Chỉ đọc. Có quyền riêng.',
        'activity' => 'Hoạt động',
        'activity_helper' => 'Mọi sự kiện bảng điều khiển ghi lại, trong một danh sách thay vì mỗi lần một máy chủ. Pelican giữ nhật ký và hiện nó theo từng máy chủ; cái này hỏi cùng nhật ký đó theo chiều ngược lại. Chỉ đọc. Có quyền riêng, bởi vì một bản ghi ai đã làm gì là thứ phải trao đi một cách có chủ ý.',
        'access' => 'Quyền vào máy chủ',
        'access_helper' => 'Buộc một vai trò với các máy chủ, để mọi người giữ vai trò đó đều vào được. Nó chạy bằng cách giữ cho chính bảng subuser của Pelican luôn đúng, mà đó lại là thứ danh sách máy chủ và mọi lượt kiểm tra quyền vốn đã đọc. Có quyền riêng, bởi vì đây là trang duy nhất ở đây cấp cho người ta quyền vào một thứ gì đó.',
        'games' => 'Các trò chơi khác',
        'games_helper' => 'Những tệp mà ARK và Valheim giữ bên cạnh thế giới của chúng, dưới dạng biểu mẫu: cài đặt thế giới của ARK, và danh sách quản trị, cấm và cho phép của Valheim. Máy chủ nào có chúng thì do danh sách egg trên trang đó quyết định, nên một danh sách rỗng vốn đã là một công tắc tắt cho từng trò chơi.',
        'game_players_helper' => 'Một trang bên trong Rust, ARK, Valheim và bất cứ thứ gì trả lời truy vấn của Valve, cho thấy ai đang kết nối và họ đã ở đó bao lâu. Chỉ đọc — bạn làm được gì với một người thì mỗi trò một khác, và đó là một bản phát hành riêng. Egg nào được tính thì dùng chung danh sách với trang trạng thái.',
        'api' => 'API',
        'api_helper' => 'Những chiếc khóa người ta đang giữ, ai đã xin một chiếc, và mỗi chiếc được thấy gì.',
        'languages' => 'Ngôn ngữ',
        'languages_helper' => 'Plugin này trả lời bằng những ngôn ngữ nào.',
    ],

    'features' => [
        'look' => 'Cài đặt diện mạo',
        'look_helper' => 'Dòng trong thanh bên cho màu sắc, hình khối và thương hiệu.',
        'pages' => 'Cài đặt trang',
        'pages_helper' => 'Dòng trong thanh bên cho danh sách máy chủ, các trang trong máy chủ và cái terminal.',
        'advanced' => 'Cài đặt nâng cao',
        'advanced_helper' => 'Dòng trong thanh bên cho CSS của riêng bạn và các thiết lập đè theo khu vực.',
        'announcements' => 'Thông báo',
        'announcements_helper' => 'Cái thanh chạy ngang đầu bảng điều khiển.',
        'nav_links' => 'Liên kết điều hướng',
        'nav_links_helper' => 'Những dòng của riêng bạn trong thanh bên.',
        'login' => 'Màn hình đăng nhập',
        'login_helper' => 'Ảnh, lời nhắn và liên kết trên màn hình đăng nhập.',
        'bars' => 'Thanh đo tài nguyên',
        'bars_helper' => 'Các thanh bộ xử lý, bộ nhớ và ổ đĩa đã đổi màu.',
        'dashboard_status' => 'Dòng phiên bản',
        'dashboard_status_helper' => 'Phần trên của khối trên trang tổng quan: phiên bản nào đang cài và có bản nào đang chờ không.',
        'dashboard_nodes' => 'Máy',
        'dashboard_nodes_helper' => 'Phần còn lại của khối đó: bảng điều khiển này và mọi node, cùng với mỗi cái đang dùng những gì.',
        'system_status' => 'Trang trạng thái hệ thống',
        'system_status_helper' => 'Trang dành cho cái máy mà chính bảng điều khiển chạy trên đó.',
        'sidebar_footer' => 'Chân thanh bên',
        'sidebar_footer_helper' => 'Dòng chữ của bạn, phiên bản bảng điều khiển và một liên kết, ở đáy thanh bên.',
        'api' => 'API',
        'api_helper' => 'Một lối vào từ bên ngoài bảng điều khiển: một địa chỉ mà một con bot Discord hay một đoạn script của riêng bạn có thể hỏi xem plugin này biết gì — ai đang chơi, máy chủ nào không có bản sao lưu, còn nhét thêm được một cái nữa lên một node hay không. Tắt thì không đăng ký một tuyến nào cả chứ không phải một tuyến chuyên từ chối, tức là ít bề mặt hơn chứ không phải cùng chừng ấy bề mặt lịch sự hơn. Bất kỳ ai đã đăng nhập đều có thể xin một chiếc khóa chỉ trả lời cho máy chủ của chính họ; còn việc cấp một chiếc, từ chối một chiếc, thu hồi chiếc của người khác và tạo một chiếc ở tầm cả bảng điều khiển thì đều cần quyền.',
        'languages' => 'Ngôn ngữ',
        'languages_helper' => 'Trả lời mỗi người bằng thứ tiếng mà tài khoản của họ đang đặt, ở những chỗ plugin này đã được dịch sang tiếng đó. Tắt thì mọi người đều nhận tiếng Anh.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Một mục Minecraft trong thanh bên, và một trang bên trong mỗi máy chủ Minecraft để sửa server.properties của nó dưới dạng một biểu mẫu. Egg nào được tính là do bạn nói.',
        'palworld' => 'Cài đặt Palworld',
        'palworld_helper' => 'Một trang bên trong một máy chủ Palworld để sửa cài đặt thế giới của nó. Nó không xuất hiện trên máy chủ nào khác, và không bao giờ xuất hiện lúc máy chủ đó đang chạy.',
        'settings_search' => 'Tìm trong cài đặt',
        'settings_search_helper' => 'Cái ô phía trên các biểu mẫu này, thu hẹp chúng lại còn những mục chứa thứ bạn gõ.',
        'preview' => 'Xem trước trực tiếp',
        'preview_helper' => 'Cái ô bên cạnh biểu mẫu Diện mạo, cho thấy màu sắc, góc bo và khoảng cách làm được gì trước khi bạn lưu chúng.',
        'duplicate' => 'Nhân bản máy chủ',
        'duplicate_helper' => 'Một trang để dựng thêm một máy chủ y hệt cái bạn đã có, hoặc vài cái cùng lúc. Tệp thì không bao giờ được sao chép.',
        'favourites' => 'Máy chủ đã gắn sao',
        'favourites_helper' => 'Một ngôi sao trên mỗi thẻ máy chủ. Những cái đã gắn sao đứng trước, và danh sách của mỗi người được giữ trên bảng điều khiển — nên sao của họ đi theo họ tới bất cứ chỗ nào họ đăng nhập lần sau. Nó đổi thứ họ thấy và không đổi gì với người khác. Việc nằm trên bảng điều khiển cũng có nghĩa nó là một tệp dưới storage, mà ai vào được cái máy đó đều đọc được.',
        'artwork' => 'Ảnh cho egg',
        'artwork_helper' => 'Trang quản trị lấy ảnh của mỗi egg từ Steam hoặc IGDB và ghi nó vào chính cái egg.',
        'alerts' => 'Cảnh báo',
        'alerts_helper' => 'Lượt kiểm tra theo giờ cho một node đã ngừng trả lời, một ổ đĩa đầy dần, một queue worker đã chết hay một phiên bản tụt lại, cùng với tin nhắn Discord, thông báo trong bảng điều khiển hoặc email mà nó gửi đi.',
        'backups' => 'Tổng quan sao lưu',
        'backups_helper' => 'Trang quản trị liệt kê mọi máy chủ theo khoảng thời gian nó không có bản sao lưu. Chỉ đọc.',
        'public_status' => 'Trang trạng thái công khai',
        'public_status_helper' => 'Trang ai cũng mở được mà không cần tài khoản. Tắt thì địa chỉ đó trả lời 404 bất kể trong danh sách có gì.',
        'game_players' => 'Người chơi, các trò khác',
        'game_players_helper' => 'Một trang bên trong Rust, ARK, Valheim và bất cứ thứ gì trả lời truy vấn của Valve, cho thấy ai đang kết nối và họ đã ở đó bao lâu.',
        'owner_alerts' => 'Báo cho người ta biết máy chủ của họ đang tắt',
        'owner_alerts_helper' => 'Phần duy nhất của plugin này viết cho những người không phải quản trị viên: một thông báo trong bảng điều khiển khi cái máy chứa một máy chủ của họ ngừng trả lời, và một cái nữa khi nó quay lại. Tắt cho tới khi được bật cả ở đây lẫn trên trang Cảnh báo — nó viết cho khách của bạn, nên nó cần hai quyết định chứ không phải một.',
        'my_backups' => 'Cảnh báo sao lưu trên danh sách máy chủ',
        'my_backups_helper' => 'Một dòng phía trên danh sách máy chủ của mỗi người khi có cái nào của họ chưa từng được sao lưu hoặc đã lâu không được sao lưu. Thẻ của Pelican nói một máy chủ đang làm gì lúc này; không chỗ nào ở đó nói rằng ba tuần rồi chưa có lần sao lưu nào. Chỉ được vẽ khi có thứ gì đang tụt lại, và nó không nêu tên máy chủ nào mà họ chưa mở được.',
        'capacity' => 'Tổng quan sức chứa',
        'capacity_helper' => 'Trang quản trị cho thấy bộ nhớ, ổ đĩa và bộ xử lý đã hứa so với còn dư trên mỗi cái máy, cùng những máy chủ đã hết bản sao lưu, cơ sở dữ liệu hay allocation. Đã hứa chứ không phải đã dùng — một node có thể bận mà rỗng, hoặc nhàn mà đầy.',
        'schedules' => 'Tổng quan tác vụ theo lịch',
        'schedules_helper' => 'Trang quản trị liệt kê mọi tác vụ theo lịch trên cả bảng điều khiển, tệ nhất trước — kẹt, quá hạn, hay chưa từng chạy. Chỉ đọc; mọi thứ sửa hay chạy một tác vụ vẫn nằm trên trang của chính Pelican cho máy chủ đó.',
        'activity' => 'Hoạt động bảng điều khiển',
        'activity_helper' => 'Trang quản trị liệt kê mọi sự kiện đã ghi trên cả bảng điều khiển, mới nhất trước, kèm ai đã làm và trên máy chủ nào. Chỉ đọc — nó không xóa gì cả, và cài đặt của chính Pelican vẫn quyết định các dòng được giữ bao lâu.',
        'access' => 'Quyền vào máy chủ theo vai trò',
        'access_helper' => 'Một trang để buộc một vai trò với các máy chủ, được giữ cho đúng trong chính bảng subuser của Pelican. Nó không cấp gì cho tới khi bạn nối một thứ gì đó. Tắt nó đi thì nó ngừng đối chiếu; quyền đã cấp thì vẫn còn, và trang có một cái nút để lấy lại.',
        'scheduled' => 'Diện mạo theo giờ',
        'scheduled_helper' => 'Mục trên trang Diện mạo để cho bảng điều khiển một kiểu dáng khác giữa hai mốc giờ trong ngày. Nó không đổi thứ gì đã lưu — một khung giờ được phủ lên trên các cài đặt trong lúc trang được vẽ rồi buông ra ngay sau đó — nên tắt cái này đi là bảng điều khiển trở lại diện mạo của chính nó ngay lập tức, và chẳng mất gì.',
        'games' => 'Các trò chơi khác',
        'games_helper' => 'Cài đặt thế giới của ARK, và danh sách quản trị, cấm và cho phép của Valheim, dưới dạng biểu mẫu thay vì dạng tệp trong trình quản lý tệp. Máy chủ nào có chúng thì do danh sách egg trên trang Các trò chơi khác quyết định.',
        'quick' => 'Menu đi tới',
        'quick_helper' => 'Một nút ở đầu mọi trang để nhảy tới một máy chủ hay một trang bạn đã gắn sao, kèm một ô tìm kiếm trên toàn bộ danh sách máy chủ của bạn. Nó cũng gắn sao cho trang bạn đang đứng. Thứ người ta tìm thấy qua nó là thứ họ vốn đã với tới được, nên nó không cấp thêm gì cả — tắt cái này đi là lấy đi lối tắt, và lấy luôn trang Yêu thích theo nó.',
    ],

    /*
     * Ô tìm kiếm phía trên các biểu mẫu cài đặt. Nó lọc thứ vốn đã có trên trang
     * ngay trong trình duyệt và không hỏi máy chủ gì cả, nên không có trạng thái
     * "đang tìm" nào để mô tả và cũng không có cách nào để nó hỏng.
     */
    /*
     * Ô xem trước. Mọi thứ trong đó là hàng thế chỗ chứ không phải một mẫu lấy
     * từ bảng điều khiển của bạn, và chữ nghĩa nói rõ như vậy — một cái ô nêu
     * tên một máy chủ thật hay một con số thật sẽ bị đọc như là thật.
     */
    'preview' => [
        'label' => 'Xem trước',
        'card' => 'Một cái thẻ',
        'card_helper' => 'Vẽ theo đúng luật của bảng điều khiển, nhưng với các cài đặt trên trang này thay cho những cái đã lưu.',
        'button' => 'Một cái nút',
        'field' => 'Một ô nhập',
        'meter_ok' => 'Ổn',
        'meter_warning' => 'Cảnh báo',
        'meter_danger' => 'Nguy',

        /*
         * Bản xem trước cả trang. Một tab chứ không phải một khung, bởi vì
         * Pelican gửi X-Frame-Options: DENY và từ chối bị đóng khung bởi bất cứ
         * thứ gì, kể cả chính nó — xem Support\FullPreview.
         */
        'full' => 'Xem cả bảng điều khiển',
        'full_confirm' => 'Mở bảng điều khiển được vẽ từ các cài đặt trên trang này thay cho những cái đã lưu. Không có gì được ghi cả — các giá trị được giữ trong mười lăm phút và bảng điều khiển trở lại bình thường khi bạn rời bản xem trước hoặc khi bạn lưu.',
        'full_go' => 'Cho tôi xem',
        'full_failed' => 'Không mở được bản xem trước',
        'bar' => 'Bạn đang nhìn những cài đặt chưa lưu. Không có gì ở đây đã được ghi.',
        'bar_back' => 'Trở lại phần cài đặt',
    ],

    'search' => [
        'placeholder' => 'Tìm trong cài đặt',
        'label' => 'Tìm trong những cài đặt này',
        'none' => 'Không có gì trên trang này khớp cả. Các cài đặt trải trên bốn trang — hãy thử Diện mạo, Trang, Nâng cao, hoặc Cài đặt Essentials.',
    ],

    'footer' => [
        'text' => 'Dòng chữ của riêng bạn',
        'text_helper' => 'Chữ thuần, nhiều nhất 120 ký tự. Được thoát ký tự, như thanh thông báo — cái này hiện trên mọi trang của bảng điều khiển, và như thế thì đây là chỗ sai để nhận mã đánh dấu.',
        'version' => 'Hiện phiên bản bảng điều khiển',
        'version_helper' => 'Phiên bản của Pelican, không phải của plugin này. Plugin nói phiên bản của chính nó trên trang tổng quan; còn thứ người ta hỏi ở đáy một thanh bên là họ đang nhìn cái bảng điều khiển nào.',
        'link_label' => 'Chữ của liên kết',
        'link_url' => 'Địa chỉ liên kết',
        'link_url_helper' => 'Một địa chỉ http hoặc https, hoặc một đường dẫn của chính bảng điều khiển như /account. Mở trong tab mới.',
    ],

    'layout' => [
        'label' => 'Bố cục',
        'helper' => 'Bảng điều khiển được sắp xếp ra sao, chứ không phải nó màu gì. Áp dụng cho khu vực quản trị, danh sách máy chủ và khu vực khách hàng như nhau. Chỗ đặt phần điều hướng chỉ là mặc định: ai đã tự đặt của mình ở Tài khoản → Điều hướng thì vẫn giữ.',
        'default' => 'Thanh bên — của chính Pelican',
        'rail' => 'Dải biểu tượng — hẹp, mở ra khi rê chuột',
        'top' => 'Điều hướng trên đỉnh — không thanh bên',
        'mixed' => 'Thanh trên và thanh bên — cả hai',
        'wide' => 'Rộng — nội dung dùng cả màn hình',
        'focus' => 'Tập trung — cột hẹp, thanh bên gập lại',

        'nav_label' => 'Kiểu thanh bên',
        'nav_helper' => 'Chính cái thanh bên được vẽ ra sao.',
        'nav_default' => 'Mặc định',
        'nav_floating' => 'Nổi — một cái thẻ riêng',
        'nav_flat' => 'Phẳng — không nền gì cả',
        'nav_bordered' => 'Viền — một đường kẻ, không phải một mặt',

        'topbar_label' => 'Kiểu topbar',
        'topbar_helper' => 'Ẩn chỉ áp dụng cho máy tính — trên điện thoại, topbar giữ lối duy nhất quay về menu.',
        'topbar_default' => 'Mặc định',
        'topbar_floating' => 'Nổi — một thanh rời ra',
        'topbar_flush' => 'Sát — phẳng, không làm mờ',
        'topbar_hidden' => 'Ẩn trên máy tính',

        'card_label' => 'Kiểu thẻ',
        'card_helper' => 'Các mục, tiện ích, thẻ máy chủ và những khối phía trên bảng điều khiển lệnh.',
        'card_default' => 'Mặc định — nổi lên với mép mềm',
        'card_flat' => 'Phẳng — không nhô lên',
        'card_outline' => 'Viền — một đường bao và không gì phía sau',
        'card_glass' => 'Kính mờ — nền hiện xuyên qua',
        'card_sharp' => 'Sắc — góc vuông',
    ],

    'servers' => [
        /*
         * Ngôi sao trên một cái thẻ. Trao cho đoạn script chứ không viết cứng
         * vào trong nó, để chữ nghĩa vẫn nằm ở chỗ duy nhất mà chữ nghĩa ở.
         */
        'favourite' => 'Gắn sao cho máy chủ này',
        'favourited' => 'Đã gắn sao — hiện trước',

        /*
         * Cái viên thuốc bên cạnh các tab của chính Pelican. Đặt tên theo việc
         * nó làm gì với danh sách chứ không như một tab thứ tư, bởi vì nó lọc
         * cái tab đang chọn chứ không thay thế tab đó.
         */
        'favourites_tab' => 'Yêu thích',
        'favourites_empty' => 'Không có gì được gắn sao trên trang này. Hãy dùng ngôi sao trên một thẻ máy chủ để thêm một cái — và lưu ý rằng cái này lọc những máy chủ đã có trong danh sách ở đây, nên một máy chủ đã gắn sao nằm ở trang sau thì không phải đang bị giấu đi, nó đơn giản là không nằm trên trang này.',
        'favourites_failed' => 'Không lưu được các máy chủ đã gắn sao của bạn, nên chúng đã được đưa về đúng thứ bảng điều khiển giữ lần cuối. Bảng điều khiển của trình duyệt nói yêu cầu đó đã trả lời gì.',

        'art' => 'Ảnh trò chơi',
        'art_helper' => 'Pelican vẽ ảnh của egg lên mọi cái thẻ. Cái này quyết định làm gì với nó.',
        'art_faded' => 'Mờ — một lớp phủ nhạt sau chữ',
        'art_cover' => 'Phủ — sau cái tên, nhạt dần đi',
        'art_off' => 'Tắt',
        'art_dim' => 'Làm tối lớp phủ',
        'art_dim_helper' => 'Ảnh của trò này là một bầu trời sáng, còn của trò kia là một cái hang.',

        'status' => 'Dấu hiệu tình trạng',
        'status_helper' => 'Cái màu đang chạy/đang khởi động/đã dừng được hiện ở đâu.',
        'status_bar' => 'Thanh — dọc mép trái',
        'status_edge' => 'Mép — chạy ngang trên đỉnh',
        'status_dot' => 'Chấm — ở góc',
        'status_off' => 'Tắt',

        'density' => 'Chiều cao thẻ',
        'density_comfortable' => 'Thoải mái',
        'density_compact' => 'Gọn — cho nhiều máy chủ',

        'filter_label' => 'Ghi chữ lên nút lọc',
        'filter_label_helper' => 'Pelican vốn đã lọc danh sách này theo egg và theo chủ sở hữu, trên mọi trang — nhưng lối vào lại là một biểu tượng không có chữ bên cạnh ô tìm kiếm. Cái này đặt chữ lên đó.',
        'filter_button' => 'Bộ lọc',

        'columns' => 'Số thẻ nằm ngang trên màn hình rộng',
        'columns_helper' => 'Chỉ áp dụng cho bố cục lưới, và chỉ từ 1280px trở lên. Mức tối đa của chính Pelican là hai.',
    ],

    'controls' => [
        'mode' => 'Nút bảng điều khiển lệnh trên mọi trang của máy chủ',
        'mode_helper' => 'Một cái nút nổi, trên mọi trang bên trong một máy chủ. Nó mở bảng điều khiển lệnh đè lên thứ bạn đang làm dở, với trạng thái và các nút nguồn trên phần đầu của nó — với thẳng tới node, giống như danh sách máy chủ làm, chứ không đi qua websocket của trang bảng điều khiển lệnh. Nó không bao giờ hiện trên chính trang đó, nơi vốn đã có đủ mọi thứ.',
        'mode_full' => 'Bảng điều khiển lệnh và các nút nguồn',
        'mode_console' => 'Chỉ bảng điều khiển lệnh',
        'mode_off' => 'Tắt',

        'label' => 'Cái nút hiện',
        'label_text' => 'Biểu tượng và tên',
        'label_icon' => 'Chỉ biểu tượng',

        'position' => 'Nó nổi ở đâu',
        'position_helper' => 'Sát cái mép mà bạn ít có khả năng đang đọc nhất.',
        'position_top' => 'Trên',
        'position_right' => 'Phải',
        'position_bottom' => 'Dưới',
    ],

    'console' => [
        'stats' => 'Các khối phía trên bảng điều khiển lệnh',
        'stats_helper' => 'Pelican hiện tên, trạng thái, địa chỉ và ba con số mức dùng phía trên cái terminal. Giấu chúng đi là trả lại chiều cao cho bảng điều khiển lệnh.',
        'stats_tiles' => 'Ô — nhãn, con số và một biểu tượng',
        'stats_plain' => 'Thuần — như Pelican vẽ chúng',
        'stats_off' => 'Ẩn',
    ],

    'terminal' => [
        'helper' => 'Trao thẳng cho chính cái terminal, nên chúng có hiệu lực ở lần nạp trang kế tiếp chứ không phải ngay lúc được lưu.',

        'renderer' => 'Vẽ bằng',
        'renderer_helper' => 'Pelican vẽ cái terminal trên GPU, và như thế nhanh hơn nhiều khi cả một bức tường chữ đang cuộn qua. Một trình duyệt chỉ giữ được chừng ấy ngữ cảnh GPU cùng lúc — trên điện thoại thì còn ít hơn — và lấy đi cái cũ nhất khi vượt giới hạn; lúc đó cái terminal chẳng vẽ gì cả, mà cũng không báo lỗi. Nếu bảng điều khiển lệnh của bạn trắng trơn trong khi mọi thứ khác quanh nó vẫn ổn thì đây là cài đặt cần đổi.',
        'renderer_webgl' => 'GPU — của chính Pelican, nhanh hơn',
        'renderer_dom' => 'Trình duyệt — chậm hơn, luôn vẽ được',

        'scheme' => 'Bảng màu',
        'scheme_helper' => 'Cài đặt terminal duy nhất mà Pelican không đưa ra. Theo giao diện sẽ lấy màu từ màu nhấn, và đó chính là lý do cái này tồn tại.',
        'scheme_theme' => 'Theo giao diện',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Con trỏ',
        'cursor_helper' => 'Bảng điều khiển lệnh không nhận gõ phím — ô nhập lệnh nằm ngay dưới nó — nên đây là chỗ dòng ra đã dừng lại, chứ không phải chỗ bạn đang đứng.',
        'cursor_underline' => 'Gạch chân — của chính Pelican',
        'cursor_block' => 'Khối',
        'cursor_bar' => 'Vạch',

        'blink' => 'Con trỏ nhấp nháy',

        'scrollback' => 'Lịch sử cuộn',
        'scrollback_helper' => 'Bảng điều khiển lệnh cuộn ngược lại được bao xa. Mọi dòng đều được giữ trong trình duyệt, nên một máy chủ lắm lời cộng với một con số lớn là bộ nhớ thật trên cái máy đang đọc nó.',
        'scrollback_lines' => ':lines dòng',
    ],

    'notice' => [
        'text' => 'Lời nhắn',
        'text_helper' => 'Một dòng, tối đa 200 ký tự. Nó được thoát ký tự cả lúc vào lẫn lúc ra, nên nó không mang được mã đánh dấu lên một trang mà người khác nạp.',
        'style' => 'Giọng',
        'style_info' => 'Thông tin',
        'style_warning' => 'Cảnh báo',
        'style_danger' => 'Khẩn',
        'style_accent' => 'Màu nhấn',
        'scope' => 'Hiện cho',
        'scope_all' => 'Mọi người',
        'scope_client' => 'Chỉ ngoài khu vực quản trị',
        'scope_admin' => 'Chỉ trong khu vực quản trị',
        'link_label' => 'Chữ trên nút',
        'link_url' => 'Địa chỉ của nút',
        'link_url_helper' => 'https:// hoặc một đường dẫn bên trong bảng điều khiển này, chẳng hạn /account. Mọi thứ khác đều bị bỏ qua — một liên kết trong một thanh nằm trên mọi trang không phải chỗ cho một giao thức chẳng ai ngờ tới.',
        'dismissible' => 'Có thể đóng lại',
        'dismissible_helper' => 'Việc đóng nó được nhớ theo từng trình duyệt, và chỉ cho lời nhắn này: đổi chữ đi là nó hiện lại với tất cả mọi người.',
        'dismiss' => 'Đóng',
    ],

    'preset' => [
        'label' => 'Kiểu dáng',
        'helper' => 'Chọn một diện mạo để bắt đầu. Nó điền hết mọi thứ bên dưới, rồi bạn sửa lại được. Không có sẽ tắt giao diện đi và để bảng điều khiển đúng như Pelican giao tới.',
        'options' => [
            'none' => 'Không có — không giao diện',
            'legend' => 'Legend — lửa đỏ chuyển thành sét xanh',
            'ember' => 'Ember — đen ấm, nhấn cam',
            'midnight' => 'Midnight — xanh thẫm, dịu',
            'crimson' => 'Crimson — đỏ, góc sắc, gọn',
            'forest' => 'Forest — xanh lá, bo tròn, không quầng sáng',
            'nebula' => 'Nebula — tím với nền chuyển màu',
            'terminal' => 'Terminal — xanh lá trên nền đen, chữ đều, sắc',
            'console' => 'Console — tròn và rộng rãi, cho máy tính bảng',
            'nord' => 'Nord — bảng màu Nord, trầm',
            'solarized' => 'Solarized — Solarized tối, nhấn xanh lơ',
            'paper' => 'Paper — sáng, tương phản cao, phẳng',
            'daylight' => 'Daylight — sáng và ấm, với một lớp phủ nhẹ',
            'mono' => 'Mono — thang xám, phẳng và dày',
        ],

        'save' => 'Lưu thành một kiểu dáng',
        'save_confirm' => 'Giữ lại màu sắc, góc bo, nền, chữ nghĩa, biểu tượng và các ngưỡng của thanh đo mà bạn đang có trên màn hình ngay lúc này — dưới một cái tên của riêng bạn, trong ô chọn bên cạnh những kiểu dáng có sẵn. Nó lưu thứ đang trên trang, chứ không phải thứ đã lưu lần cuối.',
        'save_name' => 'Tên',
        'save_name_helper' => 'Nó sẽ được gọi là gì trong ô chọn. Lưu dưới một cái tên bạn đã dùng trước đó sẽ thay thế cái cũ.',
        'saved' => 'Đã lưu kiểu dáng',
        'save_failed' => 'Không lưu được kiểu dáng đó',
        'save_full' => 'Chỉ có chỗ cho :max kiểu dáng của riêng bạn. Hãy xóa bớt một cái trước.',

        'delete' => 'Xóa một kiểu dáng',
        'delete_which' => 'Cái nào',
        'delete_confirm' => 'Chỉ xóa được những kiểu dáng của riêng bạn; những cái có sẵn thì không. Diện mạo hiện tại của bảng điều khiển chẳng đổi gì cả — một kiểu dáng là một điểm khởi đầu, và mọi giá trị nó đặt thì vốn đã nằm trong các cài đặt bên dưới.',
        'deleted' => 'Đã xóa kiểu dáng',
        'deleted_current' => 'Đó chính là cái mà bảng điều khiển này đang đặt. Các cài đặt của nó không đổi và vẫn ở trên trang này — hãy chọn một kiểu dáng, hoặc lưu lại nó dưới một cái tên.',
    ],

    'user_themes' => [
        'label' => 'Những kiểu dáng người ta được tự chọn',
        'helper' => 'Kiểu dáng được đánh dấu sẽ xuất hiện trên một trang Diện mạo trong khu vực khách hàng, nơi ai đã đăng nhập cũng chọn được một cái cho mình. Nó đổi thứ họ thấy và không đổi gì với người khác. Không đánh dấu gì nghĩa là chẳng ai chọn gì và bảng điều khiển giữ một diện mạo duy nhất — đúng như nó đang làm bây giờ.',
    ],

    'mode' => [
        'label' => 'Chế độ bảng điều khiển',
        'helper' => 'Bảng điều khiển mở ra ở chế độ nào. Ai chưa tự chọn thì nhận cái này; nút chuyển trong menu người dùng vẫn cho họ đổi, trừ khi bạn khóa nó lại bên dưới.',
        'dark' => 'Tối',
        'light' => 'Sáng',
        'system' => 'Hệ thống — theo cài đặt của chính người xem',
    ],

    'font' => [
        'label' => 'Chữ của bảng điều khiển',
        'helper' => 'Mọi lựa chọn đều là một họ chữ mà hệ điều hành vốn đã có — không có gì được lấy về từ một kho phông chữ. Cái terminal thì không bị ảnh hưởng: phông của nó là lựa chọn riêng của từng người, ở mục Tài khoản.',
        'default' => 'Mặc định — của chính Pelican',
        'mono' => 'Chữ đều',
        'rounded' => 'Bo tròn',
        'serif' => 'Có chân',
        'system' => 'Hệ thống — bất cứ thứ gì cái máy này dùng',
    ],

    'surface' => [
        'label' => 'Màu mặt nền',
        'helper' => 'Các thẻ và các khung. Những sắc sáng hơn và tối hơn đều được suy ra từ nó.',
        'placeholder' => 'Theo giao diện',
    ],

    'radius' => [
        'label' => 'Góc',
    ],

    'accent' => [
        'label' => 'Màu nhấn',
        'helper' => 'Dùng cho nút, liên kết, mục điều hướng đang chọn và vòng nhấn tiêu điểm.',

        /*
         * Nói ra, chứ không ép. Một màu bị cảnh báo ở đây vẫn được lưu: đó là
         * bảng điều khiển của người ta, con số chỉ là một cách đo một thứ, và có
         * những lý do chính đáng để muốn một màu nhấn bị chấm điểm thấp. Ô chọn
         * màu nói ra thứ nó thấy rồi tránh sang một bên.
         */
        'contrast_dark' => 'Độ dễ đọc: :ratio trên nền bảng điều khiển tối. Dưới 3 thì một màu nhấn khó đọc khi nó là một cái nút hay một liên kết — một màu sáng hơn sẽ nâng nó lên.',
        'contrast_light' => 'Độ dễ đọc: :ratio trên nền bảng điều khiển sáng. Dưới 3 thì một màu nhấn khó đọc khi nó là một cái nút hay một liên kết — một màu tối hơn sẽ nâng nó lên.',
    ],
    'density' => [
        'label' => 'Mật độ',
        'helper' => 'Gọn sẽ siết khoảng cách lại để nhiều dòng lọt lên màn hình hơn.',
        'comfortable' => 'Thoải mái',
        'compact' => 'Gọn',
    ],
    'force_dark' => [
        'label' => 'Ép chế độ tối',
        'helper' => 'Giấu nút chuyển sáng/tối và giữ mọi người dùng ở giao diện tối.',
    ],
    'glass' => [
        'label' => 'Topbar kính mờ',
        'helper' => 'Làm mờ topbar và nền phía sau các hộp thoại. Hãy tắt trên máy yếu.',
    ],
    'glow' => [
        'label' => 'Quầng sáng màu nhấn',
        'helper' => 'Bóng đổ màu nhấn dịu trên nút chính, mục điều hướng đang chọn và thẻ đăng nhập.',
    ],

    'background' => [
        'label' => 'Kiểu nền',
        'helper' => 'Aurora là nền của chính giao diện này: những quầng sáng màu nhấn với một lớp hạt mịn.',
        'aurora' => 'Aurora (mặc định)',
        'solid' => 'Một màu',
        'gradient' => 'Chuyển màu',
        'image' => 'Ảnh',
        'color' => 'Màu',
        'base' => 'Màu phía sau các quầng sáng',
        'base_helper' => 'Thứ mà trang nằm lên trước khi các quầng sáng màu nhấn được vẽ đè lên. Để trống thì giữ mặc định của bảng điều khiển, tức gần đen ở chế độ tối và gần trắng ở chế độ sáng. Đặt nó vào thì một bảng màu giữ được màu đêm của riêng nó mà vẫn được thắp sáng.',
        'color_end' => 'Màu thứ hai',
        'angle' => 'Hướng',
        'upload' => 'Tải lên một bức ảnh',
        'upload_helper' => 'Tối đa 8 MB. Ảnh tải lên được ưu tiên hơn địa chỉ bên dưới.',
        'url' => 'Hoặc một địa chỉ',
        'url_helper' => 'Phải bắt đầu bằng https:// và với tới được từ bên ngoài.',
        'dim' => 'Làm tối',
        'dim_helper' => 'Không làm tối thì chữ trắng trên một tấm ảnh sáng là không đọc nổi.',
        'blur' => 'Làm mờ',
    ],

    'channel' => [
        'installed' => 'đang cài',
        'version' => 'Cài một phiên bản cụ thể',
        'version_helper' => 'Bất kỳ bản phát hành nào trên kênh này, chứ không chỉ bản mới nhất — để quay lại khi một thứ mới hóa ra lại tệ hơn, hoặc để tiến tới một bản dựng ai đó bảo bạn thử. Chỉ dùng được khi cập nhật không tự cài: bật cái đó lên thì thứ bạn chọn chỉ sống tới lần kiểm tra kế tiếp.',
        'version_placeholder' => 'Chọn một phiên bản',
        'version_install' => 'Cài phiên bản này',
        'version_confirm' => 'Bảng điều khiển tải bản phát hành đó về, dựng lại tài nguyên của nó và xóa các bộ nhớ đệm. Cài đặt của bạn vẫn được giữ. Quay về một phiên bản cũ hơn là được phép và sẽ không tự bị hoàn tác — hãy chọn lại bản mới hơn để tiến lên.',
        'label' => 'Kênh cập nhật',
        'helper' => 'Trang Giao diện đưa ra những bản phát hành nào. Beta nhận phiên bản mới trước, và cũng nhận những chỗ gồ ghề trước.',
        'stable' => 'Ổn định',
        'beta' => 'Beta',
        'dev' => 'Dev (nhánh đang làm)',
        'auto' => [
            'label' => 'Tự động cài cập nhật',
            'helper' => 'Tắt thì việc cập nhật để cho bạn. Bật thì bảng điều khiển kiểm tra kênh đã chọn và cài bất cứ thứ gì mới hơn — nó dựng lại tài nguyên trong lúc đó và không dùng được trong vài phút, nên hằng ngày và hằng tuần chạy lúc 04:00. Cần cron của bảng điều khiển đang chạy.',
            'interval' => 'Kiểm tra mỗi',
            'minute' => 'Mỗi phút',
            'five_minutes' => 'Mỗi 5 phút',
            'ten_minutes' => 'Mỗi 10 phút',
            'thirty_minutes' => 'Mỗi 30 phút',
            'hourly' => 'Mỗi giờ',
            'daily' => 'Mỗi ngày (04:00)',
            'weekly' => 'Mỗi tuần (thứ Hai 04:00)',
        ],
    ],

    /*
     * Mục Ngôn ngữ.
     *
     * Phải cẩn thận với những gì nó tuyên bố. Pelican vốn đã cho mỗi người chọn
     * một ngôn ngữ cho cả tài khoản của họ và vốn đã áp dụng nó; không có gì ở
     * đây đổi chuyện đó, mà cũng không nên. Cái này chỉ quyết định liệu chữ
     * nghĩa của riêng plugin này có đi theo lựa chọn ấy hay không.
     */
    'languages' => [
        'section_helper' => 'Pelican vốn đã cho mỗi người chọn một ngôn ngữ cho tài khoản của họ, và plugin này đi theo nó ở bất cứ đâu nó đã được dịch. Đây là chỗ bạn quyết định nó sẽ đi theo những thứ tiếng nào. Phần lớn các ngôn ngữ nằm ở tỷ lệ thấp là có chủ ý: thứ được dịch trước là phần ai cũng thấy trên mọi trang — các nút nguồn phía trên một bảng điều khiển lệnh và các thanh đo của node — còn phần còn lại đến dần khi người ta đóng góp.',
        'panel' => 'Cho cái này quyết định ngôn ngữ của cả bảng điều khiển',
        'panel_helper' => 'Bật, một ngôn ngữ mà plugin này không mang theo — hoặc một ngôn ngữ đã tắt bên dưới — sẽ đưa cả bảng điều khiển về tiếng Anh với người đọc đó, chứ không chỉ những trang này. Tắt, chỉ plugin này đi theo danh sách còn Pelican vẫn nói thứ tiếng mà tài khoản đang đặt, nghĩa là một người đọc có thể gặp hai thứ tiếng trên cùng một màn hình. Đằng nào cũng không có tài khoản nào bị đổi: bật lại một ngôn ngữ là họ có nó trở lại.',
        'label' => 'Những ngôn ngữ sẽ trả lời',
        'helper' => 'Bỏ đánh dấu một cái sẽ đưa những người đọc có tài khoản đặt thứ tiếng đó về lại tiếng Anh, nhưng chỉ với plugin này — phần còn lại của bảng điều khiển vẫn nói tiếng của họ. Tiếng Anh không nằm trong danh sách vì mọi thứ đều lùi về nó.',
        'under' => 'chưa được đưa ra cho tới khi nó đi xa hơn — hãy đánh dấu để vẫn đưa ra',
        'done' => 'đã dịch :percent%',
        'main' => 'Ngôn ngữ chính',
        'main_helper' => 'Thứ một người đọc nhận được khi ngôn ngữ của chính họ không dùng được — hoặc plugin này không mang theo nó, hoặc nó bị bỏ đánh dấu bên dưới. Trước nay nó luôn là tiếng Anh; với một đội không làm việc bằng tiếng Anh thì đó là câu trả lời sai mà lại được đưa ra rất tự tin. Nó không bỏ đánh dấu được bên dưới, bởi vì mọi thứ đều lùi về nó.',
        'labels' => 'Mỗi ngôn ngữ được gọi là gì',
        'labels_helper' => 'Cái tên mà người đọc và người quản trị thấy trong các ô chọn. Để trống một cái thì giữ cái tên plugin này vốn biết. Một ngôn ngữ được tải lên dưới một cái tên của riêng bạn thì không có tên nào cả, nên nó sẽ được liệt kê bằng mã của nó cho tới khi bạn đặt tên ở đây.',
        'labels_code' => 'Mã',
        'labels_name' => 'Hiện là',
        'download' => 'Tải về một tệp dịch',
        'download_from' => 'Bắt đầu từ',
        'download_from_helper' => 'Một tệp JSON chứa mọi chuỗi plugin này có. Hãy chọn tiếng Anh cho một ngôn ngữ chưa ai bắt đầu, hoặc một ngôn ngữ đã có để làm tiếp phần đã dịch.',
        'code' => 'Mã ngôn ngữ',
        'code_helper' => 'Cái mã mà tệp này dành cho. Một locale thật như tài khoản dùng — fr, de, pt_BR — sẽ tới được những người đọc có tài khoản đặt thứ tiếng đó, và phải khớp chính xác thì mới tới. Một cái tên của riêng bạn, chẳng hạn Gaming-NL, cũng được phép nhưng hoạt động khác: Pelican chỉ cho một tài khoản giữ một locale thật, nên không ai chọn được cái của bạn. Nó với tới được qua mục Ngôn ngữ chính bên trên, tức là thứ mọi người nhận khi tiếng của chính họ không dùng được.',
        'url' => 'Hoặc lấy nó về từ một địa chỉ',
        'url_helper' => 'Một địa chỉ https mà bảng điều khiển với tới được — một CDN, một bucket, một tệp thô trên một kho mã. Nó được lấy về một lần lúc bạn lưu và được ghi y như một lần tải lên, nên đổi tệp ở địa chỉ đó về sau cũng chẳng thay đổi gì cho tới khi bạn lưu lại. Một tệp chọn ở trên sẽ thắng một địa chỉ bỏ quên trong ô này.',
        'upload' => 'Tải lên một tệp dịch',
        'upload_helper' => 'Cái JSON ở trên, với phần giá trị đã dịch. Nó được ghi ra ngoài plugin, nên một lần cập nhật sẽ không vứt nó đi, và nó được trộn đè lên tiếng Anh theo từng khóa — một tệp có một nửa số chuỗi sẽ cho bạn một nửa ngôn ngữ và tiếng Anh cho phần còn lại.',
        'uploaded' => 'Đã cài :count chuỗi cho :code',
        'uploaded_halves' => 'Trong đó :mine là chuỗi của chính plugin này và :panel là của bảng điều khiển. Số không ở một bên nghĩa là nửa đó của tệp chẳng chứa gì — khóa của plugin bắt đầu bằng essentials:: còn khóa của bảng điều khiển thì không.',
        'uploaded_skipped' => 'Đã bỏ qua :count: rỗng, hoặc là những khóa plugin này không có. Vài cái đầu: :keys',
        'upload_failed' => 'Không đọc được tệp đó',
        'upload_failed_body' => 'Nó phải là cái JSON tải về ở trên — một đối tượng phẳng gồm khóa và chuỗi. Hãy kiểm tra xem một trình soạn thảo có lưu nó thành thứ khác không.',
    ],

    'windows' => [
        'add' => 'Thêm một khung giờ',
        'from' => 'Từ',
        'to' => 'Đến',
        'to_helper' => 'Sớm hơn giờ bắt đầu nghĩa là nó vắt qua nửa đêm — 22:00 đến 06:00 là ban đêm.',
        'preset' => 'Kiểu dáng',
        'days' => 'Ngày',
        'days_helper' => 'Để trống hết là mọi ngày. Một khung giờ vắt qua nửa đêm thuộc về cái ngày nó bắt đầu, nên thứ Sáu 22:00 đến 06:00 phủ cả sáng thứ Bảy.',
        'day_mon' => 'Thứ Hai',
        'day_tue' => 'Thứ Ba',
        'day_wed' => 'Thứ Tư',
        'day_thu' => 'Thứ Năm',
        'day_fri' => 'Thứ Sáu',
        'day_sat' => 'Thứ Bảy',
        'day_sun' => 'Chủ Nhật',
    ],

    'arranger' => [
        'label' => 'Trình sắp xếp trang',
        'helper' => 'Cái nút Sắp xếp trang, trên mọi trang của bảng điều khiển. Ai giữ quyền Sắp xếp đều có nó và còn đặt được cách sắp xếp mà mọi người khác bắt đầu từ đó, hoặc một cách cho một vai trò. Tắt thì giấu nó với tất cả mọi người; những cách sắp xếp đã lưu thì vẫn nguyên.',
        'roles' => 'Một cách sắp xếp không phải là một quyền. Một khối mà một vai trò giấu đi vẫn là một khối người ta với tới được bằng cách gõ địa chỉ — thứ chặn chuyện đó là chính hệ quyền của Pelican, ở trang vai trò. Ba lớp áp dụng theo thứ tự này: cái mà mọi người bắt đầu từ đó, rồi vai trò của người đọc, rồi bất cứ thứ gì họ tự dời đi.',
        'users' => 'Cho mọi người tự sắp xếp trang của mình',
        'users_helper' => 'Bật, ai đã đăng nhập cũng sắp xếp lại và giấu được các khối trên những trang họ vốn đã thấy, và chỉ cho riêng họ — nó không đổi gì với người khác. Việc đặt cách sắp xếp mà mọi người bắt đầu từ đó thì vẫn thuộc về quyền Sắp xếp.',
    ],

    'brand' => [
        'logo_height' => 'Chiều cao logo',
        'logo_height_helper' => 'Pelican giao tới 2rem. Giá trị lớn hơn sẽ làm phần đầu thanh bên cao lên theo.',
        'logo_url' => 'Đè logo',
        'logo_url_helper' => 'Để trống để giữ bất cứ thứ gì cài đặt của chính Pelican đang trỏ tới.',
    ],

    'login' => [
        'image' => 'Ảnh nền',
        'image_helper' => 'Chỉ dành cho màn hình đăng nhập. Không có ảnh thì nó vẫn hiện nền của bảng điều khiển.',
        'url' => 'Hoặc một địa chỉ',
        'blur' => 'Làm mờ thẻ',
        'blur_helper' => 'Phủ kính mờ lên cái thẻ để bức ảnh phía sau hiện xuyên qua.',
        'width' => 'Bề ngang thẻ',
        'position' => 'Vị trí bức ảnh',
        'position_helper' => 'Phần nào của bức ảnh sống sót sau khi bị cắt cho vừa màn hình.',
        'position_center' => 'Giữa',
        'position_top' => 'Trên',
        'position_bottom' => 'Dưới',
        'position_left' => 'Trái',
        'position_right' => 'Phải',
        'align' => 'Vị trí thẻ',
        'align_helper' => 'Cái thẻ đăng nhập nằm ở đâu theo bề ngang màn hình.',
        'align_center' => 'Giữa',
        'align_start' => 'Trái',
        'align_end' => 'Phải',
        'opacity' => 'Độ đặc của thẻ',
        'opacity_helper' => 'Thấp hơn thì bức ảnh lọt qua cái thẻ nhiều hơn.',
        'glow' => 'Quầng sáng màu nhấn',
        'glow_helper' => 'Cái vầng sáng quanh thẻ. Tắt thì nó vẫn giữ mép và chiều sâu của mình.',
        'hide_heading' => 'Giấu tiêu đề',
        'hide_heading_helper' => 'Bỏ cái tiêu đề phía trên biểu mẫu đi, để lại một mình biểu mẫu.',
        'hide_footer' => 'Giấu chân trang',
        'hide_footer_helper' => 'Bỏ cái dòng dưới thẻ có liên kết tới pelican.dev.',
        'above' => 'Dòng phía trên biểu mẫu',
        'above_helper' => 'Một dòng, hiện với mọi người tới được màn hình đăng nhập. Để trống thì không có gì.',
        'notice' => 'Lời nhắn dưới thẻ',
        'notice_helper' => 'Một dòng, hiện với mọi người tới được màn hình đăng nhập. Để trống thì không có gì.',
    ],

    'advanced' => [
        'css' => 'CSS riêng',
        'css_helper' => 'Tối đa 100 KB. Lưu vào storage, không vào .env.',
        'reference' => 'Tra cứu CSS',
        'reference_helper' => 'Mọi biến và mọi lớp mà giao diện này và bảng điều khiển đưa ra.',
    ],

    'areas' => [
        'add' => 'Thêm một khu vực',
        'area' => 'Khu vực',
        'inherit' => 'Chung',
        'radius' => 'Góc',
        'radius_sharp' => 'Sắc',
        'radius_normal' => 'Thường',
        'radius_round' => 'Tròn',
        'surface' => 'Màu mặt nền',
        'surface_helper' => 'Các thẻ và khung bên trong khu vực này; những sắc sáng hơn và tối hơn đều được suy ra từ nó.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Bảng điều khiển lệnh (phần còn lại của trang)',
            'files' => 'Trang tệp',
            'edit' => 'Trang sửa',
            'server' => 'Các trang và mục khác trong máy chủ',
        ],
    ],

    'bars' => [
        'base' => 'Màu gốc',
        'base_green' => 'Xanh lá',
        'base_accent' => 'Màu nhấn',
        'warning' => 'Chuyển hổ phách từ',
        'danger' => 'Chuyển đỏ từ',
    ],

    'icons' => [
        'stroke' => 'Độ dày nét',
        'stroke_thin' => 'Mảnh',
        'stroke_normal' => 'Thường',
        'stroke_bold' => 'Đậm',
        'scale' => 'Cỡ',
        'accent' => 'Biểu tượng menu theo màu nhấn',
        'accent_helper' => 'Áp dụng cho các biểu tượng trong thanh bên và topbar.',
        'pack' => 'Bộ biểu tượng',
        'pack_helper' => 'Ô chọn bên dưới lấy từ bộ nào. Mọi bộ biểu tượng đã cài trên máy chủ đều được đưa ra, cộng thêm bộ Essentials đi kèm plugin này và bất kỳ bộ nào bạn tải lên. Có một khác biệt đáng biết: một biểu tượng dạng nét được vẽ bằng màu của menu và đi theo lúc rê chuột lẫn dòng đang chọn, còn các biểu tượng Essentials là hình ảnh và giữ màu của riêng chúng. Điều đó do tệp là loại gì quyết định, chứ không phải do nó đến từ bộ nào.',
        'pack_custom' => 'Bộ đã tải lên',
        'pack_shipped' => 'Biểu tượng Essentials',
        'use_shipped' => 'Dùng biểu tượng Essentials ở khắp nơi',
        'use_shipped_confirm' => 'Đặt bộ thành Biểu tượng Essentials và điền vào mọi dòng menu bên dưới cái biểu tượng được vẽ cho nó — console nhận cái terminal, startup nhận cái nút phóng, và cứ thế. Nó thay thế những dòng bạn đang có, và không có gì được lưu cho tới khi bạn bấm Lưu, nên đóng trang lại là hoàn tác.',
        'pack_upload' => 'Tải lên một bộ',
        'pack_upload_helper' => 'Một tệp .zip chứa các tệp SVG. Mỗi tệp thành một biểu tượng mang tên nó — logo.svg thành custom-logo. Tải lên sẽ thay thế bộ đang có. Tệp lớn hơn 256 KB và mọi thứ vượt quá 4.000 biểu tượng đều bị bỏ ra, và bạn sẽ được cho biết là bao nhiêu: để dễ hình dung, cả bộ Tabler gần sáu nghìn biểu tượng trong khoảng ba megabyte, nên một bộ lớn hơn thế nhiều là đang mang theo thứ khác chứ không phải biểu tượng, và phần lớn sẽ bị bỏ qua. Một lần tải lên lớn cũng có thể bị từ chối trước cả khi ô này kịp nói gì, bởi upload_max_filesize và post_max_size trong php.ini trên máy của bảng điều khiển — không cài đặt nào ở đây nâng được hai cái đó.',
        'pack_partial' => 'Đã cài :count biểu tượng, nhưng không phải tất cả',
        'pack_partial_body' => 'Bỏ qua: :big quá lớn cho một biểu tượng, :unusable không dùng được như SVG, :duplicate trùng tên với cái đã có, :empty chẳng còn gì để vẽ sau khi dọn dẹp. Một tệp SVG hơn 256 KB gần như luôn là một bức ảnh bọc trong đó chứ không phải một hình vẽ — hãy xuất nó ở cỡ biểu tượng và nó sẽ chỉ còn vài kilobyte. Một biểu tượng chẳng còn gì để vẽ thì chỉ chứa thứ mà cái này không phục vụ — nếu cả một bộ như thế thì đáng báo lại.',
        'pack_stopped_files' => 'Nó cũng đã dừng ở giới hạn số biểu tượng một bộ được phép chứa.',
        'pack_stopped_size' => 'Nó cũng dừng vì phần còn lại của bộ giải nén ra thì lớn hơn mức bảng điều khiển giữ được trong bộ nhớ cùng lúc — tệp zip có thể nhỏ hơn thế, vì SVG nén được khoảng năm lần.',
        'overrides' => 'Thay biểu tượng',
        'overrides_helper' => 'Mỗi biểu tượng bạn muốn đổi một dòng. Chọn mục menu, rồi chọn một biểu tượng từ bộ ở trên, đưa một địa chỉ, hoặc tải lên một bức ảnh của riêng bạn. Nếu điền hơn một chỗ thì ảnh tải lên thắng, rồi tới địa chỉ, rồi tới bộ.',
        'overrides_key' => 'Mục menu',
        'overrides_value' => 'Biểu tượng từ bộ',
        'overrides_url' => 'Hoặc một địa chỉ',
        'overrides_url_helper' => 'Một địa chỉ https cho một bức ảnh bạn tự lưu trữ — một CDN, một bucket, bất cứ đâu trình duyệt với tới được. Không có gì được chép về bảng điều khiển, nên thay tệp ở địa chỉ đó là đổi biểu tượng mà không phải động tới trang này; mặt kia của chuyện đó là một biểu tượng biến mất khi cái địa chỉ biến mất. Nó giữ màu của riêng nó, như một bức ảnh tải lên.',
        'overrides_file' => 'Hoặc tải lên một bức ảnh',
        /*
         * Nói rõ khác biệt thật sự nằm ở đâu, bởi vì nó không hiển nhiên và đó
         * chính là lý do người ta chọn cái này thay vì cái kia.
         */
        'overrides_file_helper' => 'PNG, SVG hoặc ICO. Một biểu tượng từ bộ được vẽ bằng chính màu của menu và đi theo lúc rê chuột lẫn dòng đang chọn; một bức ảnh tải lên thì giữ màu của riêng nó và không đi theo. Với một cái logo thì đó thường là điều bạn muốn.',
        'overrides_add' => 'Thay một biểu tượng nữa',
        'overrides_search' => 'Gõ một cái tên, hoặc mục menu…',
    ],

    /*
     * Không nằm dưới mục thương hiệu. Thương hiệu là chuyện bảng điều khiển
     * trông ra sao; cái này là chuyện plugin này xuất hiện trong đó ra sao, mà
     * đó là một câu hỏi khác và được trả lời trên một trang khác.
     */
    'identity' => [
        'nav_icon' => 'Biểu tượng cho dòng cài đặt Essentials',
        'nav_icon_helper' => 'PNG, SVG hoặc ICO, tối đa 8 MB. Thay biểu tượng trên đúng một dòng đó trong thanh bên; để trống thì dùng cái plugin này đi kèm. Nó được vẽ như một bức ảnh chứ không như một biểu tượng, nên nó giữ màu của riêng nó thay vì đi theo màu chữ — mà đó thường là điều một cái logo muốn. Tệp được phục vụ chứ không nhúng vào, nên mỗi trình duyệt lấy nó một lần, nhưng vẫn đáng để xuất ra một tệp nhỏ: vài kilobyte là quá đủ cho một dòng cao hai mươi điểm ảnh. Nếu một lần tải lên hỏng trước cả khi ô này kịp nói gì thì cái giới hạn nó chạm phải là upload_max_filesize trong php.ini của bảng điều khiển.',
    ],
];
