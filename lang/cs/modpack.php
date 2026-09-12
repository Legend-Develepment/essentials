<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Modpack", „loader", „egg", „daemon", „mody" a „config" zůstávají anglicky:
 * to jsou slova z Modrinthu, ze správce souborů a z každého návodu, který se k
 * tomu najde.
 */

return [
    'nav_label' => 'Modpacky',
    'title' => 'Modpacky',
    'subheading' => 'Instalace modpacku z Modrinthu na tenhle server.',

    'section' => 'Najít pack',
    'section_helper' => 'Jen Modrinth a jen serverové packy. Nechce ani účet, ani klíč k API, a proto je tu jediným zdrojem - ostatní chtějí klíč někam vložený, než se vůbec něco objeví.',

    'search' => 'Hledat',
    'search_helper' => 'Nechte prázdné pro nejstahovanější. Hledání se ptá Modrinthu, takže proběhne, až z pole odejdete, ne během psaní.',

    'pack' => 'Pack',
    'pack_helper' => 'Vypsané jsou jen packy, které o sobě říkají, že běží na serveru.',

    'version' => 'Verze',
    'version_helper' => 'Verze hry a loader jsou u každé uvedené. Vyberte loader, který egg tohohle serveru už spouští - tohle instaluje soubory a nemění ani váš egg, ani spouštěcí příkaz.',

    'downloads' => 'stažení',

    'install' => 'Nainstalovat tenhle pack',
    'install_go' => 'Nainstalovat',
    'install_confirm' => 'Soubory packu se přidají k tomuhle serveru. **Nic se nemaže** - ani váš svět, ani staré mody, ani config. Pack nainstalovaný přes jiný nechá oba, takže mody předchozího packu nejdřív odstraňte sami, pokud jde o tohle. Server musí být zastavený a zastavený i zůstane.',

    'started' => 'Instaluje se',
    'started_helper' => 'Pack se stahuje a rozbaluje. Několik set souborů zabere pár minut a na konci dostanete upozornění - jede to dál, i když z téhle stránky odejdete.',

    'running' => 'Server běží',
    'running_helper' => 'Minecraft načítá mody při startu, takže pack nainstalovaný teď by nechal server, který do restartu není ani starý pack, ani nový. Zastavte ho a zkuste to znovu.',

    'done' => ':pack nainstalován',
    'done_body' => 'Staženo souborů: :files, položek z vlastní složky packu rozmístěno: :overrides. Server spusťte, až budete chtít.',
    'done_refused' => 'Přeskočeno souborů: :count - pack o ně žádal odtud, odkud se tady nestahuje.',

    'failed' => 'Pack se nenainstaloval',
    'failed_fetch' => 'Pack se nepodařilo stáhnout nebo rozbalit. Daemon může být nedostupný, nebo serveru mohl dojít disk.',
    'failed_index' => 'Pack se stáhl, ale uvnitř neměl čitelný rejstřík, takže nebylo co instalovat.',
    'failed_version' => 'Tahle verze už nemá soubor packu ke stažení. Vyberte jinou.',
    'failed_queue' => 'Instalaci se nepodařilo zařadit do fronty. K tomu je potřeba běžící queue worker na panelu.',
];
