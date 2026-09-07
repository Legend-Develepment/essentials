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
 * zgubi — i dlatego zdanie o tym, że klucz pokazuje się tylko raz, nie jest
 * przypisem.
 *
 * Nigdzie tu nie ma słowa „token". „Klucz" to słowo z własnej strony konta w
 * Pelicanie, a panel, który tę samą rzecz nazywa dwojako, to panel, w którym
 * ktoś szuka nie tego.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Klucze, które pozwalają czemuś spoza panelu zapytać o to, co wie ta wtyczka. Tylko do odczytu — nic tutaj nie uruchomi serwera, nie zatrzyma go ani do niego nie sięgnie.',

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
     * gdzie czyta go bot" — owszem.
     */
    'once' => 'To jedyny raz, kiedy ten klucz jest pokazywany',
    'once_body' => 'Jest przechowywany jako skrót, więc nikt — łącznie z tym, kto prowadzi ten panel — nie odczyta go z powrotem. Wklej go teraz tam, gdzie czyta go bot albo skrypt. Jeśli zginie, unieważnij ten i poproś o kolejny.',
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
    'scope_panel_helper' => 'Odpowiada na pytania dotyczące całego panelu — każdy węzeł, pojemność, watchdog, samą maszynę panelu. Dla bota, który raportuje o panelu, a nie dla osoby.',

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
    'grant_confirm' => 'Wydaje klucz, który odpowiada za własne serwery tej osoby, i pokazuje go raz. Ona i tak widzi wszystko, co ten klucz zgłosi — tu rozstrzyga się, czy coś spoza panelu może pytać w jej imieniu.',
    'granted' => 'Przyznano',

    'refuse' => 'Odmów',
    'refuse_answer' => 'Co im powiedzieć',
    'refuse_answer_helper' => 'Nieobowiązkowe, widoczne na ich własnej stronie. Odmowa bez powodu to odmowa, o którą poprosi się znowu za tydzień.',
    'refused' => 'Odmówiono',

    'revoke' => 'Unieważnij',
    'revoke_confirm' => 'Klucz natychmiast przestaje odpowiadać, a jego skrót zostaje usunięty, więc nie da się go przywrócić. Wszystko, co go używa, staje. Poproś o nowy zamiast próbować to cofnąć.',
    'revoked' => 'Unieważniono',

    'mint' => 'Nowy klucz',
    'mint_body' => 'Dla bota, a nie dla osoby. Jest przyznany w chwili, gdy powstaje, bo to Ty byłbyś tym, kto by go zatwierdził.',
    'mint_owner' => 'Czyj jest',
    'mint_owner_helper' => 'Klucz odpowiada w czyimś imieniu. Przy kluczu na cały panel to tylko ten, kto za niego odpowiada; przy osobistym to zarazem to, co klucz widzi.',
    'minted' => 'Utworzono',

    // ---- co ustawia administrator ----------------------------------------
    'settings' => 'Jak to działa',
    'approval' => 'Prośby czekają na przyznanie',
    'approval_helper' => 'Włączone — kto prosi o klucz, dostaje go, gdy ktoś powie tak. Wyłączone — dostaje go od razu, co jest rozsądne w panelu, gdzie każdy z kontem i tak jest zaufany, i co warto wybrać, a nie do tego dojść przypadkiem.',
    'rate' => 'Zapytań na minutę, na klucz',
    'rate_helper' => 'Bot pytający czterdzieści serwerów, kto gra, to czterdzieści pytań do czterdziestu serwerów gry. To jest sufit, który nie pozwala pętli napisanej o trzeciej nad ranem zamienić się w test obciążeniowy.',
    'days' => 'Przyznany klucz żyje',
    'days_helper' => 'W dniach. Zero znaczy do unieważnienia i tak jest domyślnie — klucz, który wygasa, gdy nikt nie patrzy, to bot, który staje w nocy i nigdzie nie ma napisane dlaczego.',
    'days_never' => 'Do unieważnienia',

    /*
     * Powiedziane na stronie, a nie zostawione do odkrycia. Pelican wycofuje
     * migracje wtyczki, gdy się ją odinstalowuje, a jedyna tabela tej wtyczki
     * idzie razem z nimi.
     */
    'uninstall_note' => 'Usunięcie tej wtyczki usuwa razem z nią każdy klucz. To celowe — klucz, który przeżywa to, co mu odpowiada, jest poświadczeniem, którego nikt już nie unieważni.',
];
