<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Cài đặt cửa hàng, và về sau là chính cửa hàng.
 *
 * Hai người đọc dùng chung tệp này một cách có chủ ý. Nửa cài đặt là do quản
 * trị viên đọc; nửa công khai và nửa dành cho khách - được thêm vào khi cửa
 * hàng lớn dần - do những người có thể chưa từng nghe tới Pelican đọc, và mọi
 * câu ở đó phải được viết cho họ.
 */

return [
    'title' => 'Cài đặt cửa hàng',
    'nav_label' => 'Cài đặt cửa hàng',
    'subheading' => 'Đơn vị tiền, thuế, cách đánh số hóa đơn và những gì trang công khai nói. Còn thứ được bán thì nằm ở trang Gói.',

    // ---- ở đâu -----------------------------------------------------------
    'address' => 'Cửa hàng công khai nằm ở',
    'address_off' => 'Trang công khai đang tắt. Hãy bật "Trang cửa hàng công khai" trong danh sách tính năng ở trang Cài đặt Essentials thì trang sẽ trả lời tại :url.',

    // ---- chung -----------------------------------------------------------
    'section_general' => 'Tiền',
    'section_general_helper' => 'Một đơn vị tiền cho cả cửa hàng. Mọi giá của mọi gói đều là một con số theo đơn vị ấy.',
    'currency' => 'Đơn vị tiền',
    'currency_helper' => 'Đổi đơn vị không quy đổi lại thứ gì: giá các gói là những con số, và sau khi đổi chúng là những con số theo đơn vị mới.',
    'tax' => 'Thuế',
    'tax_helper' => 'Phần trăm được cộng vào mỗi hóa đơn thành một dòng riêng. Giá các gói là giá chưa thuế. Số không là không thu.',
    'tax_suffix' => '%',
    'prefix' => 'Số hóa đơn bắt đầu bằng',
    'prefix_helper' => 'Theo sau là một số tăng dần. INV- cho ra INV-000001.',

    // ---- gia hạn ---------------------------------------------------------
    'section_renewals' => 'Gia hạn',
    'section_renewals_helper' => 'Dành cho các gói tính tiền theo tháng, theo quý hoặc theo năm. Gói một lần không bao giờ bị đụng tới.',
    'notice_days' => 'Xuất hóa đơn trước khi hết kỳ bấy nhiêu ngày',
    'notice_days_helper' => 'Thời điểm hóa đơn kế tiếp được tạo và khách được báo.',
    'grace' => 'Dừng máy chủ sau hạn thanh toán bấy nhiêu ngày',
    'grace_helper' => 'Hóa đơn chưa trả quá mốc này sẽ dừng máy chủ — bằng chính cơ chế tạm ngưng của Pelican, được gỡ ngay khi hóa đơn được trả. Việc tạm ngưng tự nó không xóa gì cả.',
    'days' => 'ngày',

    // ---- trang công khai -------------------------------------------------
    'section_public' => 'Trang công khai',
    'section_public_helper' => 'Người không có tài khoản cũng đọc được. Trang có hiện ra hay không là do công tắc "Trang cửa hàng công khai" trong danh sách tính năng quyết định.',
    'heading' => 'Tiêu đề',
    'heading_helper' => 'Để trống thì lấy tên của chính bảng điều khiển.',
    'note' => 'Dòng phía trên các gói',
    'note_helper' => 'Để nói bạn là ai hoặc mua thì được gì. Văn bản thuần.',
    'terms_url' => 'Điều khoản',
    'terms_url_helper' => 'Địa chỉ https. Nếu có đặt, mua hàng đồng nghĩa với việc đánh dấu vào ô trỏ tới đó.',

    // ---- trả tiền thủ công -----------------------------------------------
    'section_manual' => 'Thanh toán khi chưa có nhà cung cấp',
    'section_manual_helper' => 'Hiện trên hóa đơn chưa trả khi chưa bật nhà cung cấp thanh toán nào: thông tin ngân hàng hoặc nơi gửi tiền tới. Văn bản thuần.',
    'pay_note' => 'Cách thanh toán',
    'pay_note_helper' => 'Để trống thì hóa đơn chưa trả chỉ nói rằng nó chưa được trả.',

    // ---- các nút ---------------------------------------------------------
    'save' => 'Lưu',
    'saved' => 'Đã lưu',
    'save_failed' => 'Không có gì được lưu',

    /* ---------------------------------------------------------------------
     * Chính cửa hàng, từ đây trở xuống.
     *
     * Một người đọc hoàn toàn khác: người mua máy chủ, có thể chưa từng nghe
     * tới Pelican và không biết egg là gì. Không có gì bên dưới dùng chữ của
     * bảng điều khiển, và mỗi câu trả lời đúng câu hỏi mà khách thật sự có ở
     * chỗ đó trên trang.
     * ------------------------------------------------------------------- */

    // ---- cửa hàng --------------------------------------------------------
    'store_title' => 'Cửa hàng',
    'store_nav_label' => 'Cửa hàng',
    'store_subheading' => 'Chọn một máy chủ. Nó được tạo cho bạn ngay khi hóa đơn được trả.',
    'store_empty' => 'Hiện chưa bán gì cả',
    'store_empty_body' => 'Ghé lại sau, hoặc hỏi người trông bảng điều khiển này.',

    'buy' => 'Mua',
    'sold_out' => 'Hết hàng',
    'plus_setup' => 'cộng :amount một lần',

    'spec_memory' => 'Bộ nhớ :amount MiB',
    'spec_disk' => 'Ổ đĩa :amount MiB',
    'spec_cpu' => 'CPU :amount%',
    'spec_backups' => ':count bản sao lưu',
    'spec_databases' => ':count cơ sở dữ liệu',

    // ---- trang công khai -------------------------------------------------
    'public_empty' => 'Hiện chưa bán gì cả',
    'public_empty_body' => 'Ghé lại sau.',
    'to_panel' => 'Đăng nhập',
    'terms' => 'Điều khoản',
    'sign_in_note' => 'Chọn một máy chủ bên dưới. Bạn đăng nhập để hoàn tất, và máy được tạo khi hóa đơn đã trả.',

    // ---- đặt hàng --------------------------------------------------------
    'checkout_title' => 'Đặt hàng',
    'tax_line' => 'Thuế (:rate%)',
    'coupon' => 'Mã giảm giá',
    'coupon_placeholder' => 'Nếu bạn có',
    'coupon_bad' => 'Mã đó không dùng được ở đây.',
    'coupon_good' => 'Đã áp dụng mã.',
    'agree' => 'Tôi đồng ý với',
    'place_order' => 'Đặt hàng',
    'place_order_note' => 'Việc này viết ra một hóa đơn. Không thu tiền cho tới khi bạn trả, và máy chủ được tạo khi hóa đơn đã trả.',
    'back_to_store' => 'Về cửa hàng',

    'placed' => 'Đã đặt hàng',
    'placed_body' => 'Hóa đơn :number đang chờ ở trang thanh toán của bạn.',

    'refused' => 'Không mua được thứ này',
    'refused_gone' => 'Thứ này không còn bán nữa.',
    'refused_sold_out' => 'Cái cuối cùng đã đi rồi.',
    'refused_bad_coupon' => 'Mã giảm giá không áp dụng cho thứ này.',
    'refused_failed' => 'Có gì đó trục trặc khi ghi đơn hàng. Không thu khoản nào. Thử lại đi, và báo cho người trông bảng điều khiển nếu còn lặp lại.',

    // ---- thanh toán ------------------------------------------------------
    'billing_title' => 'Thanh toán',
    'billing_nav_label' => 'Thanh toán',
    'billing_subheading' => 'Bạn đã mua gì và còn nợ gì.',
    'your_orders' => 'Đơn hàng của bạn',
    'your_invoices' => 'Hóa đơn của bạn',
    'no_orders' => 'Bạn chưa mua gì cả',
    'no_orders_body' => 'Mọi thứ bạn mua sẽ hiện ở đây cùng máy chủ và các mốc ngày.',
    'no_invoices' => 'Chưa có hóa đơn nào',
    'to_store' => 'Tới cửa hàng',
    'renews' => 'Gia hạn',
    'ask_how_to_pay' => 'Hỏi người trông bảng điều khiển này xem trả tiền thế nào. Họ chưa ghi vào đây.',
    'order_pending' => 'Đang chờ hóa đơn được trả. Ngay sau đó máy chủ sẽ được tạo.',
    'order_suspended' => 'Bị dừng vì hóa đơn chưa trả. Trả nó thì máy chủ chạy lại - không có gì bị xóa.',
    'order_ending' => 'Kết thúc :date. Không viết hóa đơn nữa, và mọi thứ trên đó bị xóa vào ngày ấy.',
    'order_ending_open' => 'Đã hủy. Không viết hóa đơn nữa và vẫn chạy cho tới khi bị gỡ đi.',

    // ---- trả tiền --------------------------------------------------------
    'pay_with' => 'Trả bằng',
    'pay_now' => 'Thanh toán',
    'pay_description' => 'Hóa đơn :number',
    'pay_thanks' => 'Cảm ơn bạn. Hóa đơn đã được trả.',
    'pay_pending' => 'Nhà cung cấp chưa xác nhận. Trang này sẽ cập nhật ngay khi họ xác nhận.',
    'pay_refused' => 'Cái đó không khởi động được',
    'pay_refused_body' => 'Không mở được lần thanh toán. Hãy thử cách khác, hoặc hỏi người trông bảng điều khiển này.',
    'gateway_mollie' => 'Mollie',

    // ---- cài đặt của nhà cung cấp ----------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Nhận iDEAL, thẻ, Bancontact và phần còn lại qua một tài khoản. Thử nghiệm và chạy thật là cùng một cài đặt: chính cái khóa nói nó thuộc tài khoản nào.',
    'mollie_on' => 'Mời dùng Mollie',
    'mollie_on_helper' => 'Tắt thì nút biến khỏi mọi hóa đơn. Cái đã trả vẫn là đã trả.',
    'mollie_key' => 'Khóa API',
    'mollie_key_helper' => 'Lấy ở mục Developers trong bảng Mollie của bạn. Nó không bao giờ được ghi vào tệp cài đặt xuất ra.',
    'mollie_hook' => 'Địa chỉ webhook',
    'mollie_hook_helper' => 'Mollie sẽ báo về :url - bảng điều khiển của bạn phải truy cập được ở đó từ internet.',

    'gateway_stripe' => 'Thẻ',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Nhận thẻ trên một trang do chính Stripe vẽ, nên số thẻ không bao giờ chạm tới bảng điều khiển này. Thử nghiệm và chạy thật nằm ở tiền tố của khóa, không phải ở một công tắc.',
    'stripe_on' => 'Mời dùng Stripe',
    'stripe_on_helper' => 'Tắt thì nút biến khỏi mọi hóa đơn. Cái đã trả vẫn là đã trả.',
    'stripe_key' => 'Khóa bí mật',
    'stripe_key_helper' => 'Khóa bắt đầu bằng sk_, ở mục Developers, API keys. Không bao giờ được ghi vào tệp cài đặt xuất ra.',
    'stripe_hook' => 'Bí mật ký',
    'stripe_hook_key_helper' => 'Giá trị whsec_ mà Stripe hiện ra khi bạn thêm địa chỉ bên dưới. Không có nó thì không thể chứng minh tin nhắn của họ là thật, và chúng bị bỏ qua.',
    'stripe_hook_helper' => 'Thêm :url làm endpoint ở Developers, webhooks, cho sự kiện checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Nhà cung cấp duy nhất mà tiền chuyển khi khách quay lại, chứ không phải lúc họ còn ở PayPal - nên đóng tab sẽ để lại một hóa đơn chưa trả, không phải một khoản tiền thất lạc.',
    'paypal_on' => 'Mời dùng PayPal',
    'paypal_on_helper' => 'Tắt thì nút biến khỏi mọi hóa đơn. Cái đã trả vẫn là đã trả.',
    'paypal_sandbox' => 'Môi trường thử',
    'paypal_sandbox_helper' => 'Nói chuyện với tài khoản thử của PayPal thay vì tài khoản thật. Client id của họ trông giống nhau ở cả hai trường hợp, và đó chính là lý do công tắc này tồn tại.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Từ ứng dụng bạn tạo trong Apps & Credentials. Kiểm tra xem tab có khớp với công tắc bên trên không.',
    'paypal_secret_helper' => 'Cạnh client ID, đằng sau nút Show. Không bao giờ được ghi vào tệp cài đặt xuất ra.',
    'paypal_hook' => 'ID webhook',
    'paypal_hook_id_helper' => 'ID mà PayPal cấp cho webhook sau khi bạn thêm nó, không phải địa chỉ. Không có nó thì không thể nhờ họ kiểm tra tin nhắn, và tin nhắn bị bỏ qua.',
    'paypal_hook_helper' => 'Thêm :url làm webhook trong ứng dụng đó, cho PAYMENT.CAPTURE.COMPLETED, rồi dán ID được cấp vào đây.',

    // ---- trang thanh toán ------------------------------------------------
    'pay_title' => 'Thanh toán',
    'pay_subheading' => 'Bạn còn nợ gì, và những cách để trả.',
    'pay_choose' => 'Bạn muốn trả bằng cách nào?',
    'pay_choose_body' => 'Chọn cách nào cũng vậy, bạn hoàn tất trên trang của họ rồi quay lại đây ngay sau đó.',
    'pay_safe' => 'Để trả tiền, bạn được đưa sang nhà cung cấp. Thông tin thẻ của bạn không bao giờ tới bảng điều khiển này.',
    'pay_no_ways' => 'Ngay khi tiền tới, hóa đơn được đánh dấu đã trả và máy chủ của bạn được dựng.',
    'pay_gone' => 'Không có hóa đơn đó',
    'pay_gone_body' => 'Có thể nó đã bị thu hồi, hoặc địa chỉ sai.',
    'pay_already' => 'Cái này đã trả rồi',
    'pay_already_body' => 'Không còn gì phải làm. Mọi thứ chờ nó đều đã lên đường.',
    'pay_withdrawn' => 'Cái này đã bị thu hồi',
    'pay_withdrawn_body' => 'Nó ra khỏi sổ sách và không cần trả. Nếu thấy lạ, hãy hỏi người trông bảng điều khiển này.',
    'back_to_billing' => 'Về trang thanh toán',

    'gateway_mollie_note' => 'iDEAL, Bancontact, thẻ và nhiều hơn',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Số dư PayPal của bạn, hoặc thẻ qua PayPal',

    // ---- dịch vụ và hóa đơn, tách riêng ----------------------------------
    'services_title' => 'Dịch vụ của tôi',
    'services_nav_label' => 'Dịch vụ của tôi',
    'services_subheading' => 'Những gì bạn đang trả tiền, và máy chủ sinh ra từ mỗi cái.',
    'open_server' => 'Mở máy chủ',
    'no_server_yet' => 'Đang dựng',

    'invoices_title' => 'Hóa đơn',
    'invoices_subheading' => 'Những gì đã tính cho bạn, và những gì còn phải trả.',
    'no_invoices_body' => 'Mọi thứ bạn mua đều được xuất hóa đơn ở đây, và vẫn nằm đây sau khi trả xong.',

    // ---- cửa hàng làm trang đầu ------------------------------------------
    'section_landing' => 'Cửa hàng nằm ở đâu',
    'section_landing_helper' => 'Người đăng nhập sẽ tới cửa hàng hay tới máy chủ của họ.',
    'landing' => 'Mở cửa hàng trước',
    'landing_helper' => 'Bật thì cửa hàng là trang đầu tiên sau khi đăng nhập, còn danh sách máy chủ dời sang bên cạnh. Dịch vụ và hóa đơn của bạn vẫn cách một cú nhấp, ở phần đầu cửa hàng và trong menu tài khoản. Tắt thì không có gì dời đi, và cửa hàng là một trang như mọi trang khác.',
];
