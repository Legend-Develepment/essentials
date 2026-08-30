<?php

/*
 * The dashboard block: the machine the panel is on, and every node.
 *
 * The node figures are Pelican's own, read from the daemon on each node. The
 * panel row is read from /proc, which is a different question - see
 * Support\SystemStatus.
 */

return [
    // The block's heading is the plugin's own name, read at runtime, so there
    // is no string for it here.
    'panel' => 'This panel',
    'offline' => 'not answering',
    'maintenance' => 'maintenance',
    'cpu' => 'CPU',
    'memory' => 'Memory',
    'disk' => 'Disk',
    'load' => 'Load',
];
