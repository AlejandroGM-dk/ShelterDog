FROM php:8.2-cli-bookworm

# Instalar dependencias del sistema
RUN apt update && apt install -y \
    curl \
    git \
    unzip \
    libzip-dev \
    libxml2-dev \
    libsqlite3-dev \
    libmariadb-dev \
    && docker-php-ext-install \
        bcmath \
        pdo \
        pdo_sqlite \
        pdo_mysql \
        zip \
    && docker-php-ext-enable \
        pdo_sqlite \
        pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
