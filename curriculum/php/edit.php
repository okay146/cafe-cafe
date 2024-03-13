<?php
// データベースに接続
$db = 'mysql:dbname=cafe;host=mysql;port=3306;';
$user = 'root';
$password = 'root';

// //ステートメント こういうもんだからあまり突っ込まず！

if(isset($_POST['confirm'])){
    //送信された内容を変数に格納
    //エスケープ処理　直接書けんように
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
    $_SESSION['id'] = $id;
    //     //php 画面遷移　エラーなければ次のページへ。　headerlocation
    //     //どのページにいるかphpで確認できる関数がある。　ボタン押してどこに飛んでいった？なんの処理してる？　「前のurlを取得するとか」今のurl
    // }
}
    $id = isset($_GET['id'])?intval($_GET['id']):0;
    // $id = $_GET['id'];
    $pdo = new PDO($db, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    try{
        $sql = "SELECT * FROM contacts WHERE id = :id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
    }catch(PDOException $e){
        echo "更新失敗:" . $e->getMessage() . "\n";
    }
    $record = $stmt->fetch(PDO::FETCH_ASSOC); 
    $name = $record["name"]; 
    $hurigana = $record["kana"]; 
    $tel = $record["tel"]; 
    $email = $record["email"]; 
    $content = $record["body"];
    
?>
<?php     

    $title = "お問い合わせページ";
    include 'header.php';
?>

<section>
    <div class="contact_box">
        <h2>お問い合わせ</h2>
        <form action="edit_done.php" method="post" id="contact">
        <!-- <form action="confirm.php" method="post" id="contact"> -->
            <!-- method = "post"でpost送信 -->
            <!-- confirm.php(確認画面)に移動 -->
            <h3>下記の項目をご記入の上送信ボタンを押してください</h3>
            <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
            <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
            <p><span class="red">*</span>は必須項目となります。</p>

            <dl>
                <dt>
                    <label for="name">氏名</label>
                    <span class="red">*</span>
                    <span style="color:red">
                        <?php 
                            if(!empty($error['name'])){
                                echo $error['name'];
                            }
                            if(!empty($error['name2'])){
                                echo $error['name2'];
                            }
                        ?>
                    </span>
                </dt>
                <dd>
                    <input type="text" name="name" id="name" placeholder="山田太郎" value = "<?php if(isset($name)){echo $name;} ?>" >
                    <!-- name属性を付与→値をphpからアクセスできる -->
                </dd>
                <dt>
                    <label for="hurigana">フリガナ</label>
                    <span class="red">*</span>
                    <span style="color:red">
                        <?php 
                            if(!empty($error['hurigana'])){
                                echo $error['hurigana'];
                            }
                            if(!empty($error['hurigana2'])){
                                echo $error['hurigana2'];
                            }
                        ?>
                    </span>
                </dt>
                <dd>
                    <input type="text" name="hurigana" id="hurigana" value = "<?php if(isset($hurigana)){echo $hurigana;} ?>" placeholder="ヤマダタロウ">
                </dd>
                <dt>
                    <label for="tel">電話番号</label>
                    <span style="color:red">
                        <?php 
                            if(!empty($error['tel'])){
                                echo $error['tel'];
                            }
                        ?>
                    </span>
                </dt>
                <dd>
                    <input type="text" name="tel" id="tel" value = "<?php if(isset($tel)){echo $tel;} ?>" placeholder="09012345678">
                </dd>
                <dt>
                    <label for="email">メールアドレス</label>
                    <span class="red">*</span>
                    <span style="color:red">
                        <?php 
                            if(!empty($error['email'])){
                                echo $error['email'];
                            }
                        ?>
                    </span>
                </dt>
                <dd>
                    <input type="text" name="email" id="email" value = "<?php if(isset($email)){echo $email;} ?>" type="email"  placeholder="test@test.co.jp">
                </dd>
            </dl>
            <h3>
                <label for="content">お問い合わせ内容をご記入ください<span class="red">*</span></label>
                <br>
                <span style="color:red">
                        <?php 
                            if(!empty($error['content'])){
                                echo $error['content'];
                            }
                        ?>
                    </span>
            </h3>
            <dl class = "body">
                <dd>
                    <textarea name="content" id="content" cols="30" rows="10"><?php if(isset($content)){echo $content;}?></textarea>
                </dd>
                <dd>
                    <button type="submit" name ="confirm">送信</button>
                    <!-- input hidden　何かしらの -->
                </dd>
            </dl>
            <input type="hidden" name="id" value="<?php echo $id; ?>">

        </form>
    </div>
    <div class="page_top" onclick="scroll_top()" style="display: none;">
        <p>Jump To Top</p>
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
