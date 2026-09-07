<?php

/*
 * Bahasa Indonesia. Ditulis dengan tangan.
 *
 * "Whitelist", "operator", "ban" dan "kick" tetap dalam bahasa Inggris: itu
 * perintah yang kamu ketik di konsol dan nama berkas yang ditulis Minecraft
 * sendiri. Tombol yang diterjemahkan di sebelah perintah berbahasa Inggris
 * adalah tombol yang harus kamu terjemahkan balik di kepala.
 */

return [
    'nav_label' => 'Pemain',
    'title' => 'Pemain',
    'subheading' => 'Whitelist, para operator, ban, dan semua orang yang pernah dilihat server ini.',

    /*
     * Dikatakan sekali, di atas, karena ini menjelaskan baik apa yang bisa
     * dilakukan halaman ini maupun mengapa satu hal yang tidak bisa dilakukannya
     * bukanlah kerusakan. Setiap perubahan dikirim sebagai perintah konsol, dan
     * begitulah memang cara memberi tahu Minecraft - game itu yang membuat
     * perubahannya dan menulis berkasnya sendiri, jadi keduanya tidak pernah
     * berbeda.
     */
    'how' => 'Perubahan dikirim ke server sebagai perintah konsol, jadi game itu yang melakukannya dan menulis berkasnya sendiri. Itu menuntut servernya berjalan.',
    'needs_running' => 'Server harus berjalan. Perubahan ini dilakukan oleh game, bukan dengan menyunting berkasnya dari bawah.',

    'name' => 'Nama pemain',
    'reason' => 'Alasan (opsional)',

    'whitelist' => 'Tambahkan ke whitelist',
    'unwhitelist' => 'Hapus dari whitelist',
    'op' => 'Jadikan operator',
    'deop' => 'Cabut operator',
    'ban' => 'Ban',
    'pardon' => 'Cabut ban',
    'kick' => 'Kick',

    'sent' => 'Perintah terkirim',
    'sent_body' => 'Server menerapkannya dan memperbarui berkasnya sendiri. Muat ulang halaman untuk melihat daftarnya berubah.',
    'refused' => 'Itu tidak terkirim',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Di whitelist',
    'flag_banned' => 'Kena ban',
    'flag_seen' => 'Pernah main di sini',

    'online' => 'Online sekarang',
    'online_count' => ':online dari :max',
    'online_none' => 'Tidak ada yang terhubung.',

    'players' => 'Pemain',
    'ips' => 'Alamat yang di-ban',
    'ips_empty' => 'Tidak ada alamat yang di-ban.',

    /*
     * Apa arti halaman kosong, dan itu biasanya bukan "tidak ada pemain" tetapi
     * "server ini belum pernah dijalankan". Minecraft tidak membuat satu pun
     * berkas ini sebelum ia berjalan pertama kali.
     */
    'empty' => 'Belum ada yang bisa ditampilkan. Minecraft menulis daftar ini sendiri, dan ia tidak membuatnya sampai server dijalankan untuk pertama kali.',

    'level' => 'Level :level',

    /*
     * Satu hal yang tidak dilakukan halaman ini, dikatakan alih-alih dibiarkan
     * untuk ditemukan. Status langsung menuntut sambungan kedua ke game itu
     * sendiri, dan itu fitur lain dengan syaratnya sendiri.
     */
    'not_live' => 'Ini adalah apa yang dicatat server, bukan siapa yang ada di dalam saat ini juga.',
];
