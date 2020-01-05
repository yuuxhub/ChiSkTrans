<!DOCTYPE html>
<?php
require_once('sql.php');
require_once('select.php');
//ヘッダファイルの読み込み
include __DIR__ . '/inc/header.php';
?>

    <div class="wrapper input-wrapper">
     <div class="container">
      <?php $mysqli = dbOpen(); ?>
       <div class="heading">
         <h3>新たに見つかったナレッジを登録しましょう</h3>
       </div>

       <!--//入力された内容をDBにINSERTする-->
    <?php
      if(!empty($_POST['input'])) {
        //全ての項目が入力されていない場合（！全ての項目入力されている）
         if(!(($_POST['stage']!="")&&($_POST['people']!="")&&(!empty($_POST['body']))&&(!empty($_POST['biko']))&&($_POST['priority']!=""))){ ?>
           <p><?php echo "上記項目を全て入力してください"; ?></p>
      <?php
      }else{
          $sql = "INSERT INTO inf_content (stageId,content,biko,peopleId,priority) VALUES({$_POST['stage']},\"{$_POST['body']}\",\"{$_POST['biko']}\",{$_POST['people']},{$_POST['priority']})";
          $result = $mysqli->query($sql);
          //$mysqli->commit();
          //$_POST['input'] = [] ; ?>
      <!--    <p><?php echo $_POST['stage'],$_POST['body'],$_POST['biko'],$_POST['people'],$_POST['priority'],$_POST['input']; ?></p>  -->
         <p>登録しました</p>
         <?php
       }
     }
     ?>


     <form method="post" action="">
      <div class = Forms>
         <div class="form-item">工程
          <select name="stage"><?php  selStage($mysqli); ?></select></div>

         <div class="form-item">対象者
          <select name="people"><?php  selPeople($mysqli); ?></select></div>

         <div class="form-item">重要度
         <select name="priority"><?php echo selPriority($mysqli) ?></select></div>

         <div class="">内容</div>
         <textarea name="body" class="form-box"></textarea>

         <div class="">備考</div>
         <textarea name="biko" class="form-box"></textarea>

         <div class="clear"></div>

         <input type="submit" value="追加" name="input" class="btn">
      </div>
    </form>
            <!--   <p><?php echo $_POST['stage'],$_POST['body'],$_POST['biko'],$_POST['people'],$_POST['priority'],$_POST['input']; ?></p>  -->
            <!--   <p><?php echo "INSERT INTO inf_content (stageId,content,biko,peopleId,priority) VALUES({$_POST['stage']},\"{$_POST['body']}\",\"{$_POST['biko']}\",{$_POST['people']},{$_POST['priority']})" ; ?></p>  -->


    <?php $mysqli->close(); ?>

     </div>
    </div>

  <!--//フッターファイル読み込み-->
  <?php include __DIR__ . '/inc/footer.php'; ?>

  </body>
</html>
