/*
 * Writes lang/<code>/<group>.php for the strings every reader sees.
 *
 * By hand this would be sixty-two files of eighteen keys each, which is sixty-two
 * chances to mistype a key name - and a mistyped key does not fail, it silently
 * stays English while looking translated. check-lang.js catches the ones that do
 * not exist in English at all; it cannot catch `stpo` being absent.
 *
 * Scope, said plainly. This covers the two groups that appear on pages everybody
 * opens: the power buttons above a console, and the node meters on the
 * dashboard. It does not cover the whole plugin - seven hundred keys across
 * thirty-one languages is twenty-two thousand strings, and a confirmation dialog
 * about deleting somebody's files is not a good place for a translation nobody
 * has read. The rest stays English until it is translated properly, which is
 * exactly what Laravel's per-key fallback makes safe.
 *
 * Existing files are never overwritten. Run with --force to rewrite them, and
 * know that hand-written translations live in the same directories.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const force = process.argv.includes('--force');

/*
 * The English source, for reference while reading the tables below.
 *
 * controls: console, full_page, close, start, restart, stop, kill,
 *           kill_confirm, sent_title, sent_body, failed
 * nodes:    panel, offline, maintenance, cpu, memory, disk, load
 *
 * `offline` and `maintenance` are lower case in English because they are drawn
 * as flags in a sentence, not as headings. Languages that capitalise nouns
 * (German) capitalise them here too.
 */
const T = {
    ar: ['وحدة التحكم', 'نافذة جديدة', 'إغلاق', 'تشغيل', 'إعادة تشغيل', 'إيقاف', 'إنهاء (Kill)',
        'الإنهاء يوقف الحاوية فوراً. كل ما لم يكتبه الخادم على القرص بعد سيُفقد. هل تريد المتابعة؟',
        'إجراء الطاقة', 'تم إرسال :action إلى :name.', 'تعذّر الوصول إلى العقدة.',
        'هذه اللوحة', 'لا يستجيب', 'صيانة', 'المعالج', 'الذاكرة', 'القرص', 'الحِمل'],

    be: ['Кансоль', 'Новае акно', 'Закрыць', 'Запусціць', 'Перазапусціць', 'Спыніць', 'Kill',
        'Kill спыняе кантэйнер адразу. Усё, што сервер яшчэ не запісаў на дыск, будзе страчана. Працягнуць?',
        'Дзеянне сілкавання', ':action адпраўлена на :name.', 'Не ўдалося звязацца з вузлом.',
        'Гэта панэль', 'не адказвае', 'абслугоўванне', 'Працэсар', 'Памяць', 'Дыск', 'Нагрузка'],

    bg: ['Конзола', 'Нов прозорец', 'Затвори', 'Стартирай', 'Рестартирай', 'Спри', 'Kill',
        'Kill спира контейнера на място. Всичко, което сървърът още не е записал на диска, се губи. Да продължим ли?',
        'Действие за захранване', ':action беше изпратено към :name.', 'Възелът не можа да бъде достигнат.',
        'Този панел', 'не отговаря', 'поддръжка', 'Процесор', 'Памет', 'Диск', 'Натоварване'],

    cs: ['Konzole', 'Nové okno', 'Zavřít', 'Spustit', 'Restartovat', 'Zastavit', 'Kill',
        'Kill zastaví kontejner na místě. Vše, co server ještě nezapsal na disk, bude ztraceno. Pokračovat?',
        'Akce napájení', ':action bylo odesláno na :name.', 'Uzel nebyl dostupný.',
        'Tento panel', 'neodpovídá', 'údržba', 'Procesor', 'Paměť', 'Disk', 'Zátěž'],

    da: ['Konsol', 'Nyt vindue', 'Luk', 'Start', 'Genstart', 'Stop', 'Kill',
        'Kill stopper containeren med det samme. Alt, som serveren endnu ikke har skrevet til disken, går tabt. Fortsæt?',
        'Strømhandling', ':action blev sendt til :name.', 'Noden kunne ikke nås.',
        'Dette panel', 'svarer ikke', 'vedligeholdelse', 'CPU', 'Hukommelse', 'Disk', 'Belastning'],

    de: ['Konsole', 'Neues Fenster', 'Schließen', 'Starten', 'Neu starten', 'Stoppen', 'Kill',
        'Kill stoppt den Container sofort. Alles, was der Server noch nicht auf die Festplatte geschrieben hat, geht verloren. Fortfahren?',
        'Energieaktion', ':action wurde an :name gesendet.', 'Die Node war nicht erreichbar.',
        'Dieses Panel', 'antwortet nicht', 'Wartung', 'CPU', 'Arbeitsspeicher', 'Festplatte', 'Auslastung'],

    el: ['Κονσόλα', 'Νέο παράθυρο', 'Κλείσιμο', 'Εκκίνηση', 'Επανεκκίνηση', 'Διακοπή', 'Kill',
        'Το Kill σταματά το container αμέσως. Ό,τι δεν έχει γράψει ακόμη ο διακομιστής στον δίσκο χάνεται. Συνέχεια;',
        'Ενέργεια λειτουργίας', 'Το :action στάλθηκε στο :name.', 'Ο κόμβος δεν ήταν προσβάσιμος.',
        'Αυτό το panel', 'δεν απαντά', 'συντήρηση', 'Επεξεργαστής', 'Μνήμη', 'Δίσκος', 'Φορτίο'],

    es: ['Consola', 'Ventana nueva', 'Cerrar', 'Iniciar', 'Reiniciar', 'Detener', 'Kill',
        'Kill detiene el contenedor de inmediato. Todo lo que el servidor aún no haya escrito en el disco se pierde. ¿Continuar?',
        'Acción de encendido', ':action se envió a :name.', 'No se pudo contactar con el nodo.',
        'Este panel', 'no responde', 'mantenimiento', 'CPU', 'Memoria', 'Disco', 'Carga'],

    fi: ['Konsoli', 'Uusi ikkuna', 'Sulje', 'Käynnistä', 'Käynnistä uudelleen', 'Pysäytä', 'Kill',
        'Kill pysäyttää säiliön välittömästi. Kaikki, mitä palvelin ei ole vielä kirjoittanut levylle, menetetään. Jatketaanko?',
        'Virtatoiminto', ':action lähetettiin kohteeseen :name.', 'Solmuun ei saatu yhteyttä.',
        'Tämä paneeli', 'ei vastaa', 'huolto', 'Suoritin', 'Muisti', 'Levy', 'Kuormitus'],

    fr: ['Console', 'Nouvelle fenêtre', 'Fermer', 'Démarrer', 'Redémarrer', 'Arrêter', 'Kill',
        'Kill arrête le conteneur sur-le-champ. Tout ce que le serveur n\'a pas encore écrit sur le disque est perdu. Continuer ?',
        'Action d\'alimentation', ':action a été envoyé à :name.', 'Le nœud est injoignable.',
        'Ce panel', 'ne répond pas', 'maintenance', 'Processeur', 'Mémoire', 'Disque', 'Charge'],

    hu: ['Konzol', 'Új ablak', 'Bezárás', 'Indítás', 'Újraindítás', 'Leállítás', 'Kill',
        'A Kill azonnal leállítja a konténert. Minden, amit a szerver még nem írt lemezre, elvész. Folytatja?',
        'Bekapcsolási művelet', 'A :action elküldve ide: :name.', 'A csomópont nem volt elérhető.',
        'Ez a panel', 'nem válaszol', 'karbantartás', 'Processzor', 'Memória', 'Lemez', 'Terhelés'],

    id: ['Konsol', 'Jendela baru', 'Tutup', 'Jalankan', 'Mulai ulang', 'Hentikan', 'Kill',
        'Kill menghentikan kontainer seketika. Semua yang belum ditulis server ke disk akan hilang. Lanjutkan?',
        'Tindakan daya', ':action dikirim ke :name.', 'Node tidak dapat dihubungi.',
        'Panel ini', 'tidak merespons', 'pemeliharaan', 'CPU', 'Memori', 'Disk', 'Beban'],

    it: ['Console', 'Nuova finestra', 'Chiudi', 'Avvia', 'Riavvia', 'Arresta', 'Kill',
        'Kill arresta il container all\'istante. Tutto ciò che il server non ha ancora scritto su disco va perso. Continuare?',
        'Azione di alimentazione', ':action è stato inviato a :name.', 'Il nodo non è raggiungibile.',
        'Questo pannello', 'non risponde', 'manutenzione', 'CPU', 'Memoria', 'Disco', 'Carico'],

    ja: ['コンソール', '新しいウィンドウ', '閉じる', '起動', '再起動', '停止', 'Kill',
        'Kill はコンテナをその場で停止します。サーバーがまだディスクに書き込んでいないものはすべて失われます。続行しますか？',
        '電源操作', ':action を :name に送信しました。', 'ノードに接続できませんでした。',
        'このパネル', '応答なし', 'メンテナンス', 'CPU', 'メモリ', 'ディスク', '負荷'],

    ko: ['콘솔', '새 창', '닫기', '시작', '다시 시작', '중지', 'Kill',
        'Kill은 컨테이너를 즉시 중지합니다. 서버가 아직 디스크에 기록하지 않은 내용은 모두 사라집니다. 계속할까요?',
        '전원 작업', ':action을(를) :name에 보냈습니다.', '노드에 연결할 수 없습니다.',
        '이 패널', '응답 없음', '점검 중', 'CPU', '메모리', '디스크', '부하'],

    lt: ['Konsolė', 'Naujas langas', 'Uždaryti', 'Paleisti', 'Perkrauti', 'Stabdyti', 'Kill',
        'Kill nedelsiant sustabdo konteinerį. Viskas, ko serveris dar neįrašė į diską, bus prarasta. Tęsti?',
        'Maitinimo veiksmas', ':action išsiųsta į :name.', 'Nepavyko pasiekti mazgo.',
        'Šis skydelis', 'neatsako', 'techninė priežiūra', 'Procesorius', 'Atmintis', 'Diskas', 'Apkrova'],

    no: ['Konsoll', 'Nytt vindu', 'Lukk', 'Start', 'Start på nytt', 'Stopp', 'Kill',
        'Kill stopper containeren umiddelbart. Alt serveren ennå ikke har skrevet til disk, går tapt. Fortsette?',
        'Strømhandling', ':action ble sendt til :name.', 'Noden kunne ikke nås.',
        'Dette panelet', 'svarer ikke', 'vedlikehold', 'CPU', 'Minne', 'Disk', 'Belastning'],

    pl: ['Konsola', 'Nowe okno', 'Zamknij', 'Uruchom', 'Uruchom ponownie', 'Zatrzymaj', 'Kill',
        'Kill zatrzymuje kontener natychmiast. Wszystko, czego serwer nie zapisał jeszcze na dysku, zostanie utracone. Kontynuować?',
        'Akcja zasilania', 'Wysłano :action do :name.', 'Nie udało się połączyć z węzłem.',
        'Ten panel', 'nie odpowiada', 'konserwacja', 'Procesor', 'Pamięć', 'Dysk', 'Obciążenie'],

    pt: ['Consola', 'Nova janela', 'Fechar', 'Iniciar', 'Reiniciar', 'Parar', 'Kill',
        'O Kill pára o contentor de imediato. Tudo o que o servidor ainda não escreveu no disco perde-se. Continuar?',
        'Ação de energia', ':action foi enviado para :name.', 'Não foi possível contactar o nó.',
        'Este painel', 'não responde', 'manutenção', 'CPU', 'Memória', 'Disco', 'Carga'],

    pt_BR: ['Console', 'Nova janela', 'Fechar', 'Iniciar', 'Reiniciar', 'Parar', 'Kill',
        'O Kill para o contêiner na hora. Tudo o que o servidor ainda não gravou no disco é perdido. Continuar?',
        'Ação de energia', ':action foi enviado para :name.', 'Não foi possível contatar o nó.',
        'Este painel', 'não responde', 'manutenção', 'CPU', 'Memória', 'Disco', 'Carga'],

    ro: ['Consolă', 'Fereastră nouă', 'Închide', 'Pornește', 'Repornește', 'Oprește', 'Kill',
        'Kill oprește containerul pe loc. Tot ce serverul nu a scris încă pe disc se pierde. Continuați?',
        'Acțiune de alimentare', ':action a fost trimis către :name.', 'Nodul nu a putut fi contactat.',
        'Acest panou', 'nu răspunde', 'mentenanță', 'Procesor', 'Memorie', 'Disc', 'Încărcare'],

    ru: ['Консоль', 'Новое окно', 'Закрыть', 'Запустить', 'Перезапустить', 'Остановить', 'Kill',
        'Kill останавливает контейнер немедленно. Всё, что сервер ещё не записал на диск, будет потеряно. Продолжить?',
        'Действие питания', ':action отправлено на :name.', 'Не удалось связаться с узлом.',
        'Эта панель', 'не отвечает', 'обслуживание', 'Процессор', 'Память', 'Диск', 'Нагрузка'],

    sk: ['Konzola', 'Nové okno', 'Zavrieť', 'Spustiť', 'Reštartovať', 'Zastaviť', 'Kill',
        'Kill zastaví kontajner okamžite. Všetko, čo server ešte nezapísal na disk, sa stratí. Pokračovať?',
        'Akcia napájania', ':action bolo odoslané na :name.', 'Uzol nebol dostupný.',
        'Tento panel', 'neodpovedá', 'údržba', 'Procesor', 'Pamäť', 'Disk', 'Záťaž'],

    sr: ['Конзола', 'Нови прозор', 'Затвори', 'Покрени', 'Поново покрени', 'Заустави', 'Kill',
        'Kill зауставља контејнер одмах. Све што сервер још није уписао на диск биће изгубљено. Наставити?',
        'Радња напајања', ':action је послато на :name.', 'Чвор није био доступан.',
        'Овај панел', 'не одговара', 'одржавање', 'Процесор', 'Меморија', 'Диск', 'Оптерећење'],

    sv: ['Konsol', 'Nytt fönster', 'Stäng', 'Starta', 'Starta om', 'Stoppa', 'Kill',
        'Kill stoppar containern omedelbart. Allt som servern ännu inte har skrivit till disk går förlorat. Fortsätta?',
        'Strömåtgärd', ':action skickades till :name.', 'Noden kunde inte nås.',
        'Den här panelen', 'svarar inte', 'underhåll', 'CPU', 'Minne', 'Disk', 'Belastning'],

    tr: ['Konsol', 'Yeni pencere', 'Kapat', 'Başlat', 'Yeniden başlat', 'Durdur', 'Kill',
        'Kill konteyneri olduğu yerde durdurur. Sunucunun diske henüz yazmadığı her şey kaybolur. Devam edilsin mi?',
        'Güç işlemi', ':action, :name sunucusuna gönderildi.', 'Düğüme ulaşılamadı.',
        'Bu panel', 'yanıt vermiyor', 'bakım', 'İşlemci', 'Bellek', 'Disk', 'Yük'],

    uk: ['Консоль', 'Нове вікно', 'Закрити', 'Запустити', 'Перезапустити', 'Зупинити', 'Kill',
        'Kill зупиняє контейнер негайно. Усе, що сервер ще не записав на диск, буде втрачено. Продовжити?',
        'Дія живлення', ':action надіслано до :name.', 'Не вдалося зв\'язатися з вузлом.',
        'Ця панель', 'не відповідає', 'обслуговування', 'Процесор', 'Пам\'ять', 'Диск', 'Навантаження'],

    vi: ['Bảng điều khiển', 'Cửa sổ mới', 'Đóng', 'Khởi động', 'Khởi động lại', 'Dừng', 'Kill',
        'Kill dừng container ngay lập tức. Mọi thứ máy chủ chưa ghi xuống đĩa sẽ mất. Tiếp tục?',
        'Thao tác nguồn', 'Đã gửi :action tới :name.', 'Không liên lạc được với node.',
        'Bảng này', 'không phản hồi', 'bảo trì', 'CPU', 'Bộ nhớ', 'Ổ đĩa', 'Tải'],

    zh_CN: ['控制台', '新窗口', '关闭', '启动', '重启', '停止', 'Kill',
        'Kill 会立即停止容器。服务器尚未写入磁盘的内容都会丢失。是否继续？',
        '电源操作', '已将 :action 发送至 :name。', '无法连接到节点。',
        '本面板', '无响应', '维护中', 'CPU', '内存', '磁盘', '负载'],

    zh_TW: ['主控台', '新視窗', '關閉', '啟動', '重新啟動', '停止', 'Kill',
        'Kill 會立即停止容器。伺服器尚未寫入磁碟的內容都會遺失。是否繼續？',
        '電源操作', '已將 :action 傳送至 :name。', '無法連線至節點。',
        '本面板', '無回應', '維護中', 'CPU', '記憶體', '磁碟', '負載'],
};

const CONTROLS = ['console', 'full_page', 'close', 'start', 'restart', 'stop', 'kill',
    'kill_confirm', 'sent_title', 'sent_body', 'failed'];
const NODES = ['panel', 'offline', 'maintenance', 'cpu', 'memory', 'disk', 'load'];

const HEAD = `<?php

/*
 * Generated by tools/make-lang.js as a starting point, not as a finished
 * translation. These are the strings every reader sees on pages they open
 * anyway - the power buttons and the node meters - so they were worth having in
 * every language Pelican supports before the rest of the plugin is done.
 *
 * Corrections from someone who actually speaks this are welcome and should be
 * made here; the generator skips files that already exist.
 *
 * A key missing from this file is not a fault. Laravel falls back per key, so
 * what is here is in this language and the rest is English.
 */

return [
`;

const quote = (s) => "'" + s.replace(/\\/g, '\\\\').replace(/'/g, "\\'") + "'";

let written = 0;
let skipped = 0;

for (const [code, values] of Object.entries(T)) {
    if (values.length !== CONTROLS.length + NODES.length) {
        console.error('  ' + code + ' has ' + values.length + ' values, expected ' + (CONTROLS.length + NODES.length));
        process.exit(1);
    }

    const dir = path.join(root, 'lang', code);
    fs.mkdirSync(dir, { recursive: true });

    for (const [group, keys, offset] of [['controls', CONTROLS, 0], ['nodes', NODES, CONTROLS.length]]) {
        const file = path.join(dir, group + '.php');

        if (fs.existsSync(file) && !force) {
            skipped += 1;
            continue;
        }

        const body = keys
            .map((key, i) => '    ' + quote(key) + ' => ' + quote(values[offset + i]) + ',')
            .join('\n');

        fs.writeFileSync(file, HEAD + body + '\n];\n', 'utf8');
        written += 1;
    }
}

console.log('make-lang: ' + written + ' file(s) written, ' + skipped + ' left alone.');
