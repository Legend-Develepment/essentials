<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Cupons: códigos que tiram algo da primeira fatura.
 *
 * Só da primeira, de propósito, e o texto diz isso onde importa. Um código que
 * também desse desconto em cada renovação seria uma mudança de preço com data
 * de fim, e quem quer isso deveria mudar o preço.
 */

return [
    'title' => 'Cupons',
    'nav_label' => 'Cupons',
    'subheading' => 'Códigos que tiram uma porcentagem ou um valor da primeira fatura. As renovações saem pelo preço do pacote.',

    // ---- a tabela --------------------------------------------------------
    'column_code' => 'Código',
    'column_value' => 'Valor',
    'column_uses' => 'Usado',
    'column_expires' => 'Expira',
    'column_packages' => 'Vale para',
    'column_live' => 'Ativo',

    'never_expires' => 'Sem data de fim',
    'all_packages' => 'Tudo',
    'some_packages' => ':count pacotes',
    'usable' => 'Pode ser usado agora',
    'unusable' => 'Desligado, expirado ou esgotado',

    // ---- os botões -------------------------------------------------------
    'new' => 'Novo cupom',
    'edit' => 'Editar',
    'delete' => 'Excluir',
    'delete_confirm' => 'Tira o código. As faturas que já usaram ficam com o desconto: cada uma guarda o que foi tirado dela.',
    'deleted' => 'Cupom excluído',
    'saved' => 'Cupom salvo',
    'save_failed' => 'Não deu para salvar o cupom',
    'taken' => 'Já tem outra coisa usando esse código.',
    'invalid' => 'Uma porcentagem é um número inteiro de 1 a 100. Um valor se escreve como 12.50 ou 12,50.',

    // ---- o formulário ----------------------------------------------------
    'section_code' => 'O código',
    'section_code_helper' => 'O que o cliente digita na hora de pagar.',
    'code' => 'Código',
    'code_helper' => 'É salvo e comparado em maiúsculas e sem espaços, para funcionar não importa como a pessoa digite.',
    'live' => 'Ativo',
    'live_helper' => 'Desligado, o código para de funcionar sem ser excluído: sai de uso enquanto o desconto que ele deu continua nas faturas que o tiveram.',

    'section_worth' => 'O que ele tira',
    'section_worth_helper' => 'Só da primeira fatura. Nunca leva uma fatura abaixo de zero.',
    'kind' => 'Tipo',
    'kind_helper' => 'Uma parte do preço, ou um valor fixo.',
    'kind_percent' => 'Porcentagem',
    'kind_fixed' => 'Valor fixo',
    'value' => 'Valor',
    'value_percent_helper' => 'Um número inteiro de 1 a 100.',
    'value_fixed_helper' => 'Na moeda da loja. Escreva como 12.50 ou 12,50.',

    'section_limits' => 'Limites',
    'section_limits_helper' => 'Tudo aqui é opcional. Um código sem nenhum deles vale para tudo, para qualquer um, para sempre.',
    'max_uses' => 'Quantas vezes pode ser usado',
    'max_uses_helper' => 'Contado quando o pedido é feito, não quando a fatura é paga: senão um código de dez usos poderia ser gasto cem vezes numa noite.',
    'expires' => 'Expira',
    'expires_helper' => 'Depois desse momento o código para de funcionar. Vazio quer dizer que isso nunca acontece.',
    'packages' => 'Pacotes',
    'packages_helper' => 'Nada marcado quer dizer todos os pacotes, agora e depois.',

    'empty' => 'Ainda não há cupons',
    'empty_body' => 'Crie um e ele funciona na hora de pagar assim que estiver ativo.',
];
