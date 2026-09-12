<?php

/*
 * Română. Scrisă de mână.
 *
 * Pagina Starea sistemului: gazda pe care rulează chiar panoul și orice node
 * cerut alături de ea.
 *
 * Nu este aceeași mașină cu node-urile pe nicio instalare unde sunt separate,
 * de aceea pot fi amândouă pe pagină.
 *
 * „Swap”, „Wings”, „PHP” și „uptime” rămân: așa se numesc pe gazdă și în orice
 * unealtă cu care ai compara.
 */

return [
    'title' => 'Starea sistemului',
    'nav_label' => 'Starea sistemului',
    'subheading' => 'Mașina pe care rulează chiar panoul, ce rulează pe ea, și orice node cerut alături.',

    'options' => 'Opțiuni',
    'enabled' => 'Arată în bara laterală',
    'enabled_helper' => 'Oprit scoate rândul din bara laterală. Pagina își păstrează adresa, deci este mereu acolo ca să o repornești.',

    'refresh' => 'Recitește la fiecare',
    'refresh_helper' => 'Toată pagina se cere din nou la acest interval. Oprit o lasă cum era când ai deschis-o.',
    'refresh_off' => 'Doar când o deschid',
    'refresh_seconds' => ':seconds secunde',

    'blocks' => 'Arată',
    'blocks_helper' => 'Ce este bifat se arată. Discul este câte o fișă pentru fiecare sistem de fișiere, deci o partiție rădăcină plină nu se ascunde în spatele unei montări de date pe jumătate goale.',
    'block_cpu' => 'Procesor',
    'block_memory' => 'Memorie',
    'block_swap' => 'Swap',
    'block_disk' => 'Disc',
    'block_load' => 'Media încărcării',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistem',
    'block_version' => 'Versiunea panoului',
    // Nu se arată niciodată - fișa unui node ia numele node-ului - dar blank()
    // o cere, iar o cheie lipsă care își tipărește propriul nume este o rezervă
    // slabă.
    'block_node' => 'Node',

    'nodes' => 'Node-uri de arătat',
    'nodes_helper' => 'Câte o fișă pentru fiecare, alături de gazda panoului. Nimic bifat nu arată niciunul - pagina de ansamblu are deja un bloc cu fiecare node. Fiecare este întrebat de propriul daemon, deci un interval scurt și o listă lungă înseamnă multe cereri.',

    'section_usage' => 'Utilizare',
    'section_host' => 'Acest panou',
    'section_nodes' => 'Node-uri',

    'disk_panel' => 'Panoul stă aici',
    'wings' => 'Wings :version',
    'version_installed' => 'Instalată',
    'version_latest' => 'Cea mai nouă',
    'version_current' => 'La zi',
    'version_update' => 'Actualizare disponibilă',
    'version_unknown' => 'Nu s-a putut verifica',

    /*
     * Ce oferă o fișă rămasă în urmă.
     *
     * O legătură spre lansare și nu un buton care face actualizarea, pentru că
     * de aici nu există actualizare de făcut: Pelicanul nu are comandă de
     * upgrade, iar Wings nu are un endpoint care să își înlocuiască propriul
     * binar. Indiciul spune unde se face de fapt treaba, ca nimeni să nu caute
     * un buton care nu a fost niciodată posibil.
     */
    'version_release' => 'Ce e nou',
    'version_how_panel' => 'Deschide notele de lansare. Actualizarea panoului se face pe mașina pe care rulează - panoul nu își poate înlocui propriile fișiere, iar niciun plugin nu poate rula comenzi de shell.',
    'version_how_wings' => 'Deschide notele de lansare. Wings se actualizează chiar pe node - panoul nu are niciun canal spre programul care rulează pe altă mașină.',

    'wings_latest' => 'Cea mai nouă :version',
    'load_cores' => ':percent% din :cores procesoare',
    'load_windows' => ':five pe 5 min · :fifteen pe 15 min',
    'uptime_since' => 'Din :date',
    'unavailable' => 'Nu este disponibil pe această gazdă',

    'fact_os' => 'Sistem de operare',
    'fact_hostname' => 'Nume de gazdă',
    'fact_php' => 'PHP',
    'fact_cores' => 'Procesoare',
    'fact_processes' => 'Procese',
];
