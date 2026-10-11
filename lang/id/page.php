<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Queue worker", "cron", "storage" dan jalur-jalurnya tetap persis seperti
 * ditulis di mesin panel: begitulah mereka diketik di sebuah shell.
 */

return [
    'title' => 'Pengaturan Essentials',
    'nav_label' => 'Pengaturan Essentials',
    'save' => 'Simpan',
    'saved' => 'Pengaturan tersimpan',
    'save_failed' => 'Pengaturan tidak dapat disimpan',
    'secret_kept' => 'Tersimpan. Biarkan kosong untuk mempertahankan, atau ketik yang baru untuk mengganti.',
    'update_background' => 'Berjalan di latar belakang dan memakan satu dua menit.',

    /*
     * Queue worker dan scheduler, tempat setiap tugas latar belakang dan tugas
     * terjadwal bergantung. Dikatakan terpisah karena keduanya gagal secara
     * terpisah dan obatnya berbeda untuk masing-masing.
     */
    'worker_missing' => 'Tidak ada queue worker yang menjawab. Pemasangan modpack, email, dan pekerjaan latar belakang lainnya diantrikan dan dikerjakan oleh sebuah proses worker, jadi sampai ada satu yang berjalan, semuanya hanya dicatat dan tidak pernah dikerjakan, tanpa kesalahan di mana pun. Entah memang tidak ada worker, atau ada satu yang dijalankan sebelum plugin ini dipasang dan tidak bisa memuat kodenya - keduanya diperbaiki dengan menjalankannya ulang di mesin panel. Setel layanannya agar menjalankan dirinya sendiri kembali, kalau tidak ini akan datang lagi setelah setiap pembaruan.',
    'cron_missing' => 'Penjadwal panel sudah :for menit tidak berjalan. Perpanjangan dan pemeriksaan watchdog menunggu itu. Baris cron-nya ada di dokumentasi Pelican.',

    /*
     * Dinamai menurut sebabnya, bukan gejalanya, karena gejalanya adalah "tidak
     * terjadi apa-apa" dan justru itulah yang membuatnya sulit ditempatkan:
     * pengumuman, tautan navigasi, gaya yang disimpan, dan tata letak halaman
     * semuanya adalah berkas di bawah storage/app, dan sebuah direktori yang
     * tidak dapat ditulis panel kehilangan setiap satu dari mereka tanpa
     * sepatah kata pun.
     */
    'storage_failed' => 'Panel tidak dapat menulis ke direktori storage-nya, jadi ini tidak tersimpan. Periksa apakah storage/app dimiliki oleh pengguna yang menjalankan panel. Alasannya ada di storage/logs.',
];
