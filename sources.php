<?php
	$conf['home'] = '/News/';
	$conf['mimes'] = array (
		'css' => 'text/css',
		'js' => 'text/javascript',
		'xml' => 'text/xml',

		'jpg' => 'image/jpeg',
		'png' => 'image/png',
		'gif' => 'image/gif',
		'ico' => 'x-icon',

		'rss' => 'application/rss+xml',
		'pdf' => 'application/pdf'
	);

	$sources = array (
		'Storie' => array ('str',
			'Gaem' => 'str/gaem',
			'2010' => 'str/2010',
			'2011' => 'str/2011',
			'2012' => 'str/2012'),
		'News' => array ('new',
			'2011' => 'new/2011',
			'2012' => 'new/2012'),
		'Recensioni' => array ('review',
			'Film' => array ('review/film',
				'Brutti' => 'review/brutti'),
			'Libri' => 'review/book',
			'Giochi' => 'review/game',
			'Show' => 'review/show',
			'Kamen' => array ('review/kr',
				'Rider' => 'review/kr')),
		'Extra' => array ('extra',
			'Rampa' => 'extra/rampa'),
		'NaNoWriMo' => array ('nano',
			'Corvino' => array ('nano/corvino',
				'MultiColore' => 'nano/corvino'),
			'2010' => 'nano/2010',
			'2011' => 'nano/2011'),
		'Tru' => array ('tru',
			'Naluten' => array ('tru',
				'Vol.I' => 'tru/primo',
				'Vol.II' => 'tru/secondo',
				'Vol.III' => 'tru/terzo')),
		'Legend' => 'legend'
	);
?>
