<?php

/*
 * Svenska. Skriven för hand.
 *
 * Att be om besked när ett slutsålt paket går att köpa igen.
 *
 * Orden lovar aldrig någon själva saken. När lagret fylls på får alla på listan
 * veta det samtidigt, och den går till den som köper först - så varje mening
 * här säger det rakt ut i stället för att säga «den är tillbaka!» och lämna
 * tjugoåtta personer att räkna ut vad det var värt.
 *
 * Att få besked tar också bort en från listan, och det sägs också högt: en
 * fråga köper ett besked, och det är det som håller klockan värd att läsa.
 */

return [
    'bell_back' => ':name går att köpa igen',
    'bell_back_body' => '{1} Det finns en, och den går till den som köper först. Du är av listan nu, så fråga igen om du missar den.|[2,*] Det finns :count, och de går till dem som köper först. Du är av listan nu, så fråga igen om du missar dem.',
    'bell_back_any' => 'Den är inte begränsad längre, så det finns en åt alla. Du är av listan nu.',
];
