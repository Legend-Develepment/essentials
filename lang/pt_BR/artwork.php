<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Steam App ID», «IGDB», «Twitch client ID» e «client secret» ficam em inglês:
 * são exatamente as palavras que aparecem nas páginas de onde esses valores
 * vêm.
 */

return [
    'title' => 'Imagens dos eggs',
    'nav_label' => 'Imagens dos eggs',
    'subheading' => 'Imagens de jogo para os seus eggs, buscadas na Steam e no IGDB. Um egg sem imagem mostra o pássaro do Pelican em cada cartão de servidor que o use.',

    // ---- a tabela ---------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Travada',

    'locked' => 'Travada',
    'unlocked' => 'Livre',

    // ---- o que dá para fazer em uma linha ---------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'O número no endereço de um jogo na Steam - store.steampowered.com/app/892970 é 892970. Buscar pelo identificador trava a imagem, porque digitar um número é uma decisão e uma passada em massa depois não pode desfazer isso.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Buscar por',
    'search_term_helper' => 'O nome do egg vem preenchido, mas raramente é como o jogo se chama - «Paper 1.20.4» é Minecraft. Digite o jogo.',

    'lock' => 'Travar',
    'unlock' => 'Destravar',
    'locked_done' => 'Travada - uma passada em massa deixa esta em paz',
    'unlocked_done' => 'Destravada - uma passada em massa pode trocar esta imagem',

    'clear' => 'Limpar',
    'clear_confirm' => 'Tira a imagem e o Steam App ID. O egg volta para o pássaro do Pelican, e a próxima passada em massa tenta de novo.',
    'cleared' => 'Imagem removida',

    // ---- resultados -------------------------------------------------------
    'fetched' => 'Imagem salva',
    'failed' => 'Nenhuma imagem foi salva',

    /*
     * Um motivo para cada um, porque são problemas diferentes.
     *
     * Uma busca que falhou por causa de um erro de digitação e uma que falhou
     * porque o disco está cheio não deveriam dizer as duas «falhou» - a
     * primeira se resolve olhando o número, a segunda olhando o servidor.
     */
    'why_bad_id' => 'Isso não é um Steam App ID.',
    'why_not_found' => 'A Steam não tem nada nesse endereço. Confira o App ID - um jogo sem página de loja também não tem imagem de cabeçalho.',
    'why_no_match' => 'Não foi achado nada com esse nome. Tente o nome de verdade do jogo em vez do nome do egg.',
    'why_no_name' => 'Não há nada para buscar.',
    'why_no_token' => 'A Twitch não emitiu nenhum token. Confira o client ID e o secret em «Credenciais».',
    'why_not_configured' => 'O IGDB precisa de um Twitch client ID e de um secret. Coloque os dois em «Credenciais».',
    'why_empty' => 'A resposta veio vazia.',
    'why_large' => 'Essa imagem é bem maior que um ícone e não foi salva.',
    'why_not_an_image' => 'O que voltou não é uma imagem. Isso normalmente quer dizer que uma página de erro respondeu com um código de sucesso.',
    'why_wrong_format' => 'Essa imagem está em um formato que este painel não guarda. O Pelican mantém PNG, JPEG e WebP.',
    'why_unwritable' => 'Não foi possível gravar a imagem. Verifique se storage/app/public pertence ao usuário com que o painel roda, e se o php artisan storage:link foi rodado.',
    'why_unknown' => 'Não deu certo, e o motivo não é um a que isto saiba dar nome.',

    // ---- tudo de uma vez --------------------------------------------------
    'bulk' => 'Buscar todas as que faltam',
    'bulk_confirm_steam' => 'Busca na Steam pelo nome de cada egg que não tem imagem e não está travado. Os eggs travados e os que já têm imagem ficam em paz. Isto roda em segundo plano - você é avisado quando terminar.',
    'bulk_confirm_both' => 'Busca na Steam pelo nome de cada egg que não tem imagem e não está travado, e depois tenta o IGDB para o que a Steam não achou. Os eggs travados e os que já têm imagem ficam em paz. Isto roda em segundo plano - você é avisado quando terminar.',

    'bulk_started' => 'Buscando em segundo plano',
    'bulk_started_body' => 'Em um painel grande isso pode levar vários minutos. Você recebe uma notificação quando terminar, e pode sair desta página.',

    'bulk_done' => 'Imagens dos eggs concluídas',
    'bulk_done_body' => ':fetched buscadas, :skipped deixadas em paz, :failed sem achar nada. Um egg fica em paz quando está travado ou já tem imagem.',

    'bulk_failed' => 'A passada em massa não rodou',
    'bulk_failed_queue' => 'Não foi possível entregá-la à fila. Isto precisa de um queue worker - confira se o pelican-queue está rodando.',

    // ---- credenciais do IGDB ----------------------------------------------
    'credentials' => 'Credenciais',
    'credentials_helper' => 'A Steam funciona sem nada disso. Estes dados são só para o IGDB, que cobre os jogos dos quais a Steam nunca ouviu falar - o Minecraft e cada variante dele, tudo o que saiu em console, a maioria dos eggs com mods.',
    'credentials_where' => 'Crie um aplicativo em dev.twitch.tv/console, gere um client secret, e cole os dois aqui. É de graça.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Credenciais salvas',
    'credentials_failed' => 'Não foi possível salvar as credenciais',
];
