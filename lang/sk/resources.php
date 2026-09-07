<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Mod", „plugin", „loader", „jar" a názvy priečinkov mods/ a plugins/
 * ostávajú, ako sú: to sú slová z Modrinthu, zo správcu súborov a z každého
 * návodu, ktorý sa k tomu nájde.
 */

return [
    'nav_label' => 'Mody a pluginy',
    'title' => 'Mody a pluginy',
    'subheading' => 'Po jednom, z Modrinthu, na tento server.',

    'section' => 'Nájsť niečo',
    'section_helper' => 'Stránka modpackov inštaluje celý pack naraz. Tu sa inštaluje jeden mod alebo jeden plugin — a to sa chce oveľa častejšie.',

    'kind' => 'Čo pridávate',
    /*
     * Spýtané, nie odvodené. Egg sa volá tak, ako ho pomenoval administrátor, a
     * niekoľko loaderov číta obidva priečinky, takže odtiaľto nie je poctivý
     * spôsob, ako to uhádnuť - a zlý odhad zapíše jar do priečinka, ktorý nikto
     * nečíta.
     */
    'kind_helper' => 'Mod ide do mods/ a je pre Fabric, Forge alebo NeoForge. Plugin ide do plugins/ a je pre Bukkit, Spigot alebo Paper. Toto tiež rozhoduje, v ktorej polovici Modrinthu sa hľadá.',
    'kind_mod' => 'Mod (mods/)',
    'kind_plugin' => 'Plugin (plugins/)',

    'search' => 'Hľadať',
    'search_helper' => 'Napíšte názov a kliknite mimo poľa. Výsledky idú podľa počtu stiahnutí.',

    'project' => 'Mod alebo plugin',
    'version' => 'Verzia',
    'version_helper' => 'V každom riadku je číslo verzie, verzie Minecraftu, pre ktoré je zostavená, a podporované loadery. Vyberte tú, ktorá sedí vášmu serveru — tu to za vás nikto nekontroluje.',

    'install' => 'Nainštalovať',
    'install_confirm' => 'Súbor stiahne uzol priamo z Modrinthu a položí ho do priečinka. Nič z toho, čo tam už je, sa neodoberá.',
    'installed' => 'Nainštalované',
    'installed_helper' => 'Načíta sa pri najbližšom spustení servera.',

    'change' => 'Zmeniť verziu',
    'change_helper' => 'Dá na miesto tohto súboru inú verziu toho istého projektu. Nová sa stiahne skôr, než sa stará zmaže, takže neúspešné sťahovanie vás nechá s tým, čo ste už mali.',
    'change_project_helper' => 'Pevné pre všetko, čo bolo nainštalované z tejto stránky. Zmeniť to by nebola zmena verzie — bol by to iný mod pod tým istým názvom súboru.',
    'change_lookup_helper' => 'Tento súbor už v priečinku ležal, takže tu nikto nevie, čo to je. Raz ho vyhľadajte a zapamätá sa.',
    'changed' => 'Verzia zmenená',

    'check' => 'Skontrolovať aktualizácie',
    'checked' => 'Skontrolované',
    'checked_none' => 'Všetko známe je vo svojej najnovšej verzii.',
    'checked_some' => 'Novšiu verziu má :count. Sú v zozname označené.',
    'update_ready' => 'dostupná v:number',
    /*
     * Povedané vedľa odznaku, nie v bubline, lebo to mení, čo odznak znamená: tu
     * nikto nevie, ktorú verziu Minecraftu a ktorý loader server spúšťa.
     */
    'check_note' => 'Novšie znamená novšie na Modrinthe. Tu nikto nevie, ktorú verziu Minecraftu a ktorý loader váš server spúšťa, tak si pred spustením servera overte, že vybraná verzia o sebe hovorí, že sedí.',
    'unknown' => 'Nie odtiaľto — použite „Zmeniť verziu", nech sa povie, čo to je',

    'remove' => 'Odobrať',
    'remove_confirm' => 'Súbor sa zo servera zmaže. Odtiaľto sa to nedá vrátiť.',
    'removed' => 'Odobrané',

    'running' => 'Server beží',
    'running_helper' => 'Minecraft číta mods/ a plugins/ raz, pri štarte. Súbor pridaný teraz by sa načítal až po reštarte, a súbor vytiahnutý spod bežiacej hry ju môže vziať so sebou. Najprv server zastavte.',

    'failed' => 'Toto nevyšlo',
    'failed_version' => 'Táto verzia nemá jar, ktorý by sa tu dal nainštalovať. Niektoré vydania obsahujú len zdrojáky alebo len klientský build.',
    'failed_write' => 'Uzol sťahovanie odmietol. Možno sa nedostal na Modrinth.',

    'installed_title' => 'Nainštalované',
    'installed_mods' => 'V mods/',
    'installed_plugins' => 'V plugins/',
    /*
     * Povedané preto, že prázdny zoznam je dvojznačný: obyčajne znamená, že
     * tento server ten priečinok vôbec nepoužíva, nie že niečo chýba.
     */
    'installed_empty' => 'Tu nič nie je. Server používa len jeden z tých dvoch priečinkov, takže že je jeden prázdny, je normálne.',
    'installed_note' => 'Vypísané sú len súbory .jar. Konfiguračné priečinky a vypnuté súbory sa nechávajú tak a neukazujú sa.',
];
