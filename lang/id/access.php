<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Subuser", "Wings", "SFTP", "cron" dan "root admin" dibiarkan: itu kata-kata
 * di Pelican dan di mesinnya, dan itulah yang dicari orang yang pergi memeriksa
 * barisnya.
 */

return [
    'nav_label' => 'Akses server',
    'title' => 'Server menurut peran',
    'subheading' => 'Beri semua orang yang memegang sebuah peran akses ke server yang sama.',

    /*
     * Dikatakan sebelum segala hal lain di halaman ini, karena inilah satu-
     * satunya fitur di sini yang menulis ke tabel milik Pelican.
     */
    'more' => 'Bagaimana ini bekerja',
    'warning' => 'Ini bekerja dengan menjaga subuser milik Pelican sendiri tetap mutakhir - baris yang sama yang akan kamu tambahkan sendiri di halaman Users sebuah server, dan justru itulah yang dibaca daftar server, pemeriksaan izin, dan Wings. Ia hanya menyentuh baris yang dibuatnya sendiri: apa pun yang kamu tambahkan sendiri tidak pernah diubah dan tidak pernah dihapus. Tidak ada yang dikirimi email ketika sebuah peran memberinya sebuah server. Mencabut akses juga mencabut SFTP mereka, dan itu butuh queue worker yang memang sudah diminta Pelican.',

    'never' => 'Belum ada yang diselaraskan. Simpan sebuah pemetaan di bawah dan itu terjadi seketika, lalu setiap menit lewat cron milik panel sendiri.',
    'timing' => 'Akses dicabut tepat saat seharusnya: orang yang kehilangan sebuah peran kehilangan servernya di halaman berikutnya. Pemberian bisa memakan sampai satu menit, karena itulah sapuan yang mencari orang-orang yang saat ini sedang tidak memakai panel.',
    'last_run' => 'Terakhir berjalan :ago detik lalu: :added ditambahkan, :removed dihapus, :held tetap.',
    'capped' => 'Terlalu banyak sekaligus - :pairs pemberian, sedangkan batasnya :max. Tidak ada yang ditulis. Persempit sebuah pemetaan: satu peran dengan lima puluh orang dan dua puluh server saja sudah seribu pemberian.',

    'which' => 'Pemetaannya',
    'which_helper' => 'Sebuah peran, server yang seharusnya dijangkau setiap pemegangnya, dan apa yang boleh mereka lakukan di sana. Orang yang ada di dua peran mendapat semua yang diberikan keduanya. Pemilik server dan root admin dilewati - mereka sudah punya lebih dari yang bisa diberikan ini.',
    'add' => 'Tambahkan sebuah peran',

    'role' => 'Peran',
    'role_helper' => 'Setiap pemegangnya, termasuk siapa pun yang diberi kemudian.',
    'servers' => 'Server',
    'servers_helper' => 'Server yang mereka dapatkan. Menghapus salah satu dari sini mencabut kembali akses itu.',

    'permissions' => 'Apa yang boleh mereka lakukan',
    'permissions_helper' => 'Izin subuser milik Pelican sendiri. Biarkan sebagaimana adanya untuk kumpulan yang masuk akal: konsol, tombol daya, berkas, cadangan, dan catatan aktivitas - dan tidak ada yang menyunting servernya, penggunanya, basis datanya, atau allocation-nya. Connect to websocket selalu ikut, karena tanpanya halaman konsol tidak terhubung ke apa pun.',

    'save' => 'Simpan dan terapkan',
    'saved' => 'Tersimpan',
    'saved_body' => ':added diberikan, :removed diambil kembali.',
    'save_failed' => 'Tidak dapat disimpan',
    'save_failed_disk' => 'Daftar tidak dapat ditulis ke storage. Periksa apakah storage/app dimiliki oleh pengguna yang menjalankan panel.',

    'revoke' => 'Ambil kembali semuanya',
    'revoke_confirm' => 'Hapus semua yang telah diberikan ini?',
    'revoke_confirm_helper' => 'Setiap baris subuser yang dibuat halaman ini, di setiap server, untuk semua orang - beserta SFTP mereka. Baris yang kamu tambahkan sendiri tidak disentuh. Pemetaan di bawah tetap ada, jadi penyimpanan berikutnya atau pewaktu berikutnya akan memberikannya lagi: kosongkan dulu daftarnya kalau kamu memang ingin selamanya.',
    'revoked' => ':count dihapus',
    'revoked_body' => 'Hanya baris yang dibuat halaman ini. Apa pun yang ditambahkan sendiri tetap di tempatnya.',
    'revoke_failed' => 'Tidak dapat dihapus',
];
