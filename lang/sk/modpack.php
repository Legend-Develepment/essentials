<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Modpack", „loader", „egg", „daemon", „mody" a „config" ostávajú po anglicky:
 * to sú slová z Modrinthu, zo správcu súborov a z každého návodu, ktorý sa k
 * tomu nájde.
 */

return [
    'nav_label' => 'Modpacky',
    'title' => 'Modpacky',
    'subheading' => 'Inštalácia modpacku z Modrinthu na tento server.',

    'section' => 'Nájsť pack',
    'section_helper' => 'Len Modrinth a len serverové packy. Nechce ani účet, ani kľúč k API, a preto je tu jediným zdrojom - ostatné chcú kľúč niekam vložený, kým sa vôbec niečo objaví.',

    'search' => 'Hľadať',
    'search_helper' => 'Nechajte prázdne pre najsťahovanejšie. Hľadanie sa pýta Modrinthu, takže prebehne, až z poľa odídete, nie počas písania.',

    'pack' => 'Pack',
    'pack_helper' => 'Vypísané sú len packy, ktoré o sebe hovoria, že bežia na serveri.',

    'version' => 'Verzia',
    'version_helper' => 'Verzia hry a loader sú pri každej uvedené. Vyberte loader, ktorý egg tohto servera už spúšťa - toto inštaluje súbory a nemení ani váš egg, ani spúšťací príkaz.',

    'downloads' => 'stiahnutí',

    'install' => 'Nainštalovať tento pack',
    'install_go' => 'Nainštalovať',
    'install_confirm' => 'Súbory packu sa pridajú k tomuto serveru. **Nič sa nemaže** - ani váš svet, ani staré mody, ani config. Pack nainštalovaný cez iný nechá oba, takže mody predchádzajúceho packu najprv odstráňte sami, ak ide o toto. Server musí byť zastavený a zastavený aj ostane.',

    'started' => 'Inštaluje sa',
    'started_helper' => 'Pack sa sťahuje a rozbaľuje. Niekoľko sto súborov zaberie pár minút a na konci dostanete upozornenie - ide to ďalej, aj keď z tejto stránky odídete.',

    'running' => 'Server beží',
    'running_helper' => 'Minecraft načítava mody pri štarte, takže pack nainštalovaný teraz by nechal server, ktorý do reštartu nie je ani starý pack, ani nový. Zastavte ho a skúste to znova.',

    'done' => ':pack nainštalovaný',
    'done_body' => 'Stiahnutých súborov: :files, položiek z vlastného priečinka packu rozmiestnených: :overrides. Server spustite, keď budete chcieť.',
    'done_refused' => 'Preskočených súborov: :count - pack o ne žiadal odtiaľ, odkiaľ sa tu nesťahuje.',

    'failed' => 'Pack sa nenainštaloval',
    'failed_fetch' => 'Pack sa nepodarilo stiahnuť ani rozbaliť. Daemon môže byť nedostupný, alebo serveru mohol dôjsť disk.',
    'failed_index' => 'Pack sa stiahol, ale vnútri nemal čitateľný register, takže nebolo čo inštalovať.',
    'failed_version' => 'Táto verzia už nemá súbor packu na stiahnutie. Vyberte inú.',
    'failed_queue' => 'Inštaláciu sa nepodarilo zaradiť do frontu. Na to treba bežiaci queue worker na paneli.',
];
