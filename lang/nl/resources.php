<?php

/*
 * Nederlands.
 *
 * "Mod", "plugin", "jar" en de mapnamen mods/ en plugins/ blijven staan. Dat
 * zijn geen Engelse woorden die vertaald moeten worden maar de namen van
 * dingen die op de server precies zo heten.
 */

return [
    'nav_label' => 'Mods & plugins',
    'title' => 'Mods en plugins',
    'subheading' => 'Eén tegelijk, van Modrinth, naar deze server.',

    'section' => 'Iets zoeken',
    'section_helper' => 'De modpack-pagina installeert een heel pack in één keer. Dit installeert één mod of plugin, en dat is wat je veel vaker wilt.',

    'kind' => 'Wat voeg je toe',
    'kind_helper' => 'Een mod gaat naar mods/ en is voor Fabric, Forge of NeoForge. Een plugin gaat naar plugins/ en is voor Bukkit, Spigot of Paper. Dit bepaalt ook welke helft van Modrinth wordt doorzocht.',
    'kind_mod' => 'Een mod (mods/)',
    'kind_plugin' => 'Een plugin (plugins/)',

    'search' => 'Zoeken',
    'search_helper' => 'Typ een naam en klik ergens anders. De meest gedownloade staan bovenaan.',

    'project' => 'Mod of plugin',
    'version' => 'Versie',
    'version_helper' => 'Elke regel toont het versienummer, de Minecraft-versies waarvoor hij gebouwd is en de loaders die hij ondersteunt. Kies er een die bij je server past — dat wordt hier niet voor je gecontroleerd.',

    'install' => 'Installeren',
    'install_confirm' => 'De node haalt het bestand rechtstreeks bij Modrinth op en zet het in de map. Wat er al staat, blijft staan.',
    'installed' => 'Geïnstalleerd',
    'installed_helper' => 'Het wordt geladen de volgende keer dat de server start.',

    'change' => 'Versie wijzigen',
    'change_helper' => 'Zet een andere versie van hetzelfde project in de plaats van dit bestand. De nieuwe wordt gedownload voordat de oude wordt verwijderd, dus een mislukte download laat je met wat je al had.',
    'change_project_helper' => 'Vastgezet voor alles wat via deze pagina is geïnstalleerd. Het wijzigen zou geen versiewissel zijn — het zou een andere mod onder dezelfde bestandsnaam zijn.',
    'change_lookup_helper' => 'Dit bestand stond al in de map, dus hier is niet bekend wat het is. Zoek het één keer op en het wordt onthouden.',
    'changed' => 'Versie gewijzigd',

    'check' => 'Controleren op updates',
    'checked' => 'Gecontroleerd',
    'checked_none' => 'Alles wat bekend is, staat op de nieuwste versie.',
    'checked_some' => 'Van :count is er een nieuwere versie. Ze zijn in de lijst gemarkeerd.',
    'update_ready' => 'v:number beschikbaar',
    'check_note' => 'Nieuwer betekent nieuwer op Modrinth. Hier is niet bekend welke Minecraft-versie of loader jouw server draait, dus controleer zelf of de versie die je kiest past voordat je de server start.',
    'unknown' => 'Niet hiervandaan — gebruik Versie wijzigen om te zeggen wat het is',

    'remove' => 'Verwijderen',
    'remove_confirm' => 'Het bestand wordt van de server verwijderd. Dat is hiervandaan niet ongedaan te maken.',
    'removed' => 'Verwijderd',

    'running' => 'De server draait',
    'running_helper' => 'Minecraft leest mods/ en plugins/ één keer, bij het starten. Een bestand dat je nu toevoegt wordt pas na een herstart geladen, en een bestand dat je onder een draaiende game vandaan haalt kan de game meenemen. Stop de server eerst.',

    'failed' => 'Dat is niet gelukt',
    'failed_version' => 'Bij die versie zit geen jar die hier te installeren is. Sommige releases bevatten alleen broncode, of alleen een client-build.',
    'failed_write' => 'De node weigerde de download. Mogelijk kon hij Modrinth niet bereiken.',

    'installed_title' => 'Geïnstalleerd',
    'installed_mods' => 'In mods/',
    'installed_plugins' => 'In plugins/',
    'installed_empty' => 'Hier staat niets. Een server gebruikt maar één van deze twee mappen, dus dat er één leeg is, is normaal.',
    'installed_note' => 'Alleen .jar-bestanden staan in de lijst. Configuratiemappen en uitgeschakelde bestanden blijven met rust en worden niet getoond.',
];
