<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Egg" ve "allocation" olduğu gibi kalıyor: bunlar Pelican'daki sözcükler ve
 * insan node sayfasında bunları arıyor.
 */

return [
    'title' => 'Sunucuyu çoğalt',
    'nav_label' => 'Sunucuyu çoğalt',
    'subheading' => 'Elindekinin tam olarak aynısı olan bir sunucu daha ya da bir seferde birkaç tane.',

    'section' => 'Ne kopyalanır',
    'section_helper' => 'Sahip, egg, başlatma komutu, sınırlar ve her değişken kopyalanır. Dosyalar, veritabanları, yedekler ve zamanlamalar kopyalanmaz — çalışan bir sunucunun dosyalarının kopyası onun durumunun kopyasıdır ve "bunun gibi bir tane daha" nadiren bunu kasteder.',

    'source' => 'Şuradan kopyala',
    'source_helper' => 'Kopyalar bu sunucuyla aynı node üzerine iner, çünkü onun boş adresleri orada.',

    'name' => 'Kopyayı adlandır',
    'name_helper' => 'Birden fazla yaparsan numaralandırır: "Bot 1", "Bot 2" ve böyle sürer.',

    'copies' => 'Kaç tane',
    'copies_helper' => 'Önce bir sunucu seç.',
    'room' => ':node üzerinde :count boş adres var, yani şu anda en fazla bu kadar yapılabilir.',
    'no_room' => ':node üzerinde hiç boş adres kalmadı. Bir kopyanın kendine ait bir adrese ihtiyacı var, bu yüzden önce o node\'a bir allocation ekle.',

    /*
     * Başarılar sayılarak, başarısızlıklar sıralanarak - ve yardımı olan sıra
     * bu: işe yarayan on ad kimsenin okumadığı bir metin duvarı, işe yaramayan
     * tek ad ise okumaya değer tek şey.
     */
    'made' => ':count kopya yapıldı',
    'partly_failed' => ':count kopya yapılamadı',
    'failed' => 'Hiçbir şey kopyalanmadı',
];
