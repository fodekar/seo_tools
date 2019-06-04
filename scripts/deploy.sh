#!/bin/bash

env="${1}"

if [ "$env" == 'production' ];
then
    curl http://seo-elsa.com/github-sync.php
    
    echo "[SEO-ELSA] - Deploy is finish"
fi