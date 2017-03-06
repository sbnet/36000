php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:generate:entities Sbnet
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load -n

# DELETE FROM city WHERE post_code IS NULL;
