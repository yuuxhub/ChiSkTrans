<!DOCTYPE html>
<?php
require_once('sql.php');
//ヘッダファイルの読み込み
include __DIR__ . '/inc/header.php';
?>

    <!--// DB接続-->
    <?php $mysqli = dbOpen(); ?>
    <div class="wrapper todo-wrapper">
      <div class="container">
        <div class="heading">
          <h3>完了した項目にチェックしていきましょう</h3>
        </div>

        <?php
        //チェックボックスの内容をDBにINSERTする
        if(!empty($_POST['input'])) {
          if(!empty($_POST['checkDb'])) { ?>
            <p><?php echo dbCheckInsert($_POST['checkDb'],"admin",$mysqli) ?></p>
          <?php }else{
            echo "<p>チェックが入っていません。</p>";
          }
       }

         ?>

        <form action ="todolist.php" method = "POST">
          <?php
            //チェックボックスリストの初期化
            $checkDb = array();
            //STAGE自体のMAXIDを調べる $rowMaxId['maxStage']　基本は定数
            $rowMaxId = dbSelect("SELECT max(id) As maxStage FROM mst_stage",$mysqli);
            //STAGEごとのコンテンツ数、STAGE名を調べる　$rowCount['stageCont']　$rowCount['stage']
          for($i = 1 ;$i<= $rowMaxId['maxStage'] ; $i++){
                $rowCount = dbSelect("SELECT Count(inf_content.id) As stageCont, mst_stage.stage from inf_content join mst_stage on inf_content.stageId = mst_stage.id WHERE mst_stage.Id={$i}",$mysqli);
                //もしコンテンツがあるならば
              if($rowCount['stageCont'] > 0) { ?>
              <div class="Stage">
              <!--タイトル-->
              <div class="<?php echo $rowCount['stage'];?> todo-Title">
                <p><?php echo $rowCount['stage']; ?></p>
              </div>
              <?php
                  //コンテンツを連想配列で取得する $rowCont
                  $sql = "SELECT inf_content.content,inf_content.Id FROM inf_content WHERE inf_content.stageId={$i} order by inf_content.id asc";
                  $result = $mysqli->query($sql);
                  //取得した連想配列の中身を表示する $rowCont['content']
                  while ($rowCont = $result->fetch_assoc()){ ?>
                    <!--内容-->
                    <div class = "todo-content">
                      <label><input name="checkDb[]" type="checkbox" value="<?php echo $rowCont['Id']; ?>"/><?php echo $rowCont['content']; ?></lable>
                    </div>
              　<?php
                }
               $result->close(); ?>
               </div>
        <?php }
           }
              ?>
          <!--登録ボタン-->
          <input type = submit value = "登録" name = "input" class="btn"/>
      　</form>

            <?php
            // DB接続を閉じる
            $mysqli->close(); ?>
    </div>
  </div>

  <!--//フッターファイル読み込み-->
  <?php include __DIR__ . '/inc/footer.php'; ?>

  </body>
</html>
