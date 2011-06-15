<?php
	$title=array('Wireless','Le cose che servono e le cose che vogliono');
	$prev=array('Storia XLIV','Storie/2011/XLIV/');
	$next=array('Storia XLVI','Storie/2011/XLVI/');
	function mkpage ($d) {
		$self = 'Storie/2011/XLV/';
?>
<div class="small">
	<div class="section">
		<p>
			Salve, sono il Gods ed alle volte potete trovarmi alle prese con
			cose difficili: ad esempio, driblando altre cose di cui vado a
			narrarvi, son riuscito a (ri)finire Vanquish nella modalità
			Difficile. Quella subito prima di Divinamente Difficile.
		</p><p>
			É stato difficile.
		</p>
	</div><div class="section">
		<p>
			Ma questa non è la sola cosa che ho fatto. Negli ultimi tre giorni,
			sono riuscito in alcune cose. O forse ho fallito? Non riesco a
			capire bene perchè la soddisfazione che ottengono IRL è estremamente
			bassa, o comunque minore di quella che ottengo sull'InterWeb o
			giochicchiando.
		</p><p>
			Ordunque, nell'ordine, parlerò del <?=$d->link($self,'mio
			router','II')?>, della <?=$d->link($self, 'biciclettata','III')?> e
			della <?=$d->link($self,'corsa','IV')?>, ancora una volta.
		</p><div class="outside"><p>
			Ed un contenuto <?=$d->link($self,'bonus','V')?>, aggiunto il giorno dopo.
		</p></div><p>
			Procedo.
		</p>
	</div>
</div><div class="section">
	<p id="II">
		Grazie al <span class="jazz">signor Jazzinghe</span>, eccomi in possesso
		d'un router nuovo nuovo.
	</p><h2>
		Avere un router in casa
	</h2><h2 class="reverse">
		Quello che la gente vuole, quello che alla gente serve
	</h2><p>
		E per quanto io ringrazi per ciò che m'è stato dato, e per quanti
		benefici se ne possano trarre, ecco che nessuna buona azione rimane
		impunita. La storia è lunga e irta di pigne. Pigne da infilare proprio
		lì.
	</p>
</div><div class="small">
	<div class="section">
		<p>
			Dunque, immaginatemi tornare a casa dopo l'ennesima deludente
			giornata di vita vera e crollare sul divano.
		</p><p>
			Immaginatemi in possesso di due cose soltanto: il router nella sua
			deliziosa (NOT) borsina fucsia e una violenta voglia di andare a
			correre per non essere lì.
		</p><p>
			Immaginate dunque il sottoscritto ch'entra in camera giusto il tempo
			per cambiarsi d'abito e uscire di corsa, lasciando al maggiore dei
			fratelli giusto il tempo di dire
		</p><div class="outside"><p>
				«È un router?»
			</p><p>
				«Si, attaccalo, dovrebbe funzionare al primo colpo!»
		</p></div><p>
			... e poi via come un'anguilla.
		</p>
	</div><div class="section">
		<p>
			Immaginate, poi, se potete, il mio stupore nel constatare, al mio
			ritorno, che le cose sono andate bene.
		</p><p>
			Ci credereste?
		</p><p>
			Fatto sta che collegando i cavi (ossia sostituendo il nuovo router
			al vecchio modem) l'internet continua a passare. Faccio il test,
			attacco un cavo tra il router e la mia colossale PS3, mi loggo e
			vedo l'internet anche da lì. Gioia e giubilo.
		</p>
	</div><div class="section">
		<p>
			Ma il giorno dopo, ecco che mio fratello (sempre quello grande)
			prova la connessione wireless.
		</p>
	</div><div class="section">
		<p>
			Noto come la configurazione standard, come mi aspetterei da una
			scatoletta per idioti qual è questo router (ossia attaccalo e sii
			felice per sempre), preveda l'antenna wifi sempre accesa.
		</p><p>
			Si collega da solo, trasmette da solo, non vedo perché non dovrebbe
			fare tutto da solo. Visto ch'è quello ch'è stato fabbricato per
			fare.
		</p><p>
			Ma presto mi disilludo. Mio fratello si collega, copia la
			chilometrica chiave WPA2-PSK (sigla che si allunga ogni volta che la
			vedo) e lo fa correttamente. Nonostante tutto, ecco che il suo
			AVGFree non s'aggiorna. Ed ecco che la colpa di tutto diventa mia.
		</p>
	</div><div class="section">
		<p>
			Soprassiedo sulla visceralità delle emozioni che mi suscita il
			sentirmi dire ancora una volta che in quanto informatico dovrei
			provvedere (in anticipo) a tutti i problemi che riguardano qualunque
			cosa vicina ad un qualcosa di elettronico.
		</p><p>
			Chiedo all'AVG cos'è che non gli piace, e lui mi risponde che un
			file CFT (o CTF, non ricordo bene) non è bello quanto si vorrebbe.
			Cerca dunque sul bel sito 'sto file, scopri che non esiste.
		</p><div class="outside"><p>
				«Fratello, da quanto non aggiorni il tuo sistema?»
			</p><p>
				«Fammi pensare... c'erano ancora i dinosauri e i nastri Betamax»
			</p><p>
				«Fratello, vai direttamente sul sito e scaricati una nuova
				versione»
			</p><p>
				«Eh, non ci riesco...»
		</p></div><p>
			Scopro soltanto allora che la connessione (tutte le richieste)
			vengono ignorate; l'unica cosa che torna indietro è l'interfaccia
			web del router, che dice «Salve sono il router» e poco altro.
		</p>
	</div><div class="section">
		<p>
			Prendo il calumet della Pace e mi siedo accanto al router.
		</p><p>
			Controlla la configurazione, manuale alla mano, e scopri che
			esistono tre importanti lucine. ADSL, WiFi e InterNet. Dunque:
		</p><ul><li>
				<p>ADSL è la lucina che indica la sincronizzazione del modem
				ADSL con il mio ISP, s'accende per conto suo non appena il
				router viene accesso e ben mi sta</p>
			</li><li>
				<p>WiFi è la lucina che indica se l'antenna è accesa o meno, e
				se il router sta trasmettendo la wireless, se attiva il DHCP e
				altre menatine</p>
			</li><li>
				<p>la lucina InterNet mi dice se funziona l'internet,
				ovviamente. Ma quello che il router pensa (invece di dirlo a me)
				è che l'internet (quello che passa per l'etere) debba avere una
				lucina tutta per se</p>
		</li></ul><p>
			Eh già. Perché se via cavo ho tutta la connettività del mondo, e
			posso navigare senza alcuna autorizzazione ulteriore (è ben
			plausibile, visto che devi essere attaccato fisicamente), se mi
			attacco wireless (con la WPA2 inserita, ovviamente) devo avere un
			permesso effettivo per navigare.
		</p><p>
			Ora, tolto il fatto che non vedo proprio per quale motivo dovrei
			bloccare il traffico in questo modo, e non vedo quale utilità dovrei
			avere tenendo chiuso questo interruttore, mi chiedo questo: come
			l'accendo?
		</p><p>
			Per prima cosa, sappiate che questa interfaccia compare
			ESCLUSIVAMENTE quando mi connetto senza fili: per i PC collegati via
			cavo, quest'interfaccia è completamente irraggiungibile; il router
			non risponde. Tutto si svolge su porte separate; risultato: devo
			collegarmi wireless per far funzionare la wireless.
		</p><p>
			Allora prendo il mio portatile e mi collego wireless. E chiedo al
			router cosa possiam fare, io e lui, lui ed io. C'è un bel bottone
			‘Accendi Internet’ e io bel bello lo premo. Il router mi chiede DUE
			conferme. Poi mi mostra nuovamente la solita interfaccia. Come
			niente fosse, senza alcun messaggio di OK, senza dare alcun errore,
			senza batter ciglio. E la luce rimane spenta.
		</p><p>
			Io continuo a provare, secondo varie combinazioni, progressivamente
			più assurde, a fare tentativi per ottenere qualcosa.
		</p><p>
			Nonostante i miei sforzi, il router pare ignorare ogni richiesta.
			Come facesse finta. Finché trovo il bottone ‘Risparmio Energetico’,
			che millanta di far risparmiare corrente; in realtà non fa altro che
			tener spente tutte le lucine del caso.
		</p><div class="outside"><p>
				«Dai, che non potendo accendere una lucina, magari riesco a
				spegnerne sei. Proviamo»
		</p></div><p>
			Ed improvvisamente (dopo altre due conferme) il router mi risponde
		</p><div class="outside"><p>
				«È necessario riavviare il sistema per attivare le modifiche. La
				procedurà prenderà 2 minuti: 2:00 1:59 1:58...»
		</p></div><p>
			Emminchia, quanto sarà mai complesso spegnere delle lucine? Ci vuole
			un riavvio totale? Vabbene, router del cazzo, fai 'sto riavvio.
		</p><p>
			Ed ovviamente, dopo due minuti di ronzii, dopo aver ammazzato la
			connessione a tutte le macchine che ho in casa e dopo aver messo in
			rapida rotazioni gli attributi, ecco che lo stronzo si riaccende. Ma
			le luci restano spente. Anche quella dell'internet. Però adesso
			posso navigare.
		</p><p>
			Perché, proprio come sotto Windows, un riavvio è necessario e
			sufficiente ad ottenere quelle semplici cose che ti servono per
			vivere.
		</p>
	</div><div class="section">
		<p>
			Ora immaginate di fare tutto questo, constantemente interroto da un
			qualche familiare che deve assolutamente navigare il web per fare
			questa o quella cosa inutile.
		</p>
	</div>
</div><div class="section">
	<p id="III">
		Poi, la domenica, sentendomi ancora dir dietro perché alle 6:57 di
		mattina «l'internet non funziona... come mai?» e a rispondere che «la
		notte il router è spento, come tutto il resto, e che prima delle 9 di
		mattina (o comunque prima del caffè) è ancora notte e lui resta spento»,
		me ne vado con il buon Dave a Pergine a far la
	</p><h2>
		Pedalata per la Vita
	</h2><p>
		Manifestazione di cui ho scoperto l'esistenza grazie ad un cartello
		appesa sulla pista ciclabile; il tutto per beneficenza, e son ben
		contento di spendere qualcosina.
	</p>
</div><div class="small">
	<div class="section">
		<p>
			Ma sarei stato più contento se la cosa fosse stata una vera pedalata
			e non una processione, composta per lo più di gente pigra e/o
			stanca e di bimbiminchia.
		</p><p>
			Succede infatti che la “gara” sia aperta a tutti, è composta di tre
			percorsi diversi di lunghezza progressivamente maggiore ed ognuno
			può scegliere il suo.
		</p><p>
			Capita però che anche il percorso più lungo e “difficile” sia
			largamente sotto le mie possibilità/aspettative.
		</p>
	</div><div class="section">
		<p>
			Insomma, io sarò anche stronzo, ma se partecipare ad una
			manifestazione del genere significa dover tenere il proprio posto in
			un lungo fiume umano, procedendo a passo di corsetta, preferisco
			starmene in coda in autostrada.
		</p><p>
			Ho visto infatti i più disparati tipi di ciclisti, di cui
			praticamente nessuno all'altezza. E io non sono un atleta, sono solo
			uno che ha briga di arrivare a pranzo, che si spacca le palle ad
			andare al passa dei bambini e vorrebbe vedere qualche salita,
			qualche panorama.
		</p><p>
			Invece mi trovo circondato di bambini alti così con la loro
			biciclettina piccina picciò, con il loro bel cascone di polistirolo,
			la loro borraccina che serve a nulla se non ad appesantirli; mi
			trovo circondato di nonne / mamme et similia che lottano per tenere
			i nipoti / figli in strada, sul percorso giusto, alla giusta
			velocità; mi trovo circondato di pigri cinquantenni con la tenuta
			tecnica, il casco profilato per la velocità, i guanti, le scarpe con
			i chiodi e i ganci, il rampichino da 2000€, il telaio in alluminio e
			i freni a disco, gli occhialetti da sole, il computer di bordo con
			&gt;9000 funzioni, che però vanno comunque ai 17/h e si fan passar
			via anche dai bambini; mi trovo circondato poi, immensa tristezza,
			di ragazze più o meno carine, tutte rigorosamente in compagnia di
			qualcuno.
		</p><p>
			E per quanto sia per beneficenza, e per quanto la compagnia, il
			sole, il panorama etc etc etc, l'intera mattinata è stata una
			colossale rottura di palle; il pranzo è stata una sofferenza
			(&gt;9000 ore di coda sotto il sole, tavolo sotto il sole, birra
			sotto il sole, musica della banda sotto il sole). Almeno era in
			buona compagnia.
		</p><p>
			Ma non credo che il prossimo anno ci tornerò: me ne andrò da qualche
			parte dove la fatica valga la soddisfazione.
		</p>
	</div>
</div><div class="section">
	<p id="IV">
		Vi ho detto o non vi ho detto che hanno aperto un nuovo ponte
		sull'Adige? Che la ciclabile ci passa sopra?
	</p><h2>
		La corsa e la gente che corre
	</h2><p>
		Mi par di non avervelo detto.
	</p>
</div><div class="small">
	<div class="section">
		<p>
			Eh... la corsa. Par che sia l'unica cosa a tenermi in vita,
			recentemente.
		</p><p>
			Ma non è che sia priva di difetti.
		</p>
	</div><div class="section">
		<p>
			In particolare, la cosa che si fa più sentire è la solitudine. Una
			volta, correndo, riflettevo sulla cosa. Ci sono infatti molti motivi
			per cui una persona può correre; io lo faccio per correre. Per
			andare in fretta.
		</p><p>
			Non particolarmente in fretta, ma comunque veloce. Per arrivare dove
			devo andare, per arrivarci in poco tempo; in particolare, per poter
			andare a bere dalla fontanella all'altezza di Mattarello e riuscire
			a tornare entro un'ora e venti, un'ora e un quarto.
		</p><p>
			Fondamentalmente, per farmi un certo giro senza impiegare troppo
			tempo. Così posso correre quando mi pare, senza dovermi
			necessariamente organizzare prima.
		</p>
	</div><div class="section">
		<p>
			Questo mi darebbe anche la piccola grande soddisfazione di
			sorpassare le persone. Perché vedere gente che va tanto per andare,
			che va per battere giù i chili di troppo, e anche quelli che vanno
			come me tanto per andare, e passarli via tutti, sotto sotto, da una
			certa soddisfazione.
		</p><p>
			Ma a lungo andare questa velocità superiore smette di essere un
			privilegio e diventa una necessità: un po' perché devo comunque
			andare in fretta per non perdere l'allenamento, un po' perché andare
			piano mi da fastidio, un po' per amor proprio perché andare più in
			fretta è quello che mi sento di fare.
		</p><div class="outside"><p class="latino">
				Per l'onore, devo correre al massimo delle mie possibilità,
				per non dare false impressioni a chiunque corra con me, contro
				di me e anche per i ciclisti.
		</p></div><p>
			Il problema, però, è che alla fine resto sempre da solo. La maggior
			parte delle persone non fa un percorso lungo come il mio, o rimane
			indietro, o si ferma a riposare, o si ferma a telefonare. Questa e
			molte altre cose, man mano, mi lasciano da solo.
		</p><p>
			E non è affatto bello.
		</p>
	</div><div class="section">
		<p>
			A me piacerebbe anche avere qualcuno con cui correre, ma a che
			scopo? Se trovassi anche qualcuno con cui correre, che dovrei fare?
			Stare al suo passo? Andar piano? A che scopo correre, dunque?
		</p><p>
			Non è come bere il caffè, ch'è buono anche se lo bevi in compagnia.
			Se non fai fatica mentre corri, allora tanto vale camminare, no?
		</p><p>
			Almeno, questo è quello che penso. Ogni volta che vedo qualcuno
			comparire all'orizzonte, non passa molto prima che mi scompaia alle
			spalle. Ma ovviamente, questo è molto più evidente quando chi
			compare all'orizzonte è una ragazza (o magari, più spesso, una
			coppia di ragazze).
		</p><p>
			Le ragazze corrono in maniera strana.
		</p>
	</div><div class="section">
		<p>
			Dondolano.
		</p><p>
			Fanno quasi impressione. Alcune, poi, sono così secche che ho paura
			a sorpassarle, che magari si spezzano. Alcune sembrano così leggere
			che se c'è troppo vento potrebbero volar via.
		</p><p>
			Ma l'unica verità fondamentale è che avvicinano troppo troppo troppo
			in fretta. Non so s'è per il fatto che dondolano troppo a destra e a
			sinistra, non so se facciano attrito a correre con le braccia
			larghe, non so se non riescano ad avanzare perché han le ossa cave
			come gli uccelli, so che tutte corrono piano e io le passo via.
		</p><p>
			E non è che ci sia il tempo di passar loro accanto, fare un cenno,
			un salutino, vanno troppo piano. Non è come superare un altro
			ciclista, quando devi avvicinarti, prendere la scia, controllare
			avanti e dietro che le corsie sian libere, poi passi via e ti
			rimetti nella tua corsia; lì è istantaneo, quasi come superare i
			paracarri.
		</p><div class="outside"><p>
				«To' guarda una ragazza che corre, magari magari...»
			</p><p>
				«Magari è già venti metri indietro e non la vedo più bene»
		</p></div><p>
			E insomma, cosa devo fare? Devo forse mettermi a correre piano? Non
			lo faccio per due motivi. 
		</p><ul><li>
				<p>non mi piace correre piano</p>
			</li><li>
				<p>
				non mi piace affatto disturbare la gente che corre, così come
				non mi piace essere disturbato. Già mi da fastidio incontrare
				qualcuno che corre in contromano dalla mia parte, pensa il
				fastidio che mi darebbe incontrare uno con la mia faccia che mi
				passa via e magari mi fa ciao con la manina per sfottermi:
				l'ammezzerei. Sicuro.
				</p>
			</li><li>
				<p>e c'è anche un motivo bonus: quello che sorpassa sono appunto
				io. E quando sorpasso, un po' inconsciamente, un po' perché sono
				all'inseguimento, un po' per scia, un po' per fare il figo,
				corro più in fretta del normale: aumento il passo per occupare
				meno l'altra corsia.</p>
				<p>Ma quando corro più in fretta, e faccio più fatica, la mia
				espressione si fa più corrucciata. E parte già corrucciata. E la
				faccia base è la mia. Quindi, sostanzialmente, quando vado a
				correre ho la faccia da mastino incacchiato. Non è una bella
				cosa da vedere.</p>
		</li></ul>
	</div>
</div><div class="section">
	<p id="V">
		Ieri non ho avuto tempo/modo di scrivere tutto tutto, quindi lo aggiungo
		adesso.
	</p><h2>
		I fiori, la futilità, le delusioni previste
	</h2><p>
		Se siete già tristi, o se volete diventarlo, continuate a leggere.
	</p>
</div><div class="small">
	<div class="section">
		<p>
			Dunque, vi ho parlato del mio nuovo bouquet di fiori? Forse sì,
			forse no, non ho voglia di andare a controllare...
		</p><p>
			Fatto sta che una volta completato il progetto per il nuovo stelo,
			sono tornato al cartoncino colorato per il modello definitivo.
		</p><p>
			E senza nemmeno tanto impegno, eccomi con un bel mazzolin di fiori.
			E visto che il cartoncino rimane in posizione molto più della
			cartaccia con cui realizzo i modelli di test, son anche riuscito a
			farci stare un fiore in più, un settimo calice infilato in mezzo
			agli altri sei, proprio al centro, senza sovrapporre niente.
		</p><p>
			M'è venuto piuttosto bene; anche i nuovi petali esterni fanno
			un'effetto migliore.
		</p>
	</div><div class="section">
		<p>
			Tuttavia, sono molto meno contento di quanto avrei pensato. E
			pensare che l'ultimo fiore l'ho piegato in bicicletta, mentre
			scendevo per la rampa assieme ai miei allegri compagni (no homo).
		</p><p>
			E l'ho fatto passando via i fisici, che sono grossi (sicuramente più
			di noi) e casinari (ma non quanto noi quando c'impegnamo!) e
			occupano la strada, quindi mi tocca chiedere il permesso, passare
			frenando con una mano e piegando carta con l'altra.
		</p><p>
			Purtroppo, un commissario del Guinness World Record non c'è mai
			quando ne hai bisogno...
		</p>
	</div><div class="section">
		<p>
			Ma il punto rimane sempre lo stesso; ho impiegato molto tempo,
			lavoro e creatività per fare qualcosa di decente che purtroppo, alla
			fine, sembra inutile anche a me che l'ho realizzato.
		</p><p>
			Dove sono finite le soddisfazioni della vita? Dov'è il piacere di
			fare le cose con le proprie mani? L'unico esterno che nota la cosa è
			il <a href="http://www.youtube.com/watch?v=lBdXS2BA3yI">blitz</a>
			(beh, uno che gli somiglia) .
		</p>
	</div><div class="section">
		<p>
			Also, ricordate quel che dicevo delle ragazze che corrono sulla
			ciclabile? Ecco, dopo essere tornato me ne sono andato a correre
			solo per ottenere ulteriori conferme.
		</p><p>
			Ne ho incontrata una (e non una qualsiasi, ma una con la tutina
			integrale e la fascetta) che andava così piano che sarebbe stato
			meglio se fosse comparsa direttamente dietro a me.
		</p><p>
			E le altre... beh, delle altre preferisco non parlare. C'era chi
			camminava e basta, c'era chi a metà percorso si fermava per tornare
			indietro, ce n'è stata persino una che s'è fermata a telefonare ;_;
		</p>
	</div>
</div>
<?php } ?>
