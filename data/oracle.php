<?php
    /**
        install php5.6
        rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm
        rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm
        yum install php56w php56w-opcache -y
        yum install php56w-devel.x86_64
        yum install gcc
    
        // download rpm from http://www.oracle.com/technetwork/cn/topics/linuxx86-64soft-092277.html
        yum install oracle-instantclient12.1-basic-12.1.0.2.0-1.x86_64.rpm
        export LD_LIBRARY_PATH=/usr/lib/oracle/12.1/client64/lib:$LD_LIBRARY_PATH
        export PATH=/usr/lib/oracle/12.1/client64/bin:$PATH
        curl -O https://pecl.php.net/get/oci8-2.0.12.tgz
        tar zxvf oci8-2.0.12.tgz
        cd oci8-2.0.12
        phpize

        ./configure --with-php-config=/usr/bin/php-config

    **/
    
    var_dump('start..');
    $conn = oci_connect('system', 'oracle', '192.168.2.1:49161/xe', 'AL32UTF8');
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // Prepare the statement
    $stid = oci_parse($conn, 'select * from test');
    if (!$stid) {
        $e = oci_error($conn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // Perform the logic of the query
    $r = oci_execute($stid);
    if (!$r) {
        $e = oci_error($stid);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // Fetch the results of the query
    print "<table border='1'>\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        print "<tr>\n";
        foreach ($row as $item) {
            print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        print "</tr>\n";
    }
    print "</table>\n";

    oci_free_statement($stid);
    oci_close($conn);
