![title-logo](./public/img/title_logo.jpg)
### License
The SF-AdTech is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## About SF-AdTech

SF-AdTech — это трекер трафика, созданный для организации взаимодействия компаний (рекламодателей), которые хотят привлечь к себе на сайт посетителей и покупателей (клиентов), и владельцев сайтов (веб-мастеров), на которые люди приходят, например, чтобы почитать новости или пообщаться на форуме.

# Installation
Выполните необходимые команды и рекоммендации:

1. cp .env.example .env
2. "в файле .env подключите DB"
3. composer require --dev
4. php artisan storage:link
5. php artisan key:generate 
6. php artisan migrate --seed
7. npm install
8. npm run build

## Tech Stack
### backend:
* Laravel11/Sanctum/Pusher
### frontend:
* Vue3/Vuex4/VueRouter/vue-sweetalert2
  
## Role Advertiser
Options:
* Зарегистрироваться в системе;
* Авторизоваться в системе;
* Посмотреть список созданных им offer-ов;
* Увидеть кол-во веб-мастеров, подписанных на каждый из offer-ов;
* Создать новый offer:
* Указать имя offer-а;
* Указать стоимость перехода;
* Указать целевой URL;
* Определить темы сайта;
* Снаять offer c публикации;
* Посмотреть расходы и кол-во переходов по offer-у в разрезах:
* День;
* Месяц;
* Год.

## Role Webmaster
Options:
* Зарегистрироваться в системе;
* Авторизоваться в системе;
* Посмотреть список offer-ов, на которые он подписан;
* Подписаться на новый offer:
* Указать стоимость перехода;
* Получить ссылку системы;
* Отписаться от offer-а;
* Посмотреть доходы и кол-во переходов по offer-у в разрезах:
* День;
* Месяц;
* Год.

## Role Administrator
Oprions:
* авторизовывать на работу новых рекламодателей и веб-мастеров;
* Блокировать пользователей;
* Контроль общего дохода системы;
* Вывод статистики по:
* выданным ссылкам;
* переходам;
* отказам ;

## Redirector
Система-редиректор SF-AdTech
Система обеспечивает весь цикл переходов в системе и сбор статистики.

### Система умеет:

* Получать информацию о ссылке, по которой кликнул клиент в момент перехода с сайта веб-мастера;
* Зафиксировать в логах факт перехода;
* Проверить, что веб-мастер подписан на offer, к которому привязана ссылка:
* Если веб-мастер не подписан на offer, то скидывать на 404;
* Преобразовать клик-ссылку в целевой URL;
* Перенаправить клиента на целевой URL;
* Зафиксировать факт перенаправления.
