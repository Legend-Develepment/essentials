<?php

/*
 * The System status page: the host the panel itself runs on.
 *
 * Not the same machine as the nodes on any install where they are separate,
 * which is why both exist.
 */

return [
    'title' => 'System status',
    'nav_label' => 'System status',
    'subheading' => 'The machine the panel itself runs on. On an install where the nodes are separate, this is not the machine your servers are on — those are on the dashboard.',

    'options' => 'Options',
    'enabled' => 'Show in the sidebar',
    'enabled_helper' => 'Off takes the row out of the sidebar. The page keeps its own address, so it is always there to switch back on.',

    'refresh' => 'Read again every',
    'refresh_helper' => 'The whole page is asked for again on this interval. Off leaves it as it was when you opened it.',
    'refresh_off' => 'Only when I open it',
    'refresh_seconds' => ':seconds seconds',

    'blocks' => 'Show',
    'blocks_helper' => 'Nothing ticked shows all of them.',
    'block_cpu' => 'Processor',
    'block_memory' => 'Memory',
    'block_disk' => 'Disk',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'System',

    'swap' => 'Swap',
    'load_windows' => ':five over 5 min · :fifteen over 15 min',
    'unavailable' => 'Not available on this host',

    'fact_os' => 'Operating system',
    'fact_hostname' => 'Hostname',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processors',
    'fact_processes' => 'Processes',
];
