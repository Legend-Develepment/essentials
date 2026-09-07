<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Genel bakıştaki blok: panelin kendisinin çalıştığı makine ve her node.
 *
 * Node sayıları Pelican'ın kendi sayıları, her birinin daemon'undan okunuyor.
 * Panel satırı /proc'tan okunuyor, o ayrı bir soru - bkz. Support\SystemStatus.
 *
 * "Node" olduğu gibi kalıyor: Pelican her yerde bu sözcüğü kullanıyor ve bir
 * çeviri, aynı şeye verilmiş ikinci bir addan başka bir şey olmazdı.
 */

return [
    // Bloğun başlığı eklentinin kendi adı, çalışma sırasında okunuyor; bu
    // yüzden burada onun için bir metin yok.
    'panel' => 'Bu panel',
    'offline' => 'yanıt vermiyor',
    'maintenance' => 'bakım',
    'cpu' => 'CPU',
    'memory' => 'Bellek',
    'disk' => 'Disk',
    'load' => 'Yük',
];
