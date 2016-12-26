from centos:6

RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm
RUN rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm
RUN yum install php56w php56w-opcache -y && yum clean all
RUN yum install php56w-devel.x86_64 -y && yum clean all
RUN yum install gcc -y && yum clean all

COPY ./data /data

WORKDIR /data
RUN yum install oracle-instantclient12.1-basic-12.1.0.2.0-1.x86_64.rpm -y && yum clean all
RUN yum install oracle-instantclient12.1-devel-12.1.0.2.0-1.x86_64.rpm -y && yum clean all
RUN export LD_LIBRARY_PATH=/usr/lib/oracle/12.1/client64/lib:$LD_LIBRARY_PATH
RUN tar zxvf oci8-2.0.12.tgz

WORKDIR /data/oci8-2.0.12
RUN phpize
RUN ./configure --with-oci8=shared,instantclient,/usr/lib/oracle/12.1/client64/lib
RUN make && make install

COPY ./php.ini /etc/php.ini
WORKDIR /data