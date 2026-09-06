<?php

/*
 * Italiano. Scritto a mano.
 *
 * La pagina dei Link di navigazione. Accanto agli annunci e non dentro le
 * impostazioni del tema: nessuna delle due parla di come appare il pannello.
 * Una è ciò che dice, e questa è dove porta.
 */

return [
    'title' => 'Link di navigazione',
    'nav_label' => 'Link di navigazione',
    'subheading' => 'Voci tue nella barra laterale — un invito Discord, una pagina di stato, una base di conoscenza. Passano dalla navigazione di Filament stesso, quindi si comportano come ogni altra voce: stanno sotto un\'intestazione, e seguono la barra laterale che sia una guida stretta o passata in alto.',

    'add' => 'Aggiungi un link',
    'enabled' => 'Attivo',
    'off' => 'spento',

    'label' => 'Nome',
    'icon' => 'Icona',
    'url' => 'Indirizzo',
    'url_helper' => 'https:// oppure un percorso dentro questo pannello, come /account. Tutto il resto viene ignorato — una voce nella navigazione non è un posto per uno schema che nessuno si aspetta.',
    'scope' => 'Mostrato in',
    'scope_all' => 'Dappertutto',
    'scope_client' => 'Solo fuori dall\'area di amministrazione',
    'scope_admin' => 'Solo nell\'area di amministrazione',
    'scope_login' => 'Sotto il modulo di accesso',
    'group' => 'Gruppo',
    'group_helper' => 'Lascia vuoto per metterlo sopra la prima intestazione. Scrivi lo stesso nome su due link e finiranno insieme sotto di essa.',
    'new_tab' => 'Apri in una nuova scheda',

    'favicon' => 'Usa l\'icona del sito stesso',
    'favicon_helper' => 'Scaricata una volta, al salvataggio - mai mentre qualcuno sta caricando una pagina. Se il sito non risponde, resta l\'icona scelta sopra.',
    'icon_fallback' => 'Usata solo se il sito non ha un\'icona sua.',

    'saved' => 'Link di navigazione salvati',
    'failed' => 'Non è stato possibile salvare i link di navigazione',
];
