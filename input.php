<!DOCTYPE html>
<?php
require_once('sql.php');
require_once('select.php');
//ヘッダファイルの読み込み
include __DIR__ . '/inc/header.php';
?>

    <div class="wrapper input-wrapper">
     <div class="container">
       <div class="heading">
         <h3>新たに見つかったナレッジを登録しましょう</h3>
       </div>
       <?php $mysqli = dbOpen(); ?>
       <form method="post" action="">

               <div class="form-item">工程</div>
                <select name="stage"><?php  selStage($mysqli); ?></select>

               <div class="form-item">対象者</div>
                <select name="people"><?php  selPeople($mysqli); ?></select>

               <div class="form-item">内容</div>
               <textarea name="body"></textarea>

               <div class="form-item">備考</div>
               <textarea name="biko"></textarea>

               <div class="form-item">重要度</div>
               <select name="priority"><?php echo selPriority($mysqli) ?></select>


               <input type="submit" value="追加" name="input" class="btn">

               <p><?php echo $_POST['stage'],$_POST['body'],$_POST['biko'],$_POST['people'],$_POST['priority'],$_POST['input']; ?></p>
               <p><?php echo "INSERT INTO inf_content (stageId,content,biko,peopleId,priority) VALUES({$_POST['stage']},\"{$_POST['body']}\",\"{$_POST['biko']}\",{$_POST['people']},{$_POST['priority']})" ; ?></p>

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
                <p><?php echo $_POST['stage'],$_POST['body'],$_POST['biko'],$_POST['people'],$_POST['priority'],$_POST['input']; ?></p>
               <p>登録しました</p>
               <?php
             }
         }
             ?>

      </form>

    <?php $mysqli->close(); ?>

     </div>
    </div>

  <!--//フッターファイル読み込み-->
  <?php include __DIR__ . '/inc/footer.php'; ?>

  </body>
</html>
