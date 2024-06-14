<?php
  require 'dbh.inc.php';
  session_start();

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  if (empty($first_name) || empty($last_name)) {
    header("Location: ../new_users.php?error=NAMES_ARE_REQUIRED");
    exit();
  }
  else {
    $sql = "INSERT INTO students (first_name, last_name) VALUES ('$first_name', '$last_name');";

    if(mysqli_query($conn, $sql)) {
          header("Location: ../new_users.php?Student_Created_Successfully");
          exit();
      }
    else {
      echo "Error on insert: " . $sql . "<br/>" . mysqli_error($conn);
    }
  
    mysqli_close($conn);
  }
  
  



?>