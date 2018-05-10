<?php
include_once("connect.php");
$current = "2018";

$qual = array();

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
        $qual[] = $code;
      }
  }
}

for ($i = 0; $i < sizeof($qual); $i++) {
  echo $qual[$i]."<br>";
}
?>
