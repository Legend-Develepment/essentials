<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Pengaturan toko, dan nanti tokonya sendiri.
 *
 * Dua pembaca berbagi berkas ini dengan sengaja. Bagian pengaturan dibaca oleh
 * admin; bagian publik dan bagian pelanggan - yang ditambahkan seiring toko
 * bertumbuh - dibaca orang yang mungkin belum pernah mendengar Pelican, dan
 * setiap kalimat di sana harus ditulis untuk mereka.
 */

return [
    'title' => 'Pengaturan toko',
    'nav_label' => 'Pengaturan toko',
    'subheading' => 'Mata uang, pajak, penomoran faktur dan apa yang dikatakan halaman publik. Yang dijual ada di halaman Paket.',

    // ---- di mana ---------------------------------------------------------
    'address' => 'Toko publik ada di',
    'address_off' => 'Halaman publik dimatikan. Nyalakan "Halaman toko publik" pada daftar fitur di halaman Pengaturan Essentials dan halaman itu akan menjawab di :url.',

    // ---- umum ------------------------------------------------------------
    'section_general' => 'Uang',
    'section_general_helper' => 'Satu mata uang untuk seluruh toko. Setiap harga setiap paket adalah angka dalam mata uang itu.',
    'currency' => 'Mata uang',
    'currency_helper' => 'Menggantinya tidak menghitung ulang apa pun: harga paket adalah angka, dan setelah diganti tetap angka dalam mata uang baru.',
    'tax' => 'Pajak',
    'tax_helper' => 'Persentase yang ditambahkan ke setiap faktur sebagai baris tersendiri. Harga paket belum termasuk pajak. Nol berarti tidak ada.',
    'tax_suffix' => '%',
    'prefix' => 'Nomor faktur diawali dengan',
    'prefix_helper' => 'Diikuti nomor yang naik. INV- menghasilkan INV-000001.',

    // ---- perpanjangan ----------------------------------------------------
    'section_renewals' => 'Perpanjangan',
    'section_renewals_helper' => 'Untuk paket yang ditagih bulanan, tiga bulanan atau tahunan. Paket sekali bayar tidak pernah tersentuh oleh ini.',
    'notice_days' => 'Terbitkan faktur sekian hari sebelum periode berakhir',
    'notice_days_helper' => 'Kapan faktur berikutnya dibuat dan pelanggan diberi tahu.',
    'grace' => 'Hentikan sekian hari setelah jatuh tempo faktur',
    'grace_helper' => 'Faktur yang belum dibayar melewati batas ini menghentikan server — dengan penangguhan milik Pelican sendiri, yang dicabut begitu faktur dibayar. Toko tidak pernah menghapus apa pun.',
    'days' => 'hari',

    // ---- halaman publik --------------------------------------------------
    'section_public' => 'Halaman publik',
    'section_public_helper' => 'Dibaca orang tanpa akun. Apakah halaman ini tampil sama sekali diputuskan oleh sakelar "Halaman toko publik" pada daftar fitur.',
    'heading' => 'Judul',
    'heading_helper' => 'Dibiarkan kosong, nama panel itu sendiri yang dipakai.',
    'note' => 'Baris di atas paket',
    'note_helper' => 'Untuk mengatakan siapa Anda atau apa yang didapat dari pembelian. Teks biasa.',
    'terms_url' => 'Syarat dan ketentuan',
    'terms_url_helper' => 'Alamat https. Jika diisi, membeli berarti mencentang kotak yang menunjuk ke sana.',

    // ---- bayar manual ----------------------------------------------------
    'section_manual' => 'Pembayaran tanpa penyedia',
    'section_manual_helper' => 'Ditampilkan pada faktur yang belum dibayar selama belum ada penyedia pembayaran yang aktif: rekening bank atau ke mana uang dikirim. Teks biasa.',
    'pay_note' => 'Cara membayar',
    'pay_note_helper' => 'Biarkan kosong dan faktur yang belum dibayar hanya mengatakan bahwa faktur itu belum dibayar.',

    // ---- tombol ----------------------------------------------------------
    'save' => 'Simpan',
    'saved' => 'Tersimpan',
    'save_failed' => 'Tidak ada yang tersimpan',
];
