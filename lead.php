<?php
  include('leadPHP.php');
 ?>

<div class="container">
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
        <?php slg(); ?>
      </div>
    </div>
  </div>
  <div class="col-md-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Hits</h5>
      <?php hits(); ?>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Singles</h5>
      <?php  ?>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Doubles</h5>
      <?php ?>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Triples</h5>
      <?php  ?>
    </div>
  </div>
</div>
<div class="col-md-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Home Runs</h5>
    <?php  ?>
  </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Runs Batted In</h5>
      <?php ?>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Walks</h5>
      <?php  ?>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Sacrifices</h5>
      <?php  ?>
    </div>
  </div>
</div>
<div class="col-md-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Total Bases</h5>
    <?php  ?>
  </div>
</div>
</div>
</div>
</div>
