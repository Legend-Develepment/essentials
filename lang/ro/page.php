<?php

/*
 * Română. Scrisă de mână.
 *
 * „Queue worker”, „cron”, „storage” și căile rămân exact cum se scriu pe gazda
 * panoului: exact așa se tastează într-un shell.
 */

return [
    'title' => 'Setări Essentials',
    'nav_label' => 'Setări Essentials',
    'save' => 'Salvează',
    'saved' => 'Setări salvate',
    'save_failed' => 'Setările nu au putut fi salvate',
    'update' => 'Actualizează',
    'update_available' => 'Este disponibilă o actualizare',
    'update_confirm' => 'Panoul descarcă versiunea nouă, își reconstruiește asset-urile și își golește cache-urile. Setările tale se păstrează.',
    'update_started' => 'Actualizare pornită',
    'update_background' => 'Rulează în fundal și durează un minut sau două.',
    'update_failed' => 'Tema nu a putut fi actualizată',
    'update_done' => 'Temă actualizată',
    'check' => 'Caută actualizări',
    'check_failed' => 'Fluxul de actualizări nu a putut fi citit',
    'check_failed_body' => 'Panoul nu a ajuns la el, sau nu a returnat JSON valid.',
    'up_to_date' => 'Ești pe cea mai nouă versiune',
    'reinstall' => 'Reinstalează',

    'auto_on' => 'Actualizările se instalează singure',

    /*
     * Ce a făcut ultima verificare automată. Fiecare dintre acestea numește
     * partea care ar trebui privită, pentru că dintr-un browser cele trei
     * feluri în care se strică arată la fel: un număr care numără invers.
     */
    'auto_never' => 'Nu a rulat încă nicio verificare. Actualizările automate au nevoie de planificatorul panoului — intrarea cron care rulează php artisan schedule:run în fiecare minut. Fără ea nu se întâmplă absolut nimic programat.',
    'auto_ago' => 'Verificat ultima dată :ago',
    'auto_just_now' => 'chiar acum',
    'auto_minutes' => 'minute în urmă',
    'auto_current' => 'nimic mai nou pe acest canal.',
    'auto_installed' => 'v:version a fost instalată aici, chiar de verificarea programată. Așa face atunci când niciun queue worker nu răspunde, deci actualizarea se petrece oricum — dar un panou fără worker este unul în care nici restul muncii din coadă nu se petrece.',
    'auto_queued' => 'v:version a fost dată queue workerului. Dacă versiunea de mai sus nu se schimbă în câteva minute, workerul ia lucrări, dar pe aceasta o ratează — de obicei se rezolvă repornindu-l, iar motivul este în storage/logs.',
    'auto_unreachable' => 'fluxul de actualizări nu a putut fi citit. Se ia de pe internet, deci de obicei este o problemă de rețea sau de DNS pe gazda panoului.',
    'auto_error' => 'verificarea a eșuat. Motivul este în storage/logs.',

    /*
     * Queue workerul, care este cel ce chiar face actualizarea. Spus separat de
     * verificarea de mai sus, pentru că se strică separat, iar leacul este
     * altul pentru fiecare.
     */
    'worker_missing' => 'Niciun queue worker nu a răspuns. Actualizările și instalările de modpack-uri se pun în coadă și sunt duse la capăt de un proces worker, deci până când nu rulează unul, ele se notează și nu se execută niciodată, fără nicio eroare undeva. Ori nu există niciun worker, ori există unul pornit înainte de instalarea acestui plugin, care nu îi poate încărca codul — ambele se rezolvă repornindu-l pe gazda panoului. Pune-i serviciul să repornească singur, altfel asta revine după fiecare actualizare.',

    'next_check' => 'Următoarea verificare în',
    'due_now' => 'acum',

    /*
     * Numit după cauză și nu după simptom, pentru că simptomul este „nu s-a
     * întâmplat nimic”, și tocmai asta a făcut greu de localizat: anunțurile,
     * legăturile de navigare, stilurile salvate și aranjamentele de pagină sunt
     * toate fișiere sub storage/app, iar un director în care panoul nu poate
     * scrie le pierde pe toate fără un cuvânt.
     */
    'storage_failed' => 'Panoul nu a putut scrie în directorul lui storage, deci asta nu s-a salvat. Verifică dacă storage/app aparține utilizatorului sub care rulează panoul. Motivul este în storage/logs.',

    /*
     * Spus după fiecare actualizare eșuată, nu doar după o nepotrivire. Mesajul
     * de mai sus numește deja cauza; acesta numește singurul leac pe care un om
     * nu îl poate deduce din „așteptam X, am primit Y”.
     */
    'update_renamed' => 'Dacă scrie că două identificatoare nu se potrivesc, pluginul a fost redenumit și nicio actualizare nu trece peste asta — Pelicanul cunoaște un plugin instalat după identificatorul lui. Dezinstalează intrarea veche la Admin → Plugins și instalează-l pe acesta de la zero. Setările tale supraviețuiesc: stau în .env și în storage/app/private/legend-theme, și niciunul nu este indexat după identificator.',
];
