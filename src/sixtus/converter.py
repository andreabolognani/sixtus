# -*- encoding: utf-8 -*-

from __future__ import print_function

import sys
import re

from .util import convert

class ContentConverter:

	def __init__ (self, page_location):

		self.debug = False

		self.environment = []
		self.writing     = False
		self.mode        = 'p'

		self.page_location = page_location

		self.content  = ''
		self.filename = ''
		self.lineno   = 0

	def error (self, message):

		line = '\nContentConverter: %s @line %d: %s' % (self.filename, self.lineno, message)
		print(line, file=sys.stderr)
		sys.exit(1)

	def parse_line (self, line):

		self.lineno += 1

		if self.debug:
			print('Parse_Line (%s)' % (line), file=sys.stderr)

		if '|' not in line:
			self.append_content(line);
			return

		token = line.split('|')
		command = token[0]

		if command == 'source':
			self.filename = token[1]
			self.lineno = int(token[2])
			return

		self.parse_content(token[0], token[1:])

	def split_at_at (self, text):
		if '@' in text:
			s = text.split('@')
			return (s[0], s[1:])
		return (text, [])

	def parse_content (self, c, args):

		if self.debug:
			print('Parse_Content (%s, %s)' % (c, args), file=sys.stderr)

		c, opt = self.split_at_at(c)

		if c == 'link': self.make_link(c, args)
		elif c == 'tid': self.make_tid(c, args)
		elif c == 'speak': self.make_speak(c, args)
		elif c == 'p' or c == 'c' or c == 'r': self.start_writing(c, self.parse_recursive(args))
		elif c == 'em' or c == 'code' or c == 'strong': self.make_style(c, args)
		elif c == 'wrong' or c == 'spoiler': self.make_decoration(c, args)
		elif c == 'id': self.make_id(c, args)
		elif c == 'br': self.make_break(c, args)
		elif c == 'begin': self.make_begin(c, args)
		elif c == 'end': self.make_end(c, args)
		elif c == 'clear': self.make_clear(c, args)
		elif c == 'tag': pass # Tags are supported, right now…
		elif c == 'title' or c == 'stitle' or '@' in c:
			self.parse_title(c, opt, args)
		else: self.error('Unknown content c [%s] %s' % (c, args))

	def parse_title (self, c, opt, args):

		if c not in ('title', 'stitle', 'subtitle'):
			self.error('What title is %s supposed to be? %s %s' % (c, opt, args))

		size = len(opt)
		if size == 0: direction = ''
		elif size > 1:
			self.error('Only one direction applicable %s %s %s' % (c, opt, args))
		elif opt[0] not in ('left', 'center', 'right'):
			self.error('What direction is %s supposed to be? %s %s' % (opt[0], c, args))
		else: direction = opt[0]

		content = self.parse_recursive(args)
		self.stop_writing()
		self.content += self.do_make_title(c, direction, content)

	def do_make_title (self, grade, direction, content):

		if grade == 'title': tag = 'h2'
		elif grade == 'stitle': tag = 'h3'

		if direction in ('', 'left'): style = ''
		elif direction == 'center': style = ' class="center"'
		elif direction == 'right': style = ' class="reverse"'

		return '<%s%s>%s</%s>' % (tag, style, content, tag)

	def parse_recursive (self, args):

		c = args[0]

		if len(args) == 1: return c

		if c == 'link':
			return self.do_make_link(args[1:], False)
		elif c == 'tid':
			return self.do_make_tid(args[1:])

			linkargs = []
			linkargs.append('/%s/%s/' % (self.page_location, args[2].upper()))
			linkargs.append(args[1])
			if len(args) > 3: linkargs.append(args[3:])
			return self.make_link(linkargs, False)
		elif c == 'speak':
			return self.do_make_speak(args[1:])
		elif c == 'em' or c == 'code' or c == 'strong':
			return self.make_style(c, args[1:])
		elif c == 'wrong' or c == 'spoiler':
			return self.make_decoration(c, args[1:])
		else: self.error('Parse_Args: not a [link|tid]! %s' % args)

	def start_writing (self, type, text):

		if self.writing: self.stop_writing()

		if self.mode == 'p': tag = 'p'
		elif self.mode == 'li': tag = 'li'

		if self.mode != 'pre':
			if type == 'p':
				self.content += ('<%s>%s' % (tag, text))
			elif type == 'c':
				self.content += ('<%s class="center">%s' % (tag, text))
			elif type == 'r':
				self.content += ('<%s class="reverse">%s' % (tag, text))
		else: self.content += text

		self.writing = True

	def stop_writing (self):

		if not self.writing: return

		if self.mode == 'p':
			self.content += '</p>\n'
		elif self.mode == 'li':
			self.content += '</li>\n'
		elif self.mode == 'pre':
			self.content += '\n'

		self.writing = False

	def append_content (self, text):

		if self.writing:
			if len(text) == 0: self.stop_writing()
			else: self.content += (' %s' % text)
		elif len(text): self.start_writing('p', text)

	def split_triplet (self, content):

		if '@' not in content:
			return ('', content, '')

		token = content.split('@')
		if len(token) == 2:
			return ('', token[0], token[1])

		return (token[0], token[1], token[2])

	def make_tid (self, c, args):
		content = self.do_make_tid(args)
		self.append_content(content)

	def do_make_tid (self, args):

		size = len(args)

		if size < 2 or size > 3:
			self.error('Tid expects 2-3 args %s' % args)

		tab_target = convert(args[1])
		tab_location = '/'.join(self.page_location.split('/') + [tab_target])

		link_args = [tab_location, args[0]]
		if size == 3: link_args.append(args[2])

		return self.do_make_link (link_args, tab_target)

	def make_link (self, c, args):
		content = self.do_make_link(args, False)
		self.append_content(content)

	def do_make_link (self, args, tab_target):

		if self.debug:
			print('Make_Link (%s)' % args, file=sys.stderr)

		if len(args) == 2: href = args[0]
		else: href = '%s#%s' % (args[0], convert(args[2]))

		if len(args[0]) and href[0] != '/': href = '/%s' % href

		before, text, after = self.split_triplet(args[1])

		if tab_target:
			check = '''<?=$d[8]=='%s'?'class="highlighted"':''?>''' % tab_target
		else: check = ''

		return '%s<a %s href="%s">%s</a>%s' % (before, check, href, text, after)

	def make_style (self, c, args):
		before, text, after = self.split_triplet(args[0])
		self.append_content(self.do_make_style(c, before, text, after))

	def do_make_style (self, c, before, text, after):
		return '%s<%s>%s</%s>%s' % (before, c, text, c, after)

	def make_decoration (self, c, args):
		before, text, after = self.split_triplet(args[0])
		self.append_content(self.do_make_decoration(c, before, text, after))

	def do_make_decoration (self, c, before, text, after):
		return '%s<span class="%s">%s</span>%s' % (before, c, text, after)

	def make_speak (self, c, args):
		content = self.do_make_speak(args)
		self.append_content(content)

	def do_make_speak (self, args):

		if len(args) != 2:
			self.error('speak# excepts 2 arguments %s' % args)

		return '<span title="%s">«%s»</span>' % (args[0], ' – '.join(args[1].split('@')))

	def make_id (self, c, args):
		self.stop_writing()
		self.do_make_id(convert(args[0]))

	def do_make_id (self, ref):
		self.content += '<a id="%s"></a>\n' % ref

	def make_break (self, c, args):
		self.stop_writing()
		self.do_make_break()

	def do_make_break (self):
		self.content += '<br/>\n'

	def make_begin (self, c, args):
		self.stop_writing()
		self.open_env(args)

	def open_env (self, args):

		env = args[0]

		if env == 'inside':
			self.content += '<div class="inside">'
			self.environment.append((self.mode, '</div>'))
		elif env == 'outside':
			self.content += '<div class="outside">'
			self.environment.append((self.mode, '</div>'))

		elif env == 'ul':
			if len(args) != 1:
				self.error('ul# expects 1 arg %s' % args)
			self.content += '<ul>'
			self.environment.append((self.mode, '</ul>'))
			self.mode = 'li'

		elif env == 'ol' or env == 'dl':

			size = len(args)

			if size > 3:
				self.error('%s# expects 1-3 args %s' % (env, args))

			output = []

			if env == 'ol': output.append('class="roman"')
			else: output.apppend('class="decimal"')

			if size > 1: output.append('style="margin-left:%s"' % args[1])
			if size > 2: output.append('start="%s"' % args[2])

			self.content += ('<ol %s>' % ' '.join(output))
			self.environment.append((self.mode, '</ol>\n'))
			self.mode = 'li'

		elif env == 'mini' or env == 'half':
			side = args[1]
			if side != 'left' and side != 'right':
				self.error('Unknown side %s' % args)
			self.content += '<div class="%s-%s-out"><div class="%s-%s-in">' % (env, side, env, side)
			self.environment.append((self.mode, '</div></div>\n'))

		elif env == 'code' or env == 'em' or env == 'strong':
			self.content += '<div class="%s">' % env
			self.environment.append((self.mode, '</div>\n'))

		elif env == 'wrong' or env == 'spoiler':
			self.content += '<div class="%s">' % env
			self.environment.append((self.mode, '</div>\n'))

		elif env == 'pre':
			self.environment.append((self.mode, '\n'))
			self.mode = 'pre'

		else: self.error('Unknown environment %s' % args)

	def make_end (self, c, args):
		self.stop_writing()

		try: mode, closure = self.environment.pop()
		except: self.error('There is no environment to close!!! %s' % args)

		self.mode = mode
		self.content += closure

	def make_clear (self, c, args):
		self.stop_writing()
		self.do_make_clear(args[0])

	def do_make_clear (self, side):

		if len(side) == 0: side = 'both'
		if side != 'left' and side != 'right' and side != 'both':
			self.error('Unknown side for clear# %s' % side)

		self.content += ('<div style="float:none;clear:%s"></div>\n' % side)

class FullConverter:

	def __init__ (self, page_location, helper):

		self.page_location = page_location
		self.helper = helper

		self.debug = False
		self.meta = {}
		self.state = 'meta'

		self.page = ''
		self.side = ''
		self.side_location = False

	def error (self, message):

		print('\nFullConverter: %s @line %d: %s' % (self.filename, self.lineno, message), file=sys.stderr)
		sys.exit(1)

	def parse_file (self, filename):

		if self.debug:
			print('Parsing file %s' % filename, file=sys.stderr)

		self.filename = filename
		self.lineno = 0

		f = open(filename, 'r')
		for line in f:
			self.lineno += 1
			self.parse_line(line.strip())

		return self

	def parse_line (self, line):

		if self.debug:
			print('Parse_Line (%s)' % (line), file=sys.stderr)

		if '|' not in line:
			if self.state == 'meta': pass
			else: self.helper.append_content(line);
			return

		token = line.split('|')
		command = token[0]

		if command == 'source':
			self.filename = token[1]
			self.lineno = int(token[2])
			return

		if command == 'start':
			self.state_update(token[1])
			return

		if self.state == 'meta':
			self.parse_meta(token[0], token[1:])
			return

		self.helper.parse_content(token[0], token[1:])

	def parse_meta (self, c, args):

		if self.debug:
			print('Parse_Meta (%s, %s)' % (c, args), file=sys.stderr)

		if c == 'jump':
			self.jump = args[0]
		elif c == 'side':
			self.side_location = args[0]
		elif c == 'title':
			self.meta['title'] = args[0]
			if len(args) == 2: self.meta['subtitle'] = args[1]
		elif c == 'short':
			self.meta['short'] = args[0]
		elif c == 'subtitle':
			self.meta['subtitle'] = args[0]
		elif c == 'prev' or c == 'next':
			size = len(args)
			if size == 1 and args[0] == '': self.meta[c] = False
			elif size == 2: self.meta[c] = (args[0], args[1])
			else: self.error('Parse_Meta: %s| expects 0 or 2 arguments %s' % (args[0], args))
		elif c == 'tabprev':
			self.meta['tabprev'] = (args[0], args[1])
		elif c == 'tabself':
			self.meta['tabself'] = args[0]
		elif c == 'tabnext':
			self.meta['tabnext'] = (args[0], args[1])
		elif c == 'tag':
			pass # Tags are supported, right now…
		else:
			self.error('Unknown meta c [%s] %s' % (c, args))

	def state_update (self, newstate):

		self.helper.stop_writing()

		if self.state == 'page':
			self.page += self.helper.content
			self.helper.content = ''
		elif self.state == 'side':
			self.side += self.helper.content
			self.helper.content = ''

		self.state = newstate

class PHPContentConverter(ContentConverter):

	def __init__ (self, page_location):

		ContentConverter.__init__(self, page_location)

class PHPFullConverter(FullConverter):

	def __init__ (self, page_location):

		FullConverter.__init__(self, page_location, PHPContentConverter(page_location))

	def output_page_file (self, filename):

		self.state_update('meta')

		output = '<?php if(!isset($i))$i=array(1,1,1);if($i[0]){$d=array('
		if len(self.page_location):
			loc = self.page_location.split('/')
			output += ('array("%s"),' % ('","'.join(loc)))
		else: output += 'False,'
		output += ('"%s",' % self.meta['title'])
		if 'short' in self.meta: output += ('"%s",' % self.meta['short'])
		else: output += ('"%s",' % self.meta['title'])
		output += ('"%s",' % self.meta['subtitle'])
		if 'prev' in self.meta.keys():
			pagprev = self.meta['prev']
			if pagprev: output += ('array("%s","%s")' % (pagprev[0], pagprev[1]))
			else: output += 'false'
		else: output += 'false'
		output += ','
		if 'next' in self.meta.keys():
			pagnext = self.meta['next']
			if pagnext: output += ('array("%s","%s")' % (pagnext[0], pagnext[1]))
			else: output += 'false'
		else: output += 'false'
		output += ','
		if 'tabprev' in self.meta.keys():
			tabprev = self.meta['tabprev']
			output += ('array("%s","%s")' % (tabprev[0], tabprev[1]))
		else: output += 'false'
		output += ','
		if 'tabnext' in self.meta.keys():
			tabnext = self.meta['tabnext']
			output += ('array("%s","%s")' % (tabnext[0], tabnext[1]))
		else: output += 'false'
		output += ','
		if 'tabself' in self.meta: output += '"%s"' % self.meta['tabself']
		else: output += 'false'
		output += ');'
		output += '$sixtus=$_SERVER["DOCUMENT_ROOT"]."sixtus/";'
		output += 'require_once($sixtus."page-top.php");}if($i[1]){?>'
		output += '\n%s\n' % self.page
		output += '<?php }if($i[0])require_once($sixtus."page-middle.php");'
		if self.side_location:
			output += 'if($i[2])require_once("%s");' % self.side_location
		else: output += 'if($i[2]){?>\n%s\n<?php }' % self.side
		output += 'if($i[0])require_once($sixtus."page-bottom.php");?>'

		with open(filename, 'w') as f: print('%s' % output, file=f)

