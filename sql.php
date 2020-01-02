<?php
////////////////////////////////////////////////////
//　関数名：dbOpen();
//　役割　：mysqliクラスのオブジェクトを作成
//　引数　：なし
//　戻り値：$mysqli（連想配列）
//　作成者：Y.Kimura
////////////////////////////////////////////////////

function dbOpen(){
$mysqli = new mysqli('localhost', 'root', 'chiiI2020', 'knowledge');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
return $mysqli ;
}

////////////////////////////////////////////////////
//　関数名：dbSelect();
//　役割　：引数のSQL文結果を連想配列として返す
//　引数　：$sql (文字列)
//　戻り値：$row（連想配列）
//　作成者：Y.Kimura
////////////////////////////////////////////////////

function dbSelect($sql,$mysqli){
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  $result->close();
  
  return $row ;
}

?>
