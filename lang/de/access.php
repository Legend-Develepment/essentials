<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Subuser", "Rolle", "SFTP" und "Wings" bleiben stehen: so heißen sie auf den
 * Pelican-Seiten, auf die diese hier verweist.
 */

return [
    'nav_label' => 'Serverzugriff',
    'title' => 'Server nach Rolle',
    'subheading' => 'Allen mit einer Rolle Zugriff auf dieselben Server geben.',

    'more' => 'Wie das funktioniert',
    'warning' => 'Das funktioniert, indem Pelicans eigene Subuser aktuell gehalten werden — dieselben Einträge, die du von Hand auf der Seite „Users" eines Servers anlegen würdest, und genau die lesen Serverliste, Rechteprüfungen und Wings. Es fasst nur Einträge an, die es selbst angelegt hat: was du von Hand hinzugefügt hast, wird nie geändert und nie entfernt. Es geht keine E-Mail hinaus, wenn eine Rolle jemandem einen Server gibt. Zugriff zu entziehen widerruft auch deren SFTP, und dafür braucht es den Queue-Worker, den Pelican ohnehin verlangt.',

    'never' => 'Es wurde noch nichts abgeglichen. Speichere unten eine Zuordnung, dann geschieht es sofort — und danach jede Minute über den Cron des Panels.',
    'timing' => 'Zugriff wird in dem Moment entzogen, in dem er entzogen gehört: Wer eine Rolle verliert, verliert die Server auf der nächsten Seite, die er öffnet. Das Gewähren kann bis zu einer Minute dauern — das ist der Durchlauf für alle, die das Panel gerade nicht offen haben.',
    'last_run' => 'Letzter Durchlauf vor :ago Sekunden: :added hinzugefügt, :removed entfernt, :held unverändert.',
    'capped' => 'Zu viel auf einmal — :pairs Zuweisungen, und die Grenze liegt bei :max. Es wurde nichts geschrieben. Grenze eine Zuordnung ein: Eine Rolle mit fünfzig Leuten und zwanzig Servern sind allein schon tausend Zuweisungen.',

    'which' => 'Die Zuordnungen',
    'which_helper' => 'Eine Rolle, die Server, die alle mit dieser Rolle erreichen sollen, und was sie dort dürfen. Wer zwei Rollen hat, bekommt alles, was beide zusammen gewähren. Servereigentümer und Root-Admins werden übersprungen — die haben ohnehin mehr, als das hier geben könnte.',
    'add' => 'Rolle hinzufügen',

    'role' => 'Rolle',
    'role_helper' => 'Alle, die sie haben — auch wer sie später bekommt.',
    'servers' => 'Server',
    'servers_helper' => 'Die Server, die sie bekommen. Einen hier zu entfernen nimmt diesen Zugriff wieder weg.',

    'permissions' => 'Was sie dürfen',
    'permissions_helper' => 'Pelicans eigene Subuser-Rechte. Lass sie so, wie sie sind, für einen vernünftigen Satz: Konsole, Ein- und Ausschalten, Dateien, Backups und das Aktivitätsprotokoll — und nichts, was den Server, seine Benutzer, seine Datenbanken oder seine Allocations ändert. „Connect to websocket" ist immer dabei, denn ohne das verbindet sich die Konsolenseite mit nichts.',

    'save' => 'Speichern und anwenden',
    'saved' => 'Gespeichert',
    'saved_body' => ':added gewährt, :removed zurückgenommen.',
    'save_failed' => 'Konnte nicht gespeichert werden',
    'save_failed_disk' => 'Die Liste konnte nicht in den Speicher geschrieben werden. Prüfe, ob storage/app dem Benutzer gehört, unter dem das Panel läuft.',

    'revoke' => 'Alles zurücknehmen',
    'revoke_confirm' => 'Alles entfernen, was hierüber gewährt wurde?',
    'revoke_confirm_helper' => 'Jeder Subuser-Eintrag, den diese Seite angelegt hat, auf jedem Server, für jeden — und deren SFTP dazu. Von Hand angelegte Einträge bleiben unberührt. Die Zuordnungen unten bleiben bestehen, das nächste Speichern oder der nächste Durchlauf würde sie also erneut gewähren: leere die Liste zuerst, wenn du es endgültig meinst.',
    'revoked' => ':count entfernt',
    'revoked_body' => 'Nur Einträge, die diese Seite selbst angelegt hatte. Was von Hand hinzugefügt wurde, steht, wo es stand.',
    'revoke_failed' => 'Sie konnten nicht entfernt werden',
];
