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
    'when_helper' => 'Pemeriksaan berjalan di latar belakang, jadi mereka butuh sebuah queue worker. Tanpa itu tidak ada yang terkirim, dan tidak ada yang memberitahumu — pakai "Kirim percobaan", yang tidak lewat antrean.',

    'every' => 'Periksa setiap',
    'every_helper' => 'Setiap pemeriksaan menjangkau daemon di setiap node, jadi itu satu permintaan per node per putaran. Lima belas menit sudah cukup untuk mendengar tentang sebuah gangguan selagi ia masih gangguan.',
    'every_off' => 'Mati — tidak ada pemeriksaan sama sekali',
    'every_five' => '5 menit',
    'every_fifteen' => '15 menit',
    'every_thirty' => '30 menit',
    'every_hourly' => 'Jam',
    'every_daily' => 'Hari',

    'repeat' => 'Ingatkan aku selama ini berlangsung',
    'repeat_helper' => 'Sebuah pesan dikirim ketika sesuatu berubah, dan satu lagi ketika ia pulih. Ini menambahkan pengingat selama masalahnya masih berlangsung. Nol berarti tanpa pengingat — sebuah saluran yang mengulang dirinya setiap seperempat jam adalah saluran yang dibisukan orang.',
    'hours' => 'jam',

    // ---- ke mana -----------------------------------------------------------
    'where' => 'Saluran',
    'where_helper' => 'Lebih dari satu itu bijak. Mereka gagal dengan cara yang berbeda-beda.',

    'discord' => 'Discord',
    'discord_helper' => 'Tempat sebuah pesan benar-benar dibaca oleh orang yang tidak sedang duduk memandangi panel.',
    'webhook' => 'Alamat webhook',
    'webhook_helper' => 'Di Discord: Pengaturan server → Integrasi → Webhooks → Webhook baru → Salin URL webhook. Dibatasi ke https, karena ini mempublikasikan mesin mana milikmu yang mati dan seberapa penuh disknya.',

    'panel' => 'Di panel',
    'panel_helper' => 'Sebuah pemberitahuan kepada semua orang yang memegang izin ini. Selalu bekerja, tidak butuh pengaturan, dan tidak terlihat oleh siapa pun yang tidak masuk.',

    'email' => 'Email',
    'email_helper' => 'Dipisahkan koma. Memakai mailer milik panel sendiri — andal ketika disetel, dan sepenuhnya bisu ketika tidak, dan itulah satu-satunya kegagalan yang tidak boleh dimiliki seorang penjaga. Biarkan kosong untuk mematikannya.',

    // ---- apa ---------------------------------------------------------------
    'what' => 'Apa yang diawasi',
    'what_helper' => 'Setiap pembacaan di sini adalah pembacaan yang memang sudah dilakukan panel. Tidak ada di halaman ini yang membuka koneksi yang tidak dibuka Status sistem.',

    'percent_helper' => 'Nol mematikan pemeriksaan ini.',
    'disk' => 'Peringatkan ketika disk sebuah node melewati',
    'memory' => 'Peringatkan ketika memori sebuah node melewati',

    'maintenance' => 'Peringatkan tentang pemeliharaan yang sudah lebih dari',
    'maintenance_helper' => 'Sebuah node dalam pemeliharaan dilewati semua pemeriksaan lain, dan itu benar — dan begitu pulalah cara sebuah node dilupakan selama empat belas hari. Nol mematikannya.',

    'versions' => 'Versi panel dan Wings',
    'versions_helper' => 'Satu pesan ketika sesuatu tertinggal, dan satu ketika ia mutakhir lagi. Tanpa pengingat — sebuah versi bukan gangguan.',

    'backups' => 'Cadangan yang tertinggal',
    'backups_helper' => 'Satu pesan yang menyebut server-servernya alih-alih satu pesan per server — ketika sebuah tugas terjadwal berhenti, semua server menjadi basi sekaligus, dan empat puluh pesan terpisah untuk satu sebab adalah saluran yang dibisukan orang. Mati secara bawaan: panel yang mencadangkan secara manual dan bukan menurut jadwal akan mendengarnya setiap hari.',
    'backup_days' => 'Sebut sebuah cadangan basi setelah',
    'backup_days_helper' => 'Itu juga yang dipakai halaman Cadangan. Server yang dicadangkan mingguan tidak seharusnya dilaporkan setelah delapan hari.',
    'days' => 'hari',

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
    'hint_email_sender' => 'Server SMTP-mu menolak alamat yang dipakai panel untuk mengirim, bukan alamat yang dituju. Di Admin → Pengaturan → Email, alamat Dari harus berupa kotak surat yang boleh dipakai akun SMTP-mu untuk mengirim. Itu tidak ada hubungannya dengan plugin ini — email percobaan milik Pelican sendiri di halaman itu gagal dengan cara yang persis sama.',
    'hint_email' => 'Lihat di Admin → Pengaturan → Email. Tombol email percobaan di halaman itu memakai pengaturan yang sama dan mengatakan hal yang sama.',
    'hint_discord_url' => 'Discord tidak mengenali webhook itu. Ia sudah dihapus, dibuat ulang, atau ditempel tidak utuh — buat yang baru di Pengaturan server → Integrasi → Webhooks, lalu salin seluruh URL-nya.',
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

    'for_unknown' => 'beberapa waktu',
    'for_minutes' => ':count menit',
    'for_hours' => ':count jam',
    'for_days' => ':count hari',

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
    'node_maintenance_body' => ':node sudah dalam pemeliharaan lebih dari :hours jam. Sementara itu tidak ada hal lain padanya yang diperiksa, dan memang itulah seluruh maksudnya — tetapi layak diketahui bahwa ia masih begitu.',
    'node_maintenance_over' => ':node keluar dari pemeliharaan',

    'wings_behind' => 'Wings di :node sudah usang',
    'wings_behind_body' => ':node menjalankan Wings :installed, sedangkan :latest sudah keluar. Perbarui di node itu sendiri — panel tidak punya cara untuk melakukannya.',
    'wings_current' => 'Wings di :node sudah mutakhir',

    'panel_behind' => 'Panel sudah usang',
    'panel_behind_body' => 'Panel ini menjalankan :installed, sedangkan :latest sudah keluar.',
    'panel_current' => 'Panel sudah mutakhir',

    'and_more' => 'dan :count lagi',

    'owners' => 'Beri tahu orang ketika mesin di balik server mereka mati',
    'owners_helper' => 'Satu-satunya pemeriksaan di sini yang menulis kepada orang selain kamu. Pemilik setiap server di sebuah mesin yang berhenti menjawab mendapat satu pemberitahuan di panel — loncengnya, tidak pernah email — dan satu lagi ketika mesinnya kembali. Tidak pernah ada pengingat di antaranya: mengulanginya setiap seperempat jam kepada semua orang di node yang sibuk adalah cara peringatan sebuah panel berhenti dibaca. Subuser tidak diberi tahu; pemiliklah yang memutuskan apa yang harus dilakukan. Mesinnya tidak disebutkan kepada mereka, dengan alasan yang sama seperti halaman status tidak mempublikasikannya.',

    'owner_down' => 'Salah satu servermu mati|:count servermu mati',
    'owner_down_body' => 'Mesin tempat mereka berada berhenti menjawab. Seseorang sudah diberi tahu. Terdampak: :servers',
    'owner_up' => 'Servermu sudah kembali|:count servermu sudah kembali',
    'owner_up_body' => 'Mesinnya menjawab lagi. Kembali: :servers',

    'schedules' => 'Tugas terjadwal yang berhenti',
    'schedules_helper' => 'Sebuah tugas yang tersangkut di tengah eksekusi, tugas yang waktunya lewat karena cron tidak berjalan, atau tugas yang belum pernah berjalan. Pelican tidak punya kata untuk satu pun dari itu — eksekusi yang jatuh akan tetap "memproses" selamanya dan digambar persis seperti yang sedang berjalan sekarang. Membaca setiap tugas terjadwal yang aktif di panel pada setiap pemeriksaan.',

    'schedule_stopped' => ':count tugas terjadwal berhenti',
    'schedule_stopped_body' => 'Tersangkut lebih dari :hours jam, terlambat, atau belum pernah berjalan: :schedules',
    'schedule_running' => 'Semua tugas terjadwal berjalan lagi',

    'backup_none' => ':count server belum pernah punya cadangan',
    'backup_none_body' => 'Belum pernah dicadangkan di: :servers',
    'backup_none_over' => 'Sekarang setiap server punya cadangan',

    'backup_stale' => ':count server sudah lama tanpa cadangan',
    'backup_stale_body' => 'Tidak ada cadangan yang berhasil selama :days hari di: :servers',
    'backup_stale_over' => 'Setiap server baru-baru ini punya cadangan',

    'backup_failed' => 'Cadangan gagal di :count server',
    'backup_failed_body' => 'Sebuah cadangan berakhir tanpa berhasil di: :servers',
    'backup_failed_over' => 'Tidak ada lagi cadangan yang gagal',

    'worker_missing' => 'Tidak ada yang mengerjakan antreannya',
    'worker_missing_body' => 'Sebuah pekerjaan diantrikan, dan tidak ada yang mengambilnya. Pembaruan plugin, pemasangan modpack, dan pemeriksaan ini semuanya berhenti sampai ada worker yang berjalan — coba systemctl status pelican-queue di mesin panel.',
    'worker_back' => 'Antreannya dikerjakan lagi',
];
