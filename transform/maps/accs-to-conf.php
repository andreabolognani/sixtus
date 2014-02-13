<?php

	function fail($message)
	{
		printf("%s\n", $message);
		exit(1);
	}

	function load_content($filename)
	{
		require_once($filename);

		if (!isset($homepage)) fail('$Homepage is not defined.');
		if (!isset($style)) fail('$Style is not defined.');

		$result['homepage'] = $homepage;
		$result['style'] = $style;
		$result['server'] = $server;

		return $result;
	}

	$data = load_content($argv[1]);

	$to_file[] = sprintf("%s%s\n\n", '<', '?php');
	$to_file[] = sprintf("\t%s = '%s';\n",
		'$runtime[\'home\']', $data['homepage']);

	$to_file[] = sprintf("\t%s = array(", '$style');
	for ($i = 0; $i < count($data['style']); $i++)
		if ($i > 0) $to_file[] = sprintf(", '%s'", $data['style'][$i]);
		else $to_file[] = sprintf("'%s'", $data['style'][$i]);
	$to_file[] = sprintf(");\n");

	foreach (array_keys($data['server']) as $_)
		foreach (array_keys($data['server'][$_]) as $__)
			$to_file[] = sprintf("\t%s['%s']['%s'] = '%s';\n",
				'$server', $_, $__, $data['server'][$_][$__]);

	$to_file[] = sprintf("\n%s%s\n", '?', '>');

	file_put_contents($argv[2], $to_file);
	exit(0);

?>
