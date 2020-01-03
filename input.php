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
        <div>
          <span class="fa fa-bars menu-icon"></span>
        </div>

        <div class="header-right">
          <a href="todolist.php">TodoList</a>
          <a href="search.php">Search</a>
          <a href="input.php">Input</a>
          <a href="#" class="login">Login</a>
        </div>
      </div>
    </header>

    <div class="input-wrapper">
     <div class="container">
       <?php $mysqli = dbOpen(); ?>
       <form method="post" action="">

               <div class="form-item">対象者</div>
               <select name="people">
                  <option value="未選択">選択してください</option>
                  <?php
                  $sql = "SELECT id As id ,people As people from mst_people";
                  $result = $mysqli->query($sql);
                    while ($rowPeople = $result->fetch_assoc()){
                   echo  "<option value={$rowPeople["id"]}>{$rowPeople["people"]}</option>" ;
                   }
                   ?>
                </select>


               <div class="form-item">内容</div>
               <textarea name="body"></textarea>

               <div class="form-item">備考</div>
               <textarea name="biko"></textarea>

               <input type="submit" value="追加" name="input">


               <div class="form-item">工程</div>
               <select name="stage">
                 <option value="未選択">選択してください</option>
                 <?php
                 $sql = "SELECT id As id ,stage As stage from mst_stage";
                 $result = $mysqli->query($sql);
                   while ($rowStage = $result->fetch_assoc()){
                  echo  "<option value={$rowStage["id"]}>{$rowStage["stage"]}</option>" ;
                  }
                  ?>
               </select>


               <div class="form-item">対象者</div>
               <select name="content">
                  <option value="未選択">選択してください</option>
                  <?php
                  $sql = "SELECT id As id ,people As people from mst_people";
                  $result = $mysqli->query($sql);
                    while ($rowPeople = $result->fetch_assoc()){
                   echo  "<option value={$rowPeople["id"]}>{$rowPeople["people"]}</option>" ;
                   }
                   ?>
                </select>

                <!--//入力された内容をDBにINSERTする-- >
                <?php
                  if(isset($_POST['input'])) {
                    if(!(isset($_POST['stage'])&&(isset($_POST['people'])&&(isset($_POST['body'])&&(isset($_POST['biko'])) {
                      echo <p>上記項目を全て入力してください</p> ;
                    }
              }else{
                $sql = "INSERT INTO inf_content (stage,contentId,checkflag) VALUES({$user},{$check[$i]},1)";
                $result = $mysqli->query($sql);
                $mysqli->commit();
               echo  <p> 登録しました</p> ;
              }


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
