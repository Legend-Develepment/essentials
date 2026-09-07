<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Die Spielmodi und Schwierigkeitsgrade bleiben unübersetzt. Minecraft zeigt sie
 * im Spiel selbst als Survival, Creative, Peaceful und Hard — auch in einem
 * deutschen Client ist das, was man in der Welt sieht — und eine Einstellung,
 * die anders heißt als der Bildschirm, aus dem sie kommt, ist eine, die man
 * zweimal nachschlagen muss.
 *
 * Dasselbe gilt für die Begriffe, die in der server.properties selbst stehen:
 * Whitelist, Operator, Seed, Chunk, RCON, Query, Resource Pack und der Nether.
 */

return [
    /* ------------------------------------------------- das Admin-Tab ----- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft-Einstellungen',
    'subheading' => 'Die server.properties dieses Servers — als Formular statt als Textdatei.',

    'section_helper' => 'Für welche Eggs das gilt, und alles Übrige, was dieses Plugin rund um Minecraft tut.',

    'live' => 'Server fragen, wer gerade spielt',
    'live_helper' => 'Ergänzt die Spielerseite um eine Liste der gerade Verbundenen, über denselben Handshake, mit dem der Minecraft-Client einen Server in seiner eigenen Liste zeichnet. Standardmäßig aus, denn es ist das Einzige hier, das eine Verbindung vom Panel direkt auf einen Spielport öffnet: liegen Panel und Nodes in Netzen, die einander nicht erreichen, antwortet nichts und die Zeile erscheint schlicht nicht. Auf dem Spielserver selbst muss nichts eingeschaltet werden.',

    'eggs' => 'Welche Eggs sind Minecraft',
    'eggs_helper' => 'Hake die Eggs an, die einen Minecraft-Server fahren — Vanilla, Paper, Purpur, Fabric, Forge, und wie deine sonst heißen. Die Seite erscheint in Servern, die sie nutzen, und sonst nirgends. Zu Beginn ist absichtlich nichts angehakt: ein Plugin kann nicht wissen, wie du deine Eggs genannt hast, und eine geratene Liste wäre auf irgendeinem Panel schon in der Woche falsch, in der sie erscheint.',

    /* ------------------------------------------- die Seite im Server ----- */

    'groups' => [
        'general' => 'Der Server',
        'players' => 'Spieler',
        'world' => 'Die Welt',
        'performance' => 'Leistung',
        'access' => 'Zugang und Zusätzliches',
        'other' => 'Alles Übrige in der Datei',
    ],

    'other_helper' => 'Aus der server.properties gelesen und genau so belassen. Mods und Modpacks legen hier ihre eigenen Einstellungen ab; sie werden gezeigt, damit du siehst, dass es sie gibt, und über den Dateimanager geändert. Das Speichern dieser Seite fasst sie nie an.',

    'reload' => 'Datei erneut lesen',

    'saved' => 'In die server.properties gespeichert',
    'saved_helper' => 'Es greift beim nächsten Start des Servers.',

    'running' => 'Der Server läuft',
    'running_helper' => 'Minecraft liest die server.properties beim Start und schreibt sie beim Stoppen zurück — jetzt Gespeichertes würde also beim Herunterfahren überschrieben. Stoppe den Server und speichere erneut.',

    'missing' => 'Keine server.properties gefunden',
    'missing_helper' => 'Die Datei erscheint, wenn der Server zum ersten Mal gestartet wird. Starte ihn einmal und komm dann zurück.',

    'failed' => 'Konnte nicht gespeichert werden',
    'failed_helper' => 'Die Daemon hat den Schreibvorgang abgelehnt. Vielleicht ist der Server gestartet, während diese Seite offen war.',

    /* ------------------------------------ was die einzelnen Schlüssel sind */

    'keys' => [
        'motd' => 'Nachricht in der Serverliste',
        'gamemode' => 'Spielmodus',
        'difficulty' => 'Schwierigkeit',
        'hardcore' => 'Hardcore — der Tod ist endgültig',
        'force_gamemode' => 'Beim Beitreten alle zurück in den Standardmodus setzen',
        'pvp' => 'Spieler können einander verletzen',
        'max_players' => 'Höchstens gleichzeitig',
        'white_list' => 'Nur Whitelist',
        'enforce_whitelist' => 'Alle kicken, die nicht auf der Whitelist stehen',
        'online_mode' => 'Konten bei Mojang prüfen',
        'player_idle_timeout' => 'Kicken nach Minuten Untätigkeit',
        'op_permission_level' => 'Was ein Operator darf (1–4)',
        'level_name' => 'Weltordner',
        'level_seed' => 'Seed',
        'level_type' => 'Weltentyp',
        'allow_nether' => 'Der Nether',
        'spawn_monsters' => 'Monster spawnen',
        'spawn_protection' => 'Geschützte Blöcke rund um den Spawn',
        'view_distance' => 'Sichtweite in Chunks',
        'simulation_distance' => 'Simulationsweite in Chunks',
        'max_tick_time' => 'Watchdog, in Millisekunden (-1 ist aus)',
        'sync_chunk_writes' => 'Chunks direkt auf die Festplatte schreiben',
        'enable_command_block' => 'Befehlsblöcke',
        'allow_flight' => 'Fliegen erlauben',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adresse des Resource Packs',
        'require_resource_pack' => 'Das Resource Pack ist Pflicht',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
