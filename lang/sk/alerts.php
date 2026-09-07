<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Watchdog.
 *
 * Každú správu odtiaľto číta človek na telefóne, o tretej ráno, minútu po
 * zobudení. Každá hovorí, ktorý stroj, čo je zle, a nič viac - podrobnosť patrí
 * tej stránke, ktorú otvorí vzápätí, nie riadku, ktorý ho zobudil.
 *
 * Návrat do poriadku je napísaný ako správa, nie ako dovetok. „Už je to späť?"
 * je otázka, kvôli ktorej by inak niekto vstával.
 *
 * „Node", „Wings", „daemon", „webhook", „queue", „Discord" a „SMTP" ostávajú po
 * anglicky: pod týmito menami sa nájdu v Pelicane, na hostiteľovi a vo všetkom,
 * čo sa o nich píše.
 */

return [
    'title' => 'Upozornenia',
    'nav_label' => 'Upozornenia',
    'subheading' => 'Panel už vie, kedy uzol prestane odpovedať, kedy sa plní disk a kedy sa zastaví front. Toto je to, čo vám o tom povie.',

    // ---- kanály a čo naposledy urobili ------------------------------------
    'channels' => 'Kam správy chodia',
    'channels_helper' => 'Čo urobil každý kanál naposledy, keď mal niečo odoslať. Zapnutý kanál, ktorý ticho odmieta, vyzerá presne ako panel, ktorému nič nie je, a preto toto stojí na stránke prvé.',

    'state_off' => 'Vypnuté',
    'state_untried' => 'Zatiaľ sa nič neodoslalo',
    'state_ok' => 'Doručené',
    'state_failed' => 'Odmietnuté',

    // ---- kedy -------------------------------------------------------------
    'when' => 'Ako často',
    'when_helper' => 'Kontroly bežia na pozadí, takže potrebujú queue worker. Bez neho sa nič neodosiela a nič to nepovie — vezmite „Poslať skúšku", tá frontom nejde.',

    'every' => 'Kontrolovať každých',
    'every_helper' => 'Každá kontrola dosiahne na daemona každého uzla, takže je to jedna požiadavka na uzol a prechod. Pätnásť minút stačí, aby sa o výpadku vedelo, kým je to ešte výpadok.',
    'every_off' => 'Vypnuté — žiadne kontroly',
    'every_five' => '5 minút',
    'every_fifteen' => '15 minút',
    'every_thirty' => '30 minút',
    'every_hourly' => 'Hodina',
    'every_daily' => 'Deň',

    'repeat' => 'Pripomínať mi to, kým to trvá',
    'repeat_helper' => 'Správa odíde, keď sa niečo zmení, a ďalšia, keď sa to spraví. Toto pridáva pripomienku, kým ťažkosť trvá. Nula znamená bez pripomienok — kanál, ktorý sa opakuje každú štvrťhodinu, je kanál, ktorý ľudia stlmia.',
    'hours' => 'hodín',

    // ---- kam --------------------------------------------------------------
    'where' => 'Kanály',
    'where_helper' => 'Viac než jeden dáva zmysel. Zlyhávajú rôzne.',

    'discord' => 'Discord',
    'discord_helper' => 'Miesto, kde si správu naozaj prečíta aj ten, kto sa práve nepozerá do panela.',
    'webhook' => 'Adresa webhooku',
    'webhook_helper' => 'V Discorde: Nastavenia servera → Integrácie → Webhooky → Nový webhook → Skopírovať URL webhooku. Len https, lebo sa týmto zverejňuje, ktorý z vašich strojov spadol a aký plný má disk.',

    'panel' => 'V paneli',
    'panel_helper' => 'Upozornenie pre každého, kto má toto oprávnenie. Funguje vždy, nič sa nemusí nastavovať, a pre neprihláseného je neviditeľné.',

    'email' => 'E-mail',
    'email_helper' => 'Oddelené čiarkami. Používa mailer samotného panela — spoľahlivý, keď je nastavený, a úplne nemý, keď nie je, a to je tá jediná porucha, ktorú watchdog mať nesmie. Nechajte prázdne, nech sa vypne.',

    // ---- čo ---------------------------------------------------------------
    'what' => 'Na čo sa stráži',
    'what_helper' => 'Každé meranie tu je meranie, ktoré panel aj tak robí. Nič na tejto stránke neotvára spojenie, ktoré by neotvárala stránka Stav systému.',

    'percent_helper' => 'Nula túto kontrolu vypína.',
    'disk' => 'Varovať, keď disk uzla presiahne',
    'memory' => 'Varovať, keď pamäť uzla presiahne',

    'maintenance' => 'Varovať na údržbu ponechanú dlhšie ako',
    'maintenance_helper' => 'Uzol v údržbe všetky ostatné kontroly preskakujú, a tak to má byť — a je to zároveň spôsob, ako sa na jeden na štrnásť dní zabudne. Nula toto vypína.',

    'versions' => 'Verzie panela a Wings',
    'versions_helper' => 'Jedna správa, keď niečo zaostane, a jedna, keď je to zase aktuálne. Bez pripomienok — verzia nie je výpadok.',

    'backups' => 'Zálohy, ktoré zaostávajú',
    'backups_helper' => 'Jedna správa, ktorá vymenuje servery, nie jedna na server — keď sa naplánovaná úloha zastaví, všetky servery zastarajú naraz, a štyridsať oddelených správ o jednej príčine je kanál, ktorý ľudia stlmia. V predvolenom stave vypnuté: panelu, ktorý zálohuje ručne a nie podľa plánu, by sa to vyčítalo denne.',
    'backup_days' => 'Záloha sa počíta ako prepadnutá po',
    'backup_days_helper' => 'To isté berie aj stránka Zálohy. Server, ktorý sa zálohuje raz týždenne, by sa nemal hlásiť po ôsmich dňoch.',
    'days' => 'dňoch',

    'worker' => 'Queue worker',
    'worker_helper' => 'Či niečo vôbec vykonáva prácu tohto pluginu na pozadí. Všimnite si ten kruh: sama kontrola beží vo fronte, takže panel, ktorý worker nikdy nemal, to nahlásiť nedokáže. Riadok hore na tejto stránke to dokáže.',

    // ---- tlačidlá ---------------------------------------------------------
    'save' => 'Uložiť',
    'saved' => 'Uložené',
    'save_failed' => 'Nič sa neuložilo',

    'test' => 'Poslať skúšku',
    'test_one' => 'Vyskúšať',
    'test_off' => 'Tento kanál je vypnutý',
    'test_off_body' => 'Zapnite ho a uložte, a vyskúša sa spolu s ostatnými.',
    'test_title' => 'Skúšobná správa',
    'test_body' => 'Ak toto čítate, upozornenia z vášho panela Pelican sem budú chodiť. Nič sa nedeje.',
    'test_sent' => 'Odoslané do každého zapnutého kanála',
    'test_failed' => 'Aspoň jeden kanál to odmietol',
    'test_none' => 'Nie je kam poslať',
    'test_none_body' => 'Žiadny kanál nie je zapnutý, takže by ani skutočné upozornenie nikam nedošlo.',

    /*
     * Čo s odmietnutím.
     *
     * Dôvod, ktorý uvedie poskytovateľ, je stručný a správny a sám osebe
     * neužitočný. Dva, ktoré vyplávajú takmer zakaždým, sú tu pomenované, lebo
     * ani jeden sa z kódu neuhádne: 553 je o odosielateľovi, nie o príjemcovi, a
     * 401 z Discordu je odvolaná alebo zle vložená URL.
     */
    'hint_email_sender' => 'Váš SMTP server odmietol tú adresu, z ktorej panel posiela, nie tú, na ktorú posielal. V Admin → Nastavenia → Pošta musí byť adresa odosielateľa schránka, z ktorej váš SMTP účet smie posielať. S týmto pluginom to nemá čo robiť — skúšobný mail samotného Pelicanu na tej istej stránke spadne úplne rovnako.',
    'hint_email' => 'Pozrite sa do Admin → Nastavenia → Pošta. Tlačidlo skúšobného mailu na tej stránke používa rovnaké nastavenia a povie to isté.',
    'hint_discord_url' => 'Discord tento webhook nepoznal. Bol zmazaný, vygenerovaný znova, alebo vložený len sčasti — vytvorte nový v Nastavenia servera → Integrácie → Webhooky a skopírujte celú URL.',
    'hint_discord' => 'Panel sa na Discord nedostal. Ak tento panel stojí za firewallom, ktorý blokuje odchádzajúce požiadavky, odtiaľto tento kanál fungovať nemôže.',
    'hint_panel' => 'Nikto na toto nemá oprávnenie, alebo sa upozornenie nepodarilo uložiť. Pozrite sa do Rolí.',

    'run_now' => 'Spustiť kontroly teraz',
    'run_started' => 'Kontroluje sa na pozadí',
    'run_failed' => 'Kontroly sa nepodarilo spustiť',

    'reset' => 'Zabudnúť, čo vie',
    'reset_confirm' => 'Zmaže to, čo každá kontrola naposledy povedala. Ďalší prechod sa učí od nuly a nič neodošle, takže ťažkosť, ktorá stále trvá, sa ohlási až o prechod ďalej. Použite to potom, čo ste vyradili uzol, o ktorom watchdog stále hovorí.',
    'reset_done' => 'Zmazané',

    // ---- samotné správy ---------------------------------------------------
    'still' => 'Trvá to :for.',
    'cleared_body' => 'Takto to bolo :for.',

    'for_unknown' => 'nejaký čas',
    'for_minutes' => ':count minút',
    'for_hours' => ':count hodín',
    'for_days' => ':count dní',

    'node_down' => ':node neodpovedá',
    'node_down_body' => 'Panel nedosiahne na daemona na :node. Servery na ňom nenaštartujú, nezastavia sa a nič nenahlásia, kým sa nevráti.',
    'node_up' => ':node zase odpovedá',

    'node_disk' => 'Na :node dochádza disk',
    'node_disk_body' => 'Disk na :node je zaplnený na :percent %, nad :limit %, ktoré ste nastavili. Zálohy a inštalácie serverov padajú ako prvé, keď toto dôjde hore.',
    'node_disk_over' => 'Disk na :node je zase pod limitom',

    'node_memory' => 'Na :node dochádza pamäť',
    'node_memory_body' => 'Pamäť na :node je využitá na :percent %, nad :limit %, ktoré ste nastavili. Servery na ňom môže zabiť jadro skôr, než čokoľvek nahlási ťažkosť.',
    'node_memory_over' => 'Pamäť na :node je zase pod limitom',

    'node_maintenance' => ':node je v údržbe už dlho',
    'node_maintenance_body' => ':node je v údržbe dlhšie ako :hours hodín. Zatiaľ sa na ňom nič ďalšie nekontroluje, čo je práve zmysel — ale vedieť, že v tom stave stále stojí, sa hodí.',
    'node_maintenance_over' => ':node je z údržby vonku',

    'wings_behind' => 'Wings na :node je zastaraný',
    'wings_behind_body' => ':node beží na Wings :installed a vonku je :latest. Aktualizujte ho na samotnom uzle — panel na to spôsob nemá.',
    'wings_current' => 'Wings na :node je aktuálny',

    'panel_behind' => 'Panel je zastaraný',
    'panel_behind_body' => 'Tento panel beží na :installed a vonku je :latest.',
    'panel_current' => 'Panel je aktuálny',

    'and_more' => 'a ďalšie :count',

    'owners' => 'Hovoriť ľuďom, keď stroj ich vlastného servera spadol',
    'owners_helper' => 'Jediná tunajšia kontrola, ktorá píše niekomu inému než vám. Vlastník každého servera na stroji, ktorý prestal odpovedať, dostane upozornenie v paneli — zvonček, nikdy e-mail — a ďalšie, keď sa stroj vráti. Medzi tým nikdy žiadnu pripomienku: opakovať to každú štvrťhodinu všetkým na vyťaženom uzle je spôsob, ako sa upozornenia z panela prestanú čítať. Subusers sa to nehovorí; rozhoduje o tom, čo robiť, vlastník. Stroj sa im nepomenúva, z toho istého dôvodu, z akého ho nezverejňuje stránka stavu.',

    'owner_down' => 'Jeden z vašich serverov je offline|Vašich serverov offline: :count',
    'owner_down_body' => 'Stroj, na ktorom stoja, prestal odpovedať. Komu treba, už bolo povedané. Týka sa to: :servers',
    'owner_up' => 'Váš server je späť|Vašich serverov sa vrátilo: :count',
    'owner_up_body' => 'Stroj zase odpovedá. Späť sú: :servers',

    'schedules' => 'Naplánované úlohy, ktoré zastali',
    'schedules_helper' => 'Úloha zaseknutá uprostred behu, taká, ktorej čas uplynul, lebo cron nebeží, alebo taká, ktorá nikdy nenabehla. Pelican nemá slovo ani pre jednu z troch — spadnutý beh ostane „spracúva sa" navždy a kreslí sa presne ako ten, ktorý práve ide. Pri každej kontrole číta všetky aktívne naplánované úlohy panela.',

    'schedule_stopped' => 'Zastavených naplánovaných úloh: :count',
    'schedule_stopped_body' => 'Zaseknuté dlhšie ako :hours hodín, oneskorené, alebo nikdy nespustené: :schedules',
    'schedule_running' => 'Všetky naplánované úlohy zase bežia',

    'backup_none' => 'Serverov bez jedinej zálohy: :count',
    'backup_none_body' => 'Nikdy sa nezálohovalo na: :servers',
    'backup_none_over' => 'Každý server už zálohu má',

    'backup_stale' => 'Serverov dlhšie bez zálohy: :count',
    'backup_stale_body' => 'Žiadna úspešná záloha za :days dní na: :servers',
    'backup_stale_over' => 'Každý server bol nedávno zazálohovaný',

    'backup_failed' => 'Zálohy zlyhávajú na serveroch: :count',
    'backup_failed_body' => 'Záloha skončila neúspešne na: :servers',
    'backup_failed_over' => 'Už nezlyháva žiadna záloha',

    'worker_missing' => 'Front nikto nespracúva',
    'worker_missing_body' => 'Úloha sa zaradila do frontu a nikto si ju nevzal. Aktualizácie pluginov, inštalácie modpackov a tieto kontroly stoja všetky, kým nebeží worker — skúste systemctl status pelican-queue na stroji panela.',
    'worker_back' => 'Front sa zase spracúva',
];
