<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Whitelist”, ”operator”, ”ban” ja ”kick” jäävät englanniksi: ne ovat komennot,
 * jotka konsoliin kirjoitetaan, ja niiden tiedostojen nimet, jotka Minecraft
 * itse kirjoittaa. Käännetty painike englanninkielisen komennon vieressä on
 * painike, joka pitää kääntää päässä takaisin.
 */

return [
    'nav_label' => 'Pelaajat',
    'title' => 'Pelaajat',
    'subheading' => 'Whitelist, operatorit, bannit, ja kaikki, jotka tämä palvelin on nähnyt.',

    /*
     * Sanottu kerran, ylhäällä, koska se selittää sekä sen, mitä sivu voi
     * tehdä, että sen, miksi yksi asia, jota se ei voi, ei ole vika. Jokainen
     * muutos lähetetään konsolikomentona, mikä on se tapa, jolla Minecraftille
     * on tarkoitus kertoa - peli tekee muutoksen ja kirjoittaa oman tiedostonsa,
     * joten ne kaksi eivät koskaan ole eri mieltä.
     */
    'how' => 'Muutokset lähetetään palvelimelle konsolikomentoina, joten peli tekee ne ja kirjoittaa omat tiedostonsa. Se vaatii, että palvelin on käynnissä.',
    'needs_running' => 'Palvelimen on oltava käynnissä. Nämä muutokset tekee peli, ei sen tiedostojen muokkaaminen sen alta.',

    'name' => 'Pelaajan nimi',
    'reason' => 'Syy (valinnainen)',

    'whitelist' => 'Lisää whitelistille',
    'unwhitelist' => 'Poista whitelistiltä',
    'op' => 'Tee operatoriksi',
    'deop' => 'Poista operator',
    'ban' => 'Banni',
    'pardon' => 'Poista banni',
    'kick' => 'Potki ulos',

    'sent' => 'Komento lähetetty',
    'sent_body' => 'Palvelin toteuttaa sen ja päivittää omat tiedostonsa. Lataa sivu uudelleen nähdäksesi listojen muuttuvan.',
    'refused' => 'Sitä ei lähetetty',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Whitelistillä',
    'flag_banned' => 'Bannattu',
    'flag_seen' => 'On pelannut täällä',

    'online' => 'Paikalla nyt',
    'online_count' => ':online / :max',
    'online_none' => 'Kukaan ei ole yhteydessä.',

    'players' => 'Pelaajat',
    'ips' => 'Bannatut osoitteet',
    'ips_empty' => 'Yhtään osoitetta ei ole bannattu.',

    /*
     * Mitä tyhjä sivu tarkoittaa, mikä ei yleensä ole ”ei pelaajia” vaan ”tämä
     * palvelin ei ole koskaan käynnistynyt”. Minecraft ei luo yhtäkään näistä
     * tiedostoista ennen ensimmäistä ajoaan.
     */
    'empty' => 'Ei vielä mitään näytettävää. Minecraft kirjoittaa nämä listat itse, eikä se luo niitä ennen kuin palvelin on käynnistynyt ensimmäisen kerran.',

    'level' => 'Taso :level',

    /*
     * Se yksi asia, jota tämä sivu ei tee, sanottuna eikä jätettynä
     * löydettäväksi. Elävä tila vaatii toisen yhteyden itse peliin, mikä on eri
     * ominaisuus omine vaatimuksineen.
     */
    'not_live' => 'Tämä on se, mitä palvelin on kirjannut ylös, ei se, ketkä ovat paikalla juuri nyt.',
];
