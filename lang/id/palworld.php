<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Pengaturan dunia Palworld, di sebuah halaman alih-alih di sebuah berkas.
 *
 * Tidak ada di sini yang menyebut sebuah pengaturan satu per satu. Setiap label
 * di halaman itu disusun dari kunci yang ada di berkas server itu sendiri -
 * lihat Support\Palworld\Palworld::label() untuk alasan mengapa daftar nama
 * akan lebih buruk daripada tidak ada sama sekali.
 *
 * "Pal" dan "guild" dibiarkan: itu kata milik game itu sendiri, dan itulah yang
 * dilihat orang di dalamnya.
 */

return [
    'title' => 'Pengaturan Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'Pengaturan dunia dari PalWorldSettings.ini milik server ini sendiri, dibaca saat kamu membuka halaman ini. Hanya bisa diubah selagi server berhenti.',

    'reload' => 'Baca ulang berkasnya',

    'save_confirm' => 'Berkas ditulis ulang dengan nilai-nilai ini. Setiap pengaturan yang tidak ditampilkan halaman ini ditulis kembali persis seperti semula, begitu pula semua isi lain di berkas itu.',
    'saved' => 'Pengaturan tersimpan',
    'saved_body' => 'Berlaku saat server berikutnya dijalankan.',
    'save_failed' => 'Berkas tidak dapat ditulis',

    'running' => 'Server sedang berjalan',
    'running_body' => 'Palworld menyimpan pengaturan ini di memori dan menulis ulang berkasnya saat berhenti, jadi perubahan yang disimpan sekarang akan dibatalkan tanpa sepatah kata pun. Hentikan server dulu.',

    'groups' => [
        'server' => 'Server dan koneksi',
        'world' => 'Dunia dan laju',
        'pals' => 'Pals',
        'players' => 'Pemain',
        'building' => 'Bangunan, barang, dan pengumpulan',
        'guild' => 'Guilds',
        'other' => 'Lainnya',
    ],
];
