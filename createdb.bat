php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:generate:entities Sbnet --no-backup
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load -n
