<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Kupon: kode yang memotong sesuatu dari faktur pertama.
 *
 * Hanya dari yang pertama, dengan sengaja, dan teksnya mengatakan itu di
 * tempat yang penting. Kode yang juga memotong tiap perpanjangan akan menjadi
 * perubahan harga dengan tanggal berakhir, dan siapa yang mau begitu sebaiknya
 * mengubah harganya.
 */

return [
    'title' => 'Kupon',
    'nav_label' => 'Kupon',
    'subheading' => 'Kode yang memotong persentase atau jumlah dari faktur pertama. Perpanjangan mengikuti harga paket.',

    // ---- tabel -----------------------------------------------------------
    'column_code' => 'Kode',
    'column_value' => 'Nilai',
    'column_uses' => 'Dipakai',
    'column_expires' => 'Berakhir',
    'column_packages' => 'Berlaku untuk',
    'column_live' => 'Aktif',

    'never_expires' => 'Tanpa tanggal berakhir',
    'all_packages' => 'Semua',
    'some_packages' => ':count paket',
    'usable' => 'Bisa dipakai sekarang',
    'unusable' => 'Mati, kedaluwarsa atau habis',

    // ---- tombol ----------------------------------------------------------
    'new' => 'Kupon baru',
    'edit' => 'Ubah',
    'delete' => 'Hapus',
    'delete_confirm' => 'Menghapus kodenya. Faktur yang sudah memakainya tetap memegang potongannya - masing-masing menyimpan sendiri berapa yang dipotong.',
    'deleted' => 'Kupon dihapus',
    'saved' => 'Kupon tersimpan',
    'save_failed' => 'Kupon tidak bisa disimpan',
    'taken' => 'Kode itu sudah dipakai yang lain.',
    'invalid' => 'Persentase adalah bilangan bulat dari 1 sampai 100. Jumlah ditulis sebagai 12.50 atau 12,50.',

    // ---- formulir --------------------------------------------------------
    'section_code' => 'Kodenya',
    'section_code_helper' => 'Yang diketik pelanggan saat memesan.',
    'code' => 'Kode',
    'code_helper' => 'Disimpan dan dibandingkan dalam huruf besar tanpa spasi, supaya tetap jalan bagaimanapun orang mengetiknya.',
    'live' => 'Aktif',
    'live_helper' => 'Dimatikan membuat kode berhenti bekerja tanpa menghapusnya: ia keluar dari peredaran, sementara potongan yang pernah diberikannya tetap ada di faktur yang memakainya.',

    'section_worth' => 'Berapa yang dipotong',
    'section_worth_helper' => 'Hanya dari faktur pertama. Tidak pernah membawa faktur ke bawah nol.',
    'kind' => 'Jenis',
    'kind_helper' => 'Bagian dari harga, atau jumlah tetap.',
    'kind_percent' => 'Persentase',
    'kind_fixed' => 'Jumlah tetap',
    'value' => 'Nilai',
    'value_percent_helper' => 'Bilangan bulat dari 1 sampai 100.',
    'value_fixed_helper' => 'Dalam mata uang toko. Tulis sebagai 12.50 atau 12,50.',

    'section_limits' => 'Batas',
    'section_limits_helper' => 'Semua di sini boleh dikosongkan. Kode tanpa satu pun dari ini berlaku untuk semua, untuk siapa saja, selamanya.',
    'max_uses' => 'Berapa kali bisa dipakai',
    'max_uses_helper' => 'Dihitung saat pesanan dibuat, bukan saat faktur dibayar - kalau tidak, kode sepuluh pemakaian bisa dipesan seratus kali dalam semalam.',
    'expires' => 'Berakhir',
    'expires_helper' => 'Setelah saat itu kode berhenti bekerja. Kosong berarti itu tidak pernah terjadi.',
    'packages' => 'Paket',
    'packages_helper' => 'Tidak ada yang dicentang berarti setiap paket, sekarang dan nanti.',

    'empty' => 'Belum ada kupon',
    'empty_body' => 'Buat satu, dan ia bekerja saat pemesanan begitu aktif.',
];
