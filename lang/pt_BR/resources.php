<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Mod», «plugin», «loader», «jar» e os nomes de pasta mods/ e plugins/ ficam
 * como estão: são as palavras que aparecem no Modrinth, no gerenciador de
 * arquivos e em qualquer tutorial que se ache sobre isso.
 */

return [
    'nav_label' => 'Mods e plugins',
    'title' => 'Mods e plugins',
    'subheading' => 'Um de cada vez, do Modrinth, para este servidor.',

    'section' => 'Achar alguma coisa',
    'section_helper' => 'A página de modpacks instala um pack inteiro de uma vez. Isto instala um único mod ou plugin, que é o que se quer com muito mais frequência.',

    'kind' => 'O que você está adicionando',
    /*
     * Perguntado e não deduzido. Um egg se chama o que um administrador chamou
     * ele, e vários loaders leem as duas pastas, então daqui não tem jeito
     * honesto de adivinhar - e adivinhar errado grava uma jar em uma pasta que
     * ninguém lê.
     */
    'kind_helper' => 'Um mod vai para mods/ e é para Fabric, Forge ou NeoForge. Um plugin vai para plugins/ e é para Bukkit, Spigot ou Paper. Isso também decide em qual metade do Modrinth se procura.',
    'kind_mod' => 'Um mod (mods/)',
    'kind_plugin' => 'Um plugin (plugins/)',

    'search' => 'Buscar',
    'search_helper' => 'Digite um nome e clique fora do campo. Os resultados vêm pelos mais baixados.',

    'project' => 'Mod ou plugin',
    'version' => 'Versão',
    'version_helper' => 'Cada linha traz o número da versão, as versões do Minecraft para as quais ela foi compilada e os loaders que ela suporta. Escolha uma que sirva no seu servidor - aqui ninguém checa isso por você.',

    'install' => 'Instalar',
    'install_confirm' => 'O arquivo é baixado pelo nó direto do Modrinth e colocado na pasta. Nada do que já está lá é removido.',
    'installed' => 'Instalado',
    'installed_helper' => 'Ele carrega na próxima vez que o servidor iniciar.',

    'change' => 'Trocar de versão',
    'change_helper' => 'Coloca outra versão do mesmo projeto no lugar deste arquivo. A nova é baixada antes de a antiga ser apagada, então um download que falha deixa você com o que já tinha.',
    'change_project_helper' => 'Fixo para tudo o que foi instalado por esta página. Mudar isso não seria uma troca de versão - seria outro mod com o mesmo nome de arquivo.',
    'change_lookup_helper' => 'Este arquivo já estava na pasta, então aqui ninguém sabe o que ele é. Busque uma vez e fica guardado.',
    'changed' => 'Versão trocada',

    'check' => 'Procurar atualizações',
    'checked' => 'Checado',
    'checked_none' => 'Tudo o que é conhecido está na versão mais nova.',
    'checked_some' => ':count têm uma versão mais nova. Estão marcados na lista.',
    'update_ready' => 'v:number disponível',
    /*
     * Dito ao lado do selo e não em uma dica, porque muda o que o selo quer
     * dizer: aqui ninguém sabe qual versão do Minecraft nem qual loader o
     * servidor roda.
     */
    'check_note' => 'Mais novo quer dizer mais novo no Modrinth. Aqui ninguém sabe qual versão do Minecraft nem qual loader seu servidor roda, então confira se a versão escolhida diz que serve antes de iniciar o servidor.',
    'unknown' => 'Não veio daqui - use «Trocar de versão» para dizer o que é',

    'remove' => 'Remover',
    'remove_confirm' => 'O arquivo é apagado do servidor. Isto não dá para desfazer daqui.',
    'removed' => 'Removido',

    'running' => 'O servidor está rodando',
    'running_helper' => 'O Minecraft lê mods/ e plugins/ uma vez só, ao iniciar. Um arquivo adicionado agora só carregaria depois de reiniciar, e um arquivo tirado debaixo de um jogo rodando pode levar o jogo junto. Pare o servidor primeiro.',

    'failed' => 'Isso não deu certo',
    'failed_version' => 'Essa versão não tem nenhuma jar que dê para instalar aqui. Algumas publicações só trazem o código-fonte, ou só um build de cliente.',
    'failed_write' => 'O nó recusou o download. Pode não ter conseguido alcançar o Modrinth.',

    'installed_title' => 'Instalados',
    'installed_mods' => 'Em mods/',
    'installed_plugins' => 'Em plugins/',
    /*
     * Dito porque uma lista vazia é ambígua: normalmente quer dizer que este
     * servidor não usa aquela pasta, e não que esteja faltando alguma coisa.
     */
    'installed_empty' => 'Não tem nada aqui. Um servidor usa só uma dessas duas pastas, então uma estar vazia é normal.',
    'installed_note' => 'Só são listados os arquivos .jar. As pastas de configuração e os arquivos desativados ficam intactos e não são mostrados.',
];
