<?php

/*
 * Română. Scrisă de mână.
 *
 * „SteamID64” și „PlayFab ID” rămân exact cum se scriu în locurile de unde le
 * iei. „Admin” rămâne și el: este cuvântul din chiar fișierul jocului.
 */

return [
    /* ------------------------------------------- fila de administrare ---- */

    'section_helper' => 'Care egg-uri rulează Valheim. Nimic altceva - un server Valheim se configurează prin variabilele lui de pornire, iar pagina Startup a Pelicanului le editează deja.',

    'eggs' => 'Care egg-uri sunt Valheim',
    'eggs_helper' => 'Bifează egg-urile care rulează un server Valheim. O pagină cu listele de jucători apare în interiorul serverelor care le folosesc și nicăieri altundeva. Unde stau acele liste diferă de la egg la egg, așa că se deduce pentru fiecare server căutând în locurile pe care le folosește jocul. La început nu este nimic bifat, intenționat - un plugin nu poate ști cum ți-ai numit egg-urile.',

    /* ------------------------------------------------ pagina serverului -- */

    'nav_label' => 'Liste de jucători',
    'title' => 'Listele de jucători Valheim',
    'subheading' => 'Adminii, ban-urile și lista celor permiși, ca trei liste în loc de trei fișiere text.',

    'admin' => 'Admini',
    'admin_helper' => 'Toți cei de aici pot folosi comenzile de admin în joc.',
    'banned' => 'Cu ban',
    'banned_helper' => 'Toți cei de aici sunt refuzați când încearcă să intre.',
    'permitted' => 'Permiși',
    'permitted_helper' => 'Dacă pe această listă este cineva, doar aceia pot intra. O listă goală lasă pe toată lumea să intre - ceea ce vor majoritatea serverelor, deci las-o goală dacă nu ai altă intenție.',

    'ids' => 'Identificatori de jucător',
    'ids_placeholder' => 'Lipește un identificator și apasă spațiu',

    'how' => 'Câte un identificator pentru fiecare jucător - un SteamID64 pe un server Steam, un PlayFab ID pe unul cu crossplay. Lipește-i și apasă spațiu, tab sau virgulă. Tot ce a scris jocul drept comentariu deasupra listei rămâne unde este.',
    'where' => 'Citit din :dir.',
    'missing' => 'Acest server nu are încă niciunul dintre aceste fișiere. Jocul le scrie când are prima oară nevoie de ele, iar salvarea de aici le va crea pe cele pe care le completezi.',
    'read_only' => 'Poți citi aceste fișiere, dar nu le poți scrie, deci nimic de aici nu se poate schimba.',

    'save' => 'Salvează',
    'saved' => 'Salvat',
    'saved_reload' => 'Valheim citește aceste liste în timp ce rulează, deci schimbarea se aplică fără repornire.',
    'unchanged' => 'Nu se schimbase nimic, deci nu s-a scris nimic',
    'failed' => 'Nu s-a putut salva',
    'failed_lists' => 'Daemonul a refuzat scrierea pentru: :lists. Verifică dacă serverul este accesibil și dacă fișierele nu sunt doar în citire.',
];
