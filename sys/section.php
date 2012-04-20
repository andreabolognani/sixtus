<?php
	class Section {
	
		private $d;

		private $isText;
		private $isPre;
		private $content;
		private $opt;
		
		private $stack;
		private $counter;

		private $prepared;
		private $isPrepared;

		public function __construct ($d) {
			$this->d = $d;

			$this->isText = false;
			$this->isPre = false;
			$this->content = array();

			$this->stack = array (false);
			$this->counter = 0;
		}

		public function isEmpty () {
			if ($this->content) return count($this->content) == 0;
			return true;
		}

		private function recursive ($lineno, $args) {
				
			if (count($args) > 2) {
				array_shift($args);
				$this->parseLine ($lineno, $args[0], $args);
			} else $this->parseLine ($lineno, false, $args);
		}

		public function parseLine ($lineno, $cmd, $args) {

			if (strpos($cmd, '@')) {
				$frag = split ('@', $cmd);
				$cmd = $frag[0];
				array_shift($frag);
			}

			switch ($cmd) {
				case '':
					$text = trim($args[1]);
					if ($text) {
						$this->mkText($lineno);
						if (preg_match('/^\\>.*$/', $text)) {
							$this->mkLine('<span class="green">'.$text.'</span>');
						} else {
							$this->mkLine("\t\t\t\t$text");
						}
					} else {
						$this->unmkText($lineno);
					}
					break;
				case 'p':
				case 'li':
					$this->unmkText($lineno);
					$this->mkText($lineno);
					$this->recursive($lineno, $args);
					break;
				case 'reverse':
					$this->unmkText($lineno);
					$this->mkText($lineno, ' class="reverse"');
					$this->isText = true;
					if ($args[1]) $this->recursive ($lineno, $args[1]);
					break;
				case 'id':
					$this->unmkText($lineno);
					$this->mkLine("\t\t\t".'<a id="'.ucwords($args[1]).'"></a>');
					break;
				case 'br':
					$this->unmkText($lineno);
					$this->mkline("\t\t\t<br />");
					break;
				case 'clear':
					$this->unmkText($lineno);
					switch ($args[1]) {
						case 'both':
						case 'left':
						case 'right':
							$this->mkline('<div style="clear:'.$args[1].'"></div>');
							break;
						default:
							die ('Secton->Cannot clear ['.$args[1].']');
					}
					break;
				case 'pre':
					$this->mkLine($args[1]);
					#$this->content .= $args[1];
					break;
				case 'title':
					$this->unmkText($lineno);
					if (isset($frag) && strcmp($frag[0], 'right') == 0)
						$header = 'h2 class="reverse"';
					else $header = 'h2';
					$this->mkLine("\t\t\t<$header>$args[1]</h2>");
					break;
				case 'titler':
					$this->unmkText($lineno);
					$this->mkline("\t\t\t<h2 class=\"reverse\">$args[1]</h2>");
					break;
				case 'stitle':
					$this->unmkText($lineno);
					if (isset($frag) && strcmp($frag[0], 'right') == 0)
						$header = 'h3 class="reverse"';
					else $header = 'h3';
					if (count($args) > 2) {
						$this->mkLine("\t\t\t<$header>");
						$this->recursive($lineno, $args);
						$this->mkLine("\t\t\t</h3>");
					} else $this->mkline("\t\t\t<$header>$args[1]</h3>"); 
					$this->isText = false;
					break;
				case 'link':
				case 'mklink':
					$this->mkLine("\t\t\t\t".$this->mklink ($lineno, $args));
					break;
				case 'tid':
				case 'mktid':
					$this->content[] = array('tid', $lineno, $args);
					break;
				case 'speak':
					$this->unmkText($lineno);
					$this->mkLine("\t\t\t\t<p>".$this->mkinline($lineno, $args).'</p>');
					break;
				case 'inline':
					$this->mkText($lineno);
					$this->mkLine("\t\t\t\t".$this->mkinline($lineno, $args));
					break;
				case 'foto':
				case 'img':
					$this->unmkText($lineno);
					$this->mkLine("\t\t\t".$this->mkfoto($args));
					break;
				case 'begin':
					$this->mkBegin($lineno, $cmd, $args);
					break;
				case 'end':
					$this->mkEnd($lineno, $cmd, $args);
					break;

				default: die ('Section: Unknown command ['.$cmd.'] @'.$lineno);
			}
		}

		private function pushEnv ($env) { $this->stack[++$this->counter] = $env; }

		private function popEnv () { $this->counter--; }

		private function currentEnv () { return $this->stack[$this->counter]; }

		private function mkText ($lineno, $opt=false) {
			
			if ($this->isText) return;
			
			switch ($this->currentEnv()) {
				case 'ol':
				case 'ul':
					#if ($opt) $this->content .= "\t\t\t<li $opt>\n";
					#else $this->content .= "\t\t\t<li>\n";
					if ($opt) $this->mkLine ("\t\t\t<li $opt>");
					else $this->mkLine ("\t\t\t<li>");
					break;	
				case '':
				case 'double':
				case 'triple':
				case 'mini':
				case 'half':
				case 'inside':
				case 'outside':
					#if ($opt) $this->content .= "\t\t\t<p $opt>\n";
					#else $this->content .= "\t\t\t<p>\n";
					if ($opt) $this->mkLine ("\t\t\t<p $opt>");
					else $this->mkLine ("\t\t\t<p>");
					break;
				default:
					die ('Section->mkText: unknown env ['.$this->currentEnv().'] @'.$lineno);
			}
			$this->isText = true;
		}

		private function unmkText ($lineno) {
			if ($this->isText) {
				switch ($this->currentEnv()) {
					case 'ol':
					case 'ul':
						$result = "\t\t\t</li>"; break;
					case '':
					case 'double':
					case 'triple':
					case 'mini':
					case 'half':
					case 'inside':
					case 'outside':
						$result = "\t\t\t</p>"; break;
					default:
						die ('Section->unmkText: unknown env ['.$this->currentEnv().'] @'.$lineno);
				}
				$this->mkline($result);
			}
			$this->isText = false;
		}

		private function mkline ($line) { $this->content[] = $line; }

		private function mkBegin ($lineno, $cmd, $args) {
			list($env, $tag) = $this->mkOpenTag($lineno, $args[1]);
			switch ($env) {
				case 'mini':
				case 'half':
				case 'double':
				case 'triple':
				case 'ol':
				case 'ul':
				case 'inside':
				case 'outside':
					$this->unmkText($lineno); $this->mkline($tag); break;
				default: die ('Section->mkBegin: Unknown environment ['.$env.'] BEGIN @'.$lineno);
			}
			$this->pushEnv($env);
		}

		private function mkEnd ($lineno, $cmd, $args) {
			list($env, $tag) = $this->mkCloseTag($lineno, $args[1]);
			switch ($env) {
				case 'mini':
				case 'half':
				case 'double':
				case 'triple':
				case 'ol':
				case 'ul':
				case 'inside':
				case 'outside':
					$current = $this->currentEnv();
					if (strcmp($env, $current) == 0) {
						$this->unmkText($lineno);
						$this->mkline($tag);
					} else die ("Cannot close $env before $current @$lineno");
					break;
				default: die ("Section->mkEnd: Unknown environment [$env] @$lineno");
			}
			$this->popEnv();	
		}

		private function mkOpenTag ($lineno, $composite) {
			
			if (strpos($composite, '@')) {
				$frag = split ('@', $composite);
				$env = $frag[0];
			} else $env = $composite;

			switch ($env) {
				case 'mini':
					$result = array ($env, "\t\t<div class=\"mini-$frag[1]\">");
					break;
				case 'half':
					$result = array ($env, "\t\t<div class=\"half-$frag[1]\">");
					break;
				case 'double':
					$result = array ($env, "\t\t<div class=\"doublecol\">");
					break;
				case 'triple':
					$result = array ($env, "\t\t<div class=\"triplecol\">");
					break;
				case 'inside':
				case 'outside':
					$result = array ($env, "\t\t<div class=\"$env\">");
					break;
				case 'ol':
				case 'ul':
					$opts = false;
					if (isset($frag)) switch (count ($frag)) {
						case 5: $opts .= ' '.$frag[3].'="'.$frag[4].'"';
						case 3: $opts .= ' '.$frag[1].'="'.$frag[2].'"';
						case 1: 
							$result = array ($env, "\t\t<$env $opts>");
							break;
						default: die ('Section->mkOpenTag: cannot handle '.count($frag). ' options @'.$lineno);
					} else $result = array ($composite, "\t\t<$composite>");
					break;
				default:
					die ('Section->mkOpenTag: unknown environment ['.$env.'] @'.$lineno);
			}

			return $result;
		}

		private function mkCloseTag ($lineno, $args) {
			switch ($args) {
				case 'ol':
				case 'ul':
					return array ($args, "\t\t</$args>");
				case '':
				case 'mini':
				case 'half':
				case 'double':
				case 'triple':
				case 'inside':
				case 'outside':
					return array ($args, "\t\t</div>");
			}
		}

		public function addInclude ($parser, $part, $asContent) {

			$this->mkLine ("\t<!-- Including [$part] as [$asContent] -->");
			$this->content[] = array ('include', $parser, $part, $asContent);
			return;
		}

		public function prepare () {
		
			if ($this->isPrepared) return;
			$this->isPrepared = true;
			$this->unmkText('Section->prepare');
			foreach ($this->content as $line) {
				if (is_array($line)) switch ($line[0]) {
					case 'tid':
						$this->prepared .= $this->mktid($line[1], $line[2]);
						break;
					case 'include':
						$line[1]->prepare();
						switch ($line[2]) {
							case 'side':
								$this->prepared .= $line[1]->getSide($line[3]);
								break;
							case 'page':
								$this->prepared .= $line[1]->getAllTabs($line[3]);
								break;
							default:
								$this->prepared .= $line[1]->getTab($line[2], $line[3]);
						}
						break;
					default:
						die ('WTF happened!?!? '.$line[0].' @'.$lineno);
				} else $this->prepared .= $line."\n";
			}
		}

		public function getContent ($asContent) {
			$this->unmkText('section->getContent');
			if ($this->content) {

				$result = "\t\t".'<!-- Section as ('.($asContent?'Content':'Section').') -->'."\n";
				
				if ($asContent) {
					$result .= $this->prepared;
				} else {
					$result .= "\n\t\t<div class=\"section\">\n";
					$result .= $this->prepared;
					$result .= "\t\t</div>\n";
				}

				return $result;
			} else return "\n\t<!-- Empty Section -->";
		}

		private function mktid ($lineno, $args) {
			switch (count($args)) {
				case 3: return $this->d->mktid($args[1], $args[2]);
				case 4: return $this->d->mktid($args[1], $args[2], $args[3]);
				case 5: return $this->d->mktid($args[1], $args[2], $args[3], $args[4]);
				default: print_r ($args); die ('Y U NO MKTID? @'.$lineno);
			}
		}

		public function mklink ($lineno, $args) {
			switch (count($args)) {
				case 3: return $this->d->link($args[1], $args[2]);
				case 4: return $this->d->link($args[1], $args[2], $args[3]);
				case 5: return $this->d->link($args[1], $args[2], $args[3], $args[4]);
				case 6: return $this->d->link($args[1], $args[2], $args[3], $args[4], null, $args[5]);
				case 7: return $this->d->link($args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
				default: print_r ($args); die ('Y U NO LINK? @'.$lineno);
			}
		}

		private function mkinline ($lineno, $args) {
			switch (count($args)) {
				case 3: return $this->d->inline($args[1], $args[2]);
				case 4: return $this->d->inline($args[1], $args[2], $args[3]);
				default: print_r ($args); die ('Y U NO INLINE? @'.$lineno);
			}
		}
					
		private function mkfoto ($frag) {

			if (count($frag) > 2) {
				$src = $frag[1];
				$ref = $frag[2];
			} else {
				$src = $ref = $frag[1];
			}

			$result = '<p class="foto"><a target="_blank" href="'.$ref.'">';
			$result .= '<img src="'.$src.'" />';
			$result .= '</a></p>';
			return $result;
		}
	}
?>
