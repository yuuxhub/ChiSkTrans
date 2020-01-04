<!DOCTYPE html>
<?php
require_once('sql.php');
//ヘッダファイルの読み込み
include __DIR__ . '/inc/header.php';
?>

    <!--// DB接続-->
    <?php $mysqli = dbOpen(); ?>
    <div class="todo-wrapper">
      <div class="container">
            <form action ="" method = "POST">
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
                  <input name="checkDb[]" type="checkbox" value="<?php echo $rowCont['Id']; ?> "/>

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
              <input type = submit class = "checkInput" value = "登録" name = "input" />
            </form>


            <?php

              if(isset($_POST['input'])) {
                if(isset($_POST['checkDb'])) { ?>
                <p><?php echo dbInsert($_POST['checkDb'],"admin",$mysqli) ?></p>
                <?php }else{ ?>
                <p> チェックが入っていません。</p>
            <?php  }
             }

            // DB接続を閉じる
            $mysqli->close(); ?>
    </div>
  </div>

  <!--//フッターファイル読み込み-->
  <?php include __DIR__ . '/inc/footer.php'; ?>

  </body>
</html>
