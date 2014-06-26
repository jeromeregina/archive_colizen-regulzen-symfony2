#!/bin/bash

php app/console cache:clear --env=prod --no-debug
php app/console assets:install web
php app/console assetic:dump --env=prod