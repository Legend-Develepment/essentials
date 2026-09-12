<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Modpack", "mod" ve "loader" olduğu gibi kalıyor: bunlar Modrinth'teki ve
 * oyundaki sözcükler ve aranan da bunlar.
 */

return [
    'nav_label' => 'Modpack\'ler',
    'title' => 'Modpack\'ler',
    'subheading' => 'Modrinth\'ten bu sunucuya bir modpack kur.',

    'section' => 'Bir paket bul',
    'section_helper' => 'Yalnızca Modrinth ve yalnızca sunucu tarafı paketleri. Ne hesap ne de API anahtarı ister, buradaki tek kaynak olmasının nedeni bu - ötekilerin her biri, herhangi bir şey görünmeden önce yapıştırılmış bir anahtar istiyor.',

    'search' => 'Ara',
    'search_helper' => 'En çok indirilenler için boş bırak. Arama Modrinth\'e sorar, bu yüzden yazarken değil, alandan çıktığında olur.',

    'pack' => 'Paket',
    'pack_helper' => 'Yalnızca sunucuda çalıştığını söyleyen paketler listelenir.',

    'version' => 'Sürüm',
    'version_helper' => 'Oyun sürümü ve loader her birinin yanında görünür. Bu sunucunun egg\'inin zaten çalıştırdığı loader\'ı seç - bu, dosya kurar; egg\'ini de başlatma komutunu da değiştirmez.',

    'downloads' => 'indirme',

    'install' => 'Bu paketi kur',
    'install_go' => 'Kur',
    'install_confirm' => 'Paketin dosyaları bu sunucuya eklenir. **Hiçbir şey silinmez** - ne dünyan, ne eski modların, ne de bir yapılandırma. Bir paketin üstüne kurulan paket ikisini de bırakır, bu yüzden istediğin buysa önceki paketin modlarını önce kendin kaldır. Sunucu durmuş olmalı ve durmuş kalır.',

    'started' => 'Kuruluyor',
    'started_helper' => 'Paket alınıyor ve açılıyor. Birkaç yüz dosya birkaç dakika sürer ve bittiğinde bildirim alırsın - bu sayfadan ayrılsan da sürer.',

    'running' => 'Sunucu çalışıyor',
    'running_helper' => 'Minecraft modlarını başlarken yükler, bu yüzden şimdi kurulan bir paket, yeniden başlatılana dek ne eski ne de yeni paket olan bir sunucu bırakırdı. Onu durdur ve yeniden dene.',

    'done' => ':pack kuruldu',
    'done_body' => ':files dosya alındı ve paketin kendi klasöründen :overrides öge yerine kondu. Hazır olduğunda sunucuyu başlat.',
    'done_refused' => ':count dosya atlandı, çünkü paket onları buranın indirmediği bir yerden istedi.',

    'failed' => 'Paket kurulmadı',
    'failed_fetch' => 'Paket alınamadı ya da açılamadı. Daemon erişilemez olabilir ya da sunucunun disk alanı bitmiş olabilir.',
    'failed_index' => 'Paket alındı ama içinde okunabilir bir dizin yoktu, bu yüzden kurulacak bir şey yoktu.',
    'failed_version' => 'O sürümün artık indirilecek bir paket dosyası yok. Başka birini seç.',
    'failed_queue' => 'Kurulum kuyruğa alınamadı. Bunun için panelde çalışan bir queue worker gerekir.',
];
