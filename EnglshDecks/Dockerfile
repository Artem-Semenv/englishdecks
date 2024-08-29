# Используем официальный PHP-образ
FROM php:8.2-fpm

# Устанавливаем необходимые системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Устанавливаем PHP-расширения
RUN docker-php-ext-install pdo pdo_pgsql

# Копируем приложение в контейнер
COPY . /var/www

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Удаляем старые зависимости и файл блокировки, если они есть
RUN rm -rf node_modules package-lock.json
RUN npm cache clean --force

# Устанавливаем зависимости для фронтенда
RUN npm install

# Выполняем сборку фронтенда с использованием npx
RUN npx vite build

# Открываем порты
EXPOSE 8000

# Запуск PHP-сервера
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
