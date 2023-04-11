SHELL = bash
.DEFAULT_GOAL := all

.PHONY: test
test: lint phpstan pest

.PHONY: server-start
server-start:
	@echo
	@echo "--> Test Server: starting"
	@echo
	nohup php -S 127.0.0.1:7878 -t tests/server/ > /dev/null 2>&1 & echo "$$!" > tests/server/pid.txt

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
pest: server-start
	@echo
	@echo "--> pest"
	@echo
	./vendor/bin/pest
	@echo
	@echo "Test Server: stopping"
	@echo
	kill -9 `cat tests/server/pid.txt`

.PHONY: all
all: test
