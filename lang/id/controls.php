<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Bilah kendali di halaman sebuah server. Berkas tersendiri, bukan sudut dari
 * settings.php, karena ini dibaca oleh orang yang memakai panel, bukan oleh
 * orang yang mengatur tema.
 *
 * Status di sebelah tombol adalah kata milik Pelican sendiri, diambil dari
 * daftar ContainerStatus, supaya bilah ini dan halaman konsol tidak pernah
 * berbeda pendapat tentang apa yang sedang dilakukan sebuah server.
 *
 * "Kill" tetap dalam bahasa Inggris: begitulah nama tombol Pelican sendiri dan
 * nama perintahnya, dan itu hal yang berbeda dari menghentikan.
 */

return [
    'console' => 'Konsol',
    'full_page' => 'Jendela baru',
    'close' => 'Tutup',

    'start' => 'Jalankan',
    'restart' => 'Jalankan ulang',
    'stop' => 'Hentikan',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill menghentikan kontainer di tempat. Semua yang belum ditulis server ke disk akan hilang. Lanjutkan?',

    'sent_title' => 'Perintah daya',
    'sent_body' => ':action dikirim ke :name.',
    'failed' => 'Node tidak terjangkau.',
];
