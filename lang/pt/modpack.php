<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Modpack», «loader», «egg», «daemon», «mods» e «config» ficam em inglês: são
 * as palavras que aparecem no Modrinth, no gestor de ficheiros e em qualquer
 * guia que se encontre sobre isto.
 */

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Instalar um modpack do Modrinth neste servidor.',

    'section' => 'Encontrar um pack',
    'section_helper' => 'Só Modrinth, e só packs para servidor. Não pede conta nem chave de API, e é por isso que é a única fonte aqui — as outras querem todas uma chave colada algures antes de aparecer o que quer que seja.',

    'search' => 'Procurar',
    'search_helper' => 'Deixe vazio para os mais descarregados. Procurar consulta o Modrinth, por isso acontece quando sai do campo e não enquanto escreve.',

    'pack' => 'Pack',
    'pack_helper' => 'Só são listados os packs que dizem funcionar num servidor.',

    'version' => 'Versão',
    'version_helper' => 'A versão do jogo e o loader aparecem ao lado de cada uma. Escolha o loader que o egg deste servidor já corre — isto instala ficheiros e não muda o seu egg nem o seu comando de arranque.',

    'downloads' => 'descarregamentos',

    'install' => 'Instalar este pack',
    'install_go' => 'Instalar',
    'install_confirm' => 'Os ficheiros do pack são acrescentados a este servidor. **Não é apagado nada** — nem o seu mundo, nem os seus mods antigos, nem uma config. Um pack instalado por cima de outro deixa os dois, por isso retire primeiro os mods do pack anterior se for isso que quer. O servidor tem de estar parado, e continua parado.',

    'started' => 'A instalar',
    'started_helper' => 'O pack está a ser obtido e descompactado. Algumas centenas de ficheiros levam alguns minutos, e recebe uma notificação no fim — continua mesmo que saia desta página.',

    'running' => 'O servidor está a correr',
    'running_helper' => 'O Minecraft carrega os mods ao arrancar, por isso um pack instalado agora deixaria um servidor que não é nem o pack antigo nem o novo até reiniciar. Pare-o e tente outra vez.',

    'done' => ':pack instalado',
    'done_body' => ':files ficheiros obtidos e :overrides itens da pasta própria do pack colocados. Arranque o servidor quando quiser.',
    'done_refused' => 'Foram ignorados :count ficheiros porque o pack pedia-os de um sítio de onde daqui não se descarrega.',

    'failed' => 'O pack não foi instalado',
    'failed_fetch' => 'Não foi possível obter ou descompactar o pack. O daemon pode estar inalcançável, ou o servidor pode ter ficado sem disco.',
    'failed_index' => 'O pack foi obtido mas não trazia nenhum índice legível, por isso não havia nada para instalar.',
    'failed_version' => 'Essa versão já não tem ficheiro de pack para descarregar. Escolha outra.',
    'failed_queue' => 'Não foi possível colocar a instalação na fila. Isto precisa de um queue worker a correr no painel.',
];
