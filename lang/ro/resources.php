<?php

/*
 * Română. Scrisă de mână.
 *
 * „Mod”, „plugin”, „loader”, „jar” și numele folderelor mods/ și plugins/
 * rămân: exact așa scriu pe Modrinth și în arborele de fișiere al serverului.
 */

return [
    'nav_label' => 'Moduri și plugin-uri',
    'title' => 'Moduri și plugin-uri',
    'subheading' => 'Câte unul pe rând, de pe Modrinth, în acest server.',

    'section' => 'Găsește ceva',
    'section_helper' => 'Pagina de modpack-uri instalează un pachet întreg deodată. Aceasta instalează un singur mod sau plugin, ceea ce vrei mult mai des.',

    'kind' => 'Ce adaugi',
    /*
     * Întrebat, nu dedus. Un egg se numește cum l-a numit un administrator, iar
     * mai multe loadere citesc ambele foldere, deci de aici nu există niciun fel
     * cinstit de a ghici asta - iar o ghiceală greșită scrie un jar într-un
     * folder pe care nu îl citește nimic.
     */
    'kind_helper' => 'Un mod merge în mods/ și este pentru Fabric, Forge sau NeoForge. Un plugin merge în plugins/ și este pentru Bukkit, Spigot sau Paper. Asta hotărăște și în care jumătate din Modrinth se caută.',
    'kind_mod' => 'Un mod (mods/)',
    'kind_plugin' => 'Un plugin (plugins/)',

    'search' => 'Caută',
    'search_helper' => 'Scrie un nume și dă clic în afara casetei. Rezultatele vin cu cele mai descărcate primele.',

    'project' => 'Mod sau plugin',
    'version' => 'Versiune',
    'version_helper' => 'Fiecare rând este numărul versiunii, versiunile de Minecraft pentru care este construită și loaderele pe care le suportă. Alege una care se potrivește serverului tău — nimic de aici nu verifică asta în locul tău.',

    'install' => 'Instalează',
    'install_confirm' => 'Fișierul este descărcat de node direct de pe Modrinth și pus în folder. Nu se șterge nimic din ce este deja acolo.',
    'installed' => 'Instalat',
    'installed_helper' => 'Se încarcă la următoarea pornire a serverului.',

    'change' => 'Schimbă versiunea',
    'change_helper' => 'Pune o altă versiune a aceluiași proiect în locul acestui fișier. Cea nouă se descarcă înainte ca cea veche să fie ștearsă, deci o descărcare eșuată te lasă cu ce aveai deja.',
    'change_project_helper' => 'Fixat pentru tot ce a fost instalat din această pagină. Schimbarea lui nu ar fi o schimbare de versiune — ar fi alt mod sub același nume de fișier.',
    'change_lookup_helper' => 'Acest fișier era deja în folder, deci nimic de aici nu știe ce este. Caută-l o dată și va fi ținut minte.',
    'changed' => 'Versiune schimbată',

    'check' => 'Caută actualizări',
    'checked' => 'Verificat',
    'checked_none' => 'Tot ce se cunoaște este pe cea mai nouă versiune.',
    'checked_some' => ':count au o versiune mai nouă. Sunt marcate în listă.',
    'update_ready' => 'v:number disponibilă',
    /*
     * Spus lângă insignă și nu într-un indiciu sub cursor, pentru că schimbă ce
     * înseamnă insigna. Nimic de aici nu știe ce versiune de Minecraft sau ce
     * loader rulează serverul, deci cea mai nouă înseamnă cea mai nouă, nu cea
     * mai nouă care va merge.
     */
    'check_note' => 'Mai nouă înseamnă mai nouă pe Modrinth. Nimic de aici nu știe ce versiune de Minecraft sau ce loader rulează serverul tău, deci verifică dacă versiunea aleasă spune că se potrivește înainte să pornești serverul.',
    'unknown' => 'Nu de aici — folosește Schimbă versiunea ca să spui ce este',

    'remove' => 'Scoate',
    'remove_confirm' => 'Fișierul se șterge de pe server. De aici nu se poate anula.',
    'removed' => 'Scos',

    'running' => 'Serverul rulează',
    'running_helper' => 'Minecraft citește mods/ și plugins/ o singură dată, la pornire. Un fișier adăugat acum nu s-ar încărca până la o repornire, iar unul luat de sub un joc care rulează poate lua jocul cu el. Oprește mai întâi serverul.',

    'failed' => 'Nu a mers',
    'failed_version' => 'Acea versiune nu are un jar pe care acesta să îl poată instala. Unele lansări conțin doar sursele sau doar o construcție de client.',
    'failed_write' => 'Node-ul a refuzat descărcarea. Poate că nu a putut ajunge la Modrinth.',

    'installed_title' => 'Instalate',
    'installed_mods' => 'În mods/',
    'installed_plugins' => 'În plugins/',
    /*
     * Spus pentru că o listă goală este ambiguă: de obicei înseamnă că acest
     * server nu folosește deloc acel folder, nu că lipsește ceva.
     */
    'installed_empty' => 'Nimic aici. Un server folosește doar unul dintre aceste două foldere, deci este normal ca unul să fie gol.',
    'installed_note' => 'Se listează doar fișierele .jar. Folderele de configurare și fișierele dezactivate sunt lăsate în pace și nu se arată.',
];
