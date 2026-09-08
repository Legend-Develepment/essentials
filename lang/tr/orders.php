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

    'empty' => 'Henüz hiçbir şey satın alınmadı',
    'empty_body' => 'Biri bir paket aldığı anda siparişler burada belirir.',
];
