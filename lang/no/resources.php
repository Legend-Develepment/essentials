<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Mod», «plugin», «loader», «jar» og mappenavnene mods/ og plugins/ blir
 * stående som de er: det er de ordene som står på Modrinth, i filbehandleren og
 * i enhver veiledning man finner om det.
 */

return [
    'nav_label' => 'Mods og plugins',
    'title' => 'Mods og plugins',
    'subheading' => 'Ett om gangen, fra Modrinth, inn på denne serveren.',

    'section' => 'Finn noe',
    'section_helper' => 'Siden med modpakker installerer en hel pakke på én gang. Her installeres én enkelt mod eller ett enkelt plugin — og det er det man vil ha langt oftere.',

    'kind' => 'Hva legger du til',
    /*
     * Spurt framfor regnet ut. Et egg heter det en administrator har kalt det,
     * og flere loadere leser begge mappene, så herfra finnes det ingen ærlig
     * måte å gjette det på - og en feil gjetning skriver en jar ned i en mappe
     * ingen leser.
     */
    'kind_helper' => 'En mod går i mods/ og er for Fabric, Forge eller NeoForge. Et plugin går i plugins/ og er for Bukkit, Spigot eller Paper. Det avgjør også hvilken halvdel av Modrinth det søkes i.',
    'kind_mod' => 'En mod (mods/)',
    'kind_plugin' => 'Et plugin (plugins/)',

    'search' => 'Søk',
    'search_helper' => 'Skriv et navn, og klikk bort fra feltet. Resultatene kommer etter antall nedlastinger.',

    'project' => 'Mod eller plugin',
    'version' => 'Versjon',
    'version_helper' => 'Hver linje har versjonsnummeret, de Minecraft-versjonene den er bygd for, og de loaderne den støtter. Velg en som passer til serveren din — her er det ingen som sjekker det for deg.',

    'install' => 'Installer',
    'install_confirm' => 'Filen hentes av noden rett fra Modrinth og legges i mappen. Ingenting av det som allerede ligger der, blir fjernet.',
    'installed' => 'Installert',
    'installed_helper' => 'Den lastes neste gang serveren starter.',

    'change' => 'Bytt versjon',
    'change_helper' => 'Setter en annen versjon av det samme prosjektet i stedet for denne filen. Den nye lastes ned før den gamle slettes, så en nedlasting som slår feil, etterlater deg med det du allerede hadde.',
    'change_project_helper' => 'Fast for alt som er installert fra denne siden. Å endre det ville ikke vært et versjonsbytte — det ville vært en annen mod under det samme filnavnet.',
    'change_lookup_helper' => 'Denne filen lå allerede i mappen, så her vet ingen hva den er. Søk den fram én gang, så blir det husket.',
    'changed' => 'Versjon byttet',

    'check' => 'Se etter oppdateringer',
    'checked' => 'Sjekket',
    'checked_none' => 'Alt det kjente er på sin nyeste versjon.',
    'checked_some' => ':count har en nyere versjon. De er merket i listen.',
    'update_ready' => 'v:number klar',
    /*
     * Sagt ved siden av merket framfor i en boble, fordi det endrer hva merket
     * betyr: her vet ingen hvilken Minecraft-versjon eller hvilken loader
     * serveren kjører.
     */
    'check_note' => 'Nyere betyr nyere på Modrinth. Her vet ingen hvilken Minecraft-versjon eller hvilken loader serveren din kjører, så sjekk at den versjonen du velger sier den passer, før du starter serveren.',
    'unknown' => 'Ikke installert herfra — bruk «Bytt versjon» for å si hva det er',

    'remove' => 'Fjern',
    'remove_confirm' => 'Filen slettes fra serveren. Det kan ikke angres herfra.',
    'removed' => 'Fjernet',

    'running' => 'Serveren kjører',
    'running_helper' => 'Minecraft leser mods/ og plugins/ én gang, når det starter. En fil lagt inn nå ville først blitt lastet etter en omstart, og en som trekkes bort under et spill som kjører, kan ta spillet med seg. Stopp serveren først.',

    'failed' => 'Det virket ikke',
    'failed_version' => 'Den versjonen har ingen jar dette kan installere. Noen utgivelser inneholder bare kildekode, eller bare en klientbygg.',
    'failed_write' => 'Noden avviste nedlastingen. Den fikk kanskje ikke tak i Modrinth.',

    'installed_title' => 'Installert',
    'installed_mods' => 'I mods/',
    'installed_plugins' => 'I plugins/',
    /*
     * Sagt fordi en tom liste er tvetydig: den betyr som regel at denne serveren
     * ikke bruker den mappen i det hele tatt, ikke at noe mangler.
     */
    'installed_empty' => 'Her er det ingenting. En server bruker bare én av disse to mappene, så at den ene er tom, er normalt.',
    'installed_note' => 'Bare .jar-filer står på listen. Konfigurasjonsmapper og avslåtte filer blir latt i fred og vises ikke.',
];
