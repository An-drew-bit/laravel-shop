## About Laravel

### Чистый запуск
```
{%project_folder%}: cp ./env.example ./.env
{%project_folder%}: composer install
{%project_folder%}: php artisan migrate --seed
{%project_folder%}: php artisan artisan storage:link
```

### Для локального запуска
```
{%project_folder%}: php artisan serve
http://127.0.0.1:8000
```
