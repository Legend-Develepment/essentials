<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Spara',
    'saved' => 'Sparat',
    'restart' => 'Spelet läser den här filen vid start, så starta om servern för att ändringen ska gälla.',
    'failed' => 'Kunde inte spara',
    'failed_write' => 'Daemonen avvisade skrivningen. Kontrollera att servern går att nå och att filen inte är skrivskyddad.',
    'read_only' => 'Du får läsa den här filen men inte skriva den, så inget här går att ändra.',
    'missing' => 'Den här servern har ingen inställningsfil än. Spelet skriver den första gången det körs, så starta servern en gång så fylls sidan i.',
    'keeps' => 'Allt annat i filen - kommentarerna, de tomma raderna, ordningen och varje nyckel som det här tillägget aldrig hört talas om - står precis som det var när du sparar.',
    'raw' => 'Namnen här är spelets egna, i filens ordning. Inget översätts eller grupperas, för sidan läser filen i stället för en handskriven lista.',
    'unset' => 'Inte satt. Spelet nämner den som exempel; fyll i den för att lägga till den.',
    'group_all' => 'Inställningar',
    'group_all_helper' => 'Allt som den här filen nämner.',
    'subheading' => 'Byggt från :files i stället för en handskriven lista.',
];
