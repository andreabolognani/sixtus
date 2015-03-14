#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os
import re

class Preprocessor:

	def __init__ (self, base):

		self.debug = False

		self.base = base
		self.origin_files = []

		self.filename = False
		self.lineno = 0
		self.inclusion = []
		self.content = []
		self.re_require = re.compile(r'^require\|(.*)')
		self.re_pipe = re.compile(r'(@PIPE@)')
		self.re_at = re.compile(r'(@AT@)')
		self.extract = r'\1'

	def clean_line (self, line):

		line = line.strip()
		line = line.replace('@PIPE@','&#124;')
		line = line.replace('@AT@','&#64;')
		return line

	def parse_file (self, filename):

		self.filename = filename
		self.origin_files.append(filename)
		self.lineno = 0

		try:
			with open(filename, 'r') as input_file:
				for line in input_file:
					self.lineno += 1
					self.parse_line(line.strip())
		except EnvironmentError as e:
			print('\nPreprocessor could not open %s: %s' % (filename, e.strerror), file=sys.stderr)
			sys.exit(1)

	def get_existing_path (self, base, required):

		trial = base

		while trial != '/':

			target = os.path.join(trial, required)
			if os.path.exists(target):
				return target

			trial = os.path.dirname(trial)

		print('Cannot find %s anywhere from %s' % (required, base), file=sys.stderr)
		sys.exit(1)

	def parse_line (self, line):

		if len(line) == 0: # Empty line
			self.content.append('')
			return

		if line[0] == '#': # Comment line
			self.content.append('')
			return

		if '|' not in line: # Plain content
			self.content.append(line)
			return

		if self.re_require.match(line): # Require directive
			target_name = self.re_require.sub(self.extract, line)
			target_file = self.get_existing_path(self.base, target_name)
			self.inclusion.append((self.filename, self.lineno))
			self.content.append('source|%s|%d' % (target_file, 0))
			self.parse_file(target_file)
			self.filename, self.lineno = self.inclusion.pop()
			self.content.append('source|%s|%d' % (self.filename, self.lineno))
			return

		self.content.append(line) # Ordinany command
