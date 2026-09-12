<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Subuser", „Wings", „SFTP", „cron" og „queue worker" bliver stående på
 * engelsk: det er under de navne, man finder dem i Pelican og på værten, og det
 * er præcis det, man skal vide, når en af disse linjer dukker op.
 */

return [
    'nav_label' => 'Serveradgang',
    'title' => 'Servere efter rolle',
    'subheading' => 'Giv alle med en rolle adgang til de samme servere.',

    /*
     * Sagt før alt andet på siden, for det her er den eneste funktion, der
     * skriver i en tabel, Pelican ejer.
     */
    'more' => 'Sådan virker det',
    'warning' => 'Det virker ved at holde Pelicans egne subusers ajour - de samme rækker, du selv ville tilføje i hånden på en servers Brugere-side, og dem, serverlisten, hver rettighedskontrol og Wings allerede læser. Der røres kun ved rækker, den selv har oprettet: det, du har lagt ind i hånden, bliver aldrig ændret eller fjernet. Ingen får en mail, når en rolle giver dem en server. At tage adgangen væk tilbagekalder også deres SFTP, og det kræver den queue worker, Pelican i forvejen beder om.',

    'never' => 'Der er endnu ikke afstemt noget. Gem en tilknytning nedenfor, så sker det med det samme, og derefter hvert minut via panelets egen cron.',
    'timing' => 'Adgangen tages væk i det øjeblik, den skal: den, der mister en rolle, mister serverne på den allernæste side. At give adgang kan tage op til et minut, for det er det gennemløb, der leder efter dem, der ikke bruger panelet lige nu.',
    'last_run' => 'Seneste gennemløb for :ago sekunder siden: :added tilføjet, :removed fjernet, :held ladt stå.',
    'capped' => 'For meget på én gang - :pairs tildelinger, og grænsen er :max. Der blev ikke skrevet noget. Snævr en tilknytning ind: en rolle med halvtreds folk og tyve servere er tusind tildelinger helt alene.',

    'which' => 'Tilknytningerne',
    'which_helper' => 'En rolle, de servere alle med den skal kunne nå, og hvad de må derinde. Er man i to roller, får man alt, hvad begge giver. Serverejere og root-administratorer springes over - de har allerede mere, end det her kunne give dem.',
    'add' => 'Tilføj en rolle',

    'role' => 'Rolle',
    'role_helper' => 'Alle med den, også dem, der får den senere.',
    'servers' => 'Servere',
    'servers_helper' => 'De servere, de får. At fjerne en herfra tager den adgang væk igen.',

    'permissions' => 'Hvad de må',
    'permissions_helper' => 'Pelicans egne subuser-rettigheder. Lad dem stå, som de er, for et fornuftigt sæt: konsollen, strømknapperne, filerne, sikkerhedskopierne og aktivitetsloggen - og intet, der retter i serveren, dens brugere, dens databaser eller dens tildelinger. „Connect to websocket" er altid med, for uden den forbinder konsolsiden til ingenting.',

    'save' => 'Gem og anvend',
    'saved' => 'Gemt',
    'saved_body' => ':added givet, :removed taget tilbage.',
    'save_failed' => 'Kunne ikke gemme',
    'save_failed_disk' => 'Listen kunne ikke skrives til storage. Tjek, at storage/app tilhører den bruger, panelet kører som.',

    'revoke' => 'Tag det hele tilbage',
    'revoke_confirm' => 'Fjern alt, det her har givet?',
    'revoke_confirm_helper' => 'Hver eneste subuser-række, denne side har oprettet, på hver server, for alle - og deres SFTP med. Rækker, du har lagt ind i hånden, røres ikke. Tilknytningerne nedenfor bliver stående, så næste gemning eller næste gennemløb ville give dem igen: tøm listen først, hvis du mener det for alvor.',
    'revoked' => ':count fjernet',
    'revoked_body' => 'Kun rækker, denne side selv havde oprettet. Det, der er lagt ind i hånden, står, hvor det stod.',
    'revoke_failed' => 'Kunne ikke fjerne dem',
];
