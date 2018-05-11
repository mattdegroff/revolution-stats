<?php
include_once("connect.php");
$current = "2018";

$ab = 0;
$r = 0;
$sin = 0;
$doub = 0;
$trip = 0;
$hr = 0;
$rbi = 0;
$sac = 0;
$bb = 0;
$k = 0;

function qual() {
  $sql = "delete from qual";
  $result = $conn->query($sql);

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
              $ab = $row1['sum(ab)'];
              $r = $row1['sum(runs)'];
              $sin = $row1['sum(singles)'];
              $doub = $row1['sum(doubles)'];
              $trip = $row1['sum(triples)'];
              $hr = $row1['sum(hr)'];
              $rbi = $row1['sum(rbi)'];
              $sac = $row1['sum(sac)'];
              $bb = $row1['sum(walk)'];
              $k = $row1['sum(k)'];
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
                $result2 = $conn->query($sql);
          }
        }
    }
}

function avg() {
  $sql = "select name, (singles+doubles+triples+hr)/ab as ba from qual order by ba desc";
  /*$result = $conn->query($sql);
    if ($result) {
      while($row = $result->fetch_assoc()){
        echo $row['name']." - ".$row['(singles+doubles+triples+hr)/ab']."</br>";
      }
    }*/
  }

?>
