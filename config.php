<?php
// 環境変数から `DATABASE_URL` を取得
$url = parse_url(getenv('DATABASE_URL'));

$host = $url["host"];  // ホスト名
$port = isset($url["port"]) ? $url["port"] : 5432;  // ポート番号を手動で設定
$user = $url["user"];  // ユーザー名
$pass = $url["pass"];  // パスワード
$dbname = ltrim($url["path"], '/');  // データベース名

// DSN (Data Source Name) を構築
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass;options=--endpoint%3Dep-rapid-waterfall-a13gyfxn;sslmode=require";

try {
    // PDOオブジェクトを作成し、データベースに接続
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // エラーが発生した場合の処理
    exit("Database connection failed: " . $e->getMessage());
}
?>
