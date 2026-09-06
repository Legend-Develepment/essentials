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
    'channels_helper' => 'Was jeder Kanal getan hat, als er zuletzt etwas senden sollte. Ein Kanal, der eingeschaltet ist und stillschweigend ablehnt, sieht genauso aus wie ein Panel, dem nichts fehlt — deshalb steht das hier ganz oben.',

    'state_off' => 'Aus',
    'state_untried' => 'Noch nichts gesendet',
    'state_ok' => 'Zugestellt',
    'state_failed' => 'Abgelehnt',

    // ---- wann -------------------------------------------------------------
    'when' => 'Wie oft',
    'when_helper' => 'Die Prüfungen laufen im Hintergrund und brauchen deshalb einen Queue-Worker. Ohne ihn wird nichts gesendet, und nichts sagt es dir — nimm „Test senden", das läuft nicht über die Queue.',

    'every' => 'Prüfen alle',
    'every_helper' => 'Jede Prüfung erreicht die Daemon jeder Node, das ist also eine Anfrage pro Node und Durchlauf. Fünfzehn Minuten reichen, um von einer Störung zu hören, solange sie noch eine ist.',
    'every_off' => 'Aus — überhaupt keine Prüfungen',
    'every_five' => '5 Minuten',
    'every_fifteen' => '15 Minuten',
    'every_thirty' => '30 Minuten',
    'every_hourly' => 'Stunde',
    'every_daily' => 'Tag',

    'repeat' => 'Erinnere mich, solange es anhält',
    'repeat_helper' => 'Eine Meldung geht raus, wenn sich etwas ändert, und noch eine, wenn es sich erholt. Das hier ergänzt eine Erinnerung, solange ein Problem noch andauert. Null heißt keine Erinnerungen — einen Kanal, der sich alle fünfzehn Minuten wiederholt, stellt man stumm.',
    'hours' => 'Stunden',

    // ---- wohin ------------------------------------------------------------
    'where' => 'Kanäle',
    'where_helper' => 'Mehr als einer ist vernünftig. Sie fallen unterschiedlich aus.',

    'discord' => 'Discord',
    'discord_helper' => 'Dort wird eine Meldung tatsächlich von jemandem gelesen, der gerade nicht ins Panel schaut.',
    'webhook' => 'Webhook-Adresse',
    'webhook_helper' => 'In Discord: Servereinstellungen → Integrationen → Webhooks → Neuer Webhook → Webhook-URL kopieren. Nur https, denn hier wird gepostet, welche deiner Maschinen unten ist und wie voll ihre Festplatte.',

    'panel' => 'Im Panel',
    'panel_helper' => 'Eine Benachrichtigung für jeden, der diese Berechtigung hat. Funktioniert immer, braucht keine Einrichtung, und ist für jeden unsichtbar, der nicht angemeldet ist.',

    'email' => 'E-Mail',
    'email_helper' => 'Mit Komma getrennt. Nutzt den Mailer des Panels — zuverlässig, wenn der eingerichtet ist, und vollkommen still, wenn nicht, und genau das ist der eine Ausfall, den ein Watchdog nicht haben darf. Leer lassen schaltet es aus.',

    // ---- was --------------------------------------------------------------
    'what' => 'Worauf geachtet wird',
    'what_helper' => 'Jeder Wert hier ist einer, den das Panel ohnehin schon abfragt. Nichts auf dieser Seite öffnet eine Verbindung, die die Seite Systemstatus nicht auch öffnet.',

    'percent_helper' => 'Null schaltet diese Prüfung aus.',
    'disk' => 'Warnen, wenn die Festplatte einer Node über',
    'memory' => 'Warnen, wenn der Arbeitsspeicher einer Node über',

    'maintenance' => 'Warnen bei Wartung, die länger anliegt als',
    'maintenance_helper' => 'Eine Node in Wartung wird von jeder anderen Prüfung übersprungen, und das ist richtig — es ist zugleich der Weg, auf dem eine vierzehn Tage lang vergessen wird. Null schaltet das aus.',

    'versions' => 'Panel- und Wings-Versionen',
    'versions_helper' => 'Eine Meldung, wenn etwas zurückfällt, und eine, wenn es wieder aktuell ist. Keine Erinnerungen — eine Version ist keine Störung.',

    'backups' => 'Backups, die zurückfallen',
    'backups_helper' => 'Eine Meldung, die die Server nennt, statt einer je Server — bleibt ein Zeitplan stehen, veralten alle Server auf einmal, und vierzig getrennte Meldungen über eine Ursache sind ein Kanal, den man stumm stellt. Standardmäßig aus: einem Panel, das von Hand statt nach Plan sichert, würde das täglich vorgehalten.',
    'backup_days' => 'Ein Backup gilt als veraltet nach',
    'backup_days_helper' => 'Dasselbe nutzt auch die Backup-Seite. Ein Server, der wöchentlich gesichert wird, sollte nicht nach acht Tagen gemeldet werden.',
    'days' => 'Tagen',

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
    'hint_email_sender' => 'Dein SMTP-Server hat die Adresse abgelehnt, von der aus das Panel sendet, nicht die, an die es senden wollte. Unter Admin → Einstellungen → Mail muss die Absenderadresse ein Postfach sein, als das dein SMTP-Konto senden darf. Das hat mit diesem Plugin nichts zu tun — Pelicans eigene Testmail auf derselben Seite scheitert genauso.',
    'hint_email' => 'Sieh unter Admin → Einstellungen → Mail nach. Die Schaltfläche für die Testmail dort nutzt dieselben Einstellungen und sagt dasselbe.',
    'hint_discord_url' => 'Discord hat diesen Webhook nicht erkannt. Er wurde gelöscht, neu erzeugt oder unvollständig eingefügt — lege unter Servereinstellungen → Integrationen → Webhooks einen neuen an und kopiere die ganze URL.',
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

    'for_unknown' => 'einer Weile',
    'for_minutes' => ':count Minuten',
    'for_hours' => ':count Stunden',
    'for_days' => ':count Tagen',

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
    'node_maintenance_body' => ':node ist seit mehr als :hours Stunden in Wartung. Währenddessen wird nichts anderes daran geprüft, und das ist der Sinn — es ist aber gut zu wissen, dass es noch so steht.',
    'node_maintenance_over' => ':node ist aus der Wartung',

    'wings_behind' => 'Wings auf :node ist veraltet',
    'wings_behind_body' => ':node fährt Wings :installed, und :latest ist draußen. Aktualisiere es auf der Node selbst — das Panel hat keinen Weg dorthin.',
    'wings_current' => 'Wings auf :node ist aktuell',

    'panel_behind' => 'Das Panel ist veraltet',
    'panel_behind_body' => 'Dieses Panel fährt :installed, und :latest ist draußen.',
    'panel_current' => 'Das Panel ist aktuell',

    'and_more' => 'und :count weitere',

    'owners' => 'Leuten sagen, wenn die Maschine ihres eigenen Servers unten ist',
    'owners_helper' => 'Die einzige Prüfung hier, die jemand anderem als dir schreibt. Der Besitzer jedes Servers auf einer Maschine, die nicht mehr antwortet, bekommt eine Benachrichtigung im Panel — die Glocke, niemals eine E-Mail — und eine, wenn sie zurück ist. Dazwischen nie eine Erinnerung: das alle Viertelstunde an alle auf einer vollen Node zu wiederholen ist der Weg, auf dem die Benachrichtigungen eines Panels nicht mehr gelesen werden. Subuser bekommen nichts; der Besitzer ist der, der entscheidet, was zu tun ist. Die Maschine wird ihnen nicht genannt, aus demselben Grund, aus dem die Statusseite sie nicht veröffentlicht.',

    'owner_down' => 'Einer deiner Server ist offline|:count deiner Server sind offline',
    'owner_down_body' => 'Die Maschine, auf der sie liegen, antwortet nicht mehr. Es ist jemandem Bescheid gesagt worden. Betroffen: :servers',
    'owner_up' => 'Dein Server ist zurück|:count deiner Server sind zurück',
    'owner_up_body' => 'Die Maschine antwortet wieder. Zurück: :servers',

    'schedules' => 'Zeitpläne, die stehen geblieben sind',
    'schedules_helper' => 'Ein Zeitplan, der mitten im Durchlauf hängen blieb, einer, dessen Zeit verstrichen ist, weil der Cron nicht läuft, oder einer, der noch nie gelaufen ist. Pelican hat für keinen davon ein Wort — ein abgestürzter Durchlauf bleibt für immer „in Bearbeitung" und wird genauso gezeichnet wie einer, der gerade läuft. Liest bei jeder Prüfung jeden aktiven Zeitplan des Panels.',

    'schedule_stopped' => ':count Zeitpläne sind stehen geblieben',
    'schedule_stopped_body' => 'Seit über :hours Stunden hängend, überfällig oder nie gelaufen: :schedules',
    'schedule_running' => 'Jeder Zeitplan läuft wieder',

    'backup_none' => 'Von :count Servern gibt es noch nie ein Backup',
    'backup_none_body' => 'Noch nie gesichert wurde: :servers',
    'backup_none_over' => 'Jeder Server hat jetzt ein Backup',

    'backup_stale' => ':count Server wurden länger nicht gesichert',
    'backup_stale_body' => 'Seit :days Tagen kein erfolgreiches Backup auf: :servers',
    'backup_stale_over' => 'Jeder Server wurde vor Kurzem gesichert',

    'backup_failed' => 'Auf :count Servern schlagen Backups fehl',
    'backup_failed_body' => 'Ein Backup endete erfolglos auf: :servers',
    'backup_failed_over' => 'Es schlagen keine Backups mehr fehl',

    'worker_missing' => 'Es arbeitet nichts die Queue ab',
    'worker_missing_body' => 'Ein Auftrag wurde eingereiht, und nichts hat ihn aufgenommen. Plugin-Aktualisierungen, Modpack-Installationen und diese Prüfungen stehen alle still, bis ein Worker läuft — versuch systemctl status pelican-queue auf der Maschine des Panels.',
    'worker_back' => 'Die Queue wird wieder abgearbeitet',
];
