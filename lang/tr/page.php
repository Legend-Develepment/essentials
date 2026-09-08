<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * "Queue worker", "cron", "storage" ve yollar panelin makinesinde yazıldıkları
 * gibi kalıyor: bir kabuğa tam olarak böyle yazılırlar.
 */

return [
    'title' => 'Essentials ayarları',
    'nav_label' => 'Essentials ayarları',
    'save' => 'Kaydet',
    'saved' => 'Ayarlar kaydedildi',
    'save_failed' => 'Ayarlar kaydedilemedi',
    'update' => 'Güncelle',
    'update_available' => 'Bir güncelleme var',
    'update_confirm' => 'Panel yeni sürümü indirir, asset\'lerini yeniden kurar ve önbelleklerini temizler. Ayarların korunur.',
    'update_started' => 'Güncelleme başladı',
    'update_background' => 'Arka planda çalışır ve bir iki dakika sürer.',
    'update_failed' => 'Tema güncellenemedi',
    'update_done' => 'Tema güncellendi',
    'check' => 'Güncellemeleri denetle',
    'check_failed' => 'Güncelleme akışı okunamadı',
    'check_failed_body' => 'Panel ona ulaşamadı ya da geçerli JSON döndürmedi.',
    'up_to_date' => 'En son sürümdesin',
    'reinstall' => 'Yeniden kur',

    'auto_on' => 'Güncellemeler kendi kendini kurar',

    /*
     * Son otomatik denetimin ne yaptığı. Bunların her biri bakılması gereken
     * parçayı adlandırır; çünkü bir tarayıcıdan bakınca bunun bozulduğu üç yol
     * da aynı görünür: geriye sayan bir sayı.
     */
    'auto_never' => 'Henüz hiçbir denetim çalışmadı. Otomatik güncellemeler panelin zamanlayıcısını ister — her dakika php artisan schedule:run çalıştıran cron girdisini. Onsuz zamanlanmış hiçbir şey olmaz.',
    'auto_ago' => 'Son denetim :ago',
    'auto_just_now' => 'az önce',
    'auto_minutes' => 'dakika önce',
    'auto_current' => 'bu kanalda daha yenisi yok.',
    'auto_installed' => 'v:version buraya, zamanlanmış denetimin kendisi tarafından kuruldu. Hiçbir queue worker yanıt vermediğinde bunu yapar, yani güncelleme her durumda olur — ama worker olmayan bir panel, kuyruktaki başka işlerin de yapılmadığı bir paneldir.',
    'auto_queued' => 'v:version queue worker sürecine verildi. Yukarıdaki sürüm birkaç dakika içinde değişmezse, worker işleri alıyor ama bunu yapamıyordur — onu yeniden başlatmak genelde çözer, nedeni de storage/logs içinde.',
    'auto_unreachable' => 'güncelleme akışı okunamadı. İnternet üzerinden alınıyor, bu yüzden bu genellikle panel makinesindeki bir ağ ya da DNS sorunudur.',
    'auto_error' => 'denetim başarısız oldu. Nedeni storage/logs içinde.',

    /*
     * Güncellemeyi asıl gerçekleştiren şey olan queue worker. Yukarıdaki
     * denetimden ayrı söylendi, çünkü ayrı bozulurlar ve her birinin çaresi
     * farklıdır.
     */
    'worker_missing' => 'Hiçbir queue worker yanıt vermedi. Güncellemeler ve modpack kurulumları kuyruğa alınır ve bir worker süreci tarafından yürütülür; bu yüzden biri çalışana dek yazılıp bırakılır ve hiç yürütülmezler, hiçbir yerde bir hata da olmaz. Ya hiç worker yoktur ya da bu eklenti kurulmadan önce başlatılmış ve kodunu yükleyemeyen biri vardır — ikisi de panel makinesinde onu yeniden başlatmakla çözülür. Servisini kendi kendine yeniden başlayacak biçimde ayarla, yoksa bu her güncellemeden sonra geri gelir.',

    'next_check' => 'Sonraki denetime',
    'due_now' => 'şimdi',

    /*
     * Belirtiye göre değil nedene göre adlandırıldı; çünkü belirti "hiçbir şey
     * olmadı" ve bunu yerleştirmeyi zorlaştıran da tam buydu: duyurular,
     * gezinme bağlantıları, kaydedilmiş stiller ve sayfa düzenleri hepsi
     * storage/app altındaki dosyalar ve panelin yazamadığı bir dizin bunların
     * her birini tek söz etmeden kaybeder.
     */
    'storage_failed' => 'Panel storage dizinine yazamadı, bu yüzden bu kaydedilmedi. storage/app dizininin panelin çalıştığı kullanıcıya ait olduğunu denetle. Nedeni storage/logs içinde.',

    /*
     * Yalnızca bir uyuşmazlıktan sonra değil, her başarısız güncellemeden sonra
     * söylendi. Yukarıdaki ileti nedeni zaten adlandırıyor; bu, bir insanın "X
     * bekledim, Y aldım" ifadesinden çıkaramayacağı tek çareyi adlandırıyor.
     */
    'update_renamed' => 'Burada iki kimliğin uyuşmadığı yazıyorsa, eklenti yeniden adlandırılmıştır ve hiçbir güncelleme bunu aşamaz — Pelican kurulu bir eklentiyi kimliğinden tanır. Admin → Plugins altındaki eski kaydı kaldır ve bunu sıfırdan kur. Ayarların hayatta kalır: .env dosyasında ve storage/app/private/legend-theme içinde yaşarlar ve ikisi de kimliğe göre anahtarlanmaz.',
];
