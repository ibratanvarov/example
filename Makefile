init: init-ci
init-ci: docker-down-clear \
	docker-pull docker-build docker-up \
	project-init

docker-up:
	make docker-compose COMMAND="up -d"

docker-down:
	make docker-compose COMMAND="down --remove-orphans"

docker-down-clear:
	make docker-compose COMMAND="down -v --remove-orphans"

docker-pull:
	make docker-compose COMMAND="pull"

docker-build:
	docker login ginger.alifshop.uz:443
	docker network create alif || true
	make docker-compose COMMAND="build --pull"

docker-compose:
	docker-compose --project-name alif-service-example ${COMMAND}

create-mysql-database:
	sudo chmod +x ./docker/development/mysql/create-mysql-database
	./docker/development/mysql/create-mysql-database
laravel:
	make docker-compose COMMAND="run --rm app-cli php artisan ${name}"

project-init:
	make project-composer-install
	#make project-migrations
	make project-permissions

project-composer-install:
	make docker-compose COMMAND="run --rm app-cli composer install"
project-permissions:
	docker run --rm -v ${PWD}/:/app -w /app alpine chmod 777 -R storage/logs
project-migrations:
	make docker-compose COMMAND="run --rm app-cli php artisan migrate"


project-cs-check:
	make docker-compose COMMAND="run --rm app-cli ./vendor/bin/php-cs-fixer fix -vvv --dry-run --show-progress=dots --config=./docker/config/.php-cs-fixer.php --allow-risky=yes"
project-cs-fix:
	make docker-compose COMMAND="run --rm app-cli ./vendor/bin/php-cs-fixer fix -vvv --show-progress=dots --config=./docker/config/.php-cs-fixer.php --allow-risky=yes"
project-analyze:
	make docker-compose COMMAND="run --rm app-cli ./vendor/bin/phpstan analyse --memory-limit=2G --configuration='docker/config/phpstan.neon.dist'"
project-test:
	make docker-compose COMMAND="run --rm app-cli ./vendor/bin/phpunit"


try-build:
	REGISTRY=localhost IMAGE_TAG=0 make build


#FOR DEPLOYMENT STAGE
build:
	docker --log-level=debug build --pull --file=docker/production/nginx/Dockerfile --tag=${REGISTRY}/nginx:${IMAGE_TAG} .
	docker --log-level=debug build --pull --file=docker/production/php-fpm/Dockerfile --tag=${REGISTRY}/app:${IMAGE_TAG} .
	docker --log-level=debug build --pull --file=docker/production/php-cli/Dockerfile --tag=${REGISTRY}/app-cli:${IMAGE_TAG} .

push:
	docker push ${REGISTRY}/app:${IMAGE_TAG}
	docker push ${REGISTRY}/app-cli:${IMAGE_TAG}
	docker push ${REGISTRY}/nginx:${IMAGE_TAG}


