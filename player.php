<?php
  include_once('connect.php');

  $current = "2018-Summer";
  $playing = true;

  if ($_GET["player"]) {
    $player = $_GET["player"];
  }

  $sql = "select `code` from players where player = '".$player."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      $code = $row['code'];
    }
  }
?>

<style>
table {
font-size: .8rem;
}

@include media-breakpoint-up(sm) {
table {
  font-size: 1.125rem;
}
}

@include media-breakpoint-up(md) {
table {
  font-size: 1.25rem;
}
}

@include media-breakpoint-up(lg) {
table {
  font-size: 1.5rem;
}
}

</style>


<div class="container">
  <div class="row text-center">
    <div class="col-md-6 text-center">
      <h1 class="display-2" style="font-size: 3em;"><?php echo $player; ?></h1>
    </div>
    <div class="col-md-6">
      <?php if ($playing) {
        echo "<h6>Current Season</h6>";
      } else {
        echo "<h6>Career</h6>";
      }
      ?>
      <table class="table  table-sm table-bordered text-center">
      <thead class="thead-light">
       <tr><th>AVG.</th><th>OBP.</th><th>SLG.</th><th>HR</th><th>RBI</th></tr>
     </thead>
     <tbody>
        <?php
        if ($playing) {
          $sql = "select sum(ab), sum(singles),
          sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
          sum(walk) from ".$code." where league = '".$current."'";
        } else {
          $sql = "select sum(ab), sum(singles),
          sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
          sum(walk) from ".$code;
        }
        $result = $conn->query($sql);
        if (!$result) {
          echo "<tr><td>.000</td><td>.000</td><td>.000</td><td>0</td><td>0</td></tr>";
        } else {
          while($row = $result->fetch_assoc()){
            $ab = $row['sum(ab)'];
            $sing = $row['sum(singles)'];
            $doub = $row['sum(doubles)'];
            $trip = $row['sum(triples)'];
            $hr = $row['sum(hr)'];
            $rbi = $row['sum(rbi)'];
            $sac = $row['sum(sac)'];
            $walk = $row['sum(walk)'];

            $hits = $sing + $doub + $trip + $hr;
            $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
            if ($ab == 0) {
              $avg = ltrim(strval(number_format(0, 3, '.', '')), "0");
              $slg = ltrim(strval(number_format(0, 3, '.', '')), "0");
            } else {
              $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
              $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");
            }
            if ($ab == 0 && $walk ==0 && $sac == 0) {
              $obp = ltrim(strval(number_format(0, 3, '.', '')), "0");
            } else {
              $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
            }

            if ($ab == 0 && $walk ==0 && $sac == 0) {
              echo "<tr><td>".$avg."</td><td>".$obp."</td><td>".$slg."</td><td>0</td><td>0</td></tr>";
            } else {
              echo "<tr><td>".$avg."</td><td>".$obp."</td><td>".$slg."</td><td>".$hr."</td><td>".$rbi."</td></tr>";
            }
          }
          }
         ?>
       </tbody>
      </table>
    </div>
  </div>
  <div class="container text-center">
    <h2>Batting Stats</h2>
    <div class="table-responsive-xl">
    <table class="table text-center table-sm table-bordered">
      <thead class="thead-light">
          <tr>
            <th>Year</th>
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
        $sql = "select distinct league from ".$code;
        $result1 = $conn->query($sql);
        if (!$result) {
          echo "<tr><td colspan='16'>No Batting Records</td></tr>";
        } else {
          while($row1 = $result1->fetch_assoc()){

                $sql = "select sum(ab), sum(runs), sum(singles),
                sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
                sum(walk), sum(k) from ".$code." where league='".$row1['league']."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
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

                    $sql = "select count(*) from ".$code." where league='".$row1['league']."'";
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
                            <td>'.str_replace('-', ' ', $row1['league']).'</td>
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
                }
              }
            }

        ?>
      </tbody>
      <tfoot class="thead-light">
        <?php
        $sql = "select count(*), sum(ab), sum(runs), sum(singles),
        sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
        sum(walk), sum(k) from ".$code;
        $result = $conn->query($sql);
        if ($result)  {
          while($row = $result->fetch_assoc()){
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
            $g = $row['count(*)'];


            $hits = $sing + $doub + $trip + $hr;
            $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
            if ($ab == 0) {
              $avg = ltrim(strval(number_format(0, 3, '.', '')), "0");
              $obp = ltrim(strval(number_format(0, 3, '.', '')), "0");
              $slg = ltrim(strval(number_format(0, 3, '.', '')), "0");
            } else {
              $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
              $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
              $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");
            }

            echo '<tr>
                    <th>Career</th>
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
  </div>
  <div class="container text-center">
    <h2>Pitching Stats</h2>
    <div class="table-responsive-xl">
    <table class="table text-center table-sm table-bordered">
      <thead class="thead-light">
          <tr>
            <th>Year</th>
            <th>G</th>
            <th>RA</th>
            <th>IP</th>
            <th>Runs</th>
            <th>K</th>
          </tr>
      </thead>
      <tbody>
        <?php
        $games = 0;
        $ip = 0;
        $r = 0;
        $k = 0;
        $era = 0;

        $sql = "select distinct league from ".$code;
        $result = $conn->query($sql);
        if (!$result) {
          echo "<tr><td colspan='6'>No Pitching Records</td></tr>";
        } else {
          while($row = $result->fetch_assoc()){
               $sql = "select count(pitch) from ".$code." where pitch = 1 and league = '".$row['league']."'";
                $result1 = $conn->query($sql);
                if ($result1->num_rows > 0) {
                  while($row1 = $result1->fetch_assoc()){
                    $games = $row1['count(pitch)'];
                  }
                }

                $sql = "select sum(ip), sum(r), sum(kP) from ".$code." where league = '".$row['league']."'";
                $result1 = $conn->query($sql);
                if ($result1->num_rows > 0) {
                  while($row1 = $result1 ->fetch_assoc()){
                    if ($row1['sum(ip)'] == 0) {
                      if ($row1['sum(r)'] > 0 ){
                        $era = -1;
                      } else {
                        $era = 0;
                      }
                    } else {
                      $era = ($row1['sum(r)'] / $row1['sum(ip)']) * 7;
                    }
                    $ip = $row1['sum(ip)'];
                    $r = $row1['sum(r)'];
                    $k = $row1['sum(kP)'];
                  }
                }

                if ($era == -1) {
                  echo "<tr><td>".str_replace('-', ' ', $row['league'])."</td><td>".$games."</td><td>&infin;</td><td>".number_format($ip, 1, '.', '')."</td><td>".$r."</td><td>".$k."</td></tr>";
                } else {
                  if ($ip == 0) {
                    echo "<tr><td>".str_replace('-', ' ', $row['league'])."</td><td colspan='5'>No pitching records this year</td></tr>";
                  } else {
                    echo "<tr><td>".str_replace('-', ' ', $row['league'])."</td><td>".$games."</td><td>".number_format($era, 2, '.', '')."</td><td>".number_format($ip, 1, '.', '')."</td><td>".$r."</td><td>".$k."</td></tr>";
                  }
                }
          }
        }

        ?>
      </tbody>
      <tfoot class="thead-light">
        <?php
          $sql = "select sum(ip), sum(r), sum(kP), sum(pitch) from ".$code;
          $result = $conn->query($sql);
          if ($result)  {
            while($row = $result ->fetch_assoc()){
              if ($row['sum(ip)'] == 0) {
                if ($row['sum(r)'] > 0 ){
                  $era = -1;
                } else {
                  $era = 0;
                }
              } else {
                $era = ($row['sum(r)'] / $row['sum(ip)']) * 7;
              }

              if ($era == -1) {
                echo "<tr><th>Career</th><th>".$row['sum(pitch)']."</th><th>&infin;</th><th>".number_format($row['sum(ip)'], 1, '.', '')."</th><th>".$row['sum(r)']."</th><th>".$row['sum(kP)']."</th></tr>";
              } else {
                echo "<tr><th>Career</th><th>".$row['sum(pitch)']."</th><th>".number_format($era, 2, '.', '')."</th><th>".number_format($row['sum(ip)'], 1, '.', '')."</th><th>".$row['sum(r)']."</th><th>".$row['sum(kP)']."</th></tr>";
              }
            }
          }
         ?>
      </tfoot>
    </table>
  </div>
  </div>
  <div class="container text-center">
    <h2>Game-by-Game Results</h2>
    <div class="row">
    <ul class="nav flex-column nav-pills" style="margin-bottom: 10px;">
      <?php
      $i=0;
      $found = false;
      $sql = "select distinct league from ".$code." order by league desc";
      $result = $conn->query($sql);
      if ($result) {
        while($row = $result->fetch_assoc()){
        if ($row['league'] == $current) {
          echo '<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#'.$code.'-'.$row['league'].'">'.str_replace('-', ' ', $row['league']).'</a></li>';
          $found = true;
        } else {
          if ($found == false && $i == 0) {
          echo '<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#'.$code.'-'.$row['league'].'">'.str_replace('-', ' ', $row['league']).'</a></li>';
          $i++;
          } else {
          echo '<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#'.$code.'-'.$row['league'].'">'.str_replace('-', ' ', $row['league']).'</a></li>';
          $i++;
          }
        }
      }
      }
       ?>
    </ul>
  <div class="col">
    <div class="tab-content">
    <?php
    $i=0;
    $found = false;
    $sql = "select distinct league from ".$code." order by league desc";
    $result1 = $conn->query($sql);
    if ($result) {
      while($row1 = $result1->fetch_assoc()) {
        if ($row1['league'] == $current) {
          echo '<div class="tab-pane active container" id="'.$code.'-'.$row1['league'].'">';
          $found = true;
        } else {
          if ($found == false && $i == 0) {
          echo '<div class="tab-pane active container" id="'.$code.'-'.$row1['league'].'">';
          $i++;
          } else {
          echo '<div class="tab-pane container" id="'.$code.'-'.$row1['league'].'">';
          $i++;
          }
        }
          echo '<div class="table-responsive-xl">
            <table class="table table-sm table-bordered text-center">
              <thead class="thead-light">
                <tr>
                  <th colspan="2"></th>
                  <th colspan="15">Batting</th>
                  <th colspan="4">Pitching</th>
                </tr>
                <tr>
                  <th>Date</th>
                  <th>Opp.</th>
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
                  <th>RA</th>
                  <th>IP</th>
                  <th>R</th>
                  <th>K</th>
                </tr>
              </thead>
              <tbody>';

              $sql = "select `date`, opponent, ab, runs, singles, doubles,
              triples, hr, rbi, sac, walk, k, ip, r, kP from ".$code." where league='". $row1['league']."' order by date";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                  $date = $row['date'];
                  $opp = $row['opponent'];
                  $ab = $row['ab'];
                  $r = $row['runs'];
                  $sing = $row['singles'];
                  $doub = $row['doubles'];
                  $trip = $row['triples'];
                  $hr = $row['hr'];
                  $rbi = $row['rbi'];
                  $sac = $row['sac'];
                  $walk = $row['walk'];
                  $k = $row['k'];

                  $date=date_format(date_create($date),"n/j/Y");

                  $hits = $sing + $doub + $trip + $hr;
                  $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
                  $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
                  $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
                  $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");

                  if ($row['ip'] == 0) {
                    if ($row['r'] > 0 ){
                      $era = -1;
                    } else {
                      $era = 0;
                    }
                  } else {
                    $era = ($row['r'] / $row['ip']) * 7;
                  }

                  $era = number_format($era, 2, '.', '');
                  $intIP = floor($row['ip']);
                  $decIP = $row['ip'] - $intIP;
                  $ip = number_format(round(($intIP + ($decIP/.33)*.1),1), 1, '.', '');
                  $rP = $row['r'];
                  $kP = $row['kP'];

                  echo '<tr>
                          <td>'.$date.'</td>
                          <td>'.$opp.'</td>
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
                          <td>'.$total_B.'</td>';

                    if ($ip == 0 && $rP == 0) {
                      echo "<td colspan='4'>DNP</td>";
                    } else {
                      if ($era == -1) {
                        echo "<td>&infin;</td>";
                      } else {
                        echo '<td>'.$era.'</td>';
                      }

                echo '<td>'.$ip.'</td>
                      <td>'.$rP.'</td>
                      <td>'.$kP.'</td>
                    </tr>';
                    }

                }
              }

              echo '</tbody>
              <tfoot>';

              $sql = "select sum(ab), sum(runs), sum(singles),
              sum(doubles), sum(triples), sum(hr), sum(rbi), sum(sac),
              sum(walk), sum(k), sum(ip), sum(r), sum(kP) from ".$code." where league='".$row1['league']."'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
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


                  $hits = $sing + $doub + $trip + $hr;
                  $total_B = $sing + $doub*2 + $trip*3 + $hr*4;
                  $avg = ltrim(strval(number_format($hits / $ab, 3, '.', '')), "0");
                  $obp = ltrim(strval(number_format(($hits + $walk) / ($ab + $walk + $sac), 3, '.', '')), "0");
                  $slg = ltrim(strval(number_format($total_B / $ab, 3, '.', '')), "0");

                  if ($row['sum(ip)'] == 0) {
                    if ($row['sum(r)'] > 0 ){
                      $era = -1;
                    } else {
                      $era = 0;
                    }
                  } else {
                    $era = ($row['sum(r)'] / $row['sum(ip)']) * 7;
                  }

                  $era = number_format($era, 2, '.', '');
                  $intIP = floor($row['sum(ip)']);
                  $decIP = $row['sum(ip)'] - $intIP;
                  $ip = number_format(round(($intIP + ($decIP/.33)*.1),1), 1, '.', '');
                  $rP = $row['sum(r)'];
                  $kP = $row['sum(kP)'];

                  echo '<tr>
                          <td colspan="2"></td>
                          <td><b>'.$avg.'</b></td>
                          <td><b>'.$obp.'</b></td>
                          <td><b>'.$slg.'</b></td>
                          <td><b>'.$ab.'</b></td>
                          <td><b>'.$hits.'</b></td>
                          <td><b>'.$r.'</b></td>
                          <td><b>'.$sing.'</b></td>
                          <td><b>'.$doub.'</b></td>
                          <td><b>'.$trip.'</b></td>
                          <td><b>'.$hr.'</b></td>
                          <td><b>'.$rbi.'</b></td>
                          <td><b>'.$sac.'</b></td>
                          <td><b>'.$walk.'</b></td>
                          <td><b>'.$k.'</b></td>
                          <td><b>'.$total_B.'</b></td>';

                          if ($era == -1) {
                            echo "<td><b>&infin;</b></td>";
                          } else {
                            echo '<td><b>'.$era.'</b></td>';
                          }

                     echo '<td><b>'.$ip.'</b></td>
                          <td><b>'.$rP.'</b></td>
                          <td><b>'.$kP.'</b></td>
                        </tr>';
                }
              }

              echo '</tfoot>
         </table>
       </div>
     </div>';


     $i++;
      }
}

     ?>
 </div>
</div>
</div>
