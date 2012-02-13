LESS_COMPRESSOR ?= `which lessc`
JS_COMPRESSOR ?= `which uglifyjs`
WATCHR ?= `which whatchr`

#
# BUILD STYLES
# lessc is required
#

styles:
	lessc styles/modern.less > styles/modern.css
	lessc --compress styles/modern.less > styles/modern.min.css

#
# WATCH LESS FILES AND MAKE AUTOMATICALLY
# watchr is required
#

watch:
	echo "Watching less files..."; \
	watchr -e "watch('styles/.*\.less') { system 'make' }"

.PHONY: styles watch
