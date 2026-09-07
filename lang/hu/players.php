<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „whitelist”, „operator”, „ban” és „kick” angolul marad: ezek azok a
 * parancsok, amelyeket a konzolba írsz, és azoknak a fájloknak a nevei,
 * amelyeket a Minecraft maga ír. Egy lefordított gomb egy angol parancs mellett
 * olyan gomb, amelyet fejben vissza kell fordítani.
 */

return [
    'nav_label' => 'Játékosok',
    'title' => 'Játékosok',
    'subheading' => 'A whitelist, az operatorok, a banok, és mindenki, akit ez a szerver látott.',

    /*
     * Egyszer kimondva, fent, mert megmagyarázza azt is, mit tud az oldal, és
     * azt is, hogy amit nem, az miért nem hiba. Minden változtatás
     * konzolparancsként megy ki, mert így kell szólni a Minecraftnak - a játék
     * végzi el a változtatást és írja a saját fájlját, így a kettő soha nem
     * mond mást.
     */
    'how' => 'A változtatások konzolparancsként mennek a szerverre, így a játék végzi el őket és írja a saját fájljait. Ehhez a szervernek futnia kell.',
    'needs_running' => 'A szervernek futnia kell. Ezeket a változtatásokat a játék végzi, nem a fájljainak szerkesztése alóla.',

    'name' => 'Játékosnév',
    'reason' => 'Indok (nem kötelező)',

    'whitelist' => 'Hozzáadás a whitelisthez',
    'unwhitelist' => 'Eltávolítás a whitelistről',
    'op' => 'Legyen operator',
    'deop' => 'Operator elvétele',
    'ban' => 'Ban',
    'pardon' => 'Ban feloldása',
    'kick' => 'Kick',

    'sent' => 'Parancs elküldve',
    'sent_body' => 'A szerver alkalmazza, és frissíti a saját fájljait. Töltsd újra az oldalt, hogy lásd a listák változását.',
    'refused' => 'Ez nem lett elküldve',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Whitelisten',
    'flag_banned' => 'Bannolva',
    'flag_seen' => 'Játszott már itt',

    'online' => 'Most fent',
    'online_count' => ':online / :max',
    'online_none' => 'Senki sincs csatlakozva.',

    'players' => 'Játékosok',
    'ips' => 'Bannolt címek',
    'ips_empty' => 'Egy cím sincs bannolva.',

    /*
     * Mit jelent egy üres oldal, ami rendszerint nem azt, hogy „nincsenek
     * játékosok”, hanem hogy „ez a szerver soha nem indult el”. A Minecraft
     * ezek közül egyik fájlt sem hozza létre az első futása előtt.
     */
    'empty' => 'Még nincs mit mutatni. A Minecraft maga írja ezeket a listákat, és nem hozza létre őket, amíg a szerver először el nem indult.',

    'level' => ':level. szint',

    /*
     * Az az egy dolog, amit ez az oldal nem csinál, kimondva, nem
     * felfedezésre hagyva. Az élő állapothoz egy második kapcsolat kell magához
     * a játékhoz, ami más funkció a maga követelményeivel.
     */
    'not_live' => 'Ez az, amit a szerver leírt, nem az, hogy ki van fent éppen most.',
];
