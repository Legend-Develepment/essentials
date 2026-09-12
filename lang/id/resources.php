<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Mod", "plugin", "loader", "jar" dan nama folder mods/ serta plugins/
 * dibiarkan: persis begitulah tertulis di Modrinth dan di pohon berkas server.
 */

return [
    'nav_label' => 'Mod & plugin',
    'title' => 'Mod dan plugin',
    'subheading' => 'Satu per satu, dari Modrinth, ke server ini.',

    'section' => 'Cari sesuatu',
    'section_helper' => 'Halaman modpack memasang satu pack utuh sekaligus. Yang ini memasang satu mod atau plugin saja, dan itulah yang jauh lebih sering dibutuhkan.',

    'kind' => 'Apa yang kamu tambahkan',
    /*
     * Ditanyakan, bukan disimpulkan. Sebuah egg bernama apa pun yang diberikan
     * seorang administrator, dan beberapa loader membaca kedua folder, jadi dari
     * sini tidak ada cara jujur untuk menebaknya - dan tebakan yang salah
     * menulis sebuah jar ke folder yang tidak dibaca apa pun.
     */
    'kind_helper' => 'Sebuah mod masuk ke mods/ dan untuk Fabric, Forge, atau NeoForge. Sebuah plugin masuk ke plugins/ dan untuk Bukkit, Spigot, atau Paper. Ini juga menentukan separuh Modrinth yang mana yang dicari.',
    'kind_mod' => 'Sebuah mod (mods/)',
    'kind_plugin' => 'Sebuah plugin (plugins/)',

    'search' => 'Cari',
    'search_helper' => 'Ketik sebuah nama lalu klik di luar kotaknya. Hasilnya datang dengan yang paling banyak diunduh lebih dulu.',

    'project' => 'Mod atau plugin',
    'version' => 'Versi',
    'version_helper' => 'Setiap baris adalah nomor versi, versi Minecraft yang menjadi sasarannya, dan loader yang didukungnya. Pilih satu yang cocok dengan servermu - tidak ada di sini yang memeriksanya untukmu.',

    'install' => 'Pasang',
    'install_confirm' => 'Berkasnya diambil node langsung dari Modrinth dan diletakkan di foldernya. Apa pun yang sudah ada di sana tidak dihapus.',
    'installed' => 'Terpasang',
    'installed_helper' => 'Ia dimuat saat server berikutnya dijalankan.',

    'change' => 'Ganti versi',
    'change_helper' => 'Menempatkan versi lain dari proyek yang sama menggantikan berkas ini. Yang baru diunduh sebelum yang lama dihapus, jadi unduhan yang gagal meninggalkanmu dengan apa yang sudah kamu punya.',
    'change_project_helper' => 'Tetap untuk apa pun yang dipasang dari halaman ini. Mengubahnya bukan berarti mengganti versi - itu akan menjadi mod lain dengan nama berkas yang sama.',
    'change_lookup_helper' => 'Berkas ini sudah ada di foldernya, jadi tidak ada di sini yang tahu ia apa. Cari sekali dan itu akan diingat.',
    'changed' => 'Versi diganti',

    'check' => 'Periksa pembaruan',
    'checked' => 'Diperiksa',
    'checked_none' => 'Semua yang dikenali ada di versi terbarunya.',
    'checked_some' => ':count punya versi yang lebih baru. Mereka ditandai di daftar.',
    'update_ready' => 'v:number tersedia',
    /*
     * Dikatakan di sebelah lencananya, bukan di tooltip, karena ini mengubah
     * arti lencana itu. Tidak ada di sini yang tahu versi Minecraft atau loader
     * mana yang dijalankan servernya, jadi terbaru berarti terbaru, bukan
     * terbaru yang akan bekerja.
     */
    'check_note' => 'Lebih baru berarti lebih baru di Modrinth. Tidak ada di sini yang tahu versi Minecraft atau loader mana yang dijalankan servermu, jadi periksa apakah versi yang kamu pilih menyatakan cocok sebelum kamu menjalankan server.',
    'unknown' => 'Bukan dari sini - pakai Ganti versi untuk menyebutkan ini apa',

    'remove' => 'Hapus',
    'remove_confirm' => 'Berkasnya dihapus dari server. Ini tidak dapat dibatalkan dari sini.',
    'removed' => 'Terhapus',

    'running' => 'Server sedang berjalan',
    'running_helper' => 'Minecraft membaca mods/ dan plugins/ sekali, saat mulai. Berkas yang ditambahkan sekarang tidak akan dimuat sampai dijalankan ulang, dan berkas yang ditarik dari bawah game yang sedang berjalan bisa membawa game-nya ikut jatuh. Hentikan servernya dulu.',

    'failed' => 'Itu tidak berhasil',
    'failed_version' => 'Versi itu tidak punya jar yang bisa dipasang oleh ini. Sebagian rilis hanya membawa sumber, atau hanya build untuk klien.',
    'failed_write' => 'Node menolak unduhannya. Mungkin ia tidak dapat menjangkau Modrinth.',

    'installed_title' => 'Terpasang',
    'installed_mods' => 'Di mods/',
    'installed_plugins' => 'Di plugins/',
    /*
     * Dikatakan karena daftar kosong bersifat mendua: biasanya itu berarti
     * server ini memang tidak memakai folder tersebut sama sekali, bukan bahwa
     * ada sesuatu yang hilang.
     */
    'installed_empty' => 'Tidak ada apa-apa di sini. Sebuah server hanya memakai satu dari dua folder ini, jadi salah satunya kosong adalah hal yang wajar.',
    'installed_note' => 'Hanya berkas .jar yang didaftar. Folder konfigurasi dan berkas yang dinonaktifkan dibiarkan dan tidak ditampilkan.',
];
