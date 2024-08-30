<?php

require './config.php';

$imageData = null;

// 画像IDが指定されている場合
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT file_name, kirari_score, comments FROM new_images WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果が存在する場合
    if ($stmt->rowCount() > 0) {
        $imageData = $stmt->fetch();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>キラリ☆評価画面</title>
    <link rel="stylesheet" href="/src/css/common.css">
    <link rel="stylesheet" href="/src/css/kirari_score.css">
    <link rel="stylesheet" href="/src/css/header.css">
</head>

<body>
    <div class="background"></div>
    <div class="star"></div>
    <script src="/public/js/background-stars.js"></script>

    <?php include 'header.php'; ?>

    <main>
        <div class="container">
            <?php if ($imageData): ?>
                <div class="image-preview">
                    <img src="uploads/<?= htmlspecialchars($imageData['file_name']); ?>" alt="アップロードされた画像">
                </div>
                <div class="sample_box13">
                    <?php
                    // 星の数を5個固定
                    $totalStars = 5;
                    // キラリ☆度に基づいて埋める星の数を計算
                    $filledStars = intval($imageData['kirari_score'] / 20);
                    // 空の星の数を計算
                    $emptyStars = $totalStars - $filledStars;
                    ?>

                    <div class="stars-container">
                        <?php for ($i = 0; $i < $filledStars; $i++): ?>
                            <span>★</span>
                        <?php endfor; ?>
                        <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                            <span>☆</span>
                        <?php endfor; ?>
                    </div>
                    <p>🌟キラリ☆度 ☞ <?= htmlspecialchars($imageData['kirari_score']); ?>キラリ☆彡</p>
                    <p>💬コメント ☞ <?= htmlspecialchars($imageData['comments']); ?></p>
                </div>
                <div class="subnav-container">
                    <a href="upload_face.php" class="subnav" id="upload-now">もう一度評価する👀👀</a>
                    <a href="#" class="subnav">結果をシェア🌷</a>
                </div>
            <?php else: ?>
                <p>評価する画像がナイヨ～💦💦</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="/public/js/header.js"></script>
</body>

</html>