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
    'grace_helper' => 'Tämän yli maksamaton lasku keskeyttää palvelimen — Pelicanin omalla keskeytyksellä, joka poistuu heti, kun lasku on maksettu. Keskeytys itsessään ei poista mitään.',
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
    'to_account' => 'Oma tili',
    'filter_all' => 'Kaikki',
    'filter_label' => 'Näytä',
    'includes' => 'Sisältää',
    'public_count' => ':count myynnissä',

    // ---- tilaaminen ------------------------------------------------------
    'checkout_title' => 'Tilaus',
    'tax_line' => 'Vero (:rate%)',
    'coupon' => 'Alennuskoodi',
    'asks' => 'Palvelimestasi',
    'upload_default' => 'Tiedostosi',
    'upload_help' => 'Zip-tiedosto. Se viedään palvelimellesi, kun se rakennetaan.',
    'upload_busy' => 'Ladataan…',
    'what_is_this' => 'Mikä tämä on?',
    'leave_as_is' => 'Jätä se ennalleen',
    'asks_optional' => 'Kaikki nämä ovat vapaaehtoisia. Se, mihin et koske, säilyttää sen, mikä palvelinmallissa jo oli.',
    'refused_no_file' => 'Tämä paketti tarvitsee tiedoston, eikä sellaista valittu.',
    'refused_not_zip' => 'Sen on oltava zip-tiedosto.',
    'refused_too_big' => 'Tuo tiedosto on liian suuri, jotta tämä paneeli ottaisi sen vastaan.',
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
    'server_installing' => 'Laitetaan vielä pystyyn. Se käynnistyy itsestään, kun se on valmis.',
    'server_failed' => 'Pystytys ei mennyt loppuun. Sille joka pitää tätä paneelia on kerrottu.',
    'server_suspended' => 'Paneeli on keskeyttänyt sen. Mitään sillä olevaa ei ole poistettu.',
    'server_restoring' => 'Varmuuskopiota palautetaan. Siinä menee muutama minuutti.',
    'give' => 'Päätä tämä palvelu',
    'give_end' => 'Päätä se sinä päivänä',
    'give_end_on' => 'Päätä se :date',
    'give_end_body' => 'Se käy :date asti eikä sitä laskuteta sinulta enää. Kaikki sillä oleva poistetaan sinä päivänä, joten kopioi talteen se, minkä haluat säilyttää.',
    'give_end_open' => 'Ei ole päivää johon asti odottaa, joten tämän päättäminen lopettaa laskutuksen ja jättää palvelimen paikoilleen kunnes joku poistaa sen.',
    'give_end_confirm' => 'Päätetäänkö tämä palvelu :date? Se käy siihen asti eikä sitä laskuteta enää.',
    'give_now' => 'Pysäytä ja poista nyt',
    'give_now_confirm' => 'Poistetaanko tämä palvelin nyt, tiedostoineen, tietokantoineen ja varmuuskopioineen? Tätä ei voi perua, eikä maksamastasi jaksosta hyvitetä jäljellä olevaa osaa.',
    'gave_end' => 'Ilmoitus tehty',
    'gave_end_body' => 'Se käy kortissa näkyvään päivään asti eikä sitä laskuteta enää. Mitään ei poisteta ennen sitä.',
    'gave_now' => 'Poissa',
    'gave_now_body' => 'Palvelin on poistettu eikä sitä laskuteta sinulta enää.',
    'gave_refused' => 'Se ei onnistunut',
    'gave_refused_body' => 'Mitään ei muutettu. Lataa sivu uudelleen, ja kysy siltä joka pitää tätä paneelia jos se jatkuu.',
    'ask_how_to_pay' => 'Kysy siltä joka pitää tätä paneelia, miten maksat. Hän ei ole vielä kirjoittanut sitä tähän.',
    'order_pending' => 'Odottaa laskun maksamista. Heti sen jälkeen palvelin luodaan.',
    'order_suspended' => 'Pysäytetty maksamattoman laskun takia. Maksaminen käynnistää palvelimen taas - mitään ei ole poistettu.',
    'order_ending' => 'Päättyy :date. Sitä ei laskuteta enää, ja kaikki sillä oleva poistetaan sinä päivänä.',
    'order_ending_open' => 'Peruttu. Sitä ei laskuteta enää, ja se käy siihen asti kunnes se poistetaan.',

    // ---- maksaminen ------------------------------------------------------
    'pay_with' => 'Maksa tavalla',
    'pay_now' => 'Maksa',
    'pay_description' => 'Lasku :number',
    'pay_thanks' => 'Kiitos. Lasku on maksettu.',
    'pay_pending' => 'Palveluntarjoaja ei ole vielä vahvistanut sitä. Tämä sivu päivittyy heti kun he vahvistavat.',
    'pay_refused' => 'Se ei lähtenyt käyntiin',
    'pay_refused_body' => 'Maksua ei saatu avattua. Kokeile toista tapaa tai kysy siltä joka pitää tätä paneelia.',
    'check' => 'Testaa maksupalvelujen avaimet',
    'check_ok' => 'toimii',
    'check_bad' => 'hylkäsi',
    'check_good' => 'Avaimet toimivat, ja tämä palveluntarjoaja vastaa.',
    'check_off' => 'Pois päältä, joten mitään ei ollut kysyttävää.',
    'check_none' => 'Yhtään palveluntarjoajaa ei ole kytketty päälle',
    'check_none_body' => 'Kytke yksi päälle alta, täytä sen avaimet, tallenna ja paina tätä uudelleen.',
    'check_no_key' => 'Tälle ei ole täytetty yhtään avainta.',
    'check_refused' => 'Palveluntarjoaja hylkäsi nämä avaimet. Se vastasi HTTP :status.',
    'check_paypal' => 'PayPal hylkäsi nämä avaimet. Se vastasi HTTP :status, ja tämä paneeli on asetettu :where — avainten on tultava heidän hallintansa siltä välilehdeltä.',
    'check_sandbox' => 'testiympäristöön',
    'check_live' => 'tuotantoon',
    'check_ellipsis' => 'Client ID päättyy pisteeseen, eli kopioitu on hallinnan lyhennetty teksti eikä koko avain. Käytä sen vieressä olevaa kopiointipainiketta ja tallenna uudelleen.',
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

    'gateway_stripe' => 'Stripe',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Ottaa kortit vastaan sivulla, jonka Stripe itse piirtää, joten kortin numero ei koskaan päädy tähän paneeliin. Testi ja tuotanto ovat avaimen etuliitteessä, eivät kytkimessä.',
    'stripe_on' => 'Tarjoa Stripea',
    'stripe_on_helper' => 'Pois päältä ottaa painikkeen pois jokaisesta laskusta. Jo maksettu pysyy maksettuna.',
    'stripe_key' => 'Salainen avain',
    'stripe_key_helper' => 'Se joka alkaa sk_, kohdasta Developers, API keys. Sitä ei koskaan kirjoiteta vietyyn asetustiedostoon.',
    'stripe_hook' => 'Allekirjoitussalaisuus',
    'stripe_hook_key_helper' => 'Se whsec_-arvo, jonka Stripe näyttää kun lisäät alla olevan osoitteen. Ilman sitä heidän viestejään ei voi todistaa aidoiksi, ja ne ohitetaan.',
    'stripe_hook_helper' => 'Lisää :url endpointiksi kohtaan Developers, webhooks, tapahtumalle checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Ainoa palveluntarjoaja, jolla raha liikkuu asiakkaan palatessa eikä silloin kun hän on vielä PayPalissa - suljettu välilehti jättää siis maksamattoman laskun eikä kadonnutta maksua.',
    'paypal_on' => 'Tarjoa PayPalia',
    'paypal_on_helper' => 'Pois päältä ottaa painikkeen pois jokaisesta laskusta. Jo maksettu pysyy maksettuna.',
    'paypal_sandbox' => 'Testiympäristö',
    'paypal_sandbox_helper' => 'Puhuu PayPalin testitilin kanssa oikean sijaan. Heidän client id -tunnuksensa näyttävät samalta kummassakin tapauksessa, ja juuri siksi tämä kytkin on olemassa.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Sovelluksesta, jonka teit kohdassa Apps & Credentials. Katso, että välilehti vastaa yllä olevaa kytkintä.',
    'paypal_secret_helper' => 'Client ID:n vieressä, Show-painikkeen takana. Sitä ei koskaan kirjoiteta vietyyn asetustiedostoon.',
    'paypal_hook' => 'Webhookin tunnus',
    'paypal_hook_id_helper' => 'Tunnus, jonka PayPal antaa webhookille lisäämisen jälkeen - ei osoite. Ilman sitä heidän viestejään ei voi tarkistaa heiltä, ja ne ohitetaan.',
    'paypal_hook_helper' => 'Lisää :url webhookiksi siihen sovellukseen, tapahtumalle PAYMENT.CAPTURE.COMPLETED, ja liitä saatu tunnus tähän.',

    // ---- maksusivu -------------------------------------------------------
    'pay_title' => 'Maksa',
    'pay_subheading' => 'Mitä olet velkaa ja millä tavoilla sen voi hoitaa.',
    'pay_choose' => 'Miten haluat maksaa?',
    'pay_choose_body' => 'Valitsitpa minkä tahansa, viimeistelet sen heidän omalla sivullaan ja palaat heti sen jälkeen tänne.',
    'pay_safe' => 'Sinut lähetetään maksamaan palveluntarjoajalle. Korttitietosi eivät koskaan päädy tähän paneeliin.',
    'pay_no_ways' => 'Heti kun raha saapuu, lasku merkitään maksetuksi ja palvelimesi laitetaan pystyyn.',
    'free' => 'Ei mitään maksettavaa',
    'free_body' => 'Alennuskoodi kattoi tämän laskun kokonaan, joten maksua ei tule. Paina nappia, niin se on hoidettu.',
    'free_go' => 'Valmis',
    'free_done' => 'Hoidettu',
    'free_done_body' => 'Maksettavaa ei ollut, joten lasku on suljettu. Palvelintasi laitetaan nyt pystyyn.',
    'pay_gone' => 'Sellaista laskua ei ole',
    'pay_gone_body' => 'Se on ehkä peruutettu, tai osoite on väärä.',
    'pay_already' => 'Tämä on maksettu',
    'pay_already_body' => 'Muuta ei tarvita. Kaikki sitä odottanut on jo matkalla.',
    'pay_withdrawn' => 'Tämä peruutettiin',
    'pay_withdrawn_body' => 'Se on pois kirjanpidosta eikä sitä tarvitse maksaa. Jos tuo näyttää oudolta, kysy siltä joka pitää tätä paneelia.',
    'back_to_billing' => 'Takaisin laskutukseen',

    'gateway_mollie_note' => 'iDEAL, Bancontact, kortti ja muita',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'PayPal-saldosi tai kortti PayPalin kautta',

    // ---- palvelut ja laskut, erikseen ------------------------------------
    'services_title' => 'Omat palveluni',
    'services_nav_label' => 'Omat palveluni',
    'services_subheading' => 'Se mistä maksat, ja palvelin joka kustakin tuli.',
    'open_server' => 'Avaa palvelin',
    'no_server_yet' => 'Laitetaan pystyyn',

    'invoices_title' => 'Laskut',
    'invoices_subheading' => 'Mitä sinulta on laskutettu ja mitä on vielä maksettavana.',
    'no_invoices_body' => 'Kaikki mitä ostat laskutetaan täällä, ja jää tänne senkin jälkeen kun se on maksettu.',

    // ---- kauppa aloitussivuna --------------------------------------------
    'section_landing' => 'Missä kauppa istuu',
    'section_landing_helper' => 'Onko kauppa paneelin etuovi, asiakkaille ja niille, jotka eivät ole kirjautuneet sisään.',
    'landing' => 'Avaa ensin kauppa',
    'landing_helper' => 'Päällä kauppa on ensimmäinen sivu sisäänkirjautumisen jälkeen ja palvelinlista siirtyy sen viereen. Palvelusi ja laskusi pysyvät yhden klikkauksen päässä, kaupan yläosassa ja tilivalikossa. Se joka ei ole kirjautunut sisään saa julkisen kaupan sisäänkirjautumislomakkeen sijaan, ja häntä pyydetään kirjautumaan vasta kun hän valitsee paketin - tämä vaatii siis myös julkisen kauppasivun olevan päällä. Pois päältä paneeli avautuu palvelinlistaan sellaisena kuin Pelican sen piirtää, se joka ei ole kirjautunut sisään saa sisäänkirjautumislomakkeen, ja kauppa on sivu kuten muutkin.',
    'self_cancel' => 'Anna asiakkaiden päättää palvelunsa itse',
    'self_cancel_helper' => 'Kaksi tietä ulos heidän palvelusivullaan: päättää se sopimuspäivänään, mikä lopettaa laskutuksen ja poistaa palvelimen sinä päivänä joka heille kerrottiin, tai pysäyttää se nyt, mikä poistaa sen heti. Molemmat ovat samat painikkeet jotka sinulla on Tilaukset-sivulla. Pois päältä kumpaakaan ei tarjota, ja palvelun päättäminen on asia jota heidän on pyydettävä sinulta.',
];
