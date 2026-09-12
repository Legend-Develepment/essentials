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
    'updating_now' => 'Este painel está a instalar uma atualização. Uma página pode ficar estranha por instantes.',
    'updating_done' => 'A atualização está instalada. Se uma página ficou estranha há pouco, recarregue-a.',
    'title' => 'Definições do Essentials',
    'nav_label' => 'Definições do Essentials',
    'save' => 'Guardar',
    'saved' => 'Definições guardadas',
    'save_failed' => 'Não foi possível guardar as definições',
    'update' => 'Atualizar',
    'update_available' => 'Há uma atualização disponível',
    'update_confirm' => 'O painel descarrega a versão nova, reconstrói os seus assets e limpa as suas caches. As suas definições são mantidas.',
    'update_started' => 'Atualização iniciada',
    'update_background' => 'Corre em segundo plano e leva um minuto ou dois.',
    'update_failed' => 'Não foi possível atualizar o tema',
    'update_done' => 'Tema atualizado',
    'check' => 'Procurar atualizações',
    'check_failed' => 'Não foi possível ler o feed de atualizações',
    'check_failed_body' => 'O painel não chegou lá, ou não devolveu JSON válido.',
    'up_to_date' => 'Está na versão mais recente',
    'reinstall' => 'Reinstalar',

    'auto_on' => 'As atualizações instalam-se sozinhas',

    /*
     * O que fez a última verificação automática. Cada uma destas linhas nomeia
     * a parte que seria preciso ver, porque a partir de um navegador as três
     * maneiras de isto correr mal parecem todas iguais: um número a descer.
     */
    'auto_never' => 'Ainda não houve nenhuma verificação. As atualizações automáticas precisam do scheduler do painel - a entrada de cron que corre php artisan schedule:run a cada minuto. Sem ela não acontece nada do que está agendado.',
    'auto_ago' => 'Última verificação :ago',
    'auto_just_now' => 'agora mesmo',
    'auto_minutes' => 'minutos',
    'auto_current' => 'não há nada mais recente neste canal.',
    'auto_installed' => 'A v:version foi instalada aqui, pela própria verificação agendada. É o que ela faz quando nenhum queue worker responde, por isso a atualização acontece de qualquer maneira - mas um painel sem worker é um painel onde o resto do trabalho em fila também não está a acontecer.',
    'auto_queued' => 'A v:version foi entregue ao queue worker. Se a versão acima não mudar dentro de alguns minutos, o worker está a aceitar trabalhos mas a falhar este - reiniciá-lo é a solução habitual, e o motivo está em storage/logs.',
    'auto_unreachable' => 'não foi possível ler o feed de atualizações. É obtido pela internet, por isso é normalmente um problema de rede ou de DNS no anfitrião do painel.',
    'auto_error' => 'a verificação falhou. O motivo está em storage/logs.',

    /*
     * O queue worker, que é o que realmente executa uma atualização. Dito à
     * parte da verificação acima porque falham separadamente e a cura é
     * diferente para cada um.
     */
    'worker_missing' => 'Nenhum queue worker respondeu. As atualizações, as instalações de modpacks e estas verificações são postas na fila e executadas por um processo worker, por isso enquanto não houver um a correr ficam anotadas e nunca executadas, sem nenhum erro em lado nenhum. Ou não há worker, ou há um que foi iniciado antes de este plugin ser instalado e não consegue carregar o código dele - as duas coisas resolvem-se reiniciando-o no anfitrião do painel. Configure o serviço dele para reiniciar sozinho, ou isto volta depois de cada atualização.',
    'cron_missing' => 'O scheduler do painel não corre há :for minutos. As renovações, as verificações do watchdog e as atualizações automáticas dependem todas dele. A linha de cron está na documentação do Pelican.',

    'next_check' => 'Próxima verificação em',
    'due_now' => 'devida agora',

    /*
     * Nomeado pela causa e não pelo sintoma, porque o sintoma é «não aconteceu
     * nada» e foi isso que tornou difícil situá-lo: os anúncios, as ligações de
     * navegação, os estilos guardados e as disposições de páginas são todos
     * ficheiros em storage/app, e um diretório onde o painel não consegue
     * escrever perde-os a todos sem uma palavra.
     */
    'storage_failed' => 'O painel não conseguiu escrever no seu diretório storage, por isso isto não foi guardado. Verifique que storage/app pertence ao utilizador com que o painel corre. O motivo está em storage/logs.',

    /*
     * Dito depois de cada atualização falhada e não só depois de uma
     * discordância de identificadores. A mensagem acima já nomeia a causa; esta
     * nomeia a única cura que não se deduz de «esperava X, recebi Y».
     */
    'update_renamed' => 'Se isto disser que dois identificadores não coincidem, o plugin foi renomeado, e nenhuma atualização atravessa isso - o Pelican conhece um plugin instalado pelo identificador. Desinstale a entrada antiga em Admin → Plugins e instale este de novo. As suas definições sobrevivem: vivem no .env e em storage/app/private/legend-theme, e nenhum dos dois é indexado pelo identificador.',
];
