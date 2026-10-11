<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Queue worker», «scheduler», «cron», «canal» e os caminhos como storage/app
 * ficam como estão: são os nomes com que se encontram no servidor e na
 * documentação do Pelican, e é exatamente o que é preciso quando aparece uma
 * destas mensagens.
 */

return [
    'title' => 'Definições do Essentials',
    'nav_label' => 'Definições do Essentials',
    'save' => 'Guardar',
    'saved' => 'Definições guardadas',
    'save_failed' => 'Não foi possível guardar as definições',
    'secret_kept' => 'Guardado. Deixe vazio para manter, ou escreva um novo para substituir.',
    'update_background' => 'Corre em segundo plano e leva um minuto ou dois.',

    /*
     * O queue worker e o scheduler, de que depende cada tarefa em segundo
     * plano e cada tarefa agendada. Ditos à parte porque falham separadamente
     * e a cura é diferente para cada um.
     */
    'worker_missing' => 'Nenhum queue worker respondeu. As instalações de modpacks, os e-mails e outras tarefas em segundo plano são postos na fila e executados por um processo worker, por isso enquanto não houver um a correr ficam anotados e nunca executados, sem nenhum erro em lado nenhum. Ou não há worker, ou há um que foi iniciado antes de este plugin ser instalado e não consegue carregar o código dele - as duas coisas resolvem-se reiniciando-o no anfitrião do painel. Configure o serviço dele para reiniciar sozinho, ou isto volta depois de cada atualização.',
    'cron_missing' => 'O scheduler do painel não corre há :for minutos. As renovações e as verificações do watchdog dependem dele. A linha de cron está na documentação do Pelican.',

    /*
     * Nomeado pela causa e não pelo sintoma, porque o sintoma é «não aconteceu
     * nada» e foi isso que tornou difícil situá-lo: os anúncios, as ligações de
     * navegação, os estilos guardados e as disposições de páginas são todos
     * ficheiros em storage/app, e um diretório onde o painel não consegue
     * escrever perde-os a todos sem uma palavra.
     */
    'storage_failed' => 'O painel não conseguiu escrever no seu diretório storage, por isso isto não foi guardado. Verifique que storage/app pertence ao utilizador com que o painel corre. O motivo está em storage/logs.',
];
