<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Oyun modları ve zorluk düzeyleri çevrilmiyor. Minecraft onları oyunun içinde
 * Survival, Creative, Peaceful ve Hard olarak gösteriyor - ve geldiği ekrandan
 * başka bir adı olan bir ayar, iki kez aranan bir ayardır.
 *
 * Aynısı server.properties dosyasının kendisinde duran terimler için de
 * geçerli: whitelist, operator, seed, chunk, RCON, query, resource pack ve the
 * Nether.
 */

return [
    /* ----------------------------------------------- yönetim sekmesi ----- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft ayarları',
    'subheading' => 'Bu sunucunun kendi server.properties dosyası; bir metin dosyası yerine bir form olarak.',

    /*
     * Başlığın kendisi burada değil. Her ayar bölümü başlığını
     * settings.groups.<ad> anahtarından alır; onu group() kurar.
     */
    'section_helper' => 'Hangi egg\'ler için geçerli olduğu ve bu eklentinin Minecraft çevresinde yaptığı diğer her şey.',

    'live' => 'Sunuculara kimin oynadığını sor',
    'live_helper' => 'Oyuncular sayfasına bağlı olanların canlı bir listesini ekler; Minecraft istemcisinin kendi listesinde bir sunucuyu çizmek için yaptığı el sıkışmayla. Varsayılan olarak kapalı, çünkü burada panelden doğrudan bir oyun portuna bağlantı açan tek şey bu: panelin ile node\'ların birbirine ulaşamayan ağlardaysa hiçbir şey yanıt vermez ve satır basitçe belirmez. Oyun sunucusunun kendisinde açılması gereken bir şey yok.',

    'eggs' => 'Hangi egg\'ler Minecraft',
    'eggs_helper' => 'Minecraft sunucusu çalıştıran egg\'leri işaretle - Vanilla, Paper, Purpur, Fabric, Forge ve seninkilerin başka ne adı varsa. Sayfa, onları kullanan sunucuların içinde belirir, başka hiçbir yerde değil. Başlangıçta hiçbir şey işaretli değil ve bu bilerek: bir eklenti egg\'lerine ne ad verdiğini bilemez ve tahmin edilmiş bir liste, çıktığı hafta birinin panelinde yanlış olurdu.',

    /* ---------------------------------------------- sunucunun sayfası ---- */

    'groups' => [
        'general' => 'Sunucu',
        'players' => 'Oyuncular',
        'world' => 'Dünya',
        'performance' => 'Başarım',
        'access' => 'Erişim ve ekler',
        'other' => 'Dosyadaki diğer her şey',
    ],

    'other_helper' => 'server.properties dosyasından okundu ve tam olduğu gibi bırakıldı. Modlar ve modpack\'ler kendi ayarlarını buraya koyar; var olduklarını göresin diye gösterilirler ve dosya yöneticisi üzerinden değiştirilirler. Bu sayfayı kaydetmek onlara hiç dokunmaz.',

    'reload' => 'Dosyayı yeniden oku',

    'saved' => 'server.properties dosyasına kaydedildi',
    'saved_helper' => 'Sunucu bir sonraki kez başladığında etkili olur.',

    'running' => 'Sunucu çalışıyor',
    'running_helper' => 'Minecraft server.properties dosyasını başlarken okur ve dururken geri yazar, bu yüzden şimdi kaydedilen şey çıkarken üzerine yazılırdı. Sunucuyu durdur ve yeniden kaydet.',

    'missing' => 'server.properties bulunamadı',
    'missing_helper' => 'Dosya, sunucu ilk kez başlatıldığında belirir. Onu bir kez başlat ve geri gel.',

    'failed' => 'Kaydedilemedi',
    'failed_helper' => 'Daemon yazmayı reddetti. Bu sayfa açıkken sunucu başlamış olabilir.',

    /* ---------------------------------- her anahtarın anlamı ------------- */

    'keys' => [
        'motd' => 'Sunucu listesindeki ileti',
        'gamemode' => 'Oyun modu',
        'difficulty' => 'Zorluk',
        'hardcore' => 'Hardcore - ölüm kesindir',
        'force_gamemode' => 'Girenleri varsayılan moda geri al',
        'pvp' => 'Oyuncular birbirine zarar verebilir',

        'max_players' => 'Aynı anda en çok oyuncu',
        'white_list' => 'Yalnızca whitelist',
        'enforce_whitelist' => 'Whitelist\'te olmayan herkesi at',
        'online_mode' => 'Hesapları Mojang\'da denetle',
        'player_idle_timeout' => 'Şu kadar boş dakikadan sonra at',
        'op_permission_level' => 'Bir operator ne yapabilir (1–4)',

        'level_name' => 'Dünya klasörü',
        'level_seed' => 'Seed',
        'level_type' => 'Dünya türü',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Canavarlar belirir',
        'spawn_protection' => 'Spawn çevresinde korumalı bloklar',

        'view_distance' => 'Chunk cinsinden görüş uzaklığı',
        'simulation_distance' => 'Chunk cinsinden benzetim uzaklığı',
        'max_tick_time' => 'Watchdog, milisaniye (-1 kapatır)',
        'sync_chunk_writes' => 'Chunk\'ları doğrudan diske yaz',

        'enable_command_block' => 'Command block\'lar',
        'allow_flight' => 'Uçmaya izin ver',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Resource pack adresi',
        'require_resource_pack' => 'Resource pack zorunlu',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
