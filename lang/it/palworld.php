<?php

/*
 * Italiano. Scritto a mano.
 *
 * Le impostazioni di mondo di Palworld, su una pagina invece che in un file.
 *
 * Qui non si nomina nessuna impostazione. Ogni etichetta di quella pagina è
 * ricavata dalla chiave che il file del server stesso contiene — vedi
 * Support\Palworld\Palworld::label() per capire perché un elenco di nomi
 * sarebbe peggio di nessun elenco.
 */

return [
    'title' => 'Impostazioni di Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'Le impostazioni di mondo dal PalWorldSettings.ini di questo server, lette quando hai aperto questa pagina. Modificabili solo a server fermo.',

    'reload' => 'Rileggi il file',

    'save_confirm' => 'Il file viene riscritto con questi valori. Ogni impostazione che questa pagina non ha mostrato viene riscritta esattamente com\'era, e così tutto il resto del file.',
    'saved' => 'Impostazioni salvate',
    'saved_body' => 'Valgono dal prossimo avvio del server.',
    'save_failed' => 'Non è stato possibile scrivere il file',

    'running' => 'Il server è in esecuzione',
    'running_body' => 'Palworld tiene queste impostazioni in memoria e riscrive il file quando si ferma, quindi una modifica salvata adesso verrebbe annullata senza una parola. Ferma prima il server.',

    'groups' => [
        'server' => 'Server e connessione',
        'world' => 'Mondo e tassi',
        'pals' => 'Pal',
        'players' => 'Giocatori',
        'building' => 'Costruzione, oggetti e raccolta',
        'guild' => 'Gilde',
        'other' => 'Altro',
    ],
];
