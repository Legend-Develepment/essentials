<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Sistem durumu sayfası: panelin kendisinin çalıştığı makine ve yanında istenen
 * her node.
 *
 * Ayrık oldukları hiçbir kurulumda node'larla aynı makine değildir; ikisinin de
 * sayfada olabilmesinin nedeni bu.
 *
 * "Swap", "Wings", "PHP" ve "uptime" olduğu gibi kalıyor: makinede ve insanın
 * karşılaştıracağı her araçta böyle anılıyorlar.
 */

return [
    'title' => 'Sistem durumu',
    'nav_label' => 'Sistem durumu',
    'subheading' => 'Panelin kendisinin çalıştığı makine, üzerinde ne çalıştığı ve yanında istediğin her node.',

    'options' => 'Seçenekler',
    'enabled' => 'Kenar çubuğunda göster',
    'enabled_helper' => 'Kapalı, satırı kenar çubuğundan çıkarır. Sayfa kendi adresini korur, bu yüzden yeniden açman için hep oradadır.',

    'refresh' => 'Şu aralıkla yeniden oku',
    'refresh_helper' => 'Bu aralıkta tüm sayfa yeniden istenir. Kapalı, açtığın andaki gibi bırakır.',
    'refresh_off' => 'Yalnızca açtığımda',
    'refresh_seconds' => ':seconds saniye',

    'blocks' => 'Göster',
    'blocks_helper' => 'İşaretli olan gösterilir. Disk, dosya sistemi başına bir karttır; böylece dolu bir kök bölüm, yarı boş bir veri bağlamasının arkasına gizlenmez.',
    'block_cpu' => 'İşlemci',
    'block_memory' => 'Bellek',
    'block_swap' => 'Swap',
    'block_disk' => 'Disk',
    'block_load' => 'Ortalama yük',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistem',
    'block_version' => 'Panel sürümü',
    // Hiç gösterilmez - bir node kartı node'un kendi adını alır - ama blank()
    // onu ister ve kendi adını yazdıran eksik bir anahtar zayıf bir yedektir.
    'block_node' => 'Node',

    'nodes' => 'Gösterilecek node\'lar',
    'nodes_helper' => 'Panelin makinesinin yanında her biri için bir kart. Hiçbiri işaretli değilse hiçbiri gösterilmez — genel bakışta zaten her node\'u içeren bir blok var. Her biri kendi daemon\'una sorulur, bu yüzden kısa bir aralık ve uzun bir liste çok istek demektir.',

    'section_usage' => 'Kullanım',
    'section_host' => 'Bu panel',
    'section_nodes' => 'Node\'lar',

    'disk_panel' => 'Panel burada yaşıyor',
    'wings' => 'Wings :version',
    'version_installed' => 'Kurulu',
    'version_latest' => 'En son',
    'version_current' => 'Güncel',
    'version_update' => 'Güncelleme var',
    'version_unknown' => 'Denetlenemedi',

    /*
     * Geride kalmış bir kartın ne sunduğu.
     *
     * Güncellemeyi yapan bir düğme değil, yayına giden bir bağlantı; çünkü
     * buradan yapılacak bir güncelleme yok: Pelican'ın bir yükseltme komutu yok
     * ve Wings'in kendi ikili dosyasını değiştiren bir endpoint'i yok. İpucu
     * işin asıl nerede yapıldığını söyler, ki kimse hiç mümkün olmamış bir
     * düğmeyi aramaya çıkmasın.
     */
    'version_release' => 'Ne yeni',
    'version_how_panel' => 'Sürüm notlarını açar. Panelin yükseltilmesi, çalıştığı makinede yapılır - panel kendi dosyalarını değiştiremez ve hiçbir eklentinin kabuk komutu çalıştırmasına izin yoktur.',
    'version_how_wings' => 'Sürüm notlarını açar. Wings node\'un kendisinde güncellenir - panelin başka bir makinede çalışan bir programa kanalı yoktur.',

    'wings_latest' => 'En son :version',
    'load_cores' => ':cores işlemcinin %:percent kadarı',
    'load_windows' => '5 dk\'da :five · 15 dk\'da :fifteen',
    'uptime_since' => ':date tarihinden beri',
    'unavailable' => 'Bu makinede yok',

    'fact_os' => 'İşletim sistemi',
    'fact_hostname' => 'Makine adı',
    'fact_php' => 'PHP',
    'fact_cores' => 'İşlemciler',
    'fact_processes' => 'Süreçler',
];
