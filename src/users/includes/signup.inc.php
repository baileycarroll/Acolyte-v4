<?php

if (isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $username = $_POST['username'];
    $student_id = $_POST['student_id'];
    $password = $_POST['pass'];
    $passwordRepeat = $_POST['passRep'];
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $agreement = $_POST['priv_and_tos'];

    if (empty($username) || empty($student_id) || empty($password) || empty($passwordRepeat)){
        header("Location: ../register.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    else if($password !== $passwordRepeat) {
        header("Location: ../register.php?error=passwordcheck&uid=".$username."&email=".$email);
        exit();
    }
    else if($agreement == 0) {
        header("Location: ../register.php?error_TOS_must_be_agreed");
        exit();
    }
    else {
        $sql = "UPDATE accounts SET username='$username', password='$hashedPwd' WHERE student_id='$student_id'";
       
        if(mysqli_query($conn, $sql)) {
            header("Location: ../login.php?registrationSuccessful");
        exit();
          }
          else {
            echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
          }
        
        
       
    
        }
    mysqli_close($conn);
}
else {
    header("Location: ../../index.html");
        exit();
}

?>


