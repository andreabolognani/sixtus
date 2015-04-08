#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

class Sixtus:

	def __init__ (self, bag):

		self.flags, self.time_delta, self.sitemap, self.conf = bag

		self.location = self.conf.get('location')
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def loud (self, message):
		if self.flags.get('loud', False):
			print(message)

	def explain_why (self, message):
		if self.flags.get('why', False):
			print(message)

	def explain_why_not (self, message):
		if self.flags.get('not', False):
			print(message)

