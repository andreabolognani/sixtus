<?php

	function polish_line ($_)
	{
		$_ = preg_replace('/@SHARP@/', '#', $_);
		$_ = preg_replace('/@AT@/', '@', $_);
		$_ = preg_replace('/\'/', '&apos;', $_);
		#$_ = preg_replace('/"/', '&quot;', $_);

		return $_;
	}

	class Parser {
	
		private $pstate = 'meta';

		private $title = '__TITLE__';
		private $subtitle = '__SUBTITLE__';
		private $keywords = '__KEYWORDS__';

		private $prev = array('__PREV_0__', '__PREV_1__');
		private $next = false;

		private $current = null;
		private $body = array();
		private $side = array();

		private $first_tab = true;
		private $default_tab = false;

		public function parse($filename)
		{
			$index = 0;
			$rows = file ($filename, FILE_IGNORE_NEW_LINES);

			foreach ($rows as $_)
			{
				$index++;
				if (preg_match('/^#.*/', $_)) {
					#printf("\tLine#$index is a comment\n");
				} else if (preg_match('/#/', $_)) {
					$fragment = split('#', trim($_));
					if (preg_match('/@/', $fragment[0])) {
						$cmd_attr = split('@', $fragment[0]);
						$command = $cmd_attr[0];
					} else $command = $cmd_attr = $fragment[0];
					switch ($this->pstate) {
						case 'meta':
							$this->parse_meta($index, $command, $cmd_attr, $fragment);
							break;
						case 'side':
							$this->parse_side($index, $command, $cmd_attr, $fragment);
							break;
						case 'body':
							$this->parse_body($index, $command, $cmd_attr, $fragment);
							break;
					}
				} else if ($this->pstate != 'meta') {
					$this->current->parse($index, '', '', array(polish_line($_)));
				}
			}
		}

		private function parse_meta ($lineno, $cmd, $cmd_attr, $cmd_par)
		{
			switch($cmd) {
				case 'title':
					switch(count($cmd_par)){
						case 3:
							$this->subtitle = polish_line($cmd_par[2]);
						case 2:
							$this->title = polish_line($cmd_par[1]);
							break;
					}
					break;
				case 'subtitle':
					$this->subtitle = polish_line($cmd_par[1]);
					break;
				case 'keywords':
					$this->keywords = polish_line($cmd_par[1]);
					break;
				case 'prev':
					$this->prev = array($cmd_par[1], polish_line($cmd_par[2]));
					break;
				case 'next':
					$this->next = array($cmd_par[1], polish_line($cmd_par[2]));
					break;
				case 'start':
					switch($cmd_par[1]) {
						case 'page':
							$this->pstate = 'body';
							$this->current = new Tab();
							break;
						case 'side':
							$this->pstate = 'side';
							$this->current = new Tab();
							break;
					}
					break;
			}
		}

		private function parse_side ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			switch ($cmd) {
				case 'stop':
					$this->pstate = 'meta';
					$this->current->closeTab();
					$this->side[] = $this->current;
					$this->current = null;
					break;
				default:
					$this->current->parse($lineno, $cmd, $cmd_attr, $cmd_args);
			}
		}

		private function parse_body ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			switch ($cmd) {
				case 'stop':
					$this->pstate = 'meta';
					$this->current->closeTab();
					$this->body[] = $this->current;
					$this->current = null;
					break;
				case 'tab':
					if ($this->first_tab) {
						$this->current->setName($cmd_args[1]);
						$this->first_tab = false;
						$this->default_tab = $cmd_args[1];
					} else {
						$this->current->closeTab();
						$this->body[] = $this->current;
						$this->current = new Tab();
						$this->current->setName($cmd_args[1]);
					}
					break;
				default:
					$this->current->parse($lineno, $cmd, $cmd_attr, $cmd_args);
			}
		}

		public function deploy ()
		{
			printf("<?php\n");
			printf("\n");
			printf("\t\$attr['title'] = '$this->title';\n");
			printf("\t\$attr['subtitle'] = '$this->subtitle';\n");
			printf("\t\$attr['keywords'] = '$this->keywords';\n");
			printf("\tif(!\$request['tab']) \$request['tab'] = '$this->default_tab';\n");
			printf("\n");
			if ($this->prev)
				printf("\t\$related['prev'] = array('".$this->prev[0]."', '".$this->prev[1]."');\n");
			else printf("\t\$related['prev'] = false;\n");
			if ($this->next)
				printf("\t\$related['next'] = array('".$this->next[0]."', '".$this->next[1]."');\n");
			else printf("\t\$related['next'] = false;\n");
			printf("\n");
			printf("\trequire_once('sys/fragments/in-before.php');\n");
			printf("?>\n");
			printf("<!--[Body/Start]-->\n");
			$first = true;
			foreach ($this->body as $_) {
				printf("%s", $_->getContent(false, $first)) or print_r($_);
				if ($first) $first = false;
			}
			printf("<!--[Body/Stop]-->\n");
			printf("<?php \n");
			printf("\trequire_once('sys/fragments/in-middle.php');\n");
			printf("?>\n");
			printf("<!--[Side/Start]-->\n");
			foreach ($this->side as $_) printf("%s", $_->getContent(true, false));
			printf("<!--[Side/Stop]-->\n");
			printf("<?php \n");
			printf("\trequire_once('sys/fragments/in-after.php');\n");
			printf("?>\n");
		}
	}
?>
