<?php
  // レスポンスデータを定義します。
  $res = array('is_success' => false);
  $name = array_key_exists('name', $_POST) ? trim($_POST['name']) : '';
  $email = array_key_exists('email', $_POST) ? trim($_POST['email']) : '';
  $comment = array_key_exists('comment', $_POST) ? trim($_POST['comment']) : '';

  //メールの送り先
  $to = "lilium74u@gmail.com";
  //メールの送り元
  // $from = "lilium74u@gmail.com"

  // エラーメッセージを格納する配列を定義します。
  $errors = array();
  if ($name === '') {
    $errors[] = array('classname' => 'name', 'message' => '名前を入力してください。');
  }
  if ($email === '') {
    $errors[] = array('classname' => 'email', 'message' => 'メールアドレスを入力してください。');
  }
  if ($comment === '') {
    $errors[] = array('classname' => 'comment', 'message'  => 'お問い合わせ内容を入力してください。');
  }

  if (count($errors) == 0) {
    $res['is_success'] = true;

    //キーとトークンが一致したら管理者に入力内容がメールで送られる
    if($_SESSION['key'] === $_POST['token']) {
      // エラーが無い場合
      //メールの件名
      $subject = 'お問い合わせを受け付けました。';
      //メール本文
      $comment =
        $name . '様からのお問い合わせ内容'
        . "\r\n\r\n" .
        '━━━━━━□■□  お問い合わせ内容  □■□━━━━━━'
        . "\r\n\r\n" .
        '名前:' . $name . "\r\n\r\n" .
        'メールアドレス:' . $email . "\r\n\r\n" .
        '内容:' . $comment .
        "\r\n\r\n" .
        '━━━━━━━━━━━━━━━━━━━━━━━━━';
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
  } else {
      // エラーがある場合は、レスポンスデータに追加します。
      $res['errors'] = $errors;
  }

header("Content-Type: application/json; charset=utf-8");
echo json_encode($res);