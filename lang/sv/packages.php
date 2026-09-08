<?php

/*
 * Svenska. Skriven för hand.
 *
 * Paket: en server som någon kan köpa.
 *
 * Läses av den som ställer i ordning butiken. Varje ord här handlar om mallen
 * och priset; det en kund ser står i shop.php, eftersom de två läsarna vill ha
 * olika meningar om samma rad.
 *
 * «egg», «node», «swap», «io» och Minecraft-orden förblir engelska: det är
 * orden på Pelicans eget serverformulär, och ett paket är det formuläret
 * sparat till senare.
 */

return [
    'title' => 'Paket',
    'nav_label' => 'Paket',
    'subheading' => 'Det som är till salu. Varje paket är en servermall med ett pris; en kund köper ett och panelen skapar servern.',

    // ---- tabellen --------------------------------------------------------
    'column_name' => 'Paket',
    'column_egg' => 'Egg',
    'column_price' => 'Pris',
    'column_stock' => 'Lager',
    'column_live' => 'Till salu',
    'column_orders' => 'Sålda',

    'live' => 'Till salu',
    'offline' => 'Inte till salu',
    'no_egg' => 'Inget egg — kan inte byggas',

    'stock_unlimited' => 'Obegränsat',
    'stock_left' => ':count kvar',
    'stock_out' => 'Slutsåld',

    // ---- perioder --------------------------------------------------------
    'period_once' => 'Engångs',
    'period_month' => 'Månadsvis',
    'period_quarter' => 'Kvartalsvis',
    'period_year' => 'Årsvis',

    // Efter ett pris: «12,50 € i månaden».
    'per_once' => 'en gång',
    'per_month' => 'i månaden',
    'per_quarter' => 'per kvartal',
    'per_year' => 'om året',

    // ---- åtgärder --------------------------------------------------------
    'new' => 'Nytt paket',
    'edit' => 'Redigera',
    'duplicate' => 'Duplicera',
    'copy_suffix' => ' (kopia)',
    'go_live' => 'Lägg ut till försäljning',
    'go_offline' => 'Ta bort från försäljning',
    'delete' => 'Ta bort',
    'delete_confirm' => 'Tar bort paketet. Det som redan köpts rörs inte — beställningar behåller sin egen kopia av vad de var.',
    'delete_refused' => 'Inte borttaget',
    'delete_refused_body' => 'Beställningar har lagts på det här paketet, och de pekar på det. Ta det ur försäljning i stället; det stannar kvar i registren och ingen kan köpa det.',
    'deleted' => 'Paket borttaget',
    'saved' => 'Paket sparat',
    'save_failed' => 'Paketet kunde inte sparas',
    'price_invalid' => 'Det är inte ett belopp. Skriv det som 12.50 eller 12,50.',

    // ---- formuläret: vad det är ------------------------------------------
    'section_basics' => 'Paketet',
    'section_basics_helper' => 'Det en kund ser på kortet.',
    'name' => 'Namn',
    'name_helper' => 'Vad det heter i butiken.',
    'slug' => 'Adress',
    'slug_helper' => 'Små bokstäver, siffror och bindestreck. Lämnas den tom görs den av namnet. Ändras den senare bryts en länk som någon sparat.',
    'description' => 'Beskrivning',
    'description_helper' => 'Några rader under namnet. Ren text.',
    'live_field' => 'Till salu',
    'live_helper' => 'Av behåller paketet här och visar det för ingen. Ett paket utan egg visas aldrig, oavsett vad som står här.',
    'sort' => 'Ordning',
    'sort_helper' => 'Lägre kommer först i butiken.',

    // ---- formuläret: vad det blir ----------------------------------------
    'section_server' => 'Servern det blir',
    'section_server_helper' => 'Samma frågor som Pelican ställer när du skapar en server för hand, besvarade en gång här och använda vid varje försäljning.',
    'egg' => 'Egg',
    'egg_helper' => 'Att välja ett fyller i image, startkommando och varje variabel med eggets egna standardvärden. Ändra dem efteråt som du vill.',
    'image' => 'Docker-image',
    'image_helper' => 'En av de images som egget erbjuder.',
    'image_default' => 'Eggets första image',
    'startup' => 'Startkommando',
    'startup_helper' => 'Ett av de kommandon som egget erbjuder.',
    'startup_default' => 'Eggets första kommando',
    'environment' => 'Variabler',
    'environment_helper' => 'Eggets variabler och vad de är satta till. Allt egget har som inte står här får sitt standardvärde när servern skapas.',
    'env_key' => 'Variabel',
    'env_value' => 'Värde',
    'nodes' => 'Noder',
    'nodes_helper' => 'Var en server från det här paketet får skapas, prövade i den här ordningen tills en har en ledig adress. Inget ikryssat betyder vilken node som helst.',

    // ---- formuläret: gränser ---------------------------------------------
    'section_limits' => 'Gränser',
    'section_limits_helper' => 'Det servern får. Samma fält som Pelicans eget serverformulär, i samma enheter.',
    'memory' => 'Minne',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Procent av en kärna: 100 är en kärna, 200 är två, 0 är ingen gräns.',
    'swap' => 'Swap',
    'swap_helper' => '0 är ingen, -1 är obegränsad.',
    'io' => 'Block-IO-vikt',
    'io_helper' => 'Pelicans standard är 500. Låt den stå om du inte vet varför inte.',
    'threads' => 'CPU-pinning',
    'threads_helper' => 'Vilka kärnor, som Pelican skriver dem: 0,1 eller 0-3. Tomt är vilken som helst.',
    'oom_killer' => 'OOM-killer',
    'oom_killer_helper' => 'Om kärnan får avsluta servern när minnet tar slut.',
    'databases' => 'Databaser',
    'allocations' => 'Extra allocations',
    'backups' => 'Säkerhetskopior',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- formuläret: pengarna --------------------------------------------
    'section_price' => 'Pris och lager',
    'section_price_helper' => 'I butikens valuta, satt på sidan Butiksinställningar. Utan moms — momsen läggs på fakturan som en egen rad.',
    'price' => 'Pris',
    'price_helper' => 'Per period. Skriv det som 12.50 eller 12,50.',
    'setup_fee' => 'Startavgift',
    'setup_fee_helper' => 'Tas ut en gång, på den första fakturan. Noll för ingen.',
    'period' => 'Faktureras',
    'period_helper' => 'Engångs betalas en gång och behålls. De andra får en ny faktura varje period; en obetald stänger av servern efter respittiden på sidan Butiksinställningar.',
    'stock' => 'Lager',
    'stock_helper' => 'Hur många som får vara sålda samtidigt, räknat med varje beställning som inte avbrutits. Tomt är obegränsat.',

    'empty' => 'Inga paket ännu',
    'empty_body' => 'Gör ett, så dyker det upp i butiken i samma stund det läggs ut till försäljning.',
];
