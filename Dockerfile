FROM hyperf/hyperf:8.4-alpine-v3.21-swoole-slim

WORKDIR /var/www

COPY . /var/www

RUN composer install --no-interaction

EXPOSE 9051

ENTRYPOINT ["php", "hyperf.php", "start"]