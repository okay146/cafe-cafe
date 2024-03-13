<?php 
    session_start();
    // var_dump($_SERVER["REQUEST_METHOD"]);
//ダイレクトアクセスされた場合コンタクトページに戻す
    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        header("Location: contact.php");
        exit();
    }
    

    //ページにアクセスする際に使用されたリクエストのメソッド名です。
    //送信された内容を変数に代入

    $name = htmlspecialchars($_POST['name'],ENT_QUOTES | ENT_HTML5);
    $hurigana = htmlspecialchars($_POST['hurigana'],ENT_QUOTES | ENT_HTML5);
    $tel = htmlspecialchars($_POST['tel'],ENT_QUOTES | ENT_HTML5);
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES | ENT_HTML5 | FILTER_VALIDATE_EMAIL);
    $content = htmlspecialchars($_POST['content'],ENT_QUOTES | ENT_HTML5);

    $_SESSION['name'] = $name;
    $_SESSION['hurigana'] = $hurigana;
    $_SESSION['email'] = $email;
    $_SESSION['tel'] = $tel;
    $_SESSION['content'] = $content;

    $error = array();

    if(empty($name)){ //何も入力されていない時エラー
        $error['name'] = '氏名は必須項目です。';
        $_SESSION['errorName'] = $error['name'];
        // exit;
        //何も表示されない
    }
    if($name && mb_strlen($name, "UTF-8")>10){ //mb_strlenで文字数、10文字以上の時にエラー
        $error['name2']= '氏名は10文字以内でお願いします。';
        $_SESSION['errorName2'] = $error['name2'];
        //exitで表示された
        // exit;
    }
    if(empty($hurigana)){//フリガナチェック
        $error['hurigana'] = 'フリガナは必須項目です。';
        $_SESSION['errorHurigana'] = $error['hurigana'];
        //exitで表示されない
        // exit;
    }
    if($hurigana  && mb_strlen($hurigana, "UTF-8")>10){
        $error['hurigana2']= 'フリガナは10文字以内でお願いします。';
        $_SESSION['errorHurigana2'] = $error['hurigana2'];
        //exitで表示された
        // exit;
    }
    if($tel && !preg_match('/^0[7-9]0[0-9]{8}$/', $tel) ){//電話番号チェック(ハイフン無し)
        //ハイフンあり→/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/
        //こういうもんやと思って覚える！
        $error['tel'] = '電話番号は0-9の数字のみでご入力ください。';
        $_SESSION['errorTel'] = $error['tel'];
        // exit;
    }
    if(empty($email)){//メールアドレスチェック
        $error['email'] = 'メールアドレスは必須項目です。';
        $_SESSION['errorEmail'] = $error['email'];
        // exit;
    }
    if(empty($content)){//お問い合わせ内容チェック
        $error['content'] = 'お問い合わせ内容は必須項目です。';
        $_SESSION['errorContent'] = $error['content'];
    }

    if(count($error)!==0){
        $_SESSION['error'] = $error;
        
        $_SESSION['name'] = $name;
        $_SESSION['hurigana'] = $hurigana;
        $_SESSION['email'] = $email;
        $_SESSION['tel'] = $tel;
        $_SESSION['content'] = $content;

        //editフラグ　
        header("Location: contact.php");
        exit;

        // var_dump($error);
        // var_dump($_SESSION['error']);
        // var_dump(count($error));
        // var_dump(isset($error));
    }


    if(isset($_POST['send'])){
        $_SESSION['name'] = $name;
        $_SESSION['hurigana'] = $hurigana;
        $_SESSION['email'] = $email;
        $_SESSION['tel'] = $tel;
        $_SESSION['content'] = $content;
    }
?>

<?php     
    $title = "完了ページ";
    include 'header.php';
?>

<section>
<div class="contact_box">
    <h2>お問い合わせ</h2>
    <form action="./complete.php" method="post">
        <!-- post送信、complete.php(完了画面)へ移動 -->
        <div class="msg">
        <p>下記の内容をご確認の上送信ボタンを押してください。<br>
        内容を訂正する場合は戻るを押してください。</p>
        </div>
        <dl>
            <dt>氏名</dt>
            <dd><?php echo $name; ?></dd>
            <dt>フリガナ</dt>
            <dd><?php echo $hurigana; ?></dd>
            <dt>電話番号</dt>
            <dd><?php echo $tel; ?></dd>
            <dt>メールアドレス</dt>
            <dd><?php echo $email; ?></dd>
            <dt>お問い合わせ内容</dt>
            <dd><?php echo nl2br($content); ?></dd>
            <dd id = "confirm_btn">
                <button type = "submit" name = "send">送信</button>
                <!-- 送信ボタン -->
                <a href = "contact.php?action=edit" name="back" class = "back_btn">戻る</a>
                <!-- <a onclick = "history.back()" name="back" class = "back_btn">戻る</a> -->
            </dd>

        </dl>
    </form>
<div class="page_top" onclick="scroll_top()" style="display: none;">
    <p>Jump To Top</p>
</div>

</div>
</section>
<script>
    const header = document.getElementById("header");
    window.addEventListener('load', headerColor);
    function headerColor(){
        header.classList.add('color');
    }
</script>
<?php include 'footer.php'; ?>

