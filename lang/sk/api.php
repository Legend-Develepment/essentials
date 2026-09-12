<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Cesta dnu zvonka panela.
 *
 * Dva druhy čitateľov v jednom súbore, a chcú opačné veci. Administrátor, ktorý
 * túto stránku číta, sa rozhoduje, či niekomu zverí kľúč, takže každý riadok tu
 * hovorí, kam kľúč dosiahne, a nie ako sa volá. Ten, kto o kľúč žiada, chce
 * vedieť, čo dostáva do ruky a čo sa stane, keď ho stratí - a preto tá veta o
 * tom, že sa kľúč ukáže len raz, nie je poznámka pod čiarou.
 *
 * Nikde tu nestojí „token". „Kľúč" je slovo z vlastnej stránky účtu v Pelicane,
 * a panel, ktorý tú istú vec pomenúva dvakrát inak, je panel, kde niekto hľadá
 * to zlé.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Kľúče, ktoré umožnia niečomu mimo panela opýtať sa na to, čo tento plugin vie. Len na čítanie - nič tu nespustí server, nezastaví ho ani naň nedosiahne.',

    'my_title' => 'Prístup k API',
    'my_nav_label' => 'Prístup k API',
    'my_subheading' => 'Vlastný kľúč, pre bota alebo skript. Odpovedá len za tie servery, ktoré aj tak môžete otvoriť.',

    // ---- čo je kľúč, povedané raz, tam kde na tom záleží -----------------
    'address' => 'Adresa',
    'address_helper' => 'Posielajte kľúč ako hlavičku Authorization: :example',

    /*
     * Jediná vec, ktorú musí mať človek prečítanú, kým okno zavrie. Napísaná
     * ako čo urobiť, nie ako varovanie, lebo „uložte ho niekam bezpečne" je
     * rada, s ktorou nikto nič neurobí, a „vložte ho teraz tam, kde ho číta
     * bot", áno.
     */
    'once' => 'Toto je jediný okamih, keď je tento kľúč vidieť',
    'once_body' => 'Ukladá sa ako odtlačok, takže ho nikto - ani ten, kto tento panel prevádzkuje - neprečíta späť. Vložte ho teraz tam, kde ho číta bot alebo skript. Keď sa stratí, tento zrušte a požiadajte o ďalší.',
    'copy' => 'Kopírovať',
    'copied' => 'Skopírované',

    // ---- stavy -----------------------------------------------------------
    'state' => 'Stav',
    'state_pending' => 'Čaká',
    'state_active' => 'Platný',
    'state_refused' => 'Zamietnuté',
    'state_revoked' => 'Zrušený',

    'state_pending_body' => 'Niekto to musí schváliť, kým kľúč na čokoľvek odpovie.',
    'state_refused_body' => 'Toto bolo zamietnuté. Nič sa nevydalo.',
    'state_revoked_body' => 'Tento kľúč bol odobraný a už neodpovedá.',

    // ---- dosah -----------------------------------------------------------
    'scope' => 'Dosiahne na',
    'scope_person' => 'Vlastné servery',
    'scope_panel' => 'Celý panel',

    'scope_person_helper' => 'Odpovedá len za tie servery, ktoré jeho majiteľ aj tak môže otvoriť, a pýta sa na ne rovnako ako panel. Stratiť tento kľúč neznamená stratiť nič, čo jeho majiteľ už aj tak nevidel.',
    'scope_panel_helper' => 'Odpovedá na otázky o celom paneli - každý uzol, kapacitu, watchdog, samotný stroj panela. Pre bota, ktorý podáva správu o paneli, nie pre človeka.',

    // ---- tabuľka ---------------------------------------------------------
    'column_name' => 'Na čo',
    'column_owner' => 'Čí',
    'column_prefix' => 'Kľúč',
    'column_asked' => 'Požiadané',
    'column_used' => 'Naposledy použitý',
    'column_expires' => 'Vyprší',

    'never_used' => 'Nikdy',
    'no_expiry' => 'Kým sa nezruší',

    'tab_waiting' => 'Čakajúce',
    'tab_active' => 'Platné',
    'tab_all' => 'Všetky',

    'empty' => 'Zatiaľ žiadne kľúče',
    'empty_body' => 'Nikto o žiadny nepožiadal a žiadny nebol vydaný. Táto stránka sa plní sama, ako to ľudia robia.',

    'my_empty' => 'Nemáte žiadny kľúč',
    'my_empty_body' => 'Požiadajte o jeden a objaví sa tu aj s tým, čo vám na to odpovedali.',

    // ---- žiadosť ---------------------------------------------------------
    'ask' => 'Požiadať o kľúč',
    'ask_name' => 'Na čo je',
    'ask_name_helper' => 'Pár slov, nech neskôr rozoznáte dva vlastné od seba a ten, kto ho schvaľuje, vie, čo schvaľuje.',
    'ask_reason' => 'Čokoľvek, čo stojí za dopísanie',
    'ask_reason_helper' => 'Nepovinné. Číta to ten, kto rozhoduje.',
    'ask_sent' => 'Požiadané',
    'ask_sent_body' => 'Objaví sa nižšie, len čo niekto odpovie.',
    'ask_granted' => 'Tu je váš kľúč',
    'ask_open' => 'Jeden už máte a čaká na odpoveď',
    'ask_open_body' => 'Jedna žiadosť naraz. Stiahnite tamtú, ak to bol omyl.',
    'ask_failed' => 'O toto sa nepodarilo požiadať',

    'cancel' => 'Stiahnuť',
    'cancel_confirm' => 'Stiahne žiadosť. Nič sa nevydalo, takže ani nič neprestane fungovať.',

    // ---- rozhodovanie ----------------------------------------------------
    'grant' => 'Schváliť',
    'grant_confirm' => 'Vydá kľúč, ktorý odpovedá za vlastné servery tohto človeka, a ukáže ho raz. Všetko, čo kľúč nahlási, ten človek aj tak vidí - tu sa rozhoduje, či sa na to smie niečo mimo panela pýtať v jeho mene.',
    'granted' => 'Schválené',

    'refuse' => 'Zamietnuť',
    'refuse_answer' => 'Čo im povedať',
    'refuse_answer_helper' => 'Nepovinné, a vidia to na svojej vlastnej stránke. Zamietnutie bez dôvodu je zamietnutie, o ktoré sa budúci týždeň požiada znova.',
    'refused' => 'Zamietnuté',
    'collect' => 'Ukázať môj kľúč',
    'state_ready_body' => 'Schválené. Stlačte Ukázať môj kľúč, nech ho uvidíte - raz, lebo sa ukladá ako odtlačok a späť sa už prečítať nedá.',
    'replace' => 'Nahradiť',
    'replace_confirm' => 'Tento kľúč prestane fungovať okamžite a jeho miesto zaujme nový, ukázaný raz. Starý sa nedá nikde dohľadať - nikdy sa neuložil - takže nahradenie je jediná odpoveď na to, že sa stratil.',
    'granted_body' => 'Vyzdvihne si ho sám, na svojej stránke Prístup k API. Tu sa neukazuje: kľúč patrí tomu, kto oň požiadal, nie tomu, kto povedal áno.',

    'revoke' => 'Zrušiť',
    'revoke_confirm' => 'Kľúč okamžite prestane odpovedať a jeho odtlačok sa zmaže, takže sa nedá vrátiť. Všetko, čo ho používa, sa zastaví. Požiadajte o nový namiesto toho, aby ste toto chceli vziať späť.',
    'revoked' => 'Zrušený',
    'forget' => 'Odstrániť',
    'forget_confirm' => 'Odoberie riadok z tejto stránky nadobro. Už dávno neodpovedá, takže sa nič bežiace nezastaví - toto len maže záznam o tom, že existoval.',
    'forgotten' => 'Odstránené',

    'mint' => 'Nový kľúč',
    'mint_body' => 'Pre bota, nie pre človeka. Je schválený v okamihu, keď vzniká, lebo ten, kto by ho schvaľoval, ste vy.',
    'abilities' => 'Na čo sa smie pýtať',
    'abilities_helper' => 'Na začiatku je zaškrtnuté všetko, lebo tým kľúč bol, kým toto nebolo. Odškrtnutie je ten úmyselný krok. Ukladá sa zoznam povoleného, takže schopnosť pridaná v neskoršom vydaní je pri kľúčoch spravených pred ňou vypnutá - schopnosť, ktorú nikto nezaškrtol, je schopnosť, ktorú nikto nedal.',
    'ability_health' => 'Overiť, že kľúč funguje',
    'ability_health_helper' => 'Na nič iné nedosiahne. Pokojne sa dá volať na časovači.',
    'ability_me' => 'Vlastné servery',
    'ability_me_helper' => 'Servery, ktoré jeho majiteľ aj tak môže otvoriť, a ich zálohy. Nikoho iného nikdy neuvidí.',
    'ability_panel' => 'Celý panel',
    'ability_panel_helper' => 'Každý uzol, každá záloha, zastavené naplánované úlohy, watchdog a stroj panela. Potrebuje aj kľúč na celý panel.',
    'ability_live' => 'Spýtať sa servera priamo',
    'ability_live_helper' => 'Kto hrá a či server beží. Jediné otázky, ktoré niečo stoja - dosiahnu na herný server alebo na daemona, s cache pätnásť až dvadsať sekúnd.',
    'ability_connect' => 'Spájať účty Discord s účtami panela',
    'ability_connect_helper' => 'Jediná skupina, ktorá nie je čítaním. Vytvára kľúče Pelican API na účtoch tých, ktorí o to požiadajú, a vie spojenie ukončiť. Dajte ju len tomu botovi, ktorý ju potrebuje.',
    'own_rate' => 'Dopytov za minútu pre tento kľúč',
    'own_rate_helper' => 'Nechajte prázdne, nech sa riadi nastavením panela. Číslo tu platí len pre tento kľúč. Nula znamená, že stropu niet vôbec - rozumné pre bota na vašom vlastnom stroji a naozajstný spôsob, ako to oľutovať, ak sa kľúč dostane inam.',
    'own_rate_default' => 'Riadi sa panelom',
    'mint_owner' => 'Čí je',
    'mint_owner_helper' => 'Kľúč odpovedá v mene niekoho. Pri kľúči na celý panel je to len ten, kto zaň ručí; pri osobnom je to zároveň aj to, čo kľúč vidí.',
    'minted' => 'Vytvorený',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Kľúč pre Essentials API',
    'profile_make_helper' => 'Iné API než to vyššie: toto odpovedá na to, čo vie tento plugin - ktorý z vašich serverov nemá zálohu, kto na nich hrá, či bežia. Odpovedá vždy len za vás a dosiahne len na servery, ktoré aj tak môžete otvoriť.',
    'profile_create' => 'Vytvoriť',
    'profile_yours' => 'Vaše kľúče Essentials',
    'profile_manage' => 'Zrušenie kľúča, dôvod, prečo bol nejaký zamietnutý, aj pripojenie Discordu sú na stránke Prístup k API v bočnom paneli.',
    'discord' => 'Discord',
    'discord_body' => 'Spojte svoj účet Discord s týmto, nech môže bot odpovedať za vaše servery, keď ho o to požiadate. Dostane kľúč, ktorý dosiahne presne na to, na čo dosiahnete vy, a na nič viac.',
    'discord_connect' => 'Pripojiť Discord',
    'discord_code' => 'Napíšte to v Discorde do desiatich minút',
    'discord_code_body' => 'Pošlite :command v kanáli, ktorý bot vie čítať. Kód platí raz. Nikto iný ako účet, pre ktorý vznikol, ho použiť nemôže.',
    'discord_on' => 'Pripojené ako :name',
    'discord_since' => 'Od :when',
    'discord_cut' => 'Odpojené',
    'discord_cut_confirm' => 'Ukončí spojenie a zmaže kľúč, ktorý pri ňom vznikol, takže bot za vás okamžite prestane odpovedať. Pripojiť sa môžete znova, kedykoľvek budete chcieť.',
    'discord_off' => 'Nepripojené',
    'discord_key_note' => 'Pripojenie vytvorí na vašom účte kľúč Pelican API s názvom Discord (Essentials). Vidieť ho a zrušiť ho môžete v Účet → Kľúče API - táto stránka je len skratka k tomu istému.',
    'docs_title' => 'Ako používať toto API',
    'docs_subheading' => 'Na čo tento panel odpovedá a na akých adresách. Napísané z toho istého popisu, z ktorého je API postavené, takže nemôže byť o vydanie pozadu.',
    'docs_base' => 'Kde sa nachádza',
    'docs_endpoints' => 'Koncové body',
    'docs_answers' => 'Čo príde späť',
    'docs_calls' => 'Kľúče, ktoré ho smú volať',
    'docs_params' => 'Čo poslať',
    'docs_required' => 'povinné',
    'docs_optional' => 'nepovinné',
    'docs_try' => 'Vyskúšať',
    'docs_errors' => 'Keď je niečo zle',
    'docs_hook' => 'Čo vám panel posiela',
    'docs_hook_body' => 'Druhý smer a jediná časť tohto, čo príde bez opýtania. Zapína sa v Upozorneniach adresou a podpisovým tajomstvom: jedno odoslanie JSON, keď watchdog niečo nájde, a jedno, keď to pominie, aby sa bot dozvedel o spadnutom uzle namiesto toho, aby sa každú minútu pýtal, či taký je.',
    'docs_hook_verify' => 'Z tela sa vaším tajomstvom urobí odtlačok a ten cestuje v X-Essentials-Signature ako sha256=<hex>. Odtlačok robte zo surového tela, nie zo znova zoserializovaného objektu - akýkoľvek rozdiel v medzerách alebo v poradí kľúčov dá iný odtlačok a nezhoda vyzerá ako útok, nie ako chyba.',
    'docs_download_md' => 'Stiahnuť ako Markdown',
    'docs_download_json' => 'Stiahnuť ako OpenAPI',

    // ---- čo nastavuje administrátor --------------------------------------
    'settings' => 'Ako to funguje',
    'approval' => 'Žiadosti čakajú na schválenie',
    'approval_helper' => 'Zapnuté - kto požiada o kľúč, dostane ho, keď niekto povie áno. Vypnuté - dostane ho rovno, čo na paneli, kde je každý s účtom aj tak dôveryhodný, dáva zmysel a stojí za to to zvoliť, nie sa k tomu dostať nedopatrením.',
    'rate' => 'Dopytov za minútu, na kľúč',
    'rate_helper' => 'Bot, ktorý sa pýta štyridsiatich serverov, kto hrá, je štyridsať otázok na štyridsať herných serverov. Toto je strop, ktorý nedovolí, aby sa zo slučky napísanej o tretej ráno stal záťažový test.',
    'days' => 'Schválený kľúč vydrží',
    'days_helper' => 'V dňoch. Nula znamená kým sa nezruší, a to je predvolené - kľúč, ktorému vyprší platnosť, keď sa nikto nepozerá, je bot, ktorý sa cez noc zastaví bez toho, aby kdekoľvek stálo prečo.',
    'days_never' => 'Kým sa nezruší',
    'hide_pelican' => 'Odstrániť kartu kľúčov API samotného panela',
    'hide_pelican_helper' => 'Odoberie kartu kľúčov API z profilu účtu úplne, takže na tej stránke ostane len jedna vec, ktorá sa volá kľúče API. Zo stránky sa odstráni, nie prekryje, takže nezostane ani adresa, ktorá by na ňu dosiahla. Jedno nedokáže: vlastné klientske API panela stále urobí kľúč účtu čomukoľvek, čo ho oň priamo požiada - karta je miesto, kde si ho ľudia robia rukou, a toto tú ruku berie. Kľúče, ktoré už existujú, fungujú ďalej.',

    /*
     * Povedané na stránke, nie ponechané na objavenie. Pelican pri odinštalovaní
     * pluginu vráti jeho migrácie späť, a jediná tabuľka tohto pluginu ide s
     * nimi.
     */
    'uninstall_note' => 'Odstrániť tento plugin znamená odstrániť s ním každý kľúč. Je to naschvál - kľúč, ktorý prežije to, čo mu odpovedá, je prihlasovací údaj, ktorý už nikto nezruší.',
];
