$(function() {
  $('form').submit(function() {
    $('form p.error_message').remove();  // エラーメッセージをクリアします。
    duration = 300;
    var data = {};  // POSTデータを定義します。
    // 各要素（input[type="text"], textarea）でループします。
    $('form input, form textarea').each(function() {
      // POSTデータを追加します。
      data[$(this).attr('class')] = $.trim($(this).val());
    });

    // Ajaxリクエストを投げます。
    $.ajax({
      url: 'inquiry.php',
      data: data,
      dataType: 'json',
      cache: false,
      type: 'POST',
      success: function(res) {
        if (res.is_success) {  // 入力エラーがなかった場合
          $('.result').css({
            display: "block"
          });
          $('.result').animate({
            top: "0px"
          },duration);
        } else {  // 入力エラーがあった場合
          $.each(res.errors, function(idx, error) {
            // エラーが発生した入力項目を取得します。
            var $elem = $('form .' + error.classname);
            // 入力項目の直前に、エラーメッセージを追加します。
            $elem.before('<p class="error_message">' + error.message +  '</p>');
          });
        }
      }
    });
    return false;
  });
});
