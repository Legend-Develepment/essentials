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
    'secret_kept' => 'Salvat. Lasă gol pentru a-l păstra sau scrie unul nou pentru a-l înlocui.',
    'update_background' => 'Rulează în fundal și durează un minut sau două.',

    /*
     * Queue workerul și schedulerul, de care depinde fiecare lucrare din
     * fundal și fiecare sarcină programată. Spuse separat, pentru că se strică
     * separat, iar leacul este altul pentru fiecare.
     */
    'worker_missing' => 'Niciun queue worker nu a răspuns. Instalările de modpack-uri, e-mailurile și alte sarcini de fundal se pun în coadă și sunt duse la capăt de un proces worker, deci până când nu rulează unul, ele se notează și nu se execută niciodată, fără nicio eroare undeva. Ori nu există niciun worker, ori există unul pornit înainte de instalarea acestui plugin, care nu îi poate încărca codul - ambele se rezolvă repornindu-l pe gazda panoului. Pune-i serviciul să repornească singur, altfel asta revine după fiecare actualizare.',
    'cron_missing' => 'Planificatorul panoului nu a mai rulat de :for minute. Reînnoirile și verificările watchdog îl așteaptă. Linia de cron este în documentația Pelican.',

    /*
     * Numit după cauză și nu după simptom, pentru că simptomul este „nu s-a
     * întâmplat nimic”, și tocmai asta a făcut greu de localizat: anunțurile,
     * legăturile de navigare, stilurile salvate și aranjamentele de pagină sunt
     * toate fișiere sub storage/app, iar un director în care panoul nu poate
     * scrie le pierde pe toate fără un cuvânt.
     */
    'storage_failed' => 'Panoul nu a putut scrie în directorul lui storage, deci asta nu s-a salvat. Verifică dacă storage/app aparține utilizatorului sub care rulează panoul. Motivul este în storage/logs.',
];
