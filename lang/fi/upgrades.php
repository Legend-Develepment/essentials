<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Käytössä olevan palvelun siirtäminen paketista toiseen.
 *
 * Sanamuoto pitää läpi tiedoston yhden asian selvänä: se mitä paketti maksaa
 * ja se mitä siihen vaihtaminen maksaa tänään ovat kaksi eri lukua.
 * Ensimmäinen on hyllyssä; toinen riippuu siitä, kuinka pitkällä maksetussa
 * jaksossa tämä palvelu on, ja juuri siihen ihminen suostuu painaessaan
 * painiketta.
 *
 * "Päivitys" on vältetty siinä mitä asiakas lukee, koska puolet näistä
 * siirroista menevät toiseen suuntaan. Täällä sana on vaihto.
 */

return [
    // ---- palvelukortilla -------------------------------------------------
    'change' => 'Vaihda pakettia',
    'change_body' => 'Se mitä jo maksamastasi jaksosta on jäljellä otetaan pois, ja samat päivät veloitetaan uuteen hintaan. Mitään palvelimeltasi ei menetetä.',
    'change_to' => 'Vaihda pakettiin :name',
    'change_confirm' => 'Vaihdetaanko tämä palvelu pakettiin :name?',
    'change_free' => 'Ei mitään maksettavaa',
    'costs_now' => ':amount nyt',
    'gives_back' => ':amount takaisin',
    'waiting' => 'Vaihdosta on sovittu',
    'waiting_for' => 'Vaihto pakettiin :name odottaa maksamatonta laskua.',

    // ---- mitä sen jälkeen tapahtuu ---------------------------------------
    'done' => 'Siirretty pakettiin :name',
    'done_body' => 'Palvelusi on uudessa paketissa. Kaikki mitä sinulle oltiin velkaa on tililläsi.',
    'refused' => 'Vaihtoa ei tehty',

    // ---- ja miksi ei, yksi syy kerrallaan --------------------------------
    'refused_off' => 'Paketin vaihtaminen on pois päältä tässä paneelissa.',
    'refused_not_active' => 'Vain käynnissä olevan palvelun voi vaihtaa. Odottavassa, keskeytetyssä tai päättymässä olevassa ei ole mitään laskettavaa.',
    'refused_gone' => 'Pakettia jossa tämä palvelu on ei ole enää olemassa, joten mihinkään ei voi verrata.',
    'refused_same' => 'Se on se paketti jossa se jo on.',
    'refused_egg' => 'Tuo paketti ajaa toista ohjelmistoa. Siitä tulisi toinen palvelin eikä isompi, joten se on ostettava sellaisena.',
    'refused_period' => 'Tuo paketti laskutetaan eri jaksolla, mikä on eri sopimus eikä isompi.',
    'refused_stock' => 'Tuo paketti on loppuunmyyty.',
    'refused_waiting' => 'Tälle palvelulle odottaa jo yksi vaihto maksamatonta laskua. Maksa tai peru se ensin.',
    'refused_failed' => 'Mitään ei kirjattu ylös, joten mikään ei ole muuttunut. Yritä uudelleen, ja kerro sille joka pitää tätä paneelia jos se jatkuu.',
    'refused_server' => 'Palvelimelle ei saatu annettua uusia rajoja, joten palvelu jätettiin täsmälleen sellaiseksi kuin se oli. Sille joka pitää tätä paneelia on kerrottu.',

    // ---- mitä asiakirjoissa lukee ----------------------------------------
    'line' => 'Vaihto paketista :from pakettiin :to, tämän jakson jäljellä olevilta :days päivältä',
    'credit_reason' => 'Vaihto pakettiin :name',

    // ---- ja mitä omistajalle kerrotaan -----------------------------------
    'bell_failed' => 'Paketin vaihto epäonnistui tilauksessa :number',
    'cold_title' => 'Paketin vaihto tuli paneeliin mutta ei nodelle, tilauksessa :number',
    'cold_body' => 'Palvelu on paketissa :name ja uudet rajat on kirjattu. Node ei ole vielä ottanut niitä ja lukee ne seuraavan kerran kun se palvelin käynnistyy, joten siihen asti asiakkaalla on yhä vanha koko. Tarkista node.',
    'gone' => 'Pakettia johon oltiin siirtymässä ei ole enää olemassa.',
    'refused_by_node' => 'Palvelin ei ottanut uusia rajoja vastaan: :why',

    // ---- asian oikaiseminen ----------------------------------------------
    'retry' => 'Yritä vaihtoa uudelleen',
    'retry_confirm' => 'Yritä paketin vaihtoa uudelleen. Sen lasku on jo maksettu, joten mitään ei veloiteta kahteen kertaan.',
    'retried' => 'Vaihto meni läpi',
    'retry_failed' => 'Se epäonnistui uudelleen. Syy on tilauksella.',
];
