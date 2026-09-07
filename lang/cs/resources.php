<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Mod", „plugin", „loader", „jar" a názvy složek mods/ a plugins/ zůstávají,
 * jak jsou: to jsou slova z Modrinthu, ze správce souborů a z každého návodu,
 * který se k tomu najde.
 */

return [
    'nav_label' => 'Mody a pluginy',
    'title' => 'Mody a pluginy',
    'subheading' => 'Po jednom, z Modrinthu, na tenhle server.',

    'section' => 'Najít něco',
    'section_helper' => 'Stránka modpacků instaluje celý pack najednou. Tady se instaluje jeden mod nebo jeden plugin — a to se chce mnohem častěji.',

    'kind' => 'Co přidáváte',
    /*
     * Zeptáno, ne odvozeno. Egg se jmenuje tak, jak ho pojmenoval
     * administrátor, a několik loaderů čte obě složky, takže odtud není poctivý
     * způsob, jak to uhodnout - a špatný odhad zapíše jar do složky, kterou
     * nikdo nečte.
     */
    'kind_helper' => 'Mod jde do mods/ a je pro Fabric, Forge nebo NeoForge. Plugin jde do plugins/ a je pro Bukkit, Spigot nebo Paper. Tohle taky rozhoduje, ve které polovině Modrinthu se hledá.',
    'kind_mod' => 'Mod (mods/)',
    'kind_plugin' => 'Plugin (plugins/)',

    'search' => 'Hledat',
    'search_helper' => 'Napište název a klikněte mimo pole. Výsledky jdou podle počtu stažení.',

    'project' => 'Mod nebo plugin',
    'version' => 'Verze',
    'version_helper' => 'V každém řádku je číslo verze, verze Minecraftu, pro které je sestavená, a podporované loadery. Vyberte tu, která sedí vašemu serveru — tady to za vás nikdo nekontroluje.',

    'install' => 'Nainstalovat',
    'install_confirm' => 'Soubor stáhne uzel přímo z Modrinthu a položí ho do složky. Nic z toho, co tam už je, se neodebírá.',
    'installed' => 'Nainstalováno',
    'installed_helper' => 'Načte se při příštím spuštění serveru.',

    'change' => 'Změnit verzi',
    'change_helper' => 'Dá na místo tohohle souboru jinou verzi téhož projektu. Nová se stáhne dřív, než se stará smaže, takže neúspěšné stahování vás nechá s tím, co jste už měli.',
    'change_project_helper' => 'Pevné pro všechno, co bylo nainstalováno z téhle stránky. Změnit to by nebyla změna verze — byl by to jiný mod pod stejným názvem souboru.',
    'change_lookup_helper' => 'Tenhle soubor už ve složce ležel, takže tady nikdo neví, co to je. Jednou ho vyhledejte a zapamatuje se.',
    'changed' => 'Verze změněna',

    'check' => 'Zkontrolovat aktualizace',
    'checked' => 'Zkontrolováno',
    'checked_none' => 'Všechno známé je ve své nejnovější verzi.',
    'checked_some' => 'Novější verzi má :count. Jsou v seznamu označené.',
    'update_ready' => 'dostupná v:number',
    /*
     * Řečeno vedle odznáčku, ne v bublině, protože to mění, co odznáček
     * znamená: tady nikdo neví, kterou verzi Minecraftu a který loader server
     * spouští.
     */
    'check_note' => 'Novější znamená novější na Modrinthu. Tady nikdo neví, kterou verzi Minecraftu a který loader váš server spouští, tak si před spuštěním serveru ověřte, že vybraná verze o sobě říká, že sedí.',
    'unknown' => 'Ne odsud — použijte „Změnit verzi", ať se řekne, co to je',

    'remove' => 'Odebrat',
    'remove_confirm' => 'Soubor se ze serveru smaže. Odsud se to nedá vrátit.',
    'removed' => 'Odebráno',

    'running' => 'Server běží',
    'running_helper' => 'Minecraft čte mods/ a plugins/ jednou, při startu. Soubor přidaný teď by se načetl až po restartu, a soubor vytažený zpod běžící hry ji může vzít s sebou. Nejdřív server zastavte.',

    'failed' => 'Tohle nevyšlo',
    'failed_version' => 'Tahle verze nemá jar, který by šlo tady nainstalovat. Některá vydání obsahují jen zdrojáky nebo jen klientský build.',
    'failed_write' => 'Uzel stahování odmítl. Možná se nedostal na Modrinth.',

    'installed_title' => 'Nainstalováno',
    'installed_mods' => 'V mods/',
    'installed_plugins' => 'V plugins/',
    /*
     * Řečeno proto, že prázdný seznam je dvojznačný: obvykle znamená, že tenhle
     * server tu složku vůbec nepoužívá, ne že něco chybí.
     */
    'installed_empty' => 'Tady nic není. Server používá jen jednu z těch dvou složek, takže že je jedna prázdná, je normální.',
    'installed_note' => 'Vypsané jsou jen soubory .jar. Konfigurační složky a vypnuté soubory se nechávají být a neukazují se.',
];
