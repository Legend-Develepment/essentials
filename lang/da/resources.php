<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Mod", „plugin", „loader", „jar" og mappenavnene mods/ og plugins/ bliver
 * stående, som de er: det er de ord, der står på Modrinth, i filhåndteringen og
 * i enhver vejledning, man finder om det.
 */

return [
    'nav_label' => 'Mods og plugins',
    'title' => 'Mods og plugins',
    'subheading' => 'Ét ad gangen, fra Modrinth, ind på denne server.',

    'section' => 'Find noget',
    'section_helper' => 'Siden med modpakker installerer en hel pakke på én gang. Her installeres et enkelt mod eller plugin - og det er det, man vil have langt oftere.',

    'kind' => 'Hvad tilføjer du',
    /*
     * Spurgt frem for regnet ud. Et egg hedder det, en administrator har kaldt
     * det, og flere loadere læser begge mapper, så herfra er der ingen ærlig
     * måde at gætte det på - og et forkert gæt skriver en jar ned i en mappe,
     * ingen læser.
     */
    'kind_helper' => 'Et mod ryger i mods/ og er til Fabric, Forge eller NeoForge. Et plugin ryger i plugins/ og er til Bukkit, Spigot eller Paper. Det afgør også, hvilken halvdel af Modrinth der søges i.',
    'kind_mod' => 'Et mod (mods/)',
    'kind_plugin' => 'Et plugin (plugins/)',

    'search' => 'Søg',
    'search_helper' => 'Skriv et navn, og klik væk fra feltet. Resultaterne kommer efter antal hentninger.',

    'project' => 'Mod eller plugin',
    'version' => 'Version',
    'version_helper' => 'Hver linje har versionsnummeret, de Minecraft-versioner den er bygget til, og de loadere den understøtter. Vælg en, der passer til din server - her er der ingen, der tjekker det for dig.',

    'install' => 'Installér',
    'install_confirm' => 'Filen hentes af noden direkte fra Modrinth og lægges i mappen. Intet af det, der allerede ligger der, bliver fjernet.',
    'installed' => 'Installeret',
    'installed_helper' => 'Den indlæses, næste gang serveren starter.',

    'change' => 'Skift version',
    'change_helper' => 'Sætter en anden version af det samme projekt i stedet for denne fil. Den nye hentes, før den gamle slettes, så en hentning, der slår fejl, efterlader dig med det, du allerede havde.',
    'change_project_helper' => 'Fast for alt, der er installeret fra denne side. At ændre det ville ikke være et versionsskift - det ville være et andet mod under samme filnavn.',
    'change_lookup_helper' => 'Denne fil lå allerede i mappen, så her ved ingen, hvad den er. Søg den frem én gang, så bliver det husket.',
    'changed' => 'Version skiftet',

    'check' => 'Søg efter opdateringer',
    'checked' => 'Tjekket',
    'checked_none' => 'Alt det kendte er på sin nyeste version.',
    'checked_some' => ':count har en nyere version. De er markeret på listen.',
    'update_ready' => 'v:number klar',
    /*
     * Sagt ved siden af mærket frem for i en boble, fordi det ændrer, hvad
     * mærket betyder: her ved ingen, hvilken Minecraft-version eller hvilken
     * loader serveren kører.
     */
    'check_note' => 'Nyere betyder nyere på Modrinth. Her ved ingen, hvilken Minecraft-version eller hvilken loader din server kører, så tjek, at den version, du vælger, siger, den passer, før du starter serveren.',
    'unknown' => 'Ikke installeret herfra - brug „Skift version" for at sige, hvad det er',

    'remove' => 'Fjern',
    'remove_confirm' => 'Filen slettes fra serveren. Det kan ikke fortrydes herfra.',
    'removed' => 'Fjernet',

    'running' => 'Serveren kører',
    'running_helper' => 'Minecraft læser mods/ og plugins/ én gang, når det starter. En fil lagt ind nu ville først blive indlæst efter en genstart, og en, der trækkes væk under et kørende spil, kan tage spillet med sig. Stop serveren først.',

    'failed' => 'Det virkede ikke',
    'failed_version' => 'Den version har ingen jar, det her kan installere. Nogle udgivelser rummer kun kildekode eller kun en klient-build.',
    'failed_write' => 'Noden afviste hentningen. Den har måske ikke kunnet nå Modrinth.',

    'installed_title' => 'Installeret',
    'installed_mods' => 'I mods/',
    'installed_plugins' => 'I plugins/',
    /*
     * Sagt, fordi en tom liste er tvetydig: den betyder som regel, at denne
     * server slet ikke bruger den mappe, ikke at der mangler noget.
     */
    'installed_empty' => 'Her er ingenting. En server bruger kun én af de to mapper, så at den ene er tom, er normalt.',
    'installed_note' => 'Kun .jar-filer står på listen. Konfigurationsmapper og slåede-fra filer bliver ladt i fred og vises ikke.',
];
