<?php
require './config.php';

$conn = new mysqli($servername, $username, $password, $database);

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imageData = null;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT file_name, kirari_score, comments FROM new_images WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $imageData = $result->fetch_assoc();
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>キラリ☆評価画面</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/kirari_score.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">
                <img class="logo" src="./images/logo.png" alt="キラめもロゴ">
            </div>
            <div class="header-center">
                <h1>キラリ☆評価</h1>
            </div>
            <div class="header-right">
                <ul>
                    <li><a href="index.html">ホーム</a></li>
                    <li><a href="album.html">アルバム</a></li>
                    <li><a href="challenge.html">チャレンジ</a></li>
                    <li><a href="ranking.html">ランキング</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <?php if ($imageData): ?>
                <div class="image-preview">
                    <img src="uploads/<?php echo htmlspecialchars($imageData['file_name']); ?>" alt="アップロードされた画像">
                </div>
                <p>キラリ☆度: <?php echo htmlspecialchars($imageData['kirari_score']); ?>点</p>
                <p>評価: <?php echo str_repeat('★', intval($imageData['kirari_score'] / 20)); ?></p>
                <p>コメント: <?php echo htmlspecialchars($imageData['comments']); ?></p>
            <?php else: ?>
                <p>評価する画像がありません。</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 キラリ☆. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
