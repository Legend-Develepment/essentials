<?php

/*
 * Português. Escrito à mão.
 *
 * Códigos de desconto: códigos que tiram alguma coisa da primeira fatura.
 *
 * Só da primeira, de propósito, e o texto di-lo onde isso interessa. Um código
 * que descontasse também cada renovação seria uma mudança de preço com data de
 * fim, e quem quer isso deve mudar o preço.
 */

return [
    'title' => 'Códigos de desconto',
    'nav_label' => 'Códigos de desconto',
    'subheading' => 'Códigos que tiram uma percentagem ou um valor da primeira fatura. As renovações são ao preço do pacote.',

    // ---- a tabela --------------------------------------------------------
    'column_code' => 'Código',
    'column_value' => 'Valor',
    'column_uses' => 'Usado',
    'column_expires' => 'Expira',
    'column_packages' => 'Aplica-se a',
    'column_live' => 'Ativo',

    'never_expires' => 'Sem data de fim',
    'all_packages' => 'Tudo',
    'some_packages' => ':count pacotes',
    'usable' => 'Pode ser usado agora',
    'unusable' => 'Desligado, expirado ou esgotado',

    // ---- os botões -------------------------------------------------------
    'new' => 'Novo código',
    'edit' => 'Editar',
    'delete' => 'Apagar',
    'delete_confirm' => 'Tira o código. As faturas que já o usaram ficam com o desconto: cada uma guarda o que lhe foi tirado.',
    'deleted' => 'Código apagado',
    'saved' => 'Código guardado',
    'save_failed' => 'Não foi possível guardar o código',
    'taken' => 'Já existe outra coisa a usar esse código.',
    'invalid' => 'Uma percentagem é um número inteiro de 1 a 100. Um valor escreve-se como 12.50 ou 12,50.',

    // ---- o formulário ----------------------------------------------------
    'section_code' => 'O código',
    'section_code_helper' => 'O que o cliente escreve ao pagar.',
    'code' => 'Código',
    'code_helper' => 'É guardado e comparado em maiúsculas e sem espaços, para funcionar seja como for que o escrevam.',
    'live' => 'Ativo',
    'live_helper' => 'Desligado deixa de funcionar sem ser apagado: fica fora de uso enquanto o desconto que deu se mantém nas faturas que o tiveram.',

    'section_worth' => 'O que tira',
    'section_worth_helper' => 'Só da primeira fatura. Nunca leva uma fatura abaixo de zero.',
    'kind' => 'Tipo',
    'kind_helper' => 'Uma parte do preço, ou um valor fixo.',
    'kind_percent' => 'Percentagem',
    'kind_fixed' => 'Valor fixo',
    'value' => 'Valor',
    'value_percent_helper' => 'Um número inteiro de 1 a 100.',
    'value_fixed_helper' => 'Na moeda da loja. Escreve-o como 12.50 ou 12,50.',

    'section_limits' => 'Limites',
    'section_limits_helper' => 'Tudo isto é opcional. Um código sem nenhum destes serve para tudo, para toda a gente, para sempre.',
    'max_uses' => 'Vezes que pode ser usado',
    'max_uses_helper' => 'Contado quando a encomenda é feita, não quando a fatura é paga: senão um código de dez usos podia ser gasto cem vezes numa noite.',
    'expires' => 'Expira',
    'expires_helper' => 'Depois deste momento o código deixa de funcionar. Vazio quer dizer que isso nunca acontece.',
    'packages' => 'Pacotes',
    'packages_helper' => 'Nada marcado quer dizer todos os pacotes, agora e depois.',

    'empty' => 'Ainda não há códigos',
    'empty_body' => 'Cria um e funciona no pagamento assim que estiver ativo.',
];
