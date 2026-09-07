<?php

/*
 * Română. Scrisă de mână.
 *
 * „Whitelist”, „operator”, „ban” și „kick” rămân în engleză: acestea sunt
 * comenzile pe care le scrii în consolă și numele fișierelor pe care Minecraft
 * le scrie singur. Un buton tradus lângă o comandă englezească este un buton pe
 * care trebuie să îl traduci înapoi în minte.
 */

return [
    'nav_label' => 'Jucători',
    'title' => 'Jucători',
    'subheading' => 'Whitelist-ul, operatorii, ban-urile și toți cei pe care i-a văzut acest server.',

    /*
     * Spus o dată, sus, pentru că explică și ce poate face pagina, și de ce un
     * lucru pe care nu îl poate face nu este o defecțiune. Fiecare schimbare
     * pleacă drept comandă de consolă, așa cum trebuie spus lucrurile
     * Minecraftului - jocul face schimbarea și își scrie propriul fișier, așa că
     * cele două nu se contrazic niciodată.
     */
    'how' => 'Schimbările se trimit serverului drept comenzi de consolă, deci jocul le face și își scrie propriile fișiere. Pentru asta serverul trebuie să ruleze.',
    'needs_running' => 'Serverul trebuie să ruleze. Aceste schimbări le face jocul, nu editarea fișierelor lui pe sub el.',

    'name' => 'Nume de jucător',
    'reason' => 'Motiv (opțional)',

    'whitelist' => 'Adaugă pe whitelist',
    'unwhitelist' => 'Scoate de pe whitelist',
    'op' => 'Fă-l operator',
    'deop' => 'Scoate operator',
    'ban' => 'Ban',
    'pardon' => 'Ridică ban-ul',
    'kick' => 'Kick',

    'sent' => 'Comandă trimisă',
    'sent_body' => 'Serverul o aplică și își actualizează fișierele. Reîncarcă pagina ca să vezi listele schimbându-se.',
    'refused' => 'Aceasta nu a fost trimisă',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Pe whitelist',
    'flag_banned' => 'Cu ban',
    'flag_seen' => 'A jucat aici',

    'online' => 'Conectați acum',
    'online_count' => ':online din :max',
    'online_none' => 'Nu este nimeni conectat.',

    'players' => 'Jucători',
    'ips' => 'Adrese cu ban',
    'ips_empty' => 'Nicio adresă nu are ban.',

    /*
     * Ce înseamnă o pagină goală, ceea ce de obicei nu este „niciun jucător”, ci
     * „acest server nu a pornit niciodată”. Minecraft nu creează niciunul dintre
     * aceste fișiere înainte de prima rulare.
     */
    'empty' => 'Nimic de arătat încă. Minecraft scrie singur aceste liste și nu le creează până când serverul nu a pornit prima oară.',

    'level' => 'Nivelul :level',

    /*
     * Singurul lucru pe care pagina nu îl face, spus și nu lăsat să fie
     * descoperit. Starea în timp real cere o a doua conexiune chiar la joc, ceea
     * ce este altă funcție, cu cerințele ei.
     */
    'not_live' => 'Acesta este ce a notat serverul, nu cine este conectat chiar acum.',
];
