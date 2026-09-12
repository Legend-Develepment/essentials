<?php

/*
 * Een lopende dienst van het ene pakket naar het andere verplaatsen.
 *
 * De teksten houden één ding uit elkaar: wat een pakket kost en wat overstappen
 * vandaag kost zijn twee verschillende bedragen. Het eerste staat in de winkel;
 * het tweede hangt af van hoe ver deze dienst in de betaalde periode zit, en
 * dat is het bedrag waar iemand ja tegen zegt als hij op de knop drukt.
 *
 * Het woord "upgrade" wordt vermeden in wat een klant leest, want de helft van
 * deze overstappen gaat de andere kant op. Hier heet het wisselen.
 */

return [
    // ---- op de dienstkaart -----------------------------------------------
    'change' => 'Ander pakket',
    'change_body' => 'Wat er over is van de periode die je al betaald hebt gaat eraf, en dezelfde dagen worden tegen de nieuwe prijs berekend. Er gaat niets van je server verloren.',
    'change_to' => 'Wissel naar :name',
    'change_confirm' => 'Deze dienst naar :name wisselen?',
    'change_free' => 'Niets te betalen',
    'costs_now' => 'nu :amount',
    'gives_back' => ':amount terug',
    'waiting' => 'Wissel afgesproken',
    'waiting_for' => 'Een wissel naar :name wacht op een openstaande factuur.',

    // ---- wat er daarna gebeurt -------------------------------------------
    'done' => 'Overgezet naar :name',
    'done_body' => 'Je dienst staat op het nieuwe pakket. Wat je tegoed had staat op je rekening.',
    'refused' => 'De wissel is niet doorgevoerd',

    // ---- en waarom niet, één reden per zin -------------------------------
    'refused_off' => 'Van pakket wisselen staat uit voor dit panel.',
    'refused_not_active' => 'Alleen een lopende dienst kan gewisseld worden. Bij een dienst die nog gebouwd wordt, geschorst is of afloopt valt er niets te verrekenen.',
    'refused_gone' => 'Het pakket waar deze dienst op staat bestaat niet meer, dus er valt niets mee te vergelijken.',
    'refused_same' => 'Dat is het pakket waar hij al op staat.',
    'refused_egg' => 'Dat pakket draait andere software. Het zou een andere server worden in plaats van een grotere, dus dat moet je als nieuwe server kopen.',
    'refused_period' => 'Dat pakket wordt over een andere periode gefactureerd, en dat is een andere afspraak in plaats van een grotere.',
    'refused_stock' => 'Dat pakket is uitverkocht.',
    'refused_waiting' => 'Er wacht al een wissel op een openstaande factuur voor deze dienst. Betaal of annuleer die eerst.',
    'refused_failed' => 'Er is niets vastgelegd, dus er is niets veranderd. Probeer het opnieuw, en meld het bij wie dit panel beheert als het blijft gebeuren.',
    'refused_server' => 'De server kon de nieuwe limieten niet krijgen, dus de dienst is precies gebleven zoals hij was. Wie dit panel beheert is op de hoogte gebracht.',

    // ---- wat er op de documenten staat -----------------------------------
    'line' => 'Wissel van :from naar :to, voor de resterende :days dagen van deze periode',
    'credit_reason' => 'Wissel naar :name',

    // ---- en wat de eigenaar te horen krijgt ------------------------------
    'bell_failed' => 'Een pakketwissel is mislukt op bestelling :number',
    'cold_title' => 'Een pakketwissel bereikte het panel maar de node niet, op bestelling :number',
    'cold_body' => 'De dienst staat op :name en de nieuwe limieten zijn vastgelegd. De node heeft ze nog niet overgenomen en leest ze de volgende keer dat die server start, dus tot dan heeft de klant nog de oude maat. Controleer de node.',
    'gone' => 'Het pakket waar naartoe gewisseld werd bestaat niet meer.',
    'refused_by_node' => 'De server wilde de nieuwe limieten niet aannemen: :why',

    // ---- rechtzetten ------------------------------------------------------
    'retry' => 'Wissel opnieuw proberen',
    'retry_confirm' => 'Probeer de pakketwissel opnieuw. De factuur ervoor is al betaald, dus er wordt niets dubbel in rekening gebracht.',
    'retried' => 'De wissel is gelukt',
    'retry_failed' => 'Het is opnieuw mislukt. De reden staat op de bestelling.',
];
