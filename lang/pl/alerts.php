<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Watchdog.
 *
 * Każdą wiadomość stąd czyta się na telefonie, o trzeciej w nocy, gdy minutę
 * wcześniej się spało. Każda mówi, która maszyna, co jest nie tak, i nic więcej
 * - szczegół należy do strony, którą ten ktoś otworzy za chwilę, a nie do
 * wiersza, który go obudził.
 *
 * Powrót do normy jest napisany jak wiadomość, a nie jak dopisek. „Czy już
 * wróciło?" to pytanie, dla którego ktoś inaczej by wstał.
 *
 * „Node", „Wings", „daemon", „webhook", „queue", „Discord" i „SMTP" zostają po
 * angielsku: pod tymi nazwami odnajduje się je w Pelicanie, na hoście i we
 * wszystkim, co się o nich pisze.
 */

return [
    'title' => 'Alerty',
    'nav_label' => 'Alerty',
    'subheading' => 'Panel już wie, kiedy węzeł przestaje odpowiadać, kiedy dysk się zapełnia albo kiedy kolejka staje. To jest to, co Ci o tym mówi.',

    // ---- kanały i to, co ostatnio zrobiły ---------------------------------
    'channels' => 'Dokąd idą wiadomości',
    'channels_helper' => 'Co zrobił każdy kanał, gdy ostatnio poproszono go o wysłanie czegoś. Kanał, który jest włączony i po cichu odmawia, wygląda dokładnie tak jak panel, z którym wszystko jest w porządku, i dlatego to jest pierwsza rzecz na tej stronie.',

    'state_off' => 'Wyłączony',
    'state_untried' => 'Nic jeszcze nie wysłano',
    'state_ok' => 'Dostarczono',
    'state_failed' => 'Odrzucono',

    // ---- kiedy ------------------------------------------------------------
    'when' => 'Jak często',
    'when_helper' => 'Sprawdzenia lecą w tle, więc potrzebują queue workera. Bez niego nic nie jest wysyłane i nic tego nie mówi - użyj „Wyślij test", który nie idzie przez kolejkę.',

    'every' => 'Sprawdzaj co',
    'every_helper' => 'Każde sprawdzenie sięga do daemona każdego węzła, więc to jedno żądanie na węzeł i na przebieg. Piętnaście minut wystarcza, żeby usłyszeć o awarii, póki jeszcze jest awarią.',
    'every_off' => 'Wyłączone - żadnych sprawdzeń',
    'every_five' => '5 minut',
    'every_fifteen' => '15 minut',
    'every_thirty' => '30 minut',
    'every_hourly' => 'Godzina',
    'every_daily' => 'Dzień',

    'repeat' => 'Przypominaj mi, dopóki trwa',
    'repeat_helper' => 'Wiadomość wychodzi, gdy coś się zmienia, i druga, gdy wraca do normy. To dodaje przypomnienie, dopóki problem trwa. Zero znaczy bez przypomnień - kanał, który powtarza się co kwadrans, to kanał, który ludzie wyciszają.',
    'hours' => 'godzin',

    // ---- gdzie ------------------------------------------------------------
    'where' => 'Kanały',
    'where_helper' => 'Więcej niż jeden ma sens. Psują się na różne sposoby.',

    'discord' => 'Discord',
    'discord_helper' => 'Miejsce, w którym wiadomość naprawdę czyta ktoś, kto nie patrzy w panel.',
    'webhook' => 'Adres webhooka',
    'webhook_helper' => 'W Discordzie: Ustawienia serwera → Integracje → Webhooki → Nowy webhook → Kopiuj URL webhooka. Ograniczone do https, bo to publikuje, która z Twoich maszyn padła i jak pełny jest jej dysk.',
    'bot' => 'Twój własny bot',
    'bot_helper' => 'Jedno podpisane wysłanie JSON pod adres, który sam prowadzisz, żeby coś spoza panelu dowiedziało się o martwym node zamiast pytać co minutę, czy taki jest. Webhooki, które daje Pelican, tego nie udźwigną: uruchamiają się na modelach i na dzienniku aktywności, a node, który przestał odpowiadać, nie zapisuje ani jednego, ani drugiego.',
    'bot_url' => 'Dokąd to wysłać',
    'bot_url_helper' => 'Ograniczone do https, bo to wysyła, która z Twoich maszyn padła, pod adres w internecie.',
    'bot_secret' => 'Sekret do podpisu',
    'bot_secret_helper' => 'Wspólny z tym, co to odbiera. Treść jest nim haszowana, a wynik jedzie w X-Essentials-Signature jako sha256=<hex>, żeby Twój bot mógł odrzucić wszystko, co nie przyszło z tego panelu. Dopóki to jest puste, nic nie jest wysyłane - podpis, który jest opcjonalny, to podpis, którego nikt nie sprawdza.',
    'facts' => 'Mów botowi także o tym, co się wydarzyło',
    'facts_helper' => 'Wszystko powyżej to awaria. To nie: to rzeczy, które po prostu się wydarzyły. Każda jest wyłączona, dopóki jej nie zaznaczysz, więc aktualizacja niczego nie zmienia, a trafiają tylko do bota, nigdy na Discord, dzwonek ani e-mail.',

    'panel' => 'W panelu',
    'panel_helper' => 'Powiadomienie dla każdego, kto ma to uprawnienie. Działa zawsze, nie wymaga żadnej konfiguracji i jest niewidoczne dla każdego, kto nie jest zalogowany.',

    'email' => 'E-mail',
    'email_helper' => 'Oddzielone przecinkami. Używa mailera samego panelu - niezawodnego, gdy jest skonfigurowany, i całkiem cichego, gdy nie jest, a to jedyna awaria, której watchdog mieć nie może. Zostaw puste, żeby wyłączyć.',

    // ---- co ---------------------------------------------------------------
    'what' => 'Co jest pilnowane',
    'what_helper' => 'Każdy odczyt tutaj to odczyt, który panel i tak wykonuje. Nic na tej stronie nie otwiera połączenia, którego nie otwiera strona Stan systemu.',

    'percent_helper' => 'Zero wyłącza to sprawdzenie.',
    'disk' => 'Ostrzegaj, gdy dysk węzła przekroczy',
    'memory' => 'Ostrzegaj, gdy pamięć węzła przekroczy',

    'maintenance' => 'Ostrzegaj o konserwacji zostawionej dłużej niż',
    'maintenance_helper' => 'Węzeł w konserwacji jest pomijany przez każde inne sprawdzenie i tak ma być - i tak samo się o jednym zapomina na dwa tygodnie. Zero to wyłącza.',

    'versions' => 'Wersje panelu i Wings',
    'versions_helper' => 'Jedna wiadomość, gdy coś zostaje w tyle, i jedna, gdy znów jest aktualne. Bez przypomnień - wersja to nie awaria.',

    'backups' => 'Kopie zapasowe zostające w tyle',
    'backups_helper' => 'Jedna wiadomość wymieniająca serwery, a nie po jednej na serwer - gdy zadanie zaplanowane staje, wszystkie serwery przeterminowują się naraz, a czterdzieści osobnych wiadomości o jednej przyczynie to kanał, który ludzie wyciszają. Domyślnie wyłączone: panelowi, który robi kopie ręcznie, a nie z harmonogramu, wypominano by to codziennie.',
    'backup_days' => 'Kopia liczy się jako przeterminowana po',
    'backup_days_helper' => 'Tego samego używa strona Kopie zapasowe. Serwer z kopią raz w tygodniu nie powinien być zgłaszany po ośmiu dniach.',
    'days' => 'dniach',

    'stock' => 'Pakiety, które się kończą',

    'unbuilt_switch_helper' => 'Zamówienie z opłaconą fakturą, którego serwer odrzucił węzeł. Jedyna kontrola tutaj, przy której ktoś jest bez pieniędzy i nic tego nie mówi: cała reszta na tej liście to maszyna, która stanęła. Wyłączone, dopóki go nie włączysz, jak reszta.',

    'unbuilt_switch' => 'Opłacone i nieutworzone',
    'stock_helper' => 'Jedna wiadomość wymieniająca pakiety, a nie po jednej na pakiet, i nigdy przypomnienie: wyprzedanie to zwykły stan sklepu, a nie awaria, a słuchanie o tym co cztery godziny to sposób, w jaki to przestaje być czytane. Sprawdzane są tylko pakiety z limitem, więc sklep, który sprzedaje wszystko bez ograniczeń, nie kosztuje tu nic. Domyślnie wyłączone, jak reszta.',
    'modules_switch' => 'Moduł, który jest włączony i nie działa',
    'modules_switch_helper' => 'Jedna wiadomość na moduł, a nie jedna na wszystkie naraz, bo z każdym jest nie tak co innego i zdanie musi powiedzieć co. Zgłasza dwie rzeczy: moduł, któremu brakuje tabel, czyli instalację, która nie doszła do końca, oraz moduł z włączonymi częściami, które czekają, aż coś zostanie uzupełnione. Strona Moduły pokazuje jedno i drugie na karcie; to jest dla paneli, do których nikt nie zagląda. Domyślnie wyłączone, jak reszta.',
    'module_tables_title' => 'Moduł :module jest włączony, a jego tabel brakuje',
    'module_tables' => 'Strony należące do modułu :module chowają się, bo tabel, z których czytają, nie ma - zwykle to instalacja, która nie doszła do końca. Otwórz stronę Moduły, wyłącz go i włącz z powrotem, a tabele zostaną utworzone.',
    'module_waiting_title' => 'Moduł :module jest włączony, a jego część czeka',
    'module_waiting' => '{1} Jedna część modułu :module jest włączona i nic nie pokazuje, dopóki czegoś nie uzupełnisz: których eggów dotyczy, jakie style są do wyboru, które serwery ma pokazywać publiczna strona. Strona Moduły mówi które, na karcie.|[2,*] Włączonych części modułu :module, które nic nie pokazują, dopóki czegoś nie uzupełnisz: :count. Chodzi o to, których eggów dotyczą, jakie style są do wyboru i które serwery ma pokazywać publiczna strona. Strona Moduły mówi które, na karcie.',
    'module_cleared' => 'Moduł :module znów działa',
    'ports_switch' => 'Kończące się porty',
    'ports_switch_helper' => 'Jedna wiadomość na pakiet, a nie jedna na wszystkie naraz, bo przydatne są zakres i liczba, a lista nazw nie. Sprawdzane są tylko pakiety z ustawionym zakresem, więc pilnowanie sklepu, w którym zakup może zająć dowolny wolny port, nic nie kosztuje. Domyślnie wyłączone, jak reszta.',
    'stock_left' => 'Ostrzegaj, gdy zapas spadnie do',
    'stock_left_helper' => 'Liczone względem limitu ustawionego na pakiecie. Pakiet musi zejść do tej liczby, żeby o nim usłyszeć, i wspiąć się o dwa powyżej, żeby znów uchodził za zdrowy, więc taki, którym zakup i rezygnacja rzucają w tę i z powrotem, nic nie mówi. Zero jest tu liczbą, a nie brakiem: wycisza ostrzeżenie i zostawia tylko wiadomość o tym, że pakietu zabrakło.',
    'stock_left_suffix' => 'sztuk',

    'worker' => 'Queue worker',
    'worker_helper' => 'Czy cokolwiek wykonuje pracę w tle tej wtyczki. Zauważ, że to koło się zamyka: samo sprawdzenie leci na kolejce, więc panel, który nigdy nie miał workera, nie umie tego zgłosić. Wiersz na górze tej strony umie.',

    // ---- przyciski --------------------------------------------------------
    'save' => 'Zapisz',
    'saved' => 'Zapisano',
    'save_failed' => 'Nic nie zostało zapisane',

    'test' => 'Wyślij test',
    'test_one' => 'Testuj',
    'test_off' => 'Ten kanał jest wyłączony',
    'test_off_body' => 'Włącz go i zapisz, a zostanie przetestowany razem z resztą.',
    'test_title' => 'Wiadomość testowa',
    'test_body' => 'Jeśli to czytasz, alerty z Twojego panelu Pelican będą tu docierać. Nic się nie stało.',
    'test_sent' => 'Wysłano do każdego włączonego kanału',
    'test_failed' => 'Co najmniej jeden kanał to odrzucił',
    'test_none' => 'Nie ma dokąd wysłać',
    'test_none_body' => 'Żaden kanał nie jest włączony, więc prawdziwy alert też nie poszedłby nigdzie.',

    /*
     * Co zrobić z odmową.
     *
     * Powód podany przez dostawcę jest zwięzły i poprawny, a sam z siebie
     * bezużyteczny. Dwa, które wychodzą prawie za każdym razem, są tu nazwane,
     * bo żadnego nie da się zgadnąć z kodu: 553 dotyczy nadawcy, a nie
     * odbiorcy, a 401 z Discorda to URL unieważniony albo źle wklejony.
     */
    'hint_email_sender' => 'Twój serwer SMTP odrzucił adres, z którego panel wysyła, a nie adres, na który wysyłał. W Admin → Ustawienia → Poczta adres nadawcy musi być skrzynką, z której Twoje konto SMTP ma prawo wysyłać. Nie ma to nic wspólnego z tą wtyczką - testowy mail samego Pelicana na tamtej stronie zawiedzie tak samo.',
    'hint_email' => 'Zajrzyj do Admin → Ustawienia → Poczta. Przycisk testowego maila na tamtej stronie używa tych samych ustawień i powie to samo.',
    'hint_discord_url' => 'Discord nie rozpoznał tego webhooka. Został usunięty, wygenerowany na nowo albo wklejony w kawałku - utwórz nowy w Ustawienia serwera → Integracje → Webhooki i skopiuj cały URL.',
    'hint_discord' => 'Panel nie dosięgnął Discorda. Jeśli ten panel stoi za zaporą blokującą żądania wychodzące, ten kanał stąd działać nie może.',
    'hint_panel' => 'Nikt nie ma do tego uprawnienia albo powiadomienia nie dało się zapisać. Zajrzyj do Ról.',

    'run_now' => 'Uruchom sprawdzenia teraz',
    'run_started' => 'Sprawdzanie w tle',
    'run_failed' => 'Nie udało się uruchomić sprawdzeń',

    'reset' => 'Zapomnij, co wie',
    'reset_confirm' => 'Czyści to, co każde sprawdzenie powiedziało ostatnio. Następny przebieg uczy się od zera i nic nie wysyła, więc problem, który wciąż trwa, zostanie zgłoszony dopiero przy kolejnym. Użyj tego po wycofaniu węzła, o którym watchdog wciąż powtarza.',
    'reset_done' => 'Wyczyszczono',

    // ---- same wiadomości --------------------------------------------------
    'still' => 'Trwa od :for.',
    'cleared_body' => 'Trwało to :for.',
    'ports_title' => 'Kończą się porty dla gry :game',
    'ports_body' => 'Serwery kupione dla gry :game lądują na portach od :from do :to. Wolne porty: już tylko :free z :total. Zakup, który nie znajdzie żadnego, zostaje opłacony i dopiero potem odrzucony, więc dodaj alokacje na węźle albo poszerz zakres na pakiecie, zanim do tego dojdzie.',
    'ports_none_title' => 'Nie został żaden port dla gry :game',
    'ports_none' => 'Serwery kupione dla gry :game lądują na portach od :from do :to i z :total nie został wolny ani jeden. Następny zakup tej gry zostanie opłacony i dopiero potem odrzucony, bez żadnej alokacji. Dodaj alokacje na węźle albo poszerz zakres na samym pakiecie.',
    'ports_empty_title' => 'Nie istnieje żaden port dla gry :game',
    'ports_empty' => 'Serwery kupione dla gry :game lądują na portach od :from do :to, a w tym zakresie nie istnieje ani jedna alokacja na żadnym z węzłów, z których ta gra może korzystać. Każdy zakup tej gry zostanie opłacony i dopiero potem odrzucony. Utwórz alokacje na węźle albo poszerz zakres na samym pakiecie.',
    'ports_cleared' => 'Znów są wolne porty dla gry :game',

    'for_unknown' => 'jakiegoś czasu',
    'for_minutes' => '{1} minutę|[2,*] :count minut',
    'for_hours' => '{1} godzinę|[2,*] :count godzin',
    'for_days' => '{1} dzień|[2,*] :count dni',

    'node_down' => ':node nie odpowiada',
    'node_down_body' => 'Panel nie sięga do daemona na :node. Serwery na nim nie wystartują, nie zatrzymają się i nic nie zgłoszą, dopóki nie wróci.',
    'node_up' => ':node znów odpowiada',

    'node_disk' => 'Na :node kończy się dysk',
    'node_disk_body' => 'Dysk na :node jest zapełniony w :percent %, powyżej :limit %, które ustawiłeś. Kopie zapasowe i instalacje serwerów padają jako pierwsze, gdy to dojdzie do końca.',
    'node_disk_over' => 'Dysk na :node wrócił poniżej limitu',

    'node_memory' => 'Na :node kończy się pamięć',
    'node_memory_body' => 'Pamięć na :node jest zajęta w :percent %, powyżej :limit %, które ustawiłeś. Serwery na nim mogą zostać ubite przez jądro, zanim cokolwiek zgłosi problem.',
    'node_memory_over' => 'Pamięć na :node wróciła poniżej limitu',

    'node_maintenance' => ':node jest w konserwacji od dawna',
    'node_maintenance_body' => ':node jest w konserwacji od ponad :hours godzin. W tym czasie nic innego na nim nie jest sprawdzane i o to właśnie chodzi - ale warto wiedzieć, że wciąż tak stoi.',
    'node_maintenance_over' => ':node wyszedł z konserwacji',

    'wings_behind' => 'Wings na :node jest nieaktualny',
    'wings_behind_body' => ':node uruchamia Wings :installed, a wyszedł :latest. Zaktualizuj go na samym węźle - panel nie ma jak.',
    'wings_current' => 'Wings na :node jest aktualny',

    'panel_behind' => 'Panel jest nieaktualny',
    'panel_behind_body' => 'Ten panel działa na :installed, a wyszedł :latest.',
    'panel_current' => 'Panel jest aktualny',

    'and_more' => 'i jeszcze :count',


    'owner_down' => '{1} Jeden z Twoich serwerów jest offline|[2,*] Twoich serwerów offline: :count',
    'owner_down_body' => 'Maszyna, na której stoją, przestała odpowiadać. Ktoś już został powiadomiony. Dotyczy: :servers',
    'owner_up' => '{1} Twój serwer wrócił|[2,*] Twoich serwerów wróciło: :count',
    'owner_up_body' => 'Maszyna znów odpowiada. Wróciły: :servers',

    'schedules' => 'Zadania zaplanowane, które stanęły',
    'schedules_helper' => 'Zadanie zablokowane w połowie uruchomienia, takie, którego godzina minęła, bo cron nie działa, albo takie, które nigdy nie ruszyło. Pelican nie ma słowa na żadne z tych trzech - uruchomienie, które padło, zostaje „w trakcie" na zawsze i rysuje się dokładnie tak jak takie, które właśnie działa. Przy każdym sprawdzeniu czyta wszystkie aktywne zadania zaplanowane w panelu.',

    'schedule_stopped' => '{1} Jedno zaplanowane zadanie się zatrzymało|[2,*] :count zaplanowanych zadań się zatrzymało',
    'schedule_stopped_body' => 'Zablokowane ponad :hours godzin, po terminie, nigdy nieuruchomione, albo zupełnie bez zadań: :schedules',
    'schedule_running' => 'Wszystkie zadania zaplanowane znów działają',

    'unbuilt_over' => 'Każde opłacone zamówienie ma swój serwer',

    'unbuilt_body' => 'Ktoś zapłacił i nic nie ma. Otwórz Zamówienia i je utwórz, albo przeczytaj, dlaczego odmówiono: :orders',

    'unbuilt' => '{1} Opłacone zamówienie bez serwera|[2,*] :count opłaconych zamówień bez serwera',

    'stock_out' => '{1} Pakiet się wyprzedał|[2,*] Wyprzedanych pakietów: :count',
    'stock_out_body' => 'Wciąż w sprzedaży, a nie ma już czego sprzedać: :packages',
    'stock_low' => '{1} Pakiet jest prawie wyprzedany|[2,*] Pakietów prawie wyprzedanych: :count',
    'stock_low_body' => 'Zostało :limit lub mniej: :packages',
    'stock_back' => '{1} Pakiet znów jest w sprzedaży|[2,*] Pakietów znów w sprzedaży: :count',
    'stock_back_body' => 'Znów jest co sprzedawać: :packages',

    'backup_none' => '{1} Jeden serwer nigdy nie był kopiowany|[2,*] :count serwerów nigdy nie było kopiowanych',
    'backup_none_body' => 'Nigdy nie zrobiono kopii na: :servers',
    'backup_none_over' => 'Każdy serwer ma już kopię zapasową',

    'backup_stale' => '{1} Jeden serwer nie był ostatnio kopiowany|[2,*] :count serwerów nie było ostatnio kopiowanych',
    'backup_stale_body' => 'Brak udanej kopii od :days dni na: :servers',
    'backup_stale_over' => 'Każdy serwer ma niedawną kopię zapasową',

    'backup_failed' => '{1} Kopie nie udają się na jednym serwerze|[2,*] Kopie nie udają się na :count serwerach',
    'backup_failed_body' => 'Kopia zakończyła się niepowodzeniem na: :servers',
    'backup_failed_over' => 'Żadna kopia zapasowa już nie pada',

    'worker_missing' => 'Nic nie obsługuje kolejki',
    'worker_missing_body' => 'Zadanie trafiło do kolejki i nic go nie podjęło. Aktualizacje wtyczek, instalacje modpacków i te sprawdzenia stoją, dopóki nie działa worker - spróbuj systemctl status pelican-queue na maszynie panelu.',
    'worker_back' => 'Kolejka jest znów obsługiwana',
    'failed_title' => '{1} Od ostatniego sprawdzenia nie powiodło się jedno zadanie|[2,*] Od ostatniego sprawdzenia nie powiodło się :count zadań',
    'failed_body' => 'Coś, co panel miał zrobić, nie wydarzyło się i nie zostanie ponowione - niezbudowany serwer, niewystawiona faktura, niewysłany mail. Leżą w tabeli failed_jobs; `php artisan queue:retry all` wstawia je z powrotem, gdy tylko naprawi się to, co je zatrzymało.',
    'failed_back' => 'Od ostatniego sprawdzenia nic nie padło',
    'failed' => 'Powiadom mnie, gdy padnie zadanie z kolejki',
    'failed_helper' => 'Laravel zapisuje zadanie, które odpuścił, i nic o nim nie mówi. To mówi. Liczone, a nie wyliczane: dwadzieścia awarii jednej nocy ma zwykle jedną przyczynę.',

    'health_interval_off' => 'Alerty są włączone, ale interwał jest ustawiony na Wyłączone, więc strażnik nigdy się nie uruchamia.',
    'health_owners_unwatched' => 'Alerty dla właścicieli są włączone, ale strażnik nie działa, więc właściciele nigdy nie dowiadują się o awarii.',
    'health_no_channel' => 'Strażnik działa, ale każdy sposób powiadomienia kogoś jest wyłączony.',
    'health_discord' => 'Alerty na Discorda są włączone, ale nie zapisano żadnego prawidłowego webhooka https.',
    'health_bot' => 'Alerty dla bota są włączone, ale brakuje adresu https lub sekretu podpisu.',
    'health_email' => 'E-maile z alertami są włączone, ale nie ma prawidłowego adresu albo poczta panelu zapisuje tylko do swojego dziennika.',
];
