<?php

/*
 * Slovenčina. Písané rukou.
 *
 * Zľavové kódy: kódy, ktoré niečo strhnú z prvej faktúry.
 *
 * Len z prvej, zámerne, a text to hovorí tam, kde na tom záleží. Kód, ktorý by
 * zlacnil aj každé obnovenie, by bola zmena ceny s dátumom konca, a kto to
 * chce, má zmeniť cenu.
 */

return [
    'title' => 'Zľavové kódy',
    'nav_label' => 'Zľavové kódy',
    'subheading' => 'Kódy, ktoré strhnú percentá alebo sumu z prvej faktúry. Obnovenia idú za cenu balíka.',

    // ---- tabuľka ---------------------------------------------------------
    'column_code' => 'Kód',
    'column_value' => 'Hodnota',
    'column_uses' => 'Použité',
    'column_expires' => 'Vyprší',
    'column_packages' => 'Platí pre',
    'column_live' => 'Aktívny',

    'never_expires' => 'Bez dátumu konca',
    'all_packages' => 'Všetko',
    'some_packages' => 'Balíkov: :count',
    'usable' => 'Práve teraz sa dá použiť',
    'unusable' => 'Vypnutý, prešlý alebo vyčerpaný',

    // ---- tlačidlá --------------------------------------------------------
    'new' => 'Nový kód',
    'edit' => 'Upraviť',
    'delete' => 'Zmazať',
    'delete_confirm' => 'Odoberie kód. Faktúry, ktoré ho už použili, si zľavu nechajú - každá si sama pamätá, čo z nej bolo strhnuté.',
    'deleted' => 'Kód zmazaný',
    'saved' => 'Kód uložený',
    'save_failed' => 'Kód sa nepodarilo uložiť',
    'taken' => 'Ten kód už niečo iné používa.',
    'invalid' => 'Percento je celé číslo od 1 do 100. Suma sa píše ako 12.50 alebo 12,50.',

    // ---- formulár --------------------------------------------------------
    'section_code' => 'Kód',
    'section_code_helper' => 'To, čo zákazník napíše pri objednávaní.',
    'code' => 'Kód',
    'code_helper' => 'Ukladá sa a porovnáva veľkými písmenami bez medzier, aby fungoval, nech ho niekto napíše akokoľvek.',
    'live' => 'Aktívny',
    'live_helper' => 'Vypnutie kód prestane používať bez toho, aby ho zmazalo: vyjde z obehu, kým zľava, ktorú dal, zostáva na faktúrach, ktoré ju mali.',

    'section_worth' => 'Koľko strhne',
    'section_worth_helper' => 'Len z prvej faktúry. Nikdy nedostane faktúru pod nulu.',
    'kind' => 'Druh',
    'kind_helper' => 'Podiel z ceny, alebo pevná suma.',
    'kind_percent' => 'Percento',
    'kind_fixed' => 'Pevná suma',
    'value' => 'Hodnota',
    'value_percent_helper' => 'Celé číslo od 1 do 100.',
    'value_fixed_helper' => 'V mene obchodu. Napíš ju ako 12.50 alebo 12,50.',

    'section_limits' => 'Obmedzenia',
    'section_limits_helper' => 'Všetko tu je nepovinné. Kód bez jediného z nich platí na všetko, pre každého, navždy.',
    'max_uses' => 'Koľkokrát sa dá použiť',
    'max_uses_helper' => 'Počíta sa pri zadaní objednávky, nie pri zaplatení faktúry - inak by sa kód na desať použití dal zadať stokrát za noc.',
    'expires' => 'Vyprší',
    'expires_helper' => 'Po tomto okamihu kód prestane fungovať. Prázdne znamená, že sa to nikdy nestane.',
    'packages' => 'Balíky',
    'packages_helper' => 'Nič zaškrtnuté znamená každý balík, teraz aj neskôr.',

    'empty' => 'Zatiaľ žiadne kódy',
    'empty_body' => 'Vytvor jeden a bude fungovať pri objednávaní, len čo bude aktívny.',
];
