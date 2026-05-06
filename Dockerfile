FROM ubuntu:24.04
ENV DEBIAN_FRONTEND=noninteractive
WORKDIR /app
RUN apt-get update && apt-get install -y --no-install-recommends \
    php8.3-cli php8.3-intl php8.3-mbstring php8.3-curl php8.3-mysql php8.3-zip curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
COPY . .
RUN composer install --no-interaction
EXPOSE 8080
CMD ["php", "spark", "serve", "--host=0.0.0.0", "--port=8080"]