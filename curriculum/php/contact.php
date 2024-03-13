<?php
//メモ
    //if文に通らない時・・・そもそも通っているか？型が正しい？変数がちゃんと読み込まれているか？じゃない時！の場合は通る？
    //php正規表現チェッカー
    session_status();
    session_start();
    session_destroy();

//送信ボタンが押されたら、
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
        //     //php 画面遷移　エラーなければ次のページへ。　headerlocation
        //     //どのページにいるかphpで確認できる関数がある。　ボタン押してどこに飛んでいった？なんの処理してる？　「前のurlを取得するとか」今のurl
        // }
    } //送信ボタンが押されたら 処理終わり
    
//戻るボタンを押された時に値を保持
    if(isset($_GET) && isset($_GET['action']) && $_GET['action']=='edit'){
        $name = $_SESSION['name'];
        $hurigana = $_SESSION['hurigana'];
        $tel = $_SESSION['tel'];
        $email = $_SESSION['email'];
        $content = $_SESSION['content'];
    }

    //配列への値の代入方法
    //どこに何が入っているのかを確認、exit使いながら
    //分岐ないでexitでどこまで

    //empty 値を確認、
    //返り値
    //exit使ってどこまで処理が通っているか確認
    // var_dump($_POST);
    // exit;


// print_r($error['name']);
// $error = array();
// var_dump($error); 
if(isset($_SESSION['error'])){
    // $_SESSION['error'] = array();
    $error = $_SESSION['error'];

    $name = $_SESSION['name'];
    $hurigana = $_SESSION['hurigana'];
    $email = $_SESSION['email'];
    $tel = $_SESSION['tel'];
    $content = $_SESSION['content'];
}
?>

<?php     
    $title = "お問い合わせページ";
    include 'header.php';
?>

<section>
    <div class="contact_box">
        <h2>お問い合わせ</h2>
        <form action="confirm.php" method="post" id="contact">
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
                </dd>
            </dl>

        </form>
    </div>
</section>
<?php
    // if(){
    $db = 'mysql:dbname=cafe;host=mysql;port=3306;';
    $user = 'root';
    $password = 'root';
        try{
            $pdo=new PDO($db, $user, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //インスタンス化
            $pdo->exec("SET time_zone = '+09:00'");
            $sql="SELECT * FROM contacts";
            $stmt = $pdo->query($sql);        ?>
            <?php
                echo "<table>";
                echo "<tr><th>id</th><th>名前</th><th>フリガナ</th><th>電話番号</th><th>メールアドレス</th><th>お問合せ内容</th></tr>";
                foreach($stmt as $record){
                    echo "<tr>";
                    echo "<td>" .$record['id'] ."</td>";
                    echo "<td>" .$record['name'] ."</td>";
                    echo "<td>" .$record['kana'] ."</td>";
                    echo "<td>" .$record['tel'] ."</td>";
                    echo "<td>" .$record['email'] ."</td>";
                    echo "<td>" .$record['body'] ."</td>";
                ?>
                    <td><button><a href="edit.php?id=<?php echo $record['id'];?>" style="text-decoration:none" >編集</a></button></td>
                    <td><button class="delete-btn" data-id="<?php echo $record['id']; ?>">削除</button></td>
                    <!-- ボタン押して、アラート出して、OKを押したらDELETEで消す。 -->
                    </tr>
            <?php
                }
                echo "</table>";
        }catch(PDOException $e){
            echo "接続失敗:" .$e->getMessage(). "\n";
        }
?>

<div class="page_top" onclick="scroll_top()" style="display: none;">
    <p>Jump To Top</p>
</div>

<script>
    // 削除ボタンがクリックされたら
    document.querySelectorAll('.delete-btn').forEach(button => {
        //https://tech-blog.tomono.jp/archives/2486
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            // 確認ダイアログを表示し、削除を確認したらAjaxリクエストを送信する
            if (confirm('本当に削除しますか？')) {
                fetch("delete.php?id=" + id, {
                    method: "DELETE"
                })
                .then(response => {
                    if (!response.ok) {
                        //レスポンスが正常→trueを返す
                        //OKじゃなかったら
                        console.log('エラーです');
                        //https://developer.mozilla.org/ja/docs/Web/JavaScript/Reference/Statements/throw
                    }
                    // 削除できたら、行を画面から消す
                    this.closest('tr').remove();
                })
                .catch(error => {
                    console.error('エラー:', error);
                });
            }
        });
    });



    // //編集ボタンがクリックされたら
    // document.querySelectorAll('.update-btn').forEach(updataButton => {
    //     updataButton.addEventListener('click',function(){
    //         const id = this.getAttribute('data-id');
    //         $_SESSION['']= $stmt;
    //     });
    // });


//     document.getElementById('contact').addEventListener("submit", function(e){
//     const name = document.getElementById('name').value;
//     const hurigana = document.getElementById('hurigana').value;
//     const tel = document.getElementById('tel').value;
//     const email = document.getElementById('email').value;
//     const content = document.getElementById('content').value;

//     //名前
//     if(!name){
//         alert("氏名は必須項目です");
//         e.preventDefault(); 
//         return;
//     }else if(name.length > 10){
//         alert("氏名は10文字以内でお願いします。");
//         e.preventDefault(); 
//         return;
//     }
//     //フリガナ
//     if(!hurigana){
//         alert("フリガナは必須項目です");
//         e.preventDefault(); 
//         return;
//     }else if(hurigana.length > 10){
//         alert("フリガナは10文字以内でお願いします。");
//         e.preventDefault(); 
//         return;
//     }
//     //メール
//     if(!email){
//         alert("メールアドレスは必須項目です");
//         e.preventDefault(); 
//         return;
//     }
//     //お問い合わせ内容
//     if(!content){
//         alert("お問い合わせ内容は必須項目です。");
//         e.preventDefault(); 
//         return;
//     }
// });

//記事編集ボタンをおしたら、該当データを引き出して画面表示させる。(セレクト)
// 編集ページにもinput的な形で、もともとvalueで表示させておく、
// 1まずは同じようなページ作る
// 2セレクトでvalueに表示させる
// php データベース　更新　 基本的な書き方を調べつつ・・・定型分なところ多い
// 同じセッションに突っ込んだらだめ！横着❌データベースを使う。



    const header = document.getElementById("header");
    window.addEventListener('load', headerColor);
    function headerColor(){
        header.classList.add('color');
    }
</script>




<?php include 'footer.php'; ?>


<!-- フォームからのデータ受け取り・バリデーション https://oopsoop.com/how-to-use-forms-in-php/ -->
<!-- 今まではエラー判定のためにフォーム画面から、エラーがなければ確認フォームにget送信、あればその場で(お問い合わせから遅い合わせにpost送信)処理をしてたから、お問い合わせフォームから確認画面にpost送信、エラーがあればheader関数でフォーム画面に戻る、なければpost送信のまま処理を続ける -->

