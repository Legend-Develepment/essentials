<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Sayfanın kendisinde "makine" yazıyor, çünkü satır donanımdan söz ediyor,
 * Pelican'ın kavramından değil; "node" ayarlara ait, orada sözcük zaten
 * okunmuş oluyor.
 */

return [
    'nav_label' => 'Kapasite',
    'title' => 'Bir sunucu daha sığar mı',
    'subheading' => 'Her node üzerinde ne kadarı söz verilmiş, dağıtmasına izin verilen miktara karşı.',

    'how' => 'Söz verilmiş, kullanılmış değil. Bir node yüzde yirmi meşgul ve aynı anda tamamen dolu olabilir, çünkü dolu olmak ne kadarının dağıtıldığıyla ilgilidir, neyin çalıştığıyla değil - genel bakıştaki Makineler bloğu öteki sorudur ve olduğu yerde kalır. Buradaki hesap Pelican\'ın kendi hesabı; bir sunucunun oluşturulmasına izin verilip verilmeyeceğine karar veren yöntemden geliyor: kapasite çarpı bir artı aşırı tahsis, node üzerindeki her sunucuya söz verilenin toplamına karşı. Kapasitenin sıfır olması sınırsız demek, sıfırın altındaki aşırı tahsis de öyle - bazı satırlarda dolu ya da boş bir çubuk yerine yüzde olmamasının nedeni bu.',

    'column_node' => 'Makine',
    'column_fullest' => 'En dolu',
    'column_memory' => 'Bellek',
    'column_disk' => 'Disk',
    'column_cpu' => 'İşlemci',
    'column_at_limit' => 'Sınırda',

    'servers' => ':count sunucu',

    'filter_tight' => 'Neredeyse dolu',

    'open' => 'Makineyi aç',

    'empty' => 'Ulaşabildiğin makine yok.',
];
