#!/usr/bin/python
# -*- encoding: utf-8 -*-

import roman

def extract (filename):

	re_include = re.compile(r'^source\|(.*)\|.*\n$')
	re_tab     = re.compile(r'^tab\|(.*)\n$')

	sources = set()
	tabs = set()

	with open(filename, 'r') as f:
		for line in f.readlines():

			if re_include.match(line):
				sources.add(re_include.sub(r'\1', line))
			elif re_tab.match(line):
				tabs.add(re_tab.sub(r'\1', line))

	return list(sources), list(tabs)

def insert (filename, destination, sources, tabs):

	with open(filename, 'w') as f:

		if len(tabs) == 0:
			print('SIX_FILES += %spage.six' % destination, file=f)
			print('%spage.six: %s' % (destination, ' '.join(sources)), file=f)
			sys.exit(0)

		files = ['%sjump.six' % destination]
		files.append('%sside.six' % destination)
		for tab in tabs:
			files.append('%s%s/page.six' % (destination, roman.convert(tab)))

		print('SIX_FILES += %s' % ' '.join(files), file=f)
		print('%s: %s' % (' '.join(files), ' '.join(sources)), file=f)
