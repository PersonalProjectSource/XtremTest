#
# Makefile
#
up: init install

init:
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create
	php bin/console doctrine:fixtures:load -n
	php bin/console server:start


# Install
install: update-bin install-composer
install-composer: bin/composer
	cp app/config/parameters.yml.dist app/config/parameters.yml
	./bin/composer install --no-interaction -o


# Binaries
update-bin: bin/composer
	./bin/composer self-update

bin/composer:
	curl -sS https://getcomposer.org/installer | php -- --install-dir=bin --filename=composer
	chmod +x bin/composer || /bin/true


# Tests
test:
	./vendor/bin/phpunit
test-coverage:
	./vendor/bin/phpunit --coverage-html var/coverage