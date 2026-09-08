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
    'when_helper' => 'As checagens rodam em segundo plano, então precisam de um queue worker. Sem ele nada é enviado e nada avisa — use «Enviar um teste», que não passa pela fila.',

    'every' => 'Checar a cada',
    'every_helper' => 'Cada checagem alcança o daemon de cada nó, então é uma requisição por nó e por passada. Quinze minutos bastam para saber de uma queda enquanto ela ainda é uma queda.',
    'every_off' => 'Desligado — nenhuma checagem',
    'every_five' => '5 minutos',
    'every_fifteen' => '15 minutos',
    'every_thirty' => '30 minutos',
    'every_hourly' => 'Hora',
    'every_daily' => 'Dia',

    'repeat' => 'Me lembrar enquanto durar',
    'repeat_helper' => 'Uma mensagem sai quando algo muda, e outra quando se recupera. Isto acrescenta um lembrete enquanto um problema ainda está rolando. Zero quer dizer sem lembretes — um canal que se repete a cada quinze minutos é um canal que as pessoas silenciam.',
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
    'bot_secret_helper' => 'Compartilhado com o que recebe isto. O corpo é passado por hash com ele e o hash viaja em X-Essentials-Signature como sha256=<hex>, então o seu bot pode recusar qualquer coisa que não tenha vindo deste painel. Nada é enviado enquanto isto estiver vazio — uma assinatura opcional é uma assinatura que ninguém confere.',

    'panel' => 'No painel',
    'panel_helper' => 'Uma notificação para todos que tiverem esta permissão. Funciona sempre, não precisa de configuração, e é invisível para quem não estiver logado.',

    'email' => 'E-mail',
    'email_helper' => 'Separados por vírgula. Usa o mailer do próprio painel — confiável quando ele está configurado e totalmente silencioso quando não está, que é a única falha que um watchdog não pode ter. Deixe vazio para desligar.',

    // ---- o quê ------------------------------------------------------------
    'what' => 'O que é vigiado',
    'what_helper' => 'Cada leitura daqui é uma que o painel já faz. Nada nesta página abre uma conexão que a página Status do sistema não abra.',

    'percent_helper' => 'Zero desliga esta checagem.',
    'disk' => 'Avisar quando o disco de um nó passar de',
    'memory' => 'Avisar quando a memória de um nó passar de',

    'maintenance' => 'Avisar de manutenção deixada ligada por mais de',
    'maintenance_helper' => 'Um nó em manutenção é pulado por todas as outras checagens, e isso está certo — e é também o jeito de um ficar esquecido por quinze dias. Zero desliga isto.',

    'versions' => 'Versões do painel e do Wings',
    'versions_helper' => 'Uma mensagem quando algo fica para trás, e outra quando volta a ficar em dia. Sem lembretes — uma versão não é uma queda.',

    'backups' => 'Backups ficando para trás',
    'backups_helper' => 'Uma única mensagem nomeando os servidores em vez de uma por servidor — quando uma tarefa agendada para, todos os servidores vencem de uma vez, e quarenta mensagens separadas por uma causa só são um canal que as pessoas silenciam. Desligado por padrão: um painel que faz backup na mão em vez de por agenda ouviria isso todo dia.',
    'backup_days' => 'Um backup conta como vencido depois de',
    'backup_days_helper' => 'É também o que a página de Backups usa. Um servidor com backup semanal não deveria ser apontado com oito dias.',
    'days' => 'dias',

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
    'hint_email_sender' => 'Seu servidor SMTP recusou o endereço de onde o painel envia, e não o endereço para onde ele estava enviando. Em Admin → Configurações → E-mail, o endereço de remetente precisa ser uma caixa da qual a sua conta SMTP tem permissão para enviar. Não tem nada a ver com este plugin — o e-mail de teste do próprio Pelican naquela página falha do mesmo jeito.',
    'hint_email' => 'Olhe em Admin → Configurações → E-mail. O botão de e-mail de teste daquela página usa as mesmas configurações e vai dizer a mesma coisa.',
    'hint_discord_url' => 'O Discord não reconheceu esse webhook. Ele foi apagado, gerado de novo, ou colado pela metade — crie um novo em Configurações do servidor → Integrações → Webhooks e copie a URL inteira.',
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

    'for_unknown' => 'um tempo',
    'for_minutes' => ':count minutos',
    'for_hours' => ':count horas',
    'for_days' => ':count dias',

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
    'node_maintenance_body' => ':node está em manutenção há mais de :hours horas. Enquanto isso nada mais nele é checado, que é justamente a ideia — mas vale saber que ele continua assim.',
    'node_maintenance_over' => ':node saiu da manutenção',

    'wings_behind' => 'O Wings em :node está desatualizado',
    'wings_behind_body' => ':node roda o Wings :installed e já saiu o :latest. Atualize no próprio nó — o painel não tem como fazer isso.',
    'wings_current' => 'O Wings em :node está em dia',

    'panel_behind' => 'O painel está desatualizado',
    'panel_behind_body' => 'Este painel roda o :installed e já saiu o :latest.',
    'panel_current' => 'O painel está em dia',

    'and_more' => 'e mais :count',

    'owners' => 'Avisar as pessoas quando a máquina do servidor delas cai',
    'owners_helper' => 'A única checagem daqui que escreve para alguém além de você. O dono de cada servidor em uma máquina que parou de responder recebe uma notificação no painel — o sininho, nunca um e-mail — e outra quando ela volta. Nunca um lembrete no meio: repetir isso a cada quinze minutos para todo mundo em um nó cheio é como as notificações de um painel deixam de ser lidas. Os subusers não são avisados; o dono é quem decide o que fazer. A máquina não é nomeada para eles, pelo mesmo motivo que a página de status não publica.',

    'owner_down' => 'Um dos seus servidores está offline|:count dos seus servidores estão offline',
    'owner_down_body' => 'A máquina em que eles estão parou de responder. Alguém já foi avisado. Afetados: :servers',
    'owner_up' => 'Seu servidor voltou|:count dos seus servidores voltaram',
    'owner_up_body' => 'A máquina voltou a responder. De volta: :servers',

    'schedules' => 'Tarefas agendadas que pararam',
    'schedules_helper' => 'Uma tarefa travada no meio de uma execução, uma cujo horário passou porque o cron não está rodando, ou uma que nunca rodou. O Pelican não tem palavra para nenhuma das três — uma execução que caiu fica «processando» para sempre e é desenhada igualzinha a uma que está rodando agora. Lê todas as tarefas agendadas ativas do painel a cada checagem.',

    'schedule_stopped' => ':count tarefas agendadas pararam',
    'schedule_stopped_body' => 'Travadas há mais de :hours horas, atrasadas, ou que nunca rodaram: :schedules',
    'schedule_running' => 'Todas as tarefas agendadas voltaram a rodar',

    'backup_none' => ':count servidores nunca receberam backup',
    'backup_none_body' => 'Nunca teve backup em: :servers',
    'backup_none_over' => 'Todos os servidores já têm um backup',

    'backup_stale' => ':count servidores estão há um tempo sem backup',
    'backup_stale_body' => 'Sem nenhum backup bem-sucedido em :days dias em: :servers',
    'backup_stale_over' => 'Todos os servidores receberam backup faz pouco',

    'backup_failed' => 'Os backups estão falhando em :count servidores',
    'backup_failed_body' => 'Um backup terminou sem sucesso em: :servers',
    'backup_failed_over' => 'Nenhum backup está falhando mais',

    'worker_missing' => 'Não tem nada processando a fila',
    'worker_missing_body' => 'Um trabalho foi enfileirado e nada pegou. As atualizações de plugins, as instalações de modpacks e estas checagens param todas até ter um worker rodando — tente systemctl status pelican-queue na máquina do painel.',
    'worker_back' => 'A fila voltou a ser processada',
];
