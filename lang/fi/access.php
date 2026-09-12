<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Subuser”, ”Wings”, ”SFTP”, ”cron” ja ”root admin” jäävät paikalleen: ne ovat
 * Pelicanin ja isäntäkoneen sanat, ja niitä rivin etsijä hakee.
 */

return [
    'nav_label' => 'Palvelinpääsy',
    'title' => 'Palvelimet roolin mukaan',
    'subheading' => 'Anna kaikille roolin haltijoille pääsy samoille palvelimille.',

    /*
     * Sanottu ennen kaikkea muuta sivulla, koska tämä on täällä se ainoa
     * ominaisuus, joka kirjoittaa Pelicanin omistamaan tauluun.
     */
    'more' => 'Näin tämä toimii',
    'warning' => 'Tämä toimii pitämällä Pelicanin omat subuserit ajan tasalla - samat rivit, jotka lisäisit käsin palvelimen Users-sivulla, ja juuri niitä palvelinlista, oikeustarkistukset ja Wings kaikki lukevat. Se koskee vain itse luomiaan rivejä: mitään käsin lisäämääsi ei koskaan muuteta eikä poisteta. Kenellekään ei lähetetä sähköpostia, kun rooli antaa hänelle palvelimen. Pääsyn poistaminen peruu myös heidän SFTP:nsä, mikä vaatii sen queue workerin, jota Pelican jo pyytää.',

    'never' => 'Mitään ei ole vielä täsmäytetty. Tallenna alla oleva kytkentä, niin se tapahtuu heti, ja sen jälkeen joka minuutti paneelin omalla cronilla.',
    'timing' => 'Pääsy poistetaan sillä hetkellä, kun sen kuuluu: roolinsa menettävä menettää palvelimet heti seuraavalla sivullaan. Antaminen voi kestää minuutin, koska se on se pyyhkäisy, joka etsii niitä, jotka eivät juuri nyt käytä paneelia.',
    'last_run' => 'Viimeisin ajo :ago sekuntia sitten: :added lisätty, :removed poistettu, :held ennallaan.',
    'capped' => 'Liikaa kerralla - :pairs myöntöä, ja raja on :max. Mitään ei kirjoitettu. Kavenna kytkentää: rooli, jolla on viisikymmentä ihmistä ja kaksikymmentä palvelinta, on jo yksinään tuhat myöntöä.',

    'which' => 'Kytkennät',
    'which_helper' => 'Rooli, ne palvelimet jotka jokaisen sen haltijan pitäisi tavoittaa, ja mitä he siellä saavat tehdä. Kahdessa roolissa oleva saa kaiken, mitä molemmat antavat. Palvelinten omistajat ja root adminit ohitetaan - heillä on jo enemmän kuin tämä voisi antaa.',
    'add' => 'Lisää rooli',

    'role' => 'Rooli',
    'role_helper' => 'Jokainen sen haltija, myös se, joka saa sen myöhemmin.',
    'servers' => 'Palvelimet',
    'servers_helper' => 'Ne palvelimet, jotka he saavat. Yhden poistaminen täältä poistaa sen pääsyn taas.',

    'permissions' => 'Mitä he saavat tehdä',
    'permissions_helper' => 'Pelicanin omat subuser-oikeudet. Jätä ne ennalleen saadaksesi järkevän joukon: konsoli, virtapainikkeet, tiedostot, varmuuskopiot ja toimintaloki - eikä mitään, mikä muokkaa palvelinta, sen käyttäjiä, tietokantoja tai allokaatioita. Connect to websocket on aina mukana, koska ilman sitä konsolisivu ei yhdisty mihinkään.',

    'save' => 'Tallenna ja toteuta',
    'saved' => 'Tallennettu',
    'saved_body' => ':added myönnetty, :removed otettu takaisin.',
    'save_failed' => 'Tallennus ei onnistunut',
    'save_failed_disk' => 'Listaa ei saatu kirjoitettua storage-hakemistoon. Tarkista, että storage/app kuuluu sille käyttäjälle, jona paneeli ajaa.',

    'revoke' => 'Ota kaikki takaisin',
    'revoke_confirm' => 'Poistetaanko kaikki, mitä tämä on myöntänyt?',
    'revoke_confirm_helper' => 'Jokainen tämän sivun luoma subuser-rivi, jokaisella palvelimella, jokaiselta - ja heidän SFTP:nsä sen mukana. Käsin lisäämiisi riveihin ei kosketa. Alla olevat kytkennät jäävät, joten seuraava tallennus tai seuraava ajastin myöntäisi ne uudelleen: tyhjennä lista ensin, jos tarkoitat sitä pysyvästi.',
    'revoked' => 'Poistettu: :count',
    'revoked_body' => 'Vain tämän sivun luomat rivit. Kaikki käsin lisätty on siellä, missä olikin.',
    'revoke_failed' => 'Niitä ei saatu poistettua',
];
