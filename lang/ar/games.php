<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'حفظ',
    'saved' => 'تم الحفظ',
    'restart' => 'يقرأ اللعبة هذا الملف عند البدء، لذا أعد تشغيل الخادم ليسري التغيير.',
    'failed' => 'تعذر الحفظ',
    'failed_write' => 'رفض الخادم الكتابة. تأكد من إمكانية الوصول إلى الخادم وأن الملف ليس للقراءة فقط.',
    'read_only' => 'يمكنك قراءة هذا الملف لا كتابته، لذا لا يمكن تغيير شيء هنا.',
    'missing' => 'لا يوجد ملف إعدادات لهذا الخادم بعد. تكتبه اللعبة عند أول تشغيل، فشغّل الخادم مرة وستمتلئ هذه الصفحة.',
    'keeps' => 'كل ما تبقى في الملف - التعليقات والأسطر الفارغة والترتيب وكل مفتاح لا تعرفه هذه الإضافة - يبقى كما هو تماماً عند الحفظ.',
    'raw' => 'الأسماء هنا هي أسماء اللعبة، بترتيب الملف. لا شيء مترجم ولا مجمّع، لأن هذه الصفحة تقرأ الملف بدل قائمة كتبها أحد: فتعرض كل إعداد تفهمه اللعبة.',
    'unset' => 'غير محدد. تذكره اللعبة كمثال؛ تعبئته يضيفه.',
    'group_all' => 'الإعدادات',
    'group_all_helper' => 'كل ما يذكره هذا الملف.',
    'subheading' => 'مبني من :files بدل قائمة كتبها أحد.',
];
