<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Egg", „daemon", „SteamID64" a „PlayFab ID" zůstávají anglicky: to jsou slova
 * Pelicanu a slova samotné hry, a právě pod nimi se zase najdou.
 */

return [
    /* --------------------------------------------- karta administrátora -- */

    'section_helper' => 'Které eggs spouštějí Valheim. Nic víc — server Valheimu se nastavuje jeho spouštěcími proměnnými, a stránka Spuštění v Pelicanu je už upravuje.',

    'eggs' => 'Které eggs jsou Valheim',
    'eggs_helper' => 'Zaškrtněte eggs, které spouštějí server Valheimu. Uvnitř serverů, které je používají, se objeví stránka Seznamy hráčů, a nikde jinde. Kde ty seznamy leží, se u různých eggs liší, takže se to zjišťuje server po serveru nahlédnutím do míst, která hra používá. Na začátku není zaškrtnuto nic, a to schválně: plugin nemůže vědět, jak jste své eggs pojmenovali.',

    /* ------------------------------------------------- stránka serveru --- */

    'nav_label' => 'Seznamy hráčů',
    'title' => 'Seznamy hráčů Valheimu',
    'subheading' => 'Administrátoři, zabanovaní a seznam povolených — tři seznamy místo tří textových souborů.',

    'admin' => 'Administrátoři',
    'admin_helper' => 'Každý, kdo je tady, může ve hře používat administrátorské příkazy.',
    'banned' => 'Zabanovaní',
    'banned_helper' => 'Každého, kdo je tady, hra při pokusu o připojení odmítne.',
    'permitted' => 'Povolení',
    'permitted_helper' => 'Když je v tomhle seznamu někdo, smějí dovnitř jen tihle lidé. Prázdný seznam pouští všechny — a to většina serverů chce, tak ho nechte prázdný, pokud to nemyslíte jinak.',

    'ids' => 'Identifikátory hráčů',
    'ids_placeholder' => 'Vložte identifikátor a stiskněte mezerník',

    'how' => 'Po jednom identifikátoru na hráče — SteamID64 na serveru Steam, PlayFab ID na crossplay serveru. Vložte je a stiskněte mezerník, tabulátor nebo čárku. To, co hra napsala jako komentář nad seznam, zůstává na místě.',
    'where' => 'Načteno z :dir.',
    'missing' => 'Tenhle server zatím nemá žádný z těchto souborů. Hra je zapíše, až je poprvé bude potřebovat, a uložení tady vytvoří ty, které vyplníte.',
    'read_only' => 'Tyhle soubory můžete číst, ale ne zapisovat, takže tady nejde nic změnit.',

    'save' => 'Uložit',
    'saved' => 'Uloženo',
    'saved_reload' => 'Valheim tyhle seznamy načítá za běhu, takže změna platí bez restartu.',
    'unchanged' => 'Nic se nezměnilo, takže se nic nezapsalo',
    'failed' => 'Nepodařilo se uložit',
    'failed_lists' => 'Daemon odmítl zápis pro: :lists. Zkontrolujte, že je server dostupný a že soubory nejsou jen ke čtení.',
];
