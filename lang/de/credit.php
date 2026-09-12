<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Guthaben, Erstattungen und Gutschriften.
 *
 * Zwei Wörter werden unten überall mit Absicht auseinandergehalten.
 *
 * „Guthaben" ist Geld, das der Shop für jemanden hält. Es geht von selbst von
 * der nächsten Rechnung ab, noch bevor überhaupt um Zahlung gebeten wird.
 *
 * Eine „Erstattung" ist das Zurückgeben selbst, und dafür gibt es zwei Wege:
 * zurück auf die Karte, von der es kam, oder als Guthaben auf das Konto. Der
 * Text sagt immer, welcher von beiden gemeint ist, denn ein Kunde, dem gesagt
 * wurde „es wurde erstattet" und der dann nichts auf seinem Konto findet,
 * schreibt zu Recht.
 *
 * Eine „Gutschrift" ist das Dokument. Geschrieben wird es in beiden Fällen,
 * denn es hält fest, dass das Geld dem Shop nicht mehr zusteht - es sagt nichts
 * darüber, wohin es ging.
 */

return [
    // ---- was ein Kunde sieht ---------------------------------------------
    'yours' => 'Dein Guthaben',
    'yours_body' => 'Das geht von selbst von deiner nächsten Rechnung ab. Du musst nichts damit tun.',
    'applied' => 'Aus deinem Guthaben bezahlt',
    'payable' => 'Noch zu zahlen',

    // ---- das Kontobuch, im Kundenfenster ---------------------------------
    'held' => 'Guthaben',
    'none_held' => 'Nichts auf dem Konto',
    'movements' => 'Guthaben',
    'column' => 'Guthaben',
    'none' => 'Keines',

    // ---- welches geben ---------------------------------------------------
    'give' => 'Guthaben',
    'give_helper' => 'Auf diesem Konto liegen :held. Was du daraufsetzt, geht von selbst von der nächsten Rechnung ab. Ein negativer Betrag nimmt Guthaben wieder weg, und beide Bewegungen bleiben in der Historie stehen.',
    'amount' => 'Betrag',
    'amount_helper' => 'Ein negativer Betrag nimmt Guthaben weg, statt welches zu geben.',
    'reason' => 'Grund',
    'reason_helper' => 'Der Kunde sieht das neben dem Betrag, schreib es also für ihn und nicht für die Akte.',
    'given' => ':amount Guthaben für :who',
    'bad_amount' => 'Das ist kein Betrag.',
    'give_failed' => 'Das Guthaben wurde nicht gegeben',
    'give_failed_body' => 'Es wurde nichts geschrieben. Versuch es noch einmal, und sieh ins Log, wenn es weiter vorkommt.',
    'take_failed' => 'Das Guthaben wurde nicht abgezogen',
    'take_failed_body' => 'Auf dem Konto liegt weniger, als du abziehen wolltest. Ein Saldo geht nie unter null.',

    // ---- was eine Bewegung sagt -----------------------------------------
    'spent_on' => 'Rechnung :number',
    'returned' => 'Zurückgelegt: die Rechnung, für die es war, ließ sich nicht schreiben',
    'note_line' => 'Gutschrift zu Rechnung :number',
    'refund_description' => 'Erstattung der Rechnung :number',

    // ---- es zurückgeben --------------------------------------------------
    'refund' => 'Erstatten',
    'refund_helper' => 'Von dieser Rechnung sind :left noch nicht zurückgegeben. Eine Gutschrift wird so oder so geschrieben, damit es auf beiden Seiten festgehalten ist.',
    'refund_amount_helper' => 'Ein Teil davon ist in Ordnung. Was übrig bleibt, lässt sich später noch zurückgeben.',
    'refund_reason_helper' => 'Das steht auf der Gutschrift, die der Kunde öffnen kann.',
    'where' => 'Wohin geht das Geld',
    'where_provider' => 'Zurück auf ihren Zahlweg',
    'where_provider_helper' => 'Der Anbieter schickt es auf die Karte oder das Konto, von dem es kam. Bis es zu sehen ist, können ein paar Tage vergehen, und er kann ablehnen - bei einer alten Zahlung oder einem Weg, der sich nicht umkehren lässt.',
    'where_balance' => 'Als Guthaben auf ihr Konto hier',
    'where_balance_helper' => 'Es wird Guthaben und geht von der nächsten Rechnung ab. Es verlässt nichts die Bank, und fehlschlagen kann es nicht.',
    'refunded' => ':amount erstattet',
    'refunded_body' => 'Gutschrift :number wurde dafür geschrieben.',
    'refund_failed' => 'Es wurde nichts erstattet',

    // ---- und warum nicht, ein Grund nach dem anderen ---------------------
    'refused_off' => 'Guthaben und Erstattungen sind für dieses Panel ausgeschaltet.',
    'refused_amount' => 'Das ist mehr, als von dieser Rechnung übrig ist.',
    'refused_no_payment' => 'Keine Zahlung auf dieser Rechnung hat noch so viel übrig, ein Anbieter hat also nichts umzukehren. Setz es stattdessen auf ihr Konto.',
    'refused_no_gateway' => 'Der Anbieter, über den das bezahlt wurde, ist nicht mehr eingeschaltet, er lässt sich also um nichts mehr bitten. Setz es stattdessen auf ihr Konto.',
    'refused_refused' => 'Der Anbieter hat abgelehnt. Das ist meist eine alte Zahlung oder ein Weg, der sich nicht umkehren lässt; der Grund, den er genannt hat, steht im Log. Setz es stattdessen auf ihr Konto.',
    'refused_note_failed' => 'Das Geld ist geflossen, aber die Gutschrift ließ sich nicht schreiben, es wurde also nichts festgehalten. Sieh ins Log, bevor du es noch einmal versuchst.',

    // ---- Geld daraufsetzen -----------------------------------------------
    'topup' => 'Guthaben aufladen',
    'topup_helper' => 'Du hast :held auf dem Konto. Was du hier dazugibst, geht von selbst von deiner nächsten Rechnung ab, und eine Rechnung, die schon offen ist, wird davon beglichen, sobald es ankommt.',
    'topup_go' => 'Weiter zur Zahlung',
    'topup_amount_helper' => 'Zwischen :least und :most.',
    'topup_bad' => 'Dieser Betrag lässt sich nicht bezahlen',
    'topup_failed' => 'Die Zahlung ließ sich nicht starten. Versuch es noch einmal, und sag es dem, der dieses Panel betreibt, wenn es weiter vorkommt.',
    'topup_line' => 'Guthaben auf das Konto gesetzt',
    'topup_reason' => 'Aufgeladen auf Rechnung :number',

    // ---- wo es zu sehen ist ----------------------------------------------
    'menu' => ':amount Guthaben',
    'held_helper' => 'Geht von selbst von deiner nächsten Rechnung ab. Aufladen kannst du auf der Rechnungsseite.',
];
