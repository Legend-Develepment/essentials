<?php

/*
 * Română. Scris de mână.
 *
 * Cererea de a fi anunțat când un pachet epuizat este iar de vânzare.
 *
 * Formularea nu promite nimănui lucrul în sine. Când stocul revine, toată lumea
 * de pe listă este anunțată deodată, iar pachetul îi rămâne celui care cumpără
 * primul, așa că fiecare frază de aici o spune pe șleau, în loc să strige „a
 * revenit!” și să lase douăzeci și opt de oameni să afle singuri cât a valorat.
 *
 * Anunțul scoate omul de pe listă, iar asta se spune tot cu voce tare: o cerere
 * cumpără un singur anunț, și tocmai asta ține clopoțelul demn de citit.
 */

return [
    'bell_back' => ':name este iar disponibil',
    'bell_back_body' => '{1} Este unul și rămâne celui care cumpără primul. Acum ai ieșit de pe listă, deci cere din nou dacă îl scapi.|[2,*] Sunt :count și rămân celor care cumpără primii. Acum ai ieșit de pe listă, deci cere din nou dacă le scapi.',
    'bell_back_any' => 'Nu mai este limitat, deci este câte unul pentru toată lumea. Acum ai ieșit de pe listă.',
];
