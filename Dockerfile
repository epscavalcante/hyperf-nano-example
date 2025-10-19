FROM hyperf/hyperf:8.4-alpine-v3.21-swoole-slim AS build

# Dependências temporárias para instalar vendors
RUN apk add --no-cache git zip unzip

WORKDIR /app

COPY composer.json composer.lock ./

# Instalar apenas pacotes de produção
RUN composer install --no-dev --optimize-autoloader --classmap-authoritative --no-scripts --no-progress --prefer-dist

# Copiar código da aplicação
COPY . .

FROM hyperf/hyperf:8.4-alpine-v3.21-swoole-slim

WORKDIR /app

# Copiar vendor e app já prontos
COPY --from=build /app /app

# Variáveis de runtime mais importantes
ENV APP_ENV=prod \
    SCAN_CACHEABLE=true \
    SWOOLE_HOOK_FLAGS=0

EXPOSE 9501

# Start da aplicação Hyperf Nano
CMD ["php", "hyperf.php", "start"]
