<?php

require './config.php';

$conn = new mysqli($servername, $username, $password, $database);

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 画像をランダムに取得
$sql = "SELECT file_name, kirari_score FROM new_images ORDER BY RAND() LIMIT 5";
$result = $conn->query($sql);

$images = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = [
            'file_name' => $row['file_name'],
            'kirari_score' => $row['kirari_score'],
            'comment' => getRandomComment($row['kirari_score'])
        ];
    }
}

$conn->close();

// JSON形式で返す
header('Content-Type: application/json');
echo json_encode($images);

?>

<?php

// 画像をランダムに取得
$sql = "SELECT file_name, kirari_score FROM new_images ORDER BY RAND() LIMIT 5";
$result = $conn->query($sql);

$images = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = [
            'file_name' => $row['file_name'],
            'kirari_score' => $row['kirari_score'],
            'comment' => getRandomComment($row['kirari_score']) // ランダムコメントを追加
        ];
    }
}

$conn->close();

// JSON形式で返す
header('Content-Type: application/json');
echo json_encode($images);
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
                echo '<div class="image-item">';
                echo '<img src="uploads/' . $fileName . '" alt="' . $fileName . '">';
                echo '<p>Uploaded on: ' . htmlspecialchars($row['upload_date']) . '</p>';
                echo '<p>キラリ☆度: ' . htmlspecialchars($kirariScore) . '点</p>';
                echo '<p>評価: ' . getStars($kirariScore) . '</p>';
                echo '<p>コメント: ' . getRandomComment($kirariScore) . '</p>'; // ここを修正
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