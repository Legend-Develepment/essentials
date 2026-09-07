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
    'subheading' => 'Schlüssel, mit denen etwas außerhalb des Panels fragen kann, was dieses Plugin weiß. Nur lesend — nichts hier kann einen Server starten, stoppen oder erreichen.',

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
    'once_body' => 'Er wird als Hash abgelegt, niemand — auch nicht, wer dieses Panel betreibt — kann ihn also zurücklesen. Setze ihn jetzt dort ein, wo der Bot oder das Skript ihn liest. Geht er verloren, zieh diesen zurück und erbitte einen neuen.',
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
    'scope_panel_helper' => 'Antwortet auf die Fragen, die das ganze Panel betreffen — jede Node, die Kapazität, den Watchdog, die Maschine des Panels selbst. Für einen Bot, der über das Panel berichtet, statt für eine Person.',

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
    'grant_confirm' => 'Gibt einen Schlüssel aus, der für die eigenen Server dieser Person antwortet, und zeigt ihn einmal. Sie kann alles, was er melden wird, ohnehin sehen — hier wird entschieden, ob etwas außerhalb des Panels in ihrem Namen fragen darf.',
    'granted' => 'Gewährt',

    'refuse' => 'Ablehnen',
    'refuse_answer' => 'Was ihnen gesagt wird',
    'refuse_answer_helper' => 'Freiwillig, und auf ihrer eigenen Seite zu sehen. Eine Ablehnung ohne Grund ist eine, die nächste Woche wieder erbeten wird.',
    'refused' => 'Abgelehnt',

    'revoke' => 'Zurückziehen',
    'revoke_confirm' => 'Der Schlüssel hört sofort auf zu antworten, und sein Hash wird entfernt, er lässt sich also nicht zurückholen. Alles, was ihn benutzt, bleibt stehen. Erbitte einen neuen, statt das rückgängig machen zu wollen.',
    'revoked' => 'Zurückgezogen',

    'mint' => 'Neuer Schlüssel',
    'mint_body' => 'Für einen Bot statt für eine Person. Er ist in dem Moment gewährt, in dem er entsteht, denn du bist der, der ihn genehmigt hätte.',
    'mint_owner' => 'Wem er gehört',
    'mint_owner_helper' => 'Ein Schlüssel antwortet als jemand. Bei einem Schlüssel fürs ganze Panel ist das nur, wer dafür geradesteht; bei einem persönlichen ist es zugleich, was der Schlüssel sehen kann.',
    'minted' => 'Erstellt',

    // ---- was ein Administrator einstellt ---------------------------------
    'settings' => 'Wie das läuft',
    'approval' => 'Anfragen warten auf Gewährung',
    'approval_helper' => 'An bekommt jemand, der einen Schlüssel erbittet, ihn, sobald jemand Ja sagt. Aus bekommt er ihn sofort — was auf einem Panel, auf dem jeder mit einem Konto ohnehin vertraut ist, vernünftig ist und das man wählen sollte, statt darin zu landen.',
    'rate' => 'Anfragen pro Minute, je Schlüssel',
    'rate_helper' => 'Ein Bot, der vierzig Server fragt, wer gerade spielt, sind vierzig Fragen an vierzig Spielserver. Das ist die Decke, die verhindert, dass eine um drei Uhr nachts geschriebene Schleife zum Lasttest wird.',
    'days' => 'Ein gewährter Schlüssel hält',
    'days_helper' => 'In Tagen. Null heißt, bis er zurückgezogen wird, und das ist die Voreinstellung — ein Schlüssel, der abläuft, während niemand hinsieht, ist ein Bot, der über Nacht stehen bleibt, ohne dass irgendwo steht, warum.',
    'days_never' => 'Bis er zurückgezogen wird',

    /*
     * Auf der Seite gesagt und nicht dem Herausfinden überlassen. Pelican dreht
     * die Migrationen eines Plugins zurück, wenn es deinstalliert wird, und die
     * eine Tabelle dieses Plugins geht mit.
     */
    'uninstall_note' => 'Dieses Plugin zu entfernen entfernt jeden Schlüssel mit. Das ist Absicht — ein Schlüssel, der das überlebt, was ihn beantwortet, ist eine Zugangsberechtigung, die niemand mehr zurückziehen kann.',
];
