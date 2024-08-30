<header class="header_bg">
    <div class="container">
        <div class="header-left header_contents">
            <img class="logo" src="./images/logo.png" alt="キラめもロゴ">
        </div>
        <div class="header-center">
            <h1><?php echo basename($_SERVER['PHP_SELF']) == 'upload_face.php' ? '自撮りアップロード' : 'ホーム'; ?></h1>
        </div>
        <div class="responsive_btn">
            <div class="menu_line"></div>
            <div class="menu_line"></div>
            <div class="menu_line"></div>
        </div>
        <nav class="header-right header_nav">
            <ul class="header_nav_lists">
                <li><a class="nav_link" href="index.php">ホーム</a></li>
                <li><a class="nav_link" href="#">アルバム</a></li>
                <li><a class="nav_link" href="#">ランキング</a></li>
            </ul>
        </nav>
    </div>
</header>