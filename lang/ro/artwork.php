<?php

/*
 * Română. Scrisă de mână.
 *
 * „Steam App ID”, „IGDB”, „Twitch client ID” și „client secret” rămân în
 * engleză: exact acestea sunt cuvintele de pe paginile de unde vin valorile.
 */

return [
    'title' => 'Imagini pentru egg-uri',
    'nav_label' => 'Imagini pentru egg-uri',
    'subheading' => 'Imagini de joc pentru egg-urile tale, aduse de pe Steam și IGDB. Un egg fără imagine arată chiar pelicanul Pelicanului pe fiecare fișă de server care îl folosește.',

    // ---- tabelul ---------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Blocat',

    'locked' => 'Blocat',
    'unlocked' => 'Deschis',

    // ---- ce poți face cu un rând -----------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Numărul din adresa jocului în magazinul Steam — store.steampowered.com/app/892970 înseamnă 892970. Aducerea după identificator blochează imaginea, pentru că tastarea unui număr este o decizie și o rulare în masă de mai târziu nu are voie să o anuleze.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Caută după',
    'search_term_helper' => 'Numele egg-ului este completat, dar rareori este numele jocului — „Paper 1.20.4” înseamnă Minecraft. Scrie jocul.',

    'lock' => 'Blochează',
    'unlock' => 'Deblochează',
    'locked_done' => 'Blocat — o aducere în masă îl va lăsa în pace',
    'unlocked_done' => 'Deblocat — o aducere în masă poate înlocui această imagine',

    'clear' => 'Golește',
    'clear_confirm' => 'Scoate imaginea și Steam App ID-ul. Egg-ul revine la pelicanul Pelicanului, iar următoarea aducere în masă va încerca din nou.',
    'cleared' => 'Imagine scoasă',

    // ---- rezultate -------------------------------------------------------
    'fetched' => 'Imagine salvată',
    'failed' => 'Nu s-a salvat nicio imagine',

    /*
     * Câte un motiv pentru fiecare, pentru că sunt probleme diferite.
     *
     * O aducere care a eșuat dintr-o greșeală de tastare și una care a eșuat
     * pentru că discul este plin nu trebuie să spună amândouă „a eșuat” — prima
     * se rezolvă privind numărul, a doua privind serverul.
     */
    'why_bad_id' => 'Acesta nu este un Steam App ID.',
    'why_not_found' => 'Steam nu are nimic la acea adresă. Verifică App ID-ul — un joc fără pagină de magazin nu are nici imagine de antet.',
    'why_no_match' => 'Nu s-a găsit nimic sub acel nume. Încearcă numele adevărat al jocului, nu numele egg-ului.',
    'why_no_name' => 'Nu este nimic de căutat.',
    'why_no_token' => 'Twitch nu a vrut să emită un token. Verifică client ID-ul și secretul la Credențiale.',
    'why_not_configured' => 'IGDB are nevoie de un Twitch client ID și de un secret. Setează-le la Credențiale.',
    'why_empty' => 'Răspunsul a fost gol.',
    'why_large' => 'Acea imagine este mult mai mare decât o pictogramă și nu a fost salvată.',
    'why_not_an_image' => 'Ce a venit înapoi nu este o imagine. De obicei asta înseamnă că o pagină de eroare a răspuns cu un cod de succes.',
    'why_wrong_format' => 'Acea imagine este într-un format pe care acest panou nu îl păstrează. Pelicanul păstrează PNG, JPEG și WebP.',
    'why_unwritable' => 'Imaginea nu a putut fi scrisă. Verifică dacă storage/app/public aparține utilizatorului sub care rulează panoul și dacă php artisan storage:link a fost rulat.',
    'why_unknown' => 'Nu a mers, iar motivul nu este unul pentru care acesta să aibă un nume.',

    // ---- totul deodată ---------------------------------------------------
    'bulk' => 'Adu-le pe toate cele lipsă',
    'bulk_confirm_steam' => 'Caută pe Steam după nume pentru fiecare egg fără imagine și neblocat. Egg-urile blocate și cele care au deja o imagine sunt lăsate în pace. Rulează în fundal — vei fi anunțat când se termină.',
    'bulk_confirm_both' => 'Caută pe Steam după nume pentru fiecare egg fără imagine și neblocat, apoi încearcă IGDB pentru tot ce Steam nu a găsit. Egg-urile blocate și cele care au deja o imagine sunt lăsate în pace. Rulează în fundal — vei fi anunțat când se termină.',

    'bulk_started' => 'Se aduc în fundal',
    'bulk_started_body' => 'Pe un panou mare poate dura câteva minute. Primești o notificare când s-a terminat și poți părăsi pagina.',

    'bulk_done' => 'Imaginile pentru egg-uri s-au terminat',
    'bulk_done_body' => ':fetched aduse, :skipped lăsate în pace, :failed fără nicio găsire. Un egg este lăsat în pace când este blocat sau are deja o imagine.',

    'bulk_failed' => 'Aducerea în masă nu a rulat',
    'bulk_failed_queue' => 'Nu a putut fi predată cozii. Pentru asta trebuie un queue worker — verifică dacă pelican-queue rulează.',

    // ---- credențiale IGDB ------------------------------------------------
    'credentials' => 'Credențiale',
    'credentials_helper' => 'Steam funcționează fără niciuna dintre acestea. Sunt doar pentru IGDB, care acoperă jocurile despre care Steam nu a auzit niciodată — Minecraft și fiecare ramificație a lui, tot ce a apărut pe o consolă, majoritatea egg-urilor cu moduri.',
    'credentials_where' => 'Fă o aplicație la dev.twitch.tv/console, generează un client secret și lipește-le pe amândouă aici. Este gratuit.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Credențiale salvate',
    'credentials_failed' => 'Credențialele nu au putut fi salvate',
];
