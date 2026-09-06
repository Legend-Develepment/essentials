<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Mod», «plugin», «loader», «jar» e os nomes de pasta mods/ e plugins/ ficam
 * como estão: são as palavras que aparecem no Modrinth, no gestor de ficheiros
 * e em qualquer guia que se encontre sobre isto.
 */

return [
    'nav_label' => 'Mods e plugins',
    'title' => 'Mods e plugins',
    'subheading' => 'Um de cada vez, do Modrinth, para este servidor.',

    'section' => 'Encontrar alguma coisa',
    'section_helper' => 'A página de modpacks instala um pack inteiro de uma vez. Isto instala um único mod ou plugin, que é o que se quer muito mais vezes.',

    'kind' => 'O que está a acrescentar',
    /*
     * Perguntado e não deduzido. Um egg chama-se aquilo que um administrador
     * lhe chamou, e vários loaders leem as duas pastas, por isso daqui não há
     * maneira honesta de adivinhar - e adivinhar mal escreve uma jar numa pasta
     * que ninguém lê.
     */
    'kind_helper' => 'Um mod vai para mods/ e é para Fabric, Forge ou NeoForge. Um plugin vai para plugins/ e é para Bukkit, Spigot ou Paper. Isto decide também em que metade do Modrinth se procura.',
    'kind_mod' => 'Um mod (mods/)',
    'kind_plugin' => 'Um plugin (plugins/)',

    'search' => 'Procurar',
    'search_helper' => 'Escreva um nome e clique fora do campo. Os resultados vêm pelos mais descarregados.',

    'project' => 'Mod ou plugin',
    'version' => 'Versão',
    'version_helper' => 'Cada linha traz o número da versão, as versões do Minecraft para que foi construída e os loaders que suporta. Escolha uma que sirva ao seu servidor — aqui ninguém verifica isso por si.',

    'install' => 'Instalar',
    'install_confirm' => 'O ficheiro é obtido pelo nó diretamente do Modrinth e colocado na pasta. Nada do que já lá está é retirado.',
    'installed' => 'Instalado',
    'installed_helper' => 'Carrega no próximo arranque do servidor.',

    'change' => 'Mudar de versão',
    'change_helper' => 'Põe outra versão do mesmo projeto no lugar deste ficheiro. A nova é descarregada antes de a antiga ser apagada, por isso um descarregamento falhado deixa-o com o que já tinha.',
    'change_project_helper' => 'Fixo para tudo o que foi instalado a partir desta página. Mudá-lo não seria uma mudança de versão — seria outro mod com o mesmo nome de ficheiro.',
    'change_lookup_helper' => 'Este ficheiro já estava na pasta, por isso aqui ninguém sabe o que ele é. Procure-o uma vez e fica guardado.',
    'changed' => 'Versão mudada',

    'check' => 'Procurar atualizações',
    'checked' => 'Verificado',
    'checked_none' => 'Tudo o que é conhecido está na sua versão mais recente.',
    'checked_some' => ':count têm uma versão mais recente. Estão assinalados na lista.',
    'update_ready' => 'v:number disponível',
    /*
     * Dito ao lado do distintivo e não numa dica, porque muda o que o
     * distintivo significa: aqui ninguém sabe que versão do Minecraft nem que
     * loader o servidor corre.
     */
    'check_note' => 'Mais recente quer dizer mais recente no Modrinth. Aqui ninguém sabe que versão do Minecraft nem que loader o seu servidor corre, por isso verifique que a versão que escolher diz servir antes de arrancar o servidor.',
    'unknown' => 'Não instalado daqui — use «Mudar de versão» para dizer o que é',

    'remove' => 'Retirar',
    'remove_confirm' => 'O ficheiro é apagado do servidor. Isto não pode ser desfeito daqui.',
    'removed' => 'Retirado',

    'running' => 'O servidor está a correr',
    'running_helper' => 'O Minecraft lê mods/ e plugins/ uma só vez, ao arrancar. Um ficheiro acrescentado agora só carregaria depois de reiniciar, e um retirado por baixo de um jogo a correr pode levar o jogo com ele. Pare primeiro o servidor.',

    'failed' => 'Isso não funcionou',
    'failed_version' => 'Essa versão não tem nenhuma jar que isto consiga instalar. Algumas publicações só trazem o código-fonte, ou só uma compilação de cliente.',
    'failed_write' => 'O nó recusou o descarregamento. Pode não ter conseguido chegar ao Modrinth.',

    'installed_title' => 'Instalados',
    'installed_mods' => 'Em mods/',
    'installed_plugins' => 'Em plugins/',
    /*
     * Dito porque uma lista vazia é ambígua: normalmente quer dizer que este
     * servidor não usa aquela pasta de todo, e não que falte alguma coisa.
     */
    'installed_empty' => 'Aqui não há nada. Um servidor só usa uma destas duas pastas, por isso uma estar vazia é normal.',
    'installed_note' => 'Só são listados os ficheiros .jar. As pastas de configuração e os ficheiros desativados são deixados em paz e não são mostrados.',
];
