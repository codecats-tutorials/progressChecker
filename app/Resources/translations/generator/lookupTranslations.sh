#!/bin/bash
#grep -ro "\st('.\+')"
#grep -roh "\st('.\+')"
cd ../../../..

#js

#twig

#php

USAGES=~/Desktop/usages.txt
grep -rEno --include \*.js "[\(: ]t\('.+'\)" | grep -v '^vendor/' >> $USAGES
grep -rEno --include \*.twig "{{.+\|\s*trans\s*}}" | grep -v '^vendor/' >> $USAGES
grep -rEno --include \*.php "trans\('.*'\)" | grep -v '^vendor/' >> $USAGES

USAGES_NO_PATH=~/Desktop/usages-no-path.txt

grep -horE --include \*.js "[\(: ]t\('.+'\)" | grep -v '^vendor/' >> $USAGES_NO_PATH
grep -horE --include \*.twig "{{.+\|\s*trans\s*}}" | grep -v '^vendor/' >> $USAGES_NO_PATH
grep -horE --include \*.php "trans\('.*'\)" | grep -v '^vendor/' >> $USAGES_NO_PATH

MESSAGE_BASE=~/Desktop/message.base.yml

