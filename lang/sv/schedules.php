<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Cron» står kvar: det är namnet på det som körs på panelens värd, och den som
 * ska titta efter det söker på det ordet.
 */

return [
    'nav_label' => 'Scheman',
    'title' => 'Vilket schema som har stannat',
    'subheading' => 'Varje schemalagd uppgift på panelen, den värsta först - fast i över :hours timmar, försenad, eller aldrig körd.',

    'how' => 'Pelican visar scheman inne i varje server, och dess eget tillstånd har tre ord för dem: av, behandlar, aktiv. Inget av dem är «det här har stannat». En körning som föll halvvägs står kvar som behandlar för alltid och ser precis ut som en som kör nu; ett schema vars tid gick för timmar sedan för att cron dog kallas fortfarande aktivt. Den här sidan ställer den andra frågan. Endast läsning - allt som ändrar, kör eller tar bort ett schema stannar på Pelicans egen sida för den servern.',

    'column_state' => 'Tillstånd',
    'column_name' => 'Schema',
    'column_server' => 'Server',
    'column_last' => 'Senaste körningen',
    'column_next' => 'Nästa körning',

    /*
     * De fem omdömena. Skrivna som vad som är sant snarare än som en
     * uppmaning, för tre av dem är sådant att titta på och två är det inte.
     */
    'state_stuck' => 'Fast',
    'state_overdue' => 'Försenad',
    'state_never' => 'Aldrig körd',
    'state_healthy' => 'Bra',
    'state_off' => 'Av',

    'filter_stuck' => 'Fast',
    'filter_overdue' => 'Försenad',
    'filter_never' => 'Aldrig körd',
    'filter_off' => 'Avstängd',

    'open' => 'Öppna på servern',

    'empty' => 'Inga scheman på någon server du når - eller inga som har stannat, om du har ett filter på.',
];
