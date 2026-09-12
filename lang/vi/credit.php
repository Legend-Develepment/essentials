<?php

/*
 * Tiếng Việt. Viết bằng tay.
 *
 * Số dư, hoàn tiền và phiếu ghi có.
 *
 * Hai chữ được giữ tách bạch khắp nơi bên dưới, và đó là cố ý.
 *
 * "Số dư" là tiền cửa hàng đang giữ hộ ai đó. Nó tự trừ vào hóa đơn kế tiếp
 * của họ, trước cả khi có ai hỏi họ trả tiền.
 *
 * "Hoàn tiền" là hành động trả tiền lại, và nó có hai chỗ để đi: về lại thẻ đã
 * trả, hoặc vào tài khoản ở đây dưới dạng số dư. Chữ ở đây luôn nói rõ là chỗ
 * nào, bởi vì một người khách được báo "đã hoàn tiền cho bạn" rồi không thấy gì
 * trong ngân hàng sẽ viết thư hỏi, mà hỏi là đúng.
 *
 * "Phiếu ghi có" là tờ giấy. Đằng nào cũng viết một tờ, bởi nó là dấu vết cho
 * việc khoản tiền ấy không còn là nợ với cửa hàng nữa - chứ không phải một lời
 * khẳng định nó đã đi đâu.
 */

return [
    // ---- những gì khách nhìn thấy ----------------------------------------
    'yours' => 'Số dư của bạn',
    'yours_body' => 'Cái này tự trừ vào hóa đơn kế tiếp của bạn. Bạn không phải làm gì với nó cả.',
    'applied' => 'Đã trả từ số dư của bạn',
    'payable' => 'Còn phải trả',

    // ---- sổ cái, trong cửa sổ khách hàng ---------------------------------
    'held' => 'Số dư',
    'none_held' => 'Không có gì trong tài khoản',
    'movements' => 'Số dư',
    'column' => 'Số dư',
    'none' => 'Không có',

    // ---- cộng số dư ------------------------------------------------------
    'give' => 'Số dư',
    'give_helper' => 'Tài khoản này đang giữ :held. Những gì bạn cộng vào sẽ tự trừ vào hóa đơn kế tiếp của họ. Một số tiền âm sẽ trừ bớt số dư đi, và cả hai chiều đều nằm lại trong lịch sử.',
    'amount' => 'Số tiền',
    'amount_helper' => 'Một số tiền âm sẽ lấy số dư đi thay vì cộng thêm.',
    'reason' => 'Lý do',
    'reason_helper' => 'Khách nhìn thấy dòng này ngay cạnh số tiền, nên hãy viết cho họ đọc chứ đừng viết cho hồ sơ.',
    'given' => ':amount số dư cho :who',
    'bad_amount' => 'Đó không phải là một số tiền.',
    'give_failed' => 'Số dư chưa được cộng',
    'give_failed_body' => 'Không có gì được ghi lại. Hãy thử lại, và xem nhật ký nếu chuyện cứ lặp lại.',
    'take_failed' => 'Số dư chưa được trừ',
    'take_failed_body' => 'Trong tài khoản còn ít hơn số bạn muốn lấy đi. Số dư không bao giờ bị kéo xuống dưới không.',

    // ---- một dòng biến động nói gì ---------------------------------------
    'spent_on' => 'Hóa đơn :number',
    'returned' => 'Trả lại: hóa đơn mà nó dành cho đã không viết được',
    'note_line' => 'Phiếu ghi có cho hóa đơn :number',
    'refund_description' => 'Hoàn tiền hóa đơn :number',

    // ---- trả lại ---------------------------------------------------------
    'refund' => 'Hoàn tiền',
    'refund_helper' => 'Hóa đơn này còn :left chưa được trả lại. Đằng nào cũng có một phiếu ghi có được viết, để cả hai bên đều có dấu vết.',
    'refund_amount_helper' => 'Trả lại một phần cũng được. Phần còn lại có thể trả sau.',
    'refund_reason_helper' => 'Dòng này được in trên phiếu ghi có mà khách mở ra xem được.',
    'where' => 'Tiền đi về đâu',
    'where_provider' => 'Về lại chỗ họ đã trả',
    'where_provider_helper' => 'Nhà cung cấp gửi nó về lại thẻ hay tài khoản mà nó đến từ đó. Có thể mất vài ngày mới thấy, và họ có quyền từ chối - một khoản trả đã lâu, hoặc một cách trả không đảo ngược được.',
    'where_balance' => 'Vào tài khoản của họ ở đây',
    'where_balance_helper' => 'Nó trở thành số dư và tự trừ vào hóa đơn kế tiếp của họ. Không có gì rời khỏi ngân hàng, và nó không thể hỏng.',
    'refunded' => 'Đã hoàn :amount',
    'refunded_body' => 'Phiếu ghi có :number đã được viết cho khoản này.',
    'refund_failed' => 'Không hoàn được đồng nào',

    // ---- và vì sao không, mỗi lần một lý do ------------------------------
    'refused_off' => 'Bảng điều khiển này đã tắt số dư và hoàn tiền.',
    'refused_amount' => 'Số đó nhiều hơn phần còn lại của hóa đơn này.',
    'refused_no_payment' => 'Không có khoản trả nào trên hóa đơn này còn lại nhiều đến thế, nên nhà cung cấp chẳng có gì để đảo ngược. Hãy cộng vào tài khoản của họ thay vì vậy.',
    'refused_no_gateway' => 'Nhà cung cấp mà khoản này đã trả qua giờ không còn được bật, nên không nhờ họ đảo ngược gì được. Hãy cộng vào tài khoản của họ thay vì vậy.',
    'refused_refused' => 'Nhà cung cấp từ chối. Thường là vì khoản trả đã lâu hoặc cách trả không đảo ngược được; lý do họ đưa ra nằm trong nhật ký. Hãy cộng vào tài khoản của họ thay vì vậy.',
    'refused_note_failed' => 'Tiền đã chuyển nhưng phiếu ghi có không viết được, nên không có gì được ghi lại. Hãy xem nhật ký trước khi thử lại.',

    // ---- nạp tiền vào ----------------------------------------------------
    'topup' => 'Nạp số dư',
    'topup_helper' => 'Bạn đang có :held trong tài khoản. Những gì bạn nạp ở đây sẽ tự trừ vào hóa đơn kế tiếp, còn hóa đơn nào bạn đang để mở thì được thanh toán từ nó ngay khi tiền tới.',
    'topup_go' => 'Sang bước thanh toán',
    'topup_amount_helper' => 'Từ :least đến :most.',
    'topup_bad' => 'Số tiền đó không trả được',
    'topup_failed' => 'Không bắt đầu được lần thanh toán. Hãy thử lại, và báo cho người quản lý bảng điều khiển này nếu chuyện cứ lặp lại.',
    'topup_line' => 'Nạp số dư vào tài khoản',
    'topup_reason' => 'Đã nạp trên hóa đơn :number',

    // ---- chỗ nó được hiện ra ---------------------------------------------
    'menu' => ':amount số dư',
    'held_helper' => 'Tự trừ vào hóa đơn kế tiếp của bạn. Nạp thêm ở trang hóa đơn.',
];
