<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Herkese açık durum sayfası.
 *
 * Bu eklentinin oturum açmamış birine sunduğu tek şey ve sözcüklerinin bir
 * yabancının göreceği gibi okunması gereken tek sayfa - çünkü bir yabancı onları
 * görecek. Burada hiçbir şey hangi node, hangi sahip ya da hangi adres olduğunu
 * söylemez; bir ad, çalışıp çalışmadığı ve kaç kişinin içeride olduğu.
 *
 * "Node" yalnızca ayarlarda geçer; herkese açık sayfanın kendisinde "makine"
 * yazar, çünkü orada onu Pelican'ı hiç duymamış biri okur.
 */

return [
    // ---- ayarlar sayfası ---------------------------------------------------
    'title' => 'Herkese açık durum sayfası',
    'nav_label' => 'Durum sayfası',
    'subheading' => 'Herkesin hesapsız açabildiği ve sunucularından hangilerinin çalıştığını gösteren bir sayfa. Aşağıda bir sunucu anmadığın sürece üzerinde hiçbir şey belirmez.',

    'address' => 'Durum sayfan şu adreste',
    'address_off' => 'Henüz hiçbir şey sunulmuyor. Aşağıya bir sunucu, bir makine ya da bir hizmet ekle ve kaydet, adres burada belirsin.',

    'which' => 'Ne yayımlanıyor',
    'which_helper' => 'Liste boş başlar ve üzerinde bir şey olana dek hiçbir şey herkese açık değildir. Yalnızca zaten açabildiğin sunucular sunulur.',
    'add' => 'Bir sunucu yayımla',
    'server' => 'Sunucu',
    'shown_as' => 'Şöyle görünür',
    'shown_as_helper' => 'Kamunun gördüğü şey. Panelin gerçek adı kullanmasına bırakmak yerine kendin yaz - "mc-prod-3 (dokunma)" kendine bir nottur, bir foruma konacak bir şey değil.',

    'look' => 'İfade',
    'look_helper' => 'Bu sayfadaki her şeyi hesabı olmayan insanlar okur.',
    'heading' => 'Başlık',
    'heading_helper' => 'Boşsa panelin kendi adı kullanılır.',
    'note' => 'Listenin üstünde bir satır',
    'note_helper' => 'Ne olduğunu söylemek için - bir bakım aralığı ya da nereden sorulabileceği. Düz metin.',
    'link' => 'Panele bağlantı',
    'link_helper' => 'Sayfanın altında içeriye dönen bir yol. Panelinin nerede olduğunu ele vermemeyi yeğliyorsan kapat.',

    'save' => 'Kaydet',
    'saved' => 'Kaydedildi',
    'save_failed' => 'Hiçbir şey kaydedilmedi',
    'open' => 'Sayfayı aç',

    // ---- oyuncu sayıları ---------------------------------------------------
    'counts' => 'Oyuncu sayıları',
    'counts_helper' => 'Bir sunucunun yanındaki sayıların nereden geldiği. Minecraft sunucuları kendi el sıkışmalarına yanıt verir ve Minecraft altında ayarlanır; aşağıdaki her şey Valve sorgusuna yanıt veren oyunlar için geçerlidir - Rust, ARK, Valheim, 7 Days to Die ve Source ya da Unreal üzerinde çalışan diğerlerinin çoğu.',
    'query_eggs' => 'Valve sorgusuna yanıt veren egg\'ler',
    'query_eggs_helper' => 'O oyunların egg\'lerini işaretle. Aynı liste, panelin içinde hangi sunucuların Oyuncular sayfası alacağını da belirler - iki nedenle sorulan tek bir soru. Sen söylemeden hiçbir şey sorulmaz: burada panelden doğrudan bir oyun portuna bağlantı açan tek şey bu, yani kendiliğinden başlayan bir şey değil, bir seçim. Portuna panelin ulaşamadığı bir sunucu basitçe sayı göstermez.',

    // ---- node'lar ----------------------------------------------------------
    'nodes' => 'Makineler',
    'nodes_helper' => 'Ayakta ya da değil, başka bir şey yok. Yük değil, diskin ne kadar dolu olduğu da değil - oynayıp oynayamayacağını soran birinin donanımının kapasite raporuna ihtiyacı yoktur ve öyle bir raporu yayımlamak, nerede sıkıştığının haritasıdır.',
    'add_node' => 'Bir makine yayımla',
    'node' => 'Makine',
    'node_shown_as_helper' => 'Kendin yaz. Bir node genellikle hetzner-fsn1-01 gibi bir ad taşır ve bu, makinelerinin nerede durduğu üzerine koca bir cümledir.',

    // ---- HTTP izlemeleri ---------------------------------------------------
    'monitors' => 'Diğer hizmetler',
    'monitors_helper' => 'Ayakta olduğunu bilmeye değer diğer her şey: siten, bir API, bir botun health uç noktası. Panel her birine sunucularla aynı ritimde sorar. Yalnızca yöneticiler - bir izleme bu panele bir adresi çektirir ve herkes bir tane ekleyebilirse, istediğin yere çevirdiğin bir sondaya dönüşür.',
    'add_monitor' => 'Hizmet ekle',
    'monitor_name' => 'Ad',
    'monitor_url' => 'Adres',
    'monitor_url_helper' => 'Yalnızca https. Bu panel düzenli aralıklarla düz http çekseydi, yoldaki herkes hangi hizmetlerinin var olduğunu bilirdi.',
    'monitor_expect' => 'Beklenen',
    'monitor_expect_helper' => '"Herhangi bir yanıt" için boş bırak; bu, yönlendiren ya da çıplak bir isteğe 403 dönen bir siteye uyar. Bir sayı, tam olarak onu söylemek için yazılmış bir uç nokta içindir - çok sıkı ayarlanırsa, hiçbir sorunu olmayan bir hizmette satır sonsuza dek kırmızı durur.',

    // ---- kullanıcılar için sayfalar ----------------------------------------
    'users' => 'Kullanıcıların için sayfalar',
    'users_helper' => 'Bu panelde sunucusu olan insanların kendi durum sayfalarını yayımlayıp yayımlayamayacağı.',
    'user_pages' => 'Kullanıcılar kendilerininkini yapsın',
    'user_pages_helper' => 'Her biri /status/adları altında kendi adresini alır; orada yalnızca sahip olduğu sunucular, kendi yazdığı adlarla durur. Onlarda makine ve başka hizmet olmaz - ikisi de yalnızca senin. Bu açıkken, hangi panelde olurlarsa olsunlar bunu hesap menülerindeki Durum sayfası altında bulurlar.',

    // ---- görünüş -----------------------------------------------------------
    'every' => 'Şu aralıkla denetle',
    'every_helper' => 'Sayfanın ne sıklıkla yeniden kurulduğu ve tarayıcıda kendini ne sıklıkla tazelediği. Bir yeniden başlatma sırasında insanların baktığı bir sayfa saniye ister; bir forumdan bağlanmış ve kimsenin açık tutmadığı bir sayfa bir saat ister ve onun uğruna her node\'a her dakika sormak, kimse için yapılmış bir iştir.',
    'every_realtime' => 'Gerçek zamanlı (10 saniye)',
    'every_30s' => '30 saniye',
    'every_1m' => '1 dakika',
    'every_5m' => '5 dakika',
    'every_10m' => '10 dakika',
    'every_30m' => '30 dakika',
    'every_60m' => '60 dakika',

    'style' => 'Stil',
    'style_helper' => 'Panelin kendi görünümlerinden biri, bu sayfaya uygulanmış: rengi, yüzeyinden kurulan grileri ve köşelerinin ne kadar yuvarlak olduğu. "Paneli izle", bugün ayarlı olan demektir; sonradan değişen her şey dahil.',
    'style_mine_helper' => 'Bu panelin sunduğu stiller, senin sayfana uygulanmış: bir renk, ondan kurulan griler ve köşelerin ne kadar yuvarlak olduğu. Listede hangi stillerin olduğuna panelin sahibi karar verir - Görünüm altında seçebildiğin listenin aynısı. "Paneli izle", ayarlı olan demektir.',
    'style_panel' => 'Paneli izle',

    // ---- kendi sayfan -------------------------------------------------------
    'mine_title' => 'Durum sayfam',
    'mine_nav_label' => 'Durum sayfası',
    'mine_subheading' => 'Sunucularında oynayan insanlara verebileceğin tek bir adres. Seçtiğin sunucuları gösterir ve bu panel hakkında başka hiçbir şeyi göstermez.',
    'mine_address' => 'Adresin',
    'mine_address_helper' => 'Kısa bir şey seç. Sonradan değiştirmek, birinin zaten kaydettiği her bağlantıyı kırar.',
    'mine_address_off' => 'Aşağıdan bir adres seç ve kaydet, sayfan burada belirsin.',
    'slug' => 'Adres',
    'slug_helper' => 'Küçük harfler, rakamlar ve tireler. Üç karakter ya da daha fazla.',
    'mine_heading' => 'Başlık',
    'mine_heading_helper' => 'Boşsa adresin kullanılır.',
    'mine_note_helper' => 'Ne olduğunu söylemek için - bir yeniden başlatma, bir etkinlik, sana nereden ulaşılacağı. Düz metin ve bağlantısı olan herkes okur.',
    'mine_which' => 'Sunucuların',
    'mine_which_helper' => 'Yalnızca kendi sahip olduğun sunucular sunulur. Başka bir yerde subuser olmak bir makineye erişimdir, onun var olduğunu yayımlama izni değil.',
    'mine_shown_as_helper' => 'Ziyaretçilerin gördüğü şey. O ad kendine bir notsa, panelden gelen adı kullanmak yerine kendin yaz.',
    'mine_look_helper' => 'Sayfanın, gönderdiğin insanlara nasıl göründüğü.',
    'mine_remove' => 'Sayfamı kaldır',
    'mine_remove_confirm' => 'Sayfanı indirir ve adresi başka birine bırakır. Ayarladığın her şey kaybolur; sunucuların kendisine dokunulmaz.',
    'mine_removed' => 'Sayfan indirildi',

    'why_slug' => 'O adres olmaz. Küçük harfler, rakamlar ve tireler, üç karakter ya da daha fazla - ve birkaç sözcük ayrılmış durumda.',
    'why_taken' => 'O adres zaten başkasında.',
    'why_unwritable' => 'Yazılamadı. storage/app dizininin panelin çalıştığı kullanıcıya ait olduğunu denetle.',

    // ---- sayfanın kendisindeki başlıklar ------------------------------------
    'section_servers' => 'Sunucular',
    'section_nodes' => 'Makineler',
    'section_monitors' => 'Hizmetler',

    // ---- sayfanın kendisi ---------------------------------------------------
    'up' => 'Ayakta',
    'down' => 'Kapalı',
    'starting' => 'Başlıyor',

    /*
     * "Kapalı" değil ve fark herkese açık olarak önemli.
     *
     * Panel sunucuya ulaşamadı. Bu genellikle bakımdaki bir node ya da yeniden
     * başlayan bir daemon'dur - kapalı bir sunucuyla aynı şey değildir ve yüz
     * oyuncuya sunucuları çalışırken kapalı olduğunu söylemek, bilmediğini
     * kabul etmekten kötüdür.
     */
    'unknown' => 'Bilinmiyor',

    'players' => 'Oyuncular',
    'online_now' => 'şu anda oynuyor',
    'checked' => 'Denetlendi',
    'next_check' => 'sonraki denetime',
    'just_now' => 'az önce',
    'seconds_ago' => ':count saniye önce',
    'panel' => 'Giriş yap',

    'all_up' => 'Her şey çalışıyor.',
    'some_down' => 'Bir şey çalışmıyor.',
    'empty' => 'Burada henüz hiçbir şey yayımlanmıyor.',
];
