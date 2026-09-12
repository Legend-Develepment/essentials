<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Mod”, ”plugin”, ”loader”, ”jar” ja kansioiden nimet mods/ ja plugins/ jäävät
 * paikalleen: juuri niin ne lukevat Modrinthissä ja palvelimen tiedostopuussa.
 */

return [
    'nav_label' => 'Modit & pluginit',
    'title' => 'Modit ja pluginit',
    'subheading' => 'Yksi kerrallaan, Modrinthistä, tälle palvelimelle.',

    'section' => 'Etsi jotain',
    'section_helper' => 'Modpack-sivu asentaa kokonaisen paketin kerralla. Tämä asentaa yhden modin tai pluginin, mikä on se, mitä haluaa paljon useammin.',

    'kind' => 'Mitä olet lisäämässä',
    /*
     * Kysytty eikä pääteltyä. Egg on nimeltään se, miksi ylläpitäjä on sen
     * nimennyt, ja useat loaderit lukevat molempia kansioita, joten täältä ei
     * ole rehellistä tapaa arvata tätä - ja väärä arvaus kirjoittaa jarin
     * kansioon, jota mikään ei lue.
     */
    'kind_helper' => 'Modi menee kansioon mods/ ja on Fabricille, Forgelle tai NeoForgelle. Plugin menee kansioon plugins/ ja on Bukkitille, Spigotille tai Paperille. Tämä ratkaisee myös sen, kumpi puoli Modrinthistä haetaan.',
    'kind_mod' => 'Modi (mods/)',
    'kind_plugin' => 'Plugin (plugins/)',

    'search' => 'Haku',
    'search_helper' => 'Kirjoita nimi ja napsauta laatikon ulkopuolelle. Tulokset ovat ladatuimmat ensin.',

    'project' => 'Modi tai plugin',
    'version' => 'Versio',
    'version_helper' => 'Jokainen rivi on versionumero, ne Minecraft-versiot joille se on rakennettu, ja ne loaderit joita se tukee. Valitse palvelimeesi sopiva - mikään täällä ei tarkista sitä puolestasi.',

    'install' => 'Asenna',
    'install_confirm' => 'Node hakee tiedoston suoraan Modrinthistä ja laittaa sen kansioon. Mitään siellä jo olevaa ei poisteta.',
    'installed' => 'Asennettu',
    'installed_helper' => 'Se latautuu, kun palvelin seuraavan kerran käynnistyy.',

    'change' => 'Vaihda versio',
    'change_helper' => 'Laittaa saman projektin eri version tämän tiedoston tilalle. Uusi ladataan ennen kuin vanha poistetaan, joten epäonnistunut lataus jättää sinulle sen, mikä sinulla jo oli.',
    'change_project_helper' => 'Kiinnitetty kaikelle, mikä on asennettu tältä sivulta. Sen muuttaminen ei olisi version vaihto - se olisi eri modi saman tiedostonimen alla.',
    'change_lookup_helper' => 'Tämä tiedosto oli jo kansiossa, joten mikään täällä ei tiedä mikä se on. Etsi se kerran, niin se muistetaan.',
    'changed' => 'Versio vaihdettu',

    'check' => 'Tarkista päivitykset',
    'checked' => 'Tarkistettu',
    'checked_none' => 'Kaikki tunnettu ajaa uusinta versiotaan.',
    'checked_some' => 'Uudempi versio saatavilla: :count. Ne on merkitty listaan.',
    'update_ready' => 'v:number saatavilla',
    /*
     * Sanottu merkin vieressä eikä vihjelaatikossa, koska se muuttaa sen, mitä
     * merkki tarkoittaa. Mikään täällä ei tiedä, mitä Minecraft-versiota tai
     * loaderia palvelin ajaa, joten uusin on uusin eikä uusin joka toimii.
     */
    'check_note' => 'Uudempi tarkoittaa uudempaa Modrinthissä. Mikään täällä ei tiedä, mitä Minecraft-versiota tai loaderia palvelimesi ajaa, joten tarkista että valitsemasi versio sanoo sopivansa ennen kuin käynnistät palvelimen.',
    'unknown' => 'Ei täältä - käytä Vaihda versio kertoaksesi mikä se on',

    'remove' => 'Poista',
    'remove_confirm' => 'Tiedosto poistetaan palvelimelta. Tätä ei voi perua täältä.',
    'removed' => 'Poistettu',

    'running' => 'Palvelin on käynnissä',
    'running_helper' => 'Minecraft lukee kansiot mods/ ja plugins/ kerran, käynnistyessään. Nyt lisätty tiedosto ei latautuisi ennen uudelleenkäynnistystä, ja käynnissä olevan pelin alta poistettu voi viedä pelin mennessään. Pysäytä palvelin ensin.',

    'failed' => 'Se ei onnistunut',
    'failed_version' => 'Sillä versiolla ei ole jaria, jonka tämä voisi asentaa. Osa julkaisuista sisältää vain lähdekoodin tai vain asiakasohjelman.',
    'failed_write' => 'Node torjui latauksen. Se ei ehkä pystynyt tavoittamaan Modrinthiä.',

    'installed_title' => 'Asennetut',
    'installed_mods' => 'Kansiossa mods/',
    'installed_plugins' => 'Kansiossa plugins/',
    /*
     * Sanottu, koska tyhjä lista on monitulkintainen: se tarkoittaa yleensä
     * sitä, ettei tämä palvelin käytä sitä kansiota lainkaan, eikä sitä, että
     * jotain puuttuisi.
     */
    'installed_empty' => 'Ei mitään täällä. Palvelin käyttää vain toista näistä kahdesta kansiosta, joten toisen tyhjyys on normaalia.',
    'installed_note' => 'Vain .jar-tiedostot listataan. Asetuskansiot ja pois käytöstä otetut tiedostot jätetään rauhaan eikä niitä näytetä.',
];
