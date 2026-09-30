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
    'save' => 'Αποθήκευση',
    'saved' => 'Αποθηκεύτηκε',
    'restart' => 'Το παιχνίδι διαβάζει αυτό το αρχείο στην εκκίνηση, οπότε επανεκκινήστε τον διακομιστή για να ισχύσει η αλλαγή.',
    'failed' => 'Δεν αποθηκεύτηκε',
    'failed_write' => 'Ο δαίμονας αρνήθηκε την εγγραφή. Ελέγξτε ότι ο διακομιστής είναι προσβάσιμος και ότι το αρχείο δεν είναι μόνο για ανάγνωση.',
    'read_only' => 'Μπορείτε να διαβάσετε αυτό το αρχείο αλλά όχι να το γράψετε, οπότε τίποτα εδώ δεν αλλάζει.',
    'missing' => 'Αυτός ο διακομιστής δεν έχει ακόμη αρχείο ρυθμίσεων. Το παιχνίδι το γράφει στην πρώτη εκτέλεση, οπότε ξεκινήστε τον μία φορά και η σελίδα θα γεμίσει.',
    'keeps' => 'Ό,τι άλλο υπάρχει στο αρχείο - τα σχόλια, οι κενές γραμμές, η σειρά και κάθε κλειδί που δεν γνωρίζει αυτό το πρόσθετο - μένει ακριβώς όπως ήταν.',
    'raw' => 'Τα ονόματα εδώ είναι του παιχνιδιού, με τη σειρά του αρχείου. Τίποτα δεν μεταφράζεται ούτε ομαδοποιείται, γιατί η σελίδα διαβάζει το αρχείο αντί για μια χειρόγραφη λίστα.',
    'unset' => 'Δεν έχει οριστεί. Το παιχνίδι το αναφέρει ως παράδειγμα, και η συμπλήρωση το προσθέτει.',
    'group_all' => 'Ρυθμίσεις',
    'group_all_helper' => 'Όλα όσα αναφέρει αυτό το αρχείο.',
    'subheading' => 'Φτιαγμένο από :files και όχι από μια χειρόγραφη λίστα.',
];
