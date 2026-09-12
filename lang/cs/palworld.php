<?php

/*
 * Čeština. Psáno ručně.
 *
 * Nastavení světa Palworldu - na stránce místo v souboru.
 *
 * Nic tady nepojmenovává jednotlivé nastavení. Každý popisek na té stránce se
 * odvozuje z klíče, který má v sobě soubor samotného serveru - proč by seznam
 * názvů byl horší než žádný, viz Support\Palworld\Palworld::label().
 */

return [
    'title' => 'Nastavení Palworldu',
    'nav_label' => 'Palworld',
    'subheading' => 'Nastavení světa z PalWorldSettings.ini tohoto serveru, načtená při otevření této stránky. Upravovat lze jen při zastaveném serveru.',

    'reload' => 'Načíst soubor znovu',

    'save_confirm' => 'Soubor se přepíše těmito hodnotami. Každé nastavení, které tahle stránka neukázala, se zapíše zpátky přesně tak, jak bylo, a stejně tak všechno ostatní v souboru.',
    'saved' => 'Nastavení uložena',
    'saved_body' => 'Začnou platit při příštím spuštění serveru.',
    'save_failed' => 'Soubor se nepodařilo zapsat',

    'running' => 'Server běží',
    'running_body' => 'Palworld drží tahle nastavení v paměti a při zastavení soubor přepisuje, takže uložené teď by se bez jediného slova vrátilo zpět. Nejdřív server zastavte.',

    'groups' => [
        'server' => 'Server a připojení',
        'world' => 'Svět a poměry',
        'pals' => 'Palové',
        'players' => 'Hráči',
        'building' => 'Stavění, předměty a sběr',
        'guild' => 'Cechy',
        'other' => 'Ostatní',
    ],
];
