## About Laravel

### Чистый запуск
```
{%project_folder%}: cp ./env.example ./.env
{%project_folder%}: composer install
{%project_folder%}: npm install
{%project_folder%}: php artisan shop:install
```

### Для локального запуска
```
{%project_folder%}: php artisan serve
http://127.0.0.1:8000
```

### Логи отправляются в телеграм, вам потребуется создать бота и чат с ним
```
TELEGRAM_BOT_TOKEN=
TELEGRAM_CHAT_ID=
```
