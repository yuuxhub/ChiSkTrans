<!DOCTYPE html>
<!--//フッターファイル読み込み-->
<?php include __DIR__ . '/inc/header.php';?>

    <div class="wrapper Item-wrapper">
      <div class="container">
        <div class="heading">
          <h2>今すぐナレッジシェアしましょう</h2>
        </div>
        <div class="Items">
          <div class="Item">
            <p class="text-contents">PJの節目でチェック</p>
            <div class="Item-icon">
              <a href="todolist.php" class="">
              <img src="http://localhost/img/TodoList.png">
              <p>TodoList</p>
              </a>
            </div>
          </div>
          <div class="Item">
            <p class="text-contents">気になる事例を検索</p>
            <div class="Item-icon">
              <a href=search.php class="">
              <img src="http://localhost/img/Search.png">
              <p>Search</p>
              </a>
            </div>
          </div>
          <div class="Item">
            <p class="text-contents">新たな事例を登録</p>
            <div class="Item-icon">
              <a href="input.php" class="">
              <img src="http://localhost/img/Input.png">
              <p>Input</p>
              </a>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>

  <!--//フッターファイル読み込み-->
  <?php include __DIR__ . '/inc/footer.php'; ?>

  </body>
</html>
