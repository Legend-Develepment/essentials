<?php

/*
 * Română. Scrisă de mână.
 *
 * „Subuser”, „Wings”, „SFTP”, „cron” și „root admin” rămân: sunt cuvintele din
 * Pelican și de pe gazdă, iar cine caută rândul după ele caută.
 */

return [
    'nav_label' => 'Acces la servere',
    'title' => 'Servere după rol',
    'subheading' => 'Dă tuturor celor care au un rol acces la aceleași servere.',

    /*
     * Spus înaintea oricărui alt lucru de pe pagină, pentru că aceasta este
     * singura funcție de aici care scrie într-un tabel al Pelicanului.
     */
    'more' => 'Cum funcționează',
    'warning' => 'Funcționează ținând la zi chiar subuserii Pelicanului - aceleași rânduri pe care le-ai adăuga de mână în pagina Users a unui server, exact cele pe care le citesc lista de servere, verificările de permisiuni și Wings. Se atinge doar de rândurile pe care le-a creat el: nimic din ce ai adăugat de mână nu se schimbă și nu se șterge vreodată. Nimeni nu primește e-mail când un rol îi dă un server. Retragerea accesului le revocă și SFTP-ul, ceea ce cere queue workerul pe care Pelicanul îl cere oricum.',

    'never' => 'Încă nu s-a reconciliat nimic. Salvează o asociere mai jos și se întâmplă imediat, iar apoi în fiecare minut pe cronul panoului.',
    'timing' => 'Accesul se retrage exact în clipa în care trebuie: cine pierde un rol pierde serverele chiar la următoarea lui pagină. Acordarea poate dura până la un minut, pentru că aceea este trecerea care caută oamenii care nu folosesc panoul chiar acum.',
    'last_run' => 'Ultima rulare acum :ago secunde: :added adăugate, :removed scoase, :held păstrate.',
    'capped' => 'Prea multe deodată - :pairs acordări, iar limita este :max. Nu s-a scris nimic. Îngustează o asociere: un rol cu cincizeci de oameni și douăzeci de servere înseamnă o mie de acordări doar el.',

    'which' => 'Asocierile',
    'which_helper' => 'Un rol, serverele la care fiecare purtător al lui ar trebui să ajungă, și ce poate face acolo. Cine este în două roluri primește tot ce dau amândouă. Proprietarii serverelor și adminii root sunt săriți - au deja mai mult decât ar putea da asta.',
    'add' => 'Adaugă un rol',

    'role' => 'Rol',
    'role_helper' => 'Fiecare purtător al lui, inclusiv cine îl primește mai târziu.',
    'servers' => 'Servere',
    'servers_helper' => 'Serverele pe care le primesc. Scoaterea unuia de aici retrage acel acces.',

    'permissions' => 'Ce pot face',
    'permissions_helper' => 'Chiar permisiunile de subuser ale Pelicanului. Lasă-le cum sunt pentru un set rezonabil: consola, butoanele de alimentare, fișierele, copiile de siguranță și jurnalul de activitate - și nimic care să editeze serverul, utilizatorii, bazele lui de date sau alocările. Connect to websocket este mereu inclus, pentru că fără el pagina de consolă nu se conectează la nimic.',

    'save' => 'Salvează și aplică',
    'saved' => 'Salvat',
    'saved_body' => ':added acordate, :removed retrase.',
    'save_failed' => 'Nu s-a putut salva',
    'save_failed_disk' => 'Lista nu a putut fi scrisă în storage. Verifică dacă storage/app aparține utilizatorului sub care rulează panoul.',

    'revoke' => 'Retrage tot',
    'revoke_confirm' => 'Scoți tot ce a acordat asta?',
    'revoke_confirm_helper' => 'Fiecare rând de subuser creat de această pagină, pe fiecare server, pentru toată lumea - și SFTP-ul lor odată cu el. Rândurile adăugate de mână nu se ating. Asocierile de mai jos rămân, deci următoarea salvare sau următorul cronometru le-ar acorda din nou: golește mai întâi lista dacă vrei asta definitiv.',
    'revoked' => ':count scoase',
    'revoked_body' => 'Doar rândurile create de această pagină. Tot ce a fost adăugat de mână este unde era.',
    'revoke_failed' => 'Nu au putut fi scoase',
];
