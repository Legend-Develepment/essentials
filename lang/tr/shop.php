<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Mağaza ayarları ve daha sonra mağazanın kendisi.
 *
 * Bu dosyayı iki okuyucu bilerek paylaşır. Ayarlar yarısını yönetici okur;
 * mağaza büyüdükçe eklenen genel ve müşteri yarısını ise Pelican'ı hiç
 * duymamış olabilecek insanlar okur ve oradaki her cümle onlar için yazılmış
 * olmalıdır.
 */

return [
    'title' => 'Mağaza ayarları',
    'nav_label' => 'Mağaza ayarları',
    'subheading' => 'Para birimi, vergi, fatura numaralandırması ve genel sayfanın söyledikleri. Satılanlar Paketler sayfasındadır.',

    // ---- nerede olduğu ---------------------------------------------------
    'address' => 'Genel mağaza şurada',
    'address_off' => 'Genel sayfa kapalı. Essentials ayarları sayfasındaki özellik listesinde „Genel mağaza sayfası" seçeneğini açın; o zaman :url adresine yanıt verir.',

    // ---- genel -----------------------------------------------------------
    'section_general' => 'Para',
    'section_general_helper' => 'Tüm mağaza için tek para birimi. Her paketin her fiyatı bu birimde bir sayıdır.',
    'currency' => 'Para birimi',
    'currency_helper' => 'Değiştirmek hiçbir şeyi yeniden hesaplamaz: paket fiyatları sayıdır ve değişiklikten sonra yeni para biriminde sayı olur.',
    'tax' => 'Vergi',
    'tax_helper' => 'Her faturaya ayrı bir satır olarak eklenen yüzde. Paket fiyatları vergisizdir. Hiç olmaması için sıfır.',
    'tax_suffix' => '%',
    'prefix' => 'Fatura numaraları şununla başlar',
    'prefix_helper' => 'Ardından artan bir numara gelir. INV- şunu verir: INV-000001.',

    // ---- yenilemeler -----------------------------------------------------
    'section_renewals' => 'Yenilemeler',
    'section_renewals_helper' => 'Aylık, üç aylık veya yıllık faturalanan paketler için. Tek seferlik bir paket bundan hiç etkilenmez.',
    'notice_days' => 'Dönem bitmeden şu kadar gün önce faturala',
    'notice_days_helper' => 'Sonraki faturanın ne zaman oluşturulacağı ve müşteriye ne zaman haber verileceği.',
    'grace' => 'Fatura vadesinden şu kadar gün sonra durdur',
    'grace_helper' => 'Bunu aşan ödenmemiş fatura sunucuyu durdurur — Pelican\'ın kendi askıya alması ile; fatura ödendiği anda kaldırılır. Mağaza hiçbir şeyi silmez.',
    'days' => 'gün',

    // ---- genel sayfa -----------------------------------------------------
    'section_public' => 'Genel sayfa',
    'section_public_helper' => 'Hesabı olmayan kişiler okur. Hiç gösterilip gösterilmeyeceğine özellik listesindeki „Genel mağaza sayfası" anahtarı karar verir.',
    'heading' => 'Başlık',
    'heading_helper' => 'Boş bırakılırsa panelin kendi adı kullanılır.',
    'note' => 'Paketlerin üstündeki satır',
    'note_helper' => 'Kim olduğunuzu veya satın almanın ne getirdiğini söylemek için. Düz metin.',
    'terms_url' => 'Koşullar',
    'terms_url_helper' => 'https adresi. Ayarlanmışsa satın almak, ona işaret eden bir kutuyu işaretlemek anlamına gelir.',

    // ---- elle ödeme ------------------------------------------------------
    'section_manual' => 'Sağlayıcısız ödeme',
    'section_manual_helper' => 'Hiçbir ödeme sağlayıcısı açık değilken ödenmemiş faturada gösterilir: banka bilgileri veya paranın nereye gönderileceği. Düz metin.',
    'pay_note' => 'Nasıl ödenir',
    'pay_note_helper' => 'Boş bırakın; ödenmemiş fatura yalnızca ödenmemiş olduğunu söyler.',

    // ---- düğmeler --------------------------------------------------------
    'save' => 'Kaydet',
    'saved' => 'Kaydedildi',
    'save_failed' => 'Hiçbir şey kaydedilmedi',
];
