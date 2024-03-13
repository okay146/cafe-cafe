//トップへ戻るボタン
// console.log('test');
const top_button = document.querySelector(".page_top");
top_button.addEventListener("click", scroll_top);
function scroll_top(){
    window.scroll({top:0, behavior:"smooth"});
}
window.addEventListener("scroll", scroll_event);
function scroll_event(){
    let height = window.scrollY;
    let page_heigth = window.height;
    if(page_heigth>1000){
        if(height>120){
            top_button.style.opacity="1";
        }else{
            top_button.style.opacity="0";
        }
    }
}


//ヘッダー固定

//サインイン画面pc
const signIn = document.getElementById('signIn');
const modal = document.getElementById('login');
const loginBox = document.getElementById('login_box');
signIn.addEventListener('click',modalOpen);
function modalOpen(){
    modal.classList.remove('none');
    loginBox.classList.remove('none');
}
modal.addEventListener('click',modalClose);
function modalClose(){
    modal.classList.add('none');
    loginBox.classList.add('none');
}

//spメニュー
const buttonSpMenu = document.getElementById('signIn_sp');
const spMenu = document.getElementById('menu_sp');
const closeMenu = document.getElementById('close');
buttonSpMenu.addEventListener('click', openSpMenu);
function openSpMenu(){
    spMenu.classList.remove('none');
    closeMenu.classList.remove('none');
}
closeMenu.addEventListener('click', closeSpMenu);
function closeSpMenu(){
    spMenu.classList.add('none');
}

//spメニューからログイン画面表示
const signInSp = document.getElementById('signInSp');
signInSp.addEventListener('click',modalOpenSp);
function modalOpenSp(){
    modal.classList.remove('none');
    loginBox.classList.remove('none');
    spMenu.classList.add('none');
}
modal.addEventListener('click',modalClose);
function modalClose(){
    modal.classList.add('none');
    loginBox.classList.add('none');
}


//jsバリデーション
// console.log('test2');
// document.getElementById('contact').addEventListener("submit", function(e){
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
//     if(hurigana=""){
//         alert("フリガナは必須項目です");
//         e.preventDefault(); 
//         return;
//     }else if(hurigana.length > 10){
//         alert("フリガナは10文字以内でお願いします。");
//         e.preventDefault(); 
//         return;
//     }
//     //メール
//     if(email=""){
//         alert("メールアドレスは必須項目です");
//         e.preventDefault(); 
//         return;
//     }
//     //お問い合わせ内容
//     if(content = ""){
//         alert("お問い合わせ内容は必須項目です。");
//         e.preventDefault(); 
//         return;
//     }
// });