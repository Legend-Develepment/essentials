<?php

/*
 * Svenska. Skriven för hand.
 *
 * Butikens inställningar, och senare butiken själv.
 *
 * Två läsare delar den här filen med avsikt. Inställningshalvan läses av
 * administratören; den offentliga halvan och kundhalvan - som tillkommer allt
 * eftersom butiken växer - läses av folk som kanske aldrig hört talas om
 * Pelican, och varje mening där måste vara skriven för dem.
 */

return [
    'title' => 'Butiksinställningar',
    'nav_label' => 'Butiksinställningar',
    'subheading' => 'Valutan, momsen, hur fakturor numreras och vad den offentliga sidan säger. Det som är till salu står på sidan Paket.',

    // ---- var den finns ---------------------------------------------------
    'address' => 'Den offentliga butiken finns på',
    'address_off' => 'Den offentliga sidan är avstängd. Slå på «Offentlig butikssida» i funktionslistan på sidan Essentials-inställningar, så svarar den på :url.',

    // ---- allmänt ---------------------------------------------------------
    'section_general' => 'Pengar',
    'section_general_helper' => 'En valuta för hela butiken. Varje pris på varje paket är ett tal i den.',
    'currency' => 'Valuta',
    'currency_helper' => 'Att ändra den räknar inte om något: priserna på paketen är tal, och efter en ändring är de tal i den nya valutan.',
    'tax' => 'Moms',
    'tax_helper' => 'En procentsats som läggs på varje faktura som en egen rad. Priserna på paketen är utan moms. Noll för ingen.',
    'tax_suffix' => '%',
    'prefix' => 'Fakturanummer börjar med',
    'prefix_helper' => 'Följt av ett tal som räknar uppåt. INV- ger INV-000001.',

    // ---- förnyelser ------------------------------------------------------
    'section_renewals' => 'Förnyelser',
    'section_renewals_helper' => 'För paket som faktureras per månad, kvartal eller år. Ett engångspaket rörs aldrig av det här.',
    'notice_days' => 'Fakturera så här många dagar innan perioden tar slut',
    'notice_days_helper' => 'När nästa faktura görs och kunden får veta om den.',
    'grace' => 'Stäng av så här många dagar efter att en faktura förfallit',
    'grace_helper' => 'En obetald faktura bortom detta stänger av servern — Pelicans egen avstängning, hävd i samma stund fakturan betalas. Butiken tar aldrig bort något.',
    'days' => 'dagar',

    // ---- den offentliga sidan --------------------------------------------
    'section_public' => 'Den offentliga sidan',
    'section_public_helper' => 'Läses av folk utan konto. Om den över huvud taget visas avgörs av brytaren «Offentlig butikssida» i funktionslistan.',
    'heading' => 'Rubrik',
    'heading_helper' => 'Lämnas den tom används panelens eget namn.',
    'note' => 'En rad ovanför paketen',
    'note_helper' => 'För att säga vem du är, eller vad ett köp ger någon. Ren text.',
    'terms_url' => 'Villkor',
    'terms_url_helper' => 'En https-adress. Är den satt innebär ett köp att kryssa i en ruta som pekar på den.',

    // ---- betala för hand -------------------------------------------------
    'section_manual' => 'Betalning utan leverantör',
    'section_manual_helper' => 'Visas på en obetald faktura så länge ingen betalleverantör är påslagen: bankuppgifter, eller vart pengarna ska skickas. Ren text.',
    'pay_note' => 'Så betalar man',
    'pay_note_helper' => 'Lämna den tom, så säger en obetald faktura bara att den är obetald.',

    // ---- knapparna -------------------------------------------------------
    'save' => 'Spara',
    'saved' => 'Sparat',
    'save_failed' => 'Inget sparades',
];
