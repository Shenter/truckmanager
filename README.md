Trucks & stocks (stocks links are hidden only)
Installation:\
php artisan migrate\
php artisan db:seed\
execute route '/seed' & delete route \
create symlink from app/storage/characters to /public \
add job listener to crontab: \
\* *     * * *   USERNAME cd /var/www/html/trucks && php artisan schedule:run >> /dev/null 2>&1
