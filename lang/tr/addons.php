<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Bir paketin yanında satılan ekstralar.
 *
 * Burada iki şey ayrı tutulur. Bir ekstranın *fiyatı*, her ücretlendirildiğinde
 * alınan tutardır. *Bugün tutacağı para* ise bunun bir payıdır; çünkü ayın
 * ortasında bir tane alan, onun yarım ayını öder. Müşterinin okuduğu sözler her
 * zaman bu ikisinden hangisi olduğunu söyler.
 *
 * "Sunucuya bir şey eklemez" gerçek bir yanıttır ve boş bırakılmak yerine
 * açıkça söylenir; çünkü öncelikli destek satmak olağan bir şeydir ve boş bir
 * hücre hata gibi okunur.
 */

return [
    'title' => 'Ekstralar',
    'nav_label' => 'Ekstralar',
    'subheading' => 'Bir paketin yanında satılan şeyler: daha fazla bellek, bir yedek yuvası daha ya da yalnızca faturada bir satır olan bir şey.',

    // ---- tablo -----------------------------------------------------------
    'column_name' => 'Ekstra',
    'column_price' => 'Fiyat',
    'column_adds' => 'Eklediği',
    'column_sold' => 'Kullanımda',
    'column_live' => 'Satışta',
    'adds_nothing' => 'Sunucuda hiçbir şey',

    // ---- form ------------------------------------------------------------
    'section_what' => 'Ne olduğu',
    'section_what_helper' => 'Müşterinin gördüğü ad ve fiyat, bir de hangi paketlerle satın alınabileceği.',
    'name' => 'Ad',
    'price' => 'Fiyat',
    'price_helper' => 'Her ücretlendirildiğinde tutacağı para. Dönemin ortasında alındığında müşteri bunun bir payını öder, bir sonraki yenilemeden itibaren de tamamını.',
    'billing' => 'Ücretlendirme',
    'billing_helper' => 'Hizmetle birlikte, ellerinde tuttukları sürece her yenilemede geri gelmesi demektir. Bir kez ise, onu ilk taşıyan faturada ücretlendirilip bir daha ücretlendirilmemesi demektir.',
    'billing_with' => 'Her yenilemede',
    'billing_once' => 'Bir kez',
    'max' => 'Hizmet başına en fazla',
    'max_helper' => 'Birinin bundan kaç tane tutabileceği. Olağan olan birdir; gigabayt ile satılan bir şey için artırın.',
    'description' => 'Açıklama',
    'description_helper' => 'Sipariş sayfasında adın altındaki tek satır. Ne denildiğini değil, ne yaptığını yazın.',
    'packages' => 'Paketler',
    'packages_helper' => 'Bunun hangi paketlerle satın alınabileceği. Hiçbiri işaretli değilse hepsi demektir; bir destek seçeneği ya da bir yedek yuvası genelde böyledir.',

    'section_adds' => 'Sunucuya eklediği',
    'section_adds_helper' => 'Bunlar paketin zaten verdiğinin üzerine eklenir, onun yerine konmaz: bellekteki 4096, sunucuyu 4 GiB büyütür. Aynı ekstradan iki tane toplanır. Yalnızca faturada bir satır olan bir şey için hepsini sıfırda bırakın. Eksi bir sayı bir şeyi geri alır; buna izin verilir ve arada bir istenen tam olarak budur.',
    'sort' => 'Sıra',
    'sort_helper' => 'Küçük olan sipariş sayfasında önce gelir. Sayılar eşitse fiyata bakılır.',
    'live' => 'Satışta',
    'live_helper' => 'Kapalıyken hiçbir yerde sunulmaz. Zaten sahip olan onu tutar ve bunun için faturalanmayı sürdürür.',

    // ---- düğmeler --------------------------------------------------------
    'new' => 'Yeni ekstra',
    'edit' => 'Düzenle',
    'delete' => 'Sil',
    'delete_confirm' => 'Bunu kimse almamış. Silmek onu listeden büsbütün kaldırır.',
    'delete_sold' => ':count hizmette bu var. Onu tutarlar, verdiği sınırları tutarlar ve bunun için faturalanmayı sürdürürler - giden şey listedeki satırdır, böylece yeni kimse satın alamaz.',
    'go_live' => 'Satışa çıkar',
    'go_offline' => 'Satıştan kaldır',
    'saved' => 'Kaydedildi',
    'deleted' => 'Ekstra gitti',
    'save_failed' => 'Kaydedilmedi',
    'save_failed_body' => 'Hiçbir şey yazılmadı. Yeniden deneyin ve sürerse günlüğe bakın.',
    'invalid' => 'Bir ekstranın adı ve fiyatı olmalı.',
    'empty' => 'Henüz ekstra yok',
    'empty_body' => 'Ekstra, bir paketin yanında satılan şeydir: bir gigabayt daha, ikinci bir yedek yuvası ya da sunucuya hiçbir şey eklemeyen bir hizmet.',

    // ---- müşterinin gördüğü ----------------------------------------------
    'choose' => 'Ekstralar',
    'choose_helper' => 'İsteğe bağlı; sonradan ekleyebilir ya da çıkarabilirsiniz.',
    'yours' => 'Bu hizmetteki ekstralar',
    'add' => 'Ekstra ekle',
    'add_helper' => 'Şimdi bu dönemden kalanı ödersiniz, bir sonraki yenilemeden itibaren de tam fiyatı.',
    'add_to' => ':name ekle',
    'add_confirm' => ':name bu hizmete eklensin mi?',
    'drop' => 'Kaldır',
    'drop_confirm' => ':name kaldırılsın mı? Ödediğinizin kullanılmayan kısmı hesabınıza geri döner ve sunucunuz hemen değişir.',
    'costs_now' => 'şimdi :amount',
    'free_now' => 'Şimdi ödenecek bir şey yok',
    'then' => 'sonra her yenilemede :amount',
    'once_only' => ':amount, bir kez',
    'each' => 'adedi',
    'added' => ':name eklendi',
    'added_body' => 'Sunucunuza, eklediği şey verildi.',
    'dropped' => ':name kaldırıldı',
    'dropped_body' => 'Ödeyip kullanmadığınız ne varsa hesabınızda.',

    // ---- ve olmadığı zaman -----------------------------------------------
    'refused' => 'Bu yapılamadı',
    'refused_off' => 'Ekstralar bu panelde kapalı.',
    'refused_not_active' => 'Yalnızca çalışan bir hizmete ekstra eklenebilir.',
    'refused_gone' => 'O ekstra artık satışta değil.',
    'refused_wrong_package' => 'O ekstra bu paketle satılmıyor.',
    'refused_enough' => 'Bu hizmetin tutabileceği kadarına zaten sahipsiniz.',
    'refused_failed' => 'Hiçbir şey kaydedilmedi, yani hiçbir şey değişmedi. Yeniden deneyin ve sürerse bu paneli işleten kişiye söyleyin.',
    'refused_server' => 'Sunucu yeni sınırları kabul etmedi, bu yüzden hiçbir şey değişmedi ve hiçbir tahsilat yapılmadı.',
    'refused_not_yours' => 'O ekstra bu hizmette değil.',

    // ---- belgelerde yazanlar ---------------------------------------------
    'line' => ':name × :many, bu dönemden kalan :days gün için',
    'credit_reason' => 'Kaldırıldı: :name',
    'bell_failed' => ':number siparişindeki sunucuya bir ekstra verilemedi',

    // ---- birimler, yönetim tablosu için ----------------------------------
    'unit_memory' => 'MiB bellek',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disk',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'veritabanı',
    'unit_allocation_limit' => 'allocation',
    'unit_backup_limit' => 'yedek',
];
