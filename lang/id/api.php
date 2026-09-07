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

    'revoke' => 'Cabut',
    'revoke_confirm' => 'Kuncinya langsung berhenti menjawab, dan hash-nya hilang, jadi ia tidak bisa diambil kembali. Semua yang memakainya berhenti. Minta yang baru alih-alih membatalkan ini.',
    'revoked' => 'Dicabut',

    'mint' => 'Kunci baru',
    'mint_body' => 'Untuk sebuah bot, bukan untuk seseorang. Ia mendapat izin pada saat yang sama ketika ia dibuat, karena kamulah yang akan mengiyakannya.',
    'mint_owner' => 'Siapa dia',
    'mint_owner_helper' => 'Sebuah kunci menjawab sebagai seseorang. Untuk kunci seluruh panel itu hanya soal siapa yang bertanggung jawab atasnya; untuk kunci pribadi itu juga soal apa yang boleh dilihat kuncinya.',
    'minted' => 'Dibuat',

    // ---- apa yang disetel seorang administrator --------------------------
    'settings' => 'Beginilah cara kerjanya',
    'approval' => 'Permintaan menunggu izin',
    'approval_helper' => 'Nyala, orang yang meminta sebuah kunci mendapatkannya ketika ada yang mengiyakan. Mati, ia mendapatkannya seketika — dan itu masuk akal di panel tempat semua orang yang punya akun memang sudah dipercaya, dan itu layak dipilih alih-alih sekadar terjadi begitu saja.',
    'rate' => 'Permintaan per menit, per kunci',
    'rate_helper' => 'Sebuah bot yang menanyai empat puluh server siapa yang sedang bermain berarti empat puluh pertanyaan ke empat puluh server game. Inilah langit-langit yang mencegah sebuah perulangan yang ditulis pukul tiga pagi berubah menjadi uji beban.',
    'days' => 'Sebuah kunci yang diberikan bertahan',
    'days_helper' => 'Dalam hari. Nol berarti sampai dicabut, dan itulah bawaannya — kunci yang kedaluwarsa saat tidak ada yang memperhatikan adalah bot yang berhenti di malam hari tanpa ada yang menyebut sebabnya.',
    'days_never' => 'Sampai dicabut',

    /*
     * Dikatakan di halaman ini alih-alih dibiarkan untuk ditemukan. Pelican
     * membatalkan migrasi sebuah plugin ketika plugin itu dicopot, dan satu-
     * satunya tabel plugin ini ikut hilang.
     */
    'uninstall_note' => 'Mencopot plugin ini akan menghapus setiap kunci bersamanya. Itu disengaja — sebuah kunci yang hidup lebih lama daripada yang menjawabnya adalah sebuah masuk yang tidak bisa dicabut siapa pun.',
];
