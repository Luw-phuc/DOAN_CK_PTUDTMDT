# Sử dụng image PHP với Apache
FROM php:8.0-apache

# Cài đặt các phần mềm cần thiết
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cài đặt các phần mở rộng PHP nếu cần
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy mã nguồn ứng dụng vào thư mục htdocs của Apache
COPY . /var/www/html/

# Mở cổng 80 để có thể truy cập qua HTTP
EXPOSE 80