** php5.6 support oracle. **

// install php5.6
```
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm
yum install php56w php56w-opcache -y
yum install php56w-devel.x86_64
yum install gcc
```

// download rpm from http://www.oracle.com/technetwork/cn/topics/linuxx86-64soft-092277.html
```
yum install oracle-instantclient12.1-basic-12.1.0.2.0-1.x86_64.rpm
export LD_LIBRARY_PATH=/usr/lib/oracle/12.1/client64/lib:$LD_LIBRARY_PATH
export PATH=/usr/lib/oracle/12.1/client64/bin:$PATH
curl -O https://pecl.php.net/get/oci8-2.0.12.tgz
tar zxvf oci8-2.0.12.tgz
cd oci8-2.0.12
phpize

./configure --with-php-config=/usr/bin/php-config
```

