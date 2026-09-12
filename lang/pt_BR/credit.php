<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Crédito, reembolsos e notas de crédito.
 *
 * Duas palavras são mantidas separadas de propósito em tudo o que vem abaixo.
 *
 * «Crédito» é dinheiro que a loja está guardando para alguém. Ele sai sozinho
 * da próxima fatura da pessoa, antes de ela ser sequer chamada a pagar.
 *
 * «Reembolso» é o ato de devolver dinheiro, e ele tem dois destinos: de volta
 * para o cartão de onde veio, ou para a conta como crédito. O texto sempre diz
 * qual dos dois, porque um cliente que leu «você foi reembolsado» e depois não
 * acha nada no banco escreve reclamando, e com razão.
 *
 * «Nota de crédito» é o documento. Uma é escrita nos dois casos, porque ela é o
 * registro de que o dinheiro não é mais devido à loja - não uma afirmação sobre
 * para onde ele foi.
 */

return [
    // ---- o que o cliente vê -----------------------------------------------
    'yours' => 'Seu crédito',
    'yours_body' => 'Ele sai da sua próxima fatura automaticamente. Você não precisa fazer nada com ele.',
    'applied' => 'Pago com o seu crédito',
    'payable' => 'Falta pagar',

    // ---- o extrato, na janela do cliente ---------------------------------
    'held' => 'Crédito',
    'none_held' => 'Nada na conta',
    'movements' => 'Crédito',
    'column' => 'Crédito',
    'none' => 'Nenhum',

    // ---- dar um pouco -----------------------------------------------------
    'give' => 'Crédito',
    'give_helper' => 'Esta conta tem :held. O que você colocar nela sai sozinho da próxima fatura do cliente. Um valor negativo tira crédito de volta, e os dois movimentos ficam no histórico.',
    'amount' => 'Valor',
    'amount_helper' => 'Um valor negativo tira crédito em vez de dar.',
    'reason' => 'Motivo',
    'reason_helper' => 'O cliente vê isto ao lado do valor, então escreva para ele e não para o arquivo.',
    'given' => ':amount de crédito para :who',
    'bad_amount' => 'Isso não é um valor.',
    'give_failed' => 'O crédito não foi dado',
    'give_failed_body' => 'Nada foi gravado. Tente de novo, e olhe o log se continuar acontecendo.',
    'take_failed' => 'O crédito não foi tirado',
    'take_failed_body' => 'Tem menos na conta do que você pediu para tirar. Um saldo nunca é levado abaixo de zero.',

    // ---- o que um movimento diz ------------------------------------------
    'spent_on' => 'Fatura :number',
    'returned' => 'Devolvido: a fatura para a qual ele era não pôde ser escrita',
    'note_line' => 'Nota de crédito da fatura :number',
    'refund_description' => 'Reembolso da fatura :number',

    // ---- devolver ---------------------------------------------------------
    'refund' => 'Reembolsar',
    'refund_helper' => 'Ainda não foram devolvidos :left desta fatura. Uma nota de crédito é escrita de qualquer jeito, para ficar registrado dos dois lados.',
    'refund_amount_helper' => 'Uma parte também serve. O que sobrar pode ser devolvido depois.',
    'refund_reason_helper' => 'Isto é impresso na nota de crédito que o cliente pode abrir.',
    'where' => 'Para onde vai o dinheiro',
    'where_provider' => 'De volta pelo meio que ele usou',
    'where_provider_helper' => 'O provedor manda o dinheiro para o cartão ou a conta de onde ele veio. Pode levar alguns dias para aparecer, e eles podem recusar - um pagamento antigo, ou um meio que não desfaz.',
    'where_balance' => 'Para a conta dele aqui',
    'where_balance_helper' => 'Ele vira crédito e sai da próxima fatura do cliente. Nada sai do banco, e isso não tem como falhar.',
    'refunded' => ':amount reembolsados',
    'refunded_body' => 'A nota de crédito :number foi escrita para isso.',
    'refund_failed' => 'Nada foi reembolsado',

    // ---- e por que não, um motivo de cada vez -----------------------------
    'refused_off' => 'O crédito e os reembolsos estão desligados neste painel.',
    'refused_amount' => 'Isso é mais do que sobrou nesta fatura.',
    'refused_no_payment' => 'Nenhum pagamento desta fatura tem tanto assim sobrando, então não há nada para um provedor desfazer. Coloque na conta do cliente em vez disso.',
    'refused_no_gateway' => 'O provedor por onde isto foi pago não está mais ligado, então não dá para pedir a ele que desfaça nada. Coloque na conta do cliente em vez disso.',
    'refused_refused' => 'O provedor recusou. Isso costuma ser um pagamento antigo ou um meio que não desfaz; o motivo que eles deram está no log. Coloque na conta do cliente em vez disso.',
    'refused_note_failed' => 'O dinheiro foi movido mas a nota de crédito não quis ser escrita, então nada foi registrado. Olhe o log antes de tentar de novo.',

    // ---- colocar dinheiro -------------------------------------------------
    'topup' => 'Adicionar crédito',
    'topup_helper' => 'Você tem :held na conta. O que você adicionar aqui sai sozinho da sua próxima fatura, e qualquer fatura que você já tenha em aberto é quitada com ele assim que ele chega.',
    'topup_go' => 'Ir para o pagamento',
    'topup_amount_helper' => 'Entre :least e :most.',
    'topup_bad' => 'Esse valor não pode ser pago',
    'topup_failed' => 'Não foi possível começar o pagamento. Tente de novo, e avise quem administra este painel se continuar acontecendo.',
    'topup_line' => 'Crédito adicionado à conta',
    'topup_reason' => 'Adicionado na fatura :number',

    // ---- onde ele aparece -------------------------------------------------
    'menu' => ':amount de crédito',
    'held_helper' => 'Sai sozinho da sua próxima fatura. Você adiciona mais na página de faturas.',
];
