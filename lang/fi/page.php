<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Queue worker”, ”cron”, ”storage” ja polut jäävät täsmälleen sellaisiksi kuin
 * ne paneelin isäntäkoneella kirjoitetaan: ne kirjoitetaan kuoreen sellaisinaan.
 */

return [
    'title' => 'Essentials-asetukset',
    'nav_label' => 'Essentials-asetukset',
    'save' => 'Tallenna',
    'saved' => 'Asetukset tallennettu',
    'save_failed' => 'Asetuksia ei saatu tallennettua',
    'secret_kept' => 'Tallennettu. Jätä tyhjäksi säilyttääksesi, tai kirjoita uusi korvataksesi.',
    'update_background' => 'Se ajetaan taustalla ja vie minuutin tai kaksi.',

    /*
     * Queue worker ja ajastin (scheduler), joista jokainen taustatyö ja
     * ajastettu tehtävä riippuu. Sanottu erikseen, koska ne menevät pieleen
     * erikseen ja parannuskeino on kummallekin eri.
     */
    'worker_missing' => 'Yksikään queue worker ei vastannut. Modpack-asennukset, sähköpostit ja muut taustatyöt laitetaan jonoon ja suorittaa worker-prosessi, joten kunnes sellainen ajaa, ne kirjataan ylös eikä niitä koskaan suoriteta, ilman virhettä missään. Joko workeria ei ole, tai sellainen on käynnistetty ennen tämän lisäosan asentamista eikä se voi ladata sen koodia - molemmat korjataan käynnistämällä se uudelleen paneelin isäntäkoneella. Aseta sen palvelu käynnistymään itse uudelleen, tai tämä palaa jokaisen päivityksen jälkeen.',
    'cron_missing' => 'Paneelin ajastin ei ole ajanut :for minuuttiin. Uusinnat ja vahtikoiran tarkistukset odottavat sitä. Cron-rivi on Pelicanin dokumentaatiossa.',

    /*
     * Nimetty syyn eikä oireen mukaan, koska oire on ”mitään ei tapahtunut” ja
     * juuri se teki tämän vaikeaksi paikantaa: tiedotteet, navigointilinkit,
     * tallennetut tyylit ja sivuasettelut ovat kaikki tiedostoja hakemistossa
     * storage/app, ja hakemisto, johon paneeli ei voi kirjoittaa, hukkaa
     * jokaisen niistä sanaakaan sanomatta.
     */
    'storage_failed' => 'Paneeli ei voinut kirjoittaa storage-hakemistoonsa, joten tätä ei tallennettu. Tarkista, että storage/app kuuluu sille käyttäjälle, jona paneeli ajaa. Syy on hakemistossa storage/logs.',
];
