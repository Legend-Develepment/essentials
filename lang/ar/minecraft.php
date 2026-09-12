<?php

/*
 * العربية. مكتوبة يدوياً.
 *
 * أنماط اللعب ومستويات الصعوبة لا تُترجم. فـ Minecraft يعرضها داخل اللعبة
 * Survival و Creative و Peaceful و Hard - وإعداد باسم غير الاسم الذي جاء منه هو
 * إعداد تبحث عنه مرتين.
 *
 * والأمر نفسه في الكلمات المكتوبة داخل server.properties: whitelist و operator و
 * seed و chunk و RCON و query و resource pack و the Nether.
 */

return [
    /* ---------------------------------------------- تبويب الإدارة -------- */

    'nav_label' => 'Minecraft',
    'title' => 'إعدادات Minecraft',
    'subheading' => 'ملف server.properties الخاص بهذا الخادم، في هيئة نموذج بدل ملف نصي.',

    /*
     * العنوان ليس هنا. كل قسم إعدادات يأخذ عنوانه من settings.groups.<الاسم>، وهو ما
     * تبنيه group()؛ أما النسخة الثانية تحت مفتاح 'section' في هذا الملف فلم يكن
     * يستعملها شيء طوال غياب الأصل بالكامل.
     */
    'section_helper' => 'على أي egg ينطبق هذا، وكل ما تفعله هذه الإضافة حول Minecraft.',

    'live' => 'اسأل الخوادم من يلعب',
    'live_helper' => 'يضيف إلى صفحة «اللاعبون» قائمة حيّة بمن هم متصلون، بالمصافحة نفسها التي يجريها عميل Minecraft ليرسم خادماً في قائمته. مطفأ افتراضياً لأنه الشيء الوحيد هنا الذي يفتح اتصالاً من اللوحة مباشرة إلى منفذ لعبة: فإن كانت لوحتك وعُقدك على شبكتين لا تصل إحداهما إلى الأخرى فلن يجيب شيء، ولن يظهر ذلك السطر ببساطة. ولا يلزم تفعيل شيء على خادم اللعبة نفسه.',

    'eggs' => 'أي egg هو Minecraft',
    'eggs_helper' => 'أشِّر على الـ egg التي تشغّل خادم Minecraft - Vanilla و Paper و Purpur و Fabric و Forge، وما سمّيت به خوادمك. تظهر الصفحة داخل الخوادم التي تستعملها ولا تظهر في غيرها. ولا شيء مؤشَّر في البداية، عن قصد: فالإضافة لا تعرف ما سمّيت به الـ egg عندك، وقائمة مخمّنة ستكون خاطئة على لوحة أحدهم في الأسبوع الذي تصدر فيه.',

    /* -------------------------------------------- صفحة الخادم ------------ */

    'groups' => [
        'general' => 'الخادم',
        'players' => 'اللاعبون',
        'world' => 'العالم',
        'performance' => 'الأداء',
        'access' => 'الوصول والإضافات',
        'other' => 'كل ما سواه في الملف',
    ],

    'other_helper' => 'يُقرأ من server.properties ويُترك تماماً كما هو. والـ mod والـ modpack تضع إعداداتها هنا؛ تُعرض لتعرف أنها موجودة، وتُغيَّر من مدير الملفات. وحفظ هذه الصفحة لا يمسّها أبداً.',

    'reload' => 'اقرأ الملف من جديد',

    'saved' => 'حُفظ في server.properties',
    'saved_helper' => 'يسري في المرة القادمة التي يعمل فيها الخادم.',

    'running' => 'الخادم يعمل',
    'running_helper' => 'يقرأ Minecraft ملف server.properties عند التشغيل ويكتبه من جديد عند التوقف، فما يُحفظ الآن سيُطمس عند خروجه. أوقف الخادم ثم احفظ من جديد.',

    'missing' => 'لم يُعثر على server.properties',
    'missing_helper' => 'يظهر هذا الملف عند تشغيل الخادم أول مرة. شغّله مرة ثم عُد.',

    'failed' => 'تعذّر الحفظ',
    'failed_helper' => 'رفض الـ daemon الكتابة. ربما بدأ الخادم بينما كانت هذه الصفحة مفتوحة.',

    /* ------------------------------------ ماذا يعني كل مفتاح ------------- */

    'keys' => [
        'motd' => 'السطر الظاهر في قائمة الخوادم',
        'gamemode' => 'نمط اللعب',
        'difficulty' => 'الصعوبة',
        'hardcore' => 'Hardcore - الموت نهائي',
        'force_gamemode' => 'أعد الجميع إلى النمط الافتراضي عند الدخول',
        'pvp' => 'يستطيع اللاعبون إيذاء بعضهم',

        'max_players' => 'أقصى عدد في وقت واحد',
        'white_list' => 'الـ whitelist وحدها',
        'enforce_whitelist' => 'اطرد كل من ليس في الـ whitelist',
        'online_mode' => 'تحقّق من الحسابات لدى Mojang',
        'player_idle_timeout' => 'اطرد بعد كم دقيقة من الخمول',
        'op_permission_level' => 'ما يستطيعه الـ operator (1–4)',

        'level_name' => 'مجلد العالم',
        'level_seed' => 'Seed',
        'level_type' => 'نوع العالم',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'ظهور الوحوش',
        'spawn_protection' => 'المكعبات المحمية حول الـ spawn',

        'view_distance' => 'مدى الرؤية بالـ chunk',
        'simulation_distance' => 'مدى المحاكاة بالـ chunk',
        'max_tick_time' => 'Watchdog، بالمللي ثانية (-1 يطفئه)',
        'sync_chunk_writes' => 'اكتب الـ chunk إلى القرص مباشرة',

        'enable_command_block' => 'مكعبات الأوامر',
        'allow_flight' => 'اسمح بالطيران',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'عنوان الـ resource pack',
        'require_resource_pack' => 'الـ resource pack إلزامي',
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
