<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Bakiye, iadeler ve iade faturaları.
 *
 * Aşağıda iki sözcük bilerek birbirinden ayrı tutulur.
 *
 * "Bakiye", mağazanın biri adına elinde tuttuğu paradır. Ödemesi istenmeden
 * önce, kendiliğinden bir sonraki faturasından düşülür.
 *
 * "İade", parayı geri verme eylemidir ve gidebileceği iki yer vardır: geldiği
 * karta ya da bakiye olarak buradaki hesaba. Sözler her zaman hangisi olduğunu
 * söyler; çünkü "paranız iade edildi" denip sonra bankasında hiçbir şey
 * bulamayan müşteri yazar, haklı olarak da yazar.
 *
 * "İade faturası" ise belgedir. İki durumda da yazılır, çünkü o belge paranın
 * artık mağazaya borç olmadığının kaydıdır - nereye gittiğine dair bir iddia
 * değil.
 */

return [
    // ---- müşterinin gördüğü ----------------------------------------------
    'yours' => 'Bakiyeniz',
    'yours_body' => 'Bu, bir sonraki faturanızdan kendiliğinden düşülür. Onunla bir şey yapmanız gerekmez.',
    'applied' => 'Bakiyenizden ödendi',
    'payable' => 'Kalan ödeme',

    // ---- müşteri penceresindeki defter -----------------------------------
    'held' => 'Bakiye',
    'none_held' => 'Hesapta bir şey yok',
    'movements' => 'Bakiye',
    'column' => 'Bakiye',
    'none' => 'Yok',

    // ---- bakiye vermek ---------------------------------------------------
    'give' => 'Bakiye',
    'give_helper' => 'Bu hesapta :held var. Buraya koyduğunuz, bir sonraki faturasından kendiliğinden düşülür. Eksi bir tutar bakiyeyi geri alır ve iki hareket de geçmişte durur.',
    'amount' => 'Tutar',
    'amount_helper' => 'Eksi bir tutar bakiye vermek yerine bakiyeyi geri alır.',
    'reason' => 'Neden',
    'reason_helper' => 'Müşteri bunu tutarın yanında görür, o yüzden dosya için değil onun için yazın.',
    'given' => ':who için :amount bakiye',
    'bad_amount' => 'Bu bir tutar değil.',
    'give_failed' => 'Bakiye verilmedi',
    'give_failed_body' => 'Hiçbir şey yazılmadı. Yeniden deneyin ve sürerse günlüğe bakın.',
    'take_failed' => 'Bakiye geri alınmadı',
    'take_failed_body' => 'Hesapta, almak istediğinizden daha azı var. Bir bakiye hiçbir zaman sıfırın altına indirilmez.',

    // ---- bir hareketin söylediği -----------------------------------------
    'spent_on' => ':number numaralı fatura',
    'returned' => 'Geri kondu: karşılığındaki fatura yazılamadı',
    'note_line' => ':number numaralı fatura için iade faturası',
    'refund_description' => ':number numaralı faturanın iadesi',

    // ---- geri vermek -----------------------------------------------------
    'refund' => 'İade et',
    'refund_helper' => 'Bu faturanın :left tutarı henüz geri verilmedi. Her durumda bir iade faturası yazılır, böylece iki tarafta da kaydı olur.',
    'refund_amount_helper' => 'Bir kısmı da olur. Kalanı sonra geri verilebilir.',
    'refund_reason_helper' => 'Bu, müşterinin açabildiği iade faturasına basılır.',
    'where' => 'Para nereye gidiyor',
    'where_provider' => 'Ödedikleri yere geri',
    'where_provider_helper' => 'Sağlayıcı parayı geldiği karta ya da hesaba gönderir. Görünmesi birkaç gün sürebilir ve reddedebilirler - eski bir ödeme ya da geri döndürülemeyen bir yöntem.',
    'where_balance' => 'Buradaki hesaplarına',
    'where_balance_helper' => 'Bakiyeye dönüşür ve bir sonraki faturalarından düşülür. Bankadan hiçbir şey çıkmaz ve başarısız olamaz.',
    'refunded' => ':amount iade edildi',
    'refunded_body' => 'Bunun için :number numaralı iade faturası yazıldı.',
    'refund_failed' => 'Hiçbir şey iade edilmedi',

    // ---- ve neden olmadığı, her seferinde tek bir neden ------------------
    'refused_off' => 'Bakiye ve iadeler bu panelde kapalı.',
    'refused_amount' => 'Bu, bu faturadan kalandan fazla.',
    'refused_no_payment' => 'Bu faturadaki hiçbir ödemede o kadarı kalmamış, yani bir sağlayıcının geri döndüreceği bir şey yok. Bunun yerine hesabına koyun.',
    'refused_no_gateway' => 'Bunun ödendiği sağlayıcı artık açık değil, bu yüzden ondan bir şeyi geri döndürmesi istenemez. Bunun yerine hesabına koyun.',
    'refused_refused' => 'Sağlayıcı reddetti. Bu genelde eski bir ödeme ya da geri döndürülemeyen bir yöntemdir; verdikleri neden günlükte. Bunun yerine hesabına koyun.',
    'refused_note_failed' => 'Para taşındı ama iade faturası yazılamadı, bu yüzden hiçbir şey kaydedilmedi. Yeniden denemeden önce günlüğe bakın.',

    // ---- hesaba para koymak ----------------------------------------------
    'topup' => 'Bakiye yükle',
    'topup_helper' => 'Hesabınızda :held var. Buraya eklediğiniz, bir sonraki faturanızdan kendiliğinden düşülür; açık duran bir faturanız varsa para gelir gelmez ondan kapatılır.',
    'topup_go' => 'Ödemeye geç',
    'topup_amount_helper' => ':least ile :most arasında.',
    'topup_bad' => 'Bu tutar ödenemez',
    'topup_failed' => 'Ödeme başlatılamadı. Yeniden deneyin ve sürerse bu paneli işleten kişiye söyleyin.',
    'topup_line' => 'Hesaba bakiye eklendi',
    'topup_reason' => ':number numaralı faturayla eklendi',

    // ---- nerede gösterildiği ---------------------------------------------
    'menu' => ':amount bakiye',
    'held_helper' => 'Bir sonraki faturanızdan kendiliğinden düşülür. Faturalar sayfasından yükleyebilirsiniz.',
];
