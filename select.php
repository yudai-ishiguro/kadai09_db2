<?php


include('funcs.php');

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM kadai08_db1_table');
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);
?>


<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Dive Log表示</title>
<link rel='stylesheet' href='css/range.css'>
<link href='css/bootstrap.min.css' rel='stylesheet'>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id='main'>
<!-- Head[Start] -->
<header>
  <nav class='navbar navbar-default'>
    <div class='container-fluid'>
      <div class='navbar-header'>
      <a class='navbar-brand' href='index.php'>データ登録（index.phpへ戻る）</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class='container jumbotron'>
      <h3>DB（kadai08_db1_table）の内容を表示</h3>
      <h4>(ここはselect.php)</h4>
      <table>
      <?php foreach($values as $v){ ?>
        <tr>
          <td><?=h($v["date"])?></td>
          <td><?=h($v["point_name"])?></td>
          <td><?=h($v["comment"])?></td>
          <td><?=h($v["wind_direction"])?></td>
          <td><a href="detail.php?id=<?=h($v["id"])?>">【更新(detai.phpへ)】</a></td>
          <td><a href="delete.php?id=<?=h($v["id"])?>">【削除(delete.phpへ)】</a></td>
        </tr>
      <?php } ?>
      </table>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
