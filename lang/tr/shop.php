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

    'gateway_stripe' => 'Kart',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Kartları Stripe\'ın kendi çizdiği bir sayfada alır, böylece hiçbir kart numarası bu panele ulaşmaz. Test ile canlı, anahtarın ön ekindedir; bir düğmede değil.',
    'stripe_on' => 'Stripe sun',
    'stripe_on_helper' => 'Kapalı, düğmeyi her faturadan kaldırır. Zaten ödenmiş olan ödenmiş kalır.',
    'stripe_key' => 'Gizli anahtar',
    'stripe_key_helper' => 'sk_ ile başlayan olan; Developers, API keys bölümünden. Dışa aktarılan bir ayar dosyasına asla yazılmaz.',
    'stripe_hook' => 'İmzalama sırrı',
    'stripe_hook_key_helper' => 'Aşağıdaki adresi eklediğinizde Stripe\'ın gösterdiği whsec_ değeri. O olmadan mesajlarının gerçek olduğu kanıtlanamaz ve yok sayılırlar.',
    'stripe_hook_helper' => ':url adresini Developers, webhooks altında checkout.session.completed olayı için endpoint olarak ekleyin.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Paranın müşteri geri döndüğünde hareket ettiği tek sağlayıcı; müşteri hâlâ PayPal\'dayken değil. Yani kapatılan bir sekme, kaybolmuş bir ödeme değil, ödenmemiş bir fatura bırakır.',
    'paypal_on' => 'PayPal sun',
    'paypal_on_helper' => 'Kapalı, düğmeyi her faturadan kaldırır. Zaten ödenmiş olan ödenmiş kalır.',
    'paypal_sandbox' => 'Test ortamı',
    'paypal_sandbox_helper' => 'Gerçek hesap yerine PayPal\'ın test hesabıyla konuşur. Client id\'leri her iki durumda da aynı görünür; bu düğmenin var olma sebebi tam olarak budur.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Apps & Credentials altında oluşturduğunuz uygulamadan. Sekmenin yukarıdaki düğmeyle uyuştuğuna bakın.',
    'paypal_secret_helper' => 'Client ID\'nin yanında, Show düğmesinin arkasında. Dışa aktarılan bir ayar dosyasına asla yazılmaz.',
    'paypal_hook' => 'Webhook ID',
    'paypal_hook_id_helper' => 'Webhook\'u ekledikten sonra PayPal\'ın ona verdiği ID; adres değil. O olmadan mesajları kendilerine doğrulatılamaz ve yok sayılır.',
    'paypal_hook_helper' => ':url adresini o uygulamada PAYMENT.CAPTURE.COMPLETED için webhook olarak ekleyin, sonra verilen ID\'yi buraya yapıştırın.',

    // ---- ödeme sayfası ---------------------------------------------------
    'pay_title' => 'Öde',
    'pay_subheading' => 'Ne borcunuz olduğu ve bunu kapatmanın yolları.',
    'pay_choose' => 'Nasıl ödemek istersiniz?',
    'pay_choose_body' => 'Hangisini seçerseniz seçin, işi onların kendi sayfasında bitirir ve hemen ardından buraya dönersiniz.',
    'pay_safe' => 'Ödemek için sağlayıcıya gönderilirsiniz. Kart bilgileriniz bu panele hiçbir zaman ulaşmaz.',
    'pay_no_ways' => 'Para geldiği anda fatura ödendi olarak işaretlenir ve sunucunuz kurulur.',
    'pay_gone' => 'Böyle bir fatura yok',
    'pay_gone_body' => 'Geri çekilmiş olabilir, ya da adres yanlıştır.',
    'pay_already' => 'Bu ödenmiş',
    'pay_already_body' => 'Yapılacak başka bir şey yok. Onu bekleyen her şey zaten yolda.',
    'pay_withdrawn' => 'Bu geri çekildi',
    'pay_withdrawn_body' => 'Defterlerden çıktı ve ödenmesi gerekmiyor. Bu size tuhaf geldiyse, paneli işleten kişiye sorun.',
    'back_to_billing' => 'Faturalara dön',

    'gateway_mollie_note' => 'iDEAL, Bancontact, kart ve daha fazlası',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'PayPal bakiyeniz ya da PayPal üzerinden kart',

    // ---- hizmetler ve faturalar, ayrı ayrı -------------------------------
    'services_title' => 'Hizmetlerim',
    'services_nav_label' => 'Hizmetlerim',
    'services_subheading' => 'Parasını ödediğiniz şeyler ve her birinden doğan sunucu.',
    'open_server' => 'Sunucuyu aç',
    'no_server_yet' => 'Kuruluyor',

    'invoices_title' => 'Faturalar',
    'invoices_subheading' => 'Size ne fatura edildiği ve geriye ne ödemenin kaldığı.',
    'no_invoices_body' => 'Satın aldığınız her şey burada faturalanır ve ödendikten sonra da burada kalır.',

    // ---- açılış sayfası olarak mağaza ------------------------------------
    'section_landing' => 'Mağazanın yeri',
    'section_landing_helper' => 'Giriş yapan biri mağazaya mı iniyor, sunucularına mı.',
    'landing' => 'Önce mağazayı aç',
    'landing_helper' => 'Açıkken mağaza, giriş sonrası ilk sayfadır ve sunucu listesi onun yanına geçer. Hizmetleriniz ve faturalarınız bir tık uzakta kalır: mağazanın başlığında ve hesap menüsünde. Kapalıyken hiçbir şey yer değiştirmez ve mağaza diğerleri gibi bir sayfadır.',
];
