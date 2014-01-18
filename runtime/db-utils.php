<?php

	function get_tag_filename ($tag)
	{
		switch(strlen($tag))
		{
			case 1:
				$target = sprintf('%s.php', $tag[0]);
				break;
			case 2:
				$target = sprintf('%s/%s.php', $tag[0], $tag);
				break;
			default:
				$target = sprintf('%s/%s%s/%s.php', $tag[0], $tag[0], $tag[1], $tag);
				break;
		}
		#printf("Tag[%s] lives in %s\n", $tag, $target);
		return $target;
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

	function include_search_cloud ($attr)
	{
		require_once('db/cloud.php');
		ksort($cloud);
		
		printf ('<div id="cloud"><p>');
		foreach(array_keys($cloud) as $key)
			printf ('%s<span style="%s"><a href="%s?query=%s">%s</a></span>',
				"\n",
				sprintf('font-size: %dpx', 11 + 4*ceil(log($cloud[$key], 2))),
				make_canonical($attr, 'Tag/', false, false),
				$key, ucwords($key));
		printf ('%s</p></div>', "\n");
		return;
	}

	function display_search_result ($attr, $query)
	{
		$result = array();
		$excluded = array();
		
		foreach ($query as $_)
		{
			#printf("<p>Now including tagfile for %s</p>", $_);
			$target_file = 'db/'.get_tag_filename($_);
			if (is_file($target_file)) {
				include($target_file);
				$result[$_] = $tag;
				unset($tag);
			} else $excluded[] = $_;
		}

		if (count($excluded) > 0) {
			printf('<p>%s</p><ul><li>%s</li></ul>',
			'I seguenti tag sono stati esclusi dalla ricerca, in quanto non hanno prodotto alcun risultato.',
			implode('</li><li>', $excluded));
		}

		$limit = count($result);
		$keys = array_keys($result);
		$combine = $result[$keys[0]];
		for ($i = 1; $i < $limit; $i++)
			$combine = array_intersect_key($combine, $result[$keys[$i]]);

		printf('<h3>%s</h3>', implode(' &amp; ', $keys));
		foreach (array_keys($combine) as $_) 
			foreach (array_keys($combine[$_]) as $__)
				printf('<p>%s => %s / %s</p>',
				$combine[$_][$__],
				$_, $__);

		var_dump($result);
	}

	function include_search_result ($attr)
	{
		$result = array();
		$param = get_GET_parameters();
	
		if (count($param) == 0) return;
		if (!isset($param['query'])) return;
		if (strlen($param['query']) == 0) return;

		display_search_result($attr, split('[\ +]', $param['query']));

		foreach (split('[ \+]', $param['query']) as $_)
		{
			$dbfile = 'db/'.get_tag_filename($_);
			if (file_exists($dbfile))
			{
				$tag = array();
				include($dbfile);
				$result[$_] = $tag;
			}
		}

		if (count($result) == 0)
		{
			echo ('<h3 class="reverse">Sorry</h3>');
			echo ('<p>No match found.</p>');
			return;
		}

		foreach(array_keys($result) as $current)
		{
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

	function include_search_static ($attr)
	{
		$limit = func_num_args();
		$args = func_get_args();

		for ($i = 1; $i < $limit; $i++)
			$query[] = $args[$i];
		display_search_result($attr, $query);
		die();

		$tag = array();
		$dbfile = 'db/'.get_tag_filename($tagname);
		#printf("<p>Tag [%s] file [%s]</p>\n", $tagname, $dbfile);
		if (file_exists($dbfile)) include($dbfile);

		echo ('<h3 class="reverse">Risultati per [');
		echo ('<a href="'.make_canonical($attr, '/Tag/', false, false).'?query='.$tagname.'">'.ucwords($tagname).'</a>');
		echo (']:</h3>');
		
		if (count($tag) < 1) {
			echo ('<p>Nessun risultato.</p>');
			return;
		}
		
		echo ('<ul>');
		foreach (array_keys($tag) as $_)
			foreach (array_keys($tag[$_]) as $__)
			{
				if (strcmp($__, 'page') == 0) $tab = false;
				else $tab = $__;
				$href = make_canonical($attr, $_, $tab, false);
				
				echo ('<li><a href="'.$href.'">'.$tag[$_][$__].'</a></li>');
			}
		echo ('</ul>');
	}

?>
