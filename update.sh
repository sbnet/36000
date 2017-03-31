#!/bin/bash
git pull origin master
php ../composer.phar update

for i in "$@" ; do
    if [[ $i == "--full" ]] ; then
        php bin/console doctrine:database:drop --force
        php bin/console doctrine:database:create
        php bin/console doctrine:generate:entities Sbnet --no-backup
        php bin/console doctrine:schema:update --force
        php bin/console doctrine:fixtures:load -n
        break
    fi
done

# may be done as root
chmod 777 -R var/cache/ var/logs/ var/sessions/
php bin/console assetic:dump --env=prod
php bin/console cache:clear --env=prod
chmod 777 -R var/cache/ var/logs/ var/sessions/

exit