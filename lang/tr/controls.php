<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Bir sunucu sayfasındaki denetim çubuğu. settings.php'nin bir köşesi değil,
 * kendi dosyası; çünkü bunu paneli kullananlar okuyor, temayı ayarlayan değil.
 *
 * Düğmelerin yanındaki durum, Pelican'ın kendi sözcüğü; ContainerStatus
 * listesinden alındı, ki çubuk ile konsol sayfası bir sunucunun ne yaptığı
 * konusunda hiçbir zaman ayrı düşmesin.
 *
 * "Kill" İngilizce kalıyor: Pelican'ın kendi düğmesinin ve komutun adı bu ve
 * durdurmaktan başka bir şey.
 */

return [
    'console' => 'Konsol',
    'full_page' => 'Yeni pencere',
    'close' => 'Kapat',

    'start' => 'Başlat',
    'restart' => 'Yeniden başlat',
    'stop' => 'Durdur',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill, konteyneri olduğu yerde durdurur. Sunucunun diske henüz yazmadığı her şey kaybolur. Devam edilsin mi?',

    'sent_title' => 'Güç komutu',
    'sent_body' => ':action, :name sunucusuna gönderildi.',
    'failed' => 'Node\'a ulaşılamadı.',
];
