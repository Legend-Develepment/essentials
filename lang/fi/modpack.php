<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Modpack”, ”mod” ja ”loader” jäävät paikalleen: ne ovat Modrinthin ja pelin
 * omat sanat, ja niillä niitä haetaan.
 */

return [
    'nav_label' => 'Modpackit',
    'title' => 'Modpackit',
    'subheading' => 'Asenna modpack Modrinthistä tälle palvelimelle.',

    'section' => 'Etsi paketti',
    'section_helper' => 'Vain Modrinth, ja vain palvelinpuolen paketit. Se ei vaadi tiliä eikä API-avainta, ja siksi se on täällä ainoa lähde — muut haluavat kukin avaimen liitettynä ennen kuin mitään ilmestyy.',

    'search' => 'Haku',
    'search_helper' => 'Jätä tyhjäksi saadaksesi ladatuimmat. Hakeminen kysyy Modrinthiltä, joten se tapahtuu kentästä poistuttaessa eikä kirjoittaessa.',

    'pack' => 'Paketti',
    'pack_helper' => 'Vain paketit, jotka kertovat toimivansa palvelimella, listataan.',

    'version' => 'Versio',
    'version_helper' => 'Peliversio ja loader näkyvät kunkin vieressä. Valitse se loader, jota tämän palvelimen egg jo ajaa — tämä asentaa tiedostoja eikä muuta eggiäsi tai käynnistyskomentoasi.',

    'downloads' => 'latausta',

    'install' => 'Asenna tämä paketti',
    'install_go' => 'Asenna se',
    'install_confirm' => 'Paketin tiedostot lisätään tälle palvelimelle. **Mitään ei poisteta** — ei maailmaasi, ei vanhoja modejasi, ei asetustiedostoa. Toisen päälle asennettu paketti jättää molemmat, joten poista edellisen paketin modit itse ensin, jos sitä haluat. Palvelimen on oltava pysäytettynä, ja se pysyy pysäytettynä.',

    'started' => 'Asennetaan',
    'started_helper' => 'Pakettia haetaan ja puretaan. Muutama sata tiedostoa vie muutaman minuutin, ja saat ilmoituksen kun se on valmis — se jatkuu, vaikka poistut tältä sivulta.',

    'running' => 'Palvelin on käynnissä',
    'running_helper' => 'Minecraft lataa modinsa käynnistyessään, joten nyt asennettu paketti jättäisi palvelimen, joka ei ole vanha eikä uusi paketti, kunnes se käynnistyy uudelleen. Pysäytä se ja yritä uudelleen.',

    'done' => ':pack asennettu',
    'done_body' => 'Tiedostoja haettu: :files, ja paketin omasta kansiosta paikalleen laitettu: :overrides. Käynnistä palvelin, kun olet valmis.',
    'done_refused' => 'Ohitettuja tiedostoja: :count, koska paketti pyysi niitä paikasta, josta tämä ei lataa.',

    'failed' => 'Pakettia ei asennettu',
    'failed_fetch' => 'Pakettia ei saatu haettua tai purettua. Daemon ei ehkä ole tavoitettavissa, tai palvelimelta on loppunut levytila.',
    'failed_index' => 'Paketti haettiin, mutta siinä ei ollut luettavaa hakemistoa, joten asennettavaa ei ollut.',
    'failed_version' => 'Sillä versiolla ei ole enää pakettitiedostoa ladattavaksi. Valitse toinen.',
    'failed_queue' => 'Asennusta ei saatu jonoon. Tämä vaatii, että paneelissa ajaa queue worker.',
];
