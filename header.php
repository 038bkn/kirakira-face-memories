<header>
    <div class="container">
        <div class="header-left">
            <img class="logo" src="./images/logo.png" alt="キラめもロゴ">
        </div>
        <div class="header-center">
            <h1><?php echo basename($_SERVER['PHP_SELF']) == 'upload_face.php' ? '自撮りアップロード' : 'ホーム'; ?></h1>
        </div>
        <div class="header-right">
            <ul>
                <li><a href="index.php">ホーム</a></li>
                <li><a href="album.php">アルバム</a></li>
                <li><a href="challenge.php">チャレンジ</a></li>
                <li><a href="ranking.php">ランキング</a></li>
            </ul>
        </div>
    </div>
</header>
