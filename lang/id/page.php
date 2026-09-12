<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Queue worker", "cron", "storage" dan jalur-jalurnya tetap persis seperti
 * ditulis di mesin panel: begitulah mereka diketik di sebuah shell.
 */

return [
    'updating_now' => 'Panel ini sedang memasang pembaruan. Sebuah halaman bisa terlihat aneh sebentar.',
    'updating_done' => 'Pembaruannya sudah terpasang. Kalau tadi ada halaman yang terlihat aneh, muat ulang saja.',
    'title' => 'Pengaturan Essentials',
    'nav_label' => 'Pengaturan Essentials',
    'save' => 'Simpan',
    'saved' => 'Pengaturan tersimpan',
    'save_failed' => 'Pengaturan tidak dapat disimpan',
    'update' => 'Perbarui',
    'update_available' => 'Ada pembaruan',
    'update_confirm' => 'Panel mengunduh versi baru, menyusun ulang asset-nya, dan mengosongkan cache-nya. Pengaturanmu tetap.',
    'update_started' => 'Pembaruan dimulai',
    'update_background' => 'Berjalan di latar belakang dan memakan satu dua menit.',
    'update_failed' => 'Tema tidak dapat diperbarui',
    'update_done' => 'Tema diperbarui',
    'check' => 'Periksa pembaruan',
    'check_failed' => 'Umpan pembaruan tidak dapat dibaca',
    'check_failed_body' => 'Panel tidak menjangkaunya, atau ia tidak mengembalikan JSON yang sah.',
    'up_to_date' => 'Kamu ada di versi terbaru',
    'reinstall' => 'Pasang ulang',

    'auto_on' => 'Pembaruan memasang dirinya sendiri',

    /*
     * Apa yang dilakukan pemeriksaan otomatis terakhir. Masing-masing menyebut
     * bagian yang perlu dilihat, karena dari sebuah peramban ketiga cara ini
     * gagal semuanya terlihat sama: sebuah angka yang menghitung mundur.
     */
    'auto_never' => 'Belum ada pemeriksaan yang berjalan. Pembaruan otomatis butuh penjadwal panel - entri cron yang menjalankan php artisan schedule:run setiap menit. Tanpa itu tidak ada apa pun yang terjadwal yang benar-benar berjalan.',
    'auto_ago' => 'Terakhir diperiksa :ago',
    'auto_just_now' => 'baru saja',
    'auto_minutes' => 'menit lalu',
    'auto_current' => 'tidak ada yang lebih baru di saluran ini.',
    'auto_installed' => 'v:version dipasang di sini, oleh pemeriksaan terjadwal itu sendiri. Ia melakukannya ketika tidak ada queue worker yang menjawab, jadi pembaruan tetap terjadi - tapi panel tanpa worker adalah panel di mana pekerjaan lain yang diantrikan juga tidak berjalan.',
    'auto_queued' => 'v:version telah diserahkan ke queue worker. Jika versi di atas tidak berubah dalam beberapa menit, worker itu mengambil pekerjaan tapi gagal pada yang satu ini - menjalankannya ulang biasanya memperbaikinya, dan alasannya ada di storage/logs.',
    'auto_unreachable' => 'umpan pembaruan tidak dapat dibaca. Ia diambil lewat internet, jadi ini biasanya masalah jaringan atau DNS di mesin panel.',
    'auto_error' => 'pemeriksaan gagal. Alasannya ada di storage/logs.',

    /*
     * Queue worker, yaitu yang sebenarnya melakukan pembaruan. Dikatakan
     * terpisah dari pemeriksaan di atas karena keduanya gagal secara terpisah
     * dan obatnya berbeda untuk masing-masing.
     */
    'worker_missing' => 'Tidak ada queue worker yang menjawab. Pembaruan dan pemasangan modpack diantrikan dan dikerjakan oleh sebuah proses worker, jadi sampai ada satu yang berjalan, semuanya hanya dicatat dan tidak pernah dikerjakan, tanpa kesalahan di mana pun. Entah memang tidak ada worker, atau ada satu yang dijalankan sebelum plugin ini dipasang dan tidak bisa memuat kodenya - keduanya diperbaiki dengan menjalankannya ulang di mesin panel. Setel layanannya agar menjalankan dirinya sendiri kembali, kalau tidak ini akan datang lagi setelah setiap pembaruan.',
    'cron_missing' => 'Penjadwal panel sudah :for menit tidak berjalan. Perpanjangan, pemeriksaan watchdog dan pembaruan otomatis semuanya menunggu itu. Baris cron-nya ada di dokumentasi Pelican.',

    'next_check' => 'Pemeriksaan berikutnya dalam',
    'due_now' => 'sekarang',

    /*
     * Dinamai menurut sebabnya, bukan gejalanya, karena gejalanya adalah "tidak
     * terjadi apa-apa" dan justru itulah yang membuatnya sulit ditempatkan:
     * pengumuman, tautan navigasi, gaya yang disimpan, dan tata letak halaman
     * semuanya adalah berkas di bawah storage/app, dan sebuah direktori yang
     * tidak dapat ditulis panel kehilangan setiap satu dari mereka tanpa
     * sepatah kata pun.
     */
    'storage_failed' => 'Panel tidak dapat menulis ke direktori storage-nya, jadi ini tidak tersimpan. Periksa apakah storage/app dimiliki oleh pengguna yang menjalankan panel. Alasannya ada di storage/logs.',

    /*
     * Dikatakan setelah setiap pembaruan yang gagal, bukan hanya setelah
     * ketidakcocokan. Pesan di atas sudah menyebut sebabnya; yang ini menyebut
     * satu obat yang tidak bisa disimpulkan orang dari "diharapkan X, didapat Y".
     */
    'update_renamed' => 'Jika di sini tertulis dua id tidak cocok, plugin ini telah diganti nama dan tidak ada pembaruan yang bisa melewatinya - Pelican mengenali plugin yang terpasang dari id-nya. Copot entri lama di Admin → Plugins lalu pasang yang ini dari awal. Pengaturanmu selamat: mereka tinggal di .env dan di storage/app/private/legend-theme, dan keduanya tidak dikunci berdasarkan id.',
];
