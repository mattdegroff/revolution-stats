<?php
include_once("connect.php");
$current = "2018";

$qual = array();
$qualSort = array();

$sql = "select player, `code` from players";
$result = $conn->query($sql);
if ($result) {
  while($row = $result->fetch_assoc()){
      $code = $row['code'];
      $name = $row['player'];
      $pa = 0;

      $sql = "select sum(ab), sum(walk), sum(sac) from ".$code." where year = ".$current;
      $result1 = $conn->query($sql);
      if ($result1) {
        while($row1 = $result1->fetch_assoc()){
          $pa = $row1['sum(ab)'] + $row1['sum(walk)'] + $row1['sum(sac)'];
        }
      }

      $sql = "select count(*) from results where year = ".$current." and inning > 0";
      $result1 = $conn->query($sql);
      if ($result1) {
        while($row1 = $result1->fetch_assoc()){
          $games = $row1['count(*)'];

        }
      }

      if ($pa/$games >= 2.3) {
        $qual[] = array($code, $name);
      }
  }
}

for ($i = 0; $i < sizeof($qual); $i++) {
  $sql = "select (sum(singles)+sum(doubles)+sum(triples)+sum(hr))/sum(ab) from ".$qual[$i][0]." where year = ".$current;
  $result = $conn->query($sql);
  if ($result) {
    while($row = $result->fetch_assoc()) {
      $avg = $row['(sum(singles)+sum(doubles)+sum(triples)+sum(hr))/sum(ab)'];
    }
  }

  $qualSort[] = array($qual[$i][0], $qual[$i][1], $avg);
}

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


array_sort_by_column($qualSort, 2, 'order');

for ($i = 0; $i < sizeof($qualSort); $i++) {
  echo $qualSort[$i][0]." - ".$qualSort[$i][1]." - ".$qualSort[$i][2]."<br>";
}

?>
