<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Kaupan asetukset, ja myöhemmin kauppa itse.
 *
 * Kaksi lukijaa jakaa tämän tiedoston tarkoituksella. Asetuspuoliskon lukee
 * ylläpitäjä; julkisen ja asiakaspuoliskon - jotka tulevat mukaan kaupan
 * kasvaessa - lukevat ihmiset, jotka eivät ehkä ole koskaan kuulleet
 * Pelicanista, ja jokainen lause siellä on kirjoitettava heille.
 */

return [
    'title' => 'Kaupan asetukset',
    'nav_label' => 'Kaupan asetukset',
    'subheading' => 'Valuutta, vero, laskujen numerointi ja se, mitä julkinen sivu sanoo. Se, mitä on myynnissä, on Paketit-sivulla.',

    // ---- missä se on -----------------------------------------------------
    'address' => 'Julkinen kauppa on osoitteessa',
    'address_off' => 'Julkinen sivu on pois päältä. Kytke ”Julkinen kauppasivu” päälle Essentials-asetukset-sivun toimintolistasta, niin se vastaa osoitteessa :url.',

    // ---- yleistä ---------------------------------------------------------
    'section_general' => 'Raha',
    'section_general_helper' => 'Yksi valuutta koko kaupalle. Jokainen jokaisen paketin hinta on luku siinä.',
    'currency' => 'Valuutta',
    'currency_helper' => 'Vaihtaminen ei muunna mitään: pakettien hinnat ovat lukuja, ja vaihdon jälkeen ne ovat lukuja uudessa valuutassa.',
    'tax' => 'Vero',
    'tax_helper' => 'Prosentti, joka lisätään jokaiselle laskulle omana rivinään. Pakettien hinnat ovat verottomia. Nolla, jos ei ole.',
    'tax_suffix' => '%',
    'prefix' => 'Laskunumerot alkavat',
    'prefix_helper' => 'Perässä kasvava numero. INV- antaa INV-000001.',

    // ---- uusinnat --------------------------------------------------------
    'section_renewals' => 'Uusinnat',
    'section_renewals_helper' => 'Paketeille, jotka laskutetaan kuukausittain, neljännesvuosittain tai vuosittain. Kertamaksullista pakettia tämä ei koske koskaan.',
    'notice_days' => 'Laskuta näin monta päivää ennen jakson päättymistä',
    'notice_days_helper' => 'Milloin seuraava lasku tehdään ja asiakkaalle kerrotaan siitä.',
    'grace' => 'Keskeytä näin monta päivää laskun eräpäivän jälkeen',
    'grace_helper' => 'Tämän yli maksamaton lasku keskeyttää palvelimen — Pelicanin omalla keskeytyksellä, joka poistuu heti, kun lasku on maksettu. Kauppa ei koskaan poista mitään.',
    'days' => 'päivää',

    // ---- julkinen sivu ---------------------------------------------------
    'section_public' => 'Julkinen sivu',
    'section_public_helper' => 'Lukijoina ovat ihmiset ilman tiliä. Näytetäänkö sitä ylipäätään, on toimintolistan kytkin ”Julkinen kauppasivu”.',
    'heading' => 'Otsikko',
    'heading_helper' => 'Tyhjäksi jätettynä käytetään paneelin omaa nimeä.',
    'note' => 'Rivi pakettien yläpuolella',
    'note_helper' => 'Kertoaksesi kuka olet, tai mitä ostaminen tuo. Pelkkää tekstiä.',
    'terms_url' => 'Ehdot',
    'terms_url_helper' => 'https-osoite. Jos se on asetettu, ostaminen tarkoittaa siihen viittaavan ruudun rastittamista.',

    // ---- maksaminen käsin ------------------------------------------------
    'section_manual' => 'Maksaminen ilman palveluntarjoajaa',
    'section_manual_helper' => 'Näytetään maksamattomalla laskulla, kun mitään maksupalvelua ei ole kytketty päälle: pankkitiedot tai minne rahat lähetetään. Pelkkää tekstiä.',
    'pay_note' => 'Kuinka maksaa',
    'pay_note_helper' => 'Jätä tyhjäksi, niin maksamaton lasku sanoo vain olevansa maksamaton.',

    // ---- painikkeet ------------------------------------------------------
    'save' => 'Tallenna',
    'saved' => 'Tallennettu',
    'save_failed' => 'Mitään ei tallennettu',
];
