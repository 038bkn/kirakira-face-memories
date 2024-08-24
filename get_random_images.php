<?php

require './config.php';

// 画像をランダムに取得
$sql = "SELECT file_name, kirari_score FROM new_images ORDER BY RAND() LIMIT 5";
$stmt = $pdo->query($sql);

$images = [];
while ($row = $stmt->fetch()) {
    $images[] = [
        'file_name' => $row['file_name'],
        'kirari_score' => $row['kirari_score'],
        'comment' => getRandomComment($row['kirari_score']) // ランダムコメントを追加
    ];
}

// JSON形式で返す
header('Content-Type: application/json');
echo json_encode($images);
