# ベースイメージとしてPHPとApacheを使用
FROM php:8.0-apache

# 作業ディレクトリを指定
WORKDIR /var/www/html

# プロジェクトのすべてのファイルをコンテナ内にコピー
COPY . .

# 必要なPHP拡張モジュールをインストール
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# アップロードフォルダのパーミッションを設定
RUN chmod -R 755 /var/www/html/uploads

# Apacheの設定をリロードして反映
RUN service apache2 restart
