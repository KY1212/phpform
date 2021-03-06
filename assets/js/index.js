$(function(){
  function form() {
    $('.contact-form').submit(function(e) {
      //フォームの既定の動作をキャンセルする
      e.preventDefault();
      //フォームの入力値を変数に格納する
      let form_data = $('form').serialize();
      if (!valid()) {
        //バリデーションに引っ掛かった場合
        return false;
      } else {
        myRet = confirm("送信しますか");
        if ( myRet == true ){
          //フォームの入力内容をajaxにより送信する
          $.ajax ({
            url: '../sendmail.php',//送信先のURL
            type: 'POST',//POST送信
            data: form_data,//送信するデータを指定
            timeout: 60000,  //タイムアウトの設定
            beforeSend: function (xhr, settings) {
              //リクエスト送信前にボタンを非活性化する
              $('.submit').attr('disabled', true);
            },
            complete: function(xhr, textStatus) {
              //リクエスト送信が完了したら、ボタンの非活性化を解除する
              $('.submit').attr('disabled', false);
            }
          }).done(function (data, textStatus, jqXHR) {
            //通信成功時の処理
            alert("送信しました");
            $('form')[0].reset();//フォームに入力している値をリセット
          }).fail(function (jqXHR, textStatus, errorThrown) {
            //通信失敗時の処理
            alert("送信に失敗しました");
          });
        }else{
          alert("キャンセルしました");
        }
      }
    });
  }

  function valid(){
    let result = true;
    // エラー用装飾のためのクラスリセット
    $('#name').removeClass("inp_error");
    $('#email').removeClass("inp_error");
    $('#comment').removeClass("inp_error");
    // 入力エラー文をリセット
    $("#name_error").empty();
    $("#email_error").empty();
    $("#comment_error").empty();
    // 入力内容セット
    let name   = $("#name").val();
    let email  = $("#email").val();
    let comment = $("#comment").val();
    // お名前
    if(name == ""){
      $("#name_error").html(" お名前は必須です。");
      $("#name").addClass("inp_error");
      result = false;
    }else if(name.length > 15){
      $("#name_error").html(" お名前は15文字以内で入力してください。");
      $("#name").addClass("inp_error");
      result = false;
    }
    // メールアドレス
    if(email == ""){
      $("#email_error").html(" メールアドレスは必須です。");
      $("#email").addClass("inp_error");
      result = false;
    } else if (!email.match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/)) {
      $('#email_error').html(" 正しいメールアドレスを入力してください。");
      $("#email").addClass("inp_error");
      result = false;
    }else if(email.length > 255){
      $('#email_error').html(" 正しいメールアドレスを入力してください。");
      $("#email").addClass("inp_error");
      result = false;
    }
    // お問い合わせ内容
    if(comment == ""){
      $("#comment_error").html(" お問い合わせ内容は必須です。");
      $("#commnet").addClass("inp_error");
      result = false;
    }else if(comment.match(/[<(.*)>.*<\/\1>]/)){
      $('#comment_error').html(" HTML、URLの貼りつけは禁止しています。");
      $("#commnet").addClass("inp_error");
      result = false;
    }else if(comment.match(/^[ \r\n\t]*$/)){
      $('#comment_error').html(" お問い合わせ内容は必須です。");
      $("#commnet").addClass("inp_error");
      result = false;
    }else if(comment.length > 225){
      $('#comment_error').html(" 文字数は２５５文字以内です。");
      $("#commnet").addClass("inp_error");
      result = false;
    }

    return result;
    }
  form();
});
