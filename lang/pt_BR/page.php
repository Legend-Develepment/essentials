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
    'secret_kept' => 'Salvo. Deixe vazio para manter, ou digite um novo para substituir.',
    'update_background' => 'Ela roda em segundo plano e leva um ou dois minutos.',

    /*
     * O queue worker e o scheduler, dos quais depende cada tarefa em segundo
     * plano e cada tarefa agendada. Ditos à parte porque falham separadamente
     * e a solução é diferente para cada um.
     */
    'worker_missing' => 'Nenhum queue worker respondeu. As instalações de modpacks, os e-mails e outras tarefas em segundo plano são enfileirados e executados por um processo worker, então enquanto não houver um rodando eles ficam anotados e nunca são executados, sem nenhum erro em lugar nenhum. Ou não há worker, ou há um que foi iniciado antes deste plugin ser instalado e não consegue carregar o código dele - os dois casos se resolvem reiniciando-o no host do painel. Configure o serviço dele para reiniciar sozinho, ou isto volta depois de cada atualização.',
    'cron_missing' => 'O scheduler do painel não roda há :for minutos. As renovações e as checagens do watchdog dependem dele. A linha de cron está na documentação do Pelican.',

    /*
     * Nomeado pela causa e não pelo sintoma, porque o sintoma é «não aconteceu
     * nada» e foi isso que tornou difícil de situar: os avisos, os links de
     * navegação, os estilos salvos e os arranjos de páginas são todos arquivos
     * em storage/app, e um diretório onde o painel não consegue gravar perde
     * todos eles sem falar nada.
     */
    'storage_failed' => 'O painel não conseguiu gravar no diretório storage dele, então isto não foi salvo. Verifique se storage/app pertence ao usuário com que o painel roda. O motivo está em storage/logs.',
];
