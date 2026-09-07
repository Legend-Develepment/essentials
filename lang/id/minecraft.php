<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Mode permainan dan tingkat kesulitan tidak diterjemahkan. Minecraft
 * menampilkannya di dalam game sebagai Survival, Creative, Peaceful dan Hard —
 * dan sebuah pengaturan yang namanya berbeda dari layar asalnya adalah
 * pengaturan yang dicari orang dua kali.
 *
 * Begitu pula istilah yang tertulis di server.properties itu sendiri: whitelist,
 * operator, seed, chunk, RCON, query, resource pack dan the Nether.
 */

return [
    /* ---------------------------------------------- tab administrasi ----- */

    'nav_label' => 'Minecraft',
    'title' => 'Pengaturan Minecraft',
    'subheading' => 'server.properties milik server ini sendiri, sebagai formulir alih-alih berkas teks.',

    /*
     * Judulnya sendiri tidak ada di sini. Setiap bagian pengaturan mengambil
     * judulnya dari settings.groups.<nama>, yang disusun oleh group().
     */
    'section_helper' => 'Egg mana yang berlaku untuknya, dan segala hal lain yang dilakukan plugin ini seputar Minecraft.',

    'live' => 'Tanyakan pada server siapa yang sedang bermain',
    'live_helper' => 'Menambahkan daftar langsung siapa yang terhubung ke halaman Pemain, dengan jabat tangan yang sama seperti yang dilakukan klien Minecraft untuk menggambar sebuah server di daftarnya sendiri. Mati secara bawaan, karena inilah satu-satunya hal di sini yang membuka koneksi dari panel langsung ke sebuah port game: kalau panel dan node-mu ada di jaringan yang tidak saling menjangkau, tidak ada yang menjawab, dan barisnya cukup tidak muncul. Di server game-nya sendiri tidak ada yang perlu dinyalakan.',

    'eggs' => 'Egg mana yang Minecraft',
    'eggs_helper' => 'Centang egg yang menjalankan server Minecraft — Vanilla, Paper, Purpur, Fabric, Forge, dan apa pun nama milikmu. Halamannya muncul di dalam server yang memakainya dan tidak di tempat lain. Awalnya tidak ada yang dicentang, dan itu disengaja: sebuah plugin tidak bisa tahu kamu menamai egg-mu apa, dan daftar tebakan akan salah di panel seseorang sejak pekan perilisannya.',

    /* -------------------------------------------------- halaman server --- */

    'groups' => [
        'general' => 'Servernya',
        'players' => 'Pemain',
        'world' => 'Dunianya',
        'performance' => 'Kinerja',
        'access' => 'Akses dan tambahan',
        'other' => 'Semua lainnya di berkas itu',
    ],

    'other_helper' => 'Dibaca dari server.properties dan dibiarkan persis seperti adanya. Mod dan modpack menaruh pengaturannya sendiri di sini; mereka ditampilkan supaya kamu tahu bahwa mereka ada, dan diubah lewat pengelola berkas. Menyimpan halaman ini tidak pernah menyentuh mereka.',

    'reload' => 'Baca ulang berkasnya',

    'saved' => 'Tersimpan ke server.properties',
    'saved_helper' => 'Berlaku saat server berikutnya dijalankan.',

    'running' => 'Server sedang berjalan',
    'running_helper' => 'Minecraft membaca server.properties saat mulai dan menulisnya kembali saat berhenti, jadi apa yang disimpan sekarang akan ditimpa saat ia keluar. Hentikan servernya lalu simpan lagi.',

    'missing' => 'Tidak ditemukan server.properties',
    'missing_helper' => 'Berkasnya muncul ketika server dijalankan untuk pertama kali. Jalankan sekali lalu kembali ke sini.',

    'failed' => 'Tidak dapat disimpan',
    'failed_helper' => 'Daemon menolak penulisan. Servernya mungkin sudah mulai selagi halaman ini terbuka.',

    /* -------------------------------- apa arti setiap kunci -------------- */

    'keys' => [
        'motd' => 'Pesan di daftar server',
        'gamemode' => 'Mode permainan',
        'difficulty' => 'Kesulitan',
        'hardcore' => 'Hardcore — kematian bersifat akhir',
        'force_gamemode' => 'Kembalikan semua orang ke mode bawaan saat masuk',
        'pvp' => 'Pemain dapat saling melukai',

        'max_players' => 'Paling banyak pemain sekaligus',
        'white_list' => 'Hanya whitelist',
        'enforce_whitelist' => 'Keluarkan siapa pun yang tidak ada di whitelist',
        'online_mode' => 'Periksa akun di Mojang',
        'player_idle_timeout' => 'Keluarkan setelah sekian menit tanpa aktivitas',
        'op_permission_level' => 'Apa yang boleh dilakukan operator (1–4)',

        'level_name' => 'Folder dunia',
        'level_seed' => 'Seed',
        'level_type' => 'Jenis dunia',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Monster bermunculan',
        'spawn_protection' => 'Blok terlindungi di sekitar spawn',

        'view_distance' => 'Jarak pandang dalam chunk',
        'simulation_distance' => 'Jarak simulasi dalam chunk',
        'max_tick_time' => 'Watchdog, dalam milidetik (-1 mematikannya)',
        'sync_chunk_writes' => 'Tulis chunk langsung ke disk',

        'enable_command_block' => 'Command block',
        'allow_flight' => 'Izinkan terbang',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Alamat resource pack',
        'require_resource_pack' => 'Resource pack diwajibkan',
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
