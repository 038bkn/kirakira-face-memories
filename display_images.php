<?php

require './config.php';

// 画像情報をデータベースから取得
$sql = "SELECT file_name, upload_date, kirari_score, comments FROM new_images";
$stmt = $pdo->query($sql);

// 星を表示する関数
function getStars($score) {
    $stars = floor($score / 20); // 0-100のスコアを5段階に変換
    return str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Images</title>
    <style>
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .image-item {
            margin: 10px;
        }
        img {
            max-width: 200px;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Uploaded Images</h1>
    <div class="image-gallery">
        <?php while ($row = $stmt->fetch()): ?>
            <div class="image-item">
                <img src="uploads/<?= htmlspecialchars($row['file_name']); ?>" alt="<?= htmlspecialchars($row['file_name']); ?>">
                <p>Uploaded on: <?= htmlspecialchars($row['upload_date']); ?></p>
                <p>キラリ☆度: <?= htmlspecialchars($row['kirari_score']); ?>点</p>
                <p>評価: <?= getStars($row['kirari_score']); ?></p>
                <p>コメント: <?= htmlspecialchars($row['comments']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
