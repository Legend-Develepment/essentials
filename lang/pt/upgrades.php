<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * Mudar um serviço a correr de um pacote para outro.
 *
 * O texto mantém uma coisa clara do princípio ao fim: quanto custa um pacote e
 * quanto custa mudar para ele hoje são dois números diferentes. O primeiro está
 * na montra; o segundo depende de quanto falta do período já pago deste
 * serviço, e é esse que a pessoa aceita quando carrega no botão.
 *
 * A palavra «upgrade» é evitada no que o cliente lê, porque metade destas
 * mudanças vai no sentido contrário. Aqui chama-se mudar.
 */

return [
    // ---- no cartão do serviço --------------------------------------------
    'change' => 'Mudar de pacote',
    'change_body' => 'O que falta do período que já pagaste é descontado, e os mesmos dias são cobrados ao preço novo. Não se perde nada do teu servidor.',
    'change_to' => 'Mudar para :name',
    'change_confirm' => 'Mudar este serviço para :name?',
    'change_free' => 'Nada a pagar',
    'costs_now' => ':amount agora',
    'gives_back' => ':amount de volta',
    'waiting' => 'Mudança acordada',
    'waiting_for' => 'Uma mudança para :name está à espera de uma fatura por pagar.',

    // ---- o que acontece a seguir -----------------------------------------
    'done' => 'Passou para :name',
    'done_body' => 'O teu serviço está no pacote novo. O que te ficou a dever está na tua conta.',
    'refused' => 'A mudança não foi feita',

    // ---- e porque não, um motivo de cada vez ------------------------------
    'refused_off' => 'Mudar de pacote está desligado neste painel.',
    'refused_not_active' => 'Só um serviço a correr pode ser mudado. Um que esteja à espera, suspenso ou a terminar não tem nada a acertar.',
    'refused_gone' => 'O pacote em que este serviço está já não existe, por isso não há com que comparar.',
    'refused_same' => 'Esse é o pacote em que já está.',
    'refused_egg' => 'Esse pacote corre software diferente. Seria outro servidor em vez de um maior, por isso tem de ser comprado como tal.',
    'refused_period' => 'Esse pacote é faturado noutro período, o que é outro acordo em vez de um maior.',
    'refused_stock' => 'Esse pacote está esgotado.',
    'refused_waiting' => 'Já há uma mudança à espera de uma fatura por pagar para este serviço. Paga ou cancela essa primeiro.',
    'refused_failed' => 'Não ficou nada registado, por isso nada mudou. Tenta outra vez, e diz a quem toma conta deste painel se continuar a acontecer.',
    'refused_server' => 'Não foi possível dar os limites novos ao servidor, por isso o serviço ficou exatamente como estava. Quem toma conta deste painel já foi avisado.',

    // ---- o que fica nos documentos ---------------------------------------
    'line' => 'Mudança de :from para :to, pelos :days dias que faltam deste período',
    'credit_reason' => 'Mudança para :name',

    // ---- e o que o dono fica a saber -------------------------------------
    'bell_failed' => 'Falhou uma mudança de pacote na encomenda :number',
    'cold_title' => 'Uma mudança de pacote chegou ao painel mas não ao node, na encomenda :number',
    'cold_body' => 'O serviço está em :name e os limites novos estão registados. O node ainda não os assumiu e vai lê-los da próxima vez que esse servidor arrancar, por isso até lá o cliente continua com o tamanho antigo. Veja o node.',
    'gone' => 'O pacote para onde estava a mudar já não existe.',
    'refused_by_node' => 'O servidor não aceitou os limites novos: :why',

    // ---- pôr uma no sítio -------------------------------------------------
    'retry' => 'Tentar a mudança outra vez',
    'retry_confirm' => 'Tenta a mudança de pacote outra vez. A fatura dela já está paga, por isso não se cobra nada duas vezes.',
    'retried' => 'A mudança foi feita',
    'retry_failed' => 'Falhou outra vez. O motivo está na encomenda.',
];
