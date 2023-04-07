SHELL = bash
.DEFAULT_GOAL := all

.PHONY: test
test:
	@echo
	@echo "--> phpstan"
	./vendor/bin/phpstan

.PHONY: all
all: test
