<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Saldo, palautukset ja hyvityslaskut.
 *
 * Kolme sanaa pidetään alla tarkoituksella erillään.
 *
 * "Saldo" on rahaa, jota kauppa pitää hallussaan jonkun puolesta. Se menee
 * seuraavasta laskusta pois itsestään, jo ennen kuin keneltäkään pyydetään
 * maksua.
 *
 * "Palautus" on rahan takaisin antaminen, ja sillä on kaksi kohdetta: se
 * kortti josta se tuli, tai tili täällä saldona. Teksti sanoo aina kumpi,
 * koska asiakas jolle kerrotaan "raha on palautettu" ja joka ei sitten löydä
 * pankistaan mitään kirjoittaa siitä, ja aiheesta.
 *
 * "Hyvityslasku" on se asiakirja. Sellainen kirjoitetaan kummassakin
 * tapauksessa, koska se on merkintä siitä ettei rahaa enää olla kaupalle
 * velkaa - ei väite siitä, minne se meni.
 */

return [
    // ---- mitä asiakas näkee ----------------------------------------------
    'yours' => 'Saldosi',
    'yours_body' => 'Tämä menee seuraavasta laskustasi pois itsestään. Sinun ei tarvitse tehdä sille mitään.',
    'applied' => 'Maksettu saldostasi',
    'payable' => 'Maksettavaa jäljellä',

    // ---- kirjanpito asiakasikkunassa -------------------------------------
    'held' => 'Saldo',
    'none_held' => 'Ei mitään tilillä',
    'movements' => 'Saldo',
    'column' => 'Saldo',
    'none' => 'Ei mitään',

    // ---- saldon antaminen ------------------------------------------------
    'give' => 'Saldo',
    'give_helper' => 'Tällä tilillä on :held. Se minkä laitat sille menee seuraavasta laskusta pois itsestään. Negatiivinen summa ottaa saldoa taas pois, ja molemmat tapahtumat jäävät historiaan.',
    'amount' => 'Summa',
    'amount_helper' => 'Negatiivinen summa ottaa saldoa pois sen sijaan että antaisi.',
    'reason' => 'Syy',
    'reason_helper' => 'Asiakas näkee tämän summan vieressä, joten kirjoita se hänelle eikä arkistolle.',
    'given' => ':amount saldoa henkilölle :who',
    'bad_amount' => 'Tuo ei ole summa.',
    'give_failed' => 'Saldoa ei annettu',
    'give_failed_body' => 'Mitään ei kirjoitettu. Yritä uudelleen, ja katso lokiin jos se jatkuu.',
    'take_failed' => 'Saldoa ei otettu pois',
    'take_failed_body' => 'Tilillä on vähemmän kuin pyysit poistettavaksi. Saldoa ei koskaan viedä nollan alle.',

    // ---- mitä tapahtuma kertoo -------------------------------------------
    'spent_on' => 'Lasku :number',
    'returned' => 'Palautettu: laskua jota varten se oli ei saatu kirjoitettua',
    'note_line' => 'Hyvityslasku laskulle :number',
    'refund_description' => 'Laskun :number palautus',

    // ---- takaisin antaminen ----------------------------------------------
    'refund' => 'Palauta',
    'refund_helper' => 'Tästä laskusta :left on vielä antamatta takaisin. Hyvityslasku kirjoitetaan kummassakin tapauksessa, joten siitä jää merkintä molemmille puolille.',
    'refund_amount_helper' => 'Osakin käy. Loput voi antaa takaisin myöhemmin.',
    'refund_reason_helper' => 'Tämä tulostuu hyvityslaskulle, jonka asiakas voi avata.',
    'where' => 'Minne raha menee',
    'where_provider' => 'Takaisin sitä tietä jota maksettiin',
    'where_provider_helper' => 'Palveluntarjoaja lähettää sen sille kortille tai tilille josta se tuli. Näkymisessä voi mennä muutama päivä, ja he voivat kieltäytyä - vanha maksu, tai tapa jota ei voi perua.',
    'where_balance' => 'Saldoksi hänen tililleen täällä',
    'where_balance_helper' => 'Siitä tulee saldoa ja se menee seuraavasta laskusta pois. Mikään ei lähde pankista, eikä tämä voi epäonnistua.',
    'refunded' => ':amount palautettu',
    'refunded_body' => 'Siitä kirjoitettiin hyvityslasku :number.',
    'refund_failed' => 'Mitään ei palautettu',

    // ---- ja miksi ei, yksi syy kerrallaan --------------------------------
    'refused_off' => 'Saldo ja palautukset ovat pois päältä tässä paneelissa.',
    'refused_amount' => 'Tuo on enemmän kuin tästä laskusta on jäljellä.',
    'refused_no_payment' => 'Yhdessäkään tämän laskun maksussa ei ole niin paljon jäljellä, joten palveluntarjoajalla ei ole mitään peruttavaa. Laita se sen sijaan hänen tililleen.',
    'refused_no_gateway' => 'Palveluntarjoaja jonka kautta tämä maksettiin ei ole enää päällä, joten sitä ei voi pyytää perumaan mitään. Laita se sen sijaan hänen tililleen.',
    'refused_refused' => 'Palveluntarjoaja kieltäytyi. Kyse on yleensä vanhasta maksusta tai tavasta jota ei voi perua; heidän antamansa syy on lokissa. Laita se sen sijaan hänen tililleen.',
    'refused_note_failed' => 'Raha liikkui mutta hyvityslasku ei suostunut kirjoittumaan, joten mitään ei kirjattu. Katso lokiin ennen kuin yrität uudelleen.',

    // ---- rahan laittaminen tilille ---------------------------------------
    'topup' => 'Lisää saldoa',
    'topup_helper' => 'Sinulla on tilillä :held. Se minkä lisäät tähän menee seuraavasta laskustasi pois itsestään, ja jo avoinna oleva lasku hoidetaan siitä heti kun se saapuu.',
    'topup_go' => 'Jatka maksamaan',
    'topup_amount_helper' => 'Välillä :least ja :most.',
    'topup_bad' => 'Tuota summaa ei voi maksaa',
    'topup_failed' => 'Maksua ei saatu käyntiin. Yritä uudelleen, ja kerro sille joka pitää tätä paneelia jos se jatkuu.',
    'topup_line' => 'Saldoa lisätty tilille',
    'topup_reason' => 'Lisätty laskulla :number',

    // ---- missä se näkyy --------------------------------------------------
    'menu' => ':amount saldoa',
    'held_helper' => 'Menee seuraavasta laskustasi pois itsestään. Lisätä voit laskusivulla.',
];
