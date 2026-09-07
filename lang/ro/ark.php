<?php

/*
 * Română. Scrisă de mână.
 *
 * „GameUserSettings.ini” și „Startup” se scriu cum apar în joc și în Pelican -
 * acelea sunt numele pe care omul le caută.
 */

return [
    /* ------------------------------------------- fila de administrare ---- */

    /*
     * Titlul însuși nu este aici. Fiecare secțiune de setări își ia titlul din
     * settings.groups.<nume>, pe care îl construiește group().
     */
    'section_helper' => 'Care egg-uri rulează ARK. Nimic altceva — restul unui server ARK se configurează prin variabilele lui de pornire, iar pagina Startup a Pelicanului le editează deja.',

    'eggs' => 'Care egg-uri sunt ARK',
    'eggs_helper' => 'Bifează egg-urile care rulează un server ARK. O pagină cu setările de lume apare în interiorul serverelor care le folosesc și nicăieri altundeva. Este altă întrebare decât cea de pe pagina de stare: aceea întreabă care egg-uri răspund interogării Valve, ceea ce fac și Rust și Valheim, iar aceasta întreabă care egg-uri țin GameUserSettings.ini acolo unde îl ține ARK, ceea ce face doar ARK. La început nu este nimic bifat, intenționat — un plugin nu poate ști cum ți-ai numit egg-urile.',

    /* ------------------------------------------------ pagina serverului -- */

    'nav_label' => 'Setări de lume',
    'title' => 'Setările de lume ARK',
    'subheading' => 'Setările pe care oamenii chiar le schimbă, din GameUserSettings.ini.',

    'group_server' => 'Serverul',
    'group_server_helper' => 'Cum se numește serverul, cine poate intra și câți.',
    'group_rates' => 'Rate',
    'group_rates_helper' => 'Cât de repede se întâmplă lucrurile. 1.0 este jocul așa cum vine; 2.0 este de două ori mai repede.',
    'group_rules' => 'Reguli',
    'group_rules_helper' => 'Ce pot face jucătorii și ce le arată jocul.',

    'keeps' => 'Cincisprezece setări dintr-un fișier cu sute. Tot restul din el — setările tale de moduri, chei despre care acest plugin nu a auzit niciodată, comentariile și ordinea lor — rămâne exact așa cum este când salvezi.',
    'missing' => 'Acest server nu are încă un GameUserSettings.ini. Jocul îl scrie la prima rulare, deci pornește serverul o dată și pagina se va completa.',
    'read_only' => 'Poți citi acest fișier, dar nu îl poți scrie, deci nimic de aici nu se poate schimba.',

    'save' => 'Salvează',
    'saved' => 'Salvat',
    'saved_restart' => 'ARK citește acest fișier la pornire, deci repornește serverul ca schimbarea să intre în vigoare.',
    'failed' => 'Nu s-a putut salva',
    'failed_write' => 'Daemonul a refuzat scrierea. Verifică dacă serverul este accesibil și dacă fișierul nu este doar în citire.',
];
