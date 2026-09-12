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
    'column_flags' => 'Flaggor',
    'column_flags_from' => 'från :count',
    'column_egg' => 'Egg',
    'column_price' => 'Pris',
    'column_stock' => 'Lager',
    'column_live' => 'Till salu',
    'column_orders' => 'Sålda',

    'live' => 'Till salu',
    'offline' => 'Inte till salu',
    'no_egg' => 'Inget egg - kan inte byggas',

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
    'delete_confirm' => 'Tar bort paketet. Det som redan köpts rörs inte - beställningar behåller sin egen kopia av vad de var.',
    'delete_confirm_sold' => 'Det här har sålts :count gånger. De tjänsterna rörs inte: en beställning bär sin egen kopia av allt den såldes med, så servrarna fortsätter köra och fakturorna fortsätter säga vad som köptes. Bara bilden på deras tjänstekort försvinner, och paketet slutar erbjudas.',
    'delete_refused' => 'Inte borttaget',
    'delete_refused_body' => 'Beställningar har lagts på det här paketet, och de pekar på det. Ta det ur försäljning i stället; det stannar kvar i registren och ingen kan köpa det.',
    'deleted' => 'Paket borttaget',
    'deleted_sold' => 'De :count tjänster som sålts från det är orörda och kör fortfarande.',
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
    'upgrade_to' => 'Kan bytas till',
    'upgrade_to_helper' => 'Vilka paket en aktiv tjänst på det här får flyttas till, uppåt eller nedåt. Bara paket som använder samma egg står med, för ett annat egg är en annan server och inte en större. Inget ikryssat betyder att det här paketet inte går att byta ifrån.',
    'upgrade_to_none' => 'Inget annat paket använder det här egget än.',

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
    'section_price_helper' => 'I butikens valuta, satt på sidan Butiksinställningar. Utan moms - momsen läggs på fakturan som en egen rad.',
    'price' => 'Pris',
    'price_helper' => 'Per period. Skriv det som 12.50 eller 12,50.',
    'setup_fee' => 'Startavgift',
    'setup_fee_helper' => 'Tas ut en gång, på den första fakturan. Noll för ingen.',
    'period' => 'Faktureras',
    'period_helper' => 'Engångs betalas en gång och behålls. De andra får en ny faktura varje period; en obetald stänger av servern efter respittiden på sidan Butiksinställningar.',
    'stock' => 'Lager',
    'stock_helper' => 'Hur många som får vara sålda samtidigt, räknat med varje beställning som inte avbrutits. Tomt är obegränsat.',
    'term' => 'Minsta bindningstid',
    'term_helper' => 'Hur länge någon är bunden när han väl köpt. Noll är ingen bindning: han kan avbryta, och det slutar vid slutet av den period han betalat för.',
    'term_unit' => 'Räknas i',
    'term_unit_helper' => 'Dagar, månader eller år. En avbruten beställning löper till slutet av den här tiden, och servern tas bort den dagen.',
    'unit_day' => 'Dagar',
    'unit_month' => 'Månader',
    'unit_year' => 'År',
    'term_day' => 'Minsta bindningstid: :count dagar',
    'term_month' => 'Minsta bindningstid: :count månader',
    'term_year' => 'Minsta bindningstid: :count år',
    'section_art' => 'Bild',
    'section_art_helper' => 'Bilden på paketkortet, i butiken och på en kunds tjänster. Lämna båda tomma så används eggets egen bild, som de flesta paket redan har.',
    'art_file' => 'Ladda upp en bild',
    'art_file_helper' => 'Hellre bred än hög: kortet beskär den till 16:9. Upp till 8 MB.',
    'art_url' => 'Eller en bildadress',
    'art_url_helper' => 'En fullständig https-adress. Används när ingenting laddats upp ovanför.',

    'empty' => 'Inga paket ännu',
    'section_ask' => 'Fråga kunden',
    'section_ask_helper' => 'Frågor som ställs i beställningen, besvarade innan den läggs. Svaren når servern när den byggs.',
    'ask_vars' => 'Variabler att fråga efter',
    'ask_vars_helper' => 'Eggets egna variabler. Kryssa i en, så fyller kunden i den medan han köper, och hans svar används i stället för det här paketets värde. Lämna allt okryssat, så frågas ingen om någonting.',
    'upload_ask' => 'Fråga efter en fil',
    'upload_ask_helper' => 'En zip som kunden laddar upp medan han köper - en värld, ett modpack, en uppsättning konfigurationer. Den läggs in i hans server när den byggs, innan han får veta att den är klar.',
    'upload_label' => 'Vad den ska kallas',
    'upload_label_helper' => 'Etiketten ovanför filrutan, med dina egna ord. Tom ger en enkel.',
    'upload_dir' => 'Var i servern',
    'upload_dir_helper' => 'En sökväg inne i servern, som / eller /world. Den görs säker innan den används.',
    'upload_extract' => 'Packa upp den',
    'upload_extract_helper' => 'På packas zipen upp där den hamnar och själva arkivet tas bort - rätt för en värld eller en uppsättning konfigurationer. Av lämnas zipen som en fil, vilket är vad ett egg som installerar ett modpack ur en vill ha.',
    'empty_body' => 'Gör ett, så dyker det upp i butiken i samma stund det läggs ut till försäljning.',
    'popular' => 'Peka på det här',
    'popular_helper' => 'Märker det som det de flesta väljer. Det flyttas upp i butiken, under allt som är på erbjudande, och får en liten flagga. Inget påstående om försäljningssiffror - en handlare som pekar.',
    'offer' => 'På erbjudande',
    'offer_helper' => 'Flyttar det längst fram i butiken med en flagga på, och drar av rabatten nedan från priset.',
    'offer_kind' => 'Rabatt som',
    'offer_percent' => 'En procentsats',
    'offer_amount' => 'Ett belopp',
    'offer_value' => 'Hur mycket av',
    'offer_value_percent' => 'En procentsats av priset, så 20 betyder en femtedel billigare.',
    'offer_value_amount' => 'Ett belopp i butikens valuta, så 2.50 betyder två och en halv av.',
    'offer_min' => 'Bara från så här många varor',
    'offer_min_helper' => 'Hur full varukorgen måste vara innan rabatten gäller, räknat på allt i den och inte bara på det här paketet. Noll eller ett betyder att den alltid gäller. Två är ett skäl att lägga i en sak till.',
];
