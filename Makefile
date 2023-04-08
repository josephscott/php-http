SHELL = bash
.DEFAULT_GOAL := all

.PHONY: test
test: lint phpstan pest

.PHONY: lint
lint:
	@echo
	@echo "--> lint"
	@echo
	php -l src/http.php

.PHONY: phpstan
phpstan:
	@echo
	@echo "--> phpstan"
	@echo
	./vendor/bin/phpstan

.PHONY: pest
pest:
	@echo
	@echo "--> pest"
	@echo
	./vendor/bin/pest

.PHONY: all
all: test
