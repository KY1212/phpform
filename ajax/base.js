$(function () {
  $('form').submit(function () {
    $('form p.error_message').remove();  // エラーメッセージをクリアします。
    duration = 500;
    var data = {};  // POSTデータを定義します。
    // 各要素（input[type="text"], textarea）でループします。
    $('form input, form textarea').each(function () {
      // POSTデータを追加します。
      data[$(this).attr('class')] = $.trim($(this).val());
    });

    // Ajaxリクエストを投げます。
    $.ajax({
      url: 'inquiry.php',
      data: {
        name: $('.name').val(),
        email: $('.email').val(),
        comment: $('.comment').val()
      },
      dataType: 'json',
      cache: false,
      type: 'post',

    // }).done(function (res) {
    //   alert("success!!!!!");
    //   //通信成功時の処理
    // if(res.is_success) {  // 入力エラーがなかった場合

    //   $('form')[0].reset();//フォームに入力している値をリセット
    //   $('.status').text("お問い合わせを受け付けました");//send_mail.phpから返ってきたメッセージをHTMLに入れて表示する
    // }
    // }).fail(function (res, jqXHR, textStatus, errorThrown) {
    //     alert("fail!!!!!");
    //     //通信失敗時の処理
    //     $('.status').text("送信に失敗しました");//send_mail.phpから返ってきたメッセージをHTMLに入れて表示する
    //     $('.result').addClass("display");
    //     $.each(res.errors, function (idx, error) {

    //       var $elem = $('form .' + error.classname);
    //       // 入力項目の直前に、エラーメッセージを追加します。
    //       $elem.before('<p class="error_message">' + error.message + '</p>');
    //       $('.result').animate({
    //         top: "0px"
    //       }, duration);
    //       console.log(data["name"] + "fail" + "\n" + data["email"] + "\n" + data["comment"]);
    //     });

    //   })



      // // //有力候補
      // }).done(function (res) {
      //   if(res.is_success) {  // 入力エラーがなかった場合
      //     alert("success!!!!!");
      //     $('.status').text("お問い合わせを受け付けました");//send_mail.phpから返ってきたメッセージをHTMLに入れて表示する
      //     //通信成功時の処理
      //     $('form')[0].reset();//フォームに入力している値をリセット
      //   } else {
      //     //通信失敗時の処理
      //     $('.status').text("送信に失敗しました");//send_mail.phpから返ってきたメッセージをHTMLに入れて表示する
      //     $('.result').addClass("display");

      //     $.each(res.errors, function (idx,error) {

      //       var $elem = $('form .' + error.classname);
      //       // 入力項目の直前に、エラーメッセージを追加します。
      //       $elem.before('<p class="error_message">' + error.message + '</p>');
      //       $('.result').animate({
      //         top: "0px"
      //       }, duration);
      //       console.log(data["name"]+"fail"+"\n"+data["email"]+"\n"+data["comment"]);

      //     });
      //   }
      // })






      success: function (res) {
        if (res.is_success) {  // 入力エラーがなかった場合
          $('.status').text("お問い合わせを受け付けました");//send_mail.phpから返ってきたメッセージをHTMLに入れて表示する
          $('.result').css({
            display: "block"
          });
          $('.result').animate({
            top: "0px"
          }, duration);
          alert("unko");
        } else {  // 入力エラーがあった場合
          $('.status').text("エラー");//send_mail.phpから返ってきたメッセージをHTMLに入れて表示する

          $.each(res.errors, function (idx, error) {
            // エラーが発生した入力項目を取得します。
            var $elem = $('form .' + error.classname);
            // 入力項目の直前に、エラーメッセージを追加します。
            $elem.before('<p class="error_message">' + error.message + '</p>');
          });
        }
      }
    });

    return false;
  });
});
