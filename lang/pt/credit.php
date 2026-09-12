<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * Saldo, reembolsos e notas de crédito.
 *
 * Há duas palavras que são mantidas à parte de propósito em tudo o que vem a
 * seguir.
 *
 * «Saldo» é dinheiro que a loja tem guardado para alguém. É descontado da
 * fatura seguinte sozinho, antes de a pessoa chegar a ser chamada a pagar.
 *
 * Um «reembolso» é o ato de devolver dinheiro, e tem dois destinos: o cartão de
 * onde veio, ou a conta aqui, como saldo. O texto diz sempre qual dos dois,
 * porque um cliente a quem se diz «foi reembolsado» e que depois não encontra
 * nada no banco escreve a reclamar, e com razão.
 *
 * Uma «nota de crédito» é o documento. É escrita nos dois casos, porque é o
 * registo de que o dinheiro já não é devido à loja - não uma afirmação sobre
 * para onde ele foi.
 */

return [
    // ---- o que o cliente vê ----------------------------------------------
    'yours' => 'O teu saldo',
    'yours_body' => 'Isto é descontado da tua próxima fatura automaticamente. Não tens de fazer nada com ele.',
    'applied' => 'Pago com o teu saldo',
    'payable' => 'Falta pagar',

    // ---- o livro de movimentos, na janela do cliente ---------------------
    'held' => 'Saldo',
    'none_held' => 'Nada na conta',
    'movements' => 'Saldo',
    'column' => 'Saldo',
    'none' => 'Nenhum',

    // ---- dar algum --------------------------------------------------------
    'give' => 'Saldo',
    'give_helper' => 'Esta conta tem :held. O que lhe puser é descontado da próxima fatura do cliente sozinho. Um valor negativo volta a tirar saldo, e os dois movimentos ficam no histórico.',
    'amount' => 'Valor',
    'amount_helper' => 'Um valor negativo tira saldo em vez de o dar.',
    'reason' => 'Motivo',
    'reason_helper' => 'O cliente vê isto ao lado do valor, por isso escreva-o para ele e não para o arquivo.',
    'given' => ':amount de saldo para :who',
    'bad_amount' => 'Isso não é um valor.',
    'give_failed' => 'O saldo não foi dado',
    'give_failed_body' => 'Não ficou nada registado. Tente outra vez, e veja o registo se continuar a acontecer.',
    'take_failed' => 'O saldo não foi retirado',
    'take_failed_body' => 'A conta tem menos do que aquilo que pediu para tirar. Um saldo nunca desce abaixo de zero.',

    // ---- o que um movimento diz -------------------------------------------
    'spent_on' => 'Fatura :number',
    'returned' => 'Devolvido: a fatura a que se destinava não pôde ser escrita',
    'note_line' => 'Nota de crédito da fatura :number',
    'refund_description' => 'Reembolso da fatura :number',

    // ---- devolver ---------------------------------------------------------
    'refund' => 'Reembolsar',
    'refund_helper' => 'Faltam devolver :left desta fatura. É escrita uma nota de crédito nos dois casos, para que fique registado dos dois lados.',
    'refund_amount_helper' => 'Uma parte também serve. O que sobrar pode ser devolvido mais tarde.',
    'refund_reason_helper' => 'Isto é impresso na nota de crédito que o cliente pode abrir.',
    'where' => 'Para onde vai o dinheiro',
    'where_provider' => 'De volta pela forma como pagaram',
    'where_provider_helper' => 'O fornecedor envia-o para o cartão ou a conta de onde veio. Pode demorar alguns dias a aparecer, e podem recusar - um pagamento antigo, ou um método que não se reverte.',
    'where_balance' => 'Para a conta que têm aqui',
    'where_balance_helper' => 'Passa a saldo e é descontado da próxima fatura. Não sai nada do banco, e não pode falhar.',
    'refunded' => ':amount reembolsados',
    'refunded_body' => 'Foi escrita a nota de crédito :number.',
    'refund_failed' => 'Não foi reembolsado nada',

    // ---- e porque não, um motivo de cada vez ------------------------------
    'refused_off' => 'O saldo e os reembolsos estão desligados neste painel.',
    'refused_amount' => 'Isso é mais do que o que resta desta fatura.',
    'refused_no_payment' => 'Nenhum pagamento desta fatura tem tanto por devolver, por isso não há nada que um fornecedor possa reverter. Ponha antes na conta do cliente.',
    'refused_no_gateway' => 'O fornecedor por onde isto foi pago já não está ligado, por isso não se lhe pode pedir para reverter nada. Ponha antes na conta do cliente.',
    'refused_refused' => 'O fornecedor recusou. Costuma ser um pagamento antigo ou um método que não se reverte; o motivo que deram está no registo. Ponha antes na conta do cliente.',
    'refused_note_failed' => 'O dinheiro mudou de sítio mas a nota de crédito não se escreveu, por isso não ficou nada registado. Veja o registo antes de tentar outra vez.',

    // ---- pôr dinheiro na conta --------------------------------------------
    'topup' => 'Adicionar saldo',
    'topup_helper' => 'Tens :held na conta. O que adicionares aqui é descontado da tua próxima fatura sozinho, e qualquer fatura que já tenhas em aberto é liquidada com ele assim que chegar.',
    'topup_go' => 'Continuar para o pagamento',
    'topup_amount_helper' => 'Entre :least e :most.',
    'topup_bad' => 'Esse valor não pode ser pago',
    'topup_failed' => 'Não foi possível iniciar o pagamento. Tenta outra vez, e diz a quem toma conta deste painel se continuar a acontecer.',
    'topup_line' => 'Saldo adicionado à conta',
    'topup_reason' => 'Adicionado na fatura :number',

    // ---- onde aparece -----------------------------------------------------
    'menu' => ':amount de saldo',
    'held_helper' => 'É descontado da tua próxima fatura sozinho. Podes adicionar mais na página de faturação.',
];
