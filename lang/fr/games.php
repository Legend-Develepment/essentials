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
    'save' => 'Enregistrer',
    'saved' => 'Enregistré',
    'restart' => 'Le jeu lit ce fichier au démarrage, redémarrez donc le serveur pour que le changement prenne effet.',
    'failed' => 'Enregistrement impossible',
    'failed_write' => 'Le daemon a refusé l écriture. Vérifiez que le serveur est joignable et que le fichier n est pas en lecture seule.',
    'read_only' => 'Vous pouvez lire ce fichier mais pas l écrire, rien ne peut donc être modifié ici.',
    'missing' => 'Ce serveur n a pas encore de fichier de configuration. Le jeu l écrit au premier démarrage : lancez le serveur une fois et cette page se remplira.',
    'keeps' => 'Tout le reste du fichier - les commentaires, les lignes vides, l ordre et chaque clé que ce plugin ne connaît pas - reste exactement tel quel après enregistrement.',
    'raw' => 'Les noms ici sont ceux du jeu, dans l ordre du fichier. Rien n est traduit et rien n est groupé, car cette page lit le fichier plutôt qu une liste écrite à la main : elle montre donc chaque réglage que le jeu comprend.',
    'unset' => 'Non défini. Le jeu le mentionne en exemple ; le remplir l ajoute.',
    'group_all' => 'Réglages',
    'group_all_helper' => 'Tout ce que ce fichier mentionne.',
    'subheading' => 'Construit à partir de :files plutôt que d une liste écrite à la main.',
];
