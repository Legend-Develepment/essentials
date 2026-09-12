<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Mod", "plugin", "loader", "jar" ve mods/ ile plugins/ klasör adları olduğu
 * gibi kalıyor: Modrinth'te ve sunucunun dosya ağacında tam olarak böyle
 * yazıyorlar.
 */

return [
    'nav_label' => 'Modlar ve eklentiler',
    'title' => 'Modlar ve eklentiler',
    'subheading' => 'Modrinth\'ten bu sunucuya, teker teker.',

    'section' => 'Bir şey bul',
    'section_helper' => 'Modpack sayfası bir seferde bütün bir paketi kurar. Bu, tek bir mod ya da eklenti kurar; istenen de çok daha sık bu olur.',

    'kind' => 'Ne ekliyorsun',
    /*
     * Çıkarım yapılmadı, soruldu. Bir egg'in adı bir yöneticinin ona verdiği
     * addır ve birkaç loader iki klasörü de okur, bu yüzden buradan bunu tahmin
     * etmenin dürüst bir yolu yoktur - ve yanlış bir tahmin, hiçbir şeyin
     * okumadığı bir klasöre jar yazar.
     */
    'kind_helper' => 'Bir mod mods/ klasörüne gider ve Fabric, Forge ya da NeoForge içindir. Bir eklenti plugins/ klasörüne gider ve Bukkit, Spigot ya da Paper içindir. Bu ayrıca Modrinth\'in hangi yarısında arandığını da belirler.',
    'kind_mod' => 'Bir mod (mods/)',
    'kind_plugin' => 'Bir eklenti (plugins/)',

    'search' => 'Ara',
    'search_helper' => 'Bir ad yaz ve kutunun dışına tıkla. Sonuçlar en çok indirilenler başta gelir.',

    'project' => 'Mod ya da eklenti',
    'version' => 'Sürüm',
    'version_helper' => 'Her satır sürüm numarası, hangi Minecraft sürümleri için kurulduğu ve desteklediği loader\'lardır. Sunucuna uyan birini seç - burada hiçbir şey bunu senin yerine denetlemez.',

    'install' => 'Kur',
    'install_confirm' => 'Dosyayı node doğrudan Modrinth\'ten indirir ve klasöre koyar. Orada zaten olan hiçbir şey kaldırılmaz.',
    'installed' => 'Kuruldu',
    'installed_helper' => 'Sunucu bir sonraki kez başladığında yüklenir.',

    'change' => 'Sürümü değiştir',
    'change_helper' => 'Aynı projenin başka bir sürümünü bu dosyanın yerine koyar. Yenisi eskisi silinmeden önce indirilir, bu yüzden başarısız bir indirme seni elindekiyle bırakır.',
    'change_project_helper' => 'Bu sayfadan kurulan her şey için sabit. Onu değiştirmek bir sürüm değişikliği olmazdı - aynı dosya adı altında başka bir mod olurdu.',
    'change_lookup_helper' => 'Bu dosya zaten klasördeydi, bu yüzden burada hiçbir şey onun ne olduğunu bilmiyor. Bir kez ara, hatırlanır.',
    'changed' => 'Sürüm değiştirildi',

    'check' => 'Güncellemeleri denetle',
    'checked' => 'Denetlendi',
    'checked_none' => 'Bilinen her şey en yeni sürümünde.',
    'checked_some' => ':count tanesinin daha yeni bir sürümü var. Listede işaretlendiler.',
    'update_ready' => 'v:number var',
    /*
     * Bir ipucu balonunda değil, rozetin yanında söylendi; çünkü rozetin ne
     * anlama geldiğini değiştiriyor. Burada hiçbir şey sunucunun hangi Minecraft
     * sürümünü ya da hangi loader'ı çalıştırdığını bilmez, bu yüzden en yeni
     * demek en yeni demektir, işe yarayacak en yeni değil.
     */
    'check_note' => 'Daha yeni, Modrinth\'te daha yeni demektir. Burada hiçbir şey sunucunun hangi Minecraft sürümünü ya da hangi loader\'ı çalıştırdığını bilmez, bu yüzden sunucuyu başlatmadan önce seçtiğin sürümün uyduğunu söylediğini denetle.',
    'unknown' => 'Buradan değil - ne olduğunu söylemek için Sürümü değiştir\'i kullan',

    'remove' => 'Kaldır',
    'remove_confirm' => 'Dosya sunucudan silinir. Bu buradan geri alınamaz.',
    'removed' => 'Kaldırıldı',

    'running' => 'Sunucu çalışıyor',
    'running_helper' => 'Minecraft mods/ ve plugins/ klasörlerini başlarken bir kez okur. Şimdi eklenen bir dosya yeniden başlatmaya kadar yüklenmez ve çalışan bir oyunun altından çekilen bir dosya oyunu da yanında götürebilir. Önce sunucuyu durdur.',

    'failed' => 'Bu işe yaramadı',
    'failed_version' => 'O sürümün bunun kurabileceği bir jar\'ı yok. Bazı yayınlar yalnızca kaynak ya da yalnızca istemci derlemesi taşır.',
    'failed_write' => 'Node indirmeyi reddetti. Modrinth\'e ulaşamamış olabilir.',

    'installed_title' => 'Kurulu',
    'installed_mods' => 'mods/ içinde',
    'installed_plugins' => 'plugins/ içinde',
    /*
     * Söylendi, çünkü boş bir liste iki anlamlıdır: genellikle bu sunucunun o
     * klasörü hiç kullanmadığı anlamına gelir, bir şeyin eksik olduğu değil.
     */
    'installed_empty' => 'Burada bir şey yok. Bir sunucu bu iki klasörden yalnızca birini kullanır, bu yüzden birinin boş olması normaldir.',
    'installed_note' => 'Yalnızca .jar dosyaları listelenir. Yapılandırma klasörleri ve devre dışı dosyalar rahat bırakılır ve gösterilmez.',
];
