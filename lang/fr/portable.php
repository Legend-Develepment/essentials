<?php

/*
 * Français. Écrit à la main.
 *
 * Les réglages sous forme de fichier : à l’extérieur, puis de retour.
 *
 * Les fichiers envoyés n’y sont volontairement pas - voir Support\Portable pour
 * la raison qui fait qu’il vaut mieux le dire que les omettre en silence.
 */

return [
    'export' => 'Exporter les réglages',
    'records' => 'Exporter les enregistrements',
    'records_helper' => 'Tous les forfaits, commandes, factures, paiements et tickets en un fichier. Retirer ce plugin supprime tout cela et Pelican ne demande rien avant, c\'est donc la copie à faire d\'avance. Les clés d\'API en sont exclues : une clé ne se restaure pas depuis un fichier, elle se réémet.',
    'import' => 'Importer des réglages',
    'apply' => 'Importer',

    'file' => 'Fichier de réglages',
    'file_helper' => 'Un fichier exporté depuis ce plugin. Les images et les packs d’icônes n’y sont pas - ce sont des fichiers sur un disque, et ils restent tels quels.',

    'summary' => 'Ce que cela changerait',
    'summary_none' => 'Choisissez un fichier pour voir ce qu’il changerait.',
    'summary_unreadable' => 'Ce n’est pas un fichier de réglages de ce plugin, ou il ne contient rien que ce panel reconnaisse.',
    'summary_same' => 'Rien. Chaque réglage de ce fichier correspond déjà à ce panel.',
    'summary_count' => '{1} Un réglage changerait.|[2,*] :count réglages changeraient.',
    'summary_more' => '· et :count de plus',

    'imported' => 'Réglages importés',
    'missing' => 'Ces images ne sont pas sur ce panel et sont laissées de côté : :files',
    'failed' => 'Impossible d’importer ce fichier',
    'no_file' => 'Aucun fichier n’est arrivé. Un envoi qui attend trop longtemps avant qu’on appuie sur Importer est effacé par le panel - choisissez à nouveau le fichier et importez-le dans la foulée.',
    'denied' => 'Vous n’avez pas la permission de modifier ces réglages.',
];
