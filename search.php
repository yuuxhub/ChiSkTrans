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

    <div class="search-wrapper">
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
                  <input type="submit" value="検索" name="search">

                  <?php
                    if(!empty($_POST['search'])) { ?>


              <p><?php echo "SELECT mst_stage.stage As stage,inf_content.content As content,inf_content.biko As biko,mst_people.people As people,inf_content.priority As priority"
                       ." FROM inf_content"
                       ." join mst_stage on inf_content.stageId=mst_stage.id"
                       ." join mst_people on inf_content.peopleId=mst_people.id"
                       ." WHERE mst_stage.Id={$_POST['stage']}"
                       ." AND mst_people.Id={$_POST['people']}"
                       ." order by inf_content.id asc"; ?></p>
         <!--//表示する-->
         <!--//検索結果を取得する-->
         <?php
         $sql = "SELECT mst_stage.stage As stage,inf_content.content As content,inf_content.biko As biko,mst_people.people As people,inf_content.priority As priority"
                 ." FROM inf_content"
                 ." join mst_stage on inf_content.stageId=mst_stage.id"
                 ." join mst_people on inf_content.peopleId=mst_people.id"
                 ." WHERE mst_stage.Id={$_POST['stage']}"
                 ." AND mst_people.Id={$_POST['people']}"
                 ." order by inf_content.id asc";
         $result = $mysqli->query($sql);
             //取得した連想配列の中身を表示する
             while ($rowSearch = $result->fetch_assoc()){ ?>
               <p><?php echo $rowSearch['stage'] ; ?></p>
               <p><?php echo $rowSearch['content'] ; ?></p>
               <p><?php echo $rowSearch['biko'] ; ?></p>
               <p><?php echo $rowSearch['people'] ; ?></p>
               <p><?php echo $rowSearch['priority'] ; ?></p>
           <?php }
         }?>

     </div>
    </div>


<footer>
    <div class="container">
      <img src="http://localhost/img/logo_resize.png">
    </div>
  </footer>
</body>
</html>
