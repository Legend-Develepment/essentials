<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Paketler: birinin satın alabileceği sunucu.
 *
 * Burayı mağazayı düzenleyen kişi okur. Buradaki her kelime şablon ve fiyat
 * içindir; müşterinin gördüğü shop.php dosyasındadır, çünkü bu iki okuyucu
 * aynı satır için farklı cümleler ister.
 *
 * „egg", „node", „swap", „io" ve Minecraft kelimeleri İngilizce kalır: bunlar
 * Pelican'ın kendi sunucu formundaki kelimelerdir ve paket, sonrası için
 * saklanmış aynı formdur.
 */

return [
    'title' => 'Paketler',
    'nav_label' => 'Paketler',
    'subheading' => 'Satılan şeyler. Her biri fiyatı olan bir sunucu şablonudur; müşteri birini satın alır ve panel sunucuyu oluşturur.',

    // ---- tablo -----------------------------------------------------------
    'column_name' => 'Paket',
    'column_flags' => 'Etiketler',
    'column_flags_from' => ':count adetten itibaren',
    'column_egg' => 'Egg',
    'column_price' => 'Fiyat',
    'column_stock' => 'Stok',
    'column_live' => 'Satışta',
    'column_orders' => 'Satıldı',

    'live' => 'Satışta',
    'offline' => 'Satışta değil',
    'no_egg' => 'Egg yok - oluşturulamaz',

    'stock_unlimited' => 'Sınırsız',
    'stock_left' => ':count kaldı',
    'stock_out' => 'Tükendi',

    // ---- dönemler --------------------------------------------------------
    'period_once' => 'Tek seferlik',
    'period_month' => 'Aylık',
    'period_quarter' => 'Üç aylık',
    'period_year' => 'Yıllık',

    // Fiyatın ardından: „12,50 € ayda".
    'per_once' => 'tek seferlik',
    'per_month' => 'ayda',
    'per_quarter' => 'üç ayda',
    'per_year' => 'yılda',

    // ---- eylemler --------------------------------------------------------
    'new' => 'Yeni paket',
    'edit' => 'Düzenle',
    'duplicate' => 'Çoğalt',
    'copy_suffix' => ' (kopya)',
    'go_live' => 'Satışa çıkar',
    'go_offline' => 'Satıştan kaldır',
    'delete' => 'Sil',
    'delete_confirm' => 'Paketi kaldırır. Zaten satın alınmış olana dokunulmaz - siparişler ne olduklarının kendi kopyasını saklar.',
    'delete_confirm_sold' => 'Bu :count kez satıldı. O hizmetlere dokunulmaz: bir sipariş, kendisine satılan her şeyin kendi kopyasını taşır, bu yüzden sunucular çalışmaya, faturalar da ne satın alındığını söylemeye devam eder. Yalnızca hizmet kartlarındaki görsel gider ve paket artık satışa sunulmaz.',
    'delete_refused' => 'Silinmedi',
    'delete_refused_body' => 'Bu pakete ait siparişler var ve ona işaret ediyorlar. Bunun yerine satıştan kaldırın; kayıt için kalır ve kimse satın alamaz.',
    'deleted' => 'Paket silindi',
    'deleted_sold' => 'Bundan satılan :count hizmete dokunulmadı, hepsi hâlâ çalışıyor.',
    'saved' => 'Paket kaydedildi',
    'save_failed' => 'Paket kaydedilemedi',
    'price_invalid' => 'Bu bir tutar değil. 12.50 veya 12,50 olarak yazın.',

    // ---- form: ne olduğu -------------------------------------------------
    'section_basics' => 'Paket',
    'section_basics_helper' => 'Müşterinin kartta gördüğü şey.',
    'name' => 'Ad',
    'name_helper' => 'Mağazada nasıl anıldığı.',
    'slug' => 'Adres',
    'slug_helper' => 'Küçük harfler, rakamlar ve tireler. Boş bırakılırsa addan üretilir. Sonradan değiştirmek birinin kaydettiği bağlantıyı bozar.',
    'description' => 'Açıklama',
    'description_helper' => 'Adın altında birkaç satır. Düz metin.',
    'live_field' => 'Satışta',
    'live_helper' => 'Kapalıysa paket burada kalır ve kimseye gösterilmez. Egg\'i olmayan bir paket, burada ne yazarsa yazsın asla gösterilmez.',
    'sort' => 'Sıra',
    'sort_helper' => 'Küçük olan mağazada önce gelir.',

    // ---- form: neye dönüştüğü --------------------------------------------
    'section_server' => 'Dönüştüğü sunucu',
    'section_server_helper' => 'Pelican bir sunucu elle oluşturulurken hangi soruları soruyorsa aynıları; burada bir kez yanıtlanır ve her satışta kullanılır.',
    'egg' => 'Egg',
    'egg_helper' => 'Birini seçmek imajı, başlatma komutunu ve her değişkeni egg\'in varsayılanlarıyla doldurur. Sonra istediğinizi değiştirin.',
    'image' => 'Docker imajı',
    'image_helper' => 'Egg\'in sunduğu imajlardan biri.',
    'image_default' => 'Egg\'in ilk imajı',
    'startup' => 'Başlatma komutu',
    'startup_helper' => 'Egg\'in sunduğu komutlardan biri.',
    'startup_default' => 'Egg\'in ilk komutu',
    'environment' => 'Değişkenler',
    'environment_helper' => 'Egg\'in değişkenleri ve değerleri. Egg\'in sahip olduğu ve burada listelenmeyen her şey, sunucu oluşturulurken kendi varsayılanını alır.',
    'env_key' => 'Değişken',
    'env_value' => 'Değer',
    'nodes' => 'Node',
    'nodes_helper' => 'Bu paketten bir sunucunun nerede oluşturulabileceği - biri boş adrese sahip olana kadar bu sırayla denenir. Hiçbiri işaretli değilse herhangi bir node demektir.',
    'upgrade_to' => 'Şuna geçilebilir',
    'upgrade_to_helper' => 'Bu paketteki çalışan bir hizmetin yukarı ya da aşağı taşınabileceği paketler. Yalnızca aynı egg\'i kullanan paketler listelenir; çünkü başka bir egg, daha büyük bir sunucu değil, başka bir sunucudur. Hiçbiri işaretli değilse bu paketten başka bir pakete geçilemez.',
    'upgrade_to_none' => 'Bu egg\'i henüz başka bir paket kullanmıyor.',

    // ---- form: sınırlar --------------------------------------------------
    'section_limits' => 'Sınırlar',
    'section_limits_helper' => 'Sunucunun aldığı şeyler. Pelican\'ın kendi sunucu formundaki alanların aynısı, aynı birimlerle.',
    'memory' => 'Bellek',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Bir çekirdeğin yüzdesi: 100 bir çekirdek, 200 iki çekirdek, 0 sınırsız.',
    'swap' => 'Swap',
    'swap_helper' => '0 hiç, -1 sınırsız.',
    'io' => 'Blok IO ağırlığı',
    'io_helper' => 'Pelican\'ın varsayılanı 500\'dür. Neden olmasın diye bilmiyorsanız öyle bırakın.',
    'threads' => 'CPU sabitleme',
    'threads_helper' => 'Hangi çekirdekler, Pelican\'ın yazdığı biçimde: 0,1 veya 0-3. Boş, herhangi biri demektir.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Belleği bittiğinde çekirdeğin sunucuyu durdurup durduramayacağı.',
    'databases' => 'Veritabanları',
    'allocations' => 'Ek allocation',
    'backups' => 'Yedekler',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- form: para ------------------------------------------------------
    'section_price' => 'Fiyat ve stok',
    'section_price_helper' => 'Mağaza ayarları sayfasında belirlenen mağaza para biriminde. Vergisiz - vergi faturaya ayrı bir satır olarak eklenir.',
    'price' => 'Fiyat',
    'price_helper' => 'Dönem başına. 12.50 veya 12,50 olarak yazın.',
    'setup_fee' => 'Kurulum ücreti',
    'setup_fee_helper' => 'Bir kez, ilk faturada alınır. Hiç olmaması için sıfır.',
    'period' => 'Faturalama',
    'period_helper' => 'Tek seferlik bir kez ödenir ve öyle kalır. Diğerleri her dönem yeni bir fatura alır; ödenmeyen, Mağaza ayarları sayfasındaki ek süreden sonra sunucuyu durdurur.',
    'stock' => 'Stok',
    'stock_helper' => 'Aynı anda kaç tane satılmış olabileceği; iptal edilmemiş her sipariş sayılır. Boş, sınırsız demektir.',
    'term' => 'Asgari süre',
    'term_helper' => 'Satın aldıktan sonra birinin ne kadar süre bağlı kaldığı. Sıfır, bağlılık yok demektir: iptal edebilir ve ödediği dönemin sonunda sona erer.',
    'term_unit' => 'Şununla sayılır',
    'term_unit_helper' => 'Gün, ay ya da yıl. İptal edilen bir sipariş bu sürenin sonuna kadar işler ve sunucu o gün silinir.',
    'unit_day' => 'Gün',
    'unit_month' => 'Ay',
    'unit_year' => 'Yıl',
    'term_day' => 'Asgari süre: :count gün',
    'term_month' => 'Asgari süre: :count ay',
    'term_year' => 'Asgari süre: :count yıl',
    'section_art' => 'Görsel',
    'section_art_helper' => 'Paket kartındaki, mağazadaki ve müşterinin hizmetlerindeki görsel. İkisini de boş bırakırsanız eggin kendi görseli kullanılır; çoğu pakette bu zaten vardır.',
    'art_file' => 'Bir görsel yükleyin',
    'art_file_helper' => 'Uzundan çok geniş olsun: kart onu 16:9 oranına kırpar. En fazla 8 MB.',
    'art_url' => 'Ya da bir görsel adresi',
    'art_url_helper' => 'Tam bir https adresi. Yukarıya hiçbir şey yüklenmediğinde kullanılır.',

    'empty' => 'Henüz paket yok',
    'section_ask' => 'Müşteriye sor',
    'section_ask_helper' => 'Sipariş sayfasına konan, sipariş verilmeden önce yanıtlanan sorular. Yanıtlar, sunucu oluşturulurken ona ulaşır.',
    'ask_vars' => 'Sorulacak değişkenler',
    'ask_vars_helper' => 'Egg\'in kendi değişkenleri. Birini işaretleyin; müşteri satın alırken onu doldurur ve verdiği yanıt, bu paketteki değerin yerine kullanılır. Hiçbirini işaretlemezseniz kimseye bir şey sorulmaz.',
    'upload_ask' => 'Dosya iste',
    'upload_ask_helper' => 'Müşterinin satın alırken yüklediği bir zip - bir dünya, bir modpack, bir ayar takımı. Sunucusu oluşturulurken, ona hazır olduğu söylenmeden önce içine konur.',
    'upload_label' => 'Adı ne olsun',
    'upload_label_helper' => 'Dosya kutusunun üstündeki etiket, kendi sözlerinizle. Boş bırakılırsa sade bir tanesi kullanılır.',
    'upload_dir' => 'Sunucunun neresine',
    'upload_dir_helper' => 'Sunucunun içindeki bir yol, / veya /world gibi. Kullanılmadan önce güvenli hale getirilir.',
    'upload_extract' => 'Arşivden çıkar',
    'upload_extract_helper' => 'Açıkken zip, indiği yerde arşivden çıkarılır ve arşivin kendisi silinir - bir dünya ya da bir ayar takımı için doğrusu budur. Kapalıyken zip dosya olarak bırakılır; bir modpack\'i zipten kuran bir egg tam olarak bunu ister.',
    'empty_body' => 'Bir tane oluşturun; satışa çıktığı anda mağazada görünür.',
    'popular' => 'Bunu işaret et',
    'popular_helper' => 'Çoğu kişinin seçtiği paket olarak işaretler. Mağazada yukarı çıkar, indirimdeki her şeyin altına, ve küçük bir etiket taşır. Satış rakamları üzerine bir iddia değil - işaret eden bir dükkân sahibi.',
    'offer' => 'İndirimde',
    'offer_helper' => 'Paketi, üzerinde bir etiketle mağazanın en önüne taşır ve aşağıdaki indirimi fiyatından düşer.',
    'offer_kind' => 'İndirim türü',
    'offer_percent' => 'Yüzde',
    'offer_amount' => 'Tutar',
    'offer_value' => 'Ne kadar düşecek',
    'offer_value_percent' => 'Fiyatın yüzdesi; yani 20, beşte bir indirim demektir.',
    'offer_value_amount' => 'Mağaza para biriminde bir tutar; yani 2,50, iki buçuk indirim demektir.',
    'offer_min' => 'Yalnızca bu kadar üründen itibaren',
    'offer_min_helper' => 'İndirimin geçerli olması için sepetin ne kadar dolu olması gerektiği; yalnızca bu paket değil, içindeki her şey sayılır. Sıfır ya da bir, her zaman geçerli demektir. İki ise sepete ikinci bir şey koymak için bir nedendir.',
];
