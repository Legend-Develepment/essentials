<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Siparişler: birinin ne aldığı ve ondan ne çıktığı.
 *
 * Aşağıdaki dört durum paradan söz eder, sunucudan değil. Sunucunun şu anda
 * çalışıp çalışmadığı Pelican'ın kendi sorusudur ve kendi sayfalarında
 * yanıtlanır. Buradaki sözcükler ikisini ayrı tutar.
 */

return [
    'title' => 'Siparişler',
    'nav_label' => 'Siparişler',
    'subheading' => 'Satın alınan her şey, ondan doğan sunucu ve durumun ne olduğu.',

    // ---- tablo -----------------------------------------------------------
    'column_order' => 'Sipariş',
    'column_customer' => 'Müşteri',
    'column_package' => 'Paket',
    'column_server' => 'Sunucu',
    'column_state' => 'Durum',
    'column_due' => 'Sonraki vade',

    'no_server' => 'Henüz kurulmadı',
    'no_due' => 'Tek seferlik',
    'gone_customer' => 'Hesap silindi',
    'gone_package' => 'Paket silindi',
    'overdue_days' => ':days gün gecikti',

    'state_pending' => 'Bekliyor',
    'state_active' => 'Etkin',
    'state_suspended' => 'Durduruldu',
    'state_cancelled' => 'İptal edildi',

    // ---- düğmeler --------------------------------------------------------
    'retry' => 'Yeniden kur',
    'retry_confirm' => 'Kurulumu bir kez daha sıraya alır. Başka hiçbir şey değişmez ve fatura ödenmiş kalır.',
    'retrying' => 'Sıraya alındı',

    'suspend' => 'Durdur',
    'suspend_confirm' => 'Sunucuyu Pelican\'ın kendi askıya alması ile durdurur. Dosyalar, veritabanları ve yedekler oldukları yerde kalır; faturanın ödenmesi askıyı kaldırır.',
    'suspended' => 'Durduruldu',

    'unsuspend' => 'Askıyı kaldır',
    'unsuspended' => 'Yeniden çalışıyor',

    'change_due' => 'Vadeyi değiştir',
    'change_due_helper' => 'Sonraki faturanın ne zaman yazılacağı. Boş bırakmak asla demektir: sipariş iptal edilmeden yenilenmeyi bırakır.',

    'cancel' => 'İptal et',
    'cancel_confirm' => 'Yenilemeleri durdurur ve stoktaki yeri geri verir. Sunucu olduğu gibi kalır: silmek Pelican\'da yapılır, yeri orasıdır.',
    'cancelled' => 'İptal edildi',

    'saved' => 'Kaydedildi',
    'refused' => 'Hiçbir şey değişmedi',
    'refused_body' => 'Sipariş bunu yapmaya elverecek bir durumda değil. Sayfayı yenileyin ve bir daha bakın.',

    // ---- müşterinin duyduğu ----------------------------------------------
    'bell_ready' => 'Sunucunuz hazır',
    'bell_ready_body' => ':server oluşturuldu ve başlatmanızı bekliyor.',
    'bell_suspended' => 'Sunucunuz durduruldu',
    'bell_suspended_body' => 'Bir fatura ek süreyi aşarak ödenmedi. Ödemek sunucuyu yeniden başlatır; hiçbir şey silinmedi.',

    // ---- yöneticinin duyduğu ---------------------------------------------
    'bell_failed' => ':number siparişi kurulamadı',
    'no_allocation' => 'Bu pakette hiçbir node\'un boş allocation\'ı yok. Bir tane ekleyin ve yeniden kurun.',
    'no_reason' => 'Panel nedenini söylemeden reddetti.',

    // ---- ondan doğan sunucu ----------------------------------------------
    'server_description' => 'Mağazadan alındı, sipariş :number.',
    'server_fallback' => 'Sunucu',
    'state_ending' => 'Bitiyor',
    'ends_on' => ':date tarihinde biter',
    'no_more_dues' => 'Yeniden faturalanmaz',
    'cancel_confirm_open' => 'Yenilemeleri şimdi durdurur ve stoktaki yeri geri verir. Sunucu çalışır durumda bırakılır: bu paketin asgari süresi yok, yani gidilecek bir tarih de yok. Müşterinin işi bitince sunucuyu Pelican\'da silin.',
    'terminate' => 'Durdur ve sil',
    'terminate_heading' => 'Bu sunucu silinsin mi?',
    'terminate_confirm' => 'Sunucu şimdi silinir; dosyaları, veritabanları ve yedekleriyle birlikte. Geri alma yok, sözleşmenin bitmesini bekleme yok. Müşteri kendisine verilen tarihe kadar onu tutacaksa, bunun yerine iptal edin.',
    'terminate_go' => 'Sil',
    'terminated' => 'Silindi',
    'terminated_body' => 'Sunucu gitti ve sipariş kapandı.',
    'bell_ending' => ':package paketiniz :date tarihinde bitiyor',
    'bell_ending_open' => ':package paketiniz iptal edildi',
    'bell_ending_body' => 'Bunun için size bir daha fatura kesilmez. Sunucu durduğunda üzerindeki her şey silinir, o yüzden saklamak istediklerinizi kopyalayın.',
    'bell_ended' => ':package paketiniz sona erdi',
    'bell_ended_body' => 'Sözleşme doldu ve sunucu silindi.',
    'bell_undeleted' => ':number siparişi silinemedi',
    'bell_undeleted_body' => 'Panel sunucuyu silmeyi reddetti. Sipariş kapandı ve kimseye faturalanmayacak, ama sunucu hâlâ orada ve Pelican\'dan kaldırılması gerekiyor.',
    'bell_undelivered' => ':number siparişinin dosyası hâlâ burada',
    'bell_undelivered_body' => 'Sunucu kuruldu, ama müşterinin yüklediği dosya içine konulamadı. Dosya hâlâ panelin deposunda duruyor ve nedeni storage/logs içinde.',
    'details' => 'Ayrıntılar',
    'details_of' => 'Sipariş :number',
    'close' => 'Kapat',
    'detail_package' => 'Paket',
    'detail_placed' => 'Sipariş verildi',
    'detail_built' => 'Sunucu kuruldu',
    'detail_due' => 'Sonraki vade',
    'detail_ends' => 'Bitiyor',
    'detail_suspended' => 'Durduruldu',
    'detail_cancelled' => 'İptal edildi',
    'detail_file_in' => 'Dosya konuldu',
    'detail_file_waiting' => 'Dosya',
    'detail_file_waiting_value' => 'Yüklendi, sunucunun kurulması bekleniyor.',
    'detail_note' => 'Son sorun',

    'empty' => 'Henüz hiçbir şey satın alınmadı',
    'empty_body' => 'Biri bir paket aldığı anda siparişler burada belirir.',

    // ---- yenilemeler -----------------------------------------------------
    'filter_late' => 'Bir faturada geride',
    'run_renewals' => 'Yenilemeleri şimdi çalıştır',
    'run_renewals_confirm' => 'Gecelik geçişin yaptığını yapar: yakında vadesi gelen her şey için bir sonraki faturayı yazar ve ek süreyi aşarak ödenmemiş kalan bir faturanın arkasındaki sunucuları durdurur.',
    'renewals_queued' => 'Sıraya alındı',
    'renewals_queued_body' => 'Sırada çalışıyor. Neyin değiştiğini görmek için birazdan sayfayı yenileyin.',
];
