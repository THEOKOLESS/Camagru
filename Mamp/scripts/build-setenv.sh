#!/bin/sh
LDFLAGS="-L/Users/tvitoux/Mamp/common/lib $LDFLAGS"
export LDFLAGS
CFLAGS="-I/Users/tvitoux/Mamp/common/include/ImageMagick -I/Users/tvitoux/Mamp/common/include $CFLAGS"
export CFLAGS
CXXFLAGS="-I/Users/tvitoux/Mamp/common/include $CXXFLAGS"
export CXXFLAGS
		    
PKG_CONFIG_PATH="/Users/tvitoux/Mamp/common/lib64/pkgconfig:/Users/tvitoux/Mamp/common/lib/pkgconfig"
export PKG_CONFIG_PATH
