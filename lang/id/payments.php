<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Pembayaran: setiap upaya membayar dan apa kata penyedia tentangnya.
 *
 * Satu baris per upaya, bukan per faktur, karena begitulah kejadiannya. Kata
 * yang terus diulang halaman ini adalah "upaya": pembayaran yang gagal itu
 * fakta yang layak disimpan, bukan kesalahan yang perlu disembunyikan.
 */

return [
    'title' => 'Pembayaran',
    'nav_label' => 'Pembayaran',
    'subheading' => 'Setiap upaya membayar, lewat setiap penyedia. Periksa lagi menanyakannya sekali lagi ke penyedia - persis yang dilakukan webhook mereka begitu sampai.',

    // ---- tabel -----------------------------------------------------------
    'column_invoice' => 'Faktur',
    'column_gateway' => 'Penyedia',
    'column_reference' => 'Acuan mereka',
    'column_amount' => 'Jumlah',
    'column_state' => 'Keadaan',
    'column_updated' => 'Kabar terakhir',

    'gone_invoice' => 'Faktur dihapus',

    'state_open' => 'Menunggu',
    'state_paid' => 'Lunas',
    'state_failed' => 'Gagal',
    'state_cancelled' => 'Ditinggalkan',

    // ---- tombol ----------------------------------------------------------
    'recheck' => 'Periksa lagi',
    'rechecked' => 'Sudah ditanyakan lagi',
    'rechecked_body' => 'Penyedia masih belum bilang sudah lunas. Tidak ada yang berubah.',
    'settled' => 'Sudah lunas',
    'settled_body' => 'Fakturnya beres dan semua yang menunggunya sedang dalam perjalanan.',
    'recheck_failed' => 'Tidak bisa bertanya',
    'recheck_failed_body' => 'Penyedia tidak menjawab. Coba semenit lagi; kalau terus begitu, periksa kuncinya di halaman Pengaturan toko.',
    'no_gateway' => 'Penyedia itu sedang mati',
    'no_gateway_body' => 'Nyalakan lagi untuk menanyakan pembayaran ini, atau tandai fakturnya lunas dengan tangan.',

    'answer' => 'Jawaban mereka',
    'no_answer' => 'Tidak ada yang tercatat',
    'close' => 'Tutup',

    'empty' => 'Belum ada yang membayar lewat penyedia',
    'empty_body' => 'Upaya muncul di sini begitu ada yang menekan Bayar, selesai atau tidak.',
];
