<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Palvelinsivun ohjausrivi. Oma tiedostonsa eikä nurkka settings.php:ssä, koska
 * tämän lukevat paneelin käyttäjät eivätkä ne, jotka teemaa säätävät.
 *
 * Painikkeiden vieressä oleva tila on Pelicanin oma sana, otettu suoraan
 * ContainerStatus-luettelosta, jotta rivi ja konsolisivu eivät koskaan ole eri
 * mieltä siitä, mitä palvelin tekee.
 *
 * ”Kill” jää englanniksi: se on Pelicanin oman painikkeen ja komennon nimi, ja
 * se on eri asia kuin pysäyttäminen.
 */

return [
    'console' => 'Konsoli',
    'full_page' => 'Uusi ikkuna',
    'close' => 'Sulje',

    'start' => 'Käynnistä',
    'restart' => 'Käynnistä uudelleen',
    'stop' => 'Pysäytä',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill pysäyttää kontin siihen paikkaan. Kaikki, mitä palvelin ei ole vielä kirjoittanut levylle, menetetään. Jatketaanko?',

    'sent_title' => 'Virtakomento',
    'sent_body' => ':action lähetettiin palvelimelle :name.',
    'failed' => 'Nodea ei tavoitettu.',
];
