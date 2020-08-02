.DEFAULT_GOAL := help

.PHONY: help build up start stop reset

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'


build: ## Build the containers or launch it
build: docker-compose.yml
	@docker-compose pull --ignore-pull-failures
	@docker-compose build --force-rm --pull

up: ## Up the containers and remove the orphans
up: docker-compose.yml
	@docker-compose up -d --remove-orphans

##
## Project
##---------------------------------------------------------------------------

start: ## Start the project
start: build up composer

stop: ## Remove docker containers
stop:
	@docker-compose kill
	@docker-compose rm -v --force

reset: ## Reset the project
reset: stop start


composer: ## Execute index.php
composer:
	@docker-compose run --rm php composer install

run: ## Execute index.php
run:
	@docker-compose run --rm php php index.php