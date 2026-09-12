<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Subuser", „Wings", „SFTP", „cron" a „queue worker" ostávajú po anglicky: pod
 * týmito menami sa nájdu v Pelicane aj na hostiteľovi, a presne to treba
 * vedieť, keď sa niektorý z tých riadkov objaví.
 */

return [
    'nav_label' => 'Prístup k serverom',
    'title' => 'Servery podľa roly',
    'subheading' => 'Dať všetkým, ktorí majú rolu, prístup k tým istým serverom.',

    /*
     * Povedané skôr než čokoľvek iné na stránke, lebo toto je jediná tunajšia
     * funkcia, ktorá zapisuje do tabuľky patriacej Pelicanu.
     */
    'more' => 'Ako to funguje',
    'warning' => 'Funguje to tak, že sa udržiavajú v aktuálnom stave subusers samotného Pelicanu - tie isté riadky, ktoré by ste ručne pridali na stránke Používatelia daného servera, a tie, ktoré už číta zoznam serverov, každá kontrola oprávnení aj Wings. Siaha sa len na riadky, ktoré vytvoril sám: to, čo ste pridali ručne, sa nikdy nemení ani nemaže. Nikomu nechodí e-mail, keď mu rola pridelí server. Odobratie prístupu ruší aj jeho SFTP, a na to treba ten istý queue worker, ktorý Pelican aj tak vyžaduje.',

    'never' => 'Zatiaľ sa nič nezosúladilo. Uložte priradenie nižšie a stane sa to hneď, a potom každú minútu cez cron samotného panela.',
    'timing' => 'Prístup sa odoberá vo chvíli, keď má: kto príde o rolu, príde o servery hneď na nasledujúcej stránke. Pridelenie môže trvať až minútu, lebo to je prechod, ktorý hľadá ľudí, čo panel práve nepoužívajú.',
    'last_run' => 'Posledný prechod pred :ago sekundami: pridaných :added, odobraných :removed, ponechaných :held.',
    'capped' => 'Priveľa naraz - pridelení :pairs, a limit je :max. Nič sa nezapísalo. Zúžte priradenie: rola s päťdesiatimi ľuďmi a dvadsiatimi servermi robí tisíc pridelení sama osebe.',

    'which' => 'Priradenia',
    'which_helper' => 'Rola, servery, na ktoré majú jej držitelia dosiahnuť, a čo tam smú. Kto má dve roly, dostane všetko, čo dávajú obe. Vlastníci serverov a root administrátori sa preskakujú - majú už viac, než by im toto mohlo dať.',
    'add' => 'Pridať rolu',

    'role' => 'Rola',
    'role_helper' => 'Všetci jej držitelia, vrátane tých, čo ju dostanú neskôr.',
    'servers' => 'Servery',
    'servers_helper' => 'Servery, ktoré dostanú. Odobrať jeden odtiaľto znamená ten prístup zase vziať späť.',

    'permissions' => 'Čo smú',
    'permissions_helper' => 'Oprávnenia subusera samotného Pelicanu. Nechajte ich, ako sú, pre rozumnú zostavu: konzola, tlačidlá napájania, súbory, zálohy a záznam aktivity - a nič, čo upravuje samotný server, jeho používateľov, jeho databázy alebo jeho alokácie. „Connect to websocket" je vždy zahrnuté, lebo bez neho sa stránka konzoly nepripojí k ničomu.',

    'save' => 'Uložiť a použiť',
    'saved' => 'Uložené',
    'saved_body' => 'Pridelených :added, odobraných :removed.',
    'save_failed' => 'Nepodarilo sa uložiť',
    'save_failed_disk' => 'Zoznam sa nepodarilo zapísať do storage. Skontrolujte, že storage/app patrí používateľovi, pod ktorým panel beží.',

    'revoke' => 'Vziať všetko späť',
    'revoke_confirm' => 'Odobrať všetko, čo toto pridelilo?',
    'revoke_confirm_helper' => 'Každý riadok subusera, ktorý táto stránka vytvorila, na každom serveri, pre všetkých - a ich SFTP spolu s ním. Riadkov pridaných ručne sa to nedotkne. Priradenia nižšie ostávajú, takže najbližšie uloženie alebo najbližší prechod ich pridelia znova: najprv zoznam vyprázdnite, ak to myslíte vážne.',
    'revoked' => 'Odobraných: :count',
    'revoked_body' => 'Len riadky, ktoré vytvorila táto stránka. To, čo sa pridalo ručne, ostalo tam, kde bolo.',
    'revoke_failed' => 'Nepodarilo sa ich odobrať',
];
