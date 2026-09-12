<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Prašymas pranešti, kai išparduotas paketas vėl bus parduodamas.
 *
 * Formuluotė niekam nieko nežada. Kai prekių vėl atsiranda, pranešama visam
 * sąrašui iš karto, o gauna tas, kas nusiperka pirmas - tad kiekvienas sakinys
 * čia tai pasako tiesiai, o ne šūkteli „jis grįžo!“ ir palieka dvidešimt
 * aštuonis žmones patiems išsiaiškinti, ko tai buvo verta.
 *
 * Pranešimas taip pat išbraukia iš sąrašo, ir tai irgi pasakoma garsiai:
 * vienas prašymas nuperka vieną pranešimą - dėl to varpelis ir lieka vertas
 * skaityti.
 */

return [
    'bell_back' => ':name vėl parduodamas',
    'bell_back_body' => '{1} Yra vienas, ir jis atiteks tam, kas nusipirks pirmas. Iš sąrašo tavęs jau nebėra, tad paprašyk vėl, jei nespėsi.|[2,*] Yra :count, ir jie atiteks tiems, kas nusipirks pirmi. Iš sąrašo tavęs jau nebėra, tad paprašyk vėl, jei nespėsi.',
    'bell_back_any' => 'Jis nebėra ribojamas, tad užteks visiems. Iš sąrašo tavęs jau nebėra.',
];
