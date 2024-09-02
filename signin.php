<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>キラめも☆ログイン画面</title>
    <link rel="stylesheet" href="/src/css/common.css">
    <link rel="stylesheet" href="/src/css/uploadarea.css">
    <link rel="stylesheet" href="/src/css/signin.css">
    <link rel="stylesheet" href="/src/css/header.css">
</head>

<body>
    <div class="background"></div>
    <div class="star"></div>
    <script src="/public/js/background-stars.js"></script>

    <?php include 'header.php'; ?>

    <main>
        <div class="container">
            <div class="body-signin">
                <div class="form">
                    <h2>Login</h2>
                    <div class="input">
                        <div class="inputBox">
                            <label for="">Username</label>
                            <input type="text">
                        </div>
                        <div class="inputBox">
                            <label for="">Password</label>
                            <input type="password">
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="" value="ログイン">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</div>
</main>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/public/js/script.js"></script>
<script src="/public/js/header.js"></script>
<script src="/public/js/signin.js"></script>
</body>

</html>