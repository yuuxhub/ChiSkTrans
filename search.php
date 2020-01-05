<!DOCTYPE html>
<?php
require_once('sql.php');
require_once('select.php');
//ヘッダファイルの読み込み
include __DIR__ . '/inc/header.php';
?>

    <div class="wrapper search-wrapper">
     <div class="container">
       <div class="heading">
         <h3>条件を入力して事例を検索しましょう</h3>
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

            <input type="submit" value="検索" name="search" class="btn">

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


    <!--//フッターファイル読み込み-->
    <?php include __DIR__ . '/inc/footer.php'; ?>

  </body>
</html>
