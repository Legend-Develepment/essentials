<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Modpack", "Loader" und "Egg" bleiben stehen: so heißen sie im Spiel, bei
 * Modrinth und im Panel, und ein eingedeutschtes Wort wäre eines, das niemand
 * dort wiederfindet.
 */

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Ein Modpack von Modrinth auf diesem Server installieren.',

    'section' => 'Pack suchen',
    'section_helper' => 'Nur Modrinth, und nur serverseitige Packs. Es braucht weder Konto noch API-Schlüssel - deshalb ist es hier die einzige Quelle: bei den anderen muss erst ein Schlüssel eingefügt werden, bevor überhaupt etwas erscheint.',

    'search' => 'Suche',
    'search_helper' => 'Leer lassen für die meistgeladenen. Die Suche fragt bei Modrinth an und läuft deshalb, wenn du das Feld verlässt - nicht beim Tippen.',

    'pack' => 'Pack',
    'pack_helper' => 'Aufgeführt sind nur Packs, die angeben, auf einem Server zu laufen.',

    'version' => 'Version',
    'version_helper' => 'Spielversion und Loader stehen jeweils daneben. Wähle den Loader, den das Egg dieses Servers ohnehin fährt - das hier installiert Dateien und ändert weder dein Egg noch deinen Startbefehl.',

    'downloads' => 'Downloads',

    'install' => 'Dieses Pack installieren',
    'install_go' => 'Installieren',
    'install_confirm' => 'Die Dateien des Packs werden diesem Server hinzugefügt. **Es wird nichts gelöscht** - weder deine Welt noch deine alten Mods noch eine Konfiguration. Ein Pack über einem anderen lässt beide stehen; entferne die Mods des vorherigen also vorher selbst, wenn du das willst. Der Server muss gestoppt sein und bleibt es auch.',

    'started' => 'Wird installiert',
    'started_helper' => 'Das Pack wird geholt und entpackt. Ein paar hundert Dateien dauern ein paar Minuten, und du bekommst eine Meldung, wenn es fertig ist - es läuft weiter, auch wenn du diese Seite verlässt.',

    'running' => 'Der Server läuft',
    'running_helper' => 'Minecraft lädt seine Mods beim Start. Ein jetzt installiertes Pack ergäbe also einen Server, der bis zum Neustart weder das alte noch das neue ist. Stoppe ihn und versuche es erneut.',

    'done' => ':pack installiert',
    'done_body' => ':files Dateien geholt und :overrides Einträge aus dem eigenen Ordner des Packs an Ort und Stelle gebracht. Starte den Server, wenn du so weit bist.',
    'done_refused' => ':count Dateien wurden übersprungen, weil das Pack sie von einer Stelle wollte, von der hier nicht heruntergeladen wird.',

    'failed' => 'Das Pack wurde nicht installiert',
    'failed_fetch' => 'Das Pack konnte nicht geholt oder entpackt werden. Vielleicht ist die Daemon nicht erreichbar, oder dem Server geht der Speicherplatz aus.',
    'failed_index' => 'Das Pack wurde geholt, hatte aber keinen lesbaren Index - es gab also nichts zu installieren.',
    'failed_version' => 'Zu dieser Version gibt es keine Pack-Datei mehr zum Herunterladen. Wähle eine andere.',
    'failed_queue' => 'Die Installation konnte nicht eingereiht werden. Dafür muss auf dem Panel ein Queue-Worker laufen.',
];
