<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Sidebar", "Topbar", "Egg", "Node", "Subuser", "Wings", "Queue", "Webhook",
 * "Dashboard", "Widget", "Cron" und die Dateiformate bleiben stehen: das sind
 * die Wörter, unter denen man sie in Pelican selbst, auf dem Host und in jeder
 * Anleitung dazu wiederfindet. Die Namen der Stile bleiben ebenfalls stehen -
 * ein Stil heißt, wie er heißt, und eine übersetzte Bezeichnung wäre ein
 * zweiter Name für dieselbe Sache.
 */

return [
    'css_warning' => 'Gespeichert, aber dieses CSS sieht falsch aus',
    'css_unclosed' => 'Eine Regel, die in Zeile :line beginnt, wird nie geschlossen. Alles danach steht innerhalb dieser Regel und greift nicht.',
    'css_extra' => 'In Zeile :line steht eine schließende Klammer, obwohl nichts offen ist. Alles danach steht außerhalb jeder Regel und wird ignoriert.',
    'css_comment' => 'Ein Kommentar, der in Zeile :line beginnt, wird nie geschlossen — der Rest der Datei steht also darin.',

    'groups' => [
        'appearance' => 'Darstellung',
        'servers' => 'Serverliste',
        'windows' => 'Zeitgesteuerte Stile',
        'windows_helper' => 'Ein anderer Stil zwischen zwei Uhrzeiten. Es passiert nichts, solange du keinen anlegst. Die Uhr ist die des Panels selbst, aus seiner Zeitzonen-Einstellung, und nicht die jedes Lesers — ein Panel, das im selben Moment für zwei Leute verschieden aussieht, sieht kaputt aus und nicht geplant. Ein Fenster ändert das Aussehen, das das Panel schon hat, es tut also nichts, solange der Stil auf „Keiner" steht. Ein Stil, den sich jemand selbst ausgesucht hat, gewinnt weiterhin dagegen.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Sprachen',
        'servers_helper' => 'Wie eine Serverkarte gezeichnet wird. Ob sie als Raster oder als Liste erscheinen, entscheidet jeder für sich, unter Konto → Dashboard-Layout.',
        'server_pages' => 'Serverseiten',
        'server_pages_helper' => 'Was jede Seite innerhalb eines Servers trägt, welche Seite es auch ist.',
        'console' => 'Konsolenseite',
        'console_helper' => 'Schrift, Größe und Höhe des Terminals wählt jeder für sich, unter Konto.',
        'background' => 'Hintergrund',
        'background_helper' => 'Gilt für das ganze Panel, auch für den Anmeldebildschirm.',
        'icons' => 'Symbole',
        'bars' => 'Auslastungsbalken',
        'bars_helper' => 'Die Balken für Prozessor, Arbeitsspeicher und Festplatte auf den Serverkarten.',
        'updates' => 'Aktualisierungen',
        'updates_helper' => 'Welche Versionen die Theme-Seite anbietet und wo sie danach sucht.',
        'brand' => 'Marke',
        'login' => 'Anmeldebildschirm',
        'login_helper' => 'Gilt für die Bildschirme zum Anmelden, zum Zurücksetzen des Passworts und für die Zwei-Faktor-Abfrage.',
        'advanced' => 'Eigenes CSS',
        'advanced_helper' => 'Für alles, was die Einstellungen oben nicht abdecken. Wird nach allem anderen geladen und gewinnt deshalb.',
        'areas' => 'Je Bereich',
        'areas_helper' => 'Alles oben gilt überall. Hier kannst du einen Bereich davon ausnehmen; was leer bleibt, folgt weiter der allgemeinen Einstellung.',
        'footer' => 'Fußzeile der Sidebar',
        'footer_helper' => 'Das untere Ende der Sidebar, das Pelican leer lässt. Alles hier ist aus, bis du es ausfüllst.',
        'features' => 'Was dieses Plugin hinzufügt',
        'features_helper' => 'Einen Haken zu entfernen nimmt das Betreffende ganz aus dem Panel. Seine Einstellungen bleiben erhalten und seine Seite behält ihre Adresse, es geht also nichts verloren, wenn man etwas ausschaltet, um zu sehen, was es getan hat. Das meiste davon hat unter Rollen zusätzlich eine eigene Berechtigung, um eines herzugeben, ohne den Rest herzugeben. Nicht alles: die Auslastungsbalken, die Fußzeile der Sidebar und die Einstellungssuche werden für jeden gezeichnet und von niemandem verwaltet, der Stern auf einer Serverkarte gehört dem, der ihn angeklickt hat, und die Palworld- und Minecraft-Seiten innerhalb eines Servers richten sich nach den Berechtigungen dieses Servers statt nach einer von diesen. Das Aussehen selbst steht nicht auf dieser Liste — dafür gibt es einen eigenen Schalter, unter Aussehen → Darstellung → Stil → Keiner.',
        'identity' => 'Dieses Plugin in der Sidebar',
        'identity_helper' => 'Die Zeile, die dieses Plugin der Sidebar hinzufügt, und das Bild darauf.',
    ],

    /*
     * Die Einstellungsseiten, jede eine Zeile in der eigenen Sidebar-Gruppe des
     * Plugins. Gruppiert nach der Frage, die man beantwortet, und nicht danach,
     * welche Klasse sie umsetzt.
     */
    'pages' => [
        'look' => 'Aussehen',
        'look_helper' => 'Farbe, Form und wie das Panel heißt.',
        'pages' => 'Seiten',
        'pages_helper' => 'Die Serverliste, die Seiten innerhalb eines Servers und das Terminal.',
        'advanced' => 'Erweitert',
        'advanced_helper' => 'Die zwei Notausgänge: dein eigenes CSS, und Einstellungen, die nur für einen Bereich gelten.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Welche Eggs Minecraft sind, und alles Weitere dazu.',
        'artwork' => 'Egg-Bilder',
        'artwork_helper' => 'Eine Seite mit jedem Egg und ein Weg, das Bild des Spiels dafür von Steam oder IGDB zu holen. Sie schreibt in die Eggs selbst — das Bild und zwei Tags, die festhalten, welches Spiel es ist und ob das Bild von Hand gewählt wurde — und trägt deshalb eine eigene Berechtigung.',
        'alerts' => 'Warnungen',
        'alerts_helper' => 'Eine Prüfung im Takt für das, was das Panel längst misst und niemandem sagt: eine Node, die nicht mehr antwortet, eine volllaufende Festplatte, ein stehen gebliebener Queue-Worker, eine zurückfallende Version. Sendet an Discord, ins Panel oder per E-Mail. Eigene Berechtigung, denn es erreicht im Takt jede Node und postet an eine Adresse, die jemand eingetippt hat.',
        'backups' => 'Backup-Übersicht',
        'backups_helper' => 'Eine Seite mit jedem Server und wie lange er ohne Backup ist, so sortiert, dass die ganz ohne oben stehen. Nur lesend — alles, was auf ein Backup wirkt, bleibt auf Pelicans eigener Seite für diesen Server. Eigene Berechtigung, denn die Liste ist eine Karte davon, wo die Lücken sind.',
        'public_status' => 'Öffentliche Statusseite',
        'public_status_helper' => 'Eine Seite, die jeder ohne Konto öffnen kann und die zeigt, welche deiner Server laufen und wie viele Leute darauf sind. Es wird nichts veröffentlicht, bevor du einen Server, eine Maschine oder einen Dienst nennst — alle drei Listen beginnen leer, und solange sie es sind, antwortet die Adresse mit 404. Eigene Berechtigung, denn sie entscheidet, was das Panel verlässt.',
        'game_players' => 'Spieler, andere Spiele',
        'capacity' => 'Kapazität',
        'capacity_helper' => 'Was auf jeder Maschine zugesagt ist gegen das, was sie vergeben darf — damit man sieht, ob noch ein Server hineinpasst. Pelicans Node-Liste zeigt einen Namen und eine Zahl von Servern, und der Maschinen-Block auf dem Dashboard zeigt, was gerade läuft - das hier ist die dritte Frage, und die Rechnung ist Pelicans eigene. Nur lesend. Eigene Berechtigung.',
        'schedules' => 'Zeitpläne',
        'schedules_helper' => 'Jeder Zeitplan des Panels, samt dem, welche davon stehen geblieben sind: mitten im Durchlauf hängend, überfällig, weil der Cron nicht läuft, oder nie gelaufen. Pelican zeigt Zeitpläne innerhalb jedes Servers, und sein eigener Status hat für keinen dieser Fälle ein Wort. Nur lesend. Eigene Berechtigung.',
        'activity' => 'Aktivität',
        'activity_helper' => 'Jedes Ereignis, das das Panel protokolliert, in einer Liste statt Server für Server. Pelican führt das Protokoll und zeigt es je Server; das hier fragt dasselbe Protokoll andersherum. Nur lesend. Eigene Berechtigung, denn eine Aufzeichnung, wer was getan hat, gibt man bewusst heraus.',
        'access' => 'Serverzugang',
        'access_helper' => 'Eine Rolle an Server binden, sodass jeder, der sie hat, sie erreicht. Es funktioniert, indem Pelicans eigene Subuser aktuell gehalten werden — und genau die liest die Serverliste und jede Berechtigungsprüfung ohnehin schon. Eigene Berechtigung, denn es ist die eine Seite hier, die Leuten Zugang zu Dingen gibt.',
        'games' => 'Andere Spiele',
        'games_helper' => 'Die Dateien, die ARK und Valheim neben ihrer Welt führen, als Formulare: ARKs Welteinstellungen und Valheims Admin-, Bann- und Zulassungslisten. Welche Server sie bekommen, sagt die Egg-Liste auf dieser Seite — eine leere Liste ist also bereits ein Ausschalter je Spiel.',
        'game_players_helper' => 'Eine Seite in Rust, ARK, Valheim und allem anderen, das Valves Query beantwortet, mit denen, die verbunden sind, und wie lange schon. Nur lesend — was man mit jemandem tun kann, ist von Spiel zu Spiel verschieden, und das ist eine eigene Version. Welche Eggs zählen, ist dieselbe Liste, die auch die Statusseite nutzt.',
        'api' => 'API',
        'api_helper' => 'Die Schlüssel, die Leute haben, wer einen erbeten hat, und was jeder von ihnen sehen darf.',
        'languages' => 'Sprachen',
        'languages_helper' => 'In welchen Sprachen dieses Plugin antwortet.',
    ],

    'features' => [
        'look' => 'Aussehen-Einstellungen',
        'look_helper' => 'Die Sidebar-Zeile für Farbe, Form und Marke.',
        'pages' => 'Seiten-Einstellungen',
        'pages_helper' => 'Die Sidebar-Zeile für Serverliste, Serverseiten und Terminal.',
        'advanced' => 'Erweiterte Einstellungen',
        'advanced_helper' => 'Die Sidebar-Zeile für dein eigenes CSS und die Ausnahmen je Bereich.',
        'announcements' => 'Ankündigungen',
        'announcements_helper' => 'Der Balken oben quer über dem Panel.',
        'nav_links' => 'Navigationslinks',
        'nav_links_helper' => 'Deine eigenen Zeilen in der Sidebar.',
        'login' => 'Anmeldebildschirm',
        'login_helper' => 'Bild, Hinweis und Links des Anmeldebildschirms.',
        'bars' => 'Auslastungsbalken',
        'bars_helper' => 'Die neu eingefärbten Balken für Prozessor, Arbeitsspeicher und Festplatte.',
        'dashboard_status' => 'Versionszeile',
        'dashboard_status_helper' => 'Der obere Teil des Dashboard-Blocks: welche Version installiert ist und ob eine wartet.',
        'dashboard_nodes' => 'Maschinen',
        'dashboard_nodes_helper' => 'Der Rest des Dashboard-Blocks: dieses Panel und jede Node, mit dem, was jede gerade braucht.',
        'system_status' => 'Seite Systemstatus',
        'system_status_helper' => 'Die Seite für die Maschine, auf der das Panel selbst läuft.',
        'sidebar_footer' => 'Fußzeile der Sidebar',
        'sidebar_footer_helper' => 'Deine Textzeile, die Panel-Version und ein Link, unten in der Sidebar.',
        'api' => 'API',
        'api_helper' => 'Ein Weg von außen ins Panel: eine Adresse, an der ein Discord-Bot oder ein eigenes Skript fragen kann, was dieses Plugin weiß — wer gerade spielt, welche Server kein Backup haben, ob noch einer auf eine Node passt. Aus registriert überhaupt keine Route statt einer, die ablehnt, und das ist weniger Angriffsfläche statt einer höflicheren Menge davon. Jeder Angemeldete darf einen Schlüssel erbitten, der nur für seine eigenen Server antwortet; einen zu gewähren, einen abzulehnen, einen fremden zurückzuziehen und einen fürs ganze Panel auszugeben verlangen allesamt die Berechtigung.',
        'languages' => 'Sprachen',
        'languages_helper' => 'Jedem in der Sprache antworten, auf die sein eigenes Konto eingestellt ist, sofern dieses Plugin dahin übersetzt wurde. Aus bekommt jeder Englisch.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Ein Minecraft-Tab in der Sidebar und eine Seite in jedem Minecraft-Server, um dessen server.properties als Formular zu bearbeiten. Welche Eggs zählen, sagst du.',
        'palworld' => 'Palworld-Einstellungen',
        'palworld_helper' => 'Eine Seite in einem Palworld-Server, um dessen Welteinstellungen zu bearbeiten. Sie erscheint auf keinem anderen Server und nie, während dieser läuft.',
        'settings_search' => 'Einstellungssuche',
        'settings_search_helper' => 'Das Feld über diesen Formularen, das sie auf die Abschnitte einengt, in denen steht, was du tippst.',
        'preview' => 'Live-Vorschau',
        'preview_helper' => 'Der Kasten neben dem Aussehen-Formular, der zeigt, was Farben, Ecken und Abstände tun, bevor du sie speicherst.',
        'duplicate' => 'Server duplizieren',
        'duplicate_helper' => 'Eine Seite, um einen weiteren Server genau wie einen vorhandenen einzurichten, oder gleich mehrere. Dateien werden nie kopiert.',
        'favourites' => 'Markierte Server',
        'favourites_helper' => 'Ein Stern auf jeder Serverkarte. Markierte stehen vorn, und die Liste jedes Einzelnen liegt auf dem Panel — die Sterne folgen ihm also auf das nächste Gerät, an dem er sich anmeldet. Es ändert, was er sieht, und für alle anderen nichts. Auf dem Panel zu liegen heißt allerdings: es ist eine Datei unter storage, die jeder mit Zugang zur Maschine lesen kann.',
        'artwork' => 'Egg-Bilder',
        'artwork_helper' => 'Die Admin-Seite, die das Bild jedes Eggs von Steam oder IGDB holt und in das Egg selbst schreibt.',
        'alerts' => 'Warnungen',
        'alerts_helper' => 'Die Prüfung im Takt auf eine Node, die nicht mehr antwortet, eine volllaufende Festplatte, einen gestorbenen Queue-Worker oder eine zurückfallende Version — und die Meldung, die sie an Discord, ins Panel oder per E-Mail schickt.',
        'backups' => 'Backup-Übersicht',
        'backups_helper' => 'Die Admin-Seite, die jeden Server danach auflistet, wie lange er ohne Backup ist. Nur lesend.',
        'public_status' => 'Öffentliche Statusseite',
        'public_status_helper' => 'Die Seite, die jeder ohne Konto öffnen kann. Aus antwortet die Adresse mit 404, was auch immer auf der Liste steht.',
        'game_players' => 'Spieler, andere Spiele',
        'game_players_helper' => 'Eine Seite in Rust, ARK, Valheim und allem anderen, das Valves Query beantwortet, mit denen, die verbunden sind, und wie lange schon.',
        'owner_alerts' => 'Leuten sagen, dass ihr Server offline ist',
        'owner_alerts_helper' => 'Der einzige Teil dieses Plugins, der Leuten schreibt, die keine Administratoren sind: eine Benachrichtigung im Panel, wenn die Maschine eines ihrer Server nicht mehr antwortet, und eine, wenn sie zurück ist. Aus, bis es hier und auf der Warnungen-Seite eingeschaltet wird - es schreibt an deine Kunden, es braucht also zwei Entscheidungen statt einer.',
        'my_backups' => 'Backup-Hinweis auf der Serverliste',
        'my_backups_helper' => 'Eine Zeile über der eigenen Serverliste jedes Einzelnen, wenn einer seiner Server noch nie oder länger nicht gesichert wurde. Pelicans Karten sagen, was ein Server gerade tut; nichts dort sagt, dass seit drei Wochen kein Backup gelaufen ist. Wird nur gezeichnet, wenn etwas hinterherhinkt, und nennt keinen Server, den derjenige nicht ohnehin öffnen könnte.',
        'capacity' => 'Kapazitätsübersicht',
        'capacity_helper' => 'Die Admin-Seite, die Arbeitsspeicher, Festplatte und Prozessor als zugesagt gegen verfügbar auf jeder Maschine zeigt, samt den Servern, denen Backups, Datenbanken oder Ports ausgegangen sind. Zugesagt und nicht verbraucht - eine Node kann viel zu tun haben und leer sein, oder untätig und voll.',
        'schedules' => 'Zeitplan-Übersicht',
        'schedules_helper' => 'Die Admin-Seite mit jedem Zeitplan des Panels, das Schlimmste zuerst - hängend, überfällig oder nie gelaufen. Nur lesend; alles, was einen bearbeitet oder ausführt, bleibt auf Pelicans eigener Seite für diesen Server.',
        'activity' => 'Panel-Aktivität',
        'activity_helper' => 'Die Admin-Seite mit jedem protokollierten Ereignis des Panels, das Neueste zuerst, mit wer es getan hat und auf welchem Server. Nur lesend - sie löscht nichts, und Pelicans eigene Einstellung entscheidet weiter, wie lange Zeilen aufgehoben werden.',
        'access' => 'Serverzugang nach Rolle',
        'access_helper' => 'Eine Seite, um eine Rolle an Server zu binden, wahrgehalten in Pelicans eigener Subuser-Tabelle. Sie gewährt nichts, solange du nichts zuordnest. Ausschalten stoppt den Abgleich; bereits gewährter Zugang bleibt, und die Seite hat eine Schaltfläche, um ihn zurückzunehmen.',
        'scheduled' => 'Zeitgesteuerte Stile',
        'scheduled_helper' => 'Der Abschnitt auf der Aussehen-Seite, um dem Panel zwischen zwei Uhrzeiten einen anderen Stil zu geben. Er ändert nichts Gespeichertes — ein Fenster wird beim Zeichnen der Seite über die Einstellungen gelegt und gleich danach wieder losgelassen — das Ausschalten stellt also sofort das eigene Aussehen des Panels wieder her und verliert nichts.',
        'games' => 'Andere Spiele',
        'games_helper' => 'ARKs Welteinstellungen und Valheims Admin-, Bann- und Zulassungslisten, als Formulare statt als Dateien im Dateimanager. Welche Server sie bekommen, sagt die Egg-Liste auf der Seite Andere Spiele.',
        'quick' => 'Menü „Gehe zu"',
        'quick_helper' => 'Ein Bedienelement oben auf jeder Seite, um zu einem Server oder zu einer markierten Seite zu springen, mit einem Suchfeld über die ganze Serverliste. Es markiert auch die Seite, auf der man gerade ist. Was jemand darüber findet, ist das, was er ohnehin erreichen konnte, es gewährt also nichts - Ausschalten nimmt die Abkürzung weg und die Favoriten-Seite mit ihr.',
        'shop' => 'Shop',
        'shop_helper' => 'Server aus dem Panel heraus verkaufen: der Shop und die Kasse im Kundenbereich, die Rechnungsseite jeder Person, und die Seite Shop-Einstellungen für Währung, Steuer und Wortlaut. Der Hauptschalter — aus, und niemand kann kaufen oder bezahlen, während bereits Verkauftes weiter über die Seiten darunter verwaltet wird.',
        'packages' => 'Pakete',
        'packages_helper' => 'Die Verwaltungsseite, auf der festgelegt wird, was zum Verkauf steht: eine Servervorlage mit Preis, Zeitraum und Bestand. Ein eigenes Recht, weil Preise festlegen eine andere Arbeit ist als Rechnungen als bezahlt zu markieren.',
        'orders' => 'Bestellungen',
        'orders_helper' => 'Die Verwaltungsseite mit allem, was gekauft wurde, dem Server, der daraus wurde, und seinem Stand — ausstehend, aktiv, gesperrt, storniert. Ein eigenes Recht.',
        'invoices' => 'Rechnungen',
        'invoices_helper' => 'Die Verwaltungsseite mit dem, was geschuldet und was bezahlt wurde, mit einer Schaltfläche, um eine Rechnung von Hand als bezahlt zu markieren. Ein eigenes Recht, weil diese Schaltfläche der Ort ist, an dem Geld verbucht wird.',
        'payments' => 'Zahlungen',
        'payments_helper' => 'Die Zahlungsanbieter — ihre Schlüssel und jeder Versuch, der über sie lief. Ein eigenes Recht, weil dort die Zugangsdaten liegen: wer jede Rechnung sehen darf, muss das Geheimnis noch lange nicht sehen.',
        'coupons' => 'Gutscheine',
        'coupons_helper' => 'Codes, die einen Prozentsatz oder einen festen Betrag von der ersten Rechnung abziehen, mit Ablaufdatum und Nutzungslimit. Ein eigenes Recht.',
        'public_shop' => 'Öffentliche Shop-Seite',
        'public_shop_helper' => 'Die Seite, die jeder ohne Konto öffnen kann und die zeigt, was zum Verkauf steht. Sie veröffentlicht nichts, was ein angemeldeter Kunde nicht im Shop sähe, also ist an oder aus die ganze Entscheidung — aus antwortet 404, wie die Statusseite.',
    ],

    /*
     * Das Suchfeld über den Einstellungsformularen. Es filtert, was ohnehin
     * schon im Browser auf der Seite steht, und fragt den Server um nichts - es
     * gibt also keinen Zustand „sucht" zu beschreiben und keinen Weg, wie es
     * scheitern könnte.
     */
    /*
     * Der Vorschaukasten. Alles darin ist ein Platzhalter und keine Probe deines
     * Panels, und der Wortlaut sagt das - ein Kasten, der einen echten Server
     * oder eine echte Zahl nennt, würde als solcher gelesen.
     */
    'preview' => [
        'label' => 'Vorschau',
        'card' => 'Eine Karte',
        'card_helper' => 'Nach denselben Regeln gezeichnet wie das Panel, nur mit den Einstellungen auf dieser Seite statt mit den gespeicherten.',
        'button' => 'Eine Schaltfläche',
        'field' => 'Ein Feld',
        'meter_ok' => 'In Ordnung',
        'meter_warning' => 'Warnung',
        'meter_danger' => 'Kritisch',

        /*
         * Die Vorschau über die ganze Seite. Ein Tab und kein Bereich, denn
         * Pelican sendet X-Frame-Options: DENY und lässt sich von nichts in
         * einen Rahmen setzen, auch nicht von sich selbst - siehe
         * Support\FullPreview.
         */
        'full' => 'Das ganze Panel ansehen',
        'full_confirm' => 'Öffnet das Panel, gezeichnet aus den Einstellungen dieser Seite statt aus den gespeicherten. Es wird nichts geschrieben — die Werte werden fünfzehn Minuten gehalten, und das Panel ist wieder normal, sobald du die Vorschau verlässt oder speicherst.',
        'full_go' => 'Zeig es mir',
        'full_failed' => 'Die Vorschau ließ sich nicht starten',
        'bar' => 'Du siehst ungespeicherte Einstellungen. Nichts davon wurde geschrieben.',
        'bar_back' => 'Zurück zu den Einstellungen',
    ],

    'search' => [
        'placeholder' => 'Einstellungen durchsuchen',
        'label' => 'Diese Einstellungen durchsuchen',
        'none' => 'Auf dieser Seite passt nichts. Die Einstellungen liegen auf vier Seiten — sieh unter Aussehen, Seiten, Erweitert oder Essentials-Einstellungen nach.',
    ],

    'footer' => [
        'text' => 'Deine eigene Zeile',
        'text_helper' => 'Reiner Text, höchstens 120 Zeichen. Maskiert, wie der Ankündigungsbalken — das hier erscheint auf jeder Seite des Panels, und damit ist es der falsche Ort, um Markup anzunehmen.',
        'version' => 'Panel-Version anzeigen',
        'version_helper' => 'Pelicans Version, nicht die dieses Plugins. Das Plugin nennt seine eigene auf dem Dashboard; was man unten in einer Sidebar sucht, ist, welches Panel man vor sich hat.',
        'link_label' => 'Linktext',
        'link_url' => 'Linkadresse',
        'link_url_helper' => 'Eine http- oder https-Adresse, oder ein Pfad des Panels selbst wie /account. Öffnet in einem neuen Tab.',
    ],

    'layout' => [
        'label' => 'Layout',
        'helper' => 'Wie das Panel angeordnet ist, und nicht, welche Farbe es hat. Gilt für den Admin-Bereich, die Serverliste und den Client-Bereich gleichermaßen. Wohin die Navigation kommt, ist eine Vorgabe: wer unter Konto → Navigation eine eigene gesetzt hat, behält sie.',
        'default' => 'Sidebar — Pelicans eigene',
        'rail' => 'Symbolleiste — schmal, öffnet beim Überfahren',
        'top' => 'Navigation oben — keine Sidebar',
        'mixed' => 'Topbar und Sidebar — beides',
        'wide' => 'Breit — der Inhalt nutzt den ganzen Bildschirm',
        'focus' => 'Fokussiert — schmale Spalte, Sidebar klappt weg',

        'nav_label' => 'Stil der Sidebar',
        'nav_helper' => 'Wie die Sidebar selbst gezeichnet wird.',
        'nav_default' => 'Standard',
        'nav_floating' => 'Schwebend — eine Karte für sich',
        'nav_flat' => 'Flach — gar kein Hintergrund',
        'nav_bordered' => 'Umrandet — eine Linie, keine Fläche',

        'topbar_label' => 'Stil der Topbar',
        'topbar_helper' => '„Ausgeblendet" gilt nur für den Desktop — auf einem Telefon trägt die Topbar den einzigen Weg zurück ins Menü.',
        'topbar_default' => 'Standard',
        'topbar_floating' => 'Schwebend — eine gelöste Leiste',
        'topbar_flush' => 'Bündig — flach, ohne Weichzeichnen',
        'topbar_hidden' => 'Auf dem Desktop ausgeblendet',

        'card_label' => 'Stil der Karten',
        'card_helper' => 'Abschnitte, Widgets, Serverkarten und die Blöcke über der Konsole.',
        'card_default' => 'Standard — angehoben mit weicher Kante',
        'card_flat' => 'Flach — ohne Anheben',
        'card_outline' => 'Umriss — ein Rahmen und nichts dahinter',
        'card_glass' => 'Milchglas — der Hintergrund scheint durch',
        'card_sharp' => 'Kantig — eckige Ecken',
    ],

    'servers' => [
        /*
         * Der Stern auf einer Karte. Dem Skript übergeben statt hineingeschrieben,
         * damit die Texte an der einen Stelle bleiben, an der Texte wohnen.
         */
        'favourite' => 'Diesen Server markieren',
        'favourited' => 'Markiert — steht vorn',

        /*
         * Die Pille neben Pelicans eigenen Tabs. Danach benannt, was sie mit der
         * Liste tut, und nicht als vierter Tab, denn sie filtert den jeweils
         * gewählten Tab, statt ihn zu ersetzen.
         */
        'favourites_tab' => 'Favoriten',
        'favourites_empty' => 'Auf dieser Seite ist nichts markiert. Nimm den Stern auf einer Serverkarte, um einen hinzuzufügen — und beachte: das filtert die Server, die hier ohnehin schon stehen. Ein markierter Server auf einer späteren Seite wird also nicht versteckt, er ist schlicht nicht auf dieser.',
        'favourites_failed' => 'Deine markierten Server ließen sich nicht speichern und wurden deshalb auf das zurückgesetzt, was das Panel zuletzt hatte. Was die Anfrage geantwortet hat, steht in der Konsole des Browsers.',

        'art' => 'Spielbild',
        'art_helper' => 'Pelican zeichnet das Bild des Eggs auf jede Karte. Das hier entscheidet, was damit geschieht.',
        'art_faded' => 'Verblasst — ein Hauch hinter dem Text',
        'art_cover' => 'Deckend — hinter dem Namen, nach unten auslaufend',
        'art_off' => 'Aus',
        'art_dim' => 'Das Bild abdunkeln',
        'art_dim_helper' => 'Das Bild des einen Spiels ist ein heller Himmel und das des anderen eine Höhle.',

        'status' => 'Zustandsmarke',
        'status_helper' => 'Wo die Farbe für läuft/startet/gestoppt gezeigt wird.',
        'status_bar' => 'Balken — an der linken Kante',
        'status_edge' => 'Kante — quer über den oberen Rand',
        'status_dot' => 'Punkt — in der Ecke',
        'status_off' => 'Aus',

        'density' => 'Kartenhöhe',
        'density_comfortable' => 'Bequem',
        'density_compact' => 'Kompakt — für viele Server',

        'filter_label' => 'Die Filter-Schaltfläche beschriften',
        'filter_label_helper' => 'Pelican filtert diese Liste längst nach Egg und Besitzer, über alle Seiten hinweg - aber der Weg dorthin ist ein unbeschriftetes Symbol neben dem Suchfeld. Das hier schreibt das Wort darauf.',
        'filter_button' => 'Filter',

        'columns' => 'Karten nebeneinander auf breitem Bildschirm',
        'columns_helper' => 'Gilt nur für das Raster und erst ab 1280px. Pelicans eigenes Maximum sind zwei.',
    ],

    'controls' => [
        'mode' => 'Konsolenschaltfläche auf jeder Serverseite',
        'mode_helper' => 'Eine schwebende Schaltfläche auf jeder Seite innerhalb eines Servers. Sie öffnet die Konsole über dem, was du gerade tust, mit dem Zustand und den Ein/Aus-Schaltflächen in ihrem Kopf — sie erreicht die Node direkt, so wie es die Serverliste tut, und nicht über das Websocket der Konsolenseite. Auf der Konsolenseite selbst erscheint sie nie, dort ist das alles schon da.',
        'mode_full' => 'Konsole und Ein/Aus-Schaltflächen',
        'mode_console' => 'Nur die Konsole',
        'mode_off' => 'Aus',

        'label' => 'Die Schaltfläche zeigt',
        'label_text' => 'Symbol und Name',
        'label_icon' => 'Nur das Symbol',

        'position' => 'Wo sie schwebt',
        'position_helper' => 'An der Kante, an der du am wenigsten liest.',
        'position_top' => 'Oben',
        'position_right' => 'Rechts',
        'position_bottom' => 'Unten',
    ],

    'console' => [
        'stats' => 'Blöcke über der Konsole',
        'stats_helper' => 'Pelican zeigt über dem Terminal Namen, Zustand, Adresse und die drei Auslastungszahlen. Sie auszublenden gibt der Konsole die Höhe zurück.',
        'stats_tiles' => 'Kacheln — Bezeichnung, Zahl und ein Symbol',
        'stats_plain' => 'Schlicht — so, wie Pelican sie zeichnet',
        'stats_off' => 'Ausgeblendet',
    ],

    'terminal' => [
        'helper' => 'Wird an das Terminal selbst übergeben und greift deshalb beim nächsten Laden der Seite statt im Moment des Speicherns.',

        'renderer' => 'Gezeichnet von',
        'renderer_helper' => 'Pelican zeichnet das Terminal auf der GPU, und das ist bei einer Wand scrollender Ausgabe viel schneller. Ein Browser hält nur eine begrenzte Zahl von GPU-Kontexten gleichzeitig am Leben — auf einem Telefon weniger — und nimmt den ältesten weg, sobald die Grenze überschritten ist; das Terminal zeichnet dann überhaupt nichts mehr, ohne Fehlermeldung. Wird deine Konsole leer, während alles andere daran richtig aussieht, ist das die Einstellung, die man ändert.',
        'renderer_webgl' => 'Die GPU — Pelicans eigene, schneller',
        'renderer_dom' => 'Der Browser — langsamer, zeichnet immer',

        'scheme' => 'Farbschema',
        'scheme_helper' => 'Die eine Terminal-Einstellung, die Pelican nicht anbietet. „Dem Theme folgen" leitet die Farben aus der Akzentfarbe ab, und deshalb gibt es das hier überhaupt.',
        'scheme_theme' => 'Dem Theme folgen',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Cursor',
        'cursor_helper' => 'Die Konsole nimmt keine Eingaben an — das Befehlsfeld sitzt darunter — das hier ist also, wo die Ausgabe aufgehört hat, und nicht, wo du bist.',
        'cursor_underline' => 'Unterstrich — Pelicans eigener',
        'cursor_block' => 'Block',
        'cursor_bar' => 'Strich',

        'blink' => 'Blinkender Cursor',

        'scrollback' => 'Rückblick',
        'scrollback_helper' => 'Wie weit sich die Konsole zurückscrollen lässt. Jede Zeile bleibt im Browser, ein gesprächiger Server bei hoher Einstellung ist also echter Arbeitsspeicher auf der Maschine, die mitliest.',
        'scrollback_lines' => ':lines Zeilen',
    ],

    'notice' => [
        'text' => 'Meldung',
        'text_helper' => 'Eine Zeile, bis zu 200 Zeichen. Sie wird beim Hinein- und beim Hinausgehen maskiert und kann deshalb kein Markup auf eine Seite tragen, die andere Leute laden.',
        'style' => 'Ton',
        'style_info' => 'Info',
        'style_warning' => 'Warnung',
        'style_danger' => 'Dringend',
        'style_accent' => 'Akzentfarbe',
        'scope' => 'Gezeigt für',
        'scope_all' => 'Alle',
        'scope_client' => 'Nur außerhalb des Admin-Bereichs',
        'scope_admin' => 'Nur im Admin-Bereich',
        'link_label' => 'Text der Schaltfläche',
        'link_url' => 'Adresse der Schaltfläche',
        'link_url_helper' => 'https:// oder ein Pfad innerhalb dieses Panels, etwa /account. Alles andere wird ignoriert — ein Link in einem Balken auf jeder Seite ist kein Ort für ein Schema, mit dem niemand rechnet.',
        'dismissible' => 'Kann geschlossen werden',
        'dismissible_helper' => 'Dass er geschlossen wurde, merkt sich jeder Browser für sich, und nur für diese Meldung: ändere den Text, und er ist für alle wieder da.',
        'dismiss' => 'Schließen',
    ],

    'preset' => [
        'label' => 'Stil',
        'helper' => 'Wähle ein Aussehen als Ausgangspunkt. Es füllt alles darunter aus, was du danach ändern kannst. „Keiner" schaltet das Theme aus und lässt das Panel genau so, wie Pelican es ausliefert.',
        'options' => [
            'none' => 'Keiner - kein Theme',
            'legend' => 'Legend - rotes Feuer in blauen Blitz',
            'ember' => 'Ember - warmes Schwarz, orangener Akzent',
            'midnight' => 'Midnight - tiefes Blau, ruhig',
            'crimson' => 'Crimson - rot, kantig, kompakt',
            'forest' => 'Forest - grün, rund, ohne Schein',
            'nebula' => 'Nebula - violett mit Verlaufshintergrund',
            'terminal' => 'Terminal - grün auf schwarz, dicktengleich, kantig',
            'console' => 'Console - rund und großzügig, für ein Tablet',
            'nord' => 'Nord - die Nord-Palette, gedämpft',
            'solarized' => 'Solarized - Solarized dark, cyanfarbener Akzent',
            'paper' => 'Paper - hell, hoher Kontrast, flach',
            'daylight' => 'Daylight - hell und warm, mit sanftem Hauch',
            'mono' => 'Mono - Graustufen, flach und dicht',
        ],

        'save' => 'Als Stil speichern',
        'save_confirm' => 'Behält die Farben, Ecken, den Hintergrund, die Schrift, die Symbole und die Schwellen der Balken, die du gerade auf dem Bildschirm hast — unter einem eigenen Namen, in der Auswahl neben den mitgelieferten. Gespeichert wird, was auf der Seite steht, und nicht, was zuletzt gespeichert wurde.',
        'save_name' => 'Name',
        'save_name_helper' => 'Wie er in der Auswahl heißen wird. Unter einem schon benutzten Namen zu speichern ersetzt jenen.',
        'saved' => 'Stil gespeichert',
        'save_failed' => 'Dieser Stil ließ sich nicht speichern',
        'save_full' => 'Es ist Platz für :max eigene Stile. Lösche zuerst einen.',

        'delete' => 'Einen Stil löschen',
        'delete_which' => 'Welchen',
        'delete_confirm' => 'Nur eigene Stile lassen sich löschen, die mitgelieferten nicht. Am gegenwärtigen Aussehen des Panels ändert sich nichts — ein Stil ist ein Ausgangspunkt, und jeder Wert, den er gesetzt hat, steht bereits in den Einstellungen darunter.',
        'deleted' => 'Stil gelöscht',
        'deleted_current' => 'Das war der, auf den dieses Panel eingestellt war. Seine Einstellungen sind unverändert und stehen weiter auf dieser Seite — wähle einen Stil, oder speichere sie erneut unter einem Namen.',
    ],

    'user_themes' => [
        'label' => 'Stile, die Leute für sich selbst wählen dürfen',
        'helper' => 'Angehakte Stile erscheinen auf einer Darstellungs-Seite im Client-Panel, wo jeder Angemeldete einen für sich wählen kann. Es ändert, was er sieht, und für alle anderen nichts. Nichts angehakt heißt, niemand wählt etwas und das Panel behält ein Aussehen — und genau das tut es jetzt.',
    ],

    'mode' => [
        'label' => 'Panel-Modus',
        'helper' => 'In welchem Modus das Panel öffnet. Wer nicht selbst gewählt hat, bekommt diesen; über den Umschalter im Benutzermenü lässt er sich weiter ändern, sofern du ihn unten nicht festlegst.',
        'dark' => 'Dunkel',
        'light' => 'Hell',
        'system' => 'System — der eigenen Einstellung des Besuchers folgen',
    ],

    'font' => [
        'label' => 'Schrift des Panels',
        'helper' => 'Jede Option ist eine Familie, die das Betriebssystem ohnehin hat — es wird nichts von einem Font-Anbieter geholt. Das Terminal ist nicht betroffen: seine Schrift wählt jeder für sich, unter Konto.',
        'default' => 'Standard - Pelicans eigene',
        'mono' => 'Dicktengleich',
        'rounded' => 'Rund',
        'serif' => 'Serif',
        'system' => 'System - was diese Maschine gerade nutzt',
    ],

    'surface' => [
        'label' => 'Flächenfarbe',
        'helper' => 'Die Karten und Flächen. Hellere und dunklere Töne werden daraus abgeleitet.',
        'placeholder' => 'Dem Theme folgen',
    ],

    'radius' => [
        'label' => 'Ecken',
    ],

    'accent' => [
        'label' => 'Akzentfarbe',
        'helper' => 'Genutzt für Schaltflächen, Links, den aktiven Navigationseintrag und Fokusringe.',

        /*
         * Gesagt, nicht erzwungen. Eine Farbe, vor der das hier warnt, wird
         * trotzdem gespeichert: es ist jemandes Panel, die Zahl misst eine
         * Sache, und es gibt gute Gründe, einen Akzent zu wollen, der schlecht
         * abschneidet. Die Auswahl sagt, was sie sieht, und geht aus dem Weg.
         */
        'contrast_dark' => 'Lesbarkeit: :ratio gegen ein dunkles Panel. Unter 3 ist ein Akzent als Schaltfläche oder Link schwer zu lesen — ein hellerer hebt ihn heraus.',
        'contrast_light' => 'Lesbarkeit: :ratio gegen ein helles Panel. Unter 3 ist ein Akzent als Schaltfläche oder Link schwer zu lesen — ein dunklerer hebt ihn heraus.',
    ],
    'density' => [
        'label' => 'Dichte',
        'helper' => 'Kompakt zieht die Abstände zusammen, sodass mehr Zeilen auf den Bildschirm passen.',
        'comfortable' => 'Bequem',
        'compact' => 'Kompakt',
    ],
    'force_dark' => [
        'label' => 'Dunklen Modus erzwingen',
        'helper' => 'Blendet den Umschalter hell/dunkel aus und hält jeden Benutzer beim dunklen Theme.',
    ],
    'glass' => [
        'label' => 'Milchglas-Topbar',
        'helper' => 'Zeichnet die Topbar und die Hintergründe von Dialogen weich. Auf schwachen Geräten ausschalten.',
    ],
    'glow' => [
        'label' => 'Akzentschein',
        'helper' => 'Ein weicher Akzentschatten auf den wichtigsten Schaltflächen, der aktiven Navigation und der Anmeldekarte.',
    ],

    'background' => [
        'label' => 'Art des Hintergrunds',
        'helper' => 'Aurora ist der eigene Hintergrund des Themes: Akzentschein mit feiner Körnung.',
        'aurora' => 'Aurora (Standard)',
        'solid' => 'Eine Farbe',
        'gradient' => 'Verlauf',
        'image' => 'Bild',
        'color' => 'Farbe',
        'base' => 'Farbe hinter dem Schein',
        'base_helper' => 'Worauf die Seite liegt, bevor der Akzentschein darüber gemalt wird. Leer lassen behält die Vorgabe des Panels, die im Dunklen fast schwarz und im Hellen fast weiß ist. Setzt du sie, behält ein Schema seine eigene Nachtfarbe und wird trotzdem beleuchtet.',
        'color_end' => 'Zweite Farbe',
        'angle' => 'Richtung',
        'upload' => 'Ein Bild hochladen',
        'upload_helper' => 'Bis zu 8 MB. Ein hochgeladenes Bild hat Vorrang vor der URL darunter.',
        'url' => 'Oder eine URL',
        'url_helper' => 'Muss mit https:// beginnen und von außen erreichbar sein.',
        'dim' => 'Abdunkeln',
        'dim_helper' => 'Ohne Abdunkeln ist weißer Text auf einem hellen Foto nicht lesbar.',
        'blur' => 'Weichzeichnen',
    ],

    'channel' => [
        'installed' => 'installiert',
        'version' => 'Eine bestimmte Version installieren',
        'version_helper' => 'Jede Version dieses Kanals, nicht nur die neueste — um zurückzugehen, wenn sich etwas Neues als schlechter erweist, oder vor, zu einem Build, den man dir zum Ausprobieren genannt hat. Nur, solange sich Aktualisierungen nicht selbst installieren: ist das an, hielte deine Wahl nur bis zur nächsten Prüfung.',
        'version_placeholder' => 'Eine Version wählen',
        'version_install' => 'Diese Version installieren',
        'version_confirm' => 'Das Panel lädt diese Version, baut seine Assets neu und leert seine Caches. Deine Einstellungen bleiben erhalten. Auf eine ältere Version zurückzugehen ist erlaubt und wird dir nicht wieder rückgängig gemacht — wähle die neuere erneut, um vorwärtszugehen.',
        'label' => 'Update-Kanal',
        'helper' => 'Welche Versionen die Theme-Seite anbietet. Beta bekommt neue Versionen zuerst — und die rauen Kanten ebenfalls zuerst.',
        'stable' => 'Stabil',
        'beta' => 'Beta',
        'dev' => 'Dev (Arbeitsbranch)',
        'auto' => [
            'label' => 'Aktualisierungen automatisch installieren',
            'helper' => 'Aus überlässt das Aktualisieren dir. An prüft das Panel den gewählten Kanal und installiert alles Neuere - dabei baut es seine Assets neu und ist ein paar Minuten nicht erreichbar, deshalb laufen täglich und wöchentlich um 04:00 Uhr. Braucht den laufenden Cron des Panels.',
            'interval' => 'Prüfen alle',
            'minute' => 'Jede Minute',
            'five_minutes' => 'Alle 5 Minuten',
            'ten_minutes' => 'Alle 10 Minuten',
            'thirty_minutes' => 'Alle 30 Minuten',
            'hourly' => 'Jede Stunde',
            'daily' => 'Jeden Tag (04:00)',
            'weekly' => 'Jede Woche (Montag 04:00)',
        ],
    ],

    /*
     * Der Sprachen-Tab.
     *
     * Vorsichtig damit, was er behauptet. Pelican lässt jeden längst eine
     * Sprache für sein ganzes Konto wählen und wendet sie auch an; nichts hier
     * ändert das oder sollte es. Das hier entscheidet allein, ob die eigenen
     * Texte dieses Plugins dieser Wahl folgen.
     */
    'languages' => [
        'section_helper' => 'Pelican lässt jeden längst eine Sprache für sein Konto wählen, und dieses Plugin folgt ihr überall dort, wo es übersetzt wurde. Hier entscheidest du, welchen davon es folgt. Die meisten Sprachen stehen mit Absicht bei einem niedrigen Prozentsatz: zuerst übersetzt wird der Teil, den jeder auf jeder Seite sieht — die Ein/Aus-Schaltflächen über einer Konsole und die Node-Anzeigen — und der Rest kommt, wie Leute ihn beisteuern.',
        'panel' => 'Das hier über die Sprache des ganzen Panels entscheiden lassen',
        'panel_helper' => 'An stellt eine Sprache, die dieses Plugin nicht trägt — oder eine unten abgeschaltete — das ganze Panel für diesen Leser auf Englisch, nicht nur diese Seiten. Aus folgt allein dieses Plugin der Liste, und Pelican spricht weiter, worauf das Konto eingestellt ist, was heißt: ein Leser kann auf einem Bildschirm zwei Sprachen antreffen. Kein Konto wird so oder so geändert: schalte eine Sprache wieder ein, und er hat sie zurück.',
        'label' => 'Sprachen, in denen geantwortet wird',
        'helper' => 'Einen Haken zu entfernen schickt Leser, deren Konto darauf steht, für dieses Plugin zurück zu Englisch — der Rest des Panels spricht weiter ihre Sprache. Englisch steht nicht auf der Liste, weil alles darauf zurückfällt.',
        'under' => 'wird noch nicht angeboten — hake es an, um es trotzdem anzubieten',
        'done' => ':percent % übersetzt',
        'main' => 'Hauptsprache',
        'main_helper' => 'Was ein Leser bekommt, wenn seine eigene Sprache nicht genutzt werden kann — entweder trägt dieses Plugin sie nicht, oder sie ist unten abgehakt. Es war immer Englisch; in einem Team, das nicht auf Englisch arbeitet, war das eine falsche Antwort, selbstsicher gegeben. Sie lässt sich unten nicht abhaken, denn alles fällt darauf zurück.',
        'labels' => 'Wie jede Sprache heißt',
        'labels_helper' => 'Der Name, den Leser und Administratoren in den Auswahlen sehen. Lass eines leer, um den Namen zu behalten, unter dem dieses Plugin sie kennt. Eine Sprache, die unter einem eigenen Namen hochgeladen wurde, hat keinen — sie stünde also unter ihrem Code, bis du ihr hier einen gibst.',
        'labels_code' => 'Code',
        'labels_name' => 'Angezeigt als',
        'download' => 'Eine Übersetzungsdatei herunterladen',
        'download_from' => 'Ausgehen von',
        'download_from_helper' => 'Ein JSON mit jedem Text dieses Plugins. Nimm Englisch für eine Sprache, die noch niemand angefangen hat, oder eine vorhandene, um mit dem weiterzumachen, was schon übersetzt ist.',
        'code' => 'Sprachcode',
        'code_helper' => 'Der Code, für den die Datei gilt. Ein echtes Locale, so wie Konten es nutzen — fr, de, pt_BR — erreicht Leser, deren Konto darauf steht, und muss genau passen, sonst tut es das nicht. Ein eigener Name wie Gaming-NL ist erlaubt und funktioniert anders: Pelican lässt ein Konto nur ein echtes Locale halten, deinen kann also niemand auswählen. Erreichbar ist er als Hauptsprache oben — und das ist, was jeder bekommt, dessen eigene nicht genutzt werden kann.',
        'url' => 'Oder von einer Adresse holen',
        'url_helper' => 'Eine https-Adresse, die das Panel erreicht — ein CDN, ein Bucket, eine rohe Datei in einem Repository. Sie wird beim Speichern einmal geholt und genauso geschrieben wie ein Upload; die Datei an dieser Adresse später zu ändern tut also nichts, bis du erneut speicherst. Eine oben gewählte Datei gewinnt gegen eine Adresse, die in diesem Feld stehen bleibt.',
        'upload' => 'Eine Übersetzungsdatei hochladen',
        'upload_helper' => 'Das JSON von oben, mit übersetzten Werten. Es wird außerhalb des Plugins geschrieben, eine Aktualisierung wirft es also nicht weg, und es wird je Schlüssel über Englisch gelegt — eine Datei mit der Hälfte der Texte gibt dir eine halbe Sprache und für den Rest Englisch.',
        'uploaded' => ':count Texte für :code eingerichtet',
        'uploaded_halves' => 'Davon sind :mine eigene Texte dieses Plugins und :panel gehören dem Panel. Null auf einer Seite heißt, diese Hälfte der Datei enthielt nichts — die Schlüssel des Plugins beginnen mit essentials:: und die des Panels nicht.',
        'uploaded_skipped' => ':count wurden übersprungen: leer, oder Schlüssel, die dieses Plugin nicht hat. Die ersten paar: :keys',
        'upload_failed' => 'Diese Datei ließ sich nicht lesen',
        'upload_failed_body' => 'Es muss das JSON aus dem Download oben sein — ein flaches Objekt aus Schlüsseln und Texten. Prüfe, ob ein Editor es nicht als etwas anderes gespeichert hat.',
    ],

    'windows' => [
        'add' => 'Ein Fenster hinzufügen',
        'from' => 'Von',
        'to' => 'Bis',
        'to_helper' => 'Früher als der Beginn heißt, es geht über Mitternacht — 22:00 bis 06:00 ist die Nacht.',
        'preset' => 'Stil',
        'days' => 'Tage',
        'days_helper' => 'Lass alle ohne Haken für jeden Tag. Ein Fenster über Mitternacht gehört zu dem Tag, an dem es beginnt — Freitag 22:00 bis 06:00 deckt also den Samstagmorgen ab.',
        'day_mon' => 'Montag',
        'day_tue' => 'Dienstag',
        'day_wed' => 'Mittwoch',
        'day_thu' => 'Donnerstag',
        'day_fri' => 'Freitag',
        'day_sat' => 'Samstag',
        'day_sun' => 'Sonntag',
    ],

    'arranger' => [
        'label' => 'Seiten anordnen',
        'helper' => 'Die Schaltfläche „Seite anordnen", auf jeder Seite des Panels. Wer die Berechtigung „Anordnen" hat, bekommt sie und kann außerdem die Anordnung setzen, mit der alle anderen beginnen, oder eine für eine Rolle. Aus blendet sie für alle aus; bereits gespeicherte Anordnungen bleiben bestehen.',
        'roles' => 'Eine Anordnung ist keine Berechtigung. Ein Block, den eine Rolle ausblendet, ist weiterhin ein Block, den jemand durch Eintippen der Adresse erreichen könnte — was das verhindert, sind Pelicans eigene Berechtigungen auf der Rollen-Seite. Drei Schichten greifen in dieser Reihenfolge: die, mit der alle beginnen, dann die Rolle des Lesers, dann alles, was er selbst verschoben hat.',
        'users' => 'Jeden seine eigenen Seiten anordnen lassen',
        'users_helper' => 'An darf jeder Angemeldete auf den Seiten, die er ohnehin sieht, Blöcke umstellen und ausblenden, nur für sich selbst — für alle anderen ändert das nichts. Die Anordnung zu setzen, mit der alle beginnen, bleibt bei der Berechtigung „Anordnen".',
    ],

    'brand' => [
        'logo_height' => 'Höhe des Logos',
        'logo_height_helper' => 'Pelican liefert 2rem aus. Größere Werte machen den Kopf der Sidebar mit höher.',
        'logo_url' => 'Logo überschreiben',
        'logo_url_helper' => 'Leer lassen, um zu behalten, worauf Pelicans eigene Einstellungen zeigen.',
    ],

    'login' => [
        'image' => 'Hintergrundbild',
        'image_helper' => 'Nur für den Anmeldebildschirm. Ohne eines zeigt er weiter den Panel-Hintergrund.',
        'url' => 'Oder eine URL',
        'blur' => 'Karte weichzeichnen',
        'blur_helper' => 'Macht die Karte milchig, sodass das Bild dahinter durchscheint.',
        'width' => 'Breite der Karte',
        'position' => 'Bildausschnitt',
        'position_helper' => 'Welcher Teil des Bildes den Zuschnitt auf den Bildschirm überlebt.',
        'position_center' => 'Mitte',
        'position_top' => 'Oben',
        'position_bottom' => 'Unten',
        'position_left' => 'Links',
        'position_right' => 'Rechts',
        'align' => 'Position der Karte',
        'align_helper' => 'Wo die Anmeldekarte quer über dem Bildschirm sitzt.',
        'align_center' => 'Mitte',
        'align_start' => 'Links',
        'align_end' => 'Rechts',
        'opacity' => 'Deckkraft der Karte',
        'opacity_helper' => 'Niedriger lässt mehr vom Bild durch die Karte.',
        'glow' => 'Akzentschein',
        'glow_helper' => 'Der Hof um die Karte. Aus behält ihre Kante und ihre Tiefe.',
        'hide_heading' => 'Überschrift ausblenden',
        'hide_heading_helper' => 'Entfernt den Titel über dem Formular und lässt das Formular für sich stehen.',
        'hide_footer' => 'Fußzeile ausblenden',
        'hide_footer_helper' => 'Entfernt die Zeile unter der Karte, die auf pelican.dev verweist.',
        'above' => 'Zeile über dem Formular',
        'above_helper' => 'Eine Zeile, gezeigt jedem, der den Anmeldebildschirm erreicht. Leer lassen für keine.',
        'notice' => 'Hinweis unter der Karte',
        'notice_helper' => 'Eine Zeile, gezeigt jedem, der den Anmeldebildschirm erreicht. Leer lassen für keinen.',
    ],

    'advanced' => [
        'css' => 'Eigenes CSS',
        'css_helper' => 'Bis zu 100 KB. Wird nach storage gespeichert, nicht in die .env.',
        'reference' => 'CSS-Referenz',
        'reference_helper' => 'Jede Variable und jede Klasse, die dieses Theme und das Panel bereitstellen.',
    ],

    'areas' => [
        'add' => 'Einen Bereich hinzufügen',
        'area' => 'Bereich',
        'inherit' => 'Allgemein',
        'radius' => 'Ecken',
        'radius_sharp' => 'Kantig',
        'radius_normal' => 'Normal',
        'radius_round' => 'Rund',
        'surface' => 'Flächenfarbe',
        'surface_helper' => 'Die Karten und Flächen in diesem Bereich; hellere und dunklere Töne werden daraus abgeleitet.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Konsole (der Rest der Seite)',
            'files' => 'Dateien-Seite',
            'edit' => 'Bearbeiten-Seite',
            'server' => 'Andere Serverseiten und Tabs',
        ],
    ],

    'bars' => [
        'base' => 'Grundfarbe',
        'base_green' => 'Grün',
        'base_accent' => 'Akzentfarbe',
        'warning' => 'Gelb ab',
        'danger' => 'Rot ab',
    ],

    'icons' => [
        'stroke' => 'Strichstärke',
        'stroke_thin' => 'Dünn',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Fett',
        'scale' => 'Größe',
        'accent' => 'Menüsymbole in der Akzentfarbe',
        'accent_helper' => 'Gilt für die Symbole in der Sidebar und in der Topbar.',
        'pack' => 'Symbolpaket',
        'pack_helper' => 'Aus welchem Satz die Auswahl darunter schöpft. Angeboten wird jeder Symbolsatz, der auf dem Server installiert ist, dazu der Essentials-Satz, der mit diesem Plugin kommt, und jedes Paket, das du hochlädst. Ein Unterschied lohnt sich zu wissen: ein Strichsymbol wird in der Menüfarbe gezeichnet und folgt dem Überfahren und der aktiven Zeile, während die Essentials-Symbole Bilder sind und stattdessen ihre eigenen Farben behalten. Das entscheidet, was die Datei ist, und nicht, aus welchem Satz sie kam.',
        'pack_custom' => 'Hochgeladenes Paket',
        'pack_shipped' => 'Essentials-Symbole',
        'use_shipped' => 'Überall die Essentials-Symbole nutzen',
        'use_shipped_confirm' => 'Setzt das Paket auf die Essentials-Symbole und füllt jede Menüzeile darunter mit dem Symbol, das dafür gezeichnet wurde — Konsole bekommt das Terminal, Start bekommt die Startschaltfläche und so weiter. Es ersetzt die Zeilen, die du jetzt hast, und es wird nichts gespeichert, bis du auf Speichern drückst — die Seite zu schließen macht es also rückgängig.',
        'pack_upload' => 'Ein Paket hochladen',
        'pack_upload_helper' => 'Ein .zip aus SVG-Dateien. Jede Datei wird zu einem Symbol, das nach ihr heißt — aus logo.svg wird custom-logo. Ein Upload ersetzt das Paket, das gerade da ist. Dateien über 256 KB und alles jenseits von 4.000 Symbolen bleiben draußen, und dir wird gesagt, wie viele: zum Maßstab — der ganze Tabler-Satz sind knapp sechstausend Symbole in etwa drei Megabyte, ein deutlich größeres Paket trägt also etwas anderes als Symbole, und das meiste davon wird übersprungen. Ein großer Upload kann auch abgelehnt werden, bevor dieses Feld überhaupt etwas sagt, nämlich von upload_max_filesize und post_max_size in der php.ini des Panel-Hosts — keine Einstellung hier kann die anheben.',
        'pack_partial' => ':count Symbole eingerichtet, aber nicht alle',
        'pack_partial_body' => 'Übersprungen: :big zu groß für ein Symbol, :unusable nicht als SVG brauchbar, :duplicate mit einem Namen, den schon eines hat, :empty ohne etwas zu zeichnen, nachdem aufgeräumt wurde. Ein SVG über 256 KB ist fast immer ein Bild, das in eines gewickelt wurde, und keine Zeichnung — exportiere es in Symbolgröße, dann sind es ein paar Kilobyte. Ein Symbol ohne etwas zu zeichnen enthielt nur etwas, das hier nicht ausgeliefert wird — ist das ein ganzes Paket, lohnt es sich zu melden.',
        'pack_stopped_files' => 'Es ist außerdem an der Grenze gestoppt, wie viele Symbole ein Paket enthalten darf.',
        'pack_stopped_size' => 'Es ist außerdem gestoppt, weil der Rest des Pakets entpackt größer ist, als das Panel auf einmal im Speicher hält — das Zip selbst kann kleiner sein, denn SVG komprimiert etwa fünf zu eins.',
        'overrides' => 'Symbole ersetzen',
        'overrides_helper' => 'Eine Zeile je Symbol, das du ändern willst. Wähle den Menüeintrag, dann ein Symbol aus dem Paket oben, gib eine Adresse an, oder lade ein eigenes Bild hoch. Ist mehr als eines ausgefüllt, gewinnt der Upload, dann die Adresse, dann das Paket.',
        'overrides_key' => 'Menüeintrag',
        'overrides_value' => 'Symbol aus dem Paket',
        'overrides_url' => 'Oder eine Adresse',
        'overrides_url_helper' => 'Eine https-Adresse für ein Bild, das du selbst hostest — ein CDN, ein Bucket, irgendwo, wo der Browser hinkommt. Es wird nichts auf das Panel kopiert, die Datei an dieser Adresse zu ersetzen ändert also das Symbol, ohne diese Seite anzufassen; die Kehrseite ist ein Symbol, das verschwindet, sobald die Adresse es tut. Es behält seine eigenen Farben, wie ein hochgeladenes Bild.',
        'overrides_file' => 'Oder ein Bild hochladen',
        /*
         * Sagt, worin der Unterschied tatsächlich besteht, denn er ist nicht
         * offensichtlich und ist der Grund, warum man das eine dem anderen
         * vorzieht.
         */
        'overrides_file_helper' => 'PNG, SVG oder ICO. Ein Symbol aus dem Paket wird in der Farbe des Menüs gezeichnet und folgt dem Überfahren und der aktiven Zeile; ein hochgeladenes Bild behält seine eigenen Farben und tut das nicht. Für ein Logo ist meist genau das gewollt.',
        'overrides_add' => 'Noch ein Symbol ersetzen',
        'overrides_search' => 'Tippe einen Namen, oder den Menüeintrag…',
    ],

    /*
     * Nicht unter „Marke". Marke ist, wie das Panel aussieht; das hier ist, wie
     * dieses Plugin darin erscheint, und das ist eine andere Frage und wird auf
     * einer anderen Seite beantwortet.
     */
    'identity' => [
        'nav_icon' => 'Symbol für die Zeile „Essentials-Einstellungen"',
        'nav_icon_helper' => 'PNG, SVG oder ICO, bis zu 8 MB. Ersetzt das Symbol auf dieser einen Zeile in der Sidebar; leer lassen für das, welches dieses Plugin mitbringt. Es wird als Bild statt als Symbol gezeichnet und behält deshalb seine eigenen Farben, statt dem Text zu folgen — und das will ein Logo meistens. Die Datei wird ausgeliefert statt eingebettet, jeder Browser holt sie also einmal; trotzdem lohnt es sich, etwas Kleines zu exportieren: ein paar Kilobyte sind für eine zwanzig Pixel hohe Zeile reichlich. Scheitert ein Upload, bevor dieses Feld überhaupt etwas sagt, ist die Grenze, an die er stieß, upload_max_filesize in der php.ini des Panels.',
    ],
];
