<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Droga do środka spoza panelu.
 *
 * Dwie grupy czytelników w jednym pliku, i chcą czegoś przeciwnego.
 * Administrator, który czyta tę stronę, decyduje, czy powierzyć komuś klucz,
 * więc każdy wiersz mówi, dokąd klucz sięga, a nie jak się nazywa. Ten, kto o
 * niego prosi, chce wiedzieć, co dostaje do ręki i co się stanie, jeśli go
 * zgubi - i dlatego zdanie o tym, że klucz pokazuje się tylko raz, nie jest
 * przypisem.
 *
 * Nigdzie tu nie ma słowa „token". „Klucz" to słowo z własnej strony konta w
 * Pelicanie, a panel, który tę samą rzecz nazywa dwojako, to panel, w którym
 * ktoś szuka nie tego.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Klucze, które pozwalają czemuś spoza panelu zapytać o to, co wie ta wtyczka. Tylko do odczytu - nic tutaj nie uruchomi serwera, nie zatrzyma go ani do niego nie sięgnie.',

    'my_title' => 'Dostęp do API',
    'my_nav_label' => 'Dostęp do API',
    'my_subheading' => 'Własny klucz, do bota albo skryptu. Odpowiada tylko za te serwery, które i tak możesz otworzyć.',

    // ---- czym jest klucz, powiedziane raz, tam gdzie to waży -------------
    'address' => 'Adres',
    'address_helper' => 'Wyślij klucz jako nagłówek Authorization: :example',

    /*
     * Jedyna rzecz, którą ktoś musi przeczytać przed zamknięciem okna.
     * Napisana jako to, co zrobić, a nie jako ostrzeżenie, bo „trzymaj go
     * bezpiecznie" to rada, z którą nikt nic nie zrobi, a „wklej go teraz tam,
     * gdzie czyta go bot" - owszem.
     */
    'once' => 'To jedyny raz, kiedy ten klucz jest pokazywany',
    'once_body' => 'Jest przechowywany jako skrót, więc nikt - łącznie z tym, kto prowadzi ten panel - nie odczyta go z powrotem. Wklej go teraz tam, gdzie czyta go bot albo skrypt. Jeśli zginie, unieważnij ten i poproś o kolejny.',
    'copy' => 'Kopiuj',
    'copied' => 'Skopiowano',

    // ---- stany -----------------------------------------------------------
    'state' => 'Stan',
    'state_pending' => 'Czeka',
    'state_active' => 'Aktywny',
    'state_refused' => 'Odmówiono',
    'state_revoked' => 'Unieważniony',

    'state_pending_body' => 'Ktoś musi to przyznać, zanim klucz na cokolwiek odpowie.',
    'state_refused_body' => 'Odmówiono. Nic nie zostało wydane.',
    'state_revoked_body' => 'Ten klucz został zabrany i już nie odpowiada.',

    // ---- zasięgi ---------------------------------------------------------
    'scope' => 'Sięga',
    'scope_person' => 'Jego własne serwery',
    'scope_panel' => 'Cały panel',

    'scope_person_helper' => 'Odpowiada tylko za serwery, które właściciel i tak może otworzyć, pytane tak samo, jak pyta panel. Zgubienie tego klucza nie traci niczego, czego właściciel nie mógł już zobaczyć.',
    'scope_panel_helper' => 'Odpowiada na pytania dotyczące całego panelu - każdy węzeł, pojemność, watchdog, samą maszynę panelu. Dla bota, który raportuje o panelu, a nie dla osoby.',

    // ---- tabela ----------------------------------------------------------
    'column_name' => 'Do czego',
    'column_owner' => 'Czyj',
    'column_prefix' => 'Klucz',
    'column_asked' => 'Poproszono',
    'column_used' => 'Ostatnio użyty',
    'column_expires' => 'Wygasa',

    'never_used' => 'Nigdy',
    'no_expiry' => 'Do unieważnienia',

    'tab_waiting' => 'Czekające',
    'tab_active' => 'Aktywne',
    'tab_all' => 'Wszystkie',

    'empty' => 'Jeszcze żadnych kluczy',
    'empty_body' => 'Nikt o żaden nie poprosił i żaden nie został wydany. Ta strona wypełnia się sama, w miarę jak ludzie to robią.',

    'my_empty' => 'Nie masz klucza',
    'my_empty_body' => 'Poproś o jeden, a pojawi się tutaj wraz z tym, co mu odpowiedziano.',

    // ---- proszenie -------------------------------------------------------
    'ask' => 'Poproś o klucz',
    'ask_name' => 'Do czego jest',
    'ask_name_helper' => 'Kilka słów, żebyś później odróżnił dwa własne, a ten, kto go przyzna, wiedział, co przyznaje.',
    'ask_reason' => 'Coś, co warto dopisać',
    'ask_reason_helper' => 'Nieobowiązkowe. Czyta to ten, kto decyduje.',
    'ask_sent' => 'Poproszono',
    'ask_sent_body' => 'Pojawi się niżej, gdy tylko ktoś odpowie.',
    'ask_granted' => 'Oto Twój klucz',
    'ask_open' => 'Masz już jeden, który czeka na odpowiedź',
    'ask_open_body' => 'Jedna prośba naraz. Wycofaj tamtą, jeśli była pomyłką.',
    'ask_failed' => 'Nie udało się o to poprosić',

    'cancel' => 'Wycofaj',
    'cancel_confirm' => 'Wycofuje prośbę. Nic nie zostało wydane, więc nic też nie przestanie działać.',

    // ---- decydowanie -----------------------------------------------------
    'grant' => 'Przyznaj',
    'grant_confirm' => 'Wydaje klucz, który odpowiada za własne serwery tej osoby, i pokazuje go raz. Ona i tak widzi wszystko, co ten klucz zgłosi - tu rozstrzyga się, czy coś spoza panelu może pytać w jej imieniu.',
    'granted' => 'Przyznano',

    'refuse' => 'Odmów',
    'refuse_answer' => 'Co im powiedzieć',
    'refuse_answer_helper' => 'Nieobowiązkowe, widoczne na ich własnej stronie. Odmowa bez powodu to odmowa, o którą poprosi się znowu za tydzień.',
    'refused' => 'Odmówiono',
    'collect' => 'Pokaż mój klucz',
    'state_ready_body' => 'Przyznany. Naciśnij Pokaż mój klucz, żeby go zobaczyć - raz, bo jest przechowywany jako skrót i potem nie da się go odczytać.',
    'replace' => 'Zastąp',
    'replace_confirm' => 'Ten klucz natychmiast przestaje działać, a jego miejsce zajmuje nowy, pokazany raz. Starego nie da się nigdzie sprawdzić - nigdy nie był przechowywany - więc zastąpienie go jest jedyną odpowiedzią na jego zgubienie.',
    'granted_body' => 'Odbierają go sami, na własnej stronie Dostęp do API. Tutaj nie jest pokazywany: klucz należy do tego, kto o niego poprosił, a nie do tego, kto powiedział tak.',

    'revoke' => 'Unieważnij',
    'revoke_confirm' => 'Klucz natychmiast przestaje odpowiadać, a jego skrót zostaje usunięty, więc nie da się go przywrócić. Wszystko, co go używa, staje. Poproś o nowy zamiast próbować to cofnąć.',
    'revoked' => 'Unieważniono',
    'forget' => 'Usuń',
    'forget_confirm' => 'Zdejmuje ten wiersz ze strony na dobre. Klucz i tak już nie odpowiada, więc nic działającego się nie zatrzyma - to usuwa tylko zapis o tym, że istniał.',
    'forgotten' => 'Usunięto',

    'mint' => 'Nowy klucz',
    'mint_body' => 'Dla bota, a nie dla osoby. Jest przyznany w chwili, gdy powstaje, bo to Ty byłbyś tym, kto by go zatwierdził.',
    'abilities' => 'O co może pytać',
    'abilities_helper' => 'Na początku wszystko jest zaznaczone, bo tym był klucz, zanim to powstało. Odznaczenie jest świadomym krokiem. Przechowywana jest lista tego, co dozwolone, więc uprawnienie dodane w późniejszym wydaniu jest wyłączone dla kluczy starszych od niego - możliwość, której nikt nie zaznaczył, to możliwość, której nikt nie przyznał.',
    'ability_health' => 'Potwierdzenie, że klucz działa',
    'ability_health_helper' => 'Nie sięga nigdzie indziej. Bezpiecznie wywoływać je co jakiś czas.',
    'ability_me' => 'Jego własne serwery',
    'ability_me_helper' => 'Serwery, które właściciel i tak może otworzyć, oraz ich kopie zapasowe. Nigdy nie zobaczy nikogo innego.',
    'ability_panel' => 'Cały panel',
    'ability_panel_helper' => 'Każdy węzeł, każda kopia zapasowa, zatrzymane zadania zaplanowane, watchdog i maszyna panelu. Wymaga też klucza na cały panel.',
    'ability_live' => 'Pytanie serwera wprost',
    'ability_live_helper' => 'Kto gra i czy serwer działa. Jedyne pytania, które coś kosztują - sięgają do serwera gry albo do daemona, z pamięcią podręczną na piętnaście do dwudziestu sekund.',
    'ability_connect' => 'Wiązanie kont Discorda z kontami panelu',
    'ability_connect_helper' => 'Jedyna grupa, która nie jest odczytem. Tworzy klucze API Pelicana na kontach osób, które o to proszą, i może zakończyć powiązanie. Daj ją tylko temu botowi, który jej potrzebuje.',
    'own_rate' => 'Zapytań na minutę dla tego klucza',
    'own_rate_helper' => 'Zostaw puste, żeby iść za ustawieniem panelu. Liczba tutaj dotyczy tylko tego klucza. Zero oznacza brak jakiegokolwiek sufitu - rozsądne dla bota na Twojej własnej maszynie i prawdziwy sposób, żeby tego pożałować, jeśli klucz trafi gdzie indziej.',
    'own_rate_default' => 'Idzie za panelem',
    'mint_owner' => 'Czyj jest',
    'mint_owner_helper' => 'Klucz odpowiada w czyimś imieniu. Przy kluczu na cały panel to tylko ten, kto za niego odpowiada; przy osobistym to zarazem to, co klucz widzi.',
    'minted' => 'Utworzono',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Klucz do Essentials API',
    'profile_make_helper' => 'Inne API niż to powyżej: to odpowiada na to, co wie ta wtyczka - który z Twoich serwerów nie ma kopii zapasowej, kto na nich gra, czy działają. Zawsze odpowiada wyłącznie za Ciebie i sięga tylko do serwerów, które i tak możesz otworzyć.',
    'profile_create' => 'Utwórz',
    'profile_yours' => 'Twoje klucze Essentials',
    'profile_manage' => 'Unieważnienie klucza, sprawdzenie, dlaczego któremuś odmówiono, i połączenie z Discordem są na stronie Dostęp do API w bocznym menu.',
    'discord' => 'Discord',
    'discord_body' => 'Powiąż swoje konto Discorda z tym kontem, żeby bot mógł odpowiadać za Twoje serwery, kiedy go o to poprosisz. Dostaje klucz, który sięga dokładnie tam, gdzie sięgasz Ty, i nigdzie dalej.',
    'discord_connect' => 'Połącz Discorda',
    'discord_code' => 'Wpisz to w Discordzie w ciągu dziesięciu minut',
    'discord_code_body' => 'Wyślij :command na kanale, który bot może czytać. Kod działa raz. Nikt nie może go użyć poza kontem, dla którego powstał.',
    'discord_on' => 'Połączono jako :name',
    'discord_since' => 'Od :when',
    'discord_cut' => 'Rozłączono',
    'discord_cut_confirm' => 'Kończy powiązanie i usuwa klucz, który z niego powstał, więc bot natychmiast przestaje odpowiadać za Ciebie. Możesz połączyć się ponownie, kiedy zechcesz.',
    'discord_off' => 'Niepołączone',
    'discord_key_note' => 'Połączenie tworzy na Twoim koncie klucz API Pelicana o nazwie Discord (Essentials). Widzisz go i możesz go unieważnić w Konto → Klucze API - ta strona jest tylko skrótem do tego samego.',
    'docs_title' => 'Jak używać tego API',
    'docs_subheading' => 'Na co ten panel odpowiada i pod jakimi adresami. Napisane z tego samego opisu, z którego zbudowane jest API, więc nie może być o wydanie za nim.',
    'docs_base' => 'Gdzie się znajduje',
    'docs_endpoints' => 'Endpointy',
    'docs_answers' => 'Co wraca',
    'docs_calls' => 'Klucze, które mogą to wywołać',
    'docs_params' => 'Co wysłać',
    'docs_required' => 'wymagane',
    'docs_optional' => 'nieobowiązkowe',
    'docs_try' => 'Wypróbuj',
    'docs_errors' => 'Gdy coś jest nie tak',
    'docs_hook' => 'Co panel wysyła do Ciebie',
    'docs_hook_body' => 'Drugi kierunek i jedyna część tego, co przychodzi bez pytania. Włączane w Alertach adresem i sekretem do podpisu: jedno wysłanie JSON, gdy watchdog coś znajdzie, i jedno, gdy to minie, żeby bot dowiedział się o martwym node zamiast pytać co minutę, czy taki jest.',
    'docs_hook_verify' => 'Treść jest haszowana Twoim sekretem, a wynik jedzie w X-Essentials-Signature jako sha256=<hex>. Licz skrót z surowej treści, a nie z obiektu złożonego na nowo - każda różnica w odstępach albo w kolejności kluczy daje inny skrót, a niezgodność czyta się jak atak, a nie jak błąd.',
    'docs_download_md' => 'Pobierz jako Markdown',
    'docs_download_json' => 'Pobierz jako OpenAPI',

    // ---- co ustawia administrator ----------------------------------------
    'settings' => 'Jak to działa',
    'approval' => 'Prośby czekają na przyznanie',
    'approval_helper' => 'Włączone - kto prosi o klucz, dostaje go, gdy ktoś powie tak. Wyłączone - dostaje go od razu, co jest rozsądne w panelu, gdzie każdy z kontem i tak jest zaufany, i co warto wybrać, a nie do tego dojść przypadkiem.',
    'rate' => 'Zapytań na minutę, na klucz',
    'rate_helper' => 'Bot pytający czterdzieści serwerów, kto gra, to czterdzieści pytań do czterdziestu serwerów gry. To jest sufit, który nie pozwala pętli napisanej o trzeciej nad ranem zamienić się w test obciążeniowy.',
    'days' => 'Przyznany klucz żyje',
    'days_helper' => 'W dniach. Zero znaczy do unieważnienia i tak jest domyślnie - klucz, który wygasa, gdy nikt nie patrzy, to bot, który staje w nocy i nigdzie nie ma napisane dlaczego.',
    'days_never' => 'Do unieważnienia',
    'hide_pelican' => 'Usuń zakładkę własnych kluczy API panelu',
    'hide_pelican_helper' => 'Zdejmuje zakładkę Klucze API z profilu konta w całości, więc na tej stronie jest już tylko jedna rzecz o nazwie Klucze API. Jest usuwana ze strony, a nie zamalowywana, więc nie zostaje żaden adres, który by do niej sięgał. Jednego nie potrafi: własne API klienta w panelu nadal utworzy klucz konta dla wszystkiego, co poprosi je o to wprost - zakładka jest miejscem, gdzie ludzie robią to ręcznie, a to zabiera rękę. Klucze, które już istnieją, działają dalej.',

    /*
     * Powiedziane na stronie, a nie zostawione do odkrycia. Pelican wycofuje
     * migracje wtyczki, gdy się ją odinstalowuje, a jedyna tabela tej wtyczki
     * idzie razem z nimi.
     */
    'uninstall_note' => 'Usunięcie tej wtyczki usuwa razem z nią każdy klucz. To celowe - klucz, który przeżywa to, co mu odpowiada, jest poświadczeniem, którego nikt już nie unieważni.',
];
