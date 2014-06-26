#!/bin/bash

php app/console cache:clear
php app/console assets:install web
php app/console assetic:dump
