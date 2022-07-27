#!/bin/bash

echo "================================================ Start NGINX"
service nginx stop && service nginx start

echo "================================================ Start FPM"
service php7.2-fpm stop && service php7.2-fpm start

echo "================================================ CRON"
service cron stop && service cron start 




while /bin/true; do

    ps auxw | grep -P '\b'nginx'(?!-)\b' >/dev/null
    if [ $? != 0 ]
    then
        echo "nginx stopped";
        exit -1
    fi;

    ps auxw | grep -P '\b'php-fpm'(?!-)\b' >/dev/null
    if [ $? != 0 ]
    then
        echo "php-fpm stopped";
        exit -1
    fi;

    ps auxw | grep -P '\b'cron'(?!-)\b' >/dev/null
    if [ $? != 0 ]
    then
        echo "crontab is stopped";
        exit -1
    fi;


    sleep 30
done




