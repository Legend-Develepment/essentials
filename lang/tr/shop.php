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

    /* ---------------------------------------------------------------------
     * Mağazanın kendisi, buradan aşağısı.
     *
     * Bambaşka bir okuyucu: sunucu satın alan biri, Pelican\'ı belki hiç
     * duymamış ve egg\'in ne olduğunu bilmeyen biri. Aşağıda hiçbir şey panelin
     * sözcüklerini kullanmaz ve her cümle, müşterinin sayfanın o noktasında
     * gerçekten sorduğu soruya yanıt verir.
     * ------------------------------------------------------------------- */

    // ---- mağaza ----------------------------------------------------------
    'store_title' => 'Mağaza',
    'store_nav_label' => 'Mağaza',
    'store_subheading' => 'Bir sunucu seçin. Fatura ödenir ödenmez sizin için oluşturulur.',
    'store_empty' => 'Şu anda satılık bir şey yok',
    'store_empty_body' => 'Daha sonra uğrayın ya da bu paneli işleten kişiye sorun.',

    'buy' => 'Satın al',
    'sold_out' => 'Tükendi',
    'plus_setup' => 'artı bir kereye mahsus :amount',

    'spec_memory' => ':amount MiB bellek',
    'spec_disk' => ':amount MiB disk',
    'spec_cpu' => '%:amount CPU',
    'spec_backups' => ':count yedek',
    'spec_databases' => ':count veritabanı',

    // ---- genel sayfa -----------------------------------------------------
    'public_empty' => 'Şu anda satılık bir şey yok',
    'public_empty_body' => 'Daha sonra uğrayın.',
    'to_panel' => 'Giriş yap',
    'terms' => 'Koşullar',
    'sign_in_note' => 'Aşağıdan bir sunucu seçin. Bitirmek için giriş yaparsınız ve fatura ödendiğinde sunucu oluşturulur.',

    // ---- sipariş ---------------------------------------------------------
    'checkout_title' => 'Sipariş',
    'tax_line' => 'KDV (%:rate)',
    'coupon' => 'İndirim kodu',
    'coupon_placeholder' => 'Varsa',
    'coupon_bad' => 'Bu kod burada geçerli değil.',
    'coupon_good' => 'Kod uygulandı.',
    'agree' => 'Kabul ediyorum:',
    'place_order' => 'Siparişi ver',
    'place_order_note' => 'Bu bir fatura yazar. Siz ödemeden hiçbir tahsilat yapılmaz ve sunucu, fatura ödendiğinde oluşturulur.',
    'back_to_store' => 'Mağazaya dön',

    'placed' => 'Sipariş verildi',
    'placed_body' => ':number numaralı fatura, fatura sayfanızda sizi bekliyor.',

    'refused' => 'Bu satın alınamadı',
    'refused_gone' => 'Artık satılık değil.',
    'refused_sold_out' => 'Sonuncusu da gitti.',
    'refused_bad_coupon' => 'İndirim kodu bunun için geçerli değil.',
    'refused_failed' => 'Sipariş yazılırken bir şeyler ters gitti. Hiçbir tahsilat yapılmadı. Yeniden deneyin ve sürerse bu paneli işleten kişiye söyleyin.',

    // ---- faturalar -------------------------------------------------------
    'billing_title' => 'Faturalar',
    'billing_nav_label' => 'Faturalar',
    'billing_subheading' => 'Ne aldığınız ve ne borcunuz olduğu.',
    'your_orders' => 'Siparişleriniz',
    'your_invoices' => 'Faturalarınız',
    'no_orders' => 'Henüz bir şey satın almadınız',
    'no_orders_body' => 'Satın aldığınız her şey sunucusu ve tarihleriyle burada görünür.',
    'no_invoices' => 'Henüz fatura yok',
    'to_store' => 'Mağazaya git',
    'renews' => 'Yenilenir',
    'ask_how_to_pay' => 'Bu paneli işleten kişiye nasıl ödeyeceğinizi sorun. Buraya henüz yazmamışlar.',
    'order_pending' => 'Faturanın ödenmesini bekliyor. Hemen ardından sunucu oluşturulur.',
    'order_suspended' => 'Ödenmemiş bir fatura yüzünden durduruldu. Ödemek sunucuyu yeniden başlatır; hiçbir şey silinmedi.',

    // ---- ödeme -----------------------------------------------------------
    'pay_with' => 'Şununla öde:',
    'pay_now' => 'Öde',
    'pay_description' => ':number numaralı fatura',
    'pay_thanks' => 'Teşekkürler. Fatura ödendi.',
    'pay_pending' => 'Sağlayıcı henüz doğrulamadı. Doğruladığı anda bu sayfa güncellenir.',
    'pay_refused' => 'Bu başlamadı',
    'pay_refused_body' => 'Ödeme açılamadı. Başka bir yolu deneyin, ya da bu paneli işleten kişiye sorun.',
    'gateway_mollie' => 'Mollie',

    // ---- sağlayıcının ayarları -------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'iDEAL, kartlar, Bancontact ve gerisini tek hesap üzerinden alır. Test ile canlı aynı ayardır: anahtarın kendisi hangi hesaba ait olduğunu söyler.',
    'mollie_on' => 'Mollie sun',
    'mollie_on_helper' => 'Kapalı, düğmeyi her faturadan kaldırır. Zaten ödenmiş olan ödenmiş kalır.',
    'mollie_key' => 'API anahtarı',
    'mollie_key_helper' => 'Mollie panelinizin Developers bölümünden. Dışa aktarılan bir ayar dosyasına asla yazılmaz.',
    'mollie_hook' => 'Webhook adresi',
    'mollie_hook_helper' => 'Mollie :url adresine bildirir; paneliniz oraya internetten erişilebilir olmalı.',
];
