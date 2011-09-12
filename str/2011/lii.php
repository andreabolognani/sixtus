<?php
	$title=array('Sgaggio Tiem',
		'Perché certe cose devono essere raccontate');
	$prev=array('Il Druido','Storie/2011/LI/');
	$next=array('Quel che ho fatto','Storie/2011/LIII/');
	function mkpage($d){
		$self = 'Storie/2011/LII/';
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<h2>
				Sgaaaaaaaaaaaaaggio!
			</h2><ol><li id="li-i">
					<?=$d->link($self,'Recupero','I')?> — 08/07/2011 11:00
				</li><li id="li-ii">
					<?=$d->link($self,'Installazione','II')?> – 08/07/2011 14:30
				</li><li id="li-iii">
					<?=$d->link($self,'La mappa di bit','III')?> – 11/07/2011 14:55
				</li><li id="li-iv">
					<?=$d->link($self,'La prima iterazione','IV')?> – 11/07/2011 16:30
				</li><li id="li-v">
					<?=$d->link($self,'La resurrezione','V')?> – 12/07/2011 XX:XX
				</li><li id="li-vi">
					<?=$d->link($self,'Trasferimento','VI')?> – 13/07/2011 12:30
				</li><li id="li-vii">
					<?=$d->link($self,'Spegnimento','VII')?> – 13/07/2011 18:30
				</li><li id="li-viii">
					<?=$d->link($self,'Il kernel','VIII')?> – 14/07/2011 18:00
				</li><li id="li-ix">
					<?=$d->link($self,'Boot image','IX')?> – 14/07/2011 18:30
				</li><li id="li-x">
					<?=$d->link($self,'Seriale','X')?> – 15/07/2011 12:50
				</li><li id="li-xi">
					<?=$d->link($self,'La seconda iterazione','XI')?>
					– 15/07/2011 17:00
				</li><li id="li-xii">
					<?=$d->link($self,'Packing services','XII')?>
					– 18/07/2011 12
				</li><li id="li-xiii">
					<?=$d->link($self,'Aggiornamenti','XIII')?>
					– 19/07/2011 12:30
				</li><li id="li-xiv">
					<?=$d->link($self,'La terza iterazione','XIV')?>
					– 19/07/2011 17:00
				</li><li id="li-xv">
					<?=$d->link($self,'L&apos;Apache','XV')?>
					– 20/07/2011 11:00
				</li><li id="li-xvi">
					<?=$d->link($self,'La formattazione','XVI')?>
					– 20/07/2011 17:30
				</li><li id="li-xvii">
					<?=$d->link($self,'Ricerca','XVII')?>
					– 21/07/2011
				</li><li id="li-xviii">
					<?=$d->link($self,'Crossing','XVIII')?>
					– 22/07/2011
				</li><li id="li-xix">
					<?=$d->link($self,'Lo scoglio','XIX')?>
					– 26/07/2011
				</li><li id="li-xx">
					<?=$d->link($self,'La luce in fondo al tunnel','XX')?>
					– 29/07/2011
				</li><li id="li-xxi">
					<?=$d->link($self,'E infine…','XXI')?>
					– 30/07~05/08
				</li>
			</li></ol>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-i">
			<div class="section">
	<p>
		E insomma… venne il giorno. Ce ne andammo, io e il <span
		class="jazz">signor Jazzinghen</span>, da Macii per ricevere
		l'investitura.
	</p><p>
		In ufficio da Macii ci viene fornita immediatamente l'immensa scatola,
		che contiene:
	</p><ul><li>
			<p>la scheda <span class="code">XILINX FPGA Virtex-II Pro ML130</span>,
			una scheda madre con sopra un banco di RAM, un lettore Flashcard per
			memorizzare la mappa del processore, una porta parallela, due porte
			seriali, quattro ingressi PCI (che non dobbiamo usare) e svariata
			altra yadda<p>
		</li><li>
			<p>un alimentatore Antec, con tutta la cavetteria del mondo e un
			cavo dell'alimentazione lungo fin laggiù</p>
		</li><li>
			<p>il programmatore, ossia un aggeggino grande così che comunica con
			la scheda tramite un misterioso connetore a 14pin, che deve essere
			alimentato a parte da un altro aggeggieto da attaccare alla corrente
			e, notate bene, un bella porta parallela a 21pin, l'unica via di
			comunicazione per programmare il processore</p>
		</li><li>
			<p>un minuscolissimo monitor LCD, grande la metà di quello del
			GameBoy, che costituisce la principale modalità di controllo sullo
			stato della macchina (oltre agli otto LED di debug, che dovremmo
			poter usare a piacimento)</p>
	</li></ul><p>
		Ma non solo. Perché oltre a questo abbiamo anche una palettata di slide,
		di documentazione e i due pacchetti software necessari per comunicare
		con il mostro. E nel mentre siamo stati condotti nel laboratorio, là
		dove alcuni colleghi fanno cose fighe, là dove si trovano molti altri
		kit NXT a vari scopi, ma soprattutto là dove si trova la <span
		class="em">Scatola delle Libertà</span> (così disse lo stesso Macii)
		contenente ogni sorta di cavi. Tutti tranne quel che serviva a noi,
		ovviamente.
	</p><p>
		Entrambi piuttosto vecchiotti (versioni 9 nel 2007, ora sono alla 13…)
		questi due nonnetti sono ISE e EDK, rispettivamente il “compilatore” che
		scrive si occupa di creare le connessioni del processore e il
		“development kit” per poterci programmare sopra.
	</p>
			</div>
		</div><div class="tab" id="tab-ii">
			<div class="section">
	<p>
		Partiamo con l'installazione. Per prima cosa, ISE, lui e il suo bel CD
		vecchio di almeno quattro anni… inserisco l'aggeggio, monto il CD,
		«salve sono il SETUP»…
	</p><p>
		E immediatamente cominciano i problemi: a quanto pare i permessi 0755
		non bastano, perché non riesco ad eseguire questo file (che non è un
		script della bash, come speravo, è un binario…), e non posso cambiare i
		permessi, né il proprietario, perché il filesystem è ovviamente montato
		il sola lettura.
	</p><p>
		Avrò fatto dei casini con il mio <span class="code">fstab</span>? Fatto
		sta che rimontando il CD una seconda volta, senza il minimo cambiamento
		apparente, riesco a far partire l'aggeggio.
	</p><p>
		Vedo di installare soltanto le componenti pertinenti al nostro progetto,
		visto che il kit permette di smanacciare con ogni aggeggino prodotto
		dalla XILINX dal 1970 ad oggi… tolgo la fuffa, tolgo il supporto per le
		piattaforme che non sono nostre, rimango con soli 3.33GB
		d'installazione. Gli faccio «butta la tua roba in <span
		class="code">/opt/xilinx/</span> ch'è pronta per te» quando il bastardo
		alza il suo mignolino e mi risponde «… e se non ci fosse abbastanza
		spazio libero su disco?»
	</p><p>
		Cazzo, ci sono 78GB liberi! «Vuoi procedere comunque?» chiede lo
		stronzo. E dai e dai, alla fine ce la fa; ci mette un quarto d'ora, ma
		ce la fa.
	</p><p>
		E si passa al secondo aggeggio, EDK. Ripeto la procedura con gli stessi
		effetti: monto il CD due volte, lancio l'eseguibile, manca spazio su
		disco, blah blah blah e alla fine ci siamo.
	</p><p>
		Ora dobbiamo andare a procurarci l'adattatore parallela/USB per sperare
		di poter realizzare un ponte.
	</p>
			</div>
		</div><div class="tab" id="tab-iii">
			<div class="section">
	<p>
		E insomma, passò il fine settimana, carico di emozioni sia per me sia
		per Jazz…
	</p><p>
		Cose brutte per tutti. In particolare, l'acquisto del dannato adattatore
		parallela/USB che poi non funziona.
	</p>
</div><div class="section">
	<p>
		Ma oggi mi concentro su un'altra cosa, nell'attesa di andare a discutere
		di questo problema con il professore.
	</p><p>
		Perché anche potendo comunicare in qualche modo con la board, ci servirà
		qualcosa da dire. Nel nostro caso, la mappa di bit che descrivere
		l'architettura di un MicroBlaze (quale? Boh! Immagino sia quello
		standard…)
	</p><p>
		Andiamo dunque a seguire le slide che ci spiegano come generare
		quest'immagine. Tolto il fatto che la cartella <span
		class="code">bin/lin/</span> si trovano qualcosa come 126 file, tra i
		quali 86 librerie, non avevo la minima idea di quale fosse
		l'applicazione da lanciare.
	</p><p>
		Scopriamo che si tratta di <span class="code">xps</span>,
		tranquillamente confondibile con <span class="code">xpsgui</span> o con
		<span class="code">xps --gui</span>.
	</p>
</div><div class="section">
	<p>
		Cominciamo con il fatto che questo programma non sa niente, non trova
		nessuno dei componenti. Comincia con il chiedermi dove siano le sue
		librerie; glielo dico («<span class="gods">sono nella cartella presente,
		coglione!</span>»); non sa dove siano le librerie per ISE («<span
		class="gods">Quelle sono nella home di ISE, coglione! Me l'hai chiesto
		durante l'installazione!</span>»); glielo dico…
	</p><p>
		Poi si lamenta che un certo file <span class="code">fileset.txt</span>
		non è scrivibile. Io guardo, questo file non esiste; glielo creo vuoto e
		lui non ci scrive niente…
	</p><p>
		Poi mi dice che <span class="code">_xps</span> non esiste. Gli faccio
		notare che anch'esso è nella cartella presente. Lui mi risponde che non
		gli serve soltanto <span class="code">$LD_LIBRARY_PATH</span> per
		caricare il bazzilione di librerie, ma gli serve anche <span
		class="code">$PATH</span> per lanciare altri applicativi. Del fatto che
		m'aveva già chiesto tutta 'sta roba in installazione s'è dimenticato,
		evidentemente. Così mi metto a settare la quarta variabile d'ambiente
		necessaria a questo stronzo.
	</p>
</div><div class="section">
	<p>
		Al che si decide a partire. Mi compare davanti il mago, uno di quei
		classici programmoni grafici che ti fanno &gt;9000 domande per crearti
		un progetto.
	</p><p>
		«<span class="gods">D'accordo, BSB, facciamo come dici tu… ma non
		dovresti chiamarti XPS?</span>» perché il tizio cambia nome… boh.
	</p><p>
		Lui mi chiede se voglio creare un nuovo progetto, io accetto prontamente
		e gli indico una cartella già pronta, <span
		class="code">~/devel/sgaggio/</span>, dove ho già un po' di roba. Al
		prossimo “NEXT” (il primo di una lunghissima serie, ovviamente) il tizio
		s'interrompe e mi fa «<span class="code">Guarda che questa bella
		cartella che m'hai detto è nel mio albero d'installazione. Sarebbe
		meglio mettere il progetto altrove. E con “meglio” intendo dire che
		altrimenti m'inchiodo. Ciao!»
	</p><p>
		Sentite questo tonfo? Erano le mie.
	</p><p>
		Non troppo deciso, di prima mattina, a calare le brache di fronte alle
		irragionevoli richieste di questo programm'e'mmerda, ricreo il progetto
		un po' più vicino a dove vuole lui. Ma lui, a quanto pare, ha già
		cambiato idea; l'errore rimane lo stesso, anche quando tento di
		salvare il progetto nella sua locazione di default, o persino quando –
		disperato e consigliato da <span class="war">War</span>, che passava di
		lì) – monto il disco esterno e salvo lì… TUTTO è nell'albero di
		installazione di EDK, secondo EDK.
	</p><p>
		Ancora non so cosa intendesse dire veramente.
	</p>
</div><div class="section">
	<p>
		Dopo mezza dozzina di punti a <span class="code">Warning Forever</span>
		mi rimetto al lavoro. Devo aver erroneamente chiuso quella shell, avrò
		modificato le variabili d'ambiente senz'accorgermene, o chissà quale
		altra cosa, succede che ora posso creare progetti senza che il pudore di
		EDK ne venga turbato.
	</p><p>
		Seguendo passo passo la guida, salta fuori un'altra finestrella che mi
		chiede che progetto dovrebbe essere il mio: se uno nuovi di pacca o uno
		preesistente. Uhm… facciamo quello nuovo, ovviamente, perché non c'è
		ancora nulla da modificare; <span class="em">sghissa botton</span> ed
		ecco un bell'elenco delle architetture disponibili. VUOTO.
	</p><p>
		L'unica altra opzione è disattivata. Di funzionante (di attivo) c'è
		soltanto un link, che porta ad una pagina del sito di queste scimmie.
		Convinto che male non potesse fare, calco quel link. Salta fuori questo:
	</p><div class="outside"><p>
			Mozilla &lt;$url&gt;: errore!
		</p><p>
			Impossibile trovare <span class="em">NETSCAPE</span>. Assicurarsi
			che $PATH contenga una cartella con NetScape.
	</p></div><p>
		A questo mi rifiuto categoricamente di cedere. Prendo l'URL per i piedi,
		vado a controllare, e scopro che la Xilinx collabora con due altre
		aziende, una con un link ufficiale e una senza. Boh.
	</p><p>
		Prendo il link della prima e comincio a perdermi via… scopro che questa
		gente redistribuisce più o meno la stessa roba, altri tizi fanno altre
		cose, tutte 'ste notizie sono vecchie di cinque anni, a nessuno frega
		più niente di 'sta board qui…
	</p><p>
		Poi, nei vari tentativi, noto che il tasto NEXT è attivo e clickabile.
		Lo faccio. Crash. Crash istantaneo e definitivo. Wow.
	</p>
</div><div class="section">
	<p>
		Me ne vado allora a spasso per l'internet a cercare di altri tizi che
		possono essere stati nelle mie condizioni.
	</p><p>
		Tramite ricerche (incrementali, con parole chiavi sempre più
		improbabili) finisco su un pezzo di PDF che narra di quali siano le
		specifiche hardware di qualcosa. E vedo, chissà per qual motivo proprio
		qui e non altrove, che il bell'EDK/BSB/XPS/comesichiama, cerca questi
		file in tre locazioni standard.
	</p><p>
		Seguo il primo di questi path nella mia installazione et voilà, ecco
		tutto quel che volevo. Ma lui non trova questa roba, i suoi paraocchi
		sono troppo stretti. Non potendo configurare altro che questo, faccio un
		tentativo e sposto $XILINX_EDK «<span class="gods">Mal che vada lo
		rimetterò a posto…” sulla cartella madre, che contiene tutto.
	</p><p>
		Contro ogni mia aspettativa, l'aggeggio non esplode, anzi, finalmente
		si decide a fare il passettino. Eccomi quindi con queste dannate
		specifiche hardware a disposizione.
	</p><p>
		Subito due scelte: MicroBlaze o PowerPC? «<span class="gods">Ma il
		MicroBlaze non era già di suo un PowerPC?</span>» Si, ma forse non
		abbastanza, forse troppo, visto ch'è anche MIPS. Boh.
	</p><p>
		Subito tre scelte: frequenza del clock, numero di canali, bit di parità;
		e poi altre scelte, tipo il colore della board, la direzione del vento,
		il numero di scarpe, questo e &gt;9000 altre specifiche. Ovviamente, ho
		defaultato tutto quanto.
	</p><p>
		E dopo tutta questa trafila, ecco che il mago si mette finalmente a
		lavorare e crea, disegna, fa cose… alla fine il progetto pare fatto.
		L'immagine viene creata. Ovviamente, non nella cartella indicata, ma
		nella cartella padre. Bah.
	</p><p>
		Faccio dunque un test, tento di scaricare l'immagine sulla scheda. So
		che non è collegata, quindi m'aspetto che mi venga chiesto dove/come
		trovare il cavo, la connessione, la porta.
	</p><p>
		Invece no, EDK mi chiede «<span class="code">Lo sai che ogni chippino
		piccino che vado a disegnare ha bisogno di essere correttamente
		licenziato, vero? Controlla $questo e $quello…</span>»
	</p>
			</div>
		</div><div class="tab" id="tab-iv">
			<div class="section">
	<p>
		Dopo una certa delusione, qualche minuto di distrazione e una buona
		merenda (ho preso l'abitudine di prendermi al bar un secondo panino, da
		mangiare più tardi…) mi sono rimesso al lavoro.
	</p><p>
		Non ho concluso niente.
	</p>
</div><div class="section">
	<p>
		Poco dopo, Jazz e il <span class="em">nuovo genio</span> (tizio ch'è
		venuto ad imparare l'Assembly) smettono di lavorare, cosicché io e il
		mio collega possiamo prendere armi e bagagli per andare da Sgaggio a
		fare rapporto.
	</p><p>
		Non lo troviamo al primo colpo, ma veniamo indirizzati al laboratorio.
		Là troviamo lo Sgaggio insieme agli uomini e alle donne di Embedded, una
		speciale forza degli scienziati dedicati alle cose fighe.
	</p><p>
		Spieghiamo rapidamente i nostri problemi di licenze, scopriamo che essi
		possono essere evitati semplicemente togliendoli dall'implementazione
		ridisegnando l'immagine binaria.
	</p><p>
		Ci rimangono tuttavia ancora i problemi di comunicazione con la scheda,
		e per questo abbiamo due simpatiche soluzioni da provare:
	</p><ul><li>
			<p>un adattatore seriale/USB, che potrebbe pure funzionare, essendo
			collegato ad una porta speciale (la terza seriale) che entra
			nell'FPGA tramite un qualche connettore JTAG, che potrebbe quindi
			influire sulla forma del processore</p>
		</li><li>
			<p>il mio vecchio portatile, IvanPrime, un vetusto ASUS merda che ne ha
			viste di tutti i tipi, dotato (storia vera) di una porta seriale mai
			usata. Speriamo che abbia ancora la forza di lavorare…</p>
	</li></ul><p>
		E con questo, dichiaro finita la seconda giornata di lavori.
		Oltrettutto, tirar fuori questo baraccone dalla scatole e poi rimetterlo
		a posto porta via tanto di quel tempo… Saluti.
	</p>
			</div>
		</div><div class="tab" id="tab-v">
			<div class="section">
	<p>
		Tornatomene a casuccia, vado a rimestare nei meandri della mia stanza
		per riesumare il vecchio portatile. Il vecchio IvanPrime, un vetusto
		ASUS dotato tra le altre cose di porta parallela.
	</p><p>
		Sinceramente, non credevo che sarebbe mai stata usata. E invece… ma i
		problemi cominciano immediatamente, considerato il fatto che quel
		portatile è stato dismesso da alcuni anni per aver preso acqua, con
		conseguente (tipico degli ASUS) manlfuzionamento della tastiera.
	</p><p>
		Niente che non si possa risolvere con una dannata tastiera esterna,
		vero? E invece no, perché il mouse può funzionare, ma la tastiera non
		viene riconosciuta. XP si rifiuta di prenderla come canale d'input; non
		il BIOS, non in fase di caricamento, non i due tasti POWER e IBERNATE,
		solo i tasti utili nei momenti utili.
	</p><p>
		Avendo le palle a terra e nulla di importante su quel baraccone, decido
		di ripristinarlo a condizioni verginali e fregarmene del resto. Che ci
		vorrà mai? Beh, due dischi di ripristino (<span class="em">Windows XP
		for ASUS only</span>) e uno di driver (colmo di porcate, ciascuna
		assolutamente indispensabile) dopo, prendendo soltanto un paio d'ore
		delle nostre vite, ecco XP rifare capolino affermando di sapere cos'è
		una tastiera USB.
	</p><p>
		Dopodiché, mettiamoci a scaricare immediatamente Firefox, poi pensiamo
		al ServicePack3 di Windows, che non si sa mai, considerato anche il
		fatto che dovremmo poter collegare il poveraccio all'internet.
	</p>
</div><div class="section">
	<p>
		Così, &gt;9000 minuscoli passaggi dopo, nacque <span
		class="em">IvanPrimeII</span> e fu finalmente possibile installare ISE.
		Fatto; non subito, ma abbastanza in fretta. Ma sapevate che ISE 9.1i ha
		un service pack?
	</p><p>
		Ci mettiamo a scaricarlo, pensa soltanto 2GB… tiratolo giù dalla rete in
		una mezz'ora, installiamo anche quello. E cominciamo a generare
		l'immagine del MicroBlaze.
	</p><p>
		Poco dopo, dopo aver spinto il portatilino ai suoi limiti (il poveretto
		dispone di 512MB di RAM soltanto) eccoci con un'immagine pronta per
		essere trasferita. O forse no?
	</p>
</div><div class="section">
	<p>
		Una scritta dice
	</p><div class="outside"><p>
		«<span class="code forte" style="color: #ff0000">Unable to open Xilinx
		data file for Vendor/Device Module “spartan3adspsdi”</span>»
	</p></div><p>
		Se ve lo steste chiedendo, questo “Spartan 3a” è un altro FPGA, una
		versione più didattica e piccina del nostro Virtex II 310 ML CE.
	</p>
</div><div class="section">
	<p>
		Ma sembra che ISE voglia avere delle specifiche anche per quell'altro… ci
		chiediamo perché… andiamo a chiedere alla documentazione ufficiale, che
		ci parla di tre possibili soluzioni, testualmente:
	</p><ul><li>
			<p>Do not install ISE 9.1 SP3</p>
		</li><li>
			<p>Make a local copy of all the pcores used in the design and
			remove Spartan-A3 from the ARCH_SUPPORT_MAP tag in the *.mpd
			files</p>
		</li><li>
			<p>Do not install Spartan-A3 devices in the ISE area</p>
	</li></ul><p>
		Io tento la via del <span class="code">grep | sed</span> e cosacce
		varie, mentre l'intrepido Jazz si mette a modificare i filozzi a mano,
		per una decina di arrendersi e utilizzare il truccone, rinominare il
		file <span class="code">spartan3adsp.acd</span> contenuto in <span
		class="code">xilinx9.1i/spartan3adsp/data/</span> aggiungendo
		l'estensione <span class="code">.jaxx</span>, cose da <span
		class="em">veri accher</span>.
	</p><p>
		Alla fine di questo lungo processo, pare che l'aggeggio voglia
		finalmente mettersi a lavorare. Bene.
	</p><p>
		Ma a quel punto, la giornata era conclusa, era tardi ed ormai ora
		d'andarsene tutti a casa. La l'ultimo colpo di coda era in agguato: al
		momento dell'arresto, il dannato XP annuncia con tutta calma d'avere 76
		(<span class="em">settantasei</span>) aggiornamenti da installare.
	</p>
			</div>
		</div><div class="tab" id="tab-vi">
			<div class="section">
	<p>
		Uhm. Stamattina, avendo noi il portatile funzionante (beh, quasi) e
		l'immagine pronta, abbiam provato a trasferire l'immagine sulla scheda.
		E qui arriva una sorpresa!
	</p><p>
		Sapete quella nostra porta parallela, quella che parla con l'aggeggio
		parallelo (il programmatore)? Eh, quella. È una Parallel IV.
	</p><p>
		Allora mettiamo anche noi i settings su Parallel IV. Risultato?
		Incompatibilità di cavo. Qualunque cosa essa significhi… ma almeno, se
		settiamo il tutto sulla III, torna a funzionare. Ma non a 5MHz, bensì a
		2KHz… tempi biblici per il trasferimento…
	</p>
</div><div class="section">
	<p>
		Ed una cosa fatta. Allora ci mettiamo a lavorare sul kernel linux che
		dovremo mettere sulla scheda programmata. E qui altri problemi: occorre
		non sono cross-compilare tutta la yadda, ma ci serve una descrizione
		delle specifiche hardware per la compilazione, un cosiddetto <span
		class="code">device-tree</span>, ossia una mappa di tutti i pin di
		comunicazione con relativi indirizzi, cosicché la CPU possa e sappia
		comunicare all'esterno.
	</p><p>
		Questo signore viene generato da un bel plugin per l'EDK. E non andiamo
		a procurarcelo sul sito ufficiale, lo <span
		class="code">git-clone</span>iamo (everything went better than expected)
		e ce lo tiriamo dentro. Dopo aver ricaricato il progetto (perché da solo
		non se ne accorge…) gli facciamo notare che l'applicativo per generare
		l'albero esiste, ci mettiamo qualche nome, qualche nota, e poi generiamo
		l'albero.
	</p><p>
		E invece no. Perché c'è un valore sballato, qualcosa fuori dai limiti. È
		un simpatico numerino, questo, che indica la cardinalità degli
		interrupt. Che non ci sono. Scopriamo soltanto allore che abbiamo
		disegnato e creato una scheda il cui processore non prende segnali
		d'interruzione, non sa neanche cosa sono… ed è quindi completamente
		inutili e fondamentalmente non può funzionare (almeno per i nostri
		scopi).
	</p>
</div><div class="section">
	<p>
		Consigliatici dal professore, torniamo ad esaminare ben bene la
		procedura di inizializzazione del progetto della piattaforma, e notiamo
		a questo punto quanto il default di questa bestia sia piuttosto inutile:
		non è sensibile alle interruzioni però si crede di poter utilizzare le
		schede PCI senza licenza! Chi ha progettato questo accrocchio?
	</p><p>
		E allora via, a ricostruire 'sti progetti, secondo vari tentativi, per
		costruire un core che serva a qualcosa e che faccia cose buone, magari
		anche in fretta.
	</p><p>
		E perdiamo sostanzialmente il pomeriggio a creare questa roba. Compilare
		la bitmap per ciascuno di questi aggeggi, quando funziona, prende venti
		minuti buoni.
	</p><p>
		A questo punto, trasferire l'immagine programmata a 2KHz non fa tanta
		differenza…
	</p>
</div><div class="section">
	<p>
		Ed ora, mettiamoci a cercare i sorgenti del kernel per MicroBlaze… sono
		un tantinello grossi, eh, qualcosa come 400MB di yadda.
	</p><p>
		Siamo quasi pronti per mettere questa roba a compilare.
	</p>
			</div>
		</div><div class="tab" id="tab-vii">
			<div class="section">
	<p>
		Quasi. Perché Jazz stava ancora <span class="code">git clone</span>ando
		quando io mi sono messo a rimettere il baraccone nella scatola. Stacco
		questo, stacco quello, metto via, arrotolo cavi…
	</p><p>
		Arriva il momento di staccare l'alimentazione del programmatore
		parallelo. Seguo il cavo con lo sguardo e con la mano, poi mi giro un
		attimo, faccio qualche altra cosa, e poi stacco il cavo.
	</p><p>
		In quella, Jazz esclama! Che succede? Quel cavo era il suo! Lui, che non
		tiene la batteria per questi casi, perde tutto. LOL.
	</p><p>
		Visto che ormai è tardi per rimettersi a scaricare il kernel, rinunciamo
		entrambi. Io allora riseguo il cavo, che spunta da dietro il mio
		monitor, e lo stacco.
	</p><p>
		In quella, Jazz esclama una seconda volta! Perché nemmeno adesso son
		riuscito a prendere il cavo giusto! Ho preso quello di IvanPrimeII, che
		pur avendo la batteria non regge più questi sforzi e muore. Poverino, ma
		almeno lui non stava facendo nulla d'importante.
	</p><p>
		E così fu che tutto venne spento con violenza e noi ce ne potemmo
		andare a festeggiare le lauree di Mitch &amp; Ranger.
	</p>
			</div>
		</div><div class="tab" id="tab-viii">
			<div class="section">
	<p>
		Arrivati stamattina, ci troviamo Jazz alle prese con il genio ed io con
		niente d'importante. Per prima cosa sono andato a restituire quella
		tastiera ch'avevamo preso in prestito due giorni fa…
	</p><p>
		Di ritorno dalla vana ricerca di Macii, che non era né in ufficio né in
		laboratorio, son tornato e mi sono messo a smanacciare il kernel.
	</p><p>
		Prendo quindi il repository git ufficiale, 1.6GB, tiro fuori la guida e
		vedo di far funzionare il baraccone.
	</p><p>
		Innanzitutto, occorrone altre due variabili d'ambiente: <span
		class="code">$CROSS_COMPILE=microblaze-unknown-linux-gnu</span> e
		un'altra aggiunta a <span class="code">$PATH</span>, per includere il
		toolkit per la crosscompilazione.
	</p>
</div><div class="section">
	<p>
		Scompatto 'sto toolkit in <span class="code">/tmp/</span> per far prima,
		poi lancio la prima di numerose esecuzioni… Incappo immediatamente in un
		errore 126 (permesso negato) per un eseguibile che invece i permessi ce
		li ha.
	</p><p>
		Questo aggeggio, un ELF32bit per Linux, non aveva la minima voglia di
		partire, perché evidentemente doveva fare un po' troppa strada: era sul
		disco esterno. Dopo aver copiato lui e tutta la sua baracca sul disco
		locale, le cose sono ripartite…
	</p>
</div><div class="section">
	<p>
		Per prima cosa, bisogna prendere il <span
		class="code">device-tree</span> dal nostro progetto e schiaffarlo molto
		molto a fondo nei meandri dei sorgenti del kernel, in modo che il
		compilatore possa andare a cercarselo e trovarlo.
	</p>
</div><div class="section">
	<p>
		Arriviamo quindi al punto in cui possiamo lancira la fatidica chiamata
	</p><div class="outside"><p>
			lyznardh@sleipnir&lt;$ make ARCH=microblaze menuconfig
	</p></div><p>
		e cominciare a configurare il kernel che andremo a compilare. E via!
	</p><p>
		Comincia a togliere cose inutili, tipo il supporto ai moduli, il
		supporto per X, il supporto per il cirillico, le regole del bridge e un
		sacco di altra roba…
	</p>
</div><div class="section">
	<p>
		Dopo aver aggiunto alcune cose comode, quali ad esempio il supporto per
		i LED e il nostro monitor LCD picciccinopicciò, mettiamo a compilare.
	</p><p>
		Avete presente l'opzione <span class="code">--jobs</span> di make? Serve
		a mettere le cose in parallelo, ma il parametro è opzionale: se manca,
		viene considerato illitato e quindi make può lanciare tutti i thread che
		gli pare… risultato: Chrome è crashato per primo, poi è morta anche la
		shell di make… poverini.
	</p><p>
		Rilanciandolo con thread limitati, cominciano a pioverci errori. Per
		ciascuno di questi, scopriamo una qualche dipendenza non soddisfatta che
		andiamo a togliere dalla configurazione. Cambio, e nuova compilata…
		nuovo errore, nuova rimozione, nuova configurazione più snella di prima,
		nuova compilata… togli il supporto VGA, togli il supporto alla
		Parallela, togli il supporto a SATA, e avanti così per tutto il
		pomeriggio.
	</p><p>
		Infine, alle sei, eccoci finalmente con un'immagine bootabile.
	</p>
			</div>
		</div><div class="tab" id="tab-ix">
			<div class="section">
	<p>
		E adesso dobbiamo schiaffare l'immagine del kernel sul processore.
		Sempre che il processore esista ancora: le lucine infatti assumono
		configurazioni completamente diverse all'accensione e dopo la creazione
		del MicroBlaze… forse è la batteria del BIOS.
	</p>
			</div>
		</div><div class="tab" id="tab-x">
			<div class="section">
	<p>
		E insomma… stamattina c'abbiam riprovato: butta su l'immagine del
		processore, mandagli l'immagine del kernel, aspetta mezz'ora… niente.
	</p><p>
		Anche tentando varie configurazioni del cavo parallelo, anche variando
		la velocità di trasmissione, anche questo&amp;quello, non ci sono eventi
		significativi successivo al comando del download.
	</p><p>
		Il vecchio IvanPrimeII spinna come un bastardo per tutto il tempo in cui
		lo lasciamo, e niente. Nel frattempo, grazie ad aiuti esterni, abbiamo
		attaccato una console seriale e controllato che funzioni. Questo su
		un'altra scheda, purtroppo.
	</p><p>
		Di fatto, ancora non abbia modo di sapere quale dei passaggi sia
		sbagliato. Se sia il kernel, o il suo trasferimento, o l'immagine del
		processore, o il disegno di quell'immagine… non lo sappiamo.
	</p><p>
		Alle 15:00 ce ne andiamo da Macii a discutere della cosa.
	</p>
			</div>
		</div><div class="tab" id="tab-xi">
			<div class="section">
	<p>
		E dopo due ore presso l'ufficio dell'illuminazione, siam di ritorno con
		un sacco di notizie interessanti.
	</p><p>
		Sapete quel problema con il trasferimento dei binari del kernel? Quei
		14MB di ELF32 che non riesce a passare dall'altra parte? Ecco. Potrebbe
		essere un semplice problema di dimensioni (come sempre, no?) visto che
		esiste la possibilità che il trasferimento venga effettuato né sulla
		Compact Flash, né sulla RAM della scheda, ma direttamente sul chip.
	</p><p>
		E questa sarebbe una validissima ragione per la quale non stiamo
		ricevendo alcuna risposta dal software, perché per ben che vada lo
		spazio che stiamo tentando di occupare sarebbe decine di volte quello
		disponibile.
	</p>
</div><div class="section">
	<p>
		Ma questo problema potrebbe essere facilmente risolto se avessi un
		kernel una decina di volte più compatto. Ed esiste, ovviamente, una cosa
		del genere. Non è DSLinux, come forse penserebbe il <span
		class="bolo">Bolo</span>… quello non è abbastanza piccolo. Si tratta di
		un misterioso uClinux io non avevo nemmeno sentito nominare… eppure,
		pare che sulle slide ci fosse… i miei fanno un po' cagare.
	</p><p>
		Comunque sia, questo aggeggiotto dovrebbe avere tutti i poteri che ci
		servono, dovrebbe stare tranquillamente entro i confini della memoria
		che abbiamo e viene tuttora svilippato e mantenuto.
	</p>
</div><div class="section">
	<p>
		Mentre discutiamo di tutta questa roba, spiegando a Macii come tutto
		quello che noi credevano di dover fare si stia inchiodando, lui si mette
		a ravanere dentro un armadio dal quale, alla fine, escono una pila di
		tesi alta così, un paio di manuali in russo e un raccoglitore ad anelli
		in spagnolo…
	</p><p>
		Pare infatti che tutto quello ch'è stato fatto in ambienti simili, in
		corsi passati, da dottorandi che non ci sono più, da professori che ora
		siano altrove, sia diventato irreperibile oppure nascosto in questo
		particolare armadio.
	</p><p>
		Alla fine, ce ne andiamo con un pacco di qualche decina di mega di slide
		dal contenuto non ancora specificato…
	</p>
</div><div class="section">
	<p>
		Ma dimenticavo la peggiore delle cose: abbiamo avuto un unica conferma
		fuori da ogni dubbio. La configurazione del processore, come quella del
		sistema che ci gira sopra è completamente volatile: non è affatto
		previsto che alcuna parte del [soft|hard]ware che mettiamo sulla scheda
		sopravviva al taglio dell'alimentazione.
	</p><p>
		Esiste, casomai, una sordida procedura di bootup da memoria flash, da
		utilizzare esclusivamente quando l'intera baracca è pronta per la
		produzione.
	</p>
			</div>
		</div><div class="tab" id="tab-xii">
			<div class="section">
	<p>
		Comincia una nuova settimana, e subito mi metto al lavoro tentando, come
		prima cosa, di mettere il processore sulla scheda. Ricordate che tutto
		viene fatto <span class="em">on the fly</span>, giusto?
	</p><p>
		Appiccio il vecchio IvanPrimeII, faccio partire XPS e aspetto… quello
		impiega un paio di minuti ad uscire dal suo sonno mortale, come Dracula,
		e soltanto poi mi chiede se voglio ricominciare con un progetto nuovo
		oppure con uno recente.
	</p><p>
		Poi, un pop-up, è Windows che mi dice gentilmente «Ciao, guarda, mi sa
		proprio che bisognerà riavviarmi. Lo faccio anche da solo, tra un quarto
		d'ora… 15:00… 14:59… 14:58… oppure subito… 14:56…»
	</p><p>
		Per evitare altri problemi, spengo XPS e riavvio immediatamente. Poi
		aspetto che il quasi-zombie portatile si riprenda. Non appena torna, mi
		dice «To', degli aggiornamenti… 1 di 16… 2 di 16… 3 di 16 e avanti… tu
		vai pure a prendere un caffettino, io tanto mi riavvio da solo… Ciao»
	</p><p>
		Gli do ascolto e lo lascio fare.
	</p>
</div><div class="section">
	<p>
		Di ritorno, pare che stia bene. Apro il quarto progetto, quello
		costruito per avere (un sicuro) accesso alla RAM, che forse prima non
		veniva presa in considerazione. Ma Jazz mi ricorda che in quell'immagine
		non è prevista la connessione Ethernet, visto che noi non ce la possiamo
		permettere (è su una licenza che non abbiamo, ovviamente).
	</p><p>
		Incredulo (come fra l'altro è anche il Macii) vado a controllare e
		scopro che tutte le opzioni sono bloccate tranne un certo controllore
		MII-to-RMII. Chissà che'll'è?
	</p><p>
		Scopro essere effettivamente un aggeggiotto di rete che può andare anche
		a 100Mbps. Perché non mettercelo?
	</p><p>
		Beh, perché ovviamente bisogna rigenerare l'immagine, ricompilare il
		bitstream… significa perdere più o meno un'ora, durante la quale la
		macchinetta a vapore dovrebbe lavorare a pieno regime.
	</p>
</div><div class="section">
	<p>
		Perché non mettere il mio portatile a fare questo lavoro, invece? Perché
		non ho il service pack.
	</p><p>
		Ma posso procurarmelo, giusto? Infatti, mi sono iscritto sul sito della
		Xilinx ed ho un account. Chiediamogli degli aggiornamenti, visto che il
		webupdate non ne vuol sapere.
	</p><p>
		Eccone tre: uno per i driver e i componenti, uno per ISE e uno per EDK.
		Rispettivamente 121MB, 468MB e 429MB… metti a scaricare il primo.
	</p><div class="outside"><p>
			«Salve, sono il download manager della Xilinx. Sai, le
			regolamentazioni statunitensi per l'esportazioni ci impongono di
			chiederle l'indirizzo completo, prima di permetterle di scaricare
			questi pacchetti software»
	</p></div><p>
		Devo riempire un form, che prevede tra le altre cose un indirizzo, un
		numero di telefono, nome dell'organizzazione e sopratutto il
		dipartimento di appartenenza. Ed io mento spudoratamente.
	</p><p>
		Ottengo uno alla volta questi tre aggiornamenti, li scompatto e li
		lancio. Tutti, uno alla volta, fallisco e lo fanno in modi sempre
		diversi. Mi chiedono di essere installati nelle cartelle sbagliate, mi
		dicono che non trovano la connessione ad internet, mi dicono che non ho
		spazio disco sufficiente, mi dicono che gli archivi sono corrotti…
	</p><p>
		Attraverso varie combinazioni di ambiente, cartella corrente e numerose
		riscritture di path di destinazione, faccio funzionare tutti e tre.
	</p>
</div><div class="section">
	<p>
		E non vi ho ancora detto che Ranger c'ha prestato il suo lettore di
		schede. Poi vi racconto…
	</p>
			</div>
		</div><div class="tab" id="tab-xiii">
			<div class="section">
	<p>
		E mentre questa s'avvia ad essere la storia più lunga di sempre, ecco
		degli aggiornamenti prima di pranzo.
	</p>
</div><div class="section">
	<p>
		Dunque, nessun passo in avanti.
	</p><ul><li>
			<p>Avete prensente la flashcard? Bene, non sappiamo cosa farci:
			abbiamo scoperto che sopra ci sono sei (6 dico 6) sistemi diversi
			preconfezionati, fatti da chissà chi…</p>
			<p>E funzionano.</p>
		</li><li>
			<p>Potremmo forse metterci sopra il nostro sistema,
			chipset&amp;kernel assieme, ma ci vuole un file ACE per farlo. E
			come si producono? Basta passare il .bit e il .elf ad una bella
			utility, <span class="code">xmd -tcl genace.tcl</span>, la quale
			ovviamente fallisce.</p>
		</li><li>
			<p>Anche potessimo usare l'immagine pronta, non sappiamo cosa c'è
			sopra, non sappiamo com'è fatta e non siamo sicuri di poterci
			compilare un kernel</p>
		</li><li>
			<p>uClinux ce l'abbiamo. Ma non possiamo compilarlo senza conoscere
			l'architettura. E quel tizio ch'ha fatto il porting per MicroBlaze
			era un professore australiano che adesso s'è commercializzato e
			vende piattaforme di sviluppo</p>
		</li><li>
			<p>tutta la storia della porta ethernet è un pigna nel sedere: tutti
			i controllori necessitano una licenza che non abbiamo. Tutti tranne
			il MII-2-RMII, che chissà se può funzionare.</p>
	</li></ul><p>
		Siamo un po' abbattuti, io e Jazz. Dobbiamo sentire Macii per vedere che
		si può fare…
	</p>
			</div>
		</div><div class="tab" id="tab-xiv">
			<div class="section">
	<p>
		Quando gli abbiamo spiegato la yadda, ha risposto con un «M'aspettavo
		che andasse così…» e intendeva dire che il progetto esplorativo prevede
		ovviamente dell'esplorazione.
	</p><p>
		Non così tanta, probabilmente.
	</p><p>
		Gli abbiamo spiegato che ci occorre una licenza per utilizzare la <span
		style="text-decoration:line-through">scheda di rete</span> controllore
		Ethernet, che non sappiamo come procurarcela e nemmeno un idea degli
		eventuali costi. Tuttavia, venendo a sapere che il PowerPC dell'immagine
		già pronta su FlashCard s'è illuminato.
	</p><p>
		Per quanto vero che noi non siamo in grado di dumpare una bitmap con un
		processore dotato di porta Ethernet, possiamo sempre usare una bitmap
		già pronta. E quindi potremmo semplicemente basarci su quel che
		troviamo.
	</p>
</div><div class="section">
	<p>
		E insomma. A quanto pare, Macii non era affatto fissato sul MicroBlaze
		come credevo che fosse: lui credeva semplicemente che quello sarebbe
		stato più facile da creare, per noi idioti dell'elettronica. Ma siccome
		i problemi sono altri, e sono spaventosi, possiamo tranquillamente
		lasciar stare.
	</p><p>
		Quindi, via, alla ricerca di una bitmap adatta, da schiaffare dentro un
		file ACE dal quale fare il boot. Ma forse ci basterà semplicemente
		smanacciare un attimino sull'installazione MonteVista che abbiamo
		scoperto di avere, che a quanto pare si porta già dietro, di suo,
		persino apache.
	</p>
</div><div class="section">
	<p>
		Ma probabilmente andremo più a fondo: ci procureremo il device-tree di
		questa misteriosa architettura e compileremo un kernel e poi
		installeremo una Gentoo della morte…
	</p><p>
		BRB compiling…
	</p>
			</div>	
		</div><div class="tab" id="tab-xv">
			<div class="section">
	<p>
		Oggi sono salito presto. Ho preparato l'argagno, mi sono fregato un cavo
		di rete da Simgi e mi sono messo a controllare il funzionamento di
		Apache.
	</p><P>
		Parte ma non fa niente. Forse muore subito, in silenzio. Di sicuro non
		ha un processo attivo. Allora verifico e scopro che <span
		class="code">/etc/init.d/apache</span> chiama direttamente <span
		class="code">/usr/sbin/httpd</span>. Lancio quel comando, faccio dei
		tentativi… l'errore è sempre lo stesso: <span class="code">Bad user
		nobody</span>.
	</p><p>
		<span class="code">Grep</span>po nella configurazione e scopro che
		<span class="code">httpd.conf</span> lo dichiara esplicitamente. Un
		commento, proprio sopra, afferma che non tutti i kernel potrebbero
		apprezzare la cosa.
	</p><p>
		Allora, visto che questo sistema non ha utenti, sostituisco quella riga
		con un'altra, in cui scrivo “root” e basta.
	</p><p>
		E mentre tento di par partire Apache, becco questo. BEST ERROR
		EVAR.
	</p><pre> Error:
 Apache has not been designed to serve pages while
 running as root.  There are known race conditions that
 will allow any local user to read any file on the system.
 If you still desire to serve pages as root then
 add -DBIG_SECURITY_HOLE to the CFLAGS env variable
 and then rebuild the server.
 It is strongly suggested that you instead modify the User
 directive in your httpd.conf file to list a non-root
 user.</pre><p>
		Non che intenda farlo, ovviamente. Ma pensa un po' gli sviluppatori che
		han messo una MACRO apposita.
	</p>
			</div>
		</div><div class="tab" id="tab-xvi">
			<div class="section">
	<p>
		Jazz è effettivamente andato a comprare un'altra CompactFlash. Questa è
		da 4GB. Io me la piglio, attacco l'adattatore e comincio a smadonnare.
	</p><p>
		Creo le partizioni, formatto, faccio le copie integrali dell'altra
		memoria, dumpo il contenuto, infilo, faccio partire. Lucette rosse.
	</p><p>
		Cerca cerca…
	</p>
</div><div class="section">
	<p>
		I file sono corretti, il filesystem è leggibile, tutto funziona. Ma il
		controllare ACE non lo accetta. Verifica la documentazione. Prova cose.
		Magari la partizione VFAT dev'essere eseguibile; provo, non cambia
		nulla.
	</p><p>
		Magari la partizione è troppo grande; provo, non cambia niente. Magari è
		colpa dell'etichetta, prova a togliere, a mettere, non cambia niente.
	</p><p>
		Alla fine individuo i confini del problema: questo sistema accetta
		esclusivamente FAT12 e FAT16, ed entrambi soltanto se tutti i cluster
		sono direttamente indicizzabili. Quindi bisogna formattare la partizione
		in modo che i cluster abbiano la dimensione corretta.
	</p><p>
		Verifica dunque la documentazione di <span class="code">mkfs.vfat</span>
		per vedere che si può fare. Prova a settare queste dimensioni, molte
		delle quali non hanno unità di misura, oppure ne hanno di improbabili,
		come settori-per-cluster e byte-per-cilindro. Procedo a tentativi,
		perché nessuna guida mi offre una tabella decente… mi pare di avere
		provato ogni combinazione disponibile.
	</p><p>
		Ma niente. Questo controller non accetta nessuno dei formati che posso
		adottare. Dopo un pomeriggio intero speso su questa cosa, Jazz si
		procura un eseguibile della morte per XP, lo schiaffa sul mio vecchio
		portatile, calca UN bottone et voilà, tutto funziona.
	</p><p>
		Ho tentato tre volte di clonare quella configurazione. È impossibile…
		non è possibile, sotto Linux, indicare correttamente quanti settori
		devono essere riservati (l'opzione -R, fatta apposta, viene ignorata),
		ed è altrettanto impossibile indicare il settore d'allocazione della
		prima FAT. Semplicemente, non si può. E siccome quella viene piazzata
		all'ottavo blocco anziché al primo, l'FPGA non funziona.
	</p><p>
		Fanculo.
	</p>
			</div>
		</div><div class="tab" id="tab-xvii">
			<div class="section">
	<p>
		Oggi ci siamo messi a cercare. A cercare un modo per compilare un kernel
		per questa roba. Visto che abbiamo il permesso di usare questo PPC405,
		vorremmo procurarci un kernel da farci girare.
	</p><p>
		Ma il device-tree di questo aggeggio ci è sconoscito, le reali
		specifiche del processore sono sconosciute, se il kernel possa compilare
		o meno appoggiandosi su &gt;9000 filetti e fileozzi ci è sconosciuto.
	</p>
</div><div class="section">
	<p>
		Stiamo quindi cercando di procurarci un crosscompilatore per questa
		roba, ma pesa un fantabyte e deve ancora arrivare…
	</p><p>
		Se nemmeno questa via dovesse funzionare, siamo disposti a calar le
		braghe e tentare l'approccio con questo antico MontaVista…
	</p>
			</div>
		</div><div class="tab" id="tab-xviii">
			<div class="section">
	<p>
		Tutto il giorno. Tutto il fottuto giorno a tentare di crosscompilare un
		fottuto kernel per PowerPC405.
	</p><p>
		Non sa da fare. <span class="code">IMPOSSIBRU.dts.so.h.bsb.xps</span>
	</p>
			</div>
		</div><div class="tab" id="tab-xix">
			<div class="section">
	<p>
		Non funziona niente.
	</p><p>
		Tre kernel diversi, decine e decine di tentativi di compilazioni, varie
		combinazioni di configurazioni, header, patch… niente.
	</p><p>
		Allora abbiamo tentato di crosscompilare con una toolchain, fatta
		apposta per questo kernel (2.4.20) e per questa glibc (3.2.3), per
		cazzarci sopra dropbear (che sarebbe un serveruccio SSH piccino piccino)
		e busybox (con &gt;9000 applicazioni).
	</p><p>
		Tutti i comandi stupidi funzionano. Ma <span
		class="code">dropbear</span> e <span class="code">[[b]a]sh</span> invece
		no: danno “illegal instruction” come fossero stati compilati per
		l'architettura sbagliata.
	</p>
</div><div class="section">
	<p>
		Ma è inutile.
	</p><p>
		Abbiamo anche caricato un rootfs apposta, che non riesce a partire e non
		funziona nemmeno se montato e <span class="code">chroot</span>ato.
	</p>
			</div>
		</div><div class="tab" id="tab-xx">
			<div class="section">
	<p>
		Abbiamo scavallato. Sento di poterlo dire.
	</p>
</div><div class="section">
	<p>
		Il semplice fatto che questa storia abbia passato le righe, e
		attualmente, 6000 parole, è indice della quantità di sforzi messi
		insieme da Jazz e me.
	</p>
</div><div class="section">
	<p>
		Non c'è modo di mettere un kernel su questa piattaforma. Non con i mezzi
		che abbiamo a disposizione. È impossibile.
	</p><p>
		Ci siamo dovuti arrendere all'evidenza: occorrono, per riuscire a
		compilare il kernel, conoscenze sull'hardware che noi non abbiamo, che
		nessuno ha, che il kernel attualmente montato non è in grado di fornire.
		Questo fottuto DTS non è riproducibile.
	</p><p>
		Ma esisteva ancora una via. Una via ardua, una via disperata, una via
		che – sinceramente – non credevo di poter percorrere. Non potendo avere
		un kernel tutto nostro, avremmo compilato per quel kernel lì.
	</p>
</div><div class="section">
	<p>
		Ci procuriamo, per prima cosa, <span class="em">dropbear</span>, per
		comunicare via rete e non più via seriale. Compiliamo questo stronzo,
		che per fortuna è ben configurabile per funzionare come busybox, un solo
		eseguibile e tanti linkini per fare tante cose carine.
	</p><p>
		Lo schiaffiamo sulla piattaforma, verifichiamo a manina che tutto sia
		nel posto giusto. Lanciamo e <span class="forte">BLAM!</span>,
		ottieniamo un magnifico
	</p><div class="outside"><p>
			<span class="code">rooo@ml310 $&gt; dropbear</span>
		</p><p>
			<span class="code">Illegal Operation</span>
	</p></div><p>
		Significa che il binario, seppur dichiaratamente compatibile, non può
		funzionare. Pigne nel culo.
	</p><p>
		E allora via, sull'ultima strada possibile.
	</p>
</div><div class="section">
	<p>
		Abbiam fatto conoscenza con un mostro, un certo <a
		href="www.kegel.com">Kegel</a>. Questo tizio ha fatto di tutto,
		programma dall'alba dei tempi e fra le altre cose ha realizzato un
		potente strumento, crosstool.
	</p><p>
		Ce lo siamo procurato. Lo scopo di questo terribile mostro è creare un
		ambiente di crosscompilazione. Perché il compilatore è potente, ma
		dipende dalla glibc, la quale deve essere compilata… la famosa
		dipendenza circolare.
	</p><p>
		&#160;
	</p><p>
		Ascoltate <a
		href="http://www.youtube.com/results?search_query=two+steps+from+hell+heart+of+courage">questa</a>, adesso.
	</p>
</div><div class="section">
	<p>
		Mille anni di configurazione, di ricerca. Verifichiamo versioni del
		kernel, della glibc e del compilatore. Cerchiamo la massima
		compatibilità del compilatore.
	</p><p>
		Scegli adeguatamente kernel 2.4.20, glibc 2.3.2, gcc-3.4.4, configura
		adeguatamente le variabili d'ambiente, aspetta la mezzanotte di luna
		piena, sacrifica adeguatamente polli, agnelli e capretti sull'altare
		costruito adeguatamente, lancia la compilazione.
	</p><p>
		Svariati tentativi di configurazione e settaggi diversi dopo,
		finalmente, riesco a ritrovarmi con questo, un crosscompilatore da
		PowerPC405 per x86, con tutto il suo ambiente e le sue librerie.
	</p><p>
		Con quello, siamo riusciti a compilare un dropbear che potesse
		funzionare. Ma non solo.
	</p>
</div><div class="section">
	<p>
		Sta ancora andando, la canzone? Forse, ora, potete sostituirla con
		<a
		href="http://www.youtube.com/results?search_query=jojo+oraoraoraoraora">questa</a>
		o forse <a
		href="http://www.youtube.com/results?search_query=dio+brando+mudamudamudamuda">quest'altra</a>.
	</p><p>
		&#160;
	</p><p>
		Mentre io compilo Apache2, Jazz cerca soluzioni alternative. E qui,
		permettetemi una parentesi. <span class="forte">Ho compilato il fottuto
		Apache httpd per PPC405 generic. Voi non l'avete fatto. Io si. L'ho
		fatto a mano, hackando vari livelli di Makefile, configure, modificando
		header e altre peggio porcherie</span>.
	</p><p>
		Al primo tentativo, avevamo dovuto configurare dropbear senza librerie,
		non avendocele. Ma ora… nell'ordine, abbiamo scaricato e costruito
	</p><ul><li><p>
			<span class="code">libpcre</span>, supporto per le PERL regex
		</p></li><li><p>
			<span class="code">zlib</span>, per la compressione al volo
		</p></li><li><p>
			<span class="code">openssl</span>, per le socket sicure
		</p></li><li><p>
			<span class="code">openssh</span>, la shell da rete
		</p></li><li><p>
			<span class="code">sqlite</span>, per i database
		</p></li><li><p>
			<span class="code">lighttpd</span>, per non usare Apache2 ch'è 'na
			bbestia. No, niente typo, è intenzionale.
	</p></li></ul><p>
		Infine, ricompila tutto dropbear per utilizzare tutte le librerie.
		Supporto per compilare e linkare librerie condivise attraverso due
		sistemi, ssh funzionante, apprendimento della via del <span
		class="code">./configure</span>, delle sue opzioni e dell'ambiente
		necessario al funzionamento del linker.
	</p><p>
		Al termine della giornata, sono stato in gradi di installare <span
		class="code">lighttpd</span> con questo comando:
	</p><div class="outside"><p>
			<span class="code">sshfs root@192.168.1.1:/
			/media/remote</span>
		</p><p>
			<span class="code">make DESTDIR=/media/remote install</span>
	</p></div><p>
		Installazione di un binario crosscompilato in ambiente simulato
		su un file system remoto. UNF.
	</p>
</div><div class="section">
	<p>
		È così che si sente Sauron con l'anello al dito.
	</p><p>
		È così che si sente Artù impugnando Excalibur.
	</p><p>
		È così che si sente Link alzando al cielo la Triforza.
	</p><p>
		È così che si sente Hotrod aprendo la Matrice.
	</p>
			</div>
		</div><div class="tab" id="tab-xxi">
			<div class="section">
	<p>
		E questo è l'ultimo tab. Perché la storia è lunga, il progetto è fatto
		ed ho già barato un po' (si veda
		<?=$d->link('Storie/2011/LV/','questo','II')?> pezzo fuori posto).
	</p><p>
		E insomma… ho compilato tutte le librerie del mondo, c'ho messo sopra un
		server SSH, un server HTTP, cosa fare di più?
	</p><p>
		Beh, alcune altre cose fighe possibili c'erano…
	</p>
</div><div class="section">
	<p>
		Per prima cosa, c'immergemmo, io e Jazz, nelle oscure profondità di
		<span class="code">/etc/init.d/</span>, trovandovi un sacco di cosucce
		interessanti.
	</p><p>
		Salterebbe allora fuori il <span class="bolo">Bolo</span> (ch'è
		effettivamente comparso, l'altro giorno…) a dirmi
	</p><div class="outside"><p>
			«<span class="bolo">Perché non usare <span
			class="code">update-rc.d</span>?</span>»
	</p></div><p>
		che noi non abbiamo perché non è Debian… comunque. Prendi dunque ago e
		filo e tessi un bello scriptino che faccia partire <span
		class="em">lighttpd</span>. Fatto, neanche tanto difficile.
	</p>
</div><div class="section">
	<p>
		Poi, avendo noi un bus IDE sulla scheda e un disco IDE a portata, mi
		sono messo a compilare un pacchetto chiamato <span
		class="code">e2fsprogs</span>, che contiene fra le altre cose <span
		class="code">mkfs.ext[23]</span> (perché il disco era attaccato, ma era
		NTFS…). Con questo mostro installato sull'FPGA, ecco che ho potuto
		riformattare questo disco, montarlo e utilizzarlo come base per
		lighttpd. Un disco da 25GB che può tenere numerosi contenuti
		downloadabili dal sito, quando/se esisterà.
	</p><p>
		Ma poi, il problema. Montare quel disco prima del login, e prima che
		lighttpd fosse lanciato, magari. Ora, sapete che sono gli LSB tag? Sono
		dei simpatici attributi utilizzati per calcolare e risolvere le
		dipendenze degli script di init. Senza di essi, bisogna stabilire le
		priorità a manina. La mia manina, in questo caso.
	</p><p>
		E qualcosa come 30 reboot dopo, ecco che tutto funziona. E questo
		concluse la giornata di mercoledì 03/08.
	</p>
</div><div class="section">
	<p>
		Poi, esaurite energie fisiche e psichiche, mi sono rilassato. Jazz ha
		cominciato a studiare per l'orale (visto che lui fugge per la Danimarca,
		deve beccare Macii prima che se ne vada in ferie, il troll…) ed io mi
		sono messo a fare un po' di fuffa… ad esempio, vi ricordate che lo
		Sgaggio avrebbe voluto il gcc montato sulla piattaforma della morte?
	</p><p>
		C'ho riprovato. C'ho provato durissimo, fino a giovedì sera… in breve:
		non esiste. Ma se volete la versione lunga, allora…
	</p><p>
		<span class="code">gcc-3.4.4</span> dipende da <span
		class="em">binutils, libiberty, bison</span> e molto altro, e queste
		cose le trova ma forse no. Poi bisogna indicargli che sto
		crosscompilando un compilatore, quindi devo settare le tre architetture,
		quella che effettua la compilazione, quella su cui il compilato andrà a
		girare e quella per la quale il compilatore compilerà. Chiaro?
	</p><p>
		Poi bisogna convincere il <span class="code">./configure</span> che non
		deve testare il compilato sulla piattaforma presente, poi bisogna
		indicargli dove trovare le librerie, poi bisogna indicargli gli header,
		bisogna indicare anche varie altre cose (ad esempio, quale assemblatore
		e quale linker usare, perché lui è stronzo e non se li cerca da solo,
		neanche se glieli metto sotto gli occhi) e infine compilare.
	</p><p>
		Ma succedono varie cose: non tutti i Makefile (ce ne sono una decina)
		sono ben parametrizzati, alcuni tengono dei simpatici parametri statici,
		come ad esempio dei linkilli a <span class="code">cc1</span>. Cos'è?
		Boh, so soltanto che si sistema soltanto quando infili a forza il
		compilatore giusto in tutti file che non ci pensano… Poi capita anche
		che i parametri di archittettura (l'opzione <span
		class="code">-m</span>, che accetta soltanto piccole varianti del
		target del compilatore) non vengano passati in giro, bensì presunti.
	</p><p>
		Sistema (a mano) anche questo problema. Ripristina, pulisci, compila,
		segna da qualche parte com'era la configurazione, fai cose, riprova…
		alla fine, quando riesco a far ingranare tutti i pezzi dalla cosa, a far
		quadrare tutti i parametri senza madonnare troppo, ecco che <span
		class="code">bison</span> si perde dei parametri e smette di funzionare.
		Prima un certo file chiamato <span class="code">crti.o</span>, poi
		specifiche di compilazione (il file <span
		class="code">gcc-3.4.4/gcc/specs</span>, automaticamente generato dal
		compilatore, ma sbagliato) e infine dipendenze di qualche file
		impossibile, tipo <span class="code">c-parse.y</span>…
	</p><p>
		Alle 18:45 di ieri mi sono arreso definitivamente.
	</p>
</div><div class="section">
	<p>
		E questo è quanto. Questa storia, ora ch'è finita, misura 7485 parole.
	</p>
			</div>
		</div>
	</div>
</div>
<?php } ?>
