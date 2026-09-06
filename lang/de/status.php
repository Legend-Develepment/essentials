<?php

/*
 * Die öffentliche Statusseite.
 *
 * Das Einzige, was dieses Plugin jemandem zeigt, der nicht angemeldet ist, und
 * die einzige Seite, deren Wortlaut so gelesen werden muss, als sähe ihn ein
 * Fremder - denn das wird er. Nichts hier nennt eine Node, einen Besitzer oder
 * eine Adresse; nur einen Namen, ob er läuft, und wie viele Leute darauf sind.
 *
 * "Node" bleibt stehen, wo die Maschine als Pelican-Objekt gemeint ist; auf der
 * öffentlichen Seite selbst heißt sie "Maschine", denn dort liest sie jemand,
 * der von Pelican noch nie gehört hat.
 */

return [
    // ---- die Einstellungsseite --------------------------------------------
    'title' => 'Öffentliche Statusseite',
    'nav_label' => 'Statusseite',
    'subheading' => 'Eine Seite, die jeder ohne Konto öffnen kann und die zeigt, welche deiner Server laufen. Es erscheint nichts darauf, solange du unten keinen Server nennst.',

    'address' => 'Deine Statusseite ist erreichbar unter',
    'address_off' => 'Es wird noch nichts ausgeliefert. Füge unten einen Server, eine Maschine oder einen Dienst hinzu und speichere — dann steht hier die Adresse.',

    'which' => 'Was veröffentlicht wird',
    'which_helper' => 'Die Liste beginnt leer, und nichts ist öffentlich, solange nichts darin steht. Angeboten werden nur Server, die du ohnehin schon öffnen kannst.',
    'add' => 'Einen Server veröffentlichen',
    'server' => 'Server',
    'shown_as' => 'Angezeigt als',
    'shown_as_helper' => 'Was die Öffentlichkeit sieht. Tipp es ein, statt das Panel den echten Namen nehmen zu lassen — „mc-prod-3 (nicht anfassen)" ist eine Notiz an dich selbst und nichts, was in ein Forum gehört.',

    'look' => 'Wortlaut',
    'look_helper' => 'Alles auf dieser Seite wird von Leuten gelesen, die kein Konto haben.',
    'heading' => 'Überschrift',
    'heading_helper' => 'Leer gelassen wird der Name des Panels selbst genommen.',
    'note' => 'Eine Zeile über der Liste',
    'note_helper' => 'Um zu sagen, was los ist — ein Wartungsfenster, oder wo man fragen kann. Reiner Text.',
    'link' => 'Link zum Panel',
    'link_helper' => 'Ein Weg zurück hinein, unten auf der Seite. Schalte ihn aus, wenn du lieber nicht verrätst, wo dein Panel steht.',

    'save' => 'Speichern',
    'saved' => 'Gespeichert',
    'save_failed' => 'Es wurde nichts gespeichert',
    'open' => 'Seite öffnen',

    // ---- Spielerzahlen ----------------------------------------------------
    'counts' => 'Spielerzahlen',
    'counts_helper' => 'Woher die Zahlen neben einem Server kommen. Minecraft-Server beantworten ihren eigenen Handshake und werden unter Minecraft eingerichtet; alles hier unten gilt den Spielen, die Valves Query beantworten — Rust, ARK, Valheim, 7 Days to Die und das meiste andere, was auf Source oder Unreal läuft.',
    'query_eggs' => 'Eggs, die die Valve-Query beantworten',
    'query_eggs_helper' => 'Hake die Eggs für diese Spiele an. Dieselbe Liste entscheidet auch, welche Server im Panel eine Spielerseite bekommen — eine Frage, aus zwei Gründen gestellt. Gefragt wird nichts, bevor du es sagst: das hier ist die einzige Stelle, die eine Verbindung vom Panel direkt auf einen Spielport öffnet, also ist es eine Entscheidung und nichts, was von selbst anfängt. Ein Server, dessen Port vom Panel aus nicht erreichbar ist, zeigt einfach keine Zahl.',

    // ---- Nodes ------------------------------------------------------------
    'nodes' => 'Maschinen',
    'nodes_helper' => 'Läuft oder läuft nicht, und sonst nichts. Nicht die Last und nicht, wie voll die Festplatte ist — wer wissen will, ob er spielen kann, braucht keinen Kapazitätsbericht über deine Hardware, und einen zu veröffentlichen ist eine Karte davon, wo es klemmt.',
    'add_node' => 'Eine Maschine veröffentlichen',
    'node' => 'Maschine',
    'node_shown_as_helper' => 'Tipp es ein. Eine Node heißt meist so etwas wie hetzner-fsn1-01, und das ist ein ganzer Satz darüber, wo deine Maschinen stehen.',

    // ---- HTTP-Monitore ----------------------------------------------------
    'monitors' => 'Weitere Dienste',
    'monitors_helper' => 'Alles andere, von dem man wissen will, dass es läuft: deine Website, eine API, der Health-Endpunkt eines Bots. Das Panel fragt jeden davon im selben Takt wie die Server. Nur für Administratoren — ein Monitor bringt dieses Panel dazu, eine Adresse abzurufen, und wenn ihn jeder anlegen darf, wird daraus eine Sonde, die man richten kann, wohin man will.',
    'add_monitor' => 'Einen Dienst hinzufügen',
    'monitor_name' => 'Name',
    'monitor_url' => 'Adresse',
    'monitor_url_helper' => 'Nur https. Würde dieses Panel im Takt einfaches http abrufen, wüsste jeder auf dem Weg dorthin, welche deiner Dienste es gibt.',
    'monitor_expect' => 'Erwartet',
    'monitor_expect_helper' => 'Leer heißt „irgendeine Antwort überhaupt", und das ist richtig für eine Seite, die weiterleitet oder auf eine nackte Anfrage mit 403 antwortet. Eine Zahl ist für einen Endpunkt gedacht, der genau das und nichts anderes sagen soll — zu streng gesetzt, ist die Zeile für immer rot bei einem Dienst, dem nichts fehlt.',

    // ---- Seiten für Benutzer ----------------------------------------------
    'users' => 'Seiten für deine Benutzer',
    'users_helper' => 'Ob Leute mit Servern auf diesem Panel eine eigene Statusseite veröffentlichen dürfen.',
    'user_pages' => 'Benutzer dürfen eine eigene anlegen',
    'user_pages_helper' => 'Jeder bekommt eine eigene Adresse unter /status/sein-kürzel, auf der nur Server stehen, die ihm gehören, unter Namen, die er selbst eintippt. Keine Maschinen und keine weiteren Dienste darauf — beides gehört allein dir. Ist das an, finden sie es unter Statusseite in ihrem Kontomenü, in welchem Panel sie auch gerade sind.',

    // ---- das Aussehen -----------------------------------------------------
    'every' => 'Prüfen alle',
    'every_helper' => 'Wie oft die Seite neu gebaut wird und wie oft sie sich im Browser selbst erneuert. Eine Seite, auf die Leute während eines Neustarts schauen, will Sekunden; eine, die aus einem Forum verlinkt ist und die niemand offen hat, will eine Stunde — und dafür jede Minute jede Node zu fragen ist Arbeit für niemanden.',
    'every_realtime' => 'Echtzeit (10 Sekunden)',
    'every_30s' => '30 Sekunden',
    'every_1m' => '1 Minute',
    'every_5m' => '5 Minuten',
    'every_10m' => '10 Minuten',
    'every_30m' => '30 Minuten',
    'every_60m' => '60 Minuten',

    'style' => 'Stil',
    'style_helper' => 'Einer der Stile des Panels, auf diese Seite angewendet: seine Farbe, die daraus gebauten Grautöne und wie rund die Ecken sind. „Dem Panel folgen" heißt, was auch immer im Panel eingestellt ist, samt allem, was später geändert wird.',
    'style_mine_helper' => 'Die Stile, die dieses Panel anbietet, auf deine Seite angewendet: eine Farbe, die daraus gebauten Grautöne und wie rund die Ecken sind. Welche Stile auf dieser Liste stehen, entscheidet der Betreiber des Panels — dieselbe Liste, aus der du unter Darstellung wählen kannst. „Dem Panel folgen" heißt, was auch immer im Panel eingestellt ist.',
    'style_panel' => 'Dem Panel folgen',

    // ---- die eigene Seite -------------------------------------------------
    'mine_title' => 'Meine Statusseite',
    'mine_nav_label' => 'Statusseite',
    'mine_subheading' => 'Eine Adresse für die Leute, die auf deinen Servern spielen. Sie zeigt die Server, die du wählst, und sonst nichts über dieses Panel.',
    'mine_address' => 'Deine Adresse',
    'mine_address_helper' => 'Nimm etwas Kurzes. Sie später zu ändern zerreißt jeden Link, den sich schon jemand gespeichert hat.',
    'mine_address_off' => 'Wähle unten eine Adresse und speichere — dann steht deine Seite hier.',
    'slug' => 'Adresse',
    'slug_helper' => 'Kleinbuchstaben, Zahlen und Bindestriche. Mindestens drei Zeichen.',
    'mine_heading' => 'Überschrift',
    'mine_heading_helper' => 'Leer gelassen wird deine Adresse genommen.',
    'mine_note_helper' => 'Um zu sagen, was los ist — ein Neustart, ein Event, wo man dich findet. Reiner Text, und gelesen von jedem, der den Link hat.',
    'mine_which' => 'Deine Server',
    'mine_which_helper' => 'Angeboten werden nur Server, die dir gehören. Irgendwo Subuser zu sein ist Zugang zu einer Maschine und nicht die Erlaubnis, zu veröffentlichen, dass es sie gibt.',
    'mine_shown_as_helper' => 'Was Besucher sehen. Tipp es ein, statt den Panel-Namen zu nehmen, wenn dieser Name eine Notiz an dich selbst ist.',
    'mine_look_helper' => 'Wie deine Seite bei den Leuten aussieht, denen du sie schickst.',
    'mine_remove' => 'Meine Seite abschalten',
    'mine_remove_confirm' => 'Entfernt deine Seite und gibt die Adresse für jemand anderen frei. Alles, was du eingestellt hast, ist weg; die Server selbst bleiben unberührt.',
    'mine_removed' => 'Deine Seite ist abgeschaltet',

    'why_slug' => 'Diese Adresse geht nicht. Kleinbuchstaben, Zahlen und Bindestriche, mindestens drei Zeichen — und ein paar Wörter sind reserviert.',
    'why_taken' => 'Diese Adresse hat schon jemand anders.',
    'why_unwritable' => 'Es ließ sich nicht schreiben. Prüfe, ob storage/app dem Benutzer gehört, unter dem das Panel läuft.',

    // ---- Überschriften auf der Seite selbst -------------------------------
    'section_servers' => 'Server',
    'section_nodes' => 'Maschinen',
    'section_monitors' => 'Dienste',

    // ---- die Seite selbst -------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Startet',

    /*
     * Nicht „offline", und der Unterschied zählt in der Öffentlichkeit.
     *
     * Das Panel hat den Server nicht erreicht. Das ist meist eine Node in
     * Wartung oder eine Daemon, die neu startet - es ist nicht dasselbe wie ein
     * ausgeschalteter Server, und hundert Spielern zu sagen, ihr Server sei
     * unten, während er läuft, ist schlimmer, als zuzugeben, es nicht zu wissen.
     */
    'unknown' => 'Unbekannt',

    'players' => 'Spieler',
    'online_now' => 'spielen gerade',
    'checked' => 'Geprüft',
    'next_check' => 'bis zur nächsten Prüfung',
    'just_now' => 'gerade eben',
    'seconds_ago' => 'vor :count Sekunden',
    'panel' => 'Anmelden',

    'all_up' => 'Alles läuft.',
    'some_down' => 'Etwas läuft nicht.',
    'empty' => 'Hier wird noch nichts veröffentlicht.',
];
