<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Mover um serviço ativo de um pacote para outro.
 *
 * O texto mantém uma coisa clara do começo ao fim: quanto um pacote custa e
 * quanto custa trocar para ele hoje são dois números diferentes. O primeiro
 * está na prateleira; o segundo depende de quanto já passou do período pago
 * deste serviço, e é ele que a pessoa está aceitando quando aperta o botão.
 *
 * A palavra «upgrade» é evitada no que o cliente lê, porque metade dessas
 * mudanças vai para o outro lado. Aqui a palavra é troca.
 */

return [
    // ---- no cartão do serviço --------------------------------------------
    'change' => 'Trocar de pacote',
    'change_body' => 'O que sobrou do período que você já pagou é descontado, e os mesmos dias são cobrados pelo preço novo. Nada do seu servidor é perdido.',
    'change_to' => 'Trocar por :name',
    'change_confirm' => 'Trocar este serviço por :name?',
    'change_free' => 'Nada a pagar',
    'costs_now' => ':amount agora',
    'gives_back' => ':amount de volta',
    'waiting' => 'Troca combinada',
    'waiting_for' => 'Uma troca por :name está esperando uma fatura em aberto.',

    // ---- o que acontece depois -------------------------------------------
    'done' => 'Movido para :name',
    'done_body' => 'Seu serviço está no pacote novo. O que você tinha a receber está na sua conta.',
    'refused' => 'A troca não foi feita',

    // ---- e por que não, um motivo de cada vez -----------------------------
    'refused_off' => 'A troca de pacote está desligada neste painel.',
    'refused_not_active' => 'Só um serviço rodando pode ser trocado. Um que está esperando, suspenso ou encerrando não tem nada a acertar.',
    'refused_gone' => 'O pacote em que este serviço está não existe mais, então não há com o que comparar.',
    'refused_same' => 'É o pacote em que ele já está.',
    'refused_egg' => 'Esse pacote roda outro software. Seria outro servidor e não um servidor maior, então ele tem de ser comprado como um.',
    'refused_period' => 'Esse pacote é cobrado por outro período, e isso é outro acordo e não um acordo maior.',
    'refused_stock' => 'Esse pacote está esgotado.',
    'refused_waiting' => 'Já existe uma troca esperando uma fatura em aberto para este serviço. Pague ou cancele aquela primeiro.',
    'refused_failed' => 'Nada foi registrado, então nada mudou. Tente de novo, e avise quem administra este painel se continuar acontecendo.',
    'refused_server' => 'Não foi possível dar os novos limites ao servidor, então o serviço ficou exatamente como estava. Quem administra este painel já foi avisado.',

    // ---- o que os documentos dizem ----------------------------------------
    'line' => 'Troca de :from para :to, pelos :days dias que faltam deste período',
    'credit_reason' => 'Troca por :name',

    // ---- e o que o dono fica sabendo --------------------------------------
    'bell_failed' => 'Uma troca de pacote falhou no pedido :number',
    'cold_title' => 'Uma troca de pacote chegou ao painel mas não ao node, no pedido :number',
    'cold_body' => 'O serviço está em :name e os novos limites estão registrados. O node ainda não os assumiu e vai lê-los na próxima vez que aquele servidor iniciar, então até lá o cliente continua com o tamanho antigo. Verifique o node.',
    'gone' => 'O pacote para o qual a troca ia não existe mais.',
    'refused_by_node' => 'O servidor não aceitou os novos limites: :why',

    // ---- consertando uma ---------------------------------------------------
    'retry' => 'Tentar a troca de novo',
    'retry_confirm' => 'Tenta a troca de pacote de novo. A fatura dela já está paga, então nada é cobrado duas vezes.',
    'retried' => 'A troca foi feita',
    'retry_failed' => 'Falhou de novo. O motivo está no pedido.',
];
