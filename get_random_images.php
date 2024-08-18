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
            'kirari_score' => $row['kirari_score']
        ];
    }
}

$conn->close();

// JSON形式で返す
header('Content-Type: application/json');
echo json_encode($images);

?>
