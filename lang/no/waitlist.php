<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Å be om beskjed når en utsolgt pakke er til salgs igjen.
 *
 * Ordlyden lover aldri noen selve tingen. Når det kommer varer inn igjen, får
 * alle på listen beskjed samtidig, og den går til den som kjøper først - så
 * hver eneste setning her sier det rett ut framfor å si «den er tilbake!» og
 * la tjueåtte personer finne ut hva det var verdt.
 *
 * Å få beskjed tar deg også av listen, og det sies høyt: én forespørsel kjøper
 * én beskjed, og det er det som holder bjellen verdt å lese.
 */

return [
    'bell_back' => ':name er til salgs igjen',
    'bell_back_body' => '{1} Det er én, og den går til den som kjøper først. Du står ikke på listen lenger, så spør på nytt om du går glipp av den.|[2,*] Det er :count, og de går til dem som kjøper først. Du står ikke på listen lenger, så spør på nytt om du går glipp av dem.',
    'bell_back_any' => 'Den er ikke begrenset lenger, så det er én til alle. Du står ikke på listen lenger.',
];
