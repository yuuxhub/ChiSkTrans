<!DOCTYPE html>
<?php
require_once('sql.php');
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareNow</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>
  <body>
    <header>
      <div class="container">
        <div class="header-left">
          <a href="http://localhost/ChiSkTrans/main.html">
          <img class="logo" src="http://localhost/img/logo_yoko_resize.png">
        </a>
        </div>
        <!--   -->
        <div>
          <span class="fa fa-bars menu-icon"></span>
        </div>

        <div class="header-right">
          <a href="todolist.php">TodoList</a>
          <a href="search.php">Search</a>
          <a href="input.php">Input</a>
          <a href="login.php" class="login">Login</a>
        </div>
      </div>
    </header>
    <!--// DB接続-->
    <?php $mysqli = dbOpen(); ?>
    <div class="todo-wrapper">
      <div class="container">


          <?php

            $checkDb = array();

            //STAGEのMAXIDを調べる $rowMaxId['maxStage']
            $rowMaxId = dbSelect("SELECT max(id) As maxStage FROM mst_stage",$mysqli);
            //STAGEごとのコンテンツ数、STAGE名を調べる　$rowCount['stageCont']　$rowCount['stage']
          for($i = 1 ;$i<= $rowMaxId['maxStage'] ; $i++){
            $rowCount = dbSelect("SELECT Count(inf_content.id) As stageCont, mst_stage.stage from inf_content join mst_stage on inf_content.stageId = mst_stage.id WHERE mst_stage.Id={$i}",$mysqli);
            //もしコンテンツがあるならば
          if($rowCount['stageCont'] > 0) { ?>
          <div class="todo-Title">
            <!--タイトル-->
            <p><?php echo $rowCount['stage'] ?></p>
          </div>
          <?php
              //コンテンツを連想配列で取得する $rowCont
              $sql = "SELECT inf_content.content,inf_content.Id FROM inf_content WHERE inf_content.stageId={$i} order by inf_content.id asc";
              $result = $mysqli->query($sql);
                  //取得した連想配列の中身を表示する $rowCont['content']
                  while ($rowCont = $result->fetch_assoc()){ ?>
                  <form action ="" method = "POST">
                  <input name="checkDb[]" type="checkbox" value=" <?php echo $rowCont["Id"] ?> "/>
                  </form>

                  <!--内容-->
                  <div class="todo-content">
                    <p><?php echo $rowCont['content'] ?></p>
                  </div>
                  <?php
                 }
           $result->close();
           }
         }
            ?>

            <!--//チェックボックスの内容をDBにINSERTする-->
            <form action ="" method = "POST">
              <input type = submit class = "checkInput" value = "登録" name = "input" />
            </form>

            <?php
              if(isset($_POST['input'])) {
                if(isset($_POST['checkDb'])) { ?>
                <p><?php echo dbInsert($_POST['checkDb'],"admin",$mysqli) ?>
                <?php }else{ ?>
                <?php var_dump($checkDb) ; ?>
                <p> チェックが入っていません。</p>
            <?php  }
             }

            // DB接続を閉じる
           $mysqli->close(); ?>
    </div>
  </div>

  <footer>
    <div class="container">
      <img src="http://localhost/img/logo_resize.png">
    </div>
  </footer>
</body>
</html>
