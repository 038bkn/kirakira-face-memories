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

# libpqのバージョンを確認するためにpg_configを使用し、明示的に出力
RUN apt-get install -y postgresql-client && pg_config --version && echo "libpq version check completed"

# アップロードフォルダが存在しない場合に作成
RUN mkdir -p /var/www/html/uploads

# アップロードフォルダのパーミッションを設定
RUN chmod -R 755 /var/www/html/uploads
