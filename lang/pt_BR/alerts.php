<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * O watchdog.
 *
 * Cada mensagem daqui é lida em um celular, às três da manhã, por alguém que um
 * minuto atrás estava dormindo. Cada uma diz qual máquina, o que está errado, e
 * nada além disso - o detalhe pertence à página que a pessoa vai abrir em
 * seguida, e não à linha que a acordou.
 *
 * A volta ao normal é escrita como notícia e não como observação. «Já voltou?»
 * é a pergunta pela qual alguém se levantaria se não fosse dito.
 *
 * «Node», «Wings», «daemon», «webhook», «queue», «Discord» e «SMTP» ficam em
 * inglês: é com esses nomes que se acham no Pelican, no host e em tudo o que se
 * escreve sobre eles.
 */

return [
    'title' => 'Alertas',
    'nav_label' => 'Alertas',
    'subheading' => 'O painel já sabe quando um nó para de responder, quando um disco enche ou quando a fila para. Isto é o que conta para você.',

    // ---- os canais, e o que fizeram da última vez -------------------------
    'channels' => 'Para onde vão as mensagens',
    'channels_helper' => 'O que cada canal fez da última vez que pediram para ele mandar alguma coisa. Um canal ligado que recusa em silêncio parece exatamente um painel em que não tem nada errado, e é por isso que isto é a primeira coisa da página.',

    'state_off' => 'Desligado',
    'state_untried' => 'Nada foi enviado ainda',
    'state_ok' => 'Entregue',
    'state_failed' => 'Recusado',

    // ---- quando -----------------------------------------------------------
    'when' => 'Com que frequência',
    'when_helper' => 'As checagens rodam em segundo plano, então precisam de um queue worker. Sem ele nada é enviado e nada avisa - use «Enviar um teste», que não passa pela fila.',

    'every' => 'Checar a cada',
    'every_helper' => 'Cada checagem alcança o daemon de cada nó, então é uma requisição por nó e por passada. Quinze minutos bastam para saber de uma queda enquanto ela ainda é uma queda.',
    'every_off' => 'Desligado - nenhuma checagem',
    'every_five' => '5 minutos',
    'every_fifteen' => '15 minutos',
    'every_thirty' => '30 minutos',
    'every_hourly' => 'Hora',
    'every_daily' => 'Dia',

    'repeat' => 'Me lembrar enquanto durar',
    'repeat_helper' => 'Uma mensagem sai quando algo muda, e outra quando se recupera. Isto acrescenta um lembrete enquanto um problema ainda está rolando. Zero quer dizer sem lembretes - um canal que se repete a cada quinze minutos é um canal que as pessoas silenciam.',
    'hours' => 'horas',

    // ---- onde -------------------------------------------------------------
    'where' => 'Canais',
    'where_helper' => 'Mais de um é sensato. Eles falham de jeitos diferentes.',

    'discord' => 'Discord',
    'discord_helper' => 'Onde uma mensagem é lida de verdade por alguém que não está olhando o painel.',
    'webhook' => 'Endereço do webhook',
    'webhook_helper' => 'No Discord: Configurações do servidor → Integrações → Webhooks → Novo webhook → Copiar URL do webhook. Limitado a https, porque isto publica qual das suas máquinas caiu e o quanto o disco dela está cheio.',
    'bot' => 'Um bot seu',
    'bot_helper' => 'Um envio JSON assinado para um endereço que você mantém, para que algo de fora do painel fique sabendo de um nó caído em vez de perguntar a cada minuto se há um. Os webhooks que o Pelican traz não dão conta disso: eles disparam em modelos e no registro de atividade, e um nó que parou de responder não escreve em nenhum dos dois.',
    'bot_url' => 'Para onde enviar',
    'bot_url_helper' => 'Limitado a https, porque isto envia para um endereço na internet qual das suas máquinas caiu.',
    'bot_secret' => 'Segredo de assinatura',
    'bot_secret_helper' => 'Compartilhado com o que recebe isto. O corpo é passado por hash com ele e o hash viaja em X-Essentials-Signature como sha256=<hex>, então o seu bot pode recusar qualquer coisa que não tenha vindo deste painel. Nada é enviado enquanto isto estiver vazio - uma assinatura opcional é uma assinatura que ninguém confere.',
    'facts' => 'Avisar o bot também quando algo acontece',
    'facts_helper' => 'Tudo acima é uma falha. Isto não: são coisas que simplesmente aconteceram. Cada uma fica desligada até você marcar, por isso atualizar não muda nada, e vão apenas para o bot, nunca para o Discord, o sino ou o email.',

    'panel' => 'No painel',
    'panel_helper' => 'Uma notificação para todos que tiverem esta permissão. Funciona sempre, não precisa de configuração, e é invisível para quem não estiver logado.',

    'email' => 'E-mail',
    'email_helper' => 'Separados por vírgula. Usa o mailer do próprio painel - confiável quando ele está configurado e totalmente silencioso quando não está, que é a única falha que um watchdog não pode ter. Deixe vazio para desligar.',

    // ---- o quê ------------------------------------------------------------
    'what' => 'O que é vigiado',
    'what_helper' => 'Cada leitura daqui é uma que o painel já faz. Nada nesta página abre uma conexão que a página Status do sistema não abra.',

    'percent_helper' => 'Zero desliga esta checagem.',
    'disk' => 'Avisar quando o disco de um nó passar de',
    'memory' => 'Avisar quando a memória de um nó passar de',

    'maintenance' => 'Avisar de manutenção deixada ligada por mais de',
    'maintenance_helper' => 'Um nó em manutenção é pulado por todas as outras checagens, e isso está certo - e é também o jeito de um ficar esquecido por quinze dias. Zero desliga isto.',

    'versions' => 'Versões do painel e do Wings',
    'versions_helper' => 'Uma mensagem quando algo fica para trás, e outra quando volta a ficar em dia. Sem lembretes - uma versão não é uma queda.',

    'backups' => 'Backups ficando para trás',
    'backups_helper' => 'Uma única mensagem nomeando os servidores em vez de uma por servidor - quando uma tarefa agendada para, todos os servidores vencem de uma vez, e quarenta mensagens separadas por uma causa só são um canal que as pessoas silenciam. Desligado por padrão: um painel que faz backup na mão em vez de por agenda ouviria isso todo dia.',
    'backup_days' => 'Um backup conta como vencido depois de',
    'backup_days_helper' => 'É também o que a página de Backups usa. Um servidor com backup semanal não deveria ser apontado com oito dias.',
    'days' => 'dias',

    'stock' => 'Pacotes acabando',

    'unbuilt_switch_helper' => 'Um pedido com a fatura paga cujo servidor um nó recusou. A única verificação aqui em que alguém fica sem o dinheiro e nada diz nada: todo o resto desta lista é uma máquina que parou. Desligado até você ligar, como os outros.',

    'unbuilt_switch' => 'Pago e não criado',
    'stock_helper' => 'Uma única mensagem nomeando os pacotes em vez de uma por pacote, e nunca um lembrete: estar esgotado é um estado comum de uma loja e não uma queda, e ouvir isso a cada quatro horas é como isto deixa de ser lido. Só são olhados os pacotes que têm um teto, então uma loja que vende tudo sem limite não custa nada para vigiar. Desligado por padrão, como o resto.',
    'modules_switch' => 'Um módulo ligado que não funciona',
    'modules_switch_helper' => 'Uma mensagem por módulo em vez de uma só para todos, porque o que está errado é diferente em cada um e a frase precisa dizer o quê. Avisa de duas coisas: um módulo a que faltam as tabelas, que é uma instalação que não conseguiu terminar, e um módulo com partes ligadas esperando que alguém preencha alguma coisa. A página de Módulos mostra as duas no cartão; isto é para os painéis onde ninguém vai olhar. Desligado por padrão, como o resto.',
    'module_tables_title' => 'O módulo «:module» está ligado e faltam as tabelas dele',
    'module_tables' => 'As páginas de «:module» se escondem porque as tabelas que elas leem não existem, o que costuma ser uma instalação que não conseguiu terminar. Abra a página de Módulos, desligue e ligue de novo, e as tabelas são criadas.',
    'module_waiting_title' => 'O módulo «:module» está ligado e uma parte dele está esperando',
    'module_waiting' => '{1} Uma parte de «:module» está ligada e não mostra nada até alguém preencher alguma coisa - os eggs a que ela se aplica, os estilos oferecidos, os servidores que uma página pública deve mostrar. A página de Módulos diz qual, no cartão.|[2,*] :count partes de «:module» estão ligadas e não mostram nada até alguém preencher alguma coisa - os eggs a que elas se aplicam, os estilos oferecidos, os servidores que uma página pública deve mostrar. A página de Módulos diz quais, no cartão.',
    'module_cleared' => 'O módulo «:module» voltou a funcionar',
    'ports_switch' => 'Portas acabando',
    'ports_switch_helper' => 'Uma mensagem por pacote em vez de uma só para todos, porque o que serve é o intervalo e a contagem, não uma lista de nomes. Só são olhados os pacotes que têm um intervalo definido, então uma loja que deixa as compras pegarem qualquer porta livre não custa nada para vigiar. Desligado por padrão, como o resto.',
    'stock_left' => 'Avisar quando sobrar esta quantidade',
    'stock_left_helper' => 'Contado em cima do teto do pacote. Um pacote precisa cair até este número para ser apontado e subir dois acima dele para voltar a ser dado como saudável, então um que uma compra e um cancelamento empurram de um lado para o outro não diz nada. Zero aqui é um número e não uma ausência: mantém o aviso calado e deixa só a mensagem que diz que um pacote acabou.',
    'stock_left_suffix' => 'sobrando',

    'worker' => 'Queue worker',
    'worker_helper' => 'Se tem alguma coisa executando o trabalho de fundo deste plugin. Repare na circularidade: a própria checagem roda na fila, então um painel que nunca teve um worker não consegue apontar isso. A linha no topo desta página consegue.',

    // ---- os botões --------------------------------------------------------
    'save' => 'Salvar',
    'saved' => 'Salvo',
    'save_failed' => 'Nada foi salvo',

    'test' => 'Enviar um teste',
    'test_one' => 'Testar',
    'test_off' => 'Esse canal está desligado',
    'test_off_body' => 'Ligue e salve, e ele será testado junto com os outros.',
    'test_title' => 'Mensagem de teste',
    'test_body' => 'Se você está lendo isto, os alertas do seu painel Pelican chegam aqui. Não tem nada errado.',
    'test_sent' => 'Enviado para todos os canais ligados',
    'test_failed' => 'Pelo menos um canal recusou',
    'test_none' => 'Não tem para onde enviar',
    'test_none_body' => 'Nenhum canal está ligado, então um alerta de verdade também não iria a lugar nenhum.',

    /*
     * O que fazer com uma recusa.
     *
     * O motivo que um provedor dá é curto e correto, e inútil sozinho. Os dois
     * que aparecem quase toda vez estão nomeados, porque nenhum se adivinha
     * pelo código: um 553 é sobre o remetente e não sobre o destinatário, e um
     * 401 do Discord é uma URL revogada ou copiada errado.
     */
    'hint_email_sender' => 'Seu servidor SMTP recusou o endereço de onde o painel envia, e não o endereço para onde ele estava enviando. Em Admin → Configurações → E-mail, o endereço de remetente precisa ser uma caixa da qual a sua conta SMTP tem permissão para enviar. Não tem nada a ver com este plugin - o e-mail de teste do próprio Pelican naquela página falha do mesmo jeito.',
    'hint_email' => 'Olhe em Admin → Configurações → E-mail. O botão de e-mail de teste daquela página usa as mesmas configurações e vai dizer a mesma coisa.',
    'hint_discord_url' => 'O Discord não reconheceu esse webhook. Ele foi apagado, gerado de novo, ou colado pela metade - crie um novo em Configurações do servidor → Integrações → Webhooks e copie a URL inteira.',
    'hint_discord' => 'O painel não conseguiu alcançar o Discord. Se este painel estiver atrás de um firewall que bloqueia requisições de saída, este canal não tem como funcionar daqui.',
    'hint_panel' => 'Ninguém tem a permissão para isto, ou a notificação não pôde ser guardada. Olhe em Cargos.',

    'run_now' => 'Rodar as checagens agora',
    'run_started' => 'Checando em segundo plano',
    'run_failed' => 'Não foi possível iniciar as checagens',

    'reset' => 'Esquecer o que ele sabe',
    'reset_confirm' => 'Limpa o que cada checagem disse da última vez. A próxima passada aprende do zero e não manda nada, então um problema que ainda esteja rolando será apontado na passada seguinte. Use isto depois de desativar um nó sobre o qual o watchdog continua insistindo.',
    'reset_done' => 'Limpo',

    // ---- as próprias mensagens --------------------------------------------
    'still' => 'Dura há :for.',
    'cleared_body' => 'Ficou assim por :for.',
    'ports_title' => 'Estão quase acabando as portas para :game',
    'ports_body' => 'As compras de :game caem entre :from e :to, e só :free de :total ainda estão livres. Uma compra que não acha nenhuma é paga e depois recusada, então adicione allocations no nó, ou amplie o intervalo no pacote, antes que isso aconteça.',
    'ports_none_title' => 'Não sobrou nenhuma porta para :game',
    'ports_none' => 'As compras de :game caem entre :from e :to e as :total estão todas ocupadas. A próxima compra deste jogo vai ser paga e depois recusada, sem allocation nenhuma. Adicione allocations no nó, ou amplie o intervalo no próprio pacote.',
    'ports_empty_title' => 'Não existe nenhuma porta para :game',
    'ports_empty' => 'As compras de :game caem entre :from e :to, e não existe uma única allocation nesse intervalo em nenhum dos nós que ele pode usar. Toda compra deste jogo vai ser paga e depois recusada. Crie as allocations no nó, ou amplie o intervalo no próprio pacote.',
    'ports_cleared' => 'Voltou a haver portas livres para :game',

    'for_unknown' => 'um tempo',
    'for_minutes' => '{1} um minuto|[2,*] :count minutos',
    'for_hours' => '{1} uma hora|[2,*] :count horas',
    'for_days' => '{1} um dia|[2,*] :count dias',

    'node_down' => ':node não responde',
    'node_down_body' => 'O painel não alcança o daemon de :node. Os servidores que estão nele não vão iniciar, parar nem reportar nada até ele voltar.',
    'node_up' => ':node voltou a responder',

    'node_disk' => 'Está acabando o disco em :node',
    'node_disk_body' => 'O disco de :node está :percent % cheio, acima dos :limit % que você definiu. Os backups e as instalações de servidores são as primeiras coisas a falhar quando isso chega no topo.',
    'node_disk_over' => 'O disco de :node voltou para baixo do limite',

    'node_memory' => 'Está acabando a memória em :node',
    'node_memory_body' => 'A memória de :node está :percent % usada, acima dos :limit % que você definiu. Os servidores que estão nele podem ser mortos pelo kernel antes de qualquer coisa apontar um problema.',
    'node_memory_over' => 'A memória de :node voltou para baixo do limite',

    'node_maintenance' => ':node está em manutenção há muito tempo',
    'node_maintenance_body' => ':node está em manutenção há mais de :hours horas. Enquanto isso nada mais nele é checado, que é justamente a ideia - mas vale saber que ele continua assim.',
    'node_maintenance_over' => ':node saiu da manutenção',

    'wings_behind' => 'O Wings em :node está desatualizado',
    'wings_behind_body' => ':node roda o Wings :installed e já saiu o :latest. Atualize no próprio nó - o painel não tem como fazer isso.',
    'wings_current' => 'O Wings em :node está em dia',

    'panel_behind' => 'O painel está desatualizado',
    'panel_behind_body' => 'Este painel roda o :installed e já saiu o :latest.',
    'panel_current' => 'O painel está em dia',

    'and_more' => 'e mais :count',


    'owner_down' => '{1} Um dos seus servidores está offline|[2,*] :count dos seus servidores estão offline',
    'owner_down_body' => 'A máquina em que eles estão parou de responder. Alguém já foi avisado. Afetados: :servers',
    'owner_up' => '{1} Seu servidor voltou|[2,*] :count dos seus servidores voltaram',
    'owner_up_body' => 'A máquina voltou a responder. De volta: :servers',

    'schedules' => 'Tarefas agendadas que pararam',
    'schedules_helper' => 'Uma tarefa travada no meio de uma execução, uma cujo horário passou porque o cron não está rodando, ou uma que nunca rodou. O Pelican não tem palavra para nenhuma das três - uma execução que caiu fica «processando» para sempre e é desenhada igualzinha a uma que está rodando agora. Lê todas as tarefas agendadas ativas do painel a cada checagem.',

    'schedule_stopped' => '{1} Uma tarefa agendada parou|[2,*] :count tarefas agendadas pararam',
    'schedule_stopped_body' => 'Travadas há mais de :hours horas, atrasadas, nunca executadas, ou sem nenhuma tarefa: :schedules',
    'schedule_running' => 'Todas as tarefas agendadas voltaram a rodar',

    'unbuilt_over' => 'Todos os pedidos pagos têm o seu servidor',

    'unbuilt_body' => 'Alguém pagou e não tem nada. Abra Pedidos e crie-os, ou veja por que foram recusados: :orders',

    'unbuilt' => '{1} Um pedido pago sem servidor|[2,*] :count pedidos pagos sem servidor',

    'stock_out' => '{1} Um pacote esgotou|[2,*] :count pacotes esgotaram',
    'stock_out_body' => 'Ainda à venda, e não tem mais nada para vender: :packages',
    'stock_low' => '{1} Um pacote está quase esgotado|[2,*] :count pacotes estão quase esgotados',
    'stock_low_body' => 'Com :limit ou menos sobrando: :packages',
    'stock_back' => '{1} Um pacote voltou à venda|[2,*] :count pacotes voltaram à venda',
    'stock_back_body' => 'Tem o que vender de novo: :packages',

    'backup_none' => '{1} Um servidor nunca teve backup|[2,*] :count servidores nunca tiveram backup',
    'backup_none_body' => 'Nunca teve backup em: :servers',
    'backup_none_over' => 'Todos os servidores já têm um backup',

    'backup_stale' => '{1} Um servidor não tem backup há algum tempo|[2,*] :count servidores não têm backup há algum tempo',
    'backup_stale_body' => 'Sem nenhum backup bem-sucedido em :days dias em: :servers',
    'backup_stale_over' => 'Todos os servidores receberam backup faz pouco',

    'backup_failed' => '{1} Os backups estão falhando em um servidor|[2,*] Os backups estão falhando em :count servidores',
    'backup_failed_body' => 'Um backup terminou sem sucesso em: :servers',
    'backup_failed_over' => 'Nenhum backup está falhando mais',

    'worker_missing' => 'Não tem nada processando a fila',
    'worker_missing_body' => 'Um trabalho foi enfileirado e nada pegou. As atualizações de plugins, as instalações de modpacks e estas checagens param todas até ter um worker rodando - tente systemctl status pelican-queue na máquina do painel.',
    'worker_back' => 'A fila voltou a ser processada',
    'failed_title' => '{1} Uma tarefa falhou desde a última verificação|[2,*] :count tarefas falharam desde a última verificação',
    'failed_body' => 'Algo que o painel deveria fazer não aconteceu e não vai ser tentado de novo - um servidor que não foi criado, uma fatura que não foi escrita, um e-mail que não foi enviado. Eles estão na tabela failed_jobs; `php artisan queue:retry all` os coloca de volta, assim que o que os travou estiver resolvido.',
    'failed_back' => 'Nada falhou desde a última checagem',
    'failed' => 'Me avise quando um trabalho da fila falhar',
    'failed_helper' => 'O Laravel anota um trabalho que ele desistiu de fazer e não fala nada sobre isso. Isto fala. Contados em vez de listados: vinte falhas numa noite costumam ter uma causa só.',

    'health_interval_off' => 'Os alertas estão ativados, mas o intervalo está em Desativado, então o vigia nunca roda.',
    'health_owners_unwatched' => 'Os alertas aos donos estão ativados, mas o vigia não está rodando, então os donos nunca ficam sabendo de uma queda.',
    'health_no_channel' => 'O vigia roda, mas todas as formas de avisar alguém estão desativadas.',
    'health_discord' => 'Os alertas do Discord estão ativados, mas não há nenhum webhook https válido salvo.',
    'health_bot' => 'Os alertas do bot estão ativados, mas falta o endereço https ou o segredo de assinatura.',
    'health_email' => 'Os e-mails de alerta estão ativados, mas não há endereço válido, ou o envio de e-mails do painel só grava no log.',
];
