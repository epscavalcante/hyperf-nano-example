FROM hyperf/hyperf:8.4-alpine-v3.21-swoole-slim

#ARG user=application
#ARG uid=1000

#RUN adduser -D -u $uid $user \
    # && addgroup $user www-data \
    # && mkdir -p /home/$user/.composer \
    # && chown -R $user:$user /home/$user

WORKDIR /var/www

COPY . /var/www

# Instala a extensão pcov via repositório do Alpine
RUN apk add --no-cache php84-pecl-pcov

# Configurações de cobertura
RUN echo "pcov.enabled=1" > /etc/php84/conf.d/50_pcov.ini \
    && echo "pcov.directory=/var/www" >> /etc/php84/conf.d/50_pcov.ini \
    && echo "pcov.exclude=\"~vendor~\"" >> /etc/php84/conf.d/50_pcov.ini

RUN git config --global --add safe.directory /var/www

EXPOSE 9501

CMD [ "tail", "-f", "/dev/null" ]
