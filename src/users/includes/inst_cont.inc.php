<?php
  require 'dbh.inc.php';
  session_start();

  $student_id = $_POST['student_id'];

  $from = 'helpdesk@gatheringwind.org';
  $subject = 'Please contact your instructor.';
  $body = "At this time your account is $acc_status. Please reach out to either Lord Carroll or Lady Gwenyfur to discuss your account. If you do not have their contact information please look under the about us page on the gatheringwind.org website.";

  $query = "SELECT * FROM students WHERE student_id = $student_id";
  $result = mysqli_query ($conn, $query) or die ('Error in finding account');

  $name = $row['first_name]'];
  $email = $row['email'];
  $acc_status = $row['first_name'];

  while ($row = mysqli_fetch_array($result)) {
    $msg = " Hello $name, \n $body";
    mail($email, $subject, $msg, 'From:' . $from);
    header("Location: ../admin.php?email=Sent");
  }
  mysqli_close($conn);
?>

?>