FROM php:8.2-apache

# Копируем все PHP файлы в корень веб-сервера
COPY . /var/www/html/

# Убеждаемся, что Apache видит index.php как индексный файл
# (ваш proxy.php будет доступен по /proxy.php)
