<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Subuser», «Wings», «SFTP», «cron» og «queue worker» blir stående på engelsk:
 * det er under de navnene man finner dem i Pelican og på verten, og det er
 * nøyaktig det man trenger å vite når en av disse linjene dukker opp.
 */

return [
    'nav_label' => 'Servertilgang',
    'title' => 'Servere etter rolle',
    'subheading' => 'Gi alle med en rolle tilgang til de samme serverne.',

    /*
     * Sagt før alt annet på siden, for dette er den eneste funksjonen som
     * skriver i en tabell Pelican eier.
     */
    'more' => 'Slik virker det',
    'warning' => 'Det virker ved å holde Pelicans egne subusers oppdatert - de samme radene du selv ville lagt inn for hånd på en servers Brukere-side, og de radene serverlisten, hver rettighetssjekk og Wings allerede leser. Bare rader den selv har laget, blir rørt: det du har lagt inn for hånd, blir aldri endret eller fjernet. Ingen får en e-post når en rolle gir dem en server. Å ta tilgangen bort tilbakekaller også SFTP-en deres, og det krever den queue workeren Pelican allerede ber om.',

    'never' => 'Ingenting er avstemt ennå. Lagre en kobling nedenfor, så skjer det med det samme, og deretter hvert minutt via panelets egen cron.',
    'timing' => 'Tilgangen tas bort i det øyeblikket den skal: den som mister en rolle, mister serverne på aller neste side. Å gi tilgang kan ta opptil et minutt, for det er den runden som leter etter dem som ikke bruker panelet akkurat nå.',
    'last_run' => 'Siste runde for :ago sekunder siden: :added lagt til, :removed fjernet, :held latt stå.',
    'capped' => 'For mye på én gang - :pairs tildelinger, og grensen er :max. Ingenting ble skrevet. Snevre inn en kobling: en rolle med femti folk og tjue servere er tusen tildelinger helt alene.',

    'which' => 'Koblingene',
    'which_helper' => 'En rolle, de serverne alle med den skal kunne nå, og hva de får gjøre der. Er man i to roller, får man alt begge gir. Servereiere og root-administratorer hoppes over - de har allerede mer enn dette kunne gitt dem.',
    'add' => 'Legg til en rolle',

    'role' => 'Rolle',
    'role_helper' => 'Alle med den, også de som får den senere.',
    'servers' => 'Servere',
    'servers_helper' => 'De serverne de får. Å fjerne en herfra tar den tilgangen bort igjen.',

    'permissions' => 'Hva de får gjøre',
    'permissions_helper' => 'Pelicans egne subuser-rettigheter. La dem stå som de er for et fornuftig sett: konsollen, strømknappene, filene, sikkerhetskopiene og aktivitetsloggen - og ingenting som endrer serveren, brukerne dens, databasene dens eller tildelingene dens. «Connect to websocket» er alltid med, for uten den kobler konsollsiden seg til ingenting.',

    'save' => 'Lagre og bruk',
    'saved' => 'Lagret',
    'saved_body' => ':added gitt, :removed tatt tilbake.',
    'save_failed' => 'Kunne ikke lagre',
    'save_failed_disk' => 'Listen kunne ikke skrives til storage. Sjekk at storage/app tilhører den brukeren panelet kjører som.',

    'revoke' => 'Ta alt tilbake',
    'revoke_confirm' => 'Fjern alt dette har gitt?',
    'revoke_confirm_helper' => 'Hver eneste subuser-rad denne siden har laget, på hver server, for alle - og SFTP-en deres med. Rader du har lagt inn for hånd, blir ikke rørt. Koblingene nedenfor blir stående, så neste lagring eller neste runde ville gitt dem igjen: tøm listen først hvis du mener det for alvor.',
    'revoked' => ':count fjernet',
    'revoked_body' => 'Bare rader denne siden selv hadde laget. Det som er lagt inn for hånd, står der det sto.',
    'revoke_failed' => 'Kunne ikke fjerne dem',
];
