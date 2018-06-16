
<?php
include_once("connect.php");
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script>
        var update = function(name) {
          var player = name.replace(/\s+/g, '%20');
          var xmlhttp;

          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("content").innerHTML = xmlhttp.responseText;
            }
          };
          xmlhttp.open("GET","player.php?player="+player,true);
          xmlhttp.send();
        };

        function home() {
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("content").innerHTML = xmlhttp.responseText;
            }
          }
          xmlhttp.open("GET","home.php",true);
          xmlhttp.send();
        }

        function results() {
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("content").innerHTML = xmlhttp.responseText;
            }
          }
          xmlhttp.open("GET","results.php",true);
          xmlhttp.send();
        }

        function full() {
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("content").innerHTML = xmlhttp.responseText;
            }
          }
          xmlhttp.open("GET","full.php",true);
          xmlhttp.send();
        }

        function lead() {
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("content").innerHTML = xmlhttp.responseText;
            }
          }
          xmlhttp.open("GET","lead.php",true);
          xmlhttp.send();
        }

        full();
    </script>
    <title>Revolution Softball</title>
  </head>
  <body>
    <style>
    html {
    font-size: 12px;
    }
    @media screen and (min-width: 320px) {
    html {
      font-size: calc(12px + 6 * ((100vw - 320px) / 680));
    }
    }
    @media screen and (min-width: 1000px) {
    html {
      font-size: 16px;
    }
    }
    body {
      font-size: calc([minimum size] + ([maximum size] - [minimum size]) * ((100vw - [minimum viewport width]) / ([maximum viewport width] - [minimum viewport width])));
    }


    .dropdown-menu {
	min-width: 200px;
}
.dropdown-menu.columns-2 {
	min-width: 400px;
}
.dropdown-menu.columns-3 {
	min-width: 600px;
}
.dropdown-menu li a {
	padding: 5px 15px;
	font-weight: 300;
}
.multi-column-dropdown {
	list-style: none;
  margin: 0px;
  padding: 0px;
}
.multi-column-dropdown li a {
	display: block;
	clear: both;
	line-height: 1.428571429;
	color: #333;
	white-space: normal;
}
.multi-column-dropdown li a:hover {
	text-decoration: none;
	color: #262626;
	background-color: #999;
}

@media (max-width: 767px) {
	.dropdown-menu.multi-column {
		min-width: 240px !important;
		overflow-x: hidden;
	}
}
    </style>

    <!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-md bg-light navbar-light">

  <a class="navbar-brand" href="#">Revolution Softball</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="full()">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="results()">Results</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="lead()">Stat Leaders</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Roster</a>

        <div class="dropdown-menu multi-column columns-2">
          <!--<a class="dropdown-item" href="#" onclick="full()">Full Roster</a>-->
          <div class="dropdown-header">Active Roster</div>
            <?php
              $sql = "select count(player) from players where status=1";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                  $total = $row['count(player)'];
                }
              }

              $half = ceil($total / 2);
              ?>
              <div class="row">
                <div class="col-6">
                  <?php
                  $sql = "select player, code from players where status=1 order by player limit ". $half;
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                      echo '<a class="dropdown-item" href="#" onclick="update(\''.$row['player'].'\')">'.$row['player'].'</a>';
                    }
                  }
                ?>
                </div>
                <div class="col-6">
                  <?php
                  $sql = "select player from players where status=1 order by player limit ". $half . ", ".$half;
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                      echo '<a class="dropdown-item" href="#" onclick="update(\''.$row['player'].'\')">'.$row['player'].'</a>';
                    }
                  }
                   ?>
                 </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-header">Reserves</div>
            <?php
            $sql = "select count(player) from players where status=2";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                $total = $row['count(player)'];
              }
            }

            $half = ceil($total / 2);
            ?>
            <div class="row">
              <div class="col-6">
                <?php

            $sql = "select player from players where status=2 order by player limit ". $half;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                echo '<a class="dropdown-item" href="#" onclick="update(\''.$row['player'].'\')">'.$row['player'].'</a>';
              }
            }
            ?>
            </div>
            <div class="col-6">
              <?php

          $sql = "select player from players where status=2 order by player limit ". $half . ", ".$half;
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
              echo '<a class="dropdown-item" href="#" onclick="update(\''.$row['player'].'\')">'.$row['player'].'</a>';
            }
          }
          ?>
        </div>
      </div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-header">Retired</div>
            <?php
              $sql = "select count(player) from players where status=0";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                  $total = $row['count(player)'];
                }
              }

              $half = ceil($total / 2);
              ?>
              <div class="row">
                <div class="col-6">
                  <?php
                  $sql = "select player, code from players where status=0 order by player limit ". $half;
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                      echo '<a class="dropdown-item" href="#" onclick="update(\''.$row['player'].'\')">'.$row['player'].'</a>';
                    }
                  }
                ?>
                </div>
                <div class="col-6">
                  <?php
                  $sql = "select player from players where status=0 order by player limit ". $half . ", ".$half;
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                      echo '<a class="dropdown-item" href="#" onclick="update(\''.$row['player'].'\')">'.$row['player'].'</a>';
                    }
                  }
                   ?>
                 </div>
            </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" target=_blank href="https://aba.leagueapps.com/leagues/634654/schedule">Schedule</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" target=_blank href="https://aba.leagueapps.com/leagues/634654/standings">Standings</a>
    </li>
    </ul>
  </div>
</nav>

<div id="content" style="margin-top: 25px;"></div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
