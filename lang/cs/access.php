<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Subuser", „Wings", „SFTP", „cron" a „queue worker" zůstávají anglicky: pod
 * těmito jmény se najdou v Pelicanu i na hostiteli, a přesně to je potřeba
 * vědět, když se některý z těch řádků objeví.
 */

return [
    'nav_label' => 'Přístup k serverům',
    'title' => 'Servery podle role',
    'subheading' => 'Dát všem, kdo mají roli, přístup ke stejným serverům.',

    /*
     * Řečeno dřív než cokoli jiného na stránce, protože tohle je jediná zdejší
     * funkce, která zapisuje do tabulky patřící Pelicanu.
     */
    'more' => 'Jak to funguje',
    'warning' => 'Funguje to tak, že se udržují v aktuálním stavu subusers samotného Pelicanu - tytéž řádky, které byste ručně přidali na stránce Uživatelé daného serveru, a ty, které už čte seznam serverů, každá kontrola oprávnění i Wings. Sahá se jen na řádky, které vytvořil sám: to, co jste přidali ručně, se nikdy nemění ani nemaže. Nikomu nechodí e-mail, když mu role přidělí server. Odebrání přístupu ruší i jeho SFTP, a k tomu je potřeba tentýž queue worker, který Pelican beztak vyžaduje.',

    'never' => 'Zatím se nic nesladilo. Uložte přiřazení níže a stane se to hned, a pak každou minutu přes cron samotného panelu.',
    'timing' => 'Přístup se odebírá ve chvíli, kdy má: kdo přijde o roli, přijde o servery hned na následující stránce. Přidělení může trvat až minutu, protože to je průchod, který hledá lidi, kteří panel právě nepoužívají.',
    'last_run' => 'Poslední průchod před :ago sekundami: přidáno :added, odebráno :removed, ponecháno :held.',
    'capped' => 'Příliš mnoho najednou - přidělení :pairs, a limit je :max. Nic se nezapsalo. Zužte přiřazení: role s padesáti lidmi a dvaceti servery dělá tisíc přidělení sama o sobě.',

    'which' => 'Přiřazení',
    'which_helper' => 'Role, servery, na které mají její držitelé dosáhnout, a co tam smějí. Kdo má dvě role, dostane všechno, co dávají obě. Vlastníci serverů a root administrátoři se přeskakují - mají už víc, než by jim tohle mohlo dát.',
    'add' => 'Přidat roli',

    'role' => 'Role',
    'role_helper' => 'Všichni její držitelé, včetně těch, kdo ji dostanou později.',
    'servers' => 'Servery',
    'servers_helper' => 'Servery, které dostanou. Odebrat jeden odsud znamená ten přístup zase vzít zpátky.',

    'permissions' => 'Co smějí',
    'permissions_helper' => 'Oprávnění subuseru samotného Pelicanu. Nechte je, jak jsou, pro rozumnou sadu: konzole, tlačítka napájení, soubory, zálohy a záznam aktivity - a nic, co upravuje samotný server, jeho uživatele, jeho databáze nebo jeho alokace. „Connect to websocket" je vždy zahrnuto, protože bez něj se stránka konzole nepřipojí k ničemu.',

    'save' => 'Uložit a použít',
    'saved' => 'Uloženo',
    'saved_body' => 'Přiděleno :added, odebráno :removed.',
    'save_failed' => 'Nepodařilo se uložit',
    'save_failed_disk' => 'Seznam se nepodařilo zapsat do storage. Zkontrolujte, že storage/app patří uživateli, pod kterým panel běží.',

    'revoke' => 'Vzít všechno zpátky',
    'revoke_confirm' => 'Odebrat všechno, co tohle přidělilo?',
    'revoke_confirm_helper' => 'Každý řádek subuseru, který tahle stránka vytvořila, na každém serveru, pro všechny - a jejich SFTP spolu s ním. Řádků přidaných ručně se to nedotkne. Přiřazení níže zůstávají, takže příští uložení nebo příští průchod je přidělí znovu: nejdřív seznam vyprázdněte, jestli to myslíte vážně.',
    'revoked' => 'Odebráno: :count',
    'revoked_body' => 'Jen řádky, které vytvořila tahle stránka. To, co se přidalo ručně, zůstalo tam, kde bylo.',
    'revoke_failed' => 'Nepodařilo se je odebrat',
];
