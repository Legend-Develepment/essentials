<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * As configurações da loja, e mais adiante a própria loja.
 *
 * Dois leitores dividem este arquivo de propósito. A metade das configurações
 * é lida pelo administrador; as metades pública e do cliente - acrescentadas
 * conforme a loja cresce - são lidas por gente que talvez nunca tenha ouvido
 * falar do Pelican, e cada frase ali tem de ser escrita para elas.
 */

return [
    'title' => 'Configurações da loja',
    'nav_label' => 'Configurações da loja',
    'subheading' => 'A moeda, o imposto, como as faturas são numeradas e o que a página pública diz. O que está à venda está na página Pacotes.',

    // ---- onde ela está ---------------------------------------------------
    'address' => 'A loja pública está em',
    'address_off' => 'A página pública está desligada. Ligue "Página pública da loja" na lista de recursos da página Configurações do Essentials e ela responde em :url.',

    // ---- geral -----------------------------------------------------------
    'section_general' => 'Dinheiro',
    'section_general_helper' => 'Uma moeda para a loja inteira. Cada preço de cada pacote é um número nela.',
    'currency' => 'Moeda',
    'currency_helper' => 'Mudá-la não converte nada: os preços nos pacotes são números, e depois de uma mudança são números na nova moeda.',
    'tax' => 'Imposto',
    'tax_helper' => 'Uma porcentagem acrescentada a cada fatura como linha própria. Os preços nos pacotes são sem imposto. Zero para nenhum.',
    'tax_suffix' => '%',
    'prefix' => 'Os números de fatura começam com',
    'prefix_helper' => 'Seguido de um número que vai subindo. INV- dá INV-000001.',

    // ---- renovações ------------------------------------------------------
    'section_renewals' => 'Renovações',
    'section_renewals_helper' => 'Para pacotes cobrados por mês, trimestre ou ano. Um pacote de pagamento único nunca é tocado por isto.',
    'notice_days' => 'Faturar estes dias antes do fim do período',
    'notice_days_helper' => 'Quando a próxima fatura é criada e o cliente é avisado.',
    'grace' => 'Suspender estes dias depois do vencimento de uma fatura',
    'grace_helper' => 'Uma fatura não paga além disto suspende o servidor — a suspensão do próprio Pelican, retirada assim que a fatura é paga. A loja nunca exclui nada.',
    'days' => 'dias',

    // ---- a página pública ------------------------------------------------
    'section_public' => 'A página pública',
    'section_public_helper' => 'Lida por gente sem conta. Se ela é servida ou não é o interruptor "Página pública da loja" na lista de recursos.',
    'heading' => 'Título',
    'heading_helper' => 'Deixado vazio, o nome do próprio painel é usado.',
    'note' => 'Uma linha acima dos pacotes',
    'note_helper' => 'Para dizer quem você é, ou o que comprar dá a alguém. Texto simples.',
    'terms_url' => 'Termos',
    'terms_url_helper' => 'Um endereço https. Se estiver definido, comprar significa marcar uma caixa que aponta para ele.',

    // ---- pagar à mão -----------------------------------------------------
    'section_manual' => 'Pagar sem provedor',
    'section_manual_helper' => 'Mostrado numa fatura não paga enquanto nenhum provedor de pagamento estiver ligado: dados bancários, ou para onde mandar o dinheiro. Texto simples.',
    'pay_note' => 'Como pagar',
    'pay_note_helper' => 'Deixe vazio e uma fatura não paga diz só que está não paga.',

    // ---- os botões -------------------------------------------------------
    'save' => 'Salvar',
    'saved' => 'Salvo',
    'save_failed' => 'Nada foi salvo',
];
