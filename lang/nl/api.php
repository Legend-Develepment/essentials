<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Een weg naar binnen van buiten het paneel.
 *
 * Twee soorten lezers in één bestand, en ze willen het tegenovergestelde. Een
 * beheerder die deze pagina leest, beslist of hij iemand een sleutel toevertrouwt,
 * dus elke regel hier zegt wat een sleutel kan bereiken in plaats van hoe hij
 * heet. Wie er een vraagt, wil weten wat hij in handen krijgt en wat er gebeurt
 * als hij hem kwijtraakt, en daarom is de zin over de sleutel die maar één keer
 * te zien is, geen voetnoot.
 *
 * Nergens staat hier „token". „Sleutel" is het woord op Pelicans eigen
 * accountpagina, en een paneel dat hetzelfde ding twee namen geeft, is een
 * paneel waar iemand het verkeerde zoekt.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Sleutels waarmee iets buiten het paneel kan vragen wat deze plugin weet. Alleen lezen - niets hier kan een server starten, stoppen of bereiken.',

    'my_title' => 'API-toegang',
    'my_nav_label' => 'API-toegang',
    'my_subheading' => 'Een eigen sleutel, voor een bot of een script. Hij antwoordt alleen voor de servers die je toch al kunt openen.',

    // ---- wat een sleutel is, één keer gezegd, waar het ertoe doet --------
    'address' => 'Het adres',
    'address_helper' => 'Stuur de sleutel mee als Authorization-header: :example',

    /*
     * Het ene dat iemand gelezen moet hebben voordat hij het venster sluit.
     * Geschreven als wat te doen in plaats van als waarschuwing, want „bewaar
     * hem goed" is een advies waar niemand iets mee kan en „plak hem nu waar de
     * bot hem leest" wel.
     */
    'once' => 'Dit is de enige keer dat deze sleutel te zien is',
    'once_body' => 'Hij wordt als hash bewaard, dus niemand - ook niet wie dit paneel draait - kan hem teruglezen. Plak hem nu waar de bot of het script hem leest. Raak je hem kwijt, trek deze dan in en vraag een nieuwe.',
    'copy' => 'Kopiëren',
    'copied' => 'Gekopieerd',

    // ---- de toestanden ---------------------------------------------------
    'state' => 'Toestand',
    'state_pending' => 'Wacht',
    'state_active' => 'Actief',
    'state_refused' => 'Geweigerd',
    'state_revoked' => 'Ingetrokken',

    'state_pending_body' => 'Iemand moet dit toekennen voordat hij ergens antwoord op geeft.',
    'state_refused_body' => 'Dit is afgewezen. Er is niets uitgegeven.',
    'state_revoked_body' => 'Deze sleutel is afgenomen en antwoordt niet meer.',

    // ---- het bereik ------------------------------------------------------
    'scope' => 'Bereikt',
    'scope_person' => 'Hun eigen servers',
    'scope_panel' => 'Het hele paneel',

    'scope_person_helper' => 'Antwoordt alleen voor de servers die de eigenaar toch al kan openen, op dezelfde manier gevraagd als het paneel het vraagt. Deze sleutel kwijtraken verliest niets wat de eigenaar niet al kon zien.',
    'scope_panel_helper' => 'Antwoordt op de vragen over het hele paneel - elke node, de capaciteit, de waakhond, de machine van het paneel zelf. Voor een bot die over het paneel rapporteert in plaats van voor een persoon.',

    // ---- de tabel --------------------------------------------------------
    'column_name' => 'Waarvoor',
    'column_owner' => 'Van wie',
    'column_prefix' => 'Sleutel',
    'column_asked' => 'Gevraagd',
    'column_used' => 'Laatst gebruikt',
    'column_expires' => 'Verloopt',

    'never_used' => 'Nooit',
    'no_expiry' => 'Tot hij wordt ingetrokken',

    'tab_waiting' => 'Wachtend',
    'tab_active' => 'Actief',
    'tab_all' => 'Alles',

    'empty' => 'Nog geen sleutels',
    'empty_body' => 'Niemand heeft erom gevraagd en er is er geen uitgegeven. Deze pagina vult zichzelf terwijl mensen dat doen.',

    'my_empty' => 'Je hebt geen sleutel',
    'my_empty_body' => 'Vraag er een, dan verschijnt hij hier met wat er ook op geantwoord is.',

    // ---- vragen ----------------------------------------------------------
    'ask' => 'Vraag een sleutel',
    'ask_name' => 'Waar is hij voor',
    'ask_name_helper' => 'Een paar woorden, zodat je later twee van jezelf uit elkaar houdt en wie hem toekent weet wat hij toekent.',
    'ask_reason' => 'Iets wat het waard is erbij te zetten',
    'ask_reason_helper' => 'Optioneel. Gelezen door wie beslist.',
    'ask_sent' => 'Gevraagd',
    'ask_sent_body' => 'Hij verschijnt hieronder zodra iemand geantwoord heeft.',
    'ask_granted' => 'Hier is je sleutel',
    'ask_open' => 'Je hebt er al een die op antwoord wacht',
    'ask_open_body' => 'Eén verzoek tegelijk. Trek dat in als het een vergissing was.',
    'ask_failed' => 'Daar kon niet om gevraagd worden',

    'cancel' => 'Intrekken',
    'cancel_confirm' => 'Trekt het verzoek in. Er is niets uitgegeven, dus er stopt ook niets met werken.',

    // ---- beslissen -------------------------------------------------------
    'grant' => 'Toekennen',
    'grant_confirm' => 'Geeft een sleutel uit die antwoordt voor de eigen servers van deze persoon, en toont hem één keer. Hij kan alles wat de sleutel zal melden al zien - dit beslist of iets buiten het paneel het namens hem mag vragen.',
    'granted' => 'Toegekend',

    'refuse' => 'Weigeren',
    'refuse_answer' => 'Wat je hun vertelt',
    'refuse_answer_helper' => 'Optioneel, en te zien op hun eigen pagina. Een weigering zonder reden is er een die volgende week opnieuw gevraagd wordt.',
    'refused' => 'Geweigerd',
    'collect' => 'Toon mijn sleutel',
    'state_ready_body' => 'Toegekend. Druk op Toon mijn sleutel om hem te zien - één keer, want hij wordt als hash bewaard en is daarna niet terug te lezen.',
    'replace' => 'Vervangen',
    'replace_confirm' => 'Deze sleutel stopt onmiddellijk met werken en er komt een nieuwe voor in de plaats, die één keer te zien is. De oude is nergens op te zoeken - hij is nooit bewaard - dus vervangen is het enige antwoord op hem kwijt zijn.',
    'granted_body' => 'Ze halen hem zelf op, op hun eigen pagina API-toegang. Hier wordt hij niet getoond: een sleutel hoort bij wie erom vroeg, niet bij wie ja zei.',

    'revoke' => 'Intrekken',
    'revoke_confirm' => 'De sleutel stopt onmiddellijk met antwoorden en zijn hash wordt verwijderd, dus hij is niet terug te halen. Alles wat hem gebruikt, valt stil. Vraag een nieuwe in plaats van dit ongedaan te maken.',
    'revoked' => 'Ingetrokken',
    'forget' => 'Verwijderen',
    'forget_confirm' => 'Haalt de rij voorgoed van deze pagina. Hij antwoordde toch al niet meer, dus er stopt niets wat nog werkt - dit verwijdert alleen de vermelding dat hij bestond.',
    'forgotten' => 'Verwijderd',

    'mint' => 'Nieuwe sleutel',
    'mint_body' => 'Voor een bot in plaats van voor een persoon. Hij is toegekend op het moment dat hij gemaakt wordt, want jij bent degene die hem zou hebben goedgekeurd.',
    'abilities' => 'Waar hij naar mag vragen',
    'abilities_helper' => 'Alles staat om te beginnen aangevinkt, want dat was een sleutel voordat dit bestond. Het uitvinken is de bewuste daad. Wat bewaard wordt is de toegestane lijst, dus een mogelijkheid die in een latere versie bijkomt staat uit voor sleutels die ouder zijn dan zij - een mogelijkheid die niemand aanvinkte, is er een die niemand heeft toegekend.',
    'ability_health' => 'Bewijzen dat de sleutel werkt',
    'ability_health_helper' => 'Bereikt verder niets. Veilig om op vaste tijden aan te roepen.',
    'ability_me' => 'Zijn eigen servers',
    'ability_me_helper' => 'De servers die zijn eigenaar toch al kan openen, en hun back-ups. Hij kan nooit iemand anders zien.',
    'ability_panel' => 'Het hele paneel',
    'ability_panel_helper' => 'Elke node, elke back-up, de gestopte geplande taken, de waakhond en de machine van het paneel. Vraagt daarnaast een sleutel voor het hele paneel.',
    'ability_live' => 'Een server rechtstreeks vragen',
    'ability_live_helper' => 'Wie er speelt, en of een server draait. De enige vragen die iets kosten - ze bereiken een gameserver of een daemon, vijftien tot twintig seconden gecachet.',
    'ability_connect' => 'Discord-accounts aan paneelaccounts koppelen',
    'ability_connect_helper' => 'De enige groep die geen aflezing is. Hij maakt Pelican-API-sleutels aan op de accounts van wie erom vraagt, en kan een koppeling beëindigen. Geef hem alleen aan de bot die hem nodig heeft.',
    'own_rate' => 'Verzoeken per minuut voor deze sleutel',
    'own_rate_helper' => 'Leeg laten volgt de instelling van het paneel. Een getal hier geldt alleen voor deze sleutel. Nul betekent helemaal geen plafond - redelijk voor een bot op je eigen machine, en een echte manier om spijt te krijgen als de sleutel ergens anders belandt.',
    'own_rate_default' => 'Volgt het paneel',
    'mint_owner' => 'Van wie hij is',
    'mint_owner_helper' => 'Een sleutel antwoordt als iemand. Bij een sleutel voor het hele paneel is dat alleen wie erop aanspreekbaar is; bij een persoonlijke is het ook wat de sleutel kan zien.',
    'minted' => 'Gemaakt',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Een sleutel voor de Essentials API',
    'profile_make_helper' => 'Een andere API dan die hierboven: deze beantwoordt wat deze plugin weet - welke van je servers geen back-up heeft, wie erop speelt, of ze draaien. Hij antwoordt altijd alleen voor jou en bereikt alleen de servers die je toch al kunt openen.',
    'profile_create' => 'Aanmaken',
    'profile_yours' => 'Je Essentials-sleutels',
    'profile_manage' => 'Een sleutel intrekken, zien waarom er een geweigerd is en Discord koppelen doe je allemaal op de pagina API-toegang in de zijbalk.',
    'discord' => 'Discord',
    'discord_body' => 'Koppel je Discord-account aan dit account, zodat een bot voor je servers kan antwoorden als je erom vraagt. Wat hij krijgt is een sleutel die precies bereikt wat jij kunt bereiken en verder niets.',
    'discord_connect' => 'Discord koppelen',
    'discord_code' => 'Typ dit binnen tien minuten in Discord',
    'discord_code_body' => 'Stuur :command in een kanaal dat de bot kan lezen. De code werkt één keer. Niemand kan hem gebruiken behalve het account waarvoor hij gemaakt is.',
    'discord_on' => 'Gekoppeld als :name',
    'discord_since' => 'Sinds :when',
    'discord_cut' => 'Ontkoppeld',
    'discord_cut_confirm' => 'Beëindigt de koppeling en verwijdert de sleutel die eruit voortkwam, dus de bot stopt meteen met voor jou antwoorden. Je kunt altijd opnieuw koppelen.',
    'discord_off' => 'Niet gekoppeld',
    'discord_key_note' => 'Koppelen maakt een Pelican-API-sleutel aan op je account met de naam Discord (Essentials). Je kunt hem zien en intrekken onder Account → API-sleutels - deze pagina is alleen een kortere weg naar hetzelfde.',
    'docs_title' => 'Hoe je deze API gebruikt',
    'docs_subheading' => 'Wat dit paneel beantwoordt, op de adressen waar het antwoordt. Geschreven uit dezelfde beschrijving waaruit de API gebouwd is, dus hij kan er geen versie op achterlopen.',
    'docs_base' => 'Waar hij staat',
    'docs_endpoints' => 'Endpoints',
    'docs_answers' => 'Wat er terugkomt',
    'docs_calls' => 'Sleutels die hem mogen aanroepen',
    'docs_params' => 'Wat je meestuurt',
    'docs_required' => 'verplicht',
    'docs_optional' => 'optioneel',
    'docs_try' => 'Uitproberen',
    'docs_errors' => 'Als er iets mis is',
    'docs_hook' => 'Wat het paneel naar jou stuurt',
    'docs_hook_body' => 'De andere richting, en het enige deel hiervan dat aankomt zonder erom te vragen. Aangezet onder Meldingen met een adres en een ondertekeningsgeheim: één JSON-post als de waakhond iets vindt en één als het over is, zodat een bot hoort dat een node plat ligt in plaats van elke minuut te vragen of dat zo is.',
    'docs_hook_verify' => 'De body wordt met jouw geheim gehasht en de hash reist mee in X-Essentials-Signature als sha256=<hex>. Hash de ruwe body, niet een opnieuw geserialiseerd object - elk verschil in spaties of in de volgorde van de sleutels geeft een andere hash, en dat verschil leest als een aanval in plaats van als een fout.',
    'docs_download_md' => 'Downloaden als Markdown',
    'docs_download_json' => 'Downloaden als OpenAPI',

    // ---- wat een beheerder instelt ---------------------------------------
    'settings' => 'Hoe dit werkt',
    'approval' => 'Verzoeken wachten op toekenning',
    'approval_helper' => 'Aan krijgt iemand die om een sleutel vraagt er een zodra iemand ja zegt. Uit krijgt hij er meteen een - wat redelijk is op een paneel waar iedereen met een account toch al vertrouwd is, en het waard is om te kiezen in plaats van erin te belanden.',
    'rate' => 'Verzoeken per minuut, per sleutel',
    'rate_helper' => 'Een bot die veertig servers vraagt wie er speelt, zijn veertig vragen aan veertig gameservers. Dit is het plafond dat voorkomt dat een lus die iemand om drie uur \'s nachts schreef een belastingstest wordt.',
    'days' => 'Een toegekende sleutel houdt het',
    'days_helper' => 'In dagen. Nul betekent tot hij wordt ingetrokken, en dat is de standaard - een sleutel die verloopt terwijl niemand kijkt, is een bot die \'s nachts stilvalt zonder dat ergens staat waarom.',
    'days_never' => 'Tot hij wordt ingetrokken',
    'hide_pelican' => 'Het tabblad met de eigen API-sleutels van het paneel weghalen',
    'hide_pelican_helper' => 'Haalt het tabblad API-sleutels helemaal van het accountprofiel, zodat er op die pagina nog maar één ding API-sleutels heet. Het wordt van de pagina verwijderd in plaats van overgeschilderd, dus er blijft geen adres over dat er nog bij komt. Eén ding kan het niet: de eigen client-API van het paneel maakt nog steeds een accountsleutel aan voor alles wat er rechtstreeks om vraagt - het tabblad is waar mensen er met de hand een maken, en dit neemt de hand weg. Sleutels die er al zijn blijven werken.',

    /*
     * Op de pagina gezegd in plaats van overgelaten om te ontdekken. Pelican
     * draait de migraties van een plugin terug als die verwijderd wordt, en de
     * ene tabel van deze plugin gaat mee.
     */
    'uninstall_note' => 'Deze plugin verwijderen verwijdert elke sleutel mee. Dat is met opzet - een sleutel die het ding overleeft dat hem beantwoordt, is een inlog die niemand kan intrekken.',
];
