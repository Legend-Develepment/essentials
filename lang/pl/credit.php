<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Środki, zwroty i faktury korygujące.
 *
 * Dwa słowa są poniżej wszędzie trzymane osobno.
 *
 * „Środki" to pieniądze, które sklep dla kogoś trzyma. Schodzą same z jego
 * następnej faktury, zanim ktokolwiek poprosi go o zapłatę.
 *
 * „Zwrot" to samo oddanie pieniędzy i ma dwa kierunki: z powrotem na kartę, z
 * której przyszły, albo na konto jako środki. Tekst zawsze mówi który, bo
 * klient, któremu napisano „zwrócono", a który potem nie znajduje nic w banku,
 * pisze do sklepu - i słusznie.
 *
 * „Faktura korygująca" to dokument. Powstaje tak czy inaczej, bo jest zapisem
 * tego, że pieniądze nie należą się już sklepowi - a nie twierdzeniem o tym,
 * dokąd poszły.
 */

return [
    // ---- co widzi klient -------------------------------------------------
    'yours' => 'Twoje środki',
    'yours_body' => 'Schodzą automatycznie z Twojej następnej faktury. Nie musisz nic z nimi robić.',
    'applied' => 'Zapłacone ze środków',
    'payable' => 'Zostaje do zapłaty',

    // ---- historia, w oknie klienta ---------------------------------------
    'held' => 'Środki',
    'none_held' => 'Nic na koncie',
    'movements' => 'Środki',
    'column' => 'Środki',
    'none' => 'Brak',

    // ---- przyznawanie ----------------------------------------------------
    'give' => 'Przyznaj środki',
    'give_helper' => 'Na tym koncie jest :held. To, co dołożysz, zejdzie samo z następnej faktury. Kwota ujemna zabiera środki z powrotem, a obie zmiany zostają w historii.',
    'amount' => 'Kwota',
    'amount_helper' => 'Kwota ujemna zabiera środki, zamiast je dawać.',
    'reason' => 'Powód',
    'reason_helper' => 'Klient widzi to obok kwoty, więc napisz to dla niego, a nie do akt.',
    'given' => ':amount środków dla :who',
    'bad_amount' => 'To nie jest kwota.',
    'give_failed' => 'Środki nie zostały przyznane',
    'give_failed_body' => 'Nic nie zostało zapisane. Spróbuj ponownie, a jeśli to się powtarza, zajrzyj do logu.',
    'take_failed' => 'Środki nie zostały zabrane',
    'take_failed_body' => 'Na koncie jest mniej, niż chcesz z niego zdjąć. Saldo nigdy nie schodzi poniżej zera.',

    // ---- co mówi jedna zmiana --------------------------------------------
    'spent_on' => 'Faktura :number',
    'returned' => 'Wróciło z powrotem: faktury, na którą to szło, nie dało się wystawić',
    'note_line' => 'Faktura korygująca do faktury :number',
    'refund_description' => 'Zwrot faktury :number',

    // ---- oddawanie -------------------------------------------------------
    'refund' => 'Zwróć',
    'refund_helper' => 'Z tej faktury :left nie zostało jeszcze oddane. Faktura korygująca powstaje tak czy inaczej, więc zapis jest po obu stronach.',
    'refund_amount_helper' => 'Część też może być. Reszta może wrócić później.',
    'refund_reason_helper' => 'To jest drukowane na fakturze korygującej, którą klient może otworzyć.',
    'where' => 'Dokąd idą pieniądze',
    'where_provider' => 'Z powrotem tam, czym zapłacili',
    'where_provider_helper' => 'Operator odsyła je na kartę albo konto, z którego przyszły. Zanim się pojawią, może minąć kilka dni, i może odmówić - przy starej płatności albo metodzie, która się nie cofa.',
    'where_balance' => 'Na ich konto tutaj',
    'where_balance_helper' => 'Stają się środkami i zejdą z ich następnej faktury. Nic nie opuszcza banku i nie ma się co nie udać.',
    'refunded' => 'Zwrócono :amount',
    'refunded_body' => 'Wystawiono na to fakturę korygującą :number.',
    'refund_failed' => 'Nic nie zostało zwrócone',

    // ---- a dlaczego nie, po jednym powodzie na raz -----------------------
    'refused_off' => 'Środki i zwroty są w tym panelu wyłączone.',
    'refused_amount' => 'To więcej, niż zostało na tej fakturze.',
    'refused_no_payment' => 'Żadna płatność na tej fakturze nie ma tyle w zapasie, więc nie ma czego cofać u operatora. Dopisz to zamiast tego do ich konta.',
    'refused_no_gateway' => 'Operator, przez którego to zapłacono, nie jest już włączony, więc nie da się go poprosić o cofnięcie. Dopisz to zamiast tego do ich konta.',
    'refused_refused' => 'Operator odmówił. Zwykle chodzi o starą płatność albo metodę, która się nie cofa; powód, który podał, jest w logu. Dopisz to zamiast tego do ich konta.',
    'refused_note_failed' => 'Pieniądze się przesunęły, ale faktury korygującej nie dało się wystawić, więc nic nie zostało zapisane. Zajrzyj do logu, zanim spróbujesz ponownie.',

    // ---- dokładanie pieniędzy --------------------------------------------
    'topup' => 'Doładuj środki',
    'topup_helper' => 'Masz na koncie :held. To, co tu dołożysz, zejdzie samo z Twojej następnej faktury, a każda faktura, którą masz już otwartą, zostanie z tego opłacona, gdy tylko pieniądze dojdą.',
    'topup_go' => 'Przejdź do płatności',
    'topup_amount_helper' => 'Od :least do :most.',
    'topup_bad' => 'Tej kwoty nie da się zapłacić',
    'topup_failed' => 'Nie udało się rozpocząć płatności. Spróbuj ponownie, a jeśli to się powtarza, powiedz o tym osobie, która prowadzi ten panel.',
    'topup_line' => 'Środki dopisane do konta',
    'topup_reason' => 'Doładowane na fakturze :number',

    // ---- gdzie to widać --------------------------------------------------
    'menu' => ':amount środków',
    'held_helper' => 'Schodzą same z Twojej następnej faktury. Doładujesz je na stronie faktur.',
];
