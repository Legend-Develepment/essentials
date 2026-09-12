<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Egg» och «allokering» står kvar: det är orden i Pelican, och det är dem man
 * letar efter på nodsidan.
 */

return [
    'title' => 'Duplicera en server',
    'nav_label' => 'Duplicera server',
    'subheading' => 'Ännu en server uppsatt precis som en du redan har, eller flera på en gång.',

    'section' => 'Vad som kopieras',
    'section_helper' => 'Ägaren, egget, startkommandot, gränserna och varenda variabel kopieras. Filer, databaser, säkerhetskopior och scheman gör det inte - en kopia av en körande servers filer är en kopia av dess tillstånd, och det är sällan vad «en till som den här» betyder.',

    'source' => 'Kopiera från',
    'source_helper' => 'Kopiorna hamnar på samma nod som den här servern, för det är där dess lediga adresser finns.',

    'name' => 'Namnge kopian',
    'name_helper' => 'Gör du fler än en numreras de: ”Bot 1”, ”Bot 2”, och så vidare.',

    'copies' => 'Hur många',
    'copies_helper' => 'Välj en server först.',
    'room' => ':count lediga adresser på :node, så fler än så går inte att göra just nu.',
    'no_room' => 'Det finns ingen ledig adress kvar på :node. En kopia behöver en egen, så lägg till en allokering på den noden först.',

    /*
     * Räknade i stället för uppräknade för de lyckade, och uppräknade för de
     * misslyckade - och det är det hållet som hjälper: tio namn som gick bra är
     * en vägg av text ingen läser, och det ena som inte gick är det enda som är
     * värt att läsa.
     */
    'made' => ':count kopior gjorda',
    'partly_failed' => ':count kopior kunde inte göras',
    'failed' => 'Ingenting kopierades',
];
