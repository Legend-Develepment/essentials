<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Egg", „daemon", „SteamID64" a „PlayFab ID" ostávajú po anglicky: to sú slová
 * Pelicanu a slová samotnej hry, a práve pod nimi sa zase nájdu.
 */

return [
    /* --------------------------------------------- karta administrátora -- */

    'section_helper' => 'Ktoré eggs spúšťajú Valheim. Nič viac — server Valheimu sa nastavuje jeho spúšťacími premennými, a stránka Spustenie v Pelicane ich už upravuje.',

    'eggs' => 'Ktoré eggs sú Valheim',
    'eggs_helper' => 'Zaškrtnite eggs, ktoré spúšťajú server Valheimu. Vnútri serverov, ktoré ich používajú, sa objaví stránka Zoznamy hráčov, a nikde inde. Kde tie zoznamy ležia, sa pri rôznych eggs líši, takže sa to zisťuje server po serveri nahliadnutím do miest, ktoré hra používa. Na začiatku nie je zaškrtnuté nič, a to naschvál: plugin nemôže vedieť, ako ste svoje eggs pomenovali.',

    /* ------------------------------------------------- stránka servera --- */

    'nav_label' => 'Zoznamy hráčov',
    'title' => 'Zoznamy hráčov Valheimu',
    'subheading' => 'Administrátori, zabanovaní a zoznam povolených — tri zoznamy namiesto troch textových súborov.',

    'admin' => 'Administrátori',
    'admin_helper' => 'Každý, kto je tu, môže v hre používať administrátorské príkazy.',
    'banned' => 'Zabanovaní',
    'banned_helper' => 'Každého, kto je tu, hra pri pokuse o pripojenie odmietne.',
    'permitted' => 'Povolení',
    'permitted_helper' => 'Keď je v tomto zozname niekto, dnu smú len títo ľudia. Prázdny zoznam púšťa všetkých — a to väčšina serverov chce, tak ho nechajte prázdny, ak to nemyslíte inak.',

    'ids' => 'Identifikátory hráčov',
    'ids_placeholder' => 'Vložte identifikátor a stlačte medzerník',

    'how' => 'Po jednom identifikátore na hráča — SteamID64 na serveri Steam, PlayFab ID na crossplay serveri. Vložte ich a stlačte medzerník, tabulátor alebo čiarku. To, čo hra napísala ako komentár nad zoznam, ostáva na mieste.',
    'where' => 'Načítané z :dir.',
    'missing' => 'Tento server zatiaľ nemá žiadny z týchto súborov. Hra ich zapíše, keď ich prvýkrát bude potrebovať, a uloženie tu vytvorí tie, ktoré vyplníte.',
    'read_only' => 'Tieto súbory môžete čítať, ale nie zapisovať, takže tu sa nedá nič zmeniť.',

    'save' => 'Uložiť',
    'saved' => 'Uložené',
    'saved_reload' => 'Valheim tieto zoznamy načítava za behu, takže zmena platí bez reštartu.',
    'unchanged' => 'Nič sa nezmenilo, takže sa nič nezapísalo',
    'failed' => 'Nepodarilo sa uložiť',
    'failed_lists' => 'Daemon odmietol zápis pre: :lists. Skontrolujte, že je server dostupný a že súbory nie sú len na čítanie.',
];
