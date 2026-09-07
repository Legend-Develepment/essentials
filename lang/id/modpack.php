<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Modpack", "mod" dan "loader" dibiarkan: itu kata-kata di Modrinth dan di
 * dalam game, dan itulah yang dicari orang.
 */

return [
    'nav_label' => 'Modpack',
    'title' => 'Modpack',
    'subheading' => 'Pasang sebuah modpack dari Modrinth ke server ini.',

    'section' => 'Cari sebuah pack',
    'section_helper' => 'Hanya Modrinth, dan hanya pack sisi server. Ia tidak butuh akun maupun kunci API, dan itulah sebabnya ia satu-satunya sumber di sini — yang lain masing-masing menuntut kunci ditempel dulu sebelum apa pun muncul.',

    'search' => 'Cari',
    'search_helper' => 'Biarkan kosong untuk yang paling banyak diunduh. Pencarian bertanya ke Modrinth, jadi ia berjalan ketika kamu meninggalkan kolom, bukan saat kamu mengetik.',

    'pack' => 'Pack',
    'pack_helper' => 'Hanya pack yang menyatakan dapat berjalan di server yang didaftar.',

    'version' => 'Versi',
    'version_helper' => 'Versi game dan loader ditampilkan di sebelah masing-masing. Pilih loader yang sudah dijalankan egg server ini — ini memasang berkas dan tidak mengubah egg-mu maupun perintah start-mu.',

    'downloads' => 'unduhan',

    'install' => 'Pasang pack ini',
    'install_go' => 'Pasang',
    'install_confirm' => 'Berkas pack ditambahkan ke server ini. **Tidak ada yang dihapus** — tidak duniamu, tidak mod lamamu, tidak sebuah konfigurasi. Sebuah pack yang dipasang di atas pack lain meninggalkan keduanya, jadi hapus dulu sendiri mod pack sebelumnya jika itu yang kamu mau. Server harus dalam keadaan berhenti, dan ia tetap berhenti.',

    'started' => 'Sedang dipasang',
    'started_helper' => 'Pack sedang diambil dan dibongkar. Beberapa ratus berkas memakan beberapa menit, dan kamu akan diberi tahu ketika selesai — ia tetap jalan meski kamu meninggalkan halaman ini.',

    'running' => 'Server sedang berjalan',
    'running_helper' => 'Minecraft memuat mod-nya saat mulai, jadi pack yang dipasang sekarang akan meninggalkan server yang bukan pack lama maupun pack baru sampai ia dijalankan ulang. Hentikan lalu coba lagi.',

    'done' => ':pack terpasang',
    'done_body' => ':files berkas diambil dan :overrides butir dari folder milik pack itu sendiri ditempatkan. Jalankan server kalau kamu sudah siap.',
    'done_refused' => ':count berkas dilewati karena pack memintanya dari tempat yang tidak diunduh oleh ini.',

    'failed' => 'Pack tidak terpasang',
    'failed_fetch' => 'Pack tidak dapat diambil atau dibongkar. Daemon mungkin tidak terjangkau, atau server kehabisan ruang disk.',
    'failed_index' => 'Pack terambil tetapi tidak punya indeks yang terbaca di dalamnya, jadi tidak ada yang bisa dipasang.',
    'failed_version' => 'Versi itu tidak lagi punya berkas pack untuk diunduh. Pilih yang lain.',
    'failed_queue' => 'Pemasangan tidak dapat diantrikan. Ini butuh sebuah queue worker yang berjalan di panel.',
];
