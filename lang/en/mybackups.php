<?php

return [
    /*
     * Two sentences that join into one line, because they are two different
     * problems: a server with no backup at all is usually one nobody set one up
     * for, and one whose last is nine days old is a schedule that has stopped.
     */
    'none' => ':count of your servers have never been backed up.',
    'stale' => ':count have not been backed up in over :days days.',

    /*
     * The third thing this line can say, added once it stopped being only about
     * backups. Written as a count rather than as a list of schedule names: the
     * names below are servers, and mixing two kinds of thing into one row is
     * how a warning becomes something to decode.
     */
    'schedules' => ':count of your scheduled tasks have stopped.',

    'and_more' => 'and :count more',

    'open' => 'Open a server and go to Backups to make one.',
];
