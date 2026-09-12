<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Rabatkoder: koder, der tager noget af den første faktura.
 *
 * Kun af den første, med vilje, og teksten siger det der, hvor det betyder
 * noget. En kode, der også gav rabat på hver fornyelse, ville være en
 * prisændring med en slutdato, og den, der vil det, bør ændre prisen.
 */

return [
    'title' => 'Rabatkoder',
    'nav_label' => 'Rabatkoder',
    'subheading' => 'Koder, der tager en procentdel eller et beløb af den første faktura. Fornyelser går til pakkens pris.',

    // ---- tabellen --------------------------------------------------------
    'column_code' => 'Kode',
    'column_value' => 'Værdi',
    'column_uses' => 'Brugt',
    'column_expires' => 'Udløber',
    'column_packages' => 'Gælder for',
    'column_live' => 'Aktiv',

    'never_expires' => 'Ingen slutdato',
    'all_packages' => 'Alt',
    'some_packages' => ':count pakker',
    'usable' => 'Kan bruges lige nu',
    'unusable' => 'Slukket, udløbet eller opbrugt',

    // ---- knapperne -------------------------------------------------------
    'new' => 'Ny rabatkode',
    'edit' => 'Redigér',
    'delete' => 'Slet',
    'delete_confirm' => 'Fjerner koden. Fakturaer, der allerede har brugt den, beholder deres rabat - hver enkelt gemmer selv, hvad der blev trukket fra.',
    'deleted' => 'Rabatkode slettet',
    'saved' => 'Rabatkode gemt',
    'save_failed' => 'Rabatkoden kunne ikke gemmes',
    'taken' => 'Noget andet bruger allerede den kode.',
    'invalid' => 'En procentdel er et helt tal fra 1 til 100. Et beløb skrives som 12.50 eller 12,50.',

    // ---- formularen ------------------------------------------------------
    'section_code' => 'Koden',
    'section_code_helper' => 'Det, kunden taster, når der bestilles.',
    'code' => 'Kode',
    'code_helper' => 'Gemmes og sammenlignes med store bogstaver uden mellemrum, så den virker, uanset hvordan nogen taster den.',
    'live' => 'Aktiv',
    'live_helper' => 'Slukket holder koden op med at virke uden at slette den: den går ud af brug, mens den rabat, den gav, bliver stående på de fakturaer, der havde den.',

    'section_worth' => 'Hvad den tager af',
    'section_worth_helper' => 'Kun af den første faktura. Den fører aldrig en faktura under nul.',
    'kind' => 'Slags',
    'kind_helper' => 'En andel af prisen, eller et fast beløb.',
    'kind_percent' => 'Procent',
    'kind_fixed' => 'Fast beløb',
    'value' => 'Værdi',
    'value_percent_helper' => 'Et helt tal fra 1 til 100.',
    'value_fixed_helper' => 'I butikkens valuta. Skriv det som 12.50 eller 12,50.',

    'section_limits' => 'Grænser',
    'section_limits_helper' => 'Alt her er frivilligt. En kode uden nogen af dem gælder alt, for alle, altid.',
    'max_uses' => 'Hvor mange gange den må bruges',
    'max_uses_helper' => 'Tælles, når ordren afgives, ikke når fakturaen betales - ellers kunne en kode med ti brug afgives hundrede gange på en nat.',
    'expires' => 'Udløber',
    'expires_helper' => 'Efter dette tidspunkt virker koden ikke længere. Tom betyder, at det aldrig sker.',
    'packages' => 'Pakker',
    'packages_helper' => 'Intet sat flueben ved betyder hver pakke, nu og senere.',

    'empty' => 'Ingen rabatkoder endnu',
    'empty_body' => 'Lav en, og den virker ved bestilling, så snart den er aktiv.',
];
