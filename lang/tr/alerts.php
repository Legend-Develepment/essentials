<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Bekçi.
 *
 * Buradan giden her ileti bir telefonda, gecenin üçünde, bir dakika önce
 * uyumakta olan biri tarafından okunuyor. Her biri hangi makine olduğunu, neyin
 * yolunda gitmediğini söylüyor ve fazlasını değil - ayrıntı, insanın sonradan
 * açacağı sayfaya aittir, onu uyandıran satıra değil.
 *
 * Bir şeyin düzeldiği, bir dipnot olarak değil bir haber olarak yazıldı. "Geri
 * geldi mi" sorusu, yoksa birinin uğruna kalkacağı sorudur.
 *
 * "Node", "Wings", "daemon", "webhook", "queue", "Discord" ve "SMTP" İngilizce
 * kalıyor: onları Pelican'da, makinede ve haklarında yazılan her şeyde bu
 * adlarla bulursun.
 */

return [
    'title' => 'Uyarılar',
    'nav_label' => 'Uyarılar',
    'subheading' => 'Panel bir node\'un yanıt vermeyi bıraktığını, bir diskin dolduğunu ya da kuyruğun durduğunu zaten biliyor. Bu, onu sana söyleyen şey.',

    // ---- kanallar ve son ne yaptıkları ------------------------------------
    'channels' => 'İletiler nereye gidiyor',
    'channels_helper' => 'Her kanalın, kendisinden bir şey göndermesi istendiğinde son yaptığı şey. Açık olup sessizce reddeden bir kanal, hiçbir şeyin yolunda gitmediği bir panelle tıpatıp aynı görünür; bu yüzden bu, sayfada ilk sırada duruyor.',

    'state_off' => 'Kapalı',
    'state_untried' => 'Henüz hiçbir şey gönderilmedi',
    'state_ok' => 'Ulaştırıldı',
    'state_failed' => 'Reddedildi',

    // ---- ne zaman ----------------------------------------------------------
    'when' => 'Ne sıklıkla',
    'when_helper' => 'Denetimler arka planda çalışır, bu yüzden bir queue worker isterler. O olmadan hiçbir şey gönderilmez ve hiçbir şey bunu söylemez — kuyruktan geçmeyen "Bir deneme gönder"i kullan.',

    'every' => 'Şu aralıkla denetle',
    'every_helper' => 'Her denetim her node\'un daemon\'una ulaşır, yani node ve tur başına bir istek. On beş dakika, bir kesintiyi daha kesintiyken duyman için yeter.',
    'every_off' => 'Kapalı — hiç denetim yok',
    'every_five' => '5 dakika',
    'every_fifteen' => '15 dakika',
    'every_thirty' => '30 dakika',
    'every_hourly' => 'Saat',
    'every_daily' => 'Gün',

    'repeat' => 'Sürdüğü sürece bana anımsat',
    'repeat_helper' => 'Bir şey değiştiğinde bir ileti, düzeldiğinde bir tane daha gönderilir. Bu, sorun hâlâ sürerken bir anımsatma ekler. Sıfır, anımsatma yok demektir — her çeyrek saatte kendini yineleyen bir kanal, insanların sustuduğu bir kanaldır.',
    'hours' => 'saat',

    // ---- nereye ------------------------------------------------------------
    'where' => 'Kanallar',
    'where_helper' => 'Birden fazlası akıllıcadır. Farklı biçimlerde bozulurlar.',

    'discord' => 'Discord',
    'discord_helper' => 'Bir iletinin, panele bakarak oturmayan biri tarafından gerçekten okunduğu yer.',
    'webhook' => 'Webhook adresi',
    'webhook_helper' => 'Discord\'da: Sunucu ayarları → Entegrasyonlar → Webhooks → Yeni webhook → Webhook URL\'sini kopyala. https ile sınırlı, çünkü bu makinelerinden hangisinin kapalı olduğunu ve diskinin ne kadar dolu olduğunu yayımlar.',

    'panel' => 'Panelde',
    'panel_helper' => 'Bu izne sahip herkese bir bildirim. Her zaman çalışır, ayar istemez ve oturum açmamış herkes için görünmezdir.',

    'email' => 'E-posta',
    'email_helper' => 'Virgülle ayrılmış. Panelin kendi mailer\'ını kullanır — ayarlıysa güvenilir, değilse tamamen sessizdir ve bir bekçinin sahip olamayacağı tek arıza budur. Kapatmak için boş bırak.',

    // ---- ne -----------------------------------------------------------------
    'what' => 'Neye göz kulak olunuyor',
    'what_helper' => 'Buradaki her ölçüm, panelin zaten aldığı bir ölçüm. Bu sayfadaki hiçbir şey, Sistem durumunun açmadığı bir bağlantı açmaz.',

    'percent_helper' => 'Sıfır bu denetimi kapatır.',
    'disk' => 'Bir node\'un diski şunu aştığında uyar',
    'memory' => 'Bir node\'un belleği şunu aştığında uyar',

    'maintenance' => 'Şundan uzun süren bakım için uyar',
    'maintenance_helper' => 'Bakımdaki bir node diğer tüm denetimlerce atlanır ve bu doğrudur — ve bir tanesinin on dört gün unutulması da tam böyle olur. Sıfır bunu kapatır.',

    'versions' => 'Panel ve Wings sürümleri',
    'versions_helper' => 'Bir şey geride kaldığında bir ileti, yeniden güncel olduğunda bir tane daha. Anımsatma yok — bir sürüm kesinti değildir.',

    'backups' => 'Geride kalmış yedekler',
    'backups_helper' => 'Sunucu başına bir tane yerine, sunucuları anan tek bir ileti — zamanlanmış bir görev durduğunda tüm sunucular aynı anda bayatlar ve tek bir neden için kırk ayrı ileti, insanların sustuduğu bir kanaldır. Varsayılan olarak kapalı: zamanlamayla değil elle yedek alan bir panel bunu her gün duyardı.',
    'backup_days' => 'Bir yedeği şu süreden sonra bayat say',
    'backup_days_helper' => 'Yedekler sayfası da bunu kullanır. Haftalık yedeklenen bir sunucu sekiz gün sonra bildirilmemeli.',
    'days' => 'gün',

    'worker' => 'Queue worker',
    'worker_helper' => 'Bu eklentinin arka plan işini gerçekten bir şeyin yapıp yapmadığı. Şu döngüye dikkat et: denetimin kendisi kuyrukta çalışır, bu yüzden hiç worker\'ı olmamış bir panel bunu bildiremez bile. Bu sayfanın başındaki satır bildirebilir.',

    // ---- düğmeler ----------------------------------------------------------
    'save' => 'Kaydet',
    'saved' => 'Kaydedildi',
    'save_failed' => 'Hiçbir şey kaydedilmedi',

    'test' => 'Bir deneme gönder',
    'test_one' => 'Dene',
    'test_off' => 'O kanal kapalı',
    'test_off_body' => 'Onu aç ve kaydet, ötekilerle birlikte denenir.',
    'test_title' => 'Deneme iletisi',
    'test_body' => 'Bunu okuyorsan, Pelican panelinden gelen uyarılar buraya ulaşıyor. Yolunda gitmeyen bir şey yok.',
    'test_sent' => 'Açık olan her kanala gönderildi',
    'test_failed' => 'En az bir kanal onu reddetti',
    'test_none' => 'Gönderilecek bir yer yok',
    'test_none_body' => 'Hiçbir kanal açık değil, bu yüzden gerçek bir uyarı da hiçbir yere ulaşmazdı.',

    /*
     * Bir reddetmeyle ne yapılacağı.
     *
     * Bir sağlayıcının kendi gerekçesi kısa, doğru ve tek başına işe yaramazdır.
     * Neredeyse her seferinde çıkan iki tanesi adlarıyla anıldı, çünkü ikisi de
     * koddan tahmin edilemez: bir 553 alıcıyla değil göndericiyle ilgilidir ve
     * Discord'dan gelen bir 401, geri çekilmiş ya da yanlış yazılmış bir URL'dir.
     */
    'hint_email_sender' => 'SMTP sunucun, panelin gönderdiği adresi reddetti; gönderdiği adresi değil. Admin → Ayarlar → E-posta altında Kimden adresi, SMTP hesabının adına gönderme izni olduğu bir posta kutusu olmalı. Bunun bu eklentiyle ilgisi yok — o sayfadaki Pelican\'ın kendi deneme e-postası da tam olarak aynı biçimde başarısız olur.',
    'hint_email' => 'Admin → Ayarlar → E-posta altına bak. O sayfadaki deneme e-postası düğmesi aynı ayarları kullanır ve aynı şeyi söyler.',
    'hint_discord_url' => 'Discord o webhook\'u tanımadı. Silinmiş, yeniden oluşturulmuş ya da eksik yapıştırılmış — Sunucu ayarları → Entegrasyonlar → Webhooks altında yeni bir tane oluştur ve URL\'nin tamamını kopyala.',
    'hint_discord' => 'Panel Discord\'a ulaşamadı. Bu panel giden istekleri engelleyen bir güvenlik duvarının arkasındaysa, bu kanal buradan çalışamaz.',
    'hint_panel' => 'Kimsenin buna izni yok ya da bildirim kaydedilemedi. Roller altına bak.',

    'run_now' => 'Denetimleri şimdi çalıştır',
    'run_started' => 'Arka planda denetleniyor',
    'run_failed' => 'Denetimler başlatılamadı',

    'reset' => 'Bildiklerini unut',
    'reset_confirm' => 'Her denetimin son söylediğini boşaltır. Sonraki tur sıfırdan öğrenir ve hiçbir şey göndermez, bu yüzden hâlâ süren bir sorun ondan sonraki turda bildirilir. Bunu, bekçinin söylenip durduğu bir node\'u hizmet dışı bıraktıktan sonra kullan.',
    'reset_done' => 'Boşaltıldı',

    // ---- iletilerin kendisi ------------------------------------------------
    'still' => ':for süredir sürüyor.',
    'cleared_body' => ':for süredir böyleydi.',

    'for_unknown' => 'bir süredir',
    'for_minutes' => ':count dakika',
    'for_hours' => ':count saat',
    'for_days' => ':count gün',

    'node_down' => ':node yanıt vermiyor',
    'node_down_body' => 'Panel :node üzerindeki daemon\'a ulaşamıyor. Üzerindeki sunucular o geri gelene dek ne başlar, ne durur, ne de bir şey bildirir.',
    'node_up' => ':node yeniden yanıt veriyor',

    'node_disk' => ':node üzerinde disk tükeniyor',
    'node_disk_body' => ':node üzerindeki disk %:percent dolu; ayarladığın %:limit sınırının üstünde. Bu dolduğunda ilk bozulanlar yedekler ve sunucu kurulumları olur.',
    'node_disk_over' => ':node üzerindeki disk yeniden sınırın altında',

    'node_memory' => ':node üzerinde bellek tükeniyor',
    'node_memory_body' => ':node üzerindeki belleğin %:percent kadarı kullanımda; ayarladığın %:limit sınırının üstünde. Üzerindeki sunucular, herhangi bir şey sorun bildirmeden önce çekirdek tarafından öldürülebilir.',
    'node_memory_over' => ':node üzerindeki bellek yeniden sınırın altında',

    'node_maintenance' => ':node uzun süredir bakımda',
    'node_maintenance_body' => ':node :hours saatten uzun süredir bakımda. Bu arada üzerinde başka hiçbir şey denetlenmiyor ve bütün amaç da bu — ama hâlâ öyle durduğunu bilmeye değer.',
    'node_maintenance_over' => ':node bakımdan çıktı',

    'wings_behind' => ':node üzerindeki Wings eski',
    'wings_behind_body' => ':node, Wings :installed sürümünü çalıştırıyor ve :latest çıkmış durumda. Onu node\'un kendisinde güncelle — panelin bunu yapacak bir yolu yok.',
    'wings_current' => ':node üzerindeki Wings güncel',

    'panel_behind' => 'Panel eski',
    'panel_behind_body' => 'Bu panel :installed sürümünü çalıştırıyor ve :latest çıkmış durumda.',
    'panel_current' => 'Panel güncel',

    'and_more' => 've :count tane daha',

    'owners' => 'Kendi sunucularının arkasındaki makine kapalıyken insanlara haber ver',
    'owners_helper' => 'Buradaki, senden başkasına yazan tek denetim. Yanıt vermeyi bırakmış bir makinedeki her sunucunun sahibi panelde bir bildirim alır — zil, hiçbir zaman e-posta değil — ve makine geri geldiğinde bir tane daha. Arada hiçbir zaman bir anımsatma olmaz: yoğun bir node\'daki herkese bunu çeyrek saatte bir yinelemek, bir panelin uyarılarının artık okunmamaya başlamasının yoludur. Subuser\'lara haber verilmez; ne yapılacağına sahip karar verir. Makine onlara anılmaz; durum sayfasının da onu yayımlamamasıyla aynı nedenle.',

    'owner_down' => 'Sunucularından biri kapalı|Sunucularından :count tanesi kapalı',
    'owner_down_body' => 'Üzerinde durdukları makine yanıt vermeyi bıraktı. Birine haber verildi. Etkilenenler: :servers',
    'owner_up' => 'Sunucun geri geldi|Sunucularından :count tanesi geri geldi',
    'owner_up_body' => 'Makine yeniden yanıt veriyor. Geri gelenler: :servers',

    'schedules' => 'Durmuş zamanlanmış görevler',
    'schedules_helper' => 'Bir çalışmanın ortasında takılmış bir görev, cron çalışmadığı için saati geçmiş bir görev ya da hiç çalışmamış bir görev. Pelican\'ın bunların hiçbiri için bir sözcüğü yok — düşmüş bir çalışma sonsuza dek "işliyor" kalır ve şu anda çalışan bir tanesiyle tıpatıp aynı çizilir. Her denetimde panelin her etkin zamanlanmış görevini okur.',

    'schedule_stopped' => ':count zamanlanmış görev durdu',
    'schedule_stopped_body' => ':hours saatten uzun süredir takılı, gecikmiş ya da hiç çalışmamış: :schedules',
    'schedule_running' => 'Tüm zamanlanmış görevler yeniden çalışıyor',

    'backup_none' => ':count sunucunun hiç yedeği olmamış',
    'backup_none_body' => 'Şunlarda hiç yedek alınmamış: :servers',
    'backup_none_over' => 'Artık her sunucunun bir yedeği var',

    'backup_stale' => ':count sunucu bir süredir yedeksiz',
    'backup_stale_body' => 'Şunlarda :days gündür başarılı bir yedek yok: :servers',
    'backup_stale_over' => 'Her sunucunun yakın zamanda bir yedeği olmuş',

    'backup_failed' => 'Yedekler :count sunucuda başarısız oluyor',
    'backup_failed_body' => 'Şunlarda bir yedek başarısız sonlandı: :servers',
    'backup_failed_over' => 'Artık hiçbir yedek başarısız olmuyor',

    'worker_missing' => 'Kuyrukta çalışan bir şey yok',
    'worker_missing_body' => 'Bir iş kuyruğa alındı ve hiçbir şey onu almadı. Eklenti güncellemeleri, modpack kurulumları ve bu denetimler, bir worker çalışana dek hep durur — panelin makinesinde systemctl status pelican-queue komutunu dene.',
    'worker_back' => 'Kuyrukta yeniden çalışılıyor',
];
