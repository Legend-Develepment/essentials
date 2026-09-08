<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Queue worker», «scheduler», «cron», «canal» e os caminhos como storage/app
 * ficam como estão: são os nomes com que se acham no servidor e na documentação
 * do Pelican, e é exatamente o que se precisa quando uma dessas mensagens
 * aparece.
 */

return [
    'title' => 'Configurações do Essentials',
    'nav_label' => 'Configurações do Essentials',
    'save' => 'Salvar',
    'saved' => 'Configurações salvas',
    'save_failed' => 'Não foi possível salvar as configurações',
    'update' => 'Atualizar',
    'update_available' => 'Há uma atualização disponível',
    'update_confirm' => 'O painel baixa a versão nova, reconstrói os assets dele e limpa os caches. Suas configurações são mantidas.',
    'update_started' => 'Atualização iniciada',
    'update_background' => 'Ela roda em segundo plano e leva um ou dois minutos.',
    'update_failed' => 'Não foi possível atualizar o tema',
    'update_done' => 'Tema atualizado',
    'check' => 'Procurar atualizações',
    'check_failed' => 'Não foi possível ler o feed de atualizações',
    'check_failed_body' => 'O painel não chegou até ele, ou ele não devolveu JSON válido.',
    'up_to_date' => 'Você está na versão mais recente',
    'reinstall' => 'Reinstalar',

    'auto_on' => 'As atualizações se instalam sozinhas',

    /*
     * O que a última checagem automática fez. Cada uma destas linhas aponta a
     * parte que precisaria ser olhada, porque de dentro de um navegador as três
     * maneiras de isso dar errado parecem todas iguais: um número descendo.
     */
    'auto_never' => 'Ainda não houve nenhuma checagem. As atualizações automáticas precisam do scheduler do painel — a entrada de cron que roda php artisan schedule:run a cada minuto. Sem ela nada do que está agendado acontece.',
    'auto_ago' => 'Última checagem :ago',
    'auto_just_now' => 'agora mesmo',
    'auto_minutes' => 'minutos atrás',
    'auto_current' => 'não há nada mais novo neste canal.',
    'auto_installed' => 'A v:version foi instalada aqui, pela própria checagem agendada. É o que ela faz quando nenhum queue worker responde, então a atualização acontece de todo jeito — mas um painel sem worker é um painel onde o resto do trabalho na fila também não está acontecendo.',
    'auto_queued' => 'A v:version foi entregue ao queue worker. Se a versão acima não mudar em alguns minutos, o worker está pegando trabalhos mas falhando neste — reiniciá-lo é a solução de sempre, e o motivo está em storage/logs.',
    'auto_unreachable' => 'não foi possível ler o feed de atualizações. Ele é buscado pela internet, então isso costuma ser um problema de rede ou de DNS no host do painel.',
    'auto_error' => 'a checagem falhou. O motivo está em storage/logs.',

    /*
     * O queue worker, que é o que de fato executa uma atualização. Dito à parte
     * da checagem acima porque eles falham separadamente e a solução é
     * diferente para cada um.
     */
    'worker_missing' => 'Nenhum queue worker respondeu. As atualizações, as instalações de modpacks e estas checagens são enfileiradas e executadas por um processo worker, então enquanto não houver um rodando elas ficam anotadas e nunca são executadas, sem nenhum erro em lugar nenhum. Ou não há worker, ou há um que foi iniciado antes deste plugin ser instalado e não consegue carregar o código dele — os dois casos se resolvem reiniciando-o no host do painel. Configure o serviço dele para reiniciar sozinho, ou isto volta depois de cada atualização.',

    'next_check' => 'Próxima checagem em',
    'due_now' => 'prevista para agora',

    /*
     * Nomeado pela causa e não pelo sintoma, porque o sintoma é «não aconteceu
     * nada» e foi isso que tornou difícil de situar: os avisos, os links de
     * navegação, os estilos salvos e os arranjos de páginas são todos arquivos
     * em storage/app, e um diretório onde o painel não consegue gravar perde
     * todos eles sem falar nada.
     */
    'storage_failed' => 'O painel não conseguiu gravar no diretório storage dele, então isto não foi salvo. Verifique se storage/app pertence ao usuário com que o painel roda. O motivo está em storage/logs.',

    /*
     * Dito depois de cada atualização que falha e não só depois de uma
     * divergência de identificadores. A mensagem acima já aponta a causa; esta
     * aponta a única solução que não se deduz de «esperava X, veio Y».
     */
    'update_renamed' => 'Se isto disser que dois identificadores não batem, o plugin foi renomeado, e nenhuma atualização atravessa isso — o Pelican conhece um plugin instalado pelo identificador. Desinstale a entrada antiga em Admin → Plugins e instale este do zero. Suas configurações sobrevivem: elas vivem no .env e em storage/app/private/legend-theme, e nenhum dos dois é indexado pelo identificador.',
];
