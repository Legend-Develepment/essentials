<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * O watchdog.
 *
 * Cada mensagem daqui é lida num telemóvel, às três da manhã, por alguém que há
 * um minuto estava a dormir. Cada uma diz que máquina, o que está mal, e nada
 * mais - o pormenor pertence à página que a pessoa abre a seguir, e não à linha
 * que a acordou.
 *
 * O regresso ao normal é escrito como notícia e não como acrescento. «Já
 * voltou?» é a pergunta por que alguém se levantaria se não fosse dito.
 *
 * «Node», «Wings», «daemon», «webhook», «queue», «Discord» e «SMTP» ficam em
 * inglês: é com esses nomes que se encontram no Pelican, no anfitrião e em tudo
 * o que se escreve sobre eles.
 */

return [
    'title' => 'Alertas',
    'nav_label' => 'Alertas',
    'subheading' => 'O painel já sabe quando um nó deixa de responder, quando um disco enche ou quando a fila pára. Isto é o que lho diz.',

    // ---- os canais, e o que fizeram da última vez -------------------------
    'channels' => 'Para onde vão as mensagens',
    'channels_helper' => 'O que cada canal fez da última vez que lhe pediram para enviar alguma coisa. Um canal ligado que recusa em silêncio parece exatamente um painel a que não falta nada, e é por isso que isto é a primeira coisa da página.',

    'state_off' => 'Desligado',
    'state_untried' => 'Ainda não foi enviado nada',
    'state_ok' => 'Entregue',
    'state_failed' => 'Recusado',

    // ---- quando -----------------------------------------------------------
    'when' => 'Com que frequência',
    'when_helper' => 'As verificações correm em segundo plano, por isso precisam de um queue worker. Sem ele não é enviado nada e nada o diz - use «Enviar um teste», que não passa pela fila.',

    'every' => 'Verificar a cada',
    'every_helper' => 'Cada verificação chega ao daemon de cada nó, por isso é um pedido por nó e por passagem. Quinze minutos chegam para saber de uma avaria enquanto ela ainda é uma avaria.',
    'every_off' => 'Desligado - nenhuma verificação',
    'every_five' => '5 minutos',
    'every_fifteen' => '15 minutos',
    'every_thirty' => '30 minutos',
    'every_hourly' => 'Hora',
    'every_daily' => 'Dia',

    'repeat' => 'Lembrar-me enquanto durar',
    'repeat_helper' => 'É enviada uma mensagem quando algo muda, e outra quando recupera. Isto acrescenta um lembrete enquanto um problema ainda dura. Zero quer dizer sem lembretes - um canal que se repete a cada quinze minutos é um canal que as pessoas silenciam.',
    'hours' => 'horas',

    // ---- onde -------------------------------------------------------------
    'where' => 'Canais',
    'where_helper' => 'Mais do que um é sensato. Falham de maneiras diferentes.',

    'discord' => 'Discord',
    'discord_helper' => 'Onde uma mensagem é mesmo lida por alguém que não está a olhar para o painel.',
    'webhook' => 'Endereço do webhook',
    'webhook_helper' => 'No Discord: Definições do servidor → Integrações → Webhooks → Novo webhook → Copiar URL do webhook. Limitado a https, porque isto publica qual das suas máquinas caiu e quão cheio está o disco dela.',
    'bot' => 'Um bot seu',
    'bot_helper' => 'Um envio JSON assinado para um endereço que é seu, para que algo fora do painel fique a saber de um node que caiu em vez de perguntar a cada minuto se há algum. Os webhooks que o Pelican traz não conseguem levar isto: disparam sobre modelos e sobre o registo de atividade, e um node que deixou de responder não escreve nem uma coisa nem outra.',
    'bot_url' => 'Para onde enviar',
    'bot_url_helper' => 'Limitado a https, porque isto envia qual das suas máquinas caiu para um endereço na internet.',
    'bot_secret' => 'Segredo de assinatura',
    'bot_secret_helper' => 'Partilhado com aquilo que recebe isto. O corpo é passado por hash com ele e o hash viaja em X-Essentials-Signature como sha256=<hex>, para que o seu bot possa recusar tudo o que não tenha vindo deste painel. Enquanto isto estiver vazio não é enviado nada - uma assinatura que é opcional é uma que ninguém verifica.',
    'facts' => 'Avisar o bot também quando algo acontece',
    'facts_helper' => 'Tudo acima é uma falha. Isto não: são coisas que simplesmente aconteceram. Cada uma está desligada até a marcares, por isso atualizar não muda nada, e vão apenas para o bot, nunca para o Discord, o sino ou o email.',

    'panel' => 'No painel',
    'panel_helper' => 'Uma notificação para todos os que tiverem esta permissão. Funciona sempre, não precisa de configuração, e é invisível para quem não tiver sessão iniciada.',

    'email' => 'E-mail',
    'email_helper' => 'Separados por vírgulas. Usa o mailer do próprio painel - fiável quando está configurado e completamente silencioso quando não está, que é a única falha que um watchdog não pode ter. Deixe vazio para o desligar.',

    // ---- o quê ------------------------------------------------------------
    'what' => 'O que é vigiado',
    'what_helper' => 'Cada leitura daqui é uma que o painel já faz. Nada nesta página abre uma ligação que a página Estado do sistema não abra.',

    'percent_helper' => 'Zero desliga esta verificação.',
    'disk' => 'Avisar quando o disco de um nó passar de',
    'memory' => 'Avisar quando a memória de um nó passar de',

    'maintenance' => 'Avisar de manutenção deixada ligada há mais de',
    'maintenance_helper' => 'Um nó em manutenção é saltado por todas as outras verificações, e isso está certo - e é também a maneira de um ficar esquecido durante quinze dias. Zero desliga isto.',

    'versions' => 'Versões do painel e do Wings',
    'versions_helper' => 'Uma mensagem quando algo fica para trás, e outra quando volta a estar atualizado. Sem lembretes - uma versão não é uma avaria.',

    'backups' => 'Cópias de segurança a ficar para trás',
    'backups_helper' => 'Uma só mensagem a nomear os servidores em vez de uma por servidor - quando uma tarefa agendada pára, todos os servidores ficam desatualizados ao mesmo tempo, e quarenta mensagens separadas por uma causa só são um canal que as pessoas silenciam. Desligado por omissão: a um painel que copia à mão em vez de por agenda isto seria apontado todos os dias.',
    'backup_days' => 'Uma cópia conta como desatualizada ao fim de',
    'backup_days_helper' => 'É também o que a página de Cópias de segurança usa. Um servidor copiado uma vez por semana não devia ser reportado aos oito dias.',
    'days' => 'dias',

    'stock' => 'Pacotes a esgotar',

    'unbuilt_switch_helper' => 'Uma encomenda com a fatura paga cujo servidor um nó recusou. A única verificação aqui em que alguém fica sem o dinheiro e nada o diz: todo o resto desta lista é uma máquina que parou. Desligado até o ligar, como os outros.',

    'unbuilt_switch' => 'Pago e não criado',
    'stock_helper' => 'Uma só mensagem a nomear os pacotes em vez de uma por pacote, e nunca um lembrete: estar esgotado é um estado normal de uma loja e não uma avaria, e ouvi-lo de quatro em quatro horas é como isto deixa de ser lido. Só são verificados os pacotes que têm stock definido, por isso uma loja que vende tudo sem limite não custa nada a vigiar. Desligado por omissão, como o resto.',
    'modules_switch' => 'Um módulo ligado que não funciona',
    'modules_switch_helper' => 'Uma mensagem por módulo em vez de uma só para todos, porque o que está mal é diferente em cada um e a frase tem de o dizer. Reporta duas coisas: um módulo a que faltam as tabelas, que é uma instalação que não conseguiu terminar, e um módulo com partes ligadas à espera que se preencha alguma coisa. A página dos Módulos mostra as duas no cartão; isto é para os painéis onde ninguém vai ver. Desligado por omissão, como o resto.',
    'module_tables_title' => 'O módulo «:module» está ligado e faltam-lhe as tabelas',
    'module_tables' => 'As páginas de «:module» escondem-se porque as tabelas que leem não existem, o que costuma ser uma instalação que não conseguiu terminar. Abra a página dos Módulos, desligue-o e volte a ligá-lo, e as tabelas são criadas.',
    'module_waiting_title' => 'O módulo «:module» está ligado e uma parte dele está à espera',
    'module_waiting' => '{1} Uma parte de «:module» está ligada e não mostra nada até se preencher alguma coisa - os eggs a que se aplica, os estilos oferecidos, os servidores que uma página pública deve mostrar. A página dos Módulos diz qual, no cartão.|[2,*] :count partes de «:module» estão ligadas e não mostram nada até se preencher alguma coisa - os eggs a que se aplicam, os estilos oferecidos, os servidores que uma página pública deve mostrar. A página dos Módulos diz quais, no cartão.',
    'module_cleared' => 'O módulo «:module» voltou a funcionar',
    'ports_switch' => 'Portas a esgotar',
    'ports_switch_helper' => 'Uma mensagem por pacote em vez de uma só para todos, porque o que serve é o intervalo e a contagem, não uma lista de nomes. Só são verificados os pacotes que têm um intervalo definido, por isso uma loja que deixa as compras ficar com qualquer porta livre não custa nada a vigiar. Desligado por omissão, como o resto.',
    'stock_left' => 'Avisar quando restarem',
    'stock_left_helper' => 'Contado contra o stock definido no pacote. Um pacote tem de descer a este número para ser avisado, e subir dois acima dele para deixar de o ser, por isso um que uma compra e um cancelamento empurram de um lado para o outro não diz nada. Aqui o zero é um número e não uma ausência: mantém o aviso calado e deixa só a mensagem que diz que um pacote se esgotou.',
    'stock_left_suffix' => 'ou menos',

    'worker' => 'Queue worker',
    'worker_helper' => 'Se há alguma coisa a executar o trabalho de fundo deste plugin. Repare na circularidade: a própria verificação corre na fila, por isso um painel que nunca teve um worker não a consegue reportar. A linha no topo desta página consegue.',

    // ---- os botões --------------------------------------------------------
    'save' => 'Guardar',
    'saved' => 'Guardado',
    'save_failed' => 'Não foi guardado nada',

    'test' => 'Enviar um teste',
    'test_one' => 'Testar',
    'test_off' => 'Esse canal está desligado',
    'test_off_body' => 'Ligue-o e guarde, e será testado com os restantes.',
    'test_title' => 'Mensagem de teste',
    'test_body' => 'Se está a ler isto, os alertas do seu painel Pelican chegam aqui. Não se passa nada.',
    'test_sent' => 'Enviado para todos os canais ligados',
    'test_failed' => 'Pelo menos um canal recusou',
    'test_none' => 'Não há para onde enviar',
    'test_none_body' => 'Nenhum canal está ligado, por isso um alerta a sério também não iria a lado nenhum.',

    /*
     * O que fazer com uma recusa.
     *
     * O motivo que um fornecedor dá é curto e correto, e inútil por si só. Os
     * dois que aparecem quase sempre estão nomeados, porque nenhum se adivinha
     * a partir do código: um 553 é sobre o remetente e não sobre o
     * destinatário, e um 401 do Discord é um URL revogado ou mal copiado.
     */
    'hint_email_sender' => 'O seu servidor SMTP recusou o endereço a partir do qual o painel envia, e não o endereço para onde estava a enviar. Em Admin → Definições → Correio, o endereço de remetente tem de ser uma caixa de onde a sua conta SMTP tem autorização para enviar. Nada tem a ver com este plugin - o correio de teste do próprio Pelican nessa página falha da mesma maneira.',
    'hint_email' => 'Veja em Admin → Definições → Correio. O botão de correio de teste dessa página usa as mesmas definições e diz o mesmo.',
    'hint_discord_url' => 'O Discord não reconheceu esse webhook. Foi apagado, regenerado, ou colado a meio - crie um novo em Definições do servidor → Integrações → Webhooks e copie o URL inteiro.',
    'hint_discord' => 'O painel não conseguiu chegar ao Discord. Se este painel estiver atrás de uma firewall que bloqueia pedidos de saída, este canal não pode funcionar daqui.',
    'hint_panel' => 'Ninguém tem a permissão para isto, ou a notificação não pôde ser guardada. Veja em Funções.',

    'run_now' => 'Executar as verificações agora',
    'run_started' => 'A verificar em segundo plano',
    'run_failed' => 'Não foi possível iniciar as verificações',

    'reset' => 'Esquecer o que sabe',
    'reset_confirm' => 'Limpa o que cada verificação disse da última vez. A passagem seguinte aprende do zero e não envia nada, por isso um problema que ainda dure será reportado na passagem a seguir. Use isto depois de desativar um nó sobre o qual o watchdog continua a insistir.',
    'reset_done' => 'Limpo',

    // ---- as próprias mensagens --------------------------------------------
    'still' => 'Dura há :for.',
    'cleared_body' => 'Esteve assim durante :for.',
    'ports_title' => 'Estão quase a acabar as portas para :game',
    'ports_body' => 'As compras de :game ficam entre :from e :to, e só :free de :total continuam livres. Uma compra que não encontre nenhuma é paga e depois recusada, por isso acrescente allocations no nó, ou alargue o intervalo no pacote, antes que isso aconteça.',
    'ports_none_title' => 'Não restam portas para :game',
    'ports_none' => 'As compras de :game ficam entre :from e :to e as :total estão todas ocupadas. A próxima compra deste jogo é paga e depois recusada, sem allocation nenhuma. Acrescente allocations no nó, ou alargue o intervalo no próprio pacote.',
    'ports_empty_title' => 'Não existe nenhuma porta para :game',
    'ports_empty' => 'As compras de :game ficam entre :from e :to, e não existe uma única allocation nesse intervalo em nenhum dos nós que pode usar. Todas as compras deste jogo são pagas e depois recusadas. Crie as allocations no nó, ou alargue o intervalo no próprio pacote.',
    'ports_cleared' => 'Voltou a haver portas livres para :game',

    'for_unknown' => 'algum tempo',
    'for_minutes' => '{1} um minuto|[2,*] :count minutos',
    'for_hours' => '{1} uma hora|[2,*] :count horas',
    'for_days' => '{1} um dia|[2,*] :count dias',

    'node_down' => ':node não responde',
    'node_down_body' => 'O painel não chega ao daemon de :node. Os servidores que lá estão não arrancam, não param e não reportam nada até ele voltar.',
    'node_up' => ':node volta a responder',

    'node_disk' => 'Está a acabar o disco em :node',
    'node_disk_body' => 'O disco de :node está :percent % cheio, acima dos :limit % que definiu. As cópias de segurança e as instalações de servidores são as primeiras coisas a falhar quando isto chega ao topo.',
    'node_disk_over' => 'O disco de :node voltou a ficar abaixo do limite',

    'node_memory' => 'Está a acabar a memória em :node',
    'node_memory_body' => 'A memória de :node está :percent % usada, acima dos :limit % que definiu. Os servidores que lá estão podem ser mortos pelo kernel antes de alguma coisa reportar um problema.',
    'node_memory_over' => 'A memória de :node voltou a ficar abaixo do limite',

    'node_maintenance' => ':node está em manutenção há muito tempo',
    'node_maintenance_body' => ':node está em manutenção há mais de :hours horas. Entretanto não é verificado mais nada nele, que é o objetivo - mas vale a pena saber que continua assim.',
    'node_maintenance_over' => ':node saiu de manutenção',

    'wings_behind' => 'O Wings em :node está desatualizado',
    'wings_behind_body' => ':node corre o Wings :installed e já saiu o :latest. Atualize-o no próprio nó - o painel não tem maneira de o fazer.',
    'wings_current' => 'O Wings em :node está atualizado',

    'panel_behind' => 'O painel está desatualizado',
    'panel_behind_body' => 'Este painel corre o :installed e já saiu o :latest.',
    'panel_current' => 'O painel está atualizado',

    'and_more' => 'e mais :count',


    'owner_down' => '{1} Um dos seus servidores está offline|[2,*] :count dos seus servidores estão offline',
    'owner_down_body' => 'A máquina onde estão deixou de responder. Já foi avisado alguém. Afetados: :servers',
    'owner_up' => '{1} O seu servidor voltou|[2,*] :count dos seus servidores voltaram',
    'owner_up_body' => 'A máquina voltou a responder. De volta: :servers',

    'schedules' => 'Tarefas agendadas que pararam',
    'schedules_helper' => 'Uma tarefa presa a meio de uma execução, uma cuja hora passou porque o cron não está a correr, ou uma que nunca correu. O Pelican não tem palavra para nenhuma das três - uma execução que caiu fica «em processamento» para sempre e é desenhada exatamente como uma que está a correr agora. Lê todas as tarefas agendadas ativas do painel em cada verificação.',

    'schedule_stopped' => '{1} Uma tarefa agendada parou|[2,*] :count tarefas agendadas pararam',
    'schedule_stopped_body' => 'Presas há mais de :hours horas, atrasadas, nunca executadas, ou sem qualquer tarefa: :schedules',
    'schedule_running' => 'Todas as tarefas agendadas voltaram a correr',

    'unbuilt_over' => 'Todas as encomendas pagas têm o seu servidor',

    'unbuilt_body' => 'Alguém pagou e não tem nada. Abra Encomendas e crie-as, ou veja porque foram recusadas: :orders',

    'unbuilt' => '{1} Uma encomenda paga sem servidor|[2,*] :count encomendas pagas sem servidor',

    'stock_out' => '{1} Um pacote esgotou-se|[2,*] :count pacotes esgotaram-se',
    'stock_out_body' => 'Ainda à venda, e já não há nada para vender: :packages',
    'stock_low' => '{1} Um pacote está quase esgotado|[2,*] :count pacotes estão quase esgotados',
    'stock_low_body' => 'Restam :limit ou menos: :packages',
    'stock_back' => '{1} Um pacote voltou à venda|[2,*] :count pacotes voltaram à venda',
    'stock_back_body' => 'Há outra vez alguma coisa para vender: :packages',

    'backup_none' => '{1} Um servidor nunca foi copiado|[2,*] :count servidores nunca foram copiados',
    'backup_none_body' => 'Nunca foi copiado nada em: :servers',
    'backup_none_over' => 'Todos os servidores já têm uma cópia',

    'backup_stale' => '{1} Um servidor não é copiado há algum tempo|[2,*] :count servidores não são copiados há algum tempo',
    'backup_stale_body' => 'Sem nenhuma cópia bem-sucedida em :days dias em: :servers',
    'backup_stale_over' => 'Todos os servidores foram copiados há pouco',

    'backup_failed' => '{1} As cópias falham num servidor|[2,*] As cópias falham em :count servidores',
    'backup_failed_body' => 'Uma cópia terminou sem sucesso em: :servers',
    'backup_failed_over' => 'Já não falha nenhuma cópia',

    'worker_missing' => 'Não há nada a processar a fila',
    'worker_missing_body' => 'Foi posto um trabalho na fila e nada o levantou. As atualizações de plugins, as instalações de modpacks e estas verificações param todas até haver um worker a correr - experimente systemctl status pelican-queue na máquina do painel.',
    'worker_back' => 'A fila voltou a ser processada',
    'failed_title' => '{1} Uma tarefa falhou desde a última verificação|[2,*] :count tarefas falharam desde a última verificação',
    'failed_body' => 'Alguma coisa que o painel tinha para fazer não aconteceu e não volta a ser tentada - um servidor que não foi criado, uma fatura que não foi escrita, um email que não foi enviado. Estão na tabela failed_jobs; `php artisan queue:retry all` volta a pô-los na fila, assim que estiver resolvido o que os travou.',
    'failed_back' => 'Nada falhou desde a última verificação',
    'failed' => 'Avisar quando um trabalho na fila falha',
    'failed_helper' => 'O Laravel regista um trabalho que desistiu de fazer e não diz nada sobre isso. Isto diz. Contados em vez de listados: vinte falhas numa noite têm quase sempre uma só causa.',

    'health_interval_off' => 'Os alertas estão ligados, mas o intervalo está em Desligado, por isso o vigilante nunca corre.',
    'health_owners_unwatched' => 'Os alertas aos proprietários estão ligados, mas o vigilante não está a correr, por isso os proprietários nunca sabem de uma falha.',
    'health_no_channel' => 'O vigilante corre, mas todas as formas de avisar alguém estão desligadas.',
    'health_discord' => 'Os alertas do Discord estão ligados, mas não está guardado nenhum webhook https válido.',
    'health_bot' => 'Os alertas do bot estão ligados, mas falta o endereço https ou o segredo de assinatura.',
    'health_email' => 'Os e-mails de alerta estão ligados, mas não há nenhum endereço válido, ou o correio do painel só escreve no seu registo.',
];
