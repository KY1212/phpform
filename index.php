<?php
session_start();

//クリックジャッキングへの対策
header('X-Frame-Options: DENY');

//トークンの生成
$token = sha1(uniqid(rand(), true));

//トークンを$_SESSIONに格納し、それをキーとする
$_SESSION['key'] = $token;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お問い合わせ【ajax通信】</title>
  <link rel="stylesheet" href="assets/css/reset.css" />
  <!-- jQueryの読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="./assets/js/index.js"></script>
</head>
<body>
  <div id="contact">
    <div class="inner">
      <h2 class="contact-title">問い合わせフォーム</h2>
      <form class="contact-form">
        <ul class="contact-form-list">
          <li class="contact-form-item">
            <input type="text" name="name" placeholder="お名前" id="name">
            <span id="name_error" class="error_m"></span>
          </li>
          <li class="contact-form-item">
            <input type="email" name="email" id="email" placeholder="メールアドレス">
            <span id="email_error" class="error_m"></span>
          </li>
          <li class="contact-form-item">
            <textarea name="comment" placeholder="内容" id="comment"></textarea>
            <span id="comment_error" class="error_m"></span>
          </li>
          <li class="contact-form-item">
            <!-- 作成したトークンを次のページに引き継ぐ-->
            <input type="hidden" name="token" value="<?= $token ?>">
          </li>
          <li class="contact-form-item">
            <button class='submit' type="submit" id="submit">送信</button>
          </li>
        </ul>
      </form>
      <!-- 結果メッセージ -->
      <div id="result"></div>
    </div>
  </div>
</body>
</html>