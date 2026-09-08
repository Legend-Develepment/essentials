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
    'grace_helper' => 'Niezapłacona faktura po tym czasie zawiesza serwer — to własne zawieszenie Pelicana, zdejmowane z chwilą opłacenia faktury. Sklep nigdy niczego nie usuwa.',
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
];
