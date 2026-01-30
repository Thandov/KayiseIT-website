#!/bin/bash
# Start Laravel server without deprecation warnings
php -d error_reporting="E_ALL & ~E_DEPRECATED" artisan serve --host=127.0.0.1 --port=8000






