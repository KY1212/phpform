<?php
// 変数の初期化
$page_flag = 0;
$clean = array();
$error = array();


// サニタイズ
if( !empty($_POST) ) {
	foreach( $_POST as $key => $value ) {
		$clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
	}
}

if( !empty($_POST['btn_confirm']) ) {

	$error = validation($clean);

	if( empty($error) ) {
		$page_flag = 1;

		// セッションの書き込み
		session_start();
		$_SESSION['page'] = true;
	}

  } elseif( !empty($_POST['btn_submit']) ) {

	session_start();
	if( !empty($_SESSION['page']) && $_SESSION['page'] === true ) {

		// セッションの削除
		unset($_SESSION['page']);

	$page_flag = 2;

	// 変数とタイムゾーンを初期化
  $header = null;
	$auto_reply_subject = null;
	$auto_reply_text = null;
  $admin_reply_subject = null;
	$admin_reply_text = null;
	date_default_timezone_set('Asia/Tokyo');

  // ヘッダー情報を設定
	$header = "MIME-Version: 1.0\n";
	$header .= "From: yusuke kato <noreply@gray-code.com>\n";
	$header .= "Reply-To: yusuke kato <noreply@gray-code.com>\n";

	// 件名を設定
	$auto_reply_subject = 'お問い合わせありがとうございます。';

	// 本文を設定
	$auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。
下記の内容でお問い合わせを受け付けました。\n\n";
	$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "氏名：" . $_POST['name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
  $auto_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";


	$auto_reply_text .= "受付係";

	// メール送信
	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text,$header);
}
	// 運営側へ送るメールの件名
	$admin_reply_subject = "お問い合わせを受け付けました";

	// 本文を設定
	$admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
	$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$admin_reply_text .= "氏名：" . $_POST['name'] . "\n";
	$admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
  $admin_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";


	// 運営側へメール送信
	mb_send_mail( 'lilium74u@gmail.com', $admin_reply_subject, $admin_reply_text, $header);
	} else {
		$page_flag = 0;
	}
  function validation($data) {

	$error = array();

	// 氏名のバリデーション
	if( empty($data['name']) ) {
		$error[] = "「氏名」は必ず入力してください。";
	}elseif( 20 < mb_strlen($data['name']) ) {
		$error[] = "「氏名」は20文字以内で入力してください。";
	}
  // メールアドレスのバリデーション
	if( empty($data['email']) ) {
		$error[] = "「メールアドレス」は必ず入力してください。";
	}elseif( !preg_match( '/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['email']) ) {
		$error[] = "「メールアドレス」は正しい形式で入力してください。";
	}
  // お問い合わせ内容のバリデーション
	if( empty($data['contact']) ) {
		$error[] = "「お問い合わせ内容」は必ず入力してください。";
	}elseif( 300 < mb_strlen($data['name']) ) {
		$error[] = "「お問い合わせ内容」は300文字以内で入力してください。";
	}

	return $error;
}
?>
