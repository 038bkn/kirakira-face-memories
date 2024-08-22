<?php

require './config.php';

// データベースに接続
$conn = new mysqli($servername, $username, $password, $database);

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 画像情報をデータベースから取得
$sql = "SELECT file_name, upload_date, kirari_score, comments FROM new_images";
$result = $conn->query($sql);

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
        <?php
        if ($result->num_rows > 0) {
            // データベースに画像が存在する場合、表示する
            while ($row = $result->fetch_assoc()) {
                $fileName = htmlspecialchars($row['file_name']);
                $kirariScore = $row['kirari_score'];
                $comment = htmlspecialchars($row['comments']);  // 保存されたコメントを取得
                echo '<div class="image-item">';
                echo '<img src="uploads/' . $fileName . '" alt="' . $fileName . '">';
                echo '<p>Uploaded on: ' . htmlspecialchars($row['upload_date']) . '</p>';
                echo '<p>キラリ☆度: ' . htmlspecialchars($kirariScore) . '点</p>';
                echo '<p>評価: ' . getStars($kirariScore) . '</p>';
                echo '<p>コメント: ' . $comment . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>No images found.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
// データベース接続を閉じる
$conn->close();
?>
