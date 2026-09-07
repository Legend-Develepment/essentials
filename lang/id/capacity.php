<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Di halamannya sendiri tertulis "mesin", karena barisnya berbicara tentang
 * perangkat kerasnya dan bukan tentang istilah Pelican; "node" adalah milik
 * pengaturan, tempat kata itu sudah terbaca.
 */

return [
    'nav_label' => 'Kapasitas',
    'title' => 'Apakah masih muat satu server lagi',
    'subheading' => 'Berapa yang sudah dijanjikan di setiap node, dibandingkan berapa yang boleh ia bagikan.',

    'how' => 'Dijanjikan, bukan terpakai. Sebuah node bisa dua puluh persen sibuk dan sekaligus benar-benar penuh, karena penuh itu soal berapa yang sudah dibagikan dan bukan soal apa yang sedang berjalan — blok Mesin di ikhtisar adalah pertanyaan yang satunya, dan ia tetap di tempatnya. Perhitungan di sini adalah milik Pelican sendiri, dari metode yang memutuskan boleh atau tidaknya sebuah server dibuat sama sekali: kapasitas dikali satu ditambah kelebihan alokasi, dibandingkan jumlah dari apa yang dijanjikan kepada setiap server di node itu. Kapasitas nol berarti tanpa batas, begitu pula kelebihan alokasi di bawah nol — karena itulah sebagian baris tidak punya persentase alih-alih menunjukkan bilah penuh atau kosong.',

    'column_node' => 'Mesin',
    'column_fullest' => 'Paling penuh',
    'column_memory' => 'Memori',
    'column_disk' => 'Disk',
    'column_cpu' => 'Prosesor',
    'column_at_limit' => 'Di batas',

    'servers' => ':count server',

    'filter_tight' => 'Hampir penuh',

    'open' => 'Buka mesinnya',

    'empty' => 'Tidak ada mesin yang bisa kamu jangkau.',
];
