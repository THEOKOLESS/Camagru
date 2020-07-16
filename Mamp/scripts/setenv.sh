#!/bin/sh
echo $PATH | egrep "/Users/tvitoux/Mamp/common" > /dev/null
if [ $? -ne 0 ] ; then
PATH="/Users/tvitoux/Mamp/frameworks/laravel/app/Console:/Users/tvitoux/Mamp/frameworks/cakephp/bin:/Users/tvitoux/Mamp/frameworks/codeigniter/bin:/Users/tvitoux/Mamp/frameworks/symfony/bin:/Users/tvitoux/Mamp/frameworks/zendframework/app/Console:/Users/tvitoux/Mamp/git/bin:/Users/tvitoux/Mamp/varnish/bin:/Users/tvitoux/Mamp/sqlite/bin:/Users/tvitoux/Mamp/php/bin:/Users/tvitoux/Mamp/mysql/bin:/Users/tvitoux/Mamp/letsencrypt/:/Users/tvitoux/Mamp/apache2/bin:/Users/tvitoux/Mamp/common/bin:$PATH"
export PATH
fi
echo $DYLD_FALLBACK_LIBRARY_PATH | egrep "/Users/tvitoux/Mamp/common" > /dev/null
if [ $? -ne 0 ] ; then
DYLD_FALLBACK_LIBRARY_PATH="/Users/tvitoux/Mamp/git/lib:/Users/tvitoux/Mamp/varnish/lib:/Users/tvitoux/Mamp/varnish/lib/varnish:/Users/tvitoux/Mamp/varnish/lib/varnish/vmods:/Users/tvitoux/Mamp/sqlite/lib:/Users/tvitoux/Mamp/mysql/lib:/Users/tvitoux/Mamp/apache2/lib:/Users/tvitoux/Mamp/common/lib:/usr/local/lib:/lib:/usr/lib${DYLD_FALLBACK_LIBRARY_PATH:+:$DYLD_FALLBACK_LIBRARY_PATH}"
export DYLD_FALLBACK_LIBRARY_PATH
fi

TERMINFO=/Users/tvitoux/Mamp/common/share/terminfo
export TERMINFO
##### GIT ENV #####
GIT_EXEC_PATH=/Users/tvitoux/Mamp/git/libexec/git-core/
export GIT_EXEC_PATH
GIT_TEMPLATE_DIR=/Users/tvitoux/Mamp/git/share/git-core/templates
export GIT_TEMPLATE_DIR
GIT_SSL_CAINFO=/Users/tvitoux/Mamp/common/openssl/certs/curl-ca-bundle.crt
export GIT_SSL_CAINFO

##### VARNISH ENV #####
		
      ##### SQLITE ENV #####
			
##### GHOSTSCRIPT ENV #####
GS_LIB="/Users/tvitoux/Mamp/common/share/ghostscript/fonts"
export GS_LIB
##### IMAGEMAGICK ENV #####
MAGICK_HOME="/Users/tvitoux/Mamp/common"
export MAGICK_HOME

MAGICK_CONFIGURE_PATH="/Users/tvitoux/Mamp/common/lib/ImageMagick-6.9.8/config-Q16:/Users/tvitoux/Mamp/common/"
export MAGICK_CONFIGURE_PATH

MAGICK_CODER_MODULE_PATH="/Users/tvitoux/Mamp/common/lib/ImageMagick-6.9.8/modules-Q16/coders"
export MAGICK_CODER_MODULE_PATH

##### FONTCONFIG ENV #####
FONTCONFIG_PATH="/Users/tvitoux/Mamp/common/etc/fonts"
export FONTCONFIG_PATH
SASL_CONF_PATH=/Users/tvitoux/Mamp/common/etc
export SASL_CONF_PATH
SASL_PATH=/Users/tvitoux/Mamp/common/lib/sasl2 
export SASL_PATH
LDAPCONF=/Users/tvitoux/Mamp/common/etc/openldap/ldap.conf
export LDAPCONF
##### PHP ENV #####
PHP_PATH=/Users/tvitoux/Mamp/php/bin/php
COMPOSER_HOME=/Users/tvitoux/Mamp/php/composer
export PHP_PATH
export COMPOSER_HOME
##### MYSQL ENV #####

##### APACHE ENV #####

##### FREETDS ENV #####
FREETDSCONF=/Users/tvitoux/Mamp/common/etc/freetds.conf
export FREETDSCONF
FREETDSLOCALES=/Users/tvitoux/Mamp/common/etc/locales.conf
export FREETDSLOCALES
##### CURL ENV #####
CURL_CA_BUNDLE=/Users/tvitoux/Mamp/common/openssl/certs/curl-ca-bundle.crt
export CURL_CA_BUNDLE
##### SSL ENV #####
SSL_CERT_FILE=/Users/tvitoux/Mamp/common/openssl/certs/curl-ca-bundle.crt
export SSL_CERT_FILE
OPENSSL_CONF=/Users/tvitoux/Mamp/common/openssl/openssl.cnf
export OPENSSL_CONF
OPENSSL_ENGINES=/Users/tvitoux/Mamp/common/lib/engines
export OPENSSL_ENGINES


. /Users/tvitoux/Mamp/scripts/build-setenv.sh
