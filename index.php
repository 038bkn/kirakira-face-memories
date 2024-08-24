<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>キラめも☆ホーム画面</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/uploadarea.css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="container">
            <div class="title-container">
                <img class="title title-img" src="./images/title.png" alt="キラめもタイトル">
                <p class="title-text">キラ☆めもへようこそ！<br>
                    自撮り写真をアップロードして、キラリ☆度をチェック！</p>
            </div>
            <div class="subnav-container">
                <a href="upload_face.php" class="subnav" id="upload-now">今すぐアップロード</a>
                <a href="album.php" class="subnav">アルバムを見る</a>
            </div>
            <div class="upload-container">
                <p>今日の自撮りをアップロードして、キラキラ度を測ってみよ～☆</p>
                <div class="file-drop-area">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <span class="fake-btn">ファイルを選択する</span>か、<br>
                        <span class="file-msg">ここにドラッグ＆ドロップしてネ ♡</span>
                        <input class="file-input" type="file" name="image" accept="image/*"><br>
                </div>
                <input class="submit-btn" type="submit" value="これでおk☆彡" name="submit">
                </form>
            </div>
            <p class="recent-text">☆今までのキラキラ☆(が表示される予定～♡)</p>
            <div class="lottie">
                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs"
                    type="module"></script>

                <dotlottie-player src="https://lottie.host/424e85a5-7bf9-4ab3-a4f0-4109450153a3/7C3Eku2aLu.json"
                    background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                    autoplay></dotlottie-player>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>
