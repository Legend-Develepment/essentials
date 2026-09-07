<?php

/*
 * Română. Scrisă de mână.
 *
 * Bara de comenzi de pe pagina unui server. Fișier propriu, nu un colț din
 * settings.php, pentru că aceasta o citesc cei care folosesc panoul, nu cel care
 * configurează tema.
 *
 * Starea de lângă butoane este chiar cuvântul Pelicanului, luat din enumerarea
 * ContainerStatus, ca bara și pagina de consolă să nu se contrazică niciodată în
 * privința a ceea ce face un server.
 *
 * „Kill” rămâne în engleză: așa se numește butonul Pelicanului și așa se numește
 * comanda, iar este altceva decât oprirea.
 */

return [
    'console' => 'Consolă',
    'full_page' => 'Fereastră nouă',
    'close' => 'Închide',

    'start' => 'Pornește',
    'restart' => 'Repornește',
    'stop' => 'Oprește',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill oprește containerul pe loc. Tot ce serverul nu a scris încă pe disc se pierde. Continui?',

    'sent_title' => 'Comandă de alimentare',
    'sent_body' => ':action a fost trimisă către :name.',
    'failed' => 'Node-ul nu a putut fi contactat.',
];
