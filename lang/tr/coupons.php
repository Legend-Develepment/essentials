<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * İndirim kodları: ilk faturadan bir şey düşen kodlar.
 *
 * Yalnızca ilkinden, bilerek, ve metin bunu önemli olduğu yerde söyler. Her
 * yenilemeyi de ucuzlatan bir kod, bitiş tarihi olan bir fiyat değişikliği
 * olurdu; bunu isteyen fiyatı değiştirsin.
 */

return [
    'title' => 'İndirim kodları',
    'nav_label' => 'İndirim kodları',
    'subheading' => 'İlk faturadan bir yüzde ya da bir tutar düşen kodlar. Yenilemeler paket fiyatından gider.',

    // ---- tablo -----------------------------------------------------------
    'column_code' => 'Kod',
    'column_value' => 'Değer',
    'column_uses' => 'Kullanıldı',
    'column_expires' => 'Biter',
    'column_packages' => 'Şunlar için geçerli',
    'column_live' => 'Etkin',

    'never_expires' => 'Bitiş tarihi yok',
    'all_packages' => 'Her şey',
    'some_packages' => ':count paket',
    'usable' => 'Şu anda kullanılabilir',
    'unusable' => 'Kapalı, süresi dolmuş ya da tükenmiş',

    // ---- düğmeler --------------------------------------------------------
    'new' => 'Yeni kod',
    'edit' => 'Düzenle',
    'delete' => 'Sil',
    'delete_confirm' => 'Kodu kaldırır. Onu daha önce kullanmış faturalar indirimlerini korur: her biri kendisinden ne düşüldüğünü kendi saklar.',
    'deleted' => 'Kod silindi',
    'saved' => 'Kod kaydedildi',
    'save_failed' => 'Kod kaydedilemedi',
    'taken' => 'Bu kodu zaten başka bir şey kullanıyor.',
    'invalid' => 'Yüzde, 1 ile 100 arasında bir tam sayıdır. Tutar 12.50 ya da 12,50 biçiminde yazılır.',

    // ---- form ------------------------------------------------------------
    'section_code' => 'Kod',
    'section_code_helper' => 'Müşterinin sipariş verirken yazdığı şey.',
    'code' => 'Kod',
    'code_helper' => 'Büyük harfle ve boşluksuz saklanıp karşılaştırılır, böylece kim nasıl yazarsa yazsın çalışır.',
    'live' => 'Etkin',
    'live_helper' => 'Kapalı, kodu silmeden çalışmaz kılar: dolaşımdan çıkar, verdiği indirim ise onu almış faturalarda kalır.',

    'section_worth' => 'Ne kadar düşer',
    'section_worth_helper' => 'Yalnızca ilk faturadan. Bir faturayı asla sıfırın altına indirmez.',
    'kind' => 'Tür',
    'kind_helper' => 'Fiyatın bir payı ya da sabit bir tutar.',
    'kind_percent' => 'Yüzde',
    'kind_fixed' => 'Sabit tutar',
    'value' => 'Değer',
    'value_percent_helper' => '1 ile 100 arasında bir tam sayı.',
    'value_fixed_helper' => 'Mağazanın para biriminde. 12.50 ya da 12,50 olarak yazın.',

    'section_limits' => 'Sınırlar',
    'section_limits_helper' => 'Buradaki her şey isteğe bağlı. Hiçbiri ayarlanmamış bir kod her şey için, herkes için, hep geçerlidir.',
    'max_uses' => 'Kaç kez kullanılabilir',
    'max_uses_helper' => 'Sipariş verildiğinde sayılır, fatura ödendiğinde değil: yoksa on kullanımlık bir kod bir gecede yüz kez verilebilirdi.',
    'expires' => 'Biter',
    'expires_helper' => 'Bu andan sonra kod artık çalışmaz. Boş bırakmak bunun hiç olmaması demektir.',
    'packages' => 'Paketler',
    'packages_helper' => 'Hiçbiri işaretli değilse her paket demektir, şimdi ve sonra.',

    'empty' => 'Henüz kod yok',
    'empty_body' => 'Bir tane oluşturun; etkin olduğu anda siparişte çalışır.',
];
