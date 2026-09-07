<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Swap", „Load average", „Wings" a „Uptime" zůstávají anglicky: pod těmito
 * jmény se najdou na hostiteli i v samotném rozhraní Pelicanu.
 */

return [
    'title' => 'Stav systému',
    'nav_label' => 'Stav systému',
    'subheading' => 'Stroj, na kterém běží samotný panel, co na něm běží, a vedle každý uzel, o který jste si řekli.',

    'options' => 'Volby',
    'enabled' => 'Zobrazit v bočním panelu',
    'enabled_helper' => 'Vypnuto vezme položku z bočního panelu pryč. Stránka si nechává vlastní adresu, takže je vždycky po ruce, aby se dala zase zapnout.',

    'refresh' => 'Načítat znovu každých',
    'refresh_helper' => 'Celá stránka se v tomhle intervalu vyžádá znovu. Vypnuto ji nechá takovou, jaká byla při otevření.',
    'refresh_off' => 'Jen když ji otevřu',
    'refresh_seconds' => ':seconds sekund',

    'blocks' => 'Zobrazit',
    'blocks_helper' => 'Zaškrtnuto znamená vidět. „Disk" je jedna karta na souborový systém, takže plný kořenový oddíl se neschová za napůl prázdný datový.',
    'block_cpu' => 'Procesor',
    'block_memory' => 'Paměť',
    'block_swap' => 'Swap',
    'block_disk' => 'Disk',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'Systém',
    'block_version' => 'Verze panelu',
    // Nikdy se neukazuje - karta uzlu nese jméno samotného uzlu - ale blank() se
    // na ni ptá, a chybějící klíč, který vypíše vlastní jméno, je slabá
    // náhrada.
    'block_node' => 'Uzel',

    'nodes' => 'Které uzly zobrazit',
    'nodes_helper' => 'Po jedné kartě, vedle hostitele panelu. Nic zaškrtnutého neukáže žádný — nástěnka už blok se všemi uzly má. Každý se ptá u svého vlastního daemona, takže krátký interval a dlouhý seznam je hodně požadavků.',

    'section_usage' => 'Využití',
    'section_host' => 'Tenhle panel',
    'section_nodes' => 'Uzly',

    'disk_panel' => 'Tady bydlí panel',
    'wings' => 'Wings :version',
    'version_installed' => 'Nainstalovaná',
    'version_latest' => 'Nejnovější',
    'version_current' => 'Aktuální',
    'version_update' => 'Dostupná aktualizace',
    'version_unknown' => 'Nepodařilo se zkontrolovat',

    /*
     * Co nabízí karta, která zaostala.
     *
     * Odkaz na vydání místo tlačítka, které aktualizuje, protože odsud není co
     * aktualizovat: Pelican nemá příkaz k aktualizaci a Wings nemá koncový bod,
     * který by vyměnil vlastní binárku. Nápověda říká, kde se práce doopravdy
     * odehrává, ať nikdo nehledá tlačítko, které nikdy nebylo možné.
     */
    'version_release' => 'Co je nového',
    'version_how_panel' => 'Otevře poznámky k vydání. Panel se aktualizuje na stroji, kde běží - panel nemůže vyměnit vlastní soubory a žádný plugin nesmí spouštět příkazy shellu.',
    'version_how_wings' => 'Otevře poznámky k vydání. Wings se aktualizuje na samotném uzlu - panel nemá žádný kanál k programu běžícímu na jiném stroji.',

    'wings_latest' => 'Nejnovější :version',
    'load_cores' => ':percent % z :cores procesorů',
    'load_windows' => ':five za 5 min · :fifteen za 15 min',
    'uptime_since' => 'Od :date',
    'unavailable' => 'Na tomhle hostiteli není k dispozici',

    'fact_os' => 'Operační systém',
    'fact_hostname' => 'Název hostitele',
    'fact_php' => 'PHP',
    'fact_cores' => 'Procesory',
    'fact_processes' => 'Procesy',
];
