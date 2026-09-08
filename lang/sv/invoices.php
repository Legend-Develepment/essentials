<?php

/*
 * Svenska. Skrivet för hand.
 *
 * Fakturor: dokumentet, sidan med listan och mejlet.
 *
 * Tre läsare delar den här filen. En administratör läser tabellen och trycker
 * "markera som betald"; en kund läser dokumentet som går att skriva ut och
 * mejlet; och själva dokumentet läses månader senare av den som sköter
 * bokföringen. Det är därför doc_-raderna är torra och formella - en faktura är
 * inte platsen för tonen i resten av panelen.
 */

return [
    'title' => 'Fakturor',
    'nav_label' => 'Fakturor',
    'subheading' => 'Vad som är obetalt och vad som är betalt. Att markera en som betald här gör allt betalning skulle göra: servern byggs, en avstängd kommer tillbaka.',

    // ---- tabellen --------------------------------------------------------
    'column_number' => 'Faktura',
    'column_customer' => 'Kund',
    'column_order' => 'Beställning',
    'column_total' => 'Totalt',
    'column_state' => 'Tillstånd',
    'column_due' => 'Förfaller',

    'kind_order' => 'Första fakturan',
    'kind_renewal' => 'Förnyelse',

    'state_unpaid' => 'Obetald',
    'state_paid' => 'Betald',
    'state_cancelled' => 'Återkallad',

    'no_order' => 'Ingen beställning',
    'no_due' => 'Inget datum',
    'gone_customer' => 'Konto borttaget',
    'discount_of' => ':amount rabatt med :code',
    'paid_via' => 'genom :how',
    'emailed' => 'Skickad',
    'not_emailed' => 'Inte skickad',
    'filter_overdue' => 'Försenade',

    // ---- knapparna -------------------------------------------------------
    'open' => 'Öppna',
    'mark_paid' => 'Markera som betald',
    'mark_paid_confirm' => 'Noterar att pengarna kommit fram. Servern byggs, en avstängd startar igen och nästa förfallodag flyttas fram - precis som om en betaltjänst hade sagt det.',
    'paid' => 'Markerad som betald',
    'paid_body' => 'Allt som väntade på den här fakturan är på väg.',
    'already_paid' => 'Den var redan betald',

    'withdraw' => 'Återkalla',
    'withdraw_confirm' => 'Tar bort fakturan ur böckerna. Bara en obetald går att återkalla; en betald faktura är beviset på pengar som bytt ägare.',
    'withdrawn' => 'Återkallad',
    'withdraw_refused' => 'Bara en obetald faktura går att återkalla',

    'empty' => 'Inga fakturor än',
    'empty_body' => 'En skrivs så fort någon köper, och sedan en per period för allt som förnyas.',

    // ---- dokumentet ------------------------------------------------------
    'doc_title' => 'Faktura',
    'doc_number' => 'Nummer',
    'doc_issued' => 'Utfärdad',
    'doc_due' => 'Förfallodag',
    'doc_paid_on' => 'Betald',
    'doc_billed_to' => 'Fakturerad till',
    'doc_from' => 'Från',
    'doc_description' => 'Beskrivning',
    'doc_amount' => 'Belopp',
    'doc_subtotal' => 'Delsumma',
    'doc_discount' => 'Rabatt',
    'doc_total' => 'Totalt',
    'doc_how_to_pay' => 'Så betalar du',
    'doc_print' => 'Skriv ut eller spara som PDF',
    'doc_back' => 'Tillbaka till panelen',

    // ---- mejlet ----------------------------------------------------------
    'mail_subject' => 'Faktura :number',
    'mail_hello' => 'Hej :name,',
    'mail_intro' => 'Här är faktura :number.',
    'mail_open' => 'Öppna fakturan',
    'mail_foot' => 'Du kan läsa den här fakturan när som helst på din faktureringssida.',

    // ---- klockan ---------------------------------------------------------
    'bell_new' => 'Faktura :number',
    'bell_new_body' => ':total ska betalas. Öppna din faktureringssida för att betala.',
    'bell_reminder' => 'Faktura :number har passerat sitt datum',
    'bell_reminder_body' => 'Den står fortfarande öppen på :total. Servern den betalar för stannar :date om den inte är betald då, och ingenting på den tas bort när det händer.',
];
