<?php
	$title=array('Quel che dovrei fare','Ma non faccio. No. Non lo faccio.');
	$prev=array('Storia XLIX','Storie/2011/XLIX/');
	$next=array('LI – Il druido', 'Storie/2011/LI/');
	function mkpage($d){
?>
<div class="small">
	<div class="section">
		<p>
			Uhm.
		</p><p>
			Ci sono cose che tutti facciamo. Meravigliosamente inutili attività
			civili, che ci distinguono dagli animali. Chessò, canticchiare sotto
			la doccia, fare «doo-da-doo» durante la pipì, leggere il cartellino
			dell'ascensore mentre s'aspetta… ecco, tutte cose senza alcuna
			rilevanza.
		</p><p>
			Poi ci sono quelli come me. Quelli come riempiono gli spazi morti
			scrivendo. Perché non sempre si scrive direttamente, a volte si
			scrive prima e poi, non appena si hanno i mezzi a portata, le parole
			vengono semplicemente versate su un supporto più affidabile della
			memoria.
		</p><p>
			Lo faccio per i capitoli di Tru Naluten, che ho scritti tutti da
			tempo (nella mia mente, <span class="em">perché sono un incapace, e
			non so fare un cazzo</span>, se (<a title="Wow! Parentesi annidate!"
			href="http://www.youtube.com/results?search_query=elio+e+le+storie+tese+la+saga+di+addolorato">non</a>)
			mi capite…), lo faccio per queste storie, lo faccio con il codice, e
			lo faccio anche per le cose che non so dire.
		</p><p>
			Perché alcune cose mi vengono naturali, altre invece no. E quando ho
			tempo mi esercito in quelle che non mi riescono. Saziarmi, ad
			esempio.
		</p>
	</div>
</div><div class="section">
	<p>
		E insomma… stamattina, come tristemente faccio nelle ultime mattine,
		tento di inventarmi una conversazione.
	</p><p>
		Perché dovrò aver qualcosa da dire alla gelataia, quando capiterà
		l'occasione. Non voglio mica fare scene muta. E non voglio nemmeno
		sbrodolare lì qualche parola a caso.
	</p><p>
		Quindi me ne sono salito anche stamattina
	</p><div class="inside"><p>
			un po' tardi rispetto al solito, in effetti, perché ieri sera ho
			fatto tardi per brutti brutti brutti motivi che ancora mi fanno
			bruciore allo stomaco… macchissenefrega.
	</p></div><p>
		pensando a come esordire, a cosa dire, se gettare un sasso con un
		messagio avvolto attorno, se scoprire dove vive e mandarle una lettera
		di sfida, se dar fuoco al suo palazzo per poi salvarla e far la figura
		del principe azzurro… nel mezzo di tutti questi ragionamenti, però, me
		ne sono arrivato in facoltà, ho acceso il portatile ed ho
		disgraziatamente scoperto che 'sta cazzo di Debian installata un paio
		d'anni fa non ne vuol sapere di far convivere le sue cose, il server X e
		la mia scheda NVIDIA.
	</p>
</div><div class="small">
	<div class="section">
		<p id="II">
			Evvaffanculo!
		</p><p>
			Due anni passati con questo peso sul groppone. Ogni fottuto
			aggiornamento di X si trascina dietro una sbrodolata, mi fa perdere
			una mattina intera e mi scende le palle verso il nucleo metallico (e
			magnetico!) della Terra.
		</p>
	</div><div class="section">
		<p>
			Ai tempi, quando questo povero portatile era giovane (non come il
			<span class="dacav">Dacav</span>) vivevo felice senza scheda
			grafica.
		</p><p>
			Funzionava, eh, per quello. Ma un giorno mi venne voglia di
			giochicchiare a <span class="em">StarCraft</span>. Una voglia di
			quelle a cui non avevo voglia di oppormi.
		</p><p>
			Decisi che avrei quindi convinto questa installazione a sfruttare un
			po' meglio il suo bell'hardware e a permettermi di giocare con un
			framerate accettabile.
		</p><p>
			Fu così che scoprii l'esistenza della <span
			class="code">libGLX</span>, divenuta da allora la mia nemesi. Questa
			simpatica signora è responsabile delle operazioni sgagge da scheda
			grafica, ossia tutti quei mazzi di operazioni matriciali per le
			quali la mia <span class="code">NVIDIA GeForce 9300M</span> è stata
			pensata, fatta e pagata.
		</p><p>
			Come fare? Beh, sul bel sito ufficiale (dico bello per dire…)
			l'azienda produttrice mi mette a disposizione un po' di cosucce
			interessanti. Ma le guide mi consigliavano (almeno ai tempi) di
			tenermi lontano da quelle cose peccaminose e di utilizzare quei bei
			e casti pacchetti legacy per il kernel.
		</p>
	</div><div class="section">
		<p>
			Per un po' funzionò: c'era un comodissimo pacchetto legacy per la
			mia generazione di schede, bastò installare quello per vivere
			felici e giocare a StarCraft per tutte e tre le campagne.
		</p><p>
			Poi dovetti aggiornare il kernel, perché era passato del tempo. E
			con il kernel, un sacco di avanzamenti di numeri di versione, un po'
			di qua, un po' di là, tante cose carine, un aggioramento di Xorg e
			improvvisamente tutto smette di funzionare.
		</p><div class="outside"><p>
				Salve, Gods, sono il Kernel 2.6.28; sai che questo fantomatico
				modulo nvidia.ko non mi piace nemmeno un pochettino? Buttalo via
				e dammene uno più bello…
		</p></div><p>
			E così feci… presi la mia picozza, scesi nei meandri di <span
			class="code">/etc/X/xorg.conf</span>, nelle liste di moduli di <span
			class="code">dpkg</span>, masturbai <span
			class="code">apt-get</span> fino allo spasmo… alla fine scoprii che
			quel fottuto pacchetto <span
			class="code">nvidia-kernel-legacy-93XX</span> era ancora lì. E
			faceva dei gran casini.
		</p>
	</div><div class="section">
		<p>
			Arato il bastardo, fu sufficiente installare un nuovo driver, questa
			volta preso direttamente dai server ufficiali. Un vero driver, con
			un vero autentico affidabile (?) installer. Che metteva tutto a
			posto.
		</p><p>
			Ma ad ogni tentativo di riavvio, le mie librerie sparivano. Venivano
			fagocitate… e allora io ce le rimettevo.
		</p><p>
			Dopo qualche tempo la misura fu colma, e dovetti tentare di
			automatizzare la procedura per evitare di ottenere la follia. Feci
			un po' di ricerca, andai ad analizzare i log di sistema.
		</p><p>
			Fu così che trovai il vero colpevole: c'erano infatti un paio di
			simpatiche righe di configurazione che andavano a testare
			l'esistenza di certune librerie (le mie, quelle vitali per far
			girare X con la mia scheda abilitata) e in caso positivo le
			toglieva. LOL.
		</p><p>
			E indovinate un po', il bastardo era <span
			class="code">nvidia-kernel-legacy-93xx</span>, in qualche modo
			redivivo. Grattatolo via una seconda volta, tolsi anche quelle
			stradannate righe dagli script di <span class="code">init</span>,
			ne misi un paio delle mie che facessero il contrario. Purtroppo, in
			caso di mancata presenza (con annesso rimpiazzo) delle librerie, era
			ovviamente necessario far girare <span class="code">depmod</span>,
			che scoprisse cosa esisteva e cosa no.
		</p><p>
			Non volendo mettere lo script troppo in alto nella lista ordinata
			delle chiamate che riportano in vita il sistema all'accensione,
			questa chiamata doveva necessariamente essere effettuata una volta
			in più: una volta di suo, una volta per le mie due librerie
			fantasma.
		</p><p>
			Risultato: i tempi d'avvio di questa carretta raddoppiarono.
		</p>
	</div><div class="section">
		<p>
			Ma ai tempi la vita era ancora avventurosa e piena di soddisfazioni
			(mah, forse…) e potevo aspettare. Finché il dannato Xorg non
			s'aggiornò ancora, finché il dannato modulo legacy (era davvero
			ostinato, non spariva nemmeno con <span>apt-get remove
			--purge</span>, o comunque tornava…) e tutto tornò a puttane.
		</p><p>
			Si fece allora un altro bel grattone. Via gli script, via le
			puttanate, via depmod, via tutto, largo alla nuova terribile
			calciaculante versione dei driver.
		</p><p>
			Questa installazione richiese un minuto soltanto e durò quasi sei
			mesi. Quasi un miracolo. E infatti passò…
		</p>
	</div><div class="section">
		<p>
			Ad un certo punto, anche il gcc venne aggiornato. Passò dalla 4.3
			alla 4.4, niente di incredibile. Ma il driver invece era rimasto lì.
			E anche il kernel.
		</p><p>
			Al successivo patatrac, il kernel disse che non avrebbe nemmeno
			preso in considerazione un modulo compilato con il gcc del futuro.
			Io allora tornai temporaneamente (<span class="code">export CC =
			/usr/bin/gcc-4.3</span>) al vecchio, sperando bastasse.
		</p><p>
			La prima volta sì, la seconda pure, poi… 
		</p><p>
			Poi semplicemente il kernel smise di darmi ascolto, e non ci furono
			né porchi, né santi né dei né madonne.
		</p><p>
			Dovevo trovare un'altra via.
		</p>
	</div><div class="section">
		<p>
			Grazie ad un po' d'assistenza, ad una frequenza di battuta di tasti
			sull'orlo del record e ad un'ennesima mattinata buttata, ebbi modo
			di vedere che installando qualcosa come &gt;9000 pacchetti e
			pacchettini, <span class="code">nvidia-glx, libGL1-nvidia-support,
			glx-nvidia-alternatives, nvidia-dkms,
			nvidia-please-pretty-please-do-as-I-say,
			nvidia-vdpau-should-work-it-has-been-done-just-for-that</span>
			sono riuscito ad ottenere qualcosa di più stabile.
		</p><p>
			Con “stabile” intendo dire sufficiente a resistere a tre
			aggiornamenti consecutivi. Ma non al quarto.
		</p><p>
			Oggi infatti è comparsa la mia nuova nemesi: <span
			class="code">lib-mesa</span>. Questa implementazione/dichiarazione
			alternativa delle estensioni GLX, a quanto pare, non solo è
			completamente incompatibile con la mia scheda e i suoi driver, ma fa
			funzionare (i.e., questi dipendono da) la maggior parte dei
			programmi che io utilizzo. MPlayer, Epiphany, Wine su tutti.
		</p><p>
			Non possono funzionare senza. E io non posso mettercela, se voglio
			vedere quel che succede.
		</p><p>
			Quindi, eccomi a vagliare le alternative.
		</p>
	</div><div class="section">
		<p>
			Grazie a Dio (beh, veramente grazie a Bram Moolenaar)
			<span>VIm</span> funziona senza accelerazione 3D. Ho sostituito
			Epiphany con qualcosa di altrettanto veloce, Chromium. Che dire,
			funzionare funziona, rapido è rapido.
		</p><p>
			Poi ho speso il resto della mattina – quel poco ch'è avanzato, prima
			e dopo il pranzo – per far funzionare <span class="code">mpd</span>,
			che già mi da delle soddisfazioni.
		</p><p>
			Ma senza Wine, come posso giocare a <span class="em">Warning
			Forever</span>?
		</p>
	</div>
</div><div class="section">
	<p id="III">
		Ma non solo…  c'è effettivamente un proseguo, ossia il risultato del
		lavoro di oggi.
	<p><p>
		Sebbene io mi sia dedicato ad altre cose per la maggior parte del tempo,
		quella storiella del metapacchetto fake mi s'è imbucata in un orecchio e
		quindi, dopo molta altra fuffa, ho tentato…
	</p>
</div><div class="small">
	<div class="section">
		<p>
			Ricordate dov'ero?
		</p><p>
			Ero alla ricerca di alternative valide. Cerca cerca, chiedi in giro,
			domanda il parere al <span class="bolo">Bolo</span>, saltano fuori
			due strade.
		</p><ul><li>
				<p>cedere, installare la dannata <span
				class="code">libgl1-mesa-glx</span>, tornare ad utilizzare tutti
				i miei soliti applicativi e sperare che questi driver siano
				abbastanza sgaggi da abilitare il mio 3D</p>
			</li><li>
				<p>passare a Gentoo</p>
			</li><li>
				<p>ma si presentò anche una terza via, la più viscida, quella di
				ingannare il sistema, aggirare le politiche di Debian e
				costruire un pacchetto fasullo…</p>
		</li></ul><p>
			Insomma, non ero troppo propenso verso alcuna di queste. La
			prospettiva di cedere ai Debianici e ignorare i driver proprietari,
			considerato l'immensa fatica spesa fino ad ora per arrivare dove
			sono, mi pare uno spreco e una vigliaccata.
		</p><p>
			Il passaggio ad una qualsiasi altra distribuzione è una soluzione
			altrettanto codarda. Quindi, ho intrapreso la terza via, carico di
			ogni speranza. Il sempre presente <span
			class="jazz">Jazzinghen</span> m'ha linkato un tutorialuccio piccino
			piccino che indica come realizzare un file <span
			class="code">.deb</span> vuoto. Ed io lo seguo.
		</p><p>
			Basta infatti infilare qualche nome fasullo, inventare un numero di
			versione e dare un <span class="code">dpkg --build</span> per
			ottenere il pacchetto.
		</p>
	</div><div class="section">
		<p>
			Niente di terribile. Una volta ottenuto il pacchetto, lo si può
			installare facilmente, con un'altra chiamata a <span
			class="code">dpkg -i</span> e il gioco è fatto. 
		</p><p>
			Prima ho provato semplicemente a mimare la libreria incriminata, ma
			ho scoperto che i conflitti sono abbastanza annidati, e soprattuto
			sembrano simili ai rancori dei nani: proseguono da secoli, passando
			di generazione in generazione, che quasi nemmeno i nani si ricordano
			i veri motivi per cui tutto ebbe inizio…
		</p><p>
			La trafila di <span class="code">breaks</span> tra una libreria e
			l'altra s'annida a fondo, e cambiarne una non basta. Una volta
			capito che la soluzione non stava affatto nel nome del pacchetto,
			notando come i pacchetti dichiarino le proprie dipendenze, ho
			cercato e trovato come un pacchetto possa dichiarare anche le sue
			disponibilità, o meglio i suoi rifornimenti, come meglio crede.
		</p><p>
			A quel punto, ecco un pacchetto completamente fasullo che dichiara
			impunemente la libreria che non c'è.
		</p><pre>  ########
  libhax/DEBIAN/control
  ########
  Package: libhax
  Version: 5.99
  Section: main
  Priority: optional
  Architecture: all
  Depends: 
  Provides: libgl1-mesa-glx
  Installed-Size:
  Maintainer: Ivan Simonini
  Description: A fake package for mesa compatibility with NVIDIA</pre><p>
			E fu fatta. Essendo infatti le due alternative completamente
			equivalenti, è bastato far credere a tutti che l'una sia l'altra.
		</p><p>
			Non appena creato il segnalino che dichiara l'effettiva esistenza
			dei simboli, ho potuto reinstallare i pacchetti dipendenti da mesa
			senza alcun problema; in più il linker ha trovato immediatamente
			tutti i riferimenti.
		</p><p>
			Posso quindi tornarmene a vedere i filmati con MPlayer, posso
			giocare con Wine e dovrei essere al sicuro ancora per un po', visto
			che l'installazione dei driver NVIDIA non è stata toccata.
		</p><p>
			Quanto durera?
		</p>
	</div>
</div><div class="section">
	<p>
		&#160;
	</p><p>
		&#160;
	</p><p>
		&#160;
	</p><p>
		&#160;
	</p><p>
		&#160;
	</p><p>
		[…]
	</p>
</div><div class="section">
	<p id="IV">
		Ma ovviamente non è questo il motivo per cui scrivo la cinquantesima
		storia.
	</p><p>
		Difatto, è un numero abbastanza importante. È un traguardo. Non vorrei
		sprecarlo.
	</p><p>
		Il problema è, credo, che questo discorso non possa funzionare in alcun
		modo. Per la sua stessa struttura. Non può funzionare perché sono io a
		doverlo pronunciare. E io sono qui per il motivo sbagliato.
	</p>
</div><div class="small">
	<div class="section">
		<h2>
			Versione #1
		</h2><p>
			Il Gods s'avvicina alla gelateria, butta dentro un occhio, trova la
			gelataia da sola, non c'è nessun altro.
		</p><p>
			S'avvicina d'un passo, entra… Lei se ne accorge un po' in ritardo,
			alza gli occhi, incrocia il suo sguardo… fa un rapido ragionamento,
			ricorda d'aver già visto questo tizio; in alcune occasioni, era
			fuori dalla gelateria a fissare con il suo fiammeggiante sguardo
			dell'odio!
		</p><p>
			«Cosa vorrà mai questo tizio? Non vorrà mica fare cose brutte?
			L'intensità del suo odio non scioglierà mica il gelato?» pensa la
			gelataia, ma è già troppo tardi.
		</p><p>
			Il Gods è scappato.
		</p>
	</div><div class="section">
		<h2 class="reverse">
			Versione #2
		</h2><p>
			Il Gods s'avvicina spavaldo alla gelateria, controlla la situazione,
			aspetta di poter restare solo con la gelataia, aspetta, aspetta, poi
			entra, si presenta e attacca bottone.
		</p><p>
			La gelataia sembra ricordarsi vagamente di lui, annuisce e ride
			persino alle battutine del nostro eroe.
		</p><p>
			Ma lui è troppo furbo, e non si lascia sfuggire i particolari.
			Qualcosa non va, è troppo facile.
		</p><p>
			Millantando un'importantissima partita di bocce, il Gods fa per
			andarsene.
		</p><p>
			Le grate della gelateria scattano, imprigionandolo. Le sbarre sono
			elettrificate e roventi: è una gabbia di Faraday!
		</p><div class="outside"><p>
				«<span class="gods">Nooooooooo!</span>» grida il nostro eroe,
				visibilmente preoccupato.
			</p><p>
				«Sei caduto nella mia trappola, Dr.Odio!» esclama il malefico
				avversario, spuntando da dietro il bancone.
			</p><p>
				«<span class="magnet">Esatto! Sei stato uno sciocco, il tuo
				piano non funzionera!</span>» ridacchia la gelataia, togliendosi
				la maschera.
			</p><p>
				«<span class="gods">Ah! Maledetti! Tu, Richards! E tu, <span
				class="em">Ragazza magnete</span>! Mi avete tirato un brutto
				scherzo… ma non crediate di potermi fermare!</span>»
		</p></div><p>
			Il Dr.Odio estrae i suoi occhialetti tondi, il suo gilet da Nekki
			Basara, e la sua speciale V7, chitarrone elettrico modificato
			personalmente.
		</p><div class="outside"><p>
				«<span class="gods">Ve l'avevo
				<?=$d->link('Storie/2011/XXXII/', 'promesso', 'II')?>,
				no?</span>» esclama il Dottore, ora spalleggiato da
				un'olografica fortezza superdimensionale trasformabile «<span
				class="gods">Nessuno si salverà!</span>»
			</p><p>
				«<span class="gods forte">Listen to my song!!!</span>»
		</p></div><p>
			L'odio brucia e arde con l'intensità di un milione di soli.
		</p>
	</div><div class="section">
		<h2>
			Versione #3 – quella vera
		</h2><p>
			Questo discorso è sincero.
		</p><p>
			M'avvicino alla gelateria. Aspetto. Aspetto un qualche segno,
			aspetto sperando magari che sia lei a fare la prima mossa, aspetto
			che non ci sia gente, faccio finta di guardarsi attorno, guardo le
			offerte dei cellulari, guardo le scarpe…
		</p><p>
			Poi, finalmente, arriva, sento che il momento arriva. Non il momento
			giusto, non il momento eroico, non il momento in cui riesco
			finalmente ad impugnare la forza dei miei sentimenti, il momento
			della verità.
		</p><p>
			È il momento della stanchezza, il momento della fatica che raggiunge
			il punto critico, il momento in cui le capacità di sopportazione si
			esauriscono, il momento in cui la prospettiva di posporre il
			confronto non è più accettabile, perché è passato troppo tempo.
		</p><p>
			È il momento che questa farsa finisca. Entro.
		</p><div class="outside">
			<?=$d->speak('gods','Ciao, scusa il disturbo')?>
			<?=$d->speak('gods','Tu non ti ricordi, vero? … Immaginavo')?>
			<?=$d->speak('gods','Ti prendo cinque minuti, poi sparisco')?>
			<?=$d->speak('gods','Io sono qui per il motivo sbagliato. Venerdì
			scorso… no, il venerdì di due settimane fa, ero qui con alcuni amici
			a prendere un gelato e t&apos;ho vista')?>
			<?=$d->speak('gods','E sono rimasto colpito')?>
		</div><div class="inside">
			<?=$d->speak('gods','All&apos;inizio ho pensato che fosse perché
			m&apos;hai ricordato una persona che conosco; una ragazza che odio.
			Pensavo fosse quello, ma si son sbagliato. Perché stavo pensando a
			te, non a lei. Anche perché contro di te non ho niente')?>
		</div><div class="outside">
			<?=$d->speak('gods','Comunque, mi sono fissato con te. Mi
			capita.')?>
			<?=$d->speak('gods','A volte sono Transformers, a volte sono Gundam,
			a volte sono ragazze. I Transformers li posso trovare abbastanza
			facilmente, i Gundam invece mi tocca ordinarli dal Giappone e ci
			vuole una vita… ma quelli li posso comprare; le ragazze, invece… per
			loro piego fiori')?>
			<?=$d->speak('gods','Questo è il tuo. L&apos;ho realizzato apposta.
			L&apos;ho creato pensando a te, in queste settimane.')?>
			<?=$d->speak('gods','È il migliore che ho mai fatto. È sempre così')?>
		</div><div class="outside">
			<?=$d->speak('gods','Non ho mai capito come dovrebbe funzionare, so
			soltanto che mi viene naturale farne uno per queste occasioni;
			crearne uno nuovo. In qualche modo, rappresenta tutte le speranze
			che ho. Perché sento che vale la pena di conoscerti e scorpire chi
			sei, e non posso lasciarti andare senza fare almeno un tentativo')?>
			<?=$d->speak('gods','Ma non è per questo che sono veramente qui; è
			perché so che ho torto, e perché so che tra un po&apos; mi
			passerà')?>
			<?=$d->speak('gods','Perché chi tu sia io non lo so, e non riesco a
			convincermi che averti vista una volta possa farmi credere di
			volerti stare accanto')?>
			<?=$d->speak('gods','E non so perché mi stai a sentire. Non trovo
			i motivi; non li vedo')?>
		</div><div class="outside">
			<?=$d->speak('gods','Quindi, se tu volessi accettare il fiore…
			Grazie')?>
			<p class="gods" style="text-align: right">«Scusa»</p>
		</div><p>
			Poi me ne vado.
		</p>
	</div>
</div><div class="section">
	<p id="V">
		C'è una cosa che non vi ho detto. Prima, mentre scrivevo il
		<?=$d->link('Storie/2011/L/','primo aggiornamento','III')?>, m'è apparso
		Codd.
	</p><p>
		M'è apparso e non ha detto niente. Se n'è rimasto lì, in silenzio, a
		fissarmi… 'Sto stronzo.
	</p><p>
		Ho capito che avrei dovuto scrivere un secondo aggiornamento a questa
		storia. E c'era una sola cosa che poteva finirci.
	</p>
</div><div class="small">
	<div class="section">
		<p>
			La farò corta, perché è tardi e ho fame…
		</p>
	</div><div class="section">
		<p>
			Era evidente che Codd non se ne sarebbe andato prima che io me ne
			fossi uscito di casa diretto verso la gelateria.
		</p><p>
			Quindi me ne sono uscito. Non subito… prima ho recuperato il
			cellulare del babbo, rimasto dimenticato in macchina, e nel fare
			questo sono andato a gettare il polistirolo.
		</p><p>
			Abbiamo cambiato lavastoviglie, recentemente. Ed era ovviamente una
			lavastoviglie imballata. Imballata con una spaventevole quantità di
			polistirolo. Polistirolo che ho dovuto infilare in un sacchetto e
			portare in cantina. Fino ad oggi, quando sono stato incaricato di
			gettare il sacchetto.
		</p><p>
			Ma il sacco, colmo, non si chiudeva. Quindi, mi sono messo a
			sbriciolare il polistirolo sperando che occupasse meglio lo spazio
			del sacchetto e mi permettesse di chiuderlo. La titanica impresa (o
			come diremme il vecchio Nadalini «il lavoro certosino») mi prese
			soltanto un quarto d'ora.
		</p><p>
			Ma alla fine il sacchetto si chiuse, il telefono venne recuperato ed
			io me ne partii verso l'avventura.
		</p>
	</div><div class="section">
		<p>
			Erano tipo le 22:30, non prestissimo. Almeno era fresco. E comunque,
			sapendo cosa volevo fare ma non come farlo, mi diressi dalla parte
			opposta, sperando di trovare dei suggerimenti, dei messaggi
			dall'universo, delle botte in testa, delle visioni di comete… cose
			del genere.
		</p><p>
			Ma no. Mi son girato mezza città senza trovare niente
			d'interessante. In compenso ho bevuto da cinque fontanelle diverse,
			mi sono goduto un po' della città di notte.
		</p><p>
			Poi, quando mi decido ad andare nella direzione giusta, mi ricordo
			che oggi è martedì e di martedì c'è un famoso happy hour, che mi
			sbrodola &gt;9000 giovinastri per strada. Ed io li odio.
		</p>
	</div><div class="section">
		<p>
			Comunque sia, mi avvicino e passo davanti alla gelateria. M'erano
			venuti un paio di dubbi, nel mentre. Tipo il fatto che lei non
			lavori tutti i giorni, e tipo il fatto che magari chiudano.
		</p><p>
			Mentre passavo davanti, questi dubbi vennero fugati. Era ancora
			aperto, lei c'era ma non era sola. C'era un collega.
		</p><p>
			Quel che non c'era ero io. Me n'ero già andato.
		</p><p>
			Nel passarle davanti ho capito tre cose.
		</p><ul><li>
				<p>non ero ancora pronto; mi ci voleva qualcosa in più</p>
			</li><li>
				<p>questa sarebbe comunque stata la sera giusta, e sarei tornato
				lì non appena pronto</p>
			</li><li>
				<p>il piano era sbagliato: dovevo cambiarlo, tornare
				all'originale, e farlo al volo</p>
		</li></ul><p>
			Perché avevo una mezza idea che ho effettivamente messo in pratica.
			E quello è stato l'errore.
		</p>
	</div><div class="section">
		<p>
			Sono uscito senza il fiore. Non so bene come avrebbe dovuto
			funzionare, ma avevo il sentore che andare a presentare il fiore e
			portarlo dopo avrebbe reso il tutto più intenso, proprio come quando
			ordini una pizza espressa e aspetti che ti arrivi.
		</p><p>
			Ma poi ho cambiato idea. Meglio, ho saputo che quella non era la
			cosa che avrei dovuto fare.
		</p>
	</div>
</div><div class="section">
	<p id="VI">
		Quindi mi sono diretto a casa, abbastanza spedito, ho recuperato il
		fiore e già che c'ero mi sono preso la bicicletta.
	</p><p>
		E sono tornato lì.
	</p>
</div><div class="small">
	<div class="section">
		<p>
			Prendere l'arietta in faccia grazie alla bicicletta non m'ha aiutato
			un gran ché.
		</p><p>
			Bello confuso e nebbioso, ho legato la bici vicino alla fontanella
			della piazza. Ho bevuto un goccio d'acqua, mi son ben asciugato le
			manine così da non rovinare il fiore, e mi son diretto verso la
			gelateria.
		</p><p>
			Ho camminato verso l'ignoto, nella nebbia. Ero fondamentalmente
			vuoto, ed ho seriamente temuto di non riuscire a spiccicare parola.
		</p><p>
			Poi è apparso Codd.
		</p>
	</div><div class="section">
		<div class="inside"><p>
			E Codd mi disse «<span class="codd">Guarda che sarà ben più
			difficile per lei</span>»
		</p></div><p>
			E quella fu la luce che squarciò le tenebre. Perché tra i due, io
			sarei stato quello che sapeva cosa stava succedendo. E questa era
			decisamente la cosa che mi serviva sapere.
		</p>
	</div><div class="section">
		<p>
			Quando sono entrato, le luci erano ancora accese, il ragazzo che
			avevo visto prima stava spostando le vaschette e pulendo il bancone,
			mentre lei era dietro una divisoria in vetro.
		</p><p>
			E sapendo quello che dovevo fare, sono entrato, ho guardato il tizio
			negli occhi. Lui, ovviamente, stava per dirmi che ormai erano
			chiusi, e che di gelati non ce n'eran più.
		</p><p>
			Ma io sapevo perché ero lì, quindi l'ho liquidato dicendo che dovevo
			parlare con la ragazza. Semplice. E lui s'è fatto da parte.
		</p>
	</div><div class="section">
		<p>
			Evidentemente, la mia spavalderia aveva lasciato tutti un po'
			intontiti; mi sarei aspettato, infatti, che il tizio avesse capito
			che cercavo la sua collega, e che l'avrebbe chiamata. E invece no,
			lui se n'è fregato.
		</p><p>
			Ma io, che sapevo perché ero lì, ho fatto quel che andava fatto. Ho
			lasciato che la mia italianità producesse dei gesti atti a farle
			capire che doveva venire fuori a sentire quel che avevo da dire.
		</p><p>
			Quindi le ho chiesto se avrebbe accettato il fiore o meno, e le ho
			ripetuto le stesse parole tre volte. Perché io sapevo cosa stava
			succedendo, la poverina no. E in effetti non capita tutti i giorni
			che salti fuori un tizio che vuole regalarti un fiore, men che meno
			di carta.
		</p><p>
			Quindi ho insistito finché lei ha preso il fiore (per una foglia! Non
			da sotto, come andrebbe fatto… quasi mi sarei alzato, se non fossi
			stato in piedi – e poi l'ho costruito bene, mica si romperà), ha
			capito che il fiore era per lei ed è arrivata al passo successivo,
			ossia chiedersi il perché.
		</p><p>
			Poi m'ha chiesto se per caso ci conoscessimo, ed io ho risposto che
			non l'avevo mai vista prima di tre venerdì fa. Poi m'ha chiesto
			anche qualcos'altro, ma ormai m'ero perso nei suoi occhi e non mi
			ricordo che cosa fosse.
		</p><p>
			Poi ha sorriso ed ha fatto un risolino imbarazzato.
		</p><p>
			A quel punto, a missione compiuta, saluti a tutti, e me ne sono
			andato.
		</p>
	</div><div class="section">
		<p>
			Ahw.
		<p><p>
			Se chiudo gli vedo ancora quel sorriso.
		</p><p>
			Se ripenso a quel sorriso e chiudo gli occhi, sento il metallo. E
			questo è certamente un buon segno.
		</p>
	</div>
</div>
<?php } ?>
