<?php
require_once('sql.php');
////////////////////////////////////////////////////
//　関数名：selStage();
//　役割　：「工程」のプルダウン表示
//　引数　：$mysqli
//　戻り値：なし
//　作成者：Y.Kimura
////////////////////////////////////////////////////

function selStage($mysqli){

echo "<option value=\"未選択\">選択してください</option>";

$sql = "SELECT id As id ,stage As stage from mst_stage";
$result = $mysqli->query($sql);
  while ($rowStage = $result->fetch_assoc()){
    echo  "<option value={$rowStage["id"]}>{$rowStage["stage"]}</option>" ;
  }
}

////////////////////////////////////////////////////
//　関数名：selPeople();
//　役割　：「対象者」のプルダウン表示
//　引数　：$mysqli
//　戻り値：なし
//　作成者：Y.Kimura
////////////////////////////////////////////////////

function selPeople($mysqli){

echo "<option value=\"未選択\">選択してください</option>";

$sql = "SELECT id As id ,people As people from mst_people";
$result = $mysqli->query($sql);
  while ($rowPeople = $result->fetch_assoc()){
    echo  "<option value={$rowPeople["id"]}>{$rowPeople["people"]}</option>" ;
  }
}

////////////////////////////////////////////////////
//　関数名：selPriority();
//　役割　：「重要度」のプルダウン表示
//　引数　：$mysqli
//　戻り値：なし
//　作成者：Y.Kimura
////////////////////////////////////////////////////

function selPriority($mysqli){

echo "<option value=\"未選択\">選択してください</option>";

$rowPriority = array(1,2,3,4,5);
  for($i=0;$i<5;$i++){
    echo  "<option value=".($i+1).">{$rowPriority[$i]}</option>";
  }
}

 ?>
