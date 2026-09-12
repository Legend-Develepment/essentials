<?php

/*
 * Türkçe. Elle yazıldı.
 *
 * Tükenmiş bir paket yeniden satışa çıktığında haber istemek.
 *
 * Buradaki sözler kimseye paketin kendisini söz vermez. Stok geri geldiğinde
 * listedeki herkese aynı anda haber verilir ve paket ilk satın alanın olur; bu
 * yüzden buradaki her cümle bunu açıkça söyler, "geri geldi!" deyip yirmi sekiz
 * kişiyi bunun ne değeri olduğunu sonradan öğrenmeye bırakmaz.
 *
 * Haber almak aynı zamanda kişiyi listeden çıkarır ve bu da açıkça söylenir:
 * bir istek bir haber satın alır; zili okunmaya değer tutan da budur.
 */

return [
    'bell_back' => ':name yeniden satışta',
    'bell_back_body' => '{1} Bir tane var ve ilk satın alanın olur. Artık listede değilsiniz, kaçırırsanız yeniden isteyin.|[2,*] :count tane var ve ilk satın alanların olur. Artık listede değilsiniz, kaçırırsanız yeniden isteyin.',
    'bell_back_any' => 'Artık sınırlı değil, yani herkese bir tane var. Artık listede değilsiniz.',
];
