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

$sql = "delete from qual";
$result = $conn->query($sql);

$sql = "select count(*) from results where year = ".$current." and inning > 0 and finished = 1";
$result1 = $conn->query($sql);
if ($result1) {
  while($row1 = $result1->fetch_assoc()){
    $games = $row1['count(*)'];

  }
}

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

        if ($pa/$games >= 2.25) {
              $sql = "insert into qual (name, code, ab, runs, singles, doubles, triples, hr, rbi, sac, walk, k, qualify) values ('".$name."', '".$code."', ".$ab.", ".$r.", ".$sin.", ".$doub.", ".$trip.", ".$hr.", ".$rbi.", ".$sac.", ".$bb.", ".$k.", 1)";
              $result2 = $conn->query($sql);
        } else if ($games > 0){
              $sql = "insert into qual (name, code, ab, runs, singles, doubles, triples, hr, rbi, sac, walk, k, qualify) values ('".$name."', '".$code."', ".$ab.", ".$r.", ".$sin.", ".$doub.", ".$trip.", ".$hr.", ".$rbi.", ".$sac.", ".$bb.", ".$k.", 0)";
              $result2 = $conn->query($sql);
        }
      }
  }

function avg() {
  global $conn;
  $sql = "select name, (singles+doubles+triples+hr)/ab as ba from qual where qualify = 1 order by ba desc, name";
  $result = $conn->query($sql);
    if ($result) {
      while($row = $result->fetch_assoc()){
        $avg = ltrim(strval(number_format($row['ba'], 3, '.', '')), "0");
        echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$avg."</div></div>";
      }
    }

    echo "<hr>";

    $sql = "select name, (singles+doubles+triples+hr)/ab as ba from qual where qualify = 0 order by ba desc, name";
    $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
          $avg = ltrim(strval(number_format($row['ba'], 3, '.', '')), "0");
          echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$avg."</div></div>";
        }
      }
  }

  function obp() {
    global $conn;
    $sql = "select name, (singles+doubles+triples+hr+walk)/(ab+walk+sac) as obp from qual where qualify = 1 order by obp desc, name";
    $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
          $obp = ltrim(strval(number_format($row['obp'], 3, '.', '')), "0");
          echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$obp."</div></div>";
        }
      }

    echo "<hr>";

    $sql = "select name, (singles+doubles+triples+hr+walk)/(ab+walk+sac) as obp from qual where qualify = 0 order by obp desc, name";
    $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
          $obp = ltrim(strval(number_format($row['obp'], 3, '.', '')), "0");
          echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$obp."</div></div>";
        }
      }
    }

  function slg() {
    global $conn;
    $sql = "select name, (singles+(doubles*2)+(triples*3)+(hr*4))/ab as slg from qual where qualify = 1 order by slg desc, name";
    $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
          $slg = ltrim(strval(number_format($row['slg'], 3, '.', '')), "0");
          echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$slg."</div></div>";
        }
      }

    echo "<hr>";

    $sql = "select name, (singles+(doubles*2)+(triples*3)+(hr*4))/ab as slg from qual where qualify = 0 order by slg desc, name";
    $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
          $slg = ltrim(strval(number_format($row['slg'], 3, '.', '')), "0");
          echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$slg."</div></div>";
        }
      }
    }

  function hits() {
    global $conn;
    $sql = "select name, singles+doubles+triples+hr as h from qual order by h desc, name";
    $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
          echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['h']."</div></div>";
        }
      }
    }

  function singles() {
    global $conn;
    $sql = "select name, singles from qual order by singles desc, name";
    $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
          echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['singles']."</div></div>";
        }
      }
    }

    function doubles() {
      global $conn;
      $sql = "select name, doubles from qual order by doubles desc, name";
      $result = $conn->query($sql);
        if ($result) {
          while($row = $result->fetch_assoc()){
            echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['doubles']."</div></div>";
          }
        }
      }

    function triples() {
      global $conn;
      $sql = "select name, triples from qual order by triples desc, name";
      $result = $conn->query($sql);
        if ($result) {
          while($row = $result->fetch_assoc()){
            echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['triples']."</div></div>";
          }
        }
      }

    function hr() {
      global $conn;
      $sql = "select name, hr from qual order by hr desc, name";
      $result = $conn->query($sql);
        if ($result) {
          while($row = $result->fetch_assoc()){
            echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['hr']."</div></div>";
          }
        }
      }

    function rbi() {
      global $conn;
      $sql = "select name, rbi from qual order by rbi desc, name";
      $result = $conn->query($sql);
        if ($result) {
          while($row = $result->fetch_assoc()){
            echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['rbi']."</div></div>";
          }
        }
      }

    function walks() {
      global $conn;
      $sql = "select name, walk from qual order by walk desc, name";
      $result = $conn->query($sql);
        if ($result) {
          while($row = $result->fetch_assoc()){
            echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['walk']."</div></div>";
          }
        }
      }

    function sac() {
      global $conn;
      $sql = "select name, sac from qual order by sac desc, name";
      $result = $conn->query($sql);
        if ($result) {
          while($row = $result->fetch_assoc()){
            echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['sac']."</div></div>";
          }
        }
      }

    function total() {
      global $conn;
      $sql = "select name, singles+(doubles*2)+(triples*3)+(hr*4) as tb from qual order by tb desc, name";
      $result = $conn->query($sql);
        if ($result) {
          while($row = $result->fetch_assoc()){
            echo "<div class='row'><div class='col-8'>".$row['name']."</div><div class='col-4'>".$row['tb']."</div></div>";
          }
        }
      }

?>
