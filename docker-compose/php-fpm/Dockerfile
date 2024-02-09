# Source: https://www.techiediaries.com/docker-compose-laravel/
# Source: https://www.digitalocean.com/community/tutorials/how-to-install-and-set-up-laravel-with-docker-compose-on-ubuntu-20-04-es

FROM php:7.4-fpm

# increase the memory limit
RUN echo "memory_limit=-1" > $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "upload_max_filesize=100M" > $PHP_INI_DIR/conf.d/upload_max_filesize.ini
RUN echo "post_max_size=100M" > $PHP_INI_DIR/conf.d/post_max_size.ini
RUN echo "max_execution_time=300" > $PHP_INI_DIR/conf.d/max_execution_time.ini



# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring pcntl bcmath gd mysqli

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user

EXPOSE 3306




