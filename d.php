<?php

	/* Set up configuration */
	$servername = $_SERVER['SERVER_NAME'];
	
	/* Set Admin data */
	$admin['name'] = 'simak';
	$admin['pass'] = '020eb5a55e7b0512016dd9e182312438';

	session_name('lyzid');
	session_start();

	if (isset($_POST['action'])) {
	
		if (strcmp($_POST['action'], 'login') == 0) {
			$name = mysql_real_escape_string ($_POST['name']);
			$pass = mysql_real_escape_string ($_POST['pass']);

			if (strcmp($name, $admin['name']) == 0 &&
			strcmp(md5($pass), $admin['pass']) == 0) {
				$_SESSION['login'] = true;
				$_SESSION['name'] = $name;
			}
		} else if (strcmp($_POST['action'], 'logout') == 0) {
			$_SESSION = array();
			session_destroy();
		}
	}

	session_write_close();
	require_once ('sources.php');
	require_once ('lib/finder.php');
	require_once ('lib/dialog.php');

	if ($servername == 'gods.roundhousecode.com') {
		$base = 'http://gods.roundhousecode.com';
	} else if ($servername == 'tanngrisnir') {
		$base = 'tanngrisnir';
	} else {
		$base = $localbase;
	}

	$request = urldecode(strtolower(substr($_SERVER['REQUEST_URI'], 1)));
	if (isset($localhome) && $request == '') header ('Location: '.$base.$localhome);

	if ((preg_match('/style\/.+/', $request) || preg_match('/extra\/.+/',$request)) && file_exists ($request)) {
		
		if (preg_match('/\.css$/', $request)) {
		
			header ('Content-Type: text/css');
			require_once ($request);
			die ();
		}

		if (preg_match('/\.gif$/', $request)) $mime = 'image/gif';
		else if (preg_match('/\.png$/', $request)) $mime = 'image/png';
		else if (preg_match('/\.jpg$/', $request)) $mime = 'image/jpeg';
		else if (preg_match('/\.ico$/', $request)) $mime = 'image/x-icon';
		else header ('Location: '. $base .'/Not/Found/');

		header ('Content-Type: '. $mime);
		$file = fopen ($request, 'r');
		while (!feof($file)) print(fread($file, 1024*1024));
		fclose($file);
		die ();
	
	} else if (preg_match('/lib\/.*\.js/', $request) && file_exists($request)) {
		header ('Content-Type: text/javascript');
		$file = fopen ($request, 'r');
		while (!feof($file)) print(fread($file, 1024*1024));
		fclose($file);
		die ();
	} else if (preg_match('/rss\.xml/', $request)) {
	
		header ('Content-Type: application/rss+xml');
		$file = fopen ('rss.xml', 'r');
		while (!feof($file)) print(fread($file,1024*1024));
		fclose ($file);
		die ();
	}

	#$token = explode ('/.', $request);
	$token = explode ('/', $request);
	$opt['mode'] = 'Gods';
	$opt['style'] = 'Raw';
	foreach (array_keys($token) as $key) {
	
		switch ($token[$key]) {
			case '':
				#echo ('<p>Empty token!</p>');
				unset($token[$key]);
				break;
			case 'gods':
			case 'bolo':
			case 'luber':
				$opt['mode'] = ucwords($token[$key]);
				#echo ('<p>Mode ['.$opt['mode'].']</p>');
				unset($token[$key]);
				break;
			case 'dado':
			case 'raw':
				$opt['style'] = ucwords($token[$key]);
				#echo ('<p>Style ['.$opt['style'].']</p>');
				unset($token[$key]);
				break;
			case 'debug':
				$opt['debug'] = 'debug';
				#echo ('<p>Debug ['.$opt['debug'].']</p>');
				unset($token[$key]);
				break;
			case 'download':
				$opt['download'] = 'download';
				#echo ('<p>Download ['.$opt['download'].']</p>');
				unset($token[$key]);
				break;
		}
	}

	$token = implode ('/', $token);
	#echo ('<p>Token: ');print_r($token);echo('</p>');
	if (preg_match('/§/', $token)) list($token, $tab['name']) = preg_split ('/§/', $token);
	else $tab['name'] = false;
	#echo ('<p>Token: ');print_r($token);echo('</p>');
	$token = preg_split ('/\//', $token);
	#echo ('<p>Token: ');print_r($token);echo('</p>');

	$finder = new Finder ($sources);
	#echo ($finder->show());

	$search = $finder->find($token);
	$searchpath = $search['destdir'] .'/';

	#echo ('<p>Token: ');print_r($token);echo('</p>');
	#echo ('<p>Category: ');print_r($search['category']);echo('</p>');
	#echo ('<p>Tab[name]: '.$tab['name'].'</p>');

	$self = false;
	foreach ($search['category'] as $category)
		$self .= $category .'/';

	$last = $search['last'];
	if ($last != 'index') {
		$pagename = $last;
		$self .= strtoupper($last).'/';
	}

	$page = $searchpath.$last.'.php';
	$tab['dir'] = $searchpath.$last.'.d/';
	$tab['req'] = substr($self, 0, -1).'§';

	#echo ('<p>Page ['.$page.']</p>');
	#echo ('<p>Self ['.$self.']</p>');
	#echo ('<p>');print_r($tab);echo('</p>');

	if (isset($opt['download'])) {
		$pdfpath = $searchpath . $search['last'] .'.pdf';
		if (file_exists($pdfpath)) {
			header('Content-Type: application/pdf');
			header('Content-Disposition: attachment; filename="'.$search['last'].'.pdf"');
			readfile($pdfpath) or die('Cannot transmit PDF file');
		} else die('File ['. $pdfpath .'] does not exist.');
	}

	if (file_exists($page))
		if ($searchpath) $rside = preg_replace ('/\//', '.', $searchpath .'php');
		else $rside = 'nav.php';
	else {
		$page = 'error404.php';
		$rside = 'nav.php';
	}

	$pages = array (); # Array for page-creatin closures
	$sides = array (); # Array for side-creatin closures
	require_once ($page);
	if ($tab['name'] == false && isset($title[2])) $tab['name'] = $title[2];
	$d = new Dialog($opt, $self, $tab);

	require_once ('tmpl/pager.php');
	die ();

?>
