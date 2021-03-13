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
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="reset.css" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="base.js"></script>
</head>
<body>
  <div class="contact">
    <div class="result">
      <p class="status">お問い合わせを受け付けました</p>
    </div>
    <div class="inner">
      <h2 class="contact-title">問い合わせフォーム</h2>
      <form class="contact-form" action="" method="post">
        <ul class="field-wrap">
          <li class="form-field">
            <input class="name" name="name" type="text" placeholder="お名前" />
          </li>
          <li class="form-field">
            <input class="email" name="email" type="email" placeholder="メールアドレス" />
          </li>
          <li class="form-field">
            <textarea class="comment" name="comment" rows="15" cols="40" placeholder="お問い合わせ"></textarea>
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