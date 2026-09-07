<?php

/*
 * Română. Scrisă de mână.
 *
 * Cine este pe un server, pentru jocurile care răspund interogării Valve.
 *
 * O singură pagină pentru Rust, ARK, Valheim și celelalte, pentru că răspund
 * aceluiași pachet. Ce diferă de la joc la joc este ce îi poți face cuiva -
 * scoaterea afară este `kick "nume"` la unul și `KickPlayer <id>` la altul - și
 * de aceea pagina aceasta citește și nu acționează.
 */

return [
    'title' => 'Jucători',
    'nav_label' => 'Jucători',
    'subheading' => 'Cine este conectat, întrebat chiar jocul și nu panoul.',

    'refresh' => 'Întreabă din nou',

    'count' => ':count conectați',
    'score' => 'Scor',

    'just_joined' => 'tocmai a intrat',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Nu este nimeni pe acest server.',

    /*
     * Nu „nu e nimeni conectat”, iar diferența contează.
     *
     * Panoul și portul de joc sunt adesea în rețele care nu ajung una la
     * cealaltă, iar a desena asta ca listă goală ar însemna ca pagina să spună
     * ceva ce nu știe.
     */
    'unreachable' => 'Serverul nu a răspuns. Poate că pornește, sau poate că panoul nu ajunge la portul lui de joc de acolo de unde rulează — asta e altceva decât să nu fie nimeni conectat.',
];
