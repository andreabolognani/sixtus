<?php
	class Section {
	
		private $d;

		private $isText;
		private $isPre;
		private $content;

		public function __construct ($d) {
			$this->d = $d;

			$this->isText = false;
			$this->isPre = false;
			$this->content = false;
		}

		public function parseLine ($lineno, $cmd, $content) {

			switch ($cmd) {
				case '':
					if ($content)
						$this->content .= $this->openp().$content;
					else
						$this->content .= $this->closep();
					break;
				case 'br':
					$this->content .= $this->closeP().'<br />'; break;
				case 'title':
					$this->content .= $this->closeP().'<h2>'.$content.'</h2>'; break;
				case 'titler':
					$this->content .= $this->closeP().'<h2 class="reverse">'.$content.'</h2>'; break;
				case 'mklink':
					$this->content .= $this->mklink ($content); break;
				case 'mktid':
					$this->content .= $this->mktid ($content); break;
				case 'speak':
					$this->content .= $this->closeP().$this->mkspeak($content); break;
				case 'inline':
					$this->content .= $this->openP().$this->mkinline($content); break;
					
				case 'begin':
					switch (strtolower($content)) {
						case 'inside':
						case 'outside':
							$this->content .= $this->closeP().'<div class="'.$content.'">'; break;
						case 'pre':
							$this->isPre = true;
							$this->content .= $this->closeP(); break;
						default: die ('Section: Unknown environment ['.$content.'] BEGIN @'.$lineno);
					}
					break;
				case 'end':
					switch (strtolower($content)) {
						case 'inside':
						case 'outside':
							$this->content .= $this->closeP().'</div>'; break;
						case 'pre':
							$this->isPre = false; break;
						default: die ('Section: Unknown environment ['.$content.'] END @'.$lineno);
					}
					break;

				default: die ('Section: Unknown command ['.$cmd.'] @'.$lineno);
			}
			$this->content .= "\n";
		}

		private function openP() {
			if ($this->isText) return '';
			$this->isText = true;
			return '<p>';
		}

		private function closeP() {
			if (!$this->isText) return '';
			$this->isText = false;
			return '</p>'."\n";
		}

		public function getContent () {
			if ($this->content) return '<div class="section">'.$this->content.'</div>';
			else return false;
		}

		private function mktid ($content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->mktid($args[0], $args[1]);
				case 3: return $this->d->mktid($args[0], $args[1], $args[2]);
				case 4: return $this->d->mktid($args[0], $args[1], $args[3], $args[3]);
				default: print_r ($args); die ('Y U NO MKTID?');
			}
		}

		public function mklink ($content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->link($args[0], $args[1]);
				case 3: return $this->d->link($args[0], $args[1], $args[2]);
				case 4: return $this->d->link($args[0], $args[1], $args[2], $args[3]);
				default: print_r ($args); die ('Y U NO LINK?');
			}
		}

		private function mkspeak ($content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->speak($args[0], $args[1]);
				case 3: return $this->d->speak($args[0], $args[1], $args[2]);
				default: print_r ($args); die ('Y U NO SPEAK?');
			}
		}

		private function mkinline ($content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->inline($args[0], $args[1]);
				case 3: return $this->d->inline($args[0], $args[1], $args[2]);
				default: print_r ($args); die ('Y U NO INLINE?');
			}
		}
	}

	class Parser {
		
		private $d;
		private $rows;
		private $status;
		private $parser;

		private $title;
		private $subtitle;
		private $prev;
		private $next;

		private $page;
		private $side;
		
		private $tabs;
		private $tab;
		private $section;

		public function __construct ($d) {
			$this->d = $d;
			$this->status = 0;
			$this->parser = array ();
			$this->meta = array ();

			$this->page = array();
			$this->side = array();

			$this->tabs = array();
			$this->tab = array();
			$this->tabname = 'default';
			$this->section = new Section ($this->d);
		}

		public function parse ($file) {
			$this->rows = file ($file, FILE_IGNORE_NEW_LINES);
			$lineno = 0;
			foreach ($this->rows as $line) $this->parseline (++$lineno, trim($line));
		}

		private function parseline ($lineno, $line) {

			$pos = strpos($line, '#');
			
			if ($pos === 0) return;
			if ($pos === false) {
				$cmd = false;
				$content = $line;
			} else {
				list ($cmd, $content) = split ('#', $line, 2);
				$cmd = strtolower($cmd);
			}
			
			switch ($this->status) {
				case 0: $this->parseMeta ($lineno, $cmd, $content); break;
				case 1: $this->parsePage ($lineno, $cmd, $content); break;
				case 2: $this->parseSide ($lineno, $cmd, $content); break;
				default: die ('Unknown status ['.$this->status.']');
			}
		}

		private function parseMeta ($lineno, $cmd, $content) {
		
			switch ($cmd) {
				case '': break;
				case 'title':
					$this->meta['title'] = $content; break;
				case 'subtitle':
					$this->meta['subtitle'] = $content; break;
				case 'prev':
					$this->meta['prev'] = $this->section->mklink($content); break;
				case 'next':
					$this->meta['next'] = $this->section->mklink($content); break;
				case 'start':
					switch (strtolower($content)) {
						case 'content':
						case 'page':
							$this->setStatus (1); break;
						case 'side':
							$this->setStatus (2); break;
						default: die ('(0) Unknown environment ['.$content.'] @line '.$lineno);
					}
					break;
				default: die ('parseMeta: Unknown command ['.$cmd.'] @line '.$lineno);
			}
		}

		private function parsePage ($lineno, $cmd, $content) {

			switch ($cmd) {
				case 'include':
					list($keyword, $file) = $this->getIncludeKeyword($content);
					$parser = $this->getParser($file);
					$parser = new Parser($this->d);
					$parser->parse($file);
					$this->tab[] = array ('sec' => $this->section);
					$this->section = new Section ($this->d);
					$this->tab[] = array ($keyword => $parser);
					break;
				case 'tab':
					$this->tab[] = array ('sec' => $this->section);
					$this->section = new Section ($this->d);
					$this->tabs[$this->tabname] = $this->tab;
					$this->tab = array ();
					$this->tabname = $content;
					if (!isset($this->meta['default'])) $this->meta['default'] = $content;
					break;
				case 'start':
					if (strpos($content, '#')) {
						list($keyword,  $id) = split ('#', $content);
						if (strcmp($keyword, 'tab') == 0) {
							if ($this->tabid) die ('(1) Cannot reopen tab!');
							$this->tabid = $id;
						} else die ('(1) Keyword ['.$keyword.'] is not tab');
					} else die ('(1) Starting ['.$content.']');
					break;
				case 'stop':
					switch (strtolower($content)) {
						case 'content':
						case 'page':
							$this->tab[] = array ('sec' => $this->section);
							$this->section = new Section ($this->d);
							$this->tabs[$this->tabname] = $this->tab;
							$this->tabname = false;
							$this->tab = array ();
							$this->setStatus (0); break;
						case 'tab':
							$this->tab[] = array ('sec' => $this->section);
							$this->section = new Section ($this->d);
							$this->tabs[$this->tabid] = $this->tab;
							$this->tabid = false;
							$this->tab = array (); break;
						case 'side':
							die ('(1) Not inside [SIDE]'); break;
						default: die ('(1) Stopping ['.$content.']');
					}
					break;
				case 'sbr':
					$this->tab[] = array ('sec' => $this->section);
					$this->section = new Section($this->d);
					$this->tab[] = array ('br' => false);
					break;
				case 'change':
					$this->tab[] = array ('sec' => $this->section);
					$this->section = new Section($this->d);
					break;
				default:
					$this->section->parseLine ($cmd, $content);
			}
		}

		private function parseSide ($lineno, $cmd, $content) {

			switch ($cmd) {
				case 'include':
					list($keyword, $file) = $this->getIncludeKeyword($content);
					$parser = $this->getParser($file);
					#$parser = new Parser($this->d);
					#$parser->parse($file);
					$this->side[] = array ('sec' => $this->section);
					$this->section = new Section ($this->d);
					$this->side[] = array ($keyword => $parser);
					break;
				case 'start':
					die ('(2) Should not start anything! ['.$content.'] @'.$lineno);
					break;
				case 'stop':
					if (strcasecmp($content, 'Side')) die ('(2) Should not stop ['.$content.'] @'.$lineno);
					$this->side[] = array ('sec' => $this->section);
					$this->section = new Section ($this->d);
					break;
				case 'sbr':
					$this->side[] = array ('sec' => $this->section);
					$this->section = new Section($this->d);
					$this->side[] = array ('br' => false);
					break;
				case 'change':
					$this->side[] = array ('sec' => $this->section);
					$this->section = new Section($this->d);
					break;
				default:
					$this->section->parseLine ($lineno, $cmd, $content);
			}
		}

		private function setStatus ($status) {
			$this->isNotText = true;
			$this->isPre = false;
			$this->status = $status;
		}

		public function getTitle () { return $this->meta['title']; }
		public function getSubtitle () { return $this->meta['subtitle']; }
		public function getDefaultTab () { return $this->meta['default']; }

		public function getNext () { return array ('Test', 'Test', false, false); }
		public function getPrev () { return array ('Test', 'Test', false, false); }

		public function getPage ($tab) {
			$page = false;
			if (isset($this->tabs[$tab])) return $this->showTab($tab, $this->tabs[$tab]);
			if (strcmp($tab, 'all') == 0) {
				foreach (array_keys($this->tabs) as $key) {
					$page .= "\n".'<!-- Tab#'.$key.'/Start -->'."\n";
					$page .= $this->showTab($key, $this->tabs[$key]);
					$page .= "\n".'<!-- Tab#'.$key.'/Stop -->'."\n";
				}
				return $page;
			}
			return '<div class="section"><h2>Tab not found</h2><p>There&apos;s no tab called ['.$tab.']</p></div>';
		}

		private function showTab ($name, $content) {
			
			$result = '<a id="'.strtoupper($name).'"></a>';
			foreach ($content as $part){
				$keys = array_keys ($part);
				switch ($keys[0]) {
					case 'sec' : $result .= $part['sec']->getContent(); break;
					case 'br'  : $result .= '<br />'; break;
					case 'side': $result .= $part['side']->getSide(); break;
					case 'page': $result .= $part['page']->getPage(); break;
					case 'both': $result .= $part['both']->getSide().$part['both']->getPage(); break;
					default: die ('showTab: unknown content type ['.$keys[0].']');
				}
			}
			return $result;
		}

		public function getSide () {
			$side = false;
			foreach ($this->side as $obj) {
				$keys = array_keys ($obj);
				switch ($keys[0]) {
					case 'sec': $side .= $obj['sec']->getContent(); break;
					case 'br': $side .= '<br />'; break;
					case 'side': $side .= $obj['side']->getSide(); break;
					case 'page': $side .= $obj['page']->getPage(); break;
					case 'both': $side .= $obj['both']->getSide().$obj['both']->getPage(); break;
					default: die ('GetSide: unknown content type ['.$keys[0].']');
				}
			}
			return $side;
		}

		private function getParser ($file) {
			if (!isset($this->parser[$file])) {
				is_file($file) or die ('Include: '.$file.' is not a file!');
				$parser = new Parser($this->d);
				$this->parser[$file] = $parser;
				$parser->parse($file);
			}
			return $this->parser[$file];
		}

		private function getIncludeKeyword ($content) {
			if (strpos($content, '#')) {
				list ($file, $keyword) = split ('#', $content);
				return array ($keyword, $file);
			} else return array('both', $content);
		}

		public function show () {
			echo ('<h2>Page / Tabs ('.count($this->tabs).')</h2>');
			foreach ($this->tabs as $tab) {
				echo ('<p>');
				foreach ($tab as $obj) echo $obj.', ';
				echo ('</p>');
			}
			echo ('<h2>Side / Section ('.count($this->side).')</h2>');
			foreach ($this->side as $side) echo $side;
			echo ('<h2>Include ('.count($this->parser).')</h2>');
			foreach ($this->parser as $parser) {
				echo ('<div style="width:50%;float:left"><div class="section">');
				$parser->show();
				echo ('</div></div>');
			}
			echo ('<div style="clear:both">');
			echo ('</div>');
		}
	}
?>