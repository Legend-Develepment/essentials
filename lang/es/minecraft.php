<?php

/*
 * Español. Escrito a mano.
 *
 * Los modos de juego y las dificultades no se traducen. Minecraft los muestra
 * dentro del juego como Survival, Creative, Peaceful y Hard - y un ajuste con
 * un nombre distinto al de la pantalla de la que viene es un ajuste que hay que
 * buscar dos veces.
 *
 * Lo mismo vale para los términos que están en el propio server.properties:
 * whitelist, operator, seed, chunk, RCON, query, resource pack y el Nether.
 */

return [
    /* ------------------------------------------- la pestaña de admin ----- */

    'nav_label' => 'Minecraft',
    'title' => 'Ajustes de Minecraft',
    'subheading' => 'El server.properties de este servidor, como formulario en vez de como archivo de texto.',

    /*
     * El título en sí no está aquí. Cada sección de ajustes toma su título de
     * settings.groups.<nombre>, que es lo que construye group().
     */
    'section_helper' => 'A qué eggs se aplica esto, y todo lo demás que este plugin hace alrededor de Minecraft.',

    'live' => 'Preguntar a los servidores quién está jugando',
    'live_helper' => 'Añade a la página de Jugadores una lista en vivo de quién está conectado, con el mismo handshake que hace el cliente de Minecraft para dibujar un servidor en su propia lista. Desactivado por defecto porque es lo único de aquí que abre una conexión del panel directamente a un puerto de juego: si tu panel y tus nodos están en redes que no se alcanzan, no responderá nada y la línea sencillamente no aparecerá. En el servidor de juego no hay que activar nada.',

    'eggs' => 'Qué eggs son Minecraft',
    'eggs_helper' => 'Marca los eggs que ejecutan un servidor de Minecraft - Vanilla, Paper, Purpur, Fabric, Forge, y como se llamen los tuyos. La página aparece dentro de los servidores que los usan, y en ningún otro sitio. Al principio no hay nada marcado, y es a propósito: un plugin no puede saber cómo has llamado a tus eggs, y una lista adivinada estaría equivocada en el panel de alguien la misma semana en que saliera.',

    /* --------------------------------------- la página del servidor ------ */

    'groups' => [
        'general' => 'El servidor',
        'players' => 'Jugadores',
        'world' => 'El mundo',
        'performance' => 'Rendimiento',
        'access' => 'Acceso y extras',
        'other' => 'Todo lo demás del archivo',
    ],

    'other_helper' => 'Leído de server.properties y dejado exactamente como está. Los mods y los modpacks ponen aquí sus propios ajustes; se muestran para que veas que existen, y se cambian con el gestor de archivos. Guardar esta página no los toca nunca.',

    'reload' => 'Leer el archivo otra vez',

    'saved' => 'Guardado en server.properties',
    'saved_helper' => 'Surte efecto la próxima vez que arranque el servidor.',

    'running' => 'El servidor está en marcha',
    'running_helper' => 'Minecraft lee server.properties al arrancar y lo reescribe al detenerse, así que lo que se guarde ahora se sobrescribiría al salir. Detén el servidor y guarda otra vez.',

    'missing' => 'No se encontró ningún server.properties',
    'missing_helper' => 'El archivo aparece cuando se arranca el servidor por primera vez. Arráncalo una vez y vuelve.',

    'failed' => 'No se pudo guardar',
    'failed_helper' => 'El daemon rechazó la escritura. Puede que el servidor haya arrancado mientras esta página estaba abierta.',

    /* --------------------------------- qué significa cada clave ---------- */

    'keys' => [
        'motd' => 'Mensaje en la lista de servidores',
        'gamemode' => 'Modo de juego',
        'difficulty' => 'Dificultad',
        'hardcore' => 'Hardcore - la muerte es definitiva',
        'force_gamemode' => 'Devolver a todos al modo por defecto al entrar',
        'pvp' => 'Los jugadores pueden hacerse daño',

        'max_players' => 'Máximo de jugadores a la vez',
        'white_list' => 'Solo whitelist',
        'enforce_whitelist' => 'Expulsar a quien no esté en la whitelist',
        'online_mode' => 'Comprobar las cuentas con Mojang',
        'player_idle_timeout' => 'Expulsar tras tantos minutos inactivo',
        'op_permission_level' => 'Qué puede hacer un operator (1–4)',

        'level_name' => 'Carpeta del mundo',
        'level_seed' => 'Seed',
        'level_type' => 'Tipo de mundo',
        'allow_nether' => 'El Nether',
        'spawn_monsters' => 'Aparecen monstruos',
        'spawn_protection' => 'Bloques protegidos alrededor del spawn',

        'view_distance' => 'Distancia de visión en chunks',
        'simulation_distance' => 'Distancia de simulación en chunks',
        'max_tick_time' => 'Watchdog, en milisegundos (-1 lo desactiva)',
        'sync_chunk_writes' => 'Escribir los chunks directamente al disco',

        'enable_command_block' => 'Bloques de comandos',
        'allow_flight' => 'Permitir volar',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Dirección del resource pack',
        'require_resource_pack' => 'El resource pack es obligatorio',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
