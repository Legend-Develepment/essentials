<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Pakker: en server, nogen kan købe.
 *
 * Læses af den, der indretter butikken. Hvert ord her handler om skabelonen og
 * prisen; det, en kunde ser, står i shop.php, fordi de to læsere vil have
 * forskellige sætninger om den samme række.
 *
 * „egg", „node", „swap", „io" og Minecraft-ordene bliver på engelsk: det er
 * ordene på Pelicans egen serverformular, og en pakke er den formular gemt til
 * senere.
 */

return [
    'title' => 'Pakker',
    'nav_label' => 'Pakker',
    'subheading' => 'Det, der er til salg. Hver er en serverskabelon med en pris på; en kunde køber en, og panelet opretter serveren.',

    // ---- tabellen --------------------------------------------------------
    'column_name' => 'Pakke',
    'column_flags' => 'Flag',
    'column_flags_from' => 'fra :count',
    'column_egg' => 'Egg',
    'column_price' => 'Pris',
    'column_stock' => 'Lager',
    'column_live' => 'Til salg',
    'column_orders' => 'Solgt',

    'live' => 'Til salg',
    'offline' => 'Ikke til salg',
    'no_egg' => 'Intet egg - kan ikke bygges',

    'stock_unlimited' => 'Ubegrænset',
    'stock_left' => ':count tilbage',
    'stock_out' => 'Udsolgt',

    // ---- perioder --------------------------------------------------------
    'period_once' => 'Engangs',
    'period_month' => 'Månedligt',
    'period_quarter' => 'Kvartalsvis',
    'period_year' => 'Årligt',

    // Efter en pris: „12,50 € om måneden".
    'per_once' => 'én gang',
    'per_month' => 'om måneden',
    'per_quarter' => 'i kvartalet',
    'per_year' => 'om året',

    // ---- handlinger ------------------------------------------------------
    'new' => 'Ny pakke',
    'edit' => 'Rediger',
    'duplicate' => 'Dupliker',
    'copy_suffix' => ' (kopi)',
    'go_live' => 'Sæt til salg',
    'go_offline' => 'Tag af salg',
    'delete' => 'Slet',
    'delete_confirm' => 'Fjerner pakken. Det, der allerede er købt, røres ikke - ordrer beholder deres egen kopi af, hvad de var.',
    'delete_confirm_sold' => 'Den er solgt :count gange. De ydelser røres ikke: en ordre bærer sin egen kopi af alt, den blev solgt med, så serverne kører videre, og fakturaerne bliver ved med at sige, hvad der blev købt. Kun billedet på deres ydelseskort forsvinder, og pakken bliver ikke udbudt længere.',
    'delete_refused' => 'Ikke slettet',
    'delete_refused_body' => 'Der er afgivet ordrer på denne pakke, og de peger på den. Tag den af salg i stedet; den bliver til arkivet, og ingen kan købe den.',
    'deleted' => 'Pakke slettet',
    'deleted_sold' => 'De :count ydelser, der er solgt fra den, er urørte og kører stadig.',
    'saved' => 'Pakke gemt',
    'save_failed' => 'Pakken kunne ikke gemmes',
    'price_invalid' => 'Det er ikke et beløb. Skriv det som 12.50 eller 12,50.',

    // ---- formularen: hvad det er -----------------------------------------
    'section_basics' => 'Pakken',
    'section_basics_helper' => 'Det, en kunde ser på kortet.',
    'name' => 'Navn',
    'name_helper' => 'Hvad den hedder i butikken.',
    'slug' => 'Adresse',
    'slug_helper' => 'Små bogstaver, tal og bindestreger. Efterlades den tom, laves den af navnet. Ændres den senere, brydes et link, nogen har gemt.',
    'description' => 'Beskrivelse',
    'description_helper' => 'Et par linjer under navnet. Ren tekst.',
    'live_field' => 'Til salg',
    'live_helper' => 'Slået fra beholder pakken her og viser den til ingen. En pakke uden egg vises aldrig, uanset hvad der står her.',
    'sort' => 'Rækkefølge',
    'sort_helper' => 'Lavere kommer først i butikken.',

    // ---- formularen: hvad den bliver til ---------------------------------
    'section_server' => 'Serveren, den bliver til',
    'section_server_helper' => 'De samme spørgsmål, Pelican stiller, når du opretter en server i hånden, besvaret én gang her og brugt ved hvert salg.',
    'egg' => 'Egg',
    'egg_helper' => 'At vælge et udfylder image, startkommando og hver variabel med egg\'ets egne standarder. Ret dem bagefter, som du vil.',
    'image' => 'Docker-image',
    'image_helper' => 'Et af de images, egg\'et tilbyder.',
    'image_default' => 'Egg\'ets første image',
    'startup' => 'Startkommando',
    'startup_helper' => 'En af de kommandoer, egg\'et tilbyder.',
    'startup_default' => 'Egg\'ets første kommando',
    'environment' => 'Variabler',
    'environment_helper' => 'Egg\'ets variabler og hvad de står på. Alt, egg\'et har, som ikke står her, får sin standard, når serveren oprettes.',
    'env_key' => 'Variabel',
    'env_value' => 'Værdi',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Hvor en server fra denne pakke må oprettes, prøvet i denne rækkefølge, indtil én har en ledig adresse. Intet afkrydset betyder enhver node.',
    'upgrade_to' => 'Kan skiftes til',
    'upgrade_to_helper' => 'Hvilke pakker en aktiv ydelse på denne må flyttes til, op eller ned. Kun pakker med samme egg står på listen, for et andet egg er en anden server og ikke en større. Intet afkrydset betyder, at der ikke kan skiftes væk fra denne pakke.',
    'upgrade_to_none' => 'Ingen anden pakke bruger dette egg endnu.',

    // ---- formularen: grænser ---------------------------------------------
    'section_limits' => 'Grænser',
    'section_limits_helper' => 'Det, serveren får. De samme felter som Pelicans egen serverformular, i de samme enheder.',
    'memory' => 'Hukommelse',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Procent af én kerne: 100 er én kerne, 200 er to, 0 er ingen grænse.',
    'swap' => 'Swap',
    'swap_helper' => '0 er ingen, -1 er ubegrænset.',
    'io' => 'Blok-IO-vægt',
    'io_helper' => 'Pelicans standard er 500. Lad den stå, medmindre du ved hvorfor ikke.',
    'threads' => 'CPU-pinning',
    'threads_helper' => 'Hvilke kerner, som Pelican skriver dem: 0,1 eller 0-3. Tom er enhver.',
    'oom_killer' => 'OOM-killer',
    'oom_killer_helper' => 'Om kernen må afslutte serveren, når den løber tør for hukommelse.',
    'databases' => 'Databaser',
    'allocations' => 'Ekstra allocations',
    'backups' => 'Sikkerhedskopier',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- formularen: pengene ---------------------------------------------
    'section_price' => 'Pris og lager',
    'section_price_helper' => 'I butikkens valuta, sat på siden Butiksindstillinger. Uden moms - momsen lægges på fakturaen som sin egen linje.',
    'price' => 'Pris',
    'price_helper' => 'Pr. periode. Skriv den som 12.50 eller 12,50.',
    'setup_fee' => 'Oprettelsesgebyr',
    'setup_fee_helper' => 'Opkræves én gang, på den første faktura. Nul for intet.',
    'period' => 'Faktureres',
    'period_helper' => 'Engangs betales én gang og beholdes. De andre får en ny faktura hver periode; en ubetalt suspenderer serveren efter henstandsperioden på siden Butiksindstillinger.',
    'stock' => 'Lager',
    'stock_helper' => 'Hvor mange der må være solgt ad gangen, talt med hver ordre, der ikke er annulleret. Tom er ubegrænset.',
    'term' => 'Bindingsperiode',
    'term_helper' => 'Hvor længe nogen er bundet, når de har købt. Nul er ingen binding: de kan annullere, og den stopper ved udgangen af den periode, de har betalt for.',
    'term_unit' => 'Talt i',
    'term_unit_helper' => 'Dage, måneder eller år. En annulleret ordre kører til udgangen af denne periode, og serveren slettes den dag.',
    'unit_day' => 'Dage',
    'unit_month' => 'Måneder',
    'unit_year' => 'År',
    'term_day' => 'Bindingsperiode: :count dage',
    'term_month' => 'Bindingsperiode: :count måneder',
    'term_year' => 'Bindingsperiode: :count år',
    'section_art' => 'Billede',
    'section_art_helper' => 'Billedet på pakkekortet, i butikken og på en kundes tjenester. Lad begge stå tomme, så bruges det billede, egget selv har, og det har de fleste pakker allerede.',
    'art_file' => 'Læg et billede op',
    'art_file_helper' => 'Bredt frem for højt: kortet beskærer det til 16:9. Op til 8 MB.',
    'art_url' => 'Eller en billedadresse',
    'art_url_helper' => 'En fuld https-adresse. Bruges, når der ikke er lagt noget op ovenfor.',

    'empty' => 'Ingen pakker endnu',
    'section_ask' => 'Spørg kunden',
    'section_ask_helper' => 'Spørgsmål, der stilles ved bestillingen og besvares, før ordren afgives. Svarene når serveren, når den bygges.',
    'ask_vars' => 'Variabler, der skal spørges om',
    'ask_vars_helper' => 'Egg\'ets egne variabler. Sæt kryds ved en, så udfylder kunden den undervejs i købet, og svaret bruges i stedet for denne pakkes værdi. Lad alt stå uden kryds, så bliver ingen spurgt om noget.',
    'upload_ask' => 'Bed om en fil',
    'upload_ask_helper' => 'En zip, kunden lægger op undervejs i købet - en verden, en modpack, et sæt konfigurationer. Den lægges ind i deres server, når den bygges, før de får at vide, at den er klar.',
    'upload_label' => 'Hvad den skal hedde',
    'upload_label_helper' => 'Teksten over filfeltet, med dine egne ord. Tom giver en helt almindelig.',
    'upload_dir' => 'Hvor i serveren',
    'upload_dir_helper' => 'En sti inde i serveren, som / eller /world. Den gøres sikker, før den bruges.',
    'upload_extract' => 'Pak den ud',
    'upload_extract_helper' => 'Tændt pakkes zip\'en ud, hvor den lander, og selve arkivet fjernes - det rigtige for en verden eller et sæt konfigurationer. Slukket bliver zip\'en liggende som fil, og det er netop, hvad et egg vil have, når det selv installerer en modpack ud af den.',
    'empty_body' => 'Lav én, og den dukker op i butikken, i det øjeblik den sættes til salg.',
    'popular' => 'Peg på denne',
    'popular_helper' => 'Markerer den som den, de fleste vælger. Den rykker frem i butikken, under alt hvad der er på tilbud, og får et lille flag. Ikke en påstand om salgstal - en købmand, der peger.',
    'offer' => 'På tilbud',
    'offer_helper' => 'Sætter den forrest i butikken med et flag på, og trækker rabatten nedenfor fra prisen.',
    'offer_kind' => 'Rabat som',
    'offer_percent' => 'En procentdel',
    'offer_amount' => 'Et beløb',
    'offer_value' => 'Hvor meget der trækkes fra',
    'offer_value_percent' => 'En procentdel af prisen, så 20 tager en femtedel.',
    'offer_value_amount' => 'Et beløb i butikkens valuta, så 2,50 tager to en halv af prisen.',
    'offer_min' => 'Først fra så mange varer',
    'offer_min_helper' => 'Hvor fuld kurven skal være, før rabatten gælder, talt over alt, hvad der ligger i den, og ikke kun over denne pakke. Nul eller én betyder altid. To er en grund til at lægge noget mere i.',
];
