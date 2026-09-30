<?php

/*
 * Italiano. Scritto a mano.
 *
 * Il watchdog.
 *
 * Ogni messaggio qui viene letto su un telefono, alle tre di notte, da qualcuno
 * che un minuto prima dormiva. Ognuno dice quale macchina, cosa non va, e
 * nient'altro - il dettaglio appartiene alla pagina che aprirà dopo, non alla
 * riga che lo ha svegliato.
 *
 * Il ritorno alla normalità è scritto come notizia e non come postilla. «È già
 * tornato?» è la domanda per cui qualcuno altrimenti si alzerebbe.
 *
 * «Node», «Wings», «daemon», «webhook», «queue», «Discord» e «SMTP» restano in
 * inglese: è con quei nomi che si ritrovano in Pelican, sull'host e in tutto
 * ciò che si scrive su di loro.
 */

return [
    'title' => 'Avvisi',
    'nav_label' => 'Avvisi',
    'subheading' => 'Il pannello sa già quando un nodo smette di rispondere, quando un disco si riempie o quando la coda si ferma. Questo è ciò che te lo dice.',

    // ---- i canali, e cosa hanno fatto l'ultima volta ----------------------
    'channels' => 'Dove vanno i messaggi',
    'channels_helper' => 'Cosa ha fatto ogni canale l\'ultima volta che gli è stato chiesto di mandare qualcosa. Un canale acceso che rifiuta in silenzio sembra identico a un pannello a cui non manca nulla, ed è per questo che questa è la prima cosa della pagina.',

    'state_off' => 'Spento',
    'state_untried' => 'Non è ancora stato mandato nulla',
    'state_ok' => 'Consegnato',
    'state_failed' => 'Rifiutato',

    // ---- quando -----------------------------------------------------------
    'when' => 'Ogni quanto',
    'when_helper' => 'I controlli girano in secondo piano, quindi richiedono un queue worker. Senza di esso non viene mandato nulla e nulla lo dice - usa «Manda una prova», che non passa dalla coda.',

    'every' => 'Controlla ogni',
    'every_helper' => 'Ogni controllo raggiunge il daemon di ciascun nodo, quindi è una richiesta per nodo e per passata. Quindici minuti bastano per sapere di un guasto mentre è ancora un guasto.',
    'every_off' => 'Spento - nessun controllo',
    'every_five' => '5 minuti',
    'every_fifteen' => '15 minuti',
    'every_thirty' => '30 minuti',
    'every_hourly' => 'Ora',
    'every_daily' => 'Giorno',

    'repeat' => 'Ricordamelo finché dura',
    'repeat_helper' => 'Un messaggio parte quando qualcosa cambia, e un altro quando si riprende. Questo aggiunge un promemoria finché un problema è ancora in corso. Zero vuol dire nessun promemoria - un canale che si ripete ogni quindici minuti è un canale che la gente silenzia.',
    'hours' => 'ore',

    // ---- dove -------------------------------------------------------------
    'where' => 'Canali',
    'where_helper' => 'Più di uno è sensato. Si guastano in modi diversi.',

    'discord' => 'Discord',
    'discord_helper' => 'Dove un messaggio viene letto davvero da qualcuno che non sta guardando il pannello.',
    'webhook' => 'Indirizzo del webhook',
    'webhook_helper' => 'In Discord: Impostazioni del server → Integrazioni → Webhook → Nuovo webhook → Copia URL webhook. Limitato a https, perché questo pubblica quale delle tue macchine è caduta e quanto è pieno il suo disco.',
    'bot' => 'Un bot tuo',
    'bot_helper' => 'Un unico invio JSON firmato a un indirizzo che gestisci tu, così qualcosa fuori dal pannello viene a sapere di un nodo caduto invece di chiedere ogni minuto se ce ne sia uno. I webhook che Pelican porta con sé non possono farlo: partono sui modelli e sul registro delle attività, e un nodo che ha smesso di rispondere non scrive né l\'uno né l\'altro.',
    'bot_url' => 'Dove inviarlo',
    'bot_url_helper' => 'Limitato a https, perché questo pubblica quale delle tue macchine è caduta a un indirizzo su internet.',
    'bot_secret' => 'Segreto per la firma',
    'bot_secret_helper' => 'Condiviso con ciò che riceve questi invii. Il corpo viene sottoposto a hash con esso e l\'hash viaggia in X-Essentials-Signature come sha256=<hex>, così il tuo bot può rifiutare qualunque cosa non venga da questo pannello. Finché è vuoto non viene mandato nulla - una firma facoltativa è una firma che nessuno controlla.',
    'facts' => 'Dire al bot anche quando succede qualcosa',
    'facts_helper' => 'Tutto quanto sopra è un guasto. Questo no: sono cose che sono semplicemente accadute. Ognuna è spenta finché non la spunti, quindi aggiornare non cambia nulla, e vanno solo al bot, mai a Discord, alla campanella o alla posta.',

    'panel' => 'Nel pannello',
    'panel_helper' => 'Una notifica per tutti quelli che hanno questo permesso. Funziona sempre, non richiede nessuna configurazione, ed è invisibile a chi non ha effettuato l\'accesso.',

    'email' => 'Email',
    'email_helper' => 'Separate da virgola. Usa il mailer del pannello stesso - affidabile quando è configurato e completamente muto quando non lo è, che è l\'unico guasto che un watchdog non può avere. Lascia vuoto per spegnerlo.',

    // ---- cosa -------------------------------------------------------------
    'what' => 'Cosa viene sorvegliato',
    'what_helper' => 'Ogni lettura qui è una che il pannello fa già. Nulla su questa pagina apre una connessione che la pagina Stato del sistema non apra.',

    'percent_helper' => 'Zero spegne questo controllo.',
    'disk' => 'Avvisa quando il disco di un nodo supera',
    'memory' => 'Avvisa quando la memoria di un nodo supera',

    'maintenance' => 'Avvisa di una manutenzione lasciata attiva da più di',
    'maintenance_helper' => 'Un nodo in manutenzione viene saltato da ogni altro controllo, e va bene così - ed è anche il modo in cui uno resta dimenticato per due settimane. Zero spegne questo.',

    'versions' => 'Versioni del pannello e di Wings',
    'versions_helper' => 'Un messaggio quando qualcosa resta indietro, e uno quando torna aggiornato. Nessun promemoria - una versione non è un guasto.',

    'backups' => 'Backup che restano indietro',
    'backups_helper' => 'Un solo messaggio che nomina i server invece di uno per server - quando un\'operazione pianificata si ferma, tutti i server scadono insieme, e quaranta messaggi separati per una sola causa sono un canale che la gente silenzia. Spento di default: a un pannello che fa i backup a mano invece che a orario verrebbe rinfacciato ogni giorno.',
    'backup_days' => 'Un backup conta come scaduto dopo',
    'backup_days_helper' => 'È anche ciò che usa la pagina Backup. Un server con backup settimanale non dovrebbe essere segnalato a otto giorni.',
    'days' => 'giorni',

    'stock' => 'Pacchetti che si stanno esaurendo',

    'unbuilt_switch_helper' => 'Un ordine con la fattura saldata il cui server un nodo ha rifiutato. L\'unico controllo qui in cui qualcuno ci rimette dei soldi e niente lo dice: tutto il resto in questo elenco è una macchina che si è fermata. Spento finché non lo accendi, come gli altri.',

    'unbuilt_switch' => 'Pagato e non creato',
    'stock_helper' => 'Un solo messaggio che nomina i pacchetti invece di uno per pacchetto, e mai un promemoria: essere esauriti è uno stato normale di un negozio e non un guasto, e sentirselo dire ogni quattro ore è il modo in cui questo smette di essere letto. Vengono guardati solo i pacchetti con un tetto, quindi un negozio che vende tutto senza limite non costa nulla da sorvegliare. Spento di default, come il resto.',
    'modules_switch' => 'Un modulo acceso che non funziona',
    'modules_switch_helper' => 'Un messaggio per modulo invece di uno solo per tutti, perché quello che non va è diverso da modulo a modulo e la frase deve dirlo. Segnala due cose: un modulo a cui mancano le tabelle, cioè un\'installazione che non è riuscita a finire, e un modulo con parti accese che aspettano che venga riempito qualcosa. La pagina Moduli le mostra entrambe sulla scheda; questo è per i pannelli dove nessuno va a guardare. Spento di default, come il resto.',
    'module_tables_title' => 'Il modulo «:module» è acceso e le sue tabelle mancano',
    'module_tables' => 'Le pagine di «:module» si nascondono perché le tabelle che leggono non ci sono, di solito un\'installazione che non è riuscita a finire. Apri la pagina Moduli, spegnilo e riaccendilo, e le tabelle vengono create.',
    'module_waiting_title' => 'Il modulo «:module» è acceso e una sua parte sta aspettando',
    'module_waiting' => '{1} Una parte di «:module» è accesa e non mostra niente finché non viene riempito qualcosa - gli eggs a cui si applica, gli stili offerti, i server che una pagina pubblica deve mostrare. La pagina Moduli dice quale, sulla scheda.|[2,*] :count parti di «:module» sono accese e non mostrano niente finché non viene riempito qualcosa - gli eggs a cui si applicano, gli stili offerti, i server che una pagina pubblica deve mostrare. La pagina Moduli dice quali, sulla scheda.',
    'module_cleared' => 'Il modulo «:module» funziona di nuovo',
    'ports_switch' => 'Porte che stanno finendo',
    'ports_switch_helper' => 'Un messaggio per pacchetto invece di uno solo per tutti, perché quello che serve è l\'intervallo e il numero, non un elenco di nomi. Vengono guardati solo i pacchetti su cui è impostato un intervallo, quindi un negozio che lascia prendere agli acquisti qualsiasi porta libera non costa nulla da sorvegliare. Spento di default, come il resto.',
    'stock_left' => 'Avvisa quando ne restano così pochi',
    'stock_left_helper' => 'Contati sul tetto fissato per il pacchetto. Un pacchetto deve scendere a questo numero per essere segnalato e risalirne due sopra per essere dichiarato di nuovo a posto, così uno che un acquisto e una disdetta spingono avanti e indietro non dice niente. Qui lo zero è un numero e non un’assenza: tiene zitto l’avviso e lascia solo il messaggio che dice che un pacchetto è finito.',
    'stock_left_suffix' => 'rimasti',

    'worker' => 'Queue worker',
    'worker_helper' => 'Se c\'è qualcosa che esegue il lavoro di fondo di questo plugin. Nota la circolarità: il controllo stesso gira sulla coda, quindi un pannello che non ha mai avuto un worker non può segnalarlo. La riga in cima a questa pagina sì.',

    // ---- i pulsanti -------------------------------------------------------
    'save' => 'Salva',
    'saved' => 'Salvato',
    'save_failed' => 'Non è stato salvato nulla',

    'test' => 'Manda una prova',
    'test_one' => 'Prova',
    'test_off' => 'Quel canale è spento',
    'test_off_body' => 'Accendilo e salva, e verrà provato insieme agli altri.',
    'test_title' => 'Messaggio di prova',
    'test_body' => 'Se stai leggendo questo, gli avvisi del tuo pannello Pelican arriveranno qui. Non c\'è nulla che non vada.',
    'test_sent' => 'Mandato a ogni canale acceso',
    'test_failed' => 'Almeno un canale lo ha rifiutato',
    'test_none' => 'Non c\'è dove mandarlo',
    'test_none_body' => 'Nessun canale è acceso, quindi anche un avviso vero non andrebbe da nessuna parte.',

    /*
     * Cosa fare di un rifiuto.
     *
     * Il motivo che dà un fornitore è breve e corretto, e da solo inutile. I due
     * che escono quasi ogni volta sono nominati, perché nessuno dei due si
     * indovina dal codice: un 553 riguarda il mittente e non il destinatario, e
     * un 401 da Discord è un URL revocato o copiato male.
     */
    'hint_email_sender' => 'Il tuo server SMTP ha rifiutato l\'indirizzo da cui il pannello manda, non l\'indirizzo a cui stava mandando. In Admin → Impostazioni → Posta, l\'indirizzo mittente deve essere una casella da cui il tuo account SMTP ha il permesso di mandare. Non ha nulla a che fare con questo plugin - la mail di prova di Pelican stesso su quella pagina fallirà allo stesso modo.',
    'hint_email' => 'Guarda in Admin → Impostazioni → Posta. Il pulsante della mail di prova su quella pagina usa le stesse impostazioni e dirà la stessa cosa.',
    'hint_discord_url' => 'Discord non ha riconosciuto quel webhook. È stato cancellato, rigenerato, o incollato a metà - creane uno nuovo sotto Impostazioni del server → Integrazioni → Webhook e copia l\'URL intero.',
    'hint_discord' => 'Il pannello non è riuscito a raggiungere Discord. Se questo pannello sta dietro un firewall che blocca le richieste in uscita, questo canale da qui non può funzionare.',
    'hint_panel' => 'Nessuno ha il permesso per questo, oppure la notifica non è stata salvata. Guarda sotto Ruoli.',

    'run_now' => 'Esegui i controlli adesso',
    'run_started' => 'Controllo in secondo piano',
    'run_failed' => 'Non è stato possibile avviare i controlli',

    'reset' => 'Dimentica ciò che sa',
    'reset_confirm' => 'Cancella ciò che ogni controllo ha detto l\'ultima volta. La passata successiva impara da zero e non manda nulla, quindi un problema ancora in corso verrà segnalato alla passata dopo. Usa questo dopo aver dismesso un nodo su cui il watchdog continua a insistere.',
    'reset_done' => 'Cancellato',

    // ---- i messaggi veri e propri -----------------------------------------
    'still' => 'Dura da :for.',
    'cleared_body' => 'Era così da :for.',
    'ports_title' => 'Stanno finendo le porte per :game',
    'ports_body' => 'Gli acquisti di :game finiscono da :from a :to, e solo :free su :total sono ancora libere. Un acquisto che non ne trova nessuna viene pagato e poi rifiutato, quindi aggiungi allocation sul nodo, oppure allarga l\'intervallo sul pacchetto, prima che succeda.',
    'ports_none_title' => 'Non ci sono più porte per :game',
    'ports_none' => 'Gli acquisti di :game finiscono da :from a :to e tutte le :total sono occupate. Il prossimo acquisto di questo gioco verrà pagato e poi rifiutato, senza allocation. Aggiungi allocation sul nodo, oppure allarga l\'intervallo sul pacchetto stesso.',
    'ports_empty_title' => 'Non esiste nessuna porta per :game',
    'ports_empty' => 'Gli acquisti di :game finiscono da :from a :to, e non c\'è una sola allocation in quell\'intervallo su nessuno dei nodi che può usare. Ogni acquisto di questo gioco verrà pagato e poi rifiutato. Crea le allocation sul nodo, oppure allarga l\'intervallo sul pacchetto stesso.',
    'ports_cleared' => 'Ci sono di nuovo porte libere per :game',

    'for_unknown' => 'un po\'',
    'for_minutes' => '{1} un minuto|[2,*] :count minuti',
    'for_hours' => '{1} un\'ora|[2,*] :count ore',
    'for_days' => '{1} un giorno|[2,*] :count giorni',

    'node_down' => ':node non risponde',
    'node_down_body' => 'Il pannello non raggiunge il daemon su :node. I server che ci stanno sopra non partiranno, non si fermeranno e non segnaleranno nulla finché non torna.',
    'node_up' => ':node risponde di nuovo',

    'node_disk' => 'Sta finendo il disco su :node',
    'node_disk_body' => 'Il disco su :node è pieno al :percent %, sopra il :limit % che hai fissato. I backup e le installazioni dei server sono le prime cose a saltare quando questo arriva in cima.',
    'node_disk_over' => 'Il disco su :node è tornato sotto il limite',

    'node_memory' => 'Sta finendo la memoria su :node',
    'node_memory_body' => 'La memoria su :node è usata al :percent %, sopra il :limit % che hai fissato. I server che ci stanno sopra possono essere uccisi dal kernel prima che qualcosa segnali un problema.',
    'node_memory_over' => 'La memoria su :node è tornata sotto il limite',

    'node_maintenance' => ':node è in manutenzione da molto tempo',
    'node_maintenance_body' => ':node è in manutenzione da più di :hours ore. Intanto non viene controllato nient\'altro su di lui, che è proprio il punto - ma vale la pena sapere che è ancora così.',
    'node_maintenance_over' => ':node è uscito dalla manutenzione',

    'wings_behind' => 'Wings su :node non è aggiornato',
    'wings_behind_body' => ':node fa girare Wings :installed ed è uscito :latest. Aggiornalo sul nodo stesso - il pannello non ha modo di farlo.',
    'wings_current' => 'Wings su :node è aggiornato',

    'panel_behind' => 'Il pannello non è aggiornato',
    'panel_behind_body' => 'Questo pannello fa girare :installed ed è uscito :latest.',
    'panel_current' => 'Il pannello è aggiornato',

    'and_more' => 'e altri :count',


    'owner_down' => '{1} Uno dei tuoi server è offline|[2,*] :count dei tuoi server sono offline',
    'owner_down_body' => 'La macchina su cui stanno ha smesso di rispondere. Qualcuno è già stato avvisato. Coinvolti: :servers',
    'owner_up' => '{1} Il tuo server è tornato|[2,*] :count dei tuoi server sono tornati',
    'owner_up_body' => 'La macchina risponde di nuovo. Tornati: :servers',

    'schedules' => 'Operazioni pianificate che si sono fermate',
    'schedules_helper' => 'Un\'operazione bloccata a metà esecuzione, una la cui ora è passata perché il cron non gira, o una che non è mai partita. Pelican non ha una parola per nessuna delle tre - un\'esecuzione caduta resta «in elaborazione» per sempre e viene disegnata esattamente come una che sta girando adesso. Legge tutte le operazioni pianificate attive del pannello a ogni controllo.',

    'schedule_stopped' => '{1} Un\'attività pianificata si è fermata|[2,*] :count attività pianificate si sono fermate',
    'schedule_stopped_body' => 'Bloccate da oltre :hours ore, scadute, mai eseguite, o senza alcuna attività: :schedules',
    'schedule_running' => 'Tutte le operazioni pianificate sono tornate a girare',

    'unbuilt_over' => 'Ogni ordine pagato ha il suo server',

    'unbuilt_body' => 'Qualcuno ha pagato e non ha niente. Apri Ordini e creali, o leggi perché sono stati rifiutati: :orders',

    'unbuilt' => '{1} Un ordine pagato senza server|[2,*] :count ordini pagati senza server',

    'stock_out' => '{1} Un pacchetto è esaurito|[2,*] :count pacchetti sono esauriti',
    'stock_out_body' => 'Ancora in vendita, e non c’è più niente da vendere: :packages',
    'stock_low' => '{1} Un pacchetto è quasi esaurito|[2,*] :count pacchetti sono quasi esauriti',
    'stock_low_body' => 'Ne restano :limit o meno: :packages',
    'stock_back' => '{1} Un pacchetto è di nuovo in vendita|[2,*] :count pacchetti sono di nuovo in vendita',
    'stock_back_body' => 'C’è di nuovo qualcosa da vendere: :packages',

    'backup_none' => '{1} Un server non è mai stato salvato|[2,*] :count server non sono mai stati salvati',
    'backup_none_body' => 'Non è mai stato fatto un backup su: :servers',
    'backup_none_over' => 'Tutti i server hanno adesso un backup',

    'backup_stale' => '{1} Un server non viene salvato da un po\'|[2,*] :count server non vengono salvati da un po\'',
    'backup_stale_body' => 'Nessun backup riuscito in :days giorni su: :servers',
    'backup_stale_over' => 'Tutti i server hanno avuto un backup di recente',

    'backup_failed' => '{1} I salvataggi non riescono su un server|[2,*] I salvataggi non riescono su :count server',
    'backup_failed_body' => 'Un backup è finito senza successo su: :servers',
    'backup_failed_over' => 'Non fallisce più nessun backup',

    'worker_missing' => 'Non c\'è nulla che lavori la coda',
    'worker_missing_body' => 'Un lavoro è stato messo in coda e nulla lo ha preso. Gli aggiornamenti dei plugin, le installazioni di modpack e questi controlli si fermano tutti finché non gira un worker - prova systemctl status pelican-queue sulla macchina del pannello.',
    'worker_back' => 'La coda viene lavorata di nuovo',
    'failed_title' => '{1} Un processo non è riuscito dall\'ultimo controllo|[2,*] :count processi non sono riusciti dall\'ultimo controllo',
    'failed_body' => 'Qualcosa che il pannello doveva fare non è successo e non verrà più ritentato - un server non creato, una fattura non scritta, una mail non inviata. Stanno nella tabella failed_jobs; `php artisan queue:retry all` li rimette in coda, una volta risolto quello che li ha bloccati.',
    'failed_back' => 'Dall\'ultimo controllo non è fallito niente',
    'failed' => 'Avvisami quando un lavoro in coda fallisce',
    'failed_helper' => 'Laravel annota un lavoro su cui ha rinunciato e non ne dice niente. Questo lo dice. Contati invece che elencati: venti fallimenti in una notte di solito hanno una causa sola.',

    'health_interval_off' => 'Gli avvisi sono attivi, ma l\'intervallo è su Disattivato, quindi il watchdog non gira mai.',
    'health_owners_unwatched' => 'Gli avvisi ai proprietari sono attivi, ma il watchdog non gira, quindi i proprietari non vengono mai avvisati di un\'interruzione.',
    'health_no_channel' => 'Il watchdog gira, ma ogni modo di avvisare qualcuno è disattivato.',
    'health_discord' => 'Gli avvisi Discord sono attivi, ma non è salvato nessun webhook https valido.',
    'health_bot' => 'Gli avvisi del bot sono attivi, ma manca l\'indirizzo https o il segreto di firma.',
    'health_email' => 'Le email di avviso sono attive, ma non c\'è nessun indirizzo valido, oppure la posta del pannello scrive solo nel suo log.',
];
