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
  <title>お問い合わせフォーム【ajax】</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="/assets/js/index.js"></script>
</head>
<body>
  <div class="status-wrap">
    <!-- 送信中に表示するモーダルウィンドウ -->
    <div id="modal">
      <p class="status">送信中です・・・</p>
    </div><!-- /#modal -->

    <!-- 結果メッセージ -->
    <div id="result"></div><!-- /#result -->
  </div>

<div class="contact">
  <div class="inner">
    <h2 class="contact-title">問い合わせフォーム</h2>
    <form class="contact-form">
      <ul class="contact-form-list">
        <li class="contact-form-item">
          <input type="text" name="name" placeholder="お名前" required>
        </li>
        <li class="contact-form-item">
          <input type="email" name="email" placeholder="メールアドレス" required>
        </li>
        <li class="contact-form-item">
          <textarea name="comment" placeholder="内容" required></textarea>
        </li>
        <li class="contact-form-item">
          <!-- 作成したトークンを次のページに引き継ぐ-->
          <input type="hidden" name="token" value="<?= $token ?>">
        </li>
      </ul>
      <div class="button-wrap">
        <button class='submit' type="submit">送信</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>
