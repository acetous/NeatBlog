LESS_COMPRESSOR ?= `which lessc`
JS_COMPRESSOR ?= `which uglifyjs`
WATCHR ?= `which whatchr`

#
# BUILD STYLES
# lessc is required
#
styles:
	lessc styles_src/modern.less > styles/modern.css
	lessc --compress styles_src/modern.less > styles/modern.min.css
	
	lessc styles_src/modern.backend.less > styles/modern.backend.css
	lessc --compress styles_src/modern.backend.less > styles/modern.backend.min.css
#
# COPY RESSOURCES
#
copy:
	../../symfony themed:setup
	
#
# BUILD JAVASCRIPTS
# uglifyjs is required
#
scripts:
	cat scripts_src/jquery-1.7.1.min.js \
		scripts_src/autoresize.jquery.min.js \
		scripts_src/bootstrap-2.0/bootstrap-transition.js \
		scripts_src/bootstrap-2.0/bootstrap-alert.js \
		scripts_src/bootstrap-2.0/bootstrap-dropdown.js \
		scripts_src/bootstrap-2.0/bootstrap-tab.js \
		scripts_src/bootstrap-2.0/bootstrap-carousel.js \
		scripts_src/modernizr.js \
		scripts_src/google-code-prettify/prettify.js \
		scripts_src/json2.js \
		scripts_src/modern.js \
		> scripts/modern.js
	cat scripts/modern.js \
		scripts_src/modern.backend.js \
		> scripts/modern.backend.js
	uglifyjs -nc scripts/modern.js > scripts/modern.min.js
	uglifyjs -nc scripts/modern.backend.js > scripts/modern.backend.min.js

#
# WATCH FILES AND MAKE AUTOMATICALLY
# watchr is required
#
watch:
	echo "Watching styles and scripts..."; \
	watchr -e "watch('(styles|scripts)_src/.*\.(less|js)') { system 'make styles scripts copy' }"


.PHONY: styles scripts watch
