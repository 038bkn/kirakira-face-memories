<?php
require './config.php';
require './comments.php';  // コメントテンプレートと関数をインクルード

$conn = new mysqli($servername, $username, $password, $database);

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image'])) {
        $fileName = $_FILES['image']['name'];
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        // 画像ファイルのバリデーション
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($fileType, $allowedTypes)) {
            echo "Unsupported file type.";
        } elseif ($fileSize > $maxFileSize) {
            echo "File size exceeds the limit of 5MB.";
        } elseif ($fileError === 0) {
            // 画像ファイルをサーバーに保存
            $uploadPath = 'uploads/' . basename($fileName);

            if (move_uploaded_file($fileTmp, $uploadPath)) {
                // キラリ☆度をランダムに生成
                $kirari_score = rand(0, 100);

                // ランダムコメントを生成
                $comment = getRandomComment($kirari_score);

                // データベースに情報を保存
                $sql = "INSERT INTO new_images (file_name, upload_date, kirari_score, comments) VALUES (?, NOW(), ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("sis", $fileName, $kirari_score, $comment);
                    $stmt->execute();

                    // 挿入されたデータのIDを取得
                    $last_id = $stmt->insert_id;

                    // kirari_score.php にリダイレクト
                    header("Location: kirari_score.php?id=" . $last_id);
                    exit();
                } else {
                    echo "Failed to prepare the SQL statement.";
                }
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            echo "Error uploading file. Error code: " . $fileError;
        }
    } else {
        echo "No file uploaded.";
    }
}

// データベース接続を閉じる
$conn->close();
