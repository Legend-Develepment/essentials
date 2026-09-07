<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Whitelist" a „operator" zůstávají anglicky: to jsou slova, která samotný
 * Minecraft píše do server.properties, do whitelist.json a do ops.json, a
 * tatáž se zpátky ťukají v konzoli.
 */

return [
    'nav_label' => 'Hráči',
    'title' => 'Hráči',
    'subheading' => 'Whitelist, operators, bany a všichni, koho tenhle server viděl.',

    /*
     * Řečeno jednou, nahoře, protože to vysvětluje jak to, co stránka umí, tak
     * i to, proč jedna věc, kterou nedělá, není závada. Každá změna odchází jako
     * příkaz do konzole, protože právě takhle se to Minecraftu má říkat - hra
     * změnu provede a zapíše si vlastní soubor, takže se ti dva nikdy
     * nerozejdou.
     */
    'how' => 'Změny se na server posílají jako příkazy konzole, takže je provádí hra a ona sama si píše své soubory. K tomu musí server běžet.',
    'needs_running' => 'Server musí běžet. Tyhle změny dělá hra, ne úprava jejích souborů pod ní.',

    'name' => 'Jméno hráče',
    'reason' => 'Důvod (nepovinné)',

    'whitelist' => 'Přidat do whitelistu',
    'unwhitelist' => 'Odebrat z whitelistu',
    'op' => 'Udělat operatorem',
    'deop' => 'Odebrat operatora',
    'ban' => 'Zabanovat',
    'pardon' => 'Odbanovat',
    'kick' => 'Vyhodit',

    'sent' => 'Příkaz odeslán',
    'sent_body' => 'Server ho použije a aktualizuje si vlastní soubory. Načtěte stránku znovu, ať uvidíte změněné seznamy.',
    'refused' => 'Tohle se neodeslalo',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Ve whitelistu',
    'flag_banned' => 'Zabanován',
    'flag_seen' => 'Už tu hrál',

    'online' => 'Právě online',
    'online_count' => ':online z :max',
    'online_none' => 'Nikdo není připojený.',

    'players' => 'Hráči',
    'ips' => 'Zabanované adresy',
    'ips_empty' => 'Žádná adresa není zabanovaná.',

    /*
     * Co znamená prázdná stránka, a obvykle to neznamená „žádní hráči", ale
     * „tenhle server ještě nikdy nenaběhl". Minecraft žádný z těchhle souborů
     * před prvním během nevytvoří.
     */
    'empty' => 'Zatím není co ukázat. Minecraft si tyhle seznamy píše sám a nevytvoří je, dokud server poprvé nenaběhne.',

    'level' => 'Úroveň :level',

    /*
     * Jediná věc, kterou tahle stránka nedělá, řečená rovnou, ne nechaná na
     * objevení. Stav naživo potřebuje druhé připojení k samotné hře, a to je
     * jiná funkce s vlastními nároky.
     */
    'not_live' => 'Tohle je to, co si server zapsal, ne to, kdo je připojený právě teď.',
];
