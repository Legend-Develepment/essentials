<?php

/*
 * Română. Scris de mână.
 *
 * Mutarea unui serviciu activ de pe un pachet pe altul.
 *
 * Formularea ține un lucru limpede peste tot: cât costă un pachet și cât costă
 * astăzi trecerea pe el sunt două sume diferite. Prima stă pe raft; a doua
 * depinde de cât s-a scurs din perioada plătită a acestui serviciu și este cea
 * cu care cineva este de acord când apasă butonul.
 *
 * Cuvântul „upgrade” este evitat în ce citește clientul, pentru că jumătate
 * dintre mutările acestea merg în cealaltă direcție. Aici se numește schimbare.
 */

return [
    // ---- pe fișa serviciului ---------------------------------------------
    'change' => 'Schimbă pachetul',
    'change_body' => 'Se scade ce a mai rămas din perioada deja plătită, iar aceleași zile se taxează la prețul nou. Nu se pierde nimic de pe serverul tău.',
    'change_to' => 'Schimbă în :name',
    'change_confirm' => 'Schimbi acest serviciu în :name?',
    'change_free' => 'Nimic de plată',
    'costs_now' => ':amount acum',
    'gives_back' => ':amount înapoi',
    'waiting' => 'Schimbare convenită',
    'waiting_for' => 'O schimbare în :name așteaptă o factură neplătită.',

    // ---- ce se întâmplă după ---------------------------------------------
    'done' => 'Mutat pe :name',
    'done_body' => 'Serviciul tău este pe pachetul nou. Tot ce ți se cuvenea este în contul tău.',
    'refused' => 'Schimbarea nu s-a făcut',

    // ---- și de ce nu, câte un motiv pe rând ------------------------------
    'refused_off' => 'Schimbarea pachetului este oprită pe acest panou.',
    'refused_not_active' => 'Se poate schimba doar un serviciu care merge. Unul care așteaptă, este suspendat sau se încheie nu are ce să deconteze.',
    'refused_gone' => 'Pachetul pe care stă acest serviciu nu mai există, deci nu are cu ce să fie comparat.',
    'refused_same' => 'Este chiar pachetul pe care stă deja.',
    'refused_egg' => 'Acel pachet rulează alt software. Ar fi alt server, nu unul mai mare, deci trebuie cumpărat ca atare.',
    'refused_period' => 'Acel pachet se facturează pe altă perioadă, iar asta este altă înțelegere, nu una mai mare.',
    'refused_stock' => 'Acel pachet este epuizat.',
    'refused_waiting' => 'Există deja o schimbare care așteaptă o factură neplătită pentru acest serviciu. Plătește-o sau anuleaz-o mai întâi.',
    'refused_failed' => 'Nu s-a notat nimic, deci nu s-a schimbat nimic. Încearcă din nou și spune-i celui care ține panoul dacă se tot întâmplă.',
    'refused_server' => 'Serverului nu i s-au putut da limitele noi, așa că serviciul a rămas exact cum era. Cel care ține panoul a fost anunțat.',

    // ---- ce scrie pe documente -------------------------------------------
    'line' => 'Schimbare de la :from la :to, pentru cele :days zile rămase din această perioadă',
    'credit_reason' => 'Schimbare în :name',

    // ---- și ce află proprietarul -----------------------------------------
    'bell_failed' => 'O schimbare de pachet a eșuat la comanda :number',
    'cold_title' => 'O schimbare de pachet a ajuns la panou, dar nu și la node, la comanda :number',
    'cold_body' => 'Serviciul este pe :name, iar limitele noi sunt înregistrate. Node-ul nu le-a preluat încă și le va citi la următoarea pornire a acelui server, deci până atunci clientul are tot dimensiunea veche. Verifică node-ul.',
    'gone' => 'Pachetul spre care se făcea mutarea nu mai există.',
    'refused_by_node' => 'Serverul nu a acceptat limitele noi: :why',

    // ---- îndreptarea lucrurilor -------------------------------------------
    'retry' => 'Încearcă schimbarea din nou',
    'retry_confirm' => 'Încearcă din nou schimbarea de pachet. Factura pentru ea este deja plătită, deci nu se taxează nimic de două ori.',
    'retried' => 'Schimbarea a trecut',
    'retry_failed' => 'A eșuat din nou. Motivul este pe comandă.',
];
