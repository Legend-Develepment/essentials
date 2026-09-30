<?php

/*
 * Der Watchdog. Von Hand geschrieben.
 *
 * Jede Meldung hier wird auf einem Telefon gelesen, um drei Uhr nachts, von
 * jemandem, der vor einer Minute noch geschlafen hat. Jede sagt also, welche
 * Maschine, was nicht stimmt, und sonst nichts - das Übrige gehört auf die
 * Seite, die derjenige als Nächstes öffnet, und nicht in die Zeile, die ihn
 * geweckt hat.
 *
 * Eine Entwarnung ist als Nachricht geschrieben und nicht als Nachtrag. „Ist es
 * schon wieder da" ist die Frage, für die sonst jemand aufstehen würde.
 *
 * "Node", "Wings", "Daemon", "Webhook", "Queue", "Discord" und "SMTP" bleiben
 * stehen: unter diesen Namen findet man sie in Pelican, auf dem Host und in
 * jeder Anleitung dazu wieder.
 */

return [
    'title' => 'Warnungen',
    'nav_label' => 'Warnungen',
    'subheading' => 'Das Panel weiß längst, wann eine Node nicht mehr antwortet, eine Festplatte volläuft oder die Queue stehen bleibt. Das hier ist, was es dir sagt.',

    // ---- die Kanäle, und was sie zuletzt getan haben ----------------------
    'channels' => 'Wohin Meldungen gehen',
    'channels_helper' => 'Was jeder Kanal getan hat, als er zuletzt etwas senden sollte. Ein Kanal, der eingeschaltet ist und stillschweigend ablehnt, sieht genauso aus wie ein Panel, dem nichts fehlt - deshalb steht das hier ganz oben.',

    'state_off' => 'Aus',
    'state_untried' => 'Noch nichts gesendet',
    'state_ok' => 'Zugestellt',
    'state_failed' => 'Abgelehnt',

    // ---- wann -------------------------------------------------------------
    'when' => 'Wie oft',
    'when_helper' => 'Die Prüfungen laufen im Hintergrund und brauchen deshalb einen Queue-Worker. Ohne ihn wird nichts gesendet, und nichts sagt es dir - nimm „Test senden", das läuft nicht über die Queue.',

    'every' => 'Prüfen alle',
    'every_helper' => 'Jede Prüfung erreicht die Daemon jeder Node, das ist also eine Anfrage pro Node und Durchlauf. Fünfzehn Minuten reichen, um von einer Störung zu hören, solange sie noch eine ist.',
    'every_off' => 'Aus - überhaupt keine Prüfungen',
    'every_five' => '5 Minuten',
    'every_fifteen' => '15 Minuten',
    'every_thirty' => '30 Minuten',
    'every_hourly' => 'Stunde',
    'every_daily' => 'Tag',

    'repeat' => 'Erinnere mich, solange es anhält',
    'repeat_helper' => 'Eine Meldung geht raus, wenn sich etwas ändert, und noch eine, wenn es sich erholt. Das hier ergänzt eine Erinnerung, solange ein Problem noch andauert. Null heißt keine Erinnerungen - einen Kanal, der sich alle fünfzehn Minuten wiederholt, stellt man stumm.',
    'hours' => 'Stunden',

    // ---- wohin ------------------------------------------------------------
    'where' => 'Kanäle',
    'where_helper' => 'Mehr als einer ist vernünftig. Sie fallen unterschiedlich aus.',

    'discord' => 'Discord',
    'discord_helper' => 'Dort wird eine Meldung tatsächlich von jemandem gelesen, der gerade nicht ins Panel schaut.',
    'webhook' => 'Webhook-Adresse',
    'webhook_helper' => 'In Discord: Servereinstellungen → Integrationen → Webhooks → Neuer Webhook → Webhook-URL kopieren. Nur https, denn hier wird gepostet, welche deiner Maschinen unten ist und wie voll ihre Festplatte.',
    'bot' => 'Ein eigener Bot',
    'bot_helper' => 'Eine signierte JSON-Meldung an eine Adresse, die du selbst betreibst, damit etwas außerhalb des Panels von einer toten Node erfährt, statt jede Minute zu fragen, ob es eine gibt. Die Webhooks, die Pelican mitbringt, können das nicht tragen: sie lösen an Modellen und am Aktivitätsprotokoll aus, und eine Node, die aufgehört hat zu antworten, schreibt in keines von beiden.',
    'bot_url' => 'Wohin damit',
    'bot_url_helper' => 'Nur https, denn hier wird an eine Adresse im Internet geschickt, welche deiner Maschinen unten ist.',
    'bot_secret' => 'Signaturgeheimnis',
    'bot_secret_helper' => 'Geteilt mit dem, was das empfängt. Der Rumpf wird damit gehasht, und der Hash reist in X-Essentials-Signature als sha256=<hex> mit, dein Bot kann also alles abweisen, was nicht von diesem Panel kam. Solange das leer ist, wird nichts geschickt - eine Signatur, die freiwillig ist, ist eine, die niemand prüft.',
    'facts' => 'Dem Bot auch sagen, wenn etwas passiert',
    'facts_helper' => 'Alles darüber ist eine Störung. Das hier nicht: das sind Dinge, die einfach passiert sind. Jedes ist aus, bis du es ankreuzt, ein Update ändert also nichts, und sie gehen nur an die Bot-Adresse - nie an Discord, die Glocke oder E-Mail.',

    'panel' => 'Im Panel',
    'panel_helper' => 'Eine Benachrichtigung für jeden, der diese Berechtigung hat. Funktioniert immer, braucht keine Einrichtung, und ist für jeden unsichtbar, der nicht angemeldet ist.',

    'email' => 'E-Mail',
    'email_helper' => 'Mit Komma getrennt. Nutzt den Mailer des Panels - zuverlässig, wenn der eingerichtet ist, und vollkommen still, wenn nicht, und genau das ist der eine Ausfall, den ein Watchdog nicht haben darf. Leer lassen schaltet es aus.',

    // ---- was --------------------------------------------------------------
    'what' => 'Worauf geachtet wird',
    'what_helper' => 'Jeder Wert hier ist einer, den das Panel ohnehin schon abfragt. Nichts auf dieser Seite öffnet eine Verbindung, die die Seite Systemstatus nicht auch öffnet.',

    'percent_helper' => 'Null schaltet diese Prüfung aus.',
    'disk' => 'Warnen, wenn die Festplatte einer Node über',
    'memory' => 'Warnen, wenn der Arbeitsspeicher einer Node über',

    'maintenance' => 'Warnen bei Wartung, die länger anliegt als',
    'maintenance_helper' => 'Eine Node in Wartung wird von jeder anderen Prüfung übersprungen, und das ist richtig - es ist zugleich der Weg, auf dem eine vierzehn Tage lang vergessen wird. Null schaltet das aus.',

    'versions' => 'Panel- und Wings-Versionen',
    'versions_helper' => 'Eine Meldung, wenn etwas zurückfällt, und eine, wenn es wieder aktuell ist. Keine Erinnerungen - eine Version ist keine Störung.',

    'backups' => 'Backups, die zurückfallen',
    'backups_helper' => 'Eine Meldung, die die Server nennt, statt einer je Server - bleibt ein Zeitplan stehen, veralten alle Server auf einmal, und vierzig getrennte Meldungen über eine Ursache sind ein Kanal, den man stumm stellt. Standardmäßig aus: einem Panel, das von Hand statt nach Plan sichert, würde das täglich vorgehalten.',
    'backup_days' => 'Ein Backup gilt als veraltet nach',
    'backup_days_helper' => 'Dasselbe nutzt auch die Backup-Seite. Ein Server, der wöchentlich gesichert wird, sollte nicht nach acht Tagen gemeldet werden.',
    'days' => 'Tagen',

    'stock' => 'Pakete, die ausgehen',

    'unbuilt_switch_helper' => 'Eine Bestellung mit bezahlter Rechnung, deren Server ein Knoten abgelehnt hat. Die einzige Prüfung hier, bei der jemandem Geld fehlt und nichts es sagt: alles andere auf dieser Liste ist eine Maschine, die stehen geblieben ist. Aus, bis Sie sie einschalten, wie der Rest.',

    'unbuilt_switch' => 'Bezahlt und nicht erstellt',
    'stock_helper' => 'Eine Meldung, die die Pakete nennt, statt einer je Paket, und nie eine Erinnerung: ausverkauft zu sein ist ein gewöhnlicher Zustand eines Shops und keine Störung, und alle vier Stunden davon zu hören ist der Weg, auf dem das hier nicht mehr gelesen wird. Angesehen werden nur Pakete mit einem begrenzten Bestand, ein Shop, der alles unbegrenzt verkauft, kostet hier also nichts. Standardmäßig aus, wie der Rest.',
    'modules_switch' => 'Ein Modul, das an ist und nicht funktioniert',
    'modules_switch_helper' => 'Eine Meldung je Modul statt einer für alle zusammen, weil bei jedem etwas anderes im Argen liegt und der Satz sagen muss, was. Gemeldet wird zweierlei: ein Modul, dessen Tabellen fehlen, also eine Installation, die nicht zu Ende kam, und ein Modul mit eingeschalteten Teilen, die darauf warten, dass etwas ausgefüllt wird. Die Modulseite zeigt beides auf der Karte; das hier ist für die Panels, auf die niemand schaut. Standardmäßig aus, wie der Rest.',
    'module_tables_title' => ':module ist an und seine Tabellen fehlen',
    'module_tables' => 'Die Seiten, die zu :module gehören, verstecken sich, weil die Tabellen, aus denen sie lesen, nicht da sind - meist eine Installation, die nicht zu Ende kam. Öffne die Modulseite, schalte es aus und wieder an, dann werden die Tabellen angelegt.',
    'module_waiting_title' => ':module ist an und ein Teil davon wartet',
    'module_waiting' => '{1} Ein Teil von :module ist eingeschaltet und zeigt nichts, bis etwas ausgefüllt ist - die Eggs, für die er gilt, die angebotenen Stile, die Server, die eine öffentliche Seite zeigen soll. Die Modulseite nennt auf der Karte, welcher.|[2,*] :count Teile von :module sind eingeschaltet und zeigen nichts, bis etwas ausgefüllt ist - die Eggs, für die sie gelten, die angebotenen Stile, die Server, die eine öffentliche Seite zeigen soll. Die Modulseite nennt auf der Karte, welche.',
    'module_cleared' => ':module funktioniert wieder',
    'ports_switch' => 'Ports, die ausgehen',
    'ports_switch_helper' => 'Eine Meldung je Paket statt einer für alle zusammen, weil der Bereich und die Zahl das Brauchbare sind und eine Liste von Namen nicht. Angesehen werden nur Pakete mit gesetztem Bereich, ein Shop, in dem Käufe jeden freien Port nehmen dürfen, kostet hier also nichts. Standardmäßig aus, wie der Rest.',
    'stock_left' => 'Warnen, wenn nur noch so viele da sind',
    'stock_left_helper' => 'Gemessen am Bestand des Pakets. Ein Paket muss auf diese Zahl fallen, um gemeldet zu werden, und wieder zwei darüber steigen, um erneut als gesund zu gelten; eines, das ein Kauf und eine Stornierung hin und her schieben, sagt also nichts. Null ist hier eine Zahl und kein Fehlen: sie hält die Warnung still und lässt nur die Meldung übrig, die sagt, dass ein Paket weg ist.',
    'stock_left_suffix' => 'übrig',

    'worker' => 'Queue-Worker',
    'worker_helper' => 'Ob überhaupt etwas die Hintergrundarbeit dieses Plugins ausführt. Beachte den Zirkelschluss: die Prüfung selbst läuft auf der Queue, ein Panel, das nie einen Worker hatte, kann das also nicht melden. Die Zeile oben auf dieser Seite kann es.',

    // ---- die Schaltflächen ------------------------------------------------
    'save' => 'Speichern',
    'saved' => 'Gespeichert',
    'save_failed' => 'Es wurde nichts gespeichert',

    'test' => 'Test senden',
    'test_one' => 'Testen',
    'test_off' => 'Dieser Kanal ist aus',
    'test_off_body' => 'Schalte ihn ein und speichere, dann wird er mit den übrigen getestet.',
    'test_title' => 'Testmeldung',
    'test_body' => 'Wenn du das liest, kommen Warnungen deines Pelican-Panels hier an. Es ist nichts passiert.',
    'test_sent' => 'An jeden eingeschalteten Kanal gesendet',
    'test_failed' => 'Mindestens ein Kanal hat es abgelehnt',
    'test_none' => 'Es gibt nichts, wohin gesendet werden könnte',
    'test_none_body' => 'Kein Kanal ist eingeschaltet, eine echte Warnung ginge also ebenfalls nirgendwohin.',

    /*
     * Was gegen eine Ablehnung zu tun ist.
     *
     * Der Grund eines Anbieters ist knapp und richtig und für sich allein
     * nutzlos. Die zwei, die fast jedes Mal kommen, sind benannt, denn keiner
     * von beiden lässt sich aus dem Code erraten: eine 553 betrifft den
     * Absender und nicht den Empfänger, und eine 401 von Discord ist eine URL,
     * die zurückgezogen oder vertippt wurde.
     */
    'hint_email_sender' => 'Dein SMTP-Server hat die Adresse abgelehnt, von der aus das Panel sendet, nicht die, an die es senden wollte. Unter Admin → Einstellungen → Mail muss die Absenderadresse ein Postfach sein, als das dein SMTP-Konto senden darf. Das hat mit diesem Plugin nichts zu tun - Pelicans eigene Testmail auf derselben Seite scheitert genauso.',
    'hint_email' => 'Sieh unter Admin → Einstellungen → Mail nach. Die Schaltfläche für die Testmail dort nutzt dieselben Einstellungen und sagt dasselbe.',
    'hint_discord_url' => 'Discord hat diesen Webhook nicht erkannt. Er wurde gelöscht, neu erzeugt oder unvollständig eingefügt - lege unter Servereinstellungen → Integrationen → Webhooks einen neuen an und kopiere die ganze URL.',
    'hint_discord' => 'Das Panel hat Discord nicht erreicht. Steht dieses Panel hinter einer Firewall, die ausgehende Anfragen blockiert, kann dieser Kanal von hier aus nicht funktionieren.',
    'hint_panel' => 'Niemand hat die Berechtigung dafür, oder die Benachrichtigung ließ sich nicht ablegen. Sieh unter Rollen nach.',

    'run_now' => 'Prüfungen jetzt ausführen',
    'run_started' => 'Wird im Hintergrund geprüft',
    'run_failed' => 'Die Prüfungen ließen sich nicht starten',

    'reset' => 'Vergessen, was es weiß',
    'reset_confirm' => 'Löscht, was jede Prüfung zuletzt gesagt hat. Der nächste Durchlauf lernt von vorn und sendet nichts, ein noch andauerndes Problem wird also erst beim übernächsten wieder gemeldet. Nimm das, nachdem du eine Node abgeschaltet hast, auf der der Watchdog weiter herumreitet.',
    'reset_done' => 'Gelöscht',

    // ---- die Meldungen selbst ---------------------------------------------
    'still' => 'Hält seit :for an.',
    'cleared_body' => 'Es war :for lang so.',
    'ports_title' => 'Fast keine Ports mehr für :game',
    'ports_body' => 'Käufe von :game landen auf :from bis :to, und nur noch :free von :total sind frei. Ein Kauf, der keinen findet, wird bezahlt und dann abgelehnt - lege also Allocations auf der Node an, oder mach den Bereich am Paket weiter, bevor das passiert.',
    'ports_none_title' => 'Keine Ports mehr für :game',
    'ports_none' => 'Käufe von :game landen auf :from bis :to, und alle :total sind belegt. Der nächste Kauf dieses Spiels wird bezahlt und dann ohne Allocation abgelehnt. Lege Allocations auf der Node an, oder mach den Bereich am Paket selbst weiter.',
    'ports_empty_title' => 'Es gibt keine Ports für :game',
    'ports_empty' => 'Käufe von :game landen auf :from bis :to, und auf keiner Node, die das Paket verwenden darf, existiert auch nur eine einzige Allocation in diesem Bereich. Jeder Kauf dieses Spiels wird bezahlt und dann abgelehnt. Lege die Allocations auf der Node an, oder mach den Bereich am Paket selbst weiter.',
    'ports_cleared' => 'Wieder Ports frei für :game',

    'for_unknown' => 'einer Weile',
    'for_minutes' => '{1} eine Minute|[2,*] :count Minuten',
    'for_hours' => '{1} eine Stunde|[2,*] :count Stunden',
    'for_days' => '{1} einen Tag|[2,*] :count Tage',

    'node_down' => ':node antwortet nicht',
    'node_down_body' => 'Das Panel erreicht die Daemon auf :node nicht. Server darauf starten, stoppen und melden nichts, bis sie wieder da ist.',
    'node_up' => ':node antwortet wieder',

    'node_disk' => 'Auf :node geht der Speicherplatz aus',
    'node_disk_body' => 'Die Festplatte auf :node ist zu :percent % voll, über den :limit %, die du gesetzt hast. Backups und Server-Installationen sind das Erste, was ausfällt, wenn das oben ankommt.',
    'node_disk_over' => 'Die Festplatte auf :node ist wieder unter der Grenze',

    'node_memory' => 'Auf :node geht der Arbeitsspeicher aus',
    'node_memory_body' => 'Der Arbeitsspeicher auf :node ist zu :percent % belegt, über den :limit %, die du gesetzt hast. Server darauf können vom Kernel abgeschossen werden, bevor irgendetwas ein Problem meldet.',
    'node_memory_over' => 'Der Arbeitsspeicher auf :node ist wieder unter der Grenze',

    'node_maintenance' => ':node ist seit Langem in Wartung',
    'node_maintenance_body' => ':node ist seit mehr als :hours Stunden in Wartung. Währenddessen wird nichts anderes daran geprüft, und das ist der Sinn - es ist aber gut zu wissen, dass es noch so steht.',
    'node_maintenance_over' => ':node ist aus der Wartung',

    'wings_behind' => 'Wings auf :node ist veraltet',
    'wings_behind_body' => ':node fährt Wings :installed, und :latest ist draußen. Aktualisiere es auf der Node selbst - das Panel hat keinen Weg dorthin.',
    'wings_current' => 'Wings auf :node ist aktuell',

    'panel_behind' => 'Das Panel ist veraltet',
    'panel_behind_body' => 'Dieses Panel fährt :installed, und :latest ist draußen.',
    'panel_current' => 'Das Panel ist aktuell',

    'and_more' => 'und :count weitere',


    'owner_down' => '{1} Einer deiner Server ist offline|[2,*] :count deiner Server sind offline',
    'owner_down_body' => 'Die Maschine, auf der sie liegen, antwortet nicht mehr. Es ist jemandem Bescheid gesagt worden. Betroffen: :servers',
    'owner_up' => '{1} Dein Server ist zurück|[2,*] :count deiner Server sind zurück',
    'owner_up_body' => 'Die Maschine antwortet wieder. Zurück: :servers',

    'schedules' => 'Zeitpläne, die stehen geblieben sind',
    'schedules_helper' => 'Ein Zeitplan, der mitten im Durchlauf hängen blieb, einer, dessen Zeit verstrichen ist, weil der Cron nicht läuft, oder einer, der noch nie gelaufen ist. Pelican hat für keinen davon ein Wort - ein abgestürzter Durchlauf bleibt für immer „in Bearbeitung" und wird genauso gezeichnet wie einer, der gerade läuft. Liest bei jeder Prüfung jeden aktiven Zeitplan des Panels.',

    'schedule_stopped' => '{1} Eine geplante Aufgabe steht still|[2,*] :count geplante Aufgaben stehen still',
    'schedule_stopped_body' => 'Seit über :hours Stunden hängend, überfällig, nie gelaufen oder ganz ohne Aufgaben: :schedules',
    'schedule_running' => 'Jeder Zeitplan läuft wieder',

    'unbuilt_over' => 'Jede bezahlte Bestellung hat ihren Server',

    'unbuilt_body' => 'Jemand hat bezahlt und hat nichts. Öffnen Sie Bestellungen und erstellen Sie sie, oder lesen Sie, warum sie abgelehnt wurden: :orders',

    'unbuilt' => '{1} Eine bezahlte Bestellung ohne Server|[2,*] :count bezahlte Bestellungen ohne Server',

    'stock_out' => '{1} Ein Paket ist ausverkauft|[2,*] :count Pakete sind ausverkauft',
    'stock_out_body' => 'Weiter im Verkauf, und es gibt nichts mehr zu verkaufen: :packages',
    'stock_low' => '{1} Ein Paket ist fast ausverkauft|[2,*] :count Pakete sind fast ausverkauft',
    'stock_low_body' => 'Nur noch :limit oder weniger übrig: :packages',
    'stock_back' => '{1} Ein Paket ist wieder zu haben|[2,*] :count Pakete sind wieder zu haben',
    'stock_back_body' => 'Es gibt wieder etwas zu verkaufen: :packages',

    'backup_none' => '{1} Ein Server wurde nie gesichert|[2,*] :count Server wurden nie gesichert',
    'backup_none_body' => 'Noch nie gesichert wurde: :servers',
    'backup_none_over' => 'Jeder Server hat jetzt ein Backup',

    'backup_stale' => '{1} Ein Server wurde länger nicht gesichert|[2,*] :count Server wurden länger nicht gesichert',
    'backup_stale_body' => 'Seit :days Tagen kein erfolgreiches Backup auf: :servers',
    'backup_stale_over' => 'Jeder Server wurde vor Kurzem gesichert',

    'backup_failed' => '{1} Auf einem Server schlagen die Sicherungen fehl|[2,*] Auf :count Servern schlagen die Sicherungen fehl',
    'backup_failed_body' => 'Ein Backup endete erfolglos auf: :servers',
    'backup_failed_over' => 'Es schlagen keine Backups mehr fehl',

    'worker_missing' => 'Es arbeitet nichts die Queue ab',
    'worker_missing_body' => 'Ein Auftrag wurde eingereiht, und nichts hat ihn aufgenommen. Plugin-Aktualisierungen, Modpack-Installationen und diese Prüfungen stehen alle still, bis ein Worker läuft - versuch systemctl status pelican-queue auf der Maschine des Panels.',
    'worker_back' => 'Die Queue wird wieder abgearbeitet',
    'failed_title' => '{1} Seit der letzten Prüfung ist ein Auftrag fehlgeschlagen|[2,*] Seit der letzten Prüfung sind :count Aufträge fehlgeschlagen',
    'failed_body' => 'Etwas, das das Panel tun sollte, ist nicht geschehen und wird nicht noch einmal versucht - ein Server, der nicht gebaut wurde, eine Rechnung, die nicht geschrieben wurde, eine Mail, die nicht verschickt wurde. Sie stehen in der Tabelle failed_jobs; `php artisan queue:retry all` reiht sie wieder ein, sobald behoben ist, was sie aufgehalten hat.',
    'failed_back' => 'Seit der letzten Prüfung ist nichts fehlgeschlagen',
    'failed' => 'Melde es, wenn ein eingereihter Auftrag fehlschlägt',
    'failed_helper' => 'Laravel notiert einen Auftrag, den es aufgegeben hat, und sagt nichts dazu. Das hier sagt etwas dazu. Gezählt statt aufgezählt: zwanzig Fehlschläge in einer Nacht haben meist eine Ursache.',

    'health_interval_off' => 'Warnungen sind eingeschaltet, aber das Intervall steht auf Aus, deshalb läuft der Wachhund nie.',
    'health_owners_unwatched' => 'Besitzerwarnungen sind an, aber der Wachhund läuft nicht, deshalb erfahren Besitzer nie von einem Ausfall.',
    'health_no_channel' => 'Der Wachhund läuft, aber jeder Weg, jemanden zu benachrichtigen, ist ausgeschaltet.',
    'health_discord' => 'Discord-Warnungen sind an, aber es ist kein gültiger https-Webhook gespeichert.',
    'health_bot' => 'Bot-Warnungen sind an, aber die https-Adresse oder das Signatur-Geheimnis fehlt.',
    'health_email' => 'Warn-E-Mails sind an, aber es gibt keine gültige Adresse, oder der Mailer des Panels schreibt nur in sein Log.',
];
