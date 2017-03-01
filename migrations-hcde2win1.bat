@echo off
cls
php bin\console doctrine:migrations:diff -e=hcde2win1
php bin\console doctrine:migrations:migrate --no-interaction -e=hcde2win1
