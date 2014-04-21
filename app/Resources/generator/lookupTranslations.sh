#!/bin/bash

#Module looks for the translations calls in whole project, available files extensions: php, js, twig.
#Omiting the vendor directory, two kinds of files will be saved as usaged (file with details)
#and usages-no-path (file without details) its placed into generator/messages directory


cd ../../..

#js
#grep -rEno --include \*.js "\st\('.+'\)" | grep -v '^vendor/'

#twig
#grep -rEno --include \*.twig "{{.+\|\s*trans\s*}}" | grep -v '^vendor/'

#php
#grep -rEno --include \*.php "trans\('.*'\)" | grep -v '^vendor/'


USAGES=./app/Resources/generator/messages/usages.txt
grep -rEno --include \*.js "[\(: ]t\('.+'\)" | grep -v '^vendor/' >> $USAGES
grep -rEno --include \*.twig "{{.+\|\s*trans\s*}}" | grep -v '^vendor/' >> $USAGES
grep -rEno --include \*.php "trans\('.*'\)" | grep -v '^vendor/' >> $USAGES

USAGES_NO_PATH=./app/Resources/generator/messages/usages-no-path.txt

grep -horE --include \*.js "[\(: ]t\('.+'\)" | grep -v '^vendor/' >> $USAGES_NO_PATH
grep -horE --include \*.twig "{{.+\|\s*trans\s*}}" | grep -v '^vendor/' >> $USAGES_NO_PATH
grep -horE --include \*.php "trans\('.*'\)" | grep -v '^vendor/' >> $USAGES_NO_PATH


cd -
