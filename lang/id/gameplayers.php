<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Siapa yang ada di sebuah server, untuk game yang menjawab kueri Valve.
 *
 * Satu halaman untuk Rust, ARK, Valheim dan lainnya, karena mereka menjawab
 * paket yang sama. Yang berbeda antar-game adalah apa yang bisa kamu lakukan
 * pada seseorang - mengeluarkan orang adalah `kick "nama"` di yang satu dan
 * `KickPlayer <id>` di yang lain - dan karena itulah halaman ini membaca, bukan
 * bertindak.
 */

return [
    'title' => 'Pemain',
    'nav_label' => 'Pemain',
    'subheading' => 'Siapa yang terhubung, ditanyakan pada game itu sendiri, bukan pada panel.',

    'refresh' => 'Tanya lagi',

    'count' => ':count terhubung',
    'score' => 'Skor',

    'just_joined' => 'baru saja masuk',
    'minutes' => ':count mnt',
    'hours' => ':count jam',
    'hours_minutes' => ':hours jam :minutes mnt',

    'empty' => 'Tidak ada siapa pun di server ini.',

    /*
     * Bukan "tidak ada yang online", dan bedanya penting.
     *
     * Panel dan port game sering berada di jaringan yang tidak dapat saling
     * menjangkau, dan menggambarkan itu sebagai daftar kosong berarti halaman
     * ini mengatakan sesuatu yang tidak diketahuinya.
     */
    'unreachable' => 'Server tidak menjawab. Mungkin ia sedang mulai, atau panel tidak dapat menjangkau port game-nya dari tempat ia berjalan — itu hal yang berbeda dari tidak adanya siapa pun.',
];
