#!/usr/bin/env python
# -*- coding: utf-8 -*-
import urllib2

def translate(toTranslate, toLangage="auto", langage="auto"):

    agents = {'User-Agent':"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)"}
    before_trans = 'class="t0">'
    link = "http://translate.google.com/m?hl=%s&sl=%s&q=%s" % (toLangage, langage, toTranslate.replace(" ", "+"))
    request = urllib2.Request(link, headers = agents)
    page = urllib2.urlopen(request).read()
    result = page[page.find(before_trans) + len(before_trans):]
    result = result.split("<")[0]
    return result

if __name__ == '__main__':
    toTranslate = 'Hola como estas?'
    result = translate(toTranslate)
    print("%s >> %s" % (toTranslate, result))
    assert True == (result == 'Hello how are you?')
    result = translate(toTranslate, 'pl')
    print("%s >> %s" % (toTranslate, result))
    assert True == (result == 'Cześć, jak się masz?')
