$(function () {

  function validation() {

}

  function ajax() {
      $('.submit').click(function () {
    if (!confirm('テスト送信してもよろしいですか？')) {
      return false;
    } else {
      $('.contact-form').submit(function(e) {
        //フォームの既定の動作をキャンセルする
        e.preventDefault();
        //フォームの入力値を変数に格納する
        let form_data = $('form').serialize();
        duration = 300;
        //フォームの入力内容をajaxにより送信する
        $.ajax ({
          url: 'sendmail.php',//送信先のURL
          type: 'POST',//POST送信
          data: {
            name: $('.name').val(),
            email: $('.email').val(),
            message: $('.comment').val()
          },
          timeout: 60000,  //タイムアウトの設定
          beforeSend: function (xhr, settings) {
            //リクエスト送信前にボタンを非活性化する
            $('.submit').attr('disabled', true);



          },
          complete: function(xhr, textStatus) {
            //モーダルウィンドウを消す
            $('.status-wrap').css({
              display: "block"
            });
            $('.status-wrap').animate({
              top: "0px"
            },duration);
            //リクエスト送信が完了したら、ボタンの非活性化を解除する
            $('.submit').attr('disabled', false);
          }
        }).done(function(data, textStatus, jqXHR) {
          //通信成功時の処理
          $('form')[0].reset();//フォームに入力している値をリセット
          $('#result').text(data);//send_mail.phpから返ってきたメッセージをHTMLに入れて表示する
          $('.status-wrap').css({
              display: "block"
            });
            $('.status-wrap').animate({
              top: "0px"
            },duration);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            //通信失敗時の処理
          $('#result').text('送信できませんでした');//失敗メッセージをHTMLに入れて表示する
        });
      });
    }
  });
  }
  function init() {
    validation();
    ajax();
  }
  init();
});
