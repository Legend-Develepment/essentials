<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Modpack», «loader», «egg», «daemon», «mods» e «config» ficam em inglês: são
 * as palavras que aparecem no Modrinth, no gerenciador de arquivos e em
 * qualquer tutorial que se ache sobre isso.
 */

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Instalar um modpack do Modrinth neste servidor.',

    'section' => 'Achar um pack',
    'section_helper' => 'Somente Modrinth, e somente packs de servidor. Ele não pede conta nem chave de API, e é por isso que é a única fonte aqui — as outras querem uma chave colada em algum lugar antes de aparecer qualquer coisa.',

    'search' => 'Buscar',
    'search_helper' => 'Deixe vazio para os mais baixados. Buscar consulta o Modrinth, então acontece quando você sai do campo e não enquanto digita.',

    'pack' => 'Pack',
    'pack_helper' => 'Só são listados os packs que dizem rodar em servidor.',

    'version' => 'Versão',
    'version_helper' => 'A versão do jogo e o loader aparecem ao lado de cada uma. Escolha o loader que o egg deste servidor já roda — isto instala arquivos e não muda seu egg nem seu comando de inicialização.',

    'downloads' => 'downloads',

    'install' => 'Instalar este pack',
    'install_go' => 'Instalar',
    'install_confirm' => 'Os arquivos do pack são adicionados a este servidor. **Nada é apagado** — nem seu mundo, nem seus mods antigos, nem uma config. Um pack instalado em cima de outro deixa os dois, então tire você mesmo os mods do pack anterior antes, se for isso que quer. O servidor precisa estar parado, e continua parado.',

    'started' => 'Instalando',
    'started_helper' => 'O pack está sendo baixado e descompactado. Algumas centenas de arquivos levam alguns minutos, e você recebe uma notificação no fim — continua mesmo se você sair desta página.',

    'running' => 'O servidor está rodando',
    'running_helper' => 'O Minecraft carrega os mods ao iniciar, então um pack instalado agora deixaria um servidor que não é nem o pack velho nem o novo até reiniciar. Pare o servidor e tente de novo.',

    'done' => ':pack instalado',
    'done_body' => ':files arquivos baixados e :overrides itens da pasta própria do pack colocados. Inicie o servidor quando quiser.',
    'done_refused' => ':count arquivos foram pulados porque o pack pedia eles de um lugar de onde daqui não se baixa.',

    'failed' => 'O pack não foi instalado',
    'failed_fetch' => 'Não foi possível baixar ou descompactar o pack. O daemon pode estar inalcançável, ou o servidor pode ter ficado sem disco.',
    'failed_index' => 'O pack foi baixado mas não trazia nenhum índice legível, então não havia nada para instalar.',
    'failed_version' => 'Essa versão não tem mais arquivo de pack para baixar. Escolha outra.',
    'failed_queue' => 'Não foi possível colocar a instalação na fila. Isto precisa de um queue worker rodando no painel.',
];
