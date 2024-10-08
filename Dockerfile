# ベースイメージとしてPHPとApacheを使用
FROM php:8.0-apache

# 環境変数の設定
ARG DATABASE_URL
ENV DATABASE_URL=$DATABASE_URL

# Node.jsのインストール (Node.js 18.xをインストール)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# 作業ディレクトリを指定
WORKDIR /var/www/html

# package.jsonとpackage-lock.jsonを最初にコピーして依存関係をインストール
COPY package*.json ./
RUN npm install

# Tailwindの設定ファイルとソースファイルをコピーしてビルド
COPY src/css ./src/css
COPY tailwind.config.js ./
RUN npm run build:css

# プロジェクトのすべてのファイルをコンテナ内にコピー
COPY . .

# 必要なPHP拡張モジュールをインストールし、libpqを最新バージョンにアップグレード
RUN apt-get update && apt-get install -y wget gnupg2 \
    && wget --quiet -O /usr/share/keyrings/postgresql.asc https://www.postgresql.org/media/keys/ACCC4CF8.asc \
    && echo "deb [signed-by=/usr/share/keyrings/postgresql.asc] http://apt.postgresql.org/pub/repos/apt bullseye-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
    && apt-get update \
    && apt-get install -y postgresql-client libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# libpqのバージョンを確認するためにpg_configを使用
RUN pg_config --version && echo "libpq version check completed"

# アップロードフォルダが存在しない場合に作成し、権限を設定
RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/uploads \
    && chmod -R 755 /var/www/html/uploads

# 必要なポートを公開
EXPOSE 80
