<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## О приложении

Приложение реализовано на laravel 9.x, с помощью пакета sail в docker контейнере.

## Запуск и первичная настройка
После клонирования репозитория выполните следующую последовательность команд в консоле:

- composer install (если команды из секции scripts не выполнились, то введите их в ручную) 
- php artisan sail install (выберите 0, это бд mysql)
- alias sail="./vendor/bin/sail"
- sail up -d
- sail php artisan migrate
- sail php artisan db:seed --class=ProductSeeder
- sail php artisan db:seed --class=CategorySeeder
- sail php artisan db:seed --class=ProductCategorySeeder

В корне приложения сохранена коллекция запросов для postman.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# test-laravel-restfull
