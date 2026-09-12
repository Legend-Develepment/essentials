<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Subuser», «Wings», «SFTP», «cron» och «root admin» står kvar: det är orden i
 * Pelican och på värden, och den som letar upp raden letar efter dem.
 */

return [
    'nav_label' => 'Serveråtkomst',
    'title' => 'Servrar per roll',
    'subheading' => 'Ge alla som har en roll åtkomst till samma servrar.',

    /*
     * Sagt före allt annat på sidan, för det här är den enda funktionen här som
     * skriver till en tabell Pelican äger.
     */
    'more' => 'Så här fungerar det',
    'warning' => 'Det här fungerar genom att hålla Pelicans egna subusers uppdaterade - samma rader som du skulle lägga till för hand på en servers Users-sida, och det är dem serverlistan, behörighetskontrollerna och Wings alla läser. Det rör bara rader det självt har skapat: allt du har lagt till för hand ändras aldrig och tas aldrig bort. Ingen får ett mejl när en roll ger dem en server. Att ta bort åtkomst återkallar även deras SFTP, vilket kräver den queue worker Pelican redan ber om.',

    'never' => 'Ingenting har stämts av ännu. Spara en koppling nedan så sker det direkt, och varje minut på panelens egen cron därefter.',
    'timing' => 'Åtkomst tas bort i samma stund som den ska: den som förlorar en roll förlorar servrarna vid allra nästa sidladdning. Att ge kan ta upp till en minut, för det är svepningen som letar efter dem som inte använder panelen just nu.',
    'last_run' => 'Senaste körningen för :ago sekunder sedan: :added tillagda, :removed borttagna, :held kvar.',
    'capped' => 'För mycket på en gång - :pairs tilldelningar, och gränsen är :max. Ingenting skrevs. Smalna av en koppling: en roll med femtio personer och tjugo servrar är tusen tilldelningar helt på egen hand.',

    'which' => 'Kopplingarna',
    'which_helper' => 'En roll, de servrar alla som har den ska nå, och vad de får göra där. Den som har två roller får allt bådas ger. Serverägare och root admins hoppas över - de har redan mer än det här kunde ge dem.',
    'add' => 'Lägg till en roll',

    'role' => 'Roll',
    'role_helper' => 'Alla som har den, även de som får den senare.',
    'servers' => 'Servrar',
    'servers_helper' => 'De servrar de får. Att ta bort en här tar bort den åtkomsten igen.',

    'permissions' => 'Vad de får göra',
    'permissions_helper' => 'Pelicans egna subuser-behörigheter. Lämna dem som de är för en vettig uppsättning: konsolen, strömknapparna, filer, säkerhetskopior och aktivitetsloggen - och ingenting som ändrar servern, dess användare, dess databaser eller dess allokeringar. Connect to websocket ingår alltid, för utan den ansluter konsolsidan till ingenting.',

    'save' => 'Spara och tillämpa',
    'saved' => 'Sparat',
    'saved_body' => ':added tilldelade, :removed återtagna.',
    'save_failed' => 'Det gick inte att spara',
    'save_failed_disk' => 'Listan kunde inte skrivas till storage. Kontrollera att storage/app tillhör den användare panelen kör som.',

    'revoke' => 'Ta tillbaka allt',
    'revoke_confirm' => 'Ta bort allt det här har gett?',
    'revoke_confirm_helper' => 'Varje subuser-rad den här sidan har skapat, på varje server, för alla - och deras SFTP med den. Rader du har lagt till för hand rörs inte. Kopplingarna nedan står kvar, så nästa sparning eller nästa timer skulle ge dem igen: töm listan först om du menar det på riktigt.',
    'revoked' => ':count borttagna',
    'revoked_body' => 'Bara rader den här sidan hade skapat. Allt som lagts till för hand är där det var.',
    'revoke_failed' => 'Det gick inte att ta bort dem',
];
