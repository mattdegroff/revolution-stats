<?php
  include_once('connect.php');
  $display = true;


 ?>

<div class="container text-center">
  <h1> Welcome to Revolution Softball!</h1>
  <hr>
  <div class="row text-center">
    <div class="col-sm-4">
      <h2>Lineup for<br>April 20<sup>th</sup></h2>
      <table class="table table-sm table-striped table-bordered text-center">
        <thead>
          <tr><th>#</th><th>Name</th><th>Position</th></tr>
        </thead>
        <tbody>
          <?php
          if ($display) {
            $sql = "select id, name, pos from lineup";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['pos']."</td></tr>";
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
          <tr>
            <td>April 20<sup>th</sup>, 2018 8:30pm</td>
            <td>St. John's</td>
            <td>Wantagh Park Field C</td>
          </tr>
          <tr>
            <td>April 27<sup>th</sup>, 2018 8:30pm</td>
            <td>The Franchise</td>
            <td>Jones Beach West</td>
          </tr>
        </tbody>
      </table>
      <!--<h2>2017 Team Leaders</h2>
      <div class="row">
        <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Batting Avg.</h5>
            <?php
              /*$sql = "select count(pitch) from ".$code." where pitch = 1 and league = '".$row['league']."'";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()){
                   $games = $row['count(pitch)'];
                 }
               }*/
             ?>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">On-Base %</h5>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Runs</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Hits</h5>
        </div>
      </div>
    </div>
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
    </div>
  </div>
</div>
