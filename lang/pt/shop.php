<?php

/*
 * Português. Escrito à mão.
 *
 * As definições da loja, e mais tarde a própria loja.
 *
 * Dois leitores partilham este ficheiro de propósito. A metade das definições
 * é lida pelo administrador; as metades pública e de cliente - acrescentadas
 * à medida que a loja cresce - são lidas por gente que talvez nunca tenha
 * ouvido falar do Pelican, e cada frase aí tem de ser escrita para eles.
 */

return [
    'title' => 'Definições da loja',
    'nav_label' => 'Definições da loja',
    'subheading' => 'A moeda, o imposto, como as faturas são numeradas e o que a página pública diz. O que está à venda está na página Pacotes.',

    // ---- onde está -------------------------------------------------------
    'address' => 'A loja pública está em',
    'address_off' => 'A página pública está desligada. Ligue «Página pública da loja» na lista de funcionalidades da página Definições do Essentials e ela responde em :url.',

    // ---- geral -----------------------------------------------------------
    'section_general' => 'Dinheiro',
    'section_general_helper' => 'Uma moeda para toda a loja. Cada preço de cada pacote é um número nela.',
    'currency' => 'Moeda',
    'currency_helper' => 'Mudá-la não converte nada: os preços nos pacotes são números, e depois de uma mudança são números na nova moeda.',
    'tax' => 'Imposto',
    'tax_helper' => 'Uma percentagem acrescentada a cada fatura como linha própria. Os preços nos pacotes são sem imposto. Zero para nenhum.',
    'tax_suffix' => '%',
    'prefix' => 'Os números de fatura começam por',
    'prefix_helper' => 'Seguido de um número que vai subindo. INV- dá INV-000001.',

    // ---- renovações ------------------------------------------------------
    'section_renewals' => 'Renovações',
    'section_renewals_helper' => 'Para pacotes faturados ao mês, ao trimestre ou ao ano. Um pacote de pagamento único nunca é tocado por isto.',
    'notice_days' => 'Faturar estes dias antes do fim do período',
    'notice_days_helper' => 'Quando a fatura seguinte é criada e o cliente é avisado.',
    'grace' => 'Suspender estes dias depois do vencimento de uma fatura',
    'grace_helper' => 'Uma fatura por pagar para lá disto suspende o servidor — a suspensão do próprio Pelican, levantada assim que a fatura é paga. A loja nunca elimina nada.',
    'days' => 'dias',

    // ---- a página pública ------------------------------------------------
    'section_public' => 'A página pública',
    'section_public_helper' => 'Lida por gente sem conta. Se é servida ou não é o interruptor «Página pública da loja» na lista de funcionalidades.',
    'heading' => 'Título',
    'heading_helper' => 'Deixado vazio, é usado o nome do próprio painel.',
    'note' => 'Uma linha por cima dos pacotes',
    'note_helper' => 'Para dizer quem é, ou o que comprar dá a alguém. Texto simples.',
    'terms_url' => 'Condições',
    'terms_url_helper' => 'Um endereço https. Se estiver definido, comprar significa marcar uma caixa que aponta para ele.',

    // ---- pagar à mão -----------------------------------------------------
    'section_manual' => 'Pagar sem fornecedor',
    'section_manual_helper' => 'Mostrado numa fatura por pagar enquanto nenhum fornecedor de pagamento estiver ligado: dados bancários, ou para onde enviar o dinheiro. Texto simples.',
    'pay_note' => 'Como pagar',
    'pay_note_helper' => 'Deixe vazio e uma fatura por pagar diz apenas que está por pagar.',

    // ---- os botões -------------------------------------------------------
    'save' => 'Guardar',
    'saved' => 'Guardado',
    'save_failed' => 'Nada foi guardado',

    /* ---------------------------------------------------------------------
     * A loja em si, daqui para baixo.
     *
     * Um leitor completamente diferente: alguém que compra um servidor, que
     * talvez nunca tenha ouvido falar do Pelican e não sabe o que é um egg.
     * Nada aqui em baixo usa as palavras do painel, e cada frase responde à
     * pergunta que um cliente realmente tem naquele ponto da página.
     * ------------------------------------------------------------------- */

    // ---- a loja ----------------------------------------------------------
    'store_title' => 'Loja',
    'store_nav_label' => 'Loja',
    'store_subheading' => 'Escolhe um servidor. É criado para ti assim que a fatura estiver paga.',
    'store_empty' => 'Neste momento não há nada à venda',
    'store_empty_body' => 'Volta mais tarde, ou pergunta a quem toma conta deste painel.',

    'buy' => 'Comprar',
    'sold_out' => 'Esgotado',
    'plus_setup' => 'mais :amount uma vez',

    'spec_memory' => ':amount MiB de memória',
    'spec_disk' => ':amount MiB de disco',
    'spec_cpu' => ':amount% de CPU',
    'spec_backups' => ':count cópias de segurança',
    'spec_databases' => ':count bases de dados',

    // ---- a página pública ------------------------------------------------
    'public_empty' => 'Neste momento não há nada à venda',
    'public_empty_body' => 'Volta mais tarde.',
    'to_panel' => 'Entrar',
    'terms' => 'Condições',
    'sign_in_note' => 'Escolhe um servidor em baixo. Entras para terminar, e é criado assim que a fatura estiver paga.',

    // ---- o pagamento -----------------------------------------------------
    'checkout_title' => 'Pagamento',
    'tax_line' => 'IVA (:rate%)',
    'coupon' => 'Código de desconto',
    'coupon_placeholder' => 'Se tiveres um',
    'coupon_bad' => 'Esse código não serve aqui.',
    'coupon_good' => 'Código aplicado.',
    'agree' => 'Aceito as',
    'place_order' => 'Fazer a encomenda',
    'place_order_note' => 'Isto escreve uma fatura. Não é cobrado nada até pagares, e o servidor é criado assim que estiver paga.',
    'back_to_store' => 'Voltar à loja',

    'placed' => 'Encomenda feita',
    'placed_body' => 'A fatura :number está à tua espera na página de faturação.',

    'refused' => 'Não foi possível comprar isso',
    'refused_gone' => 'Já não está à venda.',
    'refused_sold_out' => 'O último foi-se.',
    'refused_bad_coupon' => 'O código de desconto não serve para isto.',
    'refused_failed' => 'Correu algo mal ao escrever a encomenda. Não foi cobrado nada. Tenta outra vez e diz a quem toma conta deste painel se continuar a acontecer.',

    // ---- faturação -------------------------------------------------------
    'billing_title' => 'Faturação',
    'billing_nav_label' => 'Faturação',
    'billing_subheading' => 'O que compraste e o que deves.',
    'your_orders' => 'As tuas encomendas',
    'your_invoices' => 'As tuas faturas',
    'no_orders' => 'Ainda não compraste nada',
    'no_orders_body' => 'Tudo o que comprares aparece aqui com o servidor e as datas.',
    'no_invoices' => 'Ainda não há faturas',
    'to_store' => 'Ir à loja',
    'renews' => 'Renova',
    'ask_how_to_pay' => 'Pergunta a quem toma conta deste painel como podes pagar. Ainda não o escreveram aqui.',
    'order_pending' => 'À espera de que a fatura seja paga. Logo a seguir o servidor é criado.',
    'order_suspended' => 'Parado por causa de uma fatura por pagar. Pagá-la arranca o servidor outra vez: nada foi apagado.',

    // ---- pagar -----------------------------------------------------------
    'pay_with' => 'Pagar com',
    'pay_now' => 'Pagar',
    'pay_description' => 'Fatura :number',
    'pay_thanks' => 'Obrigado. A fatura está paga.',
    'pay_pending' => 'O fornecedor ainda não confirmou. Esta página é atualizada assim que o fizer.',
    'pay_refused' => 'Isso não arrancou',
    'pay_refused_body' => 'O pagamento não pôde ser aberto. Tenta de outra maneira, ou pergunta a quem toma conta deste painel.',
    'gateway_mollie' => 'Mollie',

    // ---- as definições do fornecedor -------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Aceita iDEAL, cartões, Bancontact e o resto por uma só conta. Teste e produção são a mesma definição: a própria chave diz a que conta pertence.',
    'mollie_on' => 'Oferecer Mollie',
    'mollie_on_helper' => 'Desligado tira o botão de todas as faturas. O que já está pago continua pago.',
    'mollie_key' => 'Chave de API',
    'mollie_key_helper' => 'Da secção Developers do teu painel Mollie. Nunca é escrita num ficheiro de definições exportado.',
    'mollie_hook' => 'Endereço do webhook',
    'mollie_hook_helper' => 'A Mollie avisa em :url - o teu painel tem de estar acessível aí a partir da internet.',

    'gateway_stripe' => 'Cartão',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Aceita cartões numa página desenhada pela Stripe, por isso nenhum número de cartão chega a este painel. Teste e produção estão no prefixo da chave, não num interruptor.',
    'stripe_on' => 'Oferecer Stripe',
    'stripe_on_helper' => 'Desligado tira o botão de todas as faturas. O que já está pago continua pago.',
    'stripe_key' => 'Chave secreta',
    'stripe_key_helper' => 'A que começa por sk_, em Developers, API keys. Nunca é escrita num ficheiro de definições exportado.',
    'stripe_hook' => 'Segredo de assinatura',
    'stripe_hook_key_helper' => 'O valor whsec_ que a Stripe mostra quando adicionas o endereço abaixo. Sem ele não se prova que as mensagens deles são genuínas e são ignoradas.',
    'stripe_hook_helper' => 'Adiciona :url como endpoint em Developers, webhooks, para o evento checkout.session.completed.',
];
