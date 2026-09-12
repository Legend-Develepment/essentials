<?php

/*
 * Halaman yang menjawab pertanyaan “mana milikku yang tertinggal”. Ditulis
 * untuk orang yang punya server itu, bukan untuk yang menjalankan panel -
 * jadi di sini tidak ada yang menyebut node, dan tidak ada angka yang tidak
 * bisa ia apa-apakan. Setiap baris menyebut sebuah server yang bisa ia buka
 * atau mengatakan apa yang harus dilakukan terhadapnya.
 */

return [
    'title' => 'Perlu perhatian',
    'nav_label' => 'Perlu perhatian',
    'subheading' => 'Server milikmu, diurutkan menurut apa yang tertinggal, bukan menurut nama. Sebuah cadangan disebut basi setelah :days hari.',
    'column_server' => 'Server',
    'column_last' => 'Cadangan terakhir',
    'column_kept' => 'Disimpan',
    'column_schedules' => 'Tugas yang berhenti',
    'never' => 'Belum pernah',
    'filter_none' => 'Belum pernah dicadangkan',
    'filter_stale' => 'Cadangan sudah basi',
    'open' => 'Cadangan',
    'empty' => 'Tidak ada yang tertinggal',
    'empty_body' => 'Setiap server yang bisa kamu jangkau punya cadangan yang baru dan tidak ada tugas yang berhenti. Halaman ini mengisi dirinya sendiri ketika itu tidak lagi benar.',
];
