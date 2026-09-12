<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Egg", „GameUserSettings.ini" a „daemon" ostávajú po anglicky: to sú slová,
 * ktoré vidno v Pelicane, v správcovi súborov a vo všetkom, čo sa o ARKu píše.
 */

return [
    /* --------------------------------------------- karta administrátora -- */

    /*
     * Samotný nadpis sekcie tu nie je. Každá sekcia nastavení berie nadpis zo
     * settings.groups.<meno>, a to stavia group().
     */
    'section_helper' => 'Ktoré eggs spúšťajú ARK. Nič viac - zvyšok servera ARK sa nastavuje jeho spúšťacími premennými, a stránka Spustenie v Pelicane ich už upravuje.',

    'eggs' => 'Ktoré eggs sú ARK',
    'eggs_helper' => 'Zaškrtnite eggs, ktoré spúšťajú server ARK. Vnútri serverov, ktoré ich používajú, sa objaví stránka Nastavenia sveta, a nikde inde. Nie je to tá istá otázka ako na stránke stavu: tam sa pýtame, ktoré eggs odpovedajú na dopyt Valve, čo robí aj Rust a Valheim, a tu, ktoré eggs držia GameUserSettings.ini tam, kde ho drží ARK, čo robí len ARK. Na začiatku nie je zaškrtnuté nič, a to naschvál: plugin nemôže vedieť, ako ste svoje eggs pomenovali.',

    /* ------------------------------------------------- stránka servera --- */

    'nav_label' => 'Nastavenia sveta',
    'title' => 'Nastavenia sveta ARK',
    'subheading' => 'Nastavenia, ktoré ľudia naozaj menia, z GameUserSettings.ini.',

    'group_server' => 'Server',
    'group_server_helper' => 'Ako sa server volá, kto smie dnu a koľko ich.',
    'group_rates' => 'Pomery',
    'group_rates_helper' => 'Ako rýchlo sa veci dejú. 1.0 je hra tak, ako vychádza; 2.0 je dvakrát rýchlejšie.',
    'group_rules' => 'Pravidlá',
    'group_rules_helper' => 'Čo hráči smú a čo im hra ukazuje.',

    'keeps' => 'Pätnásť nastavení zo súboru, kde ich sú stovky. Všetko ostatné - nastavenia vašich modov, kľúče, o ktorých tento plugin nikdy nepočul, komentáre aj poradie toho všetkého - ostáva pri uložení presne tak, ako je.',
    'missing' => 'Tento server ešte nemá GameUserSettings.ini. Hra ho zapíše pri prvom behu, tak server raz spustite a táto stránka sa naplní.',
    'read_only' => 'Tento súbor môžete čítať, ale nie zapisovať, takže tu sa nedá nič zmeniť.',

    'save' => 'Uložiť',
    'saved' => 'Uložené',
    'saved_restart' => 'ARK číta tento súbor pri štarte, tak server reštartujte, nech zmena začne platiť.',
    'failed' => 'Nepodarilo sa uložiť',
    'failed_write' => 'Daemon zápis odmietol. Skontrolujte, že je server dostupný a že súbor nie je len na čítanie.',
];
