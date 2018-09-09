<?php
include_once("connect.php");
$sql = "select active from activeSeason";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $current = $row['active'];
  }
}
?>
<p>Must be at least 2.25 to qualify</p>
<table>
  <thead>
    <tr><th>Player</th><th>PA</th><th>TGP</th><th>PA/TGP</th></tr>
  </thead>
  <tbody>
<?php

$sql = "select count(*) from results where league = ".$current." and inning > 0 and finished = 1";
$result1 = $conn->query($sql);
if ($result1) {
  while($row1 = $result1->fetch_assoc()){
    $games = $row1['count(*)'];

  }
}

$sql = "select player, `code` from players where not status = 0";
$result = $conn->query($sql);
  if ($result) {
    while($row = $result->fetch_assoc()){
        $code = $row['code'];
        $name = $row['player'];
        $pa = 0;

        $sql = "select sum(ab), sum(sac), sum(walk) from ".$code." where league = ".$current;
        $result1 = $conn->query($sql);
        if ($result1) {
          while($row1 = $result1->fetch_assoc()){
            $pa = $row1['sum(ab)'] + $row1['sum(walk)'] + $row1['sum(sac)'];
          }
        }

        echo "<tr><td>".$name."</td><td>".$pa."</td><td>".$games."</td><td>".number_format($pa/$games, 2,".", ",")."</td></tr>";
      }
    }
  ?>
  </tbody>
</table>
