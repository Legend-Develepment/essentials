<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Steam App ID", „IGDB", „Twitch client ID" i „client secret" zostają po
 * angielsku: to dokładnie te słowa, które widnieją na stronach, z których te
 * wartości pochodzą.
 */

return [
    'title' => 'Obrazki eggów',
    'nav_label' => 'Obrazki eggów',
    'subheading' => 'Grafiki gier dla Twoich eggów, pobierane ze Steama i z IGDB. Egg bez obrazka pokazuje własnego ptaka Pelicana na każdej karcie serwera, który go używa.',

    // ---- tabela -----------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Zablokowany',

    'locked' => 'Zablokowany',
    'unlocked' => 'Wolny',

    // ---- co można zrobić z wierszem ---------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Liczba w adresie gry na Steamie - store.steampowered.com/app/892970 to 892970. Pobranie po identyfikatorze blokuje obrazek, bo wpisanie liczby jest decyzją, a późniejszy przebieg zbiorczy nie może jej cofnąć.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Szukaj',
    'search_term_helper' => 'Nazwa egga jest już wpisana, ale rzadko jest nazwą gry - „Paper 1.20.4" to Minecraft. Wpisz grę.',

    'lock' => 'Zablokuj',
    'unlock' => 'Odblokuj',
    'locked_done' => 'Zablokowany - przebieg zbiorczy zostawi ten w spokoju',
    'unlocked_done' => 'Odblokowany - przebieg zbiorczy może podmienić ten obrazek',

    'clear' => 'Wyczyść',
    'clear_confirm' => 'Usuwa obrazek i Steam App ID. Egg wraca do własnego ptaka Pelicana, a następny przebieg zbiorczy spróbuje jeszcze raz.',
    'cleared' => 'Obrazek usunięty',

    // ---- wyniki -----------------------------------------------------------
    'fetched' => 'Obrazek zapisany',
    'failed' => 'Żaden obrazek nie został zapisany',

    /*
     * Osobny powód dla każdego, bo to różne problemy.
     *
     * Pobranie, które padło przez literówkę, i takie, które padło, bo dysk jest
     * pełny, nie powinny oba mówić „nie udało się" - pierwsze naprawia się
     * patrząc na liczbę, drugie patrząc na serwer.
     */
    'why_bad_id' => 'To nie jest Steam App ID.',
    'why_not_found' => 'Steam nie ma niczego pod tym adresem. Sprawdź App ID - gra bez strony w sklepie nie ma też grafiki nagłówkowej.',
    'why_no_match' => 'Nic nie znaleziono pod tą nazwą. Spróbuj tego, jak gra naprawdę się nazywa, zamiast nazwy egga.',
    'why_no_name' => 'Nie ma czego szukać.',
    'why_no_token' => 'Twitch nie wydał tokenu. Sprawdź client ID i secret w „Poświadczeniach".',
    'why_not_configured' => 'IGDB potrzebuje Twitch client ID i secretu. Wpisz je w „Poświadczeniach".',
    'why_empty' => 'Odpowiedź była pusta.',
    'why_large' => 'Ten obrazek jest znacznie większy niż ikona i nie został zapisany.',
    'why_not_an_image' => 'To, co wróciło, nie jest obrazkiem. Zwykle znaczy to, że strona błędu odpowiedziała kodem sukcesu.',
    'why_wrong_format' => 'Ten obrazek jest w formacie, którego ten panel nie przechowuje. Pelican trzyma PNG, JPEG i WebP.',
    'why_unwritable' => 'Nie udało się zapisać obrazka. Sprawdź, czy storage/app/public należy do użytkownika, na którym działa panel, i czy uruchomiono php artisan storage:link.',
    'why_unknown' => 'Nie zadziałało, a powodu ten kod nie umie nazwać.',

    // ---- wszystko naraz ---------------------------------------------------
    'bulk' => 'Pobierz wszystkie brakujące',
    'bulk_confirm_steam' => 'Szuka na Steamie po nazwie dla każdego egga, który nie ma obrazka i nie jest zablokowany. Eggi zablokowane i te, które mają już obrazek, są zostawiane w spokoju. Leci to w tle - dostaniesz wiadomość, gdy się skończy.',
    'bulk_confirm_both' => 'Szuka na Steamie po nazwie dla każdego egga, który nie ma obrazka i nie jest zablokowany, a potem próbuje IGDB dla tego, czego Steam nie znalazł. Eggi zablokowane i te, które mają już obrazek, są zostawiane w spokoju. Leci to w tle - dostaniesz wiadomość, gdy się skończy.',

    'bulk_started' => 'Pobieranie w tle',
    'bulk_started_body' => 'Na dużym panelu może to zająć kilka minut. Dostaniesz powiadomienie, gdy będzie gotowe, i możesz opuścić tę stronę.',

    'bulk_done' => 'Obrazki eggów gotowe',
    'bulk_done_body' => 'Pobrano :fetched, zostawiono w spokoju :skipped, bez znaleziska :failed. Egg zostaje w spokoju, gdy jest zablokowany albo już ma obrazek.',

    'bulk_failed' => 'Przebieg zbiorczy się nie odbył',
    'bulk_failed_queue' => 'Nie udało się przekazać go do kolejki. To wymaga queue workera - sprawdź, czy pelican-queue działa.',

    // ---- poświadczenia IGDB -----------------------------------------------
    'credentials' => 'Poświadczenia',
    'credentials_helper' => 'Steam działa bez tego wszystkiego. Te dane są tylko dla IGDB, które obejmuje gry, o jakich Steam nigdy nie słyszał - Minecrafta i każdą jego odmianę, wszystko, co wyszło na konsoli, większość eggów z modami.',
    'credentials_where' => 'Załóż aplikację na dev.twitch.tv/console, wygeneruj client secret i wklej oba tutaj. Jest to darmowe.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Poświadczenia zapisane',
    'credentials_failed' => 'Nie udało się zapisać poświadczeń',
];
