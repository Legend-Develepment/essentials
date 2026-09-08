<?php

/*
 * Suomi. Kirjoitettu käsin.
 *
 * Alennuskoodit: koodit, jotka ottavat jotain pois ensimmäisestä laskusta.
 *
 * Vain ensimmäisestä, tarkoituksella, ja teksti sanoo sen siellä missä sillä on
 * väliä. Koodi joka alentaisi myös jokaisen uusimisen olisi hinnanmuutos, jolla
 * on päättymispäivä, ja se joka sitä haluaa, muuttakoon hintaa.
 */

return [
    'title' => 'Alennuskoodit',
    'nav_label' => 'Alennuskoodit',
    'subheading' => 'Koodit jotka ottavat prosentin tai summan pois ensimmäisestä laskusta. Uusimiset menevät paketin hinnalla.',

    // ---- taulukko --------------------------------------------------------
    'column_code' => 'Koodi',
    'column_value' => 'Arvo',
    'column_uses' => 'Käytetty',
    'column_expires' => 'Vanhenee',
    'column_packages' => 'Koskee',
    'column_live' => 'Käytössä',

    'never_expires' => 'Ei päättymispäivää',
    'all_packages' => 'Kaikkea',
    'some_packages' => 'Paketteja: :count',
    'usable' => 'Käyttökelpoinen juuri nyt',
    'unusable' => 'Pois päältä, vanhentunut tai käytetty loppuun',

    // ---- painikkeet ------------------------------------------------------
    'new' => 'Uusi koodi',
    'edit' => 'Muokkaa',
    'delete' => 'Poista',
    'delete_confirm' => 'Poistaa koodin. Laskut jotka jo käyttivät sitä pitävät alennuksensa - jokainen säilyttää itse tiedon siitä, mitä siitä vähennettiin.',
    'deleted' => 'Koodi poistettu',
    'saved' => 'Koodi tallennettu',
    'save_failed' => 'Koodia ei saatu tallennettua',
    'taken' => 'Jokin muu käyttää jo tuota koodia.',
    'invalid' => 'Prosentti on kokonaisluku väliltä 1-100. Summa kirjoitetaan muodossa 12.50 tai 12,50.',

    // ---- lomake ----------------------------------------------------------
    'section_code' => 'Koodi',
    'section_code_helper' => 'Se minkä asiakas kirjoittaa tilatessaan.',
    'code' => 'Koodi',
    'code_helper' => 'Tallennetaan ja verrataan isoilla kirjaimilla ilman välilyöntejä, jotta se toimii miten tahansa se kirjoitetaan.',
    'live' => 'Käytössä',
    'live_helper' => 'Pois päältä lopettaa koodin toiminnan poistamatta sitä: se jää pois käytöstä, kun taas antamansa alennus jää niille laskuille joilla se oli.',

    'section_worth' => 'Paljonko se ottaa pois',
    'section_worth_helper' => 'Vain ensimmäisestä laskusta. Se ei koskaan vie laskua nollan alle.',
    'kind' => 'Laji',
    'kind_helper' => 'Osuus hinnasta tai kiinteä summa.',
    'kind_percent' => 'Prosentti',
    'kind_fixed' => 'Kiinteä summa',
    'value' => 'Arvo',
    'value_percent_helper' => 'Kokonaisluku väliltä 1-100.',
    'value_fixed_helper' => 'Kaupan valuutassa. Kirjoita se muodossa 12.50 tai 12,50.',

    'section_limits' => 'Rajat',
    'section_limits_helper' => 'Kaikki tämä on vapaaehtoista. Koodi jolla ei ole yhtäkään näistä pätee kaikkeen, kaikille, ikuisesti.',
    'max_uses' => 'Montako kertaa sitä voi käyttää',
    'max_uses_helper' => 'Lasketaan kun tilaus tehdään, ei kun lasku maksetaan - muuten kymmenen käyttökerran koodin voisi tehdä sata kertaa yhdessä yössä.',
    'expires' => 'Vanhenee',
    'expires_helper' => 'Tämän hetken jälkeen koodi ei enää toimi. Tyhjä tarkoittaa ettei niin käy koskaan.',
    'packages' => 'Paketit',
    'packages_helper' => 'Mitään ei ole valittu tarkoittaa jokaista pakettia, nyt ja myöhemmin.',

    'empty' => 'Ei vielä koodeja',
    'empty_body' => 'Tee yksi, niin se toimii tilattaessa heti kun se on käytössä.',
];
