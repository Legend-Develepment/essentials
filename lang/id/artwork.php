<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Steam App ID", "IGDB", "Twitch client ID" dan "client secret" tetap dalam
 * bahasa Inggris: persis kata-kata itulah yang tertulis di halaman tempat
 * nilainya berasal.
 */

return [
    'title' => 'Gambar egg',
    'nav_label' => 'Gambar egg',
    'subheading' => 'Gambar game untuk egg-mu, diambil dari Steam dan IGDB. Sebuah egg tanpa gambar menampilkan burung milik Pelican sendiri di setiap kartu server yang memakainya.',

    // ---- tabel -----------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Terkunci',

    'locked' => 'Terkunci',
    'unlocked' => 'Terbuka',

    // ---- apa yang bisa dilakukan pada satu baris -------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Angka di alamat toko Steam sebuah game - store.steampowered.com/app/892970 berarti 892970. Mengambil berdasarkan id akan mengunci gambarnya, karena mengetik sebuah angka adalah sebuah keputusan dan pengambilan massal di kemudian hari tidak boleh membatalkannya.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Cari',
    'search_term_helper' => 'Nama egg sudah diisi, tetapi itu jarang menjadi nama game-nya - "Paper 1.20.4" adalah Minecraft. Ketik nama game-nya.',

    'lock' => 'Kunci',
    'unlock' => 'Buka kunci',
    'locked_done' => 'Terkunci - pengambilan massal akan membiarkan yang ini',
    'unlocked_done' => 'Terbuka - pengambilan massal boleh mengganti gambar ini',

    'clear' => 'Kosongkan',
    'clear_confirm' => 'Menghapus gambar dan Steam App ID-nya. Egg-nya kembali ke burung milik Pelican sendiri, dan pengambilan massal berikutnya akan mencoba lagi.',
    'cleared' => 'Gambar dihapus',

    // ---- hasil -----------------------------------------------------------
    'fetched' => 'Gambar tersimpan',
    'failed' => 'Tidak ada gambar yang tersimpan',

    /*
     * Satu alasan untuk masing-masing, karena itu masalah yang berbeda.
     *
     * Pengambilan yang gagal karena salah ketik dan yang gagal karena disknya
     * penuh tidak boleh sama-sama berkata "gagal" - yang pertama diperbaiki
     * dengan melihat angkanya, yang kedua dengan melihat servernya.
     */
    'why_bad_id' => 'Itu bukan Steam App ID.',
    'why_not_found' => 'Steam tidak punya apa pun di alamat itu. Periksa App ID-nya - game tanpa halaman toko juga tidak punya gambar header.',
    'why_no_match' => 'Tidak ada yang ditemukan dengan nama itu. Coba nama game-nya yang sebenarnya, bukan nama egg-nya.',
    'why_no_name' => 'Tidak ada yang bisa dicari.',
    'why_no_token' => 'Twitch tidak mau menerbitkan token. Periksa client ID dan secret di Kredensial.',
    'why_not_configured' => 'IGDB butuh Twitch client ID dan secret. Setel keduanya di Kredensial.',
    'why_empty' => 'Jawabannya kosong.',
    'why_large' => 'Gambar itu jauh lebih besar dari sebuah ikon dan tidak disimpan.',
    'why_not_an_image' => 'Yang kembali bukan sebuah gambar. Itu biasanya berarti sebuah halaman kesalahan menjawab dengan kode sukses.',
    'why_wrong_format' => 'Gambar itu dalam format yang tidak disimpan panel ini. Pelican menyimpan PNG, JPEG dan WebP.',
    'why_unwritable' => 'Gambarnya tidak dapat ditulis. Periksa apakah storage/app/public dimiliki oleh pengguna yang menjalankan panel, dan apakah php artisan storage:link sudah dijalankan.',
    'why_unknown' => 'Ini tidak berhasil, dan alasannya bukan yang punya nama di sini.',

    // ---- semuanya sekaligus ----------------------------------------------
    'bulk' => 'Ambil semua yang belum ada',
    'bulk_confirm_steam' => 'Mencari di Steam berdasarkan nama untuk setiap egg yang belum punya gambar dan tidak terkunci. Egg yang terkunci dan yang sudah punya gambar dibiarkan. Ini berjalan di latar belakang - kamu akan diberi tahu ketika selesai.',
    'bulk_confirm_both' => 'Mencari di Steam berdasarkan nama untuk setiap egg yang belum punya gambar dan tidak terkunci, lalu mencoba IGDB untuk yang tidak ditemukan Steam. Egg yang terkunci dan yang sudah punya gambar dibiarkan. Ini berjalan di latar belakang - kamu akan diberi tahu ketika selesai.',

    'bulk_started' => 'Sedang diambil di latar belakang',
    'bulk_started_body' => 'Ini bisa memakan beberapa menit di panel yang besar. Kamu mendapat pemberitahuan ketika selesai, dan kamu boleh meninggalkan halaman ini.',

    'bulk_done' => 'Gambar egg selesai',
    'bulk_done_body' => ':fetched terambil, :skipped dibiarkan, :failed tidak ditemukan apa pun. Sebuah egg dibiarkan jika ia terkunci atau sudah punya gambar.',

    'bulk_failed' => 'Pengambilan massal tidak berjalan',
    'bulk_failed_queue' => 'Ia tidak dapat diserahkan ke antrean. Ini butuh sebuah queue worker - periksa apakah pelican-queue berjalan.',

    // ---- kredensial IGDB -------------------------------------------------
    'credentials' => 'Kredensial',
    'credentials_helper' => 'Steam bekerja tanpa satu pun dari ini. Ini hanya untuk IGDB, yang mencakup game yang tidak pernah didengar Steam - Minecraft dan setiap turunannya, apa pun yang rilis di konsol, kebanyakan egg yang dimodifikasi.',
    'credentials_where' => 'Buat sebuah aplikasi di dev.twitch.tv/console, hasilkan sebuah client secret, lalu tempel keduanya di sini. Gratis.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Kredensial tersimpan',
    'credentials_failed' => 'Kredensial tidak dapat disimpan',
];
