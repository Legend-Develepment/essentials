<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Faturalar: belge, listeleyen sayfa ve e-posta.
 *
 * Bu dosyayı üç okuyucu paylaşır. Yönetici tabloyu okur ve „ödendi olarak
 * işaretle" düğmesine basar; müşteri yazdırılabilir belgeyi ve e-postayı okur;
 * belgenin kendisini ise aylar sonra defterleri tutan kişi okur. İşte bu
 * sonuncusu yüzünden doc_ satırları kuru ve resmidir: bir fatura, panelin geri
 * kalanının üslubuna göre yer değildir.
 */

return [
    'title' => 'Faturalar',
    'nav_label' => 'Faturalar',
    'subheading' => 'Ne borç, ne ödenmiş. Burada birini ödendi olarak işaretlemek, ödemenin yapacağı her şeyi yapar: sunucu kurulur, durdurulmuş olan geri gelir.',

    // ---- tablo -----------------------------------------------------------
    'column_number' => 'Fatura',
    'column_customer' => 'Müşteri',
    'column_order' => 'Sipariş',
    'column_total' => 'Toplam',
    'column_state' => 'Durum',
    'column_due' => 'Vade',

    'kind_order' => 'İlk fatura',
    'kind_renewal' => 'Yenileme',

    'state_unpaid' => 'Ödenmemiş',
    'state_paid' => 'Ödenmiş',
    'state_cancelled' => 'Geri çekilmiş',

    'no_order' => 'Sipariş yok',
    'no_due' => 'Tarih yok',
    'gone_customer' => 'Hesap silindi',
    'discount_of' => ':code ile :amount indirim',
    'paid_via' => ':how üzerinden',
    'emailed' => 'Gönderildi',
    'not_emailed' => 'Gönderilmedi',
    'filter_overdue' => 'Gecikmiş',

    // ---- düğmeler --------------------------------------------------------
    'open' => 'Aç',
    'mark_paid' => 'Ödendi olarak işaretle',
    'mark_paid_confirm' => 'Paranın geldiğini kayda geçirir. Sunucu kurulur, durdurulmuş olan yeniden başlar ve sonraki vade ileri kayar; tıpkı bir ödeme sağlayıcısı söylemiş gibi.',
    'paid' => 'Ödendi olarak işaretlendi',
    'paid_body' => 'Bu faturayı bekleyen her şey yolda.',
    'already_paid' => 'Zaten ödenmişti',

    'withdraw' => 'Geri çek',
    'withdraw_confirm' => 'Faturayı defterlerden çıkarır. Yalnızca ödenmemiş olan geri çekilebilir; ödenmiş bir fatura, el değiştirmiş paranın izidir.',
    'withdrawn' => 'Geri çekildi',
    'withdraw_refused' => 'Yalnızca ödenmemiş bir fatura geri çekilebilir',

    'empty' => 'Henüz fatura yok',
    'empty_body' => 'Biri satın alır almaz bir tane yazılır, sonra yenilenen her şey için dönem başına bir tane.',

    // ---- belge -----------------------------------------------------------
    'doc_title' => 'Fatura',
    'doc_number' => 'Numara',
    'doc_issued' => 'Düzenlendi',
    'doc_due' => 'Son ödeme',
    'doc_paid_on' => 'Ödendi',
    'doc_billed_to' => 'Alıcı',
    'doc_from' => 'Satıcı',
    'doc_description' => 'Açıklama',
    'doc_amount' => 'Tutar',
    'doc_subtotal' => 'Ara toplam',
    'doc_discount' => 'İndirim',
    'doc_total' => 'Toplam',
    'doc_how_to_pay' => 'Nasıl ödenir',
    'doc_print' => 'Yazdır veya PDF olarak kaydet',
    'doc_back' => 'Panele dön',

    // ---- e-posta ---------------------------------------------------------
    'mail_subject' => ':number numaralı fatura',
    'mail_hello' => 'Merhaba :name,',
    'mail_intro' => 'İşte :number numaralı fatura.',
    'mail_open' => 'Faturayı aç',
    'mail_foot' => 'Bu faturayı istediğiniz zaman fatura sayfanızdan yeniden okuyabilirsiniz.',

    // ---- çan -------------------------------------------------------------
    'bell_new' => ':number numaralı fatura',
    'bell_new_body' => ':total ödenecek. Ödemek için fatura sayfanızı açın.',
];
