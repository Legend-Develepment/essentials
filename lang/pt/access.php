<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Subuser», «Wings», «SFTP», «cron» e «queue worker» ficam em inglês: é com
 * esses nomes que se encontram no Pelican e no anfitrião, e é exatamente o que
 * é preciso saber quando aparece uma destas linhas.
 */

return [
    'nav_label' => 'Acesso a servidores',
    'title' => 'Servidores por função',
    'subheading' => 'Dar a todos os que têm uma função acesso aos mesmos servidores.',

    /*
     * Dito antes de tudo o resto na página, porque esta é a única
     * funcionalidade daqui que escreve numa tabela do Pelican.
     */
    'more' => 'Como isto funciona',
    'warning' => 'Isto funciona mantendo atualizados os subusers do próprio Pelican - as mesmas linhas que acrescentaria à mão na página Utilizadores de um servidor, e as que a lista de servidores, as verificações de permissões e o Wings já leem. Só toca nas linhas que criou: o que acrescentou à mão nunca é alterado nem removido. Ninguém recebe um e-mail quando uma função lhe concede um servidor. Retirar o acesso revoga também o SFTP, o que precisa do queue worker que o Pelican já pede.',

    'never' => 'Ainda não foi reconciliado nada. Guarde uma associação abaixo e acontece de imediato, e a cada minuto pelo cron do próprio painel a partir daí.',
    'timing' => 'O acesso é retirado no momento em que deve ser: quem perde uma função perde os servidores logo na página seguinte. Conceder pode levar até um minuto, porque essa é a passagem que procura as pessoas que não estão a usar o painel neste momento.',
    'last_run' => 'Última passagem há :ago segundos: :added adicionados, :removed retirados, :held mantidos.',
    'capped' => 'Demasiado de uma vez - :pairs concessões, e o limite é :max. Não foi escrito nada. Aperte uma associação: uma função com cinquenta pessoas e vinte servidores são mil concessões só por si.',

    'which' => 'As associações',
    'which_helper' => 'Uma função, os servidores que quem a tem deve alcançar, e o que pode lá fazer. Quem tiver duas funções recebe tudo o que ambas concedem. Os proprietários de servidores e os administradores root são ignorados - já têm mais do que isto lhes poderia dar.',
    'add' => 'Adicionar uma função',

    'role' => 'Função',
    'role_helper' => 'Todos os que a têm, incluindo quem a receba mais tarde.',
    'servers' => 'Servidores',
    'servers_helper' => 'Os servidores que recebem. Retirar um daqui retira-lhes esse acesso.',

    'permissions' => 'O que podem fazer',
    'permissions_helper' => 'As permissões de subuser do próprio Pelican. Deixe-as como estão para um conjunto sensato: a consola, os botões de energia, os ficheiros, as cópias de segurança e o registo de atividade - e nada que edite o servidor, os seus utilizadores, as suas bases de dados ou as suas alocações. «Connect to websocket» vai sempre incluída, porque sem ela a página da consola não se liga a nada.',

    'save' => 'Guardar e aplicar',
    'saved' => 'Guardado',
    'saved_body' => ':added concedidos, :removed retirados.',
    'save_failed' => 'Não foi possível guardar',
    'save_failed_disk' => 'Não foi possível escrever a lista em storage. Verifique que storage/app pertence ao utilizador com que o painel corre.',

    'revoke' => 'Retirar tudo',
    'revoke_confirm' => 'Retirar tudo o que isto concedeu?',
    'revoke_confirm_helper' => 'Todas as linhas de subuser que esta página criou, em todos os servidores, para toda a gente - e o SFTP delas com elas. As linhas que acrescentou à mão não são tocadas. As associações abaixo ficam, por isso o próximo guardar ou a próxima passagem voltariam a concedê-las: esvazie primeiro a lista se for a sério.',
    'revoked' => ':count retirados',
    'revoked_body' => 'Apenas as linhas que esta página tinha criado. O que foi acrescentado à mão continua onde estava.',
    'revoke_failed' => 'Não foi possível retirá-los',
];
