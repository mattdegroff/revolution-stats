<?php
include_once("connect.php");
$current = "2017";

$key = '';

$sql = "select id, player, `code` from players";
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

      $sql = "select count(*) from results where year = ".$current;
      $result1 = $conn->query($sql);
      if ($result1) {
        while($row1 = $result1->fetch_assoc()){
          $games = $row1['count(*)'];

        }
      }

      if ($pa/$games >= 2.3) {
        $sql = "select max(id) from players";
        $result1 = $conn->query($sql);
        if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()){
            $max = $row1['max(id)'];
          }
        }

        if ($row['id'] != 1) {
          $key .= ' union all ';
          $key .= "select ab, runs, singles,
          doubles, triples, hr, rbi, sac,
          walk, k from ".$code;
        } else {
          $key .= "select ab, runs, singles,
          doubles, triples, hr, rbi, sac,
          walk, k from ".$code;
        }
      }
  }
}

echo $key;



function avg($key) {
  $sql = "select id, player, `code` from players";
  $result = $conn->query($sql);
  if ($result) {
    while($row = $result->fetch_assoc()){
}

?>
