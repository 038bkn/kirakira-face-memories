<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>キラめも☆アップロード画面</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/uploadarea.css">
    <link rel="stylesheet" href="./css/upload_face.css">    
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>
    <div class="background"></div>
    <div class="star"></div>
    <script src="./js/background-stars.js"></script>

    <?php include 'header.php'; ?>

    <main>
        <div class="container">
            <div class="upload-title">
                <p class="sample_box13">
                    アップロードの時間だよ―！！！<br>
                    ベストショットをアップして、キラリ☆度をチェック！
                </p>
            </div>
            <div class="upload-container">
                <p>ステキな写真を選んでね～☆</p>
                <div class="file-drop-area">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <span class="fake-btn">ファイルを選択する</span>か、<br>
                        <span class="file-msg">ここにドラッグ＆ドロップしてネ ♡</span>
                        <input class="file-input" type="file" name="image" accept="image/*"><br>
                </div>
            </div>
            <div id="image-preview-container">
                <div class="lottie">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs"
                        type="module">
                    </script>

                    <dotlottie-player src="https://lottie.host/424e85a5-7bf9-4ab3-a4f0-4109450153a3/7C3Eku2aLu.json"
                        background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                        autoplay></dotlottie-player>
                </div>
                <img id="image-preview" src="" alt="プレビュー" style="display: none;">
            </div>
        </div>
        <input class="submit-btn" type="submit" value="これでおk☆彡" name="submit">
    </form>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="js/header.js"></script> 
    <script>
        // 画像プレビュー機能
        $('.file-input').on('change', function (event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result).show();
                $('.lottie').hide(); // Lottieアニメーションを非表示にする
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
