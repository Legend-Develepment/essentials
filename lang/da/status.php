<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Den offentlige statusside.
 *
 * Det eneste, dette plugin serverer til nogen, der ikke er logget ind, og den
 * eneste side, hvis ord skal læses, som om en fremmed vil se dem - for det vil
 * en. Intet her siger, hvilken node, hvilken ejer eller hvilken adresse; et
 * navn, om det kører, og hvor mange der er på.
 *
 * „Node" optræder kun i indstillingerne; på selve den offentlige side står der
 * „maskine", for der læses der af nogen, der aldrig har hørt om Pelican.
 */

return [
    // ---- indstillingssiden ------------------------------------------------
    'title' => 'Offentlig statusside',
    'nav_label' => 'Statusside',
    'subheading' => 'En side, hvem som helst kan åbne uden en konto, som viser, hvilke af dine servere der kører. Der dukker intet op på den, før du nævner en server nedenfor.',

    'address' => 'Din statusside er i luften på',
    'address_off' => 'Der serveres endnu ingenting. Læg en server, en maskine eller en tjeneste til nedenfor og gem, så dukker adressen op her.',

    'which' => 'Hvad der offentliggøres',
    'which_helper' => 'Listen starter tom, og intet er offentligt, før der står noget på den. Kun servere, du allerede kan åbne, bliver budt frem.',
    'add' => 'Offentliggør en server',
    'server' => 'Server',
    'shown_as' => 'Vises som',
    'shown_as_helper' => 'Det, offentligheden ser. Skriv det selv frem for at lade panelet bruge det rigtige navn - „mc-prod-3 (må ikke røres)" er en note til dig selv, ikke noget, man lægger på et forum.',

    'look' => 'Ordlyd',
    'look_helper' => 'Alt på denne side læses af folk, der ikke har en konto.',
    'heading' => 'Overskrift',
    'heading_helper' => 'Står det tomt, bruges panelets eget navn.',
    'note' => 'En linje over listen',
    'note_helper' => 'Til at sige, hvad der foregår - et servicevindue, eller hvor man kan spørge. Almindelig tekst.',
    'link' => 'Link til panelet',
    'link_helper' => 'En vej tilbage ind, nederst på siden. Slå det fra, hvis du helst ikke vil røbe, hvor dit panel står.',

    'save' => 'Gem',
    'saved' => 'Gemt',
    'save_failed' => 'Der blev ikke gemt noget',
    'open' => 'Åbn siden',

    // ---- spillertal -------------------------------------------------------
    'counts' => 'Spillertal',
    'counts_helper' => 'Hvor tallene ved siden af en server kommer fra. Minecraft-servere svarer på deres eget håndtryk og sættes op under Minecraft; alt herunder handler om de spil, der svarer på Valves forespørgsel - Rust, ARK, Valheim, 7 Days to Die og det meste andet, der kører på Source eller Unreal.',
    'query_eggs' => 'Eggs, der svarer på Valves forespørgsel',
    'query_eggs_helper' => 'Sæt hak ved eggs til de spil. Den samme liste afgør også, hvilke servere der får en Spillere-side inde i panelet - ét spørgsmål stillet af to grunde. Der spørges ikke om noget, før du siger til: det her er det eneste, der åbner en forbindelse fra panelet direkte til en spilport, så det er et valg og ikke noget, der begynder af sig selv. En server, hvis port ikke kan nås fra panelet, viser ganske enkelt intet tal.',

    // ---- noderne ----------------------------------------------------------
    'nodes' => 'Maskiner',
    'nodes_helper' => 'Oppe eller nede, og ikke andet. Ikke belastningen og ikke, hvor fuld disken er - den, der spørger, om han kan spille, har ikke brug for en kapacitetsrapport over dit jern, og at offentliggøre en er et kort over, hvor det strammer.',
    'add_node' => 'Offentliggør en maskine',
    'node' => 'Maskine',
    'node_shown_as_helper' => 'Skriv det selv. En node hedder som regel noget i retning af hetzner-fsn1-01, og det er en hel sætning om, hvor dine maskiner står.',

    // ---- HTTP-overvågninger -----------------------------------------------
    'monitors' => 'Andre tjenester',
    'monitors_helper' => 'Alt andet, det er værd at vide er oppe: dit websted, en API, en bots health-endpoint. Panelet spørger dem alle i samme takt som serverne. Kun administratorer - en overvågning får dette panel til at hente en adresse, og lader man hvem som helst tilføje en, bliver den til en sonde, man kan pege, hvorhen man vil.',
    'add_monitor' => 'Tilføj en tjeneste',
    'monitor_name' => 'Navn',
    'monitor_url' => 'Adresse',
    'monitor_url_helper' => 'Kun https. Hvis dette panel hentede almindelig http med jævne mellemrum, ville enhver på vejen vide, hvilke af dine tjenester der findes.',
    'monitor_expect' => 'Forventer',
    'monitor_expect_helper' => 'Lad feltet stå tomt for „et hvilket som helst svar", hvilket passer til et websted, der viderestiller eller svarer 403 på en nøgen forespørgsel. Et tal er til et endpoint, der er skrevet til at sige præcis det og intet andet - sættes det for stramt, står rækken rød for altid ved en tjeneste, der er helt i orden.',

    // ---- sider til brugerne -----------------------------------------------
    'users' => 'Sider til dine brugere',
    'users_helper' => 'Om folk med servere på dette panel må offentliggøre deres egen statusside.',
    'user_pages' => 'Lad brugerne lave deres egen',
    'user_pages_helper' => 'Hver får sin egen adresse på /status/deres-navn, hvor kun de servere, de ejer, står, under de navne, de selv skriver. Ingen maskiner og ingen andre tjenester på dem - begge dele er dine alene. Når det er slået til, finder de det under Statusside i deres kontomenu, i hvilket som helst panel de nu er i.',

    // ---- udseendet --------------------------------------------------------
    'every' => 'Tjek hvert',
    'every_helper' => 'Hvor tit siden bygges om, og hvor tit den opdaterer sig selv i browseren. En side, folk kigger på under en genstart, vil have sekunder; en, der er linket fra et forum, som ingen har åben, vil have en time, og at spørge hver node hvert minut for dens skyld er arbejde udført for ingen.',
    'every_realtime' => 'Realtid (10 sekunder)',
    'every_30s' => '30 sekunder',
    'every_1m' => '1 minut',
    'every_5m' => '5 minutter',
    'every_10m' => '10 minutter',
    'every_30m' => '30 minutter',
    'every_60m' => '60 minutter',

    'style' => 'Stil',
    'style_helper' => 'Et af panelets egne udseender, lagt på denne side: dets farve, de grå toner bygget af dets flade, og hvor runde hjørnerne er. „Følg panelet" betyder det, panelet er sat til i dag, inklusive alt, der ændres senere.',
    'style_mine_helper' => 'De stile, dette panel byder frem, lagt på din side: en farve, de grå toner bygget af den, og hvor runde hjørnerne er. Hvilke stile der står på listen, er panelets ejers valg - den samme liste, du kan vælge fra under Udseende. „Følg panelet" betyder det, panelet er sat til.',
    'style_panel' => 'Følg panelet',

    // ---- ens egen side ----------------------------------------------------
    'mine_title' => 'Min statusside',
    'mine_nav_label' => 'Statusside',
    'mine_subheading' => 'Én adresse at give de folk, der spiller på dine servere. Den viser de servere, du vælger, og intet andet om dette panel.',
    'mine_address' => 'Din adresse',
    'mine_address_helper' => 'Vælg noget kort. At ændre den senere ødelægger ethvert link, nogen allerede har gemt.',
    'mine_address_off' => 'Vælg en adresse nedenfor og gem, så dukker din side op her.',
    'slug' => 'Adresse',
    'slug_helper' => 'Små bogstaver, tal og bindestreger. Tre tegn eller mere.',
    'mine_heading' => 'Overskrift',
    'mine_heading_helper' => 'Står det tomt, bruges din adresse.',
    'mine_note_helper' => 'Til at sige, hvad der foregår - en genstart, et arrangement, hvor man finder dig. Almindelig tekst, og læst af enhver med linket.',
    'mine_which' => 'Dine servere',
    'mine_which_helper' => 'Kun servere, du selv ejer, bliver budt frem. At være subuser et andet sted er adgang til en maskine, ikke lov til at offentliggøre, at den findes.',
    'mine_shown_as_helper' => 'Det, de besøgende ser. Skriv det selv frem for at bruge navnet fra panelet, hvis det navn er en note til dig selv.',
    'mine_look_helper' => 'Hvordan din side ser ud for de folk, du sender den til.',
    'mine_remove' => 'Tag min side ned',
    'mine_remove_confirm' => 'Tager din side ned og frigiver adressen til en anden. Alt, du har sat op, går tabt; selve serverne bliver ikke rørt.',
    'mine_removed' => 'Din side er taget ned',

    'why_slug' => 'Den adresse duer ikke. Små bogstaver, tal og bindestreger, tre tegn eller mere - og et par ord er reserveret.',
    'why_taken' => 'Den adresse har en anden allerede.',
    'why_unwritable' => 'Det kunne ikke skrives. Tjek, at storage/app tilhører den bruger, panelet kører som.',

    // ---- overskrifter på selve siden --------------------------------------
    'section_servers' => 'Servere',
    'section_nodes' => 'Maskiner',
    'section_monitors' => 'Tjenester',

    // ---- selve siden ------------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Starter',

    /*
     * Ikke „offline", og forskellen betyder noget offentligt.
     *
     * Panelet kunne ikke nå serveren. Det er som regel en node til
     * vedligeholdelse eller en daemon, der genstarter - det er ikke det samme
     * som, at serveren er slukket, og at fortælle hundrede spillere, at deres
     * server er nede, mens den kører, er værre end at indrømme, at man ikke ved
     * det.
     */
    'unknown' => 'Ukendt',

    'players' => 'Spillere',
    'online_now' => 'spiller lige nu',
    'checked' => 'Tjekket',
    'next_check' => 'til næste tjek',
    'just_now' => 'lige nu',
    'seconds_ago' => 'for :count sekunder siden',
    'panel' => 'Log ind',

    'all_up' => 'Alt kører.',
    'some_down' => 'Noget kører ikke.',
    'empty' => 'Der offentliggøres endnu ingenting her.',
];
