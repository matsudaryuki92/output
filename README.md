# output
<h2>環境構築</h2>
<p>Docker ビルド</p>
<ol>
<li>git clone https://github.com/matsudaryuki92/output.git</li>
<li>docker-compose up -d --build
</ol>
<p>※MySQLは、OSによって起動しない場合があるのでそれぞのPCに合わせてdocker-compose.ymlファイルを編集してください。</p>
<p>Laravel環境構築</p>
<ol>
<li>docker-compose exec php bash</li>
<li>composer install</li>

<li>.env.exampleファイルから.envを作成し、環境変数を変更</li>
DB_CONNECTION=mysql<br>
DB_HOST=mysql<br>
DB_PORT=3306<br>
DB_DATABASE=laravel_db<br>
DB_USERNAME=laravel_user<br>
DB_PASSWORD=laravel_pass<br>

<li>php artisan key:generate</li>
<li>php artisan migrate</li>
<li>php artisan db:seed</li>
</ol>
<h2>使用技術</h2>
<ul>
<li>PHP 8.0</li>
<li>Laravel 10.0</li>
<li>MySQL 8.0</li>
</ul>
<h2>URL</h2>
<ul>
<li>開発環境：http://localhost/</li>
<li>phpMyAdmin：http://localhost:8080/</li>
</ul>
