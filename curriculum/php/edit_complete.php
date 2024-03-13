<?php 
    session_start();
//ダイレクトアクセスされた場合コンタクトページに戻す
    if($_SERVER["REQUEST_METHOD"] != "POST"){
        header("Location: contact.php");
        exit();
    }
        $title = "確認ページ";
        include 'header.php';

        // var_dump($_POST);
?>
<section>
    <form action="contact.php" class="contact_box" method="post">
        <h2>お問い合わせ</h2>
        <div class="msg">
            <p>お問い合わせ頂きありがとうございます。</p>
            <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
            <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
            <a href="index.php" type="submit" name ="confirm">トップへ戻る</a>
        </div>
    </form>
</section>
<?php
    $db = 'mysql:dbname=cafe;host=mysql;port=3306;';
    $user = 'root';
    $password = 'root';
    try{
        $pdo=new PDO($db, $user, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //インスタンス化
        //インサートで処理(入れる)
        //sql
        //テーブルに対してカラム、どのデータを入れるか
        //if edit.phpから来てたら、
        // $sql = "UPDATE contacts"

        //else新規
        $sql = "INSERT INTO contacts
        (name, kana, tel, email, body)
        VALUES('$name', '$hurigana','$tel', '$email', '$content')";
        $sth = $pdo->query($sql);
    }catch(PDOException $e){
        echo "接続失敗:" .$e->getMessage(). "\n";
    }
    //dbが考える場所に作られているか(dockerのなか)
    //pass rootで入れた
    //変数、誤字脱字、コードの書き方

?> 
<div class="page_top" onclick="scroll_top()" style="display: none;">
    <p>Jump To Top</p>
</div>
<script>
    const header = document.getElementById("header");
    window.addEventListener('load', headerColor);
    function headerColor(){
        header.classList.add('color');
    }
</script>

<?php include 'footer.php'; ?>


