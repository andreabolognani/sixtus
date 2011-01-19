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

	if ($servername == 'localhost') {
		$base = 'http://localhost/faiv';
	} else if ($servername == 'trunaluten.99k.org') {
		$base = 'http://trunaluten.99k.org';
	} else if ($servername == 'drachlyznardh.altervista.org') {
		$base = 'http://drachlyznardh.altervista.org';
	}

	$request = substr($_SERVER['REQUEST_URI'], 1);
	if (preg_match ('/faiv\//', $request))
		$request = preg_replace ('/faiv\/(.*)/', '$1', $request);
	if ($request == '')
		header ('Location: '.$base.'/Home/');

	if (preg_match('/style/', $request) && file_exists ($request)) {
		
		if (preg_match('/\.css$/', $request)) {
		
			header ('Content-Type: text/css');
			require_once ($request);
			die ();
		}

		if (preg_match('/\.gif$/', $request)) $mime = 'image/gif';
		else if (preg_match('/\.png$/', $request)) $mime = 'image/png';
		else if (preg_match('/\.ico$/', $request)) $mime = 'image/x-icon';
		else header ('Location: '. $base .'/Not/Found/');

		header ('Content-Type: '. $mime);
		#header ('Content-Type: text/html');
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

	$token = explode ('/', $request);
	$voption = array ('debug','complete','bounce','download','dynamic');
	$opt = array ();
	foreach (array_keys($token) as $key) {
		foreach ($voption as $option)
		if ($token[$key] == '') {
			unset ($token[$key]);
			break;
		} else if ($token[$key] == $option) {
			$opt[$option] = $option;
			unset ($token[$key]);
			break;
		} 
	}
	$parsed = strtolower(implode('/', $token).'/');

	$cats = array (
		'/tru\/naluten\//' => array ('tru/', 'tru/primo/', 'tru/secondo/'),
		'/nanowrimo\/corvino\/multicolore\//' => array ('nano/corvino/'),
		'/storie\/2010\//' => array ('str/2010/'),
		'/storie\/2011\//' => array ('str/2011/'),
		'/storie\//' => array ('str/', 'str/2010/', 'str/2011/')
	);
	
	$section = false;
	$location = false;
	$file = false;
	$srcdir = array ();
	$include = '';

	foreach (array_keys($cats) as $key) {
		if (preg_match($key, $parsed)) {
			$location = preg_replace('/\//', '', $key);
			$section = ucfirst(preg_replace('/\\\/',' ',$location));
			$file = strtolower(substr(preg_replace($key, '', $parsed), 0, -1));
			$srcdir = $cats[$key];
			break;
		}
	}
	if ($file == '') $file = 'index';
	foreach ($srcdir as $dir) {
		if (file_exists($dir.$file.'.php')) {
			$include = $dir.$file.'.php';
			$rside = preg_replace ('/\//','.',$dir).'php';
			break;
		}
	}

	require_once ('lib/dialog.php');

	if (isset($opt['download'])) {
		 
		$path = preg_replace ('/\.php/', '.pdf', $file);
		if (file_exists ($path)) {
			header ('Content-Type: application/pdf');
			header ('Content-Disposition: attachment; filename='.$file.'.pdf');
			
			$file = fopen ($path, 'r');

			if ($file) {
				while (!feof($file)) print(fread($file, 1024*1024));
				fclose ($file);
				die ();
			} else $file = 'error404.php';
			die();
		} else $file = 'error404.php';

	}
	
	$d = new Dialog(isset($opt['bounce']), $section, $opt);

	if (isset ($opt['dynamic'])) {
	
		list($folder, $file) = explode('/', $file);
		$path = $srcdir[0].$folder .'.d/'. $file .'.php';
		if (file_exists($path)) include ($path);
		else include ('frag404.php');
		die ();
	}

	require_once ($include);
	require_once ('tmpl/pager.php');
	die ();

?>
