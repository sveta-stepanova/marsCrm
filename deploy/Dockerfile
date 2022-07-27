FROM gitlab.russiadirect.ru:4567/docker/nginx-php72
LABEL maintainer="Roman Tamashevsky <r_tamashevsky@russiadirect.ru>"


#================================================================================= CONF

ADD freetds.conf /etc/freetds/
ADD nginx.conf /etc/nginx/
ADD php-fpm.ini /etc/php/7.2/fpm/php.ini

#=========================== content
ADD html /var/www
ADD env.env /var/www/.env
WORKDIR /var/www

RUN php /composer.phar install 

#========================================cron
ADD cron.cron /cron.cron
RUN crontab /cron.cron

# ============================================================================= START
ADD start.sh /start.sh
RUN chmod 755 /start.sh
EXPOSE 80
CMD ["/start.sh"]