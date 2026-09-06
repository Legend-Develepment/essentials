<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * De namen van de instellingen zelf worden niet vertaald. Ze komen letterlijk
 * uit GameUserSettings.ini en het formulier zet ze alleen om naar leesbare
 * woorden - een instelling die anders heet dan de regel in het bestand waar hij
 * vandaan komt, is een instelling die je twee keer moet opzoeken.
 */

return [
    /* ------------------------------------------------- het beheertabblad -- */

    'section_helper' => 'Welke eggs ARK draaien. Verder niets — de rest van een ARK-server wordt via de opstartvariabelen ingesteld, en Pelicans eigen Startup-pagina bewerkt die al.',

    'eggs' => 'Welke eggs zijn ARK',
    'eggs_helper' => 'Vink de eggs aan die een ARK-server draaien. Binnen servers die ze gebruiken verschijnt een pagina Wereldinstellingen, en nergens anders. Dit is een andere vraag dan die op de statuspagina: die vraagt welke eggs Valve\'s query beantwoorden, wat Rust en Valheim ook doen, en deze vraagt welke eggs GameUserSettings.ini bewaren waar ARK dat doet, wat alleen ARK doet. Er staat om te beginnen niets aangevinkt, met opzet — een plugin kan niet weten hoe jij je eggs genoemd hebt.',

    /* -------------------------------------------- de pagina in de server -- */

    'nav_label' => 'Wereldinstellingen',
    'title' => 'ARK-wereldinstellingen',
    'subheading' => 'De instellingen die mensen echt aanpassen, uit GameUserSettings.ini.',

    'group_server' => 'De server',
    'group_server_helper' => 'Hoe de server heet, wie erin mag en met hoeveel.',
    'group_rates' => 'Snelheden',
    'group_rates_helper' => 'Hoe snel dingen gaan. 1.0 is het spel zoals het geleverd wordt; 2.0 is twee keer zo snel.',
    'group_rules' => 'Regels',
    'group_rules_helper' => 'Wat spelers mogen en wat het spel ze laat zien.',

    'keeps' => 'Vijftien instellingen uit een bestand met honderden. Al het andere erin — je mod-instellingen, sleutels waar deze plugin nog nooit van gehoord heeft, de opmerkingen en de volgorde van alles — blijft bij het opslaan precies zoals het is.',
    'missing' => 'Deze server heeft nog geen GameUserSettings.ini. Het spel schrijft dat bestand bij de eerste keer draaien, dus start de server één keer en deze pagina vult zich.',
    'read_only' => 'Je mag dit bestand lezen maar niet schrijven, dus hier valt niets te wijzigen.',

    'save' => 'Opslaan',
    'saved' => 'Opgeslagen',
    'saved_restart' => 'ARK leest dit bestand bij het starten, dus herstart de server om de wijziging te laten ingaan.',
    'failed' => 'Kon niet opslaan',
    'failed_write' => 'De daemon weigerde de schrijfactie. Controleer of de server bereikbaar is en het bestand niet alleen-lezen is.',
];
