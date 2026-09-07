<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Halaman status publik.
 *
 * Satu-satunya hal yang disajikan plugin ini kepada orang yang tidak masuk, dan
 * satu-satunya halaman yang kata-katanya harus dibaca seolah-olah orang asing
 * akan melihatnya - karena memang akan ada yang melihat. Tidak ada di sini yang
 * menyebut node mana, pemilik mana, atau alamat mana; sebuah nama, apakah ia
 * berjalan, dan berapa orang yang ada di dalamnya.
 *
 * "Node" hanya muncul di pengaturan; di halaman publiknya sendiri tertulis
 * "mesin", karena di sana ia dibaca orang yang belum pernah mendengar Pelican.
 */

return [
    // ---- halaman pengaturan ------------------------------------------------
    'title' => 'Halaman status publik',
    'nav_label' => 'Halaman status',
    'subheading' => 'Sebuah halaman yang bisa dibuka siapa saja tanpa akun, yang menunjukkan server mana milikmu yang sedang berjalan. Tidak ada apa pun yang muncul di sana sampai kamu menyebut sebuah server di bawah.',

    'address' => 'Halaman statusmu ada di',
    'address_off' => 'Belum ada yang disajikan. Tambahkan sebuah server, mesin, atau layanan di bawah lalu simpan, dan alamatnya akan muncul di sini.',

    'which' => 'Apa yang dipublikasikan',
    'which_helper' => 'Daftarnya mulai kosong, dan tidak ada yang publik sampai ada sesuatu di dalamnya. Hanya server yang sudah bisa kamu buka yang ditawarkan.',
    'add' => 'Publikasikan sebuah server',
    'server' => 'Server',
    'shown_as' => 'Ditampilkan sebagai',
    'shown_as_helper' => 'Yang dilihat publik. Tulis sendiri alih-alih membiarkan panel memakai nama aslinya — "mc-prod-3 (jangan disentuh)" adalah catatan untuk dirimu sendiri, bukan sesuatu yang dipasang di forum.',

    'look' => 'Kata-katanya',
    'look_helper' => 'Semua di halaman ini dibaca orang yang tidak punya akun.',
    'heading' => 'Judul',
    'heading_helper' => 'Kalau kosong, nama panel ini sendiri yang dipakai.',
    'note' => 'Sebuah baris di atas daftarnya',
    'note_helper' => 'Untuk menyebut apa yang sedang terjadi — jendela pemeliharaan, atau ke mana orang bisa bertanya. Teks biasa.',
    'link' => 'Tautan ke panel',
    'link_helper' => 'Jalan kembali ke dalam, di bagian bawah halaman. Matikan kalau kamu lebih suka tidak mengungkap di mana panelmu berada.',

    'save' => 'Simpan',
    'saved' => 'Tersimpan',
    'save_failed' => 'Tidak ada yang tersimpan',
    'open' => 'Buka halamannya',

    // ---- jumlah pemain -----------------------------------------------------
    'counts' => 'Jumlah pemain',
    'counts_helper' => 'Dari mana angka di sebelah sebuah server berasal. Server Minecraft menjawab jabat tangannya sendiri dan diatur di bawah Minecraft; semua di bawah ini berlaku untuk game yang menjawab kueri Valve — Rust, ARK, Valheim, 7 Days to Die dan kebanyakan lainnya yang berjalan di atas Source atau Unreal.',
    'query_eggs' => 'Egg yang menjawab kueri Valve',
    'query_eggs_helper' => 'Centang egg untuk game-game itu. Daftar yang sama juga menentukan server mana yang mendapat halaman Pemain di dalam panel — satu pertanyaan yang diajukan karena dua alasan. Tidak ada yang ditanyakan sampai kamu bilang: inilah satu-satunya hal di sini yang membuka koneksi dari panel langsung ke sebuah port game, jadi ini pilihan dan bukan sesuatu yang mulai sendiri. Sebuah server yang portnya tidak terjangkau panel cukup tidak menampilkan angka.',

    // ---- node --------------------------------------------------------------
    'nodes' => 'Mesin',
    'nodes_helper' => 'Hidup atau mati, dan tidak lebih. Bukan bebannya dan bukan seberapa penuh disknya — orang yang bertanya apakah ia bisa bermain tidak butuh laporan kapasitas perangkat kerasmu, dan mempublikasikan satu adalah peta tentang di mana yang sedang sesak.',
    'add_node' => 'Publikasikan sebuah mesin',
    'node' => 'Mesin',
    'node_shown_as_helper' => 'Tulis sendiri. Sebuah node biasanya bernama semacam hetzner-fsn1-01, dan itu satu kalimat utuh tentang di mana mesin-mesinmu berdiri.',

    // ---- pemantauan HTTP ---------------------------------------------------
    'monitors' => 'Layanan lain',
    'monitors_helper' => 'Semua hal lain yang layak diketahui sedang hidup: situsmu, sebuah API, endpoint health sebuah bot. Panel menanyai masing-masing dengan irama yang sama seperti server. Hanya administrator — sebuah pemantauan membuat panel ini mengambil sebuah alamat, dan kalau siapa pun boleh menambahkan satu, ia berubah menjadi penyelidik yang bisa kamu arahkan ke mana saja.',
    'add_monitor' => 'Tambahkan sebuah layanan',
    'monitor_name' => 'Nama',
    'monitor_url' => 'Alamat',
    'monitor_url_helper' => 'Hanya https. Kalau panel ini mengambil http biasa secara berkala, semua orang di sepanjang jalur akan tahu layanan mana milikmu yang ada.',
    'monitor_expect' => 'Mengharapkan',
    'monitor_expect_helper' => 'Biarkan kosong untuk "jawaban apa pun", yang cocok untuk situs yang mengalihkan atau menjawab 403 pada permintaan telanjang. Sebuah angka ditujukan untuk endpoint yang ditulis untuk mengatakan persis itu dan tidak lebih — kalau disetel terlalu ketat, barisnya merah selamanya pada layanan yang sebenarnya baik-baik saja.',

    // ---- halaman untuk pengguna --------------------------------------------
    'users' => 'Halaman untuk penggunamu',
    'users_helper' => 'Apakah orang yang punya server di panel ini boleh mempublikasikan halaman statusnya sendiri.',
    'user_pages' => 'Biarkan pengguna membuat miliknya sendiri',
    'user_pages_helper' => 'Masing-masing mendapat alamatnya sendiri di /status/nama-mereka, tempat hanya server yang mereka miliki yang tampil, dengan nama yang mereka tulis sendiri. Tidak ada mesin dan tidak ada layanan lain di sana — keduanya hanya milikmu. Ketika ini nyala, mereka menemukannya di bawah Halaman status di menu akunnya, di panel mana pun mereka berada.',

    // ---- tampilannya -------------------------------------------------------
    'every' => 'Periksa setiap',
    'every_helper' => 'Seberapa sering halamannya disusun ulang, dan seberapa sering ia menyegarkan dirinya di peramban. Halaman yang dilihat orang selama sebuah restart menginginkan detik; halaman yang ditautkan dari forum dan tidak dibuka siapa pun menginginkan satu jam, dan menanyai setiap node setiap menit demi halaman itu adalah pekerjaan yang dilakukan untuk siapa pun.',
    'every_realtime' => 'Waktu nyata (10 detik)',
    'every_30s' => '30 detik',
    'every_1m' => '1 menit',
    'every_5m' => '5 menit',
    'every_10m' => '10 menit',
    'every_30m' => '30 menit',
    'every_60m' => '60 menit',

    'style' => 'Gaya',
    'style_helper' => 'Salah satu tampilan milik panel sendiri, diterapkan ke halaman ini: warnanya, abu-abu yang disusun dari permukaannya, dan seberapa membulat sudutnya. "Ikuti panel" berarti yang disetel hari ini, termasuk apa pun yang berubah kemudian.',
    'style_mine_helper' => 'Gaya yang disediakan panel ini, diterapkan ke halamanmu: sebuah warna, abu-abu yang disusun darinya, dan seberapa membulat sudutnya. Gaya mana yang ada di daftar ditentukan pemilik panel — daftar yang sama dengan yang bisa kamu pilih di bawah Tampilan. "Ikuti panel" berarti yang sedang disetel.',
    'style_panel' => 'Ikuti panel',

    // ---- halamanmu sendiri -------------------------------------------------
    'mine_title' => 'Halaman statusku',
    'mine_nav_label' => 'Halaman status',
    'mine_subheading' => 'Satu alamat untuk diberikan kepada orang-orang yang bermain di servermu. Ia menampilkan server yang kamu pilih, dan tidak menampilkan apa pun lagi tentang panel ini.',
    'mine_address' => 'Alamatmu',
    'mine_address_helper' => 'Pilih yang pendek. Mengubahnya kemudian akan merusak setiap tautan yang sudah disimpan seseorang.',
    'mine_address_off' => 'Pilih sebuah alamat di bawah lalu simpan, dan halamanmu akan muncul di sini.',
    'slug' => 'Alamat',
    'slug_helper' => 'Huruf kecil, angka, dan tanda hubung. Tiga karakter atau lebih.',
    'mine_heading' => 'Judul',
    'mine_heading_helper' => 'Kalau kosong, alamatmu yang dipakai.',
    'mine_note_helper' => 'Untuk menyebut apa yang sedang terjadi — sebuah restart, sebuah acara, di mana kamu bisa ditemui. Teks biasa, dan dibaca semua orang yang punya tautannya.',
    'mine_which' => 'Servermu',
    'mine_which_helper' => 'Hanya server yang kamu miliki sendiri yang ditawarkan. Menjadi subuser di tempat lain adalah akses ke sebuah mesin, bukan izin untuk mempublikasikan bahwa ia ada.',
    'mine_shown_as_helper' => 'Yang dilihat pengunjung. Tulis sendiri alih-alih memakai nama dari panel, kalau nama itu adalah catatan untuk dirimu sendiri.',
    'mine_look_helper' => 'Bagaimana halamanmu terlihat oleh orang-orang yang kamu kirimi.',
    'mine_remove' => 'Turunkan halamanku',
    'mine_remove_confirm' => 'Menurunkan halamanmu dan membebaskan alamatnya untuk orang lain. Semua yang sudah kamu atur hilang; servernya sendiri tidak disentuh.',
    'mine_removed' => 'Halamanmu sudah diturunkan',

    'why_slug' => 'Alamat itu tidak bisa. Huruf kecil, angka, dan tanda hubung, tiga karakter atau lebih — dan beberapa kata sudah dipesan.',
    'why_taken' => 'Alamat itu sudah dipegang orang lain.',
    'why_unwritable' => 'Tidak dapat ditulis. Periksa apakah storage/app dimiliki oleh pengguna yang menjalankan panel.',

    // ---- judul di halamannya sendiri ---------------------------------------
    'section_servers' => 'Server',
    'section_nodes' => 'Mesin',
    'section_monitors' => 'Layanan',

    // ---- halamannya sendiri ------------------------------------------------
    'up' => 'Hidup',
    'down' => 'Mati',
    'starting' => 'Sedang mulai',

    /*
     * Bukan "mati", dan bedanya penting di ruang publik.
     *
     * Panel tidak berhasil menjangkau servernya. Itu biasanya sebuah node yang
     * sedang dipelihara atau sebuah daemon yang sedang dijalankan ulang - itu
     * bukan hal yang sama dengan server yang dimatikan, dan memberi tahu seratus
     * pemain bahwa server mereka mati sementara ia sedang berjalan lebih buruk
     * daripada mengaku tidak tahu.
     */
    'unknown' => 'Tidak diketahui',

    'players' => 'Pemain',
    'online_now' => 'sedang bermain saat ini',
    'checked' => 'Diperiksa',
    'next_check' => 'sampai pemeriksaan berikutnya',
    'just_now' => 'baru saja',
    'seconds_ago' => ':count detik lalu',
    'panel' => 'Masuk',

    'all_up' => 'Semuanya berjalan.',
    'some_down' => 'Ada yang tidak berjalan.',
    'empty' => 'Belum ada yang dipublikasikan di sini.',
];
