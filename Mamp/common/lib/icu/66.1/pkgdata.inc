GENCCODE_ASSEMBLY_TYPE=-a gcc-darwin
SO=dylib
SOBJ=dylib
A=a
LIBPREFIX=lib
LIB_EXT_ORDER=.66.1.dylib
COMPILE=gcc -DU_ATTRIBUTE_DEPRECATED= -DAI_ADDRCONFIG=0 -I/bitnami/mamp74stack-osx-x64/output/sqlite/include -I/Users/tvitoux/Mamp/common/include -I/bitnami/mamp74stack-osx-x64/output/mysql/include -I/Users/tvitoux/Mamp/common/include/sasl -I/Users/tvitoux/Mamp/common/include -arch x86_64   -DU_HAVE_STRTOD_L=1 -DU_HAVE_XLOCALE_H=1  -I/bitnami/mamp74stack-osx-x64/output/mysql/include -I/Users/tvitoux/Mamp/common/include -arch x86_64 -std=c11 -Wall -pedantic -Wshadow -Wpointer-arith -Wmissing-prototypes -Wwrite-strings   -fno-common -c
LIBFLAGS=-I/Users/tvitoux/Mamp/common/include  -dynamic
GENLIB=gcc -dynamiclib -dynamic -I/bitnami/mamp74stack-osx-x64/output/mysql/include -I/Users/tvitoux/Mamp/common/include -arch x86_64 -std=c11 -Wall -pedantic -Wshadow -Wpointer-arith -Wmissing-prototypes -Wwrite-strings   -L/bitnami/mamp74stack-osx-x64/output/sqlite/lib -L/bitnami/mamp74stack-osx-x64/output/mysql/include -L/Users/tvitoux/Mamp/common/lib -arch x86_64  
LDICUDTFLAGS=
LD_SONAME=-Wl,-compatibility_version -Wl,66 -Wl,-current_version -Wl,66.1 -install_name  
RPATH_FLAGS=
BIR_LDFLAGS=
AR=ar
ARFLAGS=r -c
RANLIB=ranlib
INSTALL_CMD=/usr/bin/install -c
