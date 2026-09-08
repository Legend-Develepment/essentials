<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Egg", "node", "subuser", "Wings", "queue", "webhook", "topbar", "cron" dan
 * nama format berkas dibiarkan apa adanya: dengan nama itulah kamu menemukannya
 * di Pelican, di mesinnya, dan di semua yang ditulis tentangnya. Nama gaya juga
 * tidak diterjemahkan — sebuah gaya bernama sebagaimana namanya, dan nama yang
 * diterjemahkan hanya akan menjadi satu nama lagi untuk hal yang sama.
 */

return [
    'css_warning' => 'Tersimpan, tetapi CSS ini tampak keliru',
    'css_unclosed' => 'Sebuah aturan yang dibuka di baris :line tidak pernah ditutup. Semua sesudahnya berada di dalam aturan itu dan tidak berpengaruh apa pun.',
    'css_extra' => 'Ada kurung kurawal penutup di baris :line padahal tidak ada yang terbuka. Semua sesudahnya berada di luar aturan mana pun dan dilewati.',
    'css_comment' => 'Sebuah komentar yang dibuka di baris :line tidak pernah ditutup, jadi sisa berkasnya berada di dalamnya.',

    'groups' => [
        'appearance' => 'Tampilan',
        'servers' => 'Daftar server',
        'windows' => 'Gaya menurut waktu',
        'windows_helper' => 'Gaya yang berbeda di antara dua waktu dalam sehari. Tidak terjadi apa pun sampai kamu menambahkan satu. Jamnya adalah jam milik panel sendiri, dari pengaturan zona waktunya, dan bukan jam setiap pembaca — panel yang terlihat berbeda bagi dua orang pada saat yang sama akan tampak rusak alih-alih terencana. Sebuah rentang mengubah tampilan yang sudah dimiliki panel, jadi ia tidak melakukan apa pun selagi gayanya "Tidak ada". Gaya yang dipilih seseorang untuk dirinya sendiri tetap mengalahkannya.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Bahasa',
        'servers_helper' => 'Bagaimana sebuah kartu server digambar. Apakah mereka tampil sebagai kisi atau daftar adalah pilihan masing-masing orang, di Akun → Tata letak ikhtisar.',
        'server_pages' => 'Halaman server',
        'server_pages_helper' => 'Apa yang dibawa setiap halaman di dalam sebuah server, halaman apa pun itu.',
        'console' => 'Halaman konsol',
        'console_helper' => 'Fon, ukuran, dan tinggi terminal adalah pilihan masing-masing orang, di Akun.',
        'background' => 'Latar belakang',
        'background_helper' => 'Berlaku untuk seluruh panel, termasuk layar masuk.',
        'icons' => 'Ikon',
        'bars' => 'Pengukur sumber daya',
        'bars_helper' => 'Bilah prosesor, memori, dan disk di kartu server.',
        'updates' => 'Pembaruan',
        'updates_helper' => 'Rilis mana yang ditawarkan halaman Tema, dan di mana ia mencarinya.',
        'brand' => 'Merek',
        'login' => 'Layar masuk',
        'login_helper' => 'Berlaku untuk layar masuk, setel ulang kata sandi, dan dua faktor.',
        'advanced' => 'CSS milikmu',
        'advanced_helper' => 'Untuk semua yang tidak dicakup pengaturan di atas. Dimuat setelah yang lain, jadi ia menang.',
        'areas' => 'Per area',
        'areas_helper' => 'Semua di atas berlaku di mana-mana. Di sini kamu bisa memisahkan satu area; apa pun yang kamu biarkan kosong tetap mengikuti pengaturan bersamanya.',
        'footer' => 'Bagian bawah bilah samping',
        'footer_helper' => 'Bagian bawah bilah samping, yang dibiarkan kosong oleh Pelican. Semua di sini mati sampai kamu mengisinya.',
        'features' => 'Apa yang ditambahkan plugin ini',
        'features_helper' => 'Kalau kamu melepas centang dari sesuatu, ia hilang sama sekali dari panel. Pengaturannya tetap disimpan, dan halamannya tetap punya alamatnya, jadi tidak ada yang hilang dengan mematikan sesuatu untuk melihat apa yang dilakukannya. Kebanyakan juga punya izinnya sendiri di bawah Peran, jadi satu bisa diberikan tanpa memberikan sisanya. Tidak semuanya: pengukur sumber daya, bagian bawah bilah samping, dan pencarian di pengaturan digambar untuk semua orang dan tidak dikendalikan siapa pun; bintang di sebuah kartu server milik orang yang mengekliknya; dan halaman Palworld serta Minecraft di dalam sebuah server mengikuti izin server itu sendiri alih-alih salah satu dari ini. Tampilannya sendiri tidak ada di daftar — ia punya sakelarnya sendiri, di Look → Tampilan → Gaya → Tidak ada.',
        'identity' => 'Plugin ini di bilah samping',
        'identity_helper' => 'Baris yang ditambahkan plugin ini ke bilah samping, dan gambar di atasnya.',
    ],

    /*
     * Halaman-halaman pengaturan, masing-masing sebuah baris di grup milik
     * plugin ini sendiri di bilah samping. Dikelompokkan menurut pertanyaan yang
     * kamu jawab, bukan menurut kelas yang membuatnya.
     */
    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Warna, bentuk, dan nama panelnya.',
        'pages' => 'Halaman',
        'pages_helper' => 'Daftar server, halaman di dalam sebuah server, dan terminal.',
        'advanced' => 'Lanjutan',
        'advanced_helper' => 'Dua pintu darurat: CSS milikmu, dan pengaturan yang hanya berlaku untuk satu area.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Egg mana yang Minecraft, dan semua hal lain tentang itu.',
        'artwork' => 'Gambar egg',
        'artwork_helper' => 'Sebuah halaman berisi setiap egg, dan cara mengambil gambar game-nya dari Steam atau IGDB. Ia menulis ke egg-nya sendiri — gambarnya, dan dua label yang mencatat game apa itu dan apakah gambarnya dipilih sendiri — dan karena itulah ia membawa izinnya sendiri.',
        'alerts' => 'Peringatan',
        'alerts_helper' => 'Pemeriksaan berkala atas apa yang sudah diukur panel tetapi tidak diberitahukannya kepada siapa pun: sebuah node yang berhenti menjawab, disk yang memenuh, queue worker yang berhenti, versi yang tertinggal. Mengirim ke Discord, ke panel, atau lewat email. Izinnya sendiri, karena ia menjangkau setiap node secara berkala dan mengirim ke alamat yang diketik seseorang.',
        'backups' => 'Ikhtisar cadangan',
        'backups_helper' => 'Sebuah halaman berisi setiap server dan sudah berapa lama ia tanpa cadangan, diurutkan sehingga yang tidak punya sama sekali ada di atas. Hanya baca — segala yang melakukan sesuatu pada sebuah cadangan tetap di halaman Pelican sendiri untuk server itu. Izinnya sendiri, karena daftarnya adalah peta tentang di mana lubangnya.',
        'public_status' => 'Halaman status publik',
        'public_status_helper' => 'Sebuah halaman yang bisa dibuka siapa saja tanpa akun, yang menunjukkan server mana milikmu yang berjalan dan berapa orang yang ada di dalamnya. Tidak ada yang dipublikasikan sampai kamu menyebut sebuah server, mesin, atau layanan — ketiga daftarnya mulai kosong, dan selama begitu, alamatnya menjawab 404. Izinnya sendiri, karena ialah yang memutuskan apa yang meninggalkan panel.',
        'game_players' => 'Pemain, game lain',
        'capacity' => 'Kapasitas',
        'capacity_helper' => 'Berapa yang sudah dijanjikan di setiap mesin dibandingkan berapa yang boleh ia bagikan, supaya kamu bisa melihat apakah masih muat satu server lagi. Daftar node Pelican menampilkan sebuah nama dan jumlah server, dan blok Mesin di ikhtisar menampilkan apa yang sedang berjalan - ini pertanyaan yang ketiga, dan perhitungannya milik Pelican sendiri. Hanya baca. Izinnya sendiri.',
        'schedules' => 'Tugas terjadwal',
        'schedules_helper' => 'Setiap tugas terjadwal di panel, beserta mana yang berhenti: tersangkut di tengah eksekusi, terlambat karena cron tidak berjalan, atau belum pernah berjalan. Pelican menampilkan jadwal di dalam setiap server, dan statusnya sendiri tidak punya kata untuk satu pun dari kasus itu. Hanya baca. Izinnya sendiri.',
        'activity' => 'Aktivitas',
        'activity_helper' => 'Setiap peristiwa yang dicatat panel, dalam satu daftar, bukan satu server pada satu waktu. Pelican menyimpan catatannya dan menampilkannya per server; ini menanyakan catatan yang sama dari arah sebaliknya. Hanya baca. Izinnya sendiri, karena ikhtisar tentang siapa melakukan apa adalah sesuatu yang diserahkan dengan sengaja.',
        'access' => 'Akses server',
        'access_helper' => 'Ikatkan sebuah peran ke server, supaya semua pemegangnya dapat menjangkaunya. Ia bekerja dengan menjaga subuser milik Pelican sendiri tetap mutakhir, dan justru itulah yang sudah dibaca daftar server dan setiap pemeriksaan izin. Izinnya sendiri, karena inilah satu-satunya halaman di sini yang memberi orang akses ke sesuatu.',
        'games' => 'Game lain',
        'games_helper' => 'Berkas yang disimpan ARK dan Valheim di sebelah dunianya, sebagai formulir: pengaturan dunia ARK, dan daftar admin, ban, dan yang diizinkan milik Valheim. Server mana yang mendapatkannya adalah daftar egg di halaman itu, jadi daftar kosong sudah menjadi sakelar per game.',
        'game_players_helper' => 'Sebuah halaman di dalam Rust, ARK, Valheim, dan apa pun lainnya yang menjawab kueri Valve, yang menampilkan siapa yang terhubung dan sudah berapa lama ia di dalam. Hanya baca — apa yang bisa kamu lakukan pada seseorang berbeda antar-game, dan itu rilis tersendiri. Egg mana yang dihitung adalah daftar yang sama yang dipakai halaman status.',
        'api' => 'API',
        'api_helper' => 'Kunci yang dipegang orang, siapa yang meminta satu, dan apa yang boleh dilihat masing-masing.',
        'languages' => 'Bahasa',
        'languages_helper' => 'Dalam bahasa apa saja plugin ini menjawab.',
    ],

    'features' => [
        'look' => 'Pengaturan Look',
        'look_helper' => 'Baris di bilah samping untuk warna, bentuk, dan merek.',
        'pages' => 'Pengaturan halaman',
        'pages_helper' => 'Baris di bilah samping untuk daftar server, halaman server, dan terminal.',
        'advanced' => 'Pengaturan lanjutan',
        'advanced_helper' => 'Baris di bilah samping untuk CSS milikmu dan pengecualian per area.',
        'announcements' => 'Pengumuman',
        'announcements_helper' => 'Pita di bagian atas panel.',
        'nav_links' => 'Tautan navigasi',
        'nav_links_helper' => 'Barismu sendiri di bilah samping.',
        'login' => 'Layar masuk',
        'login_helper' => 'Gambar, pesan, dan tautan pada layar masuk.',
        'bars' => 'Pengukur sumber daya',
        'bars_helper' => 'Bilah yang berganti warna untuk prosesor, memori, dan disk.',
        'dashboard_status' => 'Baris versi',
        'dashboard_status_helper' => 'Bagian atas blok di ikhtisar: versi mana yang terpasang, dan apakah ada yang menunggu.',
        'dashboard_nodes' => 'Mesin',
        'dashboard_nodes_helper' => 'Sisa blok di ikhtisar: panel ini dan setiap node, beserta apa yang dipakai masing-masing.',
        'system_status' => 'Halaman Status sistem',
        'system_status_helper' => 'Halaman untuk mesin tempat panel ini sendiri berjalan.',
        'sidebar_footer' => 'Bagian bawah bilah samping',
        'sidebar_footer_helper' => 'Baris teksmu, versi panel, dan satu tautan, di bagian bawah bilah samping.',
        'console' => 'Tombol konsol',
        'console_helper' => 'Tombol mengambang di dalam sebuah server, dengan konsol dan tombol daya di atasnya, yang menjangkau node secara langsung. Bentuk yang diambilnya ada di pengaturan halaman server; ini menentukan apakah ia digambar sama sekali.',
        'arranger' => 'Penata halaman',
        'arranger_helper' => 'Menyeret blok di sebuah halaman ke urutan yang diinginkan seseorang. Ia punya izin tersendiri di bawah Peran, jadi ini menentukan apakah panel menawarkannya dan izinnya menentukan kepada siapa.',
        'user_themes' => 'Gaya per orang',
        'user_themes_helper' => 'Membiarkan setiap orang memilih gaya dari yang kamu tawarkan, di Tampilan pada area klien. Gaya mana saja yang ditawarkan ada di halaman Look; ini menentukan apakah ada yang ditanya sama sekali.',
        'api' => 'API',
        'api_helper' => 'Sebuah jalan masuk dari luar panel: sebuah alamat yang bisa ditanyai bot Discord atau skrip milikmu sendiri tentang apa yang diketahui plugin ini — siapa yang sedang bermain, server mana yang tidak punya cadangan, apakah masih muat satu lagi di sebuah node. Mati tidak mendaftarkan rute sama sekali alih-alih mendaftarkan satu yang menolak, dan itu berarti permukaan yang lebih sedikit, bukan jumlah permukaan yang sama tetapi lebih sopan. Siapa pun yang masuk boleh meminta sebuah kunci yang hanya menjawab untuk servernya sendiri; memberikan satu, menolak satu, mencabut satu yang dipegang orang lain, dan menerbitkan satu untuk seluruh panel semuanya menuntut izin.',
        'languages' => 'Bahasa',
        'languages_helper' => 'Menjawab setiap orang dalam bahasa yang disetel di akunnya, di tempat plugin ini sudah diterjemahkan ke bahasa itu. Kalau ini mati, semua orang mendapat bahasa Inggris.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Sebuah tab Minecraft di bilah samping, dan sebuah halaman di dalam setiap server Minecraft untuk menyunting server.properties-nya sebagai formulir. Egg mana yang dihitung, kamulah yang menentukan.',
        'palworld' => 'Pengaturan Palworld',
        'palworld_helper' => 'Sebuah halaman di dalam sebuah server Palworld untuk menyunting pengaturan dunianya. Ia tidak muncul di server lain mana pun, dan tidak pernah selagi server itu berjalan.',
        'settings_search' => 'Pencarian pengaturan',
        'settings_search_helper' => 'Kolom di atas formulir ini yang mempersempitnya ke bagian-bagian yang memuat apa yang kamu ketik.',
        'preview' => 'Pratinjau langsung',
        'preview_helper' => 'Kotak di samping formulir Look yang menunjukkan apa yang dilakukan warna, sudut, dan jarak sebelum kamu menyimpannya.',
        'duplicate' => 'Gandakan server',
        'duplicate_helper' => 'Sebuah halaman untuk menyiapkan satu server lagi persis seperti yang sudah kamu punya, atau beberapa sekaligus. Berkas tidak pernah disalin.',
        'favourites' => 'Server berbintang',
        'favourites_helper' => 'Sebuah bintang di setiap kartu server. Yang berbintang tampil lebih dulu, dan daftar masing-masing orang disimpan di panel — jadi bintangnya ikut ke tempat mana pun ia masuk berikutnya. Ini mengubah apa yang ia lihat sendiri, dan tidak mengubah apa pun bagi orang lain. Meski begitu, disimpan di panel berarti ia adalah sebuah berkas di bawah storage, yang bisa dibaca siapa pun yang punya akses ke mesinnya.',
        'artwork' => 'Gambar egg',
        'artwork_helper' => 'Halaman administrasi yang mengambil gambar setiap egg dari Steam atau IGDB dan menulisnya ke egg itu sendiri.',
        'alerts' => 'Peringatan',
        'alerts_helper' => 'Pemeriksaan berkala untuk node yang berhenti menjawab, disk yang memenuh, queue worker yang mati, atau versi yang tertinggal — beserta pesan Discord, panel, atau email yang dikirimnya.',
        'backups' => 'Ikhtisar cadangan',
        'backups_helper' => 'Halaman administrasi yang mendaftar setiap server menurut sudah berapa lama ia tanpa cadangan. Hanya baca.',
        'public_status' => 'Halaman status publik',
        'public_status_helper' => 'Halaman yang bisa dibuka siapa saja tanpa akun. Kalau ia mati, alamatnya menjawab 404 apa pun isi daftarnya.',
        'game_players' => 'Pemain, game lain',
        'game_players_helper' => 'Sebuah halaman di dalam Rust, ARK, Valheim, dan apa pun lainnya yang menjawab kueri Valve, yang menampilkan siapa yang terhubung dan sudah berapa lama ia di dalam.',
        'owner_alerts' => 'Beri tahu orang bahwa server mereka mati',
        'owner_alerts_helper' => 'Satu-satunya bagian plugin ini yang menulis kepada orang yang bukan administrator: sebuah pemberitahuan di panel ketika mesin di balik salah satu server mereka berhenti menjawab, dan satu lagi ketika ia kembali. Mati sampai kamu menyalakannya di sini dan juga di halaman Peringatan - ia menulis kepada pelangganmu, jadi ia menuntut dua keputusan, bukan satu.',
        'my_backups' => 'Peringatan cadangan di daftar server',
        'my_backups_helper' => 'Sebuah baris di atas daftar server milik masing-masing orang ketika salah satu servernya belum pernah punya cadangan atau sudah lama tanpa cadangan. Kartu Pelican menyebut apa yang sedang dilakukan sebuah server; tidak ada di sana yang menyebut bahwa cadangan sudah tiga minggu tidak berjalan. Hanya digambar ketika ada yang tertinggal, dan ia tidak menyebut server mana pun yang tidak bisa dibuka orang itu sendiri.',
        'capacity' => 'Ikhtisar kapasitas',
        'capacity_helper' => 'Halaman administrasi yang menampilkan memori, disk, dan prosesor yang dijanjikan dibandingkan yang tersedia di setiap mesin, beserta server yang kehabisan cadangan, basis data, atau allocation. Dijanjikan, bukan terpakai - sebuah node bisa sibuk dan kosong, atau tenang dan penuh.',
        'schedules' => 'Ikhtisar tugas terjadwal',
        'schedules_helper' => 'Halaman administrasi yang mendaftar setiap tugas terjadwal di seluruh panel, yang terburuk lebih dulu - tersangkut, terlambat, atau belum pernah berjalan. Hanya baca; segala yang mengubah atau menjalankan satu tugas tetap di halaman Pelican sendiri untuk server itu.',
        'activity' => 'Aktivitas panel',
        'activity_helper' => 'Halaman administrasi yang mendaftar setiap peristiwa tercatat di seluruh panel, yang terbaru lebih dulu, beserta siapa yang melakukannya dan di server mana. Hanya baca - ia tidak menghapus apa pun, dan pengaturan Pelican sendiri yang tetap menentukan berapa lama barisnya bertahan.',
        'access' => 'Akses server menurut peran',
        'access_helper' => 'Sebuah halaman untuk mengikat sebuah peran ke server, dijaga tetap benar di tabel subuser milik Pelican sendiri. Ia tidak memberi apa pun sampai kamu menghubungkan sesuatu. Mematikannya menghentikan penyelarasan; akses yang sudah diberikan tetap ada, dan halamannya punya sebuah tombol untuk mengambilnya kembali.',
        'scheduled' => 'Gaya menurut waktu',
        'scheduled_helper' => 'Bagian di halaman Look yang memberi panel gaya berbeda di antara dua waktu dalam sehari. Ia tidak mengubah apa pun yang tersimpan — sebuah rentang ditumpangkan di atas pengaturan selagi halamannya digambar lalu langsung dilepas — jadi mematikannya mengembalikan tampilan panel sendiri seketika dan tidak menghilangkan apa pun.',
        'games' => 'Game lain',
        'games_helper' => 'Pengaturan dunia ARK dan daftar admin, ban, serta yang diizinkan milik Valheim, sebagai formulir alih-alih sebagai berkas di pengelola berkas. Server mana yang mendapatkannya adalah daftar egg di halaman Game lain.',
        'quick' => 'Menu "Pergi ke"',
        'quick_helper' => 'Satu butir di bagian atas setiap halaman untuk melompat ke sebuah server atau ke halaman berbintang, dengan kolom pencarian di seluruh daftar servermu. Ia juga menyorot halaman tempat kamu berada. Apa yang ditemukan seseorang lewatnya adalah apa yang memang sudah bisa ia jangkau, jadi ia tidak memberi apa pun - mematikannya menghilangkan jalan pintasnya dan halaman Favorit sekalian.',
        'shop' => 'Toko',
        'shop_helper' => 'Menjual server dari panel: toko dan kasir di sisi pelanggan, halaman faktur setiap orang, dan halaman Pengaturan toko untuk mata uang, pajak dan teksnya. Sakelar utama — dimatikan, tidak ada yang bisa membeli atau membayar, dan yang sudah terjual tetap diurus lewat halaman-halaman di bawah.',
        'packages' => 'Paket',
        'packages_helper' => 'Halaman admin tempat menentukan apa yang dijual: cetakan server dengan harga, periode dan stok. Hak tersendiri, karena menentukan harga adalah pekerjaan yang berbeda dari menandai faktur sebagai lunas.',
        'orders' => 'Pesanan',
        'orders_helper' => 'Halaman admin berisi semua yang dibeli, server yang terbentuk dari setiap pesanan, dan keadaannya — menunggu, aktif, dihentikan, dibatalkan. Hak tersendiri.',
        'invoices' => 'Faktur',
        'invoices_helper' => 'Halaman admin berisi yang terutang dan yang sudah dibayar, dengan tombol untuk menandai faktur lunas secara manual. Hak tersendiri, karena tombol itulah tempat uang dibukukan.',
        'payments' => 'Pembayaran',
        'payments_helper' => 'Penyedia pembayaran — kunci mereka dan setiap percobaan lewat mereka. Hak tersendiri, karena di sanalah kredensial tinggal: yang melihat setiap faktur tidak perlu melihat rahasianya.',
        'coupons' => 'Kupon',
        'coupons_helper' => 'Kode yang memotong persentase atau jumlah tetap dari faktur pertama, dengan masa berlaku dan batas pemakaian. Hak tersendiri.',
        'customers' => 'Pelanggan',
        'customers_helper' => 'Halaman admin yang membalik toko: satu baris per orang yang pernah membeli, dengan apa yang dipegangnya, apa yang sudah dibayar dan apa yang tersisa. Hak tersendiri, karena ini satu-satunya halaman toko yang tentang orang, bukan tentang baris - yang menentukan harga tidak butuh seluruh riwayat pelanggan, dan yang menjawab tiket butuh.',
        'overview' => 'Ikhtisar toko',
        'overview_helper' => 'Halaman yang menjawab apa yang masuk bulan ini, apa yang terutang, berapa nilai layanan aktif setiap bulan dan apa yang perlu dilihat hari ini. Hak tersendiri, karena omzet bukan sesuatu yang boleh dibaca semua orang yang berhak menentukan harga sebuah paket.',
        'terminate' => 'Menghentikan layanan',
        'terminate_helper' => 'Tombol yang menghentikan layanan sekarang dan menghapus servernya, berkas dan segalanya. Sengaja dipisahkan dari hak Pesanan: menangguhkan, memindahkan jatuh tempo dan membatalkan semuanya bisa dibalik, yang ini tidak. Orang yang menjawab tiket bisa punya tiga yang pertama tanpa punya yang ini.',
        'public_shop' => 'Halaman toko publik',
        'public_shop_helper' => 'Halaman yang bisa dibuka siapa saja tanpa akun, berisi apa yang dijual. Halaman ini tidak menerbitkan apa pun yang tidak akan dilihat pelanggan yang sudah masuk di toko, jadi nyala atau mati adalah seluruh keputusannya — dimatikan menjawab 404, seperti halaman status.',
    ],

    /*
     * Kolom pencarian di atas formulir pengaturan. Ia menyaring apa yang memang
     * sudah ada di halaman di dalam peramban dan tidak menanyakan apa pun ke
     * server, jadi tidak ada keadaan "sedang mencari" yang perlu digambarkan dan
     * tidak ada cara baginya untuk gagal.
     */
    /*
     * Pratinjau. Semua di dalamnya adalah pengganti, bukan contoh dari panelmu,
     * dan kata-katanya menyebut itu - sebuah kotak yang menyebut server sungguhan
     * atau angka sungguhan akan dibaca sebagai sungguhan.
     */
    'preview' => [
        'label' => 'Pratinjau',
        'card' => 'Sebuah kartu',
        'card_helper' => 'Digambar dengan aturan yang sama seperti panel, memakai pengaturan di halaman ini alih-alih yang tersimpan.',
        'button' => 'Sebuah tombol',
        'field' => 'Sebuah kolom',
        'meter_ok' => 'Baik',
        'meter_warning' => 'Peringatan',
        'meter_danger' => 'Bahaya',

        /*
         * Pratinjau seluruh halaman. Sebuah tab dan bukan bingkai, karena
         * Pelican mengirim X-Frame-Options: DENY dan menolak dibingkai oleh apa
         * pun, termasuk dirinya sendiri - lihat Support\FullPreview.
         */
        'full' => 'Lihat seluruh panel',
        'full_confirm' => 'Membuka panel yang digambar dari pengaturan di halaman ini alih-alih dari yang tersimpan. Tidak ada yang ditulis — nilainya disimpan lima belas menit, dan panel kembali seperti biasa ketika kamu meninggalkan pratinjau atau menyimpan.',
        'full_go' => 'Tunjukkan',
        'full_failed' => 'Pratinjau tidak dapat dijalankan',
        'bar' => 'Kamu sedang melihat pengaturan yang belum tersimpan. Tidak ada satu pun darinya yang ditulis.',
        'bar_back' => 'Kembali ke pengaturan',
    ],

    'search' => [
        'placeholder' => 'Cari di pengaturan',
        'label' => 'Cari di pengaturan ini',
        'none' => 'Tidak ada di halaman ini yang cocok. Pengaturannya tersebar di empat halaman — coba Look, Halaman, Lanjutan, atau Pengaturan Essentials.',
    ],

    'footer' => [
        'text' => 'Barismu sendiri',
        'text_helper' => 'Teks biasa, paling banyak 120 karakter. Ia di-escape, sama seperti pita pengumuman — ini digambar di setiap halaman panel, dan itu menjadikannya tempat yang salah untuk menerima markup.',
        'version' => 'Tampilkan versi panel',
        'version_helper' => 'Versi Pelican, bukan versi plugin ini. Plugin menyebut versinya sendiri di ikhtisar; yang dicari orang di bagian bawah bilah samping adalah panel mana yang sedang mereka lihat.',
        'link_label' => 'Teks tautan',
        'link_url' => 'Alamat tautan',
        'link_url_helper' => 'Sebuah alamat http atau https, atau sebuah jalur di panel ini sendiri seperti /account. Dibuka di tab baru.',
    ],

    'layout' => [
        'label' => 'Tata letak',
        'helper' => 'Bagaimana panel disusun, bukan apa warnanya. Berlaku sama untuk area administrasi, daftar server, dan area klien. Di mana navigasinya berada adalah nilai bawaan: orang yang sudah menyetel miliknya sendiri di Akun → Navigasi tetap memakainya.',
        'default' => 'Bilah samping — milik Pelican sendiri',
        'rail' => 'Jalur ikon — sempit, terbuka saat disorot',
        'top' => 'Navigasi di atas — tanpa bilah samping',
        'mixed' => 'Bilah atas dan bilah samping — keduanya',
        'wide' => 'Lebar — isinya memakai seluruh layar',
        'focus' => 'Terfokus — kolom sempit, bilah samping melipat',

        'nav_label' => 'Gaya bilah samping',
        'nav_helper' => 'Bagaimana bilah sampingnya sendiri digambar.',
        'nav_default' => 'Bawaan',
        'nav_floating' => 'Mengambang — kartunya sendiri',
        'nav_flat' => 'Datar — tanpa latar sama sekali',
        'nav_bordered' => 'Bergaris — sebuah garis, bukan bidang',

        'topbar_label' => 'Gaya topbar',
        'topbar_helper' => '"Disembunyikan" hanya berlaku di komputer — di ponsel, topbar membawa satu-satunya jalan kembali ke menu.',
        'topbar_default' => 'Bawaan',
        'topbar_floating' => 'Mengambang — baris yang terlepas',
        'topbar_flush' => 'Rata — datar, tanpa buram',
        'topbar_hidden' => 'Disembunyikan di komputer',

        'card_label' => 'Gaya kartu',
        'card_helper' => 'Bagian, widget, kartu server, dan blok di atas konsol.',
        'card_default' => 'Bawaan — terangkat dengan tepi lembut',
        'card_flat' => 'Datar — tanpa angkatan',
        'card_outline' => 'Garis luar — sebuah tepi dan tidak ada apa pun di belakangnya',
        'card_glass' => 'Buram — latarnya menembus',
        'card_sharp' => 'Tajam — sudut lurus',
    ],

    'servers' => [
        /*
         * Bintang di sebuah kartu. Diserahkan ke skripnya alih-alih ditulis ke
         * dalamnya, supaya teks tetap menjadi satu-satunya tempat teks tinggal.
         */
        'favourite' => 'Bintangi server ini',
        'favourited' => 'Berbintang — tampil lebih dulu',

        /*
         * Pil di sebelah tab milik Pelican sendiri. Dinamai menurut apa yang ia
         * lakukan pada daftarnya, bukan sebagai tab keempat, karena ia menyaring
         * tab yang sedang dipilih alih-alih menggantikannya.
         */
        'favourites_tab' => 'Favorit',
        'favourites_empty' => 'Tidak ada yang dibintangi di halaman ini. Pakai bintang di sebuah kartu server untuk menambahkan satu — dan perhatikan bahwa ini menyaring server yang memang sudah ada di sini: server berbintang di halaman berikutnya tidak disembunyikan, ia hanya tidak ada di halaman ini.',
        'favourites_failed' => 'Server berbintangmu tidak dapat disimpan, jadi mereka dikembalikan ke keadaan terakhir yang dipunyai panel. Konsol peramban menyebutkan apa jawaban permintaannya.',

        'art' => 'Gambar game',
        'art_helper' => 'Pelican menggambar gambar egg-nya di setiap kartu. Ini menentukan apa yang dilakukan padanya.',
        'art_faded' => 'Pudar — sebuah cahaya di balik teksnya',
        'art_cover' => 'Menutupi — di balik namanya, memudar',
        'art_off' => 'Mati',
        'art_dim' => 'Gelapkan gambarnya',
        'art_dim_helper' => 'Gambar satu game adalah langit yang terang, dan gambar game lain adalah sebuah gua.',

        'status' => 'Penanda status',
        'status_helper' => 'Di mana warna berjalan/mulai/berhenti ditampilkan.',
        'status_bar' => 'Bilah — di sepanjang tepi kiri',
        'status_edge' => 'Tepi — melintang di bagian atas',
        'status_dot' => 'Titik — di sudut',
        'status_off' => 'Mati',

        'density' => 'Tinggi kartu',
        'density_comfortable' => 'Lega',
        'density_compact' => 'Rapat — untuk banyak server',

        'filter_label' => 'Pasang teks pada tombol saring',
        'filter_label_helper' => 'Pelican memang sudah menyaring daftar ini menurut egg dan menurut pemilik, di seluruh halaman - tetapi pintu masuknya adalah sebuah ikon tanpa teks di sebelah kolom pencarian. Ini memasang katanya di sana.',
        'filter_button' => 'Saringan',

        'columns' => 'Kartu berdampingan di layar lebar',
        'columns_helper' => 'Hanya berlaku untuk kisi, dan hanya dari 1280px ke atas. Batas atas milik Pelican sendiri adalah dua.',
    ],

    'controls' => [
        'mode' => 'Tombol konsol di setiap halaman server',
        'mode_helper' => 'Satu tombol mengambang, di setiap halaman di dalam sebuah server. Ia membuka konsol di atas apa yang sedang kamu kerjakan, dengan status dan tombol daya di kepalanya — ia menjangkau node secara langsung, seperti yang dilakukan daftar server, bukan lewat websocket halaman konsol. Ia tidak pernah muncul di halaman konsol, yang sudah punya semuanya.',
        'mode_full' => 'Konsol dan tombol daya',
        'mode_console' => 'Hanya konsol',
        'mode_off' => 'Mati',

        'label' => 'Tombolnya menampilkan',
        'label_text' => 'Ikon dan nama',
        'label_icon' => 'Hanya ikon',

        'position' => 'Di mana ia mengambang',
        'position_helper' => 'Ke arah tepi yang paling kecil kemungkinannya kamu baca.',
        'position_top' => 'Atas',
        'position_right' => 'Kanan',
        'position_bottom' => 'Bawah',
    ],

    'console' => [
        'stats' => 'Blok di atas konsol',
        'stats_helper' => 'Pelican menampilkan nama, status, alamat, dan tiga angka pemakaian di atas terminal. Menyembunyikannya mengembalikan tinggi untuk konsolnya.',
        'stats_tiles' => 'Ubin — label, angka, dan sebuah ikon',
        'stats_plain' => 'Polos — seperti yang digambar Pelican',
        'stats_off' => 'Disembunyikan',
    ],

    'terminal' => [
        'helper' => 'Diteruskan ke terminalnya sendiri, jadi mereka berlaku pada pemuatan halaman berikutnya, bukan pada saat mereka disimpan.',

        'renderer' => 'Digambar oleh',
        'renderer_helper' => 'Pelican menggambar terminal di GPU, dan itu jauh lebih cepat menghadapi dinding keluaran yang berguling. Sebuah peramban hanya menjaga sejumlah konteks GPU tetap hidup pada satu waktu — lebih sedikit di ponsel — dan membuang yang tertua ketika batasnya terlewati; terminalnya lalu tidak menggambar apa pun sama sekali, tanpa sebuah kesalahan. Kalau konsolmu menjadi kosong sementara semua di sekelilingnya terlihat benar, inilah pengaturan yang diubah.',
        'renderer_webgl' => 'GPU — pilihan Pelican sendiri, lebih cepat',
        'renderer_dom' => 'Peramban — lebih lambat, selalu menggambar',

        'scheme' => 'Skema warna',
        'scheme_helper' => 'Satu-satunya pengaturan terminal yang tidak ditawarkan Pelican. "Ikuti tema" menurunkan warnanya dari warna aksen, dan itulah sebabnya ini ada sama sekali.',
        'scheme_theme' => 'Ikuti tema',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Kursor',
        'cursor_helper' => 'Konsol tidak menerima ketikan — kolom perintahnya ada di bawahnya — jadi ini adalah tempat keluarannya berhenti, bukan tempat kamu berada.',
        'cursor_underline' => 'Garis bawah — milik Pelican sendiri',
        'cursor_block' => 'Blok',
        'cursor_bar' => 'Garis',

        'blink' => 'Kursor berkedip',

        'scrollback' => 'Riwayat gulir',
        'scrollback_helper' => 'Seberapa jauh ke belakang konsol bisa digulir. Setiap baris disimpan di peramban, jadi server yang cerewet dengan setelan tinggi berarti memori sungguhan di mesin yang ikut membaca.',
        'scrollback_lines' => ':lines baris',
    ],

    'notice' => [
        'text' => 'Pesan',
        'text_helper' => 'Satu baris, sampai 200 karakter. Ia di-escape saat masuk dan saat keluar, jadi ia tidak bisa membawa markup ke halaman yang dimuat orang lain.',
        'style' => 'Nada',
        'style_info' => 'Info',
        'style_warning' => 'Peringatan',
        'style_danger' => 'Mendesak',
        'style_accent' => 'Warna aksen',
        'scope' => 'Ditampilkan kepada',
        'scope_all' => 'Semua orang',
        'scope_client' => 'Hanya di luar area administrasi',
        'scope_admin' => 'Hanya di area administrasi',
        'link_label' => 'Teks tombol',
        'link_url' => 'Alamat tombol',
        'link_url_helper' => 'https:// atau sebuah jalur di dalam panel ini, misalnya /account. Selain itu diabaikan — sebuah tautan di dalam pita yang tampil di setiap halaman bukan tempat untuk skema yang tak seorang pun mengharapkannya.',
        'dismissible' => 'Bisa ditutup',
        'dismissible_helper' => 'Penutupannya diingat per peramban, dan hanya untuk pesan ini: ubah teksnya dan ia kembali untuk semua orang.',
        'dismiss' => 'Tutup',
    ],

    'preset' => [
        'label' => 'Gaya',
        'helper' => 'Pilih sebuah tampilan sebagai titik awal. Ia mengisi semua di bawah, yang lalu bisa kamu ubah. "Tidak ada" mematikan temanya dan membiarkan panel persis seperti yang dikirim Pelican.',
        'options' => [
            'none' => 'Tidak ada - tanpa tema',
            'legend' => 'Legend - api merah beralih ke kilat biru',
            'ember' => 'Ember - hitam hangat, aksen jingga',
            'midnight' => 'Midnight - biru dalam, tenang',
            'crimson' => 'Crimson - merah, sudut tajam, rapat',
            'forest' => 'Forest - hijau, membulat, tanpa cahaya',
            'nebula' => 'Nebula - ungu dengan latar bergradasi',
            'terminal' => 'Terminal - hijau di atas hitam, lebar tetap, tajam',
            'console' => 'Console - membulat dan lega, untuk tablet',
            'nord' => 'Nord - palet Nord, teredam',
            'solarized' => 'Solarized - Solarized dark, aksen sian',
            'paper' => 'Paper - terang, kontras tinggi, datar',
            'daylight' => 'Daylight - terang dan hangat, dengan cahaya lembut',
            'mono' => 'Mono - nuansa abu-abu, datar dan padat',
        ],

        'save' => 'Simpan sebagai gaya',
        'save_confirm' => 'Menyimpan warna, sudut, latar, fon, ikon, dan ambang pengukur yang ada di layarmu saat ini — dengan nama yang kamu pilih sendiri, di pemilih di sebelah yang bawaan. Ia menyimpan apa yang ada di halaman, bukan apa yang terakhir disimpan.',
        'save_name' => 'Nama',
        'save_name_helper' => 'Namanya di pemilih nanti. Menyimpan dengan nama yang pernah kamu pakai akan menggantikannya.',
        'saved' => 'Gaya tersimpan',
        'save_failed' => 'Gaya itu tidak dapat disimpan',
        'save_full' => 'Ada tempat untuk :max gaya milikmu. Hapus satu dulu.',

        'delete' => 'Hapus sebuah gaya',
        'delete_which' => 'Yang mana',
        'delete_confirm' => 'Hanya gayamu sendiri yang bisa dihapus; yang bawaan tidak. Tidak ada yang berubah pada bagaimana panel terlihat sekarang — sebuah gaya adalah titik awal, dan setiap nilai yang disetelnya sudah ada di pengaturan di bawah.',
        'deleted' => 'Gaya terhapus',
        'deleted_current' => 'Itu adalah gaya yang sedang disetel di panel ini. Pengaturannya tidak berubah dan masih ada di halaman ini — pilih sebuah gaya, atau simpan lagi dengan sebuah nama.',
    ],

    'user_themes' => [
        'label' => 'Gaya yang boleh dipilih orang sendiri',
        'helper' => 'Gaya yang dicentang muncul di sebuah halaman Tampilan di area klien, tempat siapa pun yang masuk bisa memilih satu untuk dirinya sendiri. Ini mengubah apa yang mereka lihat sendiri, dan tidak mengubah apa pun bagi orang lain. Tanpa centang berarti tidak ada yang memilih apa pun, dan panel tetap pada satu tampilan — dan itulah yang dilakukannya sekarang.',
    ],

    'mode' => [
        'label' => 'Mode panel',
        'helper' => 'Panel terbuka dalam mode apa. Orang yang belum memilih sendiri mendapat yang ini; pemilih di menu pengguna tetap membiarkan mereka mengubahnya, kecuali kamu menguncinya di bawah.',
        'dark' => 'Gelap',
        'light' => 'Terang',
        'system' => 'Sistem — ikuti pengaturan pengunjung sendiri',
    ],

    'font' => [
        'label' => 'Fon panel',
        'helper' => 'Setiap pilihan adalah keluarga yang memang sudah dimiliki sistem operasinya — tidak ada yang diambil dari penyedia fon. Terminal tidak terpengaruh: fonnya adalah pilihan masing-masing orang, di Akun.',
        'default' => 'Bawaan - milik Pelican sendiri',
        'mono' => 'Lebar tetap',
        'rounded' => 'Membulat',
        'serif' => 'Serif',
        'system' => 'Sistem - yang dipakai mesin ini',
    ],

    'surface' => [
        'label' => 'Warna permukaan',
        'helper' => 'Kartu dan panel. Nuansa yang lebih terang dan lebih gelap diturunkan darinya.',
        'placeholder' => 'Ikuti tema',
    ],

    'radius' => [
        'label' => 'Sudut',
    ],

    'accent' => [
        'label' => 'Warna aksen',
        'helper' => 'Dipakai untuk tombol, tautan, butir navigasi yang aktif, dan cincin fokus.',

        /*
         * Dikatakan, bukan dipaksakan. Warna yang diperingatkan ini tetap
         * disimpan: ini panel milik seseorang, angkanya mengukur satu hal, dan
         * ada alasan bagus untuk menginginkan aksen yang nilainya buruk.
         * Pemilihnya menyebut apa yang dilihatnya, lalu menyingkir.
         */
        'contrast_dark' => 'Keterbacaan: :ratio pada panel gelap. Di bawah 3, sebuah aksen sulit dibaca sebagai tombol atau tautan — yang lebih terang mengangkatnya.',
        'contrast_light' => 'Keterbacaan: :ratio pada panel terang. Di bawah 3, sebuah aksen sulit dibaca sebagai tombol atau tautan — yang lebih gelap mengangkatnya.',
    ],
    'density' => [
        'label' => 'Kerapatan',
        'helper' => 'Rapat memperkecil jaraknya supaya lebih banyak baris muat di layar.',
        'comfortable' => 'Lega',
        'compact' => 'Rapat',
    ],
    'force_dark' => [
        'label' => 'Paksa mode gelap',
        'helper' => 'Menyembunyikan pemilih antara terang dan gelap dan menahan setiap pengguna di tema gelap.',
    ],
    'glass' => [
        'label' => 'Topbar buram',
        'helper' => 'Memburamkan topbar dan latar di balik dialog. Matikan di perangkat yang lebih lemah.',
    ],
    'glow' => [
        'label' => 'Cahaya aksen',
        'helper' => 'Bayangan aksen yang lembut pada tombol terpenting, pada navigasi yang aktif, dan pada kartu masuk.',
    ],

    'background' => [
        'label' => 'Jenis latar belakang',
        'helper' => 'Aurora adalah latar milik tema ini sendiri: cahaya aksen dengan butiran halus.',
        'aurora' => 'Aurora (bawaan)',
        'solid' => 'Satu warna',
        'gradient' => 'Gradasi',
        'image' => 'Gambar',
        'color' => 'Warna',
        'base' => 'Warna di balik cahayanya',
        'base_helper' => 'Alas tempat halaman ini bersandar sebelum cahaya aksennya disapukan di atasnya. Biarkan kosong untuk menjaga bawaan panel, yang hampir hitam di mode gelap dan hampir putih di mode terang. Kalau kamu menyetelnya, sebuah skema tetap punya warna malamnya sendiri dan tetap disinari.',
        'color_end' => 'Warna kedua',
        'angle' => 'Arah',
        'upload' => 'Unggah sebuah gambar',
        'upload_helper' => 'Sampai 8 MB. Gambar yang diunggah menang atas alamat di bawah.',
        'url' => 'Atau sebuah URL',
        'url_helper' => 'Harus dimulai dengan https:// dan terjangkau dari luar.',
        'dim' => 'Redupkan',
        'dim_helper' => 'Tanpa peredupan, teks putih di atas gambar terang tidak terbaca.',
        'blur' => 'Buram',
    ],

    'channel' => [
        'installed' => 'terpasang',
        'version' => 'Pasang versi tertentu',
        'version_helper' => 'Rilis mana pun di saluran ini, bukan hanya yang terbaru — untuk mundur ketika sesuatu yang baru ternyata lebih buruk, atau maju ke sebuah build yang diminta seseorang untuk kamu coba. Hanya selagi pembaruan tidak memasang dirinya sendiri: dengan itu menyala, pilihanmu hanya akan bertahan sampai pemeriksaan berikutnya.',
        'version_placeholder' => 'Pilih sebuah versi',
        'version_install' => 'Pasang versi ini',
        'version_confirm' => 'Panel mengunduh rilis itu, menyusun ulang asset-nya, dan mengosongkan cache-nya. Pengaturanmu tetap. Kembali ke versi yang lebih lama diperbolehkan, dan tidak ada yang dibatalkan untukmu — pilih lagi yang lebih baru untuk maju.',
        'label' => 'Saluran pembaruan',
        'helper' => 'Rilis mana yang ditawarkan halaman Tema. Beta mendapat versi baru lebih dulu, dan mendapat sisi tajamnya lebih dulu juga.',
        'stable' => 'Stabil',
        'beta' => 'Beta',
        'dev' => 'Dev (cabang kerja)',
        'auto' => [
            'label' => 'Pasang pembaruan secara otomatis',
            'helper' => 'Mati membiarkan pembaruan menjadi urusanmu. Nyala membuat panel memeriksa saluran yang dipilih dan memasang apa pun yang lebih baru - ia menyusun ulang asset-nya sementara itu dan tidak dapat diakses selama satu dua menit, jadi yang harian dan mingguan berjalan pukul 04.00. Ini menuntut cron panel berjalan.',
            'interval' => 'Periksa setiap',
            'minute' => 'Setiap menit',
            'five_minutes' => 'Setiap 5 menit',
            'ten_minutes' => 'Setiap 10 menit',
            'thirty_minutes' => 'Setiap 30 menit',
            'hourly' => 'Setiap jam',
            'daily' => 'Setiap hari (04.00)',
            'weekly' => 'Setiap pekan (Senin 04.00)',
        ],
    ],

    /*
     * Tab Bahasa.
     *
     * Hati-hati dengan apa yang diklaimnya. Pelican sudah membiarkan setiap orang
     * memilih bahasa untuk seluruh akunnya dan sudah memakainya; tidak ada di
     * sini yang mengubah itu, dan memang tidak seharusnya. Ini hanya memutuskan
     * apakah teks milik plugin ini sendiri mengikuti pilihan itu.
     */
    'languages' => [
        'section_helper' => 'Pelican sudah membiarkan setiap orang memilih bahasa untuk akunnya, dan plugin ini mengikutinya di tempat ia sudah diterjemahkan. Di sini kamu memutuskan yang mana saja yang diikutinya. Kebanyakan bahasa berada pada persentase yang rendah dengan sengaja: yang diterjemahkan lebih dulu adalah bagian yang dilihat semua orang di setiap halaman — tombol daya di atas sebuah konsol dan pengukur node — dan sisanya datang seiring orang membawanya.',
        'panel' => 'Biarkan ini menentukan bahasa seluruh panel',
        'panel_helper' => 'Nyala: sebuah bahasa yang tidak dibawa plugin ini — atau yang dimatikan di bawah — membuat seluruh panel berbahasa Inggris bagi pembaca itu, bukan hanya halaman-halaman ini. Mati: hanya plugin ini yang mengikuti daftarnya, dan Pelican terus berbicara dalam bahasa yang disetel di akun, yang berarti seorang pembaca bisa menemui dua bahasa dalam satu layar. Tidak ada akun yang diubah ke arah mana pun: nyalakan lagi sebuah bahasa dan mereka mendapatkannya kembali.',
        'label' => 'Bahasa untuk menjawab',
        'helper' => 'Melepas centangnya mengembalikan pembaca yang menyetelnya di akun mereka ke bahasa Inggris hanya untuk plugin ini — sisa panelnya tetap berbicara dalam bahasa mereka. Bahasa Inggris tidak ada di daftar, karena semuanya jatuh kembali ke sana.',
        'under' => 'belum ditawarkan sampai ia lebih maju — centang untuk tetap menawarkannya',
        'done' => ':percent% diterjemahkan',
        'main' => 'Bahasa utama',
        'main_helper' => 'Apa yang didapat seorang pembaca ketika bahasanya sendiri tidak dapat dipakai — entah plugin ini tidak membawanya, atau ia tidak dicentang di bawah. Dulu selalu bahasa Inggris; di sebuah tim yang tidak bekerja dalam bahasa Inggris, itu jawaban keliru yang diberikan dengan yakin. Centangnya tidak dapat dilepas di bawah, karena semuanya jatuh kembali ke sana.',
        'labels' => 'Nama setiap bahasa',
        'labels_helper' => 'Nama yang dilihat pembaca dan administrator di pemilihnya. Biarkan satu kosong untuk mempertahankan nama yang dikenali plugin ini. Sebuah bahasa yang diunggah dengan nama karanganmu sendiri tidak punya nama seperti itu, jadi ia akan tampil dengan kodenya sampai kamu memberinya satu di sini.',
        'labels_code' => 'Kode',
        'labels_name' => 'Ditampilkan sebagai',
        'download' => 'Unduh sebuah berkas terjemahan',
        'download_from' => 'Mulai dari',
        'download_from_helper' => 'Sebuah JSON berisi setiap teks di plugin ini. Pilih bahasa Inggris untuk bahasa yang belum dimulai siapa pun, atau bahasa yang sudah ada untuk membangun di atas yang sudah diterjemahkan.',
        'code' => 'Kode bahasa',
        'code_helper' => 'Kode yang berkas ini tujukan. Sebuah locale sungguhan, sebagaimana dipakai akun — fr, de, pt_BR — menjangkau pembaca yang menyetelnya, dan harus cocok persis, kalau tidak ia tidak menjangkau. Nama karanganmu sendiri, seperti Gaming-ID, diperbolehkan dan bekerja berbeda: Pelican hanya membiarkan sebuah akun punya locale sungguhan, jadi milikmu tidak bisa dipilih siapa pun. Ia bisa dijangkau sebagai bahasa utama di atas, dan itulah yang didapat semua orang yang bahasanya sendiri tidak dapat dipakai.',
        'url' => 'Atau ambil dari sebuah alamat',
        'url_helper' => 'Sebuah alamat https yang bisa dijangkau panel — sebuah CDN, sebuah bucket, sebuah berkas mentah di sebuah repositori. Ia diambil sekali ketika kamu menyimpan dan ditulis dengan cara yang sama seperti yang diunggah, jadi mengubah berkas di alamat itu kemudian tidak melakukan apa pun sampai kamu menyimpan lagi. Berkas yang dipilih di atas menang atas alamat yang tertinggal di kolom ini.',
        'upload' => 'Unggah sebuah berkas terjemahan',
        'upload_helper' => 'Berkas JSON dari atas, dengan nilainya sudah diterjemahkan. Ia ditulis di luar plugin ini, jadi sebuah pembaruan tidak membuangnya, dan ia ditumpangkan di atas bahasa Inggris kunci demi kunci — sebuah berkas berisi separuh teksnya memberimu separuh bahasa dan bahasa Inggris untuk sisanya.',
        'uploaded' => ':count teks dipasang untuk :code',
        'uploaded_halves' => 'Dari jumlah itu, :mine adalah teks milik plugin ini sendiri, dan :panel adalah milik panel. Nol pada salah satu sisi berarti separuh berkas itu tidak berisi apa pun — kunci plugin dimulai dengan essentials:: dan kunci panel tidak.',
        'uploaded_skipped' => ':count dilewati: kosong, atau kunci yang tidak dimiliki plugin ini. Yang pertama: :keys',
        'upload_failed' => 'Berkas itu tidak dapat dibaca',
        'upload_failed_body' => 'Harus berupa berkas JSON dari unduhan di atas — sebuah objek datar berisi kunci dan teks. Periksa apakah sebuah penyunting tidak menyimpannya sebagai hal lain.',
    ],

    'windows' => [
        'add' => 'Tambahkan sebuah rentang',
        'from' => 'Dari',
        'to' => 'Sampai',
        'to_helper' => 'Lebih awal daripada awalnya berarti ia melewati tengah malam — 22.00 sampai 06.00 adalah malam.',
        'preset' => 'Gaya',
        'days' => 'Hari',
        'days_helper' => 'Biarkan semuanya tanpa centang untuk setiap hari. Sebuah rentang yang melewati tengah malam menjadi milik hari saat ia dimulai, jadi Jumat 22.00 sampai 06.00 mencakup Sabtu pagi.',
        'day_mon' => 'Senin',
        'day_tue' => 'Selasa',
        'day_wed' => 'Rabu',
        'day_thu' => 'Kamis',
        'day_fri' => 'Jumat',
        'day_sat' => 'Sabtu',
        'day_sun' => 'Minggu',
    ],

    'arranger' => [
        'label' => 'Penata halaman',
        'helper' => 'Tombol "Tata halaman", di setiap halaman panel. Semua orang yang memegang izin Tata mendapatkannya dan juga bisa menyetel tata letak yang menjadi titik awal semua orang lain, atau satu untuk sebuah peran. Mati menyembunyikannya dari semua orang; tata letak yang sudah tersimpan tetap di tempatnya.',
        'roles' => 'Sebuah tata letak bukan sebuah izin. Blok yang disembunyikan sebuah peran tetap sebuah blok yang bisa dijangkau seseorang dengan mengetik alamatnya — yang menghentikannya adalah izin milik Pelican sendiri, di halaman peran. Tiga lapis ditumpuk dengan urutan ini: yang menjadi titik awal semua orang, lalu peran pembacanya, lalu apa yang ia pindahkan sendiri.',
        'users' => 'Biarkan semua orang menata halamannya sendiri',
        'users_helper' => 'Nyala membiarkan siapa pun yang masuk memindahkan dan menyembunyikan blok di halaman yang memang sudah bisa mereka lihat, hanya untuk dirinya sendiri — itu tidak mengubah apa pun bagi orang lain. Menyetel tata letak yang menjadi titik awal semua orang tetap berada pada izin Tata.',
    ],

    'brand' => [
        'logo_height' => 'Tinggi logo',
        'logo_height_helper' => 'Pelican mengirim 2rem. Nilai yang lebih besar membuat kepala bilah samping ikut lebih tinggi.',
        'logo_url' => 'Ganti logonya',
        'logo_url_helper' => 'Biarkan kosong untuk mempertahankan apa yang ditunjuk pengaturan Pelican sendiri.',
    ],

    'login' => [
        'image' => 'Gambar latar',
        'image_helper' => 'Hanya untuk layar masuk. Tanpa itu ia tetap menampilkan latar panel.',
        'url' => 'Atau sebuah URL',
        'blur' => 'Buram pada kartunya',
        'blur_helper' => 'Membuat kartunya buram sehingga gambar di belakangnya menembus.',
        'width' => 'Lebar kartu',
        'position' => 'Pembingkaian gambar',
        'position_helper' => 'Bagian gambar mana yang selamat dari pemangkasan ke layar.',
        'position_center' => 'Tengah',
        'position_top' => 'Atas',
        'position_bottom' => 'Bawah',
        'position_left' => 'Kiri',
        'position_right' => 'Kanan',
        'align' => 'Letak kartu',
        'align_helper' => 'Di mana kartu masuk berada melintang di layar.',
        'align_center' => 'Tengah',
        'align_start' => 'Kiri',
        'align_end' => 'Kanan',
        'opacity' => 'Kepekatan kartu',
        'opacity_helper' => 'Yang lebih rendah membiarkan lebih banyak gambar menembus kartunya.',
        'glow' => 'Cahaya aksen',
        'glow_helper' => 'Lingkaran cahaya di sekeliling kartunya. Mati tetap menjaga tepi dan kedalamannya.',
        'hide_heading' => 'Sembunyikan judulnya',
        'hide_heading_helper' => 'Menghapus judul di atas formulirnya dan membiarkan formulirnya sendirian.',
        'hide_footer' => 'Sembunyikan baris bawahnya',
        'hide_footer_helper' => 'Menghapus baris di bawah kartunya yang menaut ke pelican.dev.',
        'above' => 'Baris di atas formulirnya',
        'above_helper' => 'Satu baris, ditampilkan kepada siapa pun yang sampai ke layar masuk. Biarkan kosong untuk tidak ada.',
        'notice' => 'Pesan di bawah kartunya',
        'notice_helper' => 'Satu baris, ditampilkan kepada siapa pun yang sampai ke layar masuk. Biarkan kosong untuk tidak ada.',
    ],

    'advanced' => [
        'css' => 'CSS milikmu',
        'css_helper' => 'Sampai 100 KB. Disimpan di storage, bukan di .env.',
        'reference' => 'Rujukan CSS',
        'reference_helper' => 'Setiap variabel dan kelas yang disediakan tema ini dan panelnya.',
    ],

    'areas' => [
        'add' => 'Tambahkan sebuah area',
        'area' => 'Area',
        'inherit' => 'Bersama',
        'radius' => 'Sudut',
        'radius_sharp' => 'Tajam',
        'radius_normal' => 'Biasa',
        'radius_round' => 'Membulat',
        'surface' => 'Warna permukaan',
        'surface_helper' => 'Kartu dan panel di dalam area ini; nuansa yang lebih terang dan lebih gelap diturunkan darinya.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Konsol (sisa halamannya)',
            'files' => 'Halaman berkas',
            'edit' => 'Halaman penyuntingan',
            'server' => 'Halaman dan tab server lainnya',
        ],
    ],

    'bars' => [
        'base' => 'Warna dasar',
        'base_green' => 'Hijau',
        'base_accent' => 'Warna aksen',
        'warning' => 'Kuning sejak',
        'danger' => 'Merah sejak',
    ],

    'icons' => [
        'stroke' => 'Ketebalan garis',
        'stroke_thin' => 'Tipis',
        'stroke_normal' => 'Biasa',
        'stroke_bold' => 'Tebal',
        'scale' => 'Ukuran',
        'accent' => 'Ikon menu berwarna aksen',
        'accent_helper' => 'Berlaku untuk ikon di bilah samping dan di topbar.',
        'pack' => 'Paket ikon',
        'pack_helper' => 'Dari kumpulan mana pemilih di bawah mengambil. Setiap kumpulan ikon yang terpasang di server ditawarkan, ditambah kumpulan Essentials yang datang bersama plugin ini dan setiap paket yang kamu unggah. Satu perbedaan layak diketahui: sebuah ikon garis digambar dalam warna menunya dan mengikuti sorotan serta baris yang aktif, sedangkan ikon Essentials adalah gambar dan justru mempertahankan warnanya sendiri. Itu ditentukan oleh berkasnya apa, bukan oleh dari kumpulan mana ia berasal.',
        'pack_custom' => 'Paket yang diunggah',
        'pack_shipped' => 'Ikon Essentials',
        'use_shipped' => 'Pakai ikon Essentials di mana-mana',
        'use_shipped_confirm' => 'Menyetel paketnya ke ikon Essentials dan mengisi setiap baris menu di bawah dengan ikon yang digambar untuknya — konsol mendapat terminalnya, start mendapat tombol start, dan seterusnya. Itu menggantikan baris yang kamu punya sekarang, dan tidak ada yang tersimpan sampai kamu menekan Simpan, jadi menutup halaman ini membatalkannya.',
        'pack_upload' => 'Unggah sebuah paket',
        'pack_upload_helper' => 'Sebuah .zip berisi berkas SVG. Setiap berkas menjadi sebuah ikon yang dinamai menurutnya — logo.svg menjadi custom-logo. Mengunggah menggantikan paket yang ada di sana sekarang. Berkas di atas 256 KB dan apa pun di atas 4.000 ikon ditinggalkan, dan kamu diberi tahu berapa banyak: sebagai ukuran, seluruh kumpulan Tabler hampir enam ribu ikon dalam sekitar tiga megabyte, jadi paket yang jauh lebih besar membawa sesuatu selain ikon, dan sebagian besarnya akan dilewati. Unggahan besar juga bisa ditolak sebelum kolom ini mengatakan apa pun, oleh upload_max_filesize dan post_max_size di php.ini pada mesin panel — tidak ada pengaturan di sini yang bisa menaikkannya.',
        'pack_partial' => ':count ikon terpasang, tetapi tidak semuanya',
        'pack_partial_body' => 'Dilewati: :big terlalu besar untuk sebuah ikon, :unusable tidak dapat dipakai sebagai SVG, :duplicate dengan nama yang sudah terpakai, :empty tidak menyisakan apa pun untuk digambar setelah dibersihkan. Sebuah SVG di atas 256 KB hampir selalu sebuah gambar yang dibungkus di dalamnya, bukan sebuah gambar vektor — ekspor dalam ukuran ikon dan ia akan menjadi beberapa kilobyte. Sebuah ikon yang tidak menyisakan apa pun untuk digambar hanya berisi hal-hal yang tidak disajikan ini — kalau itu satu paket penuh, layak dilaporkan.',
        'pack_stopped_files' => 'Ia juga berhenti pada batas berapa banyak ikon yang boleh dimuat sebuah paket.',
        'pack_stopped_size' => 'Ia juga berhenti karena sisa paketnya terurai menjadi lebih besar daripada yang bisa dipegang panel di memori sekaligus — zip-nya bisa lebih kecil dari itu, karena SVG memampat sekitar lima banding satu.',
        'overrides' => 'Ganti ikon',
        'overrides_helper' => 'Satu baris per ikon yang ingin kamu ubah. Pilih butir menunya, lalu pilih sebuah ikon dari paket di atas, berikan sebuah alamat, atau unggah gambarmu sendiri. Kalau lebih dari satu diisi, unggahan menang, lalu alamat, lalu paket.',
        'overrides_key' => 'Butir menu',
        'overrides_value' => 'Ikon dari paket',
        'overrides_url' => 'Atau sebuah alamat',
        'overrides_url_helper' => 'Sebuah alamat https ke gambar yang kamu inangi sendiri — sebuah CDN, sebuah bucket, di mana pun peramban bisa menjangkau. Tidak ada yang disalin ke panel, jadi mengganti berkas di alamat itu mengubah ikonnya tanpa menyentuh halaman ini; sisi buruknya adalah ikon yang lenyap ketika alamatnya lenyap. Ia mempertahankan warnanya sendiri, seperti gambar yang diunggah.',
        'overrides_file' => 'Atau unggah sebuah gambar',
        /*
         * Menyebut apa bedanya yang sebenarnya, karena itu tidak jelas dengan
         * sendirinya dan itulah alasan orang memilih yang satu alih-alih yang
         * lain.
         */
        'overrides_file_helper' => 'PNG, SVG, atau ICO. Sebuah ikon dari paket digambar dalam warna menunya sendiri dan mengikuti sorotan serta baris yang aktif; sebuah gambar yang diunggah mempertahankan warnanya sendiri dan tidak melakukan itu. Untuk sebuah logo, biasanya itulah yang diinginkan.',
        'overrides_add' => 'Ganti satu ikon lagi',
        'overrides_search' => 'Ketik sebuah nama, atau butir menunya…',
    ],

    /*
     * Bukan di bawah merek. Merek adalah tentang bagaimana panel terlihat; ini
     * tentang bagaimana plugin ini menampakkan diri di dalamnya, dan itu
     * pertanyaan lain yang dijawab di halaman lain.
     */
    'identity' => [
        'nav_icon' => 'Ikon untuk baris "Pengaturan Essentials"',
        'nav_icon_helper' => 'PNG, SVG, atau ICO, sampai 8 MB. Menggantikan ikon pada satu baris itu saja di bilah samping; biarkan kosong untuk ikon yang datang bersama plugin ini. Ia digambar sebagai gambar alih-alih sebagai ikon, jadi ia mempertahankan warnanya sendiri alih-alih mengikuti teksnya — dan itu biasanya yang diinginkan sebuah logo. Berkasnya disajikan alih-alih disematkan, jadi setiap peramban mengambilnya sekali, tetapi tetap layak mengekspor sesuatu yang kecil: beberapa kilobyte lebih dari cukup untuk baris setinggi dua puluh piksel. Kalau sebuah unggahan gagal sebelum kolom ini mengatakan apa pun, batas yang ditabraknya adalah upload_max_filesize di php.ini panel.',
    ],
];
