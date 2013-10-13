<?php

	require_once('utils.php');
	require_once('runtime-utils.php');

	function get_array_from_tagfile ($filename)
	{
		if (file_exists($filename))
		{
			include ($filename);
			return $tag;
		}

		return array();
	}

	function put_tag_into_tagfile ($tagname, $basedir, $data)
	{
		echo("\nPut Tag Into Tagfile ($tagname, $basedir)\n");

		$filename = $basedir.get_filename_from_tag($tagname);
		$formerlist = get_array_from_tagfile($filename);
		$newlist = $formerlist;

		foreach (array_keys($data) as $_)
			foreach ($data[$_] as $__)
				$newlist[$__[0]][$_] = $__[1];

		print_r($newlist);
		$to_file = '<'.'?php'."\n";
		foreach(array_keys($newlist) as $_)
			foreach(array_keys($newlist[$_]) as $__)
				$to_file .= "\t\$tag['$_']['$__'] = '".$newlist[$_][$__]."';\n";
		$to_file .= '?'.'>';
		echo ($to_file);
		if (!file_exists(dirname($filename))) mkdir(dirname($filename), 0777, true);
		file_put_contents($filename, $to_file);
		return;
		
		foreach (array_keys($pagetitle) as $_)
		{
			if (strcmp($_, 'page') == 0) $key = $pagename;
			else $key = substr($pagename, 0, -1).'§'.$_.'/';
			#echo ("\n\t\$tag['$pagename']['$_'] = '$pagetitle[$_]';");
			$newlist[$pagename][$_] = $pagetitle[$_];
		}

		#echo("\n -- New List\n");
		#print_r($newlist);

		$to_file = '<'.'?php';
		foreach (array_keys($newlist) as $_)
			foreach (array_keys($newlist[$_]) as $__)
				$to_file .= "\n\t\$tag['$_']['$__'] = '".$newlist[$_][$__]."';";
		$to_file .= "\n".'?'.'>';

		if (!file_exists(dirname($filename))) mkdir(dirname($filename), 0777, true);
		echo ($to_file);
		echo ("\n\n To $filename");
		file_put_contents($filename, $to_file);
	}

	print_r($argv);

	$taglist = array();
	$rows = make_lines_from_file($argv[3]);
	$base = dirname($argv[3]);
	$pagetitle = false;
	$environment = 'page';

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', strtolower($_));
			array_shift($result);
			foreach ($result as $r) $taglist[$environment][$r] = true;
		}
		else if (preg_match('/title#/', $_))
		{
			$result = split('#', $_)[1];
			$result = str_replace('\'', '&apos;', $result);
			if (!isset($pagetitle[$environment]))
				$pagetitle[$environment] = $result;
		}
		else if (preg_match('/stop#/', $_))
			$environment = 'page';
		else if (preg_match('/tab#/', $_))
			$environment = split('#', $_)[1];
	}

	if (file_exists($argv[5])) include($argv[5]);
	else $rmap = array();
	
	$current_file = str_replace($argv[1], '', $argv[3]);
	$current_page = str_replace('.lyz', '', $current_file);
	$current_page = str_replace('.pag', '', $current_page);
	$current_page = str_replace('/index', '', $current_page);
	#echo ("Current [$current_page]");
	if (isset($rmap[$current_page])) $canonical_name = $rmap[$current_page];
	else {
		$index = strrpos($current_page, '/');
		$current_category = substr($current_page, 0, $index);
		$current_name = substr($current_page, $index + 1);
		$canonical_name = $rmap[$current_category].strtoupper($current_name).'/';
	}
	#echo (", Canonical [$canonical_name]\n");

	$to_file = '<'.'?php';
	foreach (array_keys($pagetitle) as $_)
		$to_file .= "\n\t\$pagetitle['$_']='$pagetitle[$_]';";
	foreach (array_keys($taglist) as $_)
		foreach (array_keys($taglist[$_]) as $__)
	{
		$to_file .= "\n\t";
		$to_file .=
		'$tag[\''.$canonical_name.'\'][\''.$_.'\'][\''.ucwords($__).'\'] = '.$taglist[$_][$__].';';
	}
	$to_file .= "\n".'?'.'>';

	echo ($to_file);
	file_put_contents($argv[4], $to_file);

	echo ("Now reversing…\n");
	foreach (array_keys($taglist) as $_)
		foreach (array_keys($taglist[$_]) as $__)
		{
			$current_tag = $__;
			$current_tab = $_;
			$current_title = $pagetitle[$_];
			$rtmap[$current_tag][$current_tab][] = array($canonical_name, $current_title);
		}
	print_r($rtmap);
	echo ("Done.\n");

	foreach (array_keys($rtmap) as $_)
		put_tag_into_tagfile ($_, $argv[2], $rtmap[$_]);
	die();
?>
