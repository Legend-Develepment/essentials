<?php

/*
 * De waakhond.
 *
 * Elk bericht hier wordt om drie uur 's nachts op een telefoon gelezen door
 * iemand die een minuut geleden nog sliep. Dus elk bericht zegt welke machine,
 * wat er mis is, en verder niets - de details horen op de pagina die daarna
 * geopend wordt, niet in de regel die iemand wakker maakte.
 */

return [
    'title' => 'Meldingen',
    'nav_label' => 'Meldingen',
    'subheading' => 'Het panel weet al wanneer een node niet meer antwoordt, een schijf vol loopt of de wachtrij stilvalt. Dit is wat het je vertelt.',

    // ---- de kanalen ------------------------------------------------------
    'channels' => 'Waar berichten heen gaan',
    'channels_helper' => 'Wat elk kanaal deed toen het voor het laatst iets moest versturen. Een kanaal dat aan staat en stilletjes weigert ziet er precies zo uit als een panel waar niets mis is — daarom staat dit bovenaan.',

    'state_off' => 'Uit',
    'state_untried' => 'Nog niets verstuurd',
    'state_ok' => 'Afgeleverd',
    'state_failed' => 'Geweigerd',

    // ---- wanneer ---------------------------------------------------------
    'when' => 'Hoe vaak',
    'when_helper' => 'De controles draaien op de achtergrond, dus er is een queue worker voor nodig. Zonder worker gaat er niets uit en zegt niets dat — gebruik Stuur een test, die gaat niet via de wachtrij.',

    'every' => 'Controleer elke',
    'every_helper' => 'Elke controle bevraagt de daemon van elke node, dus dit is één verzoek per node per ronde. Een kwartier is genoeg om van een storing te horen terwijl het nog een storing is.',
    'every_off' => 'Uit — helemaal geen controles',
    'every_five' => '5 minuten',
    'every_fifteen' => '15 minuten',
    'every_thirty' => '30 minuten',
    'every_hourly' => 'Uur',
    'every_daily' => 'Dag',

    'repeat' => 'Herinner me zolang het duurt',
    'repeat_helper' => 'Er gaat een bericht uit als er iets verandert, en opnieuw als het hersteld is. Dit voegt een herinnering toe zolang een probleem aanhoudt. Nul betekent geen herinneringen — een kanaal dat zichzelf elk kwartier herhaalt wordt gedempt.',
    'hours' => 'uur',

    // ---- waarheen --------------------------------------------------------
    'where' => 'Kanalen',
    'where_helper' => 'Meer dan één is verstandig. Ze falen op verschillende manieren.',

    'discord' => 'Discord',
    'discord_helper' => 'Waar een bericht daadwerkelijk gelezen wordt door iemand die niet naar het panel zit te kijken.',
    'webhook' => 'Webhook-adres',
    'webhook_helper' => 'In Discord: Serverinstellingen → Integraties → Webhooks → Nieuwe webhook → Webhook-URL kopiëren. Alleen https, want hier gaat overheen welke van jouw machines plat ligt en hoe vol zijn schijf zit.',

    'panel' => 'In het panel',
    'panel_helper' => 'Een melding voor iedereen die dit recht heeft. Werkt altijd, hoeft niet ingesteld te worden, en is onzichtbaar voor wie niet is ingelogd.',

    'email' => 'E-mail',
    'email_helper' => 'Gescheiden door komma\'s. Gebruikt de mailer van het panel zelf — betrouwbaar als die goed staat en volkomen stil als dat niet zo is, en stil is precies wat een waakhond niet mag zijn. Leeg laten zet het uit.',

    // ---- wat -------------------------------------------------------------
    'what' => 'Waar op letten',
    'what_helper' => 'Elke meting hier neemt het panel al. Niets op deze pagina opent een verbinding die de Systeemstatus-pagina niet ook opent.',

    'percent_helper' => 'Nul zet deze controle uit.',
    'disk' => 'Waarschuw als de schijf van een node boven',
    'memory' => 'Waarschuw als het geheugen van een node boven',

    'maintenance' => 'Waarschuw over onderhoud dat langer aanstaat dan',
    'maintenance_helper' => 'Een node in onderhoud wordt door elke andere controle overgeslagen, en dat is juist — het is ook hoe er eentje twee weken vergeten wordt. Nul zet dit uit.',

    'versions' => 'Versies van panel en Wings',
    'versions_helper' => 'Eén bericht als iets achterloopt, en één als het weer bij is. Geen herinneringen — een versie is geen storing.',

    'worker' => 'Queue worker',
    'worker_helper' => 'Of er iets is dat het achtergrondwerk van deze plugin uitvoert. Let op de cirkel: de controle zelf draait op de wachtrij, dus een panel dat nooit een worker heeft gehad kan het niet melden. De regel bovenaan deze pagina wel.',

    // ---- de knoppen ------------------------------------------------------
    'save' => 'Opslaan',
    'saved' => 'Opgeslagen',
    'save_failed' => 'Er is niets opgeslagen',

    'test' => 'Stuur een test',
    'test_one' => 'Test',
    'test_off' => 'Dat kanaal staat uit',
    'test_off_body' => 'Zet hem aan en sla op, dan wordt hij samen met de rest getest.',
    'test_title' => 'Testbericht',
    'test_body' => 'Als je dit leest, komen meldingen van je Pelican-panel hier aan. Er is niets aan de hand.',
    'test_sent' => 'Verstuurd naar elk kanaal dat aan staat',
    'test_failed' => 'Minstens één kanaal weigerde het',
    'test_none' => 'Nergens om heen te sturen',
    'test_none_body' => 'Er staat geen enkel kanaal aan, dus een echte melding zou ook nergens heen gaan.',

    'run_now' => 'Nu controleren',
    'run_started' => 'Bezig op de achtergrond',
    'run_failed' => 'De controles konden niet gestart worden',

    'reset' => 'Vergeet wat hij weet',
    'reset_confirm' => 'Wist wat elke controle als laatste zei. De volgende ronde leert opnieuw en stuurt niets, dus een probleem dat nog speelt wordt de ronde daarna opnieuw gemeld. Gebruik dit nadat je een node hebt uitgezet waar de waakhond over blijft doorgaan.',
    'reset_done' => 'Gewist',

    // ---- de berichten zelf -----------------------------------------------
    'still' => 'Duurt nu al :for.',
    'cleared_body' => 'Het was :for zo.',

    'for_unknown' => 'een tijdje',
    'for_minutes' => ':count minuten',
    'for_hours' => ':count uur',
    'for_days' => ':count dagen',

    'node_down' => ':node antwoordt niet',
    'node_down_body' => 'Het panel kan de daemon op :node niet bereiken. Servers daarop starten, stoppen en melden niets tot hij terug is.',
    'node_up' => ':node antwoordt weer',

    'node_disk' => 'De schijf van :node loopt vol',
    'node_disk_body' => 'De schijf op :node zit voor :percent% vol, boven de :limit% die je ingesteld hebt. Back-ups en installaties zijn het eerste wat faalt als dit de top raakt.',
    'node_disk_over' => 'De schijf van :node zit weer onder de grens',

    'node_memory' => 'Het geheugen van :node loopt vol',
    'node_memory_body' => 'Het geheugen op :node is voor :percent% in gebruik, boven de :limit% die je ingesteld hebt. Servers kunnen door de kernel afgeschoten worden voordat er iets een probleem meldt.',
    'node_memory_over' => 'Het geheugen van :node zit weer onder de grens',

    'node_maintenance' => ':node staat al lang in onderhoud',
    'node_maintenance_body' => ':node staat al meer dan :hours uur in onderhoud. Er wordt zolang niets anders aan hem gecontroleerd, en dat is de bedoeling — maar het is goed om te weten dat hij er nog staat.',
    'node_maintenance_over' => ':node staat niet meer in onderhoud',

    'wings_behind' => 'Wings op :node is verouderd',
    'wings_behind_body' => ':node draait Wings :installed en :latest is uit. Bijwerken doe je op de node zelf — het panel kan dat niet.',
    'wings_current' => 'Wings op :node is bij',

    'panel_behind' => 'Het panel is verouderd',
    'panel_behind_body' => 'Dit panel draait :installed en :latest is uit.',
    'panel_current' => 'Het panel is bij',

    'worker_missing' => 'Er draait niets op de wachtrij',
    'worker_missing_body' => 'Er is een taak in de wachtrij gezet en niets heeft hem opgepakt. Plugin-updates, modpack-installaties en deze controles staan stil tot er een worker draait — probeer systemctl status pelican-queue op de machine van het panel.',
    'worker_back' => 'De wachtrij wordt weer verwerkt',
];
