FROM ujhgj/php7.1:0.0.1 as php

COPY --chown=www-data:www-data . /opt/app
#RUN composer install --no-scripts


FROM nginx:1.15.8-alpine as nginx
COPY --chown=nginx:nginx ./public /opt/app/public
COPY ./deploy/configs/newsletters-demo.conf /etc/nginx/conf.d/default.conf
