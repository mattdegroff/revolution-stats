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

      $sql = "select sum(ab), sum(runs), sum(singles), sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac), sum(walk), sum(k) from ".$code." where year = ".$current;
      $result1 = $conn->query($sql);
      if ($result1) {
        while($row1 = $result1->fetch_assoc()){
          $pa = $row1['sum(ab)'] + $row1['sum(walk)'] + $row1['sum(sac)'];
          $ab = $row['sum(ab)'];
          $r = $row['sum(runs)'];
          $sin = $row['sum(singles)'];
          $doub = $row['sum(doubles)'];
          $trip = $row['sum(triples)'];
          $hr = $row['sum(hr)'];
          $rbi = $row['sum(rbi)'];
          $sac = $row['sum(sac)'];
          $bb = $row['sum(walk)'];
          $k = $row['sum(k)'];
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
            $sql = "insert into qual (name, code, ab, runs, singles, doubles, triples, hr, rbi, sac, walk, k) values ('".$name."', '".$code."', ".$ab.", ".$r.", ".$sin.", ".$doub.", ".$trip.", ".$hr.", ".$rbi.", ".$sac.", ".$bb.", ".$k.")";
            echo $sql."<br>";
            $result2 = $conn->query($sql);

  }
}

?>
