<?php

/*
 * De publieke statuspagina.
 *
 * Het enige wat deze plugin serveert aan iemand die niet is ingelogd, en de
 * enige pagina waarvan de tekst gelezen moet worden alsof een vreemde hem ziet -
 * want dat gebeurt ook. Niets hier zegt welke node, welke eigenaar of welk
 * adres; een naam, of hij draait, en hoeveel mensen erop zitten.
 */

return [
    // ---- de instellingenpagina --------------------------------------------
    'title' => 'Publieke statuspagina',
    'nav_label' => 'Statuspagina',
    'subheading' => 'Een pagina die iedereen kan openen, zonder account, met welke van jouw servers draaien. Er verschijnt niets op tot je hieronder een server noemt.',

    'address' => 'Je statuspagina staat op',
    'address_off' => 'Er wordt nog niets geserveerd. Voeg hieronder een server toe en sla op, dan verschijnt het adres hier.',

    'which' => 'Wat er gepubliceerd wordt',
    'which_helper' => 'De lijst begint leeg en er is niets openbaar tot er iets in staat. Alleen servers die je zelf al kunt openen worden aangeboden.',
    'add' => 'Server publiceren',
    'server' => 'Server',
    'shown_as' => 'Getoond als',
    'shown_as_helper' => 'Wat het publiek ziet. Typ het zelf in plaats van het panel de echte naam te laten gebruiken — "mc-prod-3 (niet aankomen)" is een notitie aan jezelf, geen tekst voor een forum.',

    'look' => 'Tekst',
    'look_helper' => 'Alles op deze pagina wordt gelezen door mensen zonder account.',
    'heading' => 'Kop',
    'heading_helper' => 'Leeg gelaten wordt de naam van het panel gebruikt.',
    'note' => 'Een regel boven de lijst',
    'note_helper' => 'Om te zeggen wat er speelt — een onderhoudsvenster, of waar men iets kan vragen. Platte tekst.',
    'link' => 'Link naar het panel',
    'link_helper' => 'Een weg terug naar binnen onderaan de pagina. Zet uit als je liever niet adverteert waar je panel staat.',

    'save' => 'Opslaan',
    'saved' => 'Opgeslagen',
    'save_failed' => 'Er is niets opgeslagen',
    'open' => 'Pagina openen',


    // ---- nodes -------------------------------------------------------------
    'nodes' => 'Machines',
    'nodes_helper' => 'Aan of uit, en verder niets. Niet de belasting en niet hoe vol de schijf zit — een bezoeker die wil weten of hij kan spelen heeft geen capaciteitsrapport over jouw hardware nodig, en zoiets publiceren is een kaart van waar de druk zit.',
    'add_node' => 'Machine publiceren',
    'node' => 'Machine',
    'node_shown_as_helper' => 'Typ het zelf. Een node heet meestal iets als hetzner-fsn1-01, en dat is een zin over waar jouw machines staan.',

    // ---- HTTP-monitors -----------------------------------------------------
    'monitors' => 'Andere diensten',
    'monitors_helper' => 'Alles waarvan het goed is te weten dat het draait: je website, een API, het health-adres van een bot. Het panel vraagt ze op dezelfde klok als de servers. Alleen beheerders — een monitor laat dit panel een adres ophalen, en dat aan iedereen geven maakt er een sonde van die ze kunnen richten waar ze willen.',
    'add_monitor' => 'Dienst toevoegen',
    'monitor_name' => 'Naam',
    'monitor_url' => 'Adres',
    'monitor_url_helper' => 'Alleen https. Dit panel dat op een timer platte http ophaalt vertelt iedereen op het pad welke diensten jij hebt.',
    'monitor_expect' => 'Verwacht',
    'monitor_expect_helper' => 'Leeg laten voor "elk antwoord telt", wat klopt voor een site die doorverwijst of 403 geeft op een kale aanvraag. Een getal is voor een adres dat precies dat hoort te zeggen — te streng ingesteld staat de regel voor eeuwig rood op een dienst die prima werkt.',

    // ---- gebruikerspagina's -------------------------------------------------
    'users' => "Pagina's voor je gebruikers",
    'users_helper' => 'Of mensen met servers op dit panel een eigen statuspagina mogen publiceren.',
    'user_pages' => 'Laat gebruikers er zelf een maken',
    'user_pages_helper' => 'Ieder krijgt een eigen adres op /status/hun-slug, met alleen servers die zij bezitten, onder namen die zij typen. Geen machines en geen andere diensten daarop — die zijn alleen van jou.',

    // ---- het uiterlijk ------------------------------------------------------
    'style' => 'Stijl',
    'style_helper' => 'Een van de looks van het panel zelf, toegepast op deze pagina: de kleur, de grijstinten die uit het oppervlak volgen, en hoe rond de hoeken zijn. Volg het panel betekent waar het panel vandaag op staat, inclusief wat je later verandert.',
    'style_panel' => 'Volg het panel',
    'accent' => 'Accentkleur',
    'accent_helper' => 'Overschrijft alleen de kleur van de stijl hierboven. Leeg laten gebruikt die van de stijl zelf.',
    'mode' => 'Licht of donker',
    'mode_helper' => 'Automatisch volgt wat het apparaat van de lezer ingesteld heeft, en dat is meestal het vriendelijkst.',
    'mode_dark' => 'Donker',
    'mode_light' => 'Licht',
    'mode_auto' => 'Volg de lezer',

    // ---- iemands eigen pagina ----------------------------------------------
    'mine_title' => 'Mijn statuspagina',
    'mine_nav_label' => 'Statuspagina',
    'mine_subheading' => 'Eén adres om te geven aan de mensen die op jouw servers spelen. Hij toont de servers die jij kiest en verder niets over dit panel.',
    'mine_address' => 'Jouw adres',
    'mine_address_helper' => 'Kies iets korts. Later veranderen breekt elke link die iemand al bewaard heeft.',
    'mine_address_off' => 'Kies hieronder een adres en sla op, dan verschijnt je pagina hier.',
    'slug' => 'Adres',
    'slug_helper' => 'Kleine letters, cijfers en koppeltekens. Drie tekens of meer.',
    'mine_heading' => 'Kop',
    'mine_heading_helper' => 'Leeg gelaten wordt je adres gebruikt.',
    'mine_note_helper' => 'Om te zeggen wat er speelt — een herstart, een evenement, waar je te vinden bent. Platte tekst, en gelezen door iedereen met de link.',
    'mine_which' => 'Jouw servers',
    'mine_which_helper' => 'Alleen servers die je zelf bezit worden aangeboden. Ergens subuser zijn is toegang tot een machine, geen toestemming om te publiceren dat hij bestaat.',
    'mine_shown_as_helper' => 'Wat bezoekers zien. Typ het zelf in plaats van de panelnaam als die naam een notitie aan jezelf is.',
    'mine_look_helper' => 'Hoe je pagina eruitziet voor de mensen die je hem stuurt.',
    'mine_remove' => 'Mijn pagina weghalen',
    'mine_remove_confirm' => 'Haalt je pagina weg en geeft het adres vrij voor iemand anders. Wat je ingesteld had is weg; de servers zelf blijven ongemoeid.',
    'mine_removed' => 'Je pagina is weggehaald',

    'why_slug' => 'Dat adres kan niet. Kleine letters, cijfers en koppeltekens, minstens drie tekens, en een paar woorden zijn gereserveerd.',
    'why_taken' => 'Iemand anders heeft dat adres al.',
    'why_unwritable' => 'Het kon niet weggeschreven worden. Controleer of storage/app van de gebruiker is waaronder het panel draait.',

    // ---- koppen op de pagina zelf -------------------------------------------
    'section_servers' => 'Servers',
    'section_nodes' => 'Machines',
    'section_monitors' => 'Diensten',

    // ---- de pagina zelf ---------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Start op',

    /*
     * Niet "offline", en dat verschil telt juist in het openbaar. Het panel kon
     * de server niet bereiken. Dat is meestal een node in onderhoud of een
     * daemon die herstart — niet hetzelfde als een server die uit staat, en
     * honderd spelers vertellen dat hun server plat ligt terwijl hij draait is
     * erger dan toegeven dat je het niet weet.
     */
    'unknown' => 'Onbekend',

    'players' => 'Spelers',
    'checked' => 'Gecontroleerd',
    'panel' => 'Inloggen',

    'all_up' => 'Alles draait.',
    'some_down' => 'Er draait iets niet.',
    'empty' => 'Hier wordt nog niets gepubliceerd.',
];
