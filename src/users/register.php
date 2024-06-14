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

<style>

a {
  color: black;
}
</style>
</head>




<header class="text-light">
  <img src="img/Header.jpg" width="100%" height="100px" alt="Gathering WIND">
  </img>

<nav class="navbar navbar-expand-lg navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="../index.php">Home</a></li>
      <li><a class="nav-link" href="../tos.php">Terms of Service</a></li>
      <li><a class="nav-link" href="../privpoly.php">Privacy Policy</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
</nav>
</header>
<main>
    <body class="text-center">
    <div class="row d-flex justify-content-center">
    <div id="regForm" class="col-4 text-center text-light form-group m-3">
    <form class="form-signin" _lpchecked="1" action="includes/signup.inc.php" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">
          Please Register
        </h1>
        <label for="inputUsername" class="sr-only">
        Username
        </label>
        <input type="text" id="inputUsername" class="form-control mb-2" placeholder="Username" name="username" required="" autofocus="" autocomplete="off">
        <label for="inputPassword" class="sr-only">
        Password
        </label>
        <input type="password" id="inputPassRep" class="form-control mb-2" placeholder="Password" name="pass" required="" autocomplete="off">
        <label for="inputPassRep" class="sr-only">
        Repeat Password
        </label>
        <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Repeat Password" name="passRep" required="" autocomplete="off">
        <label for="inputEmail" class="sr-only">
          Student ID (In your Registration Email)
        </label>
        <input type="integer" id="inputEmail" class="form-control mb-2" placeholder="Student ID" required="" name="student_id" autofocus="" autocomplete="off">
        <input type="checkbox" class="m-2" value="1" name="priv_and_tos" id="priv_and_tos"> I agree to the GatheringWIND<a href="../tos.php"> Terms of Service</a> and <a href="../privpoly.php">Privacy Policy</a>
        <button class="btn mb-1 btn-lg btn-primary btn-block" name="signup-submit" type="submit">
          Register
        </button>
    </form>
    </div>
    </div>
    </body>
  </main>

  <?php 
  require "footer.php";
  ?>