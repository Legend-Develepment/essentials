<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Steam App ID», «IGDB», «Twitch client ID» e «client secret» ficam em inglês:
 * são exatamente as palavras que aparecem nas páginas de onde esses valores
 * vêm.
 */

return [
    'title' => 'Imagens dos eggs',
    'nav_label' => 'Imagens dos eggs',
    'subheading' => 'Imagens de jogo para os seus eggs, obtidas da Steam e do IGDB. Um egg sem imagem mostra o pássaro do Pelican em cada cartão de servidor que o use.',

    // ---- a tabela ---------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Bloqueada',

    'locked' => 'Bloqueada',
    'unlocked' => 'Livre',

    // ---- o que se pode fazer a uma linha ----------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'O número no endereço de um jogo na Steam — store.steampowered.com/app/892970 é 892970. Obter por identificador bloqueia a imagem, porque escrever um número é uma decisão e uma passagem em massa posterior não a deve desfazer.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Procurar por',
    'search_term_helper' => 'O nome do egg vem preenchido, mas raramente é como o jogo se chama — «Paper 1.20.4» é Minecraft. Escreva o jogo.',

    'lock' => 'Bloquear',
    'unlock' => 'Desbloquear',
    'locked_done' => 'Bloqueada — uma passagem em massa deixa esta em paz',
    'unlocked_done' => 'Desbloqueada — uma passagem em massa pode substituir esta imagem',

    'clear' => 'Limpar',
    'clear_confirm' => 'Retira a imagem e o Steam App ID. O egg volta ao pássaro do Pelican, e a próxima passagem em massa tenta outra vez.',
    'cleared' => 'Imagem retirada',

    // ---- resultados -------------------------------------------------------
    'fetched' => 'Imagem guardada',
    'failed' => 'Não foi guardada nenhuma imagem',

    /*
     * Um motivo para cada um, porque são problemas diferentes.
     *
     * Uma obtenção que falhou por causa de uma gralha e outra que falhou porque
     * o disco está cheio não deviam dizer as duas «falhou» — a primeira
     * resolve-se olhando para o número, a segunda olhando para o servidor.
     */
    'why_bad_id' => 'Isso não é um Steam App ID.',
    'why_not_found' => 'A Steam não tem nada nesse endereço. Verifique o App ID — um jogo sem página de loja também não tem imagem de cabeçalho.',
    'why_no_match' => 'Não foi encontrado nada com esse nome. Tente o nome real do jogo em vez do nome do egg.',
    'why_no_name' => 'Não há nada para procurar.',
    'why_no_token' => 'A Twitch não emitiu nenhum token. Verifique o client ID e o secret em «Credenciais».',
    'why_not_configured' => 'O IGDB precisa de um Twitch client ID e de um secret. Ponha-os em «Credenciais».',
    'why_empty' => 'A resposta estava vazia.',
    'why_large' => 'Essa imagem é muito maior do que um ícone e não foi guardada.',
    'why_not_an_image' => 'O que voltou não é uma imagem. Isso normalmente quer dizer que uma página de erro respondeu com um código de sucesso.',
    'why_wrong_format' => 'Essa imagem está num formato que este painel não guarda. O Pelican mantém PNG, JPEG e WebP.',
    'why_unwritable' => 'Não foi possível escrever a imagem. Verifique que storage/app/public pertence ao utilizador com que o painel corre, e que php artisan storage:link foi executado.',
    'why_unknown' => 'Não resultou, e o motivo não é um a que isto saiba dar nome.',

    // ---- tudo de uma vez --------------------------------------------------
    'bulk' => 'Obter todas as que faltam',
    'bulk_confirm_steam' => 'Procura na Steam por nome para cada egg que não tenha imagem e não esteja bloqueado. Os eggs bloqueados e os que já têm imagem são deixados em paz. Isto corre em segundo plano — será avisado quando terminar.',
    'bulk_confirm_both' => 'Procura na Steam por nome para cada egg que não tenha imagem e não esteja bloqueado, e depois tenta o IGDB para o que a Steam não encontrou. Os eggs bloqueados e os que já têm imagem são deixados em paz. Isto corre em segundo plano — será avisado quando terminar.',

    'bulk_started' => 'A obter em segundo plano',
    'bulk_started_body' => 'Num painel grande isto pode levar vários minutos. Recebe uma notificação quando estiver feito, e pode sair desta página.',

    'bulk_done' => 'Imagens dos eggs concluídas',
    'bulk_done_body' => ':fetched obtidas, :skipped deixadas em paz, :failed sem nada encontrado. Um egg é deixado em paz quando está bloqueado ou já tem imagem.',

    'bulk_failed' => 'A passagem em massa não correu',
    'bulk_failed_queue' => 'Não foi possível entregá-la à fila. Isto precisa de um queue worker — verifique que o pelican-queue está a correr.',

    // ---- credenciais do IGDB ----------------------------------------------
    'credentials' => 'Credenciais',
    'credentials_helper' => 'A Steam funciona sem nada disto. Estes dados são só para o IGDB, que cobre os jogos de que a Steam nunca ouviu falar — o Minecraft e todas as suas variantes, tudo o que saiu numa consola, a maioria dos eggs com mods.',
    'credentials_where' => 'Crie uma aplicação em dev.twitch.tv/console, gere um client secret, e cole os dois aqui. É gratuito.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Credenciais guardadas',
    'credentials_failed' => 'Não foi possível guardar as credenciais',
];
