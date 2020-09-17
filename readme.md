
## Установка проекта

1. Склонировать проект и настроить nginx или apache до папки `public` в директории проекта
2. В папке c проектом запустить composer install
3. Создать новый файл `.env` на основе `.env.example`
4. Создать БД и настроить подключение в файле `.env`, строки `DB_DATABASE, DB_USERNAME, DB_PASSWORD` 
5. Запустить команду `php artisan key:generate`
6. Запускаем миграции `php artisan migrate` и можно будет приступить к тестированию
