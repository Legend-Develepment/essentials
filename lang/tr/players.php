<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Whitelist", "operator", "ban" ve "kick" İngilizce kalıyor: bunlar konsola
 * yazdığın komutlar ve Minecraft'ın kendi yazdığı dosyaların adları. İngilizce
 * bir komutun yanındaki çevrilmiş bir düğme, kafanda geri çevirmen gereken bir
 * düğmedir.
 */

return [
    'nav_label' => 'Oyuncular',
    'title' => 'Oyuncular',
    'subheading' => 'Whitelist, operator\'lar, ban\'lar ve bu sunucunun gördüğü herkes.',

    /*
     * Bir kez, en üstte söylendi; çünkü hem sayfanın ne yapabildiğini hem de
     * yapamadığı bir şeyin neden bir arıza olmadığını açıklıyor. Her değişiklik
     * bir konsol komutu olarak gönderilir, Minecraft'a zaten böyle söylenir -
     * değişikliği oyun yapar ve kendi dosyasını yazar, böylece ikisi hiçbir
     * zaman ayrı düşmez.
     */
    'how' => 'Değişiklikler sunucuya konsol komutu olarak gönderilir, böylece onları oyun yapar ve kendi dosyalarını yazar. Bunun için sunucunun çalışıyor olması gerekir.',
    'needs_running' => 'Sunucu çalışıyor olmalı. Bu değişiklikleri oyun yapar, altından dosyalarını düzenlemek değil.',

    'name' => 'Oyuncu adı',
    'reason' => 'Neden (isteğe bağlı)',

    'whitelist' => 'Whitelist\'e ekle',
    'unwhitelist' => 'Whitelist\'ten çıkar',
    'op' => 'Operator yap',
    'deop' => 'Operator\'ü al',
    'ban' => 'Ban',
    'pardon' => 'Ban\'ı kaldır',
    'kick' => 'Kick',

    'sent' => 'Komut gönderildi',
    'sent_body' => 'Sunucu onu uygular ve kendi dosyalarını günceller. Listelerin değiştiğini görmek için sayfayı yeniden yükle.',
    'refused' => 'Bu gönderilmedi',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Whitelist\'te',
    'flag_banned' => 'Ban\'lı',
    'flag_seen' => 'Burada oynamış',

    'online' => 'Şu anda bağlı',
    'online_count' => ':max içinden :online',
    'online_none' => 'Kimse bağlı değil.',

    'players' => 'Oyuncular',
    'ips' => 'Ban\'lı adresler',
    'ips_empty' => 'Hiçbir adres ban\'lı değil.',

    /*
     * Boş bir sayfanın ne anlama geldiği; bu genellikle "oyuncu yok" değil, "bu
     * sunucu hiç başlatılmamış" demektir. Minecraft, ilk çalışmasına kadar bu
     * dosyaların hiçbirini oluşturmaz.
     */
    'empty' => 'Henüz gösterecek bir şey yok. Minecraft bu listeleri kendisi yazar ve sunucu ilk kez başlayana dek onları oluşturmaz.',

    'level' => ':level. seviye',

    /*
     * Bu sayfanın yapmadığı tek şey; keşfedilmeye bırakılmadı, söylendi. Canlı
     * durum, oyunun kendisine ikinci bir bağlantı ister; bu, kendi gereksinimleri
     * olan başka bir özelliktir.
     */
    'not_live' => 'Bu, sunucunun yazdığı şeydir; şu anda kimin içeride olduğu değil.',
];
