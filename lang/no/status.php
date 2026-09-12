<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Den offentlige statussiden.
 *
 * Det eneste dette pluginet serverer til noen som ikke er logget inn, og den
 * eneste siden hvis ord må leses som om en fremmed vil se dem - for det vil en.
 * Ingenting her sier hvilken node, hvilken eier eller hvilken adresse; et navn,
 * om det kjører, og hvor mange som er på.
 *
 * «Node» opptrer bare i innstillingene; på selve den offentlige siden står det
 * «maskin», for der leses det av noen som aldri har hørt om Pelican.
 */

return [
    // ---- innstillingssiden ------------------------------------------------
    'title' => 'Offentlig statusside',
    'nav_label' => 'Statusside',
    'subheading' => 'En side hvem som helst kan åpne uten en konto, som viser hvilke av serverne dine som kjører. Det dukker ikke opp noe på den før du nevner en server nedenfor.',

    'address' => 'Statussiden din er oppe på',
    'address_off' => 'Ingenting serveres ennå. Legg til en server, en maskin eller en tjeneste nedenfor og lagre, så dukker adressen opp her.',

    'which' => 'Hva som offentliggjøres',
    'which_helper' => 'Listen starter tom, og ingenting er offentlig før det står noe på den. Bare servere du allerede kan åpne, blir tilbudt.',
    'add' => 'Offentliggjør en server',
    'server' => 'Server',
    'shown_as' => 'Vises som',
    'shown_as_helper' => 'Det publikum ser. Skriv det selv framfor å la panelet bruke det ekte navnet - «mc-prod-3 (ikke rør)» er en huskelapp til deg selv, ikke noe man legger på et forum.',

    'look' => 'Ordlyd',
    'look_helper' => 'Alt på denne siden leses av folk som ikke har en konto.',
    'heading' => 'Overskrift',
    'heading_helper' => 'Står det tomt, brukes panelets eget navn.',
    'note' => 'En linje over listen',
    'note_helper' => 'Til å si hva som foregår - et vedlikeholdsvindu, eller hvor man kan spørre. Vanlig tekst.',
    'link' => 'Lenke til panelet',
    'link_helper' => 'En vei tilbake inn, nederst på siden. Slå den av hvis du helst ikke vil røpe hvor panelet ditt står.',

    'save' => 'Lagre',
    'saved' => 'Lagret',
    'save_failed' => 'Ingenting ble lagret',
    'open' => 'Åpne siden',

    // ---- spillertall ------------------------------------------------------
    'counts' => 'Spillertall',
    'counts_helper' => 'Hvor tallene ved siden av en server kommer fra. Minecraft-servere svarer på sitt eget håndtrykk og settes opp under Minecraft; alt nedenfor gjelder de spillene som svarer på Valves forespørsel - Rust, ARK, Valheim, 7 Days to Die og det meste andre som kjører på Source eller Unreal.',
    'query_eggs' => 'Eggs som svarer på Valves forespørsel',
    'query_eggs_helper' => 'Kryss av for eggene til de spillene. Den samme listen avgjør også hvilke servere som får en Spillere-side inne i panelet - ett spørsmål stilt av to grunner. Ingenting blir spurt om før du sier fra: dette er det eneste her som åpner en forbindelse fra panelet rett til en spillport, så det er et valg og ikke noe som begynner av seg selv. En server hvis port ikke kan nås fra panelet, viser rett og slett ingen tall.',

    // ---- nodene -----------------------------------------------------------
    'nodes' => 'Maskiner',
    'nodes_helper' => 'Oppe eller nede, og ikke noe annet. Ikke belastningen og ikke hvor full disken er - den som spør om han kan spille, trenger ingen kapasitetsrapport over maskinvaren din, og å offentliggjøre en er et kart over hvor det strammer.',
    'add_node' => 'Offentliggjør en maskin',
    'node' => 'Maskin',
    'node_shown_as_helper' => 'Skriv det selv. En node heter som regel noe i retning av hetzner-fsn1-01, og det er en hel setning om hvor maskinene dine står.',

    // ---- HTTP-overvåkinger ------------------------------------------------
    'monitors' => 'Andre tjenester',
    'monitors_helper' => 'Alt annet det er verdt å vite er oppe: nettstedet ditt, et API, en bots health-endepunkt. Panelet spør hver av dem i samme takt som serverne. Bare administratorer - en overvåking får dette panelet til å hente en adresse, og lar man hvem som helst legge til en, blir den til en sonde man kan peke dit man vil.',
    'add_monitor' => 'Legg til en tjeneste',
    'monitor_name' => 'Navn',
    'monitor_url' => 'Adresse',
    'monitor_url_helper' => 'Bare https. Hvis dette panelet hentet vanlig http med jevne mellomrom, ville alle på veien visst hvilke av tjenestene dine som finnes.',
    'monitor_expect' => 'Forventer',
    'monitor_expect_helper' => 'La feltet stå tomt for «et hvilket som helst svar», noe som passer et nettsted som videresender eller svarer 403 på en naken forespørsel. Et tall er til et endepunkt som er skrevet for å si nøyaktig det og ingenting annet - settes det for stramt, står raden rød for alltid ved en tjeneste det ikke er noe galt med.',

    // ---- sider til brukerne -----------------------------------------------
    'users' => 'Sider til brukerne dine',
    'users_helper' => 'Om folk med servere på dette panelet får offentliggjøre sin egen statusside.',
    'user_pages' => 'La brukerne lage sin egen',
    'user_pages_helper' => 'Hver får sin egen adresse på /status/navnet-deres, der bare serverne de eier står, under de navnene de selv skriver. Ingen maskiner og ingen andre tjenester på dem - begge deler er dine alene. Når dette er på, finner de det under Statusside i kontomenyen sin, i hvilket panel de nå enn er.',

    // ---- utseendet --------------------------------------------------------
    'every' => 'Sjekk hvert',
    'every_helper' => 'Hvor ofte siden bygges på nytt, og hvor ofte den oppdaterer seg selv i nettleseren. En side folk ser på under en omstart, vil ha sekunder; en som er lenket fra et forum og som ingen har åpen, vil ha en time, og å spørre hver node hvert minutt for dens skyld er arbeid gjort for ingen.',
    'every_realtime' => 'Sanntid (10 sekunder)',
    'every_30s' => '30 sekunder',
    'every_1m' => '1 minutt',
    'every_5m' => '5 minutter',
    'every_10m' => '10 minutter',
    'every_30m' => '30 minutter',
    'every_60m' => '60 minutter',

    'style' => 'Stil',
    'style_helper' => 'Ett av panelets egne utseender, lagt på denne siden: fargen dens, gråtonene bygd av flaten dens, og hvor runde hjørnene er. «Følg panelet» betyr den som er satt i dag, medregnet alt som endres senere.',
    'style_mine_helper' => 'De stilene dette panelet tilbyr, lagt på din side: en farge, gråtonene bygd av den, og hvor runde hjørnene er. Hvilke stiler som står på listen, er panelets eier som bestemmer - den samme listen du kan velge fra under Utseende. «Følg panelet» betyr den som er satt.',
    'style_panel' => 'Følg panelet',

    // ---- ens egen side ----------------------------------------------------
    'mine_title' => 'Min statusside',
    'mine_nav_label' => 'Statusside',
    'mine_subheading' => 'Én adresse å gi de folkene som spiller på serverne dine. Den viser de serverne du velger, og ingenting annet om dette panelet.',
    'mine_address' => 'Adressen din',
    'mine_address_helper' => 'Velg noe kort. Å endre den senere ødelegger enhver lenke noen allerede har lagret.',
    'mine_address_off' => 'Velg en adresse nedenfor og lagre, så dukker siden din opp her.',
    'slug' => 'Adresse',
    'slug_helper' => 'Små bokstaver, tall og bindestreker. Tre tegn eller mer.',
    'mine_heading' => 'Overskrift',
    'mine_heading_helper' => 'Står det tomt, brukes adressen din.',
    'mine_note_helper' => 'Til å si hva som foregår - en omstart, et arrangement, hvor man finner deg. Vanlig tekst, og lest av alle med lenken.',
    'mine_which' => 'Serverne dine',
    'mine_which_helper' => 'Bare servere du selv eier, blir tilbudt. Å være subuser et annet sted er tilgang til en maskin, ikke lov til å offentliggjøre at den finnes.',
    'mine_shown_as_helper' => 'Det de besøkende ser. Skriv det selv framfor å bruke navnet fra panelet, hvis det navnet er en huskelapp til deg selv.',
    'mine_look_helper' => 'Hvordan siden din ser ut for de folkene du sender den til.',
    'mine_remove' => 'Ta ned siden min',
    'mine_remove_confirm' => 'Tar ned siden din og frigjør adressen til noen andre. Alt du har satt opp, går tapt; selve serverne blir ikke rørt.',
    'mine_removed' => 'Siden din er tatt ned',

    'why_slug' => 'Den adressen duger ikke. Små bokstaver, tall og bindestreker, tre tegn eller mer - og et par ord er reservert.',
    'why_taken' => 'Den adressen har noen andre allerede.',
    'why_unwritable' => 'Det kunne ikke skrives. Sjekk at storage/app tilhører den brukeren panelet kjører som.',

    // ---- overskrifter på selve siden --------------------------------------
    'section_servers' => 'Servere',
    'section_nodes' => 'Maskiner',
    'section_monitors' => 'Tjenester',

    // ---- selve siden ------------------------------------------------------
    'up' => 'Oppe',
    'down' => 'Nede',
    'starting' => 'Starter',

    /*
     * Ikke «nede», og forskjellen betyr noe offentlig.
     *
     * Panelet nådde ikke serveren. Det er som regel en node til vedlikehold
     * eller en daemon som starter på nytt - det er ikke det samme som at
     * serveren er slått av, og å fortelle hundre spillere at serveren deres er
     * nede mens den kjører, er verre enn å innrømme at man ikke vet.
     */
    'unknown' => 'Ukjent',

    'players' => 'Spillere',
    'online_now' => 'spiller akkurat nå',
    'checked' => 'Sjekket',
    'next_check' => 'til neste sjekk',
    'just_now' => 'akkurat nå',
    'seconds_ago' => 'for :count sekunder siden',
    'panel' => 'Logg inn',

    'all_up' => 'Alt kjører.',
    'some_down' => 'Noe kjører ikke.',
    'empty' => 'Det offentliggjøres ingenting her ennå.',
];
