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
    'secret_kept' => 'Kaydedildi. Korumak için boş bırakın veya değiştirmek için yenisini yazın.',
    'update_background' => 'Arka planda çalışır ve bir iki dakika sürer.',

    /*
     * Queue worker ve zamanlayıcı (scheduler); her arka plan işi ve her
     * zamanlanmış görev bunlara bağlıdır. Ayrı söylendi, çünkü ayrı bozulurlar
     * ve her birinin çaresi farklıdır.
     */
    'worker_missing' => 'Hiçbir queue worker yanıt vermedi. Modpack kurulumları, e-postalar ve diğer arka plan işleri kuyruğa alınır ve bir worker süreci tarafından yürütülür; bu yüzden biri çalışana dek yazılıp bırakılır ve hiç yürütülmezler, hiçbir yerde bir hata da olmaz. Ya hiç worker yoktur ya da bu eklenti kurulmadan önce başlatılmış ve kodunu yükleyemeyen biri vardır - ikisi de panel makinesinde onu yeniden başlatmakla çözülür. Servisini kendi kendine yeniden başlayacak biçimde ayarla, yoksa bu her güncellemeden sonra geri gelir.',

    'cron_missing' => 'Panelin zamanlayıcısı :for dakikadır çalışmadı. Yenilemeler ve bekçi denetimleri onu bekler. Cron satırı Pelican belgelerinde.',

    /*
     * Belirtiye göre değil nedene göre adlandırıldı; çünkü belirti "hiçbir şey
     * olmadı" ve bunu yerleştirmeyi zorlaştıran da tam buydu: duyurular,
     * gezinme bağlantıları, kaydedilmiş stiller ve sayfa düzenleri hepsi
     * storage/app altındaki dosyalar ve panelin yazamadığı bir dizin bunların
     * her birini tek söz etmeden kaybeder.
     */
    'storage_failed' => 'Panel storage dizinine yazamadı, bu yüzden bu kaydedilmedi. storage/app dizininin panelin çalıştığı kullanıcıya ait olduğunu denetle. Nedeni storage/logs içinde.',
];
