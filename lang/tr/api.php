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
    'subheading' => 'Panelin dışındaki bir şeyin, bu eklentinin bildiklerini sormasına izin veren anahtarlar. Yalnızca okuma - burada hiçbir şey bir sunucuyu başlatamaz, durduramaz ya da ona ulaşamaz.',

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
    'once_body' => 'Bir hash olarak saklanır, bu yüzden hiç kimse - bu paneli işleten bile - onu geri okuyamaz. Botun ya da betiğin okuduğu yere şimdi yapıştır. Kaybolursa bunu geri çek ve yenisini iste.',
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
    'scope_panel_helper' => 'Panelin tamamını ilgilendiren sorulara yanıt verir - her node, kapasite, bekçi, panelin kendi makinesi. Bir kişi adına değil, panel hakkında rapor veren bir bot için.',

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
    'grant_confirm' => 'Bu kişinin kendi sunucuları için yanıt veren bir anahtar verir ve onu bir kez gösterir. Anahtarın bildireceği her şeyi zaten görüyor - bu, panelin dışındaki bir şeyin onun adına sorup soramayacağına karar verir.',
    'granted' => 'Verildi',

    'refuse' => 'Reddet',
    'refuse_answer' => 'Ne öğrenecekler',
    'refuse_answer_helper' => 'İsteğe bağlı ve kendi sayfalarında gösterilir. Gerekçesiz bir reddediş, gelecek hafta yeniden istenen bir reddediştir.',
    'refused' => 'Reddedildi',
    'collect' => 'Anahtarımı göster',
    'state_ready_body' => 'Verildi. Görmek için Anahtarımı göster düğmesine bas - bir kez, çünkü hash olarak saklanır ve sonradan geri okunamaz.',
    'replace' => 'Değiştir',
    'replace_confirm' => 'Bu anahtar hemen çalışmayı bırakır ve yerini, bir kez gösterilen yenisi alır. Eskisine bakılacak bir yer yok - hiç saklanmadı - bu yüzden onu kaybetmenin tek yanıtı değiştirmektir.',
    'granted_body' => 'Onu kendi API erişimi sayfasından kendisi alır. Burada gösterilmez: bir anahtar, evet diyene değil, onu isteyen kişiye aittir.',

    'revoke' => 'Geri çek',
    'revoke_confirm' => 'Anahtar hemen yanıt vermeyi bırakır ve hash\'i silinir, bu yüzden geri getirilemez. Onu kullanan her şey durur. Bunu geri almak yerine yeni bir tane iste.',
    'revoked' => 'Geri çekildi',
    'forget' => 'Kaldır',
    'forget_confirm' => 'Satırı bu sayfadan temelli çıkarır. Zaten yanıt vermeyi bıraktı, yani çalışan hiçbir şey durmaz - bu yalnızca var olduğu kaydını kaldırır.',
    'forgotten' => 'Kaldırıldı',

    'mint' => 'Yeni anahtar',
    'mint_body' => 'Bir kişi için değil, bir bot için. Oluşturulduğu anda izni alır; çünkü ona evet diyecek olan sensin.',
    'abilities' => 'Neyi sorabilir',
    'abilities_helper' => 'Başlangıçta hepsi işaretlidir, çünkü bu var olmadan önce bir anahtar buydu. Asıl bilinçli davranış, işareti kaldırmaktır. Saklanan şey izin verilenlerin listesidir, bu yüzden sonraki bir sürümde eklenen bir yetenek, ondan önce yapılmış anahtarlar için kapalıdır - kimsenin işaretlemediği bir yetenek, kimsenin vermediği bir yetenektir.',
    'ability_health' => 'Anahtarın çalıştığını kanıtla',
    'ability_health_helper' => 'Başka hiçbir yere ulaşmaz. Zamanlayıcıyla çağırmak güvenlidir.',
    'ability_me' => 'Kendi sunucuları',
    'ability_me_helper' => 'Sahibinin zaten açabildiği sunucular ve onların yedekleri. Başka kimseyi asla göremez.',
    'ability_panel' => 'Panelin tamamı',
    'ability_panel_helper' => 'Her node, her yedek, durmuş zamanlanmış görevler, bekçi ve panelin kendi makinesi. Ayrıca panelin tamamını kapsayan bir anahtar gerektirir.',
    'ability_live' => 'Bir sunucuya doğrudan sor',
    'ability_live_helper' => 'Kimin oynadığı ve bir sunucunun çalışıp çalışmadığı. Bir bedeli olan tek sorular - bir oyun sunucusuna ya da bir daemona ulaşırlar; yanıt on beş ila yirmi saniye saklanır.',
    'ability_connect' => 'Discord hesaplarını panel hesaplarına bağla',
    'ability_connect_helper' => 'Bir okuma olmayan tek grup. İsteyen kişilerin hesaplarında Pelican API anahtarları oluşturur ve bir bağlantıyı sonlandırabilir. Bunu yalnızca gereken bota ver.',
    'own_rate' => 'Bu anahtar için dakikada istek',
    'own_rate_helper' => 'Panel ayarını izlemesi için boş bırak. Buradaki bir sayı yalnızca bu anahtar için geçerlidir. Sıfır, hiç tavan yok demektir - kendi makinendeki bir bot için makul, anahtar başka bir yere giderse pişman olmanın da gerçek bir yolu.',
    'own_rate_default' => 'Paneli izler',
    'mint_owner' => 'Kim olduğu',
    'mint_owner_helper' => 'Bir anahtar biri olarak yanıt verir. Panelin tamamını kapsayan bir anahtar için bu yalnızca ondan kimin sorumlu olduğudur; kişisel bir anahtar içinse anahtarın ne görebileceği de budur.',
    'minted' => 'Oluşturuldu',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Essentials API için bir anahtar',
    'profile_make_helper' => 'Yukarıdakinden başka bir API: bu, bu eklentinin bildiklerine yanıt verir - sunucularından hangisinin yedeği yok, üzerlerinde kim oynuyor, çalışıyorlar mı. Her zaman yalnızca senin adına yanıt verir ve yalnızca zaten açabildiğin sunuculara ulaşır.',
    'profile_create' => 'Oluştur',
    'profile_yours' => 'Essentials anahtarların',
    'profile_manage' => 'Bir anahtarı geri çekmek, birinin neden reddedildiğini görmek ve Discord bağlamak; hepsi kenar çubuğundaki API erişimi sayfasında.',
    'discord' => 'Discord',
    'discord_body' => 'Discord hesabını buna bağla; böylece istediğinde bir bot senin sunucuların için yanıt verebilir. Aldığı şey, tam olarak senin ulaştığın yere ulaşan ve fazlasına ulaşmayan bir anahtardır.',
    'discord_connect' => 'Discord bağla',
    'discord_code' => 'Bunu on dakika içinde Discord\'da yaz',
    'discord_code_body' => ':command komutunu, botun okuyabildiği bir kanalda gönder. Kod bir kez işler. Onu, yapıldığı hesaptan başkası kullanamaz.',
    'discord_on' => ':name olarak bağlı',
    'discord_since' => ':when tarihinden beri',
    'discord_cut' => 'Bağlantı kesildi',
    'discord_cut_confirm' => 'Bağlantıyı sonlandırır ve onun oluşturduğu anahtarı siler; böylece bot senin adına yanıt vermeyi hemen bırakır. İstediğin zaman yeniden bağlanabilirsin.',
    'discord_off' => 'Bağlı değil',
    'discord_key_note' => 'Bağlanmak, hesabında Discord (Essentials) adlı bir Pelican API anahtarı oluşturur. Onu Hesap → API anahtarları altında görebilir ve geri çekebilirsin - bu sayfa yalnızca aynı şeye giden bir kısayol.',
    'docs_title' => 'Bu API nasıl kullanılır',
    'docs_subheading' => 'Bu panelin neye, hangi adreslerde yanıt verdiği. API\'nin kendisinden üretildiği tanımın aynısından yazıldı, bu yüzden ondan bir sürüm geride kalamaz.',
    'docs_base' => 'Nerede bulunur',
    'docs_endpoints' => 'Endpointler',
    'docs_answers' => 'Ne dönüyor',
    'docs_calls' => 'Onu çağırabilecek anahtarlar',
    'docs_params' => 'Ne gönderilecek',
    'docs_required' => 'zorunlu',
    'docs_optional' => 'isteğe bağlı',
    'docs_try' => 'Dene',
    'docs_errors' => 'Bir şey yolunda gitmediğinde',
    'docs_hook' => 'Panelin sana gönderdikleri',
    'docs_hook_body' => 'Öteki yön ve bunun, istenmeden gelen tek parçası. Uyarılar altında bir adres ve bir imzalama sırrı ile açılır: bekçi bir şey bulduğunda bir JSON gönderisi, o düzeldiğinde bir tane daha. Böylece bir bot, ölü bir node var mı diye her dakika sormak yerine bunu duyar.',
    'docs_hook_verify' => 'Gövde senin sırrınla hashlenir ve hash, X-Essentials-Signature içinde sha256=<hex> olarak gider. Yeniden serileştirilmiş bir nesneyi değil, ham gövdeyi hashle - boşluklardaki ya da anahtar sırasındaki en küçük fark başka bir hash verir ve uyuşmazlık, bir hatadan çok bir saldırı gibi okunur.',
    'docs_download_md' => 'Markdown olarak indir',
    'docs_download_json' => 'OpenAPI olarak indir',

    // ---- bir yöneticinin ayarladıkları -----------------------------------
    'settings' => 'Bu böyle çalışır',
    'approval' => 'İstekler izin bekler',
    'approval_helper' => 'Açık: anahtar isteyen, biri evet dediğinde alır. Kapalı: hemen alır - hesabı olan herkesin zaten güvenilir olduğu bir panelde bu makuldür ve içine düşülmek yerine seçilmeye değer.',
    'rate' => 'Anahtar başına dakikada istek',
    'rate_helper' => 'Kırk sunucuya kimin oynadığını soran bir bot, kırk oyun sunucusuna kırk soru demektir. Bu, gecenin üçünde yazılmış bir döngünün bir yük testine dönüşmesini engelleyen tavandır.',
    'days' => 'Verilen bir anahtar şu kadar sürer',
    'days_helper' => 'Gün olarak. Sıfır, geri çekilene dek demektir ve varsayılan da budur - kimse bakmazken sona eren bir anahtar, gece duran ve nedenini hiçbir yerde söylemeyen bir bottur.',
    'days_never' => 'Geri çekilene dek',
    'hide_pelican' => 'Panelin kendi API anahtarları sekmesini kaldır',
    'hide_pelican_helper' => 'API anahtarları sekmesini hesap profilinden tümüyle çıkarır; böylece o sayfada API anahtarları adında tek bir şey kalır. Üzeri boyanmak yerine sayfadan kaldırılır, yani ona ulaşan bir adres de kalmaz. Yapamadığı bir şey var: panelin kendi istemci API\'si, doğrudan isteyen her şeye hâlâ bir hesap anahtarı üretir - sekme, insanların bunu elle yaptığı yerdir ve bu, eli ortadan kaldırır. Zaten var olan anahtarlar çalışmayı sürdürür.',

    /*
     * Keşfedilmeye bırakılmadı, sayfada söylendi. Pelican bir eklenti
     * kaldırıldığında onun göçlerini geri alır ve bu eklentinin tek tablosu da
     * onlarla birlikte gider.
     */
    'uninstall_note' => 'Bu eklentiyi kaldırmak, onunla birlikte her anahtarı da kaldırır. Bu bilerek - kendisine yanıt veren şeyden daha uzun yaşayan bir anahtar, kimsenin geri çekemeyeceği bir oturumdur.',
];
