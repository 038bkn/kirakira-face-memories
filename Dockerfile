# ベースイメージとしてPHPとApacheを使用
FROM php:8.0-apache

# 環境変数の設定
ARG DATABASE_URL
ENV DATABASE_URL=$DATABASE_URL

# 作業ディレクトリを指定
WORKDIR /var/www/html

# プロジェクトのすべてのファイルをコンテナ内にコピー
COPY . .

# 必要なPHP拡張モジュールをインストールし、libpqをアップグレード
RUN apt-get update && apt-get install -y libpq-dev \
    && apt-get install -y libssl-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# libpqのバージョンを確認するためのコマンドを追加
RUN psql --version

# アップロードフォルダが存在しない場合に作成
RUN mkdir -p /var/www/html/uploads

# アップロードフォルダのパーミッションを設定
RUN chmod -R 755 /var/www/html/uploads
