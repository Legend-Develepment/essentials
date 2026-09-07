<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Subuser», «Wings», «SFTP», «cron» e «queue worker» restano in inglese: è con
 * quei nomi che si ritrovano in Pelican e sull'host, ed è esattamente ciò che
 * serve sapere quando compare una di queste righe.
 */

return [
    'nav_label' => 'Accesso ai server',
    'title' => 'Server per ruolo',
    'subheading' => 'Dare a tutti quelli che hanno un ruolo l\'accesso agli stessi server.',

    /*
     * Detto prima di ogni altra cosa sulla pagina, perché questa è l'unica
     * funzione qui che scrive in una tabella di Pelican.
     */
    'more' => 'Come funziona',
    'warning' => 'Funziona tenendo aggiornati i subuser di Pelican stesso — le stesse righe che aggiungeresti a mano sulla pagina Utenti di un server, e quelle che la lista dei server, i controlli dei permessi e Wings già leggono. Tocca solo le righe che ha creato lui: ciò che hai aggiunto a mano non viene mai modificato né rimosso. Nessuno riceve un\'email quando un ruolo gli concede un server. Togliere l\'accesso revoca anche il suo SFTP, cosa che richiede il queue worker che Pelican già chiede.',

    'never' => 'Non è ancora stato riconciliato nulla. Salva un abbinamento qui sotto e succede subito, e ogni minuto tramite il cron del pannello stesso da lì in poi.',
    'timing' => 'L\'accesso viene tolto nel momento in cui va tolto: chi perde un ruolo perde i server già alla pagina successiva. Concedere può richiedere fino a un minuto, perché quella è la passata che cerca le persone che in questo momento non stanno usando il pannello.',
    'last_run' => 'Ultima passata :ago secondi fa: :added aggiunti, :removed rimossi, :held mantenuti.',
    'capped' => 'Troppo in una volta — :pairs concessioni, e il limite è :max. Non è stato scritto nulla. Restringi un abbinamento: un ruolo con cinquanta persone e venti server fa mille concessioni da solo.',

    'which' => 'Gli abbinamenti',
    'which_helper' => 'Un ruolo, i server che chi lo ha deve raggiungere, e cosa può farci. Chi ha due ruoli riceve tutto ciò che entrambi concedono. I proprietari dei server e gli amministratori root vengono saltati — hanno già più di quanto questo potrebbe dargli.',
    'add' => 'Aggiungi un ruolo',

    'role' => 'Ruolo',
    'role_helper' => 'Tutti quelli che lo hanno, compreso chi lo riceverà più avanti.',
    'servers' => 'Server',
    'servers_helper' => 'I server che ricevono. Toglierne uno da qui toglie di nuovo quell\'accesso.',

    'permissions' => 'Cosa possono fare',
    'permissions_helper' => 'I permessi da subuser di Pelican stesso. Lasciali come stanno per un insieme ragionevole: la console, i pulsanti di alimentazione, i file, i backup e il registro delle attività — e nulla che modifichi il server, i suoi utenti, i suoi database o le sue allocazioni. «Connect to websocket» è sempre inclusa, perché senza di essa la pagina della console non si collega a nulla.',

    'save' => 'Salva e applica',
    'saved' => 'Salvato',
    'saved_body' => ':added concessi, :removed ritirati.',
    'save_failed' => 'Non è stato possibile salvare',
    'save_failed_disk' => 'Non è stato possibile scrivere la lista in storage. Controlla che storage/app appartenga all\'utente con cui gira il pannello.',

    'revoke' => 'Ritirare tutto',
    'revoke_confirm' => 'Rimuovere tutto ciò che questo ha concesso?',
    'revoke_confirm_helper' => 'Ogni riga di subuser che questa pagina ha creato, su ogni server, per chiunque — e il loro SFTP con essa. Le righe che hai aggiunto a mano non vengono toccate. Gli abbinamenti qui sotto restano, quindi il prossimo salvataggio o la prossima passata le concederebbero di nuovo: svuota prima la lista se lo intendi per davvero.',
    'revoked' => ':count rimossi',
    'revoked_body' => 'Solo le righe che questa pagina aveva creato. Ciò che è stato aggiunto a mano è rimasto dov\'era.',
    'revoke_failed' => 'Non è stato possibile rimuoverli',
];
