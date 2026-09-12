<?php

/*
 * “Benimkilerden hangisi geride kaldı” sorusuna yanıt veren sayfa. Sunucular
 * kimin ise onun için yazıldı, paneli çeviren için değil - bu yüzden burada
 * node sözü geçmez ve elinden bir şey gelmeyeceği bir sayı sunulmaz. Her
 * satır ya açabileceği bir sunucunun adını verir ya da onunla ne
 * yapılacağını söyler.
 */

return [
    'title' => 'İlgi bekliyor',
    'nav_label' => 'İlgi bekliyor',
    'subheading' => 'Sunucuların, ada göre değil neyin geride kaldığına göre sıralı. :days günden eski bir yedek bayat sayılır.',
    'column_server' => 'Sunucu',
    'column_last' => 'Son yedek',
    'column_kept' => 'Saklanan',
    'column_schedules' => 'Durmuş görevler',
    'never' => 'Hiç',
    'filter_none' => 'Hiç yedeklenmemiş',
    'filter_stale' => 'Yedek bayat',
    'open' => 'Yedekler',
    'empty' => 'Geride kalan yok',
    'empty_body' => 'Ulaşabildiğin her sunucunun yakın tarihli bir yedeği var ve durmuş görevi yok. Bu doğru olmaktan çıktığında bu sayfa kendini doldurur.',
];
