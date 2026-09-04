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
