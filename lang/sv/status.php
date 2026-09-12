<?php

/*
 * Svenska. Skriven för hand.
 *
 * Den offentliga statussidan.
 *
 * Det enda det här pluginet serverar till någon som inte är inloggad, och den
 * enda sida vars ord måste läsas som om en främling ska se dem - för det ska en.
 * Ingenting här säger vilken nod, vilken ägare eller vilken adress; ett namn, om
 * det kör, och hur många som är inne.
 *
 * «Nod» förekommer bara i inställningarna; på själva den offentliga sidan står
 * det «maskin», för där läses det av någon som aldrig har hört talas om Pelican.
 */

return [
    // ---- inställningssidan -------------------------------------------------
    'title' => 'Offentlig statussida',
    'nav_label' => 'Statussida',
    'subheading' => 'En sida vem som helst kan öppna utan ett konto, som visar vilka av dina servrar som kör. Det dyker inte upp något på den förrän du nämner en server nedan.',

    'address' => 'Din statussida ligger på',
    'address_off' => 'Ingenting serveras ännu. Lägg till en server, en maskin eller en tjänst nedan och spara, så dyker adressen upp här.',

    'which' => 'Vad som offentliggörs',
    'which_helper' => 'Listan börjar tom, och ingenting är offentligt förrän något står på den. Bara servrar du redan kan öppna erbjuds.',
    'add' => 'Offentliggör en server',
    'server' => 'Server',
    'shown_as' => 'Visas som',
    'shown_as_helper' => 'Det publiken ser. Skriv det själv i stället för att låta panelen använda det riktiga namnet - «mc-prod-3 (rör ej)» är en lapp till dig själv, inte något man lägger ut på ett forum.',

    'look' => 'Ordval',
    'look_helper' => 'Allt på den här sidan läses av folk som inte har ett konto.',
    'heading' => 'Rubrik',
    'heading_helper' => 'Står det tomt används panelens eget namn.',
    'note' => 'En rad ovanför listan',
    'note_helper' => 'Till att säga vad som pågår - ett underhållsfönster, eller var man kan fråga. Vanlig text.',
    'link' => 'Länk till panelen',
    'link_helper' => 'En väg tillbaka in, längst ner på sidan. Stäng av den om du helst inte vill avslöja var din panel står.',

    'save' => 'Spara',
    'saved' => 'Sparat',
    'save_failed' => 'Ingenting sparades',
    'open' => 'Öppna sidan',

    // ---- spelarantal -------------------------------------------------------
    'counts' => 'Spelarantal',
    'counts_helper' => 'Var siffrorna bredvid en server kommer ifrån. Minecraft-servrar svarar på sin egen handskakning och ställs in under Minecraft; allt nedan gäller de spel som svarar på Valves fråga - Rust, ARK, Valheim, 7 Days to Die och det mesta annat som kör på Source eller Unreal.',
    'query_eggs' => 'Eggs som svarar på Valves fråga',
    'query_eggs_helper' => 'Kryssa i eggen för de spelen. Samma lista avgör också vilka servrar som får en Spelare-sida inne i panelen - en fråga ställd av två skäl. Ingenting frågas förrän du säger till: det här är det enda här som öppnar en anslutning från panelen rakt till en spelport, så det är ett val och inte något som börjar av sig självt. En server vars port inte går att nå från panelen visar helt enkelt inga siffror.',

    // ---- noderna -----------------------------------------------------------
    'nodes' => 'Maskiner',
    'nodes_helper' => 'Uppe eller nere, och inget annat. Inte lasten och inte hur full disken är - den som frågar om han kan spela behöver ingen kapacitetsrapport över din hårdvara, och att offentliggöra en är en karta över var det är trångt.',
    'add_node' => 'Offentliggör en maskin',
    'node' => 'Maskin',
    'node_shown_as_helper' => 'Skriv det själv. En nod heter oftast något i stil med hetzner-fsn1-01, och det är en hel mening om var dina maskiner står.',

    // ---- HTTP-övervakningar ------------------------------------------------
    'monitors' => 'Andra tjänster',
    'monitors_helper' => 'Allt annat som är värt att veta är uppe: din webbplats, ett API, en bots health-endpoint. Panelen frågar var och en av dem i samma takt som servrarna. Bara administratörer - en övervakning får den här panelen att hämta en adress, och låter man vem som helst lägga till en blir den en sond man kan rikta vart man vill.',
    'add_monitor' => 'Lägg till en tjänst',
    'monitor_name' => 'Namn',
    'monitor_url' => 'Adress',
    'monitor_url_helper' => 'Bara https. Om den här panelen med jämna mellanrum hämtade vanlig http skulle alla längs vägen veta vilka av dina tjänster som finns.',
    'monitor_expect' => 'Förväntar',
    'monitor_expect_helper' => 'Lämna tomt för «vilket svar som helst», vilket passar en webbplats som vidarebefordrar eller svarar 403 på en naken förfrågan. En siffra är till en endpoint som är skriven för att säga precis det och inget annat - sätts det för snävt står raden röd för alltid vid en tjänst det inte är något fel på.',

    // ---- sidor till användarna ---------------------------------------------
    'users' => 'Sidor till dina användare',
    'users_helper' => 'Om folk med servrar på den här panelen får offentliggöra en egen statussida.',
    'user_pages' => 'Låt användarna göra en egen',
    'user_pages_helper' => 'Var och en får en egen adress på /status/deras-namn, där bara de servrar de äger står, under de namn de själva skriver. Inga maskiner och inga andra tjänster på dem - bådadera är dina ensam. När det här är på hittar de det under Statussida i sin kontomeny, i vilken panel de än är.',

    // ---- utseendet ---------------------------------------------------------
    'every' => 'Kontrollera var',
    'every_helper' => 'Hur ofta sidan byggs om, och hur ofta den uppdaterar sig själv i webbläsaren. En sida folk tittar på under en omstart vill ha sekunder; en som är länkad från ett forum och som ingen har öppen vill ha en timme, och att fråga varje nod varje minut för dess skull är arbete gjort för ingen.',
    'every_realtime' => 'Realtid (10 sekunder)',
    'every_30s' => '30 sekunder',
    'every_1m' => '1 minut',
    'every_5m' => '5 minuter',
    'every_10m' => '10 minuter',
    'every_30m' => '30 minuter',
    'every_60m' => '60 minuter',

    'style' => 'Stil',
    'style_helper' => 'Ett av panelens egna utseenden, lagt på den här sidan: dess färg, gråtonerna byggda ur dess yta, och hur runda hörnen är. «Följ panelen» betyder den som är vald i dag, inklusive allt som ändras senare.',
    'style_mine_helper' => 'De stilar den här panelen erbjuder, lagda på din sida: en färg, gråtonerna byggda ur den, och hur runda hörnen är. Vilka stilar som står på listan bestämmer panelens ägare - samma lista du kan välja ur under Utseende. «Följ panelen» betyder den som är vald.',
    'style_panel' => 'Följ panelen',

    // ---- den egna sidan ----------------------------------------------------
    'mine_title' => 'Min statussida',
    'mine_nav_label' => 'Statussida',
    'mine_subheading' => 'En adress att ge de människor som spelar på dina servrar. Den visar de servrar du väljer, och ingenting annat om den här panelen.',
    'mine_address' => 'Din adress',
    'mine_address_helper' => 'Välj något kort. Att ändra den senare förstör varje länk någon redan har sparat.',
    'mine_address_off' => 'Välj en adress nedan och spara, så dyker din sida upp här.',
    'slug' => 'Adress',
    'slug_helper' => 'Små bokstäver, siffror och bindestreck. Tre tecken eller fler.',
    'mine_heading' => 'Rubrik',
    'mine_heading_helper' => 'Står det tomt används din adress.',
    'mine_note_helper' => 'Till att säga vad som pågår - en omstart, ett evenemang, var man hittar dig. Vanlig text, och läst av alla med länken.',
    'mine_which' => 'Dina servrar',
    'mine_which_helper' => 'Bara servrar du själv äger erbjuds. Att vara subuser någon annanstans är åtkomst till en maskin, inte rätt att offentliggöra att den finns.',
    'mine_shown_as_helper' => 'Det besökarna ser. Skriv det själv i stället för att använda namnet ur panelen, om det namnet är en lapp till dig själv.',
    'mine_look_helper' => 'Hur din sida ser ut för dem du skickar den till.',
    'mine_remove' => 'Ta ner min sida',
    'mine_remove_confirm' => 'Tar ner din sida och frigör adressen åt någon annan. Allt du har ställt in går förlorat; själva servrarna rörs inte.',
    'mine_removed' => 'Din sida är nertagen',

    'why_slug' => 'Den adressen duger inte. Små bokstäver, siffror och bindestreck, tre tecken eller fler - och ett par ord är reserverade.',
    'why_taken' => 'Den adressen har någon annan redan.',
    'why_unwritable' => 'Det gick inte att skriva. Kontrollera att storage/app tillhör den användare panelen kör som.',

    // ---- rubriker på själva sidan ------------------------------------------
    'section_servers' => 'Servrar',
    'section_nodes' => 'Maskiner',
    'section_monitors' => 'Tjänster',

    // ---- själva sidan ------------------------------------------------------
    'up' => 'Uppe',
    'down' => 'Nere',
    'starting' => 'Startar',

    /*
     * Inte «nere», och skillnaden spelar roll offentligt.
     *
     * Panelen nådde inte servern. Det är oftast en nod på underhåll eller en
     * daemon som startar om - det är inte samma sak som att servern är avstängd,
     * och att tala om för hundra spelare att deras server är nere medan den kör
     * är värre än att erkänna att man inte vet.
     */
    'unknown' => 'Okänt',

    'players' => 'Spelare',
    'online_now' => 'spelar just nu',
    'checked' => 'Kontrollerad',
    'next_check' => 'till nästa kontroll',
    'just_now' => 'nyss',
    'seconds_ago' => 'för :count sekunder sedan',
    'panel' => 'Logga in',

    'all_up' => 'Allt kör.',
    'some_down' => 'Något kör inte.',
    'empty' => 'Ingenting offentliggörs här ännu.',
];
