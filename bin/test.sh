#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )"/.. && pwd )"
cd $DIR

composer --quiet dump --optimize --classmap-authoritative > /dev/null

vendor/bin/phpunit
