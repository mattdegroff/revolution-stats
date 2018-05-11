<?php
  include('leadPHP.php');
 ?>

 <style>
  .card {
    margin-bottom: 10px;
  }

 </style>

<div class="container text-center">
<h2>Team Leaders</h2>
  <div class="row">
    <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Batting Avg.</h5>
        <?php avg(); ?>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">On-Base %</h5>
        <?php obp(); ?>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Slugging %</h5>
        <?php slg(); ?>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Hits</h5>
      <?php hits(); ?>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Singles</h5>
      <?php singles(); ?>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Doubles</h5>
      <?php doubles(); ?>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Triples</h5>
      <?php triples(); ?>
    </div>
  </div>
</div>
<div class="col-lg-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Home Runs</h5>
    <?php hr(); ?>
  </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Runs Batted In</h5>
      <?php rbi(); ?>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Walks</h5>
      <?php walks(); ?>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Sacrifices</h5>
      <?php sac(); ?>
    </div>
  </div>
</div>
<div class="col-lg-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Total Bases</h5>
    <?php total(); ?>
  </div>
</div>
</div>
</div>
</div>
