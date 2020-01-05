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
//　関数名：dbSelect();　　　※１回の実行で一行のみ取得　
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

////////////////////////////////////////////////////
//　関数名：dbCheckInsert();　※inf_check 専用
//　役割　：引数の配列の内容をDBにINSERTする　
//　引数　：$row (連想配列),$table（テーブル(文字列)）
//　戻り値：$message（文字列）
//　作成者：Y.Kimura
////////////////////////////////////////////////////
function dbCheckInsert($check,$user,$mysqli){
  for($i = 0;$i<count($check);$i++){
  //  echo $check[$i] ;
  //  echo "INSERT INTO inf_check (name,contentId,checkflag) VALUES(\"{$user}\",{$check[$i]},1)" ;
    $sql = "INSERT INTO inf_check (name,contentId,checkflag) VALUES(\"{$user}\",{$check[$i]},1)";
    $result = $mysqli->query($sql);
  }
    return "登録完了しました。" ;
}

?>
