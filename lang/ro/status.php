<?php

/*
 * Română. Scrisă de mână.
 *
 * Pagina publică de stare.
 *
 * Singurul lucru pe care acest plugin îl servește cuiva neconectat și singura
 * pagină ale cărei cuvinte trebuie citite ca și cum le-ar vedea un străin -
 * pentru că un străin le va vedea. Nimic de aici nu spune care node, care
 * proprietar sau care adresă; un nume, dacă rulează, și câți sunt conectați.
 *
 * „Node” apare doar în setări; pe pagina publică propriu-zisă scrie „mașină”,
 * pentru că acolo o citește cineva care nu a auzit niciodată de Pelican.
 */

return [
    // ---- pagina de setări --------------------------------------------------
    'title' => 'Pagină publică de stare',
    'nav_label' => 'Pagină de stare',
    'subheading' => 'O pagină pe care oricine o poate deschide fără cont și care arată care dintre serverele tale rulează. Nu apare nimic pe ea până nu menționezi mai jos un server.',

    'address' => 'Pagina ta de stare este la',
    'address_off' => 'Nu se servește încă nimic. Adaugă mai jos un server, o mașină sau un serviciu și salvează, iar adresa va apărea aici.',

    'which' => 'Ce se publică',
    'which_helper' => 'Lista pornește goală și nimic nu este public până nu apare ceva pe ea. Se oferă doar serverele pe care le poți deschide deja.',
    'add' => 'Publică un server',
    'server' => 'Server',
    'shown_as' => 'Apare ca',
    'shown_as_helper' => 'Ce vede publicul. Scrie-l tu în loc să lași panoul să folosească numele real — „mc-prod-3 (nu atinge)” este o notiță pentru tine, nu ceva ce pui pe un forum.',

    'look' => 'Formulare',
    'look_helper' => 'Tot ce este pe această pagină îl citesc oameni fără cont.',
    'heading' => 'Titlu',
    'heading_helper' => 'Dacă este gol, se folosește numele panoului.',
    'note' => 'Un rând deasupra listei',
    'note_helper' => 'Ca să spui ce se întâmplă — o fereastră de mentenanță sau unde se poate întreba. Text simplu.',
    'link' => 'Legătură către panou',
    'link_helper' => 'O cale înapoi înăuntru, la baza paginii. Oprește-o dacă preferi să nu dezvălui unde se află panoul tău.',

    'save' => 'Salvează',
    'saved' => 'Salvat',
    'save_failed' => 'Nu s-a salvat nimic',
    'open' => 'Deschide pagina',

    // ---- numărul de jucători -----------------------------------------------
    'counts' => 'Numărul de jucători',
    'counts_helper' => 'De unde vin cifrele de lângă un server. Serverele Minecraft răspund propriei lor strângeri de mână și se configurează la Minecraft; tot ce urmează se aplică jocurilor care răspund interogării Valve — Rust, ARK, Valheim, 7 Days to Die și majoritatea celorlalte care rulează pe Source sau Unreal.',
    'query_eggs' => 'Egg-uri care răspund interogării Valve',
    'query_eggs_helper' => 'Bifează egg-urile acelor jocuri. Aceeași listă hotărăște și care servere primesc o pagină Jucători în interiorul panoului — o singură întrebare pusă din două motive. Nu se întreabă nimic până nu spui tu: acesta este singurul lucru de aici care deschide o conexiune de la panou direct către un port de joc, deci este o alegere și nu ceva care pornește singur. Un server al cărui port nu poate fi atins de panou pur și simplu nu arată cifre.',

    // ---- node-urile --------------------------------------------------------
    'nodes' => 'Mașini',
    'nodes_helper' => 'Sus sau jos, și nimic altceva. Nu încărcarea și nu cât de plin este discul — cine întreabă dacă poate juca nu are nevoie de un raport de capacitate despre fierul tău, iar publicarea unuia este o hartă a locurilor unde e strâmt.',
    'add_node' => 'Publică o mașină',
    'node' => 'Mașină',
    'node_shown_as_helper' => 'Scrie-l tu. Un node se numește de obicei cam hetzner-fsn1-01, iar asta este o propoziție întreagă despre unde îți sunt mașinile.',

    // ---- monitorizări HTTP -------------------------------------------------
    'monitors' => 'Alte servicii',
    'monitors_helper' => 'Tot ce mai merită știut că este sus: site-ul tău, un API, endpointul de sănătate al unui bot. Panoul le întreabă pe fiecare în același ritm ca serverele. Doar administratori — o monitorizare face acest panou să ceară o adresă, iar dacă oricine poate adăuga una, devine o sondă pe care o îndrepți unde vrei.',
    'add_monitor' => 'Adaugă un serviciu',
    'monitor_name' => 'Nume',
    'monitor_url' => 'Adresă',
    'monitor_url_helper' => 'Doar https. Dacă acest panou ar cere http simplu la intervale regulate, toți cei de pe traseu ar ști care dintre serviciile tale există.',
    'monitor_expect' => 'Așteaptă',
    'monitor_expect_helper' => 'Lasă gol pentru „orice răspuns”, ceea ce se potrivește unui site care redirecționează sau răspunde cu 403 la o cerere goală. Un număr este pentru un endpoint scris ca să spună exact atât și nimic altceva — setat prea strâns, rândul rămâne roșu pentru totdeauna la un serviciu care nu are nimic.',

    // ---- pagini pentru utilizatori -----------------------------------------
    'users' => 'Pagini pentru utilizatorii tăi',
    'users_helper' => 'Dacă oamenii cu servere pe acest panou pot publica propria pagină de stare.',
    'user_pages' => 'Lasă utilizatorii să își facă una',
    'user_pages_helper' => 'Fiecare primește adresa lui la /status/numele-lui, unde stau doar serverele pe care le deține, sub numele pe care le scrie el. Fără mașini și fără alte servicii pe ele — amândouă sunt doar ale tale. Când asta este pornit, o găsesc la Pagină de stare în meniul contului lor, în orice panou ar fi.',

    // ---- înfățișarea -------------------------------------------------------
    'every' => 'Verifică la fiecare',
    'every_helper' => 'Cât de des se reconstruiește pagina și cât de des se reîmprospătează singură în browser. O pagină pe care oamenii o privesc în timpul unei reporniri vrea secunde; una legată de pe un forum și pe care nimeni nu o ține deschisă vrea o oră, iar întrebarea fiecărui node în fiecare minut de dragul ei este muncă făcută pentru nimeni.',
    'every_realtime' => 'Timp real (10 secunde)',
    'every_30s' => '30 de secunde',
    'every_1m' => '1 minut',
    'every_5m' => '5 minute',
    'every_10m' => '10 minute',
    'every_30m' => '30 de minute',
    'every_60m' => '60 de minute',

    'style' => 'Stil',
    'style_helper' => 'Una dintre înfățișările panoului, aplicată acestei pagini: culoarea ei, griurile construite din suprafața ei și cât de rotunde sunt colțurile. „Urmează panoul” înseamnă cel setat azi, inclusiv orice se schimbă mai târziu.',
    'style_mine_helper' => 'Stilurile pe care le oferă acest panou, aplicate paginii tale: o culoare, griurile construite din ea și cât de rotunde sunt colțurile. Care stiluri sunt pe listă hotărăște proprietarul panoului — aceeași listă din care poți alege la Aspect. „Urmează panoul” înseamnă cel setat.',
    'style_panel' => 'Urmează panoul',

    // ---- pagina proprie ----------------------------------------------------
    'mine_title' => 'Pagina mea de stare',
    'mine_nav_label' => 'Pagină de stare',
    'mine_subheading' => 'O singură adresă pe care să o dai celor care joacă pe serverele tale. Arată serverele pe care le alegi și nimic altceva despre acest panou.',
    'mine_address' => 'Adresa ta',
    'mine_address_helper' => 'Alege ceva scurt. Schimbarea ei mai târziu rupe orice legătură pe care cineva a salvat-o deja.',
    'mine_address_off' => 'Alege mai jos o adresă și salvează, iar pagina ta va apărea aici.',
    'slug' => 'Adresă',
    'slug_helper' => 'Litere mici, cifre și cratime. Trei caractere sau mai multe.',
    'mine_heading' => 'Titlu',
    'mine_heading_helper' => 'Dacă este gol, se folosește adresa ta.',
    'mine_note_helper' => 'Ca să spui ce se întâmplă — o repornire, un eveniment, unde te găsesc. Text simplu, citit de toți cei care au legătura.',
    'mine_which' => 'Serverele tale',
    'mine_which_helper' => 'Se oferă doar serverele pe care le deții tu. A fi subuser în altă parte înseamnă acces la o mașină, nu dreptul de a publica faptul că există.',
    'mine_shown_as_helper' => 'Ce văd vizitatorii. Scrie-l tu în loc să folosești numele din panou, dacă acel nume este o notiță pentru tine.',
    'mine_look_helper' => 'Cum arată pagina ta pentru cei cărora le-o trimiți.',
    'mine_remove' => 'Retrage pagina mea',
    'mine_remove_confirm' => 'Îți retrage pagina și eliberează adresa pentru altcineva. Tot ce ai configurat se pierde; serverele în sine nu sunt atinse.',
    'mine_removed' => 'Pagina ta este retrasă',

    'why_slug' => 'Acea adresă nu merge. Litere mici, cifre și cratime, trei caractere sau mai multe — iar câteva cuvinte sunt rezervate.',
    'why_taken' => 'Acea adresă o are deja altcineva.',
    'why_unwritable' => 'Nu s-a putut scrie. Verifică dacă storage/app aparține utilizatorului sub care rulează panoul.',

    // ---- titluri pe pagina însăși ------------------------------------------
    'section_servers' => 'Servere',
    'section_nodes' => 'Mașini',
    'section_monitors' => 'Servicii',

    // ---- pagina însăși -----------------------------------------------------
    'up' => 'Sus',
    'down' => 'Jos',
    'starting' => 'Pornește',

    /*
     * Nu „jos”, iar diferența contează în public.
     *
     * Panoul nu a ajuns la server. De obicei este un node în mentenanță sau un
     * daemon care repornește - nu este același lucru cu un server oprit, iar a
     * le spune la o sută de jucători că serverul lor este jos în timp ce el
     * rulează este mai rău decât să recunoști că nu știi.
     */
    'unknown' => 'Necunoscut',

    'players' => 'Jucători',
    'online_now' => 'joacă chiar acum',
    'checked' => 'Verificat',
    'next_check' => 'până la următoarea verificare',
    'just_now' => 'chiar acum',
    'seconds_ago' => 'acum :count secunde',
    'panel' => 'Conectare',

    'all_up' => 'Totul rulează.',
    'some_down' => 'Ceva nu rulează.',
    'empty' => 'Aici nu se publică încă nimic.',
];
