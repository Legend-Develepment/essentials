<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Subuser", "Wings", "SFTP", "cron" ve "root admin" olduğu gibi kalıyor:
 * bunlar Pelican'daki ve makinedeki sözcükler ve satıra bakmaya giden bunları
 * arıyor.
 */

return [
    'nav_label' => 'Sunucu erişimi',
    'title' => 'Role göre sunucular',
    'subheading' => 'Bir role sahip herkese aynı sunuculara erişim ver.',

    /*
     * Sayfadaki her şeyden önce söylendi, çünkü buradaki tek özellik bu:
     * Pelican'a ait bir tabloya yazan.
     */
    'more' => 'Bu nasıl çalışır',
    'warning' => 'Bu, Pelican\'ın kendi subuser kayıtlarını güncel tutarak çalışır - bir sunucunun Users sayfasında elle ekleyeceğin satırların aynısı; sunucu listesi, izin denetimleri ve Wings zaten tam bunları okur. Yalnızca kendi oluşturduğu satırlara dokunur: elle eklediğin hiçbir şey asla değişmez ve asla kaldırılmaz. Bir rol birine sunucu verdiğinde kimseye e-posta gitmez. Erişimi geri almak SFTP\'lerini de iptal eder, bunun için de Pelican\'ın zaten istediği queue worker gerekir.',

    'never' => 'Henüz hiçbir şey uzlaştırılmadı. Aşağıya bir eşleme kaydet, hemen olur; ondan sonra da panelin kendi cron\'unda her dakika.',
    'timing' => 'Erişim tam olması gerektiği anda geri alınır: bir rolü kaybeden, sunucuları daha bir sonraki sayfasında kaybeder. Vermek bir dakikaya kadar sürebilir, çünkü o tarama şu anda paneli kullanmayanları arayan taramadır.',
    'last_run' => 'Son çalışma :ago saniye önce: :added eklendi, :removed kaldırıldı, :held yerinde kaldı.',
    'capped' => 'Tek seferde çok fazla - :pairs verme, sınır ise :max. Hiçbir şey yazılmadı. Bir eşlemeyi daralt: elli kişilik ve yirmi sunuculu bir rol, tek başına bin verme demektir.',

    'which' => 'Eşlemeler',
    'which_helper' => 'Bir rol, ona sahip herkesin ulaşması gereken sunucular ve orada ne yapabildikleri. İki rolde olan, ikisinin verdiği her şeyi alır. Sunucu sahipleri ve root admin\'ler atlanır - onların zaten bunun verebileceğinden fazlası var.',
    'add' => 'Rol ekle',

    'role' => 'Rol',
    'role_helper' => 'Ona sahip olan herkes; sonradan alanlar dahil.',
    'servers' => 'Sunucular',
    'servers_helper' => 'Aldıkları sunucular. Buradan birini kaldırmak o erişimi yeniden geri alır.',

    'permissions' => 'Ne yapabilirler',
    'permissions_helper' => 'Pelican\'ın kendi subuser izinleri. Makul bir küme için onları olduğu gibi bırak: konsol, güç düğmeleri, dosyalar, yedekler ve etkinlik günlüğü - ve sunucuyu, kullanıcılarını, veritabanlarını ya da allocation\'larını düzenleyen hiçbir şey. Connect to websocket her zaman dahildir, çünkü onsuz konsol sayfası hiçbir şeye bağlanmaz.',

    'save' => 'Kaydet ve uygula',
    'saved' => 'Kaydedildi',
    'saved_body' => ':added verildi, :removed geri alındı.',
    'save_failed' => 'Kaydedilemedi',
    'save_failed_disk' => 'Liste storage\'a yazılamadı. storage/app dizininin panelin çalıştığı kullanıcıya ait olduğunu denetle.',

    'revoke' => 'Hepsini geri al',
    'revoke_confirm' => 'Bunun verdiği her şey kaldırılsın mı?',
    'revoke_confirm_helper' => 'Bu sayfanın oluşturduğu her subuser satırı, her sunucuda, herkes için - ve onlarla birlikte SFTP\'leri. Elle eklediğin satırlara dokunulmaz. Aşağıdaki eşlemeler kalır, bu yüzden bir sonraki kayıt ya da bir sonraki zamanlayıcı onları yeniden verir: kalıcı olmasını istiyorsan önce listeyi boşalt.',
    'revoked' => ':count kaldırıldı',
    'revoked_body' => 'Yalnızca bu sayfanın oluşturmuş olduğu satırlar. Elle eklenen her şey olduğu yerde.',
    'revoke_failed' => 'Kaldırılamadılar',
];
