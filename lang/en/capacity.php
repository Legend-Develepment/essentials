<?php

return [
    'nav_label' => 'Capacity',
    'title' => 'Whether another server fits',
    'subheading' => 'What has been promised on each node, against what it may hand out.',

    'how' => 'Promised, not used. A node can be twenty percent busy and completely full, because full is about what has been handed out rather than about what is running - the Machines block on the dashboard is the other question, and it stays where it is. The arithmetic here is Pelican\'s own, from the method that decides whether a server may be created at all: capacity times one plus the overallocation, against the sum of what every server on the node was promised. A capacity of zero means unlimited and so does an overallocation below zero, which is why some rows have no percentage rather than a full bar or an empty one.',

    'column_node' => 'Machine',
    'column_fullest' => 'Fullest',
    'column_memory' => 'Memory',
    'column_disk' => 'Disk',
    'column_cpu' => 'Processor',
    'column_at_limit' => 'At a limit',

    'servers' => ':count servers',

    'filter_tight' => 'Nearly full',

    'open' => 'Open the machine',

    'empty' => 'No machines you can reach.',
];
