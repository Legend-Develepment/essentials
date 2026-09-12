<?php

/*
 * Svenska. Skriven för hand.
 *
 * «SteamID64» och «PlayFab ID» står kvar precis som de stavas på de ställen man
 * hämtar dem från. «Admin» står också kvar: det är ordet i spelets egen fil.
 */

return [
    /* ---------------------------------------------- administratörsfliken - */

    'section_helper' => 'Vilka eggs som kör Valheim. Inget annat - en Valheim-server ställs in med sina startvariabler, och Pelicans egen Startup-sida redigerar redan dem.',

    'eggs' => 'Vilka eggs är Valheim',
    'eggs_helper' => 'Kryssa i de eggs som kör en Valheim-server. En sida med spelarlistor dyker upp inne i de servrar som använder dem, och ingen annanstans. Var listorna ligger skiljer sig mellan eggs, så det räknas ut per server genom att titta på de ställen spelet använder. Ingenting är ikryssat till att börja med, med flit - ett plugin kan inte veta vad du har döpt dina eggs till.',

    /* -------------------------------------------------- serverns sida ---- */

    'nav_label' => 'Spelarlistor',
    'title' => 'Valheims spelarlistor',
    'subheading' => 'Admins, bannade och den tillåtna listan, som tre listor i stället för tre textfiler.',

    'admin' => 'Admins',
    'admin_helper' => 'Alla här kan använda adminkommandona i spelet.',
    'banned' => 'Bannade',
    'banned_helper' => 'Alla här nekas när de försöker gå med.',
    'permitted' => 'Tillåtna',
    'permitted_helper' => 'Står det någon på den här listan får bara de gå med. En tom lista släpper in alla - vilket är vad de flesta servrar vill, så lämna den tom om du inte menar något annat.',

    'ids' => 'Spelar-ID:n',
    'ids_placeholder' => 'Klistra in ett ID och tryck mellanslag',

    'how' => 'Ett ID per spelare - ett SteamID64 på en Steam-server, ett PlayFab ID på en med crossplay. Klistra in dem och tryck mellanslag, tabb eller komma. Allt spelet skrev som en kommentar ovanför listan står kvar där det är.',
    'where' => 'Läst från :dir.',
    'missing' => 'Den här servern har ännu ingen av de här filerna. Spelet skriver dem när det först behöver dem, och att spara här skapar de du fyller i.',
    'read_only' => 'Du får läsa de här filerna men inte skriva dem, så ingenting här går att ändra.',

    'save' => 'Spara',
    'saved' => 'Sparat',
    'saved_reload' => 'Valheim läser de här listorna medan det kör, så ändringen gäller utan omstart.',
    'unchanged' => 'Ingenting hade ändrats, så ingenting skrevs',
    'failed' => 'Det gick inte att spara',
    'failed_lists' => 'Daemonen nekade skrivningen för: :lists. Kontrollera att servern går att nå och att filerna inte är skrivskyddade.',
];
