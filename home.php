<?php
  include_once('connect.php');
  include('lead.php');
  $sql = "select display from lineupDisp";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      if ($row['display'] == 0) {
        $display = false;
      } else {
        $display = true;
      }
    }
  }



 ?>

<div class="container text-center">
  <h1> Welcome to Revolution Softball!</h1>
  <hr>
  <div class="row text-center">
    <div class="col-sm-4">
      <?php
      $sql = "select date from upcoming order by date limit 1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          $date=date_format(date_create($row['date']),"F jS");
        }
      }
      ?>
      <h2>Tentative Lineup <br>for <?php echo $date; ?></h2>
      <table class="table table-sm table-striped table-bordered text-center">
        <thead>
          <tr><th>#</th><th>Name</th><th>Position</th></tr>
        </thead>
        <tbody>
          <?php
          $num = 1;
          if ($display) {
            $sql = "select name, pos, display from lineup order by id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                if ($row['display'] == 1) {
                  echo "<tr><td>".$num."</td><td>".$row['name']."</td><td>".$row['pos']."</td></tr>";
                  $num++;
                }
              }
            }
          } else {
            echo "<tr><td colspan='3'>To Be Announced</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-sm-8">
      <h2>Upcoming Games</h2>
      <table class="table table-bordered text-center table-sm">
        <thead>
          <tr><th>Date & Time</th><th>Opponent</th><th>Location</th></tr>
        </thead>
        <tbody>
          <?php
          $sql = "select date, opp, location from upcoming order by `date`";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
              $date = date_format(date_create($row['date']),"F jS, Y g:i A");

              echo "<tr><td>".$date."</td><td>".$row['opp']."</td><td>".$row['location']."</td></tr>";
            }
          }
          ?>
        </tbody>
      </table>
      <h2>Postponed Games</h2>
      <div class="row">
        <div class="col-sm-3">
          <table border=0>
            <tr><th>Revolution</th><th>11</th></tr>
            <tr><th>St. John's</th><th>13</th></tr>
            <tr><td>Top 4</td><td>0 Outs</td></tr>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm">
          <p>Postponed Games will be continued directly before next scheduled DH against opponent.</p>
        </div>
      </div>
    </div>
  </div>
    <h2>Team Leaders</h2>
      <div class="row">
        <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Batting Avg.</h5>
            <?php avg(); ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">On-Base %</h5>
            <?php obp(); ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Runs</h5>
          </div>
        </div>
      </div>
      <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Hits</h5>
        </div>
      </div>
    </div>
    </div>
  <!--<div class="row">

    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Singles</h5>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Doubles</h5>
        </div>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Triples</h5>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Home Runs</h5>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">RBI</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sacrifices</h5>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Walks</h5>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Total Bases</h5>
          </div>
        </div>
      </div>-->
  </div>
