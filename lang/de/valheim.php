<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * SteamID64 und PlayFab bleiben unübersetzt: so heißen sie dort, wo man sie
 * herholt, und ein Name, den es nur hier gibt, ist einer, den niemand
 * nachschlagen kann.
 */

return [
    /* ------------------------------------------------- das Admin-Tab ----- */

    'section_helper' => 'Welche Eggs Valheim fahren. Sonst nichts — ein Valheim-Server wird über die Startvariablen eingestellt, und Pelicans eigene Startup-Seite bearbeitet die bereits.',

    'eggs' => 'Welche Eggs sind Valheim',
    'eggs_helper' => 'Hake die Eggs an, die einen Valheim-Server fahren. In Servern, die sie nutzen, erscheint dann eine Seite „Spielerlisten" — und sonst nirgends. Wo diese Listen liegen, hängt vom Egg ab; das wird deshalb je Server ermittelt, indem an den Stellen nachgesehen wird, die das Spiel benutzt. Zu Beginn ist absichtlich nichts angehakt: ein Plugin kann nicht wissen, wie du deine Eggs genannt hast.',

    /* ------------------------------------------- die Seite im Server ----- */

    'nav_label' => 'Spielerlisten',
    'title' => 'Valheim-Spielerlisten',
    'subheading' => 'Admins, Sperren und die Zulassungsliste — als drei Listen statt als drei Textdateien.',

    'admin' => 'Admins',
    'admin_helper' => 'Alle hier können im Spiel die Admin-Befehle benutzen.',
    'banned' => 'Gesperrt',
    'banned_helper' => 'Alle hier werden abgewiesen, wenn sie beitreten wollen.',
    'permitted' => 'Zugelassen',
    'permitted_helper' => 'Steht hier jemand drin, dürfen nur diese Leute beitreten. Eine leere Liste lässt alle herein — und das wollen die meisten Server, lass sie also leer, wenn du es nicht ausdrücklich anders meinst.',

    'ids' => 'Spieler-IDs',
    'ids_placeholder' => 'Eine ID einfügen und Leertaste drücken',

    'how' => 'Eine ID je Spieler — eine SteamID64 auf einem Steam-Server, eine PlayFab-ID auf einem Crossplay-Server. Füge sie ein und drücke Leertaste, Tab oder Komma. Was das Spiel als Kommentar über die Liste geschrieben hat, bleibt stehen.',
    'where' => 'Gelesen aus :dir.',
    'missing' => 'Dieser Server hat noch keine dieser Dateien. Das Spiel legt sie an, wenn es sie braucht — und Speichern legt hier die an, die du ausfüllst.',
    'read_only' => 'Du darfst diese Dateien lesen, aber nicht schreiben — hier lässt sich also nichts ändern.',

    'save' => 'Speichern',
    'saved' => 'Gespeichert',
    'saved_reload' => 'Valheim liest diese Listen im laufenden Betrieb; die Änderung greift also ohne Neustart.',
    'unchanged' => 'Es hatte sich nichts geändert, also wurde nichts geschrieben',
    'failed' => 'Konnte nicht gespeichert werden',
    'failed_lists' => 'Die Daemon hat den Schreibvorgang abgelehnt für: :lists. Prüfe, ob der Server erreichbar und die Dateien nicht schreibgeschützt sind.',
];
