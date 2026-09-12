<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Egg", "node", "subuser", "Wings", "queue", "webhook", "topbar", "cron" ve
 * dosya biçimlerinin adları olduğu gibi kalıyor: onları Pelican'da, makinede ve
 * haklarında yazılan her şeyde bu adlarla bulursun. Stillerin adları da
 * çevrilmiyor - bir stilin adı neyse odur ve çevrilmiş bir ad, aynı şeye
 * verilmiş bir ad daha olurdu.
 */

return [
    'css_warning' => 'Kaydedildi, ama bu CSS yanlış görünüyor',
    'css_unclosed' => ':line satırında açılan bir kural hiç kapanmıyor. Ondan sonraki her şey o kuralın içinde duruyor ve hiçbir etkisi yok.',
    'css_extra' => ':line satırında, hiçbir şey açık değilken bir kapanış küme parantezi var. Ondan sonraki her şey her kuralın dışında duruyor ve atlanıyor.',
    'css_comment' => ':line satırında açılan bir açıklama hiç kapanmıyor, bu yüzden dosyanın geri kalanı onun içinde duruyor.',

    'groups' => [
        'appearance' => 'Görünüm',
        'servers' => 'Sunucu listesi',
        'windows' => 'Saate göre stiller',
        'windows_helper' => 'Günün iki saati arasında başka bir stil. Bir tane eklemeden hiçbir şey olmaz. Saat, her okurun değil, panelin kendi saati; onun saat dilimi ayarından gelir - aynı anda iki insana farklı görünen bir panel, planlanmış bir şeyden çok bozuk bir şeye benzerdi. Bir aralık, panelin zaten sahip olduğu görünümü değiştirir; bu yüzden stil "Yok" iken hiçbir şey yapmaz. Birinin kendisi için seçtiği bir stil yine de onu yener.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Diller',
        'files_where' => 'Dosyaların tutulduğu yer',
        'files_bucket' => 'Bucket',
        'files_cdn' => 'CDN',
        'files_mirror' => 'Diller, panelin dışında tutulanlar',
        'servers_helper' => 'Bir sunucu kartının nasıl çizildiği. Izgara mı liste mi olarak göründükleri herkesin kendi seçimi, Hesap → Genel bakış düzeni altında.',
        'server_pages' => 'Sunucu sayfaları',
        'server_pages_helper' => 'Bir sunucunun içindeki her sayfanın neyi taşıdığı; hangi sayfa olursa olsun.',
        'console' => 'Konsol sayfası',
        'console_helper' => 'Terminalin kendi yazı tipi, boyutu ve yüksekliği herkesin kendi seçimi, Hesap altında.',
        'background' => 'Arka plan',
        'background_helper' => 'Giriş ekranı dahil, panelin tamamı için geçerli.',
        'icons' => 'Simgeler',
        'bars' => 'Kaynak göstergeleri',
        'bars_helper' => 'Sunucu kartlarındaki işlemci, bellek ve disk çubukları.',
        'updates' => 'Güncellemeler',
        'updates_helper' => 'Tema sayfasının hangi sürümleri sunduğu ve onları nerede aradığı.',
        'brand' => 'Marka',
        'login' => 'Giriş ekranı',
        'login_helper' => 'Giriş, parola sıfırlama ve iki adımlı doğrulama ekranları için geçerli.',
        'advanced' => 'Kendi CSS\'in',
        'advanced_helper' => 'Yukarıdaki ayarların kapsamadığı her şey için. Diğer her şeyden sonra yüklenir, bu yüzden o kazanır.',
        'areas' => 'Alana göre',
        'areas_helper' => 'Yukarıdaki her şey her yerde geçerli. Burada bir alanı ayırabilirsin; boş bıraktığın her şey yine ortak ayarı izler.',
        'footer' => 'Kenar çubuğunun altı',
        'footer_helper' => 'Pelican\'ın boş bıraktığı kenar çubuğunun alt kısmı. Sen doldurana dek buradaki her şey kapalı.',
        'features' => 'Bu eklentinin eklediği şeyler',
        'features_helper' => 'Bir şeyin işaretini kaldırırsan, o panelden tamamen kaybolur. Ayarları saklanır ve sayfası adresini korur, bu yüzden ne yaptığını görmek için bir şeyi kapatmakla hiçbir şey kaybolmaz. Çoğunun Roller altında kendi izni de var, bu yüzden birini ötekileri vermeden verebilirsin. Hepsinin değil: kaynak göstergeleri, kenar çubuğunun altı ve ayarlardaki arama herkes için çizilir ve kimse onları denetlemez; bir sunucu kartındaki yıldız ona tıklayana aittir; bir sunucunun içindeki Palworld ve Minecraft sayfaları ise bunlardan birini değil, o sunucunun kendi izinlerini izler. Görünümün kendisi listede değil - kendi düğmesi var, Look → Görünüm → Stil → Yok altında.',
        'identity' => 'Bu eklenti kenar çubuğunda',
        'identity_helper' => 'Bu eklentinin kenar çubuğuna eklediği satır ve üzerindeki görsel.',
    ],

    /*
     * Ayar sayfaları; her biri, eklentinin kenar çubuğundaki kendi grubunda bir
     * satır. Onları oluşturan sınıfa göre değil, yanıtladığın soruya göre
     * gruplandı.
     */
    /*
     * Bu eklentinin tuttuğu dosyaların nereye konduğu.
     *
     * Sözler bir sağlayıcıdan değil bir hedeften söz ediyor, çünkü aynı üç
     * cümle hem bir bucket hem de bir CDN için doğru ve birini kuran yönetici,
     * alanlar ayrışana dek hangisine baktığını umursamıyor.
     */
    'files' => [
        'where' => 'Dosyalar şurada tutulur',
        'where_helper' => 'Panelde, panelin kendi diskinde dururlar; hep oraya gittiler ve bunun için bir şey kurmak gerekmez. Başka bir yer, bu panelin onları tutmak zorunda olmadığı ve bakan kişiye daha yakından sunulan bir yerdir. Yanıt vermeyen bir hedef, bir yüklemeyi kaybetmek yerine panele geri düşer.',
        'panel' => 'Bu panelde',
        's3' => 'Bir bucket\'ta (S3, R2, MinIO, Wasabi)',
        'cdn' => 'Bir CDN\'de',
        'read_from' => 'Şuradan oku',
        'read_from_helper' => 'Bir dosyanın nereden alındığı; bu her zaman yazıldığı yer değildir. Bir bucket\'ın önündeki CDN buraya yazılır, API\'nin bulunduğundan başka bir dağıtım adresi de öyle. Boş bırakırsan hedef bunu kendi çözer.',

        'bucket' => 'Bucket',
        'bucket_helper' => 'S3 protokolünü konuşan her şey. Endpoint ve path-style düğmesi, AWS olmayanların gerek duyduğu şeylerdir; AWS\'nin kendisi için ikisine de dokunma.',
        'bucket_key' => 'Erişim anahtarı',
        'bucket_secret' => 'Gizli anahtar',
        'bucket_name' => 'Bucket adı',
        'bucket_region' => 'Bölge',
        'bucket_region_helper' => 'auto, R2\'ye ve kendi makinende barındırılanların çoğuna uyar. AWS kendine ait bir bölge ister, eu-central-1 gibi.',
        'bucket_endpoint' => 'Endpoint',
        'bucket_endpoint_helper' => 'AWS için boş bırak. R2, MinIO ve geri kalanların her birinin kendi endpoint\'i var.',
        'bucket_path_style' => 'Path-style adresler',
        'bucket_path_style_helper' => 'MinIO\'nun ve kendi makinende barındırılanların çoğunun gerek duyduğu şey. AWS ile R2 duymaz.',

        'cdn_title' => 'CDN',
        'cdn_helper' => 'Modora API\'sini konuşan bir CDN. Token, sunucudan sunucuya kullanılan bir token\'dır ve o hesapta tam yetkilidir; bu yüzden buradaki her kimlik bilgisi gibi dışa aktarılan ayar dosyasının dışında tutulur.',
        'cdn_base' => 'Adres',
        'cdn_base_helper' => 'API\'nin bulunduğu yer. Dosyalar başka bir yerden sunuluyorsa, o adresi yukarıdaki "Şuradan oku" alanına yaz.',
        'cdn_token' => 'Token',
        'cdn_token_helper' => 'X-Internal-Token olarak gönderilir. Elinde tutan herkes hesabın tamamına yazabilir ve ondan silebilir.',
        'cdn_folder' => 'Klasör',
        'cdn_folder_helper' => 'Bu panelin dosyalarını tutmak için hesabın altında bir klasör; böylece tek bir CDN, birbirine karışmadan birkaç panele hizmet edebilir.',

        'move' => 'Hâlâ panelde olanları taşı',
        'move_confirm' => 'Kenar çubuğu simgesi, panelin arka planı ve giriş ekranının arka planı hedefe kopyalanır ve adresleri yeniden yazılır. Bu paneldeki kopyalar oldukları yerde bırakılır, böylece fikrini değiştirirsen hiçbir şey bozulmaz. Bundan sonra yüklenen görseller zaten hedefe gider; bu, yalnızca hâlihazırda burada olanlar için.',
        'move_done' => 'Taşındı',
        'move_done_body' => 'Bakılan :looked, taşınan :moved, taşınamayan :failed.',
        'check' => 'Bunu dene',
        'check_ok' => 'Çalışıyor',
        'check_ok_body' => 'Bir dosya yazıldı, herkese açık adresinden geri alındı ve yeniden silindi.',
        'check_bad' => 'Bu işe yaramadı',
        'check_panel' => 'Dosyalar bu panelde tutulacak biçimde ayarlı, bu yüzden denenecek bir şey yok.',
        'check_refused' => 'Hedef dosyayı reddetti ve nedeni konusunda hiçbir şey söylemedi.',
        'check_unreadable' => 'Dosyayı aldı, ama :url adresinden geri okunamadı. Bir tarayıcının kullanacağı adres tam olarak budur, yani kimsenin alamadığı bir dosya sonradan bozuk bir görsel demektir. "Şuradan oku" alanını ve hedefin dosyaları herkese açık sunup sunmadığını denetle.',
        'bucket_missing' => 'Denenecek bir şey olması için anahtar, gizli anahtar ve bucket adının üçü de gerekli.',
        'cdn_missing' => 'Denenecek bir şey olması için hem adres hem de token gerekli.',
        'cdn_shape' => 'Dosyayı kabul etti ve ardından bu panelin içinde bir adres bulamadığı bir biçimde yanıt verdi. Söylediği şuydu: :body',
        'mirror_minutes' => 'Değişen dilleri şu aralıkla ara',
        'mirror_minutes_helper' => 'Dakika olarak. Aramak ucuzdur: yüklenen her dil okunur, hashlenir ve en son gönderilenle karşılaştırılır, bu yüzden sıradan bir tur hiçbir şey göndermez. Yalnızca birinin değiştirdiği bir dil hattı geçer.',
        'mirror_now' => 'Dilleri şimdi kopyala',
        'mirror_done' => 'Diller kopyalandı',
        'mirror_done_body' => 'Bakılan :looked, gönderilen :sent, gönderilemeyen :failed.',
        'mirror_restore' => 'Dilleri geri yükle',
        'mirror_restore_confirm' => 'Bu, panel dışındaki kopyadaki her dili bu paneldekinin üzerine yazar. Bir yükseltmeden sonra bunun amacı tam olarak budur ve kurulmuş bir dili sonradan kaldırmanın bir yolu yoktur, bu yüzden emin olmaya değer.',
        'mirror_back' => 'Diller geri yüklendi',
        'mirror_back_body' => 'Bulunan :found, geri konan :put, alınamayan :failed.',
    ],

    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Renk, biçim ve panelin adı.',
        'pages' => 'Sayfalar',
        'pages_helper' => 'Sunucu listesi, bir sunucunun içindeki sayfalar ve terminal.',
        'advanced' => 'Gelişmiş',
        'advanced_helper' => 'İki acil çıkış: kendi CSS\'in ve yalnızca bir alan için geçerli olan ayarlar.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Hangi egg\'lerin Minecraft olduğu ve bununla ilgili diğer her şey.',
        'artwork' => 'Egg görselleri',
        'artwork_helper' => 'Her egg\'in bulunduğu bir sayfa ve onun için oyun görselini Steam ya da IGDB\'den almanın bir yolu. Egg\'lerin kendisine yazar - görseli ve hangi oyun olduğunu ve görselin elle mi seçildiğini not eden iki etiketi - ve bu yüzden kendi iznini taşır.',
        'alerts' => 'Uyarılar',
        'alerts_helper' => 'Panelin zaten ölçtüğü ama kimseye söylemediği şeylerin düzenli bir denetimi: yanıt vermeyi bırakan bir node, dolan bir disk, durmuş bir queue worker, geride kalmış bir sürüm. Discord\'a, panele ya da e-postayla gönderir. Kendi izni var, çünkü düzenli olarak her node\'a ulaşır ve birinin yazdığı bir adrese gönderir.',
        'backups' => 'Yedeklere genel bakış',
        'backups_helper' => 'Her sunucunun ve ne kadar süredir yedeksiz olduğunun bulunduğu bir sayfa; hiç yedeği olmayanlar en üstte olacak biçimde sıralanır. Yalnızca okuma - bir yedekle bir şey yapan her şey, o sunucu için Pelican\'ın kendi sayfasında kalır. Kendi izni var, çünkü liste, deliklerin nerede olduğunun haritasıdır.',
        'public_status' => 'Herkese açık durum sayfası',
        'public_status_helper' => 'Herkesin hesapsız açabildiği ve sunucularından hangilerinin çalıştığını ve üzerlerinde kaç kişi olduğunu gösteren bir sayfa. Bir sunucu, bir makine ya da bir hizmet anmadıkça hiçbir şey yayımlanmaz - üç listenin üçü de boş başlar ve öyle kaldıkları sürece adres 404 yanıtı verir. Kendi izni var, çünkü panelden neyin çıkacağına o karar verir.',
        'game_players' => 'Oyuncular, diğer oyunlar',
        'capacity' => 'Kapasite',
        'capacity_helper' => 'Bir sunucu daha sığıp sığmayacağını görebilmen için, her makinede ne kadarının söz verildiği ve dağıtmasına izin verilen miktar. Pelican\'ın node listesi bir ad ve bir sunucu sayısı gösterir, genel bakıştaki Makineler bloğu ise neyin çalıştığını gösterir - bu üçüncü sorudur ve hesap Pelican\'ın kendi hesabıdır. Yalnızca okuma. Kendi izni var.',
        'schedules' => 'Zamanlanmış görevler',
        'schedules_helper' => 'Paneldeki her zamanlanmış görev ve hangisinin durduğu: bir çalışmanın ortasında takılmış, cron çalışmadığı için gecikmiş ya da hiç çalışmamış. Pelican zamanlamaları her sunucunun içinde gösterir ve kendi durumunun bu durumların hiçbiri için bir sözcüğü yoktur. Yalnızca okuma. Kendi izni var.',
        'activity' => 'Etkinlik',
        'activity_helper' => 'Panelin kaydettiği her olay; her seferinde tek bir sunucu değil, tek bir listede. Pelican günlüğü tutar ve sunucu başına gösterir; bu, aynı günlüğü öteki yönden sorar. Yalnızca okuma. Kendi izni var, çünkü kimin ne yaptığına dair bir genel bakış, bilerek verilen bir şeydir.',
        'access' => 'Sunucu erişimi',
        'access_helper' => 'Bir rolü sunuculara bağla, ki ona sahip herkes onlara ulaşsın. Bu, Pelican\'ın kendi subuser kayıtlarını güncel tutarak çalışır ve sunucu listesi ile her izin denetimi zaten tam onları okur. Kendi izni var, çünkü buradaki insanlara bir şeye erişim veren tek sayfa bu.',
        'games' => 'Diğer oyunlar',
        'games_helper' => 'ARK ve Valheim\'ın dünyalarının yanında tuttuğu dosyalar, form olarak: ARK\'ın dünya ayarları ve Valheim\'ın admin, ban ve izin verilenler listeleri. Hangi sunucuların bunları alacağı o sayfadaki egg listesidir, bu yüzden boş bir liste zaten oyun başına bir düğmedir.',
        'game_players_helper' => 'Rust, ARK, Valheim ve Valve sorgusuna yanıt veren diğer her şeyin içinde, kimin bağlı olduğunu ve ne kadar süredir içeride olduğunu gösteren bir sayfa. Yalnızca okuma - birine ne yapabileceğin oyundan oyuna değişir ve o ayrı bir yayındır. Hangi egg\'lerin sayıldığı, durum sayfasının kullandığı listenin aynısıdır.',
        'api' => 'API',
        'api_helper' => 'İnsanların elindeki anahtarlar, kimin bir tane istediği ve her birinin neyi görebildiği.',
        'languages' => 'Diller',
        'languages_helper' => 'Bu eklentinin hangi dillerde yanıt verdiği.',
        'files' => 'Depolama ve CDN',
        'files_helper' => 'Bu eklentinin tuttuğu dosyaların nereye konduğu ve hangi adresten okunduğu.',
    ],

    'features' => [
        'look' => 'Look ayarları',
        'look_helper' => 'Renk, biçim ve marka için kenar çubuğundaki satır.',
        'pages' => 'Sayfa ayarları',
        'pages_helper' => 'Sunucu listesi, sunucu sayfaları ve terminal için kenar çubuğundaki satır.',
        'advanced' => 'Gelişmiş ayarlar',
        'advanced_helper' => 'Kendi CSS\'in ve alan başına ayrıcalıklar için kenar çubuğundaki satır.',
        'announcements' => 'Duyurular',
        'announcements_helper' => 'Panelin üstündeki şerit.',
        'nav_links' => 'Gezinme bağlantıları',
        'nav_links_helper' => 'Kenar çubuğundaki kendi satırların.',
        'login' => 'Giriş ekranı',
        'login_helper' => 'Giriş ekranının görseli, iletisi ve bağlantıları.',
        'bars' => 'Kaynak göstergeleri',
        'bars_helper' => 'İşlemci, bellek ve disk için renk değiştiren çubuklar.',
        'dashboard_status' => 'Sürüm satırı',
        'dashboard_status_helper' => 'Genel bakıştaki bloğun üstü: hangi sürümün kurulu olduğu ve bir tanesinin bekleyip beklemediği.',
        'dashboard_nodes' => 'Makineler',
        'dashboard_nodes_helper' => 'Genel bakıştaki bloğun geri kalanı: bu panel ve her node, her birinin ne kullandığıyla.',
        'system_status' => 'Sistem durumu sayfası',
        'system_status_helper' => 'Panelin kendisinin çalıştığı makine için sayfa.',
        'sidebar_footer' => 'Kenar çubuğunun altı',
        'sidebar_footer_helper' => 'Metin satırın, panelin sürümü ve bir bağlantı; kenar çubuğunun altında.',
        'console' => 'Konsol düğmesi',
        'console_helper' => 'Bir sunucunun içindeki yüzen düğme; üstünde konsol ve güç düğmeleriyle, node\'a doğrudan ulaşan. Hangi biçimi aldığı sunucu sayfaları ayarlarındadır; bu, hiç çizilip çizilmeyeceğine karar verir.',
        'arranger' => 'Sayfa düzenleyici',
        'arranger_helper' => 'Bir sayfadaki blokları birinin istediği sıraya sürüklemek. Roller altında kendi iznini taşır, yani panelin bunu sunup sunmayacağına bu karar verir, kime sunacağına ise izin.',
        'user_themes' => 'Kişiye özel stiller',
        'user_themes_helper' => 'Herkesin, istemci alanındaki Görünüm altında, senin sunduğun stiller arasından kendine bir tane seçmesine izin vermek. Hangi stillerin sunulduğu Look sayfasındadır; bu, birine hiç sorulup sorulmayacağına karar verir.',
        'api' => 'API',
        'api_helper' => 'Panelin dışından içeriye bir yol: bir Discord botunun ya da kendi betiğinin, bu eklentinin bildiklerini sorabileceği bir adres - kimin oynadığı, hangi sunucuların yedeği olmadığı, bir node\'a bir tane daha sığıp sığmadığı. Kapalı, reddeden bir rota kaydetmek yerine hiç rota kaydetmez; bu, aynı yüzeyin daha kibar bir miktarı değil, daha az yüzeydir. Oturum açmış herkes, yalnızca kendi sunucuları için yanıt veren bir anahtar isteyebilir; bir tane vermek, bir tanesini reddetmek, başkasının elindekini geri çekmek ve panelin tamamı için bir tane çıkarmak, hepsi izni gerektirir.',
        'languages' => 'Diller',
        'languages_helper' => 'Bu eklentinin çevrildiği yerlerde herkese hesabının ayarlandığı dilde yanıt vermek. Bu kapalıysa herkes İngilizce alır.',
        'files' => 'Depolama ve CDN',
        'files_helper' => 'Bu eklentinin dosyalarını panelden başka bir yerde tutmak: bir S3 bucket\'ı ya da bir CDN. Kapalı olması "dosya yok" demek değil - panelin kendi diski demek, ki onlar hep oraya gittiler. Bunun karar verdiği şey, başka bir yerin hiç sunulup sunulmayacağı. Yanıt vermeyen bir hedef, bir yüklemeyi kaybetmek yerine panele geri düşer ve bir kez yazılmış bir adres hiçbir zaman geri alınmaz: bunu değiştirmek, sonraki dosyanın nereye gideceğine karar verir, sonuncusunun nerede durduğuna değil.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Kenar çubuğunda bir Minecraft sekmesi ve her Minecraft sunucusunun içinde onun server.properties dosyasını form olarak düzenleyecek bir sayfa. Hangi egg\'lerin sayılacağını sen söylersin.',
        'palworld' => 'Palworld ayarları',
        'palworld_helper' => 'Bir Palworld sunucusunun içinde onun dünya ayarlarını düzenleyecek bir sayfa. Başka hiçbir sunucuda belirmez ve o sunucu çalışırken hiç belirmez.',
        'settings_search' => 'Ayarlarda arama',
        'settings_search_helper' => 'Bu formların üstündeki, onları yazdığın şeyi içeren bölümlere daraltan alan.',
        'preview' => 'Canlı önizleme',
        'updating' => 'Güncelleme bildirimi',
        'waitlist' => 'Bekleme listesi',
        'waitlist_helper' => 'Birinin, tükenmiş bir paket yeniden satışa çıktığında haber verilmesini istemesine izin vermek. Stok geri geldiğinde o paketi bekleyen herkese aynı anda söylenir ve paket ilk satın alana gider - kimse için hiçbir şey ayrılmaz ve her ileti bunu söyler. Haber verilmesi kişiyi listeden çıkarır, yani bir istek bir bildirim satın alır, sürekli bir abonelik değil. Mağazayı gerektirir ve mağazada hiçbir şey satın almamış bir müşteriye yazan tek şeydir.',
        'updating_helper' => 'Bu eklenti bir güncelleme kurarken ve işi bittikten sonraki beş dakika boyunca sayfanın başında tek bir satır. Güncellemenin kendisi sırasında gösterilemez - yayın yerine konurken Pelican bu eklentiyi kurulu değil diye okur ve hiçbir parçasını yüklemez, yani çizecek bir şeyimiz kalmaz. Amacı, yarı çizilmiş bir sayfayla karşılaşan, bekleyen ve geri gelen kişidir: satır ona ne gördüğünü söyler.',
        'preview_helper' =>'Look formunun yanındaki, renklerin, köşelerin ve boşlukların ne yaptığını sen kaydetmeden önce gösteren kutu.',
        'duplicate' => 'Sunucuyu çoğalt',
        'duplicate_helper' => 'Elindekinin tam aynısı olan bir sunucu daha ya da bir seferde birkaç tane kurmak için bir sayfa. Dosyalar hiçbir zaman kopyalanmaz.',
        'favourites' => 'Yıldızlı sunucular',
        'favourites_helper' => 'Her sunucu kartında bir yıldız. Yıldızlananlar önce gelir ve herkesin listesi panelde durur - böylece yıldızlar, bir dahaki oturum açtığı yere onunla gider. Bu, kendi gördüğünü değiştirir, başkaları için hiçbir şeyi değiştirmez. Panelde durması ise storage altında bir dosya olduğu anlamına gelir; makineye erişimi olan herkes onu okuyabilir.',
        'artwork' => 'Egg görselleri',
        'artwork_helper' => 'Her egg\'in görselini Steam ya da IGDB\'den alan ve egg\'in kendisine yazan yönetim sayfası.',
        'alerts' => 'Uyarılar',
        'alerts_helper' => 'Yanıt vermeyi bırakmış bir node, dolan bir disk, ölü bir queue worker ya da geride kalmış bir sürüm için yapılan düzenli denetim - ve gönderdiği Discord, panel ya da e-posta iletisi.',
        'backups' => 'Yedeklere genel bakış',
        'backups_helper' => 'Her sunucuyu ne kadar süredir yedeksiz olduğuna göre listeleyen yönetim sayfası. Yalnızca okuma.',
        'public_status' => 'Herkese açık durum sayfası',
        'public_status_helper' => 'Herkesin hesapsız açabildiği sayfa. Kapalıysa, listede ne olursa olsun adres 404 yanıtı verir.',
        'game_players' => 'Oyuncular, diğer oyunlar',
        'game_players_helper' => 'Rust, ARK, Valheim ve Valve sorgusuna yanıt veren diğer her şeyin içinde, kimin bağlı olduğunu ve ne kadar süredir içeride olduğunu gösteren bir sayfa.',
        'owner_alerts' => 'İnsanlara sunucularının kapalı olduğunu söyle',
        'owner_alerts_helper' => 'Bu eklentinin yönetici olmayan insanlara yazan tek parçası: sunucularından birinin arkasındaki makine yanıt vermeyi bıraktığında panelde bir bildirim ve makine geri geldiğinde bir tane daha. Hem burada hem de Uyarılar sayfasında açana dek kapalı - müşterilerine yazar, bu yüzden bir değil iki karar ister.',
        'my_backups' => 'Sunucu listesinde yedek uyarısı',
        'my_backups_helper' => 'Herkesin kendi sunucu listesinin üstünde, sunucularından birinin hiç yedeği olmadığında ya da bir süredir olmadığında beliren bir satır. Pelican\'ın kartı bir sunucunun şu anda ne yaptığını söyler; orada hiçbir şey bir yedeğin üç haftadır çalışmadığını söylemez. Yalnızca bir şey geride kaldığında çizilir ve kişinin zaten açamayacağı hiçbir sunucuyu anmaz.',
        'capacity' => 'Kapasiteye genel bakış',
        'capacity_helper' => 'Her makinede söz verilmiş belleği, diski ve işlemciyi kullanılabilir olana karşı gösteren; yedekleri, veritabanları ya da allocation\'ları tükenmiş sunucularla birlikte veren yönetim sayfası. Kullanılmış değil, söz verilmiş - bir node meşgul ve boş olabilir ya da sessiz ve dolu.',
        'schedules' => 'Zamanlanmış görevlere genel bakış',
        'schedules_helper' => 'Panel genelindeki her zamanlanmış görevi, en kötüleri başta listeleyen yönetim sayfası - takılı, gecikmiş ya da hiç çalışmamış. Yalnızca okuma; birini değiştiren ya da çalıştıran her şey, o sunucu için Pelican\'ın kendi sayfasında kalır.',
        'activity' => 'Panelin etkinliği',
        'activity_helper' => 'Panel genelindeki her kayıtlı olayı, en yenisi başta, kimin yaptığı ve hangi sunucuda olduğuyla listeleyen yönetim sayfası. Yalnızca okuma - hiçbir şeyi silmez ve satırların ne kadar kalacağına yine Pelican\'ın kendi ayarı karar verir.',
        'access' => 'Role göre sunucu erişimi',
        'access_helper' => 'Bir rolü sunuculara bağlamak için, Pelican\'ın kendi subuser tablosunda doğru tutulan bir sayfa. Sen bir şey bağlamadan hiçbir şey vermez. Kapatmak uzlaştırmayı durdurur; zaten verilmiş erişim kalır ve sayfada onu geri almak için bir düğme vardır.',
        'scheduled' => 'Saate göre stiller',
        'scheduled_helper' => 'Look sayfasındaki, panele günün iki saati arasında başka bir stil veren bölüm. Kaydedilmiş hiçbir şeyi değiştirmez - sayfa çizilirken ayarların üzerine bir aralık konur ve hemen ardından bırakılır - bu yüzden kapatmak panelin kendi görünümünü anında geri verir ve hiçbir şey kaybettirmez.',
        'games' => 'Diğer oyunlar',
        'games_helper' => 'ARK\'ın dünya ayarları ve Valheim\'ın admin, ban ve izin verilenler listeleri; dosya yöneticisindeki dosyalar olarak değil, form olarak. Hangi sunucuların bunları alacağı, Diğer oyunlar sayfasındaki egg listesidir.',
        'quick' => '"Şuraya git" menüsü',
        'quick_helper' => 'Her sayfanın başında, bir sunucuya ya da yıldızlı bir sayfaya atlamak için tek bir öge; tüm sunucu listende bir arama alanıyla. Bulunduğun sayfayı da vurgular. Birinin onun üzerinden bulduğu şey, zaten ulaşabildiği şeydir; bu yüzden hiçbir şey vermez - kapatmak kısayolu ve onunla birlikte Sık kullanılanlar sayfasını alır.',
        'shop' => 'Mağaza',
        'shop_helper' => 'Panelden sunucu satmak: müşteri tarafındaki mağaza ve ödeme adımı, herkesin fatura sayfası ve para birimi, vergi ve metinler için Mağaza ayarları sayfası. Ana anahtar - kapalıyken kimse satın alamaz veya ödeyemez, zaten satılmış olanlar ise aşağıdaki sayfalardan yönetilmeye devam eder.',
        'packages' => 'Paketler',
        'packages_helper' => 'Neyin satıldığının belirlendiği yönetici sayfası: fiyatı, dönemi ve stoğu olan bir sunucu şablonu. Ayrı bir yetki, çünkü fiyat belirlemek faturaları ödendi olarak işaretlemekten başka bir iştir.',
        'orders' => 'Siparişler',
        'orders_helper' => 'Satın alınan her şeyi, her siparişin dönüştüğü sunucuyu ve durumunu - bekliyor, etkin, durduruldu, iptal - gösteren yönetici sayfası. Ayrı bir yetki.',
        'invoices' => 'Faturalar',
        'invoices_helper' => 'Borçlu olunanı ve ödeneni gösteren, bir faturayı elle ödendi olarak işaretleyecek düğmesi olan yönetici sayfası. Ayrı bir yetki, çünkü paranın kaydedildiği yer o düğmedir.',
        'payments' => 'Ödemeler',
        'payments_helper' => 'Ödeme sağlayıcıları - anahtarları ve onlar üzerinden yapılan her deneme. Ayrı bir yetki, çünkü kimlik bilgileri orada durur: her faturayı gören kişinin sırrı görmesi gerekmez.',
        'coupons' => 'Kuponlar',
        'coupons_helper' => 'İlk faturadan yüzde veya sabit tutar düşen, geçerlilik süresi ve kullanım sınırı olan kodlar. Ayrı bir yetki.',
        'customers' => 'Müşteriler',
        'customers_helper' => 'Mağazayı ters çeviren yönetim sayfası: satın almış her kişi için bir satır; elinde ne var, ne ödemiş ve ne kalmış. Kendi yetkisi var, çünkü mağazanın satır yerine insan hakkında olan tek sayfası bu - fiyat belirleyenin bir müşterinin tüm geçmişine ihtiyacı yoktur, bir talebi yanıtlayanın vardır.',
        'credit' => 'Bakiye ve iadeler',
        'credit_helper' => 'Mağazanın bir müşteri adına elinde tuttuğu para. Bir iade, geldiği karta geri gidebilir ya da bakiye olarak hesapta kalabilir; her iki durumda da bir iade faturası yazılır ve hesaptaki bakiye, müşteriden ödeme istenmeden önce kendiliğinden bir sonraki faturadan düşülür. Kendi yetkisi var, çünkü bir faturayı ödendi diye işaretlemek paranın geldiğini kaydeder, bu ise para dağıtır.',
        'upgrades' => 'Yükseltme ve düşürme',
        'upgrades_helper' => 'Çalışan bir hizmeti, yenisini satın almadan başka bir pakete taşımak. Zaten ödenmiş dönemden geriye kalan geri döner, aynı süre yeni fiyattan hesaplanır ve aradaki fark faturalanır ya da müşterinin hesabına yazılır. Her paket hangi paketlere geçilebileceğini listeler ve yalnızca aynı egg\'i paylaşanlar sunulur: başka bir egg, daha büyük bir sunucu değil, başka bir sunucudur.',
        'addons' => 'Ekstralar',
        'addons_helper' => 'Bir paketin yanında satılan şeyler: daha çok bellek, bir yedek yuvası daha ya da yalnızca faturada bir satır olan bir şey. Her biri hangi paketlere uyduğunu ve sunucuya ne eklediğini söyler; ya her yenilemede ya da bir kez ücretlendirilir. Ödeme adımında ya da sonradan çalışan bir hizmet üzerinde satın alınır; sonradan alındığında dönemden geriye kalana göre oranlanır. Kendi yetkisi var, çünkü bir ekstranın birinin sunucusuna ne ekleyebileceği, bir fiyat listesiyle değil o kişinin makinesiyle ilgili bir karardır.',
        'tickets' => 'Destek talepleri',
        'tickets_helper' => 'Müşterilerin panelin içinden, sordukları hizmetin yanı başında soru sorabileceği bir yer - bir sohbet kanalının yapamadığı tek şey de budur. Destek talepleri sayfası neye ayarlıysa, ya buradaki bir sayfada yanıtlanır ya da Modora üzerinden Discord\'a iletilir. İki durumda da her soru ve her yanıt bu panelde saklanır, böylece karşı uca ulaşılamadığında hiçbir şey kaybolmaz. Kendi yetkisi var, çünkü müşterileri yanıtlamak, paket fiyatlamayla birlikte gelen bir iş değil, birine verilen bir iştir.',
        'overview' => 'Mağazaya genel bakış',
        'overview_helper' => 'Bu ay ne girdiği, ne borç olduğu, etkin hizmetlerin her ay ne ettiği ve bugün neye bakmak gerektiği sorularını yanıtlayan sayfa. Kendi izni var, çünkü ciro, bir pakete fiyat koyabilen herkesin okuyabilmesi gereken bir şey değil.',
        'terminate' => 'Bir hizmeti sonlandır',
        'terminate_helper' => 'Bir hizmeti şimdi durduran ve sunucusunu dosyalarıyla birlikte silen düğme. Sipariş izninden bilerek ayrı: durdurmak, vadeyi kaydırmak ve iptal etmek geri alınabilir, bu ise alınamaz. Talepleri yanıtlayan biri, bu olmadan ilk üçüne sahip olabilir.',
        'public_shop' => 'Genel mağaza sayfası',
        'public_shop_helper' => 'Herkesin hesapsız açabildiği, satılanları gösteren sayfa. Giriş yapmış bir müşterinin mağazada göremeyeceği hiçbir şeyi yayımlamaz, bu yüzden açık ya da kapalı olması kararın tamamıdır - kapalıyken durum sayfası gibi 404 yanıtı verir.',
    ],

    /*
     * Ayar formlarının üstündeki arama alanı. Tarayıcıda zaten sayfada olanı
     * süzer ve sunucuya hiçbir şey sormaz; bu yüzden betimlenecek bir "aranıyor"
     * durumu yoktur ve bozulmasının bir yolu da yoktur.
     */
    /*
     * Önizleme. İçindeki her şey senin panelinden bir örnek değil, bir vekildir
     * ve ifade bunu söyler - gerçek bir sunucudan ya da gerçek bir sayıdan söz
     * eden bir kutu, öyle okunurdu.
     */
    'preview' => [
        'label' => 'Önizleme',
        'card' => 'Bir kart',
        'card_helper' => 'Panelle aynı kurallara göre, kaydedilmiş ayarlarla değil bu sayfadaki ayarlarla çizildi.',
        'button' => 'Bir düğme',
        'field' => 'Bir alan',
        'meter_ok' => 'İyi',
        'meter_warning' => 'Uyarı',
        'meter_danger' => 'Tehlike',

        /*
         * Tüm sayfanın önizlemesi. Bir çerçeve değil bir sekme; çünkü Pelican
         * X-Frame-Options: DENY gönderir ve kendisi dahil hiçbir şeyce
         * çerçevelenmeyi kabul etmez - bkz. Support\FullPreview.
         */
        'full' => 'Tüm paneli gör',
        'full_confirm' => 'Paneli, kaydedilmiş ayarlardan değil bu sayfadaki ayarlardan çizilmiş olarak açar. Hiçbir şey yazılmaz - değerler on beş dakika tutulur ve önizlemeden çıktığında ya da kaydettiğinde panel olağana döner.',
        'full_go' => 'Göster',
        'full_failed' => 'Önizleme başlatılamadı',
        'bar' => 'Kaydedilmemiş ayarlara bakıyorsun. Onlardan hiçbiri yazılmadı.',
        'bar_back' => 'Ayarlara dön',
    ],

    'search' => [
        'placeholder' => 'Ayarlarda ara',
        'label' => 'Bu ayarlarda ara',
        'none' => 'Bu sayfada hiçbir şey uymuyor. Ayarlar dört sayfaya dağılmış - Look, Sayfalar, Gelişmiş ya da Essentials ayarları\'nı dene.',
    ],

    'footer' => [
        'text' => 'Kendi satırın',
        'text_helper' => 'Düz metin, en çok 120 karakter. Duyuru şeridi gibi kaçış uygulanır - bu, panelin her sayfasında çizilir ve bu da onu işaretleme almak için yanlış bir yer yapar.',
        'version' => 'Panelin sürümünü göster',
        'version_helper' => 'Pelican\'ın sürümü, bu eklentininki değil. Eklenti kendininkini genel bakışta söyler; insanların bir kenar çubuğunun altında aradığı şey hangi panele baktıklarıdır.',
        'link_label' => 'Bağlantı metni',
        'link_url' => 'Bağlantı adresi',
        'link_url_helper' => 'Bir http ya da https adresi ya da panelin kendi içinde /account gibi bir yol. Yeni bir sekmede açılır.',
    ],

    'layout' => [
        'label' => 'Düzen',
        'helper' => 'Panelin nasıl kurulduğu, ne renk olduğu değil. Yönetim alanı, sunucu listesi ve istemci alanı için aynı ölçüde geçerli. Gezinmenin nerede durduğu bir varsayılandır: Hesap → Gezinme altında kendininkini ayarlamış olan onu korur.',
        'default' => 'Kenar çubuğu - Pelican\'ın kendi',
        'rail' => 'Simge şeridi - dar, üzerine gelince açılır',
        'top' => 'Gezinme üstte - kenar çubuğu yok',
        'mixed' => 'Üst çubuk ve kenar çubuğu - ikisi de',
        'wide' => 'Geniş - içerik tüm ekranı kullanır',
        'focus' => 'Odaklı - dar sütun, kenar çubuğu katlanır',

        'nav_label' => 'Kenar çubuğu stili',
        'nav_helper' => 'Kenar çubuğunun kendisinin nasıl çizildiği.',
        'nav_default' => 'Varsayılan',
        'nav_floating' => 'Yüzen - kendi kartı',
        'nav_flat' => 'Düz - hiç arka plan yok',
        'nav_bordered' => 'Kenarlıklı - bir çizgi, bir yüzey değil',

        'topbar_label' => 'Topbar stili',
        'topbar_helper' => '"Gizli" yalnızca bilgisayarda geçerli - telefonda topbar, menüye dönen tek yolu taşır.',
        'topbar_default' => 'Varsayılan',
        'topbar_floating' => 'Yüzen - ayrık bir satır',
        'topbar_flush' => 'Hizada - düz, bulanıklık yok',
        'topbar_hidden' => 'Bilgisayarda gizli',

        'card_label' => 'Kart stili',
        'card_helper' => 'Bölümler, widget\'lar, sunucu kartları ve konsolun üstündeki bloklar.',
        'card_default' => 'Varsayılan - yumuşak kenarlıkla yükseltilmiş',
        'card_flat' => 'Düz - yükseltmesiz',
        'card_outline' => 'Dış çizgi - bir kenarlık ve arkasında hiçbir şey',
        'card_glass' => 'Buzlu - arka plan içinden görünür',
        'card_sharp' => 'Keskin - düz köşeler',
    ],

    'servers' => [
        /*
         * Bir karttaki yıldız. Betiğin içine yazılmadı, betiğe verildi; ki
         * metinler, metinlerin yaşadığı tek yer olsun.
         */
        'favourite' => 'Bu sunucuyu yıldızla',
        'favourited' => 'Yıldızlı - önce gösterilir',

        /*
         * Pelican'ın kendi sekmelerinin yanındaki hap. Dördüncü bir sekme olarak
         * değil, listeye ne yaptığına göre adlandırıldı; çünkü seçili sekmeyi
         * değiştirmez, süzer.
         */
        'favourites_tab' => 'Sık kullanılanlar',
        'favourites_empty' => 'Bu sayfada hiçbir şey yıldızlı değil. Bir tane eklemek için bir sunucu kartındaki yıldızı kullan - ve dikkat et: bu, zaten burada olan sunucuları süzer; sonraki bir sayfadaki yıldızlı bir sunucu gizlenmez, yalnızca bu sayfada değildir.',
        'favourites_failed' => 'Yıldızlı sunucuların kaydedilemedi, bu yüzden panelin son sahip olduğu duruma geri alındılar. İsteğin ne yanıt verdiğini tarayıcı konsolu söyler.',

        'art' => 'Oyun görseli',
        'art_helper' => 'Pelican egg\'in görselini her kartta çizer. Bu, onunla ne yapılacağına karar verir.',
        'art_faded' => 'Soluk - metnin arkasında bir parıltı',
        'art_cover' => 'Kaplayan - adın arkasında, sönerek biter',
        'art_off' => 'Kapalı',
        'art_dim' => 'Görseli karart',
        'art_dim_helper' => 'Bir oyunun görseli aydınlık bir gökyüzü, ötekininki bir mağaradır.',

        'status' => 'Durum işareti',
        'status_helper' => 'Çalışıyor/başlıyor/durdu renginin nerede göründüğü.',
        'status_bar' => 'Çubuk - sol kenar boyunca',
        'status_edge' => 'Kenar - üst boyunca',
        'status_dot' => 'Nokta - köşede',
        'status_off' => 'Kapalı',

        'density' => 'Kart yüksekliği',
        'density_comfortable' => 'Ferah',
        'density_compact' => 'Sıkışık - çok sunucu için',

        'filter_label' => 'Süzme düğmesine metin koy',
        'filter_label_helper' => 'Pelican bu listeyi egg\'e ve sahibine göre, tüm sayfalar boyunca zaten süzüyor - ama giriş, arama alanının yanında metinsiz bir simge. Bu, üzerine sözcüğü koyar.',
        'filter_button' => 'Süzgeçler',

        'columns' => 'Geniş ekranda yan yana kartlar',
        'columns_helper' => 'Yalnızca ızgara için ve yalnızca 1280px ve üstünde geçerli. Pelican\'ın kendi tavanı iki.',
    ],

    'controls' => [
        'mode' => 'Her sunucu sayfasında konsol düğmesi',
        'mode_helper' => 'Bir sunucunun her sayfasında tek bir yüzen düğme. Uğraştığın şeyin üstünde konsolu açar; başlığında durum ve güç düğmeleriyle - node\'a doğrudan ulaşır, sunucu listesinin yaptığı gibi; konsol sayfasının websocket\'i üzerinden değil. Hepsi zaten orada olan konsol sayfasında hiç belirmez.',
        'mode_full' => 'Konsol ve güç düğmeleri',
        'mode_console' => 'Yalnızca konsol',
        'mode_off' => 'Kapalı',

        'label' => 'Düğme şunu gösterir',
        'label_text' => 'Simge ve ad',
        'label_icon' => 'Yalnızca simge',

        'position' => 'Nerede yüzer',
        'position_helper' => 'Okuma olasılığının en düşük olduğu kenara doğru.',
        'position_top' => 'Üst',
        'position_right' => 'Sağ',
        'position_bottom' => 'Alt',
    ],

    'console' => [
        'stats' => 'Konsolun üstündeki bloklar',
        'stats_helper' => 'Pelican terminalin üstünde adı, durumu, adresi ve üç kullanım sayısını gösterir. Onları gizlemek konsola yüksekliğini geri verir.',
        'stats_tiles' => 'Karolar - etiket, sayı ve bir simge',
        'stats_plain' => 'Yalın - Pelican\'ın çizdiği gibi',
        'stats_off' => 'Gizli',
    ],

    'terminal' => [
        'helper' => 'Terminalin kendisine verilir, bu yüzden kaydedildikleri anda değil, bir sonraki sayfa yüklemesinde etkili olurlar.',

        'renderer' => 'Şununla çizilir',
        'renderer_helper' => 'Pelican terminali GPU üzerinde çizer; akan bir çıktı duvarı karşısında bu çok daha hızlıdır. Bir tarayıcı aynı anda yalnızca belli sayıda GPU bağlamını canlı tutar - telefonda daha az - ve sınır aşıldığında en eskisini alır; terminal o zaman hiçbir hata vermeden hiçbir şey çizmez. Çevresindeki her şey doğru görünürken konsolun boşalıyorsa, değiştirilecek ayar budur.',
        'renderer_webgl' => 'GPU - Pelican\'ın kendi seçimi, daha hızlı',
        'renderer_dom' => 'Tarayıcı - daha yavaş, her zaman çizer',

        'scheme' => 'Renk düzeni',
        'scheme_helper' => 'Pelican\'ın sunmadığı tek terminal ayarı. "Temayı izle" renkleri vurgudan türetir ve bunun var olmasının nedeni de budur.',
        'scheme_theme' => 'Temayı izle',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'İmleç',
        'cursor_helper' => 'Konsol yazı almaz - komut alanı onun altındadır - bu yüzden bu, çıktının durduğu yerdir; senin bulunduğun yer değil.',
        'cursor_underline' => 'Alt çizgi - Pelican\'ın kendi seçimi',
        'cursor_block' => 'Blok',
        'cursor_bar' => 'Çizgi',

        'blink' => 'Yanıp sönen imleç',

        'scrollback' => 'Kaydırma geçmişi',
        'scrollback_helper' => 'Konsolun ne kadar geriye kaydırılabildiği. Her satır tarayıcıda tutulur, bu yüzden yüksek ayarlı konuşkan bir sunucu, birlikte okuyan makinede gerçek bellek demektir.',
        'scrollback_lines' => ':lines satır',
    ],

    'notice' => [
        'text' => 'İleti',
        'text_helper' => 'Tek satır, en çok 200 karakter. Girişte de çıkışta da kaçış uygulanır, bu yüzden başkalarının yüklediği bir sayfaya işaretleme taşıyamaz.',
        'style' => 'Ton',
        'style_info' => 'Bilgi',
        'style_warning' => 'Uyarı',
        'style_danger' => 'Acil',
        'style_accent' => 'Vurgu rengi',
        'scope' => 'Şuna gösterilir',
        'scope_all' => 'Herkese',
        'scope_client' => 'Yalnızca yönetim alanının dışında',
        'scope_admin' => 'Yalnızca yönetim alanında',
        'link_label' => 'Düğme metni',
        'link_url' => 'Düğme adresi',
        'link_url_helper' => 'https:// ya da bu panelin içinde /account gibi bir yol. Başka her şey yok sayılır - her sayfada görünen bir şerit içindeki bir bağlantı, kimsenin beklemediği bir şema için yer değildir.',
        'dismissible' => 'Kapatılabilir',
        'dismissible_helper' => 'Kapatılması tarayıcı başına ve yalnızca bu ileti için anımsanır: metni değiştir, herkes için geri gelir.',
        'dismiss' => 'Kapat',
    ],

    'preset' => [
        'label' => 'Stil',
        'helper' => 'Başlayacağın bir görünüm seç. Aşağıdaki her şeyi doldurur, sonra da onları değiştirebilirsin. "Yok", temayı kapatır ve paneli tam olarak Pelican\'ın verdiği gibi bırakır.',
        'options' => [
            'none' => 'Yok - tema yok',
            'legend' => 'Legend - kırmızı ateşten mavi şimşeğe',
            'ember' => 'Ember - sıcak siyah, turuncu vurgu',
            'midnight' => 'Midnight - derin mavi, dingin',
            'crimson' => 'Crimson - kırmızı, keskin köşeler, sıkışık',
            'forest' => 'Forest - yeşil, yuvarlak, parıltısız',
            'nebula' => 'Nebula - mor, geçişli bir arka planla',
            'terminal' => 'Terminal - siyah üzerine yeşil, sabit genişlik, keskin',
            'console' => 'Console - yuvarlak ve ferah, bir tablet için',
            'nord' => 'Nord - Nord paleti, kısık',
            'solarized' => 'Solarized - Solarized dark, camgöbeği vurgu',
            'paper' => 'Paper - aydınlık, yüksek karşıtlık, düz',
            'daylight' => 'Daylight - aydınlık ve sıcak, yumuşak bir parıltıyla',
            'mono' => 'Mono - gri tonlar, düz ve yoğun',
        ],

        'save' => 'Stil olarak kaydet',
        'save_confirm' => 'Şu anda ekranda olan renkleri, köşeleri, arka planı, yazı tipini, simgeleri ve gösterge eşiklerini - kendi seçtiğin bir adla, yerleşiklerin yanındaki seçicide - saklar. Sayfada duranı kaydeder, en son kaydedileni değil.',
        'save_name' => 'Ad',
        'save_name_helper' => 'Seçicide nasıl anılacağı. Daha önce kullandığın bir adla kaydetmek onun yerine geçer.',
        'saved' => 'Stil kaydedildi',
        'save_failed' => 'O stil kaydedilemedi',
        'save_full' => 'Kendi stillerin için :max yer var. Önce birini sil.',

        'delete' => 'Bir stili sil',
        'delete_which' => 'Hangisi',
        'delete_confirm' => 'Yalnızca kendi stillerin silinebilir; yerleşikler silinemez. Panelin şu anki görünümünde hiçbir şey değişmez - bir stil bir başlangıç noktasıdır ve ayarladığı her değer zaten aşağıdaki ayarlarda durur.',
        'deleted' => 'Stil silindi',
        'deleted_current' => 'Bu panelin ayarlı olduğu stil oydu. Ayarları değişmedi ve hâlâ bu sayfada duruyor - bir stil seç ya da onları bir adla yeniden kaydet.',
    ],

    'user_themes' => [
        'label' => 'İnsanların kendileri için seçebileceği stiller',
        'helper' => 'İşaretli stiller, istemci alanında bir Görünüm sayfasında belirir; orada oturum açmış herkes kendine bir tane seçebilir. Bu, kendi gördüklerini değiştirir, başkaları için hiçbir şeyi değiştirmez. Hiç işaret yoksa kimse bir şey seçmez ve panel tek bir görünümde kalır - şu anda yaptığı da budur.',
    ],

    'mode' => [
        'label' => 'Panel kipi',
        'helper' => 'Panelin hangi kipte açıldığı. Kendisi seçmemiş olan bunu alır; kullanıcı menüsündeki seçici, aşağıda kilitlemediğin sürece onu değiştirmelerine izin vermeyi sürdürür.',
        'dark' => 'Koyu',
        'light' => 'Açık',
        'system' => 'Sistem - ziyaretçinin kendi ayarını izle',
    ],

    'font' => [
        'label' => 'Panelin yazı tipi',
        'helper' => 'Her seçenek işletim sisteminin zaten sahip olduğu bir ailedir - bir yazı tipi sağlayıcısından hiçbir şey indirilmez. Terminal etkilenmez: onun yazı tipi herkesin kendi seçimidir, Hesap altında.',
        'default' => 'Varsayılan - Pelican\'ın kendi seçimi',
        'mono' => 'Sabit genişlik',
        'rounded' => 'Yuvarlatılmış',
        'serif' => 'Tırnaklı',
        'system' => 'Sistem - bu makinenin kullandığı',
    ],

    'surface' => [
        'label' => 'Yüzey rengi',
        'helper' => 'Kartlar ve paneller. Daha açık ve daha koyu tonlar ondan türetilir.',
        'placeholder' => 'Temayı izle',
    ],

    'radius' => [
        'label' => 'Köşeler',
    ],

    'accent' => [
        'label' => 'Vurgu rengi',
        'helper' => 'Düğmeler, bağlantılar, etkin gezinme ögesi ve odak halkaları için kullanılır.',

        /*
         * Söylendi, dayatılmadı. Bunun uyardığı bir renk yine de kaydedilir: bu
         * birinin paneli, sayı tek bir şeyi ölçüyor ve düşük puan alan bir vurgu
         * istemenin iyi nedenleri olabilir. Seçici gördüğünü söyler ve kenara
         * çekilir.
         */
        'contrast_dark' => 'Okunabilirlik: koyu bir panele karşı :ratio. 3\'ün altında bir vurgunun düğme ya da bağlantı olarak okunması zordur - daha açık bir renk onu yükseltir.',
        'contrast_light' => 'Okunabilirlik: açık bir panele karşı :ratio. 3\'ün altında bir vurgunun düğme ya da bağlantı olarak okunması zordur - daha koyu bir renk onu yükseltir.',
    ],
    'density' => [
        'label' => 'Yoğunluk',
        'helper' => 'Sıkışık, ekrana daha çok satır sığsın diye boşlukları daraltır.',
        'comfortable' => 'Ferah',
        'compact' => 'Sıkışık',
    ],
    'force_dark' => [
        'label' => 'Koyu kipi zorunlu kıl',
        'helper' => 'Açık ile koyu arasındaki seçiciyi gizler ve her kullanıcıyı koyu temada tutar.',
    ],
    'glass' => [
        'label' => 'Buzlu topbar',
        'helper' => 'Topbar\'ı ve iletişim kutularının arkasındaki arka planı bulanıklaştırır. Zayıf aygıtlarda kapat.',
    ],
    'glow' => [
        'label' => 'Vurgu parıltısı',
        'helper' => 'En önemli düğmelerde, etkin gezinmede ve giriş kartında yumuşak bir vurgu gölgesi.',
    ],

    'background' => [
        'label' => 'Arka plan türü',
        'helper' => 'Aurora, temanın kendi arka planıdır: ince bir taneyle vurgu parıltısı.',
        'aurora' => 'Aurora (varsayılan)',
        'solid' => 'Tek renk',
        'gradient' => 'Geçiş',
        'image' => 'Görsel',
        'color' => 'Renk',
        'base' => 'Parıltının arkasındaki renk',
        'base_helper' => 'Vurgu parıltısı üzerine boyanmadan önce sayfanın üzerinde durduğu şey. Panelin varsayılanını korumak için boş bırak; o da koyu kipte neredeyse siyah, açık kipte neredeyse beyazdır. Ayarlarsan, bir düzen kendi gece rengini korur ve yine de aydınlanır.',
        'color_end' => 'İkinci renk',
        'angle' => 'Yön',
        'upload' => 'Bir görsel yükle',
        'upload_helper' => 'En çok 8 MB. Yüklenen bir görsel aşağıdaki adresi yener.',
        'url' => 'Ya da bir URL',
        'url_helper' => 'https:// ile başlamalı ve dışarıdan erişilebilir olmalı.',
        'dim' => 'Karart',
        'dim_helper' => 'Kararma olmadan, aydınlık bir görsel üzerindeki beyaz metin okunmaz.',
        'blur' => 'Bulanıklık',
    ],

    'channel' => [
        'installed' => 'kurulu',
        'version' => 'Belirli bir sürümü kur',
        'version_helper' => 'Bu kanaldaki her yayın, yalnızca en yenisi değil - yeni bir şey daha kötü çıktığında geri dönmek ya da birinin denemeni istediği bir derlemeye ileri gitmek için. Yalnızca güncellemeler kendi kendini kurmuyorken: o açıkken seçimin ancak bir sonraki denetime kadar sürerdi.',
        'version_placeholder' => 'Bir sürüm seç',
        'version_install' => 'Bu sürümü kur',
        'version_confirm' => 'Panel o yayını indirir, asset\'lerini yeniden kurar ve önbelleklerini temizler. Ayarların korunur. Daha eski bir sürüme dönmene izin vardır ve senin yerine hiçbir şey geri alınmaz - ileri gitmek için yenisini yeniden seç.',
        'label' => 'Güncelleme kanalı',
        'helper' => 'Tema sayfasının hangi yayınları sunduğu. Yeni sürümleri önce beta alır ve keskin köşeleri de önce o alır.',
        'token' => 'Dev deposu token\'ı',
        'token_helper' => 'Dev kanalı özel bir depodan yayımlanır, bu yüzden onu okumak bir GitHub token\'ı ister - o deponun içeriğine okuma erişimi olan, başka hiçbir şeyi olmayan ince ayarlı bir kişisel erişim token\'ı. Kararlı ve beta herkese açıktır ve hiçbirini gerektirmez. Bu panelde kalır: dışa aktarılan ayar dosyasına yazılmaz.',
        'stable' => 'Kararlı',
        'beta' => 'Beta',
        'dev' => 'Dev (çalışma dalı)',
        'auto' => [
            'label' => 'Güncellemeleri kendiliğinden kur',
            'helper' => 'Kapalı, güncellemeyi sana bırakır. Açık, panelin seçilen kanalı denetlemesini ve daha yeni olan her şeyi kurmasını sağlar - bu arada asset\'lerini yeniden kurar ve birkaç dakika erişilemez olur, bu yüzden günlük ve haftalık olanlar 04:00\'te çalışır. Panelin cron\'unun çalışmasını gerektirir.',
            'interval' => 'Şu aralıkla denetle',
            'minute' => 'Her dakika',
            'five_minutes' => '5 dakikada bir',
            'ten_minutes' => '10 dakikada bir',
            'thirty_minutes' => '30 dakikada bir',
            'hourly' => 'Her saat',
            'daily' => 'Her gün (04:00)',
            'weekly' => 'Her hafta (pazartesi 04:00)',
        ],
    ],

    /*
     * Diller sekmesi.
     *
     * Neyi savunduğuna dikkat. Pelican zaten herkesin tüm hesabı için bir dil
     * seçmesine izin veriyor ve onu zaten kullanıyor; burada hiçbir şey bunu
     * değiştirmez ve değiştirmemeli. Bu yalnızca, bu eklentinin kendi
     * metinlerinin o seçimi izleyip izlemeyeceğine karar verir.
     */
    'languages' => [
        'section_helper' => 'Pelican zaten herkesin hesabı için bir dil seçmesine izin veriyor ve bu eklenti, çevrildiği yerde onu izliyor. Burada hangilerini izleyeceğine karar veriyorsun. Çoğu dil bilerek düşük bir yüzdede duruyor: önce çevrilen, herkesin her sayfada gördüğü bölümdür - bir konsolun üstündeki güç düğmeleri ve node göstergeleri - geri kalanı da insanlar getirdikçe gelir.',
        'panel' => 'Panelin tamamının dilini bu belirlesin',
        'panel_helper' => 'Açık: bu eklentinin taşımadığı bir dil - ya da aşağıda kapatılmış olan biri - o okur için yalnızca bu sayfaları değil, panelin tamamını İngilizceye çevirir. Kapalı: listeyi yalnızca bu eklenti izler ve Pelican hesabın ayarlandığı dili konuşmayı sürdürür; bu da bir okurun tek bir ekranda iki dille karşılaşabileceği anlamına gelir. Hiçbir hesap iki yönde de değişmez: bir dili yeniden aç, ona geri kavuşurlar.',
        'label' => 'Yanıt verilecek diller',
        'helper' => 'İşareti kaldırmak, hesabında o dil ayarlı olan okurları yalnızca bu eklenti için İngilizceye geri gönderir - panelin geri kalanı yine onların dilini konuşur. İngilizce listede değil, çünkü her şey ona geri düşer.',
        'under' => 'daha ilerlemeden sunulmaz - yine de sunmak için işaretle',
        'done' => '%:percent çevrildi',
        'main' => 'Ana dil',
        'main_helper' => 'Bir okurun kendi dili kullanılamadığında aldığı şey - ya bu eklenti onu taşımıyordur ya da aşağıda işaretli değildir. Hep İngilizceydi; İngilizce çalışmayan bir ekipte bu, kendinden emin verilmiş yanlış bir yanıttı. İşaret aşağıda kaldırılamaz, çünkü her şey ona geri düşer.',
        'labels' => 'Her dilin adı',
        'labels_helper' => 'Okurların ve yöneticilerin seçicilerde gördüğü ad. Bu eklentinin onu bildiği adı korumak için birini boş bırak. Kendi uydurduğun bir adla yüklenen bir dilin böyle bir adı olmaz, bu yüzden sen burada bir tane verene dek kodu ile durur.',
        'labels_code' => 'Kod',
        'labels_name' => 'Şöyle görünür',
        'download' => 'Bir çeviri dosyası indir',
        'download_from' => 'Şuradan başla',
        'download_from_helper' => 'Bu eklentideki her metni içeren bir JSON. Kimsenin başlamadığı bir dil için İngilizceyi, çevrilmiş olanın üzerine kurmak için var olan bir dili seç.',
        'code' => 'Dil kodu',
        'code_helper' => 'Dosyanın hangi kod için olduğu. Hesapların kullandığı gibi gerçek bir locale - fr, de, pt_BR - onu ayarlamış okurlara ulaşır ve tam olarak eşleşmelidir, yoksa ulaşmaz. Gaming-TR gibi kendi uydurduğun bir ad da geçerlidir ve başka türlü çalışır: Pelican bir hesaba yalnızca gerçek bir locale verir, bu yüzden seninkini kimse seçemez. Yukarıdaki ana dil olarak ulaşılabilir; o da kendi dili kullanılamayan herkesin aldığı şeydir.',
        'url' => 'Ya da onu bir adresten al',
        'url_helper' => 'Panelin ulaşabildiği bir https adresi - bir CDN, bir bucket, bir depodaki ham dosya. Kaydettiğinde bir kez alınır ve yüklenen bir dosyayla aynı biçimde yazılır, bu yüzden o adresteki dosyayı sonradan değiştirmek, sen yeniden kaydedene dek hiçbir şey yapmaz. Yukarıda seçilen bir dosya, bu alanda kalmış bir adresi yener.',
        'upload' => 'Bir çeviri dosyası yükle',
        'upload_helper' => 'Yukarıdaki JSON dosyası, değerleri çevrilmiş olarak. Eklentinin dışına yazılır, bu yüzden bir güncelleme onu atmaz ve İngilizcenin üzerine anahtar anahtar serilir - metinlerin yarısını içeren bir dosya sana yarım bir dil ve geri kalanı için İngilizce verir.',
        'uploaded' => ':code için :count metin kuruldu',
        'uploaded_halves' => 'Bunların :mine tanesi bu eklentinin kendi metinleri, :panel tanesi panelin. Bir taraftaki sıfır, dosyanın o yarısının hiçbir şey içermediği anlamına gelir - eklentinin anahtarları essentials:: ile başlar, panelinkiler başlamaz.',
        'uploaded_skipped' => ':count tanesi atlandı: boş olanlar ya da bu eklentinin sahip olmadığı anahtarlar. İlkleri: :keys',
        'upload_failed' => 'O dosya okunamadı',
        'upload_failed_body' => 'Yukarıdaki indirmedeki JSON dosyası olmalı - anahtar ve metinlerden oluşan düz bir nesne. Bir düzenleyicinin onu başka bir şey olarak kaydetmediğini denetle.',
    ],

    'windows' => [
        'add' => 'Bir aralık ekle',
        'from' => 'Şundan',
        'to' => 'Şuna',
        'to_helper' => 'Başlangıçtan daha erken olması gece yarısını geçtiği anlamına gelir - 22:00\'den 06:00\'ya gecedir.',
        'preset' => 'Stil',
        'days' => 'Günler',
        'days_helper' => 'Her gün için hepsini işaretsiz bırak. Gece yarısını geçen bir aralık, başladığı güne aittir; bu yüzden cuma 22:00\'den 06:00\'ya cumartesi sabahını kapsar.',
        'day_mon' => 'Pazartesi',
        'day_tue' => 'Salı',
        'day_wed' => 'Çarşamba',
        'day_thu' => 'Perşembe',
        'day_fri' => 'Cuma',
        'day_sat' => 'Cumartesi',
        'day_sun' => 'Pazar',
    ],

    'arranger' => [
        'label' => 'Sayfa düzenleyici',
        'helper' => 'Panelin her sayfasındaki "Sayfayı düzenle" düğmesi. Düzenle iznine sahip herkes onu alır ve herkesin başladığı düzeni ya da bir rol için bir düzeni de ayarlayabilir. Kapalı onu herkesten gizler; zaten kaydedilmiş düzenler oldukları yerde kalır.',
        'roles' => 'Bir düzen bir izin değildir. Bir rolün gizlediği bir blok, birinin adresi yazarak ulaşabileceği bir blok olmayı sürdürür - bunu durduran şey, roller sayfasındaki Pelican\'ın kendi izinleridir. Üç katman şu sırayla konur: herkesin başladığı düzen, sonra okurun rolü, sonra da kendisinin taşıdıkları.',
        'users' => 'Herkes kendi sayfalarını düzenlesin',
        'users_helper' => 'Açık, oturum açmış herkesin zaten görebildiği sayfalarda blokları taşımasına ve gizlemesine yalnızca kendisi için izin verir - başkaları için hiçbir şeyi değiştirmez. Herkesin başladığı düzeni ayarlamak, Düzenle izninde kalır.',
    ],

    'brand' => [
        'logo_height' => 'Logo yüksekliği',
        'logo_height_helper' => 'Pelican 2rem verir. Daha büyük değerler kenar çubuğunun başlığını da yükseltir.',
        'logo_url' => 'Logoyu değiştir',
        'logo_url_helper' => 'Pelican\'ın kendi ayarlarının işaret ettiğini korumak için boş bırak.',
    ],

    'login' => [
        'image' => 'Arka plan görseli',
        'image_helper' => 'Yalnızca giriş ekranı için. O olmadan yine panelin arka planını gösterir.',
        'url' => 'Ya da bir URL',
        'blur' => 'Kartın bulanıklığı',
        'blur_helper' => 'Kartı buzlandırır, böylece arkasındaki görsel içinden görünür.',
        'width' => 'Kart genişliği',
        'position' => 'Görselin çerçevelenmesi',
        'position_helper' => 'Ekrana kırpılmaktan görselin hangi bölümünün kurtulduğu.',
        'position_center' => 'Orta',
        'position_top' => 'Üst',
        'position_bottom' => 'Alt',
        'position_left' => 'Sol',
        'position_right' => 'Sağ',
        'align' => 'Kartın yeri',
        'align_helper' => 'Giriş kartının ekran boyunca nerede durduğu.',
        'align_center' => 'Orta',
        'align_start' => 'Sol',
        'align_end' => 'Sağ',
        'opacity' => 'Kartın saydamsızlığı',
        'opacity_helper' => 'Daha düşüğü, karttan daha çok görsel geçirir.',
        'glow' => 'Vurgu parıltısı',
        'glow_helper' => 'Kartın çevresindeki hale. Kapalı, kenarlığını ve derinliğini korur.',
        'hide_heading' => 'Başlığı gizle',
        'hide_heading_helper' => 'Formun üstündeki başlığı kaldırır ve formu yalnız bırakır.',
        'hide_footer' => 'Alt satırı gizle',
        'hide_footer_helper' => 'Kartın altındaki, pelican.dev adresine giden satırı kaldırır.',
        'above' => 'Formun üstünde bir satır',
        'above_helper' => 'Tek satır; giriş ekranına gelen herkese gösterilir. Hiçbiri olmaması için boş bırak.',
        'notice' => 'Kartın altında bir ileti',
        'notice_helper' => 'Tek satır; giriş ekranına gelen herkese gösterilir. Hiçbiri olmaması için boş bırak.',
    ],

    'advanced' => [
        'css' => 'Kendi CSS\'in',
        'css_helper' => 'En çok 100 KB. .env dosyasına değil, storage\'a kaydedilir.',
        'reference' => 'CSS başvurusu',
        'reference_helper' => 'Bu temanın ve panelin sunduğu her değişken ve sınıf.',
    ],

    'areas' => [
        'add' => 'Bir alan ekle',
        'area' => 'Alan',
        'inherit' => 'Ortak',
        'radius' => 'Köşeler',
        'radius_sharp' => 'Keskin',
        'radius_normal' => 'Olağan',
        'radius_round' => 'Yuvarlak',
        'surface' => 'Yüzey rengi',
        'surface_helper' => 'Bu alanın içindeki kartlar ve paneller; daha açık ve daha koyu tonlar ondan türetilir.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Konsol (sayfanın geri kalanı)',
            'files' => 'Dosyalar sayfası',
            'edit' => 'Düzenleme sayfası',
            'server' => 'Diğer sunucu sayfaları ve sekmeleri',
        ],
    ],

    'bars' => [
        'base' => 'Temel renk',
        'base_green' => 'Yeşil',
        'base_accent' => 'Vurgu rengi',
        'warning' => 'Şundan sonra kehribar',
        'danger' => 'Şundan sonra kırmızı',
    ],

    'icons' => [
        'stroke' => 'Çizgi kalınlığı',
        'stroke_thin' => 'İnce',
        'stroke_normal' => 'Olağan',
        'stroke_bold' => 'Kalın',
        'scale' => 'Boyut',
        'accent' => 'Menü simgeleri vurgu renginde',
        'accent_helper' => 'Kenar çubuğundaki ve topbar\'daki simgeler için geçerli.',
        'pack' => 'Simge paketi',
        'pack_helper' => 'Aşağıdaki seçicinin hangi kümeden aldığı. Sunucuda kurulu her simge kümesi, bu eklentiyle gelen Essentials kümesi ve yüklediğin her paket sunulur. Bilmeye değer bir fark var: çizgi bir simge menünün renginde çizilir ve üzerine gelmeyi ve etkin satırı izler; Essentials simgeleri ise görsel oldukları için kendi renklerini korurlar. Buna dosyanın ne olduğu karar verir, hangi kümeden geldiği değil.',
        'pack_custom' => 'Yüklenen paket',
        'pack_shipped' => 'Essentials simgeleri',
        'use_shipped' => 'Her yerde Essentials simgelerini kullan',
        'use_shipped_confirm' => 'Paketi Essentials simgelerine ayarlar ve aşağıdaki her menü satırını onun için çizilmiş simgeyle doldurur - konsol terminali alır, başlatma başlat düğmesini alır, ve böyle sürer. Şu anki satırlarının yerine geçer ve Kaydet\'e basmadan hiçbir şey kaydedilmez, bu yüzden sayfayı kapatmak bunu geri alır.',
        'pack_upload' => 'Bir paket yükle',
        'pack_upload_helper' => 'SVG dosyaları içeren bir .zip. Her dosya, adını taşıyan bir simgeye dönüşür - logo.svg custom-logo olur. Yüklemek şu anda oradaki paketin yerine geçer. 256 KB üzerindeki dosyalar ve 4.000 simgeyi aşan her şey dışarıda bırakılır ve sana kaç tane olduğu söylenir: ölçek olarak, tüm Tabler kümesi yaklaşık üç megabaytta neredeyse altı bin simgedir; yani çok daha büyük bir paket simgeden başka bir şey taşıyordur ve büyük bölümü atlanacaktır. Büyük bir yükleme, bu alan bir şey söylemeden önce panel makinesindeki php.ini içinde upload_max_filesize ve post_max_size tarafından da reddedilebilir - buradaki hiçbir ayar onları yükseltemez.',
        'pack_partial' => ':count simge kuruldu, ama hepsi değil',
        'pack_partial_body' => 'Atlananlar: :big tanesi bir simge için çok büyük, :unusable tanesi SVG olarak kullanılamaz, :duplicate tanesi zaten alınmış bir adla, :empty tanesi temizlendiğinde çizilecek hiçbir şeyi kalmamış. 256 KB üzerindeki bir SVG neredeyse her zaman bir çizim değil, içine sarılmış bir görseldir - onu simge boyutunda dışa aktar, birkaç kilobayt olur. Çizilecek hiçbir şeyi kalmayan bir simge yalnızca buranın sunmadığı şeyleri içeriyordu - bütün bir paket öyleyse bildirmeye değer.',
        'pack_stopped_files' => 'Ayrıca bir paketin içerebileceği simge sayısı sınırında da durdu.',
        'pack_stopped_size' => 'Ayrıca paketin geri kalanı, panelin bir seferde bellekte tutabileceğinden fazlasına açıldığı için de durdu - zip bundan küçük olabilir, çünkü SVG yaklaşık beşte bire sıkışır.',
        'overrides' => 'Simgeleri değiştir',
        'overrides_helper' => 'Değiştirmek istediğin her simge için bir satır. Menü ögesini seç, sonra da yukarıdaki paketten bir simge seç, bir adres ver ya da kendi görselini yükle. Birden fazlası doldurulmuşsa yükleme kazanır, sonra adres, sonra paket.',
        'overrides_key' => 'Menü ögesi',
        'overrides_value' => 'Paketten simge',
        'overrides_url' => 'Ya da bir adres',
        'overrides_url_helper' => 'Kendi barındırdığın bir görsele giden bir https adresi - bir CDN, bir bucket, tarayıcının ulaşabildiği herhangi bir yer. Panele hiçbir şey kopyalanmaz, bu yüzden o adresteki dosyayı değiştirmek, bu sayfaya dokunmadan simgeyi değiştirir; öteki yüzü ise adres yok olduğunda yok olan bir simgedir. Yüklenen bir görsel gibi kendi renklerini korur.',
        'overrides_file' => 'Ya da bir görsel yükle',
        /*
         * Farkın gerçekte ne olduğunu söylüyor; çünkü apaçık değil ve birini
         * ötekine yeğlemenin nedeni de bu.
         */
        'overrides_file_helper' => 'PNG, SVG ya da ICO. Paketten gelen bir simge menünün kendi renginde çizilir ve üzerine gelmeyi ve etkin satırı izler; yüklenen bir görsel kendi renklerini korur ve bunu yapmaz. Bir logo için genellikle istenen budur.',
        'overrides_add' => 'Bir simge daha değiştir',
        'overrides_search' => 'Bir ad ya da menü ögesi yaz…',
    ],

    /*
     * Markanın altında değil. Marka, panelin nasıl göründüğüyle ilgilidir; bu
     * ise bu eklentinin onun içinde nasıl göründüğüyle ilgilidir ve bu, başka
     * bir sayfada yanıtlanan başka bir sorudur.
     */
    'identity' => [
        'nav_icon' => '"Essentials ayarları" satırı için simge',
        'nav_icon_helper' => 'PNG, SVG ya da ICO; en çok 8 MB. Kenar çubuğundaki tam olarak o tek satırın simgesinin yerine geçer; bu eklentinin birlikte geldiği simge için boş bırak. Bir simge olarak değil bir görsel olarak çizilir, bu yüzden metni izlemek yerine kendi renklerini korur - bir logonun genellikle istediği de budur. Dosya gömülmez, sunulur; bu yüzden her tarayıcı onu bir kez alır, ama yine de küçük bir şey dışa aktarmaya değer: yirmi piksellik bir satır için birkaç kilobayt fazlasıyla yeter. Bir yükleme bu alan bir şey söylemeden başarısız olursa, çarptığı sınır panelin php.ini dosyasındaki upload_max_filesize\'dır.',
    ],
];
