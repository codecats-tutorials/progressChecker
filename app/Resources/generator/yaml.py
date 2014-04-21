# -*- coding: utf-8 -*-
'''
en - english
pl - polish

Module reads the generator/messages/usages-no-path.txt line by line. Then creates the yaml file (translated or base).
example (required: usages-no-path.txt file):
python yaml.py
-> creates base yaml file into messages

python yaml.py pl
-> creates translated pl file into messages, base text is autodetected

python yaml.py pl en
-> created translated pl file into messages, base text is en

keep in mind: usages-no-path.txt file can be generated via lookupTranslations.sh
'''
__author__ = 't'
import translate
import re
from sys import argv
import yaml
import codecs

locale = None
try:
    locale = argv[1]
except:
    pass

localeFrom = 'auto'
try:
    localeFrom = argv[2]
except:
    pass

def match(regex, string):
    result = regex.search(string)
    if result != None:
        return result.group(1)
    return None

def stripMarginQuotes(str):
    if str == None: return None
    if (str[0:1] + str[-1:]) == "''":
        str = str[1:-1]
    return str

regexJS     = re.compile("[\(: ]t\((.+?)\)")
regexTWIG   = re.compile("{{\s*(.+?)\s*\|\s*trans\s*}}")
regexPHP    = re.compile("trans\((.+?)\)")

with open('./messages/usages-no-path.txt', 'r') as file: lines = file.read().split('\n')

toYaml = ''
yamlDirectory = {}
for line in lines:
    string = None
    string = match(regexJS, line)
    if string == None: string = match(regexTWIG, line)
    if string == None: string = match(regexPHP, line)

    string = stripMarginQuotes(string)

    if string != None:
        if locale == None:
            yamlDirectory['' + string + ''] = ''

        else:
            yamlDirectory['' + string + ''] = '"%s"' % translate.translate(string, locale, localeFrom)

pathName = './messages/messages.base.yml'
if locale != None:
    pathName = './messages/messages.' + locale + '.yml'


content = yaml.safe_dump(yamlDirectory, default_flow_style = False, encoding='utf-8', allow_unicode=True)
with codecs.open(pathName, 'w') as file: file.write(content)
