環境構築

Dockerビルド
- git clone git@github.com:nekomajin-1017/contact-form2.git
- docker-compose up -d --build

Laravel環境構築
- docker-compose exec php bash
- composer install
- cp .env.example .env, 環境変数を適宜変更
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

開発環境
- お問い合わせ画面：http://localhost/
- ログイン画面：http://localhost/login
- ユーザー登録：http://localhost/register
- 管理画面：http://localhost/admin
- phpMyAdmin：http://localhost:8080/

使用技術(実行環境)
- PHP 8.1.34
- Laravel 8.83.8
- MySQL 8.0.26
- nginx 1.21.1

ER図
![作成したER図の画像](/contact-form.drawio.png)