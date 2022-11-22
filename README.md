## About Laravel

## Docker
```
{%project_folder%}: docker-compose up -d
http://localhost:8080
```

### Чистый запуск
```
{%project_folder%}: cp ./env.example ./.env and ./env.testing.example ./.env.testing
{%project_folder%}: composer install
{%project_folder%}: npm install
{%project_folder%}: php artisan shop:install
```

### Для локального запуска
```
{%project_folder%}: php artisan serve
http://127.0.0.1:8000
```

### Smtp mailhog
```
MAIL_HOST=localhost
MAIL_PORT=1025
http://localhost:8025
```

### Логи отправляются в телеграм, вам потребуется создать бота и чат с ним
```
TELEGRAM_BOT_TOKEN=
TELEGRAM_CHAT_ID=
```
