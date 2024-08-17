<?php

require './config.php';

// データベースに接続
$conn = new mysqli($servername, $username, $password, $database);

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 画像情報をデータベースから取得
$sql = "SELECT file_name, upload_date, kirari_score FROM new_images";
$result = $conn->query($sql);

// 星を表示する関数
function getStars($score) {
    $stars = floor($score / 20); // 0-100のスコアを5段階に変換
    return str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);
}

// コメントテンプレート
$comments = [
    '0-19' => 'もう少し頑張りましょう！',
    '20-39' => '良い感じですが、さらに向上を目指しましょう！',
    '40-59' => 'とても良いです！この調子で！',
    '60-79' => '素晴らしいです！',
    '80-100' => '完璧です！おめでとうございます！'
];

// コメントを選ぶ関数
function getComment($score) {
    global $comments;
    if ($score <= 19) {
        return $comments['0-19'];
    } elseif ($score <= 39) {
        return $comments['20-39'];
    } elseif ($score <= 59) {
        return $comments['40-59'];
    } elseif ($score <= 79) {
        return $comments['60-79'];
    } else {
        return $comments['80-100'];
    }
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
                echo '<div class="image-item">';
                echo '<img src="uploads/' . $fileName . '" alt="' . $fileName . '">';
                echo '<p>Uploaded on: ' . htmlspecialchars($row['upload_date']) . '</p>';
                echo '<p>キラリ☆度: ' . htmlspecialchars($kirariScore) . '点</p>';
                echo '<p>評価: ' . getStars($kirariScore) . '</p>';
                echo '<p>コメント: ' . getComment($kirariScore) . '</p>';
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
