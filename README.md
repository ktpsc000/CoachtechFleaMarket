# CoachtechFleaMarket

## 環境構築
**Dockerビルド**

#### 1.リポジトリをクローン
```bash
git clone git@github.com:ktpsc000/CoachtechFleaMarket.git
```

#### 2.ディレクトリへ移動
```bash
cd CoachtechFleaMarket
```

#### 3.DockerDesktopアプリを立ち上げる

#### 4.Dockerコンテナをビルド・起動
```bash
docker compose up -d --build
```

> *MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください*
``` bash
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```

**Laravel環境構築**

#### 1.PHPコンテナへログイン
```bash
docker compose exec php bash
```
#### 2.Composerをインストール
```bash
composer install
```

#### 3.Stripeをインストール
```bash
composer require stripe/stripe-php
```

#### 4.`.env`ファイルを作成
```bash
cp .env.example .env
```

#### 5.`.env`に以下の環境変数を追加

``` env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=test@example.com
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_KEY=pk_test_xxxxxxxxx
STRIPE_SECRET=sk_test_xxxxxxxxx
```
#### 6.アプリケーションキーの作成
``` bash
php artisan key:generate
```

#### 7.ディレクトリ権限の設定
```bash
mkdir -p storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

#### 8.マイグレーションの実行
``` bash
php artisan migrate
```

#### 9.シーディングの実行
``` bash
php artisan db:seed
```

#### 10.シンボリックリンク作成
``` bash
php artisan storage:link
```

#### 11.設定の反映
``` bash
php artisan config:clear
php artisan config:cache
exit
```
## テスト環境の構築

#### 1.`env.testing`ファイルを作成
```bash
cp .env.example .env.testing
```

#### 2.`env.testing`に以下を設定

```env.testing
.enn.testingの内容書く
```
#### 3.テスト用データベースの作成
```bash
docker compose exec mysql bash
mysql -u laravel_user -p
```



## Stripe APIキーの設定

#### 本アプリでは、オンライン決済サービスのStripeを利用しています。各自でAPIキーを取得し、設定してください。

#### 1. Stripeアカウントの作成
https://stripe.com/jp
 にアクセスし、アカウントを作成します。

#### 2. APIキーの取得
Stripeダッシュボードから以下を取得します。

- 公開可能キー（Publishable Key）
- シークレットキー（Secret Key）

#### 3. .envに設定
```env
STRIPE_KEY=pk_test_xxxxxxxxxxxxxxxxxxxxx
STRIPE_SECRET=sk_test_xxxxxxxxxxxxxxxxxxxxx
```

### 💳Stripeテストカード

#### 決済成功用
| 項目 | 値 |
|---|---|
| カード番号 | 4242 4242 4242 4242 |
| 有効期限 | 任意（例：12/34） |
| CVC | 任意（例：123） |
| 名義 | 任意 |

#### 決済失敗用
| 項目 | 値 |
|---|---|
| カード番号 | 4000 0000 0000 0002 |

## 使用技術(実行環境)
- PHP 8.1.34
- Laravel 8.83.29
- MySQL 8.0.26
- nginx 1.21.1
- mailhog
- Stripe

## ER図
![ER図](index.drawio.png)

## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/


## 内容
購入時、カード決済の場合はstripe決済画面へ移行する

※もしかしたら、、、
.env.testingとか作る指示必要かも？