<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Ein Weg von außen ins Panel.
 *
 * Zwei Sorten Leser in einer Datei, und sie wollen Gegensätzliches. Ein
 * Administrator, der diese Seite liest, entscheidet gerade, ob er jemandem
 * einen Schlüssel anvertraut - jede Zeile hier sagt also, was ein Schlüssel
 * erreicht, und nicht, wie er heißt. Wer einen erbittet, will wissen, was er in
 * die Hand bekommt und was passiert, wenn er ihn verliert, und deshalb ist der
 * Satz darüber, dass ein Schlüssel nur einmal zu sehen ist, keine Fußnote.
 *
 * Nirgends steht hier „Token". „Schlüssel" ist das Wort auf Pelicans eigener
 * Kontoseite, und ein Panel, das dieselbe Sache zweimal anders nennt, ist ein
 * Panel, in dem jemand das Falsche sucht.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Schlüssel, mit denen etwas außerhalb des Panels fragen kann, was dieses Plugin weiß. Nur lesend - nichts hier kann einen Server starten, stoppen oder erreichen.',

    'my_title' => 'API-Zugang',
    'my_nav_label' => 'API-Zugang',
    'my_subheading' => 'Ein eigener Schlüssel, für einen Bot oder ein Skript. Er antwortet nur für die Server, die du ohnehin öffnen kannst.',

    // ---- was ein Schlüssel ist, einmal gesagt, wo es zählt ---------------
    'address' => 'Die Adresse',
    'address_helper' => 'Schicke den Schlüssel als Authorization-Header mit: :example',

    /*
     * Das eine, was jemand gelesen haben muss, bevor er das Fenster schließt.
     * Als Handlung geschrieben und nicht als Warnung, denn „gut aufbewahren"
     * ist ein Rat, mit dem niemand etwas anfangen kann, und „jetzt dorthin
     * einsetzen, wo der Bot ihn liest" schon.
     */
    'once' => 'Das ist das einzige Mal, dass dieser Schlüssel zu sehen ist',
    'once_body' => 'Er wird als Hash abgelegt, niemand - auch nicht, wer dieses Panel betreibt - kann ihn also zurücklesen. Setze ihn jetzt dort ein, wo der Bot oder das Skript ihn liest. Geht er verloren, zieh diesen zurück und erbitte einen neuen.',
    'copy' => 'Kopieren',
    'copied' => 'Kopiert',

    // ---- die Zustände ----------------------------------------------------
    'state' => 'Zustand',
    'state_pending' => 'Wartet',
    'state_active' => 'Aktiv',
    'state_refused' => 'Abgelehnt',
    'state_revoked' => 'Zurückgezogen',

    'state_pending_body' => 'Jemand muss das erst gewähren, bevor er auf irgendetwas antwortet.',
    'state_refused_body' => 'Das wurde abgelehnt. Es wurde nichts ausgegeben.',
    'state_revoked_body' => 'Dieser Schlüssel wurde entzogen und antwortet nicht mehr.',

    // ---- die Reichweite --------------------------------------------------
    'scope' => 'Erreicht',
    'scope_person' => 'Die eigenen Server',
    'scope_panel' => 'Das ganze Panel',

    'scope_person_helper' => 'Antwortet nur für die Server, die sein Besitzer ohnehin öffnen kann, genauso gefragt, wie das Panel fragt. Diesen Schlüssel zu verlieren verliert nichts, was sein Besitzer nicht schon sehen konnte.',
    'scope_panel_helper' => 'Antwortet auf die Fragen, die das ganze Panel betreffen - jede Node, die Kapazität, den Watchdog, die Maschine des Panels selbst. Für einen Bot, der über das Panel berichtet, statt für eine Person.',

    // ---- die Tabelle -----------------------------------------------------
    'column_name' => 'Wofür',
    'column_owner' => 'Wessen',
    'column_prefix' => 'Schlüssel',
    'column_asked' => 'Erbeten',
    'column_used' => 'Zuletzt benutzt',
    'column_expires' => 'Läuft ab',

    'never_used' => 'Nie',
    'no_expiry' => 'Bis er zurückgezogen wird',

    'tab_waiting' => 'Wartend',
    'tab_active' => 'Aktiv',
    'tab_all' => 'Alle',

    'empty' => 'Noch keine Schlüssel',
    'empty_body' => 'Niemand hat einen erbeten, und es wurde keiner ausgegeben. Diese Seite füllt sich von selbst, sobald Leute es tun.',

    'my_empty' => 'Du hast keinen Schlüssel',
    'my_empty_body' => 'Erbitte einen, dann erscheint er hier mitsamt dem, was darauf geantwortet wurde.',

    // ---- erbitten --------------------------------------------------------
    'ask' => 'Einen Schlüssel erbitten',
    'ask_name' => 'Wofür ist er',
    'ask_name_helper' => 'Ein paar Worte, damit du später zwei eigene auseinanderhältst und wer ihn gewährt weiß, was er gewährt.',
    'ask_reason' => 'Alles, was noch dazugehört',
    'ask_reason_helper' => 'Freiwillig. Gelesen von dem, der entscheidet.',
    'ask_sent' => 'Erbeten',
    'ask_sent_body' => 'Er erscheint unten, sobald jemand geantwortet hat.',
    'ask_granted' => 'Hier ist dein Schlüssel',
    'ask_open' => 'Du hast schon einen, der auf Antwort wartet',
    'ask_open_body' => 'Eine Anfrage auf einmal. Zieh jene zurück, wenn sie ein Versehen war.',
    'ask_failed' => 'Darum konnte nicht gebeten werden',

    'cancel' => 'Zurückziehen',
    'cancel_confirm' => 'Zieht die Anfrage zurück. Es wurde nichts ausgegeben, also hört auch nichts auf zu funktionieren.',

    // ---- entscheiden -----------------------------------------------------
    'grant' => 'Gewähren',
    'grant_confirm' => 'Gibt einen Schlüssel aus, der für die eigenen Server dieser Person antwortet, und zeigt ihn einmal. Sie kann alles, was er melden wird, ohnehin sehen - hier wird entschieden, ob etwas außerhalb des Panels in ihrem Namen fragen darf.',
    'granted' => 'Gewährt',

    'refuse' => 'Ablehnen',
    'refuse_answer' => 'Was ihnen gesagt wird',
    'refuse_answer_helper' => 'Freiwillig, und auf ihrer eigenen Seite zu sehen. Eine Ablehnung ohne Grund ist eine, die nächste Woche wieder erbeten wird.',
    'refused' => 'Abgelehnt',
    'collect' => 'Meinen Schlüssel zeigen',
    'state_ready_body' => 'Gewährt. Drücke auf Meinen Schlüssel zeigen, um ihn zu sehen - einmal, denn er wird als Hash abgelegt und lässt sich danach nicht zurücklesen.',
    'replace' => 'Ersetzen',
    'replace_confirm' => 'Dieser Schlüssel hört sofort auf zu funktionieren, und ein neuer nimmt seinen Platz ein, einmal gezeigt. Der alte lässt sich nirgends nachschlagen, denn er wurde nie abgelegt: ihn zu ersetzen ist die einzige Antwort darauf, ihn verloren zu haben.',
    'granted_body' => 'Sie holen ihn sich selbst auf ihrer eigenen Seite API-Zugang ab. Hier wird er nicht gezeigt: ein Schlüssel gehört dem, der ihn erbeten hat, und nicht dem, der Ja gesagt hat.',

    'revoke' => 'Zurückziehen',
    'revoke_confirm' => 'Der Schlüssel hört sofort auf zu antworten, und sein Hash wird entfernt, er lässt sich also nicht zurückholen. Alles, was ihn benutzt, bleibt stehen. Erbitte einen neuen, statt das rückgängig machen zu wollen.',
    'revoked' => 'Zurückgezogen',
    'forget' => 'Entfernen',
    'forget_confirm' => 'Nimmt die Zeile endgültig von dieser Seite. Er hat schon aufgehört zu antworten, es bleibt also nichts stehen, was funktioniert - das hier entfernt nur den Vermerk, dass es ihn gab.',
    'forgotten' => 'Entfernt',

    'mint' => 'Neuer Schlüssel',
    'mint_body' => 'Für einen Bot statt für eine Person. Er ist in dem Moment gewährt, in dem er entsteht, denn du bist der, der ihn genehmigt hätte.',
    'abilities' => 'Worüber er fragen darf',
    'abilities_helper' => 'Zu Anfang ist alles angehakt, denn das war ein Schlüssel, bevor es das hier gab. Den Haken zu entfernen ist die bewusste Handlung. Abgelegt wird die Liste des Erlaubten, eine Fähigkeit aus einer späteren Version ist für davor erstellte Schlüssel also aus - eine Fähigkeit, die niemand angehakt hat, ist eine, die niemand gewährt hat.',
    'ability_health' => 'Beweisen, dass der Schlüssel funktioniert',
    'ability_health_helper' => 'Erreicht sonst nichts. Kann gefahrlos in festen Abständen aufgerufen werden.',
    'ability_me' => 'Die eigenen Server',
    'ability_me_helper' => 'Die Server, die sein Besitzer ohnehin öffnen kann, und deren Backups. Jemand anderen kann er nie sehen.',
    'ability_panel' => 'Das ganze Panel',
    'ability_panel_helper' => 'Jede Node, jedes Backup, die stehen gebliebenen Zeitpläne, den Watchdog und die Maschine des Panels. Braucht zusätzlich einen Schlüssel fürs ganze Panel.',
    'ability_live' => 'Einen Server direkt fragen',
    'ability_live_helper' => 'Wer gerade spielt und ob ein Server läuft. Die einzigen Fragen, die etwas kosten - sie erreichen einen Spielserver oder einen Daemon und werden fünfzehn bis zwanzig Sekunden zwischengespeichert.',
    'ability_connect' => 'Discord-Konten mit Panel-Konten verbinden',
    'ability_connect_helper' => 'Die eine Gruppe, die kein Lesen ist. Sie erstellt Pelican-API-Schlüssel auf den Konten derer, die darum bitten, und kann eine Verbindung beenden. Gib sie nur dem Bot, der sie braucht.',
    'own_rate' => 'Anfragen pro Minute für diesen Schlüssel',
    'own_rate_helper' => 'Leer lassen, um der Einstellung des Panels zu folgen. Eine Zahl hier gilt nur für diesen Schlüssel. Null heißt gar keine Decke - vernünftig für einen Bot auf deiner eigenen Maschine, und ein zuverlässiger Weg, es zu bereuen, wenn der Schlüssel woanders landet.',
    'own_rate_default' => 'Folgt dem Panel',
    'mint_owner' => 'Wem er gehört',
    'mint_owner_helper' => 'Ein Schlüssel antwortet als jemand. Bei einem Schlüssel fürs ganze Panel ist das nur, wer dafür geradesteht; bei einem persönlichen ist es zugleich, was der Schlüssel sehen kann.',
    'minted' => 'Erstellt',
    'profile_tab' => 'Essentials-API',
    'profile_make' => 'Ein Schlüssel für die Essentials-API',
    'profile_make_helper' => 'Eine andere API als die oben: diese beantwortet, was dieses Plugin weiß - welcher deiner Server kein Backup hat, wer darauf spielt, ob sie laufen. Sie antwortet immer nur für dich und erreicht nur die Server, die du ohnehin öffnen kannst.',
    'profile_create' => 'Erstellen',
    'profile_yours' => 'Deine Essentials-Schlüssel',
    'profile_manage' => 'Einen Schlüssel zurückziehen, nachsehen, warum einer abgelehnt wurde, und Discord verbinden steht alles auf der Seite API-Zugang in der Seitenleiste.',
    'discord' => 'Discord',
    'discord_body' => 'Verbinde dein Discord-Konto mit diesem, damit ein Bot für deine Server antworten kann, wenn du ihn darum bittest. Was er bekommt, ist ein Schlüssel, der genau das erreicht, was du erreichst, und nichts darüber hinaus.',
    'discord_connect' => 'Discord verbinden',
    'discord_code' => 'Tippe das binnen zehn Minuten in Discord',
    'discord_code_body' => 'Schicke :command in einen Kanal, den der Bot lesen kann. Der Code geht einmal. Niemand außer dem Konto, für das er gemacht wurde, kann ihn benutzen.',
    'discord_on' => 'Verbunden als :name',
    'discord_since' => 'Seit :when',
    'discord_cut' => 'Getrennt',
    'discord_cut_confirm' => 'Beendet die Verbindung und löscht den Schlüssel, den sie angelegt hat, der Bot hört also sofort auf, für dich zu antworten. Du kannst dich jederzeit wieder verbinden.',
    'discord_off' => 'Nicht verbunden',
    'discord_key_note' => 'Das Verbinden legt auf deinem Konto einen Pelican-API-Schlüssel namens Discord (Essentials) an. Du kannst ihn unter Konto → API-Schlüssel sehen und zurückziehen - diese Seite ist nur eine Abkürzung dorthin.',
    'docs_title' => 'Wie diese API zu benutzen ist',
    'docs_subheading' => 'Was dieses Panel beantwortet, an den Adressen, an denen es antwortet. Aus derselben Beschreibung geschrieben, aus der die API gebaut ist, sie kann ihr also keine Version hinterherhinken.',
    'docs_base' => 'Wo sie liegt',
    'docs_endpoints' => 'Endpunkte',
    'docs_answers' => 'Was zurückkommt',
    'docs_calls' => 'Schlüssel, die das aufrufen dürfen',
    'docs_params' => 'Was zu schicken ist',
    'docs_required' => 'erforderlich',
    'docs_optional' => 'freiwillig',
    'docs_try' => 'Ausprobieren',
    'docs_errors' => 'Wenn etwas nicht stimmt',
    'docs_hook' => 'Was das Panel dir schickt',
    'docs_hook_body' => 'Die andere Richtung, und das Einzige hier, das ankommt, ohne erbeten zu sein. Unter Warnungen mit einer Adresse und einem Signaturgeheimnis eingeschaltet: eine JSON-Meldung, wenn der Watchdog etwas findet, und eine, wenn es sich erledigt hat, damit ein Bot von einer toten Node erfährt, statt jede Minute zu fragen, ob es eine gibt.',
    'docs_hook_verify' => 'Der Rumpf wird mit deinem Geheimnis gehasht, und der Hash reist in X-Essentials-Signature als sha256=<hex> mit. Hashe den rohen Rumpf und nicht ein neu serialisiertes Objekt - jeder Unterschied in den Leerzeichen oder in der Reihenfolge der Schlüssel ergibt einen anderen Hash, und die Abweichung liest sich wie ein Angriff und nicht wie ein Fehler.',
    'docs_download_md' => 'Als Markdown herunterladen',
    'docs_download_json' => 'Als OpenAPI herunterladen',

    // ---- was ein Administrator einstellt ---------------------------------
    'settings' => 'Wie das läuft',
    'approval' => 'Anfragen warten auf Gewährung',
    'approval_helper' => 'An bekommt jemand, der einen Schlüssel erbittet, ihn, sobald jemand Ja sagt. Aus bekommt er ihn sofort - was auf einem Panel, auf dem jeder mit einem Konto ohnehin vertraut ist, vernünftig ist und das man wählen sollte, statt darin zu landen.',
    'rate' => 'Anfragen pro Minute, je Schlüssel',
    'rate_helper' => 'Ein Bot, der vierzig Server fragt, wer gerade spielt, sind vierzig Fragen an vierzig Spielserver. Das ist die Decke, die verhindert, dass eine um drei Uhr nachts geschriebene Schleife zum Lasttest wird.',
    'days' => 'Ein gewährter Schlüssel hält',
    'days_helper' => 'In Tagen. Null heißt, bis er zurückgezogen wird, und das ist die Voreinstellung - ein Schlüssel, der abläuft, während niemand hinsieht, ist ein Bot, der über Nacht stehen bleibt, ohne dass irgendwo steht, warum.',
    'days_never' => 'Bis er zurückgezogen wird',
    'hide_pelican' => 'Den eigenen API-Schlüssel-Tab des Panels entfernen',
    'hide_pelican_helper' => 'Nimmt den Tab API-Schlüssel ganz aus dem Kontoprofil, es gibt auf dieser Seite also nur noch eines, das API-Schlüssel heißt. Er wird von der Seite entfernt und nicht übermalt, es bleibt also keine Adresse, die ihn erreicht. Eines kann das nicht: die eigene Client-API des Panels legt weiterhin einen Kontoschlüssel für alles an, was sie direkt danach fragt - der Tab ist, wo Leute einen von Hand anlegen, und das hier nimmt die Hand weg. Schlüssel, die es schon gibt, funktionieren weiter.',

    /*
     * Auf der Seite gesagt und nicht dem Herausfinden überlassen. Pelican dreht
     * die Migrationen eines Plugins zurück, wenn es deinstalliert wird, und die
     * eine Tabelle dieses Plugins geht mit.
     */
    'uninstall_note' => 'Dieses Plugin zu entfernen entfernt jeden Schlüssel mit. Das ist Absicht - ein Schlüssel, der das überlebt, was ihn beantwortet, ist eine Zugangsberechtigung, die niemand mehr zurückziehen kann.',
];
