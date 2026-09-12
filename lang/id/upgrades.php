<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Memindahkan layanan yang sedang berjalan dari satu paket ke paket lain.
 *
 * Kata-katanya menjaga satu hal tetap jelas dari awal sampai akhir: berapa
 * harga sebuah paket dan berapa biaya pindah ke sana hari ini adalah dua angka
 * yang berbeda. Yang pertama tertera di rak; yang kedua tergantung sudah
 * sejauh mana layanan ini berjalan dalam periode yang dibayar, dan itulah yang
 * disetujui seseorang ketika ia menekan tombolnya.
 *
 * Kata "upgrade" dihindari di teks yang dibaca pelanggan, karena separuh
 * perpindahan ini justru ke arah sebaliknya. Di sini kata yang dipakai adalah
 * ganti.
 */

return [
    // ---- di kartu layanan ------------------------------------------------
    'change' => 'Ganti paket',
    'change_body' => 'Sisa periode yang sudah Anda bayar dipotong, dan hari yang sama dihitung dengan harga baru. Tidak ada isi server Anda yang hilang.',
    'change_to' => 'Ganti ke :name',
    'change_confirm' => 'Ganti layanan ini ke :name?',
    'change_free' => 'Tidak ada yang harus dibayar',
    'costs_now' => ':amount sekarang',
    'gives_back' => ':amount kembali',
    'waiting' => 'Penggantian disepakati',
    'waiting_for' => 'Penggantian ke :name menunggu faktur yang belum dibayar.',

    // ---- apa yang terjadi sesudahnya -------------------------------------
    'done' => 'Dipindahkan ke :name',
    'done_body' => 'Layanan Anda sudah ada di paket baru. Apa pun yang menjadi hak Anda kembali masuk ke akun Anda.',
    'refused' => 'Penggantian tidak dilakukan',

    // ---- dan kenapa tidak, satu alasan sekali ----------------------------
    'refused_off' => 'Ganti paket dimatikan untuk panel ini.',
    'refused_not_active' => 'Hanya layanan yang berjalan yang bisa diganti. Yang masih menunggu, dihentikan atau akan berakhir tidak punya apa-apa untuk dihitung.',
    'refused_gone' => 'Paket yang dipakai layanan ini sudah tidak ada, jadi tidak ada pembandingnya.',
    'refused_same' => 'Itu paket yang sudah dipakainya sekarang.',
    'refused_egg' => 'Paket itu menjalankan perangkat lunak yang lain. Hasilnya server yang berbeda, bukan yang lebih besar, jadi harus dibeli sebagai server baru.',
    'refused_period' => 'Paket itu ditagih atas periode yang berbeda, dan itu kesepakatan yang lain, bukan yang lebih besar.',
    'refused_stock' => 'Paket itu habis terjual.',
    'refused_waiting' => 'Sudah ada penggantian yang menunggu faktur yang belum dibayar untuk layanan ini. Bayar atau batalkan yang itu dulu.',
    'refused_failed' => 'Tidak ada yang dicatat, jadi tidak ada yang berubah. Coba lagi, dan beri tahu yang mengelola panel ini kalau terus terjadi.',
    'refused_server' => 'Server tidak bisa diberi batas yang baru, jadi layanannya dibiarkan persis seperti semula. Yang mengelola panel ini sudah diberi tahu.',

    // ---- yang tertulis di dokumen ----------------------------------------
    'line' => 'Ganti dari :from ke :to, untuk sisa :days hari periode ini',
    'credit_reason' => 'Ganti ke :name',

    // ---- dan yang didengar pemiliknya ------------------------------------
    'bell_failed' => 'Ganti paket gagal pada pesanan :number',
    'cold_title' => 'Ganti paket sampai ke panel tapi tidak ke node, pada pesanan :number',
    'cold_body' => 'Layanannya sudah di :name dan batas yang baru sudah dicatat. Node belum mengambilnya dan baru akan membacanya saat server itu dinyalakan lagi, jadi sampai saat itu pelanggan masih memakai ukuran yang lama. Periksa node-nya.',
    'gone' => 'Paket yang dituju sudah tidak ada.',
    'refused_by_node' => 'Server tidak mau menerima batas yang baru: :why',

    // ---- membereskannya --------------------------------------------------
    'retry' => 'Coba ganti lagi',
    'retry_confirm' => 'Coba ganti paketnya sekali lagi. Fakturnya sudah dibayar, jadi tidak ada yang ditagih dua kali.',
    'retried' => 'Penggantiannya berhasil',
    'retry_failed' => 'Gagal lagi. Alasannya ada di pesanannya.',
];
