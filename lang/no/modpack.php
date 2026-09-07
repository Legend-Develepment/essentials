<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Modpack», «loader», «egg», «daemon», «mods» og «config» blir stående på
 * engelsk: det er de ordene som står på Modrinth, i filbehandleren og i enhver
 * veiledning man finner om det.
 */

return [
    'nav_label' => 'Modpakker',
    'title' => 'Modpakker',
    'subheading' => 'Installer en modpakke fra Modrinth på denne serveren.',

    'section' => 'Finn en pakke',
    'section_helper' => 'Bare Modrinth, og bare pakker for server. Den krever verken konto eller API-nøkkel, og derfor er den den eneste kilden her — de andre vil ha en nøkkel limt inn et sted før noe som helst dukker opp.',

    'search' => 'Søk',
    'search_helper' => 'La feltet stå tomt for de mest nedlastede. Et søk spør Modrinth, så det skjer når du går ut av feltet, og ikke mens du skriver.',

    'pack' => 'Pakke',
    'pack_helper' => 'Bare pakker som sier at de kjører på en server, står på listen.',

    'version' => 'Versjon',
    'version_helper' => 'Spillversjonen og loaderen står ved siden av hver enkelt. Velg den loaderen egget til denne serveren allerede kjører — dette installerer filer og endrer verken egget ditt eller startkommandoen din.',

    'downloads' => 'nedlastinger',

    'install' => 'Installer denne pakken',
    'install_go' => 'Installer den',
    'install_confirm' => 'Pakkens filer legges til denne serveren. **Ingenting blir slettet** — ikke verdenen din, ikke de gamle modsene dine, ikke en config. En pakke installert oppå en annen etterlater begge, så fjern selv modsene fra den forrige pakken først hvis det er det du vil. Serveren må være stoppet, og den blir stoppet.',

    'started' => 'Installerer',
    'started_helper' => 'Pakken hentes og pakkes ut. Et par hundre filer tar noen minutter, og du får et varsel når den er ferdig — det går videre selv om du forlater denne siden.',

    'running' => 'Serveren kjører',
    'running_helper' => 'Minecraft laster modsene sine når det starter, så en pakke installert nå ville etterlatt en server som verken er den gamle eller den nye pakken før den starter på nytt. Stopp den og prøv igjen.',

    'done' => ':pack installert',
    'done_body' => ':files filer hentet og :overrides ting fra pakkens egen mappe lagt på plass. Start serveren når du er klar.',
    'done_refused' => ':count filer ble hoppet over fordi pakken ba om dem fra et sted det ikke lastes ned fra her.',

    'failed' => 'Pakken ble ikke installert',
    'failed_fetch' => 'Pakken kunne ikke hentes eller pakkes ut. Daemonen kan være utilgjengelig, eller serveren kan ha gått tom for disk.',
    'failed_index' => 'Pakken ble hentet, men hadde ingen lesbar indeks i seg, så det var ingenting å installere.',
    'failed_version' => 'Den versjonen har ikke lenger en pakkefil å laste ned. Velg en annen.',
    'failed_queue' => 'Installasjonen kunne ikke settes i kø. Dette krever en queue worker som kjører på panelet.',
];
