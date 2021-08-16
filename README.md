Эмулятор грузовиков (Тут нам предстоит покупать гаражи, грузовики, нанимать водителей и отпавлять их на рейс)
В начале игроку доступно 10 000 ед. денег, на которые он покупает грузовики и гаражи.\
Игрок решает лишь кого нанять и на что потратить деньги. 
Есть корреляция между возрстом водителя и тем, сколько денег он приносит: молодые водители выполняют заказ быстрее, но опытные находят работу быстрее.

#Стек:
Laravel8\Bootstrap
#TODO:
- Переделать внешний вид с использованием VueJS либо React
- Провести рефактор внешних элементов, переименовать кнопки и заголовки
- Исправить существующие баги
- Дополнить тестами
- Доделать окна просмотра водителей (drivers/{id}) и гаражей (garages/{id})
#Установка:
- composer install 
- php artisan migrate\
- php artisan db:seed\
- npm install & npm run dev
- Если символическая ссылка не работает, создать её:\
app/storage/characters -> /public \
- Добавить обработчик заданий (USERNAME заменить на соответствующего пользователя): \
\* *     * * *   USERNAME cd /var/www/html/trucks && php artisan schedule:run >> /dev/null 2>&1\
![Иллюстрация к проекту](https://github.com/Shenter/truckmanager/raw/master/trucks.png)
