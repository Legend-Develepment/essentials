<?php

/*
 * Suomi. Kirjoitettu käsin.
 *
 * Asiakkaat: kauppa, mutta käännettynä ihmiseen päin rivin sijaan.
 *
 * Tilaukset, laskut ja maksut ovat kukin luettelo siitä, mitä on tapahtunut.
 * Tämä sivu esittää sen kysymyksen, joka tukipyyntöä hoitavalla oikeasti on:
 * kuka tämä on, mitä hänellä on, mitä on maksettu ja mitä jää jäljelle.
 */

return [
    'title' => 'Asiakkaat',
    'nav_label' => 'Asiakkaat',
    'subheading' => 'Kaikki jotka ovat ostaneet jotain, sen kanssa mitä heillä on, mitä he ovat maksaneet ja mitä on vielä velkaa.',

    // ---- taulukko --------------------------------------------------------
    'column_customer' => 'Asiakas',
    'column_services' => 'Palvelut',
    'column_spent' => 'Maksettu',
    'column_outstanding' => 'Avoinna',

    'of_orders' => ':count tilatusta',
    'nothing_owed' => 'Ei mitään',

    'filter_owing' => 'On jotain velkaa',
    'filter_active' => 'On käytössä oleva palvelu',

    // ---- yksi heistä -----------------------------------------------------
    'open' => 'Avaa',
    'close' => 'Sulje',
    'servers' => 'Palvelimet',
    'since' => 'Asiakkaana',
    'their_services' => 'Palvelut',
    'their_invoices' => 'Laskut',
    'no_services' => 'Ei mitään käytössä eikä mitään rakennusta odottamassa.',
    'no_invoices' => 'Tälle tilille ei ole kirjoitettu yhtään laskua.',

    'empty' => 'Kukaan ei ole vielä ostanut mitään',
    'empty_body' => 'Täällä ovat ne jotka ovat tilanneet, eivät kaikki joilla on tili - joten se täyttyy ensimmäisestä kaupasta.',
    'who' => 'Kuka hän on',
];
