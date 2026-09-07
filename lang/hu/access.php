<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „subuser”, „Wings”, „SFTP”, „cron” és „root admin” marad: ezek a Pelican és
 * a gazdagép szavai, és ezekre keres az, aki utánanéz a sornak.
 */

return [
    'nav_label' => 'Szerverhozzáférés',
    'title' => 'Szerverek szerepkör szerint',
    'subheading' => 'Adj mindenkinek, akinek megvan egy szerepköre, hozzáférést ugyanazokhoz a szerverekhez.',

    /*
     * Az oldalon minden más előtt kimondva, mert ez itt az egyetlen funkció,
     * amely olyan táblába ír, amely a Pelicané.
     */
    'more' => 'Hogyan működik ez',
    'warning' => 'Ez úgy működik, hogy naprakészen tartja a Pelican saját subusereit — ugyanazokat a sorokat, amelyeket kézzel adnál hozzá egy szerver Users oldalán, és pontosan ezeket olvassa a szerverlista, a jogosultságellenőrzés és a Wings is. Csak azokhoz a sorokhoz nyúl, amelyeket ő hozott létre: amit kézzel vettél fel, azt soha nem módosítja és nem távolítja el. Senki sem kap e-mailt, ha egy szerepkör szervert ad neki. A hozzáférés elvétele visszavonja az SFTP-jüket is, amihez az a queue worker kell, amelyet a Pelican amúgy is kér.',

    'never' => 'Még semmi sem lett összehangolva. Ments el lent egy hozzárendelést, és azonnal megtörténik, utána pedig percenként a panel saját cronján.',
    'timing' => 'A hozzáférés abban a pillanatban tűnik el, amikor kell: aki elveszít egy szerepkört, a legközelebbi oldalán már elveszíti a szervereket is. Az adás akár egy percig is tarthat, mert az az a söprés, amely azokat keresi, akik éppen nem használják a panelt.',
    'last_run' => 'Utolsó futás :ago másodperce: :added hozzáadva, :removed eltávolítva, :held a helyén.',
    'capped' => 'Túl sok egyszerre — :pairs adás, a határ pedig :max. Semmi sem lett kiírva. Szűkíts egy hozzárendelést: egy szerepkör ötven emberrel és húsz szerverrel önmagában ezer adás.',

    'which' => 'A hozzárendelések',
    'which_helper' => 'Egy szerepkör, azok a szerverek, amelyeket minden birtokosának el kell érnie, és az, hogy mit tehetnek ott. Aki két szerepkörben van, mindent megkap, amit mindkettő ad. A szerverek tulajdonosait és a root adminokat kihagyja — nekik már többjük van, mint amit ez adhatna.',
    'add' => 'Szerepkör hozzáadása',

    'role' => 'Szerepkör',
    'role_helper' => 'Minden birtokosa, azok is, akik később kapják meg.',
    'servers' => 'Szerverek',
    'servers_helper' => 'Azok a szerverek, amelyeket megkapnak. Ha itt eltávolítasz egyet, azt a hozzáférést újra elveszi.',

    'permissions' => 'Mit tehetnek',
    'permissions_helper' => 'A Pelican saját subuser-jogosultságai. Hagyd őket úgy, ahogy vannak, egy értelmes csomagért: a konzol, az energiagombok, a fájlok, a mentések és a tevékenységnapló — és semmi, ami a szervert, a felhasználóit, az adatbázisait vagy az allokációit szerkeszti. A Connect to websocket mindig benne van, mert nélküle a konzololdal semmihez sem csatlakozik.',

    'save' => 'Mentés és alkalmazás',
    'saved' => 'Mentve',
    'saved_body' => ':added megadva, :removed visszavéve.',
    'save_failed' => 'Nem sikerült menteni',
    'save_failed_disk' => 'A listát nem sikerült a storage könyvtárba írni. Ellenőrizd, hogy a storage/app azé a felhasználóé-e, amelyként a panel fut.',

    'revoke' => 'Vedd vissza az egészet',
    'revoke_confirm' => 'Eltávolítod mindazt, amit ez adott?',
    'revoke_confirm_helper' => 'Minden subuser-sort, amelyet ez az oldal hozott létre, minden szerveren, mindenkinél — és az SFTP-jüket is vele. A kézzel felvett sorokhoz nem nyúl. A lenti hozzárendelések maradnak, tehát a következő mentés vagy a következő időzítés újra megadná őket: előbb ürítsd ki a listát, ha véglegesen gondolod.',
    'revoked' => ':count eltávolítva',
    'revoked_body' => 'Csak azok a sorok, amelyeket ez az oldal hozott létre. Amit kézzel vettél fel, ott van, ahol volt.',
    'revoke_failed' => 'Nem sikerült eltávolítani őket',
];
