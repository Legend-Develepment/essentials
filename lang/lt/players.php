<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Whitelist“, „operator“, „ban“ ir „kick“ lieka angliškai: tai komandos,
 * kurias rašai konsolėje, ir failų, kuriuos Minecraft rašo pats, pavadinimai.
 * Išverstas mygtukas šalia angliškos komandos yra mygtukas, kurį galvoje tenka
 * versti atgal.
 */

return [
    'nav_label' => 'Žaidėjai',
    'title' => 'Žaidėjai',
    'subheading' => 'Whitelist, operatoriai, ban-ai ir visi, ką šis serveris matė.',

    /*
     * Pasakyta vieną kartą, viršuje, nes tai paaiškina ir tai, ką puslapis gali,
     * ir tai, kodėl vienas dalykas, kurio jis negali, nėra gedimas. Kiekvienas
     * pakeitimas išsiunčiamas kaip konsolės komanda, o būtent taip Minecraft ir
     * yra sakoma - žaidimas atlieka pakeitimą ir rašo savo failą, tad tiedu
     * niekada nesiskiria.
     */
    'how' => 'Pakeitimai siunčiami serveriui kaip konsolės komandos, tad juos atlieka žaidimas ir rašo savo failus. Tam serveris turi veikti.',
    'needs_running' => 'Serveris turi veikti. Šiuos pakeitimus atlieka žaidimas, o ne jo failų redagavimas po juo.',

    'name' => 'Žaidėjo vardas',
    'reason' => 'Priežastis (nebūtina)',

    'whitelist' => 'Įtraukti į whitelist',
    'unwhitelist' => 'Pašalinti iš whitelist',
    'op' => 'Padaryti operator',
    'deop' => 'Nuimti operator',
    'ban' => 'Ban',
    'pardon' => 'Nuimti ban',
    'kick' => 'Kick',

    'sent' => 'Komanda išsiųsta',
    'sent_body' => 'Serveris ją pritaiko ir atnaujina savo failus. Perkrauk puslapį, kad pamatytum, kaip sąrašai keičiasi.',
    'refused' => 'Tai nebuvo išsiųsta',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Whitelist sąraše',
    'flag_banned' => 'Su ban',
    'flag_seen' => 'Yra čia žaidęs',

    'online' => 'Prisijungę dabar',
    'online_count' => ':online iš :max',
    'online_none' => 'Niekas neprisijungęs.',

    'players' => 'Žaidėjai',
    'ips' => 'Adresai su ban',
    'ips_empty' => 'Nė vienas adresas neturi ban.',

    /*
     * Ką reiškia tuščias puslapis, o tai paprastai ne „nėra žaidėjų“, o „šis
     * serveris niekada nebuvo paleistas“. Minecraft nesukuria nė vieno iš šių
     * failų iki pirmo savo paleidimo.
     */
    'empty' => 'Kol kas nėra ką rodyti. Minecraft rašo šiuos sąrašus pats ir nesukuria jų, kol serveris pirmą kartą nepasileidžia.',

    'level' => ':level lygis',

    /*
     * Vienintelis dalykas, kurio šis puslapis nedaro, pasakytas, o ne paliktas
     * atrasti. Gyvai būsenai reikia antro ryšio su pačiu žaidimu, o tai kita
     * galimybė su savais reikalavimais.
     */
    'not_live' => 'Tai yra tai, ką serveris užsirašė, o ne tai, kas viduje kaip tik dabar.',
];
