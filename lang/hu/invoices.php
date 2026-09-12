<?php

/*
 * Magyar. Kézzel írva.
 *
 * Számlák: a dokumentum, a listázó oldal és a levél.
 *
 * Három olvasó osztozik ezen a fájlon. Az adminisztrátor a táblázatot olvassa
 * és a „fizetettnek jelöl" gombot nyomja; a vásárló a nyomtatható dokumentumot
 * és a levelet olvassa; magát a dokumentumot pedig hónapokkal később az, aki a
 * könyvelést viszi. Emiatt az utóbbi miatt szárazak és hivatalosak a doc_
 * sorok - egy számla nem a panel többi részének hangnemére való hely.
 */

return [
    'title' => 'Számlák',
    'nav_label' => 'Számlák',
    'subheading' => 'Mi van hátra és mi van kifizetve. Itt fizetettnek jelölni mindent megtesz, amit a fizetés tenne: a szerver megépül, a felfüggesztett visszatér.',

    // ---- a táblázat ------------------------------------------------------
    'column_number' => 'Számla',
    'column_customer' => 'Vásárló',
    'column_order' => 'Rendelés',
    'column_total' => 'Összesen',
    'column_state' => 'Állapot',
    'column_due' => 'Esedékes',

    'kind_order' => 'Első számla',
    'kind_renewal' => 'Megújítás',
    'kind_credit' => 'Jóváíró számla',
    'kind_upgrade' => 'Csomagcsere',
    'kind_topup' => 'Egyenlegfeltöltés',
    'kind_addon' => 'Extra',

    'state_unpaid' => 'Kifizetetlen',
    'state_paid' => 'Kifizetve',
    'state_cancelled' => 'Visszavonva',

    'no_order' => 'Nincs rendelés',
    'order_count' => ':count szolgáltatás',
    'no_due' => 'Nincs dátum',
    'gone_customer' => 'Fiók törölve',
    'discount_of' => ':amount kedvezmény a :code kóddal',
    'paid_via' => 'ezen keresztül: :how',
    'column_attempts' => 'Fizetés',
    'paid_by' => 'fizetve: :how',
    'paid_by_unknown' => 'kifizetve',
    'paid_by_manual' => 'kézzel',
    'paid_by_free' => 'nincs mit fizetni',
    'attempts_none' => 'nincs próbálkozás',
    'attempts_open' => ':count próbálkozás - :how',
    'attempt_last' => 'utolsó: :when, :state',
    'attempt_open' => 'nincs befejezve',
    'attempt_paid' => 'kifizetve',
    'attempt_cancelled' => 'megszakítva',
    'attempt_failed' => 'meghiúsult',
    'emailed' => 'Elküldve',
    'not_emailed' => 'Nincs elküldve',
    'filter_overdue' => 'Lejárt',

    // ---- a gombok --------------------------------------------------------
    'open' => 'Megnyitás',
    'mark_paid' => 'Fizetettnek jelöl',
    'mark_paid_confirm' => 'Rögzíti, hogy a pénz megérkezett. A szerver megépül, a felfüggesztett újraindul, a következő esedékesség pedig előrébb lép - pontosan úgy, mintha egy fizetési szolgáltató mondta volna.',
    'paid' => 'Fizetettnek jelölve',
    'paid_body' => 'Minden, ami erre a számlára várt, úton van.',
    'already_paid' => 'Már ki volt fizetve',

    'withdraw' => 'Visszavonás',
    'withdraw_confirm' => 'Kiveszi a számlát a könyvekből. Csak kifizetetlent lehet visszavonni; egy kifizetett számla gazdát cserélt pénz nyoma.',
    'withdrawn' => 'Visszavonva',
    'withdraw_refused' => 'Csak kifizetetlen számlát lehet visszavonni',

    'empty' => 'Még nincsenek számlák',
    'empty_body' => 'Az első akkor íródik, amint valaki vásárol, utána pedig időszakonként egy mindenre, ami megújul.',

    // ---- a dokumentum ----------------------------------------------------
    'doc_title' => 'Számla',
    'doc_number' => 'Sorszám',
    'doc_issued' => 'Kelt',
    'doc_due' => 'Fizetési határidő',
    'doc_paid_on' => 'Kifizetve',
    'doc_billed_to' => 'Vevő',
    'doc_from' => 'Eladó',
    'doc_vat' => 'Adószám',
    'doc_coc' => 'Cégjegyzékszám',
    'doc_description' => 'Megnevezés',
    'doc_amount' => 'Összeg',
    'doc_subtotal' => 'Nettó',
    'doc_discount' => 'Kedvezmény',
    'doc_total' => 'Összesen',
    'doc_how_to_pay' => 'Hogyan fizess',
    'doc_print' => 'Nyomtatás vagy mentés PDF-be',
    'doc_back' => 'Vissza a panelre',

    // ---- a levél ---------------------------------------------------------
    'mail_subject' => ':number számla',
    'mail_hello' => 'Szia :name!',
    'mail_intro' => 'Itt a(z) :number számla.',
    'mail_open' => 'Számla megnyitása',
    'mail_foot' => 'Ezt a számlát bármikor újraolvashatod a számlázási oldaladon.',

    // ---- a csengő --------------------------------------------------------
    'bell_new' => ':number számla',
    'bell_new_body' => ':total van hátra. Nyisd meg a számlázási oldaladat a fizetéshez.',
    'bell_reminder' => ':number számla lejárt',
    'bell_reminder_body' => 'Még mindig nyitva van :total értékben. A szerver, amelyet fizet, :date napon leáll, ha addig nem fizetik ki, és semmi sem törlődik róla, amikor ez megtörténik.',
];
