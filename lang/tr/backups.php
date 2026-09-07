<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Panel genelinde yedekler.
 *
 * Pelican "bu sunucunun hangi yedekleri var" sorusuna yanıt verir. Bu sayfa
 * tersine yanıt verir; bir yöneticinin gerçekte sorduğu ve panelin koyacak yer
 * bulamadığı soru budur: benimkilerden hangisinin hiç yedeği yok.
 */

return [
    'title' => 'Yedekler',
    'nav_label' => 'Yedekler',
    'subheading' => 'Ulaşabildiğin her sunucu ve ne kadar süredir yedeksiz olduğu. Hiç yedeklenmemiş sunucular en üstte; :days günden eskisi bayat sayılır.',

    // ---- tablo ------------------------------------------------------------
    'column_server' => 'Sunucu',
    'column_last' => 'Son yedek',
    'column_kept' => 'Saklanan',
    'column_size' => 'Boyut',
    'column_failed' => 'Başarısız',

    'never' => 'Hiç',

    'filter_none' => 'Hiç yedeklenmemiş',
    'filter_stale' => 'Bayat',
    'filter_failed' => 'Başarısız oluyor',

    'open' => 'Pelican\'da aç',
];
