<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Einen laufenden Dienst von einem Paket auf ein anderes umstellen.
 *
 * Die Formulierungen halten durchgehend eines auseinander: was ein Paket
 * kostet und was der Wechsel dorthin heute kostet, sind zwei verschiedene
 * Zahlen. Die erste steht im Regal; die zweite hängt davon ab, wie weit dieser
 * Dienst in der bezahlten Periode steht, und ihr stimmt jemand zu, wenn er auf
 * die Schaltfläche drückt.
 *
 * „Upgrade" wird in dem, was ein Kunde liest, vermieden, denn die Hälfte
 * dieser Wechsel geht in die andere Richtung. Hier heißt es Wechsel.
 */

return [
    // ---- auf der Dienstkarte ---------------------------------------------
    'change' => 'Paket wechseln',
    'change_body' => 'Was von der bereits bezahlten Periode übrig ist, wird abgezogen, und dieselben Tage werden zum neuen Preis berechnet. Auf deinem Server geht nichts verloren.',
    'change_to' => 'Zu :name wechseln',
    'change_confirm' => 'Diesen Dienst zu :name wechseln?',
    'change_free' => 'Nichts zu zahlen',
    'costs_now' => ':amount jetzt',
    'gives_back' => ':amount zurück',
    'waiting' => 'Wechsel vereinbart',
    'waiting_for' => 'Ein Wechsel zu :name wartet auf eine offene Rechnung.',

    // ---- was danach geschieht --------------------------------------------
    'done' => 'Auf :name umgestellt',
    'done_body' => 'Dein Dienst läuft auf dem neuen Paket. Was dir zustand, liegt auf deinem Konto.',
    'refused' => 'Der Wechsel wurde nicht durchgeführt',

    // ---- und warum nicht, ein Grund nach dem anderen ----------------------
    'refused_off' => 'Das Wechseln des Pakets ist für dieses Panel ausgeschaltet.',
    'refused_not_active' => 'Nur ein laufender Dienst lässt sich wechseln. Bei einem, der noch aussteht, gesperrt ist oder ausläuft, gibt es nichts zu verrechnen.',
    'refused_gone' => 'Das Paket, auf dem dieser Dienst läuft, gibt es nicht mehr, es lässt sich also nichts damit vergleichen.',
    'refused_same' => 'Das ist das Paket, auf dem er schon läuft.',
    'refused_egg' => 'Dieses Paket lässt andere Software laufen. Es wäre ein anderer Server und kein größerer, es muss also als eigener gekauft werden.',
    'refused_period' => 'Dieses Paket wird über eine andere Periode abgerechnet, und das ist eine andere Vereinbarung und keine größere.',
    'refused_stock' => 'Dieses Paket ist ausverkauft.',
    'refused_waiting' => 'Für diesen Dienst wartet schon ein Wechsel auf eine offene Rechnung. Bezahle oder storniere diesen zuerst.',
    'refused_failed' => 'Es wurde nichts festgehalten, also hat sich nichts geändert. Versuch es noch einmal, und sag es dem, der dieses Panel betreibt, wenn es weiter vorkommt.',
    'refused_server' => 'Dem Server ließen sich die neuen Grenzen nicht geben, der Dienst blieb also genau so, wie er war. Wer dieses Panel betreibt, wurde benachrichtigt.',

    // ---- was auf den Dokumenten steht ------------------------------------
    'line' => 'Wechsel von :from zu :to, für die verbleibenden :days Tage dieser Periode',
    'credit_reason' => 'Wechsel zu :name',

    // ---- und was der Betreiber erfährt -----------------------------------
    'bell_failed' => 'Ein Paketwechsel ist fehlgeschlagen, bei Bestellung :number',
    'cold_title' => 'Ein Paketwechsel erreichte das Panel, aber nicht die Node, bei Bestellung :number',
    'cold_body' => 'Der Dienst läuft auf :name, und die neuen Grenzen sind festgehalten. Die Node hat sie noch nicht übernommen und liest sie beim nächsten Start dieses Servers, bis dahin hat der Kunde also noch die alte Größe. Sieh dir die Node an.',
    'gone' => 'Das Paket, zu dem gewechselt wurde, gibt es nicht mehr.',
    'refused_by_node' => 'Der Server wollte die neuen Grenzen nicht annehmen: :why',

    // ---- einen wieder geradebiegen ---------------------------------------
    'retry' => 'Wechsel erneut versuchen',
    'retry_confirm' => 'Versucht den Paketwechsel noch einmal. Die Rechnung dafür ist schon bezahlt, es wird also nichts doppelt berechnet.',
    'retried' => 'Der Wechsel ist durchgegangen',
    'retry_failed' => 'Er ist wieder fehlgeschlagen. Der Grund steht an der Bestellung.',
];
