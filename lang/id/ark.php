<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "GameUserSettings.ini" dan "Startup" ditulis sebagaimana adanya di dalam game
 * dan di Pelican - itulah nama yang dicari orang.
 */

return [
    /* ---------------------------------------------- tab administrasi ----- */

    /*
     * Judulnya sendiri tidak ada di sini. Setiap bagian pengaturan mengambil
     * judulnya dari settings.groups.<nama>, yang disusun oleh group().
     */
    'section_helper' => 'Egg mana yang menjalankan ARK. Tidak ada yang lain — sisa dari sebuah server ARK diatur lewat variabel start-nya, dan halaman Startup milik Pelican sendiri sudah menyunting itu.',

    'eggs' => 'Egg mana yang ARK',
    'eggs_helper' => 'Centang egg yang menjalankan server ARK. Halaman Pengaturan dunia muncul di dalam server yang memakainya dan tidak di tempat lain. Ini pertanyaan yang berbeda dari yang di halaman status: yang itu menanyakan egg mana yang menjawab kueri Valve, yang juga dilakukan Rust dan Valheim, sedangkan yang ini menanyakan egg mana yang menyimpan GameUserSettings.ini di tempat ARK menyimpannya, yang hanya dilakukan ARK. Awalnya tidak ada yang dicentang, dan itu disengaja — sebuah plugin tidak bisa tahu kamu menamai egg-mu apa.',

    /* -------------------------------------------------- halaman server --- */

    'nav_label' => 'Pengaturan dunia',
    'title' => 'Pengaturan dunia ARK',
    'subheading' => 'Pengaturan yang benar-benar diubah orang, dari GameUserSettings.ini.',

    'group_server' => 'Servernya',
    'group_server_helper' => 'Nama servernya, siapa yang boleh bergabung, dan berapa banyak.',
    'group_rates' => 'Laju',
    'group_rates_helper' => 'Seberapa cepat segala sesuatu terjadi. 1.0 adalah game seperti aslinya; 2.0 dua kali lebih cepat.',
    'group_rules' => 'Aturan',
    'group_rules_helper' => 'Apa yang boleh dilakukan pemain dan apa yang ditampilkan game kepada mereka.',

    'keeps' => 'Lima belas pengaturan dari sebuah berkas yang berisi ratusan. Semua lainnya di dalamnya — pengaturan mod-mu, kunci yang belum pernah didengar plugin ini, komentar, dan urutan semuanya — dibiarkan persis seperti adanya saat kamu menyimpan.',
    'missing' => 'Server ini belum punya GameUserSettings.ini. Game menulisnya saat pertama kali berjalan, jadi jalankan servernya sekali lalu halaman ini akan terisi.',
    'read_only' => 'Kamu boleh membaca berkas ini tetapi tidak menulisnya, jadi tidak ada di sini yang bisa diubah.',

    'save' => 'Simpan',
    'saved' => 'Tersimpan',
    'saved_restart' => 'ARK membaca berkas ini saat mulai, jadi jalankan ulang server agar perubahannya berlaku.',
    'failed' => 'Tidak dapat disimpan',
    'failed_write' => 'Daemon menolak penulisan. Periksa apakah server terjangkau dan berkasnya tidak hanya-baca.',
];
