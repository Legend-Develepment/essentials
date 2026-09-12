<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * Halaman Status sistem: mesin tempat panel ini sendiri berjalan, dan setiap
 * node yang diminta di sebelahnya.
 *
 * Bukan mesin yang sama dengan node pada pemasangan mana pun yang memisahkan
 * keduanya, dan itulah sebabnya keduanya bisa ada di halaman ini.
 *
 * "Swap", "Wings", "PHP" dan "uptime" dibiarkan: begitulah namanya di mesinnya
 * dan di setiap perkakas yang akan dipakai orang untuk membandingkan.
 */

return [
    'title' => 'Status sistem',
    'nav_label' => 'Status sistem',
    'subheading' => 'Mesin tempat panel ini sendiri berjalan, apa yang berjalan di atasnya, dan setiap node yang kamu minta di sebelahnya.',

    'options' => 'Opsi',
    'enabled' => 'Tampilkan di bilah samping',
    'enabled_helper' => 'Mati akan mengeluarkan barisnya dari bilah samping. Halamannya tetap punya alamatnya sendiri, jadi ia selalu ada untuk dinyalakan lagi.',

    'refresh' => 'Baca ulang setiap',
    'refresh_helper' => 'Seluruh halaman diminta lagi pada selang waktu ini. Mati membiarkannya sebagaimana saat kamu membukanya.',
    'refresh_off' => 'Hanya saat saya membukanya',
    'refresh_seconds' => ':seconds detik',

    'blocks' => 'Tampilkan',
    'blocks_helper' => 'Yang dicentang ditampilkan. Disk adalah satu kartu per sistem berkas, sehingga partisi root yang penuh tidak tersembunyi di balik mount data yang setengah kosong.',
    'block_cpu' => 'Prosesor',
    'block_memory' => 'Memori',
    'block_swap' => 'Swap',
    'block_disk' => 'Disk',
    'block_load' => 'Rerata beban',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistem',
    'block_version' => 'Versi panel',
    // Tidak pernah ditampilkan - kartu node memakai nama node itu sendiri -
    // tetapi blank() memintanya, dan kunci yang hilang yang mencetak namanya
    // sendiri adalah cadangan yang buruk.
    'block_node' => 'Node',

    'nodes' => 'Node yang ditampilkan',
    'nodes_helper' => 'Satu kartu untuk masing-masing, di sebelah mesin panel. Tidak ada yang dicentang berarti tidak ada yang ditampilkan - ikhtisar sudah punya blok berisi setiap node. Masing-masing ditanyakan pada daemon-nya sendiri, jadi selang yang pendek dengan daftar yang panjang berarti banyak permintaan.',

    'section_usage' => 'Pemakaian',
    'section_host' => 'Panel ini',
    'section_nodes' => 'Node',

    'disk_panel' => 'Panel tinggal di sini',
    'wings' => 'Wings :version',
    'version_installed' => 'Terpasang',
    'version_latest' => 'Terbaru',
    'version_current' => 'Mutakhir',
    'version_update' => 'Ada pembaruan',
    'version_unknown' => 'Tidak dapat diperiksa',

    /*
     * Apa yang ditawarkan sebuah kartu yang tertinggal.
     *
     * Sebuah tautan ke rilisnya, bukan tombol yang menjalankan pembaruannya,
     * karena dari sini memang tidak ada pembaruan yang bisa dijalankan: Pelican
     * tidak punya perintah upgrade, dan Wings tidak punya endpoint yang
     * mengganti binernya sendiri. Petunjuknya menyebut di mana pekerjaannya
     * benar-benar terjadi, supaya tidak ada yang mencari tombol yang memang
     * tidak pernah mungkin ada.
     */
    'version_release' => 'Apa yang baru',
    'version_how_panel' => 'Membuka catatan rilis. Peningkatan panel dilakukan di mesin tempat ia berjalan - panel tidak bisa mengganti berkasnya sendiri, dan tidak ada plugin yang boleh menjalankan perintah shell.',
    'version_how_wings' => 'Membuka catatan rilis. Wings diperbarui di node itu sendiri - panel tidak punya saluran ke program yang berjalan di mesin lain.',

    'wings_latest' => 'Terbaru :version',
    'load_cores' => ':percent% dari :cores prosesor',
    'load_windows' => ':five dalam 5 mnt · :fifteen dalam 15 mnt',
    'uptime_since' => 'Sejak :date',
    'unavailable' => 'Tidak tersedia di mesin ini',

    'fact_os' => 'Sistem operasi',
    'fact_hostname' => 'Nama host',
    'fact_php' => 'PHP',
    'fact_cores' => 'Prosesor',
    'fact_processes' => 'Proses',
];
