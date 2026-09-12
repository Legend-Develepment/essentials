<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Ilmoituksen pyytäminen siitä, kun loppuunmyyty paketti on taas myynnissä.
 *
 * Sanamuoto ei koskaan lupaa kenellekään itse tuotetta. Kun varastoa palaa,
 * kaikille listalla oleville kerrotaan yhtä aikaa ja se menee sille joka ostaa
 * ensin, joten jokainen lause tässä sanoo sen suoraan sen sijaan että sanoisi
 * "se on takaisin!" ja jättäisi kaksikymmentäkahdeksan ihmistä selvittämään,
 * mitä se oli arvoltaan.
 *
 * Ilmoitus myös poistaa listalta, ja sekin sanotaan ääneen: yksi pyyntö ostaa
 * yhden ilmoituksen, ja juuri se pitää kellon lukemisen arvoisena.
 */

return [
    'bell_back' => ':name on taas saatavilla',
    'bell_back_body' => '{1} Niitä on yksi, ja se menee sille joka ostaa ensin. Olet nyt pois listalta, joten pyydä uudelleen jos se menee ohi.|[2,*] Niitä on :count, ja ne menevät niille jotka ostavat ensin. Olet nyt pois listalta, joten pyydä uudelleen jos ne menevät ohi.',
    'bell_back_any' => 'Sitä ei enää rajoiteta, joten niitä riittää kaikille. Olet nyt pois listalta.',
];
