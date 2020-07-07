# laravel_tutorial
研修用

以下のコマンドを打ち、docker環境を構築
git clone https://github.com/seiyakidokoro/laravel_tutorial.git <br>
cd my-laravel-app <br>
docker-compose up -d <br>
docker-compose exec app bash <br>
cd my-laravel-app <br>
composer install <br>
cp .env.example .env <br>
php artisan key:generate <br>
以下URLにアクセス <br>
http://localhost:8080/
