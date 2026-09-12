<?php

/*
 * Čeština. Psáno rukou.
 *
 * Přesun živé služby z jednoho balíčku na druhý.
 *
 * Slova drží celou dobu od sebe jednu věc: kolik balíček stojí a kolik stojí
 * přejít na něj dneska, jsou dvě různá čísla. To první je na pultě; to druhé
 * závisí na tom, jak daleko je tahle služba v zaplaceném období, a je to ono,
 * s čím člověk souhlasí, když zmáčkne tlačítko.
 *
 * Slovu „upgrade" se v tom, co čte zákazník, vyhýbáme, protože polovina těch
 * přesunů jde opačným směrem. Tady se tomu říká změna.
 */

return [
    // ---- na kartě služby -------------------------------------------------
    'change' => 'Změnit balíček',
    'change_body' => 'To, co zbývá z období, které už máš zaplacené, se odečte, a tytéž dny se naúčtují novou cenou. Na tvém serveru se nic neztratí.',
    'change_to' => 'Změnit na :name',
    'change_confirm' => 'Změnit tuhle službu na :name?',
    'change_free' => 'Není co platit',
    'costs_now' => ':amount teď',
    'gives_back' => ':amount zpátky',
    'waiting' => 'Změna domluvena',
    'waiting_for' => 'Změna na :name čeká na nezaplacenou fakturu.',

    // ---- co se stane potom ------------------------------------------------
    'done' => 'Přesunuto na :name',
    'done_body' => 'Tvoje služba je na novém balíčku. Co ti zbývalo, máš na účtu.',
    'refused' => 'Změna se neprovedla',

    // ---- a proč ne, vždycky jeden důvod -----------------------------------
    'refused_off' => 'Změna balíčku je na tomhle panelu vypnutá.',
    'refused_not_active' => 'Změnit jde jen běžící služba. U té, která čeká na postavení, je pozastavená nebo končí, není co vyrovnávat.',
    'refused_gone' => 'Balíček, na kterém tahle služba je, už neexistuje, takže není s čím porovnávat.',
    'refused_same' => 'Na tom balíčku už je.',
    'refused_egg' => 'Ten balíček běží na jiném softwaru. Byl by z toho jiný server, ne větší, takže se musí koupit jako nový.',
    'refused_period' => 'Ten balíček se fakturuje za jiné období, a to je jiná dohoda, ne větší.',
    'refused_stock' => 'Ten balíček je vyprodaný.',
    'refused_waiting' => 'U téhle služby už jedna změna čeká na nezaplacenou fakturu. Nejdřív ji zaplať nebo zruš.',
    'refused_failed' => 'Nic se nezapsalo, takže se nic nezměnilo. Zkus to znovu, a jestli se to bude opakovat, řekni to tomu, kdo tenhle panel spravuje.',
    'refused_server' => 'Serveru se nepodařilo předat nové limity, takže služba zůstala přesně taková, jaká byla. Kdo tenhle panel spravuje, se o tom dozvěděl.',

    // ---- co stojí na dokladech --------------------------------------------
    'line' => 'Změna z :from na :to, za zbývající dny tohoto období: :days',
    'credit_reason' => 'Změna na :name',

    // ---- a co se dozví majitel --------------------------------------------
    'bell_failed' => 'Změna balíčku selhala u objednávky :number',
    'cold_title' => 'Změna balíčku došla do panelu, ale ne na node, u objednávky :number',
    'cold_body' => 'Služba je na :name a nové limity jsou zapsané. Node si je ještě nevzal a přečte si je, až ten server příště nastartuje, takže do té doby má zákazník pořád starou velikost. Zkontroluj node.',
    'gone' => 'Balíček, na který se přecházelo, už neexistuje.',
    'refused_by_node' => 'Server nové limity nepřijal: :why',

    // ---- jak to uvést do pořádku ------------------------------------------
    'retry' => 'Zkusit změnu znovu',
    'retry_confirm' => 'Zkusí změnu balíčku znovu. Faktura za ni je už zaplacená, takže se nic neúčtuje dvakrát.',
    'retried' => 'Změna prošla',
    'retry_failed' => 'Selhalo to znovu. Důvod je na objednávce.',
];
