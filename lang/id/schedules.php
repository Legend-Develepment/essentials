<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Cron" dibiarkan: itu nama benda yang berjalan di mesin panel, dan orang yang
 * pergi memeriksanya mencari kata itu.
 */

return [
    'nav_label' => 'Jadwal',
    'title' => 'Jadwal mana yang berhenti',
    'subheading' => 'Setiap tugas terjadwal di panel, yang terburuk lebih dulu - tersangkut lebih dari :hours jam, terlambat, atau belum pernah berjalan.',

    'how' => 'Pelican menampilkan jadwal di dalam setiap server, dan statusnya sendiri punya tiga kata untuknya: mati, memproses, aktif. Tidak satu pun berarti "yang ini berhenti". Sebuah eksekusi yang jatuh di tengah jalan akan tetap "memproses" selamanya dan terlihat persis seperti yang sedang berjalan sekarang; sebuah jadwal yang waktunya sudah lewat berjam-jam karena cron mati masih disebut aktif. Halaman ini menanyakan pertanyaan yang satunya. Hanya baca - segala yang menyunting, menjalankan, atau menghapus sebuah jadwal tetap di halaman Pelican sendiri untuk server itu.',

    'column_state' => 'Keadaan',
    'column_name' => 'Jadwal',
    'column_server' => 'Server',
    'column_last' => 'Terakhir berjalan',
    'column_next' => 'Berjalan berikutnya',

    /*
     * Lima putusan. Ditulis sebagai apa yang benar, bukan sebagai perintah,
     * karena tiga di antaranya adalah hal yang perlu dilihat dan dua tidak.
     */
    'state_stuck' => 'Tersangkut',
    'state_overdue' => 'Terlambat',
    'state_never' => 'Belum pernah berjalan',
    'state_healthy' => 'Baik',
    'state_off' => 'Mati',

    'filter_stuck' => 'Tersangkut',
    'filter_overdue' => 'Terlambat',
    'filter_never' => 'Belum pernah berjalan',
    'filter_off' => 'Dimatikan',

    'open' => 'Buka di server',

    'empty' => 'Tidak ada jadwal di server mana pun yang bisa kamu jangkau - atau tidak ada yang berhenti, jika kamu memasang filter.',
];
