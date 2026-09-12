<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Steam App ID", "IGDB", "Twitch client ID" und "client secret" bleiben stehen:
 * genau diese Wörter stehen auf den Seiten, von denen man die Werte holt.
 */

return [
    'title' => 'Egg-Bilder',
    'nav_label' => 'Egg-Bilder',
    'subheading' => 'Spielbilder für deine Eggs, geholt von Steam und IGDB. Ein Egg ohne Bild zeigt auf jeder Serverkarte Pelicans eigenen Vogel.',

    // ---- die Tabelle ------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Gesperrt',
    'locked' => 'Gesperrt',
    'unlocked' => 'Offen',

    // ---- was man mit einer Zeile tun kann ---------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Die Zahl in der Steam-Adresse eines Spiels - store.steampowered.com/app/892970 ist 892970. Ein Abruf über die ID sperrt das Bild, denn eine eingetippte Zahl ist eine Entscheidung, und ein späterer Sammellauf darf sie nicht rückgängig machen.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Suchen nach',
    'search_term_helper' => 'Der Name des Eggs ist vorausgefüllt, aber er ist selten der Name des Spiels - „Paper 1.20.4" ist Minecraft. Tipp das Spiel ein.',

    'lock' => 'Sperren',
    'unlock' => 'Entsperren',
    'locked_done' => 'Gesperrt - ein Sammellauf lässt dieses hier in Ruhe',
    'unlocked_done' => 'Entsperrt - ein Sammellauf darf dieses Bild ersetzen',

    'clear' => 'Löschen',
    'clear_confirm' => 'Entfernt das Bild und die Steam App ID. Das Egg fällt auf Pelicans eigenen Vogel zurück, und der nächste Sammellauf versucht es erneut.',
    'cleared' => 'Bild entfernt',

    // ---- Ergebnisse -------------------------------------------------------
    'fetched' => 'Bild gespeichert',
    'failed' => 'Es wurde kein Bild gespeichert',

    /*
     * Je ein eigener Grund, denn das sind verschiedene Probleme: ein Abruf, der
     * an einem Tippfehler scheiterte, und einer, der scheiterte, weil die
     * Festplatte voll ist, sollten nicht beide „fehlgeschlagen" sagen.
     */
    'why_bad_id' => 'Das ist keine Steam App ID.',
    'why_not_found' => 'Unter dieser Adresse hat Steam nichts. Prüfe die App ID - ein Spiel ohne Shop-Seite hat auch kein Titelbild.',
    'why_no_match' => 'Unter diesem Namen wurde nichts gefunden. Versuch es damit, wie das Spiel tatsächlich heißt, statt mit dem Namen des Eggs.',
    'why_no_name' => 'Es gibt nichts, wonach gesucht werden könnte.',
    'why_no_token' => 'Twitch hat kein Token ausgestellt. Prüfe client ID und secret unter „Zugangsdaten".',
    'why_not_configured' => 'IGDB braucht eine Twitch client ID und ein secret. Trag sie unter „Zugangsdaten" ein.',
    'why_empty' => 'Die Antwort war leer.',
    'why_large' => 'Dieses Bild ist weit größer als ein Icon und wurde nicht gespeichert.',
    'why_not_an_image' => 'Was zurückkam, ist kein Bild. Meist heißt das, eine Fehlerseite hat mit einem Erfolgscode geantwortet.',
    'why_wrong_format' => 'Dieses Bild liegt in einem Format vor, das dieses Panel nicht ablegt. Pelican behält PNG, JPEG und WebP.',
    'why_unwritable' => 'Das Bild konnte nicht geschrieben werden. Prüfe, ob storage/app/public dem Benutzer gehört, unter dem das Panel läuft, und ob php artisan storage:link ausgeführt wurde.',
    'why_unknown' => 'Es hat nicht geklappt, und für den Grund kennt das hier keinen Namen.',

    // ---- alles auf einmal -------------------------------------------------
    'bulk' => 'Alle fehlenden holen',
    'bulk_confirm_steam' => 'Sucht bei Steam nach Namen für jedes Egg, das kein Bild hat und nicht gesperrt ist. Gesperrte Eggs und solche mit Bild bleiben unberührt. Das läuft im Hintergrund - du bekommst Bescheid, wenn es fertig ist.',
    'bulk_confirm_both' => 'Sucht bei Steam nach Namen für jedes Egg, das kein Bild hat und nicht gesperrt ist, und versucht danach IGDB für alles, was Steam nicht gefunden hat. Gesperrte Eggs und solche mit Bild bleiben unberührt. Das läuft im Hintergrund - du bekommst Bescheid, wenn es fertig ist.',
    'bulk_started' => 'Wird im Hintergrund geholt',
    'bulk_started_body' => 'Auf einem großen Panel kann das mehrere Minuten dauern. Du bekommst eine Meldung, wenn es fertig ist, und kannst diese Seite verlassen.',
    'bulk_done' => 'Egg-Bilder fertig',
    'bulk_done_body' => ':fetched geholt, :skipped unberührt gelassen, :failed ohne Fund. Ein Egg bleibt unberührt, wenn es gesperrt ist oder schon ein Bild hat.',
    'bulk_failed' => 'Der Sammellauf ist nicht gelaufen',
    'bulk_failed_queue' => 'Er konnte nicht an die Queue übergeben werden. Dafür braucht es einen Queue-Worker - prüfe, ob pelican-queue läuft.',

    // ---- IGDB-Zugangsdaten ------------------------------------------------
    'credentials' => 'Zugangsdaten',
    'credentials_helper' => 'Steam funktioniert ganz ohne das hier. Diese Angaben sind nur für IGDB, das die Spiele abdeckt, von denen Steam nie gehört hat - Minecraft und jeden seiner Ableger, alles, was auf einer Konsole erschien, die meisten gemoddeten Eggs.',
    'credentials_where' => 'Lege unter dev.twitch.tv/console eine Anwendung an, erzeuge ein client secret und füge beides hier ein. Es ist kostenlos.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Zugangsdaten gespeichert',
    'credentials_failed' => 'Die Zugangsdaten konnten nicht gespeichert werden',
];
