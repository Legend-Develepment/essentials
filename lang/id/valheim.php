<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "SteamID64" dan "PlayFab ID" tetap persis seperti tertulis di tempat kamu
 * mengambilnya. "Admin" juga tetap: itu kata di dalam berkas game itu sendiri.
 */

return [
    /* ---------------------------------------------- tab administrasi ----- */

    'section_helper' => 'Egg mana yang menjalankan Valheim. Tidak ada yang lain - sebuah server Valheim diatur lewat variabel start-nya, dan halaman Startup milik Pelican sendiri sudah menyunting itu.',

    'eggs' => 'Egg mana yang Valheim',
    'eggs_helper' => 'Centang egg yang menjalankan server Valheim. Halaman Daftar pemain muncul di dalam server yang memakainya dan tidak di tempat lain. Di mana daftar itu berada berbeda-beda per egg, jadi ia disimpulkan per server dengan melihat tempat-tempat yang dipakai game-nya. Awalnya tidak ada yang dicentang, dan itu disengaja - sebuah plugin tidak bisa tahu kamu menamai egg-mu apa.',

    /* -------------------------------------------------- halaman server --- */

    'nav_label' => 'Daftar pemain',
    'title' => 'Daftar pemain Valheim',
    'subheading' => 'Admin, ban, dan daftar yang diizinkan; sebagai tiga daftar alih-alih tiga berkas teks.',

    'admin' => 'Admin',
    'admin_helper' => 'Semua orang di sini dapat memakai perintah admin di dalam game.',
    'banned' => 'Kena ban',
    'banned_helper' => 'Semua orang di sini ditolak ketika mencoba bergabung.',
    'permitted' => 'Diizinkan',
    'permitted_helper' => 'Jika ada orang di daftar ini, hanya merekalah yang boleh bergabung. Daftar kosong membiarkan semua orang masuk - dan itulah yang diinginkan kebanyakan server, jadi biarkan kosong kecuali kamu memang bermaksud lain.',

    'ids' => 'ID pemain',
    'ids_placeholder' => 'Tempel sebuah ID lalu tekan spasi',

    'how' => 'Satu ID per pemain - SteamID64 di server Steam, PlayFab ID di server crossplay. Tempel lalu tekan spasi, tab, atau koma. Apa pun yang ditulis game sebagai komentar di atas daftar tetap di tempatnya.',
    'where' => 'Dibaca dari :dir.',
    'missing' => 'Server ini belum punya satu pun berkas ini. Game menulisnya saat pertama kali membutuhkannya, dan menyimpan di sini akan membuat yang kamu isi.',
    'read_only' => 'Kamu boleh membaca berkas-berkas ini tetapi tidak menulisnya, jadi tidak ada di sini yang bisa diubah.',

    'save' => 'Simpan',
    'saved' => 'Tersimpan',
    'saved_reload' => 'Valheim membaca daftar ini selagi berjalan, jadi perubahannya berlaku tanpa dijalankan ulang.',
    'unchanged' => 'Tidak ada yang berubah, jadi tidak ada yang ditulis',
    'failed' => 'Tidak dapat disimpan',
    'failed_lists' => 'Daemon menolak penulisan untuk: :lists. Periksa apakah server terjangkau dan berkasnya tidak hanya-baca.',
];
