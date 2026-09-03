<?php

/*
 * Nederlands.
 *
 * "Modpack", "loader" en "egg" blijven staan: dat zijn de woorden die Modrinth
 * en Pelican zelf gebruiken, en een Nederlands equivalent zou een tweede naam
 * zijn voor iets wat overal elders één naam heeft.
 */

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Installeer een modpack van Modrinth op deze server.',

    'section' => 'Een pack zoeken',
    'section_helper' => 'Alleen Modrinth, en alleen packs voor een server. Het vraagt geen account en geen API-sleutel, en dat is precies waarom het hier de enige bron is — bij de andere moet er eerst een sleutel worden ingeplakt voordat er iets verschijnt.',

    'search' => 'Zoeken',
    'search_helper' => 'Laat het leeg voor de meest gedownloade. Zoeken vraagt het aan Modrinth, dus het gebeurt wanneer je het veld verlaat en niet terwijl je typt.',

    'pack' => 'Pack',
    'pack_helper' => 'Alleen packs die zeggen dat ze op een server draaien, staan in de lijst.',

    'version' => 'Versie',
    'version_helper' => 'De gameversie en de loader staan bij elke regel. Kies de loader die de egg van deze server al draait — dit installeert bestanden en verandert je egg of je startcommando niet.',

    'downloads' => 'downloads',

    'install' => 'Dit pack installeren',
    'install_go' => 'Installeren',
    'install_confirm' => 'De bestanden van het pack worden aan deze server toegevoegd. **Er wordt niets verwijderd** — niet je wereld, niet je oude mods, geen enkele config. Een pack dat over een ander heen wordt gezet, laat beide staan, dus verwijder de mods van het vorige pack eerst zelf als je dat wilt. De server moet gestopt zijn, en blijft gestopt.',

    'started' => 'Bezig met installeren',
    'started_helper' => 'Het pack wordt opgehaald en uitgepakt. Een paar honderd bestanden kost een paar minuten, en je krijgt een melding als het klaar is — het gaat door als je deze pagina verlaat.',

    'running' => 'De server draait',
    'running_helper' => 'Minecraft laadt zijn mods bij het starten, dus een pack dat nu wordt geïnstalleerd laat een server achter die noch het oude noch het nieuwe pack is totdat hij herstart. Stop hem en probeer het opnieuw.',

    'done' => ':pack geïnstalleerd',
    'done_body' => ':files bestanden opgehaald en :overrides onderdelen uit de eigen map van het pack op hun plek gezet. Start de server wanneer je zover bent.',
    'done_refused' => ':count bestanden zijn overgeslagen omdat het pack ze opvroeg van een plek waar hier niet vandaan wordt gedownload.',

    'failed' => 'Het pack is niet geïnstalleerd',
    'failed_fetch' => 'Het pack kon niet worden opgehaald of uitgepakt. Mogelijk is de daemon onbereikbaar, of is de schijf van de server vol.',
    'failed_index' => 'Het pack is opgehaald maar bevatte geen leesbare index, dus er was niets om te installeren.',
    'failed_version' => 'Bij die versie hoort geen bestand meer om te downloaden. Kies een andere.',
    'failed_queue' => 'De installatie kon niet in de wachtrij worden gezet. Hiervoor moet er een queue worker op het panel draaien.',
];
