<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Palworld'ün dünya ayarları, bir dosyada değil bir sayfada.
 *
 * Burada hiçbir şey tek tek bir ayarı adlandırmıyor. O sayfadaki her etiket,
 * sunucunun kendi dosyasındaki anahtardan çıkarılıyor - bir ad listesinin neden
 * hiç yoktan kötü olacağı için bkz. Support\Palworld\Palworld::label().
 *
 * "Pal" ve "guild" olduğu gibi kalıyor: bunlar oyunun kendi sözcükleri ve insan
 * oyunda onları görüyor.
 */

return [
    'title' => 'Palworld ayarları',
    'nav_label' => 'Palworld',
    'subheading' => 'Bu sunucunun kendi PalWorldSettings.ini dosyasındaki dünya ayarları; bu sayfayı açtığında okundu. Yalnızca sunucu durmuşken düzenlenebilir.',

    'reload' => 'Dosyayı yeniden oku',

    'save_confirm' => 'Dosya bu değerlerle yeniden yazılır. Bu sayfanın göstermediği her ayar tam olduğu gibi geri yazılır, dosyadaki diğer her şey de öyle.',
    'saved' => 'Ayarlar kaydedildi',
    'saved_body' => 'Sunucu bir sonraki kez başladığında etkili olurlar.',
    'save_failed' => 'Dosya yazılamadı',

    'running' => 'Sunucu çalışıyor',
    'running_body' => 'Palworld bu ayarları bellekte tutar ve dururken dosyayı yeniden yazar; bu yüzden şimdi kaydedilen bir değişiklik tek söz edilmeden geri alınırdı. Önce sunucuyu durdur.',

    'groups' => [
        'server' => 'Sunucu ve bağlantı',
        'world' => 'Dünya ve oranlar',
        'pals' => 'Pals',
        'players' => 'Oyuncular',
        'building' => 'İnşa, eşyalar ve toplama',
        'guild' => 'Guilds',
        'other' => 'Diğer',
    ],
];
