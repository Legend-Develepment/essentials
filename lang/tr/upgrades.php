<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Çalışan bir hizmeti bir paketten başka bir pakete taşımak.
 *
 * Buradaki sözler baştan sona tek bir şeyi ayrı tutar: bir paketin fiyatı ile
 * ona geçmenin bugün tutacağı para iki ayrı sayıdır. Birincisi raftadır;
 * ikincisi bu hizmetin ödenmiş dönemin neresinde olduğuna bağlıdır ve düğmeye
 * basan kişinin kabul ettiği sayı da odur.
 *
 * Müşterinin okuduğu yerde "yükseltme" sözcüğünden kaçınılır, çünkü bu
 * geçişlerin yarısı ters yöndedir. Buradaki sözcük değiştirmektir.
 */

return [
    // ---- hizmet kartında -------------------------------------------------
    'change' => 'Paket değiştir',
    'change_body' => 'Zaten ödediğiniz dönemden geriye kalan düşülür ve aynı günler yeni fiyattan hesaplanır. Sunucunuzdaki hiçbir şey kaybolmaz.',
    'change_to' => ':name paketine geç',
    'change_confirm' => 'Bu hizmet :name paketine geçsin mi?',
    'change_free' => 'Ödenecek bir şey yok',
    'costs_now' => 'şimdi :amount',
    'gives_back' => ':amount geri',
    'waiting' => 'Değişiklik kabul edildi',
    'waiting_for' => ':name paketine geçiş, ödenmemiş bir faturayı bekliyor.',

    // ---- sonrasında olanlar ----------------------------------------------
    'done' => ':name paketine geçildi',
    'done_body' => 'Hizmetiniz yeni pakette. Alacağınız ne varsa hesabınızda.',
    'refused' => 'Değişiklik yapılmadı',

    // ---- ve neden olmadığı, her seferinde tek bir neden ------------------
    'refused_off' => 'Paket değiştirme bu panelde kapalı.',
    'refused_not_active' => 'Yalnızca çalışan bir hizmet değiştirilebilir. Kurulmayı bekleyen, durdurulmuş ya da biten bir hizmette hesaplanacak bir şey yoktur.',
    'refused_gone' => 'Bu hizmetin üzerinde olduğu paket artık yok, bu yüzden karşılaştırılacak bir şey de yok.',
    'refused_same' => 'Zaten üzerinde olduğu paket bu.',
    'refused_egg' => 'O paket başka bir yazılım çalıştırır. Daha büyük bir sunucu değil, başka bir sunucu olurdu; o yüzden ayrı olarak satın alınması gerekir.',
    'refused_period' => 'O paket başka bir dönem üzerinden faturalanır; bu da daha büyük bir anlaşma değil, başka bir anlaşmadır.',
    'refused_stock' => 'O paket tükendi.',
    'refused_waiting' => 'Bu hizmet için ödenmemiş bir faturayı bekleyen bir değişiklik zaten var. Önce onu ödeyin ya da iptal edin.',
    'refused_failed' => 'Hiçbir şey kaydedilmedi, yani hiçbir şey değişmedi. Yeniden deneyin ve sürerse bu paneli işleten kişiye söyleyin.',
    'refused_server' => 'Sunucuya yeni sınırlar verilemedi, bu yüzden hizmet olduğu gibi bırakıldı. Bu paneli işleten kişiye haber verildi.',

    // ---- belgelerde yazanlar ---------------------------------------------
    'line' => ':from paketinden :to paketine geçiş, bu dönemden kalan :days gün için',
    'credit_reason' => ':name paketine geçiş',

    // ---- ve sahibine söylenenler -----------------------------------------
    'bell_failed' => ':number siparişinde bir paket değişikliği başarısız oldu',
    'cold_title' => ':number siparişinde bir paket değişikliği panele ulaştı ama node\'a ulaşmadı',
    'cold_body' => 'Hizmet :name paketinde ve yeni sınırlar kaydedildi. Node bunları henüz almadı; o sunucu bir sonraki açılışında okuyacak, yani o ana kadar müşteride eski boyut duruyor. Node\'u denetleyin.',
    'gone' => 'Geçilen paket artık yok.',
    'refused_by_node' => 'Sunucu yeni sınırları kabul etmedi: :why',

    // ---- düzeltmek -------------------------------------------------------
    'retry' => 'Değişikliği yeniden dene',
    'retry_confirm' => 'Paket değişikliğini yeniden deneyin. Faturası zaten ödendi, yani iki kez ücret alınmaz.',
    'retried' => 'Değişiklik gerçekleşti',
    'retry_failed' => 'Yine başarısız oldu. Nedeni siparişin üzerinde.',
];
