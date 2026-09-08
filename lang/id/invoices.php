<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Faktur: dokumennya, halaman yang mendaftarnya, dan surelnya.
 *
 * Tiga pembaca berbagi berkas ini. Admin membaca tabel dan menekan "tandai
 * lunas"; pelanggan membaca dokumen yang bisa dicetak dan surelnya; dan
 * dokumen itu sendiri dibaca berbulan-bulan kemudian oleh yang memegang
 * pembukuan. Karena yang terakhir inilah baris doc_ ditulis kering dan resmi -
 * sebuah faktur bukan tempat untuk nada bagian panel yang lain.
 */

return [
    'title' => 'Faktur',
    'nav_label' => 'Faktur',
    'subheading' => 'Apa yang terutang dan apa yang sudah dibayar. Menandainya lunas di sini melakukan semua yang dilakukan pembayaran: server dibuat, yang dihentikan kembali.',

    // ---- tabel -----------------------------------------------------------
    'column_number' => 'Faktur',
    'column_customer' => 'Pelanggan',
    'column_order' => 'Pesanan',
    'column_total' => 'Total',
    'column_state' => 'Keadaan',
    'column_due' => 'Jatuh tempo',

    'kind_order' => 'Faktur pertama',
    'kind_renewal' => 'Perpanjangan',

    'state_unpaid' => 'Belum dibayar',
    'state_paid' => 'Lunas',
    'state_cancelled' => 'Ditarik',

    'no_order' => 'Tanpa pesanan',
    'no_due' => 'Tanpa tanggal',
    'gone_customer' => 'Akun dihapus',
    'discount_of' => 'Potongan :amount dengan :code',
    'paid_via' => 'lewat :how',
    'emailed' => 'Terkirim',
    'not_emailed' => 'Tidak terkirim',
    'filter_overdue' => 'Terlambat',

    // ---- tombol ----------------------------------------------------------
    'open' => 'Buka',
    'mark_paid' => 'Tandai lunas',
    'mark_paid_confirm' => 'Mencatat bahwa uangnya sudah masuk. Server dibuat, yang dihentikan menyala lagi, dan jatuh tempo berikutnya bergeser maju - persis seperti kalau penyedia pembayaran yang mengatakannya.',
    'paid' => 'Ditandai lunas',
    'paid_body' => 'Semua yang menunggu faktur ini sedang dalam perjalanan.',
    'already_paid' => 'Ini sudah lunas sebelumnya',

    'withdraw' => 'Tarik',
    'withdraw_confirm' => 'Mengeluarkan faktur dari pembukuan. Hanya yang belum dibayar yang bisa ditarik; faktur lunas adalah jejak uang yang sudah berpindah tangan.',
    'withdrawn' => 'Ditarik',
    'withdraw_refused' => 'Hanya faktur yang belum dibayar yang bisa ditarik',

    'empty' => 'Belum ada faktur',
    'empty_body' => 'Satu ditulis begitu ada yang membeli, lalu satu tiap periode untuk semua yang diperpanjang.',

    // ---- dokumen ---------------------------------------------------------
    'doc_title' => 'Faktur',
    'doc_number' => 'Nomor',
    'doc_issued' => 'Diterbitkan',
    'doc_due' => 'Jatuh tempo',
    'doc_paid_on' => 'Dibayar',
    'doc_billed_to' => 'Ditagihkan kepada',
    'doc_from' => 'Dari',
    'doc_description' => 'Keterangan',
    'doc_amount' => 'Jumlah',
    'doc_subtotal' => 'Subtotal',
    'doc_discount' => 'Potongan',
    'doc_total' => 'Total',
    'doc_how_to_pay' => 'Cara membayar',
    'doc_print' => 'Cetak atau simpan sebagai PDF',
    'doc_back' => 'Kembali ke panel',

    // ---- surel -----------------------------------------------------------
    'mail_subject' => 'Faktur :number',
    'mail_hello' => 'Halo :name,',
    'mail_intro' => 'Ini faktur :number.',
    'mail_open' => 'Buka fakturnya',
    'mail_foot' => 'Anda bisa membaca faktur ini kapan saja di halaman tagihan Anda.',

    // ---- lonceng ---------------------------------------------------------
    'bell_new' => 'Faktur :number',
    'bell_new_body' => ':total harus dibayar. Buka halaman tagihan Anda untuk membayar.',
    'bell_reminder' => 'Faktur :number sudah lewat jatuh tempo',
    'bell_reminder_body' => 'Masih terbuka sebesar :total. Server yang dibayarnya berhenti pada :date kalau sampai saat itu belum dilunasi, dan tidak ada isinya yang dihapus ketika itu terjadi.',
];
