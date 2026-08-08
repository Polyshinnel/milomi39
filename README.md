# Milomi39

Laravel 13 с Filament 5, Tailwind CSS 4, PHP 8.4, Node.js/npm и MySQL 8.4.

## Запуск в Docker

Порты по умолчанию выбраны из свободных на машине:

- сайт: [http://localhost:8098](http://localhost:8098)
- админка Filament: [http://localhost:8098/admin](http://localhost:8098/admin)
- MySQL с хоста: `127.0.0.1:3308`

Собрать образ и запустить сервисы:

```bash
docker compose up --build -d
docker compose ps
```

При первом старте приложение дождётся MySQL и автоматически применит миграции. Данные базы и содержимое `storage` сохраняются в Docker volumes.

Создать первого администратора интерактивно:

```bash
docker compose exec app php artisan make:filament-user
```

Остановить контейнеры:

```bash
docker compose down
```

Чтобы также удалить локальные данные MySQL и Laravel storage:

```bash
docker compose down -v
```

## Работа с PHP и frontend

Composer, Node.js и npm уже находятся в контейнере приложения:

```bash
docker compose exec app php -v
docker compose exec app composer --version
docker compose exec app node --version
docker compose exec app npm --version
```

После изменения PHP-кода или frontend-файлов пересоберите приложение:

```bash
docker compose up --build -d app
```

Переопределить порты и реквизиты базы можно через локальный `.env`, например:

```dotenv
APP_PORT=8090
DB_FORWARD_PORT=3310
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel
DB_ROOT_PASSWORD=root
```
