#!/bin/bash
./lookupTranslations.sh
./progress.sh 'found all'

python yaml.py en
./progress.sh en 

python yaml.py es 
./progress.sh es

python yaml.py it
./progress.sh it

python yaml.py fr
./progress.sh fr

python yaml.py pl
./progress.sh pl
