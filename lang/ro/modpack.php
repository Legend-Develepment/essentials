<?php

/*
 * Română. Scrisă de mână.
 *
 * „Modpack”, „mod” și „loader” rămân: sunt cuvintele de pe Modrinth și din joc,
 * iar după ele se caută.
 */

return [
    'nav_label' => 'Modpack-uri',
    'title' => 'Modpack-uri',
    'subheading' => 'Instalează un modpack de pe Modrinth pe acest server.',

    'section' => 'Găsește un pachet',
    'section_helper' => 'Doar Modrinth și doar pachete de partea serverului. Nu cere cont și nici cheie API, de aceea este singura sursă de aici — celelalte vor fiecare o cheie lipită înainte să apară ceva.',

    'search' => 'Caută',
    'search_helper' => 'Lasă gol pentru cele mai descărcate. Căutarea întreabă Modrinth, deci se face când ieși din câmp, nu în timp ce scrii.',

    'pack' => 'Pachet',
    'pack_helper' => 'Se listează doar pachetele care spun că rulează pe server.',

    'version' => 'Versiune',
    'version_helper' => 'Versiunea jocului și loaderul apar lângă fiecare. Alege loaderul pe care egg-ul acestui server îl rulează deja — acesta instalează fișiere și nu îți schimbă nici egg-ul, nici comanda de pornire.',

    'downloads' => 'descărcări',

    'install' => 'Instalează acest pachet',
    'install_go' => 'Instalează-l',
    'install_confirm' => 'Fișierele pachetului se adaugă acestui server. **Nu se șterge nimic** — nici lumea ta, nici modurile vechi, nici vreo configurație. Un pachet instalat peste altul le lasă pe amândouă, deci scoate singur modurile pachetului anterior dacă asta vrei. Serverul trebuie să fie oprit și rămâne oprit.',

    'started' => 'Se instalează',
    'started_helper' => 'Pachetul se descarcă și se despachetează. Câteva sute de fișiere durează câteva minute și primești o notificare când s-a terminat — continuă și dacă părăsești pagina.',

    'running' => 'Serverul rulează',
    'running_helper' => 'Minecraft își încarcă modurile la pornire, deci un pachet instalat acum ar lăsa un server care nu este nici pachetul vechi, nici cel nou, până la repornire. Oprește-l și încearcă din nou.',

    'done' => ':pack instalat',
    'done_body' => ':files fișiere descărcate și :overrides elemente din folderul propriu al pachetului puse la locul lor. Pornește serverul când ești gata.',
    'done_refused' => ':count fișiere au fost sărite pentru că pachetul le-a cerut dintr-un loc de unde acesta nu descarcă.',

    'failed' => 'Pachetul nu a fost instalat',
    'failed_fetch' => 'Pachetul nu a putut fi descărcat sau despachetat. Poate că daemonul nu este accesibil, sau serverul a rămas fără spațiu pe disc.',
    'failed_index' => 'Pachetul a fost descărcat, dar nu avea în el un index lizibil, deci nu era nimic de instalat.',
    'failed_version' => 'Acea versiune nu mai are un fișier de pachet de descărcat. Alege alta.',
    'failed_queue' => 'Instalarea nu a putut fi pusă în coadă. Pentru asta trebuie să ruleze un queue worker pe panou.',
];
