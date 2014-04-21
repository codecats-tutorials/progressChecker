# -*- coding: utf-8 -*-
__author__ = 't'
import os,sys,inspect
currentdir = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe())))
parentdir = os.path.dirname(currentdir)
sys.path.insert(0, parentdir)

import yaml
import translate
from sys import argv
import codecs

# locale = argv[1]
locale = 'en'

localeFrom = 'auto'
localeFrom = 'pl'
try:
    localeFrom = argv[2]
except:
    pass

docs = None
path = 'input/messages.' + localeFrom + '.yml'
path = os.path.join(currentdir, path)
with codecs.open(path, 'r', 'utf8') as file: docs = yaml.load(file)

translatedDocs = {}
for key in docs:
    translatedDocs[key] = translate.translate(codecs.encode(docs[key], 'utf8'), locale, localeFrom)


for key in translatedDocs:
    print key

content = yaml.safe_dump(translatedDocs, default_flow_style = False, encoding='utf-8', allow_unicode=True)
print content
with codecs.open('./output/messages.' + locale + '.yml', 'w', 'utf8') as file: file.write(content)

with open('./output/test.yml', 'w') as file: file.write('łąźćóęółń')