<?php
  require 'dbh.inc.php';
  session_start();

  $student_id = $_POST['student_id'];
  $new_grade = $_POST['std_grade'];
  $module = $_SESSION['module'];

  if (empty($student_id)) {
    header("Location: ../gradebook.php?error=student_id_needed");
    exit();
  }
  else {
    $sql = "UPDATE gradebook SET $module = '$new_grade' WHERE student_id = $student_id ";

    if(mysqli_query($conn, $sql)) {
      header("Location: ../gradebook.php?success");
      exit();
    }
    else {
      echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
    }
  
    mysqli_close($conn);
  }
  
  



?>