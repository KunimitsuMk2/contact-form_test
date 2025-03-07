<h1>お問い合わせフォーム</h1>

<h2>環境構築</h2>
<h3>Dockerビルド</h3>
<span>1 git clone リンク</span> <br>
<span>2 docker-compose up -d -build <br>
<br>
<span>MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。
<br>
<h3>Laravel開発環境</h3>　<br>
<span>1 docker-compose exec php bash <br>
<span>2 composer install <br>
<span>3 .env.exampleファイルから.envを作成し、環境変数を変更 <br>
<span>4 php artisan key:generate <br>
<span>5 php artisan migrate <br>
<span>6 php artisan db:seed <br>
<h3>使用技術</h3><br>
<li>
<ul> PHP 8.4.4
<ul> Laravel 8.83.8
<ul> MySQL 8.02.6
</li>
<h3>URL</h3>
<span>開発環境: http://localhost/</span>
<span>phpMyAdmin: http://localhost:8080/
</span>
