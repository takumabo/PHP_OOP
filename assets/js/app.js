    // 画面遷移しないようにする
$(function(){
  //idがjs-delete-btnで始まるIDがクリックされたとき
    $(document).on('click', '[id^="js-delete-btn-"]', function (e) {
        //eはクリックされた要素
        //クリックされた要素のデフォルトの機能(別ページへ飛ぶ)を無効にする
        e.preventDefault();

        //idを取得
        //クリックされた要素のidの15文字目以降を取得
        let id = $(this).attr('id').substr('14');

        deleteTask(id);
        
    });

    function deleteTask(id){
      // リクエスト先,HTTPメソッド(GETで送るのかPOSTで送るのか),受け取るデータ型など指定,
      $.ajax({
        url: 'delete.php?id=' + id,
        type: 'GET',
        dateType: 'json'
      })
      .then(
          //成功した場合の処理
          function (data) {
            deleteDOM(id);
          },
          //失敗した場合の処理
          function () {

          }
      )
    }

    function deleteDOM(id){
      $('#js-task-' + id).remove();
    }
})



// DBからデータを削除する



// 画面からデータを削除する