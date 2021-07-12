#!/bin/bash

set -eux

cd ~/******
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan config:cache
