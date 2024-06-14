<?php
  require 'dbh.inc.php';
  session_start();

  $student_id = $_POST['student_id'];
  $new_status = $_POST['admin_status'];

  if (empty($student_id)) {
    header("Location: ../admin_users.php?error=student_id_needed");
    exit();
  }
  else {
    $sql = "UPDATE accounts SET admin = '$new_status' WHERE student_id = $student_id ";

    if(mysqli_query($conn, $sql)) {
      header("Location: ../admin_users.php?success");
      exit();
    }
    else {
      echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
    }
  
    mysqli_close($conn);
  }
  
  



?>