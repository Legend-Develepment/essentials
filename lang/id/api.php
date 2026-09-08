<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Sebuah jalan masuk dari luar.
 *
 * Dua jenis pembaca dalam satu berkas, dan masing-masing menginginkan hal yang
 * berbeda. Seorang administrator yang membaca halaman ini sedang memutuskan
 * apakah ia berani memercayakan sebuah kunci kepada seseorang, jadi setiap baris
 * di sini menyebut sejauh mana sebuah kunci menjangkau, bukan namanya apa. Orang
 * yang memintanya ingin tahu apa yang ia terima dan apa yang terjadi kalau ia
 * kehilangannya, dan karena itulah kalimat bahwa sebuah kunci hanya ditampilkan
 * sekali bukanlah catatan kaki.
 *
 * Tidak ada di sini yang berkata "token". "Kunci" adalah kata di halaman akun
 * milik Pelican sendiri, dan panel yang menyebut hal yang sama dengan dua nama
 * adalah panel tempat seseorang mencari yang keliru.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Kunci yang membiarkan sesuatu di luar panel menanyakan apa yang diketahui plugin ini. Hanya baca — tidak ada di sini yang bisa menjalankan, menghentikan, atau menjangkau sebuah server.',

    'my_title' => 'Akses API',
    'my_nav_label' => 'Akses API',
    'my_subheading' => 'Kunci milikmu sendiri, untuk sebuah bot atau skrip. Ia hanya menjawab untuk server yang sudah bisa kamu buka.',

    // ---- apa itu kunci, dikatakan sekali, di tempat yang penting -------
    'address' => 'Alamatnya',
    'address_helper' => 'Kirim kuncinya sebagai header Authorization: :example',

    /*
     * Satu hal yang harus sudah dibaca seseorang sebelum jendelanya tertutup.
     * Ditulis sebagai apa yang harus dilakukan, bukan sebagai peringatan, karena
     * "simpan baik-baik" adalah nasihat yang tidak bisa ditindaklanjuti siapa
     * pun, sedangkan "tempel di tempat bot itu membacanya, sekarang" bisa.
     */
    'once' => 'Ini satu-satunya kali kunci ini ditampilkan',
    'once_body' => 'Ia disimpan sebagai hash, jadi tidak ada seorang pun — termasuk yang mengelola panel ini — yang bisa membacanya kembali. Tempel di tempat bot atau skrip membacanya, sekarang. Kalau hilang, cabut yang ini dan minta yang baru.',
    'copy' => 'Salin',
    'copied' => 'Tersalin',

    // ---- keadaannya ------------------------------------------------------
    'state' => 'Keadaan',
    'state_pending' => 'Menunggu',
    'state_active' => 'Aktif',
    'state_refused' => 'Ditolak',
    'state_revoked' => 'Dicabut',

    'state_pending_body' => 'Seseorang harus memberi izin sebelum ia menjawab apa pun.',
    'state_refused_body' => 'Ini dijawab tidak. Tidak ada yang diterbitkan.',
    'state_revoked_body' => 'Kunci ini sudah diambil dan tidak lagi menjawab.',

    // ---- jangkauannya ----------------------------------------------------
    'scope' => 'Menjangkau',
    'scope_person' => 'Server miliknya sendiri',
    'scope_panel' => 'Seluruh panel',

    'scope_person_helper' => 'Hanya menjawab untuk server yang sudah bisa dibuka pemiliknya, ditanyakan dengan cara yang sama seperti panel bertanya. Kehilangan kunci ini tidak menghilangkan apa pun yang tidak bisa dilihat pemiliknya sendiri.',
    'scope_panel_helper' => 'Menjawab pertanyaan yang menyangkut seluruh panel — setiap node, kapasitasnya, si penjaga, mesin panel itu sendiri. Untuk sebuah bot yang melaporkan tentang panel, bukan atas nama seseorang.',

    // ---- tabel -----------------------------------------------------------
    'column_name' => 'Untuk apa',
    'column_owner' => 'Milik siapa',
    'column_prefix' => 'Kunci',
    'column_asked' => 'Diminta',
    'column_used' => 'Terakhir dipakai',
    'column_expires' => 'Kedaluwarsa',

    'never_used' => 'Belum pernah',
    'no_expiry' => 'Sampai dicabut',

    'tab_waiting' => 'Menunggu',
    'tab_active' => 'Aktif',
    'tab_all' => 'Semua',

    'empty' => 'Belum ada kunci',
    'empty_body' => 'Belum ada yang meminta, dan belum ada yang diterbitkan. Halaman ini mengisi dirinya sendiri seiring orang melakukannya.',

    'my_empty' => 'Kamu belum punya kunci',
    'my_empty_body' => 'Minta satu, dan ia akan muncul di sini bersama jawaban yang diterimanya.',

    // ---- cara memintanya -------------------------------------------------
    'ask' => 'Minta sebuah kunci',
    'ask_name' => 'Untuk apa ia dipakai',
    'ask_name_helper' => 'Beberapa kata, supaya nanti kamu bisa membedakan dua kunci milikmu sendiri, dan supaya yang memberi izin tahu ia memberi izin untuk apa.',
    'ask_reason' => 'Sesuatu yang layak ditambahkan',
    'ask_reason_helper' => 'Opsional. Dibaca oleh yang memutuskan.',
    'ask_sent' => 'Diminta',
    'ask_sent_body' => 'Ia muncul di bawah begitu ada yang menjawab.',
    'ask_granted' => 'Ini kuncimu',
    'ask_open' => 'Kamu sudah punya satu yang menunggu jawaban',
    'ask_open_body' => 'Satu permintaan pada satu waktu. Tarik kalau itu keliru.',
    'ask_failed' => 'Permintaan tidak dapat diajukan',

    'cancel' => 'Batal',
    'cancel_confirm' => 'Menarik permintaannya. Tidak ada yang diterbitkan, jadi tidak ada pula yang berhenti bekerja.',

    // ---- cara memutuskan -------------------------------------------------
    'grant' => 'Beri izin',
    'grant_confirm' => 'Menerbitkan sebuah kunci yang menjawab untuk server milik orang ini sendiri, dan menampilkannya sekali. Ia sudah bisa melihat semua yang akan dilaporkannya — ini memutuskan apakah sesuatu di luar panel boleh bertanya atas namanya.',
    'granted' => 'Diberikan',

    'refuse' => 'Tolak',
    'refuse_answer' => 'Apa yang akan mereka ketahui',
    'refuse_answer_helper' => 'Opsional, dan ditampilkan di halaman mereka sendiri. Penolakan tanpa alasan adalah penolakan yang akan diminta lagi pekan depan.',
    'refused' => 'Ditolak',
    'collect' => 'Tampilkan kunciku',
    'state_ready_body' => 'Diberikan. Tekan Tampilkan kunciku untuk melihatnya — sekali saja, karena ia disimpan sebagai hash dan tidak bisa dibaca kembali sesudahnya.',
    'replace' => 'Ganti',
    'replace_confirm' => 'Kunci ini langsung berhenti bekerja dan kunci baru menggantikannya, ditampilkan sekali. Tidak ada cara mencari yang lama — ia tidak pernah disimpan — jadi menggantinya adalah satu-satunya jawaban atas kehilangannya.',
    'granted_body' => 'Ia mengambilnya sendiri di halaman Akses API miliknya. Kunci itu tidak ditampilkan di sini: sebuah kunci milik orang yang memintanya, bukan milik yang mengiyakan.',

    'revoke' => 'Cabut',
    'revoke_confirm' => 'Kuncinya langsung berhenti menjawab, dan hash-nya hilang, jadi ia tidak bisa diambil kembali. Semua yang memakainya berhenti. Minta yang baru alih-alih membatalkan ini.',
    'revoked' => 'Dicabut',
    'forget' => 'Hapus',
    'forget_confirm' => 'Menghilangkan barisnya dari halaman ini untuk selamanya. Ia sudah berhenti menjawab, jadi tidak ada yang sedang bekerja lalu berhenti - ini hanya menghapus catatan bahwa ia pernah ada.',
    'forgotten' => 'Dihapus',

    'mint' => 'Kunci baru',
    'mint_body' => 'Untuk sebuah bot, bukan untuk seseorang. Ia mendapat izin pada saat yang sama ketika ia dibuat, karena kamulah yang akan mengiyakannya.',
    'abilities' => 'Apa yang boleh ia tanyakan',
    'abilities_helper' => 'Semuanya tercentang pada awalnya, karena begitulah sebuah kunci sebelum ini ada. Melepas centang adalah tindakan yang disengaja. Yang disimpan adalah daftar yang diizinkan, jadi kemampuan yang ditambahkan pada rilis berikutnya mati untuk kunci yang dibuat sebelumnya - kemampuan yang tidak dicentang siapa pun adalah kemampuan yang tidak diberikan siapa pun.',
    'ability_health' => 'Membuktikan kuncinya bekerja',
    'ability_health_helper' => 'Tidak menjangkau apa pun yang lain. Aman dipanggil secara berkala.',
    'ability_me' => 'Server miliknya sendiri',
    'ability_me_helper' => 'Server yang sudah bisa dibuka pemiliknya, beserta cadangannya. Ia tidak pernah bisa melihat orang lain.',
    'ability_panel' => 'Seluruh panel',
    'ability_panel_helper' => 'Setiap node, setiap cadangan, jadwal yang berhenti, si penjaga dan mesin panel itu sendiri. Perlu kunci seluruh panel juga.',
    'ability_live' => 'Bertanya langsung ke sebuah server',
    'ability_live_helper' => 'Siapa yang sedang bermain, dan apakah sebuah server berjalan. Satu-satunya pertanyaan yang ada ongkosnya — pertanyaan itu menjangkau server game atau daemon, disimpan sementara lima belas sampai dua puluh detik.',
    'ability_connect' => 'Menautkan akun Discord ke akun panel',
    'ability_connect_helper' => 'Satu-satunya kelompok yang bukan pembacaan. Ia membuat kunci API Pelican pada akun orang yang memintanya dan bisa memutus sebuah tautan. Berikan hanya kepada bot yang memerlukannya.',
    'own_rate' => 'Permintaan per menit untuk kunci ini',
    'own_rate_helper' => 'Biarkan kosong untuk mengikuti pengaturan panel. Angka di sini hanya berlaku untuk kunci ini saja. Nol berarti tanpa langit-langit sama sekali — masuk akal untuk bot di mesinmu sendiri, dan cara yang nyata untuk menyesal kalau kuncinya sampai ke tempat lain.',
    'own_rate_default' => 'Mengikuti panel',
    'mint_owner' => 'Siapa dia',
    'mint_owner_helper' => 'Sebuah kunci menjawab sebagai seseorang. Untuk kunci seluruh panel itu hanya soal siapa yang bertanggung jawab atasnya; untuk kunci pribadi itu juga soal apa yang boleh dilihat kuncinya.',
    'minted' => 'Dibuat',
    'profile_tab' => 'API Essentials',
    'profile_make' => 'Kunci untuk API Essentials',
    'profile_make_helper' => 'API yang berbeda dari yang di atas: yang ini menjawab apa yang diketahui plugin ini — server mana milikmu yang belum punya cadangan, siapa yang bermain di sana, apakah mereka berjalan. Ia selalu menjawab untukmu sendiri dan hanya menjangkau server yang sudah bisa kamu buka.',
    'profile_create' => 'Buat',
    'profile_yours' => 'Kunci Essentials milikmu',
    'profile_manage' => 'Mencabut kunci, melihat kenapa sebuah kunci ditolak, dan menghubungkan Discord semuanya ada di halaman Akses API di bilah sisi.',
    'discord' => 'Discord',
    'discord_body' => 'Tautkan akun Discord-mu ke akun ini, supaya sebuah bot bisa menjawab untuk servermu ketika kamu memintanya. Yang ia dapat adalah kunci yang menjangkau persis apa yang bisa kamu jangkau, tidak lebih.',
    'discord_connect' => 'Hubungkan Discord',
    'discord_code' => 'Ketik ini di Discord dalam sepuluh menit',
    'discord_code_body' => 'Kirim :command di kanal yang bisa dibaca bot. Kodenya berlaku sekali. Tidak ada yang bisa memakainya selain akun yang untuknya kode itu dibuat.',
    'discord_on' => 'Terhubung sebagai :name',
    'discord_since' => 'Sejak :when',
    'discord_cut' => 'Terputus',
    'discord_cut_confirm' => 'Mengakhiri tautannya dan menghapus kunci yang dibuatnya, jadi bot langsung berhenti menjawab untukmu. Kamu bisa menghubungkan lagi kapan saja.',
    'discord_off' => 'Tidak terhubung',
    'discord_key_note' => 'Menghubungkan akan membuat kunci API Pelican pada akunmu dengan nama Discord (Essentials). Kamu bisa melihatnya, dan mencabutnya, di Akun → Kunci API — halaman ini hanya jalan pintas ke hal yang sama.',
    'docs_title' => 'Cara memakai API ini',
    'docs_subheading' => 'Apa yang dijawab panel ini, di alamat tempat ia menjawabnya. Ditulis dari keterangan yang sama dengan yang membangun API-nya, jadi ia tidak mungkin tertinggal satu rilis.',
    'docs_base' => 'Di mana ia berada',
    'docs_endpoints' => 'Endpoint',
    'docs_answers' => 'Apa yang kembali',
    'docs_calls' => 'Kunci yang boleh memanggilnya',
    'docs_params' => 'Apa yang dikirim',
    'docs_required' => 'wajib',
    'docs_optional' => 'opsional',
    'docs_try' => 'Coba',
    'docs_errors' => 'Ketika ada yang salah',
    'docs_hook' => 'Apa yang dikirim panel kepadamu',
    'docs_hook_body' => 'Arah yang sebaliknya, dan satu-satunya bagian dari ini yang datang tanpa diminta. Dinyalakan di bagian Peringatan dengan sebuah alamat dan rahasia penanda tangan: satu kiriman JSON ketika si penjaga menemukan sesuatu dan satu lagi ketika keadaannya pulih, supaya sebuah bot tahu ada node yang mati alih-alih bertanya setiap menit apakah ada.',
    'docs_hook_verify' => 'Isinya di-hash dengan rahasiamu dan hash-nya dibawa di X-Essentials-Signature sebagai sha256=<hex>. Hash isi mentahnya, bukan objek yang diserialkan ulang — perbedaan sekecil apa pun pada spasi atau urutan kunci menghasilkan hash yang berbeda, dan ketidakcocokan itu terbaca seperti serangan, bukan seperti bug.',
    'docs_download_md' => 'Unduh sebagai Markdown',
    'docs_download_json' => 'Unduh sebagai OpenAPI',

    // ---- apa yang disetel seorang administrator --------------------------
    'settings' => 'Beginilah cara kerjanya',
    'approval' => 'Permintaan menunggu izin',
    'approval_helper' => 'Nyala, orang yang meminta sebuah kunci mendapatkannya ketika ada yang mengiyakan. Mati, ia mendapatkannya seketika — dan itu masuk akal di panel tempat semua orang yang punya akun memang sudah dipercaya, dan itu layak dipilih alih-alih sekadar terjadi begitu saja.',
    'rate' => 'Permintaan per menit, per kunci',
    'rate_helper' => 'Sebuah bot yang menanyai empat puluh server siapa yang sedang bermain berarti empat puluh pertanyaan ke empat puluh server game. Inilah langit-langit yang mencegah sebuah perulangan yang ditulis pukul tiga pagi berubah menjadi uji beban.',
    'days' => 'Sebuah kunci yang diberikan bertahan',
    'days_helper' => 'Dalam hari. Nol berarti sampai dicabut, dan itulah bawaannya — kunci yang kedaluwarsa saat tidak ada yang memperhatikan adalah bot yang berhenti di malam hari tanpa ada yang menyebut sebabnya.',
    'days_never' => 'Sampai dicabut',
    'hide_pelican' => 'Hapus tab kunci API milik panel',
    'hide_pelican_helper' => 'Menghilangkan tab kunci API dari profil akun sepenuhnya, sehingga hanya ada satu hal bernama kunci API di halaman itu. Ia dihapus dari halamannya, bukan ditutupi, jadi tidak ada alamat tersisa yang menjangkaunya. Satu hal yang tidak bisa dilakukannya: API klien milik panel tetap akan membuat kunci akun untuk apa pun yang memintanya secara langsung — tab itu tempat orang membuatnya dengan tangan, dan ini mengambil tangannya. Kunci yang sudah ada tetap bekerja.',

    /*
     * Dikatakan di halaman ini alih-alih dibiarkan untuk ditemukan. Pelican
     * membatalkan migrasi sebuah plugin ketika plugin itu dicopot, dan satu-
     * satunya tabel plugin ini ikut hilang.
     */
    'uninstall_note' => 'Mencopot plugin ini akan menghapus setiap kunci bersamanya. Itu disengaja — sebuah kunci yang hidup lebih lama daripada yang menjawabnya adalah sebuah masuk yang tidak bisa dicabut siapa pun.',
];
