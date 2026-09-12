<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Saldo, pengembalian dana dan nota kredit.
 *
 * Dua kata sengaja dijaga tetap terpisah di seluruh berkas ini.
 *
 * "Saldo" adalah uang yang dipegang toko untuk seseorang. Uang itu dipotong
 * sendiri dari faktur mereka berikutnya, sebelum mereka pernah diminta
 * membayar.
 *
 * "Pengembalian dana" adalah tindakan mengembalikan uang, dan tujuannya ada
 * dua: ke kartu asalnya, atau ke akun sebagai saldo. Teksnya selalu menyebut
 * yang mana, karena pelanggan yang diberi tahu "dana Anda sudah dikembalikan"
 * lalu tidak menemukan apa-apa di banknya pasti akan menulis surat, dan memang
 * sepantasnya.
 *
 * "Nota kredit" adalah dokumennya. Satu ditulis dengan cara apa pun, karena ia
 * adalah catatan bahwa uangnya tidak lagi terutang kepada toko - bukan klaim
 * tentang ke mana uang itu pergi.
 */

return [
    // ---- yang dilihat pelanggan ------------------------------------------
    'yours' => 'Saldo Anda',
    'yours_body' => 'Ini otomatis dipotong dari faktur Anda berikutnya. Anda tidak perlu berbuat apa-apa dengannya.',
    'applied' => 'Dibayar dari saldo Anda',
    'payable' => 'Sisa yang harus dibayar',

    // ---- buku besarnya, di jendela pelanggan -----------------------------
    'held' => 'Saldo',
    'none_held' => 'Tidak ada saldo di akun',
    'movements' => 'Saldo',
    'column' => 'Saldo',
    'none' => 'Tidak ada',

    // ---- memberikannya ---------------------------------------------------
    'give' => 'Saldo',
    'give_helper' => 'Akun ini punya :held. Yang Anda taruh di sini dipotong sendiri dari faktur mereka berikutnya. Jumlah negatif menarik saldo kembali, dan kedua gerakan itu tetap tersimpan di riwayat.',
    'amount' => 'Jumlah',
    'amount_helper' => 'Jumlah negatif menarik saldo, bukan memberikannya.',
    'reason' => 'Alasan',
    'reason_helper' => 'Pelanggan melihat ini di samping jumlahnya, jadi tulislah untuk mereka, bukan untuk arsip.',
    'given' => 'Saldo :amount untuk :who',
    'bad_amount' => 'Itu bukan jumlah uang.',
    'give_failed' => 'Saldonya tidak diberikan',
    'give_failed_body' => 'Tidak ada yang ditulis. Coba lagi, dan lihat log kalau terus terjadi.',
    'take_failed' => 'Saldonya tidak ditarik',
    'take_failed_body' => 'Saldo di akun itu lebih sedikit daripada yang Anda minta untuk ditarik. Saldo tidak pernah dibawa turun di bawah nol.',

    // ---- apa kata sebuah gerakan -----------------------------------------
    'spent_on' => 'Faktur :number',
    'returned' => 'Dikembalikan: faktur yang dituju tidak bisa ditulis',
    'note_line' => 'Nota kredit untuk faktur :number',
    'refund_description' => 'Pengembalian dana faktur :number',

    // ---- mengembalikannya ------------------------------------------------
    'refund' => 'Kembalikan dana',
    'refund_helper' => ':left dari faktur ini belum dikembalikan. Nota kredit tetap ditulis bagaimanapun caranya, jadi ada catatannya di kedua sisi.',
    'refund_amount_helper' => 'Sebagian saja boleh. Sisanya bisa dikembalikan nanti.',
    'refund_reason_helper' => 'Ini dicetak pada nota kredit yang bisa dibuka pelanggan.',
    'where' => 'Uangnya ke mana',
    'where_provider' => 'Kembali lewat cara mereka membayar',
    'where_provider_helper' => 'Penyedia mengirimkannya ke kartu atau rekening asalnya. Butuh beberapa hari sampai terlihat, dan mereka bisa menolak - pembayaran yang sudah lama, atau metode yang tidak bisa dibalik.',
    'where_balance' => 'Ke akun mereka di sini',
    'where_balance_helper' => 'Uangnya menjadi saldo dan dipotong dari faktur mereka berikutnya. Tidak ada yang keluar dari bank, dan ini tidak bisa gagal.',
    'refunded' => ':amount dikembalikan',
    'refunded_body' => 'Nota kredit :number ditulis untuk itu.',
    'refund_failed' => 'Tidak ada yang dikembalikan',

    // ---- dan kenapa tidak, satu alasan sekali ----------------------------
    'refused_off' => 'Saldo dan pengembalian dana dimatikan untuk panel ini.',
    'refused_amount' => 'Itu lebih besar daripada sisa faktur ini.',
    'refused_no_payment' => 'Tidak ada pembayaran di faktur ini yang sisanya sebanyak itu, jadi tidak ada yang bisa dibalik oleh penyedia. Taruh saja di akun mereka.',
    'refused_no_gateway' => 'Penyedia yang dipakai membayar ini sudah tidak dinyalakan, jadi tidak bisa diminta membalikkan apa pun. Taruh saja di akun mereka.',
    'refused_refused' => 'Penyedianya menolak. Biasanya itu pembayaran yang sudah lama atau metode yang tidak bisa dibalik; alasan yang mereka berikan ada di log. Taruh saja di akun mereka.',
    'refused_note_failed' => 'Uangnya berpindah tapi nota kreditnya tidak mau ditulis, jadi tidak ada yang tercatat. Lihat log dulu sebelum mencoba lagi.',

    // ---- menambah uang ---------------------------------------------------
    'topup' => 'Tambah saldo',
    'topup_helper' => 'Anda punya :held di akun. Yang Anda tambahkan di sini dipotong sendiri dari faktur Anda berikutnya, dan faktur yang sudah terbuka dilunasi dari situ begitu uangnya masuk.',
    'topup_go' => 'Lanjut ke pembayaran',
    'topup_amount_helper' => 'Antara :least dan :most.',
    'topup_bad' => 'Jumlah itu tidak bisa dibayar',
    'topup_failed' => 'Pembayarannya tidak bisa dimulai. Coba lagi, dan beri tahu yang mengelola panel ini kalau terus terjadi.',
    'topup_line' => 'Saldo ditambahkan ke akun',
    'topup_reason' => 'Ditambahkan pada faktur :number',

    // ---- di mana ini ditampilkan -----------------------------------------
    'menu' => 'saldo :amount',
    'held_helper' => 'Dipotong sendiri dari faktur Anda berikutnya. Tambah lewat halaman faktur.',
];
