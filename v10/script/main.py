#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util
import build

class Sixtus:

	def __init__ (self):

		self.debug = True

		self.location = {}

		self.location['pag'] = 'src'
		self.location['blog'] = 'blog'
		self.location['build'] = 'build'
		self.location['deploy'] = '/opt/web/mobile'

		self.files = {key:[] for key in 'pag Six dep six php'.split()}

		self.match = {}
		self.match['pag'] = re.compile(r'^%s(.*)\.pag$' % self.location['pag'])

		self.replace = {}
		self.replace['Six'] = r'%s\1.Six' % self.location['build']

		print(self.location)
		print(self.files)

	def build (self):

		self.files['pag'] += util.find_all_files(self.location['pag'], '*.pag')
		print('Files[pag] = %s' % self.files['pag'])

		self.files['Six'] += [self.match['pag'].sub(self.replace['Six'], name) for name in self.files['pag']]
		print('Files[Six] = %s' % self.files['Six'])

		return

print('Siχtus 0.10')

src_dir = 'src'
build_dir = 'build'
deploy_dir = '/opt/web/mobile'

pag_files = util.find_all_files ('src', '*.pag')
Six_files = [re.sub(r'^src(.*)\.pag$', r'build\1.Six', i) for i in pag_files]
dep_files = [re.sub(r'(.*)\.Six$', r'\1.dep', i) for i in Six_files]

print('pag_files = %s' % pag_files)
print('Six_files = %s' % Six_files)
print('dep_files = %s' % dep_files)

for Six_file in Six_files:

	if not os.path.exists(Six_file):
		print('Six file [%s] does not exist!' % Six_file)
		build.build_Six_file(Six_file)

for dep_file in dep_files:

	if not os.path.exists(dep_file):
		print('dep file [%s] does not exist!' % dep_file)
		build.build_dep_file(dep_file)

six_dirs  = {}
php_names = []

for dep_file in dep_files:

	mapped, stem, tab_files = build.parse_dep_file(dep_file)

	six_dirs[mapped] = stem
	php_names += tab_files

six_files = [util.get_six_filename(bundle) for bundle in php_names]
php_files = [util.get_php_filename(bundle) for bundle in php_names]
print('six_files = %s' % six_files)
print('php_files = %s' % php_files)

for name in six_files:

	six_file = os.path.join(build_dir, name)
	if not os.path.exists(six_file):
		print('six file %60s does not exist!' % six_file)

		six_dir = build.locate_six_dir(os.path.dirname(name), six_dirs)

		print('Match found! "%s" → "%s"' % (six_dir, six_dirs[six_dir]))

		Six_file = os.path.join('build', '%s.Six' % six_dirs[six_dir])
		output_dir = os.path.join('build', six_dir)

		build.build_six_files(Six_file, output_dir)

for bundle in php_names:

	php_type = bundle[0]
	php_base = bundle[1]
	six_file = os.path.join(build_dir, util.get_six_filename(bundle))
	php_file = os.path.join(deploy_dir, util.get_php_filename(bundle))

	if not os.path.exists(php_file):
		print('PHP file %60s does not exist!' % php_file)

		if php_type == 0: # page
			build.build_page_file(php_base, six_file, php_file)
		elif php_type == 1: # jump
			build.build_jump_file(php_base, six_file, php_file)
		elif php_type == 2: # side
			build.build_side_file(php_base, six_file, php_file)

print('Siχtus 0.10, done')

sixtus = Sixtus()
sixtus.build()

sys.exit(0)
