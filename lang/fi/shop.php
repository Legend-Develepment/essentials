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

    /* ---------------------------------------------------------------------
     * Itse kauppa, tästä alaspäin.
     *
     * Aivan toisenlainen lukija: joku joka ostaa palvelimen, joka ei ehkä ole
     * koskaan kuullutkaan Pelicanista eikä tiedä mikä egg on. Mikään alla ei
     * käytä paneelin sanoja, ja jokainen lause vastaa siihen kysymykseen joka
     * asiakkaalla siinä kohtaa sivua oikeasti on.
     * ------------------------------------------------------------------- */

    // ---- kauppa ----------------------------------------------------------
    'store_title' => 'Kauppa',
    'store_nav_label' => 'Kauppa',
    'store_subheading' => 'Valitse palvelin. Se luodaan sinulle heti kun lasku on maksettu.',
    'store_empty' => 'Juuri nyt ei ole mitään myynnissä',
    'store_empty_body' => 'Tule myöhemmin uudelleen tai kysy siltä joka pitää tätä paneelia.',

    'buy' => 'Osta',
    'sold_out' => 'Loppuunmyyty',
    'plus_setup' => 'lisäksi :amount kerran',

    'spec_memory' => 'Muistia :amount MiB',
    'spec_disk' => 'Levyä :amount MiB',
    'spec_cpu' => 'CPU :amount%',
    'spec_backups' => 'Varmuuskopioita: :count',
    'spec_databases' => 'Tietokantoja: :count',

    // ---- julkinen sivu ---------------------------------------------------
    'public_empty' => 'Juuri nyt ei ole mitään myynnissä',
    'public_empty_body' => 'Tule myöhemmin uudelleen.',
    'to_panel' => 'Kirjaudu sisään',
    'terms' => 'Ehdot',
    'sign_in_note' => 'Valitse palvelin alta. Kirjaudut sisään viimeistelläksesi, ja se luodaan kun lasku on maksettu.',

    // ---- tilaaminen ------------------------------------------------------
    'checkout_title' => 'Tilaus',
    'tax_line' => 'Vero (:rate%)',
    'coupon' => 'Alennuskoodi',
    'coupon_placeholder' => 'Jos sinulla on sellainen',
    'coupon_bad' => 'Tuo koodi ei päde tässä.',
    'coupon_good' => 'Koodi käytetty.',
    'agree' => 'Hyväksyn',
    'place_order' => 'Tee tilaus',
    'place_order_note' => 'Tämä kirjoittaa laskun. Mitään ei veloiteta ennen kuin maksat, ja palvelin luodaan kun lasku on maksettu.',
    'back_to_store' => 'Takaisin kauppaan',

    'placed' => 'Tilaus tehty',
    'placed_body' => 'Lasku :number odottaa laskutussivullasi.',

    'refused' => 'Tuota ei voitu ostaa',
    'refused_gone' => 'Se ei ole enää myynnissä.',
    'refused_sold_out' => 'Viimeinen meni.',
    'refused_bad_coupon' => 'Alennuskoodi ei päde tähän.',
    'refused_failed' => 'Jokin meni pieleen tilausta kirjoitettaessa. Mitään ei veloitettu. Yritä uudelleen ja kerro sille joka pitää tätä paneelia, jos se jatkuu.',

    // ---- laskutus --------------------------------------------------------
    'billing_title' => 'Laskutus',
    'billing_nav_label' => 'Laskutus',
    'billing_subheading' => 'Mitä olet ostanut ja mitä olet velkaa.',
    'your_orders' => 'Tilauksesi',
    'your_invoices' => 'Laskusi',
    'no_orders' => 'Et ole vielä ostanut mitään',
    'no_orders_body' => 'Kaikki mitä ostat näkyy täällä palvelimineen ja päivineen.',
    'no_invoices' => 'Ei vielä laskuja',
    'to_store' => 'Kauppaan',
    'renews' => 'Uusiutuu',
    'ask_how_to_pay' => 'Kysy siltä joka pitää tätä paneelia, miten maksat. Hän ei ole vielä kirjoittanut sitä tähän.',
    'order_pending' => 'Odottaa laskun maksamista. Heti sen jälkeen palvelin luodaan.',
    'order_suspended' => 'Pysäytetty maksamattoman laskun takia. Maksaminen käynnistää palvelimen taas - mitään ei ole poistettu.',

    // ---- maksaminen ------------------------------------------------------
    'pay_with' => 'Maksa tavalla',
    'pay_now' => 'Maksa',
    'pay_description' => 'Lasku :number',
    'pay_thanks' => 'Kiitos. Lasku on maksettu.',
    'pay_pending' => 'Palveluntarjoaja ei ole vielä vahvistanut sitä. Tämä sivu päivittyy heti kun he vahvistavat.',
    'pay_refused' => 'Se ei lähtenyt käyntiin',
    'pay_refused_body' => 'Maksua ei saatu avattua. Kokeile toista tapaa tai kysy siltä joka pitää tätä paneelia.',
    'gateway_mollie' => 'Mollie',

    // ---- palveluntarjoajan asetukset -------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Ottaa vastaan iDEALin, kortit, Bancontactin ja loput yhden tilin kautta. Testi ja tuotanto ovat sama asetus: avain itse kertoo, mille tilille se kuuluu.',
    'mollie_on' => 'Tarjoa Mollieta',
    'mollie_on_helper' => 'Pois päältä ottaa painikkeen pois jokaisesta laskusta. Jo maksettu pysyy maksettuna.',
    'mollie_key' => 'API-avain',
    'mollie_key_helper' => 'Mollie-hallintasi Developers-osiosta. Sitä ei koskaan kirjoiteta vietyyn asetustiedostoon.',
    'mollie_hook' => 'Webhook-osoite',
    'mollie_hook_helper' => 'Mollie ilmoittaa osoitteeseen :url - paneelisi on oltava siellä tavoitettavissa internetistä.',
];
