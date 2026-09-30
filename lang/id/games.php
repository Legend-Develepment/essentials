<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Simpan',
    'saved' => 'Tersimpan',
    'restart' => 'Game membaca berkas ini saat mulai, jadi mulai ulang server agar perubahan berlaku.',
    'failed' => 'Gagal menyimpan',
    'failed_write' => 'Daemon menolak penulisan. Periksa apakah server dapat dijangkau dan berkas tidak hanya-baca.',
    'read_only' => 'Anda boleh membaca berkas ini tetapi tidak menulisnya, jadi tidak ada yang bisa diubah di sini.',
    'missing' => 'Server ini belum punya berkas pengaturan. Game menulisnya saat pertama kali berjalan, jadi jalankan server sekali dan halaman ini akan terisi.',
    'keeps' => 'Semua isi berkas lainnya - komentar, baris kosong, urutannya dan setiap kunci yang tidak dikenal plugin ini - tetap persis seperti semula saat Anda menyimpan.',
    'raw' => 'Nama di sini adalah nama milik game, dalam urutan berkas. Tidak ada yang diterjemahkan atau dikelompokkan, karena halaman ini membaca berkas alih-alih daftar tulisan tangan.',
    'unset' => 'Belum diatur. Game menyebutnya sebagai contoh; mengisinya akan menambahkannya.',
    'group_all' => 'Pengaturan',
    'group_all_helper' => 'Semua yang disebut berkas ini.',
    'subheading' => 'Dibangun dari :files, bukan dari daftar tulisan tangan.',
];
