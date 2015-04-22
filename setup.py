from distutils.core import setup
__version__ = open('VERSION').read().strip()
setup(
	name='sixtus',
	version=__version__,
	url='https://github.com/drachlyznardh/sixtus',
	author='Ivan Simonini',
	author_email='drachlyznardh@gmail.com',
	package_dir={'sixtus':'src/sixtus'},
	packages=['sixtus'],
	package_data={'sixtus':['README.md', 'data/*', 'README.md', 'CHANGELOG', 'VERSION']},
	data_files=[('samples', ['samples/*'])]
)
