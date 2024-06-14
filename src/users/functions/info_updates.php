<?php

if (isset($_POST['info_update-submit'])) {

require '../includes/dbh.inc.php';
session_start();
$username = $_SESSION['username'];
$student_id = $_SESSION['student_id'];
$first_name = $_POST['first'];
$last_name = $_POST['last'];
$phone_number = $_POST['phone'];
$email = $_POST['email'];

if (empty($username) || empty($first_name) || empty($last_name) || empty($phone_number)) {
  echo "Please fill in all fields.";
  exit();
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Invalid Email Address";
  exit();
}

else {
  $sql = "UPDATE students set first_name='$first_name', last_name='$last_name', phone='$phone_number',email='$email' WHERE student_id='$student_id'";

  
  if(mysqli_query($conn, $sql)) {
    echo "Contact Information Successfully Updated.<br /><a href='../profile.php'>Return to Profile Page</a>";
    exit();
  }
  else {
    echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}

}






?>