<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Mod", "Plugin", "Loader", "jar" und die Ordnernamen mods/ und plugins/
 * bleiben stehen: das sind die Wörter auf Modrinth, im Dateimanager und in jeder
 * Anleitung, die man dazu findet.
 */

return [
    'nav_label' => 'Mods & Plugins',
    'title' => 'Mods und Plugins',
    'subheading' => 'Eines nach dem anderen, von Modrinth, in diesen Server.',

    'section' => 'Etwas suchen',
    'section_helper' => 'Die Modpack-Seite installiert ein ganzes Pack auf einmal. Hier kommt ein einzelnes Mod oder Plugin hinein - und das ist es, was man weit häufiger will.',

    'kind' => 'Was fügst du hinzu',

    /*
     * Gefragt statt hergeleitet. Ein Egg heißt, wie ein Administrator es genannt
     * hat, und mehrere Loader lesen beide Ordner - es gibt von hier aus also
     * keinen ehrlichen Weg zu raten, und falsch geraten schreibt eine jar in
     * einen Ordner, den nichts liest.
     */
    'kind_helper' => 'Ein Mod kommt nach mods/ und ist für Fabric, Forge oder NeoForge. Ein Plugin kommt nach plugins/ und ist für Bukkit, Spigot oder Paper. Das entscheidet auch, welche Hälfte von Modrinth durchsucht wird.',
    'kind_mod' => 'Ein Mod (mods/)',
    'kind_plugin' => 'Ein Plugin (plugins/)',

    'search' => 'Suche',
    'search_helper' => 'Tippe einen Namen und klicke aus dem Feld heraus. Die Treffer stehen nach Downloads sortiert.',

    'project' => 'Mod oder Plugin',
    'version' => 'Version',
    'version_helper' => 'Jede Zeile nennt die Versionsnummer, die Minecraft-Versionen, für die sie gebaut ist, und die unterstützten Loader. Wähle eine, die zu deinem Server passt - das prüft hier nichts für dich.',

    'install' => 'Installieren',
    'install_confirm' => 'Die Datei wird von der Node direkt bei Modrinth geholt und in den Ordner gelegt. Nichts, was schon da ist, wird entfernt.',
    'installed' => 'Installiert',
    'installed_helper' => 'Es lädt beim nächsten Start des Servers.',

    'change' => 'Version wechseln',
    'change_helper' => 'Ersetzt diese Datei durch eine andere Version desselben Projekts. Die neue wird heruntergeladen, bevor die alte gelöscht wird - ein fehlgeschlagener Download lässt dich also mit dem zurück, was du schon hattest.',
    'change_project_helper' => 'Steht fest für alles, was über diese Seite installiert wurde. Es zu ändern wäre kein Versionswechsel, sondern ein anderes Mod unter demselben Dateinamen.',
    'change_lookup_helper' => 'Diese Datei lag bereits im Ordner, hier weiß also nichts, was sie ist. Suche sie einmal, dann wird es gemerkt.',
    'changed' => 'Version gewechselt',

    'check' => 'Nach Aktualisierungen suchen',
    'checked' => 'Geprüft',
    'checked_none' => 'Alles Bekannte ist auf seiner neuesten Version.',
    'checked_some' => 'Für :count gibt es eine neuere Version. Sie sind in der Liste markiert.',
    'update_ready' => 'v:number verfügbar',

    /*
     * Neben dem Abzeichen gesagt statt im Tooltip, denn es ändert, was das
     * Abzeichen bedeutet: hier weiß nichts, welche Minecraft-Version und welchen
     * Loader der Server fährt.
     */
    'check_note' => 'Neuer heißt neuer auf Modrinth. Hier weiß nichts, welche Minecraft-Version oder welchen Loader dein Server fährt - prüfe also vor dem Start, ob die gewählte Version dazu passt.',
    'unknown' => 'Nicht von hier - nutze „Version wechseln", um zu sagen, was es ist',

    'remove' => 'Entfernen',
    'remove_confirm' => 'Die Datei wird vom Server gelöscht. Von hier aus lässt sich das nicht rückgängig machen.',
    'removed' => 'Entfernt',

    'running' => 'Der Server läuft',
    'running_helper' => 'Minecraft liest mods/ und plugins/ genau einmal, beim Start. Eine jetzt hinzugefügte Datei lädt erst nach einem Neustart, und eine, die man einem laufenden Spiel unter den Füßen wegzieht, kann das Spiel mitnehmen. Stoppe den Server zuerst.',

    'failed' => 'Das hat nicht geklappt',
    'failed_version' => 'Zu dieser Version gibt es keine jar, die sich hier installieren lässt. Manche Releases enthalten nur Quelltext oder nur einen Client-Build.',
    'failed_write' => 'Die Node hat den Download abgelehnt. Womöglich hat sie Modrinth nicht erreicht.',

    'installed_title' => 'Installiert',
    'installed_mods' => 'In mods/',
    'installed_plugins' => 'In plugins/',

    /*
     * Gesagt, weil eine leere Liste mehrdeutig ist: meist heißt sie, dass dieser
     * Server diesen Ordner gar nicht nutzt, und nicht, dass etwas fehlt.
     */
    'installed_empty' => 'Hier ist nichts. Ein Server nutzt nur einen dieser beiden Ordner - dass einer leer ist, ist normal.',
    'installed_note' => 'Aufgeführt sind nur .jar-Dateien. Konfigurationsordner und deaktivierte Dateien bleiben unberührt und werden nicht gezeigt.',
];
