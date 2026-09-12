<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Queue worker”, ”cron”, ”storage” ja polut jäävät täsmälleen sellaisiksi kuin
 * ne paneelin isäntäkoneella kirjoitetaan: ne kirjoitetaan kuoreen sellaisinaan.
 */

return [
    'updating_now' => 'Tämä paneeli asentaa päivitystä. Jokin sivu voi näyttää hetken oudolta.',
    'updating_done' => 'Päivitys on asennettu. Jos jokin sivu näytti hetki sitten oudolta, lataa se uudelleen.',
    'title' => 'Essentials-asetukset',
    'nav_label' => 'Essentials-asetukset',
    'save' => 'Tallenna',
    'saved' => 'Asetukset tallennettu',
    'save_failed' => 'Asetuksia ei saatu tallennettua',
    'update' => 'Päivitä',
    'update_available' => 'Päivitys on saatavilla',
    'update_confirm' => 'Paneeli lataa uuden version, rakentaa assettinsa uudelleen ja tyhjentää välimuistinsa. Asetuksesi säilyvät.',
    'update_started' => 'Päivitys aloitettu',
    'update_background' => 'Se ajetaan taustalla ja vie minuutin tai kaksi.',
    'update_failed' => 'Teemaa ei saatu päivitettyä',
    'update_done' => 'Teema päivitetty',
    'check' => 'Tarkista päivitykset',
    'check_failed' => 'Päivityssyötettä ei saatu luettua',
    'check_failed_body' => 'Paneeli ei tavoittanut sitä, tai se ei palauttanut kelvollista JSONia.',
    'up_to_date' => 'Ajat uusinta versiota',
    'reinstall' => 'Asenna uudelleen',

    'auto_on' => 'Päivitykset asentavat itsensä',

    /*
     * Mitä viimeisin automaattinen tarkistus teki. Kukin näistä nimeää sen
     * osan, jota pitäisi katsoa, koska selaimesta nämä kolme tapaa mennä
     * pieleen näyttävät kaikki samalta: alaspäin laskevalta luvulta.
     */
    'auto_never' => 'Yhtään tarkistusta ei ole vielä ajettu. Automaattiset päivitykset tarvitsevat paneelin ajastimen - sen cron-rivin, joka ajaa php artisan schedule:run joka minuutti. Ilman sitä mitään ajastettua ei tapahdu lainkaan.',
    'auto_ago' => 'Viimeksi tarkistettu :ago',
    'auto_just_now' => 'juuri äsken',
    'auto_minutes' => 'minuuttia sitten',
    'auto_current' => 'tällä kanavalla ei ole mitään uudempaa.',
    'auto_installed' => 'v:version asennettiin tässä, ja sen teki ajastettu tarkistus itse. Se tekee niin, kun yksikään queue worker ei vastaa, joten päivitys tapahtuu joka tapauksessa - mutta paneeli ilman workeria on paneeli, jossa muukaan jonossa oleva työ ei etene.',
    'auto_queued' => 'v:version annettiin queue workerille. Jos yllä oleva versio ei muutu muutamassa minuutissa, worker ottaa töitä vastaan mutta kaatuu juuri tähän - uudelleenkäynnistys on tavallisin korjaus, ja syy on hakemistossa storage/logs.',
    'auto_unreachable' => 'päivityssyötettä ei saatu luettua. Se haetaan internetistä, joten tämä on yleensä verkko- tai DNS-ongelma paneelin isäntäkoneella.',
    'auto_error' => 'tarkistus epäonnistui. Syy on hakemistossa storage/logs.',

    /*
     * Queue worker, joka on se, mikä päivityksen oikeasti suorittaa. Sanottu
     * erikseen yllä olevasta tarkistuksesta, koska ne menevät pieleen erikseen
     * ja parannuskeino on kummallekin eri.
     */
    'worker_missing' => 'Yksikään queue worker ei vastannut. Päivitykset ja modpack-asennukset laitetaan jonoon ja suorittaa worker-prosessi, joten kunnes sellainen ajaa, ne kirjataan ylös eikä niitä koskaan suoriteta, ilman virhettä missään. Joko workeria ei ole, tai sellainen on käynnistetty ennen tämän lisäosan asentamista eikä se voi ladata sen koodia - molemmat korjataan käynnistämällä se uudelleen paneelin isäntäkoneella. Aseta sen palvelu käynnistymään itse uudelleen, tai tämä palaa jokaisen päivityksen jälkeen.',
    'cron_missing' => 'Paneelin ajastin ei ole ajanut :for minuuttiin. Uusinnat, vahtikoiran tarkistukset ja automaattiset päivitykset odottavat kaikki sitä. Cron-rivi on Pelicanin dokumentaatiossa.',

    'next_check' => 'Seuraava tarkistus',
    'due_now' => 'nyt',

    /*
     * Nimetty syyn eikä oireen mukaan, koska oire on ”mitään ei tapahtunut” ja
     * juuri se teki tämän vaikeaksi paikantaa: tiedotteet, navigointilinkit,
     * tallennetut tyylit ja sivuasettelut ovat kaikki tiedostoja hakemistossa
     * storage/app, ja hakemisto, johon paneeli ei voi kirjoittaa, hukkaa
     * jokaisen niistä sanaakaan sanomatta.
     */
    'storage_failed' => 'Paneeli ei voinut kirjoittaa storage-hakemistoonsa, joten tätä ei tallennettu. Tarkista, että storage/app kuuluu sille käyttäjälle, jona paneeli ajaa. Syy on hakemistossa storage/logs.',

    /*
     * Sanottu jokaisen epäonnistuneen päivityksen jälkeen eikä vain
     * ristiriidan jälkeen. Yllä oleva viesti nimeää jo syyn; tämä nimeää sen
     * yhden parannuskeinon, jota ihminen ei voi päätellä lauseesta ”odotettiin
     * X, saatiin Y”.
     */
    'update_renamed' => 'Jos tässä sanotaan, että kaksi tunnusta eivät täsmää, lisäosa on nimetty uudelleen eikä yksikään päivitys ylitä sitä - Pelican tunnistaa asennetun lisäosan sen tunnuksesta. Poista vanha merkintä kohdasta Admin → Plugins ja asenna tämä puhtaalta pöydältä. Asetuksesi säilyvät: ne asuvat .env-tiedostossa ja hakemistossa storage/app/private/legend-theme, eikä kumpikaan ole avaimistettu tunnuksen mukaan.',
];
