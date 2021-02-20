# DDBMS Server

1. Add Database,MySQL User
2. Run Shell Code
```shell
composer install 
cp .env.example .env
chown -R www-data:www-data *
php artisan migrate:refresh --seed
npm install
npm run dev
php artisan key:generate
```
