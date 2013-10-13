<?php

	function make_canonical ($attr, $url, $tab=false, $hash=false)
	{
		if ($tab) $result = substr($url, 0, -1).'§'.strtoupper($tab).'/';
		else $result = $url;
		if (!$attr['gray']) $result .= 'White/';
		if (!$attr['single']) $result .= 'All/';
		if ($hash) $result .= '#'.$hash;
		return $result;
	}
	
	function make_tid($attr, $title, $tab, $hash)
	{
		$url = false;
		
		if ($attr['single'] && !$attr['force_all_tabs']) {
			if ($attr['current'] == $tab) {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
			} else {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
				else $url = make_canonical ($attr, $attr['self'], $tab);
			}
		} else {
			$url = make_canonical ($attr, $attr['self'], false, strtoupper($tab));
		}
		
		if ($url) return '<a href="'.$url.'">'.$title.'</a>';
		return '<em>'.$title.'</em>';
	}

	function make_next($attr, $name)
	{
		$result = '<div class="section"><p class="reverse">';
		$result .= 'Continua nel '.make_tid($attr, 'prossimo', $name, false).' tab.';
		$result .= '</p></div>';
		
		return $result;
	}

	function make_prev($attr, $name)
	{
		$result = '<div class="section"><p>';
		$result .= 'Continua dal tab '.make_tid($attr, 'precendente', $name, false).'.';
		$result .= '</p></div>';
		
		return $result;
	}

	function dynamic_include ($attr, $filename, $part, $sections)
	{
		$attr['included'] = true;
		$attr['sections'] = $sections;
	
		switch($part)
		{
			case '':
			case 'page':
				$attr['part'] = 'page';
				$attr['force_all_tabs'] = true;
				break;
			case 'side':
				$attr['part'] = 'side';
				$attr['force_all_tabs'] = false;
				break;
			default:
				$attr['part'] = $part;
				$attr['force_all_tabs'] = false;
		}

		require($filename);	
	}

	function tab_condition ($attr, $name)
	{
		if ($attr['included'])
			return $attr['part'] == 'page' or
					$attr['part'] == $name;
		else
			return !$attr['single'] or
					$attr['part'] == $name or
					($attr['part'] == false and $attr['all_or_one']) or
					$attr['force_all_tabs'];
	}

	function side_condition ($attr)
	{
		if ($attr['included']) return $attr['part'] == 'side';
		else return true;
	}

	function tabrel_condition ($attr)
	{
		return $attr['single'] && !$attr['included'] && !$attr['all_or_one'];
	}

	function include_search_form ()
	{
		echo ('<input type="text" name="query" value="" placeholder="Search" />');
	}

	function get_GET_parameters ()
	{
		$query = urldecode(strtolower($_SERVER['REQUEST_URI']));
		$index = strpos($query, '?');
		$query = substr($query, $index + 1);

		foreach (split('&', $query) as $_)
		{
			$param = split('=', $_);

			if (count($param) == 1) $data[$param[0]] = $param[0];
			else $data[$param[0]] = $param[1];
		}

		return $data;
	}

	function get_filename_from_tag ($tagname)
	{
		$tagname = strtolower($tagname);
		
		if (strlen($tagname) == 1) return $tagname[0].'/'.$tagname.'.tag';
		else return $tagname[0].'/'.$tagname[0].$tagname[1].'/'.$tagname.'.tag';
	}

	function count_tags ($filename)
	{
		echo ("<p>[$filename]</p><br/>");
		$rows = file($filename);
		foreach($rows as $row) echo ("<p>$row</p>");
		
		include ($filename);
		//print_r($tag);
		return count($tag);
	}
	
	function include_search_cloud ($attr)
	{
		include('.cloud.php');
		echo ('<div id="cloud"><p>');
		ksort($cloud);
		foreach(array_keys($cloud) as $key)
		{
			$size = 12 + 4*floor(log($cloud[$key], 2));
			$style = 'font-size: '.$size.'px';
			echo ("\n<span style=\"$style\"><a href=\"");
			echo make_canonical($attr, 'Tag/?query='.$key, false, false);
			#echo ('">'.ucwords($key).'['.$cloud[$key].']</a></span>');
			echo ('">'.ucwords($key).'</a></span>');
		}
		echo ('</p></div>');
		return;
		
		$collection = array();
		$dir = scandir('.tagdb');
		array_shift($dir);
		array_shift($dir);

		#echo ('<p>');
		#print_r($dir);
		#echo ('</p>');

		foreach($dir as $_)
		{
			$ddir = scandir(".tagdb/$_");
			array_shift($ddir);
			array_shift($ddir);
			foreach($ddir as $__)
			{
				$filename = ".tagdb/$_/$__";
				if (is_file($filename)) $collection[] = $__;
				else {
					$dddir = scandir($filename);
					array_shift($dddir);
					array_shift($dddir);
					foreach($dddir as $___) $collection[] = $___;
				}
			}
		}

		#echo ('<p>');
		#print_r($collection);
		#echo ('</p>');

		foreach ($collection as $_)
		{
			$tagname = substr($_, 0, -4);
			$tagfile = get_filename_from_tag($tagname);
			//echo ("<p>Tagname[$tagname] → Tagfile[$tagfile], from [".getcwd()."]</p>");
			$weight[$tagname] = count_tags(".tagdb/$tagfile");
		}

		echo ('<p>');
		print_r($weight);
		echo ('</p>');
	}

	function include_search_result ($attr)
	{
		$result = array();
		$param = get_GET_parameters();
	
		#echo ("<p>");
		#print_r ($param);
		#echo ("</p>");

		if (count($param) == 0) return;
		if (!isset($param['query'])) return;
		if (strlen($param['query']) == 0) return;

		foreach (split('[ \+]', $param['query']) as $_)
		{
			$dbfile = '.db/'.get_filename_from_tag ($_);
			#echo ("<p>Now opening [$dbfile], ".getcwd()."</p>");
			if (file_exists($dbfile))
			{
				$tag = array();
				include($dbfile);
				$result[$_] = $tag;
			} #else echo ('<p>['.$dbfile.']: 404 no such file.</p>');
		}

		if (count($result) == 0)
		{
			echo ('<h3 class="reverse">Sorry</h3>');
			echo ('<p>No match found.</p>');
			return;
		}

		echo ('<p>Results:');
		print_r($result);
		echo ('</p>');

		#foreach(array_keys($result) as $_)
		foreach(array_keys($result) as $current)
		{
			#$current = array_keys($_)[0];
			echo ('<h3 class="reverse">Risultati per [');
			echo ('<a href="'.make_canonical($attr, '/Tag/', false,
			false).'?query='.$current.'">'.ucwords($current).'</a>');
			echo(']:</h3><ul>');
			foreach (array_keys($result[$current]) as $_)
				foreach (array_keys($result[$current][$_]) as $__)
				{
					if (strcmp($__, 'page') == 0) $tab = false;
					else $tab = $__;
					$href = make_canonical($attr, $_, $tab, false);
					
					echo ('<li><a href="'.$href.'">'.$result[$current][$_][$__].'</a></li>');
				}
			echo ('</ul>');
		}
	}
?>
