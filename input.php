<!DOCTYPE html>
<?php
require_once('sql.php');
require_once('select.php');
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

    <div class="input-wrapper">
     <div class="container">
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


               <input type="submit" value="追加" name="input">

               <p><?php echo $_POST['stage'],$_POST['body'],$_POST['biko'],$_POST['people'],$_POST['priority'],$_POST['input']; ?></p>
               <p><?php echo "INSERT INTO inf_content (stageId,content,biko,peopleId,priority) VALUES({$_POST['stage']},\"{$_POST['body']}\",\"{$_POST['biko']}\",{$_POST['people']},{$_POST['priority']})" ; ?></p>

               <!--//入力された内容をDBにINSERTする-->
            <?php
              if(!empty($_POST['input'])) {
                //全ての項目が入力されていない場合（！全ての項目入力されている）
                 if(!(($_POST['stage']!="未選択")&&($_POST['people']!="未選択")&&(!empty($_POST['body']))&&(!empty($_POST['biko']))&&($_POST['people']!="未選択"))){ ?>
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

<footer>
    <div class="container">
      <img src="http://localhost/img/logo_resize.png">
    </div>
  </footer>
</body>
</html>
