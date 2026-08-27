<?php

/*
 * The controls bar on a server page. Its own file rather than a corner of
 * settings.php, because these are read by people using the panel rather than by
 * whoever is configuring the theme.
 *
 * The state beside the buttons is Pelican's own word for it, taken from the
 * ContainerStatus enum, so the bar and the console page never disagree about
 * what a server is doing.
 */

return [
    'console' => 'Console',

    'start' => 'Start',
    'restart' => 'Restart',
    'stop' => 'Stop',
    'kill' => 'Kill',

    'kill_confirm' => 'Killing stops the container where it stands. Anything the server has not written to disk yet is lost. Continue?',

    'sent_title' => 'Power action',
    'sent_body' => ':action was sent to :name.',
    'failed' => 'The node could not be reached.',
];
