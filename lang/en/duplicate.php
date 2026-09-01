<?php

return [
    'title' => 'Duplicate a server',
    'nav_label' => 'Duplicate server',
    'subheading' => 'Another server set up exactly like one you already have, or several at once.',

    'section' => 'What to copy',
    'section_helper' => 'The owner, the egg, the startup command, the limits and every variable are copied. Files, databases, backups and schedules are not — a copy of a running server\'s files is a copy of its state, which is rarely what "another one like this" means.',

    'source' => 'Copy from',
    'source_helper' => 'The copies land on the same node as this server, because that is where its free addresses are.',

    'name' => 'Name the copy',
    'name_helper' => 'Making more than one numbers them: “Bot 1”, “Bot 2”, and so on.',

    'copies' => 'How many',
    'copies_helper' => 'Choose a server first.',
    'room' => ':count free addresses on :node, so that is the most that can be made right now.',
    'no_room' => 'There is no free address left on :node. A copy needs one of its own, so add an allocation to that node first.',

    /*
     * Counted rather than listed for the successes and listed for the failures,
     * which is the way round that helps: ten names that worked is a wall of text
     * nobody reads, and one that did not is the only thing worth reading.
     */
    'made' => ':count copies made',
    'partly_failed' => ':count copies could not be made',
    'failed' => 'Nothing was copied',
];
