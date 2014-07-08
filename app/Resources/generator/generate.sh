#!/bin/bash
#look up for the translations in whole project,
#generate yaml(s)
#translate 2nd column from choosen yaml
./lookupTranslations.sh
./progress.sh 'found all'

#python yaml.py en
#./progress.sh en

#python yaml.py es
#./progress.sh es

#python yaml.py it
#./progress.sh it

#python yaml.py fr
#./progress.sh fr

#python yaml.py pl
#./progress.sh pl

#python yaml.py pl pl
#./progress.sh

cd ./reverseTranslateFromYaml
cp ../messages/messages.base.yml ./input/messages.base.yml
python translate.py en base
../progress.sh en-trans
