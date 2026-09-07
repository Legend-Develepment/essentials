<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Een weg naar binnen van buiten het paneel.
 *
 * Twee soorten lezers in één bestand, en ze willen het tegenovergestelde. Een
 * beheerder die deze pagina leest, beslist of hij iemand een sleutel toevertrouwt,
 * dus elke regel hier zegt wat een sleutel kan bereiken in plaats van hoe hij
 * heet. Wie er een vraagt, wil weten wat hij in handen krijgt en wat er gebeurt
 * als hij hem kwijtraakt, en daarom is de zin over de sleutel die maar één keer
 * te zien is, geen voetnoot.
 *
 * Nergens staat hier „token". „Sleutel" is het woord op Pelicans eigen
 * accountpagina, en een paneel dat hetzelfde ding twee namen geeft, is een
 * paneel waar iemand het verkeerde zoekt.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Sleutels waarmee iets buiten het paneel kan vragen wat deze plugin weet. Alleen lezen — niets hier kan een server starten, stoppen of bereiken.',

    'my_title' => 'API-toegang',
    'my_nav_label' => 'API-toegang',
    'my_subheading' => 'Een eigen sleutel, voor een bot of een script. Hij antwoordt alleen voor de servers die je toch al kunt openen.',

    // ---- wat een sleutel is, één keer gezegd, waar het ertoe doet --------
    'address' => 'Het adres',
    'address_helper' => 'Stuur de sleutel mee als Authorization-header: :example',

    /*
     * Het ene dat iemand gelezen moet hebben voordat hij het venster sluit.
     * Geschreven als wat te doen in plaats van als waarschuwing, want „bewaar
     * hem goed" is een advies waar niemand iets mee kan en „plak hem nu waar de
     * bot hem leest" wel.
     */
    'once' => 'Dit is de enige keer dat deze sleutel te zien is',
    'once_body' => 'Hij wordt als hash bewaard, dus niemand — ook niet wie dit paneel draait — kan hem teruglezen. Plak hem nu waar de bot of het script hem leest. Raak je hem kwijt, trek deze dan in en vraag een nieuwe.',
    'copy' => 'Kopiëren',
    'copied' => 'Gekopieerd',

    // ---- de toestanden ---------------------------------------------------
    'state' => 'Toestand',
    'state_pending' => 'Wacht',
    'state_active' => 'Actief',
    'state_refused' => 'Geweigerd',
    'state_revoked' => 'Ingetrokken',

    'state_pending_body' => 'Iemand moet dit toekennen voordat hij ergens antwoord op geeft.',
    'state_refused_body' => 'Dit is afgewezen. Er is niets uitgegeven.',
    'state_revoked_body' => 'Deze sleutel is afgenomen en antwoordt niet meer.',

    // ---- het bereik ------------------------------------------------------
    'scope' => 'Bereikt',
    'scope_person' => 'Hun eigen servers',
    'scope_panel' => 'Het hele paneel',

    'scope_person_helper' => 'Antwoordt alleen voor de servers die de eigenaar toch al kan openen, op dezelfde manier gevraagd als het paneel het vraagt. Deze sleutel kwijtraken verliest niets wat de eigenaar niet al kon zien.',
    'scope_panel_helper' => 'Antwoordt op de vragen over het hele paneel — elke node, de capaciteit, de waakhond, de machine van het paneel zelf. Voor een bot die over het paneel rapporteert in plaats van voor een persoon.',

    // ---- de tabel --------------------------------------------------------
    'column_name' => 'Waarvoor',
    'column_owner' => 'Van wie',
    'column_prefix' => 'Sleutel',
    'column_asked' => 'Gevraagd',
    'column_used' => 'Laatst gebruikt',
    'column_expires' => 'Verloopt',

    'never_used' => 'Nooit',
    'no_expiry' => 'Tot hij wordt ingetrokken',

    'tab_waiting' => 'Wachtend',
    'tab_active' => 'Actief',
    'tab_all' => 'Alles',

    'empty' => 'Nog geen sleutels',
    'empty_body' => 'Niemand heeft erom gevraagd en er is er geen uitgegeven. Deze pagina vult zichzelf terwijl mensen dat doen.',

    'my_empty' => 'Je hebt geen sleutel',
    'my_empty_body' => 'Vraag er een, dan verschijnt hij hier met wat er ook op geantwoord is.',

    // ---- vragen ----------------------------------------------------------
    'ask' => 'Vraag een sleutel',
    'ask_name' => 'Waar is hij voor',
    'ask_name_helper' => 'Een paar woorden, zodat je later twee van jezelf uit elkaar houdt en wie hem toekent weet wat hij toekent.',
    'ask_reason' => 'Iets wat het waard is erbij te zetten',
    'ask_reason_helper' => 'Optioneel. Gelezen door wie beslist.',
    'ask_sent' => 'Gevraagd',
    'ask_sent_body' => 'Hij verschijnt hieronder zodra iemand geantwoord heeft.',
    'ask_granted' => 'Hier is je sleutel',
    'ask_open' => 'Je hebt er al een die op antwoord wacht',
    'ask_open_body' => 'Eén verzoek tegelijk. Trek dat in als het een vergissing was.',
    'ask_failed' => 'Daar kon niet om gevraagd worden',

    'cancel' => 'Intrekken',
    'cancel_confirm' => 'Trekt het verzoek in. Er is niets uitgegeven, dus er stopt ook niets met werken.',

    // ---- beslissen -------------------------------------------------------
    'grant' => 'Toekennen',
    'grant_confirm' => 'Geeft een sleutel uit die antwoordt voor de eigen servers van deze persoon, en toont hem één keer. Hij kan alles wat de sleutel zal melden al zien — dit beslist of iets buiten het paneel het namens hem mag vragen.',
    'granted' => 'Toegekend',

    'refuse' => 'Weigeren',
    'refuse_answer' => 'Wat je hun vertelt',
    'refuse_answer_helper' => 'Optioneel, en te zien op hun eigen pagina. Een weigering zonder reden is er een die volgende week opnieuw gevraagd wordt.',
    'refused' => 'Geweigerd',

    'revoke' => 'Intrekken',
    'revoke_confirm' => 'De sleutel stopt onmiddellijk met antwoorden en zijn hash wordt verwijderd, dus hij is niet terug te halen. Alles wat hem gebruikt, valt stil. Vraag een nieuwe in plaats van dit ongedaan te maken.',
    'revoked' => 'Ingetrokken',

    'mint' => 'Nieuwe sleutel',
    'mint_body' => 'Voor een bot in plaats van voor een persoon. Hij is toegekend op het moment dat hij gemaakt wordt, want jij bent degene die hem zou hebben goedgekeurd.',
    'mint_owner' => 'Van wie hij is',
    'mint_owner_helper' => 'Een sleutel antwoordt als iemand. Bij een sleutel voor het hele paneel is dat alleen wie erop aanspreekbaar is; bij een persoonlijke is het ook wat de sleutel kan zien.',
    'minted' => 'Gemaakt',

    // ---- wat een beheerder instelt ---------------------------------------
    'settings' => 'Hoe dit werkt',
    'approval' => 'Verzoeken wachten op toekenning',
    'approval_helper' => 'Aan krijgt iemand die om een sleutel vraagt er een zodra iemand ja zegt. Uit krijgt hij er meteen een — wat redelijk is op een paneel waar iedereen met een account toch al vertrouwd is, en het waard is om te kiezen in plaats van erin te belanden.',
    'rate' => 'Verzoeken per minuut, per sleutel',
    'rate_helper' => 'Een bot die veertig servers vraagt wie er speelt, zijn veertig vragen aan veertig gameservers. Dit is het plafond dat voorkomt dat een lus die iemand om drie uur \'s nachts schreef een belastingstest wordt.',
    'days' => 'Een toegekende sleutel houdt het',
    'days_helper' => 'In dagen. Nul betekent tot hij wordt ingetrokken, en dat is de standaard — een sleutel die verloopt terwijl niemand kijkt, is een bot die \'s nachts stilvalt zonder dat ergens staat waarom.',
    'days_never' => 'Tot hij wordt ingetrokken',

    /*
     * Op de pagina gezegd in plaats van overgelaten om te ontdekken. Pelican
     * draait de migraties van een plugin terug als die verwijderd wordt, en de
     * ene tabel van deze plugin gaat mee.
     */
    'uninstall_note' => 'Deze plugin verwijderen verwijdert elke sleutel mee. Dat is met opzet — een sleutel die het ding overleeft dat hem beantwoordt, is een inlog die niemand kan intrekken.',
];
