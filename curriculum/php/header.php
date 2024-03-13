<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="keyword" content=",,">
    <link rel="stylesheet" href="style.css">
</head>

<body id="body">
    <main id= "main">
        <!-- <div class="kv" > -->
    <header>
        <nav id ="header" class ="">
            <div class="logo"><a href="index.php">
                <h1 class = "logo"><img src="cafe/img/logo.png" alt=""></h1></a>
            </div>
            <div class="menu_nav">
                <ul>
                    <li><a href="index.php#location">はじめに</a></li>
                    <li><a href="index.php#exp">体験</a></li>
                    <li><a href="contact.php">お問い合わせ</a></li>
                </ul>
            </div>
            <div class="sign">
                <p><a href="#login" id="signIn">サインイン</a></p>
            </div>
            <div class="hum_menu">
                <a href="#login" id="signIn_sp"><img src="cafe/img/menu.png" alt="" ></a>
            </div>
        </nav>

        <div id="login" class ="none"></div> <!-- ログイン画面背景 -->
        <div id="login_box" class="none">  <!-- ログイン画面の内容 -->
            <h2>ログイン</h2>
            <form action="">
                <dl class="login_mail">
                    <dd><input type="text" placeholder="メールアドレス"></dd>
                    <dd><input type="pass" placeholder="パスワード"></dd>
                    <dd><button type="submit" class = "submit" >送信</button></dd>
                </dl>
                <dl class="sns">
                    <dd><button><img src="cafe/img/twitter.png" alt=""></button></dd>
                    <dd><button><img src="cafe/img/fb.png" alt=""></button></dd>
                    <dd><button><img src="cafe/img/google.png" alt=""></button></dd>
                    <dd><button><img src="cafe/img/apple.png" alt=""></button></dd>
                </dl>
            </form>
        </div><!-- ログイン画面の内容終わり -->
        
        <div id="close" class="none"></div> <!-- spメニュー画面背景 -->
        <div id="menu_sp" class ="none"><!-- spメニュー -->
            <p><a href="#login" id="signInSp">サインイン</a></p>
            <p><a href="index.php#location">はじめに</a></p>
            <p><a href="index.php#exp">体験</a></p>
            <p><a href="contact.php" type="submit" name ="confirm">お問い合わせ</a></p>
        </div><!-- spメニュー終わり -->

    </header>