<?php
include_once("connect.php");
$current = 2018;
?>
<p>Must be at least 2.25 to qualify</p>
<table>
  <thead>
    <tr><th>Player</th><th>PA/TGP</th></tr>
  </thead>
  <tbody>
<?php
$sql = "select player, `code` from players where not status = 0";
$result = $conn->query($sql);
  if ($result) {
    while($row = $result->fetch_assoc()){
        $code = $row['code'];
        $name = $row['player'];
        $pa = 0;

        $sql = "select sum(ab), sum(sac), sum(walk) from ".$code." where year = ".$current;
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

        echo "<tr><td>".$name."</td><td>".round($pa/$games, 2)."</td></tr>";
      }
    }
  ?>
  </tbody>
</table>
