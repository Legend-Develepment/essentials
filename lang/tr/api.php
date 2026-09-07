<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Dışarıdan içeriye bir yol.
 *
 * Tek bir dosyada iki tür okur ve her biri başka bir şey istiyor. Bu sayfayı
 * okuyan bir yönetici, birine bir anahtar emanet etmeye cesaret edip
 * etmeyeceğine karar veriyor; bu yüzden buradaki her satır, bir anahtarın nereye
 * ulaştığını söyler, adının ne olduğunu değil. Bir anahtar isteyen ise eline ne
 * geçtiğini ve kaybederse ne olacağını bilmek ister; bu yüzden bir anahtarın
 * yalnızca bir kez gösterildiği cümlesi bir dipnot değildir.
 *
 * Burada hiçbir şey "token" demez. "Anahtar", Pelican'ın kendi hesap
 * sayfasındaki sözcüktür ve aynı şeye iki ad veren bir panel, birinin yanlış
 * şeyi aradığı bir paneldir.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Panelin dışındaki bir şeyin, bu eklentinin bildiklerini sormasına izin veren anahtarlar. Yalnızca okuma — burada hiçbir şey bir sunucuyu başlatamaz, durduramaz ya da ona ulaşamaz.',

    'my_title' => 'API erişimi',
    'my_nav_label' => 'API erişimi',
    'my_subheading' => 'Bir bot ya da bir betik için kendine ait bir anahtar. Yalnızca zaten açabildiğin sunucular için yanıt verir.',

    // ---- bir anahtar nedir; bir kez, önemli olduğu yerde ---------------
    'address' => 'Adres',
    'address_helper' => 'Anahtarı bir Authorization başlığı olarak gönder: :example',

    /*
     * Pencere kapanmadan önce birinin okumuş olması gereken tek şey. Bir uyarı
     * olarak değil, ne yapılacağı olarak yazıldı; çünkü "onu iyi sakla" kimsenin
     * üzerine hareket edemeyeceği bir öğüttür, "onu botun okuduğu yere yapıştır,
     * şimdi" ise öyle değildir.
     */
    'once' => 'Bu anahtarın gösterildiği tek sefer bu',
    'once_body' => 'Bir hash olarak saklanır, bu yüzden hiç kimse — bu paneli işleten bile — onu geri okuyamaz. Botun ya da betiğin okuduğu yere şimdi yapıştır. Kaybolursa bunu geri çek ve yenisini iste.',
    'copy' => 'Kopyala',
    'copied' => 'Kopyalandı',

    // ---- durumlar --------------------------------------------------------
    'state' => 'Durum',
    'state_pending' => 'Bekliyor',
    'state_active' => 'Etkin',
    'state_refused' => 'Reddedildi',
    'state_revoked' => 'Geri çekildi',

    'state_pending_body' => 'Herhangi bir şeye yanıt vermeden önce birinin izin vermesi gerekiyor.',
    'state_refused_body' => 'Buna hayır dendi. Hiçbir şey verilmedi.',
    'state_revoked_body' => 'Bu anahtar alındı ve artık yanıt vermiyor.',

    // ---- kapsam ----------------------------------------------------------
    'scope' => 'Nereye ulaşır',
    'scope_person' => 'Kendi sunucularına',
    'scope_panel' => 'Panelin tamamına',

    'scope_person_helper' => 'Yalnızca sahibin zaten açabildiği sunucular için, panelin sorduğu biçimde sorularak yanıt verir. Bu anahtarı kaybetmek, sahibinin zaten göremeyeceği hiçbir şeyi kaybetmez.',
    'scope_panel_helper' => 'Panelin tamamını ilgilendiren sorulara yanıt verir — her node, kapasite, bekçi, panelin kendi makinesi. Bir kişi adına değil, panel hakkında rapor veren bir bot için.',

    // ---- tablo -----------------------------------------------------------
    'column_name' => 'Ne için',
    'column_owner' => 'Kimin',
    'column_prefix' => 'Anahtar',
    'column_asked' => 'İstendi',
    'column_used' => 'Son kullanım',
    'column_expires' => 'Sona erer',

    'never_used' => 'Hiç',
    'no_expiry' => 'Geri çekilene dek',

    'tab_waiting' => 'Bekliyor',
    'tab_active' => 'Etkin',
    'tab_all' => 'Tümü',

    'empty' => 'Henüz anahtar yok',
    'empty_body' => 'Kimse istemedi ve hiçbiri verilmedi. Bu sayfa, insanlar bunu yaptıkça kendi kendini doldurur.',

    'my_empty' => 'Anahtarın yok',
    'my_empty_body' => 'Bir tane iste, aldığı yanıtla birlikte burada belirsin.',

    // ---- istemek ---------------------------------------------------------
    'ask' => 'Bir anahtar iste',
    'ask_name' => 'Ne için kullanılacak',
    'ask_name_helper' => 'Birkaç sözcük; ki sonradan kendi anahtarlarından ikisini ayırt edebilesin ve izin veren neye izin verdiğini bilsin.',
    'ask_reason' => 'Eklemeye değer bir şey',
    'ask_reason_helper' => 'İsteğe bağlı. Bunu karar veren okur.',
    'ask_sent' => 'İstendi',
    'ask_sent_body' => 'Biri yanıt verir vermez aşağıda belirir.',
    'ask_granted' => 'İşte anahtarın',
    'ask_open' => 'Yanıt bekleyen bir tane zaten var',
    'ask_open_body' => 'Bir seferde bir istek. Yanlışlıksa geri çek.',
    'ask_failed' => 'İstek yapılamadı',

    'cancel' => 'Vazgeç',
    'cancel_confirm' => 'İsteği geri çeker. Hiçbir şey verilmedi, bu yüzden çalışmayı bırakan bir şey de olmaz.',

    // ---- karar vermek ----------------------------------------------------
    'grant' => 'İzin ver',
    'grant_confirm' => 'Bu kişinin kendi sunucuları için yanıt veren bir anahtar verir ve onu bir kez gösterir. Anahtarın bildireceği her şeyi zaten görüyor — bu, panelin dışındaki bir şeyin onun adına sorup soramayacağına karar verir.',
    'granted' => 'Verildi',

    'refuse' => 'Reddet',
    'refuse_answer' => 'Ne öğrenecekler',
    'refuse_answer_helper' => 'İsteğe bağlı ve kendi sayfalarında gösterilir. Gerekçesiz bir reddediş, gelecek hafta yeniden istenen bir reddediştir.',
    'refused' => 'Reddedildi',

    'revoke' => 'Geri çek',
    'revoke_confirm' => 'Anahtar hemen yanıt vermeyi bırakır ve hash\'i silinir, bu yüzden geri getirilemez. Onu kullanan her şey durur. Bunu geri almak yerine yeni bir tane iste.',
    'revoked' => 'Geri çekildi',

    'mint' => 'Yeni anahtar',
    'mint_body' => 'Bir kişi için değil, bir bot için. Oluşturulduğu anda izni alır; çünkü ona evet diyecek olan sensin.',
    'mint_owner' => 'Kim olduğu',
    'mint_owner_helper' => 'Bir anahtar biri olarak yanıt verir. Panelin tamamını kapsayan bir anahtar için bu yalnızca ondan kimin sorumlu olduğudur; kişisel bir anahtar içinse anahtarın ne görebileceği de budur.',
    'minted' => 'Oluşturuldu',

    // ---- bir yöneticinin ayarladıkları -----------------------------------
    'settings' => 'Bu böyle çalışır',
    'approval' => 'İstekler izin bekler',
    'approval_helper' => 'Açık: anahtar isteyen, biri evet dediğinde alır. Kapalı: hemen alır — hesabı olan herkesin zaten güvenilir olduğu bir panelde bu makuldür ve içine düşülmek yerine seçilmeye değer.',
    'rate' => 'Anahtar başına dakikada istek',
    'rate_helper' => 'Kırk sunucuya kimin oynadığını soran bir bot, kırk oyun sunucusuna kırk soru demektir. Bu, gecenin üçünde yazılmış bir döngünün bir yük testine dönüşmesini engelleyen tavandır.',
    'days' => 'Verilen bir anahtar şu kadar sürer',
    'days_helper' => 'Gün olarak. Sıfır, geri çekilene dek demektir ve varsayılan da budur — kimse bakmazken sona eren bir anahtar, gece duran ve nedenini hiçbir yerde söylemeyen bir bottur.',
    'days_never' => 'Geri çekilene dek',

    /*
     * Keşfedilmeye bırakılmadı, sayfada söylendi. Pelican bir eklenti
     * kaldırıldığında onun göçlerini geri alır ve bu eklentinin tek tablosu da
     * onlarla birlikte gider.
     */
    'uninstall_note' => 'Bu eklentiyi kaldırmak, onunla birlikte her anahtarı da kaldırır. Bu bilerek — kendisine yanıt veren şeyden daha uzun yaşayan bir anahtar, kimsenin geri çekemeyeceği bir oturumdur.',
];
