<?php

session_start();
?>

<!doctype html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Gathering Wind</title>

<script src="js/scripts.js"> </script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="/css/style.css" type=text/css>

<script src="https://cdn.tiny.cloud/1/34j1r2wiojy8shf1rhb1lu949ogfbo8i39ilfkefx9hw1tt7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>tinymce.init({selector:'textarea'});</script>

</head>




<header class="text-light">
  <img src="img/Header.jpg" width="100%" height="100px" alt="Gathering WIND">
  </img>

<nav class="navbar navbar-expand-lg navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="../index.php">Home</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
                    
        
<?php 
        if($_SESSION['year'] == '10') {
            printf(
                '<li class="nav-item">
                <a href="admin.php" class="nav-link">Admin</a>
            </li>'
            );
        }
        if (isset($_SESSION['username'])) {
            printf( '<li class="nav-item">
            <a href="profile.php" class="nav-link">My Profile</a>
        </li><li id="loginLink" class="nav-item"><form id="logsOut" action="includes/logout.inc.php" method="post">
            <button class=" btn btn-light text-dark" type="submit" name="logout-submit">Logout</button>
        </form></li>');
        }
    ?>
               
                    </ul>
</nav>
                
                
    </header>
    
    <body>

