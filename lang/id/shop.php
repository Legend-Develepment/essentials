<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Pengaturan toko, dan nanti tokonya sendiri.
 *
 * Dua pembaca berbagi berkas ini dengan sengaja. Bagian pengaturan dibaca oleh
 * admin; bagian publik dan bagian pelanggan - yang ditambahkan seiring toko
 * bertumbuh - dibaca orang yang mungkin belum pernah mendengar Pelican, dan
 * setiap kalimat di sana harus ditulis untuk mereka.
 */

return [
    'title' => 'Pengaturan toko',
    'nav_label' => 'Pengaturan toko',
    'subheading' => 'Mata uang, pajak, penomoran faktur dan apa yang dikatakan halaman publik. Yang dijual ada di halaman Paket.',

    // ---- di mana ---------------------------------------------------------
    'address' => 'Toko publik ada di',
    'address_off' => 'Halaman publik dimatikan. Nyalakan "Halaman toko publik" pada daftar fitur di halaman Pengaturan Essentials dan halaman itu akan menjawab di :url.',

    // ---- umum ------------------------------------------------------------
    'section_general' => 'Uang',
    'section_general_helper' => 'Satu mata uang untuk seluruh toko. Setiap harga setiap paket adalah angka dalam mata uang itu.',
    'currency' => 'Mata uang',
    'currency_helper' => 'Menggantinya tidak menghitung ulang apa pun: harga paket adalah angka, dan setelah diganti tetap angka dalam mata uang baru.',
    'tax' => 'Pajak',
    'tax_helper' => 'Persentase yang ditambahkan ke setiap faktur sebagai baris tersendiri. Harga paket belum termasuk pajak. Nol berarti tidak ada.',
    'tax_suffix' => '%',
    'prefix' => 'Nomor faktur diawali dengan',
    'prefix_helper' => 'Diikuti nomor yang naik. INV- menghasilkan INV-000001.',

    // ---- perpanjangan ----------------------------------------------------
    'section_renewals' => 'Perpanjangan',
    'section_renewals_helper' => 'Untuk paket yang ditagih bulanan, tiga bulanan atau tahunan. Paket sekali bayar tidak pernah tersentuh oleh ini.',
    'notice_days' => 'Terbitkan faktur sekian hari sebelum periode berakhir',
    'notice_days_helper' => 'Kapan faktur berikutnya dibuat dan pelanggan diberi tahu.',
    'grace' => 'Hentikan sekian hari setelah jatuh tempo faktur',
    'grace_helper' => 'Faktur yang belum dibayar melewati batas ini menghentikan server — dengan penangguhan milik Pelican sendiri, yang dicabut begitu faktur dibayar. Penangguhan itu sendiri tidak menghapus apa pun.',
    'days' => 'hari',

    // ---- halaman publik --------------------------------------------------
    'section_public' => 'Halaman publik',
    'section_public_helper' => 'Dibaca orang tanpa akun. Apakah halaman ini tampil sama sekali diputuskan oleh sakelar "Halaman toko publik" pada daftar fitur.',
    'heading' => 'Judul',
    'heading_helper' => 'Dibiarkan kosong, nama panel itu sendiri yang dipakai.',
    'note' => 'Baris di atas paket',
    'note_helper' => 'Untuk mengatakan siapa Anda atau apa yang didapat dari pembelian. Teks biasa.',
    'terms_url' => 'Syarat dan ketentuan',
    'terms_url_helper' => 'Alamat https. Jika diisi, membeli berarti mencentang kotak yang menunjuk ke sana.',

    // ---- bayar manual ----------------------------------------------------
    'section_manual' => 'Pembayaran tanpa penyedia',
    'section_manual_helper' => 'Ditampilkan pada faktur yang belum dibayar selama belum ada penyedia pembayaran yang aktif: rekening bank atau ke mana uang dikirim. Teks biasa.',
    'pay_note' => 'Cara membayar',
    'pay_note_helper' => 'Biarkan kosong dan faktur yang belum dibayar hanya mengatakan bahwa faktur itu belum dibayar.',

    // ---- tombol ----------------------------------------------------------
    'save' => 'Simpan',
    'saved' => 'Tersimpan',
    'save_failed' => 'Tidak ada yang tersimpan',

    /* ---------------------------------------------------------------------
     * Tokonya sendiri, dari sini ke bawah.
     *
     * Pembaca yang sama sekali berbeda: seseorang yang membeli server, yang
     * mungkin belum pernah mendengar Pelican dan tidak tahu apa itu egg. Tidak
     * ada di bawah ini yang memakai kata-kata panel, dan setiap kalimat
     * menjawab pertanyaan yang benar-benar ada di benak pelanggan di titik itu.
     * ------------------------------------------------------------------- */

    // ---- toko ------------------------------------------------------------
    'store_title' => 'Toko',
    'store_nav_label' => 'Toko',
    'store_subheading' => 'Pilih sebuah server. Server dibuat untuk Anda begitu fakturnya lunas.',
    'store_empty' => 'Saat ini tidak ada yang dijual',
    'store_empty_body' => 'Datang lagi nanti, atau tanyakan kepada yang mengurus panel ini.',

    'buy' => 'Beli',
    'sold_out' => 'Habis',
    'plus_setup' => 'ditambah :amount sekali',

    'spec_memory' => 'Memori :amount MiB',
    'spec_disk' => 'Disk :amount MiB',
    'spec_cpu' => 'CPU :amount%',
    'spec_backups' => ':count cadangan',
    'spec_databases' => ':count basis data',

    // ---- halaman publik --------------------------------------------------
    'public_empty' => 'Saat ini tidak ada yang dijual',
    'public_empty_body' => 'Datang lagi nanti.',
    'to_panel' => 'Masuk',
    'terms' => 'Syarat',
    'sign_in_note' => 'Pilih server di bawah. Anda masuk untuk menyelesaikannya, dan server dibuat begitu fakturnya lunas.',
    'to_account' => 'Akun saya',
    'filter_all' => 'Semua',
    'filter_label' => 'Tampilkan',
    'includes' => 'Termasuk',
    'public_count' => ':count paket dijual',

    // ---- pemesanan -------------------------------------------------------
    'checkout_title' => 'Pemesanan',
    'tax_line' => 'Pajak (:rate%)',
    'coupon' => 'Kode potongan',
    'coupon_placeholder' => 'Kalau punya',
    'coupon_bad' => 'Kode itu tidak berlaku di sini.',
    'coupon_good' => 'Kode diterapkan.',
    'agree' => 'Saya setuju dengan',
    'place_order' => 'Buat pesanan',
    'place_order_note' => 'Ini menulis sebuah faktur. Tidak ada yang ditagih sampai Anda membayar, dan server dibuat begitu fakturnya lunas.',
    'back_to_store' => 'Kembali ke toko',

    'placed' => 'Pesanan dibuat',
    'placed_body' => 'Faktur :number menunggu di halaman tagihan Anda.',

    'refused' => 'Itu tidak bisa dibeli',
    'refused_gone' => 'Sudah tidak dijual lagi.',
    'refused_sold_out' => 'Yang terakhir sudah habis.',
    'refused_bad_coupon' => 'Kode potongan tidak berlaku untuk ini.',
    'refused_failed' => 'Ada yang salah saat menulis pesanan. Tidak ada yang ditagih. Coba lagi, dan beri tahu yang mengurus panel ini kalau terus terjadi.',

    // ---- tagihan ---------------------------------------------------------
    'billing_title' => 'Tagihan',
    'billing_nav_label' => 'Tagihan',
    'billing_subheading' => 'Apa yang Anda beli dan apa yang Anda tunggak.',
    'your_orders' => 'Pesanan Anda',
    'your_invoices' => 'Faktur Anda',
    'no_orders' => 'Anda belum membeli apa pun',
    'no_orders_body' => 'Semua yang Anda beli muncul di sini beserta server dan tanggalnya.',
    'no_invoices' => 'Belum ada faktur',
    'to_store' => 'Ke toko',
    'renews' => 'Diperpanjang',
    'ask_how_to_pay' => 'Tanyakan kepada yang mengurus panel ini cara membayarnya. Mereka belum menuliskannya di sini.',
    'order_pending' => 'Menunggu fakturnya dibayar. Sesudah itu server langsung dibuat.',
    'order_suspended' => 'Dihentikan karena faktur yang belum dibayar. Membayarnya menyalakan server lagi - tidak ada yang dihapus.',
    'order_ending' => 'Berakhir :date. Ia tidak ditagih lagi, dan semua yang ada di dalamnya dihapus pada hari itu.',
    'order_ending_open' => 'Dibatalkan. Ia tidak ditagih lagi dan tetap berjalan sampai dihapus.',

    // ---- membayar --------------------------------------------------------
    'pay_with' => 'Bayar dengan',
    'pay_now' => 'Bayar',
    'pay_description' => 'Faktur :number',
    'pay_thanks' => 'Terima kasih. Fakturnya sudah lunas.',
    'pay_pending' => 'Penyedia belum mengonfirmasi. Halaman ini diperbarui begitu mereka melakukannya.',
    'pay_refused' => 'Itu tidak jalan',
    'pay_refused_body' => 'Pembayarannya tidak bisa dibuka. Coba cara lain, atau tanyakan kepada yang mengurus panel ini.',
    'gateway_mollie' => 'Mollie',

    // ---- pengaturan penyedia ---------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Menerima iDEAL, kartu, Bancontact dan sisanya lewat satu akun. Uji coba dan mode nyata adalah pengaturan yang sama: kuncinya sendiri yang menyatakan milik akun mana.',
    'mollie_on' => 'Tawarkan Mollie',
    'mollie_on_helper' => 'Dimatikan menghapus tombolnya dari setiap faktur. Yang sudah lunas tetap lunas.',
    'mollie_key' => 'Kunci API',
    'mollie_key_helper' => 'Dari bagian Developers di dasbor Mollie Anda. Kunci itu tidak pernah ditulis ke berkas pengaturan yang diekspor.',
    'mollie_hook' => 'Alamat webhook',
    'mollie_hook_helper' => 'Mollie akan melapor ke :url - panel Anda harus bisa dijangkau di sana dari internet.',

    'gateway_stripe' => 'Kartu',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Menerima kartu di halaman yang digambar Stripe sendiri, jadi nomor kartu tidak pernah sampai ke panel ini. Uji coba dan mode nyata ada di awalan kuncinya, bukan di sakelar.',
    'stripe_on' => 'Tawarkan Stripe',
    'stripe_on_helper' => 'Dimatikan menghapus tombolnya dari setiap faktur. Yang sudah lunas tetap lunas.',
    'stripe_key' => 'Kunci rahasia',
    'stripe_key_helper' => 'Yang diawali sk_, dari Developers, API keys. Tidak pernah ditulis ke berkas pengaturan yang diekspor.',
    'stripe_hook' => 'Rahasia penandatanganan',
    'stripe_hook_key_helper' => 'Nilai whsec_ yang ditunjukkan Stripe saat Anda menambahkan alamat di bawah. Tanpa itu pesan mereka tidak bisa dibuktikan asli dan diabaikan.',
    'stripe_hook_helper' => 'Tambahkan :url sebagai endpoint di Developers, webhooks, untuk peristiwa checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Satu-satunya penyedia yang uangnya bergerak saat pelanggan kembali, bukan selagi mereka masih di PayPal - jadi tab yang ditutup meninggalkan faktur belum dibayar, bukan pembayaran yang hilang.',
    'paypal_on' => 'Tawarkan PayPal',
    'paypal_on_helper' => 'Dimatikan menghapus tombolnya dari setiap faktur. Yang sudah lunas tetap lunas.',
    'paypal_sandbox' => 'Lingkungan uji',
    'paypal_sandbox_helper' => 'Berbicara dengan akun uji PayPal, bukan yang sungguhan. Client id mereka terlihat sama pada kedua kasus, dan justru itulah alasan sakelar ini ada.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Dari aplikasi yang Anda buat di Apps & Credentials. Pastikan tabnya cocok dengan sakelar di atas.',
    'paypal_secret_helper' => 'Di sebelah client ID, di balik Show. Tidak pernah ditulis ke berkas pengaturan yang diekspor.',
    'paypal_hook' => 'ID webhook',
    'paypal_hook_id_helper' => 'ID yang diberikan PayPal ke webhook setelah Anda menambahkannya, bukan alamatnya. Tanpa itu pesan mereka tidak bisa dicek ke mereka dan diabaikan.',
    'paypal_hook_helper' => 'Tambahkan :url sebagai webhook di aplikasi itu, untuk PAYMENT.CAPTURE.COMPLETED, lalu tempel ID yang diberikan di sini.',

    // ---- halaman pembayaran ----------------------------------------------
    'pay_title' => 'Bayar',
    'pay_subheading' => 'Apa yang Anda tunggak, dan cara-cara melunasinya.',
    'pay_choose' => 'Mau bayar dengan cara apa?',
    'pay_choose_body' => 'Apa pun yang Anda pilih, Anda menyelesaikannya di halaman mereka sendiri lalu langsung kembali ke sini.',
    'pay_safe' => 'Untuk membayar, Anda dikirim ke penyedia. Data kartu Anda tidak pernah sampai ke panel ini.',
    'pay_no_ways' => 'Begitu uangnya masuk, faktur ditandai lunas dan server Anda disiapkan.',
    'pay_gone' => 'Faktur itu tidak ada',
    'pay_gone_body' => 'Mungkin sudah ditarik, atau alamatnya salah.',
    'pay_already' => 'Yang ini sudah lunas',
    'pay_already_body' => 'Tidak ada lagi yang perlu dilakukan. Semua yang menunggunya sudah dalam perjalanan.',
    'pay_withdrawn' => 'Yang ini ditarik',
    'pay_withdrawn_body' => 'Sudah keluar dari pembukuan dan tidak perlu dibayar. Kalau itu terasa aneh, tanyakan kepada yang mengurus panel ini.',
    'back_to_billing' => 'Kembali ke tagihan',

    'gateway_mollie_note' => 'iDEAL, Bancontact, kartu dan lainnya',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Saldo PayPal Anda, atau kartu lewat PayPal',

    // ---- layanan dan faktur, terpisah ------------------------------------
    'services_title' => 'Layanan saya',
    'services_nav_label' => 'Layanan saya',
    'services_subheading' => 'Apa yang Anda bayar, dan server yang lahir dari masing-masing.',
    'open_server' => 'Buka servernya',
    'no_server_yet' => 'Sedang disiapkan',

    'invoices_title' => 'Faktur',
    'invoices_subheading' => 'Apa yang ditagihkan kepada Anda, dan apa yang masih harus dibayar.',
    'no_invoices_body' => 'Semua yang Anda beli difakturkan di sini, dan tetap di sini setelah dibayar.',

    // ---- toko sebagai halaman awal ---------------------------------------
    'section_landing' => 'Di mana toko duduk',
    'section_landing_helper' => 'Apakah toko menjadi pintu depan panel, bagi pelanggan dan bagi orang yang belum masuk.',
    'landing' => 'Buka toko lebih dulu',
    'landing_helper' => 'Menyala, toko adalah halaman pertama setelah masuk dan daftar server pindah ke sebelahnya. Layanan dan faktur Anda tetap sejauh satu klik, di kepala toko dan di menu akun. Orang yang belum masuk mendapat toko publik, bukan formulir masuk, dan baru diminta masuk setelah memilih paket - jadi halaman toko publik harus dinyalakan juga. Mati, panel terbuka di daftar server seperti yang digambar Pelican, orang yang belum masuk mendapat formulir masuk, dan toko adalah halaman seperti yang lain.',
];
