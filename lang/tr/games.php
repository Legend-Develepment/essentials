<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Kaydet',
    'saved' => 'Kaydedildi',
    'restart' => 'Oyun bu dosyayı başlarken okur, bu yüzden değişikliğin geçerli olması için sunucuyu yeniden başlatın.',
    'failed' => 'Kaydedilemedi',
    'failed_write' => 'Daemon yazmayı reddetti. Sunucuya erişilebildiğini ve dosyanın salt okunur olmadığını kontrol edin.',
    'read_only' => 'Bu dosyayı okuyabilir ama yazamazsınız, bu yüzden burada hiçbir şey değiştirilemez.',
    'missing' => 'Bu sunucunun henüz ayar dosyası yok. Oyun ilk çalıştığında yazar, bu yüzden sunucuyu bir kez başlatın ve bu sayfa dolar.',
    'keeps' => 'Dosyadaki diğer her şey - yorumlar, boş satırlar, sıralama ve bu eklentinin bilmediği her anahtar - kaydettiğinizde olduğu gibi kalır.',
    'raw' => 'Buradaki isimler oyunun kendi isimleri, dosyadaki sırayla. Hiçbir şey çevrilmez veya gruplanmaz, çünkü bu sayfa elle yazılmış bir liste yerine dosyayı okur.',
    'unset' => 'Ayarlanmamış. Oyun bunu örnek olarak anıyor; doldurmak ekler.',
    'group_all' => 'Ayarlar',
    'group_all_helper' => 'Bu dosyanın andığı her şey.',
    'subheading' => ':files dosyasından oluşturulur, elle yazılmış bir listeden değil.',
];
