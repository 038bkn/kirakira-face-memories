# ベースイメージとしてPHPとApacheを使用
FROM php:8.0-apache

# 環境変数の設定
ARG DATABASE_URL
ENV DATABASE_URL=$DATABASE_URL

# 作業ディレクトリを指定
WORKDIR /var/www/html

# プロジェクトのすべてのファイルをコンテナ内にコピー
COPY . .

# 必要なPHP拡張モジュールをインストールし、libpqを最新バージョンにアップグレード
RUN apt-get update && apt-get install -y wget gnupg2 \
    && echo "deb http://apt.postgresql.org/pub/repos/apt/ $(lsb_release -cs)-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
    && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - \
    && apt-get update \
    && apt-get install -y postgresql-client libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# libpqのバージョンを確認するためにpg_configを使用
RUN pg_config --version && echo "libpq version check completed"

# アップロードフォルダが存在しない場合に作成
RUN mkdir -p /var/www/html/uploads

# アップロードフォルダのパーミッションを設定
RUN chmod -R 755 /var/www/html/uploads
