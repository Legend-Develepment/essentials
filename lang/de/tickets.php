<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Eine Frage von innerhalb des Panels stellen.
 *
 * Die Formulierungen versprechen nie, woher eine Antwort kommt. Auf einem
 * Panel, das auf Modora steht, antwortet das Team in Discord und der Kunde
 * liest es hier; eines, das seine Tickets selbst beantwortet, hat dieselben
 * zwei Ansichten. Deshalb steht unten nirgends „wir antworten in Discord" oder
 * „sieh auf dieser Seite nach" - beides wäre auf der Hälfte der Panels falsch,
 * auf denen das hier läuft.
 *
 * „Weitergegeben" wird von „beantwortet" getrennt gehalten. Eine Nachricht, die
 * hier geschrieben und noch nicht an den Desk gespiegelt wurde, ist eine, die
 * niemand gesehen hat, und das ist etwas anderes als eine, die niemand
 * beantwortet hat. Der Unterschied ist der zwischen geduldig warten und ein
 * zweites Mal fragen.
 *
 * „Bucket", „Endpoint", „Secret", „Webhook" und „Modora" bleiben stehen: so
 * heißen sie dort, wo man sie einträgt.
 */

return [
    // ---- die Verwaltungsseite ---------------------------------------------
    'title' => 'Tickets',
    'nav_label' => 'Tickets',
    'subheading' => 'Was Kunden gefragt haben, die noch Wartenden zuerst.',
    'column_subject' => 'Frage',
    'column_state' => 'Stand',
    'column_priority' => 'Priorität',
    'column_last' => 'Letzte Nachricht',
    'column_pushed' => 'Weitergegeben',
    'pushed_yes' => 'Ja',
    'pushed_no' => 'Noch nicht',
    'read' => 'Lesen',
    'shut' => 'Diese Ansicht schließen',
    'answer' => 'Deine Antwort',
    'send' => 'Senden',
    'sent' => 'Gesendet',
    'not_sent' => 'Das wurde nicht gesendet. Verloren ist nichts - versuch es noch einmal.',
    'close' => 'Als erledigt markieren',
    'close_confirm' => 'Markiert dieses Ticket als erledigt. Der Kunde kann es weiter lesen und kann erneut fragen, indem er ein neues öffnet.',
    'closed' => 'Erledigt',
    'close_failed' => 'Das ließ sich nicht als erledigt markieren.',
    'closed_note' => 'Dieses Ticket ist erledigt. Es lässt sich nichts mehr hinzufügen.',
    'from_staff' => 'Support',
    'picture' => 'Bild',
    'picture_add' => 'Ein Bild anhängen',
    'answer_hint' => 'Schreib eine Antwort. Enter sendet, Umschalt und Enter macht eine neue Zeile.',
    'reply_hint' => 'Schreib etwas dazu. Enter sendet, Umschalt und Enter macht eine neue Zeile.',
    'file' => 'Datei',
    'file_add' => 'Eine Datei anhängen',
    'picture_busy' => 'Das Bild wird gesendet...',
    'nothing_said' => 'Es wurde noch nichts gesagt.',
    'tag_staff' => 'Support',
    'tag_user' => 'Kunde',
    'markdown_hint' => 'Enter sendet, Umschalt und Enter macht eine neue Zeile. **fett**, *kursiv*, __unterstrichen__, ~~durchgestrichen~~, `Code` und > Zitate funktionieren alle und lesen sich in Discord genauso.',
    'from_panel' => 'aus dem Panel',
    'from_discord' => 'aus Discord',
    'empty' => 'Es hat noch niemand etwas gefragt',
    'empty_body' => 'Fragen aus dem Kundenbereich landen hier, mit dem Dienst daran, um den es geht.',

    // ---- wer es hat und zu welchem Team es gehört -------------------------
    'column_claimed' => 'Übernommen von',
    'column_group' => 'Gruppe',
    'claimed_nobody' => 'Noch niemand',
    'only_mine' => 'Nur, was ich übernommen habe',
    'take' => 'Das hier übernehmen',
    'take_over' => 'Das hier abnehmen',
    'release' => 'Das hier abgeben',
    'taken' => 'Es gehört dir',
    'released' => 'Zurück auf den Stapel',
    'claim_failed' => 'Das ließ sich nicht ändern.',
    'group' => 'In eine Gruppe verschieben',
    'group_helper' => 'Die Gruppen sind die Rollen dieses Panels, denn wer Rechnungsfragen beantwortet, ist ohnehin schon eine. Vor niemandem, der es vorher sehen konnte, wird etwas verborgen - die Gruppe ist das, wonach das Team filtert, nicht das, was es lesen darf.',
    'group_move' => 'Verschieben',
    'group_none' => 'Keine Gruppe',
    'group_moved' => 'Verschoben',
    'group_failed' => 'Das ließ sich nicht verschieben.',
    'priority_set' => 'Setzen',
    'priority_done' => 'Geändert',
    'priority_failed' => 'Das ließ sich nicht ändern.',

    // ---- was eine Änderung im Gespräch sagt -------------------------------
    'note_claimed' => ':who hat das hier übernommen.',
    'note_released' => ':who hat das hier zurück auf den Stapel gelegt.',
    'note_grouped' => ':who hat das hier nach :group verschoben.',
    'note_ungrouped' => ':who hat das hier aus seiner Gruppe genommen.',
    'note_priority' => ':who hat das hier auf :level gesetzt.',
    'day_today' => 'Heute',
    'day_yesterday' => 'Gestern',

    'retry' => 'Erneut weitergeben',
    'retry_confirm' => 'Schickt dieses Ticket und alles, was der Kunde gesagt hat, noch einmal an den Desk. Es wird nichts doppelt: es geht nur, was noch nicht weitergegeben wurde.',
    'retried' => 'Weitergegeben',
    'retry_failed' => 'Es ist immer noch nicht durchgegangen',
    'retry_failed_body' => 'Der Grund steht im Log. Das Ticket und jede Nachricht liegen hier so oder so sicher.',

    // ---- die Zustände -----------------------------------------------------
    'state_open' => 'Wartet auf dich',
    'state_answered' => 'Wartet auf sie',
    'state_closed' => 'Erledigt',
    'priority_low' => 'Niedrig',
    'priority_normal' => 'Normal',
    'priority_high' => 'Dringend',

    // ---- die Einstellungen ------------------------------------------------
    'settings' => 'Wo diese beantwortet werden',
    'settings_helper' => 'Jede Frage und jede Antwort bleibt in diesem Panel, wie das hier auch steht. Was hier entschieden wird, ist, wo das Team sie liest.',
    'files_where' => 'Bilder liegen',
    'files_where_helper' => 'Auf dem Panel werden sie von einer nicht zu erratenden Adresse hier ausgeliefert. In einem Bucket gehören sie diesem Panel gar nicht mehr, und ein CDN davor ist die Adresse in der Einstellung unten. Ein Bucket, der nicht antwortet, fällt auf das Panel zurück, statt das Bild zu verlieren.',
    'files_panel' => 'Auf diesem Panel',
    'files_s3' => 'In einem Bucket (S3, R2, MinIO, Wasabi)',
    'bucket' => 'Bucket',
    'bucket_helper' => 'Alles, was das S3-Protokoll spricht. Endpoint und Path-Style-Schalter brauchen die, die nicht AWS sind; für AWS selbst lass beides in Ruhe.',
    'bucket_key' => 'Zugriffsschlüssel',
    'bucket_secret' => 'Secret',
    'bucket_region' => 'Region',
    'bucket_region_helper' => 'auto passt für R2 und die meisten selbst betriebenen. AWS will seine eigene, etwa eu-central-1.',
    'bucket_name' => 'Bucket-Name',
    'bucket_endpoint' => 'Endpoint',
    'bucket_endpoint_helper' => 'Für AWS leer lassen. R2, MinIO und der Rest haben jeder einen eigenen.',
    'bucket_path_style' => 'Path-Style-Adressen',
    'bucket_path_style_helper' => 'Was MinIO und die meisten selbst betriebenen brauchen. AWS und R2 nicht.',
    'bucket_url' => 'Gelesen von',
    'bucket_url_helper' => 'Wo ein Bild geholt wird, und das ist nicht immer dort, wo es geschrieben wurde. Ein CDN vor dem Bucket gehört hierher. Leer lässt es den Treiber selbst herausfinden.',
    'bucket_check' => 'Bucket testen',
    'bucket_ok' => 'Der Bucket funktioniert',
    'bucket_ok_body' => 'Geschrieben, zurückgelesen und wieder entfernt.',
    'bucket_bad' => 'Der Bucket wollte das nicht',
    'bucket_off' => 'Bilder sollen auf diesem Panel liegen, es gibt also keinen Bucket zu testen.',
    'bucket_missing' => 'Schlüssel, Secret und Bucket-Name werden alle drei gebraucht, bevor es etwas zu testen gibt.',
    'bucket_mismatch' => 'Er hat die Datei genommen und etwas anderes zurückgegeben, und damit tut der Bucket etwas, womit dieses Panel nicht arbeiten kann.',
    'bucket_no_url' => 'Er hat die Datei genommen, aber es gibt keine Adresse, von der sie sich zurücklesen lässt. Füll Gelesen von aus - ein Bucket, der nicht öffentlich ist, braucht ein CDN oder eine öffentliche Adresse davor.',
    'taking' => 'Nimmt neue Fragen an',
    'taking_helper' => 'Aus schließt die Annahme. Alles, was schon offen ist, bleibt offen und lässt sich weiter lesen und beantworten - das hier hält nur auf, dass neue begonnen werden.',
    'corner' => 'Hilfe-Schaltfläche in der Ecke',
    'corner_helper' => 'Ein Rettungsring in der Ecke jeder Seite, auf der ein Kunde ist, der mit einem Klick das Fragefenster öffnet. Aus erreichen sie die Seite über das Kontomenü und über ihre Dienste.',
    'via' => 'Beantwortet',
    'via_helper' => 'Im Panel heißt, du antwortest auf der Seite hinter diesem Fenster. Über Modora heißt, die Frage wird zusätzlich als Ticket in deinem Discord geöffnet, und alles, was dort gesagt wird, kommt hierher zurück.',
    'via_panel' => 'Im Panel',
    'via_modora' => 'In Discord, über Modora',
    'modora' => 'Modora',
    'modora_helper' => 'Ein Integrationsschlüssel von deinem Modora-Server, mit den Scopes tickets.create, tickets.read, tickets.close, messages.read und messages.write.',
    'modora_key' => 'Integrationsschlüssel',
    'modora_key_helper' => 'Liegt in der Umgebungsdatei dieses Panels und wird einem Kunden nie gezeigt.',
    'modora_panel' => 'Ticket-Panel',
    'modora_panel_helper' => 'Auf welchem deiner Modora-Ticket-Panels neue Tickets geöffnet werden. Die Liste kommt von Modora selbst; sie ist leer, wenn der Schlüssel keine Panels lesen darf, und das ist in Ordnung - nichts zu setzen überlässt Modora die Wahl.',
    'modora_panel_any' => 'Modora wählen lassen',
    'saved' => 'Gespeichert',
    'save_failed' => 'Nicht gespeichert. Es wurde nichts geschrieben.',

    'check' => 'Schlüssel testen',
    'check_ok' => 'Der Schlüssel funktioniert',
    'check_ok_body' => 'Modora hat geantwortet, und der Schlüssel trägt, was hier gebraucht wird.',
    'check_bad' => 'Modora hat das nicht angenommen',
    'check_no_key' => 'Es gibt noch keinen Integrationsschlüssel.',
    'check_refused' => 'Modora hat den Schlüssel abgelehnt. Er ist entweder falsch oder zurückgezogen worden.',
    'check_ip' => 'Der Schlüssel stimmt, aber Modora nimmt ihn nur von bestimmten Adressen an, und dieses Panel hat von :ip aus angefragt, was keine davon ist. Trag diese Adresse in Modora beim Schlüssel ein.',
    'check_ip_six' => 'Der Schlüssel stimmt, aber Modora nimmt ihn nur von bestimmten Adressen an. Dieses Panel hat über IPv6 angefragt, von :ip - seine IPv4-Adresse zu erlauben ändert also nichts, denn so gehen die Anfragen nicht hinaus. Trag :ip in Modora beim Schlüssel zusätzlich ein.',
    'check_ip_blind' => 'Der Schlüssel stimmt, aber Modora nimmt ihn von der Adresse dieses Panels nicht an. Welche Adresse das ist, ließ sich aus der Verbindung nicht ablesen; die Zeile, die Modora zur abgelehnten Anfrage führt, nennt sie.',
    'check_http' => 'Modora hat mit HTTP :status geantwortet. Das ist ihre Seite und nicht der Schlüssel.',
    'check_scopes' => 'Der Schlüssel funktioniert, aber es fehlt ihm, was hier gebraucht wird: :scopes. Trag diese Scopes in Modora bei ihm nach.',

    // ---- die Seite des Kunden ---------------------------------------------
    'mine_title' => 'Hilfe',
    'mine_nav_label' => 'Hilfe',
    'mine_subheading' => 'Frag zu einem Dienst, und lies, was zurückkam.',
    'mine_empty' => 'Du hast noch nichts gefragt',
    'mine_empty_body' => 'Stell hier eine Frage, und sie kommt mit deinem Dienst daran an, sodass der, der sie liest, schon weiß, welchen Server du meinst.',
    'ask' => 'Eine Frage stellen',
    'ask_helper' => 'Sag, was los ist und um welchen Dienst es geht. Je mehr davon hier steht, desto seltener muss jemand zurückfragen.',
    'ask_send' => 'Abschicken',
    'subject' => 'In einer Zeile',
    'subject_helper' => 'Worum es geht, kurz genug, um es in einer Liste zu lesen.',
    'about' => 'Welcher Dienst',
    'about_helper' => 'Freiwillig. Einen auszuwählen spart allen eine Runde Fragen.',
    'priority' => 'Wie dringend',
    'body' => 'Was los ist',
    'body_helper' => 'Was du getan hast, was du erwartet hast und was stattdessen geschehen ist.',
    'reply' => 'Etwas hinzufügen',
    'asked' => 'Deine Frage ist abgeschickt',
    'asked_body' => 'Du bekommst hier eine Benachrichtigung, sobald jemand antwortet.',
    'not_asked' => 'Das wurde nicht abgeschickt',
    'not_asked_body' => 'Es wurde nichts festgehalten. Versuch es noch einmal, und sag es dem, der dieses Panel betreibt, wenn es weiter vorkommt.',
    'claim' => 'In Discord öffnen',
    'ask_about' => 'Zu diesem Dienst fragen',

    // ---- was gesagt wird --------------------------------------------------
    'said_by' => '**:who** hat gefragt, aus dem Panel:',
    'replied_by' => '**:who** hat geantwortet, aus dem Panel:',
    'ctx_service' => 'Dienst: :name',
    'ctx_server' => 'Server: :url',
    'ctx_priority' => 'Priorität: :level',
    'ctx_ticket' => 'Panel-Ticket: :number',
    'ctx_picture' => 'Bild: :url',
    'someone' => 'Jemand',

    // ---- und die Glocken --------------------------------------------------
    'bell_answered' => 'Auf deine Frage gibt es eine Antwort',
    'bell_answered_body' => 'Es geht um: :subject',
    'bell_asked' => 'Ein Kunde hat etwas gefragt, Ticket :number',

    // ---- die Adresse, an die Modora schickt -------------------------------
    'hook' => 'Ereignis-Adresse',
    'hook_helper' => 'Füg das in Modora als Callback-URL ein. Alle fünf Ereignisse sind es wert, angehakt zu werden, und jedes tut hier etwas anderes: eine Nachricht aus dem Kanal kommt dazu, eine eigene bestätigt, wo sie in Discord gelandet ist, ein Schließen beendet das Ticket auch hier, ein Claim legt die Verbindung still, und ein in Discord geöffnetes Ticket bleibt in Ruhe. Antworten kommen dann an, sobald sie geschrieben werden, statt zur nächsten Viertelstunde.',
    'hook_none' => 'Es gibt noch keine Adresse. Leg mit der Schaltfläche neben diesem Formular eine an.',
    'hook_make' => 'Ereignis-Adresse anlegen',
    'hook_renew' => 'Neue Ereignis-Adresse',
    'hook_renew_confirm' => 'Das legt eine neue Adresse an, und die alte antwortet sofort nicht mehr. Was schon in Modora eingefügt ist, muss ersetzt werden.',
    'hook_made' => 'Die Adresse steht bereit',
    'hook_made_body' => 'Sie steht im Einstellungsfenster unter Modora. Füg sie dort als Callback-URL ein.',
    'hook_seen' => 'Was angekommen ist',
    'hook_seen_none' => 'Es ist noch nichts angekommen',
    'hook_seen_none_body' => 'Sobald die Adresse in Modora eingefügt ist und in einem Ticket etwas geschieht, bleiben hier die letzten zwanzig Zustellungen stehen, damit du genau siehst, was sie schicken.',
    'hook_headers' => 'Header',
    'hook_body' => 'Rumpf',
];
