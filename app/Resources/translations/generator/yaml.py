# -*- coding: utf-8 -*-
__author__ = 't'
import translate
import re
from sys import argv

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
for line in lines:
    string = None
    string = match(regexJS, line)
    if string == None: string = match(regexTWIG, line)
    if string == None: string = match(regexPHP, line)

    string = stripMarginQuotes(string)

    if string != None:
        if locale == None:
            toYaml += string + ': \n'
        else:
            toYaml += string + ': %s\n' % translate.translate(string, locale, localeFrom)

if locale == None:
    with open('./messages/messages.base.yml', 'w') as file: file.write(toYaml)
else:
    with open('./messages/messages.' + locale + '.yml', 'w') as file: file.write(toYaml)