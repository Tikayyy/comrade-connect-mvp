# How To Deploy

### For first time only !
- `docker compose up -d --build`
- `docker compose exec php bash`
- `chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache`
- `chmod -R 775 /var/www/storage /var/www/bootstrap/cache`
- `composer setup`

### From the second time onwards
- `docker compose up -d`

# Other

### Basic docker compose commands
- Build or rebuild services
    - `docker compose build`
- Create and start containers
    - `docker compose up -d`
- Stop and remove containers, networks
    - `docker compose down`
- Stop all services
    - `docker compose stop`
- Restart service containers
    - `docker compose restart`
- Run a command inside a container
    - `docker compose exec [container] [command]`

### Useful Laravel Commands
- Display basic information about your application
    - `php artisan about`
- Remove the configuration cache file
    - `php artisan config:clear`
- Flush the application cache
    - `php artisan cache:clear`
- Clear all cached events and listeners
    - `php artisan event:clear`
- Delete all of the jobs from the specified queue
    - `php artisan queue:clear`
- Remove the route cache file
    - `php artisan route:clear`
- Clear all compiled view files
    - `php artisan view:clear`
- Remove the compiled class file
    - `php artisan clear-compiled`
- Remove the cached bootstrap files
    - `php artisan optimize:clear`
- Delete the cached mutex files created by scheduler
    - `php artisan schedule:clear-cache`
- Flush expired password reset tokens
    - `php artisan auth:clear-resets`

### Laravel Pint (Code Style Fixer | PHP-CS-Fixer)
- Format all files
    - `vendor/bin/pint`
- Format specific files or directories
    - `vendor/bin/pint app/Models`
    - `vendor/bin/pint app/Models/User.php`
- Format all files with preview
    - `vendor/bin/pint -v`
- Format uncommitted changes according to Git
    - `vendor/bin/pint --dirty`
- Inspect all files
  - `vendor/bin/pint --test`


# TODO

### Пользователь [+]
    1) Регистрация [+]
      1.1) Ник, Пароль, Почта с подтверждением [+]
    2) Авторизация [+]
        2.1) Почта, Пароль [+]
    3) Друзья [+]
        3.1) Заявка в друзья [+]
        3.2) Добавления в друзья [+]
        3.3) Удаления из друзей [+]

### Сервера [+]
    1) Создание [+]
    2) Приглашение [+]
    3) Вход [+]
    4) Удаление [+]

### Канал [-]
    1) Создание [+]
    2) Удаление [+]
    3) Вход [-]
    4) Чат [-]
    5) Доступ [-]
    6) WebRTC [-]
    7) Демонстрация экрана [-]

### Чат (Личный + Чат канала) [-]
    1) Писать [-]
    2) Читать [-]
    3) Количество новых сообщений [-]
    4) Уведомления [-]
