<?php

/*
 * Svenska. Skriven för hand.
 *
 * Modulsidan.
 *
 * En egen fil i stället för ett hörn av settings.php, som redan är den
 * största språkfilen det här tillägget har.
 */

return [
    'title' => 'Moduler',
    'nav_label' => 'Moduler',
    'subheading' => 'Vad det här tillägget är på den här panelen. Allt här går att stänga av, och att stänga av något tar aldrig bort det som redan är antecknat.',

    'first_title' => 'Vad är den här panelen till för?',
    'first_helper' => 'Svara en gång, så slås delarna som hör dit på. Ingenting låses fast av det: varje strömbrytare nedanför är fortfarande din, och att stänga av något tar aldrig bort det som redan är antecknat.',
    'first_look' => 'Mest hur den ser ut',
    'first_look_helper' => 'Färger, inloggningsskärmen, meddelanden, dina egna länkar och sidorna för att ändra det. Ingenting som säljer, svarar eller når utanför.',
    'first_run' => 'Köra servrar, åt mig eller ett lag',
    'first_run_helper' => 'Utseendet, plus vad en server visar och vad som är fullt eller har stannat. Ingen butik, ingen ärendedisk och ingenting som skickar post på en timer.',
    'first_sell' => 'Sälja hosting till kunder',
    'first_sell_helper' => 'Allt. En butik utan någonstans att svara på frågor, och utan något som håller ögonen på noderna, är en halv butik.',
    'first_skip' => 'Jag väljer själv',

    'first_left' => 'Lämnat som det är. Strömbrytarna finns allihop nedanför.',
    'go' => 'Ställ in',

    'state_on' => 'På',
    'state_part' => 'Delvis på',
    'state_off' => 'Av',

    'count' => '{1} :on av :of del på|[2,*] :on av :of delar på',
    'parts' => '{1} Den enda delen|[2,*] Alla :count delar',

    'health_tables' => 'Dess tabeller finns inte än. Att spara något på den här sidan skapar dem.',
    'health_missing' => '{1} En del behöver något som är avstängt|[2,*] :count delar behöver något som är avstängt',
    'health_waiting' => '{1} En del är på och visar ännu ingenting|[2,*] :count delar är på och visar ännu ingenting',

    'left_access' => '{1} En person har fortfarande en server som gavs härifrån|[2,*] :count personer har fortfarande servrar som gavs härifrån',
    'left_public_status' => '{1} En publicerad sida och dess adress finns kvar|[2,*] :count publicerade sidor och deras adresser finns kvar',
    'left_arranger' => '{1} En sparad ordning finns kvar|[2,*] :count sparade ordningar finns kvar',
    'left_user_themes' => '{1} En persons valda stil finns kvar|[2,*] :count personers valda stilar finns kvar',
    'left_unknown' => 'Något finns kvar här, och panelen kunde inte läsa hur mycket.',
    'cleared' => '{1} En återtagen|[2,*] :count återtagna',
    'clear_failed' => 'Det gick inte att rensa',

    'turn_on' => 'Slå på',
    'turn_off' => 'Stäng av',

    'saved' => 'Sparat',
    'brought' => 'Påslagna samtidigt, för utan dem fungerar ingenting här: :names.',
    'save_failed' => 'Det gick inte att spara',
    'read_only' => 'Du får titta på det här men inte ändra det. Att ändra vad panelen erbjuder kräver den bredare behörigheten till det här tillägget.',
];
