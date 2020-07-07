# laravel_tutorial
研修用

// 以下のコマンドを打ち、docker環境を構築
git clone https://github.com/seiyakidokoro/laravel_tutorial.git
docker-compose up -d
docker-compose exec app bash
cd my-laravel-app
composer install
cp .env.example .env
php artisan key:generate
