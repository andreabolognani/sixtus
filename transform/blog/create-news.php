<?php

	function dig_posts ($prefix, $year, $month)
	{
		$c = array();
		$target = sprintf('%s%s/%s/c.php', $prefix, $year, $month);

		if (!is_file($target)) 
		{
			printf("Cannot locate [%s]\n", $target);
			exit(1);
		}
		
		require($target);
		return $c;
	}

	function dump_meta($target)
	{
		$out[] = sprintf('#### %d', 1);
		$out[] = sprintf('%d %s', 0, 'AUTOGENERATED by Sixtus 0.9.8');
		$out[] = sprintf('####');

		$out[] = sprintf('%d %04d title#%s#%s', 0, 0, 'Novità', 'Le notizie più recenti');
		$out[] = sprintf('%d %04d next#%s#%s', 0, 0, 'Blog/ARCHIVIO/', 'Archivio');

		file_put_contents($target, implode("\n", $out));
	}

	function dump_content($target, $year, $news)
	{
		$out[] = sprintf('#### %d', 0);
		$out[] = sprintf('%d %s', 0, 'AUTOGENERATED by Sixtus 0.9.8');
		$out[] = sprintf('####');

		$i = 0;
		foreach ($news as $_)
		{
			if ($i++) $out[] = sprintf('%d %04d sec#br', 0, 0);
			$out[] = sprintf('%d %04d require@tab@%s#blog/%s/%s',
				0, 0, $_[2], $_[0], $_[1]);
		}

		file_put_contents($target, implode("\n", $out));
	}

	function dump_side ($target, $year, $sides)
	{
		$out[] = sprintf('#### %d', 0);
		$out[] = sprintf('%d %s', 0, 'AUTOGENERATED by Sixtus 0.9.8');
		$out[] = sprintf('####');

		$i = 0;
		foreach (array_keys($sides) as $year)
			foreach (array_keys($sides[$year]) as $month)
			{
				if ($i++) $out[] = sprintf('%d %04d sec#br', 0, 0);
				$out[] = sprintf('%d %04d require@side#blog/%s/%s', 0, 0, $year, $month);
			}

		file_put_contents($target, implode("\n", $out));
	}

	# Load map
	require_once($argv[1]);

	$i = 0;
	$limit = 15;
	foreach (array_reverse(array_keys($blog_map)) as $year)
		foreach (array_reverse($blog_map[$year]) as $month)
			foreach (dig_posts($argv[2], $year, $month) as $post)
			{
				$news[] = array($year, $month, $post);
				$sides[$year][$month] = true;

				if ($i < $limit) $i++; else break 3;
			}

	dump_meta("$argv[2]meta.frag");
	dump_content("$argv[2]tab-default.frag", $year, $news);
	dump_side("$argv[2]side.frag", $year, $sides);

	exit(0);
?>
