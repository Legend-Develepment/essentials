<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Si penjaga.
 *
 * Setiap pesan dari sini dibaca di sebuah ponsel, pukul tiga pagi, oleh orang
 * yang semenit lalu masih tidur. Masing-masing menyebut mesin yang mana, apa
 * yang salah, dan tidak lebih - rinciannya adalah milik halaman yang akan ia
 * buka sesudahnya, bukan milik baris yang membangunkannya.
 *
 * Bahwa sesuatu sudah pulih ditulis sebagai kabar, bukan sebagai catatan kaki.
 * "Sudah kembali belum" adalah pertanyaan yang kalau tidak dijawab akan membuat
 * seseorang bangun.
 *
 * "Node", "Wings", "daemon", "webhook", "queue", "Discord" dan "SMTP" tetap
 * dalam bahasa Inggris: dengan nama itulah kamu menemukannya di Pelican, di
 * mesinnya, dan di semua yang ditulis tentangnya.
 */

return [
    'title' => 'Peringatan',
    'nav_label' => 'Peringatan',
    'subheading' => 'Panel sudah tahu kapan sebuah node berhenti menjawab, kapan sebuah disk memenuh, atau kapan antreannya berhenti. Inilah yang memberitahumu.',

    // ---- salurannya, dan apa yang terakhir mereka lakukan -----------------
    'channels' => 'Ke mana pesannya pergi',
    'channels_helper' => 'Apa yang dilakukan setiap saluran terakhir kali ia diminta mengirim sesuatu. Sebuah saluran yang nyala tetapi menolak dalam diam terlihat persis seperti panel yang tidak sedang bermasalah, dan karena itulah ini berdiri pertama di halaman.',

    'state_off' => 'Mati',
    'state_untried' => 'Belum ada yang dikirim',
    'state_ok' => 'Terkirim',
    'state_failed' => 'Ditolak',

    // ---- kapan -------------------------------------------------------------
    'when' => 'Seberapa sering',
    'when_helper' => 'Pemeriksaan berjalan di latar belakang, jadi mereka butuh sebuah queue worker. Tanpa itu tidak ada yang terkirim, dan tidak ada yang memberitahumu - pakai "Kirim percobaan", yang tidak lewat antrean.',

    'every' => 'Periksa setiap',
    'every_helper' => 'Setiap pemeriksaan menjangkau daemon di setiap node, jadi itu satu permintaan per node per putaran. Lima belas menit sudah cukup untuk mendengar tentang sebuah gangguan selagi ia masih gangguan.',
    'every_off' => 'Mati - tidak ada pemeriksaan sama sekali',
    'every_five' => '5 menit',
    'every_fifteen' => '15 menit',
    'every_thirty' => '30 menit',
    'every_hourly' => 'Jam',
    'every_daily' => 'Hari',

    'repeat' => 'Ingatkan aku selama ini berlangsung',
    'repeat_helper' => 'Sebuah pesan dikirim ketika sesuatu berubah, dan satu lagi ketika ia pulih. Ini menambahkan pengingat selama masalahnya masih berlangsung. Nol berarti tanpa pengingat - sebuah saluran yang mengulang dirinya setiap seperempat jam adalah saluran yang dibisukan orang.',
    'hours' => 'jam',

    // ---- ke mana -----------------------------------------------------------
    'where' => 'Saluran',
    'where_helper' => 'Lebih dari satu itu bijak. Mereka gagal dengan cara yang berbeda-beda.',

    'discord' => 'Discord',
    'discord_helper' => 'Tempat sebuah pesan benar-benar dibaca oleh orang yang tidak sedang duduk memandangi panel.',
    'webhook' => 'Alamat webhook',
    'webhook_helper' => 'Di Discord: Pengaturan server → Integrasi → Webhooks → Webhook baru → Salin URL webhook. Dibatasi ke https, karena ini mempublikasikan mesin mana milikmu yang mati dan seberapa penuh disknya.',
    'bot' => 'Bot milikmu sendiri',
    'bot_helper' => 'Satu kiriman JSON bertanda tangan ke alamat yang kamu kelola sendiri, supaya sesuatu di luar panel tahu ada node yang mati alih-alih bertanya setiap menit apakah ada. Webhook bawaan Pelican tidak bisa membawa ini: mereka terpicu oleh model dan oleh log aktivitas, sedangkan node yang berhenti menjawab tidak menulis satu pun dari keduanya.',
    'bot_url' => 'Ke mana dikirim',
    'bot_url_helper' => 'Dibatasi ke https, karena ini mengirim mesin mana milikmu yang mati ke sebuah alamat di internet.',
    'bot_secret' => 'Rahasia penanda tangan',
    'bot_secret_helper' => 'Dibagi dengan apa pun yang menerima ini. Isinya di-hash dengan rahasia itu dan hash-nya dibawa di X-Essentials-Signature sebagai sha256=<hex>, sehingga botmu bisa menolak apa pun yang tidak datang dari panel ini. Tidak ada yang dikirim selama ini kosong - tanda tangan yang sifatnya opsional adalah tanda tangan yang tidak diperiksa siapa pun.',
    'facts' => 'Beri tahu bot juga saat sesuatu terjadi',
    'facts_helper' => 'Semua di atas adalah gangguan. Ini bukan: ini hal-hal yang memang terjadi. Masing-masing mati sampai Anda mencentangnya, jadi pembaruan tidak mengubah apa pun, dan hanya dikirim ke bot, tidak pernah ke Discord, lonceng, atau email.',

    'panel' => 'Di panel',
    'panel_helper' => 'Sebuah pemberitahuan kepada semua orang yang memegang izin ini. Selalu bekerja, tidak butuh pengaturan, dan tidak terlihat oleh siapa pun yang tidak masuk.',

    'email' => 'Email',
    'email_helper' => 'Dipisahkan koma. Memakai mailer milik panel sendiri - andal ketika disetel, dan sepenuhnya bisu ketika tidak, dan itulah satu-satunya kegagalan yang tidak boleh dimiliki seorang penjaga. Biarkan kosong untuk mematikannya.',

    // ---- apa ---------------------------------------------------------------
    'what' => 'Apa yang diawasi',
    'what_helper' => 'Setiap pembacaan di sini adalah pembacaan yang memang sudah dilakukan panel. Tidak ada di halaman ini yang membuka koneksi yang tidak dibuka Status sistem.',

    'percent_helper' => 'Nol mematikan pemeriksaan ini.',
    'disk' => 'Peringatkan ketika disk sebuah node melewati',
    'memory' => 'Peringatkan ketika memori sebuah node melewati',

    'maintenance' => 'Peringatkan tentang pemeliharaan yang sudah lebih dari',
    'maintenance_helper' => 'Sebuah node dalam pemeliharaan dilewati semua pemeriksaan lain, dan itu benar - dan begitu pulalah cara sebuah node dilupakan selama empat belas hari. Nol mematikannya.',

    'versions' => 'Versi panel dan Wings',
    'versions_helper' => 'Satu pesan ketika sesuatu tertinggal, dan satu ketika ia mutakhir lagi. Tanpa pengingat - sebuah versi bukan gangguan.',

    'backups' => 'Cadangan yang tertinggal',
    'backups_helper' => 'Satu pesan yang menyebut server-servernya alih-alih satu pesan per server - ketika sebuah tugas terjadwal berhenti, semua server menjadi basi sekaligus, dan empat puluh pesan terpisah untuk satu sebab adalah saluran yang dibisukan orang. Mati secara bawaan: panel yang mencadangkan secara manual dan bukan menurut jadwal akan mendengarnya setiap hari.',
    'backup_days' => 'Sebut sebuah cadangan basi setelah',
    'backup_days_helper' => 'Itu juga yang dipakai halaman Cadangan. Server yang dicadangkan mingguan tidak seharusnya dilaporkan setelah delapan hari.',
    'days' => 'hari',

    'stock' => 'Paket yang mulai habis',

    'unbuilt_switch_helper' => 'Pesanan yang fakturnya sudah lunas dan servernya ditolak node. Satu-satunya pemeriksaan di sini yang membuat orang kehilangan uang tanpa ada yang memberi tahu: selebihnya di daftar ini adalah mesin yang berhenti. Mati sampai dinyalakan, seperti yang lain.',

    'unbuilt_switch' => 'Lunas dan belum dibuat',
    'stock_helper' => 'Satu pesan yang menyebut paket-paketnya alih-alih satu pesan per paket, dan tidak pernah ada pengingat: habis terjual adalah keadaan biasa sebuah toko, bukan sebuah gangguan, dan mendengarnya setiap empat jam adalah cara ini berhenti dibaca. Hanya paket yang punya batas yang dilihat, jadi toko yang menjual semuanya tanpa batas tidak memakan biaya apa pun untuk diawasi. Mati secara bawaan, seperti yang lain.',
    'modules_switch' => 'Modul yang hidup dan tidak bekerja',
    'modules_switch_helper' => 'Satu pesan per modul alih-alih satu pesan untuk semuanya, karena yang salah pada masing-masing berbeda dan kalimatnya harus menyebut yang mana. Dua hal yang dilaporkannya: modul yang tabelnya tidak ada, yaitu pemasangan yang tidak selesai, dan modul yang bagiannya hidup tetapi menunggu sesuatu diisi. Halaman Modul menunjukkan keduanya di kartunya; ini untuk panel yang tidak pernah ditengok siapa pun. Mati secara bawaan, seperti yang lain.',
    'module_tables_title' => 'Modul ":module" hidup dan tabelnya tidak ada',
    'module_tables' => 'Halaman milik modul ":module" menyembunyikan diri karena tabel yang dibacanya tidak ada, dan itu biasanya pemasangan yang tidak selesai. Buka halaman Modul, matikan lalu hidupkan lagi, dan tabelnya dibuat.',
    'module_waiting_title' => 'Modul ":module" hidup dan sebagiannya menunggu',
    'module_waiting' => '{1} Satu bagian modul ":module" hidup dan tidak menampilkan apa pun sampai ada yang diisi - egg mana yang berlaku baginya, gaya yang ditawarkan, server yang harus ditampilkan halaman publik. Halaman Modul menyebut yang mana, di kartunya.|[2,*] :count bagian modul ":module" hidup dan tidak menampilkan apa pun sampai ada yang diisi - egg mana yang berlaku bagi mereka, gaya yang ditawarkan, server yang harus ditampilkan halaman publik. Halaman Modul menyebut yang mana, di kartunya.',
    'module_cleared' => 'Modul ":module" bekerja lagi',
    'ports_switch' => 'Port yang mulai habis',
    'ports_switch_helper' => 'Satu pesan per paket alih-alih satu pesan untuk semuanya, karena yang berguna adalah rentang dan jumlahnya, bukan daftar nama. Hanya paket yang punya rentang yang dilihat, jadi toko yang membiarkan pembelian mengambil port kosong mana pun tidak memakan biaya apa pun untuk diawasi. Mati secara bawaan, seperti yang lain.',
    'stock_left' => 'Peringatkan ketika tersisa',
    'stock_left_helper' => 'Dihitung terhadap batas yang dipasang pada paketnya. Sebuah paket harus turun ke angka ini untuk diperingatkan, dan naik dua di atasnya untuk disebut sehat lagi, jadi paket yang didorong bolak-balik oleh satu pembelian dan satu pembatalan tidak mengatakan apa-apa. Nol di sini adalah sebuah angka, bukan ketiadaan: ia membuat peringatannya diam dan hanya menyisakan pesan yang mengatakan bahwa sebuah paket sudah habis.',
    'stock_left_suffix' => 'lagi',

    'worker' => 'Queue worker',
    'worker_helper' => 'Apakah ada sesuatu yang benar-benar mengerjakan pekerjaan latar belakang plugin ini. Perhatikan lingkarannya: pemeriksaannya sendiri berjalan di antrean, jadi panel yang belum pernah punya worker tidak bisa melaporkannya. Baris di bagian atas halaman ini bisa.',

    // ---- tombolnya ---------------------------------------------------------
    'save' => 'Simpan',
    'saved' => 'Tersimpan',
    'save_failed' => 'Tidak ada yang tersimpan',

    'test' => 'Kirim percobaan',
    'test_one' => 'Coba',
    'test_off' => 'Saluran itu mati',
    'test_off_body' => 'Nyalakan lalu simpan, dan ia akan dicoba bersama yang lain.',
    'test_title' => 'Pesan percobaan',
    'test_body' => 'Kalau kamu membaca ini, peringatan dari panel Pelican-mu sampai ke sini. Tidak ada yang salah.',
    'test_sent' => 'Terkirim ke setiap saluran yang nyala',
    'test_failed' => 'Setidaknya satu saluran menolaknya',
    'test_none' => 'Tidak ada tujuan pengiriman',
    'test_none_body' => 'Tidak ada saluran yang nyala, jadi peringatan sungguhan pun tidak akan sampai ke mana-mana.',

    /*
     * Apa yang harus dilakukan terhadap sebuah penolakan.
     *
     * Alasan dari penyedianya singkat, benar, dan sendirian tak berguna. Dua yang
     * hampir selalu muncul disebut namanya, karena keduanya tidak bisa ditebak
     * dari kodenya: 553 adalah soal pengirim dan bukan penerima, dan 401 dari
     * Discord adalah URL yang sudah dicabut atau salah ketik.
     */
    'hint_email_sender' => 'Server SMTP-mu menolak alamat yang dipakai panel untuk mengirim, bukan alamat yang dituju. Di Admin → Pengaturan → Email, alamat Dari harus berupa kotak surat yang boleh dipakai akun SMTP-mu untuk mengirim. Itu tidak ada hubungannya dengan plugin ini - email percobaan milik Pelican sendiri di halaman itu gagal dengan cara yang persis sama.',
    'hint_email' => 'Lihat di Admin → Pengaturan → Email. Tombol email percobaan di halaman itu memakai pengaturan yang sama dan mengatakan hal yang sama.',
    'hint_discord_url' => 'Discord tidak mengenali webhook itu. Ia sudah dihapus, dibuat ulang, atau ditempel tidak utuh - buat yang baru di Pengaturan server → Integrasi → Webhooks, lalu salin seluruh URL-nya.',
    'hint_discord' => 'Panel tidak menjangkau Discord. Kalau panel ini berada di balik firewall yang memblokir permintaan keluar, saluran ini tidak bisa bekerja dari sini.',
    'hint_panel' => 'Tidak ada yang punya izin untuk ini, atau pemberitahuannya tidak dapat disimpan. Lihat di Peran.',

    'run_now' => 'Jalankan pemeriksaan sekarang',
    'run_started' => 'Sedang memeriksa di latar belakang',
    'run_failed' => 'Pemeriksaan tidak dapat dijalankan',

    'reset' => 'Lupakan yang sudah diketahuinya',
    'reset_confirm' => 'Mengosongkan apa yang terakhir dikatakan setiap pemeriksaan. Putaran berikutnya belajar dari nol dan tidak mengirim apa pun, jadi masalah yang masih berlangsung dilaporkan pada putaran sesudahnya. Pakai ini setelah kamu menonaktifkan sebuah node yang terus diributkan si penjaga.',
    'reset_done' => 'Dikosongkan',

    // ---- pesannya sendiri --------------------------------------------------
    'still' => 'Sudah berlangsung :for.',
    'cleared_body' => 'Sudah begitu selama :for.',
    'ports_title' => 'Port hampir habis untuk :game',
    'ports_body' => 'Pembelian :game mengambil port di rentang :from sampai :to, dan hanya :free dari :total yang masih kosong. Pembelian yang tidak menemukan satu pun tetap dibayar lalu ditolak, jadi tambahkan allocation di node, atau lebarkan rentangnya di paket itu, sebelum itu terjadi.',
    'ports_none_title' => 'Tidak ada port tersisa untuk :game',
    'ports_none' => 'Pembelian :game mengambil port di rentang :from sampai :to, dan seluruh :total port sudah terpakai. Pembelian game ini berikutnya akan dibayar lalu ditolak tanpa allocation. Tambahkan allocation di node, atau lebarkan rentangnya di paket itu sendiri.',
    'ports_empty_title' => 'Belum ada port untuk :game',
    'ports_empty' => 'Pembelian :game mengambil port di rentang :from sampai :to, dan tidak ada satu pun allocation di rentang itu pada node mana pun yang boleh dipakainya. Setiap pembelian game ini akan dibayar lalu ditolak. Buat allocation-nya di node, atau lebarkan rentangnya di paket itu sendiri.',
    'ports_cleared' => 'Port kembali kosong untuk :game',

    'for_unknown' => 'beberapa waktu',
    'for_minutes' => '{1} satu menit|[2,*] :count menit',
    'for_hours' => '{1} satu jam|[2,*] :count jam',
    'for_days' => '{1} satu hari|[2,*] :count hari',

    'node_down' => ':node tidak menjawab',
    'node_down_body' => 'Panel tidak menjangkau daemon di :node. Server di sana tidak akan mulai, tidak akan berhenti, dan tidak akan melaporkan apa pun sampai ia kembali.',
    'node_up' => ':node menjawab lagi',

    'node_disk' => 'Disk di :node hampir habis',
    'node_disk_body' => 'Disk di :node terisi :percent %, di atas :limit % yang kamu setel. Cadangan dan pemasangan server adalah yang pertama gagal ketika ini penuh.',
    'node_disk_over' => 'Disk di :node kembali di bawah batas',

    'node_memory' => 'Memori di :node hampir habis',
    'node_memory_body' => 'Memori di :node terpakai :percent %, di atas :limit % yang kamu setel. Server di sana bisa dimatikan kernel sebelum ada apa pun yang melaporkan masalah.',
    'node_memory_over' => 'Memori di :node kembali di bawah batas',

    'node_maintenance' => ':node sudah lama dalam pemeliharaan',
    'node_maintenance_body' => ':node sudah dalam pemeliharaan lebih dari :hours jam. Sementara itu tidak ada hal lain padanya yang diperiksa, dan memang itulah seluruh maksudnya - tetapi layak diketahui bahwa ia masih begitu.',
    'node_maintenance_over' => ':node keluar dari pemeliharaan',

    'wings_behind' => 'Wings di :node sudah usang',
    'wings_behind_body' => ':node menjalankan Wings :installed, sedangkan :latest sudah keluar. Perbarui di node itu sendiri - panel tidak punya cara untuk melakukannya.',
    'wings_current' => 'Wings di :node sudah mutakhir',

    'panel_behind' => 'Panel sudah usang',
    'panel_behind_body' => 'Panel ini menjalankan :installed, sedangkan :latest sudah keluar.',
    'panel_current' => 'Panel sudah mutakhir',

    'and_more' => 'dan :count lagi',


    'owner_down' => '{1} Salah satu servermu mati|[2,*] :count servermu mati',
    'owner_down_body' => 'Mesin tempat mereka berada berhenti menjawab. Seseorang sudah diberi tahu. Terdampak: :servers',
    'owner_up' => '{1} Servermu sudah kembali|[2,*] :count servermu sudah kembali',
    'owner_up_body' => 'Mesinnya menjawab lagi. Kembali: :servers',

    'schedules' => 'Tugas terjadwal yang berhenti',
    'schedules_helper' => 'Sebuah tugas yang tersangkut di tengah eksekusi, tugas yang waktunya lewat karena cron tidak berjalan, atau tugas yang belum pernah berjalan. Pelican tidak punya kata untuk satu pun dari itu - eksekusi yang jatuh akan tetap "memproses" selamanya dan digambar persis seperti yang sedang berjalan sekarang. Membaca setiap tugas terjadwal yang aktif di panel pada setiap pemeriksaan.',

    'schedule_stopped' => '{1} Satu tugas terjadwal berhenti|[2,*] :count tugas terjadwal berhenti',
    'schedule_stopped_body' => 'Macet lebih dari :hours jam, lewat waktu, belum pernah jalan, atau sama sekali tanpa tugas: :schedules',
    'schedule_running' => 'Semua tugas terjadwal berjalan lagi',

    'unbuilt_over' => 'Setiap pesanan lunas sudah punya servernya',

    'unbuilt_body' => 'Ada yang membayar dan tidak dapat apa-apa. Buka Pesanan dan buat, atau baca kenapa ditolak: :orders',

    'unbuilt' => '{1} Satu pesanan lunas tanpa server|[2,*] :count pesanan lunas tanpa server',

    'stock_out' => '{1} Sebuah paket habis terjual|[2,*] :count paket habis terjual',
    'stock_out_body' => 'Masih dijual, dan tidak ada lagi yang bisa dijual: :packages',
    'stock_low' => '{1} Sebuah paket hampir habis terjual|[2,*] :count paket hampir habis terjual',
    'stock_low_body' => 'Tersisa :limit atau kurang: :packages',
    'stock_back' => '{1} Sebuah paket kembali dijual|[2,*] :count paket kembali dijual',
    'stock_back_body' => 'Ada lagi yang bisa dijual: :packages',

    'backup_none' => '{1} Satu server belum pernah dicadangkan|[2,*] :count server belum pernah dicadangkan',
    'backup_none_body' => 'Belum pernah dicadangkan di: :servers',
    'backup_none_over' => 'Sekarang setiap server punya cadangan',

    'backup_stale' => '{1} Satu server belum dicadangkan belakangan ini|[2,*] :count server belum dicadangkan belakangan ini',
    'backup_stale_body' => 'Tidak ada cadangan yang berhasil selama :days hari di: :servers',
    'backup_stale_over' => 'Setiap server baru-baru ini punya cadangan',

    'backup_failed' => '{1} Pencadangan gagal di satu server|[2,*] Pencadangan gagal di :count server',
    'backup_failed_body' => 'Sebuah cadangan berakhir tanpa berhasil di: :servers',
    'backup_failed_over' => 'Tidak ada lagi cadangan yang gagal',

    'worker_missing' => 'Tidak ada yang mengerjakan antreannya',
    'worker_missing_body' => 'Sebuah pekerjaan diantrikan, dan tidak ada yang mengambilnya. Pembaruan plugin, pemasangan modpack, dan pemeriksaan ini semuanya berhenti sampai ada worker yang berjalan - coba systemctl status pelican-queue di mesin panel.',
    'worker_back' => 'Antreannya dikerjakan lagi',
    'failed_title' => '{1} Satu pekerjaan gagal sejak pemeriksaan terakhir|[2,*] :count pekerjaan gagal sejak pemeriksaan terakhir',
    'failed_body' => 'Sesuatu yang diperintahkan kepada panel tidak terjadi dan tidak akan dicoba lagi - server yang tidak dibuat, faktur yang tidak ditulis, surel yang tidak terkirim. Semuanya ada di tabel failed_jobs; `php artisan queue:retry all` mengembalikannya, setelah apa pun yang menghentikannya diperbaiki.',
    'failed_back' => 'Tidak ada yang gagal sejak pemeriksaan terakhir',
    'failed' => 'Beri tahu saya kalau sebuah pekerjaan di antrean gagal',
    'failed_helper' => 'Laravel mencatat pekerjaan yang sudah ia menyerah padanya dan tidak mengatakan apa-apa soal itu. Ini mengatakannya. Dihitung, bukan didaftar: dua puluh kegagalan dalam satu malam biasanya satu sebab.',

    'health_interval_off' => 'Peringatan menyala, tetapi intervalnya Mati, jadi penjaga tidak pernah berjalan.',
    'health_owners_unwatched' => 'Peringatan pemilik menyala, tetapi penjaga tidak berjalan, jadi pemilik tidak pernah diberi tahu soal gangguan.',
    'health_no_channel' => 'Penjaga berjalan, tetapi semua cara untuk memberi tahu seseorang dimatikan.',
    'health_discord' => 'Peringatan Discord menyala, tetapi tidak ada webhook https valid yang tersimpan.',
    'health_bot' => 'Peringatan bot menyala, tetapi alamat https atau rahasia penandatanganan tidak ada.',
    'health_email' => 'Email peringatan menyala, tetapi tidak ada alamat yang valid, atau pengirim email panel hanya menulis ke log-nya.',
];
