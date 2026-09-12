<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * At bede om besked, når en udsolgt pakke er til salg igen.
 *
 * Teksten lover aldrig nogen selve tingen. Når der kommer noget på lager igen,
 * får alle på listen besked på én gang, og den går til den, der køber først, så
 * hver sætning siger det ligeud i stedet for at sige „den er tilbage!“ og lade
 * otteogtyve mennesker finde ud af, hvad det var værd.
 *
 * At få besked tager også en af listen, og det bliver sagt højt: én forespørgsel
 * køber én besked, og det er det, der holder klokken værd at læse.
 */

return [
    'bell_back' => ':name er til salg igen',
    'bell_back_body' => '{1} Der er én, og den går til den, der køber først. Du står ikke på listen længere, så spørg igen, hvis du misser den.|[2,*] Der er :count, og de går til dem, der køber først. Du står ikke på listen længere, så spørg igen, hvis du misser dem.',
    'bell_back_any' => 'Den er ikke begrænset længere, så der er én til alle. Du står ikke på listen længere.',
];
