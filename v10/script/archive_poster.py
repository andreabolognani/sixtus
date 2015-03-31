#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys

if len(sys.argv) < 2:
	params = ['<output file>', '<blog name file>', '<year list files…>']
	print('Usage: %s %s' % (sys.argv[0], ' '.join(params)))
	sys.exit(1)

pag_file  = sys.argv[1]
name_file = sys.argv[2]

with open(name_file, 'r') as f:
	name_map = eval(f.read())

page = []
side = []
for filename in sys.argv[3:]:
	side.append(filename.split('/')[-1].split('.')[0])
	with open(filename, 'r') as f:
		page.append(f.read().strip())

with open(pag_file, 'w') as f:

	print('title|%s' % name_map['14'], file=f)
	print('subtitle|%s' % (name_map['15']), file=f)

	print('start|page', file=f)
	print('\nbr|\n'.join(page), file=f)

	print('start|side', file=f)
	print('stitle|%s' % name_map['14'], file=f)
	print('p|%s' % ('\n/\n'.join(['link||%s|%s' % (i, i) for i in side])), file=f)
