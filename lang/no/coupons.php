<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Rabattkoder: koder som tar noe av den første fakturaen.
 *
 * Bare av den første, med vilje, og teksten sier det der det betyr noe. En kode
 * som også ga rabatt på hver fornyelse, ville vært en prisendring med en
 * sluttdato, og den som vil det, bør endre prisen.
 */

return [
    'title' => 'Rabattkoder',
    'nav_label' => 'Rabattkoder',
    'subheading' => 'Koder som tar en prosentdel eller et beløp av den første fakturaen. Fornyelser går til pakkeprisen.',

    // ---- tabellen --------------------------------------------------------
    'column_code' => 'Kode',
    'column_value' => 'Verdi',
    'column_uses' => 'Brukt',
    'column_expires' => 'Utløper',
    'column_packages' => 'Gjelder for',
    'column_live' => 'Aktiv',

    'never_expires' => 'Ingen sluttdato',
    'all_packages' => 'Alt',
    'some_packages' => ':count pakker',
    'usable' => 'Kan brukes akkurat nå',
    'unusable' => 'Av, utløpt eller oppbrukt',

    // ---- knappene --------------------------------------------------------
    'new' => 'Ny rabattkode',
    'edit' => 'Rediger',
    'delete' => 'Slett',
    'delete_confirm' => 'Fjerner koden. Fakturaer som allerede har brukt den, beholder rabatten sin - hver enkelt tar vare på hva som ble trukket fra.',
    'deleted' => 'Rabattkode slettet',
    'saved' => 'Rabattkode lagret',
    'save_failed' => 'Rabattkoden kunne ikke lagres',
    'taken' => 'Noe annet bruker allerede den koden.',
    'invalid' => 'En prosentdel er et helt tall fra 1 til 100. Et beløp skrives som 12.50 eller 12,50.',

    // ---- skjemaet --------------------------------------------------------
    'section_code' => 'Koden',
    'section_code_helper' => 'Det kunden taster når de bestiller.',
    'code' => 'Kode',
    'code_helper' => 'Lagres og sammenlignes med store bokstaver uten mellomrom, så den virker uansett hvordan noen taster den.',
    'live' => 'Aktiv',
    'live_helper' => 'Av gjør at koden slutter å virke uten å slette den: den går ut av bruk, mens rabatten den ga blir stående på fakturaene som hadde den.',

    'section_worth' => 'Hva den tar av',
    'section_worth_helper' => 'Bare av den første fakturaen. Den fører aldri en faktura under null.',
    'kind' => 'Type',
    'kind_helper' => 'En andel av prisen, eller et fast beløp.',
    'kind_percent' => 'Prosent',
    'kind_fixed' => 'Fast beløp',
    'value' => 'Verdi',
    'value_percent_helper' => 'Et helt tall fra 1 til 100.',
    'value_fixed_helper' => 'I butikkens valuta. Skriv det som 12.50 eller 12,50.',

    'section_limits' => 'Grenser',
    'section_limits_helper' => 'Alt her er frivillig. En kode uten noen av dem gjelder alt, for alle, for alltid.',
    'max_uses' => 'Hvor mange ganger den kan brukes',
    'max_uses_helper' => 'Telles når bestillingen legges inn, ikke når fakturaen betales - ellers kunne en kode med ti bruk legges inn hundre ganger på en natt.',
    'expires' => 'Utløper',
    'expires_helper' => 'Etter dette tidspunktet virker koden ikke lenger. Tomt betyr at det aldri skjer.',
    'packages' => 'Pakker',
    'packages_helper' => 'Ingenting avkrysset betyr hver pakke, nå og senere.',

    'empty' => 'Ingen rabattkoder ennå',
    'empty_body' => 'Lag en, og den virker ved bestilling så snart den er aktiv.',
];
