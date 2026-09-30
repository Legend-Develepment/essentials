<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * As configurações como arquivo: para fora, e de volta.
 *
 * Os arquivos enviados não estão dentro de propósito - veja Support\Portable
 * para entender por que dizê-lo é melhor do que deixá-los de fora em silêncio.
 */

return [
    'export' => 'Exportar configurações',
    'records' => 'Exportar os registros',
    'records_helper' => 'Todos os pacotes, pedidos, faturas, pagamentos e chamados em um arquivo. Remover este plugin apaga tudo isso e o Pelican não pergunta nada antes, então esta é a cópia que se faz de antemão. As chaves de API ficam de fora: uma chave não se restaura de um arquivo, emite-se de novo.',
    'import' => 'Importar configurações',
    'apply' => 'Importar',

    'file' => 'Arquivo de configurações',
    'file_helper' => 'Um arquivo exportado deste plugin. As imagens e os pacotes de ícones não estão dentro - são arquivos em um disco, e ficam como estão.',

    'summary' => 'O que isto mudaria',
    'summary_none' => 'Escolha um arquivo para ver o que mudaria.',
    'summary_unreadable' => 'Isso não é um arquivo de configurações deste plugin, ou não contém nada que este painel reconheça.',
    'summary_same' => 'Nada. Todas as configurações desse arquivo já batem com este painel.',
    'summary_count' => '{1} Uma configuração mudaria.|[2,*] :count configurações mudariam.',
    'summary_more' => '· e mais :count',

    'imported' => 'Configurações importadas',
    'missing' => 'Estas imagens não estão neste painel e ficam de fora: :files',
    'failed' => 'Não foi possível importar esse arquivo',
    'no_file' => 'Nenhum arquivo chegou. Um envio que espera demais antes de clicar em Importar é apagado pelo painel - escolha o arquivo de novo e importe logo em seguida.',
    'denied' => 'Você não tem permissão para mudar estas configurações.',
];
