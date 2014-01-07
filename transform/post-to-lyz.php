<?php

	require_once('utils.php');

	$day     = 0;
	$month   = 0;
	$year    = 0;
	$current = array();

	$in_rows = make_lines_from_file($argv[1]);

	foreach ($in_rows as $_)
	{
		if (preg_match('/blog#/', $_))
		{
			list($_, $year, $month) = split('#', $_);
		}
		else if (preg_match('/post#/', $_))
		{
			if (count($current) > 0) $out_rows[$day][] = $current;
			list($_, $day, $title) = split('#', $_);
			$current = array();
			$current['title'] = $title;
		}
		else $current['content'][] = $_;
	}

	if (count($current) > 0) $out_rows[$day][] = $current;

	####

	foreach (array_keys($out_rows) as $day)
	{
		$count = count($out_rows[$day]);

		if ($count > 1)
			for ($i = 0; $i < $count; $i++)
				$out_rows[$day][$i]['tab'] = sprintf('%02d%c', $day, 96 + $count - $i);
		else $out_rows[$day][0]['tab'] = sprintf("%02d", $day);
	}

	####

	function name_that_month($month)
	{
		switch($month % 12)
		{
			case  1: return 'Gennaio';   break;
			case  2: return 'Febbraio';  break;
			case  3: return 'Marzo';     break;
			case  4: return 'Aprile';    break;
			case  5: return 'Maggio';    break;
			case  6: return 'Giugno';    break;
			case  7: return 'Luglio';    break;
			case  8: return 'Agosto';    break;
			case  9: return 'Settembre'; break;
			case 10: return 'Ottobre';   break;
			case 11: return 'Novembre';  break;
			case  0: return 'Dicembre';  break;
		}
	}

	function prev_year($month, $year)
	{
		if ($month == 1) return $year - 1;
		return $year;
	}

	function next_year($month, $year)
	{
		if ($month == 12) return $year + 1;
		return $year;
	}

	ksort($out_rows);
	$out_rows = array_reverse($out_rows, true);
	printf("title#%s#%s %s\n", $year, name_that_month($month), $year);
	printf("prev#Blog/%s/%s/#%s@ %s\n",
		$year, $month, name_that_month($month - 1), prev_year($month, $year));
	printf("next#Blog/%s/%s/#%s@ %s\n",
		$year, $month, name_that_month($month + 1), next_year($month, $year));
	printf("tabs#all_or_one\n");
	printf("start#page\n");

	foreach (array_keys($out_rows) as $day)
	{
		$posts = $out_rows[$day];
		
		foreach ($posts as $post)
		{
			printf("tab#%s\n", $post['tab']);
			printf("\tp#link#Blog/%s/%s/#<em>@%02d/%s/%s@</em>#%s\n",
				$year, $month, $day, $month, $year, $post['tab']);
			printf("\ttitle#%s\n", $title);

			if (isset($post['content'])) foreach ($post['content'] as $line) printf("%s\n", $line);
		}
	}

	printf("stop#page\n");
	printf("start#side\n");
	printf("\tstitle#link#Blog/%s/%s/#%s@ %s\n",
		$year, $month, name_that_month($month), $year);
	
	foreach (array_keys($out_rows) as $day)
	{
		$posts = $out_rows[$day];
		$first = true;
		$count = count($posts);

		printf("\tp#<code>%02d/%s</code> –\n", $day, $month);

		for ($i = 0; $i < $count; $i++)
		{
			$post = $posts[$count - $i - 1];
			
			if ($first) $first = false;
			else printf("\t\t&amp;\n");
			printf("\t\tlink#Blog/%s/%s/#%s#%s\n",
				$year, $month, $post['title'], $post['tab']);
		}
	}

	printf("stop#side\n");
?>
