<?php
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';
  session_start();

  $username = $_SESSION['username'];
  $password = $_POST['pass'];
  $passwordRepeat = $_POST['passRep'];
  $student_id = $_SESSION['student_id'];

  if (empty($username) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../profile.php?error=emptyfields");
    exit();
  }
  else if ($password !== $passwordRepeat) {
    header("Location: ../profile.php?error=passwords_do_not_match");
    exit();
  }
  else {
    $new_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE accounts SET password = '$new_password' WHERE student_id = '$student_id' ";

    if(mysqli_query($conn, $sql)) {
      echo "
      <!doctype HTML>
      <html>
      <head>
      </head>
      <body>
  
      <h4>Thank you! Your password has been successfully updated.</h4>
  
      <p>
      <a href='../profile.php'> Return to Profile Page </a>
      </p>
  
      </body>
      </html>
      ";
  
      exit();
    }
    else {
      echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
    }
  
    mysqli_close($conn);
  }
  
  }
  



?>