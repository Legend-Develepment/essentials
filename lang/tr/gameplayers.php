<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Bir sunucuda kimin olduğu; Valve sorgusuna yanıt veren oyunlar için.
 *
 * Rust, ARK, Valheim ve diğerleri için tek bir sayfa, çünkü hepsi aynı pakete
 * yanıt veriyor. Oyundan oyuna değişen şey, birine ne yapabildiğin - atmak
 * birinde `kick "ad"`, ötekinde `KickPlayer <id>` - ve bu yüzden bu sayfa okur,
 * işlem yapmaz.
 */

return [
    'title' => 'Oyuncular',
    'nav_label' => 'Oyuncular',
    'subheading' => 'Kimin bağlı olduğu; panele değil, oyunun kendisine sorularak.',

    'refresh' => 'Yeniden sor',

    'count' => ':count bağlı',
    'score' => 'Puan',

    'just_joined' => 'az önce girdi',
    'minutes' => ':count dk',
    'hours' => ':count sa',
    'hours_minutes' => ':hours sa :minutes dk',

    'empty' => 'Bu sunucuda kimse yok.',

    /*
     * "Kimse yok" değil ve fark önemli.
     *
     * Panel ile oyun portu çoğu zaman birbirine ulaşamayan ağlarda olur ve bunu
     * boş bir liste olarak çizmek, bu sayfanın bilmediği bir şeyi söylemesi
     * olurdu.
     */
    'unreachable' => 'Sunucu yanıt vermedi. Başlıyor olabilir ya da panel, çalıştığı yerden onun oyun portuna ulaşamıyor olabilir — bu, kimsenin olmamasından başka bir şey.',
];
