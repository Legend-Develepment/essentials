<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Mod», «plugin», «loader», «jar» och mappnamnen mods/ och plugins/ står kvar:
 * det är precis det som står på Modrinth och i serverns filträd.
 */

return [
    'nav_label' => 'Mods & plugins',
    'title' => 'Mods och plugins',
    'subheading' => 'En i taget, från Modrinth, in i den här servern.',

    'section' => 'Hitta något',
    'section_helper' => 'Modpack-sidan installerar ett helt pack på en gång. Det här installerar en enda mod eller ett enda plugin, vilket är det man vill betydligt oftare.',

    'kind' => 'Vad lägger du till',
    /*
     * Frågat i stället för uträknat. Ett egg heter vad en administratör har
     * döpt det till, och flera loaders läser båda mapparna, så det finns inget
     * ärligt sätt att gissa det härifrån - och en felgissning skriver en jar
     * till en mapp ingenting läser.
     */
    'kind_helper' => 'En mod hamnar i mods/ och är till Fabric, Forge eller NeoForge. Ett plugin hamnar i plugins/ och är till Bukkit, Spigot eller Paper. Det avgör också vilken halva av Modrinth som söks igenom.',
    'kind_mod' => 'En mod (mods/)',
    'kind_plugin' => 'Ett plugin (plugins/)',

    'search' => 'Sök',
    'search_helper' => 'Skriv ett namn och klicka utanför rutan. Träffarna kommer med de mest nedladdade först.',

    'project' => 'Mod eller plugin',
    'version' => 'Version',
    'version_helper' => 'Varje rad är versionsnumret, de Minecraft-versioner den är byggd för, och de loaders den stödjer. Välj en som passar din server — ingenting här kontrollerar det åt dig.',

    'install' => 'Installera',
    'install_confirm' => 'Filen hämtas av noden direkt från Modrinth och läggs i mappen. Ingenting som redan finns där tas bort.',
    'installed' => 'Installerad',
    'installed_helper' => 'Den laddas nästa gång servern startar.',

    'change' => 'Byt version',
    'change_helper' => 'Sätter en annan version av samma projekt i stället för den här filen. Den nya laddas ner innan den gamla tas bort, så en nedladdning som misslyckas lämnar dig med det du redan hade.',
    'change_project_helper' => 'Låst för allt som installerats från den här sidan. Att ändra det vore inte ett versionsbyte — det vore en annan mod under samma filnamn.',
    'change_lookup_helper' => 'Den här filen låg redan i mappen, så ingenting här vet vad den är. Sök upp den en gång så kommer det ihågas.',
    'changed' => 'Versionen bytt',

    'check' => 'Leta efter uppdateringar',
    'checked' => 'Kontrollerat',
    'checked_none' => 'Allt som är känt kör sin senaste version.',
    'checked_some' => ':count har en nyare version. De är markerade i listan.',
    'update_ready' => 'v:number finns',
    /*
     * Sagt bredvid märket i stället för i en tipsruta, för det ändrar vad
     * märket betyder. Ingenting här vet vilken Minecraft-version eller vilken
     * loader servern kör, så nyast är nyast och inte nyast som fungerar.
     */
    'check_note' => 'Nyare betyder nyare på Modrinth. Ingenting här vet vilken Minecraft-version eller vilken loader din server kör, så kontrollera att den version du väljer säger att den passar innan du startar servern.',
    'unknown' => 'Inte härifrån — använd Byt version för att säga vad den är',

    'remove' => 'Ta bort',
    'remove_confirm' => 'Filen tas bort från servern. Det går inte att ångra härifrån.',
    'removed' => 'Borttagen',

    'running' => 'Servern kör',
    'running_helper' => 'Minecraft läser mods/ och plugins/ en gång, när det startar. En fil som läggs till nu skulle inte laddas förrän efter en omstart, och en som rycks undan ett spel som kör kan ta spelet med sig. Stoppa servern först.',

    'failed' => 'Det gick inte',
    'failed_version' => 'Den versionen har ingen jar som det här kan installera. Vissa utgåvor bär bara källkod, eller bara ett klientbygge.',
    'failed_write' => 'Noden nekade nedladdningen. Den kanske inte kunde nå Modrinth.',

    'installed_title' => 'Installerat',
    'installed_mods' => 'I mods/',
    'installed_plugins' => 'I plugins/',
    /*
     * Sagt för att en tom lista är tvetydig: den betyder oftast att den här
     * servern inte använder den mappen alls, och inte att något saknas.
     */
    'installed_empty' => 'Ingenting här. En server använder bara en av de här två mapparna, så att en är tom är normalt.',
    'installed_note' => 'Bara .jar-filer listas. Konfigurationsmappar och avstängda filer lämnas i fred och visas inte.',
];
