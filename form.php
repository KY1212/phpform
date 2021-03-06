<!DOCTYPE>
<html lang="ja">
<head>
<title>フォーム</title>
<link rel="stylesheet" href="/assets/css/style.css">
<?php require('functions.php');?>

</head>
<body>
<h1>お問い合わせ</h1>
<?php if( $page_flag === 1 ): ?>
<form method="post" action="">
	<div class="element_wrap">
		<label>氏名</label>
		<p><?php echo $_POST['name']; ?></p>
	</div>
	<div class="element_wrap">
		<label>メールアドレス</label>
		<p><?php echo $_POST['email']; ?></p>
	</div>
  <div class="element_wrap">
		<label>お問い合わせ</label>
		<p><?php echo $_POST['contact']; ?></p>
	</div>
	<input type="submit" name="btn_back" value="戻る">
	<input type="submit" name="btn_submit" value="送信">
	<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
	<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
  <input type="hidden" name="contact" value="<?php echo $_POST['contact']; ?>">

</form>
<?php elseif( $page_flag === 2 ): ?>
<p>送信が完了しました。</p>
<?php else: ?>
  <?php if( !empty($error) ): ?>
	<ul class="error_list">
	<?php foreach( $error as $value ): ?>
		<li><?php echo $value; ?></li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
<form method="post" action="">
	<div class="element_wrap">
		<label>氏名</label>
		<input type="text" name="name" value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>">
	</div>
	<div class="element_wrap">
		<label>メールアドレス</label>
		<input type="text" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>">
	</div>
  <div class="element_wrap">
		<label>お問い合わせ内容</label>
		<textarea name="contact"></textarea>
	</div>
	<input type="submit" name="btn_confirm" value="入力内容を確認する">
</form>
<?php endif; ?>

</body>
</html>
