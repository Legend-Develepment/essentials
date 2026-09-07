<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Subuser», «Wings», «SFTP», «cron» e «queue worker» ficam em inglês: é com
 * esses nomes que se acham no Pelican e no host, e é exatamente o que se
 * precisa saber quando uma dessas linhas aparece.
 */

return [
    'nav_label' => 'Acesso a servidores',
    'title' => 'Servidores por cargo',
    'subheading' => 'Dar a todos que têm um cargo acesso aos mesmos servidores.',

    /*
     * Dito antes de tudo o mais na página, porque este é o único recurso daqui
     * que grava em uma tabela do Pelican.
     */
    'more' => 'Como isto funciona',
    'warning' => 'Isto funciona mantendo em dia os subusers do próprio Pelican — as mesmas linhas que você adicionaria na mão na página Usuários de um servidor, e as que a lista de servidores, as checagens de permissão e o Wings já leem. Ele só mexe nas linhas que criou: o que você adicionou na mão nunca é alterado nem removido. Ninguém recebe e-mail quando um cargo lhe concede um servidor. Tirar o acesso também revoga o SFTP dele, o que precisa do queue worker que o Pelican já pede.',

    'never' => 'Ainda não foi reconciliado nada. Salve um vínculo abaixo e isso acontece na hora, e a cada minuto pelo cron do próprio painel daí em diante.',
    'timing' => 'O acesso é tirado no momento em que deve ser: quem perde um cargo perde os servidores já na página seguinte. Conceder pode levar até um minuto, porque essa é a passada que procura as pessoas que não estão usando o painel neste momento.',
    'last_run' => 'Última passada há :ago segundos: :added adicionados, :removed removidos, :held mantidos.',
    'capped' => 'Demais de uma vez — :pairs concessões, e o limite é :max. Nada foi gravado. Aperte um vínculo: um cargo com cinquenta pessoas e vinte servidores dá mil concessões sozinho.',

    'which' => 'Os vínculos',
    'which_helper' => 'Um cargo, os servidores que quem o tem deve alcançar, e o que pode fazer lá. Quem tiver dois cargos recebe tudo o que os dois concedem. Os donos de servidores e os administradores root são pulados — já têm mais do que isto poderia dar a eles.',
    'add' => 'Adicionar um cargo',

    'role' => 'Cargo',
    'role_helper' => 'Todos que o têm, inclusive quem receber depois.',
    'servers' => 'Servidores',
    'servers_helper' => 'Os servidores que eles recebem. Tirar um daqui tira esse acesso de volta.',

    'permissions' => 'O que eles podem fazer',
    'permissions_helper' => 'As permissões de subuser do próprio Pelican. Deixe como estão para um conjunto razoável: o console, os botões de energia, os arquivos, os backups e o registro de atividade — e nada que edite o servidor, os usuários dele, os bancos de dados dele ou as alocações dele. «Connect to websocket» vai sempre incluída, porque sem ela a página do console não se conecta a nada.',

    'save' => 'Salvar e aplicar',
    'saved' => 'Salvo',
    'saved_body' => ':added concedidos, :removed retirados.',
    'save_failed' => 'Não foi possível salvar',
    'save_failed_disk' => 'Não foi possível gravar a lista em storage. Verifique se storage/app pertence ao usuário com que o painel roda.',

    'revoke' => 'Tirar tudo de volta',
    'revoke_confirm' => 'Remover tudo o que isto concedeu?',
    'revoke_confirm_helper' => 'Cada linha de subuser que esta página criou, em cada servidor, para todo mundo — e o SFTP junto. As linhas que você adicionou na mão não são tocadas. Os vínculos abaixo continuam, então o próximo salvamento ou a próxima passada concederiam tudo de novo: esvazie a lista antes se for para valer.',
    'revoked' => ':count removidos',
    'revoked_body' => 'Somente as linhas que esta página tinha criado. O que foi adicionado na mão continua onde estava.',
    'revoke_failed' => 'Não foi possível removê-los',
];
