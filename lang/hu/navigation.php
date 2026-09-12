<?php

/*
 * Magyar. Kézzel írva.
 *
 * A Navigációs linkek oldal. A közlemények mellett, nem a téma beállításain
 * belül: egyik sem arról szól, hogy hogyan néz ki a panel. Az egyik az, amit
 * mond, ez pedig az, hogy hová visz.
 *
 * A „topbar” marad: így hívják magában a panelben.
 */

return [
    'title' => 'Navigációs linkek',
    'nav_label' => 'Navigációs linkek',
    'subheading' => 'Saját sorok az oldalsávban - egy Discord-meghívó, egy állapotoldal, egy tudásbázis. A Filament saját navigációján keresztül mennek, így úgy viselkednek, mint minden más bejegyzés: egy cím alatt ülnek, és követik az oldalsávot akkor is, ha az keskeny sáv, és akkor is, ha felső sáv.',

    'add' => 'Link hozzáadása',
    'enabled' => 'Be',
    'off' => 'ki',

    'label' => 'Név',
    'icon' => 'Ikon',
    'url' => 'Cím',
    'url_helper' => 'https:// vagy egy útvonal ezen a panelen belül, például /account. Minden mást figyelmen kívül hagy - a navigáció egy sora nem az a hely, ahol váratlan sémának helye van.',
    'scope' => 'Itt látszik',
    'scope_all' => 'Mindenhol',
    'scope_client' => 'Csak az admin területen kívül',
    'scope_admin' => 'Csak az admin területen',
    'scope_login' => 'A bejelentkezési űrlap alatt',
    'group' => 'Csoport',
    'group_helper' => 'Hagyd üresen, hogy az első cím fölé kerüljön. Írd ugyanazt a nevet két linkhez, és együtt ülnek alatta.',
    'new_tab' => 'Megnyitás új lapon',

    'favicon' => 'Használd a webhely saját ikonját',
    'favicon_helper' => 'Egyszer töltődik le, amikor mentesz - soha nem akkor, amikor valaki oldalt tölt be. Ha a webhely nem válaszol, a fent kiválasztott ikon marad.',
    'icon_fallback' => 'Csak akkor használatos, ha a webhelynek nincs saját ikonja.',

    'saved' => 'Navigációs linkek mentve',
    'failed' => 'A navigációs linkeket nem sikerült menteni',
];
