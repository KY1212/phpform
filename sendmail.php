<?php
session_start();

//このページに直接アクセスした場合は拒否する
if(!isset($_POST['token'])) {
  echo '不正なアクセスの可能性があります';
  exit;
}

      validRequired($name, 'name');
      validRequired($subject, 'subject');
      validRequired($message, 'message');
      validemail($email, 'email');

//キーとトークンが一致したら管理者に入力内容がメールで送られる
if($_SESSION['key'] === $_POST['token']) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $comment = $_POST['comment'];

  //メールの送り先
  $to = 'lilium74u@gmail.com';

  //メールの件名
  $subject = $name . 'さんからの入力フォームでの送信です';

  //メール本文
  $comment = '名前:' . $name . "\r\n\r\n" . 'メールアドレス:' . $email . "\r\n\r\n" . '内容:' . $comment;

  //メールヘッダー
  $header = 'From: ' . mb_encode_mimeheader($name). ' <' . $email. '>';

  //文字化け対策
  mb_language('ja');
  mb_internal_encoding('UTF-8');

  if(mb_send_mail($to, $subject, $comment, $header)) {
    echo '送信に成功しました';
  } else {
    echo  '送信に失敗しました';
  }
} else {
  echo 'キーとトークンが一致しません';
}
