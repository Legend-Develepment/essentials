<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Pakketten: een server die iemand kan kopen.
 *
 * Gelezen door wie de winkel inricht. Elk woord hier gaat over het sjabloon en
 * de prijs; wat een klant ziet staat in shop.php, omdat de twee lezers andere
 * zinnen over dezelfde rij willen.
 *
 * "egg", "node", "swap", "io" en de Minecraft-woorden blijven Engels: het zijn
 * de woorden op Pelicans eigen serverformulier, en een pakket is dat formulier,
 * bewaard voor later.
 */

return [
    'title' => 'Pakketten',
    'nav_label' => 'Pakketten',
    'subheading' => 'Wat te koop is. Elk pakket is een serversjabloon met een prijs erop; een klant koopt er een en het paneel maakt de server.',

    // ---- de tabel --------------------------------------------------------
    'column_name' => 'Pakket',
    'column_egg' => 'Egg',
    'column_price' => 'Prijs',
    'column_stock' => 'Voorraad',
    'column_live' => 'Te koop',
    'column_orders' => 'Verkocht',

    'live' => 'Te koop',
    'offline' => 'Niet te koop',
    'no_egg' => 'Geen egg — kan niet gebouwd worden',

    'stock_unlimited' => 'Onbeperkt',
    'stock_left' => 'Nog :count',
    'stock_out' => 'Uitverkocht',

    // ---- periodes --------------------------------------------------------
    'period_once' => 'Eenmalig',
    'period_month' => 'Maandelijks',
    'period_quarter' => 'Per kwartaal',
    'period_year' => 'Jaarlijks',

    // Achter een prijs: "€ 12,50 per maand".
    'per_once' => 'eenmalig',
    'per_month' => 'per maand',
    'per_quarter' => 'per kwartaal',
    'per_year' => 'per jaar',

    // ---- acties ----------------------------------------------------------
    'new' => 'Nieuw pakket',
    'edit' => 'Bewerken',
    'duplicate' => 'Dupliceren',
    'copy_suffix' => ' (kopie)',
    'go_live' => 'Te koop zetten',
    'go_offline' => 'Uit de verkoop halen',
    'delete' => 'Verwijderen',
    'delete_confirm' => 'Verwijdert het pakket. Wat al gekocht is blijft onaangeroerd — bestellingen bewaren hun eigen kopie van wat ze waren.',
    'delete_refused' => 'Niet verwijderd',
    'delete_refused_body' => 'Er zijn bestellingen op dit pakket geplaatst, en die wijzen ernaar. Haal het liever uit de verkoop; het blijft dan bestaan voor de administratie en niemand kan het nog kopen.',
    'deleted' => 'Pakket verwijderd',
    'saved' => 'Pakket opgeslagen',
    'save_failed' => 'Het pakket kon niet worden opgeslagen',
    'price_invalid' => 'Dat is geen bedrag. Schrijf het als 12.50 of 12,50.',

    // ---- het formulier: wat het is ---------------------------------------
    'section_basics' => 'Het pakket',
    'section_basics_helper' => 'Wat een klant op de kaart ziet.',
    'name' => 'Naam',
    'name_helper' => 'Hoe het in de winkel heet.',
    'slug' => 'Adres',
    'slug_helper' => 'Kleine letters, cijfers en koppeltekens. Leeg gelaten wordt het uit de naam gemaakt. Later wijzigen breekt een link die iemand heeft bewaard.',
    'description' => 'Omschrijving',
    'description_helper' => 'Een paar regels onder de naam. Platte tekst.',
    'live_field' => 'Te koop',
    'live_helper' => 'Uit houdt het pakket hier en toont het aan niemand. Een pakket zonder egg wordt nooit getoond, wat hier ook staat.',
    'sort' => 'Volgorde',
    'sort_helper' => 'Lager komt eerder in de winkel.',

    // ---- het formulier: wat het wordt ------------------------------------
    'section_server' => 'De server die het wordt',
    'section_server_helper' => 'Dezelfde vragen die Pelican stelt als je met de hand een server aanmaakt, hier één keer beantwoord en bij elke verkoop gebruikt.',
    'egg' => 'Egg',
    'egg_helper' => 'Een egg kiezen vult de image, het opstartcommando en elke variabele met de standaardwaarden van de egg. Pas ze daarna naar wens aan.',
    'image' => 'Docker-image',
    'image_helper' => 'Een van de images die de egg aanbiedt.',
    'image_default' => 'De eerste image van de egg',
    'startup' => 'Opstartcommando',
    'startup_helper' => 'Een van de commando\'s die de egg aanbiedt.',
    'startup_default' => 'Het eerste commando van de egg',
    'environment' => 'Variabelen',
    'environment_helper' => 'De variabelen van de egg en waarop ze staan. Alles wat de egg heeft en hier niet staat, krijgt zijn standaardwaarde als de server wordt gemaakt.',
    'env_key' => 'Variabele',
    'env_value' => 'Waarde',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Waar een server uit dit pakket gemaakt mag worden, in deze volgorde geprobeerd tot er een een vrij adres heeft. Niets aangevinkt betekent elke node.',

    // ---- het formulier: limieten -----------------------------------------
    'section_limits' => 'Limieten',
    'section_limits_helper' => 'Wat de server krijgt. Dezelfde velden als Pelicans eigen serverformulier, in dezelfde eenheden.',
    'memory' => 'Geheugen',
    'disk' => 'Schijf',
    'cpu' => 'CPU',
    'cpu_helper' => 'Procent van één kern: 100 is één kern, 200 is twee, 0 is geen limiet.',
    'swap' => 'Swap',
    'swap_helper' => '0 is geen, -1 is onbeperkt.',
    'io' => 'Block-IO-gewicht',
    'io_helper' => 'Pelicans standaard is 500. Laat het daar tenzij je weet waarom niet.',
    'threads' => 'CPU-pinning',
    'threads_helper' => 'Welke kernen, zoals Pelican ze schrijft: 0,1 of 0-3. Leeg is elke.',
    'oom_killer' => 'OOM-killer',
    'oom_killer_helper' => 'Of de kernel de server mag beëindigen als het geheugen op is.',
    'databases' => 'Databases',
    'allocations' => 'Extra allocations',
    'backups' => 'Back-ups',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- het formulier: het geld -----------------------------------------
    'section_price' => 'Prijs en voorraad',
    'section_price_helper' => 'In de valuta van de winkel, ingesteld op de pagina Winkelinstellingen. Exclusief btw — die komt als eigen regel op de factuur.',
    'price' => 'Prijs',
    'price_helper' => 'Per periode. Schrijf het als 12.50 of 12,50.',
    'setup_fee' => 'Opzetkosten',
    'setup_fee_helper' => 'Eenmalig in rekening gebracht, op de eerste factuur. Nul voor geen.',
    'period' => 'Gefactureerd',
    'period_helper' => 'Eenmalig wordt één keer betaald en gehouden. De andere krijgen elke periode een nieuwe factuur; een onbetaalde schorst de server na de respijtperiode op de pagina Winkelinstellingen.',
    'stock' => 'Voorraad',
    'stock_helper' => 'Hoeveel er tegelijk verkocht mogen zijn, alle niet-geannuleerde bestellingen meegeteld. Leeg is onbeperkt.',

    'empty' => 'Nog geen pakketten',
    'empty_body' => 'Maak er een en het verschijnt in de winkel zodra het te koop wordt gezet.',
];
