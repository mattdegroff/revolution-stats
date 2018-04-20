<?php
  include_once("connect.php");
  $current = "2017";
  $

  $key = '';
  $keyR = '';


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

        /*if ($pa/$games >= 2.3) {
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
        }*/
    }
  }

  $sql = "select id, player, `code` from players where status = 1";
  $result = $conn->query($sql);
  if ($result) {
    while($row = $result->fetch_assoc()){
            if ($row['id'] != 1 && $row['code'] != 'genna' && $row['code']!= 'lively') {
            $key .= ' union all ';
            $key .= "select ab, runs, singles,
            doubles, triples, hr, rbi, sac,
            walk, k from ".$row['code'];
          } else if ($row['code'] != 'genna' && $row['code']!= 'lively'){
            $key .= "select ab, runs, singles,
            doubles, triples, hr, rbi, sac,
            walk, k from ".$row['code'];
          }
        }
      }

      $sql = "select id, player, `code` from players where status = 2";
      $result = $conn->query($sql);
      $count = 1;
      if ($result) {
        while($row = $result->fetch_assoc()){
                if ($count != 1 && $row['code'] != 'grup') {
                $keyR .= ' union all ';
                $keyR .= "select ab, runs, singles,
                doubles, triples, hr, rbi, sac,
                walk, k from ".$row['code'];
              } else if ($row['code'] != 'grup'){
                $keyR .= "select ab, runs, singles,
                doubles, triples, hr, rbi, sac,
                walk, k from ".$row['code'];
              }
              $count++;
            }
          }

/*$sql = $key;
$result = $conn->query($sql);
if ($result) {
  while($row = $result->fetch_assoc()){
    $hits = $row['sum(singles)'] + $row['sum(doubles)'] + $row['sum(triples)'] + $row['sum(hr)'];
    $ab = $row['sum(ab)'];


  }
}*/
?>
<div class='container text-center'>
    <h3>Active</h3>
    <div class="table-responsive-xl">
      <table class="table text-center table-sm table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>G</th>
            <th>Avg.</th>
            <th>OBP.</th>
            <th>SLG.</th>
            <th>AB</th>
            <th>H</th>
            <th>R</th>
            <th>1B</th>
            <th>2B</th>
            <th>3B</th>
            <th>HR</th>
            <th>RBI</th>
            <th>SAC</th>
            <th>BB</th>
            <th>K</th>
            <th>TB</th>
          </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select player, code from players where status = 1";
        $result1 = $conn->query($sql);
        if($result1) {
          while($row1 = $result1->fetch_assoc()){
                $code = $row1['code'];

        $sql = "select sum(ab), sum(runs), sum(singles),
        sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
        sum(walk), sum(k) from ".$code;
        $result = $conn->query($sql);
        if ($result) {
          while($row = $result ->fetch_assoc()){
            $ab = $row['sum(ab)'];
            $r = $row['sum(runs)'];
            $sing = $row['sum(singles)'];
            $doub = $row['sum(doubles)'];
            $trip = $row['sum(triples)'];
            $hr = $row['sum(hr)'];
            $rbi = $row['sum(rbi)'];
            $sac = $row['sum(sac)'];
            $walk = $row['sum(walk)'];
            $k = $row['sum(k)'];

            $sql = "select count(*) from ".$code;
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
              while($row2 = $result2 ->fetch_assoc()){
                $g = $row2['count(*)'];
              }
            }

            $hits = $sing + $doub + $trip + $hr;
            $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
            $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
            $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
            $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");

            echo '<tr>
                    <td>'.$row1['player'].'</td>
                    <td>'.$g.'</td>
                    <td>'.$avg.'</td>
                    <td>'.$obp.'</td>
                    <td>'.$slg.'</td>
                    <td>'.$ab.'</td>
                    <td>'.$hits.'</td>
                    <td>'.$r.'</td>
                    <td>'.$sing.'</td>
                    <td>'.$doub.'</td>
                    <td>'.$trip.'</td>
                    <td>'.$hr.'</td>
                    <td>'.$rbi.'</td>
                    <td>'.$sac.'</td>
                    <td>'.$walk.'</td>
                    <td>'.$k.'</td>
                    <td>'.$total_B.'</td>
                  </tr>';
          }
        } else {
          echo '<tr>
                  <td>'.$row1['player'].'</td>
                  <td>0</td>
                  <td>.000</td>
                  <td>.000</td>
                  <td>.000</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                </tr>';
        }
      }
    }
    ?>
        </tbody>
        <tfoot class="thead-light">
          <?php
          $sql = "select sum(u.ab), sum(u.runs), sum(u.singles),
          sum(u.doubles), sum(u.triples), sum(u.hr), sum(u.rbi), sum(u.sac),
          sum(u.walk), sum(u.k) from (".$key.") as u";
          $result = $conn->query($sql);
          if ($result) {
            while($row = $result ->fetch_assoc()){
              $ab = $row['sum(u.ab)'];
              $r = $row['sum(u.runs)'];
              $sing = $row['sum(u.singles)'];
              $doub = $row['sum(u.doubles)'];
              $trip = $row['sum(u.triples)'];
              $hr = $row['sum(u.hr)'];
              $rbi = $row['sum(u.rbi)'];
              $sac = $row['sum(u.sac)'];
              $walk = $row['sum(u.walk)'];
              $k = $row['sum(u.k)'];

              $sql = "select count(*) from results where year=".$current." and inning > 0";
              $result2 = $conn->query($sql);
              if ($result2->num_rows > 0) {
                while($row2 = $result2 ->fetch_assoc()){
                  $g = $row2['count(*)'];
                }
              }

              $hits = $sing + $doub + $trip + $hr;
              $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
              $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
              $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
              $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");

              echo '<tr>
                      <th>Total</th>
                      <th>'.$g.'</th>
                      <th>'.$avg.'</th>
                      <th>'.$obp.'</th>
                      <th>'.$slg.'</th>
                      <th>'.$ab.'</th>
                      <th>'.$hits.'</th>
                      <th>'.$r.'</th>
                      <th>'.$sing.'</th>
                      <th>'.$doub.'</th>
                      <th>'.$trip.'</th>
                      <th>'.$hr.'</th>
                      <th>'.$rbi.'</th>
                      <th>'.$sac.'</th>
                      <th>'.$walk.'</th>
                      <th>'.$k.'</th>
                      <th>'.$total_B.'</th>
                    </tr>';
            }
          }
           ?>
        </tfoot>
      </table>
    </div>

    <h3>Reserves</h3>
    <div class="table-responsive-xl">
      <table class="table text-center table-sm table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>G</th>
            <th>Avg.</th>
            <th>OBP.</th>
            <th>SLG.</th>
            <th>AB</th>
            <th>H</th>
            <th>R</th>
            <th>1B</th>
            <th>2B</th>
            <th>3B</th>
            <th>HR</th>
            <th>RBI</th>
            <th>SAC</th>
            <th>BB</th>
            <th>K</th>
            <th>TB</th>
          </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select player, code from players where status = 2";
        $result1 = $conn->query($sql);
        if($result1) {
          while($row1 = $result1->fetch_assoc()){
                $code = $row1['code'];

        $sql = "select sum(ab), sum(runs), sum(singles),
        sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
        sum(walk), sum(k) from ".$code;
        $result = $conn->query($sql);
        if ($result) {
          while($row = $result ->fetch_assoc()){
            $ab = $row['sum(ab)'];
            $r = $row['sum(runs)'];
            $sing = $row['sum(singles)'];
            $doub = $row['sum(doubles)'];
            $trip = $row['sum(triples)'];
            $hr = $row['sum(hr)'];
            $rbi = $row['sum(rbi)'];
            $sac = $row['sum(sac)'];
            $walk = $row['sum(walk)'];
            $k = $row['sum(k)'];

            $sql = "select count(*) from ".$code;
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
              while($row2 = $result2 ->fetch_assoc()){
                $g = $row2['count(*)'];
              }
            }

            $hits = $sing + $doub + $trip + $hr;
            $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
            $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
            $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
            $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");

            echo '<tr>
                    <td>'.$row1['player'].'</td>
                    <td>'.$g.'</td>
                    <td>'.$avg.'</td>
                    <td>'.$obp.'</td>
                    <td>'.$slg.'</td>
                    <td>'.$ab.'</td>
                    <td>'.$hits.'</td>
                    <td>'.$r.'</td>
                    <td>'.$sing.'</td>
                    <td>'.$doub.'</td>
                    <td>'.$trip.'</td>
                    <td>'.$hr.'</td>
                    <td>'.$rbi.'</td>
                    <td>'.$sac.'</td>
                    <td>'.$walk.'</td>
                    <td>'.$k.'</td>
                    <td>'.$total_B.'</td>
                  </tr>';
          }
        } else {
          echo '<tr>
                  <td>'.$row1['player'].'</td>
                  <td>0</td>
                  <td>.000</td>
                  <td>.000</td>
                  <td>.000</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                </tr>';
        }
      }
    }
    ?>
        </tbody>
        <tfoot class="thead-light">
          <?php
          $sql = "select sum(u.ab), sum(u.runs), sum(u.singles),
          sum(u.doubles), sum(u.triples), sum(u.hr), sum(u.rbi), sum(u.sac),
          sum(u.walk), sum(u.k) from (".$keyR.") as u";
          $result = $conn->query($sql);
          if ($result) {
            while($row = $result ->fetch_assoc()){
              $ab = $row['sum(u.ab)'];
              $r = $row['sum(u.runs)'];
              $sing = $row['sum(u.singles)'];
              $doub = $row['sum(u.doubles)'];
              $trip = $row['sum(u.triples)'];
              $hr = $row['sum(u.hr)'];
              $rbi = $row['sum(u.rbi)'];
              $sac = $row['sum(u.sac)'];
              $walk = $row['sum(u.walk)'];
              $k = $row['sum(u.k)'];

              $sql = "select count(*) from results where year=".$current." and inning > 0";
              $result2 = $conn->query($sql);
              if ($result2->num_rows > 0) {
                while($row2 = $result2 ->fetch_assoc()){
                  $g = $row2['count(*)'];
                }
              }

              $hits = $sing + $doub + $trip + $hr;
              $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
              $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
              $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
              $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");

              echo '<tr>
                      <th>Total</th>
                      <th></th>
                      <th>'.$avg.'</th>
                      <th>'.$obp.'</th>
                      <th>'.$slg.'</th>
                      <th>'.$ab.'</th>
                      <th>'.$hits.'</th>
                      <th>'.$r.'</th>
                      <th>'.$sing.'</th>
                      <th>'.$doub.'</th>
                      <th>'.$trip.'</th>
                      <th>'.$hr.'</th>
                      <th>'.$rbi.'</th>
                      <th>'.$sac.'</th>
                      <th>'.$walk.'</th>
                      <th>'.$k.'</th>
                      <th>'.$total_B.'</th>
                    </tr>';
            }
          }
           ?>
        </tfoot>
      </table>
    </div>

    <h3>Retired</h3>
    <div class="table-responsive-xl">
      <table class="table text-center table-sm table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>G</th>
            <th>Avg.</th>
            <th>OBP.</th>
            <th>SLG.</th>
            <th>AB</th>
            <th>H</th>
            <th>R</th>
            <th>1B</th>
            <th>2B</th>
            <th>3B</th>
            <th>HR</th>
            <th>RBI</th>
            <th>SAC</th>
            <th>BB</th>
            <th>K</th>
            <th>TB</th>
          </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select player, code from players where status = 0";
        $result1 = $conn->query($sql);
        if($result1) {
          while($row1 = $result1->fetch_assoc()){
                $code = $row1['code'];

        $sql = "select sum(ab), sum(runs), sum(singles),
        sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
        sum(walk), sum(k) from ".$code;
        $result = $conn->query($sql);
        if ($result) {
          while($row = $result ->fetch_assoc()){
            $ab = $row['sum(ab)'];
            $r = $row['sum(runs)'];
            $sing = $row['sum(singles)'];
            $doub = $row['sum(doubles)'];
            $trip = $row['sum(triples)'];
            $hr = $row['sum(hr)'];
            $rbi = $row['sum(rbi)'];
            $sac = $row['sum(sac)'];
            $walk = $row['sum(walk)'];
            $k = $row['sum(k)'];

            $sql = "select count(*) from ".$code;
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
              while($row2 = $result2 ->fetch_assoc()){
                $g = $row2['count(*)'];
              }
            }

            $hits = $sing + $doub + $trip + $hr;
            $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
            $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
            $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
            $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");

            echo '<tr>
                    <td>'.$row1['player'].'</td>
                    <td>'.$g.'</td>
                    <td>'.$avg.'</td>
                    <td>'.$obp.'</td>
                    <td>'.$slg.'</td>
                    <td>'.$ab.'</td>
                    <td>'.$hits.'</td>
                    <td>'.$r.'</td>
                    <td>'.$sing.'</td>
                    <td>'.$doub.'</td>
                    <td>'.$trip.'</td>
                    <td>'.$hr.'</td>
                    <td>'.$rbi.'</td>
                    <td>'.$sac.'</td>
                    <td>'.$walk.'</td>
                    <td>'.$k.'</td>
                    <td>'.$total_B.'</td>
                  </tr>';
          }
        } else {
          echo '<tr>
                  <td>'.$row1['player'].'</td>
                  <td>0</td>
                  <td>.000</td>
                  <td>.000</td>
                  <td>.000</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                </tr>';
        }
      }
    }
    ?>
        </tbody>
      </table>
    </div>

  </div>
