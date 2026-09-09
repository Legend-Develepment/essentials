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
    'grace_helper' => 'En obetald faktura bortom detta stänger av servern — Pelicans egen avstängning, hävd i samma stund fakturan betalas. Själva avstängningen tar inte bort något.',
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

    /* ---------------------------------------------------------------------
     * Själva butiken, härifrån och ner.
     *
     * En helt annan läsare: någon som köper en server, som kanske aldrig hört
     * talas om Pelican och inte vet vad en egg är. Inget här nere använder
     * panelens ord, och varje mening svarar på den fråga en kund faktiskt har
     * på den platsen på sidan.
     * ------------------------------------------------------------------- */

    // ---- butiken ---------------------------------------------------------
    'store_title' => 'Butik',
    'store_nav_label' => 'Butik',
    'store_subheading' => 'Välj en server. Den skapas åt dig så fort fakturan är betald.',
    'store_empty' => 'Ingenting är till salu just nu',
    'store_empty_body' => 'Kom tillbaka senare, eller fråga den som sköter den här panelen.',

    'buy' => 'Köp',
    'sold_out' => 'Slutsåld',
    'plus_setup' => 'plus :amount en gång',

    'spec_memory' => ':amount MiB minne',
    'spec_disk' => ':amount MiB disk',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count säkerhetskopior',
    'spec_databases' => ':count databaser',

    // ---- den publika sidan -----------------------------------------------
    'public_empty' => 'Ingenting är till salu just nu',
    'public_empty_body' => 'Kom tillbaka senare.',
    'to_panel' => 'Logga in',
    'terms' => 'Villkor',
    'sign_in_note' => 'Välj en server nedan. Du loggar in för att slutföra, och den skapas när fakturan är betald.',
    'to_account' => 'Mitt konto',
    'filter_all' => 'Allt',
    'filter_label' => 'Visa',
    'includes' => 'Ingår',
    'public_count' => ':count till salu',

    // ---- beställningen ---------------------------------------------------
    'checkout_title' => 'Beställning',
    'tax_line' => 'Moms (:rate%)',
    'coupon' => 'Rabattkod',
    'asks' => 'Om din server',
    'upload_default' => 'Din fil',
    'upload_help' => 'En zip-fil. Den läggs in i din server när den skapas.',
    'upload_busy' => 'Laddar upp…',
    'what_is_this' => 'Vad är det?',
    'leave_as_is' => 'Lämna som det är',
    'asks_optional' => 'Allt det här är valfritt. Det du lämnar i fred behåller det servermallen redan hade.',
    'refused_no_file' => 'Det här paketet behöver en fil, och ingen valdes.',
    'refused_not_zip' => 'Det måste vara en zip-fil.',
    'refused_too_big' => 'Den filen är för stor för den här panelen att ta emot.',
    'coupon_placeholder' => 'Om du har en',
    'coupon_bad' => 'Den koden gäller inte här.',
    'coupon_good' => 'Koden är använd.',
    'agree' => 'Jag godtar',
    'place_order' => 'Lägg beställningen',
    'place_order_note' => 'Det här skriver en faktura. Ingenting dras förrän du betalar, och servern skapas när den är betald.',
    'back_to_store' => 'Tillbaka till butiken',

    'placed' => 'Beställningen är lagd',
    'placed_body' => 'Faktura :number väntar på din faktureringssida.',

    'refused' => 'Det gick inte att köpa',
    'refused_gone' => 'Det är inte till salu längre.',
    'refused_sold_out' => 'Den sista är borta.',
    'refused_bad_coupon' => 'Rabattkoden gäller inte för det här.',
    'refused_failed' => 'Något gick fel när beställningen skulle skrivas. Ingenting har dragits. Försök igen, och säg till den som sköter panelen om det fortsätter.',

    // ---- fakturering -----------------------------------------------------
    'billing_title' => 'Fakturering',
    'billing_nav_label' => 'Fakturering',
    'billing_subheading' => 'Vad du har köpt och vad du är skyldig.',
    'your_orders' => 'Dina beställningar',
    'your_invoices' => 'Dina fakturor',
    'no_orders' => 'Du har inte köpt något än',
    'no_orders_body' => 'Allt du köper står här med sin server och sina datum.',
    'no_invoices' => 'Inga fakturor än',
    'to_store' => 'Gå till butiken',
    'renews' => 'Förnyas',
    'server_installing' => 'Sätts fortfarande upp. Den startar av sig själv när det är klart.',
    'server_failed' => 'Uppsättningen blev inte klar. Den som sköter den här panelen har fått veta.',
    'server_suspended' => 'Stoppad av panelen. Ingenting på den har tagits bort.',
    'server_restoring' => 'En säkerhetskopia läggs tillbaka. Det tar några minuter.',
    'give' => 'Avsluta den här tjänsten',
    'give_end' => 'Avsluta den på det datumet',
    'give_end_on' => 'Avsluta den :date',
    'give_end_body' => 'Den kör vidare till :date och du faktureras inte för den igen. Allt på den tas bort den dagen, så kopiera ut det du vill behålla.',
    'give_end_open' => 'Det finns inget datum att gå mot, så att avsluta den här stoppar faktureringen och lämnar servern där den är tills någon tar bort den.',
    'give_end_confirm' => 'Avsluta den här tjänsten :date? Den kör vidare till dess och faktureras inte igen.',
    'give_now' => 'Stoppa och ta bort den nu',
    'give_now_confirm' => 'Ta bort den här servern nu, med sina filer, sina databaser och sina säkerhetskopior? Det går inte att ångra, och du får inga pengar tillbaka för resten av perioden du har betalat för.',
    'gave_end' => 'Uppsägning mottagen',
    'gave_end_body' => 'Den kör till datumet på kortet och faktureras inte igen. Ingenting tas bort före dess.',
    'gave_now' => 'Borta',
    'gave_now_body' => 'Servern har tagits bort och du faktureras inte för den igen.',
    'gave_refused' => 'Det gick inte',
    'gave_refused_body' => 'Ingenting ändrades. Ladda om sidan, och fråga den som sköter den här panelen om det fortsätter.',
    'ask_how_to_pay' => 'Fråga den som sköter den här panelen hur du betalar. De har inte skrivit det här än.',
    'order_pending' => 'Väntar på att fakturan betalas. Direkt efter det skapas servern.',
    'order_suspended' => 'Stoppad på grund av en obetald faktura. Betalar du den startar servern igen - ingenting har tagits bort.',
    'order_ending' => 'Slutar :date. Den faktureras inte igen, och allt på den tas bort den dagen.',
    'order_ending_open' => 'Avbruten. Den faktureras inte igen och kör vidare tills den tas bort.',

    // ---- att betala ------------------------------------------------------
    'pay_with' => 'Betala med',
    'pay_now' => 'Betala',
    'pay_description' => 'Faktura :number',
    'pay_thanks' => 'Tack. Fakturan är betald.',
    'pay_pending' => 'Leverantören har inte bekräftat det än. Sidan uppdateras så fort de gör det.',
    'pay_refused' => 'Det startade inte',
    'pay_refused_body' => 'Betalningen gick inte att öppna. Prova en annan väg, eller fråga den som sköter den här panelen.',
    'check' => 'Testa betalnycklarna',
    'check_ok' => 'fungerar',
    'check_bad' => 'nekade',
    'check_good' => 'Nycklarna fungerar och den här leverantören svarar.',
    'check_off' => 'Avstängd, så det fanns ingenting att fråga om.',
    'check_none' => 'Ingen leverantör är påslagen',
    'check_none_body' => 'Slå på en nedan, fyll i dess nycklar, spara och tryck här igen.',
    'check_no_key' => 'Det finns inga nycklar ifyllda för den här.',
    'check_refused' => 'Leverantören nekade de här nycklarna. Den svarade HTTP :status.',
    'check_paypal' => 'PayPal nekade de här nycklarna. De svarade HTTP :status, och den här panelen är inställd på :where — nycklarna måste komma från den fliken i deras panel.',
    'check_sandbox' => 'testmiljö',
    'check_live' => 'skarpt läge',
    'check_ellipsis' => 'Client ID slutar med en punkt, vilket betyder att den förkortade texten i deras panel kopierades i stället för hela nyckeln. Använd kopieringsknappen bredvid den och spara igen.',
    'gateway_mollie' => 'Mollie',

    // ---- leverantörens inställningar -------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Tar iDEAL, kort, Bancontact och resten via ett konto. Test och skarpt läge är samma inställning: nyckeln säger själv vilket konto den hör till.',
    'mollie_on' => 'Erbjud Mollie',
    'mollie_on_helper' => 'Av tar bort knappen från varje faktura. Det som är betalt förblir betalt.',
    'mollie_key' => 'API-nyckel',
    'mollie_key_helper' => 'Från Developers-delen i din Mollie-panel. Den skrivs aldrig in i en exporterad inställningsfil.',
    'mollie_hook' => 'Webhook-adress',
    'mollie_hook_helper' => 'Mollie hör av sig till :url - din panel måste gå att nå där från internet.',

    'gateway_stripe' => 'Stripe',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Tar kort på en sida som Stripe själv ritar, så ett kortnummer når aldrig den här panelen. Test och skarpt läge ligger i nyckelns prefix, inte i en brytare.',
    'stripe_on' => 'Erbjud Stripe',
    'stripe_on_helper' => 'Av tar bort knappen från varje faktura. Det som är betalt förblir betalt.',
    'stripe_key' => 'Hemlig nyckel',
    'stripe_key_helper' => 'Den som börjar med sk_, från Developers, API keys. Skrivs aldrig in i en exporterad inställningsfil.',
    'stripe_hook' => 'Signeringshemlighet',
    'stripe_hook_key_helper' => 'Det whsec_-värde Stripe visar när du lägger till adressen nedan. Utan det går deras meddelanden inte att bevisa äkta, och de ignoreras.',
    'stripe_hook_helper' => 'Lägg till :url som endpoint under Developers, webhooks, för händelsen checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Den enda leverantören där pengarna rör sig när kunden kommer tillbaka i stället för medan de fortfarande är hos PayPal - en stängd flik lämnar alltså en obetald faktura och inte en förlorad betalning.',
    'paypal_on' => 'Erbjud PayPal',
    'paypal_on_helper' => 'Av tar bort knappen från varje faktura. Det som är betalt förblir betalt.',
    'paypal_sandbox' => 'Testmiljö',
    'paypal_sandbox_helper' => 'Pratar med PayPals testkonto i stället för det riktiga. Deras client id ser likadana ut i båda fallen, och det är just därför den här brytaren finns.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Från appen du skapade under Apps & Credentials. Se till att fliken stämmer med brytaren ovanför.',
    'paypal_secret_helper' => 'Bredvid client ID, bakom Show. Skrivs aldrig in i en exporterad inställningsfil.',
    'paypal_hook' => 'Webhook-ID',
    'paypal_hook_id_helper' => 'Det ID PayPal ger webhooken när du lagt till den - inte adressen. Utan det går deras meddelanden inte att kontrollera hos dem, och de ignoreras.',
    'paypal_hook_helper' => 'Lägg till :url som webhook på den appen, för PAYMENT.CAPTURE.COMPLETED, och klistra in det ID den får här.',

    // ---- betalsidan ------------------------------------------------------
    'pay_title' => 'Betala',
    'pay_subheading' => 'Vad du är skyldig, och sätten att göra upp det på.',
    'pay_choose' => 'Hur vill du betala?',
    'pay_choose_body' => 'Vad du än väljer avslutar du på deras egen sida och kommer tillbaka hit direkt efteråt.',
    'pay_safe' => 'Du skickas till leverantören för att betala. Dina kortuppgifter når aldrig den här panelen.',
    'pay_no_ways' => 'Så fort pengarna kommit in markeras fakturan betald och din server sätts upp.',
    'free' => 'Inget att betala',
    'free_body' => 'En rabattkod täckte hela den här, så det finns inget att betala. Tryck på knappen så är det klart.',
    'free_go' => 'Slutför',
    'free_done' => 'Klart',
    'free_done_body' => 'Det fanns inget att betala, så fakturan är avslutad. Din server sätts upp nu.',
    'pay_gone' => 'Den fakturan finns inte',
    'pay_gone_body' => 'Den kan ha återkallats, eller så är adressen fel.',
    'pay_already' => 'Den här är betald',
    'pay_already_body' => 'Inget mer att göra. Allt som väntade på den är redan på väg.',
    'pay_withdrawn' => 'Den här återkallades',
    'pay_withdrawn_body' => 'Den är ute ur böckerna och ska inte betalas. Fråga den som sköter panelen om det ser fel ut.',
    'back_to_billing' => 'Tillbaka till fakturering',

    'gateway_mollie_note' => 'iDEAL, Bancontact, kort och mer',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Ditt PayPal-saldo, eller ett kort via PayPal',

    // ---- tjänster och fakturor, var för sig ------------------------------
    'services_title' => 'Mina tjänster',
    'services_nav_label' => 'Mina tjänster',
    'services_subheading' => 'Det du betalar för, och servern var och en blev till.',
    'open_server' => 'Öppna servern',
    'no_server_yet' => 'Sätts upp',

    'invoices_title' => 'Fakturor',
    'invoices_subheading' => 'Vad du har fakturerats för, och vad som står kvar att betala.',
    'no_invoices_body' => 'Allt du köper faktureras här, och blir kvar här efter att det betalats.',

    // ---- butiken som startsida -------------------------------------------
    'section_landing' => 'Var butiken sitter',
    'section_landing_helper' => 'Om butiken är panelens ytterdörr, för kunder och för folk som inte har loggat in.',
    'landing' => 'Öppna butiken först',
    'landing_helper' => 'På är butiken den första sidan efter inloggning, och serverlistan flyttar sig bredvid. Dina tjänster och dina fakturor är fortfarande ett klick bort, i butikens huvud och i kontomenyn. Någon som inte har loggat in får den offentliga butiken i stället för inloggningsrutan, och blir ombedd att logga in först när de valt ett paket - så det här kräver att den offentliga butikssidan också är påslagen. Av öppnar panelen på serverlistan så som Pelican ritar den, någon som inte har loggat in får inloggningsrutan, och butiken är en sida som alla andra.',
    'self_cancel' => 'Låt kunder avsluta sin egen tjänst',
    'self_cancel_helper' => 'Två vägar ut på deras tjänstesida: avsluta den på avtalsdatumet, vilket stoppar faktureringen och tar bort servern den dag de fått besked om, eller stoppa den nu, vilket tar bort den direkt. Båda är samma knappar som du har på sidan Beställningar. Av erbjuds ingendera, och att avsluta en tjänst är något de får be dig om.',
];
