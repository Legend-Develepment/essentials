<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Modpack», «mod» och «loader» står kvar: det är orden på Modrinth och i
 * spelet, och det är dem man söker efter.
 */

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Installera ett modpack från Modrinth på den här servern.',

    'section' => 'Hitta ett pack',
    'section_helper' => 'Bara Modrinth, och bara pack som körs på serversidan. Det kräver varken konto eller API-nyckel, och det är därför det är den enda källan här — de andra vill var och en ha en nyckel inklistrad innan något alls dyker upp.',

    'search' => 'Sök',
    'search_helper' => 'Lämna tomt för de mest nedladdade. Att söka frågar Modrinth, så det sker när du lämnar fältet i stället för medan du skriver.',

    'pack' => 'Pack',
    'pack_helper' => 'Bara pack som säger att de körs på en server listas.',

    'version' => 'Version',
    'version_helper' => 'Spelversionen och loadern visas bredvid var och en. Välj den loader serverns egg redan kör — det här installerar filer och ändrar varken ditt egg eller ditt startkommando.',

    'downloads' => 'nedladdningar',

    'install' => 'Installera det här packet',
    'install_go' => 'Installera det',
    'install_confirm' => 'Packets filer läggs till på den här servern. **Ingenting tas bort** — inte din värld, inte dina gamla mods, inte en konfigurationsfil. Ett pack installerat ovanpå ett annat lämnar kvar båda, så ta bort det förra packets mods själv först om det är vad du vill. Servern måste vara stoppad, och den förblir stoppad.',

    'started' => 'Installerar',
    'started_helper' => 'Packet hämtas och packas upp. Några hundra filer tar några minuter, och du får en avisering när det är klart — det fortsätter även om du lämnar den här sidan.',

    'running' => 'Servern kör',
    'running_helper' => 'Minecraft laddar sina mods när det startar, så ett pack som installeras nu skulle lämna en server som varken är det gamla packet eller det nya förrän den startar om. Stoppa den och försök igen.',

    'done' => ':pack installerat',
    'done_body' => ':files filer hämtade och :overrides saker ur packets egen mapp lagda på plats. Starta servern när du är redo.',
    'done_refused' => ':count filer hoppades över för att packet bad om dem från ett ställe det här inte laddar ner från.',

    'failed' => 'Packet installerades inte',
    'failed_fetch' => 'Packet gick inte att hämta eller packa upp. Daemonen kanske inte går att nå, eller så är servern slut på diskutrymme.',
    'failed_index' => 'Packet hämtades men hade inget läsbart index i sig, så det fanns ingenting att installera.',
    'failed_version' => 'Den versionen har ingen packfil att ladda ner längre. Välj en annan.',
    'failed_queue' => 'Installationen kunde inte köas. Det här kräver att en queue worker kör på panelen.',
];
