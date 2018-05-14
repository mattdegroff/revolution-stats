<?php include("connect.php");
$current = "2018-Summer";

?>

<style>
.nav {
  margin-bottom: 10px;
}

table {
font-size: 1rem;
}

@include media-breakpoint-up(sm) {
table {
  font-size: 1.2rem;
}
}

@include media-breakpoint-up(md) {
table {
  font-size: 1.4rem;
}
}

@include media-breakpoint-up(lg) {
table {
  font-size: 1.6rem;
}
}
  tbody {
    height: 100%;
    overflow: scroll;
  }
</style>

<div class="container">
    <h3 class="text-center">Cumulative</h3>
    <?php
    $sql = "select count(*) from results where oppScore > score and finished = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $lose = $row['count(*)'];
      }
    }

    $sql = "select count(inning) from results where inning > 0 and finished = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $count = $row['count(inning)'];
      }
    }

    $sql = "select count(*) from results where oppScore < score and finished = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $win = $row['count(*)'];
      }
    }

    $sql = "select count(*) from results where oppScore < score and finished = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $win = $row['count(*)'];
      }
    }

    $sql = "select sum(oppScore), sum(score) from results where finished = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $runFor = $row['sum(score)'];
        $runAgainst = $row['sum(oppScore)'];
      }
    }

    echo "<div class='row'>";

    echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Record</h5>";
    echo "<p class='card-text'>".$win." - ".$lose."</h2></div></div></div>";

    echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Runs For</h5>";
    echo "<p class='card-text'>".$runFor."<br>(".round($runFor/$count, 2)." per game)</h2></div></div></div>";

    echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Runs Against</h5>";
    echo "<p class='card-text'>".$runAgainst."<br>(".round($runAgainst/$count, 2)." per game)</h2></div></div></div>";

    echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Run Differential</h5>";
    echo "<p class='card-text'>".($runFor - $runAgainst)."</h2></div></div></div>";

    echo "</div>";

    ?>
  <hr>
  <h3 class="text-center">Season by Season</h3><br>
  <div class="row text-center">
    <div class="col-md-2">
    <ul class="nav flex-column nav-pills nav-justified">
      <?php
      $i=0;
      $sql = "select distinct league from results order by league desc";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
        if ($row['league'] == $current) {
          echo '<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#results-'.$row['league'].'">'.str_replace('-', ' ', $row['league']).'</a></li>';
        } else {
          echo '<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#results-'.$row['league'].'">'.str_replace('-', ' ', $row['league']).'</a></li>';
        }
        $i++;
      }
      }
       ?>
    </ul>
  </div>
  <div class="col-md-10">
  <div class="tab-content">
    <?php
    $i=0;
    $sql = "select distinct league from results";
    $result1 = $conn->query($sql);
    if ($result1->num_rows > 0) {
      while($row1 = $result1->fetch_assoc()){
        if ($row1['league'] == $current) {
          echo '<div class="tab-pane active container" id="results-'.$row1['league'].'">';
        } else {
          echo '<div class="tab-pane container" id="results-'.$row1['league'].'">';
        }
        $i++;

        $sql = "select count(*) from results where oppScore > score and league = '".$row1['league']."' and finished = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $lose = $row['count(*)'];
          }
        }

        $sql = "select count(inning) from results where inning > 0 and league = '".$row1['league']."' and finished = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $count = $row['count(inning)'];
          }
        }

        $sql = "select count(*) from results where oppScore < score and league = '".$row1['league']."' and finished = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $win = $row['count(*)'];
          }
        }

        $sql = "select count(*) from results where oppScore < score and league = '".$row1['league']."' and finished = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $win = $row['count(*)'];
          }
        }

        $sql = "select sum(oppScore), sum(score) from results where league = '".$row1['league']."' and finished = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $runFor = $row['sum(score)'];
            $runAgainst = $row['sum(oppScore)'];
          }
        }

        echo "<div class='row'>";
        echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Record</h5>";
        echo "<p class='card-text'>".$win." - ".$lose."</h2></div></div></div>";

        echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Runs For</h5>";
        if ($count > 0) {
          echo "<p class='card-text'>".$runFor."<br>(".round($runFor/$count, 2)." per game)</h2></div></div></div>";
        } else {
          echo "<p class='card-text'>".$runFor."<br>(0 per game)</h2></div></div></div>";
        }

        echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Runs Against</h5>";
        if ($count > 0) {
          echo "<p class='card-text'>".$runAgainst."<br>(".round($runAgainst/$count, 2)." per game)</h2></div></div></div>";
        } else {
          echo "<p class='card-text'>".$runAgainst."<br>(0 per game)</h2></div></div></div>";
        }

        echo "<div class='col-md-3'><div class='card text-center'><div class='card-body'><h5 class='card-title'>Run Differential</h5>";
        echo "<p class='card-text'>".($runFor - $runAgainst)."</h2></div></div></div>";

        echo "</div>";

    echo '<hr>
    <div class="table-responsive-xl">
    <table class="table table-sm table-bordered text-center">
      <thead class="thead-light">
        <tr><th>Date</th><th>Opponent</th><th>Revolution</th><th>Opponent Score</th><th>Result</th><th>Location</th></tr>
      </thead>
      <tbody>';

        $sql = "select date, opponent, oppScore, score, location, inning from results where league = '".$row1['league']."' and finished = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            if ($row['oppScore'] > $row['score']) {
              $record = 'Loss';
            } else {
              $record = 'Win';
            }

            $date=date_format(date_create($row['date']),"n/j/Y g:i A");

            if ($row['inning'] != 7 && $row['inning'] > 0) {
              echo "<tr><td>".$date."</td><td>".$row['opponent']."</td><td>".$row['score']."</td><td>".$row['oppScore']."</td><td>".$record." (".$row['inning']." innings)</td><td>".$row['location']."</td></tr>";
            } else if ($row['inning'] == -1) {
              echo "<tr><td>".$date."</td><td>".$row['opponent']."</td><td colspan='3'>Postponed</td><td>".$row['location']."</td></tr>";
            } else if ($row['inning'] == 0) {
              echo "<tr><td>".$date."</td><td>".$row['opponent']."</td><td colspan='3'>Cancelled</td><td>".$row['location']."</td></tr>";
            } else {
              echo "<tr><td>".$date."</td><td>".$row['opponent']."</td><td>".$row['score']."</td><td>".$row['oppScore']."</td><td>".$record."</td><td>".$row['location']."</td></tr>";
            }
          }
        }
        echo '</tbody>';
        echo '<tfoot>';

        echo '<tr><th></th><th></th><th>'.$runFor.'</th><th>'.$runAgainst.'</th><th>'.$win.' - '.$lose.'</th><th></th></tr>';
        echo '<tr><th colspan="2"></th><th colspan="2">'.($runFor - $runAgainst).' Run Differential</th><th colspan="2"></th></tr>';

        echo '</tfoot></table></div>';
        echo '</div>';
      }
    }
    ?>
  </div>
</div>
</div>
