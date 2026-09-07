<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Steam App ID", "IGDB", "Twitch client ID" ve "client secret" İngilizce
 * kalıyor: değerlerin geldiği sayfalarda duran sözcükler tam olarak bunlar.
 */

return [
    'title' => 'Egg görselleri',
    'nav_label' => 'Egg görselleri',
    'subheading' => 'Egg\'lerin için Steam ve IGDB\'den alınan oyun görselleri. Görseli olmayan bir egg, onu kullanan her sunucu kartında Pelican\'ın kendi kuşunu gösterir.',

    // ---- tablo -----------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Kilitli',

    'locked' => 'Kilitli',
    'unlocked' => 'Açık',

    // ---- bir satırla ne yapabilirsin -------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Bir oyunun Steam mağaza adresindeki sayı — store.steampowered.com/app/892970 için 892970. Kimliğe göre almak görseli kilitler; çünkü bir sayı yazmak bir karardır ve sonradan yapılan toplu bir çalışma onu geri almamalıdır.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Şunu ara',
    'search_term_helper' => 'Egg\'in adı dolduruldu, ama bu ender olarak oyunun adıdır — "Paper 1.20.4" Minecraft demektir. Oyunu yaz.',

    'lock' => 'Kilitle',
    'unlock' => 'Kilidi aç',
    'locked_done' => 'Kilitli — toplu alma buna dokunmaz',
    'unlocked_done' => 'Kilidi açık — toplu alma bu görseli değiştirebilir',

    'clear' => 'Temizle',
    'clear_confirm' => 'Görseli ve Steam App ID\'yi kaldırır. Egg, Pelican\'ın kendi kuşuna döner ve bir sonraki toplu alma yeniden dener.',
    'cleared' => 'Görsel kaldırıldı',

    // ---- sonuçlar --------------------------------------------------------
    'fetched' => 'Görsel kaydedildi',
    'failed' => 'Hiçbir görsel kaydedilmedi',

    /*
     * Her biri için ayrı bir neden, çünkü bunlar ayrı sorunlar.
     *
     * Bir yazım hatası yüzünden başarısız olan bir alma ile disk dolu olduğu
     * için başarısız olan bir alma, ikisi birden "başarısız" dememeli — biri
     * sayıya bakarak, öteki sunucuya bakarak çözülür.
     */
    'why_bad_id' => 'Bu bir Steam App ID değil.',
    'why_not_found' => 'Steam\'de o adreste hiçbir şey yok. App ID\'yi denetle — mağaza sayfası olmayan bir oyunun başlık görseli de yoktur.',
    'why_no_match' => 'O adla hiçbir şey bulunamadı. Egg\'in adını değil, oyunun gerçekte ne diye anıldığını dene.',
    'why_no_name' => 'Aranacak bir şey yok.',
    'why_no_token' => 'Twitch bir token vermedi. Kimlik bilgileri altında client ID ve secret\'ı denetle.',
    'why_not_configured' => 'IGDB bir Twitch client ID ve secret ister. Onları Kimlik bilgileri altında ayarla.',
    'why_empty' => 'Yanıt boştu.',
    'why_large' => 'O görsel bir simgeden çok daha büyük ve kaydedilmedi.',
    'why_not_an_image' => 'Geri gelen şey bir görsel değil. Bu genellikle bir hata sayfasının başarı koduyla yanıt verdiği anlamına gelir.',
    'why_wrong_format' => 'O görsel, bu panelin saklamadığı bir biçimde. Pelican PNG, JPEG ve WebP\'yi tutar.',
    'why_unwritable' => 'Görsel yazılamadı. storage/app/public dizininin panelin çalıştığı kullanıcıya ait olduğunu ve php artisan storage:link komutunun çalıştırıldığını denetle.',
    'why_unknown' => 'İşe yaramadı ve neden, bunun bir adı olan nedenlerden değil.',

    // ---- hepsi bir arada -------------------------------------------------
    'bulk' => 'Eksik olanların hepsini al',
    'bulk_confirm_steam' => 'Görseli olmayan ve kilitli olmayan her egg için Steam\'de ada göre arar. Kilitli egg\'ler ve zaten görseli olanlar rahat bırakılır. Bu arka planda çalışır — bittiğinde sana söylenir.',
    'bulk_confirm_both' => 'Görseli olmayan ve kilitli olmayan her egg için Steam\'de ada göre arar, sonra Steam\'in bulamadıkları için IGDB\'yi dener. Kilitli egg\'ler ve zaten görseli olanlar rahat bırakılır. Bu arka planda çalışır — bittiğinde sana söylenir.',

    'bulk_started' => 'Arka planda alınıyor',
    'bulk_started_body' => 'Büyük bir panelde birkaç dakika sürebilir. Bittiğinde bildirim alırsın ve bu sayfadan ayrılabilirsin.',

    'bulk_done' => 'Egg görselleri tamamlandı',
    'bulk_done_body' => ':fetched alındı, :skipped rahat bırakıldı, :failed için hiçbir şey bulunamadı. Bir egg kilitliyse ya da zaten görseli varsa rahat bırakılır.',

    'bulk_failed' => 'Toplu alma çalışmadı',
    'bulk_failed_queue' => 'Kuyruğa verilemedi. Bunun için bir queue worker gerekir — pelican-queue\'nun çalıştığını denetle.',

    // ---- IGDB kimlik bilgileri -------------------------------------------
    'credentials' => 'Kimlik bilgileri',
    'credentials_helper' => 'Steam bunların hiçbiri olmadan çalışır. Bunlar yalnızca IGDB içindir; o da Steam\'in hiç duymadığı oyunları kapsar — Minecraft ve onun her türevi, konsolda çıkmış her şey, moddan geçmiş egg\'lerin çoğu.',
    'credentials_where' => 'dev.twitch.tv/console adresinde bir uygulama oluştur, bir client secret üret ve ikisini de buraya yapıştır. Ücretsizdir.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Kimlik bilgileri kaydedildi',
    'credentials_failed' => 'Kimlik bilgileri kaydedilemedi',
];
