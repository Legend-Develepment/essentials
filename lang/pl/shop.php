<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Ustawienia sklepu, a później sam sklep.
 *
 * Dwóch czytelników dzieli ten plik celowo. Połowę z ustawieniami czyta
 * administrator; połowy publiczną i klienta - dodawane w miarę jak sklep
 * rośnie - czytają ludzie, którzy mogli nigdy nie słyszeć o Pelicanie, i
 * każde zdanie tam musi być napisane dla nich.
 */

return [
    'title' => 'Ustawienia sklepu',
    'nav_label' => 'Ustawienia sklepu',
    'subheading' => 'Waluta, podatek, sposób numerowania faktur i to, co mówi strona publiczna. To, co jest na sprzedaż, jest na stronie Pakiety.',

    // ---- gdzie jest ------------------------------------------------------
    'address' => 'Publiczny sklep jest pod',
    'address_off' => 'Strona publiczna jest wyłączona. Włącz „Publiczna strona sklepu" na liście funkcji na stronie Ustawienia Essentials, a odpowie pod :url.',

    // ---- ogólne ----------------------------------------------------------
    'section_general' => 'Pieniądze',
    'section_general_helper' => 'Jedna waluta dla całego sklepu. Każda cena każdego pakietu jest liczbą w niej.',
    'currency' => 'Waluta',
    'currency_helper' => 'Zmiana niczego nie przelicza: ceny na pakietach to liczby, a po zmianie są to liczby w nowej walucie.',
    'tax' => 'Podatek',
    'tax_helper' => 'Procent dodawany do każdej faktury jako osobna pozycja. Ceny na pakietach są bez podatku. Zero oznacza brak.',
    'tax_suffix' => '%',
    'prefix' => 'Numery faktur zaczynają się od',
    'prefix_helper' => 'Po nim liczba rosnąca. INV- daje INV-000001.',

    // ---- odnowienia ------------------------------------------------------
    'section_renewals' => 'Odnowienia',
    'section_renewals_helper' => 'Dla pakietów rozliczanych miesięcznie, kwartalnie lub rocznie. Pakietu jednorazowego nic z tego nigdy nie dotyka.',
    'notice_days' => 'Wystaw fakturę tyle dni przed końcem okresu',
    'notice_days_helper' => 'Kiedy powstaje kolejna faktura i klient zostaje o niej powiadomiony.',
    'grace' => 'Zawieś tyle dni po terminie płatności faktury',
    'grace_helper' => 'Niezapłacona faktura po tym czasie zawiesza serwer — to własne zawieszenie Pelicana, zdejmowane z chwilą opłacenia faktury. Samo zawieszenie niczego nie usuwa.',
    'days' => 'dni',

    // ---- strona publiczna ------------------------------------------------
    'section_public' => 'Strona publiczna',
    'section_public_helper' => 'Czytają ją ludzie bez konta. Czy w ogóle jest serwowana, decyduje przełącznik „Publiczna strona sklepu" na liście funkcji.',
    'heading' => 'Nagłówek',
    'heading_helper' => 'Pozostawiony pusty — używana jest nazwa samego panelu.',
    'note' => 'Linijka nad pakietami',
    'note_helper' => 'Żeby powiedzieć, kim jesteś albo co daje zakup. Zwykły tekst.',
    'terms_url' => 'Regulamin',
    'terms_url_helper' => 'Adres https. Jeśli jest ustawiony, zakup oznacza zaznaczenie pola, które na niego wskazuje.',

    // ---- płatność ręczna -------------------------------------------------
    'section_manual' => 'Płatność bez operatora',
    'section_manual_helper' => 'Pokazywane na niezapłaconej fakturze, dopóki żaden operator płatności nie jest włączony: dane bankowe albo gdzie wysłać pieniądze. Zwykły tekst.',
    'pay_note' => 'Jak zapłacić',
    'pay_note_helper' => 'Zostaw puste, a niezapłacona faktura powie tylko, że jest niezapłacona.',

    // ---- przyciski -------------------------------------------------------
    'save' => 'Zapisz',
    'saved' => 'Zapisano',
    'save_failed' => 'Niczego nie zapisano',

    /* ---------------------------------------------------------------------
     * Sam sklep, od tego miejsca w dół.
     *
     * Zupełnie inny czytelnik: ktoś, kto kupuje serwer, kto może nigdy nie
     * słyszał o Pelicanie i nie wie, czym jest egg. Nic poniżej nie używa słów
     * panelu, a każde zdanie odpowiada na pytanie, które klient naprawdę ma w
     * tym miejscu strony.
     * ------------------------------------------------------------------- */

    // ---- sklep -----------------------------------------------------------
    'store_title' => 'Sklep',
    'store_nav_label' => 'Sklep',
    'store_subheading' => 'Wybierz serwer. Zostanie dla ciebie utworzony, gdy tylko faktura będzie opłacona.',
    'store_empty' => 'W tej chwili nic nie jest na sprzedaż',
    'store_empty_body' => 'Wróć później albo zapytaj tego, kto prowadzi ten panel.',

    'buy' => 'Kup',
    'sold_out' => 'Wyprzedane',
    'plus_setup' => 'plus :amount jednorazowo',

    'spec_memory' => 'Pamięć: :amount MiB',
    'spec_disk' => 'Dysk: :amount MiB',
    'spec_cpu' => 'CPU: :amount%',
    'spec_backups' => 'Kopii zapasowych: :count',
    'spec_databases' => 'Baz danych: :count',

    // ---- strona publiczna ------------------------------------------------
    'public_empty' => 'W tej chwili nic nie jest na sprzedaż',
    'public_empty_body' => 'Wróć później.',
    'to_panel' => 'Zaloguj się',
    'terms' => 'Regulamin',
    'sign_in_note' => 'Wybierz serwer poniżej. Logujesz się, żeby dokończyć, a serwer powstaje, gdy faktura zostanie opłacona.',
    'to_account' => 'Moje konto',
    'filter_all' => 'Wszystko',
    'filter_label' => 'Pokaż',
    'includes' => 'Zawiera',
    'public_count' => 'Na sprzedaż: :count',

    // ---- zamawianie ------------------------------------------------------
    'checkout_title' => 'Zamówienie',
    'tax_line' => 'Podatek (:rate%)',
    'coupon' => 'Kod rabatowy',
    'asks' => 'O twoim serwerze',
    'upload_default' => 'Twój plik',
    'upload_help' => 'Plik zip. Trafi do twojego serwera, gdy ten powstanie.',
    'upload_busy' => 'Wgrywanie…',
    'what_is_this' => 'Co to jest?',
    'leave_as_is' => 'Zostaw bez zmian',
    'asks_optional' => 'Nic z tego nie jest wymagane. To, czego nie ruszysz, zostaje takie, jakie było w szablonie serwera.',
    'refused_no_file' => 'Ten pakiet potrzebuje pliku, a żaden nie został wybrany.',
    'refused_not_zip' => 'To musi być plik zip.',
    'refused_too_big' => 'Ten plik jest za duży, żeby ten panel go przyjął.',
    'coupon_placeholder' => 'Jeśli jakiś masz',
    'coupon_bad' => 'Ten kod tutaj nie działa.',
    'coupon_good' => 'Kod zastosowany.',
    'agree' => 'Akceptuję',
    'place_order' => 'Złóż zamówienie',
    'place_order_note' => 'To wystawia fakturę. Nic nie jest pobierane, dopóki nie zapłacisz, a serwer powstaje, gdy faktura zostanie opłacona.',
    'back_to_store' => 'Wróć do sklepu',

    'placed' => 'Zamówienie złożone',
    'placed_body' => 'Faktura :number czeka na twojej stronie płatności.',

    'refused' => 'Tego nie dało się kupić',
    'refused_gone' => 'To nie jest już na sprzedaż.',
    'refused_sold_out' => 'Ostatni już poszedł.',
    'refused_bad_coupon' => 'Kod rabatowy nie dotyczy tego.',
    'refused_failed' => 'Coś poszło nie tak przy zapisywaniu zamówienia. Nic nie zostało pobrane. Spróbuj jeszcze raz i powiedz o tym osobie prowadzącej ten panel, jeśli będzie się powtarzać.',

    // ---- płatności -------------------------------------------------------
    'billing_title' => 'Płatności',
    'billing_nav_label' => 'Płatności',
    'billing_subheading' => 'Co kupiłeś i co jest do zapłaty.',
    'your_orders' => 'Twoje zamówienia',
    'your_invoices' => 'Twoje faktury',
    'no_orders' => 'Nic jeszcze nie kupiłeś',
    'no_orders_body' => 'Wszystko, co kupisz, pojawia się tutaj razem z serwerem i datami.',
    'no_invoices' => 'Jeszcze nie ma faktur',
    'to_store' => 'Do sklepu',
    'renews' => 'Odnawia się',
    'server_installing' => 'Wciąż jest przygotowywany. Uruchomi się sam, gdy to się skończy.',
    'server_failed' => 'Przygotowanie się nie dokończyło. Osoba prowadząca ten panel już o tym wie.',
    'server_suspended' => 'Zatrzymany przez panel. Nic na nim nie zostało usunięte.',
    'server_restoring' => 'Kopia zapasowa jest wgrywana z powrotem. Potrwa to kilka minut.',
    'give' => 'Zakończ tę usługę',
    'give_end' => 'Zakończ ją w tym dniu',
    'give_end_body' => 'Działa do :date i nie zostaniesz za nią ponownie obciążony. Wszystko, co na nim jest, zostanie tego dnia usunięte, więc skopiuj sobie to, co chcesz zachować.',
    'give_end_open' => 'Nie ma daty, do której miałaby dobiec, więc zakończenie tej usługi zatrzymuje faktury i zostawia serwer tam, gdzie jest, dopóki ktoś go nie usunie.',
    'give_end_confirm' => 'Zakończyć tę usługę :date? Działa do tego dnia i nie ma kolejnych faktur.',
    'give_now' => 'Zatrzymaj i usuń teraz',
    'give_now_confirm' => 'Usunąć ten serwer teraz, wraz z plikami, bazami danych i kopiami zapasowymi? Nie ma cofnięcia ani zwrotu pieniędzy za resztę opłaconego okresu.',
    'gave_end' => 'Wypowiedziano',
    'gave_end_body' => 'Działa do daty na karcie i nie ma kolejnych faktur. Do tego czasu nic nie zostanie usunięte.',
    'gave_now' => 'Nie ma go',
    'gave_now_body' => 'Serwer został usunięty i nie zostaniesz za niego ponownie obciążony.',
    'gave_refused' => 'To się nie udało',
    'gave_refused_body' => 'Nic się nie zmieniło. Odśwież stronę i zapytaj osobę prowadzącą ten panel, jeśli będzie się powtarzać.',
    'ask_how_to_pay' => 'Zapytaj osobę prowadzącą ten panel, jak zapłacić. Jeszcze tego tu nie zapisała.',
    'order_pending' => 'Czeka na opłacenie faktury. Zaraz potem serwer zostanie utworzony.',
    'order_suspended' => 'Zatrzymany z powodu nieopłaconej faktury. Opłacenie jej uruchamia serwer z powrotem - nic nie zostało usunięte.',
    'order_ending' => 'Kończy się :date. Nie ma kolejnych faktur, a wszystko, co na nim jest, zostanie tego dnia usunięte.',
    'order_ending_open' => 'Anulowane. Nie ma kolejnych faktur i działa dalej, dopóki nie zostanie usunięte.',

    // ---- płacenie --------------------------------------------------------
    'pay_with' => 'Zapłać przez',
    'pay_now' => 'Zapłać',
    'pay_description' => 'Faktura :number',
    'pay_thanks' => 'Dziękujemy. Faktura jest opłacona.',
    'pay_pending' => 'Operator jeszcze tego nie potwierdził. Ta strona zaktualizuje się, gdy tylko to zrobi.',
    'pay_refused' => 'To się nie zaczęło',
    'pay_refused_body' => 'Nie udało się otworzyć płatności. Spróbuj inaczej albo zapytaj osobę prowadzącą ten panel.',
    'gateway_mollie' => 'Mollie',

    // ---- ustawienia operatora --------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Przyjmuje iDEAL, karty, Bancontact i resztę przez jedno konto. Test i produkcja to to samo ustawienie: sam klucz mówi, do którego konta należy.',
    'mollie_on' => 'Oferuj Mollie',
    'mollie_on_helper' => 'Wyłączone usuwa przycisk z każdej faktury. To, co już opłacone, zostaje opłacone.',
    'mollie_key' => 'Klucz API',
    'mollie_key_helper' => 'Z sekcji Developers w panelu Mollie. Nigdy nie trafia do wyeksportowanego pliku ustawień.',
    'mollie_hook' => 'Adres webhooka',
    'mollie_hook_helper' => 'Mollie zgłosi się pod :url - twój panel musi być tam osiągalny z internetu.',

    'gateway_stripe' => 'Karta',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Przyjmuje karty na stronie, którą rysuje sam Stripe, więc numer karty nigdy nie trafia do tego panelu. Test i produkcja siedzą w przedrostku klucza, nie w przełączniku.',
    'stripe_on' => 'Oferuj Stripe',
    'stripe_on_helper' => 'Wyłączone usuwa przycisk z każdej faktury. To, co już opłacone, zostaje opłacone.',
    'stripe_key' => 'Klucz tajny',
    'stripe_key_helper' => 'Ten zaczynający się od sk_, z Developers, API keys. Nigdy nie trafia do wyeksportowanego pliku ustawień.',
    'stripe_hook' => 'Sekret podpisu',
    'stripe_hook_key_helper' => 'Wartość whsec_, którą Stripe pokazuje po dodaniu adresu poniżej. Bez niej ich wiadomości nie da się uznać za prawdziwe i są pomijane.',
    'stripe_hook_helper' => 'Dodaj :url jako endpoint w Developers, webhooks, dla zdarzenia checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Jedyny operator, u którego pieniądze ruszają dopiero po powrocie klienta, a nie wtedy gdy jest jeszcze w PayPalu - zamknięta karta zostawia więc nieopłaconą fakturę, a nie zgubioną płatność.',
    'paypal_on' => 'Oferuj PayPal',
    'paypal_on_helper' => 'Wyłączone usuwa przycisk z każdej faktury. To, co już opłacone, zostaje opłacone.',
    'paypal_sandbox' => 'Środowisko testowe',
    'paypal_sandbox_helper' => 'Rozmawia z kontem testowym PayPala zamiast z prawdziwym. Ich client id wyglądają tak samo w obu przypadkach i właśnie dlatego ten przełącznik istnieje.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Z aplikacji utworzonej w Apps & Credentials. Sprawdź, czy zakładka zgadza się z przełącznikiem powyżej.',
    'paypal_secret_helper' => 'Obok client ID, za przyciskiem Show. Nigdy nie trafia do wyeksportowanego pliku ustawień.',
    'paypal_hook' => 'ID webhooka',
    'paypal_hook_id_helper' => 'ID, które PayPal nadaje webhookowi po dodaniu - nie adres. Bez niego ich wiadomości nie da się u nich sprawdzić i są pomijane.',
    'paypal_hook_helper' => 'Dodaj :url jako webhook w tej aplikacji, dla PAYMENT.CAPTURE.COMPLETED, i wklej tutaj nadane ID.',

    // ---- strona płatności ------------------------------------------------
    'pay_title' => 'Zapłać',
    'pay_subheading' => 'Ile jesteś winien i jak to uregulować.',
    'pay_choose' => 'Jak chcesz zapłacić?',
    'pay_choose_body' => 'Cokolwiek wybierzesz, kończysz na ich własnej stronie i zaraz potem wracasz tutaj.',
    'pay_safe' => 'Do zapłaty przenosimy cię do operatora. Dane twojej karty nigdy nie trafiają do tego panelu.',
    'pay_no_ways' => 'Gdy pieniądze dojdą, faktura zostanie oznaczona jako opłacona, a twój serwer przygotowany.',
    'free' => 'Nic do zapłaty',
    'free_body' => 'Kod rabatowy pokrył całą tę fakturę, więc nie ma czego płacić. Naciśnij przycisk i gotowe.',
    'free_go' => 'Zakończ',
    'free_done' => 'Uregulowane',
    'free_done_body' => 'Nie było czego płacić, więc faktura jest zamknięta. Twój serwer właśnie powstaje.',
    'pay_gone' => 'Takiej faktury nie ma',
    'pay_gone_body' => 'Mogła zostać wycofana albo adres jest niewłaściwy.',
    'pay_already' => 'Ta jest już opłacona',
    'pay_already_body' => 'Nic więcej do zrobienia. Wszystko, co na nią czekało, jest już w drodze.',
    'pay_withdrawn' => 'Ta została wycofana',
    'pay_withdrawn_body' => 'Nie ma jej w księgach i nie trzeba jej płacić. Zapytaj osobę prowadzącą ten panel, jeśli to wygląda dziwnie.',
    'back_to_billing' => 'Wróć do płatności',

    'gateway_mollie_note' => 'iDEAL, Bancontact, karta i więcej',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Twoje saldo PayPal albo karta przez PayPala',

    // ---- usługi i faktury, osobno ----------------------------------------
    'services_title' => 'Moje usługi',
    'services_nav_label' => 'Moje usługi',
    'services_subheading' => 'To, za co płacisz, i serwer, który z każdej usługi powstał.',
    'open_server' => 'Otwórz serwer',
    'no_server_yet' => 'W przygotowaniu',

    'invoices_title' => 'Faktury',
    'invoices_subheading' => 'To, czym cię obciążono, i to, co zostało do zapłaty.',
    'no_invoices_body' => 'Wszystko, co kupisz, jest tu fakturowane i zostaje tutaj po opłaceniu.',

    // ---- sklep jako strona startowa --------------------------------------
    'section_landing' => 'Gdzie stoi sklep',
    'section_landing_helper' => 'Czy sklep jest drzwiami wejściowymi panelu, dla klientów i dla ludzi, którzy się nie zalogowali.',
    'landing' => 'Najpierw otwórz sklep',
    'landing_helper' => 'Włączone: sklep jest pierwszą stroną po zalogowaniu, a lista serwerów przesuwa się obok. Twoje usługi i faktury zostają o jedno kliknięcie, w nagłówku sklepu i w menu konta. Kto nie jest zalogowany, dostaje publiczny sklep zamiast formularza logowania, a o zalogowanie jest proszony dopiero wtedy, gdy wybierze pakiet - potrzebna jest do tego także włączona publiczna strona sklepu. Wyłączone: panel otwiera się na liście serwerów, którą rysuje sam Pelican, kto nie jest zalogowany, dostaje formularz logowania, a sklep jest stroną jak każda inna.',
    'self_cancel' => 'Pozwól klientom samodzielnie kończyć swoje usługi',
    'self_cancel_helper' => 'Dwa wyjścia na stronie ich usług: zakończenie w dacie umowy, co zatrzymuje faktury i usuwa serwer w dniu, o którym im powiedziano, albo zatrzymanie teraz, co usuwa go natychmiast. To te same przyciski, które masz na stronie Zamówienia. Wyłączone: nie ma żadnego z nich, a o zakończenie usługi muszą poprosić ciebie.',
];
