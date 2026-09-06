<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Egg» resta in inglese: è la parola che Pelican usa in tutta la sua
 * interfaccia, e un'impostazione con un nome diverso da quello della schermata
 * da cui viene è un'impostazione da cercare due volte.
 */

return [
    'title' => 'Duplica un server',
    'nav_label' => 'Duplica server',
    'subheading' => 'Un altro server allestito esattamente come uno che hai già, oppure diversi in una volta.',

    'section' => 'Cosa viene copiato',
    'section_helper' => 'Vengono copiati il proprietario, l\'egg, il comando di avvio, i limiti e tutte le variabili. I file, i database, i backup e le operazioni pianificate no — copiare i file di un server in esecuzione è copiarne lo stato, che raramente è ciò che si intende con «un altro come questo».',

    'source' => 'Copia da',
    'source_helper' => 'Le copie finiscono sullo stesso nodo di questo server, perché è lì che stanno i suoi indirizzi liberi.',

    'name' => 'Nome della copia',
    'name_helper' => 'Farne più di una le numera: «Bot 1», «Bot 2», e così via.',

    'copies' => 'Quante',
    'copies_helper' => 'Scegli prima un server.',
    'room' => ':count indirizzi liberi su :node, quindi è il massimo che si possa fare adesso.',
    'no_room' => 'Non è rimasto nessun indirizzo libero su :node. Una copia ne vuole uno suo, quindi aggiungi prima un\'allocazione a quel nodo.',

    /*
     * Contate e non elencate per i successi, ed elencate per i fallimenti, che
     * è il verso che aiuta: dieci nomi che hanno funzionato sono un muro di
     * testo che nessuno legge, e quello che non ha funzionato è l'unica cosa
     * che vale la pena leggere.
     */
    'made' => ':count copie create',
    'partly_failed' => 'Non è stato possibile creare :count copie',
    'failed' => 'Non è stato copiato nulla',
];
