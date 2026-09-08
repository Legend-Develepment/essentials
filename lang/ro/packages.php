<?php

/*
 * Română. Scris de mână.
 *
 * Pachete: un server pe care cineva îl poate cumpăra.
 *
 * Citit de cine amenajează magazinul. Fiecare cuvânt de aici este despre șablon
 * și preț; ce vede un client stă în shop.php, pentru că cei doi cititori vor
 * fraze diferite despre același rând.
 *
 * „egg", „node", „swap", „io" și cuvintele din Minecraft rămân în engleză: sunt
 * cuvintele din formularul de server al lui Pelican, iar un pachet este acel
 * formular păstrat pentru mai târziu.
 */

return [
    'title' => 'Pachete',
    'nav_label' => 'Pachete',
    'subheading' => 'Ce este de vânzare. Fiecare este un șablon de server cu un preț; un client cumpără unul și panoul creează serverul.',

    // ---- tabelul ---------------------------------------------------------
    'column_name' => 'Pachet',
    'column_egg' => 'Egg',
    'column_price' => 'Preț',
    'column_stock' => 'Stoc',
    'column_live' => 'De vânzare',
    'column_orders' => 'Vândute',

    'live' => 'De vânzare',
    'offline' => 'Nu este de vânzare',
    'no_egg' => 'Fără egg — nu poate fi construit',

    'stock_unlimited' => 'Nelimitat',
    'stock_left' => 'Au rămas :count',
    'stock_out' => 'Epuizat',

    // ---- perioade --------------------------------------------------------
    'period_once' => 'O singură dată',
    'period_month' => 'Lunar',
    'period_quarter' => 'Trimestrial',
    'period_year' => 'Anual',

    // După un preț: „12,50 € pe lună".
    'per_once' => 'o dată',
    'per_month' => 'pe lună',
    'per_quarter' => 'pe trimestru',
    'per_year' => 'pe an',

    // ---- acțiuni ---------------------------------------------------------
    'new' => 'Pachet nou',
    'edit' => 'Modifică',
    'duplicate' => 'Duplică',
    'copy_suffix' => ' (copie)',
    'go_live' => 'Pune la vânzare',
    'go_offline' => 'Retrage de la vânzare',
    'delete' => 'Șterge',
    'delete_confirm' => 'Elimină pachetul. Ce s-a cumpărat deja nu este atins — comenzile își păstrează propria copie a ceea ce erau.',
    'delete_refused' => 'Nu a fost șters',
    'delete_refused_body' => 'Au fost plasate comenzi pe acest pachet și ele arată spre el. Retrage-l mai bine de la vânzare; rămâne în evidențe și nimeni nu-l poate cumpăra.',
    'deleted' => 'Pachet șters',
    'saved' => 'Pachet salvat',
    'save_failed' => 'Pachetul nu a putut fi salvat',
    'price_invalid' => 'Aceasta nu este o sumă. Scrie-o ca 12.50 sau 12,50.',

    // ---- formularul: ce este ---------------------------------------------
    'section_basics' => 'Pachetul',
    'section_basics_helper' => 'Ce vede un client pe card.',
    'name' => 'Nume',
    'name_helper' => 'Cum se numește în magazin.',
    'slug' => 'Adresă',
    'slug_helper' => 'Litere mici, cifre și cratime. Lăsată goală, se formează din nume. Schimbarea ulterioară strică un link pe care cineva l-a salvat.',
    'description' => 'Descriere',
    'description_helper' => 'Câteva rânduri sub nume. Text simplu.',
    'live_field' => 'De vânzare',
    'live_helper' => 'Oprit ține pachetul aici și nu îl arată nimănui. Un pachet fără egg nu este arătat niciodată, orice ar scrie aici.',
    'sort' => 'Ordine',
    'sort_helper' => 'Mai mic vine mai întâi în magazin.',

    // ---- formularul: ce devine -------------------------------------------
    'section_server' => 'Serverul în care se transformă',
    'section_server_helper' => 'Aceleași întrebări pe care le pune Pelican când creezi un server de mână, cu răspuns dat o dată aici și folosit la fiecare vânzare.',
    'egg' => 'Egg',
    'egg_helper' => 'Alegerea unuia completează imaginea, comanda de pornire și fiecare variabilă cu valorile implicite ale egg-ului. Schimbă-le după aceea cum vrei.',
    'image' => 'Imagine Docker',
    'image_helper' => 'Una dintre imaginile oferite de egg.',
    'image_default' => 'Prima imagine a egg-ului',
    'startup' => 'Comandă de pornire',
    'startup_helper' => 'Una dintre comenzile oferite de egg.',
    'startup_default' => 'Prima comandă a egg-ului',
    'environment' => 'Variabile',
    'environment_helper' => 'Variabilele egg-ului și valorile lor. Tot ce are egg-ul și nu este listat aici primește valoarea implicită la crearea serverului.',
    'env_key' => 'Variabilă',
    'env_value' => 'Valoare',
    'nodes' => 'Node-uri',
    'nodes_helper' => 'Unde poate fi creat un server din acest pachet, încercate în această ordine până când unul are o adresă liberă. Nimic bifat înseamnă orice node.',

    // ---- formularul: limite ----------------------------------------------
    'section_limits' => 'Limite',
    'section_limits_helper' => 'Ce primește serverul. Aceleași câmpuri ca în formularul de server al lui Pelican, în aceleași unități.',
    'memory' => 'Memorie',
    'disk' => 'Disc',
    'cpu' => 'CPU',
    'cpu_helper' => 'Procent dintr-un nucleu: 100 este un nucleu, 200 sunt două, 0 este fără limită.',
    'swap' => 'Swap',
    'swap_helper' => '0 este niciun, -1 este nelimitat.',
    'io' => 'Pondere IO bloc',
    'io_helper' => 'Valoarea implicită a lui Pelican este 500. Las-o acolo dacă nu știi de ce nu.',
    'threads' => 'Fixare CPU',
    'threads_helper' => 'Care nuclee, așa cum le scrie Pelican: 0,1 sau 0-3. Gol înseamnă oricare.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Dacă nucleul poate opri serverul când rămâne fără memorie.',
    'databases' => 'Baze de date',
    'allocations' => 'Allocation-uri suplimentare',
    'backups' => 'Copii de rezervă',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- formularul: banii -----------------------------------------------
    'section_price' => 'Preț și stoc',
    'section_price_helper' => 'În moneda magazinului, setată pe pagina Setările magazinului. Fără taxă — taxa este adăugată pe factură ca rând separat.',
    'price' => 'Preț',
    'price_helper' => 'Pe perioadă. Scrie-l ca 12.50 sau 12,50.',
    'setup_fee' => 'Taxă de instalare',
    'setup_fee_helper' => 'Percepută o dată, pe prima factură. Zero pentru niciuna.',
    'period' => 'Facturat',
    'period_helper' => 'O singură dată se plătește o dată și se păstrează. Celelalte primesc o factură nouă la fiecare perioadă; una neplătită suspendă serverul după perioada de grație de pe pagina Setările magazinului.',
    'stock' => 'Stoc',
    'stock_helper' => 'Câte pot fi vândute deodată, numărând fiecare comandă neanulată. Gol înseamnă nelimitat.',
    'term' => 'Termen minim',
    'term_helper' => 'Cât timp rămâne cineva legat după ce cumpără. Zero înseamnă fără obligație: poate anula și se oprește la sfârșitul perioadei pe care a plătit-o.',
    'term_unit' => 'Numărat în',
    'term_unit_helper' => 'Zile, luni sau ani. O comandă anulată merge până la sfârșitul acestui termen, iar serverul se șterge în ziua aceea.',
    'unit_day' => 'Zile',
    'unit_month' => 'Luni',
    'unit_year' => 'Ani',
    'term_day' => 'Termen minim: :count zile',
    'term_month' => 'Termen minim: :count luni',
    'term_year' => 'Termen minim: :count ani',
    'section_art' => 'Imagine',
    'section_art_helper' => 'Imaginea de pe cardul pachetului, în magazin și la serviciile unui client. Lasă-le pe amândouă goale și se folosește imaginea proprie a egg-ului, pe care majoritatea pachetelor o au deja.',
    'art_file' => 'Încarcă o imagine',
    'art_file_helper' => 'Lată, nu înaltă: cardul o taie la 16:9. Până la 8 MB.',
    'art_url' => 'Sau o adresă de imagine',
    'art_url_helper' => 'O adresă https completă. Folosită când nu se încarcă nimic mai sus.',

    'empty' => 'Încă nu există pachete',
    'section_ask' => 'Întreabă clientul',
    'section_ask_helper' => 'Întrebări puse la comandă, cu răspuns dat înainte ca ea să fie plasată. Răspunsurile ajung la server când acesta este creat.',
    'ask_vars' => 'Variabile de cerut',
    'ask_vars_helper' => 'Variabilele proprii ale egg-ului. Bifează una și clientul o completează în timp ce cumpără, iar răspunsul lui este folosit în locul valorii din acest pachet. Lasă totul nebifat și nimeni nu este întrebat nimic.',
    'upload_ask' => 'Cere un fișier',
    'upload_ask_helper' => 'Un zip pe care clientul îl încarcă în timp ce cumpără — o lume, un modpack, un set de configurații. Este pus în serverul lui când acesta este construit, înainte să i se spună că e gata.',
    'upload_label' => 'Cum să îi spui',
    'upload_label_helper' => 'Eticheta de deasupra casetei de fișier, în cuvintele tale. Goală, se folosește una simplă.',
    'upload_dir' => 'Unde în server',
    'upload_dir_helper' => 'O cale în interiorul serverului, precum / sau /world. Este făcută sigură înainte de a fi folosită.',
    'upload_extract' => 'Despachetează-l',
    'upload_extract_helper' => 'Pornit, zip-ul este despachetat acolo unde ajunge, iar arhiva însăși este ștearsă — potrivit pentru o lume sau un set de configurații. Oprit, zip-ul rămâne un fișier, iar asta vrea un egg care instalează dintr-unul un modpack.',
    'empty_body' => 'Creează unul și apare în magazin în clipa în care este pus la vânzare.',
];
