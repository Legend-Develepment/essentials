<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Cron" olduğu gibi kalıyor: panelin makinesinde çalışan şeyin adı bu ve ona
 * bakmaya giden tam bu sözcüğü arıyor.
 */

return [
    'nav_label' => 'Zamanlamalar',
    'title' => 'Hangi zamanlama durdu',
    'subheading' => 'Paneldeki her zamanlanmış görev, en kötüsü başta - :hours saatten uzun süredir takılı, gecikmiş ya da hiç çalışmamış.',

    'how' => 'Pelican zamanlamaları her sunucunun içinde gösterir ve kendi durumunun onlar için üç sözcüğü vardır: kapalı, işliyor, etkin. Hiçbiri "bu durdu" demek değildir. Yarı yolda düşen bir çalışma sonsuza dek "işliyor" kalır ve şu anda çalışan bir tanesiyle tıpatıp aynı görünür; cron öldüğü için saati saatler önce geçmiş bir zamanlama hâlâ etkin diye anılır. Bu sayfa öteki soruyu sorar. Yalnızca okuma - bir zamanlamayı düzenleyen, çalıştıran ya da silen her şey, o sunucu için Pelican\'ın kendi sayfasında kalır.',

    'column_state' => 'Durum',
    'column_name' => 'Zamanlama',
    'column_server' => 'Sunucu',
    'column_last' => 'Son çalışma',
    'column_next' => 'Sonraki çalışma',

    /*
     * Beş hüküm. Bir yönerge olarak değil, doğru olan şey olarak yazıldı;
     * çünkü üçü bakılacak şeyler, ikisi değil.
     */
    'state_stuck' => 'Takılı',
    'state_overdue' => 'Gecikmiş',
    'state_never' => 'Hiç çalışmamış',
    'state_healthy' => 'Yolunda',
    'state_off' => 'Kapalı',

    'filter_stuck' => 'Takılı',
    'filter_overdue' => 'Gecikmiş',
    'filter_never' => 'Hiç çalışmamış',
    'filter_off' => 'Kapatılmış',

    'open' => 'Sunucuda aç',

    'empty' => 'Ulaşabildiğin hiçbir sunucuda zamanlama yok - ya da bir filtren açıksa, durmuş olan yok.',
];
