<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Tambahan yang dijual berdampingan dengan sebuah paket.
 *
 * Dua kata dijaga tetap terpisah di sini. Berapa *harga* sebuah tambahan
 * adalah harganya, yaitu yang ditagih setiap kali. Berapa *biayanya hari ini*
 * hanyalah sebagian dari itu, karena yang membelinya di tengah bulan membayar
 * setengah bulan. Teks yang dibaca pelanggan selalu menyebut yang mana dari
 * keduanya yang dimaksud.
 *
 * "Tidak menambah apa pun di server" adalah jawaban yang sah dan dikatakan
 * terus terang, bukan dibiarkan kosong, karena dukungan prioritas itu barang
 * dagangan yang wajar dan sel kosong terbaca sebagai kesalahan.
 */

return [
    'title' => 'Tambahan',
    'nav_label' => 'Tambahan',
    'subheading' => 'Barang yang dijual berdampingan dengan sebuah paket: memori lebih banyak, satu slot cadangan lagi, atau sesuatu yang hanya berupa satu baris di faktur.',

    // ---- tabel ------------------------------------------------------------
    'column_name' => 'Tambahan',
    'column_price' => 'Harga',
    'column_adds' => 'Menambah',
    'column_sold' => 'Terpakai',
    'column_live' => 'Dijual',
    'adds_nothing' => 'Tidak menambah apa pun di server',

    // ---- formulir ---------------------------------------------------------
    'section_what' => 'Ini apa',
    'section_what_helper' => 'Nama dan harga yang dilihat pelanggan, dan dengan paket mana ia bisa dibeli.',
    'name' => 'Nama',
    'price' => 'Harga',
    'price_helper' => 'Berapa biayanya setiap kali ditagih. Dibeli di tengah periode, pelanggan membayar sebagian dari ini, lalu penuh mulai perpanjangan berikutnya.',
    'billing' => 'Ditagih',
    'billing_helper' => 'Bersama layanan berarti ia kembali pada setiap perpanjangan, selama mereka menyimpannya. Sekali berarti ia ditagih pada faktur yang pertama kali membawanya dan tidak pernah lagi.',
    'billing_with' => 'Pada setiap perpanjangan',
    'billing_once' => 'Sekali',
    'max' => 'Paling banyak per layanan',
    'max_helper' => 'Berapa banyak dari yang satu ini boleh dipegang seseorang. Satu adalah kasus biasa; naikkan untuk sesuatu yang dijual per gigabyte.',
    'description' => 'Keterangan',
    'description_helper' => 'Satu baris di bawah namanya saat memesan. Katakan apa gunanya, bukan apa namanya.',
    'packages' => 'Paket',
    'packages_helper' => 'Dengan paket mana ini bisa dibeli. Tidak ada yang dicentang berarti dengan semuanya, dan itulah biasanya sebuah opsi dukungan atau slot cadangan.',

    'section_adds' => 'Apa yang ia tambahkan ke server',
    'section_adds_helper' => 'Ini ditambahkan pada apa yang sudah diberikan paketnya, bukan menggantikannya: 4096 pada memori membuat server 4 GiB lebih besar. Dua tambahan yang sama dijumlahkan. Biarkan semuanya nol untuk sesuatu yang hanya berupa satu baris di faktur. Angka negatif justru mengurangi, itu diperbolehkan, dan sesekali memang itu yang diinginkan orang.',
    'sort' => 'Urutan',
    'sort_helper' => 'Yang lebih kecil muncul lebih dulu saat memesan. Angka yang sama diurutkan berdasarkan harga.',
    'live' => 'Dijual',
    'live_helper' => 'Dimatikan, ia tidak ditawarkan di mana pun. Yang sudah punya tetap menyimpannya dan tetap ditagih untuknya.',

    // ---- tombol -----------------------------------------------------------
    'new' => 'Tambahan baru',
    'edit' => 'Ubah',
    'delete' => 'Hapus',
    'delete_confirm' => 'Tidak ada yang memiliki yang ini. Menghapusnya mengeluarkannya dari daftar untuk selamanya.',
    'delete_sold' => ':count layanan memiliki ini. Mereka tetap menyimpannya, tetap mendapat batas yang diberikannya dan tetap ditagih untuknya - yang hilang adalah barisnya di daftar, jadi tidak ada orang baru yang bisa membelinya.',
    'go_live' => 'Jual',
    'go_offline' => 'Tarik dari penjualan',
    'saved' => 'Tersimpan',
    'deleted' => 'Tambahannya sudah hilang',
    'save_failed' => 'Tidak tersimpan',
    'save_failed_body' => 'Tidak ada yang ditulis. Coba lagi, dan lihat log kalau terus terjadi.',
    'invalid' => 'Sebuah tambahan butuh nama dan harga.',
    'empty' => 'Belum ada tambahan',
    'empty_body' => 'Tambahan adalah sesuatu yang dijual berdampingan dengan sebuah paket: satu gigabyte lagi, slot cadangan kedua, atau layanan yang sama sekali tidak menambah apa pun di server.',

    // ---- yang dilihat pelanggan -------------------------------------------
    'choose' => 'Tambahan',
    'choose_helper' => 'Tidak wajib, dan bisa Anda tambahkan atau lepas nanti.',
    'yours' => 'Tambahan pada layanan ini',
    'add' => 'Tambahkan satu',
    'add_helper' => 'Anda membayar sisa periode ini sekarang, lalu harga penuh mulai perpanjangan berikutnya.',
    'add_to' => 'Tambahkan :name',
    'add_confirm' => 'Tambahkan :name ke layanan ini?',
    'drop' => 'Lepas',
    'drop_confirm' => 'Lepas :name? Bagian yang sudah Anda bayar tapi belum terpakai kembali ke akun Anda, dan server Anda langsung berubah.',
    'costs_now' => ':amount sekarang',
    'free_now' => 'Tidak ada yang harus dibayar sekarang',
    'then' => 'lalu :amount per perpanjangan',
    'once_only' => ':amount, sekali',
    'each' => 'per buah',
    'added' => ':name ditambahkan',
    'added_body' => 'Server Anda sudah diberi apa yang ia tambahkan.',
    'dropped' => ':name dilepas',
    'dropped_body' => 'Apa pun yang sudah Anda bayar tapi belum terpakai ada di akun Anda.',

    // ---- dan kalau tidak bisa ---------------------------------------------
    'refused' => 'Itu tidak bisa dilakukan',
    'refused_off' => 'Tambahan dimatikan untuk panel ini.',
    'refused_not_active' => 'Hanya layanan yang berjalan yang bisa diberi tambahan.',
    'refused_gone' => 'Tambahan itu sudah tidak dijual.',
    'refused_wrong_package' => 'Tambahan itu tidak dijual dengan paket ini.',
    'refused_enough' => 'Anda sudah punya sebanyak yang boleh dipegang layanan ini.',
    'refused_failed' => 'Tidak ada yang dicatat, jadi tidak ada yang berubah. Coba lagi, dan beri tahu yang mengelola panel ini kalau terus terjadi.',
    'refused_server' => 'Server tidak mau menerima batas yang baru, jadi tidak ada yang diubah dan tidak ada yang ditagih.',
    'refused_not_yours' => 'Tambahan itu tidak ada pada layanan ini.',

    // ---- yang tertulis di dokumen -----------------------------------------
    'line' => ':name × :many, untuk sisa :days hari periode ini',
    'credit_reason' => 'Dilepas: :name',
    'bell_failed' => 'Sebuah tambahan tidak bisa diberikan ke server pada pesanan :number',

    // ---- satuan, untuk tabel admin ----------------------------------------
    'unit_memory' => 'MiB memori',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disk',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'basis data',
    'unit_allocation_limit' => 'allocation',
    'unit_backup_limit' => 'cadangan',
];
