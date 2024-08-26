<?php
ob_start();

require './config.php';
require './comments.php';  // コメント生成関数をインクルード

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'uploads/';
    // ファイル名の無効な文字を除去する（ここでファイル名を安全にする）
    $cleanFileName = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", basename($_FILES["image"]["name"]));
    $uploadFile = $uploadDir . time() . '_' . $cleanFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // 画像が既に存在しているか確認
    if (file_exists($uploadFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // ファイルの種類を確認
    $check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // ファイルサイズを確認
    if ($_FILES['image']['size'] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // 特定のファイル形式のみ許可
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // アップロードが成功したか確認
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // ランダムなキラリ☆度とコメントを生成
            $kirariScore = rand(0, 100);
            $comment = getRandomComment($kirariScore);

            // データベースに情報を保存
            $sql = "INSERT INTO new_images (file_name, upload_date, kirari_score, comments) VALUES (:file_name, NOW(), :kirari_score, :comments)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':file_name', basename($uploadFile), PDO::PARAM_STR);  // タイムスタンプ付きのファイル名を保存
            $stmt->bindParam(':kirari_score', $kirariScore, PDO::PARAM_INT);
            $stmt->bindParam(':comments', $comment, PDO::PARAM_STR);
            $stmt->execute();

            echo "The file ". htmlspecialchars($cleanFileName). " has been uploaded.";

            // アップロード後に評価ページにリダイレクト
            header("Location: kirari_score.php?id=" . $pdo->lastInsertId());
            exit();

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, the file was not uploaded.";
    }
}

ob_end_flush();
?>
