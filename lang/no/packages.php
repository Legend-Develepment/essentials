<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Pakker: en server noen kan kjøpe.
 *
 * Leses av den som setter opp butikken. Hvert ord her handler om malen og
 * prisen; det en kunde ser står i shop.php, fordi de to leserne vil ha ulike
 * setninger om den samme raden.
 *
 * «egg», «node», «swap», «io» og Minecraft-ordene forblir engelske: det er
 * ordene på Pelicans eget serverskjema, og en pakke er det skjemaet lagret til
 * senere.
 */

return [
    'title' => 'Pakker',
    'nav_label' => 'Pakker',
    'subheading' => 'Det som er til salgs. Hver er en servermal med en pris på; en kunde kjøper en, og panelet oppretter serveren.',

    // ---- tabellen --------------------------------------------------------
    'column_name' => 'Pakke',
    'column_egg' => 'Egg',
    'column_price' => 'Pris',
    'column_stock' => 'Lager',
    'column_live' => 'Til salgs',
    'column_orders' => 'Solgt',

    'live' => 'Til salgs',
    'offline' => 'Ikke til salgs',
    'no_egg' => 'Ingen egg — kan ikke bygges',

    'stock_unlimited' => 'Ubegrenset',
    'stock_left' => ':count igjen',
    'stock_out' => 'Utsolgt',

    // ---- perioder --------------------------------------------------------
    'period_once' => 'Engangs',
    'period_month' => 'Månedlig',
    'period_quarter' => 'Kvartalsvis',
    'period_year' => 'Årlig',

    // Etter en pris: «12,50 € i måneden».
    'per_once' => 'én gang',
    'per_month' => 'i måneden',
    'per_quarter' => 'i kvartalet',
    'per_year' => 'i året',

    // ---- handlinger ------------------------------------------------------
    'new' => 'Ny pakke',
    'edit' => 'Rediger',
    'duplicate' => 'Dupliser',
    'copy_suffix' => ' (kopi)',
    'go_live' => 'Legg ut for salg',
    'go_offline' => 'Ta av salg',
    'delete' => 'Slett',
    'delete_confirm' => 'Fjerner pakken. Det som allerede er kjøpt, røres ikke — ordrer beholder sin egen kopi av hva de var.',
    'delete_refused' => 'Ikke slettet',
    'delete_refused_body' => 'Det er lagt inn ordrer på denne pakken, og de peker på den. Ta den av salg i stedet; den blir værende i arkivet, og ingen kan kjøpe den.',
    'deleted' => 'Pakke slettet',
    'saved' => 'Pakke lagret',
    'save_failed' => 'Pakken kunne ikke lagres',
    'price_invalid' => 'Det er ikke et beløp. Skriv det som 12.50 eller 12,50.',

    // ---- skjemaet: hva det er --------------------------------------------
    'section_basics' => 'Pakken',
    'section_basics_helper' => 'Det en kunde ser på kortet.',
    'name' => 'Navn',
    'name_helper' => 'Hva den heter i butikken.',
    'slug' => 'Adresse',
    'slug_helper' => 'Små bokstaver, tall og bindestreker. Står den tom, lages den av navnet. Endres den senere, brytes en lenke noen har lagret.',
    'description' => 'Beskrivelse',
    'description_helper' => 'Et par linjer under navnet. Ren tekst.',
    'live_field' => 'Til salgs',
    'live_helper' => 'Av beholder pakken her og viser den til ingen. En pakke uten egg vises aldri, uansett hva som står her.',
    'sort' => 'Rekkefølge',
    'sort_helper' => 'Lavere kommer først i butikken.',

    // ---- skjemaet: hva den blir ------------------------------------------
    'section_server' => 'Serveren den blir',
    'section_server_helper' => 'De samme spørsmålene Pelican stiller når du oppretter en server for hånd, besvart én gang her og brukt ved hvert salg.',
    'egg' => 'Egg',
    'egg_helper' => 'Å velge et fyller inn image, startkommando og hver variabel med eggets egne standardverdier. Endre dem etterpå som du vil.',
    'image' => 'Docker-image',
    'image_helper' => 'Et av imagene egget tilbyr.',
    'image_default' => 'Eggets første image',
    'startup' => 'Startkommando',
    'startup_helper' => 'En av kommandoene egget tilbyr.',
    'startup_default' => 'Eggets første kommando',
    'environment' => 'Variabler',
    'environment_helper' => 'Eggets variabler og hva de står på. Alt egget har som ikke står her, får standardverdien sin når serveren opprettes.',
    'env_key' => 'Variabel',
    'env_value' => 'Verdi',
    'nodes' => 'Noder',
    'nodes_helper' => 'Hvor en server fra denne pakken kan opprettes, prøvd i denne rekkefølgen til én har en ledig adresse. Ingenting avkrysset betyr hvilken som helst node.',

    // ---- skjemaet: grenser -----------------------------------------------
    'section_limits' => 'Grenser',
    'section_limits_helper' => 'Det serveren får. De samme feltene som Pelicans eget serverskjema, i de samme enhetene.',
    'memory' => 'Minne',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Prosent av én kjerne: 100 er én kjerne, 200 er to, 0 er ingen grense.',
    'swap' => 'Swap',
    'swap_helper' => '0 er ingen, -1 er ubegrenset.',
    'io' => 'Blokk-IO-vekt',
    'io_helper' => 'Pelicans standard er 500. La den stå med mindre du vet hvorfor ikke.',
    'threads' => 'CPU-pinning',
    'threads_helper' => 'Hvilke kjerner, slik Pelican skriver dem: 0,1 eller 0-3. Tom er hvilken som helst.',
    'oom_killer' => 'OOM-killer',
    'oom_killer_helper' => 'Om kjernen får avslutte serveren når den går tom for minne.',
    'databases' => 'Databaser',
    'allocations' => 'Ekstra allocations',
    'backups' => 'Sikkerhetskopier',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- skjemaet: pengene -----------------------------------------------
    'section_price' => 'Pris og lager',
    'section_price_helper' => 'I butikkens valuta, satt på siden Butikkinnstillinger. Uten avgift — avgiften legges på fakturaen som sin egen linje.',
    'price' => 'Pris',
    'price_helper' => 'Per periode. Skriv den som 12.50 eller 12,50.',
    'setup_fee' => 'Etableringsgebyr',
    'setup_fee_helper' => 'Belastes én gang, på den første fakturaen. Null for ingen.',
    'period' => 'Faktureres',
    'period_helper' => 'Engangs betales én gang og beholdes. De andre får en ny faktura hver periode; en ubetalt suspenderer serveren etter henstandsperioden på siden Butikkinnstillinger.',
    'stock' => 'Lager',
    'stock_helper' => 'Hvor mange som kan være solgt samtidig, medregnet hver ordre som ikke er avbrutt. Tom er ubegrenset.',

    'empty' => 'Ingen pakker ennå',
    'empty_body' => 'Lag én, så dukker den opp i butikken i det øyeblikket den legges ut for salg.',
];
