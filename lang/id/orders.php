<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Pesanan: apa yang dibeli seseorang dan jadi apa akhirnya.
 *
 * Empat keadaan di bawah bicara soal uang, bukan soal server. Apakah server
 * sedang berjalan sekarang adalah pertanyaan Pelican sendiri dan dijawab di
 * halaman-halaman Pelican. Kata-kata di sini menjaga keduanya tetap terpisah.
 */

return [
    'title' => 'Pesanan',
    'nav_label' => 'Pesanan',
    'subheading' => 'Semua yang sudah dibeli, server yang lahir darinya, dan bagaimana keadaannya.',

    // ---- tabel -----------------------------------------------------------
    'column_order' => 'Pesanan',
    'column_customer' => 'Pelanggan',
    'column_package' => 'Paket',
    'column_server' => 'Server',
    'column_state' => 'Keadaan',
    'column_due' => 'Jatuh tempo berikutnya',

    'no_server' => 'Belum dibuat',
    'no_due' => 'Sekali bayar',
    'gone_customer' => 'Akun dihapus',
    'gone_package' => 'Paket dihapus',
    'overdue_days' => 'Terlambat :days hari',

    'state_pending' => 'Menunggu',
    'state_active' => 'Aktif',
    'state_suspended' => 'Dihentikan',
    'state_cancelled' => 'Dibatalkan',

    // ---- tombol ----------------------------------------------------------
    'retry' => 'Buat lagi',
    'retry_confirm' => 'Menaruh pembuatan di antrean sekali lagi. Tidak ada yang lain berubah, dan fakturnya tetap lunas.',
    'retrying' => 'Ditaruh di antrean',

    'suspend' => 'Hentikan',
    'suspend_confirm' => 'Menghentikan server dengan penangguhan milik Pelican sendiri. Berkas, basis data dan cadangan tetap di tempatnya, dan membayar faktur mengangkatnya kembali.',
    'suspended' => 'Dihentikan',

    'unsuspend' => 'Cabut penghentian',
    'unsuspended' => 'Berjalan lagi',

    'change_due' => 'Ubah jatuh tempo',
    'change_due_helper' => 'Kapan faktur berikutnya ditulis. Kosong berarti tidak pernah - pesanan berhenti diperpanjang tanpa dibatalkan.',

    'cancel' => 'Batalkan',
    'cancel_confirm' => 'Menghentikan perpanjangan dan mengembalikan tempat di stok. Server dibiarkan apa adanya: menghapusnya dilakukan di Pelican, tempatnya di sana.',
    'cancelled' => 'Dibatalkan',

    'saved' => 'Tersimpan',
    'refused' => 'Tidak ada yang berubah',
    'refused_body' => 'Pesanan tidak dalam keadaan yang memungkinkan itu. Muat ulang halamannya dan lihat sekali lagi.',

    // ---- yang didengar pelanggan -----------------------------------------
    'bell_ready' => 'Server Anda siap',
    'bell_ready_body' => ':server sudah dibuat dan menunggu Anda menyalakannya.',
    'bell_suspended' => 'Server Anda dihentikan',
    'bell_suspended_body' => 'Sebuah faktur tetap belum dibayar melewati masa tenggang. Membayarnya menyalakan server lagi; tidak ada yang dihapus.',

    // ---- yang didengar admin ---------------------------------------------
    'bell_failed' => 'Pesanan :number tidak bisa dibuat',
    'no_allocation' => 'Tidak ada node di paket ini yang punya allocation kosong. Tambahkan satu, lalu buat lagi.',
    'no_reason' => 'Panel menolaknya tanpa mengatakan kenapa.',

    // ---- server yang lahir darinya ---------------------------------------
    'server_description' => 'Dibeli di toko, pesanan :number.',
    'server_fallback' => 'Server',

    'empty' => 'Belum ada yang dibeli',
    'empty_body' => 'Pesanan muncul di sini begitu ada yang membeli paket.',

    // ---- perpanjangan ----------------------------------------------------
    'filter_late' => 'Tertinggal satu tagihan',
    'run_renewals' => 'Jalankan perpanjangan sekarang',
    'run_renewals_confirm' => 'Melakukan apa yang dilakukan lintasan malam: menulis faktur berikutnya untuk semua yang segera jatuh tempo, dan menghentikan server di balik tagihan yang tetap belum dibayar melewati masa tenggang.',
    'renewals_queued' => 'Ditaruh di antrean',
    'renewals_queued_body' => 'Berjalan di antrean. Muat ulang sebentar lagi untuk melihat apa yang berubah.',
];
