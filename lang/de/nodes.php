<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Der Block auf dem Dashboard: die Maschine, auf der das Panel liegt, und jede
 * Node.
 *
 * Die Zahlen der Nodes sind Pelicans eigene, bei der Daemon jeder Node gelesen.
 * Die Zeile für das Panel wird aus /proc gelesen, was eine andere Frage ist -
 * siehe Support\SystemStatus.
 */

return [
    // Die Überschrift des Blocks ist der Name des Plugins selbst, zur Laufzeit
    // gelesen - dafür gibt es hier also keinen Text.
    'panel' => 'Dieses Panel',
    'offline' => 'antwortet nicht',
    'maintenance' => 'Wartung',
    'cpu' => 'CPU',
    'memory' => 'Arbeitsspeicher',
    'disk' => 'Festplatte',
    'load' => 'Auslastung',
];
