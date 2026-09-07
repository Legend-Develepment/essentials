<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "GameUserSettings.ini" ve "Startup" oyunda ve Pelican'da durdukları gibi
 * yazılıyor - insanın aradığı adlar tam olarak bunlar.
 */

return [
    /* ----------------------------------------------- yönetim sekmesi ----- */

    /*
     * Başlığın kendisi burada değil. Her ayar bölümü başlığını
     * settings.groups.<ad> anahtarından alır; onu group() kurar.
     */
    'section_helper' => 'Hangi egg\'ler ARK çalıştırıyor. Başka bir şey değil — bir ARK sunucusunun geri kalanı başlatma değişkenleriyle ayarlanır ve Pelican\'ın kendi Startup sayfası onları zaten düzenler.',

    'eggs' => 'Hangi egg\'ler ARK',
    'eggs_helper' => 'ARK sunucusu çalıştıran egg\'leri işaretle. Dünya ayarları sayfası, onları kullanan sunucuların içinde belirir, başka hiçbir yerde değil. Bu, durum sayfasındakinden başka bir soru: o, hangi egg\'lerin Valve sorgusuna yanıt verdiğini sorar ki bunu Rust ve Valheim de yapar; bu ise hangi egg\'lerin GameUserSettings.ini dosyasını ARK\'ın tuttuğu yerde tuttuğunu sorar ki bunu yalnızca ARK yapar. Başlangıçta hiçbir şey işaretli değil, bilerek — bir eklenti egg\'lerine ne ad verdiğini bilemez.',

    /* ---------------------------------------------- sunucunun sayfası ---- */

    'nav_label' => 'Dünya ayarları',
    'title' => 'ARK dünya ayarları',
    'subheading' => 'İnsanların gerçekten değiştirdiği ayarlar, GameUserSettings.ini dosyasından.',

    'group_server' => 'Sunucu',
    'group_server_helper' => 'Sunucunun adı, kimin katılabildiği ve kaç kişi.',
    'group_rates' => 'Oranlar',
    'group_rates_helper' => 'İşlerin ne kadar hızlı olduğu. 1.0 oyunun geldiği hali; 2.0 iki katı hızlı.',
    'group_rules' => 'Kurallar',
    'group_rules_helper' => 'Oyuncuların ne yapabildiği ve oyunun onlara ne gösterdiği.',

    'keeps' => 'Yüzlercesi olan bir dosyadan on beş ayar. İçindeki diğer her şey — mod ayarların, bu eklentinin hiç duymadığı anahtarlar, yorumlar ve bunların sırası — kaydettiğinde tam olduğu gibi kalır.',
    'missing' => 'Bu sunucuda henüz GameUserSettings.ini yok. Oyun onu ilk çalıştığında yazar, bu yüzden sunucuyu bir kez başlat, bu sayfa da dolar.',
    'read_only' => 'Bu dosyayı okuyabilirsin ama yazamazsın, bu yüzden burada hiçbir şey değiştirilemez.',

    'save' => 'Kaydet',
    'saved' => 'Kaydedildi',
    'saved_restart' => 'ARK bu dosyayı başlarken okur, bu yüzden değişikliğin etkili olması için sunucuyu yeniden başlat.',
    'failed' => 'Kaydedilemedi',
    'failed_write' => 'Daemon yazmayı reddetti. Sunucunun erişilebilir olduğunu ve dosyanın salt okunur olmadığını denetle.',
];
