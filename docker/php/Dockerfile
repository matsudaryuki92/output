FROM php:8.2-fpm

# PHP 設定ファイルのコピー
COPY php.ini /usr/local/etc/php/

# 必要なパッケージと PHP 拡張をインストール
RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip

# Composer を公式の推奨方法でインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 作業ディレクトリの設定
WORKDIR /var/www
