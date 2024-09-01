<header class="header_bg">
    <div class="container">
        <div class="header-left header_contents">
            <img class="logo" src="/public/images/logo.png" alt="キラめもロゴ">
        </div>
        <div class="header-center">
            <h1>
                <?php
                $page = basename($_SERVER['PHP_SELF']);
                if ($page === 'index.php') {
                    echo 'ホーム画面';
                } elseif ($page === 'signin.php') {
                    echo 'ログイン';
                } elseif ($page === 'upload_face.php') {
                    echo 'アップロード';
                } elseif ($page === 'display_images.php') {
                    echo 'アルバム';
                } else {
                    echo 'ホーム';
                }
                ?>
                </h1>
        </div>
        <div class="responsive_btn">
            <div class="menu_line"></div>
            <div class="menu_line"></div>
            <div class="menu_line"></div>
        </div>
        <nav class="header-right header_nav">
            <ul class="header_nav_lists">
                <li><a class="nav_link" href="/index.php">ホーム</a></li>
                <li><a class="nav_link" href="#">アルバム</a></li>
                <li><a class="nav_link" href="/signin.php">ログイン</a></li>
            </ul>
        </nav>
    </div>
</header>