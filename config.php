<?php
$dsn = getenv('DATABASE_URL');

try {
    $pdo = new PDO($dsn, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // エラーメッセージを出力し、スクリプトを終了
    exit('Database connection failed: ' . $e->getMessage());
}
