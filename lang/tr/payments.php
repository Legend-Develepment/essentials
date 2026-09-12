<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Ödemeler: her ödeme denemesi ve sağlayıcının onun hakkında söyledikleri.
 *
 * Fatura başına değil, deneme başına bir satır; çünkü olan buydu. Bu sayfanın
 * tekrarladığı sözcük „deneme"dir: başarısız bir ödeme, saklanmayı hak eden bir
 * olgudur, gizlenecek bir hata değil.
 */

return [
    'title' => 'Ödemeler',
    'nav_label' => 'Ödemeler',
    'subheading' => 'Her sağlayıcı üzerinden yapılan her ödeme denemesi. Yeniden sor, sağlayıcıya bir kez daha sorar; bu, webhookları geldiğinde yaptığının aynısıdır.',

    // ---- tablo -----------------------------------------------------------
    'column_invoice' => 'Fatura',
    'column_gateway' => 'Sağlayıcı',
    'column_reference' => 'Onların referansı',
    'column_amount' => 'Tutar',
    'column_state' => 'Durum',
    'column_updated' => 'Son haber',

    'gone_invoice' => 'Fatura silindi',

    'state_open' => 'Bekliyor',
    'state_paid' => 'Ödendi',
    'state_failed' => 'Başarısız',
    'state_cancelled' => 'Yarıda kaldı',

    // ---- düğmeler --------------------------------------------------------
    'recheck' => 'Yeniden sor',
    'rechecked' => 'Yeniden soruldu',
    'rechecked_body' => 'Sağlayıcı hâlâ ödendiğini söylemiyor. Hiçbir şey değişmedi.',
    'settled' => 'Ödenmiş',
    'settled_body' => 'Fatura kapandı ve onu bekleyen her şey yolda.',
    'recheck_failed' => 'Sorulamadı',
    'recheck_failed_body' => 'Sağlayıcı yanıt vermedi. Bir dakika sonra yeniden deneyin; sürerse Mağaza ayarları sayfasındaki anahtarı kontrol edin.',
    'no_gateway' => 'O sağlayıcı kapalı',
    'no_gateway_body' => 'Bu ödemeyi sorabilmek için yeniden açın, ya da faturayı elle ödendi olarak işaretleyin.',

    'answer' => 'Onların yanıtı',
    'no_answer' => 'Kayda geçmiş bir şey yok',
    'close' => 'Kapat',

    'empty' => 'Henüz kimse bir sağlayıcı üzerinden ödeme yapmadı',
    'empty_body' => 'Denemeler, biri Öde düğmesine bastığı anda burada belirir; tamamlansın ya da tamamlanmasın.',
];
