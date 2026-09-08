<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Paket: server yang bisa dibeli orang.
 *
 * Yang membaca ini adalah orang yang menata toko. Setiap kata di sini tentang
 * cetakan dan harga; apa yang dilihat pembeli ada di shop.php, karena dua
 * pembaca itu ingin kalimat yang berbeda untuk baris yang sama.
 *
 * "egg", "node", "swap", "io" dan kata-kata Minecraft tetap dalam bahasa
 * Inggris: itu kata-kata dari formulir server milik Pelican sendiri, dan sebuah
 * paket adalah formulir yang sama, disimpan untuk nanti.
 */

return [
    'title' => 'Paket',
    'nav_label' => 'Paket',
    'subheading' => 'Yang dijual. Masing-masing adalah cetakan server dengan harga; pembeli membeli satu dan panel membuat servernya.',

    // ---- tabel -----------------------------------------------------------
    'column_name' => 'Paket',
    'column_egg' => 'Egg',
    'column_price' => 'Harga',
    'column_stock' => 'Stok',
    'column_live' => 'Dijual',
    'column_orders' => 'Terjual',

    'live' => 'Dijual',
    'offline' => 'Tidak dijual',
    'no_egg' => 'Tanpa egg — tidak bisa dibangun',

    'stock_unlimited' => 'Tanpa batas',
    'stock_left' => 'Sisa :count',
    'stock_out' => 'Habis',

    // ---- periode ---------------------------------------------------------
    'period_once' => 'Sekali bayar',
    'period_month' => 'Bulanan',
    'period_quarter' => 'Tiga bulanan',
    'period_year' => 'Tahunan',

    // Setelah harga: "Rp 12.500 per bulan".
    'per_once' => 'sekali bayar',
    'per_month' => 'per bulan',
    'per_quarter' => 'per tiga bulan',
    'per_year' => 'per tahun',

    // ---- tindakan --------------------------------------------------------
    'new' => 'Paket baru',
    'edit' => 'Ubah',
    'duplicate' => 'Gandakan',
    'copy_suffix' => ' (salinan)',
    'go_live' => 'Jual sekarang',
    'go_offline' => 'Hentikan penjualan',
    'delete' => 'Hapus',
    'delete_confirm' => 'Menghapus paketnya. Yang sudah dibeli tidak disentuh — setiap pesanan menyimpan salinannya sendiri tentang apa dirinya dulu.',
    'delete_refused' => 'Tidak dihapus',
    'delete_refused_body' => 'Ada pesanan atas paket ini dan pesanan itu menunjuk padanya. Lebih baik hentikan penjualannya; paket tetap ada untuk pembukuan dan tidak ada yang bisa membelinya.',
    'deleted' => 'Paket dihapus',
    'saved' => 'Paket disimpan',
    'save_failed' => 'Paket tidak bisa disimpan',
    'price_invalid' => 'Itu bukan jumlah uang. Tulis sebagai 12.50 atau 12,50.',

    // ---- formulir: apa itu -----------------------------------------------
    'section_basics' => 'Paketnya',
    'section_basics_helper' => 'Yang dilihat pembeli di kartunya.',
    'name' => 'Nama',
    'name_helper' => 'Namanya di toko.',
    'slug' => 'Alamat',
    'slug_helper' => 'Huruf kecil, angka dan tanda hubung. Dibiarkan kosong, dibentuk dari namanya. Mengubahnya nanti merusak tautan yang sudah disimpan orang.',
    'description' => 'Keterangan',
    'description_helper' => 'Beberapa baris di bawah nama. Teks biasa.',
    'live_field' => 'Dijual',
    'live_helper' => 'Dimatikan membuat paket tinggal di sini dan tidak ditampilkan kepada siapa pun. Paket tanpa egg tidak pernah ditampilkan, apa pun yang tertulis di sini.',
    'sort' => 'Urutan',
    'sort_helper' => 'Angka lebih kecil muncul lebih dulu di toko.',

    // ---- formulir: jadi apa ----------------------------------------------
    'section_server' => 'Server yang terbentuk darinya',
    'section_server_helper' => 'Pertanyaan yang sama seperti saat Pelican membuat server secara manual, dijawab sekali di sini dan dipakai pada setiap penjualan.',
    'egg' => 'Egg',
    'egg_helper' => 'Memilih satu akan mengisi image, perintah start dan setiap variabel dengan bawaan egg. Setelah itu ubah sesuka Anda.',
    'image' => 'Image Docker',
    'image_helper' => 'Salah satu image yang ditawarkan egg.',
    'image_default' => 'Image pertama dari egg',
    'startup' => 'Perintah start',
    'startup_helper' => 'Salah satu perintah yang ditawarkan egg.',
    'startup_default' => 'Perintah pertama dari egg',
    'environment' => 'Variabel',
    'environment_helper' => 'Variabel egg dan nilainya. Apa pun yang dimiliki egg dan tidak ada di sini mendapat nilai bawaannya saat server dibuat.',
    'env_key' => 'Variabel',
    'env_value' => 'Nilai',
    'nodes' => 'Node',
    'nodes_helper' => 'Di mana server dari paket ini boleh dibuat — dicoba berurutan sampai ada yang punya alamat kosong. Tidak ada yang dicentang berarti node mana pun.',

    // ---- formulir: batas -------------------------------------------------
    'section_limits' => 'Batas',
    'section_limits_helper' => 'Yang didapat server. Kolom yang sama seperti formulir server milik Pelican sendiri, dalam satuan yang sama.',
    'memory' => 'Memori',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Persen dari satu inti: 100 berarti satu inti, 200 berarti dua, 0 berarti tanpa batas.',
    'swap' => 'Swap',
    'swap_helper' => '0 berarti tidak ada, -1 berarti tanpa batas.',
    'io' => 'Bobot block IO',
    'io_helper' => 'Bawaan Pelican adalah 500. Biarkan begitu kecuali Anda tahu alasannya tidak.',
    'threads' => 'Penguncian CPU',
    'threads_helper' => 'Inti yang mana, seperti cara Pelican menulisnya: 0,1 atau 0-3. Kosong berarti mana saja.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Apakah kernel boleh menghentikan server ketika memorinya habis.',
    'databases' => 'Basis data',
    'allocations' => 'Allocation tambahan',
    'backups' => 'Cadangan',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- formulir: uang --------------------------------------------------
    'section_price' => 'Harga dan stok',
    'section_price_helper' => 'Dalam mata uang toko, diatur di halaman Pengaturan toko. Belum termasuk pajak — pajak ditambahkan pada faktur sebagai baris tersendiri.',
    'price' => 'Harga',
    'price_helper' => 'Per periode. Tulis sebagai 12.50 atau 12,50.',
    'setup_fee' => 'Biaya pemasangan',
    'setup_fee_helper' => 'Ditagih sekali, pada faktur pertama. Nol berarti tidak ada.',
    'period' => 'Penagihan',
    'period_helper' => 'Sekali bayar dibayar sekali lalu dimiliki. Yang lain mendapat faktur baru setiap periode; yang tidak dibayar menghentikan server setelah masa tenggang dari halaman Pengaturan toko.',
    'stock' => 'Stok',
    'stock_helper' => 'Berapa banyak yang boleh terjual pada saat bersamaan, menghitung setiap pesanan yang belum dibatalkan. Kosong berarti tanpa batas.',
    'term' => 'Masa minimum',
    'term_helper' => 'Berapa lama seseorang terikat begitu ia membeli. Nol berarti tanpa ikatan: ia bisa membatalkan dan itu berhenti di akhir periode yang sudah ia bayar.',
    'term_unit' => 'Dihitung dalam',
    'term_unit_helper' => 'Hari, bulan atau tahun. Pesanan yang dibatalkan berjalan sampai akhir masa ini dan servernya dihapus pada hari itu.',
    'unit_day' => 'Hari',
    'unit_month' => 'Bulan',
    'unit_year' => 'Tahun',
    'term_day' => 'Masa minimum: :count hari',
    'term_month' => 'Masa minimum: :count bulan',
    'term_year' => 'Masa minimum: :count tahun',
    'section_art' => 'Gambar',
    'section_art_helper' => 'Gambar di kartu paket, di toko dan di layanan milik pelanggan. Biarkan keduanya kosong dan gambar bawaan egg yang dipakai, yang sudah dimiliki sebagian besar paket.',
    'art_file' => 'Unggah gambar',
    'art_file_helper' => 'Lebih baik lebar daripada tinggi: kartunya memotongnya jadi 16:9. Maksimal 8 MB.',
    'art_url' => 'Atau alamat gambar',
    'art_url_helper' => 'Alamat https lengkap. Dipakai kalau tidak ada yang diunggah di atas.',

    'empty' => 'Belum ada paket',
    'section_ask' => 'Tanya pembeli',
    'section_ask_helper' => 'Pertanyaan yang muncul saat pemesanan, dijawab sebelum pesanan dibuat. Jawabannya sampai ke server ketika server dibangun.',
    'ask_vars' => 'Variabel yang ditanyakan',
    'ask_vars_helper' => 'Variabel milik egg sendiri. Centang satu dan pembeli mengisinya sambil membeli, lalu jawabannya dipakai menggantikan nilai dari paket ini. Biarkan semua tidak dicentang dan tidak ada yang ditanya apa pun.',
    'upload_ask' => 'Minta sebuah berkas',
    'upload_ask_helper' => 'Sebuah zip yang diunggah pembeli sambil membeli — sebuah dunia, sebuah modpack, sekumpulan konfigurasi. Berkas itu dimasukkan ke servernya saat server dibangun, sebelum ia diberi tahu bahwa servernya siap.',
    'upload_label' => 'Mau disebut apa',
    'upload_label_helper' => 'Label di atas kotak berkas, dengan kata-kata Anda sendiri. Kosong berarti dipakai yang biasa saja.',
    'upload_dir' => 'Di mana dalam server',
    'upload_dir_helper' => 'Sebuah jalur di dalam server, seperti / atau /world. Jalurnya dibuat aman sebelum dipakai.',
    'upload_extract' => 'Ekstrak isinya',
    'upload_extract_helper' => 'Dinyalakan, zip diekstrak di tempat ia mendarat dan arsipnya sendiri dihapus — cocok untuk sebuah dunia atau sekumpulan konfigurasi. Dimatikan, zip dibiarkan sebagai berkas, dan itulah yang diinginkan egg yang memasang modpack dari sebuah zip.',
    'empty_body' => 'Buat satu dan paket itu muncul di toko begitu dijual.',
];
