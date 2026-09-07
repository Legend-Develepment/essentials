<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Egg" dan "allocation" dibiarkan: itu kata-kata di Pelican, dan itulah yang
 * dicari orang di halaman node.
 */

return [
    'title' => 'Gandakan server',
    'nav_label' => 'Gandakan server',
    'subheading' => 'Satu server lagi yang disiapkan persis seperti yang sudah kamu punya, atau beberapa sekaligus.',

    'section' => 'Apa yang disalin',
    'section_helper' => 'Pemilik, egg, perintah start, batasan, dan setiap variabel disalin. Berkas, basis data, cadangan, dan jadwal tidak — salinan berkas dari server yang sedang berjalan adalah salinan keadaannya, dan itu jarang yang dimaksud dengan "satu lagi seperti ini".',

    'source' => 'Salin dari',
    'source_helper' => 'Salinannya mendarat di node yang sama dengan server ini, karena di situlah alamat bebasnya berada.',

    'name' => 'Beri nama salinannya',
    'name_helper' => 'Membuat lebih dari satu akan menomorinya: "Bot 1", "Bot 2", dan seterusnya.',

    'copies' => 'Berapa banyak',
    'copies_helper' => 'Pilih sebuah server dulu.',
    'room' => ':count alamat bebas di :node, jadi sebanyak itulah paling banyak yang bisa dibuat sekarang.',
    'no_room' => 'Tidak ada alamat bebas yang tersisa di :node. Sebuah salinan butuh alamatnya sendiri, jadi tambahkan dulu sebuah allocation ke node itu.',

    /*
     * Yang berhasil dihitung dan bukan didaftar, yang gagal didaftar - dan
     * urutan inilah yang menolong: sepuluh nama yang berhasil adalah dinding
     * teks yang tak dibaca siapa pun, sedangkan satu yang gagal adalah satu-
     * satunya yang layak dibaca.
     */
    'made' => ':count salinan dibuat',
    'partly_failed' => ':count salinan tidak dapat dibuat',
    'failed' => 'Tidak ada yang disalin',
];
