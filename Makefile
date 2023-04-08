SHELL = bash
.DEFAULT_GOAL := all

.PHONY: test
test: phpstan pest

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
