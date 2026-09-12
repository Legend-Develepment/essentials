<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Mod“, „plugin“, „loader“, „jar“ ir aplankų pavadinimai mods/ bei plugins/
 * lieka: būtent taip jie rašomi Modrinth ir serverio failų medyje.
 */

return [
    'nav_label' => 'Modai ir papildiniai',
    'title' => 'Modai ir papildiniai',
    'subheading' => 'Po vieną iš karto, iš Modrinth, į šį serverį.',

    'section' => 'Surask ką nors',
    'section_helper' => 'Modpack puslapis įdiegia visą paketą iš karto. Šis įdiegia vieną vienintelį modą ar papildinį, o to norisi kur kas dažniau.',

    'kind' => 'Ką pridedi',
    /*
     * Paklausta, o ne išvesta. Egg vadinasi taip, kaip jį pavadino
     * administratorius, o keli loader skaito abu aplankus, tad iš čia nėra
     * sąžiningo būdo to atspėti - o klaidinga prielaida įrašo jar į aplanką,
     * kurio niekas neskaito.
     */
    'kind_helper' => 'Modas eina į mods/ ir skirtas Fabric, Forge ar NeoForge. Papildinys eina į plugins/ ir skirtas Bukkit, Spigot ar Paper. Tai lemia ir tai, kurioje Modrinth pusėje bus ieškoma.',
    'kind_mod' => 'Modas (mods/)',
    'kind_plugin' => 'Papildinys (plugins/)',

    'search' => 'Paieška',
    'search_helper' => 'Įrašyk pavadinimą ir spustelėk už lauko. Rezultatai ateina su daugiausiai atsisiųstais priekyje.',

    'project' => 'Modas ar papildinys',
    'version' => 'Versija',
    'version_helper' => 'Kiekviena eilutė yra versijos numeris, Minecraft versijos, kurioms ji sudėta, ir loader, kuriuos ji palaiko. Pasirink tą, kuri tinka tavo serveriui - niekas čia to už tave nepatikrina.',

    'install' => 'Įdiegti',
    'install_confirm' => 'Failą node parsiunčia tiesiai iš Modrinth ir įdeda į aplanką. Niekas iš to, kas ten jau yra, nešalinama.',
    'installed' => 'Įdiegta',
    'installed_helper' => 'Įkeliama kitą kartą paleidus serverį.',

    'change' => 'Keisti versiją',
    'change_helper' => 'Įdeda kitą to paties projekto versiją šio failo vieton. Naujoji parsiunčiama prieš ištrinant senąją, tad nepavykęs parsiuntimas palieka tave su tuo, ką jau turėjai.',
    'change_project_helper' => 'Užfiksuota viskam, kas įdiegta iš šio puslapio. Jį pakeisti nebūtų versijos keitimas - tai būtų kitas modas tuo pačiu failo vardu.',
    'change_lookup_helper' => 'Šis failas jau buvo aplanke, tad niekas čia nežino, kas jis toks. Surask jį vieną kartą, ir tai bus įsiminta.',
    'changed' => 'Versija pakeista',

    'check' => 'Tikrinti atnaujinimus',
    'checked' => 'Patikrinta',
    'checked_none' => 'Viskas žinoma yra ties naujausia savo versija.',
    'checked_some' => 'Su naujesne versija: :count. Jie pažymėti sąraše.',
    'update_ready' => 'v:number prieinama',
    /*
     * Pasakyta šalia ženklelio, o ne patarime, nes tai keičia, ką ženklelis
     * reiškia. Niekas čia nežino, kurią Minecraft versiją ar kurį loader
     * serveris paleidžia, tad naujausia reiškia naujausia, o ne naujausia,
     * kuri veiks.
     */
    'check_note' => 'Naujesnė reiškia naujesnė Modrinth. Niekas čia nežino, kurią Minecraft versiją ar kurį loader paleidžia tavo serveris, tad patikrink, ar pasirinkta versija sako, kad tinka, prieš paleisdamas serverį.',
    'unknown' => 'Ne iš čia - naudokis Keisti versiją, kad pasakytum, kas tai',

    'remove' => 'Pašalinti',
    'remove_confirm' => 'Failas ištrinamas iš serverio. Iš čia to atšaukti negalima.',
    'removed' => 'Pašalinta',

    'running' => 'Serveris veikia',
    'running_helper' => 'Minecraft skaito mods/ ir plugins/ vieną kartą, paleidžiamas. Dabar pridėtas failas nebūtų įkeltas iki paleidimo iš naujo, o ištrauktas iš po veikiančio žaidimo gali nusinešti žaidimą kartu. Pirma sustabdyk serverį.',

    'failed' => 'Nepavyko',
    'failed_version' => 'Ta versija neturi jar, kurį tai galėtų įdiegti. Kai kurios laidos neša tik pirminį kodą arba tik kliento sudėjimą.',
    'failed_write' => 'Node atmetė parsiuntimą. Gali būti, kad jis nepasiekė Modrinth.',

    'installed_title' => 'Įdiegta',
    'installed_mods' => 'Aplanke mods/',
    'installed_plugins' => 'Aplanke plugins/',
    /*
     * Pasakyta, nes tuščias sąrašas dviprasmiškas: paprastai jis reiškia, kad
     * šis serveris to aplanko apskritai nenaudoja, o ne kad kažko trūksta.
     */
    'installed_empty' => 'Čia nieko nėra. Serveris naudoja tik vieną iš šių dviejų aplankų, tad tai, kad vienas tuščias, yra normalu.',
    'installed_note' => 'Išvardijami tik .jar failai. Konfigūracijos aplankai ir išjungti failai paliekami ramybėje ir nerodomi.',
];
