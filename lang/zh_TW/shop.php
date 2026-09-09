<?php

/*
 * 繁體中文。手寫。
 *
 * 商店的設定，以後還有商店本身。
 *
 * 兩種讀者共用這個檔案是有意為之。設定那一半由管理員讀；公開頁和顧客那一半 -
 * 隨著商店長大再往裡加 - 由那些也許根本沒聽說過 Pelican 的人讀，那邊的每一句都
 * 要為他們而寫。
 */

return [
    'title' => '商店設定',
    'nav_label' => '商店設定',
    'subheading' => '貨幣、稅、帳單編號，以及公開頁上說的話。賣的東西本身在「方案」頁裡。',

    // ---- 在哪裡 ----------------------------------------------------------
    'address' => '公開商店在',
    'address_off' => '公開頁已關閉。在 Essentials 設定頁的功能清單裡打開「公開商店頁」，:url 就會有回應。',

    // ---- 一般 ------------------------------------------------------------
    'section_general' => '錢',
    'section_general_helper' => '整個商店只用一種貨幣。每個方案的每個價格，都是這種貨幣下的一個數。',
    'currency' => '貨幣',
    'currency_helper' => '換貨幣不會換算任何東西：方案價格就是數字，換完之後它們就是新貨幣下的數字。',
    'tax' => '稅',
    'tax_helper' => '作為單獨一行加到每張帳單上的百分比。方案價格是未稅的。不收就填 0。',
    'tax_suffix' => '%',
    'prefix' => '帳單編號以此開頭',
    'prefix_helper' => '後面跟一個遞增的號碼。INV- 得到 INV-000001。',

    // ---- 續約 ------------------------------------------------------------
    'section_renewals' => '續約',
    'section_renewals_helper' => '給按月、按季、按年計費的方案用。一次性的方案永遠不受這裡影響。',
    'notice_days' => '週期結束前多少天出帳單',
    'notice_days_helper' => '下一張帳單什麼時候產生、顧客什麼時候收到通知。',
    'grace' => '帳單到期後多少天停機',
    'grace_helper' => '超過這個天數還沒付的帳單會停掉伺服器 — 用的是 Pelican 自己的停權，帳單一付清就解除。停權本身不刪除任何東西。',
    'days' => '天',

    // ---- 公開頁 ----------------------------------------------------------
    'section_public' => '公開頁',
    'section_public_helper' => '沒有帳號的人也會讀。它到底出不出現，由功能清單裡的「公開商店頁」開關決定。',
    'heading' => '標題',
    'heading_helper' => '留空就用面板自己的名字。',
    'note' => '方案上方的一行字',
    'note_helper' => '用來說你是誰，或者買了能得到什麼。純文字。',
    'terms_url' => '條款',
    'terms_url_helper' => 'https 網址。填了以後，購買就意味著勾選一個指向它的方框。',

    // ---- 手動付款 --------------------------------------------------------
    'section_manual' => '沒有金流商時的付款方式',
    'section_manual_helper' => '在一個金流商都沒開的時候，顯示在未付帳單上：銀行資訊，或者錢該匯到哪裡。純文字。',
    'pay_note' => '怎麼付款',
    'pay_note_helper' => '留空的話，未付帳單就只說它還沒付。',

    // ---- 按鈕 ------------------------------------------------------------
    'save' => '儲存',
    'saved' => '已儲存',
    'save_failed' => '什麼都沒儲存',

    /* ---------------------------------------------------------------------
     * 從這裡往下是商店本身。
     *
     * 完全另一種讀者：來買伺服器的人，也許根本沒聽說過 Pelican，也不知道 egg 是
     * 什麼。下面沒有一處用面板的詞，每一句都回答顧客在頁面那個位置真正會有的疑問。
     * ------------------------------------------------------------------- */

    // ---- 商店 ------------------------------------------------------------
    'store_title' => '商店',
    'store_nav_label' => '商店',
    'store_subheading' => '挑一台伺服器。帳單一付清就為你建好。',
    'store_empty' => '現在沒有在售的東西',
    'store_empty_body' => '過一會兒再來，或者問問打理這個面板的人。',

    'buy' => '購買',
    'sold_out' => '已售完',
    'plus_setup' => '另加一次性 :amount',

    'spec_memory' => '記憶體 :amount MiB',
    'spec_disk' => '硬碟 :amount MiB',
    'spec_cpu' => 'CPU :amount%',
    'spec_backups' => ':count 個備份',
    'spec_databases' => ':count 個資料庫',

    // ---- 公開頁 ----------------------------------------------------------
    'public_empty' => '現在沒有在售的東西',
    'public_empty_body' => '過一會兒再來。',
    'to_panel' => '登入',
    'terms' => '條款',
    'sign_in_note' => '在下面挑一台伺服器。你登入後完成下單，帳單付清就為你建好。',
    'to_account' => '我的帳號',
    'filter_all' => '全部',
    'filter_label' => '顯示',
    'includes' => '包含',
    'public_count' => '在售 :count 個方案',

    // ---- 下單 ------------------------------------------------------------
    'checkout_title' => '下單',
    'tax_line' => '稅 (:rate%)',
    'coupon' => '優惠碼',
    'asks' => '關於你的伺服器',
    'upload_default' => '你的檔案',
    'upload_help' => '一個 zip 檔。建你的伺服器時會放進去。',
    'upload_busy' => '正在上傳…',
    'what_is_this' => '這是什麼？',
    'leave_as_is' => '保持原樣',
    'asks_optional' => '這些都可以不填。你沒動的地方，就還是伺服器範本裡原來的樣子。',
    'refused_no_file' => '這個方案需要一個檔案，但一個都沒選。',
    'refused_not_zip' => '那必須是一個 zip 檔。',
    'refused_too_big' => '這個檔案太大，這個面板收不下。',
    'coupon_placeholder' => '有的話就填',
    'coupon_bad' => '這個碼在這裡用不了。',
    'coupon_good' => '優惠碼已生效。',
    'agree' => '我同意',
    'place_order' => '送出訂單',
    'place_order_note' => '這會產生一張帳單。在你付款之前不會扣任何錢，伺服器在帳單付清後建立。',
    'back_to_store' => '回到商店',

    'placed' => '訂單已送出',
    'placed_body' => '帳單 :number 已經在你的帳單頁面上等著了。',

    'refused' => '這個買不了',
    'refused_gone' => '它已經不賣了。',
    'refused_sold_out' => '最後一個也沒了。',
    'refused_bad_coupon' => '這個優惠碼不適用於它。',
    'refused_failed' => '寫訂單的時候出了差錯。沒有扣任何錢。再試一次，如果還這樣就告訴打理這個面板的人。',

    // ---- 帳單 ------------------------------------------------------------
    'billing_title' => '帳單',
    'billing_nav_label' => '帳單',
    'billing_subheading' => '你買了什麼，還欠什麼。',
    'your_orders' => '你的訂單',
    'your_invoices' => '你的帳單',
    'no_orders' => '你還沒買過東西',
    'no_orders_body' => '你買的每樣東西都會連同伺服器和日期一起出現在這裡。',
    'no_invoices' => '還沒有帳單',
    'to_store' => '去商店',
    'renews' => '續約於',
    'server_installing' => '還在準備。準備好了它自己會啟動。',
    'server_failed' => '準備沒能完成。打理這個面板的人已經收到通知。',
    'server_suspended' => '被面板停掉了。上面的東西一樣都沒刪。',
    'server_restoring' => '正在把一個備份放回去。要幾分鐘。',
    'give' => '結束這項服務',
    'give_end' => '到那天結束',
    'give_end_on' => '到 :date 結束',
    'give_end_body' => '它一直跑到 :date，以後不會再為它開帳單。上面的東西會在那天全部刪除，想留的先複製出來。',
    'give_end_open' => '沒有一個要跑到的日子，所以結束這一項只是停掉帳單，伺服器就那麼留著，直到有人把它移除。',
    'give_end_confirm' => '在 :date 結束這項服務？在那之前它照常跑，也不再出帳單。',
    'give_now' => '現在就停掉並刪除',
    'give_now_confirm' => '現在就刪掉這臺伺服器，連同它的檔案、資料庫和備份？沒有復原，已經付過的這段時間也不退錢。',
    'gave_end' => '已受理',
    'gave_end_body' => '它跑到卡片上的那個日子，之後不再出帳單。在那之前什麼都不會刪。',
    'gave_now' => '已刪除',
    'gave_now_body' => '伺服器已經刪除，以後不會再為它開帳單。',
    'gave_refused' => '這個沒成',
    'gave_refused_body' => '什麼都沒變。重新整理頁面，如果還這樣就問問打理這個面板的人。',
    'ask_how_to_pay' => '問問打理這個面板的人怎麼付款。他們還沒把這寫在這裡。',
    'order_pending' => '正在等帳單付清。付清後馬上就會建出伺服器。',
    'order_suspended' => '因為有帳單沒付而停著。付清後伺服器會重新跑起來 — 什麼都沒刪。',
    'order_ending' => ':date 結束。不再出帳單，上面的一切都會在那天被刪掉。',
    'order_ending_open' => '已取消。不再出帳單，在被移除之前一直跑著。',

    // ---- 付款 ------------------------------------------------------------
    'pay_with' => '用以下方式付款',
    'pay_now' => '付款',
    'pay_description' => '帳單 :number',
    'pay_thanks' => '謝謝。帳單已付清。',
    'pay_pending' => '金流商還沒確認。他們一確認，這個頁面就會更新。',
    'pay_refused' => '這個沒能開始',
    'pay_refused_body' => '付款打不開。換個方式試試，或者問問打理這個面板的人。',
    'check' => '測試付款金鑰',
    'check_ok' => '正常',
    'check_bad' => '被拒',
    'check_good' => '金鑰沒問題，這家金流商也有回應。',
    'check_off' => '已經關掉了，所以沒有什麼可問的。',
    'check_none' => '一個金流商都沒開',
    'check_none_body' => '在下面打開一個，把它的金鑰填上，儲存，再按一次這裡。',
    'check_no_key' => '這一個的金鑰沒有填。',
    'check_refused' => '金流商拒絕了這些金鑰。它回的是 HTTP :status。',
    'check_paypal' => 'PayPal 拒絕了這些金鑰。它回的是 HTTP :status，而這個面板設的是 :where — 金鑰必須來自他們後台的那個分頁。',
    'check_sandbox' => '沙盒',
    'check_live' => '正式',
    'check_ellipsis' => 'Client ID 的結尾是一個點，這說明複製下來的是後台裡被截短的那串字，不是整把金鑰。用它旁邊的複製按鈕，再儲存一次。',
    'gateway_mollie' => 'Mollie',

    // ---- 金流商設定 ------------------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => '用一個帳戶收 iDEAL、信用卡、Bancontact 和其餘方式。測試和正式是同一個設定：金鑰本身就說明它屬於哪個帳戶。',
    'mollie_on' => '提供 Mollie',
    'mollie_on_helper' => '關掉會把按鈕從每張帳單上撤下。已經付過的仍然是已付。',
    'mollie_key' => 'API 金鑰',
    'mollie_key_helper' => '在你的 Mollie 後台 Developers 一節裡。它永遠不會寫進匯出的設定檔。',
    'mollie_hook' => 'Webhook 位址',
    'mollie_hook_helper' => 'Mollie 會通知 :url — 你的面板要能從公網在那個位址被連到。',

    'gateway_stripe' => 'Stripe',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => '在 Stripe 自己畫的頁面上收卡，所以卡號永遠不會到這個面板來。測試和正式在金鑰的前綴裡，不在某個開關上。',
    'stripe_on' => '提供 Stripe',
    'stripe_on_helper' => '關掉會把按鈕從每張帳單上撤下。已經付過的仍然是已付。',
    'stripe_key' => '私密金鑰',
    'stripe_key_helper' => 'Developers 的 API keys 裡以 sk_ 開頭的那一個。它永遠不會寫進匯出的設定檔。',
    'stripe_hook' => '簽章金鑰',
    'stripe_hook_key_helper' => '你加入下面這個位址時 Stripe 顯示的 whsec_ 值。沒有它就無法證明他們的通知是真的，通知會被忽略。',
    'stripe_hook_helper' => '在 Developers 的 webhooks 裡把 :url 加為 endpoint，事件選 checkout.session.completed。',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => '三家裡唯一一家，錢是在顧客回來的時候才動，而不是他們還在 PayPal 上的時候。所以關掉分頁留下的是一張未付帳單，不是一筆丟掉的錢。',
    'paypal_on' => '提供 PayPal',
    'paypal_on_helper' => '關掉會把按鈕從每張帳單上撤下。已經付過的仍然是已付。',
    'paypal_sandbox' => '沙盒',
    'paypal_sandbox_helper' => '和 PayPal 的測試帳戶說話，而不是真的那個。他們的 client id 兩種情況下長得一樣，這個開關正是因此而存在。',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => '來自你在 Apps & Credentials 裡建的應用程式。注意那個分頁要和上面的開關對得上。',
    'paypal_secret_helper' => '在 client ID 旁邊，Show 後面。它永遠不會寫進匯出的設定檔。',
    'paypal_hook' => 'Webhook ID',
    'paypal_hook_id_helper' => '你加入 webhook 之後 PayPal 給它的 ID，不是那個位址。沒有它就沒辦法把他們的通知拿去跟他們核對，通知會被忽略。',
    'paypal_hook_helper' => '在那個應用程式裡把 :url 加為 webhook，事件選 PAYMENT.CAPTURE.COMPLETED，再把拿到的 ID 貼到這裡。',

    // ---- 付款頁 ----------------------------------------------------------
    'pay_title' => '付款',
    'pay_subheading' => '你欠多少，以及可以怎麼付。',
    'pay_choose' => '你想怎麼付款？',
    'pay_choose_body' => '不管選哪一個，你都在對方自己的頁面上完成，然後馬上回到這裡。',
    'pay_safe' => '付款是在金流商那邊完成的。你的卡片資料永遠不會到這個面板來。',
    'pay_no_ways' => '錢一到，帳單就會標為已付，你的伺服器隨即建好。',
    'free' => '不用付款',
    'free_body' => '優惠碼把這張全折抵掉了，所以不用付款。按一下按鈕就好了。',
    'free_go' => '完成',
    'free_done' => '已結清',
    'free_done_body' => '沒有要付的錢，帳單就此結清。你的伺服器正在建。',
    'pay_gone' => '沒有這張帳單',
    'pay_gone_body' => '可能是被作廢了，也可能是位址不對。',
    'pay_already' => '這張已經付了',
    'pay_already_body' => '沒有別的要做了。等著它的一切都已經動起來。',
    'pay_withdrawn' => '這張被作廢了',
    'pay_withdrawn_body' => '它已經不在帳上，不用付。如果看著不對，問問打理這個面板的人。',
    'back_to_billing' => '回到帳單',

    'gateway_mollie_note' => 'iDEAL、Bancontact、信用卡等',
    'gateway_stripe_note' => 'Visa、Mastercard、American Express',
    'gateway_paypal_note' => '你的 PayPal 餘額，或經由 PayPal 的信用卡',

    // ---- 服務和帳單分開 --------------------------------------------------
    'services_title' => '我的服務',
    'services_nav_label' => '我的服務',
    'services_subheading' => '你正在付費的東西，以及每一項變成的伺服器。',
    'open_server' => '開啟伺服器',
    'no_server_yet' => '正在準備',

    'invoices_title' => '帳單',
    'invoices_subheading' => '開給你的帳單，以及還要付的部分。',
    'no_invoices_body' => '你買的每樣東西都在這裡開帳單，付清之後也留在這裡。',

    // ---- 把商店放在首頁 --------------------------------------------------
    'section_landing' => '商店擺在哪裡',
    'section_landing_helper' => '商店是不是面板的正門：既給顧客，也給還沒登入的人。',
    'landing' => '先開啟商店',
    'landing_helper' => '打開後，商店就是登入後的第一頁，伺服器清單挪到它旁邊。你的服務和帳單仍然只有一步之遙 — 在商店的頂部和帳號選單裡。還沒登入的人看到的是公開商店，而不是登入框，只有挑好方案之後才會請他登入；所以這還需要把公開商店頁也一起打開。關掉則面板打開的是伺服器清單，照 Pelican 畫的樣子，還沒登入的人看到的是登入框，商店只是一個和其他一樣的頁面。',
    'self_cancel' => '讓顧客自己結束服務',
    'self_cancel_helper' => '在他們的服務頁上給兩條出路：到合約日期結束，停掉帳單並在當初告訴他們的那天刪掉伺服器；或者現在就停，立刻刪掉。兩個都跟你訂單頁上的按鈕一模一樣。關掉則兩條都不給，要結束一項服務只能來找你。',
];
