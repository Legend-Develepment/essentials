<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Müşteriler: mağaza, ama satıra değil insana dönük.
 *
 * Siparişler, faturalar ve ödemeler; her biri olanların bir listesi. Bu sayfa,
 * bir talebi yanıtlayanın gerçekten sorduğu soruyu sorar: bu kim, elinde ne
 * var, ne ödemiş ve geriye ne kalmış.
 */

return [
    'title' => 'Müşteriler',
    'nav_label' => 'Müşteriler',
    'subheading' => 'Bir şey satın almış herkes; ellerinde ne olduğu, ne ödedikleri ve hâlâ ne borçlu oldukları ile.',

    // ---- tablo -----------------------------------------------------------
    'column_customer' => 'Müşteri',
    'column_services' => 'Hizmetler',
    'column_spent' => 'Ödenen',
    'column_outstanding' => 'Kalan',

    'of_orders' => ':count siparişten',
    'nothing_owed' => 'Yok',

    'filter_owing' => 'Borcu var',
    'filter_active' => 'Etkin hizmeti var',

    // ---- içlerinden biri -------------------------------------------------
    'open' => 'Aç',
    'close' => 'Kapat',
    'servers' => 'Sunucular',
    'since' => 'Müşteri olduğu tarih',
    'their_services' => 'Hizmetler',
    'their_invoices' => 'Faturalar',
    'no_services' => 'Etkin bir şey yok, kurulmayı bekleyen de yok.',
    'no_invoices' => 'Bu hesap için hiç fatura yazılmamış.',

    'empty' => 'Henüz kimse bir şey satın almadı',
    'empty_body' => 'Burada sipariş verenler görünür, hesabı olan herkes değil - yani ilk satışla dolar.',
    'who' => 'Kim olduğu',
];
