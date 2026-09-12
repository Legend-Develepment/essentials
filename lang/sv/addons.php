<?php

/*
 * Svenska. Skriven för hand.
 *
 * Tillägg som säljs vid sidan av ett paket.
 *
 * Två ord hålls isär här. Vad ett tillägg *kostar* är dess pris, och det är det
 * som debiteras varje gång. Vad det *kostar i dag* är en del av det, för den
 * som köper ett mitt i en månad betalar för en halv månad av det. Orden som
 * kunden läser säger alltid vilket av de två som menas.
 *
 * «Lägger inte till något på servern» är ett riktigt svar och sägs rakt ut i
 * stället för att lämnas tomt, för prioriterad support är en fullt vanlig sak
 * att sälja och en tom ruta läser sig som ett misstag.
 */

return [
    'title' => 'Tillägg',
    'nav_label' => 'Tillägg',
    'subheading' => 'Sådant som säljs vid sidan av ett paket: mer minne, en säkerhetskopia till, eller något som bara är en rad på fakturan.',

    // ---- tabellen ---------------------------------------------------------
    'column_name' => 'Tillägg',
    'column_price' => 'Pris',
    'column_adds' => 'Lägger till',
    'column_sold' => 'I bruk',
    'column_live' => 'Till salu',
    'adds_nothing' => 'Ingenting på servern',

    // ---- formuläret -------------------------------------------------------
    'section_what' => 'Vad det är',
    'section_what_helper' => 'Namnet och priset kunden ser, och vilka paket det går att köpa till.',
    'name' => 'Namn',
    'price' => 'Pris',
    'price_helper' => 'Vad det kostar varje gång det debiteras. Köps det mitt i en period betalar kunden en del av det här, och hela från nästa förnyelse.',
    'billing' => 'Debiteras',
    'billing_helper' => 'Med tjänsten betyder att det kommer tillbaka vid varje förnyelse, så länge de behåller det. En gång betyder att det debiteras på den faktura som först bär det och aldrig mer.',
    'billing_with' => 'Vid varje förnyelse',
    'billing_once' => 'En gång',
    'max' => 'Flest per tjänst',
    'max_helper' => 'Hur många av det här någon får ha. Ett är det vanliga; höj det för något som säljs per gigabyte.',
    'description' => 'Beskrivning',
    'description_helper' => 'En rad under namnet i kassan. Säg vad det gör i stället för vad det heter.',
    'packages' => 'Paket',
    'packages_helper' => 'Vilka paket det här går att köpa till. Inget ikryssat betyder alla, vilket ett supportalternativ eller en säkerhetskopieplats oftast är.',

    'section_adds' => 'Vad det lägger till på servern',
    'section_adds_helper' => 'De här läggs till det paketet redan ger, de sätts inte i stället för det: 4096 i minne gör servern 4 GiB större. Två av samma tillägg räknas ihop. Lämna dem alla på noll för något som bara är en rad på fakturan. Ett negativt tal tar bort något, vilket är tillåtet och ibland är precis vad någon vill.',
    'sort' => 'Ordning',
    'sort_helper' => 'Lägre kommer först i kassan. Lika tal faller tillbaka på priset.',
    'live' => 'Till salu',
    'live_helper' => 'Av erbjuds det ingenstans. Den som redan har det behåller det och fortsätter faktureras för det.',

    // ---- knapparna --------------------------------------------------------
    'new' => 'Nytt tillägg',
    'edit' => 'Redigera',
    'delete' => 'Ta bort',
    'delete_confirm' => 'Ingen har det här. Att ta bort det tar bort det ur listan för gott.',
    'delete_sold' => ':count tjänster har det här. De behåller det, behåller gränserna det gav dem och fortsätter faktureras för det - det som går är raden i listan, så att ingen ny kan köpa det.',
    'go_live' => 'Lägg ut till försäljning',
    'go_offline' => 'Ta bort från försäljning',
    'saved' => 'Sparat',
    'deleted' => 'Tillägget är borta',
    'save_failed' => 'Inte sparat',
    'save_failed_body' => 'Ingenting skrevs. Försök igen, och titta i loggen om det fortsätter.',
    'invalid' => 'Ett tillägg behöver ett namn och ett pris.',
    'empty' => 'Inga tillägg än',
    'empty_body' => 'Ett tillägg är något som säljs vid sidan av ett paket: en gigabyte till, en andra säkerhetskopieplats, eller en tjänst som inte lägger till något alls på servern.',

    // ---- vad en kund ser --------------------------------------------------
    'choose' => 'Tillägg',
    'choose_helper' => 'Valfria, och du kan lägga till eller ta bort dem senare.',
    'yours' => 'Tillägg på den här tjänsten',
    'add' => 'Lägg till ett tillägg',
    'add_helper' => 'Du betalar för det som är kvar av den här perioden nu, och hela priset från nästa förnyelse.',
    'add_to' => 'Lägg till :name',
    'add_confirm' => 'Lägga till :name på den här tjänsten?',
    'drop' => 'Ta bort',
    'drop_confirm' => 'Ta bort :name? Den oanvända delen av det du betalat går tillbaka till ditt konto, och din server ändras med en gång.',
    'costs_now' => ':amount nu',
    'free_now' => 'Inget att betala nu',
    'then' => 'sedan :amount per förnyelse',
    'once_only' => ':amount, en gång',
    'each' => 'styck',
    'added' => ':name tillagt',
    'added_body' => 'Din server har fått det tillägget ger.',
    'dropped' => ':name borttaget',
    'dropped_body' => 'Det du betalat för och inte använt står på ditt konto.',

    // ---- och när det inte går ---------------------------------------------
    'refused' => 'Det gick inte att göra',
    'refused_off' => 'Tillägg är avstängda för den här panelen.',
    'refused_not_active' => 'Bara en körande tjänst går att lägga tillägg på.',
    'refused_gone' => 'Det tillägget är inte till salu längre.',
    'refused_wrong_package' => 'Det tillägget säljs inte till det här paketet.',
    'refused_enough' => 'Du har redan så många av dem som den här tjänsten får ha.',
    'refused_failed' => 'Ingenting skrevs ner, så ingenting har ändrats. Försök igen, och säg till den som sköter panelen om det fortsätter.',
    'refused_server' => 'Servern ville inte ta de nya gränserna, så ingenting ändrades och ingenting debiterades.',
    'refused_not_yours' => 'Det tillägget finns inte på den här tjänsten.',

    // ---- vad dokumenten säger ---------------------------------------------
    'line' => ':name × :many, för de :days dagar som är kvar av perioden',
    'credit_reason' => 'Borttaget: :name',
    'bell_failed' => 'Ett tillägg gick inte att ge servern på beställning :number',

    // ---- enheter, till administratörens tabell ----------------------------
    'unit_memory' => 'MiB minne',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disk',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'databaser',
    'unit_allocation_limit' => 'allokeringar',
    'unit_backup_limit' => 'säkerhetskopior',
];
