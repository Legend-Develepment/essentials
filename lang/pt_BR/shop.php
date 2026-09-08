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

    /* ---------------------------------------------------------------------
     * A loja em si, daqui para baixo.
     *
     * Um leitor totalmente diferente: alguém comprando um servidor, que talvez
     * nunca tenha ouvido falar do Pelican e não saiba o que é um egg. Nada aqui
     * embaixo usa as palavras do painel, e cada frase responde à pergunta que o
     * cliente realmente tem naquele ponto da página.
     * ------------------------------------------------------------------- */

    // ---- a loja ----------------------------------------------------------
    'store_title' => 'Loja',
    'store_nav_label' => 'Loja',
    'store_subheading' => 'Escolha um servidor. Ele é criado para você assim que a fatura for paga.',
    'store_empty' => 'Agora não tem nada à venda',
    'store_empty_body' => 'Volte mais tarde, ou pergunte a quem cuida deste painel.',

    'buy' => 'Comprar',
    'sold_out' => 'Esgotado',
    'plus_setup' => 'mais :amount uma vez',

    'spec_memory' => ':amount MiB de memória',
    'spec_disk' => ':amount MiB de disco',
    'spec_cpu' => ':amount% de CPU',
    'spec_backups' => ':count backups',
    'spec_databases' => ':count bancos de dados',

    // ---- a página pública ------------------------------------------------
    'public_empty' => 'Agora não tem nada à venda',
    'public_empty_body' => 'Volte mais tarde.',
    'to_panel' => 'Entrar',
    'terms' => 'Termos',
    'sign_in_note' => 'Escolha um servidor abaixo. Você entra para terminar, e ele é criado assim que a fatura for paga.',

    // ---- o pagamento -----------------------------------------------------
    'checkout_title' => 'Pagamento',
    'tax_line' => 'Imposto (:rate%)',
    'coupon' => 'Cupom de desconto',
    'coupon_placeholder' => 'Se você tiver um',
    'coupon_bad' => 'Esse código não vale aqui.',
    'coupon_good' => 'Código aplicado.',
    'agree' => 'Concordo com os',
    'place_order' => 'Fazer o pedido',
    'place_order_note' => 'Isso escreve uma fatura. Nada é cobrado até você pagar, e o servidor é criado assim que ela for paga.',
    'back_to_store' => 'Voltar para a loja',

    'placed' => 'Pedido feito',
    'placed_body' => 'A fatura :number está esperando na sua página de faturas.',

    'refused' => 'Não deu para comprar isso',
    'refused_gone' => 'Não está mais à venda.',
    'refused_sold_out' => 'O último acabou.',
    'refused_bad_coupon' => 'O cupom de desconto não vale para isso.',
    'refused_failed' => 'Deu algo errado ao escrever o pedido. Nada foi cobrado. Tente de novo, e avise quem cuida deste painel se continuar acontecendo.',

    // ---- faturas ---------------------------------------------------------
    'billing_title' => 'Faturas',
    'billing_nav_label' => 'Faturas',
    'billing_subheading' => 'O que você comprou e o que está devendo.',
    'your_orders' => 'Seus pedidos',
    'your_invoices' => 'Suas faturas',
    'no_orders' => 'Você ainda não comprou nada',
    'no_orders_body' => 'Tudo o que você comprar aparece aqui com o servidor e as datas.',
    'no_invoices' => 'Ainda não há faturas',
    'to_store' => 'Ir para a loja',
    'renews' => 'Renova em',
    'ask_how_to_pay' => 'Pergunte a quem cuida deste painel como pagar. Ainda não escreveram isso aqui.',
    'order_pending' => 'Esperando a fatura ser paga. Logo depois o servidor é criado.',
    'order_suspended' => 'Parado por causa de uma fatura em aberto. Pagar liga o servidor de novo: nada foi excluído.',

    // ---- pagar -----------------------------------------------------------
    'pay_with' => 'Pagar com',
    'pay_now' => 'Pagar',
    'pay_description' => 'Fatura :number',
    'pay_thanks' => 'Obrigado. A fatura está paga.',
    'pay_pending' => 'Ainda não confirmaram. Esta página é atualizada assim que confirmarem.',
    'pay_refused' => 'Isso não começou',
    'pay_refused_body' => 'Não deu para abrir o pagamento. Tente de outro jeito, ou pergunte a quem cuida deste painel.',
    'gateway_mollie' => 'Mollie',

    // ---- as configurações do meio de pagamento ---------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Aceita iDEAL, cartões, Bancontact e o resto por uma conta só. Teste e produção são a mesma configuração: a própria chave diz a qual conta pertence.',
    'mollie_on' => 'Oferecer Mollie',
    'mollie_on_helper' => 'Desligado tira o botão de todas as faturas. O que já está pago continua pago.',
    'mollie_key' => 'Chave de API',
    'mollie_key_helper' => 'Da seção Developers do seu painel Mollie. Ela nunca é escrita num arquivo de configurações exportado.',
    'mollie_hook' => 'Endereço do webhook',
    'mollie_hook_helper' => 'A Mollie avisa em :url - seu painel precisa estar acessível ali pela internet.',

    'gateway_stripe' => 'Cartão',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Aceita cartões numa página desenhada pela Stripe, então nenhum número de cartão chega a este painel. Teste e produção estão no prefixo da chave, não num interruptor.',
    'stripe_on' => 'Oferecer Stripe',
    'stripe_on_helper' => 'Desligado tira o botão de todas as faturas. O que já está pago continua pago.',
    'stripe_key' => 'Chave secreta',
    'stripe_key_helper' => 'A que começa com sk_, em Developers, API keys. Nunca é escrita num arquivo de configurações exportado.',
    'stripe_hook' => 'Segredo de assinatura',
    'stripe_hook_key_helper' => 'O valor whsec_ que a Stripe mostra quando você adiciona o endereço abaixo. Sem ele não dá para provar que as mensagens deles são autênticas, e elas são ignoradas.',
    'stripe_hook_helper' => 'Adicione :url como endpoint em Developers, webhooks, para o evento checkout.session.completed.',
];
