# ベースイメージとしてPHPとApacheを使用
FROM php:8.0-apache

# 作業ディレクトリを指定
WORKDIR /var/www/html

# プロジェクトのすべてのファイルをコンテナ内にコピー
COPY . .

# アップロードフォルダが存在しない場合に作成
RUN mkdir -p /var/www/html/uploads

# 必要なPHP拡張モジュールをインストール
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# アップロードフォルダのパーミッションを設定
RUN chmod -R 755 /var/www/html/uploads
