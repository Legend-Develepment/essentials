<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "SteamID64" ve "PlayFab ID" tam olarak alındıkları yerlerde yazıldıkları gibi
 * kalıyor. "Admin" de kalıyor: oyunun kendi dosyasındaki sözcük bu.
 */

return [
    /* ----------------------------------------------- yönetim sekmesi ----- */

    'section_helper' => 'Hangi egg\'ler Valheim çalıştırıyor. Başka bir şey değil — bir Valheim sunucusu başlatma değişkenleriyle ayarlanır ve Pelican\'ın kendi Startup sayfası onları zaten düzenler.',

    'eggs' => 'Hangi egg\'ler Valheim',
    'eggs_helper' => 'Valheim sunucusu çalıştıran egg\'leri işaretle. Oyuncu listeleri sayfası, onları kullanan sunucuların içinde belirir, başka hiçbir yerde değil. O listelerin nerede durduğu egg\'e göre değişir, bu yüzden oyunun kullandığı yerlere bakılarak her sunucu için ayrı ayrı bulunur. Başlangıçta hiçbir şey işaretli değil, bilerek — bir eklenti egg\'lerine ne ad verdiğini bilemez.',

    /* ---------------------------------------------- sunucunun sayfası ---- */

    'nav_label' => 'Oyuncu listeleri',
    'title' => 'Valheim oyuncu listeleri',
    'subheading' => 'Admin\'ler, ban\'lar ve izin verilenler listesi; üç metin dosyası yerine üç liste olarak.',

    'admin' => 'Admin\'ler',
    'admin_helper' => 'Buradaki herkes oyun içinde admin komutlarını kullanabilir.',
    'banned' => 'Ban\'lı',
    'banned_helper' => 'Buradaki herkes katılmaya çalıştığında geri çevrilir.',
    'permitted' => 'İzin verilenler',
    'permitted_helper' => 'Bu listede biri varsa, yalnızca onlar katılabilir. Boş liste herkesi içeri alır — çoğu sunucunun istediği de budur, bu yüzden başka bir şey demek istemiyorsan boş bırak.',

    'ids' => 'Oyuncu kimlikleri',
    'ids_placeholder' => 'Bir kimlik yapıştır ve boşluğa bas',

    'how' => 'Oyuncu başına bir kimlik — Steam sunucusunda SteamID64, crossplay olanda PlayFab ID. Onları yapıştır ve boşluğa, sekmeye ya da virgüle bas. Oyunun listenin üstüne yorum olarak yazdığı her şey olduğu yerde kalır.',
    'where' => ':dir konumundan okundu.',
    'missing' => 'Bu sunucuda bu dosyaların hiçbiri henüz yok. Oyun onları ilk gerektiğinde yazar ve burada kaydetmek, doldurduklarını oluşturur.',
    'read_only' => 'Bu dosyaları okuyabilirsin ama yazamazsın, bu yüzden burada hiçbir şey değiştirilemez.',

    'save' => 'Kaydet',
    'saved' => 'Kaydedildi',
    'saved_reload' => 'Valheim bu listeleri çalışırken okur, bu yüzden değişiklik yeniden başlatmadan geçerli olur.',
    'unchanged' => 'Hiçbir şey değişmemişti, bu yüzden hiçbir şey yazılmadı',
    'failed' => 'Kaydedilemedi',
    'failed_lists' => 'Daemon şunlar için yazmayı reddetti: :lists. Sunucunun erişilebilir olduğunu ve dosyaların salt okunur olmadığını denetle.',
];
