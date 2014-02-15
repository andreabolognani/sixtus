<?php

	function fail ($message, $file, $line)
	{
		printf("Error: %s, in %2 @%04d\n", $message, $file, $line);
		exit(1);
	}

	function find_include_file ($localdir, $sourcedir, $target)
	{
		if (is_file($target)) return $target;
		
		$tmp = sprintf('%s%s', $localdir, $target);
		if (is_file($tmp)) return $tmp;
		
		$tmp = sprintf('%s%s', $sourcedir, $target);
		if (is_file($tmp)) return $tmp;

		return false;
	}

	function output_on_file ($target, $sourcefile, $content)
	{
		$i = 0;
		
		$current = basename($target);
		$page = basename(dirname($target));
		$location = dirname(dirname($target));
		
		$out[] = sprintf("#### file %s %s %s\n", $location, $page, $current);
		foreach ($sourcefile as $_) $out[] = sprintf("%d %s\n", $i++, $_);
		$out[] = sprintf("####\n");
		foreach($content as $_) $out[] = sprintf("%d %04d %s\n", $_[0], $_[1], $_[2]);

		printf("Now writing %s\n", $target);
		if (file_put_contents($target, $out) === false)
			printf("Something went wrong\n");
	}

	class Splitter {

		private $meta;
		private $body;
		private $ghost;
		private $side;

		private $state;
		private $current;
		private $parsedfiles;

		public function __construct ()
		{
			$this->meta  = array();
			$this->body  = array();
			$this->ghost = array();
			$this->side  = array();

			$this->state = 'meta';
			$this->current = &$this->meta;
			$this->parsedfiles = array();
		}

		private function parse ($target, $indir)
		{
			array_push($this->parsedfiles, $target);
			$fileno = count($this->parsedfiles) - 1;

			$row = file($target);
			foreach (array_keys($row) as $lineno)
			{
				$line = trim($row[$lineno]);

				if (preg_match('/#/', $line))
				{
					$token = split('#', $line);

					switch ($token[0]) {
						case '':
							break;
						case 'stop':
							break;
						case 'start':
							if ($token[1] != 'meta' && $token[1] != 'body'
								&& $token[1] != 'ghost' && $token[1] != 'side')
									fail('Unkown environment '.$token[1], $fileno, $lineno);
							$this->state = $token[1];
							$this->current = &$this->{$token[1]};
							break;
						case 'tab':
							if ($this->state != 'body' && $this->state != 'ghost')
								fail('No tabs allowed in '.$this->state, $fileno, $lineno);
							$this->{$this->state}[$token[1]] = array();
							$this->current = &$this->{$this->state}[$token[1]];
							break;
						case 'include':
							$this->_include($token[1], dirname($target), $indir, $fileno, $lineno);
							break;
						default:
							$this->current[] = array($fileno, $lineno, $line);
					}
				}
				else
				{
					$this->current[] = array($fileno, $lineno, $line);
				}
			}
		}
		
		private function _include ($target, $localdir, $indir, $fileno, $lineno)
		{
			$filename = find_include_file($localdir, $indir, $target);
			
			if ($filename) $this->parse($filename, $indir);
			else fail ('Unable to locate '.$filename, $fileno, $lineno);

		}

		private function dump ($outdir) {

			output_on_file($outdir.'meta.frag', $this->parsedfiles, $this->meta);
			foreach(array_keys($this->body) as $_)
				output_on_file($outdir.'tab-'.$_.'.frag', $this->parsedfiles, $this->body[$_]);
			foreach(array_keys($this->ghost) as $_)
				output_on_file($outdir.'ghost-'.$_.'.frag', $this->parsedfiles, $this->ghost[$_]);
			output_on_file($outdir.'side.frag', $this->parsedfiles, $this->side);
		}

		public function split ($target, $indir, $outdir)
		{
			$this->parse($target, $indir);
			$this->dump($outdir);
		}
	}

	(new Splitter())->split($argv[1], $argv[2], $argv[3]);

?>
