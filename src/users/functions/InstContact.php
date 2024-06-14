<?php

require "../includes/dbh.inc.php";
$first_name = $_POST['fname'];
$email = $_POST['student_email'];

$from= 'mentors@gatheringwind.org';
$subject= 'Please Contact Your Instructor.';
$body= 'Please reach out to your instructor to discuss the status of your account.';


$query= "SELECT * FROM accounts";
$result= mysqli_query ($conn, $query) 
or die ('Error querying database.');


while ($row = mysqli_fetch_array($result)) {

$last_name= $row['last_name'];


$msg= "Dear $first_name $last_name,\n$body";
mail($email, $subject, $msg, 'From:' . $from);
echo 'Email sent to: ' . $email. '<br>';
}

echo "<p>Email to $first_name at $email has been successfully sent.</p><a href='admin.php?Email_Sent>Return to Admin Pages</a>'";
mysqli_close($conn);
?>