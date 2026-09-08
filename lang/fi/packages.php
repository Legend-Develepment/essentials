<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Paketit: palvelin, jonka joku voi ostaa.
 *
 * Lukijana on se, joka pystyttää kaupan. Jokainen sana täällä koskee mallia ja
 * hintaa; se, minkä asiakas näkee, on shop.php:ssä, koska kaksi lukijaa
 * haluavat samasta rivistä eri lauseet.
 *
 * ”egg”, ”node”, ”swap”, ”io” ja Minecraft-sanat pysyvät englanniksi: ne ovat
 * sanoja Pelicanin omassa palvelinlomakkeessa, ja paketti on se lomake
 * talletettuna myöhempää varten.
 *
 * Luku tulee sanan jälkeen, ei ennen: suomi taivuttaa laskettavan luvun
 * mukaan, eikä yksi muoto sovi kaikkiin.
 */

return [
    'title' => 'Paketit',
    'nav_label' => 'Paketit',
    'subheading' => 'Se, mitä on myynnissä. Jokainen on palvelinmalli, jolla on hinta; asiakas ostaa yhden ja paneeli luo palvelimen.',

    // ---- taulukko --------------------------------------------------------
    'column_name' => 'Paketti',
    'column_egg' => 'Egg',
    'column_price' => 'Hinta',
    'column_stock' => 'Varasto',
    'column_live' => 'Myynnissä',
    'column_orders' => 'Myyty',

    'live' => 'Myynnissä',
    'offline' => 'Ei myynnissä',
    'no_egg' => 'Ei eggiä — ei voi rakentaa',

    'stock_unlimited' => 'Rajaton',
    'stock_left' => 'Jäljellä: :count',
    'stock_out' => 'Loppuunmyyty',

    // ---- jaksot ----------------------------------------------------------
    'period_once' => 'Kertamaksu',
    'period_month' => 'Kuukausittain',
    'period_quarter' => 'Neljännesvuosittain',
    'period_year' => 'Vuosittain',

    // Hinnan perään: ”12,50 € kuukaudessa”.
    'per_once' => 'kerran',
    'per_month' => 'kuukaudessa',
    'per_quarter' => 'neljännesvuodessa',
    'per_year' => 'vuodessa',

    // ---- toiminnot -------------------------------------------------------
    'new' => 'Uusi paketti',
    'edit' => 'Muokkaa',
    'duplicate' => 'Monista',
    'copy_suffix' => ' (kopio)',
    'go_live' => 'Aseta myyntiin',
    'go_offline' => 'Poista myynnistä',
    'delete' => 'Poista',
    'delete_confirm' => 'Poistaa paketin. Jo ostettuun ei kosketa — tilaukset säilyttävät oman kopionsa siitä, mitä ne olivat.',
    'delete_refused' => 'Ei poistettu',
    'delete_refused_body' => 'Tälle paketille on tehty tilauksia, ja ne viittaavat siihen. Poista se mieluummin myynnistä; se jää kirjanpitoon eikä kukaan voi ostaa sitä.',
    'deleted' => 'Paketti poistettu',
    'saved' => 'Paketti tallennettu',
    'save_failed' => 'Pakettia ei voitu tallentaa',
    'price_invalid' => 'Tuo ei ole summa. Kirjoita se muodossa 12.50 tai 12,50.',

    // ---- lomake: mikä se on ----------------------------------------------
    'section_basics' => 'Paketti',
    'section_basics_helper' => 'Se, minkä asiakas näkee kortilla.',
    'name' => 'Nimi',
    'name_helper' => 'Miksi sitä kutsutaan kaupassa.',
    'slug' => 'Osoite',
    'slug_helper' => 'Pieniä kirjaimia, numeroita ja väliviivoja. Tyhjäksi jätettynä se muodostetaan nimestä. Myöhempi muutos rikkoo linkin, jonka joku on tallentanut.',
    'description' => 'Kuvaus',
    'description_helper' => 'Muutama rivi nimen alla. Pelkkää tekstiä.',
    'live_field' => 'Myynnissä',
    'live_helper' => 'Pois päältä pitää paketin täällä eikä näytä sitä kenellekään. Pakettia ilman eggiä ei näytetä koskaan, lukipa tässä mitä tahansa.',
    'sort' => 'Järjestys',
    'sort_helper' => 'Pienempi tulee kaupassa ensin.',

    // ---- lomake: miksi se muuttuu ----------------------------------------
    'section_server' => 'Palvelin, joksi se muuttuu',
    'section_server_helper' => 'Samat kysymykset, jotka Pelican esittää, kun luot palvelimen käsin, vastattuina kerran täällä ja käytettyinä jokaisessa myynnissä.',
    'egg' => 'Egg',
    'egg_helper' => 'Yhden valinta täyttää imagen, käynnistyskomennon ja jokaisen muuttujan eggin omilla oletuksilla. Muuta niitä sen jälkeen miten haluat.',
    'image' => 'Docker-image',
    'image_helper' => 'Yksi eggin tarjoamista imageista.',
    'image_default' => 'Eggin ensimmäinen image',
    'startup' => 'Käynnistyskomento',
    'startup_helper' => 'Yksi eggin tarjoamista komennoista.',
    'startup_default' => 'Eggin ensimmäinen komento',
    'environment' => 'Muuttujat',
    'environment_helper' => 'Eggin muuttujat ja niiden arvot. Kaikki, mitä eggillä on eikä ole täällä listattuna, saa oletusarvonsa, kun palvelin luodaan.',
    'env_key' => 'Muuttuja',
    'env_value' => 'Arvo',
    'nodes' => 'Nodet',
    'nodes_helper' => 'Missä tämän paketin palvelin saa syntyä, kokeiltuina tässä järjestyksessä, kunnes jollakin on vapaa osoite. Ei mitään valittuna tarkoittaa mitä tahansa nodea.',

    // ---- lomake: rajat ---------------------------------------------------
    'section_limits' => 'Rajat',
    'section_limits_helper' => 'Se, mitä palvelin saa. Samat kentät kuin Pelicanin omassa palvelinlomakkeessa, samoissa yksiköissä.',
    'memory' => 'Muisti',
    'disk' => 'Levy',
    'cpu' => 'CPU',
    'cpu_helper' => 'Prosenttia yhdestä ytimestä: 100 on yksi ydin, 200 on kaksi, 0 on ei rajaa.',
    'swap' => 'Swap',
    'swap_helper' => '0 on ei mitään, -1 on rajaton.',
    'io' => 'Lohko-IO:n paino',
    'io_helper' => 'Pelicanin oletus on 500. Jätä se siihen, ellet tiedä miksi ei.',
    'threads' => 'CPU-kiinnitys',
    'threads_helper' => 'Mitkä ytimet, kuten Pelican ne kirjoittaa: 0,1 tai 0-3. Tyhjä on mikä tahansa.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Saako ydin lopettaa palvelimen, kun muisti loppuu.',
    'databases' => 'Tietokannat',
    'allocations' => 'Lisä-allocationit',
    'backups' => 'Varmuuskopiot',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- lomake: raha ----------------------------------------------------
    'section_price' => 'Hinta ja varasto',
    'section_price_helper' => 'Kaupan valuutassa, joka asetetaan Kaupan asetukset -sivulla. Ilman veroa — vero lisätään laskulle omana rivinään.',
    'price' => 'Hinta',
    'price_helper' => 'Jaksoa kohden. Kirjoita se muodossa 12.50 tai 12,50.',
    'setup_fee' => 'Perustamismaksu',
    'setup_fee_helper' => 'Veloitetaan kerran, ensimmäisellä laskulla. Nolla, jos ei ole.',
    'period' => 'Laskutus',
    'period_helper' => 'Kertamaksu maksetaan kerran ja pidetään. Muut saavat uuden laskun joka jakso; maksamaton keskeyttää palvelimen Kaupan asetukset -sivun armonajan jälkeen.',
    'stock' => 'Varasto',
    'stock_helper' => 'Montako voi olla myytynä yhtä aikaa, kun lasketaan jokainen perumaton tilaus. Tyhjä on rajaton.',

    'empty' => 'Ei vielä paketteja',
    'empty_body' => 'Tee yksi, niin se ilmestyy kauppaan heti, kun se asetetaan myyntiin.',
];
